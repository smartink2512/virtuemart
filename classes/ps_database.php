<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: ps_database.php,v 1.5 2005/10/28 09:35:36 soeren_nb Exp $
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
     * @param ps_DB $obj
     * @return ps_DB copy of $obj
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
    * @param string The common table prefix
    */
	function setQuery( $sql ) {
		global $database;
		$vm_prefix = "{vm}";

		$this->_sql = str_replace( $vm_prefix, VM_TABLEPREFIX, $sql );
		$database->_sql = $this->replacePrefixAndSetQuery( $this->_sql );
	}

	/**
    * This function replaces a string identifier <var>$prefix</var> with the
    * string held is the <var>_table_prefix</var> class variable.
    * @author http://forum.mamboserver.com/showthread.php?t=45647
    * @param string The SQL query
    * @param string The common table prefix
    */
	function replacePrefixAndSetQuery( $sql, $prefix='#__' ) {
		global $database;
		$sql = trim( $sql );

		$escaped = false;
		$quoteChar = '';

		$n = strlen( $sql );

		$startPos = 0;
		$literal = '';
		while ($startPos < $n)
		{
			$ip = strpos($sql, $prefix, $startPos);
			if ($ip === false)
			break;

			$j = strpos($sql, "'", $startPos);
			$k = strpos($sql, '"', $startPos);
			if (($k !== FALSE) && (($k < $j) || ($j === FALSE))) {
				$quoteChar    = '"';
				$j            = $k;
			} else {
				$quoteChar    = "'";
			}

			if ($j === false)
			$j = $n;

			$literal .= str_replace($prefix, $database->_table_prefix, substr($sql, $startPos, $j - $startPos));
			$startPos = $j;

			$j = $startPos + 1;

			if ($j >= $n)
			break;

			// quote comes first, find end of quote
			while(TRUE) {
				$k = strpos($sql, $quoteChar, $j);
				$escaped = false;
				if ($k === false)
				break;
				$l = $k - 1;
				while ($l >= 0 && $sql{$l} == '\\')
				{
					$l--;
					$escaped = !$escaped;
				}
				if ($escaped) {
					$j    = $k+1;
					continue;
				}
				break;
			}
			if ($k === FALSE) {
				// error in the query - no end quote; ignore it
				break;
			}
			$literal .= substr($sql, $startPos, $k - $startPos + 1);
			$startPos = $k+1;
		}
		if ($startPos < $n)
		$literal .= substr($sql, $startPos, $n - $startPos);
		return $literal;
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

		if (empty($q)) {
			if (empty($this->_sql))
			return 0;
		}

		else {
			$this->_sql = str_replace( $vm_prefix, VM_TABLEPREFIX, $q );
			$database->setQuery( $this->_sql );
		}
		$database->_sql = str_replace( '_pshop_', VM_TABLEPREFIX, $database->_sql );
		$this->row = 0;
		$this->called = false;
		$this->record = null;
		$this->record = Array(0);

		if (strtoupper(substr( $this->_sql , 0, 6 )) == "SELECT" ) {
			$this->record = $database->loadObjectList();
		}
		else
		$database->query();

	}

	/**
  * Returns the next row in the RecordSet for the last query run.  
  * Returns False if RecordSet is empty or at the end.
  */
	function next_record() {

		if ( empty( $this->_sql ) ) {
			$this->error = "next_record called with no query pending.";
			return false;
		}
		if ( $this->called )
		$this->row++;
		else
		$this->called = true;

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
  */
	function f($field_name, $stripslashes=true) {
		if (isset($this->record[$this->row]->$field_name)) {

			if($stripslashes)
			return( stripslashes( $this->record[$this->row]->$field_name ) );
			else
			return( $this->record[$this->row]->$field_name );
		}
	}

	/**
  * Returns the value of the field name from the $vars variable
       if it is set, otherwise returns the value of the current
		  record in the RecordSet.  Useful for handling forms that have
		  been submitted with errors.  This way, fields retain the values 
		  sent in the $vars variable (user input) instead of the database
		  values.
      sf == selective field
  * @param string  The field name
  */
	function sf($field_name, $stripslashes=true) {
		global $vars, $default;

		if (isset($vars["error"]) && !empty($vars["$field_name"])) {
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
  */
	function p($field_name, $stripslashes=true) {
		if (isset($this->record[$this->row]->$field_name))
		if( $stripslashes )
		print  stripslashes($this->record[$this->row]->$field_name );
		else
		print  $this->record[$this->row]->$field_name;
	}

	/**
  * Prints the value of the field name from the $vars variable
      if it is set, otherwise prints the value of the current
		  record in the RecordSet.  Useful for handling forms that have
		  been submitted with errors.  This way, fields retain the values 
		  sent in the $vars variable (user input) instead of the database
		  values.
      sp == selective print
  * @param string  The field name
  */
	function sp($field_name, $stripslashes=true) {
		global $vars, $default;

		if (isset($vars["error"]) && !empty($vars["$field_name"])) {
			if( $stripslashes )
			print  stripslashes($vars["$field_name"] );
			else
			print  $vars["$field_name"];
		}
		elseif (isset($default["$field_name"])) {
			if( $stripslashes )
			print  stripslashes($default["$field_name"] );
			else
			print $default["$field_name"];
		}
		elseif (isset($this->record[$this->row]->$field_name)) {
			if( $stripslashes )
			print  stripslashes($this->record[$this->row]->$field_name );
			else
			print  $this->record[$this->row]->$field_name;
		}
		else print "";
	}

	/**
  * Returns the number of rows in the RecordSet from a query.
  * 
  */
	function num_rows() {

		return sizeof( $this->record );
	}
	/**
  * Returns the ID of the last AUTO_INCREMENT INSERT.
  * 
  */
	function last_insert_id() {
		global $database;
		return $database->insertid();
	}
	/**
  * boolean is_last_record
  * returns true when the actual row is the last record in the record set
  * otherwise returns false
  * 
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
