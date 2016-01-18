<?php
/**
 * Basic table for VMF (VirtueMart Frame)
 * @package 	VirtueMart Frame
 * @author		Max Milbers
 * @copyright 	Copyright (C) 2015 VirtueMart Team and the authors. All rights reserved.
 * @license 	LGPL Lesser Lesser General Public License version 2, or later see LICENSE.txt
 * @version 	$Id: about.php 2641 2010-11-09 19:25:13Z milbo $
 */

if(!class_exists('vBasicModel'))
	require(VMPATH_ADMIN. DS. 'vmf' .DS. 'vbasicmodel.php');

abstract class vTable extends vBasicModel implements vITable {

	protected $_rules;
	protected $_trackAssets = false;

	protected $_tbl = '';
	protected $_tbl_key ='';
	protected $_tbl_keys = '';
	protected $_pkey = '';
	protected $_pkeyForm = '';
	protected $_obkeys = array();
	protected $_unique = false;
	protected $_unique_name = array();
	protected $_db = false;
	protected $_autoincrement = false;
	protected $_orderingKey = 'ordering';
	protected $_updateNulls = false;

	/**
	 * @param string $table
	 * @param string $key
	 * @param JDatabase $db
	 */
	function __construct($table, $key, &$db) {

		$this->_tbl = $table;
		$this->_db =& vFactory::$_db;//$db ;//= vFactory::getDbo();//& $db;
		$this->_pkey = $key;
		$this->_pkeyForm = 'cid';

		if(JVM_VERSION<3){
			$this->_tbl_key = $key;
			$this->_tbl_keys = array($key);
		} else {
			// Set the key to be an array.
			if (is_string($key)){
				$key = array($key);
			} elseif (is_object($key)){
				$key = (array) $key;
			}

			$this->_tbl_keys = $key;
			$this->_tbl_key = $key[0];

			if (count($key) == 1) {
				$this->_autoincrement = true;
			}
		}
	}

	function getName()
	{
		if (empty($this->_name))
		{
			$r = null;
			if (!preg_match('/Table(.*)/i', get_class($this), $r))
			{
				throw new Exception(vmText::_('VMF_ERROR_MODEL_GET_NAME'), 500);
			}
			$this->_name = strtolower($r[1]);
		}

		return $this->_name;
	}


	public function getKeyName($multiple = false) {

		if (count($this->_tbl_keys)) {
			if ($multiple) {
				return $this->_tbl_keys;
			} else {
				return $this->_tbl_keys[0];
			}
		} else {
			return $this->_tbl_key;
		}

	}

	public function setPrimaryKey($key, $keyForm = 0) {

		$error = vmText::sprintf('COM_VIRTUEMART_STRING_ERROR_PRIMARY_KEY', vmText::_('COM_VIRTUEMART_' . strtoupper($key)));
		$this->setObligatoryKeys('_pkey', $error);
		$this->_pkey = $key;
		$this->_pkeyForm = empty($keyForm) ? $key : $keyForm;
		$this->$key = 0;
	}

	public function getPKey(){
		return $this->_pkey;
	}

	public function getDbo() {
		//static $db = false;
		if(!$this->_db){
			$this->_db = vFactory::getDbo();
		}
		return $this->_db;
	}

	/**
	 * @return string|void
	 */
	public function getError(){
		vmTrace( get_class($this).' asks for error');
		vmdebug( get_class($this).' asks for error');
		return ;
	}

	public function getErrors(){
		vmTrace( get_class($this).' asks for errors');
		vmdebug( get_class($this).' asks for errors');
		return ;
	}


	public function setObligatoryKeys($key) {

		$this->_obkeys[$key] = 1;
	}

	public function setUniqueName($name) {
		$this->_unique = true;
		$this->_obkeys[$name] = 1;
		$this->_unique_name[$name] = 1;
	}

	var $_tablePreFix = '';

	function setTableShortCut($prefix) {

		$this->_tablePreFix = $prefix . '.';
	}

	function setOrderable($key = 'ordering', $auto = true) {

		$this->_orderingKey = $key;
		$this->_orderable = 1;
		$this->_autoOrdering = $auto;
		$this->$key = 0;
	}

	/**
	 * Method to bind an associative array or object to the JTable instance.This
	 * method only binds properties that are publicly accessible and optionally
	 * takes an array of properties to ignore when binding.
	 *
	 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
	 * @param   mixed  $src     An associative array or object to bind to the JTable instance.
	 * @param   mixed  $ignore  An optional array or space separated list of properties to ignore while binding.
	 *
	 * @return  boolean  True on success.
	 *
	 * @link    http://docs.joomla.org/JTable/bind
	 * @since   11.1
	 */
	public function bind($src, $ignore = array())
	{
		// If the source value is not an array or object return false.
		if (!is_object($src) && !is_array($src))
		{
			$e = new Exception(vmText::sprintf('JLIB_DATABASE_ERROR_BIND_FAILED_INVALID_SOURCE_ARGUMENT', get_class($this)));
			vmError($e);
			return false;
		}

		// If the source value is an object, get its accessible properties.
		if (is_object($src))
		{
			$src = get_object_vars($src);
		}

		// If the ignore value is a string, explode it over spaces.
		if (!is_array($ignore))
		{
			$ignore = explode(' ', $ignore);
		}

		// Bind the source value, excluding the ignored fields.
		foreach ($this->getProperties() as $k => $v)
		{
			// Only process fields not in the ignore array.
			if (!in_array($k, $ignore))
			{
				if (isset($src[$k]))
				{
					$this->$k = $src[$k];
				}
			}
		}

		return true;
	}

	function bindChecknStore(&$data, $preload = false) {

		$tblKey = $this->_tbl_key;

		$ok = true;
		$msg = '';

		if (!$this->bind($data)) {
			$ok = false;
			$msg = 'bind';
			vmdebug('Problem in bind ' . get_class($this) . ' ');
		}

		if ($ok) {
			if (!$this->store($this->_updateNulls)) {
				$ok = false;
				$msg .= ' store';
				vmdebug('Problem in store ' . get_class($this) . ' ' . $this->_db->getErrorMsg());
				return false;
			}
		}

		if (is_object($data)) {
			$data->$tblKey = !empty($this->$tblKey) ? $this->$tblKey : 0;
		} else {
			$data[$tblKey] = !empty($this->$tblKey) ? $this->$tblKey : 0;
		}

		// 		vmdebug('bindChecknStore '.get_class($this).' '.$this->_db->getErrorMsg());
		//This should return $ok and not the data, because it is already updated due use of reference
		return $data;
	}

	function checkDataContainsTableFields($from, $ignore = array()) {

		if (empty($from))
			return false;
		$fromArray = is_array($from);
		$fromObject = is_object($from);

		if (!$fromArray && !$fromObject) {
			vmError(get_class($this) . '::check if data contains table fields failed. Invalid from argument <pre>' . print_r($from, 1) . '</pre>');
			return false;
		}
		if (!is_array($ignore)) {
			$ignore = explode(' ', $ignore);
		}
		$properties = $this->getProperties();
		foreach ($properties as $k => $v) {
			// internal attributes of an object are ignored
			if (!in_array($k, $ignore)) {

				if ($fromArray && isset($from[$k])) {
					return true;
				} else if ($fromObject && isset($from->$k)) {
					return true;
				}
			}
		}
		vmdebug('VmTable developer notice, table ' . get_class($this) . ' means that there is no data to store. When you experience that something does not get stored as expected, please write in the forum.virtuemart.net',$properties);
		return false;
	}

	function delete($oid = null, $where = 0) {

		$k = $this->_tbl_key;

		if ($oid) {
			$this->$k = intval($oid);
		}

		$mainTableError = $this->checkAndDelete($this->_tbl, $where);

		if ($this->_translatable) {

			$langs = VmConfig::get('active_languages', array());
			if (!$langs) $langs[] = VmConfig::$vmlang;
			if (!class_exists('VmTableData')) require(VMPATH_ADMIN . DS . 'helpers' . DS . 'vmtabledata.php');
			foreach ($langs as $lang) {
				$lang = strtolower(strtr($lang, '-', '_'));
				$langError = $this->checkAndDelete($this->_tbl . '_' . $lang);
				$mainTableError = min($mainTableError, $langError);
			}
		}

		return $mainTableError;
	}

	function checkAndDelete($table, $whereField = 0, $andWhere = '') {

		$ok = 1;
		$k = $this->_tbl_key;

		if ($whereField !== 0) {
			$whereKey = $whereField;
		} else {
			$whereKey = $this->_pkey;
		}

		$query = 'SELECT `' . $this->_tbl_key . '` FROM `' . $table . '` WHERE `' . $whereKey . '` = "' . $this->$k . '" '.$andWhere;
		$this->_db->setQuery($query);
		// 		vmdebug('checkAndDelete',$query);
		$list = $this->_db->loadColumn();
		// 		vmdebug('checkAndDelete',$list);


		if ($list) {

			foreach ($list as $row) {
				$ok = $row;
				$query = 'DELETE FROM `' . $table . '` WHERE ' . $this->_tbl_key . ' = "' . $row . '"';
				$this->_db->setQuery($query);

				if (!$this->_db->execute()) {
					vmError($this->_db->getErrorMsg());
					vmError('checkAndDelete ' . $this->_db->getErrorMsg());
					$ok = 0;
				}
			}

		}
		return $ok;
	}

}