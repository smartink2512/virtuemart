<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: ps_shopper.php,v 1.3 2005/09/29 20:01:14 soeren_nb Exp $
* @package VirtueMart
* @subpackage classes
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

/**
*
* The class is meant to manage shopper entries
*/
class ps_shopper {
  var $classname = "ps_shopper";
  
	/**************************************************************************
	** name: validate_add()
	** created by:
	** description:
	** parameters:
	** returns:
	  ***************************************************************************/
	function validate_add(&$d) {
		global $my, $perm;
		
		$db = new ps_DB;
		
		$provided_required = true;
		$missing = "";
		
		if( empty( $my->id )) {
			if (empty($d['username'])) { $provided_required = false; $missing .= "username,"; }
			if (empty($d['password'])) { $provided_required = false; $missing .= "password,"; }
			if (empty($d['password2'])) { $provided_required = false; $missing .= "password2,"; }
			if (empty($d['email'])) { $provided_required = false; $missing .= "email,"; }
		}
		
		if (empty($d['first_name'])) { $provided_required = false; $missing .= "first_name,"; }
		if (empty($d['last_name']))  { $provided_required = false; $missing .= "last_name,"; }
		//if (empty($d['company']))  { $provided_required = false; $missing .= "company,"; }
		if (empty($d['address_1']))  { $provided_required = false; $missing .= "address_1,"; }
		if (empty($d['city']))  { $provided_required = false; $missing .= "city,"; }
		if (empty($d['zip'])) { $provided_required = false; $missing .= "zip,"; }
		if (CAN_SELECT_STATES == '1') {
			if (empty($d['state'])) { $provided_required = false; $missing .= "state,"; }
		}
		if (empty($d['country'])) { $provided_required = false; $missing .= "country,"; }
		//if (empty($d['phone_1'])) { $provided_required = false; $missing .= "phone_1"; }
		
		if (MUST_AGREE_TO_TOS == '1'&& !$perm->is_registered_customer( $my->id )) { 
		  if( empty( $d['agreed'] ))
			$provided_required = false;
			$missing .= "agreed,";
		}
		
		if (!$provided_required) {
			$url="username=".$d['username'];
			$url.="&email=".$d['email'];
			$url.="&first_name=".$d['first_name'];
			$url.="&last_name=".$d['last_name'];
			$url.="&middle_name=".$d['middle_name'];
			$url.="&title=".$d['title'];
			$url.="&company=".$d['company'];
			$url.="&address_1=".$d['address_1'];
			$url.="&address_2=".$d['address_2'];
			$url.="&city=".$d['city'];
			$url.="&zip=".$d['zip'];
			$url.="&state=".$d['state'];
			$url.="&country=".$d['country'];
			$url.="&phone_1=".$d['phone_1'];
			$url.="&fax=".$d['fax'];
			$url.="&bank_account_nr=".@$d['bank_account_nr'];
			$url.="&bank_sort_code=".@$d['bank_sort_code'];
			$url.="&bank_name=".@$d['bank_name'];
			$url.="&bank_iban=".@$d['bank_iban'];
			$url.="&bank_account_holder=".@$d['bank_account_holder'];
			$url.="&bank_account_type=".@$d['bank_account_type'];
			
			mosRedirect( "index.php?option=com_virtuemart&page=".$_SESSION['last_page']."&missing=$missing&$url", _CONTACT_FORM_NC );
			exit();
		}
		
		$d['user_email'] = $d['email'];
		$d['perms'] = 'shopper';
	
		return $provided_required;
	  }

	/**************************************************************************
	** name: validate_update()
	** created by:
	** description:
	** parameters:
	** returns:
	***************************************************************************/
	function validate_update(&$d) {
		global $my, $perm;
		
		if ($my->id == 0){
		  $d["error"] .= "Please Login first.";
		  return false;
		}
		return $this->validate_add( $d );
		
	}
	
	/**************************************************************************
	** name: validate_delete()
	** created by:
	** description:
	** parameters:
	** returns:
	***************************************************************************/
	function validate_delete(&$d) {
		global $my;		
		 
		if ($my->id == 0){
			$d["error"] .= "Please Login first.";
			return false;
		}
		if (!$d["user_id"]) {
			$d["error"] .= "ERROR:  Please select a user to delete.";
			return False;
		}
		else {
			return True;
		}
	}

  
	/**
	* Function to add a new Shopper into the Shop and Joomla
	*/
	function add( &$d ) {
		global $my, $ps_user, $mainframe, $mosConfig_absolute_path, $VM_LANG, $database, $option;
		
		$ps_vendor_id = $_SESSION["ps_vendor_id"];
		$hash_secret = "VirtueMartIsCool";
		$db = new ps_DB;
		$timestamp = time();
		
		if (!$this->validate_add($d)) {
		  return False;
		}
		
		$iFilter = new vmInputFilter();
		$d = $iFilter->process( $d );
	
		if ($VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_4 and $d["extra_field_4"] == "") {
		  $d["extra_field_4"] = "N";
		}
		if ($VM_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_4 and $d["extra_field_5"] == "") {
		  $d["extra_field_5"] = "N";
		} 
		if( empty( $my->id ) ) {
			// Joomla User Information stuff
			$mainframe->_path->front_html = $mosConfig_absolute_path.'/components/com_registration/registration.html.php';
			$_REQUEST['task'] = $task = 'saveRegistration';
			$_POST['name'] = $d['first_name']." ".$d['last_name'];
			require_once( $mosConfig_absolute_path.'/components/com_registration/registration.php' );
			
			$database->setQuery( "SELECT id FROM #__users ORDER BY registerDate DESC" );
			$database->loadObject( $userid );
			$uid = $userid->id;
		}
		else
			$uid = $my->id;
		
		// Insert billto
		$q = "INSERT INTO #__{vm}_user_info VALUES (";
		$q .= "'" . md5(uniqid( $hash_secret)) . "',";
		$q .= "'" . $uid . "',";
		$q .= "'BT',";
		$q .= "'-default-',";
		$q .= "'" .$d["company"] . "',";
		$q .= "'" .$d["title"] . "',";
		$q .= "'" .$d["last_name"] . "',";
		$q .= "'" .$d["first_name"] . "',";
		$q .= "'" .$d["middle_name"] . "',";
		$q .= "'" .$d["phone_1"] . "',";
		$q .= "'" .@$d["phone_2"] . "',";
		$q .= "'" .$d["fax"] . "',";
		$q .= "'" .$d["address_1"] . "',";
		$q .= "'" .$d["address_2"] . "',";
		$q .= "'" .$d["city"] . "',";
		$q .= "'" .@$d["state"] . "',";
		$q .= "'" .$d["country"] . "',";
		$q .= "'" .$d["zip"] . "',";
		$q .= "'" .$d["email"] . "',";
		$q .= "'" .@$d["extra_field_1"] . "',";
		$q .= "'" .@$d["extra_field_2"] . "',";
		$q .= "'" .@$d["extra_field_3"] . "',";
		$q .= "'" .@$d["extra_field_4"] . "',";
		$q .= "'" .@$d["extra_field_5"] . "',";
		$q .= "'" .$timestamp . "',";
		$q .= "'" .$timestamp . "',";
		$q .= "'shopper', ";
		$q .= "'" . @$d["bank_account_nr"] . "', ";
		$q .= "'" . @$d["bank_name"] . "', ";
		$q .= "'" . @$d["bank_sort_code"] . "', ";
		$q .= "'" . @$d["bank_iban"] . "', ";
		$q .= "'" . @$d["bank_account_holder"] . "', ";
		$q .= "'" . @$d["bank_account_type"] . "') ";
		
		$db->query($q);
		
		
		// Insert vendor relationship
		$q = "INSERT INTO #__{vm}_auth_user_vendor (user_id,vendor_id)";
		$q .= " VALUES ";
		$q .= "('" . $uid . "','";
		$q .= $ps_vendor_id . "') ";
		$db->query($q);
		
		// Insert Shopper -ShopperGroup - Relationship    
		$q =  "SELECT shopper_group_id from #__{vm}_shopper_group WHERE ";
		$q .= "`default`='1' ";
   
		$db->query($q);
		if (!$db->num_rows()) {  // take the first in the table
   
			$q =  "SELECT shopper_group_id from #__{vm}_shopper_group";
			$db->query($q);
		}
		$db->next_record();
		$d['shopper_group_id'] = $db->f("shopper_group_id");

		$customer_nr = uniqid( rand() );
		
		$q  = "INSERT INTO #__{vm}_shopper_vendor_xref ";
		$q .= "(user_id,vendor_id,shopper_group_id,customer_number) ";
		$q .= "VALUES ('$uid', '$ps_vendor_id','".$d['shopper_group_id']."', '$customer_nr')";
		$db->query($q);

		$mainframe->login($d['username'], md5( $d['password'] ));
		
		mosRedirect( "index.php?option=$option&page=checkout.index" );
		return True;
    
	}
  
	/**
	* Function to update a Shopper Entry
	* (uses who have perms='shopper')
	*/
	function update(&$d) {
		global $my, $perm, $sess;
		
		$auth = $_SESSION['auth'];
			
		$db = new ps_DB;
		
		$iFilter = new vmInputFilter();
		$d = $iFilter->process( $d );
	
		if ($d["user_id"] != $auth["user_id"] && $auth["perms"] != "admin") {
		  $d["error"] = "Tricky tricky, but we know about this one.";
		  return False;
		}
		
		require_once(CLASSPATH. 'ps_user.php' );
		$_POST['name'] = $d['first_name']." ". $d['last_name'];
		$_POST['id'] = $auth["user_id"];
		$_POST['gid'] = 18;
		ps_user::saveUser();
		
		if (!$this->validate_update($d)) {
			$_SESSION['last_page'] = "checkout.index";
			return false;
		}
		$user_id = $auth["user_id"];
		
		/* Update Bill To */
		$q  = "UPDATE #__{vm}_user_info SET ";
		if (!empty($d['company']))
			$q .= "company='" . $d["company"] . "', ";
		$q .= "title='" . $d["title"] . "', ";
		$q .= "last_name='" . $d["last_name"] . "', ";
		$q .= "first_name='" . $d["first_name"] . "', ";
		if (!empty($d['middle_name']))
			$q .= "middle_name='" . $d["middle_name"] . "', ";
		$q .= "phone_1='" . $d["phone_1"] . "', ";
		if (!empty($d['phone_2']))
			$q .= "phone_2='" . $d["phone_2"] . "',";
		if (!empty($d['fax']))
			$q .= "fax='" . $d["fax"] . "', ";
		$q .= 	"address_1='" . $d["address_1"] . "', ";
		$q .= "address_2='" . @$d["address_2"] . "', ";
		$q .= "city='" . $d["city"] . "', ";
		if (!empty($d['state']))
			$q .= "state='" . $d["state"] . "', ";
		$q .= "country='" . $d["country"] . "', ";
		$q .= "zip='" . $d["zip"] . "', ";
		$q .= "extra_field_1='" . @$d["extra_field_1"] . "', ";
		$q .= "extra_field_2='" . @$d["extra_field_2"] . "', ";
		$q .= "extra_field_3='" . @$d["extra_field_3"] . "', ";
		$q .= "extra_field_4='" . @$d["extra_field_4"] . "', ";
		$q .= "extra_field_5='" . @$d["extra_field_5"] . "' ";
		if (!empty($d['bank_iban']))
			$q .= ",bank_iban='" . $d["bank_iban"] . "' ";
		if (!empty($d['bank_account_nr']))
			$q .= ",bank_account_nr='" . $d["bank_account_nr"] . "' ";
		if (!empty($d['bank_sort_code']))
			$q .= ",bank_sort_code='" . $d["bank_sort_code"] . "' ";
		if (!empty($d['bank_name']))
			$q .= ",bank_name='" . $d["bank_name"] . "'";
		if (!empty($d['bank_account_holder']))
			$q .= ", bank_account_holder='" . $d["bank_account_holder"] . "' ";
		if (mShop_validateEmail(@$d['email']))
			$q .= ",user_email = '".@$d['email']."' ";
		$q .= "WHERE user_id='" . $user_id . "' AND address_type='BT'";
	  
		$db->query($q);
	  
		// UPDATE #__{vm}_shopper group relationship
		$q = "SELECT shopper_group_id FROM #__{vm}_shopper_vendor_xref ";
		$q .= "WHERE user_id = '".$user_id."'";
		$db->query($q);
		
		if (!$db->num_rows()) {
			//add
			
			$shopper_db = new ps_DB;
			// get the default shopper group
			$q =  "SELECT shopper_group_id from #__{vm}_shopper_group WHERE ";
			$q .= "`default`='1'";
			$shopper_db->query($q);
			if (!$shopper_db->num_rows()) {  // when there is no "default", take the first in the table 
				$q =  "SELECT shopper_group_id from #__{vm}_shopper_group";
				$shopper_db->query($q);
			}
			
			$shopper_db->next_record();
			$my_shopper_group_id = $shopper_db->f("shopper_group_id");
			if (empty($d['customer_number'])) 
				$d['customer_number'] = "";
			
			$q  = "INSERT INTO #__{vm}_shopper_vendor_xref ";
			$q .= "(user_id,vendor_id,shopper_group_id) ";
			$q .= "VALUES ('";
			$q .= $_SESSION['auth']['user_id'] . "','";
			$q .= $_SESSION['ps_vendor_id'] . "','";
			$q .= $my_shopper_group_id. "')";
			$db->query($q);
		}
		$q = "SELECT user_id FROM #__{vm}_auth_user_vendor ";
		$q .= "WHERE user_id = '".$_SESSION['auth']['user_id']."'";
		$db->query($q);
		if (!$db->num_rows()) {
			// Insert vendor relationship
			$q = "INSERT INTO #__{vm}_auth_user_vendor (user_id,vendor_id)";
			$q .= " VALUES ";
			$q .= "('" . $_SESSION['auth']['user_id'] . "','";
			$q .= $_SESSION['ps_vendor_id'] . "') ";
			$db->query($q);
		}
		
		return True;
	}
  
	/**
	* Function to delete a Shopper
	*/
	function delete(&$d) {
		global $my;
	  
		$db = new ps_DB;
		
		if (!$this->validate_delete($d)) {
			return False;
		}
	
		// Delete user_info entries
		// and Shipping addresses
		$q = "DELETE FROM #__{vm}_user_info where user_id='" . $d["user_id"] . "'"; 
		$db->query($q);
		
		// Delete shopper_vendor_xref entries
		$q = "DELETE FROM #__{vm}_shopper_vendor_xref where user_id='" . $d["user_id"] . "'"; 
		$db->query($q);
		
		$q = "DELETE FROM #__{vm}_auth_user_vendor where user_id='" . $d["user_id"] . "'"; 
		$db->query($q);
		return True;
	}
}
$ps_shopper = new ps_shopper;
?>
