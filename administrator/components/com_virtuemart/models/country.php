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
 * @subpackage Country 
 * @author RickG  
 */
class VirtueMartModelCountry extends JModel
{    
	/** @var integer Primary key */
    var $_id;          
	/** @var objectlist Country data */
    var $_data;        
	/** @var integer Total number of countries in the database */
	var $_total;      
	/** @var pagination Pagination for country list */
	var $_pagination;    
    
    
    /**
     * Constructor for the country model.
     *
     * The country id is read and detmimined if it is an array of ids or just one single id.
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
    }
    
    
    /**
     * Resets the country id and data
     *
     * @author RickG
     */        
    function setId($id) 
    {
        $this->_id = $id;
        $this->_data = null;
    }	
    
    
	/**
	 * Loads the pagination for the country table
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
			$query = 'SELECT `country_id` FROM `#__vm_country`';	  		
			$this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }    
    
    
    /** 
     * Retrieve the detail record for the current $id if the data has not already been loaded.
     *
     * @author RickG
     */ 
	function getCountry()
	{	
		$db = JFactory::getDBO();  
     
  		if (empty($this->_data)) {
   			$this->_data = $this->getTable();
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
     * Retreive a country record given a country code.
     *
     * @author RickG     
     * @param string $code Country code to lookup
     * @return object Country object from database
     */ 
    function getCountryByCode($code)
    {
		$db = JFactory::getDBO();	
		
		$countryCodeLength = strlen($code);
		switch ($countryCodeLength) {
			case 2:
				$countryCodeFieldname = 'country_2_code';
				break;
			case 3:
				$countryCodeFieldname = 'country_3_code';
				break;
			default:
				return false;
		}			
										
		$query = 'SELECT *';
		$query .= ' FROM `#__vm_country`';
		$query .= ' WHERE `' . $countryCodeFieldname . '` = ' . (int)$code;
		$db->setQuery($query);

        return $db->loadObject();
	}
	
        
	/**
	 * Bind the post data to the country table and save it
     *
     * @author RickG	
     * @return boolean True is the save was successful, false otherwise. 
	 */
    function store() 
	{
		$table = $this->getTable('country');

		$data = JRequest::get('post');		
	
		// Bind the form fields to the country table
		if (!$table->bind($data)) {		    
			$this->setError($table->getError());
			return false;	
		}

		// Make sure the country record is valid
		if (!$table->check()) {
			$this->setError($table->getError());
			return false;	
		}
		
		// Save the country record to the database
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
	function delete() 
	{
		$countryIds = JRequest::getVar('cid',  0, '', 'array');
    	$table = $this->getTable('country');
 
    	foreach($countryIds as $countryId) {
    		if ($this->deleteCountryStates($countryId)) {
        		if (!$table->delete($countryId)) {
            		$this->setError($table->getError());
            		return false;
        		}
        	}
        	else {
        		$this->setError('Could not remove country states!');
        		return false;
        	}
    	}
 
    	return true;	
	}	
	
	
	/**
	 * Delete all state records for a given country id.
     *
     * @author RickG
     * @return boolean True is the delete was successful, false otherwise.      
     */ 	 
	function deleteCountryStates($countryId = '') 
	{
		if ($countryId) {
			$db = JFactory::getDBO();	
				
			$query = 'DELETE FROM `#__vm_state`  WHERE `country_id`= "'.$countryId.'"';
			$db->setQuery($query);
			if ($db->query()) {
				return true;
			}
			else {
				return false;
			}
		}
		else {
    		return false;
    	}	
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
		$table = $this->getTable('country');
		$countryIds = JRequest::getVar( 'cid', array(0), 'post', 'array' );				
								
        if (!$table->publish($countryIds, $publishId)) {
			$this->setError($table->getError());
			return false;        		
        }		
        
		return true;		
	}	
	
	
	/**
	 * Retireve a list of countries from the database.
	 * 
     * @author RickG	 
     * @param string $onlyPuiblished True to only retreive the publish countries, false otherwise
     * @param string $noLimit True if no record count limit is used, false otherwise
	 * @return object List of country objects
	 */
	function getCountries($onlyPublished=false, $noLimit=false)
	{		
		$query = 'SELECT * FROM `#__vm_country` ';
		if ($onlyPublished) { 
			$query .= 'WHERE `#__vm_country`.`published` = 1';			
		}
		$query .= ' ORDER BY `#__vm_country`.`country_name`';
		if ($noLimit) {
			$this->_data = $this->_getList($query);
		}
		else {
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}		

		return $this->_data;
	}
}
?>