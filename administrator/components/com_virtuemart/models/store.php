<?php
/**
 * Data module for vendro stores
 *
 * @package	VirtueMart
 * @subpackage Store
 * @author RickG
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model class for vendor stores
 *
 * @package	VirtueMart
 * @subpackage Vendor
 * @author RickG
 */
class VirtueMartModelStore extends JModel {
    /** @var integer Primary key (vendor_id) */
    var $_id;
    /** @var objectlist store data */
    var $_data;
    /** @var integer Total number of stores in the database */
    var $_total;
    /** @var pagination Pagination for store list */
    var $_pagination;


    /**
     * Constructor for the store model.
     *
     * The vendor id is read and detmimined if it is an array of ids or just one single id.
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

	// Get the store id or array of ids.
	$idArray = JRequest::getVar('cid',  0, '', 'array');
	$this->setId((int)$idArray[0]);
    }


    /**
     * Resets the vendor id and data
     *
     * @author RickG
     */
    function setId($id) {
	$this->_id = $id;
	$this->_data = null;
    }


    /**
     * Loads the pagination for the store table
     *
     * @author RickG
     * @return JPagination Pagination for the current list of stores
     */
    function getPagination() {
	if (empty($this->_pagination)) {
	    jimport('joomla.html.pagination');
	    $this->_pagination = new JPagination($this->_getTotal(), $this->getState('limitstart'), $this->getState('limit'));
	}
	return $this->_pagination;
    }


    /**
     * Gets the total number of stores
     *
     * @author RickG
     * @return int Total number of stores in the database
     */
    function _getTotal() {
	if (empty($this->_total)) {
	    $query = 'SELECT `vendor_id` FROM `#__vm_vendor`';
	    $this->_total = $this->_getListCount($query);
	}
	return $this->_total;
    }


    /**
     * Returns the total number of stores
     *
     * @author RickG
     * @return int Total number of store in the database
     */
    function getTotalNbrOfStores() {
	$this->_getTotal();
	return $this->_total;
    }


    /**
     * Returns id of the first store in the database if there is only one store
     *
     * @author RickG
     * @return int 0 if there are more than 1 store, vendor_id if only one store exists
     */
    function getIdOfOnlyStore() {
	if ($this->_total == 1) {
	    $db = JFactory::getDBO();
	    $query = 'SELECT `vendor_id` FROM `#__vm_vendor`';
	    $db->setQuery($query);
	    return $db->loadResult();
	}
	else {
	    return 0;
	}
    }


    /**
     * Retrieve the detail record for the current $id if the data has not already been loaded.
     *
     * Vendor information and user information are combined into the
     * _data variable to pose as a store.
     *
     * @author RickG
     */
    function getStore() {
	if (empty($this->_data)) {
	    $this->_data = $this->getTable('vendor');
	    $this->_data->load((int)$this->_id);
	    $sqlUserVendor = "SELECT user_id FROM #__vm_auth_user_vendor
  		WHERE vendor_id = ". $this->_db->Quote((int)$this->_id) ."";

	    $this->_db->setQuery($sqlUserVendor);
	    $userVendor = $this->_db->loadObject();

	    $userVendor->user_id = (isset($userVendor->user_id) ? $userVendor->user_id : 0);

	    $this->_data->userInfo = $this->getTable('user_info');
	    $this->_data->userInfo->load((int)$userVendor->user_id);
	}

	if (!$this->_data) {
	    $this->_data = new stdClass();
	    $this->_id = 0;
	    $this->_data = null;
	}
	
	return $this->_data;
    }


    /**
     * Bind the post data to the credit card table and save it
     *
     * @author RickG
     * @return boolean True is the save was successful, false otherwise.
     */
    function store() {
	$table = $this->getTable('vendor');

	$data = JRequest::get( 'post' );
	// Bind the form fields to the vendor table
	if (!$table->bind($data)) {
	    $this->setError($this->getError());
	    return false;
	}

	// Make sure the vendor record is valid
	if (!$table->check()) {
	    $this->setError($this->getError());
	    return false;
	}

	// Save the vendor to the database
	if (!$table->store()) {
	    $this->setError($this->getError());
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
	$creditcardIds = JRequest::getVar('cid',  0, '', 'array');
	$table = $this->getTable('vendor');

	foreach($vendorIds as $vendorId) {
	    if (!$table->delete($vendorId)) {
		$this->setError($table->getError());
		return false;
	    }
	}

	return true;
    }


    /**
     * Retireve a list of stores from the database.
     *
     * @author RickG
     * @return object List of store objects
     */
    function getStores() {
	$query = 'SELECT * FROM `#__vm_vendor` ';
	$query .= 'ORDER BY `#__vm_vendor`.`vendor_id`';
	$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
	return $this->_data;
    }
}
?>