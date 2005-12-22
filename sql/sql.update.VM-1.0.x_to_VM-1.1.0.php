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

$db->query( "CREATE TABLE IF NOT EXISTS `#__{vm}_userfield` (
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
) TYPE=MyISAM AUTO_INCREMENT=30 COMMENT='Holds the fields for the user information';" );

## 
## Dumping data for table `#__{vm}_userfield`
## 

$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (1, 'email', '_REGISTER_EMAIL', '', 'emailaddress', 100, 30, 1, 2, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (7, 'title', '_PHPSHOP_SHOPPER_FORM_TITLE', '', 'select', 0, 0, 0, 8, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (3, 'password', '_PHPSHOP_SHOPPER_FORM_PASSWORD_1', '', 'password', 25, 30, 1, 4, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (4, 'password2', '_PHPSHOP_SHOPPER_FORM_PASSWORD_2', '', 'password', 25, 30, 1, 5, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (6, 'company', '_PHPSHOP_SHOPPER_FORM_COMPANY_NAME', '', 'text', 64, 30, 0, 7, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (5, 'delimiter_billto', '_PHPSHOP_USER_FORM_BILLTO_LBL', '', 'delimiter', 25, 30, 0, 6, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (2, 'username', '_REGISTER_UNAME', '', 'text', 25, 30, 1, 3, 0, 0, '', 0, 1, 1, 1, 0, 0, 1, 1, '');" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (8, 'first_name', '_PHPSHOP_SHOPPER_FORM_FIRST_NAME', '', 'text', 32, 30, 1, 9, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (9, 'last_name', '_PHPSHOP_SHOPPER_FORM_LAST_NAME', '', 'text', 32, 30, 1, 10, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (10, 'middle_name', '_PHPSHOP_SHOPPER_FORM_MIDDLE_NAME', '', 'text', 32, 30, 0, 11, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (11, 'address_1', '_PHPSHOP_SHOPPER_FORM_ADDRESS_1', '', 'text', 64, 30, 1, 12, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (12, 'address_2', '_PHPSHOP_SHOPPER_FORM_ADDRESS_2', '', 'text', 64, 30, 0, 13, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (13, 'city', '_PHPSHOP_SHOPPER_FORM_CITY', '', 'text', 32, 30, 1, 14, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (14, 'zip', '_PHPSHOP_SHOPPER_FORM_ZIP', '', 'text', 32, 30, 1, 15, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (15, 'country', '_PHPSHOP_SHOPPER_FORM_COUNTRY', '', 'select', 0, 0, 1, 16, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (16, 'state', '_PHPSHOP_SHOPPER_FORM_STATE', '', 'select', 0, 0, 1, 17, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (17, 'phone_1', '_PHPSHOP_SHOPPER_FORM_PHONE', '', 'text', 32, 30, 1, 18, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (18, 'phone_2', '_PHPSHOP_SHOPPER_FORM_PHONE2', '', 'text', 32, 30, 0, 19, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (19, 'fax', '_PHPSHOP_SHOPPER_FORM_FAX', '', 'text', 32, 30, 0, 20, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (20, 'delimiter_bankaccount', '_PHPSHOP_ACCOUNT_BANK_TITLE', '', 'delimiter', 25, 30, 0, 21, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (21, 'bank_account_holder', '_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER', '', 'text', 48, 30, 0, 22, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (22, 'bank_account_nr', '_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR', '', 'text', 32, 30, 0, 23, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (23, 'bank_sort_code', '_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE', '', 'text', 16, 30, 0, 24, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (24, 'bank_name', '_PHPSHOP_ACCOUNT_LBL_BANK_NAME', '', 'text', 32, 30, 0, 25, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (25, 'bank_account_type', '_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE', '', 'select', 0, 0, 0, 26, 0, 0, '', 0, 1, 1, 1, 1, 0, 1, 1, '');" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (26, 'bank_iban', '_PHPSHOP_ACCOUNT_LBL_BANK_IBAN', '', 'text', 64, 30, 0, 27, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (27, 'delimiter_sendregistration', '_BUTTON_SEND_REG', '', 'delimiter', 25, 30, 0, 28, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 0, 0, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (28, 'agreed', '_PHPSHOP_I_AGREE_TO_TOS', '', 'checkbox', NULL, NULL, 1, 29, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 0, 1, 1, NULL);" );
$db->query( "INSERT INTO `#__{vm}_userfield` VALUES (29, 'delimiter_userinfo', '_PHPSHOP_ORDER_PRINT_CUST_INFO_LBL', '', 'delimiter', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 1, NULL);" );

## --------------------------------------------------------


$db->query( "CREATE TABLE IF NOT EXISTS `#__{vm}_userfield_values` (
  `fieldvalueid` int(11) NOT NULL auto_increment,
  `fieldid` int(11) NOT NULL default '0',
  `fieldtitle` varchar(50) NOT NULL default '',
  `ordering` int(11) NOT NULL default '0',
  `sys` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`fieldvalueid`)
) TYPE=MyISAM COMMENT='Holds the different values for dropdown and radio lists';" );

$db->query( "INSERT INTO `#__{vm}_function` VALUES ('', 1, 'userfieldSave', 'ps_userfield', 'savefield', 'add or edit a user field', 'admin');" );
$db->query( "INSERT INTO `#__{vm}_function` VALUES ('', 1, 'userfieldDelete', 'ps_userfield', 'deletefield', '', 'admin');" );
$db->query( "INSERT INTO `#__{vm}_function` VALUES ('', 1, 'changeordering', 'vmAbstractObject.class', 'handleordering', '', 'admin');" );
$db->query( "INSERT INTO `#__{vm}_function` VALUES ('', 2, 'moveProduct', 'ps_product', 'move', 'Move products from one category to another.', 'admin,storeadmin');" );

?>