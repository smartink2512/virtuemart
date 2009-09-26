<?php
/**
* @package		JMart
* @license		GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model for Macola
 *
 * @package		JMart
 */
class JMartModelJMart extends JModel
{
    
    /**
	 * creates a bulleted of the childen of this category if they exist
	 * @author pablo
	 * @param int $category_id
	 * @return string The HTML code
	 */
	function GetVendorDetails($vendor_id) 
	{		
		$db = JFactory::getDBO();

		$query = "SELECT category_id, category_thumb_image, category_child_id, category_name ";
		$query .= "FROM #__jmart_category, #__jmart_category_xref ";
		$query .= "WHERE #__jmart_category_xref.category_parent_id = '$category_id' ";
		$query .= "AND #__jmart_category.category_id = #__jmart_category_xref.category_child_id ";
		//$query .= "AND #__jmart_category.vendor_id = '$hVendor_id' ";
		$query .= "AND #__jmart_category.vendor_id = '1' ";
		$query .= "AND #__jmart_category.category_publish = 'Y' ";
		$query .= "ORDER BY #__jmart_category.list_order, #__jmart_category.category_name ASC";
		
		$childList = $this->_getList( $query );
		return $childList;	    
	}

}
?>