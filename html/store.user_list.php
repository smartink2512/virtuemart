<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: store.user_list.php,v 1.2 2005/09/27 17:51:26 soeren_nb Exp $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );

if (!$acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' )) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

require_once( PAGEPATH . 'store.users.html.php' );

$task = trim( mosGetParam( $_REQUEST, 'task', null ) );
$cid = mosGetParam( $_REQUEST, 'cid', array( 0 ) );
if (!is_array( $cid )) {
	$cid = array ( 0 );
}

switch ($task) {
	case "new":
		editUser( 0, $option);
		break;

	case "edit":
		editUser( intval( $cid[0] ), $option );
		break;

	case "save":
		saveUser( $option );
		break;

	case "remove":
		removeUsers( $cid, $option );
		break;

	case "remove_as_customer":
      remove_as_customer( $cid, $option );
		break;
    
	case "block":
		changeUserBlock( $cid, 1, $option );
		break;

	case "unblock":
		changeUserBlock( $cid, 0, $option );
		break;

	default:
		showUsers( $option );
		break;
}

function showUsers( $option ) {
	global $database, $mainframe, $my, $acl, $_VERSION;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = $mainframe->getUserStateFromRequest( "viewcom_userslimitstart", 'limitstart', 0 );
	$search = $mainframe->getUserStateFromRequest( "searchcom_users", 'search', '' );
	$search = $database->getEscaped( trim( strtolower( $search ) ) );

	$where = array();
	if (isset( $search ) && $search!= "") {
		$where[] = "(username LIKE '%$search%' OR email LIKE '%$search%' OR a.name LIKE '%$search%')";
	}

	// exclude any child group id's for this user
	//$acl->_debug = true;
	$pgids = $acl->get_group_children( $my->gid, 'ARO', 'RECURSE' );

	if (is_array( $pgids ) && count( $pgids ) > 0) {
		$where[] = "(a.gid NOT IN (" . implode( ',', $pgids ) . "))";
	}

	$database->setQuery( "SELECT COUNT(*)"
		. "\nFROM #__users AS a"
		. (count( $where ) ? "\nWHERE " . implode( ' AND ', $where ) : "")
	);
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );
  
  //$where[] = "sg.shopper_group_id = sv_xref.shopper_group_id";
  //$where[] = "sv_xref.user_id = a.id";
  $aro_id = "aro_id";
  $group_id = "group_id";
  if( isset( $_VERSION ))
	if( $_VERSION->RELEASE == "4.5" && $_VERSION->DEV_LEVEL >= "3" ) {
	  $aro_id = "id";
	  $group_id = "id";
	}
  $q_uery = "SELECT a.*, g.name AS groupname"
	. "\nFROM #__users AS a"
	. "\nINNER JOIN #__core_acl_aro AS aro ON aro.value = a.id"	// map user to aro
	. "\nINNER JOIN #__core_acl_groups_aro_map AS gm ON gm.aro_id = aro.$aro_id"	// map aro to group
	. "\nINNER JOIN #__core_acl_aro_groups AS g ON g.$group_id = gm.group_id";
	
  $q_uery .= (count( $where ) ? "\nWHERE " . implode( ' AND ', $where ) : "");
		//. "\nGROUP BY usertype,username"
  if (!empty($_REQUEST['arg']))
	$q_uery  .= "\nORDER BY ".$_REQUEST['arg']." ".$_REQUEST['order']." ";
        
  $q_uery	.= "\nLIMIT $pageNav->limitstart, $pageNav->limit";

 $database->setQuery($q_uery);
 
	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	HTML_users::showUsers( $rows, $pageNav, $search, $option );
}

function editUser( $uid='0', $option='com_virtuemart' ) {
	global $database, $my, $acl;

	$row = new mosUser( $database );
	// load the row from the db table
	$row->load( $uid );

	// check to ensure only super admins can edit super admin info
	if ( ( $my->gid < 25 ) && ( $row->gid == 25 ) ) {
		mosRedirect( 'index2.php?option=com_virtuemart', _NOT_AUTH );
	}
	
	$lists = array();

	$my_group = strtolower( $acl->get_group_name( $row->gid, 'ARO' ) );
	if ($my_group == 'super administrator') {
		$lists['gid'] = "<input type=\"hidden\" name=\"gid\" value=\"$my->gid\" /><strong>Super Administrator</strong>";
	} else {
		// ensure user can't add group higher than themselves
		$my_groups = $acl->get_object_groups( 'users', $my->id, 'ARO' );
		if (is_array( $my_groups ) && count( $my_groups ) > 0) {
			$ex_groups = $acl->get_group_children( $my_groups[0], 'ARO', 'RECURSE' );
		} else {
			$ex_groups = array();
		}
	
		$gtree = $acl->get_group_children_tree( null, 'USERS', false );

		// remove users 'above' me
		$i = 0;
		while ($i < count( $gtree )) {
			if (in_array( $gtree[$i]->value, $ex_groups )) {
				array_splice( $gtree, $i, 1 );
			} else {
				$i++;
			}
		}

		$lists['gid'] = mosHTML::selectList( $gtree, 'gid', 'size="4"', 'value', 'text', $row->gid );
	}

// make the select list for yes/no fields
	$yesno[] = mosHTML::makeOption( '0', (_CMN_NO) );
	$yesno[] = mosHTML::makeOption( '1', (_CMN_YES) );

// build the html select list
	$lists['block'] = mosHTML::yesnoSelectList( 'block', 'class="inputbox" size="1"', $row->block );

// build the html select list
	$lists['sendEmail'] = mosHTML::yesnoSelectList( 'sendEmail', 'class="inputbox" size="1"', $row->sendEmail );

	HTML_users::edituser( $row, $lists, $option, $uid );
}

function saveUser( $option ) {
	global $database, $my, $ps_shopper_group, $ps_shopper, $mosConfig_live_site, $_VERSION;

	$row = new mosUser( $database );
	
	$user_id 	= intval( mosGetParam( $_POST, 'id', 0 ));
	$isNew		= empty($user_id);
	
	$row->load( $user_id );
	
	$orig_password = $row->password;
	
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	// check to ensure only super admins can edit super admin info
	$database->setQuery( "SELECT group_id FROM #__core_acl_groups_aro_map as am, #__core_acl_aro as a WHERE value='".$row->id."' AND a.aro_id = am.aro_id"); 
	$group_id = $database->loadResult();
	
	if ( ( $my->gid < 25 ) && ( $group_id == 25 ) ) {
		mosRedirect( 'index2.php?option=com_virtuemart', _NOT_AUTH );
	}
	
	// number of Super Administrators
	$query = "SELECT COUNT( id  )"
	. "\n FROM #__users"	
	. "\n WHERE gid = '25'"
	. "\n AND block = 0"
	;
	$database->setQuery( $query );
	$supers = $database->loadResult();
	// check if only one Super Administrator exists
	if ( $supers == 1 && $_POST["block"] ) {
		mosRedirect( "index2.php?option=com_virtuemart&page=store.user_list", "You cannot block the only Superadministrator!" );
	}
  
	$pwd = '';
	if ( isset( $_POST["password"] ) && isset( $_POST["password2"] ) && $_POST["password"] != '' ) {
		if ( $_POST["password2"] == $_POST["password"] ) {
			$row->password = md5( $_POST["password"] );
		} else {
			echo "<script> alert('"._REGWARN_VPASS2."'); window.history.go(-1); </script>\n";
			exit();
		}
	} else {
		// Restore 'original password'
		$row->password = $orig_password;
	}
	$aro_id = "aro_id";
	$group_id = "group_id";
	if( isset( $_VERSION ))
	  if( $_VERSION->RELEASE == "4.5" && $_VERSION->DEV_LEVEL >= "3" ) {
		$aro_id = "id";
		$group_id = "id";
	  }
	// save usertype to usetype column
	$query = "SELECT name"
	. "\n FROM #__core_acl_aro_groups"
	. "\n WHERE $group_id = $row->gid";
	
	$database->setQuery( $query );
	$usertype = $database->loadResult();
	$row->usertype = $usertype;
	
	$row->user_info_id = md5 (uniqid (rand())); 
	$row->address_type = $_POST['address_type'];
	$row->first_name = $_POST['first_name'];
	$row->last_name = $_POST['last_name'];
	$row->middle_name = $_POST['middle_name'];
	$row->title = $_POST['title'];
	if (empty($_POST['perms']))
		$_POST['perms'] = "shopper";
	$row->perms = $_POST['perms'];
	$row->address_type_name = $_POST['address_type_name'];
	$row->company = $_POST['company'];
	$row->address_1 = $_POST['address_1'];
	$row->address_2 = $_POST['address_2'];
	$row->city = $_POST['city'];
	$row->zip = $_POST['zip'];
	$row->state = $_POST['state'];
	$row->country = $_POST['country'];
	$row->phone_1 = $_POST['phone_1'];
	$row->fax = $_POST['fax'];
	$row->bank_account_nr = $_POST['bank_account_nr'];
	$row->bank_sort_code = $_POST['bank_sort_code'];
	$row->bank_name = $_POST['bank_name'];
	$row->bank_iban = $_POST['bank_iban'];
	$row->bank_account_holder = $_POST['bank_account_holder'];
	$row->bank_account_type = $_POST['bank_account_type'];
        
	// save register date for new users
	if ( $isNew ) {
		$row->registerDate = date( 'Y-m-d H:i:s' );
	}
	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-2); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-2); </script>\n";
		exit();
	}
	
	// update the ACL
	if ($isNew) {
    
        ////////////////////////////////////////////////////
        // BEGIN PHPSHOP MODIFICATION
        //
        // some have experienced problems with acl records not
        // being stored with $row->store()
        
        // get the user id
        
        $database->setQuery( "SELECT id FROM #__users"
        ."\n WHERE username='".$row->username."' AND email='".$row->email."'" );
        $my_user_id = $database->loadResult();

        // check here if the acl-records have already been stored
        // so you can built in this modification even if you don't have problems
        
        $database->setQuery( "SELECT a.value FROM #__core_acl_aro as a, #__core_acl_groups_aro_map as b"
        ."\n WHERE value='".$my_user_id."' AND a.$aro_id = b.aro_id" );
        $database->query();
        $am_i_null = $database->getNumRows();
        
        
        // check if the query has an result
        if( empty( $am_i_null ) ) {
            
            $q_store1 = "INSERT INTO #__core_acl_aro (section_value,value,order_value,name,hidden) ";
            $q_store1 .= "VALUES ('users','".$my_user_id."','0','".$row->name."','0')";
            $database->setQuery($q_store1);
            $database->query();
            
            
            // get the aro_id (auto_increment!)
            // of the record we've stored
            $database->setQuery( "SELECT $aro_id FROM #__core_acl_aro WHERE value='".$my_user_id."'" );
            $my_aro_id = $database->loadResult();
            
            $q_store2 = "INSERT INTO #__core_acl_groups_aro_map (group_id,section_value,aro_id) ";
            $q_store2 .= "VALUES ('".$row->gid."','','".$my_aro_id."')";
            $database->setQuery($q_store2);
            $database->query();
        }
        
        include_class('shopper');
        $ps_shopper->add($my_user_id, $_POST['shopper_group_id'], $_POST['customer_number'], $_POST['vendor_id']);
    
        // now we have stored the missing entries in tables
        // #__core_acl_aro and #__core_acl_groups_aro_map
        //
        // END PHPSHOP MODIFICATION
        ////////////////////////////////////////////////////
        
        
	} else {
  
      $vals["shopper_group_id"] = $_POST['shopper_group_id'];
      $vals["customer_number"] = $_POST['customer_number'];
      $vals["user_id"] = $row->id;
      $vals["vendor_id"] = $_POST['vendor_id'];
      include_class('shopper');
      $ps_shopper->update($vals);
      
		$database->setQuery( "SELECT $aro_id FROM #__core_acl_aro WHERE value='$row->id'" );
		$my_aro_id = $database->loadResult();

		$database->setQuery( "UPDATE #__core_acl_groups_aro_map"
			. "\nSET group_id = '$row->gid'"
			. "\nWHERE aro_id = '$my_aro_id'"
		);
		$database->query() or die( $database->stderr() );
	}

	$row->checkin();
	if ($isNew) {
		$database->setQuery( "SELECT email FROM #__users WHERE id=$my->id" );
		$adminEmail = $database->loadResult();

		$subject = "New User Details";
		$message = "Hello $row->name,\r \n \r \n";
		$message .= "You have been added as a user to $mosConfig_live_site by an Administrator.\r \n";
		$message .= "This email contains your username and password to log into the $mosConfig_live_site site:\r \n \r \n";
		$message .= "Username - $row->username\r \n";
		$message .= "Password - $row->password\r \n \r \n \r \n";
		$message .= "Please do not respond to this message as it is automatically generated and is for information purposes only\r \n";

		$headers .= "From: $adminEmail\r\n";
		$headers .= "Reply-To: $adminEmail\r\n";
		$headers .= "X-Priority: 3\r\n";
		$headers .= "X-MSMail-Priority: Low\r\n";
		$headers .= "X-Mailer: Mambo Open Source 4.5\r\n";

		mail( $row->email, $subject, $message, $headers );
	}

	$limit = intval( mosGetParam( $_REQUEST, 'limit', 10 ) );
	$limitstart	= intval( mosGetParam( $_REQUEST, 'limitstart', 0 ) );
	mosRedirect( "index2.php?option=$option&page=store.user_list" );
}

function removeUsers( $cid, $option ) {
	global $database, $acl;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
		exit;
	}
	$msg = '';
	if (count( $cid )) {
		$obj = new mosUser( $database );
		foreach ($cid as $id) {
			// check for a super admin ... can't delete them
			$groups = $acl->get_object_groups( 'users', $id, 'ARO' );
			$this_group = strtolower( $acl->get_group_name( $groups[0], 'ARO' ) );
			if ($this_group == 'super administrator') {
				$msg .= "You cannot delete a Super Administrator";
			} else {
				$obj->delete( $id );
				$msg .= $obj->getError();
        
        if (empty($msg)) {
        
            /** Delete shopper_vendor_xref entries **/
            $q = "DELETE FROM #__{vm}_shopper_vendor_xref where user_id='" . $id . "'"; 
            $database->setQuery($q);
            $database->query();
            
            $q = "DELETE FROM #__{vm}_auth_user_vendor where user_id='" . $id . "'"; 
            $database->setQuery($q);
            $database->query();

        }
			}
		}
	}

	$limit = intval( mosGetParam( $_REQUEST, 'limit', 10 ) );
	$limitstart	= intval( mosGetParam( $_REQUEST, 'limitstart', 0 ) );
	mosRedirect( "index2.php?option=$option&page=store.user_list", $msg );
}

function remove_as_customer( $cid, $option ) {
	global $database, $acl;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
		exit;
	}
	$msg = '';
  $ps_user = new ps_user;
	if (count( $cid )) {
		foreach ($cid as $id) {
        $d['user_id'] = $id;
        				       
        if ($ps_user->delete( $d )) {
        
            /** Delete shopper_vendor_xref entries **/
            $q = "DELETE FROM #__{vm}_shopper_vendor_xref where user_id='" . $id . "'"; 
            $database->setQuery($q);
            $database->query();
            
            $q = "DELETE FROM #__{vm}_auth_user_vendor where user_id='" . $id . "'"; 
            $database->setQuery($q);
            $database->query();
            $msg = "User was removed from customer list";
        }
			}
		}

	$limit = intval( mosGetParam( $_REQUEST, 'limit', 10 ) );
	$limitstart	= intval( mosGetParam( $_REQUEST, 'limitstart', 0 ) );
	mosRedirect( "index2.php?option=$option&page=store.user_list", $msg );
}

/**
* Blocks or Unblocks one or more user records
* @param array An array of unique category id numbers
* @param integer 0 if unblock, 1 if blocking
* @param string The current url option
*/
function changeUserBlock( $cid=null, $block=1, $option ) {
	global $database, $my;

	if (count( $cid ) < 1) {
		$action = $block ? 'block' : 'unblock';
		echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );

	$database->setQuery( "UPDATE #__users SET block='$block'"
	. "\nWHERE id IN ($cids)"
	);
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	mosRedirect( "index2.php?option=$option&page=store.user_list" );
}

function is_email($email){
	$rBool=false;

	if(preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $email)){
		$rBool=true;
	}
	return $rBool;
}
?>
