<?php
/**
 * Product table
 *
 * @package	JMart
 * @subpackage Product
 * @author RolandD
 * @copyright Copyright (c) 2009 JMart Team. All rights reserved.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * Product table class
 * The class is is used to manage the products in the shop.
 *
 * @package	JMart
 * @author RolandD
 */
class TableProduct extends JTable
{
	/** @var int Primary key */
	var $product_id				= 0;
	/** @var integer Product id */
	var $vendor_id		= 0;
	/** @var string File name */
	var $product_parent_id		= '';
	/** @var string File title */
	var $product_sku				= '';
    /** @var string File description */
	var $product_s_desc		= '';
    /** @var string File extension */
	var $product_desc			= '';
	/** @var string File mime type */
	var $product_thumb_image			= '';
	/** @var string File URL */
	var $product_full_image				= '';
	/** @var int File published or not */
	var $product_publish		= 0;
	/** @var int File is an image or other */
	var $product_weight			= 0;
	/** @var int File image height */
	var $product_weight_uom		= 0;
	/** @var int File image width */
	var $product_length		= 0;
	/** @var int File thumbnail image height */
	var $product_width = 0;
	/** @var int File thumbnail image width */
	var $product_height	= 0;
	/** @var int File thumbnail image width */
	var $product_lwh_uom	= 0;
	/** @var int File thumbnail image width */
	var $product_url	= 0;
	/** @var int File thumbnail image width */
	var $product_in_stock	= 0;
	/** @var int File thumbnail image width */
	var $low_stock_notification	= 0;
	/** @var int File thumbnail image width */
	var $product_available_date	= 0;
	/** @var int File thumbnail image width */
	var $product_availability	= 0;
	/** @var int File thumbnail image width */
	var $product_special	= 0;
	/** @var int File thumbnail image width */
	var $product_discount_id	= 0;
	/** @var int File thumbnail image width */
	var $ship_code_id	= 0;
	/** @var int File thumbnail image width */
	var $cdate	= 0;
	/** @var int File thumbnail image width */
	var $mdate	= 0;
	/** @var string Name of the product */
	var $product_name	= null;
	/** @var int File thumbnail image width */
	var $product_sales	= 0;
	/** @var int File thumbnail image width */
	var $attribute	= 0;
	/** @var int File thumbnail image width */
	var $custom_attribute	= 0;
	/** @var int File thumbnail image width */
	var $product_tax_id	= 0;
	/** @var int File thumbnail image width */
	var $product_unit	= 0;
	/** @var int File thumbnail image width */
	var $product_packaging	= 0;
	/** @var int File thumbnail image width */
	var $child_options	= 0;
	/** @var int File thumbnail image width */
	var $quantity_options	= 0;
	/** @var int File thumbnail image width */
	var $child_option_ids	= 0;
	/** @var int File thumbnail image width */
	var $product_order_levels	= 0;
	/** @var string Internal note for product */
	var $intnotes = null;
	/** @var string Meta description */
	var $metadesc	= null;
	/** @var string Meta keys */
	var $metakey	= null;
	/** @var string Meta robot */
	var $metarobot	= null;
	/** @var string Meta author */
	var $metaauthor	= null;
	
	
	/**
	 * @author RolandD
	 * @param $db A database connector object
	 */
	function __construct(&$db) {
		parent::__construct('#__jmart_product', 'product_id', $db);
	}
}
?>
