<?php
/**
 * Data module for shop credit cards
 *
 * @package	VirtueMart
 * @subpackage CreditCard
 * @author Rick Glunt 
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model class for shop credit cards
 *
 * @package	VirtueMart
 * @subpackage CreditCard 
 * @author Rick Glunt  
 */
class VirtueMartModelCreditcard extends JModel
{    
	/** @var integer Primary key */
    var $_id;          
	/** @var objectlist Credit card data */
    var $_data;        
	/** @var integer Total number of credit cards in the database */
	var $_total;      
	/** @var pagination Pagination for credit card list */
	var $_pagination;    
    
    
    /**
     * Constructor for the credit card model.
     *
     * The credit card id is read and detmimined if it is an array of ids or just one single id.
     *
     * @author Rick Glunt 
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
        
        // Get the credit card id or array of ids.
		$idArray = JRequest::getVar('cid',  0, '', 'array');
    	$this->setId((int)$idArray[0]);
    }
    
    
    /**
     * Resets the credit card id and data
     *
     * @author Rick Glunt
     */        
    function setId($id) 
    {
        $this->_id = $id;
        $this->_data = null;
    }	
    
    
	/**
	 * Loads the pagination for the credit card table
	 *
     * @author Rick Glunt	
     * @return JPagination Pagination for the current list of credit cards 
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
	 * Gets the total number of credit cards
	 *
     * @author Rick Glunt	 
	 * @return int Total number of credit cards in the database
	 */
	function _getTotal() 
	{
    	if (empty($this->_total)) {
			$query = 'SELECT `creditcard_id` FROM `#__vm_creditcard`';	  		
			$this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }    
    
    
    /** 
     * Retrieve the detail record for the current $id if the data has not already been loaded.
     *
     * @author Rick Glunt
     */ 
	function getCreditCard()
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
	 * Bind the post data to the credit card table and save it
     *
     * @author Rick Glunt	
     * @return boolean True is the save was successful, false otherwise. 
	 */
    function store() 
	{
		$table =& $this->getTable('creditcard');

		$data = JRequest::get( 'post' );			
		// Bind the form fields to the credit card table
		if (!$table->bind($data)) {		    
			$this->setError($table->getError());
			return false;	
		}

		// Make sure the credit card record is valid
		if (!$table->check()) {
			$this->setError($table->getError());
			return false;	
		}
		
		// Save the credit card record to the database
		if (!$table->store()) {
			$this->setError($table->getError());
			return false;	
		}		
		
		return true;
	}	


	/**
	 * Delete all record ids selected
     *
     * @author Rick Glunt
     * @return boolean True is the delete was successful, false otherwise.      
     */ 	 
	function delete() 
	{
		$creditcardIds = JRequest::getVar('cid',  0, '', 'array');
    	$table =& $this->getTable('creditcard');
 
    	foreach($creditcardIds as $creditcardId) {
        	if (!$table->delete($creditcardId)) {
            	$this->setError($table->getError());
            	return false;
        	}
    	}
 
    	return true;	
	}	
	
	
	/**
	 * Retireve a list of credit cards from the database.
	 * 
     * @author Rick Glunt	 
	 * @return object List of credit card objects
	 */
	function getCreditCards()
	{		
		$query = 'SELECT * FROM `#__vm_creditcard` ';
		$query .= 'ORDER BY `#__vm_creditcard`.`creditcard_id`';
		$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		return $this->_data;
	}
}
?>