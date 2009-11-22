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
}
?>
