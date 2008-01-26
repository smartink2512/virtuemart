#############################################
# SQL update script for upgrading 
# from VirtueMart 1.0.x to VirtueMart 1.1.0
#
#############################################
 

CREATE TABLE `jos_vm_userfield` (
  `fieldid` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `type` varchar(50) NOT NULL default '',
  `maxlength` int(11) default NULL,
  `size` int(11) default NULL,
  `required` tinyint(4) default '0',
  `ordering` int(11) default NULL,
  `cols` int(11) default NULL,
  `rows` int(11) default NULL,
  `value` varchar(50) default NULL,
  `default` int(11) default NULL,
  `published` tinyint(1) NOT NULL default '1',
  `registration` tinyint(1) NOT NULL default '0',
  `account` tinyint(1) NOT NULL default '1',
  `readonly` tinyint(1) NOT NULL default '0',
  `calculated` tinyint(1) NOT NULL default '0',
  `sys` tinyint(4) NOT NULL default '0',
  `vendor_id` int(11) default NULL,
  `params` mediumtext,
  PRIMARY KEY  (`fieldid`)
) TYPE=MyISAM AUTO_INCREMENT=30 COMMENT='Holds the fields for the user information';

## 
## Dumping data for table `jos_vm_userfield`
## 

INSERT INTO `jos_vm_userfield` VALUES (1, 'email', '_REGISTER_EMAIL', '', 'emailaddress', 100, 30, 1, 2, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (7, 'title', '_PHPSHOP_SHOPPER_FORM_TITLE', '', 'select', 0, 0, 0, 8, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (3, 'password', '_PHPSHOP_SHOPPER_FORM_PASSWORD_1', '', 'password', 25, 30, 1, 4, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (4, 'password2', '_PHPSHOP_SHOPPER_FORM_PASSWORD_2', '', 'password', 25, 30, 1, 5, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (6, 'company', '_PHPSHOP_SHOPPER_FORM_COMPANY_NAME', '', 'text', 64, 30, 0, 7, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (5, 'delimiter_billto', '_PHPSHOP_USER_FORM_BILLTO_LBL', '', 'delimiter', 25, 30, 0, 6, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (2, 'username', '_REGISTER_UNAME', '', 'text', 25, 30, 1, 3, 0, 0, '', 0, 1, 1, 1, 0, 0, 1, 1, '');
INSERT INTO `jos_vm_userfield` VALUES (8, 'first_name', '_PHPSHOP_SHOPPER_FORM_FIRST_NAME', '', 'text', 32, 30, 1, 9, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (9, 'last_name', '_PHPSHOP_SHOPPER_FORM_LAST_NAME', '', 'text', 32, 30, 1, 10, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (10, 'middle_name', '_PHPSHOP_SHOPPER_FORM_MIDDLE_NAME', '', 'text', 32, 30, 0, 11, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (11, 'address_1', '_PHPSHOP_SHOPPER_FORM_ADDRESS_1', '', 'text', 64, 30, 1, 12, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (12, 'address_2', '_PHPSHOP_SHOPPER_FORM_ADDRESS_2', '', 'text', 64, 30, 0, 13, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (13, 'city', '_PHPSHOP_SHOPPER_FORM_CITY', '', 'text', 32, 30, 1, 14, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (14, 'zip', '_PHPSHOP_SHOPPER_FORM_ZIP', '', 'text', 32, 30, 1, 15, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (15, 'country', '_PHPSHOP_SHOPPER_FORM_COUNTRY', '', 'select', 0, 0, 1, 16, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (16, 'state', '_PHPSHOP_SHOPPER_FORM_STATE', '', 'select', 0, 0, 1, 17, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (17, 'phone_1', '_PHPSHOP_SHOPPER_FORM_PHONE', '', 'text', 32, 30, 1, 18, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (18, 'phone_2', '_PHPSHOP_SHOPPER_FORM_PHONE2', '', 'text', 32, 30, 0, 19, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (19, 'fax', '_PHPSHOP_SHOPPER_FORM_FAX', '', 'text', 32, 30, 0, 20, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (20, 'delimiter_bankaccount', '_PHPSHOP_ACCOUNT_BANK_TITLE', '', 'delimiter', 25, 20, 0, 21, NULL, NULL, NULL, NULL, 1, 0, 1, 0, 0, 0, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (21, 'bank_account_holder', '_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER', '', 'text', 48, 20, 0, 22, NULL, NULL, NULL, NULL, 1, 0, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (22, 'bank_account_nr', '_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR', '', 'text', 32, 20, 0, 23, NULL, NULL, NULL, NULL, 1, 0, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (23, 'bank_sort_code', '_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE', '', 'text', 16, 20, 0, 24, NULL, NULL, NULL, NULL, 1, 0, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (24, 'bank_name', '_PHPSHOP_ACCOUNT_LBL_BANK_NAME', '', 'text', 32, 20, 0, 25, NULL, NULL, NULL, NULL, 1, 0, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (25, 'bank_account_type', '_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE', '', 'select', 0, 0, 0, 26, 0, 0, '', 0, 1, 0, 1, 1, 0, 1, 1, '');
INSERT INTO `jos_vm_userfield` VALUES (26, 'bank_iban', '_PHPSHOP_ACCOUNT_LBL_BANK_IBAN', '', 'text', 64, 20, 0, 27, NULL, NULL, NULL, NULL, 1, 0, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (27, 'delimiter_sendregistration', '_BUTTON_SEND_REG', '', 'delimiter', 25, 30, 0, 28, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 0, 0, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (28, 'agreed', '_PHPSHOP_I_AGREE_TO_TOS', '', 'checkbox', NULL, NULL, 1, 29, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (29, 'delimiter_userinfo', '_PHPSHOP_ORDER_PRINT_CUST_INFO_LBL', '', 'delimiter', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (30, 'extra_field_1', '_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_1', '', 'text', 255, 30, 0, 31, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 0, 0, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (31, 'extra_field_2', '_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_2', '', 'text', 255, 30, 0, 32, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 0, 0, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (32, 'extra_field_3', '_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_3', '', 'text', 255, 30, 0, 33, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 0, 0, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (33, 'extra_field_4', '_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_4', '', 'select', 1, 1, 0, 34, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 0, 0, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (34, 'extra_field_5', '_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_5', '', 'select', 1, 1, 0, 35, NULL, NULL, NULL, NULL, 0, 1, 1, 0, 0, 0, 1, NULL);

## --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `jos_vm_userfield_values` (
  `fieldvalueid` int(11) NOT NULL auto_increment,
  `fieldid` int(11) NOT NULL default '0',
  `fieldtitle` varchar(255) NOT NULL default '',
  `fieldvalue` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL default '0',
  `sys` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`fieldvalueid`)
) TYPE=MyISAM COMMENT='Holds the different values for dropdown and radio lists';

INSERT INTO `jos_vm_userfield_values` VALUES (1, 25, '_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_BUSINESSCHECKING', 'Checking', 1, 1);
INSERT INTO `jos_vm_userfield_values` VALUES (2, 25, '_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_CHECKING', 'Business Checking', 2, 1);
INSERT INTO `jos_vm_userfield_values` VALUES (3, 25, '_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_SAVINGS', 'Savings', 3, 1);

INSERT INTO `jos_vm_function` VALUES ('', 1, 'userfieldSave', 'ps_userfield', 'savefield', 'add or edit a user field', 'admin');
INSERT INTO `jos_vm_function` VALUES ('', 1, 'userfieldDelete', 'ps_userfield', 'deletefield', '', 'admin');
INSERT INTO `jos_vm_function` VALUES ('', 1, 'changeordering', 'vmAbstractObject.class', 'handleordering', '', 'admin');
INSERT INTO `jos_vm_function` VALUES ('', 2, 'moveProduct', 'ps_product', 'move', 'Move products from one category to another.', 'admin,storeadmin');


# Allow percentages as payment method discount

ALTER TABLE `jos_vm_payment_method` 
	ADD `payment_method_discount_is_percent` TINYINT( 1 ) NOT NULL AFTER `payment_method_discount` ,
	ADD `payment_method_discount_max_amount` DECIMAL( 10, 2 ) NOT NULL AFTER `payment_method_discount_is_percent` ,
	ADD `payment_method_discount_min_amount` DECIMAL( 10, 2 ) NOT NULL AFTER `payment_method_discount_max_amount` ;

# DHL integration, 29.03.2006
CREATE TABLE IF NOT EXISTS `jos_vm_shipping_label` (
	`order_id` int(11) NOT NULL default '0',
	`shipper_class` varchar(32) default NULL,
	`ship_date` varchar(32) default NULL,
	`service_code` varchar(32) default NULL,
	`special_service` varchar(32) default NULL,
	`package_type` varchar(16) default NULL,
	`order_weight` decimal(10,2) default NULL,
	`is_international` tinyint(1) default NULL,
	`additional_protection_type` varchar(16) default NULL,
	`additional_protection_value` decimal(10,2) default NULL,
	`duty_value` decimal(10,2) default NULL,
	`content_desc` varchar(255) default NULL,
	`label_is_generated` tinyint(1) NOT NULL default '0',
	`tracking_number` varchar(32) default NULL,
	`label_image` blob default NULL,
	`have_signature` tinyint(1) NOT NULL default '0',
	`signature_image` blob default NULL,
	PRIMARY KEY (`order_id`)
) TYPE=MyISAM COMMENT='Stores information used in generating shipping labels';



## Export Modules
CREATE TABLE IF NOT EXISTS `jos_vm_export` (
  `export_id` int(11) NOT NULL auto_increment,
  `vendor_id` int(11) default NULL,
  `export_name` varchar(255) default NULL,
  `export_desc` text NOT NULL,
  `export_class` varchar(50) NOT NULL,
  `export_enabled` char(1) NOT NULL default 'N',
  `export_config` text NOT NULL,
  `iscore` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`export_id`)
) TYPE=MyISAM COMMENT='Export Modules';


# NEW States
INSERT INTO `jos_vm_state` (country_id, state_name, state_3_code, state_2_code)
VALUES
    (104, 'Gaza Strip', 'GZS', 'GZ'),
    (104, 'West Bank', 'WBK', 'WB'),
    (104, 'Other', 'OTH', 'OT'),
    (151, 'St. Maarten', 'STM', 'SM'),
    (151, 'Bonaire', 'BNR', 'BN'),
    (151, 'Curacao', 'CUR', 'CR') ;
# NEW Countries
INSERT INTO `jos_vm_country` (country_name, country_3_code, country_2_code)
VALUES
    ('East Timor', 'XET', 'XE'),
    ('Jersey', 'XJE', 'XJ'),
    ('St. Barthelemy', 'XSB', 'XB'),
    ('St. Eustatius', 'XSE', 'XU'),
    ('Canary Islands', 'XCA', 'XC');
    
# 10.04.2006
ALTER TABLE `jos_vm_product_reviews` ADD `review_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;
ALTER TABLE `jos_vm_product_reviews` ADD UNIQUE ( `product_id` , `userid` );

ALTER TABLE `jos_vm_product_votes` ADD PRIMARY KEY ( `product_id` ) ;
ALTER TABLE `jos_vm_zone_shipping` DROP INDEX `zone_id` 

# 13.04.2006 for JoomFish
ALTER TABLE `jos_vm_product_attribute` ADD `attribute_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;
# Ask a question!
INSERT INTO `jos_vm_function` VALUES (NULL, 7, 'productAsk', 'ps_communication', 'mail_question', 'Lets the customer send a question about a specific product.', 'admin,storeadmin,shopper,demo');
INSERT INTO `jos_vm_function` VALUES (NULL, 2, 'reviewUpdate', 'ps_reviews', 'update', 'Modify a review about a specific product.', 'admin');
INSERT INTO `jos_vm_function` VALUES (NULL, 7, 'recommendProduct', 'ps_communication', 'sendRecommendation', 'Lets the customer send a recommendation about a specific product to a friend.', 'none');
INSERT INTO `jos_vm_function` VALUES (NULL, 8, 'ExportUpdate', 'ps_export', 'update', '', 'admin,storeadmin');
INSERT INTO `jos_vm_function` VALUES (NULL, 8, 'ExportAdd', 'ps_export', 'add', '', 'admin,storeadmin');
INSERT INTO `jos_vm_function` VALUES (NULL, 8, 'ExportDelete', 'ps_export', 'delete', '', 'admin,storeadmin');
INSERT INTO `jos_vm_function` VALUES (NULL, 1, 'writeThemeConfig', 'ps_config', 'writeThemeConfig', 'Writes a theme configuration file.', 'admin');


# Prevent auto-publishing of product reviews
ALTER TABLE `jos_vm_product_reviews` ADD `published` CHAR( 1 ) NOT NULL DEFAULT 'Y';

# 02.05.2006 Multi-Currency Feature
ALTER TABLE `jos_vm_vendor` ADD `vendor_accepted_currencies` TEXT NOT NULL ;

# 12.09.2006 improve category listing performance
ALTER TABLE `jos_vm_category_xref` DROP INDEX `category_xref_category_child_id` ;
ALTER TABLE `jos_vm_category_xref` ADD PRIMARY KEY ( `category_child_id` ) ;

# 13.09.2006 Allow Order Status Descriptions
ALTER TABLE `jos_vm_order_status` ADD `order_status_description` TEXT NOT NULL AFTER `order_status_name`;

# 06.11.2006 Track coupon code used to order
ALTER TABLE `jos_vm_orders` ADD `coupon_code` VARCHAR( 32 ) NULL AFTER `coupon_discount` ;

# 08.11.2006 Allowing new user groups
CREATE TABLE `jos_vm_auth_group` (
	  `group_id` int(11) NOT NULL auto_increment,
	  `group_name` varchar(128) default NULL,
	  `group_level` int(11) default NULL,
	  PRIMARY KEY  (`group_id`)
	) TYPE=MyISAM AUTO_INCREMENT=5 COMMENT='Holds all the user groups' ;

# these are the default user groups
INSERT INTO `jos_vm_auth_group` (`group_id`, `group_name`, `group_level`) VALUES (1, 'admin', 0),(2, 'storeadmin', 250),(3, 'shopper', 500),(4, 'demo', 750);
		
CREATE TABLE `jos_vm_auth_user_group` (
	  `user_id` int(11) NOT NULL default '0',
	  `group_id` int(11) default NULL,
	  PRIMARY KEY  (`user_id`)
	) TYPE=MyISAM COMMENT='Maps the user to user groups';
	
INSERT INTO `jos_vm_auth_user_group` 
				SELECT user_id, 
					CASE `perms` 
					    WHEN 'admin' THEN 0
					    WHEN 'storeadmin' THEN 1
					    WHEN 'shopper' THEN 2
					    WHEN 'demo' THEN 3
					    ELSE 2 
					END
				FROM jos_vm_user_info
				WHERE address_type='BT';
INSERT INTO `jos_vm_function` VALUES 
	(NULL, 1, 'usergroupAdd', 'usergroup.class', 'add', 'Add a new user group', 'admin'),
	(NULL, 1, 'usergroupUpdate', 'usergroup.class', 'update', 'Update an user group', 'admin'),
	(NULL, 1, 'usergroupDelete', 'usergroup.class', 'delete', 'Delete an user group', 'admin');

# Marks Child list options
ALTER TABLE `jos_vm_product` ADD `child_options` varchar(45) default NULL;
ALTER TABLE `jos_vm_product` ADD `quantity_options` varchar(45) default NULL;
ALTER TABLE `jos_vm_product` ADD  `child_option_ids` varchar(45) default NULL;
ALTER TABLE `jos_vm_product` ADD  `product_order_levels` varchar(45) default NULL;

# 20.01.2007: Udate Module and Function permissions directly from the list 
INSERT INTO `jos_vm_function` (`function_id`, `module_id`, `function_name`, `function_class`, `function_method`, `function_description`, `function_perms`) VALUES 
	(null, 1, 'setModulePermissions', 'ps_module', 'update_permissions', '', 'admin'),
	(null, 1, 'setFunctionPermissions', 'ps_function', 'update_permissions', '', 'admin');

	
# Mail Download ID and re-insert downloads for a product
INSERT INTO `jos_vm_function` (`function_id`, `module_id`, `function_name`, `function_class`, `function_method`, `function_description`, `function_perms`) 
	VALUES (185, 2, 'insertDownloadsForProduct', 'ps_order', 'insert_downloads_for_product', '', 'admin'),
			(186, 5, 'mailDownloadId', 'ps_order', 'mail_download_id', '', 'storeadmin,admin');

# 12.04.2007 Cart Storage
CREATE TABLE `jos_vm_cart` (
`user_id` INT( 11 ) NOT NULL ,
`cart_content` TEXT NOT NULL ,
`last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY ( `user_id` )
) TYPE = MYISAM COMMENT = 'Stores the cart contents of a user';

ALTER TABLE `jos_vm_product_reviews` CHANGE `product_id` `product_id` INT( 11 ) NOT NULL 

# 25.07.2007: Allow to set address and date format
ALTER TABLE `jos_vm_vendor` 
				ADD `vendor_address_format` TEXT NOT NULL ;
ALTER TABLE `jos_vm_vendor` 
				ADD `vendor_date_format` VARCHAR( 255 ) NOT NULL;
UPDATE `jos_vm_vendor` SET
			`vendor_address_format` = '{storename}\n{address_1}\n{address_2}\n{city}, {zip}',
			`vendor_date_format` = '%A, %d %B %Y %H:%M'
			WHERE vendor_id=1;
			
UPDATE `jos_components` SET `params` = 'RELEASE=1.1.0\nDEV_STATUS=beta2' WHERE `name` = 'virtuemart_version';