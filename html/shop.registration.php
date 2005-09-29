<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
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

function saveRegistration( $option ) {
	global $database, $my, $acl, $mainframe, $vars, $sess,
		$mosConfig_sitename, $mosConfig_live_site, $mosConfig_useractivation, $mosConfig_allowUserRegistration,
		$mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mailfrom, $mosConfig_fromname;

	if ($mosConfig_allowUserRegistration=="0") {
		mosNotAuth();
		return;
	}

	$row = new mosUser( $database );

	if (!$row->bind( $_POST, "usertype" )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	mosMakeHtmlSafe($row);
	
	$aro_id = "aro_id";
	$group_id = "group_id";
	if( isset( $_VERSION ))
	  if( $_VERSION->RELEASE == "4.5" && $_VERSION->DEV_LEVEL >= "3" ) {
		$aro_id = "id";
		$group_id = "id";
	  }
	  
	$row->id = 0;
	$row->gid = $acl->get_group_id('Registered','ARO');

	// save usertype to usetype column
	$query = "SELECT name"
	. "\n FROM #__core_acl_aro_groups"
	. "\n WHERE $group_id = $row->gid";
	
	$database->setQuery( $query );
	$usertype = $database->loadResult();
	$row->usertype = $usertype;
	
	if ($mosConfig_useractivation=="1") {
		$row->activation = md5( mosMakePassword() );
		$row->block = "1";
	}
	
	//////////////////////////////
	// PHPSHOP MODIFICATION
	$provided_required = true;
	$missing = "";
	
	if( empty( $my->id )) {
	  if (empty($_POST['username'])) { $provided_required = false; $missing .= "username,"; }
	  if (empty($_POST['password'])) { $provided_required = false; $missing .= "password,"; }
	  if (empty($_POST['password2'])) { $provided_required = false; $missing .= "password2,"; }
	  if (empty($_POST['email'])) { $provided_required = false; $missing .= "email,"; }
	}
	
	if (empty($_POST['first_name'])) { $provided_required = false; $missing .= "first_name,"; }
	if (empty($_POST['last_name']))  { $provided_required = false; $missing .= "last_name,"; }
	//if (empty($_POST['company']))  { $provided_required = false; $missing .= "company,"; }
	if (empty($_POST['address_1']))  { $provided_required = false; $missing .= "address_1,"; }
	if (empty($_POST['city']))  { $provided_required = false; $missing .= "city,"; }
	if (empty($_POST['zip'])) { $provided_required = false; $missing .= "zip,"; }
	if (CAN_SELECT_STATES == '1') {
		if (empty($_POST['state'])) { $provided_required = false; $missing .= "state,"; }
	}
	if (empty($_POST['country'])) { $provided_required = false; $missing .= "country,"; }
	//if (empty($_POST['phone_1'])) { $provided_required = false; $missing .= "phone_1"; }
	
	if (MUST_AGREE_TO_TOS == '1') { 
	  if( empty( $_POST['agreed'] ))
		$provided_required = false;
		$missing .= "agreed,";
	}
	
	if (!$provided_required) {
			$url="username=".$_POST['username'];
			$url.="&email=".$_POST['email'];
			$url.="&first_name=".$_POST['first_name'];
			$url.="&last_name=".$_POST['last_name'];
			$url.="&middle_name=".$_POST['middle_name'];
			$url.="&title=".$_POST['title'];
			$url.="&company=".$_POST['company'];
			$url.="&address_1=".$_POST['address_1'];
			$url.="&address_2=".$_POST['address_2'];
			$url.="&city=".$_POST['city'];
			$url.="&zip=".$_POST['zip'];
			$url.="&state=".$_POST['state'];
			$url.="&country=".$_POST['country'];
			$url.="&phone_1=".$_POST['phone_1'];
			$url.="&fax=".$_POST['fax'];
			$url.="&bank_account_nr=".@$_POST['bank_account_nr'];
			$url.="&bank_sort_code=".@$_POST['bank_sort_code'];
			$url.="&bank_name=".@$_POST['bank_name'];
			$url.="&bank_iban=".@$_POST['bank_iban'];
			$url.="&bank_account_holder=".@$_POST['bank_account_holder'];
			$url.="&bank_account_type=".@$_POST['bank_account_type'];
			
			mosRedirect("index.php?option=com_virtuemart&page=checkout.index&missing=$missing&$url",_CONTACT_FORM_NC);
			exit();
	}
	
	$row->name = $_POST['first_name'] ." ". $_POST['last_name'];
	// thanks to Erich for fixing this with "a"
	$row->user_info_id = "a" . md5 (uniqid (rand())); 
	$row->address_type = 'BT';
	$row->first_name = $_POST['first_name'];
	$row->last_name = $_POST['last_name'];
	$row->middle_name = $_POST['middle_name'];
	$row->title = $_POST['title'];
	$row->address_type_name = '-default-';
	$row->company = $_POST['company'];
	$row->address_1 = $_POST['address_1'];
	$row->address_2 = $_POST['address_2'];
	$row->city = $_POST['city'];
	$row->zip = $_POST['zip'];
	$row->state = @$_POST['state'];
	$row->country = $_POST['country'];
	$row->phone_1 = @$_POST['phone_1'];
	$row->fax = @$_POST['fax'];
	$row->bank_account_nr = @$_POST['bank_account_nr'];
	$row->bank_sort_code = @$_POST['bank_sort_code'];
	$row->bank_name = @$_POST['bank_name'];
	$row->bank_iban = @$_POST['bank_iban'];
	$row->bank_account_holder = @$_POST['bank_account_holder'];
	$row->bank_account_type = @$_POST['bank_account_type'];
	
	//
	// PHPSHOP MODIFICATION
	//////////////////////////////
			
	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$pwd = $row->password;
	$row->password = md5( $row->password );
	$row->registerDate = date("Y-m-d H:i:s");

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	////////////////////////////////////////////////////
	// BEGIN PHPSHOP MODIFICATION
	//
	// Shoppers must have a
	// * shopper-vendor entry
	// and a
	// *auth_user_vendor entry
	// otherwise they are not assigned to any user group
	// and get into real trouble (no payment methods, products....)!!
	
	// get the user id
	$database->setQuery( "SELECT id FROM #__users"
	."\n WHERE username='".$row->username."' AND email='".$row->email."'" );
	$database->loadObject( $my_id );
	$my_user_id = $my_id->id;
	
	
	// insert shopper-vendor-xref
	$my_q =  "SELECT shopper_group_id from #__{vm}_shopper_group WHERE ";
	$my_q .= "`default`='1'";
	   
	$database->setQuery($my_q);
	$database->loadObject( $res );
	$my_shopper_id = $res->shopper_group_id;
	
	$q2  = "INSERT INTO #__{vm}_shopper_vendor_xref ";
	$q2 .= "(user_id,vendor_id,shopper_group_id,customer_number) ";
	$q2 .= "VALUES ('";
	$q2 .= $my_user_id . "','";
	$q2 .= $_SESSION['ps_vendor_id'] . "','";
	$q2 .= $my_shopper_id . "','";
	$q2 .= @$vars["customer_number"] . "')";
	$database->setQuery($q2);
	$database->query();
	
	// Insert vendor relationship
	$q3 = "INSERT INTO #__{vm}_auth_user_vendor (user_id,vendor_id)";
	$q3 .= " VALUES ";
	$q3 .= "('" . $my_user_id . "','";
	$q3 .= $_SESSION['ps_vendor_id'] . "') ";
	$database->setQuery($q3);
	$database->query();
	//
	// END PHPSHOP MODIFICATION
	////////////////////////////////////////////////////


	$row->checkin();

	$name = $row->name;
	$email = $row->email;
	$username = $row->username;

	$subject = sprintf (_SEND_SUB, $row->name, $mosConfig_sitename);
	if ($mosConfig_useractivation=="1"){
		$message = sprintf (_USEND_MSG_ACTIVATE, $row->name, $mosConfig_sitename, $mosConfig_live_site."/index.php?option=com_registration&task=activate&activation=".$row->activation, $mosConfig_live_site, $username, $pwd);
	} else {
		$message = sprintf (_USEND_MSG, $row->name, $mosConfig_sitename, $mosConfig_live_site);
	}

	// Send email to user
	if ($mosConfig_mailfrom != "" && $mosConfig_fromname != "") {
		$adminName2 = $mosConfig_fromname;
		$adminEmail2 = $mosConfig_mailfrom;
	} else {
		$database->setQuery( "SELECT name, email FROM #__users"
		."\n WHERE usertype='superadministrator'" );
		$rows = $database->loadObjectList();
		$row2 = $rows[0];
		$adminName2 = $row2->name;
		$adminEmail2 = $row2->email;
	}

	mosMail($adminEmail2, $adminName2, $email, $subject, $message);

	// Send notification to all administrators
	$subject2 = sprintf (_SEND_SUB, $name, $mosConfig_sitename);
	$message2 = sprintf (_ASEND_MSG, $adminName2, $mosConfig_sitename, $row->name, $email, $username);

	// get superadministrators id
	$admins = $acl->get_group_objects( 25, 'ARO' );

	foreach ( $admins['users'] AS $id ) {
		$database->setQuery( "SELECT email, sendEmail FROM #__users"
			."\n WHERE id='$id'" );
		$rows = $database->loadObjectList();

		$row = $rows[0];

		if ($row->sendEmail) {
			mosMail($adminEmail2, $adminName2, $row->email, $subject2, $message2);
		}
	}

	if ( $mosConfig_useractivation == "1" ){
		echo _REG_COMPLETE_ACTIVATE;
	} else {
		$mainframe->login($username, md5( $pwd ));
		mosRedirect($sess->url(SECUREURL."index.php?option=com_virtuemart&page=checkout.index&Itemid=".@$_REQUEST['Itemid']), _REG_COMPLETE);
	}
            
	
}
    
    function is_email($email){
            $rBool=false;
    
            if(preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $email)){
                    $rBool=true;
            }
            return $rBool;
    }
    
    
if (@$_POST['is_it_safe'] == 'yep') {

    $task = mosGetParam( $_REQUEST, 'task', "" );
    
    
    switch( $task ) {
    
            case "saveRegistration":
            saveRegistration( $option );
            break;
    }
}
else
  include( PAGEPATH . "checkout_register_form.php" );
?>
