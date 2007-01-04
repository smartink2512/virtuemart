<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
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

class ps_user {
	var $classname = "ps_user";

	/**************************************************************************
	** name: validate_add()
	** created by:
	** description:
	** parameters:
	** returns:
	***************************************************************************/
	function validate_add(&$d) {
		global $my, $perm, $vmLogger;

		$db = new ps_DB;

		$valid = true;
		$missing = "";

		require_once( CLASSPATH . 'ps_userfield.php' );
		$requiredFields = ps_userfield::getUserFields( 'registration', true );

		$skipFields = array( 'username', 'password', 'password2', 'email', 'agreed');

		foreach( $requiredFields as $field )  {
			if( in_array( $field->name, $skipFields )) {
				continue;
			}
			if( empty( $d[$field->name])) {
				$valid = false;
				$vmLogger->err( 'Missing value for field "'.$field->name .'".' );
			}
		}

		$d['user_email'] = @$d['email'];

		if (!$d['perms']) {
			$vmLogger->warning( 'You must assign the user to a group.' );
			$valid = false;
		}
		else {
			if( !$perm->hasHigherPerms( $d['perms'] )) {
				$vmLogger->err( 'You have no permission to add a user of that usertype: '.$d['perms'] );
				$valid = false;
			}

		}
		return $valid;
	}

	/**************************************************************************
	** name: validate_update()
	** created by:
	** description:
	** parameters:
	** returns:
	***************************************************************************/
	function validate_update(&$d) {
		return $this->validate_add( $d );
	}

	/**************************************************************************
	** name: validate_delete()
	** created by:
	** description:
	** parameters:
	** returns:
	***************************************************************************/
	function validate_delete( $id ) {
		global $my, $vmLogger, $perm;
		$auth = $_SESSION['auth'];
		$valid = true;

		if( empty($id)) {
			$vmLogger->err( 'Please select a user to delete.' );
			return false;
		}
		$db = new ps_DB();
		$q = "SELECT user_id, perms FROM #__{vm}_user_info WHERE user_id=$id";
		$db->query( $q );
		$perms = $db->f('perms');
		if( !$perm->hasHigherPerms( $perms ) ) {
			$vmLogger->err( 'You have no permission to delete a user of that usertype: '.$perms );
			$valid = false;
		}
		if( $id == $my->id) {
			$vmLogger->err( 'Very funny, but you cannot delete yourself.' );
			$valid = false;
		}
		$valid = $valid;
	}

	/**************************************************************************
	* name: add()
	* created by:
	* description:
	* parameters:
	* returns:
	**************************************************************************/
	function add(&$d) {
		global $my, $VM_LANG, $perm, $vmLogger;
		$ps_vendor_id = $_SESSION["ps_vendor_id"];
		$hash_secret = "VirtueMartIsCool";
		$db = new ps_DB;
		$timestamp = time();

		if (!$this->validate_add($d)) {
			return False;
		}

		// Joomla User Information stuff
		$uid = $this->saveUser( $d );
		if( empty( $uid ) && empty( $d['id'] ) ) {
			$vmLogger->err( 'New User couldn\'t be added' );
			return false;
		}
		elseif( !empty( $d['id'])) {
			$uid = $d['id'];
		}
		
		// Get all fields which where shown to the user
		$userFields = ps_userfield::getUserFields('registration', false, '', true);
		$skipFields = ps_userfield::getSkipFields();
		
		// Insert billto;
		$fields = array();
		
		$fields['user_info_id'] = md5(uniqid( $hash_secret));
		$fields['user_id'] =  $uid;
		$fields['address_type'] =  'BT';
		$fields['address_type_name'] =  '-default-';
		$fields['cdate'] =  $timestamp;
		$fields['mdate'] =  $timestamp;
		$fields['perms'] =  $d['perms'];

		$values = array();
		foreach( $userFields as $userField ) {
			if( !in_array($userField->name, $skipFields )) {
				$fields[$userField->name] = ps_userfield::prepareFieldDataSave( $userField->type, $userField->name, @$d[$userField->name]);
			}
		}
		
		$fields['user_email'] = $fields['email'];
		unset($fields['email']);
		
		$db->buildQuery( 'INSERT', '#__{vm}_user_info', $fields );
		$db->query();
		
		if( $perm->check("admin")) {
			$vendor_id = $d['vendor_id'];
		}
		else {
			$vendor_id = $ps_vendor_id;
		}

		// Insert vendor relationship
		$q = "INSERT INTO #__{vm}_auth_user_vendor (user_id,vendor_id)";
		$q .= " VALUES ";
		$q .= "('" . $uid . "','$vendor_id') ";
		$db->query($q);

		// Insert Shopper -ShopperGroup - Relationship
		$q  = "INSERT INTO #__{vm}_shopper_vendor_xref ";
		$q .= "(user_id,vendor_id,shopper_group_id,customer_number) ";
		$q .= "VALUES ('$uid', '$vendor_id','".$d['shopper_group_id']."', '".$d['customer_number']."')";
		$db->query($q);
		
		$_REQUEST['id'] = $_REQUEST['user_id'] = $uid;
		
		return True;

	}

	/**************************************************************************
	* name: update()
	* created by:
	* description:
	* parameters:
	* returns:
	**************************************************************************/
	function update(&$d) {
		global $my, $VM_LANG, $perm;
		$ps_vendor_id = $_SESSION["ps_vendor_id"];
		$db = new ps_DB;
		$timestamp = time();

		if (!$this->validate_update($d)) {
			return False;
		}

		// Joomla User Information stuff
		$this->saveUser( $d );

		/* Update Bill To */

		// Get all fields which where shown to the user
		$userFields = ps_userfield::getUserFields('registration', false, '', true);

		$user_id = intval( $d['id'] );

		// Building the query: PART ONE
		// The first 7 fields are FIX and not built dynamically
		$db->query( "SELECT COUNT(user_info_id) AS num_rows FROM #__{vm}_user_info WHERE user_id='" . $user_id . "'" );
		if( $db->f('num_rows') < 1 ) {
			// The user is registered in Joomla, but not in VirtueMart; so, insert the bill to information
			return $this->add(&$d);
		}
		else {
			$q = "UPDATE #__{vm}_user_info SET
	                                `mdate` = '".time()."',
	                                `perms` = '".$d['perms']."', ";
			$fields = array();
			$skip_fields = ps_userfield::getSkipFields();
			foreach( $userFields as $userField ) {
				if( !in_array($userField->name,$skip_fields)) {
					$d[$userField->name] = ps_userfield::prepareFieldDataSave( $userField->type, $userField->name, @$d[$userField->name]);
					$fields[] = "`".$userField->name."`='".$d[$userField->name]."'";
				}
			}
			$q .= str_replace( '`email`', '`user_email`', implode( ",\n", $fields ));
	
			$q .= " WHERE user_id=".$user_id." AND address_type='BT'";
	
			// Run the query now!
			$db->query($q);
		}

		if( $perm->check("admin")) {
			$vendor_id = $d['vendor_id'];
		}
		else {
			$vendor_id = $ps_vendor_id;
		}

		$db->query( "SELECT COUNT(user_id) FROM #__{vm}_auth_user_vendor WHERE vendor_id='".$vendor_id."' AND user_id='" . $d["user_id"] . "'" );
		if( $db->num_rows() < 1 ) {
			// Insert vendor relationship
			$q = "INSERT INTO #__{vm}_auth_user_vendor (user_id,vendor_id)";
			$q .= " VALUES ";
			$q .= "('" . $d['user_id'] . "','$vendor_id') ";
			$db->query($q);
		}
		else {
			// Update the User- Vendor  relationship
			$q = "UPDATE #__{vm}_auth_user_vendor set ";
			$q .= "vendor_id='".$d['vendor_id']."' ";
			$q .= "WHERE user_id='" . $d["user_id"] . "'";
			$db->query($q);
		}
		$db->query( "SELECT COUNT(user_id) FROM #__{vm}_shopper_vendor_xref WHERE vendor_id='".$vendor_id."' AND user_id='" . $d["user_id"] . "'" );
		if( $db->num_rows() < 1 ) {
			// Insert Shopper -ShopperGroup - Relationship
			$q  = "INSERT INTO #__{vm}_shopper_vendor_xref ";
			$q .= "(user_id,vendor_id,shopper_group_id,customer_number) ";
			$q .= "VALUES ('".$d['user_id']."', '$vendor_id','".$d['shopper_group_id']."', '".$d['customer_number']."')";
		}
		else {
			// Update the Shopper Group Entry for this user
			$q = "UPDATE #__{vm}_shopper_vendor_xref SET ";
			$q .= "shopper_group_id='".$d['shopper_group_id']."' ";
			$q.= ",vendor_id ='".$vendor_id."' ";
			$q .= "WHERE user_id='" . $d["user_id"] . "' ";
		}
		$db->query($q);

		return True;
	}

	/**************************************************************************
	* name: delete()
	* created by:
	* description:
	* parameters:
	* returns:
	**************************************************************************/
	function delete(&$d) {
		$db = new ps_DB;
		$ps_vendor_id = $_SESSION['ps_vendor_id'];

		$this->removeUsers( $d['user_id' ], $d );

		if( !is_array( $d['user_id'] )) {
			$d['user_id'] = array( $d['user_id'] );
		}

		foreach( $d['user_id'] as $user ) {
			if( !$this->validate_delete( $user ) ) {
				return false;
			}
			// Delete user_info entries
			$q  = "DELETE FROM #__{vm}_user_info ";
			$q .= "WHERE user_id='" . $user . "' ";
			$q .= "AND address_type='BT'";
			$db->query($q);
			$db->next_record();

			$q = "DELETE FROM #__{vm}_auth_user_vendor where user_id='$user' AND vendor_id='$ps_vendor_id'";
			$db->query($q);

			$q = "DELETE FROM #__{vm}_shopper_vendor_xref where user_id='$user' AND vendor_id='$ps_vendor_id'";
			$db->query($q);
		}

		return True;
	}

	/**
        * Function to save User Information
        * into Joomla
        */
	function saveUser( &$d ) {
		global $database, $my, $_VERSION;
		global $mosConfig_live_site, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_sitename;

		$aro_id = 'aro_id';
		$group_id = 'group_id';
		// Column names have changed (but why???)
		if( $_VERSION->PRODUCT == 'Joomla!' && $_VERSION->RELEASE >= 1.1 ) {
			$aro_id = 'id';
			$group_id = 'id';
		}

		$row = new mosUser( $database );
		if (!$row->bind( $_POST )) {
			echo "<script type=\"text/javascript\"> alert('".vmHtmlEntityDecode($row->getError())."');</script>\n";
		}

		$isNew 	= !$row->id;
		$pwd 	= '';

		// MD5 hash convert passwords
		if ($isNew) {
			// new user stuff
			if ($row->password == '') {
				$pwd = mosMakePassword();
				$row->password = md5( $pwd );
			} else {
				$pwd = $row->password;
				$row->password = md5( $row->password );
			}
			$row->registerDate = date( 'Y-m-d H:i:s' );
		} else {
			// existing user stuff
			if ($row->password == '') {
				// password set to null if empty
				$row->password = null;
			} else {
				if( !empty( $_POST['password'] )) {
					if( $row->password != @$_POST['password2'] ) {
						$d['error'] = vmHtmlEntityDecode(_REGWARN_VPASS2);
						return false;
					}
				}
				$row->password = md5( $row->password );
			}
		}

		// save usertype to usetype column
		$query = "SELECT name"
		. "\n FROM #__core_acl_aro_groups"
		. "\n WHERE `$group_id` = $row->gid"
		;
		$database->setQuery( $query );
		$usertype = $database->loadResult();
		$row->usertype = $usertype;

		// save params
		$params = mosGetParam( $_POST, 'params', '' );
		if (is_array( $params )) {
			$txt = array();
			foreach ( $params as $k=>$v) {
				$txt[] = "$k=$v";
			}
			$row->params = implode( "\n", $txt );
		}

		if (!$row->check()) {
			echo "<script type=\"text/javascript\"> alert('".vmHtmlEntityDecode($row->getError())."');</script>\n";
			return false;
		}
		if (!$row->store()) {
			echo "<script type=\"text/javascript\"> alert('".vmHtmlEntityDecode($row->getError())."');</script>\n";
			return false;
		}
		if ( $isNew ) {
			$newUserId = $row->id;
		}
		else
		$newUserId = false;

		$row->checkin();

		$_SESSION['session_user_params']= $row->params;

		// update the ACL
		if ( !$isNew ) {
			$query = "SELECT `$aro_id`"
			. "\n FROM #__core_acl_aro"
			. "\n WHERE value = '$row->id'"
			;
			$database->setQuery( $query );
			$aro_id = $database->loadResult();

			$query = "UPDATE #__core_acl_groups_aro_map"
			. "\n SET group_id = $row->gid"
			. "\n WHERE aro_id = $aro_id"
			;
			$database->setQuery( $query );
			$database->query() or die( $database->stderr() );
		}

		// for new users, email username and password
		if ($isNew) {
			$query = "SELECT email"
			. "\n FROM #__users"
			. "\n WHERE id = $my->id"
			;
			$database->setQuery( $query );
			$adminEmail = $database->loadResult();

			$subject = _NEW_USER_MESSAGE_SUBJECT;
			$message = sprintf ( _NEW_USER_MESSAGE, $row->name, $mosConfig_sitename, $mosConfig_live_site, $row->username, $pwd );

			if ($mosConfig_mailfrom != "" && $mosConfig_fromname != "") {
				$adminName 	= $mosConfig_fromname;
				$adminEmail = $mosConfig_mailfrom;
			} else {
				$query = "SELECT name, email"
				. "\n FROM #__users"
				// administrator
				. "\n WHERE gid = 25"
				;
				$database->setQuery( $query );
				$admins = $database->loadObjectList();
				$admin 		= $admins[0];
				$adminName 	= $admin->name;
				$adminEmail = $admin->email;
			}
			mosMail( $adminEmail, $adminName, $row->email, $subject, $message );
		}
		return $newUserId;
	}

	/**
	* Function to remove a user from Joomla
	*/
	function removeUsers( $cid, &$d ) {
		global $database, $acl, $my;

		if (!is_array( $cid ) ) {
			$cid = array( $cid );
		}

		if ( count( $cid ) ) {
			$obj = new mosUser( $database );
			foreach ($cid as $id) {
				// check for a super admin ... can't delete them
				$groups 	= $acl->get_object_groups( 'users', $id, 'ARO' );
				$this_group = strtolower( $acl->get_group_name( $groups[0], 'ARO' ) );
				if ( $this_group == 'super administrator' ) {
					$d["error"] = "You cannot delete a Super Administrator";
				} else if ( $id == $my->id ){
					$d["error"] = "You cannot delete Yourself!";
				} else if ( ( $this_group == 'administrator' ) && ( $my->gid == 24 ) ){
					$d["error"] = "You cannot delete another `Administrator` only `Super Administrators` have this power";
				} else {
					$obj->delete( $id );
					$d["error"] = $obj->getError();
				}
			}
		}
	}
	
	/**
	 * Returns the information from the user_info table for a specific user
	 *
	 * @param int $user_id
	 * @param array $fields
	 * @return ps_DB
	 */
	function getUserInfo( $user_id, $fields=array() ) {
		$user_id = intval( $user_id );
		if( empty( $fields )) {
			$selector = '*';
		}
		else {
			$selector = '`'. implode( '`,`', $fields ) . '`';
		}
		$db = new ps_DB();
		$q = 'SELECT '.$selector.' FROM `#__{vm}_user_info` WHERE `user_id`='.$user_id;
		$db->query( $q );
		$db->next_record();
		
		return $db;
	}
	
	/**
	 * Inserts or Updates the user information
	 *
	 * @param array $user_info
	 * @param int $user_id
	 */
	function setUserInfo( $user_info, $user_id=0 ) {
		$db = new ps_DB;
		
		if( empty( $user_id ) ) { // INSERT NEW USER
			
			$db->buildQuery( 'INSERT', '#__{vm}_user_info', $user_info );
			// Run the query now!
			$db->query();
		}
		else { // UPDATE EXISTING USER
			
			$db->buildQuery( 'UPDATE', '#__{vm}_user_info', $user_info, 'WHERE `user_id`='.$user_id );
			// Run the query now!
			$db->query();
		}
	}
}

?>
