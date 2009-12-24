<?php
/**
 * Manufacturer Category table
 *
 * @package	VirtueMart
 * @subpackage ManufacturerCategory
 * @author RickG
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * Manufacturer Category table class
 * The class is is used to manage the manufaturer categories in the shop.
 *
 * @author RickG
 * @package	VirtueMart
 */
class TableManufacturer_Category extends JTable {
    /** @var int Primary key */
    var $mf_category_id			= 0;
    /** @var string Shipping Carrier name*/
    var $mf_category_name      	= '';
    /** @var string Shipping Carrier code */
    var $mf_category_desc    = '';


    /**
     * @author RickG
     * @param $db A database connector object
     */
    function __construct(&$db) {
	parent::__construct('#__vm_manufacturer_category', 'mf_category_id', $db);
    }


    /**
     * Validates the record fields.
     *
     * @author RickG
     * @return boolean True if the table buffer is contains valid data, false otherwise.
     */
    function check() {
	if (!$this->mf_category_name) {
	    $this->setError(JText::_('Categories records must contain a categories name.'));
	    return false;
	}

	if (($this->mf_category_name) && ($this->mf_category_id == 0)) {
	    $db =& JFactory::getDBO();

	    $q = 'SELECT count(*) FROM `#__vm_manufacturer_category` ';
	    $q .= 'WHERE `mf_category_name`="' .  $this->mf_category_name . '"';
	    $db->setQuery($q);
	    $rowCount = $db->loadResult();
	    if ($rowCount > 0) {
		$this->setError(JText::_('The given category name already exists.'));
		return false;
	    }
	}

	return true;
    }

}
?>
