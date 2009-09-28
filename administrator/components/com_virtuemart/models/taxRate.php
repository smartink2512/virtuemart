<?php
/**
* @package JMart
* @subpackage Tax
* @license GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model for JMart Products
 *
 * @package JMart
 * @subpackage Tax
 * @author RolandD
 */
class JMartModelTaxRate extends JModel {
    
	var $_total;
	var $_pagination;
	
	function __construct() {
		parent::__construct();
		
		// Get the pagination request variables
		$mainframe = JFactory::getApplication() ;
		$limit = $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart = $mainframe->getUserStateFromRequest( JRequest::getVar('option').'.limitstart', 'limitstart', 0, 'int' );
		
		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}  
	
	/**
	 * Loads the pagination
	 */
    public function getPagination() {
		if ($this->_pagination == null) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_pagination;
	}
    
	/**
	 * Gets the total number of products
	 */
	private function getTotal() {
    	if (empty($this->_total)) {
    		$db = JFactory::getDBO();
			$q = "SELECT COUNT(*) FROM #__jmart_tax_rate";
			$db->setQuery($q);
			$this->_total = $db->loadResult();
        }
        
        return $this->_total;
    }
	
    /**
     * Select the products to list on the product list page
     */
    public function getTaxRatesList() {
     	$db = JFactory::getDBO();
     	/* Pagination */
     	$this->getPagination();
     	
     	/* Build the query */
     	$q = "SELECT *
     		FROM #__jmart_tax_rate";
     	$db->setQuery($q, $this->_pagination->limitstart, $this->_pagination->limit);
     	return $db->loadObjectList('tax_rate_id');
    }
    
    /**
     * Select the products to list on the product list page
     */
    public function getTaxRates() {
     	$db = JFactory::getDBO();
     	
     	/* Build the query */
     	$q = "SELECT tax_rate_id, vendor_id, tax_state, tax_country, mdate, CONCAT((tax_rate*100), '%') AS tax_rate
     		FROM #__jmart_tax_rate";
     	$db->setQuery($q);
     	return $db->loadObjectList();
    }
}
?>