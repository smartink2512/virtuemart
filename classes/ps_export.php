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


class ps_export {
	var $classname = 'ps_export';

	/**
	* validate order export module add
	* @param array
	* @return bool
	* @author Manfred Dennerlein Rodelo <manni@zapto.de>
	*/
	function validate_add(&$d) {
		global $vmLogger, $VM_LANG;
		$db = new ps_DB;

		if (!$d['export_name']) {
			$d['error'] = 'ERROR:  Module name cannot be empty';
			return False;
		}
		if (empty($d['export_enabled'])) {
			$d['export_enabled'] = 'N';
		}
		if(empty($d['export_class'])) {
			$d['export_class'] = 'ps_xmlexport';
		}
		if(!file_exists( CLASSPATH.'export/'.$d['export_class'].'.php' ) ) {
			$d['error'] = 'ERROR: Export Class does not exist.';
			return false;
		}
		$d['export_config'] = mosGetParam( $_POST, 'export_config', '', _MOS_ALLOWHTML );
		if( !get_magic_quotes_runtime() || !get_magic_quotes_gpc() ) {
			$d['export_config'] = addslashes( $d['export_config'] );
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
		if (!$d['export_id']) {
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

		if (!$d['export_id']) {
			$d['error'] = 'ERROR:  You must select an export module to update.';
			return False;
		}
		if (!$d['export_name']) {
			$d['error'] = 'ERROR:  You must enter a name for the order export module.';
			return False;
		}
		if(!file_exists( CLASSPATH.'export/'.$d['export_class'].'.php' ) ) {
			$d['error'] = 'ERROR: Export Class does not exist.';
			return false;
		}
		$d['export_config'] = mosGetParam( $_POST, 'export_config', '', _MOS_ALLOWHTML );
		if( !get_magic_quotes_runtime() || !get_magic_quotes_gpc() ) {
			$d['export_config'] = addslashes( $d['export_config'] );
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
		global $vmLogger, $VM_LANG,  $mosConfig_absolute_path;
		$db = new ps_DB;
		$ps_vendor_id = $_SESSION['ps_vendor_id'];
		$timestamp = time();

		if ( !empty($d['export_class']) ) {
			// Here we have a custom export class
			if( file_exists( CLASSPATH.'export/'.$d['export_class'].'.php' ) ) {
				// Include the class code and create an instance of this class
				include_once( CLASSPATH.'export/'.$d['export_class'].'.php' );
				eval( "\$_EXPORT = new ".$d['export_class']."();");
			}
		} else {
			// ps_xmlexport is the default export method handler
			include_once( CLASSPATH."export/ps_xmlexport.php" );
			$_EXPORT = new ps_xmlexport();
		}
		
		if(method_exists($_EXPORT, 'process_installation')) {
			$d = $_EXPORT->process_installation($d);
		}
		
		if (!$this->validate_add($d)) {
			return False;
		}
		
		if( $_EXPORT->configfile_writeable() ) {
			$_EXPORT->write_configuration( $d );
		}

		$q = 'INSERT INTO #__{vm}_export (vendor_id, export_name,';
		$q .= 'export_desc, export_class, export_enabled, export_config, iscore) ';
		$q .= 'VALUES (';
		$q .= "'$ps_vendor_id','";
		$q .= $d['export_name'] . "','";
		$q .= $d['export_desc'] . "','";
		$q .= $d['export_class'] . "','";
		$q .= $d['export_enabled'] . "','";
		$q .= $d['export_config'] . "','";
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

		if ( !empty($d['export_class']) ) {
			if (include_once( CLASSPATH.'export/'.$d['export_class'].'.php' ))
			eval( "\$_EXPORT = new ".$d['export_class']."();");
		}
		else {
			include_once( CLASSPATH.'export/ps_xmlexport.php' );
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

		$q = 'UPDATE #__{vm}_export SET ';
		if(!$d['iscore']) {
			$q .= "export_name='" . $d['export_name'];
			$q .= "',export_desc='" . $d['export_desc'];
			$q .= "',export_class='" . $d['export_class'];
		}
		$q .= "',export_config='" . $d['export_config'];
		$q .= "',export_enabled='" . $d['export_enabled'];
		$q .= "' WHERE export_id='" . $d['export_id'] . "'";
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
		$record_id = $d['export_id'];

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

		$q = "DELETE from #__{vm}_export WHERE export_id='$record_id'";
		$q .= " AND vendor_id='$ps_vendor_id'";
		$db->query($q);
		return True;
	}

/**
 * Enter description here...
 *
 * @param unknown_type $name
 * @param unknown_type $preselected
 * @return unknown
 */
	function list_available_classes( $name, $preselected='ps_xmlexport' ) {

		$files = mosReadDirectory( CLASSPATH."export/", ".php", true, true);
		$array = array();
		foreach ($files as $file) {
			$file_info = pathinfo($file);
			$filename = $file_info['basename'];
			if( stristr($filename, '.cfg')) { continue; }
			$array[basename($filename, '.php' )] = basename($filename, '.php' );
		}
		return ps_html::selectList( $name, $preselected, $array );
	}
}
?>
