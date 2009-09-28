<?php
/**
* @package VirtueMart
* @subpackage Manufacturer
* @license		GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model for VirtueMart Products
 *
 * @package VirtueMart
 * @subpackage Manufacturer
 * @author RolandD
 * @todo Replace getOrderUp and getOrderDown with JTable move function. This requires the virtuemart_product_category_xref table to replace the product_list with the ordering column
 */
class VirtueMartModelManufacturer extends JModel {
    
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
    		$filter = '';
            if (JRequest::getInt('manufacturer_id', 0) > 0) $filter .= ' WHERE #__vm_manufacturer.`manufacturer_id` = '.JRequest::getInt('manufacturer_id');
			$q = "SELECT COUNT(*) 
				FROM #__vm_manufacturer ".
				$filter;
			$db->setQuery($q);
			$this->_total = $db->loadResult();
        }
        
        return $this->_total;
    }
	
    /**
     * Load a single manufacturer
     */
     public function getManufacturer() {
     	 
     	 $row = $this->getTable();
     	 $row->load(JRequest::getInt('manufacturer_id', 0));
     	 return $row;
     }
    
    /**
     * Select the products to list on the product list page
     */
    public function getManufacturerList() {
     	$db = JFactory::getDBO();
     	/* Pagination */
     	$this->getPagination();
     	
     	/* Build the query */
     	$q = "SELECT 
			";
     	$db->setQuery($q, $this->_pagination->limitstart, $this->_pagination->limit);
     	return $db->loadObjectList('product_id');
    }
    
    /**
     * Returns a dropdown menu with manufacturers
     * @author RolandD
     */
    public function getManufacturerDropdown($manufacturer) {
    	$db = JFactory::getDBO();
    	$q = "SELECT manufacturer_id AS value, mf_name AS text
    		FROM #__vm_manufacturer";
    	$db->setQuery($q);
    	$manufacturers = $db->loadObjectList();
    	return JHTML::_('select.genericlist', $manufacturers, 'manufacturer_id', 'class="inputbox"', 'value', 'text', $manufacturer);
    }
    
    /*
     * Set the publish/unpublish state
     */
    public function getPublish() {
     	$cid = JRequest::getVar('cid', false);
     	if (is_array($cid)) {
     		$db = JFactory::getDBO();
     		$cids = implode( ',', $cid );
			if (JRequest::getVar('task') == 'publish') $state =  'Y'; else $state = 'N';
			$q = "UPDATE #__vm_manufacturer 
				SET product_publish = ".$db->Quote($state)." 
				WHERE product_id IN (".$cids.")";
			$db->setQuery($q);
			if ($db->query()) return true;
			else return false;
		}
    }
}
?>