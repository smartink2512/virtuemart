<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : thai.php 1071 2007-12-03 08:42:28Z thepisu $
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
$langvars = array (
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_USER_FORM_EMAIL' => 'อีเมล์',
	'PHPSHOP_SHOPPER_LIST_LBL' => 'ผู้ซื้อ',
	'PHPSHOP_SHOPPER_FORM_BILLTO_LBL' => 'ที่อยู่ใบแจ้งหนี้',
	'PHPSHOP_SHOPPER_FORM_USERNAME' => 'ชื่อผู้ใช้งาน',
	'PHPSHOP_AFFILIATE_MOD' => 'ผู้ดูแลระบบสมาชิกเครือข่าย',
	'PHPSHOP_AFFILIATE_LIST_LBL' => 'สมาชิกเครือข่าย',
	'PHPSHOP_AFFILIATE_LIST_AFFILIATE_NAME' => 'ชื่อสมาชิก',
	'PHPSHOP_AFFILIATE_LIST_AFFILIATE_ACTIVE' => 'เลือก',
	'PHPSHOP_AFFILIATE_LIST_RATE' => 'อัตรา',
	'PHPSHOP_AFFILIATE_LIST_MONTH_TOTAL' => 'จำนวนเดือน',
	'PHPSHOP_AFFILIATE_LIST_MONTH_COMMISSION' => 'ค่าคอมมิชชั่น',
	'PHPSHOP_AFFILIATE_LIST_ORDERS' => 'เรียงลำดับ',
	'PHPSHOP_AFFILIATE_EMAIL_WHO' => 'อีเมล์ถึง (* = ทั้งหมด)',
	'PHPSHOP_AFFILIATE_EMAIL_CONTENT' => 'อีเมล์ของท่าน',
	'PHPSHOP_AFFILIATE_EMAIL_SUBJECT' => 'หัวข้อ',
	'PHPSHOP_AFFILIATE_EMAIL_STATS' => 'รวมสถิติปัจจุบัน',
	'PHPSHOP_AFFILIATE_FORM_RATE' => 'อัตราค่าคอมมิชชั่น (เปอร์เซ็นต์)',
	'PHPSHOP_AFFILIATE_FORM_ACTIVE' => 'เลือก?',
	'VM_AFFILIATE_SHOWINGDETAILS_FOR' => 'Showing Details for',
	'VM_AFFILIATE_LISTORDERS' => 'List Orders',
	'VM_AFFILIATE_MONTH' => 'Month',
	'VM_AFFILIATE_CHANGEVIEW' => 'Change View',
	'VM_AFFILIATE_ORDERSUMMARY_LBL' => 'Order Summary',
	'VM_AFFILIATE_ORDERLIST_ORDERREF' => 'Order Ref',
	'VM_AFFILIATE_ORDERLIST_DATEORDERED' => 'Date Ordered',
	'VM_AFFILIATE_ORDERLIST_ORDERTOTAL' => 'Order Total',
	'VM_AFFILIATE_ORDERLIST_COMMISSION' => 'Commission (rate)',
	'VM_AFFILIATE_ORDERLIST_ORDERSTATUS' => 'Order Status'
); $VM_LANG->initModule( 'affiliate', $langvars );
?>