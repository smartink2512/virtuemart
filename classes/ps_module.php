<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: ps_module.php 431 2006-10-17 21:55:46 +0200 (Di, 17 Okt 2006) soeren_nb $
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2006 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

class ps_module {
	var $classname = "ps_module";
	var $error;


	/**************************************************************************
	* name: validate_add()
	* created by: pablo
	* description: validate the given data before adding a function record
	* parameters:
	* returns:
	**************************************************************************/

	function validate_add(&$d) {
		global $db, $vmLogger;

		if ( empty($d[ 'module_name' ] )) {
			$vmLogger->err ( 'You must enter a name for the module.' );
			return False;
		}
		else {
			$q = "SELECT count(*) as rowcnt from #__{vm}_module where module_name='" . $db->getEscaped( $d[ 'module_name' ] ) . "'";
			$db->query($q);
			$db->next_record();
			if ($db->f("rowcnt") > 0) {
				$vmLogger->err( 'The given module name already exists.' );
				return False;
			}
		}

		if ( empty($d[ 'module_perms' ]) ) {
			$vmLogger->err( 'You must enter permissions for the module.' );
			return false;
		}
		if (empty( $d[ 'list_order' ] ) ) {
			$d[ 'list_order' ] = "99";
		}
		return True;
	}


	/**************************************************************************
	* name: validate_update()
	* created by: pablo
	* description: validate the given data before updating a function record
	* parameters:
	* returns:
	**************************************************************************/

	function validate_update(&$d) {
		global $vmLogger;
		

		if ( empty($d[ 'module_name' ] )) {
			$vmLogger->err ( 'You must enter a name for the module.' );
			return False;
		}
		else {
			$db = new ps_DB();
			$q = "SELECT COUNT(*) AS rowcnt FROM #__{vm}_module WHERE module_name='" . $db->getEscaped( $d[ 'module_name' ] ) . "' AND module_id <> ".(int)$d['module_id'];
			$db->query($q);
			$db->next_record();
			if ($db->f("rowcnt") > 0) {
				$vmLogger->err( 'The given module name already exists.' );
				return False;
			}
		}

		if ( empty($d[ 'module_perms' ]) ) {
			$vmLogger->err( 'You must enter permissions for the module.' );
			return false;
		}
		if (empty( $d[ 'list_order' ] ) ) {
			$d[ 'list_order' ] = "99";
		}
		return True;
	}
	
	
	/**************************************************************************
	* name: validate_delete()
	* created by: pablo
	* description: validate the given data before deleting a function record
	* parameters:
	* returns:
	**************************************************************************/

	function validate_delete($module_id) {
		global $db, $vmLogger;

		if (empty($module_id)) {
			$vmLogger->err( 'Please select a module to delete.' );
			return False;
		}

		$db->query( "SELECT module_name FROM #__{vm}_module WHERE module_id='$module_id'" );
		$db->next_record();
		$name = $db->f("module_name");
		if( $this->is_core( $name ) ) {
			$vmLogger->err( 'The module '.$name.' is a core module. It cannot be deleted.' );
			return false;
		}
		return True;

	}

	/**
	 * Adds a new module into the core module register
	 *
	 * @param array $d
	 * @return boolean
	 */
	function add(&$d) {
		global $db;

		$hash_secret="VMIsCool";

		$timestamp = time();

		if (!$this->validate_add($d)) {
			$d[ 'error' ] = $this->error;
			return False;
		}
		if( is_array( $d[ 'module_perms' ] )) {			
			$d[ 'module_perms' ] = implode( ',', $d[ 'module_perms' ] );
		}
		$fields = array( 'module_name' => $d[ 'module_name' ],
			            'module_perms' => $d[ 'module_perms' ],
						'module_description' => $d[ 'module_description' ],
						'module_publish' => $d[ 'module_publish'],
						'list_order' => $d[ 'list_order' ]);
			
		$db->buildQuery( 'INSERT',  '#__{vm}_module', $fields );

		$db->query();

		$_REQUEST['module_id'] = $db->last_insert_id();
		
		return True;

	}

	/**
	 * Updates information about a core module
	 *
	 * @param array $d
	 * @return boolean
	 */
	function update(&$d) {
		global $db;

		$timestamp = time();

		if (!$this->validate_update($d)) {
			$d[ 'error' ] = $this->error;
			return False;
		}
		if( is_array( $d[ 'module_perms' ] )) {			
			$d[ 'module_perms' ] = implode( ',', $d[ 'module_perms' ] );
		}
		
		$fields = array( 'module_name' => $d[ 'module_name' ],
			            'module_perms' => $d[ 'module_perms' ],
						'module_description' => $d[ 'module_description' ],
						'module_publish' => $d[ 'module_publish'],
						'list_order' => $d[ 'list_order' ]);
			
		$db->buildQuery( 'UPDATE',  '#__{vm}_module', $fields, ' WHERE module_id='.intval( $d[ 'module_id' ] ) );

		$db->query();

		return true;
	}

	/**
	* Controller for Deleting Records.
	*/
	function delete(&$d) {

		$record_id = $d["module_id"];

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

		if (!$this->validate_delete($record_id)) {
			$d[ 'error' ]=$this->error;
			return False;
		}

		$q = "DELETE from #__{vm}_function WHERE module_id='$record_id'";
		$db->query($q);

		$q = "DELETE FROM #__{vm}_module where module_id='$record_id'";
		$db->query($q);
		return true;

	}

	function is_core( $module ) {
		return( $module == "shop" || $module == "vendor" || $module == "product" || $module == "store" || $module == "order" || $module == "admin"
		|| $module == "checkout" || $module == "account" );

	}
	/**
	 * Returns the permissions for a module
	 *
	 * @param string $basename
	 * @return mixed
	 */
	function get_dir($basename) {
		$datab = new ps_DB;

		$results = array();

		$q = "SELECT module_perms FROM #__{vm}_module where module_name='".$basename."'";
		$datab->query($q);

		if ($datab->next_record()) {
			$results[ 'perms' ] = $datab->f("module_perms");
			return $results;
		}
		else {
			return false;
		}
	}
	/**
	 * Lists all available files from the /classes directory
	 *
	 * @param string $name
	 * @param string $preselected
	 * @return string
	 */
	function list_classes( $name, $preselected ) {
		global $mosConfig_absolute_path;
		$classes = mosReadDirectory( CLASSPATH, '.', false, true );
		$array = array();
		foreach ($classes as $class ) {
			if( is_dir( $class ) ) continue;
			$classname = basename( $class, '.php' );
			if( $classname != 'ps_main' && $classname != 'ps_ini' ) {
				$array[$classname] = $classname;
			}
		}
		return ps_html::selectList( $name, $preselected, $array, 1, '', 'id="'.$name.'"' );
	}
	
	function checkModulePermissions( $calledPage ) {

		global $page, $VM_LANG, $error_type, $vmLogger, $perm;

		// "shop.browse" => module: shop, page: browse
		$my_page= explode ( '.', $page );
		if( empty( $my_page[1] )) {
			return false;
		}
		$modulename = $my_page[0];
		$pagename = $my_page[1];


		$dir_list = $this->get_dir($modulename);

		if ($dir_list) {

			// Load MODULE-specific CLASS-FILES
			include_class( $modulename );

			if ($perm->check( $dir_list[ 'perms' ]) ) {

				if ( !file_exists(PAGEPATH.$modulename.".".$pagename.".php") ) {
					define( '_VM_PAGE_NOT_FOUND', 1 );
					$error = $VM_LANG->_PHPSHOP_PAGE_404_1;
					$error .= ' '.$VM_LANG->_PHPSHOP_PAGE_404_2 ;
					$error .= ' "'.$modulename.".".$pagename.'.php"';
					$vmLogger->err( $error );
					return false;
				}
				return true;
			}
			else {
				define( '_VM_PAGE_NOT_AUTH', 1 );
				$vmLogger->err( $VM_LANG->_PHPSHOP_MOD_NO_AUTH );
				return false;
			}
		}
		else {
			$error = $VM_LANG->_PHPSHOP_MOD_NOT_REG;
			$error .= '"'.$modulename .'" '. $VM_LANG->_PHPSHOP_MOD_ISNO_REG;
			$vmLogger->err( $error );
			return false;
		}

	}

}

?>