<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: ps_shopper.php,v 1.12 2005/11/12 08:32:08 soeren_nb Exp $
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

		require_once( CLASSPATH . 'ps_userfield.php' );
		$requiredFields = ps_userfield::getUserFields( 'registration', true );

		if( VM_SILENT_REGISTRATION == '1') {
			$skipFields = array( 'username', 'password', 'password2');
		}
		if( $my->id ) {
			$skipFields[] = 'email';
		}
		foreach( $requiredFields as $field )  {
			if( in_array( $field->name, $skipFields )) {
				continue;
			}
			if( empty( $d[$field->name])) {
				$provided_required = false;
				$missing .= $field->name . ",";
			}
		}

		if (!$provided_required) {
			$_REQUEST['missing'] = $missing;
			return false;
		}

		$d['user_email'] = @$d['email'];
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
		global $my, $perm, $vmLogger;

		if ($my->id == 0){
			$vmLogger->err( "Please Login first." );

			return false;
		}
		$db = new ps_DB;

		$provided_required = true;
		$missing = "";

		require_once( CLASSPATH . 'ps_userfield.php' );
		$requiredFields = ps_userfield::getUserFields( 'account', true );

		if( VM_SILENT_REGISTRATION == '1') {
			$skipFields = array( 'username', 'password', 'password2');
		}
		if( $my->id ) {
			$skipFields[] = 'email';
		}
		foreach( $requiredFields as $field )  {
			if( in_array( $field->name, $skipFields )) {
				continue;
			}
			if( empty( $d[$field->name])) {
				$provided_required = false;
				$missing .= $field->name . ",";
			}
		}

		if (!$provided_required) {
			$_REQUEST['missing'] = $missing;
			return false;
		}

		$d['user_email'] = @$d['email'];
		$d['perms'] = 'shopper';

		return $provided_required;

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
			$vmLogger->err( "Please Login first." );
			return false;
		}
		if (!$d["user_id"]) {
			$vmLogger->err( "Please select a user to delete." );
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
		global $my, $ps_user, $mainframe, $mosConfig_absolute_path,
		$VM_LANG, $vmLogger, $database, $option, $mosConfig_useractivation;

		$ps_vendor_id = $_SESSION["ps_vendor_id"];
		$hash_secret = "VirtueMartIsCool";
		$db = new ps_DB;
		$timestamp = time();

		if (!$this->validate_add($d)) {
			return False;
		}
		// Use InputFilter class to prevent SQL injection or HTML tags
		$d = $GLOBALS['vmInputFilter']->safeSQL( $d );

		if( empty( $my->id ) ) {

			$_POST['name'] = $d['first_name']." ".$d['last_name'];
			if( VM_SILENT_REGISTRATION == '1' ) {
				$silent_username = substr( str_replace( '-', '_', $d['email'] ), 0, 25 );
				$db->query( 'SELECT username FROM `#__users` WHERE username=\''.$silent_username.'\'');
				$i = 0;
				while( $db->next_record()) {
					$silent_username = substr_replace( $silent_username, $i, strlen($silent_username)-1 );
					$db->query( 'SELECT username FROM `#__users` WHERE username=\''.$silent_username.'\'');
					$i++;
				}
				$_POST['username'] = $d['username'] = $silent_username;
				$_POST['password'] = $d['password'] = mosMakePassword();
				$_POST['password2'] = $_POST['password'];
			}
			// Process Mambo/Joomla registration stuff
			if( !$this->saveRegistration() ) {
				return false;
			}

			$database->setQuery( "SELECT id FROM #__users WHERE username='".$d['username']."'" );
			$database->loadObject( $userid );
			$uid = $userid->id;
		}
		else {
			$uid = $my->id;
			$d['email'] = $_POST['email'] = $my->email;

		}
		$db->query( 'SELECT user_id FROM #__{vm}_user_info WHERE user_id='.$my->id );
		$db->next_record();

		if( $db->f('user_id')) {
			return $this->update( $d );
		}
		// Get all fields which where shown to the user
		$userFields = ps_userfield::getUserFields('registration', false, '', true );
		$skipFields = ps_userfield::getSkipFields();
		
		// Insert billto;

		// Building the query: PART ONE
		// The first 7 fields are FIX and not built dynamically
		$q = "INSERT INTO #__{vm}_user_info (`user_info_id`, `user_id`, `address_type`, `address_type_name`, `cdate`, `mdate`, `perms`, ";
		$fields = array();
		
		foreach( $userFields as $userField ) {
			if( !in_array($userField->name, $skipFields )) {
				
				$fields[] = "`".$userField->name."`";
				
				// Catch a newsletter registration!
				if( stristr( $userField->params, 'newsletter' )) {
					if( !empty($d[$userField->name])) {
						$subscribeTo = new mosParameters( $userField->params );
					}
				}
				
			}
		}
		$q .= str_replace( '`email`', '`user_email`', implode( ',', $fields ));

		// Building the query: PART TWO, listing all values
		$q .= ") VALUES (\n";
		$q .= "'" . md5(uniqid( $hash_secret)) . "',";
		$q .= "'" . $uid . "',";
		$q .= "'BT',";
		$q .= "'-default-',";
		$q .= "'" .$timestamp . "',";
		$q .= "'" .$timestamp . "',";
		$q .= "'shopper', ";

		$values = array();
		foreach( $userFields as $userField ) {
			if( !in_array($userField->name, $skipFields )) {
				$d[$userField->name] = ps_userfield::prepareFieldDataSave( $userField->type, $userField->name, @$d[$userField->name]);
				$values[] = "'".$d[$userField->name]."'";
			}
		}
		$q .= implode( ',', $values );
		$q .= ") ";

		// Run the query now!
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
		
		// Process the NEwsletter subscription
		if( !empty( $subscribeTo ) && get_class($subscribeTo)=='mosparameters') {
			switch( $subscribeTo->get('newsletter', 'letterman')) {
				// TODO:
				// case 'yanc':
				// case 'anjel':
				case 'letterman':
				default:
					if( file_exists($mosConfig_absolute_path.'/components/com_letterman/letterman.php')) {
						$db->query( "INSERT INTO `#__letterman_subscribers` (`user_id`, `subscriber_name`, `subscriber_email`, `confirmed`, `subscribe_date`)
										VALUES('$uid','".$d['first_name']." ". $d['last_name']."','".$d['email']."', '1', NOW())");
					}

			}
		}
		
		if( !$my->id && $mosConfig_useractivation == '0') {
			$mainframe->login($d['username'], md5( $d['password'] ));
			mosRedirect( "index.php?option=$option&page=checkout.index" );
		}
		elseif( $my->id ) {
			mosRedirect( "index.php?option=$option&page=checkout.index" );
		}
		else {
			mosRedirect( "index.php?option=$option&page=shop.index", _REG_COMPLETE_ACTIVATE );
		}

		return true;

	}

	/**
	 * The function from com_registration!
	 * Registers a user into Mambo/Joomla
	 *
	 * @return boolean True when the registration process was successful, False when not
	 */
	function saveRegistration() {
		global $database, $acl, $VM_LANG, $vmLogger;
		global $mosConfig_sitename, $mosConfig_live_site, $mosConfig_useractivation, $mosConfig_allowUserRegistration;
		global $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mailfrom, $mosConfig_fromname;

		if ($mosConfig_allowUserRegistration=='0') {
			mosNotAuth();
			return false;
		}

		$row = new mosUser( $database );

		if (!$row->bind( $_POST, 'usertype' )) {
			$error = vmHtmlEntityDecode( $row->getError() );
			$vmLogger->err( $error );
			echo "<script type=\"text/javascript\"> alert('". $error. "');</script>\n";
			return false;
		}

		mosMakeHtmlSafe($row);

		$usergroup = 'Registered';
		$row->id = 0;
		$row->usertype = $usergroup;
		$row->gid = $acl->get_group_id( $usergroup, 'ARO' );

		if ($mosConfig_useractivation == '1') {
			$row->activation = md5( mosMakePassword() );
			$row->block = '1';
		}

		if (!$row->check()) {
			$error = vmHtmlEntityDecode( $row->getError() );
			$vmLogger->err( $error );
			echo "<script type=\"text/javascript\"> alert('". $error. "');</script>\n";
			return false;
		}

		$pwd 				= $row->password;
		$row->password 		= md5( $row->password );
		$row->registerDate 	= date('Y-m-d H:i:s');

		if (!$row->store()) {
			$error = vmHtmlEntityDecode( $row->getError() );
			$vmLogger->err( $error );
			echo "<script type=\"text/javascript\"> alert('". $error. "');</script>\n";
			return false;
		}
		$row->checkin();

		$name 		= $row->name;
		$email 		= $row->email;
		$username 	= $row->username;

		$subject 	= sprintf (_SEND_SUB, $name, $mosConfig_sitename);
		$subject 	= vmHtmlEntityDecode($subject, ENT_QUOTES);
		if ($mosConfig_useractivation=="1"){
			$message = sprintf (_USEND_MSG_ACTIVATE, $name, $mosConfig_sitename, $mosConfig_live_site."/index.php?option=com_registration&task=activate&activation=".$row->activation, $mosConfig_live_site, $username, $pwd);
		} else {
			$message = sprintf ($VM_LANG->_PHPSHOP_USER_SEND_REGISTRATION_DETAILS, $name, $mosConfig_sitename, $mosConfig_live_site, $username, $pwd);
		}

		$message = vmHtmlEntityDecode($message, ENT_QUOTES);
		// Send email to user
		if ($mosConfig_mailfrom != "" && $mosConfig_fromname != "") {
			$adminName2 = $mosConfig_fromname;
			$adminEmail2 = $mosConfig_mailfrom;
		} else {
			$query = "SELECT name, email"
			. "\n FROM #__users"
			. "\n WHERE LOWER( usertype ) = 'superadministrator'"
			. "\n OR LOWER( usertype ) = 'super administrator'"
			;
			$database->setQuery( $query );
			$rows = $database->loadObjectList();
			$row2 			= $rows[0];
			$adminName2 	= $row2->name;
			$adminEmail2 	= $row2->email;
		}

		mosMail($adminEmail2, $adminName2, $email, $subject, $message);

		// Send notification to all administrators
		$subject2 = sprintf (_SEND_SUB, $name, $mosConfig_sitename);
		$message2 = sprintf (_ASEND_MSG, $adminName2, $mosConfig_sitename, $row->name, $email, $username);
		$subject2 = vmHtmlEntityDecode($subject2, ENT_QUOTES);
		$message2 = vmHtmlEntityDecode($message2, ENT_QUOTES);

		// get superadministrators id
		$admins = $acl->get_group_objects( 25, 'ARO' );

		foreach ( $admins['users'] AS $id ) {
			$query = "SELECT email, sendEmail"
			. "\n FROM #__users"
			."\n WHERE id = $id"
			;
			$database->setQuery( $query );
			$rows = $database->loadObjectList();

			$row = $rows[0];

			if ($row->sendEmail) {
				mosMail($adminEmail2, $adminName2, $row->email, $subject2, $message2);
			}
		}

		if ( $mosConfig_useractivation == 1 ){
			echo _REG_COMPLETE_ACTIVATE;
		} else {
			echo _REG_COMPLETE;
		}
		return true;
	}


	/**
	* Function to update a Shopper Entry
	* (uses who have perms='shopper')
	*/
	function update(&$d) {
		global $my, $perm, $sess, $vmLogger;

		$auth = $_SESSION['auth'];

		$db = new ps_DB;

		$d = $GLOBALS['vmInputFilter']->safeSQL( $d );

		if (@$d["user_id"] != $my->id && $auth["perms"] != "admin") {
			$vmLogger->crit( "Tricky tricky, but we know about this one." );
			return False;
		}

		require_once(CLASSPATH. 'ps_user.php' );
		if( !empty($d['username'])) {
			$_POST['username'] = $d['username'];
		}
		else {
			$_POST['username'] = $my->username;
		}
		$_POST['name'] = $d['first_name']." ". $d['last_name'];
		$_POST['id'] = $auth["user_id"];
		$_POST['gid'] = $my->gid;
		$d['error'] = "";

		ps_user::saveUser( $d );
		if( !empty( $d['error']) ) {

			return false;
		}

		if (!$this->validate_update($d)) {
			$_SESSION['last_page'] = "checkout.index";
			return false;
		}
		$user_id = $auth["user_id"];

		/* Update Bill To */

		// Get all fields which where shown to the user
		$userFields = ps_userfield::getUserFields( 'account', false, '', true );

		// Insert billto;

		// Building the query: PART ONE
		// The first 7 fields are FIX and not built dynamically
		$q = "UPDATE #__{vm}_user_info SET
                                `mdate` = '".time()."', ";
		$fields = array();
		$skip_fields = ps_userfield::getSkipFields();
		foreach( $userFields as $userField ) {
			if( !in_array($userField->name,$skip_fields)) {
				$d[$userField->name] = ps_userfield::prepareFieldDataSave( $userField->type, $userField->name, @$d[$userField->name]);
				$fields[] = "`".$userField->name."`='".$d[$userField->name]."'";
			}
		}
		$q .= str_replace( '`email`', '`user_email`', implode( ',', $fields ));

		$q .= " WHERE user_id=".$user_id." AND address_type='BT'";

		// Run the query!
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
