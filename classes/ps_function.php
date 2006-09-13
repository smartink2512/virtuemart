<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: ps_function.php,v 1.4 2005/09/29 20:01:13 soeren_nb Exp $
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
 * This class is is used to manage the function register.
 *
 */
class ps_function extends vmAbstractObject {
	
	var $_table_name = "#__{vm}_function";
	var $_key = 'function_id';

	function ps_function() {
		$this->addRequiredField( array('function_name', 'module_id', 'function_class', 'function_method', 'function_perms') );
		$this->addUniqueField( 'function_name' );
	}
	/**
    * Validates adding a function to a module.
    *
    * @param array $d
    * @return boolean
    */
	function validate_add( &$d ) {

		return $this->validate( $d );
	}

	/**
	 * Validates updating a module function
	 *
	 * @param array $d
	 * @return boolean
	 */
	function validate_update($d) {

		return $this->validate( $d );
	}
	
	/**
	 * Validates deleting a function record
	 *
	 * @param array $d
	 * @return boolean
	 */
	function validate_delete($d) {
		global $perm, $vmLogger;
		
		if (empty($d["function_id"])) {
			$vmLogger->err( 'Please select a function to delete.' );
			return False;
		}
		else {
			$db = new ps_DB();
			$db->query( 'SELECT module_perms, function_perms FROM `#__{vm}_function` f, `#__{vm}_module` m 
							WHERE `function_id` = '.(int)$d["function_id"]
							. ' AND `f`.`module_id` = `m`.`module_id`' );
			$db->next_record();
			
			if( !$perm->check( $db->f('module_perms')) || !$perm->check($db->f('function_perms'))) {
				$vmLogger->err( 'You are not allowed to delete this function (Module Perms: '.$db->f('module_perms').', Function Perms: '.$db->f('function_perms').', Your Perms: '.$_SESSION['auth']['perms'].').' );
				return false;
			}
		}
	}


	/**
	 * Creates a new function record
	 * @author pablo, soeren
	 *
	 * @param array $d
	 * @return boolean
	 */
	function add(&$d) {
			
		$db = new ps_DB;
		$timestamp = time();

		if (!$this->validate_add($d)) {
			return False;
		}
		if( is_array( $d[ 'function_perms' ] )) {			
			$d[ 'function_perms' ] = implode( ',', $d[ 'function_perms' ] );
		}
		$fields = array( 'function_name' => $d["function_name"],
						'function_class'=> $d["function_class"],
						'function_method' => $d["function_method"],
						'function_perms' => $d["function_perms"],
						'module_id' => $d["module_id"],
						'function_description'=> $d["function_description"] );
		$db->buildQuery( 'INSERT', '#__{vm}_function', $fields );
		
		$db->query();
		
		$_REQUEST['function_id'] = $db->last_insert_id();
		return True;

	}

	/**
	 * updates function information
	 * @author pablo, soeren
	 * 
	 * @param array $d
	 * @return boolean
	 */
	function update(&$d) {
		
		$db = new ps_DB;
		$timestamp = time();

		if (!$this->validate_update($d)) {
			return False;
		}
		if( is_array( $d[ 'function_perms' ] )) {			
			$d[ 'function_perms' ] = implode( ',', $d[ 'function_perms' ] );
		}
		$fields = array( 'function_name' => $d["function_name"],
						'function_class'=> $d["function_class"],
						'function_method' => $d["function_method"],
						'function_perms' => $d["function_perms"],
						'function_description'=> $d["function_description"] );
		$db->buildQuery( 'UPDATE', '#__{vm}_function', $fields, 'WHERE function_id='.(int)$d["function_id"] );
		$db->query();
		
		return True;
	}

	/**
	 * Delete a function, but check permissions before
	 *
	 * @param array $d
	 * @return boolean
	 */
	function delete(&$d) {
		$db = new ps_DB;

		if (!$this->validate_delete($d)) {
			return False;
		}

		$record_id = $d["function_id"];

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
		$q = "DELETE from #__{vm}_function where function_id='$record_id'";
		$db->query($q);
		return True;
	}

	/**
	 * Returns an information array about the function $func
	 *
	 * @param string $func
	 * @return mixed
	 */
	function get_function($func) {
		$db = new ps_DB;
		$result = array();

		$q = "SELECT `function_perms`, `function_class`, `function_method` 
				FROM `#__{vm}_function` 
				WHERE LOWER(`function_name`)='".strtolower($func)."'";
		
		$db->query( $q );
		
		if ($db->next_record()) {
			$result["perms"] = $db->f("function_perms");
			$result["class"] = $db->f("function_class");
			$result["method"] = $db->f("function_method");
			return $result;
		}
		else {
			return False;
		}
	}

	/**
	 * Check Function Permissions
	 * returns true if the function $func is registered
	 * and user has permission to run it
	 * Displays error if function is not registered
	 *
	 * @param string $func the function name
	 * @return mixed
	 */
	function checkFuncPermissions( $func ) {

		global $page, $perm, $VM_LANG, $vmLogger;

		if (!empty($func)) {

			$funcParams = $this->get_function($func);
			if ($funcParams) {
				if ($perm->check($funcParams["perms"])) {
					return $funcParams;
				}
				else {
					$error = $VM_LANG->_PHPSHOP_PAGE_403.'. ';
					$error .= $VM_LANG->_PHPSHOP_FUNC_NO_EXEC . $func;
					$vmLogger->err( $error );
					return false;
				}
			}
			else {
				$error = $VM_LANG->_PHPSHOP_FUNC_NOT_REG.'. ';
				$error .= $func . $VM_LANG->_PHPSHOP_FUNC_ISNO_REG ;
				$vmLogger->err( $error );
				return false;
			}
		}
		
		return true;
		
	}
}

?>