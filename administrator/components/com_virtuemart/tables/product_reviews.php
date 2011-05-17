<?php
/**
*
* Product reviews table
*
* @package	VirtueMart
* @subpackage
* @author RolandD
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: ratings.php 3267 2011-05-16 22:51:49Z Milbo $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

if(!class_exists('VmTableData')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'vmtabledata.php');

/**
 * Product review table class
 * The class is is used to manage the reviews in the shop.
 *
 * @package		VirtueMart
 * @author Max Milbers
 */
class TableProduct_reviews extends VmTableData {

	/** @var int Primary key */
	var $virtuemart_product_review_id	= 0;
	/** @var int Product ID */
	var $virtuemart_product_id			= null;
	/** @var int The ID of the user who made comment */
	var $virtuemart_user_id         	= null;

	/** @var string The user comment */
	var $comment         				= null;
	/** @var int The number of stars awared */
	var $review_ok       				= null;

	/** The rating of shoppers for the review*/
	var $review_rate         			= null;
	var $review_ratingcount      		= null;
	var $review_rating      			= null;

	/** The rate of the user who wrote the review */
	var $rate      		= null;

	var $lastip      		= null;

	/** @var int State of the review */
	var $published         		= 0;


	/**
	* @author Max Milbers
	* @param $db A database connector object
	*/
	function __construct(&$db) {
		parent::__construct('#__virtuemart_product_reviews', 'virtuemart_product_review_id', $db);
		$this->setPrimaryKey('virtuemart_product_id');
//		$this->setUniqueName('country_name','COM_VIRTUEMART_COUNTRY_NAME_ALREADY_EXISTS');
//		$this->setObligatoryKeys('virtuemart_product_id','COM_VIRTUEMART_PRODUCT_REVIEWS_RECORDS_MUST_CONTAIN_PRODUCT_ID');
		$this->setObligatoryKeys('comment','COM_VIRTUEMART_PRODUCT_REVIEWS_RECORDS_MUST_CONTAIN_COMMENT');

		$this->setLoggable();
	}


}
// pure php no closing tag
