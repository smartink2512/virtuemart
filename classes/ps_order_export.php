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


class ps_order_export {
	var $classname = 'ps_order_export';

	/*
	** VALIDATION FUNCTIONS
	**
	*/

	function validate_add(&$d) {

		$db = new ps_DB;

		if (!$d['order_export_name']) {
			$d['error'] = 'ERROR:  There is already a module with the same name.';
			return False;
		}
		if (empty($d['export_enabled'])) {
			$d['export_enabled'] = 'N';
		}
		
		$d['order_export_config'] = mosGetParam( $_POST, 'order_export_config', '', _MOS_ALLOWHTML );
		if( !get_magic_quotes_runtime() || !get_magic_quotes_gpc() ) {
			$d['order_export_config'] = addslashes( $d['order_export_config'] );
		}
		return True;
	}

	function validate_delete($d) {

		if (!$d['order_export_id']) {
			$d['error'] = 'ERROR:  Please select an export module to delete.';
			return False;
		}
		else {
			return True;
		}
	}

	function validate_update(&$d) {
		$db = new ps_DB;

		if (!$d['order_export_id']) {
			$d['error'] = 'ERROR:  You must select an export module to update.';
			return False;
		}
		if (!$d['order_export_name']) {
			$d['error'] = 'ERROR:  You must enter a name for the order export module.';
			return False;
		}
		
		$d['order_export_config'] = mosGetParam( $_POST, 'order_export_config', '', _MOS_ALLOWHTML );
		if( !get_magic_quotes_runtime() || !get_magic_quotes_gpc() ) {
			$d['order_export_config'] = addslashes( $d['order_export_config'] );
		}
		return True;
	}


	/**
	* Add an export module
	* @param 
	* @return
	* @author Manfred Dennerlein Rodelo <manni@zapto.de>
	*/
	function add(&$d) {
		$db = new ps_DB;
		$ps_vendor_id = $_SESSION['ps_vendor_id'];
		$timestamp = time();

		if (!$this->validate_add($d)) {
			return False;
		}
		$q = 'INSERT INTO #__{vm}_order_export (vendor_id, order_export_name,';
		$q .= 'order_export_desc, order_export_class, export_enabled, order_export_config, iscore) ';
		$q .= 'VALUES (';
		$q .= "'$ps_vendor_id','";
		$q .= $d['order_export_name'] . "','";
		$q .= $d['order_export_desc'] . "','";
		$q .= $d['order_export_class'] . "','";
		$q .= $d['export_enabled'] . "','";
		$q .= $d['order_export_config'] . "','";
		$q .= "0')";
		$db->query($q);
		$db->next_record();
		return True;

	}

	/**************************************************************************
	* name: update()
	* created by: pablo
	* description: updates function information
	* parameters:
	* returns:
	**************************************************************************/
	function update(&$d) {
		$db = new ps_DB;
		$ps_vendor_id = $_SESSION['ps_vendor_id'];
		$timestamp = time();

		if (!$this->validate_update($d)) {
			return False;
		}
		$q = 'UPDATE #__{vm}_order_export SET ';
		if(!$d['iscore']) {
		$q .= "order_export_name='" . $d['order_export_name'];
		$q .= "',order_export_desc='" . $d['order_export_desc'];
		$q .= "',order_export_class='" . $d['order_export_class'];
		}
		$q .= "',order_export_config='" . $d['order_export_config'];
		$q .= "',export_enabled='" . $d['export_enabled'];
		$q .= "' WHERE order_export_id='" . $d['order_export_id'] . "'";
		$q .= " AND vendor_id='$ps_vendor_id'";
		$db->query($q);
		$db->next_record();
		return True;
	}

	/**
	* Controller for Deleting Records.
	*/
	function delete(&$d) {

		if (!$this->validate_delete($d)) {
			return False;
		}
		echo $record_id = $d['order_export_id'];

		if( is_array( $record_id)) {
			foreach( $record_id as $record) {
				if( !$this->delete_record( $record, $d ))
				return false;
			}
			return true;
		}
		else {
			return $this->delete_record( $record_id, $d );
		}
	}
	/**
	* Deletes one Record.
	*/
	function delete_record( $record_id, &$d ) {
		global $db;
		$ps_vendor_id = $_SESSION['ps_vendor_id'];

		$q = "DELETE from #__{vm}_order_export WHERE order_export_id='$record_id'";
		$q .= " AND vendor_id='$ps_vendor_id'";
		$db->query($q);
		return True;
	}



}
?>
