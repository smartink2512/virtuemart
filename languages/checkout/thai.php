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
$VM_LANG->initModule('checkout',array (
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_NO_CUSTOMER' => 'ท่านยังไม่ได้ลงทะเบียน กรุณาระบุรายละเอียดของท่าน',
	'PHPSHOP_THANKYOU' => 'ขอบคุณที่สั่งซื้อสินค้า',
	'PHPSHOP_EMAIL_SENDTO' => 'การยืนยันรายการได้จัดส่งให้ทางอีเมล์แล้ว',
	'PHPSHOP_CHECKOUT_NEXT' => 'ถัดไป',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'ใบแจ้งหนี้',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'บริษัท',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'ชื่อ',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'ที่อยู่',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'อีเมล์',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'รายละเอียดการจัดส่ง',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'บริษัท',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'ชื่อ',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'ที่อยู่',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'โทรศัพท์',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'โทรสาร',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'วิธีการชำระเงิน',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'ระบุรายละเอียดเมื่อเลือกการชำระเงินด้วยบัตรเครดิต',
	'PHPSHOP_PAYPAL_THANKYOU' => 'ขอบคุณสำหรับการชำระเงิน การทำธุรกรรมของท่านเรียบร้อยแล้ว้<br />ท่านจะได้รับอีเมล์ยืนยันการทำรายการจากทาง PayPal ซึ่งท่านสามารถล็อกอินเข้าเข้าไปที่ <a href=http://www.paypal.com>www.paypal.com</a> เพื่อดูรายละเอียดได้',
	'PHPSHOP_PAYPAL_ERROR' => 'เกิดความผิดพลาดระหว่างการทำรายการ สถานะการสั่งซื้อยังไม่ได้เปลี่ยนแปลง',
	'PHPSHOP_THANKYOU_SUCCESS' => 'รายการสั่งซื้อของท่านได้รับการดำเนินการเรียบร้อยแล้ว!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>