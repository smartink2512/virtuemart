<?php
/**
* @package VirtueMart
* @subpackage Tax
* @license GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model for VirtueMart Products
 *
 * @package VirtueMart
 * @subpackage Tax
 * @author RolandD, RickG
 */
class VirtueMartModelTaxRate extends JModel {
	/** @var integer Primary key */
    var $_id;          
	/** @var objectlist currency data */
    var $_data;        
	/** @var integer Total number of tax rates in the database */
	var $_total;      
	/** @var pagination Pagination for tax rate list */
	var $_pagination;    
    
	
	/**
     * Constructor for the tax rate model.
     *
     * The tax rate id is read and detmimined if it is an array of ids or just one single id.
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
        
        // Get the currency id or array of ids.
		$idArray = JRequest::getVar('cid',  0, '', 'array');
    	$this->setId((int)$idArray[0]);
    }
 
     
    /**
     * Resets the tax rate id and data
     *
     * @author Rick Glunt
     */        
    function setId($id) 
    {
        $this->_id = $id;
        $this->_data = null;
    }	
    
    
	/**
	 * Loads the pagination for the tax rate table
	 *
     * @author Rick Glunt	
     * @return JPagination Pagination for the current list of tax rates 
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
	 * Gets the total number of tax rates
	 *
     * @author Rick Glunt	 
	 * @return int Total number of tax rates in the database
	 */
	function _getTotal() 
	{
    	if (empty($this->_total)) {
			$query = 'SELECT `tax_rate_id` FROM `#__vm_tax_rate`';	  		
			$this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }    
    
    
    /** 
     * Retrieve the detail record for the current $id if the data has not already been loaded.
     *
     * @author Rick Glunt
     */ 
	function getTaxRate()
	{		
		$db = JFactory::getDBO();  
     
  		if (empty($this->_data)) {
   			$this->_data = $this->getTable('tax_rate');
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
	 * Bind the post data to the tax rate table and save it
     *
     * @author Rick Glunt	
     * @return boolean True is the save was successful, false otherwise. 
	 */
    function store() 
	{
		$table =& $this->getTable('tax_rate');

		$data = JRequest::get( 'post' );		
		// Bind the form fields to the tax rate table
		if (!$table->bind($data)) {		    
			$this->setError($table->getError());
			return false;	
		}

		// Make sure the tax rate record is valid
		if (!$table->check()) {
			$this->setError($table->getError());
			return false;	
		}
		
		// Save the tax rate record to the database
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
		$currencyIds = JRequest::getVar('cid',  0, '', 'array');
    	$table =& $this->getTable('currency');
 
    	foreach($currencyIds as $currencyId) {
        	if (!$table->delete($currencyId)) {
            	$this->setError($table->getError());
            	return false;
        	}
    	}
 
    	return true;	
	}		
	
	
	/**
	 * Retireve a list of tax rates from the database.
	 * 
     * @author RolandD, RickG	 
	 * @return object List of tax rates objects
	 */
	function getTaxRates() {
		$db = JFactory::getDBO();
		$query = 'SELECT *, ';
		$query .= 'CONCAT("(", `#__vm_tax_rate`.`tax_rate_id`, ") ", FORMAT(`#__vm_tax_rate`.`tax_rate`*100, 2)) AS select_list_name ';
		$query .= 'FROM `#__vm_tax_rate`';

		$db->setQuery($query);
		return $db->loadObjectList();
	}
}
?>