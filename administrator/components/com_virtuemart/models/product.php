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
 * @todo Replace getOrderUp and getOrderDown with JTable move function. This requires the vm_product_category_xref table to replace the product_list with the ordering column
 */
class VirtueMartModelProduct extends JModel {
    
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
            if (JRequest::getInt('category_id', 0) > 0) $filter .= ' AND #__vm_category.`category_id` = '.JRequest::getInt('category_id');
			$q = "SELECT COUNT(*) ".$this->getProductListQuery().$filter."
				 GROUP BY #__vm_product.`product_id`
				";
			$db->setQuery($q);
			$this->_total = $db->loadResult();
        }
        
        return $this->_total;
    }
	
    /**
     * Load a single product
     */
     public function getProduct() {
     	 $product_id = JRequest::getInt('product_id', 0);
     	 /* Check if we are loading an existing product */
     	 if ($product_id > 0) {
			 $db = JFactory::getDBO();
			 $q = "SELECT p.*, pf.manufacturer_id, pp.product_price_id, pp.product_price, pp.product_currency,
			 	pp.price_quantity_start, pp.price_quantity_end, a.attribute_name AS attribute_names
				FROM #__vm_product AS p
				LEFT JOIN #__vm_product_mf_xref AS pf
				ON p.product_id = pf.product_id
				LEFT JOIN #__vm_product_price AS pp
				ON p.product_id = pp.product_id
				LEFT JOIN #__vm_product_attribute_sku a
				ON p.product_id = a.product_id
				WHERE p.product_id = ".$product_id;
			 $db->setQuery($q);
			 $row = $db->loadObject();
		 }
		 else {
		 	 /* Load an empty product */
		 	 $row = $this->getTable();
		 	 $row->load();
		 	 
		 	 /* Add optional fields */
		 	 $row->manufacturer_id = null;
		 	 $row->product_price_id = null;
		 	 $row->product_price = null;
		 	 $row->product_currency = null;
		 	 $row->product_price_quantity_start = null;
		 	 $row->product_price_quantity_end = null;
		 }
     	 return $row;
     }
     
     /**
     * Load the attribute names for a product
     */
     public function getProductAttributeNames() {
     	 $product_id = JRequest::getInt('product_id', 0);
     	 $product_parent_id = JRequest::getInt('product_parent_id', 0);
     	 /* Check if we are loading an existing product */
     	 if ($product_id > 0) {
     	 	 $db = JFactory::getDBO();
			 $q = "SELECT attribute_name
				FROM #__vm_product_attribute_sku
				WHERE product_id = ";
				if ($product_parent_id > 0) $q .= $product_parent_id;
				else $q .= $product_id;
			 $db->setQuery($q);
			 return $db->loadResultArray();
     	 }
     	 else return null;
     }
     
     /**
     * Load the attribute names for a product
     */
     public function getProductAttributeValues() {
     	 $product_id = JRequest::getInt('product_id', 0);
     	 /* Check if we are loading an existing product */
     	 if ($product_id > 0) {
     	 	 $db = JFactory::getDBO();
			 $q = "SELECT attribute_id, attribute_name, attribute_value
				FROM #__vm_product_attribute
				WHERE product_id = ".$product_id;
			 $db->setQuery($q);
			 return $db->loadAssocList('attribute_name');
     	 }
     	 else return null;
     }
    
    /**
     * Select the products to list on the product list page
     */
    public function getProductList() {
     	$db = JFactory::getDBO();
     	/* Pagination */
     	$this->getPagination();
     	
     	/* Check some filters */
     	if (JRequest::getInt('product_parent_id', 0) > 0) $filter = ' WHERE #__vm_product.`product_parent_id` = '.JRequest::getInt('product_parent_id');
     	else $filter = ' WHERE #__vm_product.`product_parent_id` = 0';
     	if (JRequest::getInt('category_id', 0) > 0) $filter .= ' AND #__vm_category.`category_id` = '.JRequest::getInt('category_id').' ORDER BY product_list';
     	
     	
     	/* Build the query */
     	$q = "SELECT #__vm_product.`product_id`,
     				#__vm_product.`product_parent_id`,
     				`product_name`,
     				`vendor_name`,
     				`product_sku`,
     				`category_name`,
     				#__vm_category.`category_id`,
     				#__vm_category_xref.`category_parent_id`,
     				#__vm_product_category_xref.`product_list`,
     				`mf_name`,
     				#__vm_manufacturer.`manufacturer_id`,
     				`product_publish`,
     				IF (`product_publish` = 'Y', 1, 0) AS `published`,
     				`product_price`
     				".$this->getProductListQuery().$filter."
			";
     	$db->setQuery($q, $this->_pagination->limitstart, $this->_pagination->limit);
     	return $db->loadObjectList('product_id');
    }
    
    private function getProductListQuery() {
    	return 'FROM #__vm_product
			LEFT JOIN #__vm_product_price
			ON #__vm_product.product_id = #__vm_product_price.product_id
			LEFT JOIN #__vm_product_mf_xref
			ON #__vm_product.product_id = #__vm_product_mf_xref.product_id
			LEFT JOIN #__vm_manufacturer
			ON #__vm_product_mf_xref.manufacturer_id = #__vm_manufacturer.manufacturer_id
			LEFT JOIN #__vm_product_attribute
			ON #__vm_product.product_id = #__vm_product_attribute.product_id
			LEFT JOIN #__vm_product_category_xref
			ON #__vm_product.product_id = #__vm_product_category_xref.product_id
			LEFT JOIN #__vm_category
			ON #__vm_product_category_xref.category_id = #__vm_category.category_id
			LEFT JOIN #__vm_category_xref
			ON #__vm_category.category_id = #__vm_category_xref.category_child_id
			LEFT JOIN #__vm_vendor
			ON #__vm_product.vendor_id = #__vm_vendor.vendor_id';
    }
    
    /**
    * Check if the product has any children
    */
    public function checkChildProducts($product_id) {
     	$db = JFactory::getDBO();
     	$q  = "SELECT IF (COUNT(product_id) > 0, 'Y', 'N') FROM `#__vm_product` WHERE `product_parent_id` = ".$product_id;
     	$db->setQuery($q);
     	if ($db->loadResult() == 'Y') return true;
     	else if ($db->loadResult() == 'N') return false;
    }
    
    /**
    * Set the publish/unpublish state
    */
    public function getPublish() {
     	$cid = JRequest::getVar('cid', false);
     	if (is_array($cid)) {
     		$db = JFactory::getDBO();
     		$cids = implode( ',', $cid );
			if (JRequest::getVar('task') == 'publish') $state =  'Y'; else $state = 'N';
			$q = "UPDATE #__vm_product 
				SET product_publish = ".$db->Quote($state)." 
				WHERE product_id IN (".$cids.")";
			$db->setQuery($q);
			if ($db->query()) return true;
			else return false;
		}
    }
    
    
    /**
	 * Retrieve a list of featured products from the database.
	 *
	 * @param int $categoryId Id of the category to lookup, null for all categories
	 * @param int $nbrReturnProducts Number of products to return
	 * @return object List of featured products
	 */    
    function getFeaturedProducts($vendorId, $categoryId='', $nbrReturnProducts) {
		$db = JFactory::getDBO();         
	    
        if ( $categoryId ) {
	        $query  = 'SELECT DISTINCT `product_sku`,`#__vm_product`.`product_id`, `product_name`, `product_s_desc`, `product_thumb_image`, `product_full_image`, `product_in_stock`, `product_url` '; 
	        $query .= 'FROM `#__vm_product`, `#__vm_product_category_xref`, `#__vm_category` WHERE ';
	        $query .= '(`#__vm_product`.`product_parent_id`="" OR `#__vm_product`.`product_parent_id`="0") ';
	        $query .= 'AND `#__vm_product`.`product_id`=`#__vm_product_category_xref`.`product_id` ';
	        $query .= 'AND `#__vm_category`.`category_id`=`#__vm_product_category_xref`.`category_id` ';
            $query .= 'AND `#__vm_category`.`category_id`=' . $categoryId . ' ';
	        $query .= 'AND `#__vm_product`.`product_publish`="Y" ';
	        $query .= 'AND `#__vm_product`.`product_special`="Y" ';
	        if( CHECK_STOCK && SHOW_OUT_OF_STOCK_PRODUCTS != '1') {
		        $query .= ' AND `product_in_stock` > 0 ';
	        }
	        $query .= 'ORDER BY RAND() LIMIT 0, '.(int)$nbrReturnProducts;
        }
        else {
	        $query  = 'SELECT DISTINCT `product_sku`,`product_id`,`product_name`,`product_s_desc`,`product_thumb_image`, `product_full_image`, `product_in_stock`, `product_url` ';
	        $query .= 'FROM `#__vm_product` WHERE ';
	        $query .= '(`#__vm_product`.`product_parent_id`="" OR `#__vm_product`.`product_parent_id`="0") AND `vendor_id`=' . $vendorId . ' ';
	        $query .= 'AND `#__vm_product`.`product_publish`="Y" ';
	        $query .= 'AND `#__vm_product`.`product_special`="Y" ';
	        if( CHECK_STOCK && PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS != '1') {
		        $query .= ' AND `product_in_stock` > 0 ';
	        }
	        $query .= 'ORDER BY RAND() LIMIT 0, '.(int)$nbrReturnProducts;
        }
        $db->setQuery($query);
		$result = $db->loadObjectList();
		
		return $result;
    }
    
    /**
     * Saves products according to their order
     * @author RolandD
     */
    public function getSaveOrder() {
    	$db = JFactory::getDBO();
    	$mainframe = Jfactory::getApplication('site');
    	$order = JRequest::getVar('order');
    	$category_id = JRequest::getInt('category_id');
    	
    	/* Check if all the entries are numbers */
		foreach( $order as $list_id ) {
			if( !is_numeric( $list_id ) ) {
				$mainframe->enqueueMessage(JText::_('VM_SORT_ERR_NUMBERS_ONLY'), 'error');
				return false;
			}
		}
		
		/* Get the list of product IDs */
		$q = "SELECT product_id 
			FROM #__vm_product_category_xref
			WHERE category_id = ".$category_id;
		$db->setQuery($q);
		$product_ids = $db->loadResultArray();
		
		foreach( $order as $key => $list_id ) {
			$q = "UPDATE #__vm_product_category_xref ";
			$q .= "SET product_list = ".$list_id;
			$q .= " WHERE category_id ='".$category_id."' ";
			$q .= " AND product_id ='".$product_ids[$key]."' ";
			$db->setQuery($q);
			$db->query();
		}
	}
	
	/**
     * Saves products according to their order
     * @author RolandD
     */
    public function getOrderUp() {
    	$db = JFactory::getDBO();
    	$cids = JRequest::getVar('cid');
    	$cid = (int)$cids[0];
    	$category_id = JRequest::getInt('category_id');
    	
    	$q = "SELECT product_id, product_list
    		FROM #__vm_product_category_xref
    		WHERE category_id = ".$category_id."
    		ORDER BY product_list";
    	$db->setQuery($q);
    	$products = $db->loadAssocList('product_id');
    	$keys = array_keys($products);
    	while (current($keys) !== $cid) next($keys);
    	
    	/* Get the previous ID */
    	$prev_id = prev($keys);
    	
    	/* Check if a previous product_list exists */
    	if (is_null($products[$prev_id]['product_list'])) {
    		$products[$prev_id]['product_list'] = $prev_id;
    	}
    	
    	/* Check if the product_listings are the same */
    	if ($products[$prev_id]['product_list'] == $products[$cid]['product_list']) {
    		$products[$cid]['product_list']++;
    	}
    	
    	/* Update the current product */
		$q = "UPDATE #__vm_product_category_xref
			SET product_list = ".$products[$prev_id]['product_list']."
			WHERE category_id = ".$category_id."
			AND product_id = ".$products[$cid]['product_id'];
		$db->setQuery($q);
		$db->query();
		
		/* Check if a next product_list exists */
    	if (is_null($products[$cid]['product_list'])) {
    		$products[$cid]['product_list'] = $prev_id+1;
    	}
		/* Update the previous product */
		$q = "UPDATE #__vm_product_category_xref
			SET product_list = ".$products[$cid]['product_list']."
			WHERE category_id = ".$category_id."
			AND product_id = ".$products[$prev_id]['product_id'];
		$db->setQuery($q);
		$db->query();
	}
	
	/**
     * Saves products according to their order
     * @author RolandD
     */
    public function getOrderDown() {
    	$db = JFactory::getDBO();
    	$cids = JRequest::getVar('cid');
    	$cid = (int)$cids[0];
    	$category_id = JRequest::getInt('category_id');
    	
    	$q = "SELECT product_id, product_list
    		FROM #__vm_product_category_xref
    		WHERE category_id = ".$category_id."
    		ORDER BY product_list";
    	$db->setQuery($q);
    	$products = $db->loadAssocList('product_id');
    	$keys = array_keys($products);
    	while (current($keys) !== $cid) next($keys);
    	
    	/* Get the next ID */
    	$next_id = next($keys);
    	
    	/* Check if a previous product_list exists */
    	if (is_null($products[$next_id]['product_list'])) {
    		$products[$next_id]['product_list'] = $next_id;
    	}
    	
    	/* Check if the product_listings are the same */
    	if ($products[$next_id]['product_list'] == $products[$cid]['product_list']) {
    		$products[$cid]['product_list']--;
    	}
    	
    	/* Update the current product */
		$q = "UPDATE #__vm_product_category_xref
			SET product_list = ".$products[$next_id]['product_list']."
			WHERE category_id = ".$category_id."
			AND product_id = ".$products[$cid]['product_id'];
		$db->setQuery($q);
		$db->query();
		
		/* Check if a next product_list exists */
    	if (is_null($products[$cid]['product_list'])) {
    		$products[$cid]['product_list'] = $next_id-1;
    	}
		/* Update the next product */
		$q = "UPDATE #__vm_product_category_xref
			SET product_list = ".$products[$cid]['product_list']."
			WHERE category_id = ".$category_id."
			AND product_id = ".$products[$next_id]['product_id'];
		$db->setQuery($q);
		$db->query();
	}
	
	/**
	 * Get the related products
	 */
	 public function getRelatedProducts($product_id=false) {
	 	 if (!$product_id) return array();
	 	 else {
			$db = JFactory::getDBO();
			$q = "SELECT related_products FROM #__vm_product_relations WHERE product_id='".$product_id."'";
			$db->setQuery($q);
			$results = explode("|", $db->loadResult());
			if (count($results) > 0) {
				$ids = 'product_id=' . implode( ' OR product =', $results );
				$q = "SELECT product_id AS id, CONCAT(product_name, '::', product_sku) AS text
					FROM #__vm_product
					WHERE (".$ids.")";
				$db->setQuery($q);
				return $db->loadObjectList();
			}
			else return false;
		 }
	 }
	 
	/**
	* Create a list of products for JSON return
	*/
	public function getProductListJson() {
		$db = JFactory::getDBO();
		$filter = JRequest::getVar('q', false);
		$q = "SELECT product_id AS id, CONCAT(product_name, '::', product_sku) AS value
			FROM #__vm_product";
		if ($filter) $q .= " WHERE product_name LIKE '%".$filter."%'";
		$db->setQuery($q);
		return $db->loadObjectList();
	}
	
	/**
	* Load the child products for a given product
	*/
	public function getChildAttributes($product_id) {
		$db = JFactory::getDBO();
		$q = "SELECT p.product_id, product_name, product_sku, attribute_name, attribute_value
			FROM #__vm_product p
			LEFT JOIN #__vm_product_attribute
			ON p.product_id = #__vm_product_attribute.product_id
			WHERE p.product_parent_id = ".$product_id."
			ORDER BY p.product_sku";
		$db->setQuery($q);
		$products = $db->loadObjectList();
		$childproduct = array();
		foreach ($products as $key => $product) {
			foreach ($product as $name => $value) {
				if (!array_key_exists($product->product_sku, $childproduct)) {
					$childproduct[$product->product_sku] = new StdClass();
				}
				if ($name != 'attribute_name' && $name != 'attribute_value') {
					$childproduct[$product->product_sku]->$name = $value;
				}
				else {
					$attribute_name = $product->attribute_name;
					$childproduct[$product->product_sku]->$attribute_name = $product->attribute_value;
				}
			}
		}
		return $childproduct;
	}
}
?>