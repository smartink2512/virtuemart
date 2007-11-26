<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
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
	/**
	 * Validates the input parameters for the add event
	 *
	 * @param array $d
	 * @return boolean
	 */
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

		if( empty( $id ) ) {
			$vmLogger->err( 'Please select a user to delete.' );
			return false;
		}
		$db = new ps_DB();
		$q = 'SELECT user_id, perms FROM #__{vm}_user_info WHERE user_id='.(int)$id;
		$db->query( $q );

		// Only check VirtueMart users - the user may be only a CMS user		
		if( $db->num_rows() > 0 ) {
			$perms = $db->f('perms');

			if( !$perm->hasHigherPerms( $perms ) ) {
				$vmLogger->err( 'You have no permission to delete a user of that usertype: '.$perms );
				$valid = false;
			}

			if( $id == $my->id) {
				$vmLogger->err( 'Very funny, but you cannot delete yourself.' );
				$valid = false;
			}
		}
		
		return $valid;
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
		if( vmIsJoomla( '1.5' ) ) {
			$uid = $this->save();
		} else {
			$uid = $this->saveUser( $d );
		}
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
		$vmLogger->info( 'The user has been added.');
		
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
		global $my, $VM_LANG, $perm, $vmLogger;
		$ps_vendor_id = $_SESSION["ps_vendor_id"];
		$db = new ps_DB;
		$timestamp = time();

		if (!$this->validate_update($d)) {
			return False;
		}

		// Joomla User Information stuff
		if( vmIsJoomla( '1.5' ) ) {
			$this->save();
		} else {
			$this->saveUser( $d );
		}

		/* Update Bill To */

		// Get all fields which where shown to the user
		$userFields = ps_userfield::getUserFields('registration', false, '', true);

		$user_id = intval( $d['id'] );

		// Building the query: PART ONE
		// The first 7 fields are FIX and not built dynamically
		$db->query( "SELECT COUNT(user_info_id) AS num_rows FROM #__{vm}_user_info WHERE user_id='" . $user_id . "'" );
		if( $db->f('num_rows') < 1 ) {
			// The user is registered in Joomla, but not in VirtueMart; so, insert the bill to information
			return $this->add($d);
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
		
		$vmLogger->info( 'The user details have been updated.');
		
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
		$ps_vendor_id = (int) $_SESSION['ps_vendor_id'];

		if( !is_array( $d['user_id'] )) {
			$d['user_id'] = array( $d['user_id'] );
		}

		foreach( $d['user_id'] as $user ) {
			if( !$this->validate_delete( $user ) ) {
				return false;
			}
			
			$user = (int) $user;
			
			// remove the CMS user
			if( !$this->removeUsers( $user ) ) {
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
		global $database, $my, $_VERSION, $VM_LANG;
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
						$d['error'] = vmHtmlEntityDecode($VM_LANG->_('REGWARN_VPASS2',false));
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
		$params = vmGet( $_POST, 'params', '' );
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
			// Send the notification emails
			$name = $row->name;
			$email = $row->email;
			$username = $row->username;
			$password = $pwd;
			$this->_sendMail( $name, $email, $username, $password );
		}
		
		return $newUserId;
	}
	
	/**
	 * Saves a user into Joomla! 1.5 
	 *
	 * @return int An integer user_id if the user was saved successfully, false if not
	 */
	function save()
	{
		global $mainframe;
		global $vmLogger;

		$option = JRequest::getCmd( 'option');

		// Initialize some variables
		$db			= & JFactory::getDBO();
		$me			= & JFactory::getUser();
		$MailFrom	= $mainframe->getCfg('mailfrom');
		$FromName	= $mainframe->getCfg('fromname');
		$SiteName	= $mainframe->getCfg('sitename');

 		// Create a new JUser object
		$user = new JUser(JRequest::getVar( 'id', 0, 'post', 'int'));
		$original_gid = $user->get('gid');

		$post = JRequest::get('post');
		$post['username']	= JRequest::getVar('username', '', 'post', 'username');
		$post['password']	= JRequest::getVar('password', '', 'post', 'string', JREQUEST_ALLOWRAW);
		$post['password2']	= JRequest::getVar('password2', '', 'post', 'string', JREQUEST_ALLOWRAW);

		if (!$user->bind($post))
		{
			echo "<script type=\"text/javascript\"> alert('".vmHtmlEntityDecode( $user->getError() )."');</script>\n";
			return false;
		}

		// Are we dealing with a new user which we need to create?
		$isNew 	= ($user->get('id') < 1);
		if (!$isNew)
		{
			// if group has been changed and where original group was a Super Admin
			if ( $user->get('gid') != $original_gid && $original_gid == 25 )
			{
				// count number of active super admins
				$query = 'SELECT COUNT( id )'
					. ' FROM #__users'
					. ' WHERE gid = 25'
					. ' AND block = 0'
				;
				$db->setQuery( $query );
				$count = $db->loadResult();

				if ( $count <= 1 )
				{
					// disallow change if only one Super Admin exists
					$vmLogger->err( "You cannot change this user's group as the user is the only active Super Administrator for your site." );
					return false;
				}
			}
		}

		/*
	 	 * Lets save the JUser object
	 	 */
		if (!$user->save())
		{
			echo "<script type=\"text/javascript\"> alert('".vmHtmlEntityDecode( $user->getError() )."');</script>\n";
			return false;
		}

		// For new users, email username and password
		if ($isNew)
		{
			$name = $user->get( 'name' );
			$email = $user->get( 'email' );
			$username = $user->get( 'username' );
			$password = $user->password_clear;
		 	$this->_sendMail( $name, $email, $username, $password );
		}
	 	
		// Capture the new user id
		if( $isNew ) {
			$newUserId = $user->get('id');
		} else {
			$newUserId = false;
		}

		return $newUserId;
	}
	
	/**
	 * Sends new/updated user notification emails 
	 *
	 * @param string $name - The name of the newly created/updated user
	 * @param string $email - The email address of the newly created/updated user
	 * @param string $username - The username of the newly created/updated user
	 * @param string $password - The plain text password of the newly created/updated user
	 */
	function _sendMail( $name, $email, $username, $password ) {
		global $database, $VM_LANG;
		global $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_sitename, $mosConfig_live_site;
		
		$query = "SELECT email"
			. "\n FROM #__users"
			. "\n WHERE id = $my->id"
			;
		$database->setQuery( $query );
		$adminEmail = $database->loadResult();
		
		$subject = $VM_LANG->_('NEW_USER_MESSAGE_SUBJECT',false);
		$message = sprintf ( $VM_LANG->_('NEW_USER_MESSAGE',false), $name, $mosConfig_sitename, $mosConfig_live_site, $username, $password );
		
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

		mosMail( $adminEmail, $adminName, $email, $subject, $message );
	}


	/**
	* Function to remove a user from Joomla
	*/
	function removeUsers( $cid ) {
		global $database, $acl, $my, $vmLogger;

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
					$vmLogger->err( 'You cannot delete a Super Administrator' );
					return false;
				} else if ( $id == $my->id ){
					$vmLogger->err( 'You cannot delete Yourself!' );
					return false;
				} else if ( ( $this_group == 'administrator' ) && ( $my->gid == 24 ) ){
					$vmLogger->err( 'You cannot delete another `Administrator` only `Super Administrators` have this power' );
					return false;
				} else {
					$obj->delete( $id );
					$err = $obj->getError();
					if( $err ) {
						$vmLogger->err( $err );
						return false;
					}
					
					return true;
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
