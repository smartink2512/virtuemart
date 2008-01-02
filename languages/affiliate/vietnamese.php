<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : vietnamese.php 1071 2007-12-03 08:42:28Z thepisu $
* @package VirtueMart
* @subpackage languages
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
* @translator soeren
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
global $VM_LANG;
$VM_LANG->initModule('affiliate',array (
	'CHARSET' => 'UTF-8',
	'PHPSHOP_USER_FORM_EMAIL' => 'Email',
	'PHPSHOP_SHOPPER_LIST_LBL' => 'Shopper Danh sách',
	'PHPSHOP_SHOPPER_FORM_BILLTO_LBL' => 'Bill To Thông tin',
	'PHPSHOP_SHOPPER_FORM_USERNAME' => 'User Tên',
	'PHPSHOP_AFFILIATE_MOD' => 'Affiliate Administration',
	'PHPSHOP_AFFILIATE_LIST_LBL' => 'Affiliates Liệt kê',
	'PHPSHOP_AFFILIATE_LIST_AFFILIATE_NAME' => 'Affiliate Tên',
	'PHPSHOP_AFFILIATE_LIST_AFFILIATE_ACTIVE' => 'Kích hoạt',
	'PHPSHOP_AFFILIATE_LIST_RATE' => 'Rate',
	'PHPSHOP_AFFILIATE_LIST_MONTH_TOTAL' => 'Month Total',
	'PHPSHOP_AFFILIATE_LIST_MONTH_COMMISSION' => 'Month Commission',
	'PHPSHOP_AFFILIATE_LIST_ORDERS' => 'Liệt kê Orders',
	'PHPSHOP_AFFILIATE_EMAIL_WHO' => 'Who to Email(* = ALL)',
	'PHPSHOP_AFFILIATE_EMAIL_CONTENT' => 'Your Email',
	'PHPSHOP_AFFILIATE_EMAIL_SUBJECT' => 'The Subject',
	'PHPSHOP_AFFILIATE_EMAIL_STATS' => 'Include Current Statistics',
	'PHPSHOP_AFFILIATE_FORM_RATE' => 'Commission Rate (percent)',
	'PHPSHOP_AFFILIATE_FORM_ACTIVE' => 'Kích hoạt?'
	));
?>