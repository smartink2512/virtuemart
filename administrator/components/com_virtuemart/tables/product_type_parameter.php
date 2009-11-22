<?php
/**
* Virtuemart Product Type Parameter table
*
* @package Virtuemart
* @author RolandD
* @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
*/

/* No direct access */
defined('_JEXEC') or die('Restricted access');

/**
* @package Virtuemart
 */
class TableProduct_type_parameter extends JTable {
	
	/** @var int Primary key */
	var $product_type_id = 0;
	/** @var string Parameter name */
	var $parameter_name = null;
	/** @var string Product type parameter database name */
	var $parameter_label = null;	
	/** @var string Description */
	var $parameter_description = null;
	/** @var int The order to list the product types in */
	var $parameter_list_order = null;
	/** @var string Type of parameter */
	var $parameter_type = null;
	/** @var string Values for the parameter */
	var $parameter_values = null;
	/** @var string If parameter is multiselect */
	var $parameter_multiselect = null;
	/** @var string Parameter default value */
	var $parameter_default = null;
	/** @var string Unit for parameter */
	var $parameter_unit = null;
	
	
	/**
	* @param database A database connector object
	 */
	function __construct($db) {
		parent::__construct('#__vm_product_type_parameter', 'product_type_id', $db );
	}
	
	/**
	* Store a product type parameter
	* @author RolandD
	*/
	public function store() {
		$mainframe = Jfactory::getApplication();
		$db = JFactory::getDBO();
		
		/* Update or Insert? */
		$insert = $this->check();
		if ($insert) $q = 'INSERT INTO #__vm_product_type_parameter VALUES (';
		else $q = 'UPDATE #__vm_product_type_parameter SET ';
		
		foreach ($this as $name => $value) {
			if (substr($name, 0, 1) != '_') {
				if ($insert) $q .= $db->Quote($value).',';
				else $q .= $db->nameQuote($name).'='.$db->Quote($value).',';
			}
		}
		
		if ($insert) $q = substr($q, 0, -1).')';
		else $q = substr($q, 0, -1).' WHERE product_type_id = '.$this->product_type_id." AND parameter_name = ".$db->Quote($this->parameter_name);
		
		/* Update the database */
		$db->setQuery($q);
		$mainframe->enqueueMessage(__FILE__.__LINE__.$db->getQuery());
		return ($db->query());
	}
	
	/**
	* Check if the parameter exists or not
	* @author RolandD
	*/
	public function check() {
		$db = JFactory::getDBO();
		$q = "SELECT COUNT(*) AS total FROM #__vm_product_type_parameter WHERE product_type_id = ".$this->product_type_id." AND parameter_name = ".$db->Quote($this->parameter_name);
		$db->setQuery($q);
		
		$count = $db->loadResult();
		if ($count > 0) return false;
		else return true;
	}
}
?>
