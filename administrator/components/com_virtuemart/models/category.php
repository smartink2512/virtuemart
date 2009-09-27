<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model for product categories
 */
class JMartModelCategory extends JModel
{    
    function __construct()
    {
        parent::__construct();
    }
    
    
    /**
	 * Get the list of child categories for a given category
	 *
	 * @param int $category_id Category id to check for child categories
	 * @return object List of objects containing the child categories
	 */
	function getChildCategoryList($vendorId, $category_id) 
	{		
		$db = JFactory::getDBO();

		$query = 'SELECT `category_id`, `category_thumb_image`, `category_child_id`, `category_name` ';
		$query .= 'FROM `#__jmart_category`, `#__jmart_category_xref` ';
		$query .= 'WHERE `#__jmart_category_xref`.`category_parent_id` = ' . $category_id . ' ';
		$query .= 'AND `#__jmart_category`.`category_id` = `#__jmart_category_xref`.`category_child_id` ';
		$query .= 'AND `#__jmart_category`.`vendor_id` = ' . $vendorId . ' ';
		$query .= 'AND `#__jmart_category`.`category_publish` = "Y" ';
		$query .= 'ORDER BY `#__jmart_category`.`list_order`, `#__jmart_category`.`category_name` ASC';
		
		$childList = $this->_getList( $query );
		return $childList;	    
	}
	
	/**
	 * Creates structured option fields for all categories
	 *
	 * @todo Connect to vendor data
	 *
	 * @param int $category_id A single category to be pre-selected
	 * @param int $cid Internally used for recursion
	 * @param int $level Internally used for recursion
	 * @param array $selected_categories All category IDs that will be pre-selected
	 */
	function list_tree($category_id="", $cid='0', $level='0', $selected_categories=Array(), $disabledFields=Array() ) {
		global $perm, $hVendor;
		
		//$vendor_id = $hVendor->getLoggedVendor();
		$vendor_id = 1;

		$db = JFactory::getDBO();
		$category_tree = '';
		
		$level++;

		$q = "SELECT category_id, category_child_id,category_name FROM #__jmart_category,#__jmart_category_xref ";
		$q .= "WHERE #__jmart_category_xref.category_parent_id='$cid' ";
		$q .= "AND #__jmart_category.category_id=#__jmart_category_xref.category_child_id ";
		/**
		if (!$perm->check("admin")) {
			//This shows for the admin everything, but for normal vendors only their own AND shared categories by Max Milbers
			$q .= "AND (#__jmart_category.vendor_id = '$vendor_id' OR #__jmart_category_xref.category_shared = 'Y') ";
			
		}
		$GLOBALS['vmLogger']->debug('$hVendor_id='.$vendor_id);
		*/
		
		$q .= "ORDER BY #__jmart_category.list_order, #__jmart_category.category_name ASC";
		$db->setQuery($q);   
		$records = $db->loadObjectList();
		
		foreach ($records as $key => $category) {
			$child_id = $category->category_child_id;
			if ($child_id != $cid) {
				$selected = ($child_id == $category_id) ? "selected=\"selected\"" : "";
				if( $selected == "" && @$selected_categories[$child_id] == "1") {
					$selected = "selected=\"selected\"";
				}
				$disabled = '';
				if( in_array( $child_id, $disabledFields )) {
					$disabled = 'disabled="disabled"';
				}
				if( $disabled != '' && stristr($_SERVER['HTTP_USER_AGENT'], 'msie')) {
					// IE7 suffers from a bug, which makes disabled option fields selectable
				} else {
					$category_tree .= "<option $selected $disabled value=\"$child_id\">\n";
					for ($i=0;$i<$level;$i++) {
						$category_tree .= "&#151;";
					}
					$category_tree .= "|$level|";
					$category_tree .= "&nbsp;" . $category->category_name . "</option>";
				}
			}
			$this->list_tree($category_id, $child_id, $level, $selected_categories, $disabledFields);
		}
		return $category_tree;
	}
}
?>