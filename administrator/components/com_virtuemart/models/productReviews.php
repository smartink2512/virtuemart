<?php
/**
* @package		VirtueMart
* @license		GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model for VirtueMart Product Reviews
 *
 * @package		VirtueMart
 */
class VirtueMartModelProductReviews extends JModel {
    
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
    private function getPagination() {
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
	 * Returns the number of reviews assigned to a product
	 *
	 * @param int $pid Product ID
	 * @return int
	 */
	public function countReviewsForProduct($pid) {
		$db = JFactory::getDBO();
		$q = "SELECT COUNT(*) AS total 
			FROM #__vm_product_reviews 
			WHERE product_id=".$pid;
		$db->setQuery($q);
		$reviews = $db->loadResult();
		return $reviews;
	}
}
?>
