<?php

/**
 * Interfaces for VEF (Virtue Ecommerce Frame)
 * @package 	Virtue Ecommerce Framework
 * @author		Max Milbers
 * @copyright 	Copyright (C) 2015 VirtueMart Team and the authors. All rights reserved.
 * @license 	LGPL Lesser General Public License version 3, or later see LICENSE.txt
 * @version 	$Id: about.php 2641 2010-11-09 19:25:13Z milbo $
 */
 
defined ( '_JEXEC' ) or die ( 'Restricted access' );

interface vIObject {
	function getName();
	function __toString();
	function get($prop, $def = null);
	function set($prop, $value = null);
	function setProperties($props);
}

interface vIController {
	function display($cachable = false, $urlparams = array());
	function execute($task);
	function getView($name = '', $type = '', $prefix = '', $config = array());
}

interface vIView {
	function escape($output);
	function setLayout($layout);
	function getLayout();
}

interface vIDataBaseConnector {
	static function isSupported();
}

interface vIApp {
	static function getConfig();
	function isSite();
	function isAdmin();
}

interface vITable {
	function getKeyName();
	function setPrimaryKey($key, $keyForm = 0);
	function getPKey();
	function setObligatoryKeys($key);
	function setUniqueName($name);
	function setTableShortCut($prefix);
	function setOrderable($key = 'ordering', $auto = true);
	function load($oid=null,$overWriteLoadName=0,$andWhere=0,$tableJoins= array(),$joinKey = 0);
	function bind($src, $ignore = array());
	function store($updateNulls = false);
	function bindChecknStore(&$data, $preload = false);
	function move($dirn, $where = '', $orderingkey = 0);
	function delete($oid = null, $where = 0);
}

interface vITableable {
	static function addTablePath($path);
	function getTable($name = '', $prefix = 'Table', $options = array());
	function setMainTable($maintablename,$maintable=0);
}

interface vILoadable {
	static function getInstance($type, $prefix = '', $config = array(), $single = false);
	static function addIncludePath($path, $prefix = '');
}

interface vIToggler {
	function setToggleName($togglesName);
	function toggle($field,$val = NULL, $cidname = 0,$tablename = 0  );
}

interface vICacheable {
	function emptyCache();
}

interface vIStorable {

	static function getModel($name=false);
	function setId($id);
	function getId();
	function setIdName($idName);
	function getIdName();
	function setState($property, $value = null);
	function getState($property = null, $default = null);
	function getData($id = 0);
	function store(&$data);
	function remove($ids);
	function addImages($obj,$limit=0);
	function resetErrors();
}

interface vIListable {
	function exeSortSearchListQuery($object, $select, $joinedTables, $whereString = '', $groupBy = '', $orderBy = '', $filter_order_Dir = '', $nbrReturnProducts = false);
	function getPagination($perRow = 5);
	function setPaginationLimits();
	function getTotal();
	function setGetCount($withCount);
}

interface vIOrderable {
	function setDefaultValidOrderingFields($defaultTable=null);
	function addvalidOrderingFieldName($add);
	function removevalidOrderingFieldName($name);
	function getDefaultOrdering();
	function _getOrdering($preTable='');

	function saveorder($cid = array(), $order, $filter = null);
	function checkFilterOrder($toCheck);
	function checkFilterDir($toCheck);
}
