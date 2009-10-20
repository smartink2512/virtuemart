<?php
/**
 * Configuration table
 *
 * @package	VirtueMart
 * @subpackage Config
 * @author Rick Glunt 
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * Coupon table class
 * The class is is used to manage the coupons in the shop.
 *
 * @author Rick Glunt
 * @package	VirtueMart
 * @subpackage Config 
 */
class TableConfig extends JTable
{
	/** @var int Primary key */
	var $config_id			 		= 0;
	/** @var tinyint Shop Offline flag */
	var $shop_is_offline       		= 0;	
	/** @var text Shop Offline message */
	var $offline_message       		= '';		
	/** @var tinyint Usa as catalog flag */
	var $use_as_catalog       		= 0;
	/** @var tinyint Show prices flag */
	var $show_prices	       		= 1;
	/** @var tinyint Price access level enabled */
	var $price_access_level_enabled  = 0;			
	/** @var varchar Price access level */
	var $price_acces_level     		= '';	
	/** @var tinyint Show prices with tax flag */
	var $show_prices_with_tax  		= 0;	
	/** @var tinyint Show excluding tax note flag */
	var $show_excluding_tax_note	= 0;	
	/** @var tinyint Show including tax note flag */
	var $show_including_tax_note    = 0;	
	/** @var tinyint Show price for packaging flag */
	var $show_price_for_packaging  	= 0;	
	/** @var tinyint Enable content plugins flag */
	var $enable_content_plugins    	= 0;	

	/**
	 * @author Rick Glunt
	 * @param $db A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__vm_config', 'config_id', $db);
	}


	/**
	 * Validates the config record fields.
	 *
	 * @author Rick Glunt
	 * @return boolean True if the table buffer is contains valid data, false otherwise.
	 */
	function check() 
	{	
		return true;
	}
	
	
	

}
?>
