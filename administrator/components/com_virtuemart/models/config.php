<?php
/**
 * Data module for shop configuration
 *
 * @package	VirtueMart
 * @subpackage Config
 * @author Rick Glunt 
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model class for shop configuration
 *
 * @package	VirtueMart
 * @subpackage Config 
 * @author Rick Glunt  
 */
class VirtueMartModelConfig extends JModel
{    
	/** @var integer Primary key */
    var $_id;          
	/** @var objectlist Config data */
    var $_data;         
    
    
    /**
     * Constructor for the config model.
     *
     * There should only be one config record with an id = 1
     *
     * @author Rick Glunt 
     */
    function __construct()
    {
        parent::__construct();      

    	$this->setId(1);
    }
    
    
    /**
     * Resets the config id and data
     *
     * @author Rick Glunt
     */        
    function setId($id) 
    {
        $this->_id = $id;
        $this->_data = null;
    }	
    
    
    /** 
     * Retrieve the detail record if the data has not already been loaded.
     *
     * @author Rick Glunt
     */ 
	function getConfig()
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
	 * Bind the post data to the config table and save it
     *
     * @author Rick Glunt	
     * @return boolean True is the save was successful, false otherwise. 
	 */
    function store() 
	{
		$table =& $this->getTable('config');
		$data = JRequest::get('post');			

		// Bind the form fields to the config table
		if (!$table->bind($data)) {		    
			$this->setError($table->getError());
			return false;	
		}

		// Make sure the config record is valid
		if (!$table->check()) {
			$this->setError($table->getError());
			return false;	
		}
		
		// Save the config record to the database
		if (!$table->store()) {
			$this->setError($table->getError());
			return false;	
		}		
		
		return true;
	}	
}
?>