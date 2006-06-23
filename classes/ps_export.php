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

	/**
	* validate order export module add
	* @param array
	* @return bool
	* @author Manfred Dennerlein Rodelo <manni@zapto.de>
	*/
	function validate_add(&$d) {
		global $vmLogger, $VM_LANG;
		$db = new ps_DB;

		if (!$d['order_export_name']) {
			$d['error'] = 'ERROR:  There is already a module with the same name.';
			return False;
		}
		if (empty($d['export_enabled'])) {
			$d['export_enabled'] = 'N';
		}
		if(!file_exists( CLASSPATH.'export/'.$d['order_export_class'].'.php' ) ) {
			$d['error'] = 'ERROR: Export Class does not exist.';
			return false;
		}
		$d['order_export_config'] = mosGetParam( $_POST, 'order_export_config', '', _MOS_ALLOWHTML );
		if( !get_magic_quotes_runtime() || !get_magic_quotes_gpc() ) {
			$d['order_export_config'] = addslashes( $d['order_export_config'] );
		}
		return True;
	}
	/**
	* validate order export module deletion
	* @param array
	* @return bool
	* @author Manfred Dennerlein Rodelo <manni@zapto.de>
	*/
	function validate_delete($d) {
		global $vmLogger, $VM_LANG;
		if (!$d['order_export_id']) {
			$d['error'] = 'ERROR:  Please select an export module to delete.';
			return False;
		}
		else {
			return True;
		}
	}

	/**
	* validate order export module update
	* @param array
	* @return bool
	* @author Manfred Dennerlein Rodelo <manni@zapto.de>
	*/
	function validate_update(&$d) {
		global $vmLogger, $VM_LANG;
		$db = new ps_DB;

		if (!$d['order_export_id']) {
			$d['error'] = 'ERROR:  You must select an export module to update.';
			return False;
		}
		if (!$d['order_export_name']) {
			$d['error'] = 'ERROR:  You must enter a name for the order export module.';
			return False;
		}
		if(!file_exists( CLASSPATH.'export/'.$d['order_export_class'].'.php' ) ) {
			$d['error'] = 'ERROR: Export Class does not exist.';
			return false;
		}
		$d['order_export_config'] = mosGetParam( $_POST, 'order_export_config', '', _MOS_ALLOWHTML );
		if( !get_magic_quotes_runtime() || !get_magic_quotes_gpc() ) {
			$d['order_export_config'] = addslashes( $d['order_export_config'] );
		}
		return True;
	}


	/**
	* Add an export module
	* @param array
	* @return bool
	* @author Manfred Dennerlein Rodelo <manni@zapto.de>
	*/
	function add(&$d) {
		global $vmLogger, $VM_LANG;
		$db = new ps_DB;
		$ps_vendor_id = $_SESSION['ps_vendor_id'];
		$timestamp = time();

		if (!$this->validate_add($d)) {
			return False;
		}
		if ( !empty($d['order_export_class']) ) {
			// Here we have a custom export class
			if( file_exists( CLASSPATH.'export/'.$d['order_export_class'].'.php' ) ) {
				// Include the class code and create an instance of this class
				include( CLASSPATH.'export/'.$d['order_export_class'].'.php' );
				eval( "\$_EXPORT = new ".$d['order_export_class']."();");
			}
		}
		else {
			// ps_xmlexport is the default export method handler
			include( CLASSPATH."export/ps_xmlexport.php" );
			$_EXPORT = new ps_payment();
		}
		if( $_EXPORT->configfile_writeable() ) {
			$_EXPORT->write_configuration( $d );
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

	/**
	* update export module
	* @param array
	* @return bool
	* @author Manfred Dennerlein
	*/
	function update(&$d) {
		global $vmLogger, $VM_LANG;
		$db = new ps_DB;
		$ps_vendor_id = $_SESSION['ps_vendor_id'];
		$timestamp = time();

		if (!$this->validate_update($d)) {
			return False;
		}

		if ( !empty($d['order_export_class']) ) {
			if (include( CLASSPATH.'export/'.$d['order_export_class'].'.php' ))
			eval( "\$_EXPORT = new ".$d['order_export_class']."();");
		}
		else {
			include( CLASSPATH.'export/ps_xmlexport.php' );
			$_EXPORT = new ps_xmlexport();
		}
		if( $_EXPORT->configfile_writeable() ) {
			$_EXPORT->write_configuration( $d );
			$vmLogger->info( $VM_LANG->_VM_CONFIGURATION_CHANGE_SUCCESS );
		}
		else {
			$vmLogger->err( sprintf($VM_LANG->_VM_CONFIGURATION_CHANGE_FAILURE , CLASSPATH."export/".$_EXPORT->classname.".cfg.php" ) );
			return false;
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
	* @param array
	* @return bool
	* @author Manfred Dennerlein
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
	* delete order export module update
	* @param array
	* @return bool
	* @author Manfred Dennerlein Rodelo <manni@zapto.de>
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
