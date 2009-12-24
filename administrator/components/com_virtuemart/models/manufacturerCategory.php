<?php
/**
 * Data module for manufacturer categories
 *
 * @package	VirtueMart
 * @subpackage ManufacturerCategory
 * @author RickG
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model class for categories
 *
 * @package	VirtueMart
 * @subpackage ManufacturerCategory
 * @author RickG
 */
class VirtueMartModelManufacturerCategory extends JModel {
    /** @var integer Primary key */
    var $_id;
    /** @var objectlist category data */
    var $_data;
    /** @var integer Total number of categories in the database */
    var $_total;
    /** @var pagination Pagination for category list */
    var $_pagination;


    /**
     * Constructor for the model.
     *
     * The category id is read and detmimined if it is an array of ids or just one single id.
     *
     * @author RickG
     */
    function __construct() {
	parent::__construct();

	// Get the pagination request variables
	$mainframe = JFactory::getApplication() ;
	$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
	$limitstart = $mainframe->getUserStateFromRequest(JRequest::getVar('option').'.limitstart', 'limitstart', 0, 'int');

	// Set the state pagination variables
	$this->setState('limit', $limit);
	$this->setState('limitstart', $limitstart);

	// Get the category id or array of ids.
	$idArray = JRequest::getVar('cid',  0, '', 'array');
	$this->setId((int)$idArray[0]);
    }


    /**
     * Resets the category id and data
     *
     * @author RickG
     */
    function setId($id) {
	$this->_id = $id;
	$this->_data = null;
    }


    /**
     * Loads the pagination for the categories table
     *
     * @author RickG
     * @return JPagination Pagination for the current list of categories
     */
    function getPagination() {
	if (empty($this->_pagination)) {
	    jimport('joomla.html.pagination');
	    $this->_pagination = new JPagination($this->_getTotal(), $this->getState('limitstart'), $this->getState('limit'));
	}
	return $this->_pagination;
    }


    /**
     * Gets the total number of categories
     *
     * @author RickG
     * @return int Total number of shipping carriers in the database
     */
    function _getTotal() {
	if (empty($this->_total)) {
	    $query = 'SELECT `mf_category_id` FROM `#__vm_manufacturer_category`';
	    $this->_total = $this->_getListCount($query);
	}
	return $this->_total;
    }


    /**
     * Retrieve the detail record for the current $id if the data has not already been loaded.
     *
     * @author RickG
     */
    function getManufacturerCategory() {
	$db = JFactory::getDBO();

	if (empty($this->_data)) {
	    $this->_data = $this->getTable('manufacturer_category');
	    $this->_data->load((int)$this->_id);
	}

	if (!$this->_data) {
	    $this->_data = new stdClass();
	    $this->_id = 0;
	    $this->_data = null;
	}

	return $this->_data;
    }


    /**
     * Bind the post data to the table and save it
     *
     * @author RickG
     * @return boolean True is the save was successful, false otherwise.
     */
    function store() {
	$table = $this->getTable('manufacturer_category');

	$data = JRequest::get( 'post' );
	// Bind the form fields to the table
	if (!$table->bind($data)) {
	    $this->setError($table->getError());
	    return false;
	}

	// Make sure the record is valid
	if (!$table->check()) {
	    $this->setError($table->getError());
	    return false;
	}

	// Save the record to the database
	if (!$table->store()) {
	    $this->setError($table->getError());
	    return false;
	}

	return true;
    }


    /**
     * Delete all record ids selected
     *
     * @author RickG
     * @return boolean True is the delete was successful, false otherwise.
     */
    function delete() {
	$ManufacturerCategoryIds = JRequest::getVar('cid',  0, '', 'array');
	$table = $this->getTable('manufacturer_category');

	foreach($ManufacturerCategoryIds as $ManufacturerCategoryId) {
		if (!$table->delete($ManufacturerCategoryId)) {
		    $this->setError($table->getError());
		    return false;
		}
	}

	return true;
    }


    /**
     * Retireve a list of manufactureer categories from the database.
     *
     * @author RickG
     * @return object List of objects
     */
    function getManufacturerCategories() {
	$query = 'SELECT * FROM `#__vm_manufacturer_category` ';
	$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
	return $this->_data;
    }
}
?>