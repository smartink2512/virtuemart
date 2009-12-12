<?php
/**
* @package		VirtueMart
* @license		GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model for VirtueMart Products
 *
 * @package VirtueMart
 * @author RolandD
 */
class VirtueMartModelOrders extends JModel {
    
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
    		
			$q = "SELECT #__vm_orders.`order_id` ".$this->getOrdersListQuery().$this->getOrdersListFilter();
			$db->setQuery($q);
			$fields = $db->loadObjectList('order_id');
			
			$this->_total = count($fields);
        }
        
        return $this->_total;
    }
	
    /**
     * Load a single order
     */
     public function getOrder() {
		 /* Load an attribute */
		 $row = $this->getTable();
		 $row->load(JRequest::getInt('attribute_sku_id'));
     	 return $row;
     }
     
    /**
    * Select the products to list on the product list page
    */
    public function getOrdersList() {
     	$db = JFactory::getDBO();
     	/* Pagination */
     	$this->getPagination();
     	
     	/* Build the query */
     	$q = "SELECT *
     			".$this->getOrdersListQuery().$this->getOrdersListFilter()."
			";
     	$db->setQuery($q, $this->_pagination->limitstart, $this->_pagination->limit);
     	return $db->loadObjectList('order_id');
    }
    
    /**
    * List of tables to include for the product query
    * @author RolandD
    */
    private function getOrdersListQuery() {
    	return 'FROM #__vm_orders ';
    }
    
    /**
    * Collect the filters for the query
    * @author RolandD
    */
    private function getOrdersListFilter() {
    	$db = JFactory::getDBO();
    	$filters = array();
    	/* Check some filters */
    	$filter_order = JRequest::getCmd('filter_order', 'order_id');
		if ($filter_order == '') $filter_order = 'order_id';
		$filter_order_Dir = JRequest::getWord('filter_order_Dir', 'desc');
		if ($filter_order_Dir == '') $filter_order_Dir = 'desc';
    	
     	/* Attributes name */
     	if (JRequest::getVar('filter_orders', false)) $filters[] = '#__vm_orders.`order_id` LIKE '.$db->Quote('%'.JRequest::getVar('filter_orders').'%');
     	
     	if (count($filters) > 0) $filter = ' WHERE '.implode(' AND ', $filters).' ORDER BY '.$filter_order." ".$filter_order_Dir;
     	else $filter = ' ORDER BY '.$filter_order." ".$filter_order_Dir;
     	return $filter;
    }
    
	/**
	* Store an attribute
	*
	* @author RolandD
	*/
	public function saveAttribute() {
		/* Load an attribute */
		 $row = $this->getTable();
		 $row->load(JRequest::getInt('attribute_sku_id'));
		 
		/* Update the list order */
		$new_list = JRequest::getInt('listorder', 0);
		$db = JFactory::getDBO();
		if ($new_list == 0) {
			$q = "SELECT IF(MAX(attribute_list) IS NULL, 1, MAX(attribute_list)+1) AS newlist
				FROM #__vm_product_attribute_sku";
			$db->setQuery($q);
			$new_list = $db->loadResult();
		}
		else {
			if ($new_list > $row->attribute_list) {
				/* First the lists below the new list order */
				$q = "UPDATE #__vm_product_attribute_sku SET attribute_list = attribute_list-1
					 WHERE attribute_list <= ".$new_list;
				$db->setQuery($q);
				$db->query();
			}
			else if ($new_list < $row->attribute_list) {
				/* Second the lists above the new list order */
				$q = "UPDATE #__vm_product_attribute_sku SET attribute_list = attribute_list+1
					 WHERE attribute_list >= ".$new_list;
				$db->setQuery($q);
				$db->query();
			}
		}
		$row->bind(JRequest::get('post'));
		$row->attribute_list = $new_list;
		if ($row->store()) return true;
		else return false;
	}
	
	/**
	* Get the list order list
	*/
	public function getListOrder() {
		$db = JFactory::getDBO();
		$q = "SELECT attribute_list AS value, CONCAT(attribute_list, '. ', attribute_name) AS text
			FROM #__vm_product_attribute_sku
			ORDER BY attribute_list";
		$db->setQuery($q);
		return $db->loadObjectList();
	}
	
	/**
	* Remove an attribute
	* @author RolandD
	* @todo Add sanity checks
	*/
	public function removeAttribute() {
		/* Get the attribute IDs to remove */
		$cids = JRequest::getVar('cid');
		if (!is_array($cids)) $cids = array($cids);
		
		/* Start removing */
		foreach ($cids as $key => $attribute_id) {
			/* First copy the product in the product table */
			$row = $this->getTable('attributes');
			
			/* Delete the attribute */
			$row->delete($attribute_id);
		}
		return true;
	}
}
?>