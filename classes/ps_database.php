<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: ps_database.php,v 1.8 2005/11/04 15:16:48 soeren_nb Exp $
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

/***********************************************************************
Wrapper Class for Mambo's $database - Object
************************************************************************/

class ps_DB extends database {

	/** @var int   Current row in query result set */
	var $row = 0;
	/** @var stdclass	Current row record data */
	var $record = null;
	/** @var string  Error Message */
	var $error = "";
	/** @var int  Error Number */
	var $errno = "";
	/** @var string   The current sql Query    */
	var $_sql = "";
	/** @var boolean   true if next_record has already been called   */
	var $called = false;

	function ps_DB() {
		/** just a dummy contructor for now **/
	}
	/**
     * Clone an object
     *
     * @param mixed $obj
     * @return mixed copy of $obj
     */
	function _clone( $obj ) {
		return $obj;
	}

	/**
    * Sets the SQL query string for later execution.
    *
    * This function replaces a string identifier <var>$prefix</var> with the
    * string held is the <var>_table_prefix</var> class variable.
    *
    * @param string The SQL query
    */
	function setQuery( $sql ) {
		global $database;
		$vm_prefix = "{vm}";

		$this->_sql = str_replace( $vm_prefix, VM_TABLEPREFIX, $sql );
		$database->setQuery( $this->_sql );
		
	}

	/**
	* Runs query and sets up the query id for the class.
	*
	* @param string The SQL query
	*/
	function query( $q='' ) {
		global $database, $mosConfig_dbprefix, $mosConfig_debug;
		$prefix = "#__";
		$vm_prefix = "{vm}";

		if (empty($q) ) {
			if( empty($this->_sql)) {
				return 0;
			}
		}
		else {
			$this->setQuery( $q );
		}
		
		$this->row = 0;
		$this->called = false;
		$this->record = null;
		$this->record = Array(0);

		if (strtoupper(substr( $this->_sql , 0, 6 )) == "SELECT" ) {
			$this->record = $database->loadObjectList();
		}
		else {
			$database->query();
		}

	}

	/**
	 * Returns the next row in the RecordSet for the last query run.  
	 *
	 * @return boolean False if RecordSet is empty or the pointer is at the end.
	 */
	function next_record() {

		if ( empty( $this->_sql ) ) {
			$this->error = "next_record called with no query pending.";
			return false;
		}
		if ( $this->called ) {
			$this->row++;
		}
		else {
			$this->called = true;
		}

		if ($this->row < sizeof( $this->record ) ) {
			return true;
		}
		else {
			$this->row--;
			return false;
		}
	}


	/**
  *  Returns the value of the given field name for the current
  *  record in the RecordSet. 
  * f == field
  * @param string  The field name
  * @param boolean Strip slashes from the data?
  * @return string the value of the field $field_name in the recent row of the record set
  */
	function f($field_name, $stripslashes=true) {
		if (isset($this->record[$this->row]->$field_name)) {

			if($stripslashes) {
				return( stripslashes( $this->record[$this->row]->$field_name ) );
			}
			else {
				return( $this->record[$this->row]->$field_name );
			}
		}
	}

	/**
	 * Returns the value of the field name from the $vars variable
	 * if it is set, otherwise returns the value of the current
	 * record in the RecordSet.  Useful for handling forms that have
	 * been submitted with errors.  This way, fields retain the values 
	 * sent in the $vars variable (user input) instead of the database values.
	 * sf == selective field
	 * @param string  The field name
	 * @param boolean Strip slashes from the data?
	 * @return string the value of the field $field_name in the recent row of the record set
	 */
	function sf($field_name, $stripslashes=true) {
		global $vars, $default;

		if ((defined( '_VM_LOG_ERRORS' ) || isset($vars["error"])) && !empty($vars["$field_name"])) {
			if($stripslashes) {
				return  stripslashes($vars[$field_name] );
			}
			else {
				return( $vars[$field_name] );
			}
		}
		elseif (isset($this->record[$this->row]->$field_name)) {
			if($stripslashes) {
				return  stripslashes($this->record[$this->row]->$field_name );
			}
			else {
				return( $this->record[$this->row]->$field_name );
			}
		}
		elseif (isset($default[$field_name])) {
			if($stripslashes) {
				return  stripslashes($default[$field_name]);
			}
			else {
				return( $default[$field_name] );
			}
		}
	}

	/**
	* Prints the value of the given field name for the current
	* record in the RecordSet.
	* p == print
	* @param string  The field name
	* @param boolean Strip slashes from the data?
	*/
	function p($field_name, $stripslashes=true) {
		echo $this->f( $field_name, $stripslashes );
	}

	/**
  	* Prints the value of the field name from the $vars variable
  	* if it is set, otherwise prints the value of the current
  	* record in the RecordSet.  Useful for handling forms that have
  	* been submitted with errors.  This way, fields retain the values 
  	* sent in the $vars variable (user input) instead of the database
  	* values.
  	* sp == selective print
  	* @param string  The field name
  	* @param boolean Strip slashes from the data?
  	*/
	function sp($field_name, $stripslashes=true) {
		echo $this->sf( $field_name, $stripslashes);
	}

		/**
	* This global function loads the first row of a query into an object
	*
	* If an object is passed to this function, the returned row is bound to the existing elements of <var>object</var>.
	* If <var>object</var> has a value of null, then all of the returned query fields returned in the object.
	* @param string The SQL query
	* @param object The address of variable
	*/
	function loadObject( &$object ) {
		$this->query();
		if( !empty($this->record)) {
			$object = $this->record[0];
		}
	}
	
	/**
	 * Returns the number of rows in the RecordSet from a query.
	 * @return int
	 */
	function num_rows() {
		return sizeof( $this->record );
	}
	
	/**
	 * Returns the ID of the last AUTO_INCREMENT INSERT.
	 *
	 * @return int
	 */
	function last_insert_id() {
		global $database;
		return $database->insertid();
	}
	
	/**
	 * returns true when the actual row is the last record in the record set
	 * otherwise returns false
	 *
	 * @return boolean
	 */
	function is_last_record() {
		return ($this->row+1 >= $this->num_rows());
	}

	/**
	 * Set the "next_record" pointer back to the first row.
	 *
	 */
	function reset() {

		$this->row = 0;
		$this->called = false;

	}
}
?>
