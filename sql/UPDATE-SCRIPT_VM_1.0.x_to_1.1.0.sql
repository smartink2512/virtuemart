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
INSERT INTO `jos_vm_userfield` VALUES (20, 'delimiter_bankaccount', '_PHPSHOP_ACCOUNT_BANK_TITLE', '', 'delimiter', 25, 30, 0, 21, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (21, 'bank_account_holder', '_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER', '', 'text', 48, 30, 0, 22, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (22, 'bank_account_nr', '_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR', '', 'text', 32, 30, 0, 23, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (23, 'bank_sort_code', '_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE', '', 'text', 16, 30, 0, 24, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (24, 'bank_name', '_PHPSHOP_ACCOUNT_LBL_BANK_NAME', '', 'text', 32, 30, 0, 25, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
INSERT INTO `jos_vm_userfield` VALUES (25, 'bank_account_type', '_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE', '', 'select', 0, 0, 0, 26, 0, 0, '', 0, 1, 1, 1, 1, 0, 1, 1, '');
INSERT INTO `jos_vm_userfield` VALUES (26, 'bank_iban', '_PHPSHOP_ACCOUNT_LBL_BANK_IBAN', '', 'text', 64, 30, 0, 27, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);
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
