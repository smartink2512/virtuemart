<?php
/**
* @package		JMart
* @license		GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model for JMart Products
 *
 * @package JMart
 * @author RolandD
 * @todo Replace getOrderUp and getOrderDown with JTable move function. This requires the jmart_product_category_xref table to replace the product_list with the ordering column
 */
class JMartModelProduct extends JModel {
    
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
            if (JRequest::getInt('category_id', 0) > 0) $filter .= ' AND #__jmart_category.`category_id` = '.JRequest::getInt('category_id');
			$q = "SELECT COUNT(*) ".$this->getProductListQuery().$filter."
				 GROUP BY #__jmart_product.`product_id`
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
			 	pp.price_quantity_start, pp.price_quantity_end 
				FROM #__jmart_product AS p
				LEFT JOIN #__jmart_product_mf_xref AS pf
				ON p.product_id = pf.product_id
				LEFT JOIN #__jmart_product_price AS pp
				ON p.product_id = pp.product_id
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
     * Select the products to list on the product list page
     */
    public function getProductList() {
     	$db = JFactory::getDBO();
     	/* Pagination */
     	$this->getPagination();
     	
     	/* Check some filters */
     	if (JRequest::getInt('product_parent_id', 0) > 0) $filter = ' WHERE #__jmart_product.`product_parent_id` = '.JRequest::getInt('product_parent_id');
     	else $filter = ' WHERE #__jmart_product.`product_parent_id` = 0';
     	if (JRequest::getInt('category_id', 0) > 0) $filter .= ' AND #__jmart_category.`category_id` = '.JRequest::getInt('category_id').' ORDER BY product_list';
     	
     	
     	/* Build the query */
     	$q = "SELECT #__jmart_product.`product_id`,
     				#__jmart_product.`product_parent_id`,
     				`product_name`,
     				`vendor_name`,
     				`product_sku`,
     				`category_name`,
     				#__jmart_category.`category_id`,
     				#__jmart_category_xref.`category_parent_id`,
     				#__jmart_product_category_xref.`product_list`,
     				`mf_name`,
     				#__jmart_manufacturer.`manufacturer_id`,
     				`product_publish`,
     				IF (`product_publish` = 'Y', 1, 0) AS `published`,
     				`product_price`
     				".$this->getProductListQuery().$filter."
			";
     	$db->setQuery($q, $this->_pagination->limitstart, $this->_pagination->limit);
     	return $db->loadObjectList('product_id');
    }
    
    private function getProductListQuery() {
    	return 'FROM #__jmart_product
			LEFT JOIN #__jmart_product_price
			ON #__jmart_product.product_id = #__jmart_product_price.product_id
			LEFT JOIN #__jmart_product_mf_xref
			ON #__jmart_product.product_id = #__jmart_product_mf_xref.product_id
			LEFT JOIN #__jmart_manufacturer
			ON #__jmart_product_mf_xref.manufacturer_id = #__jmart_manufacturer.manufacturer_id
			LEFT JOIN #__jmart_product_attribute
			ON #__jmart_product.product_id = #__jmart_product_attribute.product_id
			LEFT JOIN #__jmart_product_category_xref
			ON #__jmart_product.product_id = #__jmart_product_category_xref.product_id
			LEFT JOIN #__jmart_category
			ON #__jmart_product_category_xref.category_id = #__jmart_category.category_id
			LEFT JOIN #__jmart_category_xref
			ON #__jmart_category.category_id = #__jmart_category_xref.category_child_id
			LEFT JOIN #__jmart_vendor
			ON #__jmart_product.vendor_id = #__jmart_vendor.vendor_id';
    }
    
    /*
     * Check if the product has any children
     */
    public function checkChildProducts($product_id) {
     	$db = JFactory::getDBO();
     	$q  = "SELECT IF (COUNT(product_id) > 0, 'Y', 'N') FROM `#__jmart_product` WHERE `product_parent_id` = ".$product_id;
     	$db->setQuery($q);
     	if ($db->loadResult() == 'Y') return true;
     	else if ($db->loadResult() == 'N') return false;
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
			$q = "UPDATE #__jmart_product 
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
	        $query  = 'SELECT DISTINCT `product_sku`,`#__jmart_product`.`product_id`, `product_name`, `product_s_desc`, `product_thumb_image`, `product_full_image`, `product_in_stock`, `product_url` '; 
	        $query .= 'FROM `#__jmart_product`, `#__jmart_product_category_xref`, `#__jmart_category` WHERE ';
	        $query .= '(`#__jmart_product`.`product_parent_id`="" OR `#__jmart_product`.`product_parent_id`="0") ';
	        $query .= 'AND `#__jmart_product`.`product_id`=`#__jmart_product_category_xref`.`product_id` ';
	        $query .= 'AND `#__jmart_category`.`category_id`=`#__jmart_product_category_xref`.`category_id` ';
            $query .= 'AND `#__jmart_category`.`category_id`=' . $categoryId . ' ';
	        $query .= 'AND `#__jmart_product`.`product_publish`="Y" ';
	        $query .= 'AND `#__jmart_product`.`product_special`="Y" ';
	        if( CHECK_STOCK && SHOW_OUT_OF_STOCK_PRODUCTS != '1') {
		        $query .= ' AND `product_in_stock` > 0 ';
	        }
	        $query .= 'ORDER BY RAND() LIMIT 0, '.(int)$nbrReturnProducts;
        }
        else {
	        $query  = 'SELECT DISTINCT `product_sku`,`product_id`,`product_name`,`product_s_desc`,`product_thumb_image`, `product_full_image`, `product_in_stock`, `product_url` ';
	        $query .= 'FROM `#__jmart_product` WHERE ';
	        $query .= '(`#__jmart_product`.`product_parent_id`="" OR `#__jmart_product`.`product_parent_id`="0") AND `vendor_id`=' . $vendorId . ' ';
	        $query .= 'AND `#__jmart_product`.`product_publish`="Y" ';
	        $query .= 'AND `#__jmart_product`.`product_special`="Y" ';
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
				$mainframe->enqueueMessage(JText::_('JM_SORT_ERR_NUMBERS_ONLY'), 'error');
				return false;
			}
		}
		
		/* Get the list of product IDs */
		$q = "SELECT product_id 
			FROM #__jmart_product_category_xref
			WHERE category_id = ".$category_id;
		$db->setQuery($q);
		$product_ids = $db->loadResultArray();
		
		foreach( $order as $key => $list_id ) {
			$q = "UPDATE #__jmart_product_category_xref ";
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
    		FROM #__jmart_product_category_xref
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
		$q = "UPDATE #__jmart_product_category_xref
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
		$q = "UPDATE #__jmart_product_category_xref
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
    		FROM #__jmart_product_category_xref
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
		$q = "UPDATE #__jmart_product_category_xref
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
		$q = "UPDATE #__jmart_product_category_xref
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
			$q = "SELECT related_products FROM #__jmart_product_relations WHERE product_id='".$product_id."'";
			$db->setQuery($q);
			$results = explode("|", $db->loadResult());
			if (count($results) > 0) {
				$ids = 'product_id=' . implode( ' OR product =', $results );
				$q = "SELECT product_id AS id, CONCAT(product_name, '::', product_sku) AS text
					FROM #__jmart_product
					WHERE (".$ids.")";
				$db->setQuery($q);
				return $db->loadObjectList();
			}
			else return false;
		 }
	 }
	 
	 /**
	 * Function to create a DB object that holds all information
	 * from the attribute tables about item $item_id AND/OR product $product_id
	 *
	 * @param int $item_id The product_id of the item
	 * @param int $product_id The product_id of the parent product
	 * @param string $attribute_name The name of the attribute to filter
	 * @return ps_DB The db object...
	 */
	function getAttributeTitles($item_id="",$product_id="",$attribute_name="") {
		$db = JFactory::getDBO();
		$attributes = array();
		if ($item_id and $product_id) {
			$q  = "SELECT * FROM #__jmart_product_attribute,#__jmart_product_attribute_sku ";
			$q .= "WHERE #__jmart_product_attribute.product_id = '$item_id' ";
			$q .= "AND #__jmart_product_attribute_sku.product_id ='$product_id' ";
			if ($attribute_name) {
				$q .= "AND #__jmart_product_attribute.attribute_name = $attribute_name ";
			}
			$q .= "AND #__jmart_product_attribute.attribute_name = ";
			$q .=     "#__jmart_product_attribute_sku.attribute_name ";
			$q .= "ORDER BY attribute_list,#__jmart_product_attribute.attribute_name";
		} elseif ($item_id) {
			$q  = "SELECT * FROM #__jmart_product_attribute ";
			$q .= "WHERE product_id=$item_id ";
			if ($attribute_name) {
				$q .= "AND attribute_name = '$attribute_name' ";
			}
		} elseif ($product_id) {
			$q  = "SELECT * FROM #__jmart_product_attribute_sku ";
			$q .= "WHERE product_id =".(int)$product_id.' ';
			if ($attribute_name) {
				$q .= "AND #__jmart_product_attribute.attribute_name = $attribute_name ";
			}
			$q .= "ORDER BY attribute_list,attribute_name";
		} else {
			/* Error: no arguments were provided. */
			return $attributes;
		}
		
		$db->setQuery($q); 
		$attributes = $db->loadObjectList();
		return $attributes;
	}
	
	/**
	 * Function to create a db object holding the data of all child items of
	 * product $product_id
	 *
	 * @param int $product_id
	 * @return ps_DB object that holds all items of product $product_id
	 */
	public function getAttributeItems($product_id) {
		$db = JFactory::getDBO();
		if( !empty($product_id) ) {
			$q  = "SELECT * FROM #__jmart_product ";
			$q .= "WHERE product_parent_id=".(int)$product_id.' ';
			$q .= "ORDER BY product_name";

			$db->setQuery($q); 
		}
		return $db->loadObjectList();
	}
	
	public function getProductListJson() {
		$db = JFactory::getDBO();
		$filter = JRequest::getVar('q', false);
		$q = "SELECT product_id AS id, CONCAT(product_name, '::', product_sku) AS value
			FROM #__jmart_product";
		if ($filter) $q .= " WHERE product_name LIKE '%".$filter."%'";
		$db->setQuery($q);
		return $db->loadObjectList();
	}
}
?>