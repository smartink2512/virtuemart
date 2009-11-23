<?php
/**
 * Data module for shop countries
 *
 * @package	VirtueMart
 * @subpackage Country
 * @author RickG 
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model class for shop countries
 *
 * @package	VirtueMart
 * @subpackage State 
 * @author RickG and Max Milbers
 */
class VirtueMartModelState extends JModel
{
	/** @var array Array of Primary keys */
    var $_cid;     
	/** @var integer Primary key */
    var $_id;      
	/** @var objectlist State data */
    var $_data;        
//	/** @var integer Total number of countries in the database */
//	var $_total;      
	/** @var pagination Pagination for state list */
	var $_pagination;    
    
    
    /**
     * Constructor for the state model.
     *
     * The state id is read and detmimined if it is an array of ids or just one single id.
     *
     * @author RickG 
     */
    function __construct()
    {
        parent::__construct();
        
		// Get the pagination request variables
		$mainframe = JFactory::getApplication() ;
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest(JRequest::getVar('option').'.limitstart', 'limitstart', 0, 'int');		
				
		// Set the state pagination variables
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);        
        
        // Get the country id or array of ids.
		$idArray = JRequest::getVar('cid',  0, '', 'array');
    	$this->setId((int)$idArray[0]);
/*	?><pre><?php print_r($this); ?></pre><?php  */

    }
    
    
    /**
     * Resets the state id and data
     *
     * @author RickG
     */        
    function setId($id) 
    {
        $this->_id = $id;
        $this->_data = null;
    }	
    
    
	/**
	 * Loads the pagination for the state table
	 *
     * @author RickG	
     * @return JPagination Pagination for the current list of countries 
	 */
    function getPagination() 
    {
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($this->_getTotal(), $this->getState('limitstart'), $this->getState('limit'));
		}
		return $this->_pagination;
	}
    
    
	/**
	 * Gets the total number of countries
	 *
     * @author RickG	 
	 * @return int Total number of countries in the database
	 */
	function _getTotal() 
	{
    	if (empty($this->_total)) {
			$query = 'SELECT `state_id` FROM `#__vm_state`';	  		
			$this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }    
    
    
    /** 
     * Retrieve the detail record for the current $id if the data has not already been loaded.
     *
     * @author RickG
     */ 
	function getState()
	{		
		$db =& JFactory::getDBO();		
					
		if (empty($this->_data)) {					
			$query = 'SELECT * ';
			$query .= 'FROM `#__vm_state` ';
			$query .= 'WHERE `state_id` = ' . (int)$this->_id;
			$db->setQuery($query);
			$this->_data = $db->loadObject();
		}
		
		if (!$this->_data) {
			$this->_data = new stdClass();
			$this->_id = 0;
			$this->_data = null;
		}

		return $this->_data;
	}    
    
    
    /**
     * Retreive a state record given a state code.
     *
     * @author RickG     
     * @param string $code State code to lookup
     * @return object State object from database
     */ 
    function &getStateByCode($code)
    {
		$db =& JFactory::getDBO();	
		
		$stateCodeLength = strlen($code);
		switch ($stateCodeLength) {
			case 2:
				$stateCodeFieldname = 'state_2_code';
				break;
			case 3:
				$stateCodeFieldname = 'state_3_code';
				break;
			default:
				return false;
		}			
										
		$query = 'SELECT *';
		$query .= ' FROM `#__vm_state`';
		$query .= ' WHERE `' . $stateCodeFieldname . '` = ' . (int)$code;
		$db->setQuery($query);

        return $db->loadObject();
	}
	
        
	/**
	 * Bind the post data to the state table and save it
     *
     * @author RickG	
     * @return boolean True is the save was successful, false otherwise. 
	 */
    function store() 
	{
		$table =& $this->getTable('state');

		$data = JRequest::get( 'post' );			
		// Bind the form fields to the state table
		if (!$table->bind($data)) {		    
			$this->setError($this->getError());
			return false;	
		}

		// Make sure the state record is valid
		if (!$table->check()) {
			$this->setError($this->getError());
			return false;	
		}
		
		// Save the state record to the database
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
	function delete() 
	{
		$stateIds = JRequest::getVar('cid',  0, '', 'array');
    	$table =& $this->getTable('state');
 
    	foreach($stateIds as $stateId) {
        	if (!$table->delete($stateId)) {
            	$this->setError($table->getError());
            	return false;
        	}
    	}
 
    	return true;	
	}

	/**
	 * Publish/Unpublish all the ids selected
     *
     * @author RickG
     * @param boolean $publishId True is the ids should be published, false otherwise.
     * @return boolean True is the delete was successful, false otherwise.      
     */ 	 
	function publish($publishId = false) 
	{
		$table =& $this->getTable('state');
		$stateIds = JRequest::getVar( 'cid', array(0), 'post', 'array' );				
								
        if (!$table->publish($stateIds, $publishId)) {
			$this->setError($table->getError());
			return false;        		
        }		
        
		return true;		
	}	
	
	
	/**
	 * Retireve a list of countries from the database.
	 * 
     * @author RickG and Max Milbers 
	 * @return object List of state objects
	 */
	function getStates($countryId)
	{	
		$query = 'SELECT * FROM `#__vm_state`  WHERE `country_id`= "'.$countryId.'"';
		$query .= 'ORDER BY `#__vm_state`.`state_id`';
		$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		return $this->_data;
	}
}
?>