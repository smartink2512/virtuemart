<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_phpshop/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
/**
* Run all the upgrade queries 
*/
	$database->setQuery( "ALTER TABLE `#__pshop_shopper_group` ADD `default` TINYINT( 1 ) DEFAULT '0' NOT NULL ;"); $database->query();
	$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_reviews` (
	  `product_id` varchar(255) NOT NULL default '',
	  `comment` text NOT NULL,
	  `userid` int(11) NOT NULL default '0',
	  `time` int(11) NOT NULL default '0',
	  `user_rating` tinyint(1) NOT NULL default '0',
	  `review_ok` int(11) NOT NULL default '0',
	  `review_votes` int(11) NOT NULL default '0'
	) TYPE=MyISAM;"); $database->query();
	$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_votes` (
	  `product_id` int(255) NOT NULL default '0',
	  `votes` text NOT NULL,
	  `allvotes` int(11) NOT NULL default '0',
	  `rating` tinyint(1) NOT NULL default '0',
	  `lastip` varchar(50) NOT NULL default '0'
	) TYPE=MyISAM;"); $database->query();
	
	$database->setQuery( "ALTER TABLE `#__pshop_category` ADD `category_browsepage` VARCHAR( 255 ) DEFAULT 'browse_1' NOT NULL AFTER `mdate` ;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_category` ADD `products_per_row` TINYINT( 2 ) DEFAULT '1' NOT NULL AFTER `category_browsepage` ;"); $database->query();
	
	$database->setQuery( "ALTER TABLE `#__pshop_csv` ADD `csv_manufacturer_id` INT( 2 ) DEFAULT NULL;"); $database->query();
	$database->setQuery( "UPDATE `#__pshop_csv` SET csv_manufacturer_id='19';"); $database->query();
	
	$database->setQuery( "ALTER TABLE `#__pshop_payment_method` ADD `payment_class` VARCHAR( 50 ) NOT NULL AFTER `payment_method_name` ;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_payment_method` ADD `payment_enabled` CHAR( 1 ) DEFAULT 'N' NOT NULL ;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_payment_method` ADD `accepted_creditcards` VARCHAR( 128 ) NOT NULL ;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_payment_method` ADD `payment_extrainfo` TEXT NOT NULL ;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_payment_method` ADD `payment_passkey` BLOB NOT NULL ;"); $database->query();
		
	$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES ('', 1, 'NEW_Authorize.net', 'ps_authorize', 5, '0.00', 0, 'AN', 'Y', 0, 'N', '1,2,6,7,', '', '');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES ('', 1, 'NEW_PayPal', 'ps_paypal', 5, '0.00', 0, 'PP', 'P', 0, 'N', '', '<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\" target=\"_blank\">\r\n<input type=\"image\" name=\"submit\" src=\"http://images.paypal.com/images/x-click-but6.gif\" border=\"0\" alt=\"Make payments with PayPal, it\'s fast, free, and secure!\">\r\n<input type=\"hidden\" name=\"cmd\" value=\"_xclick\" />\r\n<input type=\"hidden\" name=\"business\" value=\"<?php echo PAYPAL_EMAIL ?>\" />\r\n<input type=\"hidden\" name=\"receiver_email\" value=\"<?php echo PAYPAL_EMAIL ?>\" />\r\n<input type=\"hidden\" name=\"item_name\" value=\"Order Nr. <?php \$db->p(\"order_id\") ?>\" />\r\n<input type=\"hidden\" name=\"order_id\" value=\"<?php \$db->p(\"order_id\") ?>\" />\r\n<input type=\"hidden\" name=\"invoice\" value=\"<?php \$db->p(\"order_number\") ?>\" />\r\n<input type=\"hidden\" name=\"amount\" value=\"<?php printf(\"%.2f\", \$db->f(\"order_total\"))?>\" />\r\n<input type=\"hidden\" name=\"currency_code\" value=\"<?php echo \$_SESSION[\'vendor_currency\'] ?>\" />\r\n<input type=\"hidden\" name=\"image_url\" value=\"<?php echo \$vendor_image_url ?>\" />\r\n<input type=\"hidden\" name=\"return\" value=\"<?php echo SECUREURL .\"index.php?option=com_phpshop&amp;page=checkout.result&amp;order_id=\".\$db->f(\"order_id\") ?>\" />\r\n<input type=\"hidden\" name=\"notify_url\" value=\"<?php echo SECUREURL .\"administrator/components/com_phpshop/notify.php\" ?>\" />\r\n<input type=\"hidden\" name=\"cancel_return\" value=\"<?php echo SECUREURL .\"index.php\" ?>\" />\r\n<input type=\"hidden\" name=\"undefined_quantity\" value=\"0\" />\r\n<input type=\"hidden\" name=\"pal\" value=\"NRUBJXESJTY24\" />\r\n<input type=\"hidden\" name=\"no_shipping\" value=\"1\" />\r\n<input type=\"hidden\" name=\"no_note\" value=\"1\" />\r\n</form>', '');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES ('', 1, 'NEW_PayMate', 'ps_paymate', 5, '0.00', 0, 'PM', 'P', 0, 'N', '', '<script type=\"text/javascript\" language=\"javascript\">
	  function openExpress(){
		var url = 'https://www.paymate.com.au/PayMate/ExpressPayment?mid=<?php echo PAYMATE_USERNAME.
		  \"&amt=\".\$db->f(\"order_total\").
		  \"&currency=\".\$_SESSION['vendor_currency'].
		  \"&ref=\".\$db->f(\"order_id\").
		  \"&pmt_sender_email=\".\$user->email.
		  \"&pmt_contact_firstname=\".\$user->first_name.
		  \"&pmt_contact_surname=\".\$user->last_name.
		  \"&regindi_address1=\".\$user->address_1.
		  \"&regindi_address2=\".\$user->address_2.
		  \"&regindi_sub=\".\$user->city.
		  \"&regindi_pcode=\".\$user->zip;?>'
		var newWin = window.open(url, 'wizard', 'height=640,width=500,scrollbars=0,toolbar=no');
		self.name = 'parent';
		newWin.focus();
	  }
	  </script>
	  <div align=\"center\">
	  <p>
	  <a href=\"javascript:openExpress();\">
	  <img src=\"https://www.paymate.com.au/homepage/images/butt_PayNow.gif\" border=\"0\" alt=\"Pay with Paymate Express\">
	  <br />click here to pay your account</a>
	  </p>
	  </div>', '');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES ('', 1, 'NEW_WorldPay', 'ps_worldpay', 5, '0.00', 0, 'WP', 'P', 0, 'N', '', '<form action=\"https://select.worldpay.com/wcc/purchase\" method=\"post\">
							<input type=hidden name=\"testMode\" value=\"100\"> 
							<input type=\"hidden\" name=\"instId\" value=\"<?php echo WORLDPAY_INST_ID ?>\" />
							<input type=\"hidden\" name=\"cartId\" value=\"<?php echo \$db->f(\"order_id\") ?>\" />
							<input type=\"hidden\" name=\"amount\" value=\"<?php echo \$db->f(\"order_total\") ?>\" />
							<input type=\"hidden\" name=\"currency\" value=\"<?php echo \$_SESSION[\'vendor_currency\'] ?>\" />
							<input type=\"hidden\" name=\"desc\" value=\"Products\" />
							<input type=\"hidden\" name=\"email\" value=\"<?php echo \$user->email?>\" />
							<input type=\"hidden\" name=\"address\" value=\"<?php echo \$user->address_1?>&#10<?php echo \$user->address_2?>&#10<?php echo
							\$user->city?>&#10<?php echo \$user->state?>\" />
							<input type=\"hidden\" name=\"name\" value=\"<?php echo \$user->title?><?php echo \$user->first_name?>. <?php echo \$user->middle_name?><?php echo \$user->last_name?>\" />
							<input type=\"hidden\" name=\"country\" value=\"<?php echo \$user->country?>\"/>
							<input type=\"hidden\" name=\"postcode\" value=\"<?php echo \$user->zip?>\" />
							<input type=\"hidden\" name=\"tel\"  value=\"<?php echo \$user->phone_1?>\">
							<input type=\"hidden\" name=\"withDelivery\"  value=\"true\">
							<br />
							<input type=\"submit\" value =\"PROCEED TO PAYMENT PAGE\" />
							</form>', '');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES ('', 1, 'NEW_2Checkout', 'ps_twocheckout', 5, '0.00', 0, '2CO', 'P', 0, 'N', '<?php
	  \$q  = \"SELECT * FROM #__users WHERE user_info_id=\'\".\$db->f(\"user_info_id\").\"\'\"; 
	  \$dbbt = new ps_DB;
	  \$dbbt->setQuery(\$q);
	  \$dbbt->query();
	  \$dbbt->next_record(); 
	  // Get ship_to information
	  if( \$db->f(\"user_info_id\") != \$dbbt->f(\"user_info_id\")) {
		\$q2  = \"SELECT * FROM #__pshop_user_info WHERE user_info_id=\'\".\$db->f(\"user_info_id\").\"\'\"; 
		\$dbst = new ps_DB;
		\$dbst->setQuery(\$q2);
		\$dbst->query();
		\$dbst->next_record();
	  }
	  else  {
		\$dbst = \$dbbt;
	  }
			  
	  //Authnet vars to send
	  \$formdata = array (
	   \'x_login\' => TWOCO_LOGIN,
	   \'x_email_merchant\' => ((TWOCO_MERCHANT_EMAIL == \'True\') ? \'TRUE\' : \'FALSE\'),
			   
	   // Customer Name and Billing Address
	   \'x_first_name\' => \$dbbt->f(\"first_name\"),
	   \'x_last_name\' => \$dbbt->f(\"last_name\"),
	   \'x_company\' => \$dbbt->f(\"company\"),
	   \'x_address\' => \$dbbt->f(\"address_1\"),
	   \'x_city\' => \$dbbt->f(\"city\"),
	   \'x_state\' => \$dbbt->f(\"state\"),
	   \'x_zip\' => \$dbbt->f(\"zip\"),
	   \'x_country\' => \$dbbt->f(\"country\"),
	   \'x_phone\' => \$dbbt->f(\"phone_1\"),
	   \'x_fax\' => \$dbbt->f(\"fax\"),
	   \'x_email\' => \$dbbt->f(\"email\"),
	  
	   // Customer Shipping Address
	   \'x_ship_to_first_name\' => \$dbst->f(\"first_name\"),
	   \'x_ship_to_last_name\' => \$dbst->f(\"last_name\"),
	   \'x_ship_to_company\' => \$dbst->f(\"company\"),
	   \'x_ship_to_address\' => \$dbst->f(\"address_1\"),
	   \'x_ship_to_city\' => \$dbst->f(\"city\"),
	   \'x_ship_to_state\' => \$dbst->f(\"state\"),
	   \'x_ship_to_zip\' => \$dbst->f(\"zip\"),
	   \'x_ship_to_country\' => \$dbst->f(\"country\"),
	  
	   \'x_invoice_num\' => \$db->f(\"order_number\"),
	   \'x_receipt_link_url\' => SECUREURL.\"2checkout_notify.php\"
	   );
	   
	  if( TWOCO_TESTMODE == \"Y\" )
		\$formdata[\'demo\'] = \"Y\";
	  
	   \$version = \"2\";
	   \$url = \"https://www2.2checkout.com/2co/buyer/purchase\";
	   \$formdata[\'x_amount\'] = \$db->f(\"order_total\");
		
	   //build the post string
	   \$poststring = \'\';
	   foreach(\$formdata AS \$key => \$val){
		 \$poststring .= \"<input type=\'hidden\' name=\'\$key\' value=\'\$val\' />
	  \";
	   }
	  
	  ?>
	  <form action=\"<?php echo \$url ?>\" method=\"post\" target=\"_blank\">
	  <?php echo \$poststring ?>
	  <p>Click on the Image below to pay...</p>
	  <input type=\"image\" name=\"submit\" src=\"https://www.2checkout.com/images/buy_logo.gif\" border=\"0\" alt=\"Make payments with 2Checkout, it\'s fast and secure!\" title=\"Pay your Order with 2Checkout, it\'s fast and secure!\" />
	  </form>', '');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES ('', 1, 'NEW_NoChex', 'ps_nochex', 5, '0.00', 0, 'NOCHEX', 'P', 0, 'N', '', '<form action=\"https://www.nochex.com/nochex.dll/checkout\" method=post target=\"_blank\"> 
                                                <input type=\"hidden\" name=\"email\" value=\"<?php echo NOCHEX_EMAIL ?>\" />
                                                <input type=\"hidden\" name=\"amount\" value=\"<?php printf(\"%.2f\", \$db->f(\"order_total\"))?>\" />
                                                <input type=\"hidden\" name=\"ordernumber\" value=\"<?php \$db->p(\"order_id\") ?>\" />
                                                <input type=\"hidden\" name=\"logo\" value=\"<?php echo \$vendor_image_url ?>\" />
                                                <input type=\"hidden\" name=\"returnurl\" value=\"<?php echo SECUREURL .\"index.php?option=com_phpshop&amp;page=checkout.result&amp;order_id=\".\$db->f(\"order_id\") ?>\" />
                                                <input type=\"image\" name=\"submit\" src=\"http://www.nochex.com/web/images/paymeanimated.gif\"> 
                                                </form>', '');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES ('', 1, 'NEW_eWay', 'ps_eway', 5, '0.00', 0, 'EW', 'Y', 0, 'N', '', '', '');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES ('', 1, 'eCheck.net', 'ps_echeck', 5, '0.00', 0, 'ECK', 'B', 0, 'N', '', '', '');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES ('', 1, 'Dankort / PBS', 'ps_pbs', 5, '0.00', 0, 'PBS', 'P', 0, 'N', '', '', '');"); $database->query();
	
	$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_creditcard` (
	`creditcard_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
	`vendor_id` INT( 11 ) NOT NULL,
	`creditcard_name` VARCHAR( 70 ) NOT NULL ,
	`creditcard_code` VARCHAR( 30 ) NOT NULL ,
	PRIMARY KEY ( `creditcard_id` ));"); $database->query();
	
	$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (1, 1, 'Visa', 'VISA');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (2, 1, 'MasterCard', 'MC');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (3, 1, 'American Express', 'amex');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (4, 1, 'Discover Card', 'discover');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (5, 1, 'Diners Club', 'diners');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (6, 1, 'JCB', 'jcb');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (7, 1, 'Australian Bankcard', 'australian_bc');" ); $database->query();
	
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 7, 'addReview', 'ps_reviews', 'process_review', 'This lets the user add a review and rating to a product.', 'admin,storeadmin,shopper,demo');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', '7', 'productReviewDelete', 'ps_reviews', 'delete_review', 'This deletes a review and from a product.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', '2', 'publishProduct', 'ps_product', 'product_publish', 'Changes the product_publish field, so that a product can be published or unpublished easily.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', '2', 'export_csv', 'ps_csv', 'export_csv', 'This function exports all relevant product data to CSV.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', '8', 'creditcardAdd', 'ps_creditcard', 'add', 'Adds a Credit Card entry.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', '8', 'creditcardUpdate', 'ps_creditcard', 'update', 'Updates a Credit Card entry.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', '8', 'creditcardDelete', 'ps_creditcard', 'delete', 'Deletes a Credit Card entry.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'reorder', 'ps_product_category', 'reorder', 'Changes the list order of a category.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'discountAdd', 'ps_product_discount', 'add', 'Adds a discount.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'discountUpdate', 'ps_product_discount', 'update', 'Updates a discount.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'discountDelete', 'ps_product_discount', 'delete', 'Deletes a discount.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 8, 'shippingmethodSave', 'ps_shipping_method', 'save', '', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'uploadProductFile', 'ps_product_files', 'add', 'Uploads and Adds a Product Image/File.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'updateProductFile', 'ps_product_files', 'update', 'Updates a Product Image/File.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'deleteProductFile', 'ps_product_files', 'delete', 'Deletes a Product Image/File.', 'admin,storeadmin');"); $database->query();
	
	$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (12843, 'coupon', 'Coupon Management', 'admin,storeadmin', 'header.ihtml', 'footer.ihtml', 'Y', 99, 'eng', '', '', '', '', '', '', '', '', '', 'Coupon', '', '', '', '');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 12843, 'couponAdd', 'ps_coupon', 'add_coupon_code', 'Adds a Coupon.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 12843, 'couponUpdate', 'ps_coupon', 'update_coupon', 'Updates a Coupon.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 12843, 'couponDelete', 'ps_coupon', 'remove_coupon_code', 'Deletes a Coupon.', 'admin,storeadmin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 12843, 'couponProcess', 'ps_coupon', 'process_coupon_code', 'Processes a Coupon.', 'admin,storeadmin,shopper,demo');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 1, 'stateAdd', 'ps_country', 'addState', 'Add a State ', 'storeadmin,admin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 1, 'stateUpdate', 'ps_country', 'updateState', 'Update a state record', 'storeadmin,admin');"); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 1, 'stateDelete', 'ps_country', 'deleteState', 'Delete a state record', 'storeadmin,admin');"); $database->query();

	$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_discount` (
      `discount_id` int(11) NOT NULL auto_increment,
      `amount` decimal(5,2) NOT NULL default '0.00',
      `is_percent` tinyint(1) NOT NULL default '0',
      `start_date` int(11) NOT NULL default '0',
      `end_date` int(11) NOT NULL default '0',
	  PRIMARY KEY  (`discount_id`)
    ) TYPE=MyISAM;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_shopper_group` ADD `shopper_group_discount` DECIMAL( 3,2 ) DEFAULT '0' NOT NULL AFTER `shopper_group_desc` ;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_vendor` ADD `vendor_currency_display_style` VARCHAR( 64 ) DEFAULT '1|$|2|.| |2|1' NOT NULL ;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_vendor` ADD `vendor_freeshipping` DECIMAL( 10, 2 ) NOT NULL AFTER `vendor_min_pov` ;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_product` ADD `custom_attribute` TEXT NOT NULL;"); $database->query();
	
	$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_files` (
	  `file_id` int(19) NOT NULL auto_increment,
	  `file_product_id` int(11) NOT NULL default '0',
	  `file_name` varchar(128) NOT NULL default '',
	  `file_title` varchar(128) NOT NULL default '',
	  `file_description` mediumtext NOT NULL,
	  `file_extension` varchar(128) NOT NULL default '',
	  `file_mimetype` varchar(64) NOT NULL default '',
	  `file_url` varchar(254) NOT NULL default '',
	  `file_published` tinyint(1) NOT NULL default '0',
	  `file_is_image` tinyint(1) NOT NULL default '0',
	  `file_image_height` int NOT NULL default '0',
	  `file_image_width` int NOT NULL default '0',
	  `file_image_thumb_height` int NOT NULL default '50',
	  `file_image_thumb_width` int NOT NULL default '0',
	  PRIMARY KEY  (`file_id`)
	) TYPE=MyISAM;" ); $database->query();
	$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_coupons` (
	  `coupon_id` int(16) NOT NULL auto_increment,
	  `coupon_code` varchar(32) NOT NULL default '',
	  `percent_or_total` enum('percent','total') NOT NULL default 'percent',
	  `coupon_type` ENUM( 'gift', 'permanent' ) DEFAULT 'gift' NOT NULL,
	  `coupon_value` decimal(10,2) NOT NULL default '0.00',
	  PRIMARY KEY  (`coupon_id`)
	) TYPE=MyISAM AUTO_INCREMENT=6 ;"); $database->query();

	$database->setQuery( "ALTER TABLE `#__pshop_orders` ADD `coupon_discount` DECIMAL( 10, 2 ) NOT NULL AFTER `order_shipping_tax` ;"); $database->query();
	
	$database->setQuery( "ALTER TABLE `#__users` ADD `bank_account_type` ENUM( 'Checking', 'Business Checking', 'Savings' ) DEFAULT 'Checking' NOT NULL ;"); $database->query();
	
	$database->setQuery( "ALTER TABLE `#__pshop_order_payment` ADD `order_payment_trans_id` TEXT NOT NULL ;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_order_payment` ADD `order_payment_code` VARCHAR( 30 ) NOT NULL AFTER `payment_method_id` ;"); $database->query();
		
	$database->setQuery( "ALTER TABLE `#__pshop_order_item` DROP INDEX `idx_order_item_product_id` ;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_order_item` 
	  ADD `order_item_sku` VARCHAR( 64 ) NOT NULL AFTER `product_id` ,
	  ADD `order_item_name` VARCHAR( 64 ) NOT NULL AFTER `order_item_sku` ;"); $database->query();
  
	$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_order_user_info` (
	  `order_info_id` int(11) NOT NULL auto_increment,
	  `order_id` int(11) NOT NULL,
	  `user_id` varchar(32) NOT NULL default '',
	  `address_type` char(2) default NULL,
	  `address_type_name` varchar(32) default NULL,
	  `company` varchar(64) default NULL,
	  `title` varchar(32) default NULL,
	  `last_name` varchar(32) default NULL,
	  `first_name` varchar(32) default NULL,
	  `middle_name` varchar(32) default NULL,
	  `phone_1` varchar(32) default NULL,
	  `phone_2` varchar(32) default NULL,
	  `fax` varchar(32) default NULL,
	  `address_1` varchar(64) NOT NULL default '',
	  `address_2` varchar(64) default NULL,
	  `city` varchar(32) NOT NULL default '',
	  `state` varchar(32) NOT NULL default '',
	  `country` varchar(32) NOT NULL default 'US',
	  `zip` varchar(32) NOT NULL default '',
	  `user_email` varchar(255) default NULL,
      `extra_field_1` varchar(255) default NULL,
      `extra_field_2` varchar(255) default NULL,
      `extra_field_3` varchar(255) default NULL,
      `extra_field_4` char(1) default NULL,
      `extra_field_5` char(1) default NULL,
	  PRIMARY KEY  (`order_info_id`),
	  KEY `idx_order_info_order_id` (`order_id`)
	) TYPE=MyISAM;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_shopper_group` ADD `show_price_including_tax` TINYINT( 1 ) DEFAULT '1' NOT NULL AFTER `shopper_group_discount` ;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_zone_shipping` ADD `zone_tax_rate` INT( 11 ) NOT NULL ;"); $database->query();
	$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_relations` (
		  `product_id` int(11) NOT NULL default '0',
		  `related_products` text,
		  PRIMARY KEY  (`product_id`)
		) TYPE=MyISAM;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_product` CHANGE `product_in_stock` `product_in_stock` INT( 11 ) UNSIGNED DEFAULT NULL "); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_order_item` ADD `product_final_price` DECIMAL( 10, 2 ) NOT NULL AFTER `product_item_price` ;"); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_product_price` CHANGE `product_price` `product_price` DECIMAL( 10, 5 ) DEFAULT NULL "); $database->query();
	$database->setQuery( "ALTER TABLE `#__pshop_product_price` 
							ADD `price_quantity_start` INT( 11 ) UNSIGNED DEFAULT '0' NOT NULL ,
							ADD `price_quantity_end` INT( 11 ) UNSIGNED NOT NULL ;"); $database->query();

	$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_order_history` (
	`order_status_history_id` int( 11 ) NOT NULL AUTO_INCREMENT ,
	`order_id` int( 11 ) NOT NULL default '0',
	`order_status_code` CHAR( 1 ) NOT NULL DEFAULT '0',
	`date_added` datetime NOT NULL default '0000-00-00 00:00:00',
	`customer_notified` int( 1 ) default '0',
	`comments` text,
	PRIMARY KEY ( `order_status_history_id` )
	) TYPE = MYISAM;" ); $database->query();
							
	/** THIS IS FOR MAMBELFISH - INTEGRATION
	******************************************/
	$database->setQuery( "SELECT category_id FROM #__pshop_category ORDER BY cdate" );
	$category_rows = $database->loadObjectList();
	$categories = Array();
	$i = 1;
	foreach( $category_rows as $category_row ) {
	  $categories["old_id"] = $category_row->category_id;
	  // assign the new_id to a Key named like the old_id
	  $categories[$category_row->category_id] = $i++;
	}
	// Now as we have stored the old IDs we can update the table
	// #__pshop_categories
	foreach( $category_rows as $category_row ) {
	  $q = "UPDATE #__pshop_category SET category_id='".$categories[$category_row->category_id]."' WHERE category_id='".$category_row->category_id."'";
	  $database->setQuery( $q ); $database->query();
	}
	// Alter the Table now
	$database->setQuery( "ALTER TABLE `#__pshop_category` CHANGE `category_id` `category_id` INT( 11 ) NOT NULL AUTO_INCREMENT;" ); $database->query();
	
	// Now update the Category XREF Table
	foreach( $category_rows as $category_row ) {
	  $q = "UPDATE #__pshop_category_xref SET category_parent_id='".$categories[$category_row->category_id]."' WHERE category_parent_id='".$category_row->category_id."'";
	  $database->setQuery( $q );  $database->query();
	  $q = "UPDATE #__pshop_category_xref SET category_child_id='".$categories[$category_row->category_id]."' WHERE category_child_id='".$category_row->category_id."'";
	  $database->setQuery( $q );  $database->query();
	}
	// When we have done that, Alter the Table!
	$database->setQuery( "ALTER TABLE `#__pshop_category_xref` 
							CHANGE `category_parent_id` `category_parent_id` INT( 11 ) DEFAULT '0' NOT NULL ,
							CHANGE `category_child_id` `category_child_id` INT( 11 ) DEFAULT '0' NOT NULL;" ); $database->query();
	
	// Now update the Product <-> Category XREF Table
	foreach( $category_rows as $category_row ) {
	  $q = "UPDATE #__pshop_product_category_xref SET category_id='".$categories[$category_row->category_id]."' WHERE category_id='".$category_row->category_id."'";
	  $database->setQuery( $q );  $database->query();
	}
	// Alter the Table now
	$database->setQuery( "ALTER TABLE `#__pshop_product_category_xref` CHANGE `category_id` `category_id` INT( 11 ) NOT NULL;" ); $database->query();
	/*********************************
	END MAMBELFISH ADJUSTMENT **/
	
	$database->setQuery( "ALTER TABLE `#__pshop_product_price` 
							ADD `price_quantity_start` INT( 11 ) UNSIGNED DEFAULT '0' NOT NULL ,
							ADD `price_quantity_end` INT( 11 ) UNSIGNED NOT NULL ;"); $database->query();

	/**
	* Begin Product Types Integration */
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'ProductTypeAdd', 'ps_product_type', 'add', 'Function add a Product Type and create new table product_type_<id>.', 'admin');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'ProductTypeUpdate', 'ps_product_type', 'update', 'Update a Product Type.', 'admin');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'ProductTypeDelete', 'ps_product_type', 'delete', 'Delete a Product Type and drop table product_type_<id>.', 'admin');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'ProductTypeReorder', 'ps_product_type', 'reorder', 'Changes the list order of a Product Type.', 'admin');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'ProductTypeAddParam', 'ps_product_type_parameter', 'add_parameter', 'Function add a Parameter into a Product Type and create new column in table product_type_<id>.', 'admin');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'ProductTypeUpdateParam', 'ps_product_type_parameter', 'update_parameter', 'Function update a Parameter in a Product Type and a column in table product_type_<id>.', 'admin');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'ProductTypeDeleteParam', 'ps_product_type_parameter', 'delete_parameter', 'Function delete a Parameter from a Product Type and drop a column in table product_type_<id>.', 'admin');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'ProductTypeReorderParam', 'ps_product_type_parameter', 'reorder_parameter', 'Changes the list order of a Parameter.', 'admin');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'productProductTypeAdd', 'ps_product_product_type', 'add', 'Add a Product into a Product Type.', 'admin,storeadmin');" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'productProductTypeDelete', 'ps_product_product_type', 'delete', 'Delete a Product from a Product Type.', 'admin,storeadmin');" ); $database->query();
	
	$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_type` (
		  `product_type_id` int(11) NOT NULL auto_increment,
		  `product_type_name` varchar(255) NOT NULL default '',
		  `product_type_description` text default NULL,
		  `product_type_publish` char(1) default NULL,
		  `product_type_browsepage` varchar(255) default NULL,
		  `product_type_flypage` varchar(255) default NULL,
		  `product_type_list_order` int(11) default NULL,
		  PRIMARY KEY (`product_type_id`)
	  ) TYPE=MyISAM;" ); $database->query();
	  
	$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_product_type_xref` (
		  `product_id` int(11) NOT NULL,
		  `product_type_id` int(11) NOT NULL,
		  KEY `idx_product_product_type_xref_product_id` (`product_id`),
		  KEY `idx_product_product_type_xref_product_type_id` (`product_type_id`)
	  ) TYPE=MyISAM;" ); $database->query();
	  
	$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_type_parameter` (
		  `product_type_id` int(11) NOT NULL,
		  `parameter_name` varchar(255) NOT NULL,
		  `parameter_label` varchar(255) NOT NULL default '',
		  `parameter_description` text,
		  `parameter_list_order` int(11) NOT NULL,
		  `parameter_type` char(1) NOT NULL default 'T',
		  `parameter_values` varchar(255) default NULL,
		  `parameter_multiselect` char(1) default NULL,
		  `parameter_default` varchar(255) default NULL,
		  `parameter_unit` varchar(32) default NULL,
		  PRIMARY KEY (`product_type_id`,`parameter_name`),
		  KEY `idx_product_type_parameter_product_type_id` (`product_type_id`),
		  KEY `idx_product_type_parameter_parameter_order` (`parameter_list_order`)
	  ) TYPE=MyISAM;" ); $database->query();
	/**
	* End Product Types Integration */
	
	# States Management; 05.05.2005
	$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_state` (
		`state_id` int(11) NOT NULL auto_increment,
		`country_id` int(11) NOT NULL default '1',
		`state_name` varchar(64) default NULL,
		`state_3_code` char(3) default NULL,
		`state_2_code` char(2) default NULL,
		PRIMARY KEY  (`state_id`),
        UNIQUE KEY `state_3_code` (`state_3_code`,`state_2_code`),
		KEY `idx_country_id` (`country_id`)
	  ) TYPE=MyISAM;" ); $database->query();
	$database->setQuery( "INSERT INTO `#__pshop_state` VALUES
  ('', 223, 'Alabama', 'ALA', 'AL'),  ('', 223, 'Alaska', 'ALK', 'AK'),  ('', 223, 'Arizona', 'ARZ', 'AZ'),
  ('', 223, 'Arkansas', 'ARK', 'AR'),  ('', 223, 'California', 'CAL', 'CA'),  ('', 223, 'Colorado', 'COL', 'CO'),
  ('', 223, 'Connecticut', 'CCT', 'CT'),  ('', 223, 'Delaware', 'DEL', 'DE'),  ('', 223, 'District Of Columbia', 'DOC', 'DC'),
  ('', 223, 'Florida', 'FLO', 'FL'),  ('', 223, 'Georgia', 'GEA', 'GA'),  ('', 223, 'Hawaii', 'HWI', 'HI'),
  ('', 223, 'Idaho', 'IDA', 'ID'),  ('', 223, 'Illinois', 'ILL', 'IL'),  ('', 223, 'Indiana', 'IND', 'IN'),
  ('', 223, 'Iowa', 'IOA', 'IA'),  ('', 223, 'Kansas', 'KAS', 'KS'),  ('', 223, 'Kentucky', 'KTY', 'KY'),
  ('', 223, 'Louisiana', 'LOA', 'LA'),  ('', 223, 'Maine', 'MAI', 'ME'),  ('', 223, 'Maryland', 'MLD', 'MD'),
  ('', 223, 'Massachusetts', 'MSA', 'MA'),  ('', 223, 'Michigan', 'MIC', 'MI'),  ('', 223, 'Minnesota', 'MIN', 'MN'),
  ('', 223, 'Mississippi', 'MIS', 'MS'),  ('', 223, 'Missouri', 'MIO', 'MO'),  ('', 223, 'Montana', 'MOT', 'MT'),
  ('', 223, 'Nebraska', 'NEB', 'NE'),  ('', 223, 'Nevada', 'NEV', 'NV'),  ('', 223, 'New Hampshire', 'NEH', 'NH'),
  ('', 223, 'New Jersey', 'NEJ', 'NJ'),  ('', 223, 'New Mexico', 'NEM', 'NM'),  ('', 223, 'New York', 'NEY', 'NY'),
  ('', 223, 'North Carolina', 'NOC', 'NC'),  ('', 223, 'North Dakota', 'NOD', 'ND'),  ('', 223, 'Ohio', 'OHI', 'OH'),
  ('', 223, 'Oklahoma', 'OKL', 'OK'),  ('', 223, 'Oregon', 'ORN', 'OR'),  ('', 223, 'Pennsylvania', 'PEA', 'PA'),
  ('', 223, 'Rhode Island', 'RHI', 'RI'),  ('', 223, 'South Carolina', 'SOC', 'SC'),  ('', 223, 'South Dakota', 'SOD', 'SD'),
  ('', 223, 'Tennessee', 'TEN', 'TN'),  ('', 223, 'Texas', 'TXS', 'TX'), ('', 223, 'Utah', 'UTA', 'UT'),  
  ('', 223, 'Vermont', 'VMT', 'VT'),  ('', 223, 'Virginia', 'VIA', 'VA'),  ('', 223, 'Washington', 'WAS', 'WA'),  
  ('', 223, 'West Virginia', 'WEV', 'WV'),  ('', 223, 'Wisconsin', 'WIS', 'WI'), ('', 223, 'Wyoming', 'WYO', 'WY'),
  
  ('', 38, 'Alberta', 'ALB', 'AB'),  ('', 38, 'British Columbia', 'BRC', 'BC'),  ('', 38, 'Manitoba', 'MAB', 'MB'),
  ('', 38, 'New Brunswick', 'NEB', 'NB'),  ('', 38, 'Newfoundland and Labrador', 'NFL', 'NL'),  ('', 38, 'Northwest Territories', 'NWT', 'NT'),
  ('', 38, 'Nova Scotia', 'NOS', 'NS'),  ('', 38, 'Nunavut', 'NUT', 'NU'),  ('', 38, 'Ontario', 'ONT', 'ON'),
  ('', 38, 'Prince Edward Island', 'PEI', 'PE'),  ('', 38, 'Quebec', 'QEC', 'QC'),  ('', 38, 'Saskatchewan', 'SAK', 'SK'),
  ('', 38, 'Yukon', 'YUT', 'YT'),  ('', 222, 'England', 'ENG', 'EN'),  ('', 222, 'Northern Ireland', 'NOI', 'NI'),
  ('', 222, 'Scotland', 'SCO', 'SD'),  ('', 222, 'Wales', 'WLS', 'WS'),  ('', 13, 'Australian Capital Territory', 'ACT', 'AT'),
  ('', 13, 'New South Wales', 'NSW', 'NW'),  ('', 13, 'Northern Territory', 'NOT', 'NT'),  ('', 13, 'Queensland', 'QLD', 'QL'),
  ('', 13, 'South Australia', 'SOA', 'SA'),  ('', 13, 'Tasmania', 'TAS', 'TA'),  ('', 13, 'Victoria', 'VIC', 'VI'),  ('', 13, 'Western Australia', 'WEA', 'WA'),
  
  ('', 138, 'Aguascalientes', 'AGS', 'AG'),  ('', 138, 'Baja California Norte', 'BCN', 'BN'),  ('', 138, 'Baja California Sur', 'BCS', 'BS'),
  ('', 138, 'Campeche', 'CAM', 'CA'),  ('', 138, 'Chiapas', 'CHI', 'CS'),  ('', 138, 'Chihuahua', 'CHA', 'CH'),
  ('', 138, 'Coahuila', 'COA', 'CO'),  ('', 138, 'Colima', 'COL', 'CM'),  ('', 138, 'Distrito Federal', 'DFM', 'DF'),
  ('', 138, 'Durango', 'DGO', 'DO'),  ('', 138, 'Guanajuato', 'GTO', 'GO'),  ('', 138, 'Guerrero', 'GRO', 'GU'),
  ('', 138, 'Hidalgo', 'HGO', 'HI'),  ('', 138, 'Jalisco', 'JAL', 'JA'),  ('', 138, 'México (Estado de)', 'EDM', 'EM'),
  ('', 138, 'Michoacán', 'MCN', 'MI'),  ('', 138, 'Morelos', 'MOR', 'MO'),  ('', 138, 'Nayarit', 'NAY', 'NY'),
  ('', 138, 'Nuevo León', 'NUL', 'NL'),  ('', 138, 'Oaxaca', 'OAX', 'OA'),  ('', 138, 'Puebla', 'PUE', 'PU'),
  ('', 138, 'Querétaro', 'QRO', 'QU'),  ('', 138, 'Quintana Roo', 'QUR', 'QR'),  ('', 138, 'San Luis Potosí', 'SLP', 'SP'),
  ('', 138, 'Sinaloa', 'SIN', 'SI'),  ('', 138, 'Sonora', 'SON', 'SO'),  ('', 138, 'Tabasco', 'TAB', 'TA'),
  ('', 138, 'Tamaulipas', 'TAM', 'TM'),  ('', 138, 'Tlaxcala', 'TLX', 'TX'),  ('', 138, 'Veracruz', 'VER', 'VZ'),
  ('', 138, 'Yucatán', 'YUC', 'YU'),  ('', 138, 'Zacatecas', 'ZAC', 'ZA'),
  
  ('', 30, 'Acre', 'ACR', 'AC'),  ('', 30, 'Alagoas', 'ALG', 'AL'),  ('', 30, 'Amapá', 'AMP', 'AP'),
  ('', 30, 'Amazonas', 'AMZ', 'AM'),  ('', 30, 'Bahía', 'BAH', 'BA'),  ('', 30, 'Ceará', 'CEA', 'CE'),
  ('', 30, 'Distrito Federal', 'DFB', 'DF'),  ('', 30, 'Espirito Santo', 'ESS', 'ES'),  ('', 30, 'Goiás', 'GOI', 'GO'),
  ('', 30, 'Maranhão', 'MAR', 'MA'),  ('', 30, 'Mato Grosso', 'MAT', 'MT'),
  ('', 30, 'Mato Grosso do Sul', 'MGS', 'MS'),  ('', 30, 'Minas Geraís', 'MIG', 'MG'),  ('', 30, 'Paraná', 'PAR', 'PR'),
  ('', 30, 'Paraíba', 'PRB', 'PB'),  ('', 30, 'Pará', 'PAB', 'PA'),  ('', 30, 'Pernambuco', 'PER', 'PR'),
  ('', 30, 'Piauí', 'PIA', 'PI'),  ('', 30, 'Rio Grande do Norte', 'RGN', 'RN'),  ('', 30, 'Rio Grande do Sul', 'RGS', 'RS'),
  ('', 30, 'Rio de Janeiro', 'RDJ', 'RJ'),  ('', 30, 'Rondônia', 'RON', 'RO'),
  ('', 30, 'Roraima', 'ROR', 'RR'),  ('', 30, 'Santa Catarina', 'SAC', 'SC'),  ('', 30, 'Sergipe', 'SER', 'SE'),
  ('', 30, 'São Paulo', 'SAP', 'SP'),  ('', 30, 'Tocantins', 'TOC', 'TO'),  
  
  ('', 44, 'Anhui', 'ANH', 'AN'),  ('', 44, 'Beijing', 'BEI', 'BE'),  ('', 44, 'Fujian', 'FUJ', 'FJ'),
  ('', 44, 'Gansu', 'GAN', 'GU'),  ('', 44, 'Guangdong', 'GUA', 'GU'),  ('', 44, 'Guangxi Zhuang', 'GUZ', 'GZ'),
  ('', 44, 'Guizhou', 'GUI', 'GI'),  ('', 44, 'Hainan', 'HAI', 'HA'),  ('', 44, 'Hebei', 'HEB', 'HE'),
  ('', 44, 'Heilongjiang', 'HEI', 'HG'),  ('', 44, 'Henan', 'HEN', 'HN'), 
  ('', 44, 'Hubei', 'HUB', 'HI'),  ('', 44, 'Hunan', 'HUN', 'HU'),  ('', 44, 'Jiangsu', 'JIA', 'JI'),
  ('', 44, 'Jiangxi', 'JIX', 'JX'),  ('', 44, 'Jilin', 'JIL', 'JN'),  ('', 44, 'Liaoning', 'LIA', 'LI'),
  ('', 44, 'Nei Mongol', 'NML', 'NM'),  ('', 44, 'Ningxia Hui', 'NIH', 'NH'),  ('', 44, 'Qinghai', 'QIN', 'QI'),
  ('', 44, 'Shaanxi', 'SHA', 'SH'),  ('', 44, 'Shandong', 'SNG', 'SG'),  ('', 44, 'Shanghai', 'SHH', 'SI'),
  ('', 44, 'Shanxi', 'SHX', 'SX'),  ('', 44, 'Sichuan', 'SIC', 'SN'),  ('', 44, 'Tianjin', 'TIA', 'TI'),
  ('', 44, 'Xinjiang Uygur', 'XIU', 'XU'),  ('', 44, 'Xizang', 'XIZ', 'XI'),  ('', 44, 'Yunnan', 'YUN', 'YU'),  ('', 44, 'Zhejiang', 'ZHE', 'ZH');"); $database->query();
  
  # CSV UPDATE!
  # 18.05.2005
  $database->setQuery( "DROP TABLE IF EXISTS `#__pshop_csv`;"); $database->query();
  $database->setQuery( "CREATE TABLE `#__pshop_csv` (
	`field_id` int(11) NOT NULL auto_increment,
	`field_name` VARCHAR(128) NOT NULL,
	`field_default_value` text,
	`field_ordering` int(3) NOT NULL,
	`field_required` char(1) default 'N',
	PRIMARY KEY  (`field_id`)
  ) TYPE=MyISAM;"); $database->query();
  $database->setQuery( "INSERT INTO `#__pshop_csv` VALUES
	('', 'product_sku', '', 1, 'Y' ),  ('', 'product_s_desc', '', 2, 'N' ),  ('', 'product_desc', '', 3, 'N' ),
	('', 'product_thumb_image', '', 4, 'N' ),  ('', 'product_full_image', '', 5, 'N' ),  ('', 'product_weight', '', 6, 'N' ),
	('', 'product_weight_uom', 'KG', 7, 'N' ),  ('', 'product_length', '', 8, 'N' ),  ('', 'product_width', '', 9, 'N' ),
	('', 'product_height', '', 10, 'N' ),  ('', 'product_lwh_uom', '', 11, 'N' ),  ('', 'product_in_stock', '0', 12, 'N' ),
	('', 'product_available_date', '', 13, 'N' ),  ('', 'product_discount_id', '', 14, 'N' ),  ('', 'product_name', '', 15, 'Y' ),
	('', 'product_price', '', 16, 'N' ),  ('', 'category_path', '', 17, 'Y' ),  ('', 'manufacturer_id', '', 18, 'N' ),
	('', 'product_tax_id', '', 19, 'N' ),  ('', 'product_sales', '', 20, 'N' ),  ('', 'product_parent_id', '0', 21, 'N' ),
	('', 'attribute', '', 22, 'N' ),  ('', 'custom_attribute', '', 23, 'N' ), ('', 'attributes', '', 24, 'N' ),  ('', 'attribute_values', '', 25, 'N' );"); $database->query();
  
  $database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'csvFieldAdd', 'ps_csv', 'add', 'Add a CSV Field ', 'storeadmin,admin');"); $database->query();
  $database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'csvFieldUpdate', 'ps_csv', 'update', 'Update a CSV Field', 'storeadmin,admin');"); $database->query();
  $database->setQuery( "INSERT INTO `#__pshop_function` VALUES ('', 2, 'csvFieldDelete', 'ps_csv', 'delete', 'Delete a CSV Field', 'storeadmin,admin');"); $database->query();
  
  @rename( $mosConfig_absolute_path."/components/com_phpshop/shop_image/ps_image/toplogo.gif", $mosConfig_absolute_path."/administrator/components/com_phpshop/shop_image/ps_image/toplogo.gif" );
  @rename( $mosConfig_absolute_path."/components/com_phpshop/shop_image/ps_image/com_phpshop_poweredby.gif", $mosConfig_absolute_path."/administrator/components/com_phpshop/shop_image/ps_image/com_phpshop_poweredby.gif" );
	
  $database->setQuery( "ALTER TABLE `#__pshop_product` ADD `product_unit` varchar(32);"); $database->query();
  $database->setQuery( "ALTER TABLE `#__pshop_product` ADD `product_packaging` int(11);"); $database->query();
  
  ?> 
