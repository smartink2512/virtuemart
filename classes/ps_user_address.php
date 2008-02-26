<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
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
* This class is used for managing Shipping Addresses
*
* @author Edikon Corp., pablo
*/
class ps_user_address {
	

	/**
	 * Validates all input parameters onBeforeAdd
	 *
	 * @param array $d
	 * @return boolean
	 */
	function validate_add(&$d) {
		global $my, $VM_LANG, $vmLogger, $vmInputFilter;
		$valid = true;

		$d['missing'] = "";

		if (!$my->id) {
			$vmLogger->err( $VM_LANG->_('MUST_NOT_USE') );
			$valid = false;
			return $valid;
		}

		if (empty($d["address_type_name"])) {
			$d['missing'] .= "address_type_name";
			$valid = false;
		}
		if (empty($d["last_name"])) {
			$d['missing'] .= "last_name";
			$valid = false;
		}
		if (empty($d["first_name"])) {
			$d['missing'] .= "first_name";
			$valid = false;
		}
		if (empty($d["address_1"])) {
			$d['missing'] .= "address_1";
			$valid = false;
		}
		if (empty($d["city"])) {
			$d['missing'] .= "city";
			$valid = false;
		}
		if (empty($d["zip"])) {
			$d['missing'] .= "zip";
			$valid = false;
		}

		if (empty($d["phone_1"])) {
			$d['missing'] .= "phone_1";
			$valid = false;
		}

		if(empty($d['user_info_id'])) {
			$db = new ps_DB;
			$q  = "SELECT user_id from #__{vm}_user_info ";
			$q .= "WHERE address_type_name='" . $db->getEscaped($d["address_type_name"]) . "' ";
			$q .= "AND address_type='" . $db->getEscaped($d["address_type"]) . "' ";
			$q .= "AND user_id = " .(int)$d["user_id"];
			$db->query($q);
	
			if ($db->next_record()) {
				$d['missing'] .= "address_type_name";
				$vmLogger->warning( $VM_LANG->_('VM_USERADDRESS_ERR_LABEL_EXISTS') );
				$valid = false;
			}
		}
		
		return $valid;
	}

	/**
	 * Validates all input parameters onBeforeUpdate
	 *
	 * @param array $d
	 * @return boolean
	 */
	function validate_update(&$d) {

		return $this->validate_add( $d );
	}

	/**
	 * Validates all input parameters onBeforeDelete
	 *
	 * @param array $d
	 * @return boolean
	 */
	function validate_delete(&$d) {
		global $vmLogger, $VM_LANG;
		if (empty($d["user_info_id"])) {
			$vmLogger->err( $VM_LANG->_('VM_USERADDRESS_DELETE_SELECT') );
			return false;
		}
		else {
			return true;
		}
	}

	/**
	 * Adds a new Shipping Adress for the specified user
	 *
	 * @param array $d
	 * @return boolean
	 */
	function add(&$d) {
		global $perm, $page, $VM_LANG;
		$hash_secret = "VirtueMartIsCool";
		$db = new ps_DB;
		$timestamp = time();

		if (!$this->validate_add($d)) {
			return false;
		}

		$d["extra_field_1"] = vmGet( $d, 'extra_field_1', '' );
		$d["extra_field_2"] = vmGet( $d, 'extra_field_2', '' );
		$d["extra_field_3"] = vmGet( $d, 'extra_field_3', '' );
		$d["extra_field_4"] = vmGet( $d, 'extra_field_4', 'N' );
		$d["extra_field_5"] = vmGet( $d, 'extra_field_5', 'N' );

		$fields = array('user_info_id' => md5( uniqid( $hash_secret )), 
								'user_id' => !$perm->check("admin,storeadmin") ? $_SESSION['auth']['user_id'] : (int)$d["user_id"],
								'address_type' => $d["address_type"],
								'address_type_name' => $d["address_type_name"],
								'company' => $d["company"],
								'title' => @$d["title"],
								'last_name' => $d["last_name"],
								'first_name' => $d["first_name"] ,
								'middle_name' => $d["middle_name"],
								'phone_1' => $d["phone_1"],
								'phone_2' => $d["phone_2"],
								'fax' => $d["fax"],
								'address_1' => $d["address_1"],
								'address_2' => $d["address_2"],
								'city' =>$d["city"],
								'state' => @$d["state"],
								'country' => $d["country"],
								'zip' => $d["zip"],
								'extra_field_1' => $d["extra_field_1"],
								'extra_field_2' => $d["extra_field_2"],
								'extra_field_3' => $d["extra_field_3"],
								'extra_field_4' => $d["extra_field_4"],
								'extra_field_5' => $d["extra_field_5"],
								'cdate' => $timestamp,
								'mdate' => $timestamp 
								);

		$db->buildQuery('INSERT', '#__{vm}_user_info', $fields  );
		if( $db->query() !== false ) {
			$GLOBALS['vmLogger']->info($VM_LANG->_('VM_USERADDRESS_ADDED'));
			return true;
		} else {
			$GLOBALS['vmLogger']->err($VM_LANG->_('VM_USERADDRESS_ADD_FAILED'));
			return false;
		}
	}
	
	/**
	 * Updates a Shipping Adress for the specified user info ID
	 *
	 * @param array $d
	 * @return boolean
	 */
	function update(&$d) {
		global $perm, $VM_LANG;
		$db = new ps_DB;
		$timestamp = time();

		if (!$this->validate_update($d)) {
			return false;
		}
		$d["extra_field_1"] = vmGet( $d, 'extra_field_1', '' );
		$d["extra_field_2"] = vmGet( $d, 'extra_field_2', '' );
		$d["extra_field_3"] = vmGet( $d, 'extra_field_3', '' );
		$d["extra_field_4"] = vmGet( $d, 'extra_field_4', 'N' );
		$d["extra_field_5"] = vmGet( $d, 'extra_field_5', 'N' );
		$fields = array( 
								'user_id' => !$perm->check("admin,storeadmin") ? $_SESSION['auth']['user_id'] : (int)$d["user_id"],
								'address_type' => $d["address_type"],
								'address_type_name' => $d["address_type_name"],
								'company' => $d["company"],
								'title' => @$d["title"],
								'last_name' => $d["last_name"],
								'first_name' => $d["first_name"] ,
								'middle_name' => $d["middle_name"],
								'phone_1' => $d["phone_1"],
								'phone_2' => $d["phone_2"],
								'fax' => $d["fax"],
								'address_1' => $d["address_1"],
								'address_2' => $d["address_2"],
								'city' =>$d["city"],
								'state' => @$d["state"],
								'country' => $d["country"],
								'zip' => $d["zip"],
								'extra_field_1' => $d["extra_field_1"],
								'extra_field_2' => $d["extra_field_2"],
								'extra_field_3' => $d["extra_field_3"],
								'extra_field_4' => $d["extra_field_4"],
								'extra_field_5' => $d["extra_field_5"],
								'mdate' => $timestamp 
								);

		$db->buildQuery('UPDATE', '#__{vm}_user_info', $fields, "WHERE user_info_id='" . $db->getEscaped($d["user_info_id"]) . "'".(!$perm->check("admin,storeadmin") ? " AND user_id=".$_SESSION['auth']['user_id'] : '') );	
		if( $db->query() !== false ) {
			$GLOBALS['vmLogger']->info($VM_LANG->_('VM_USERADDRESS_UPDATED'));
			return true;
		} else {
			$GLOBALS['vmLogger']->err($VM_LANG->_('VM_USERADDRESS_UPDATED_FAILED'));
			return false;
		}
	}

	/**
	 * Deletes the Shipping Adress of the specified user info ID
	 *
	 * @param array $d
	 * @return boolean
	 */
	function delete(&$d) {
		global $perm;

		$db = new ps_DB;

		if (!$this->validate_delete($d)) {
			return false;
		}

		$q  = "DELETE FROM #__{vm}_user_info ";
		$q .= "WHERE user_info_id='" . $d["user_info_id"] . "'";
		if (!$perm->check("admin,storeadmin")) {
			$q .= " AND user_id=".$_SESSION['auth']['user_id'];
		}
		$q .= ' LIMIT 1';
		$db->query($q);

		return true;
	}

}
?>
