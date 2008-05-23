<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : thai.php 1071 2007-12-03 08:42:28Z thepisu $
* @package VirtueMart
* @subpackage languages
* @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
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
	'CHARSET' => 'UTF-8',
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
	'PHPSHOP_PAYPAL_THANKYOU' => 'ขอบคุณสำหรับการชำระเงิน การทำธุรกรรมของท่านเรียบร้อยแล้ว<br />ท่านจะได้รับอีเมล์ยืนยันการทำรายการจากทาง PayPal ซึ่งท่านสามารถล็อกอินเข้าเข้าไปที่ <a href=http://www.paypal.com>www.paypal.com</a> เพื่อดูรายละเอียดได้',
	'PHPSHOP_PAYPAL_ERROR' => 'เกิดความผิดพลาดระหว่างการทำรายการ สถานะการสั่งซื้อยังไม่ได้เปลี่ยนแปลง',
	'PHPSHOP_THANKYOU_SUCCESS' => 'รายการสั่งซื้อของท่านได้รับการดำเนินการเรียบร้อยแล้ว!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s',
	'VM_CHECKOUT_ORDERIDNOTSET' => 'iID รายการไม่ได้ถูกเซท หรือ ไม่มี!',
	'VM_CHECKOUT_FAILURE' => 'ผิดพลาด',
	'VM_CHECKOUT_SUCCESS' => 'สำเร็จ',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_1' => 'หน้านี้อยู่ในหน้าเว็บร้านค้า ของเว็บไซต์.',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_2' => 'เกทเวย์ที่ดำเนินการบนหน้าเว็บไซต์, และแสดงผลลัพธ์ SSL Encrypted.',
	'VM_CHECKOUT_CCV_CODE' => 'Credit Card Validation Code',
	'VM_CHECKOUT_CCV_CODE_TIPTITLE' => 'What\'s the Credit Card Validation Code?',
	'VM_CHECKOUT_MD5_FAILED' => 'MD5 Check failed',
	'VM_CHECKOUT_ORDERNOTFOUND' => 'ไม่พบรายการสั่งซื้อ',
	'VM_CHECKOUT_PBS_APPROVED_ORDERCOMMENT' => ' การติดต่อการชำระเงิน ถูกตรวจสอบโดย PBS. n
                การติดต่อ ได้รับหมายเลขการติดต่อดังนี้ :nn
                หมายเลขการติดต่อ: {transactionnumber}n',
	'VM_CHECKOUT_PBS_NOTAPPROVED_ORDERCOMMENT' => ' การติดต่อการชำระเงิน ไม่ถูกตรวจสอบโดย PBS. n
                การติดต่อ ได้รับหมายเลขการติดต่อดังนี้ :nn
                หมายเลขการติดต่อ: {transactionnumber}n',
	'VM_CHECKOUT_DD_ERROR_0' => 'ตระกร้า/forretningsnummer ugyldigt',
	'VM_CHECKOUT_DD_ERROR_1' => 'Ugyldigt kreditkortnummer',
	'VM_CHECKOUT_DD_ERROR_2' => 'Ugyldigt belob',
	'VM_CHECKOUT_DD_ERROR_3' => 'OrderID mangler eller er ugyldig',
	'VM_CHECKOUT_DD_ERROR_4' => 'PBS afvisning - (Oftest - ugyldig kortdata, sp?rret kort osv...)',
	'VM_CHECKOUT_DD_ERROR_5' => 'Intern server fejl hos DanDomain eller PBS',
	'VM_CHECKOUT_DD_ERROR_6' => 'E-dankort ikke tilladt. Kontakt DanDomain',
	'VM_CHECKOUT_DD_ERROR_DEFAULT' => 'System fejl',
	'VM_CHECKOUT_FP_ERROR_1' => 'Error: ปฏิเสธการติดต่อ',
	'VM_CHECKOUT_FP_ERROR_2' => 'Error: ปฏิเสธการติดต่อ',
	'VM_CHECKOUT_FP_ERROR_3' => 'Error: รูปแบบตัวเลขผิด',
	'VM_CHECKOUT_FP_ERROR_4' => 'Error: รูปแบบไม่ถูกต้องตามกฎ',
	'VM_CHECKOUT_FP_ERROR_5' => 'Error: ไม่มีคำตอบรับ',
	'VM_CHECKOUT_FP_ERROR_6' => 'Error_system_failure',
	'VM_CHECKOUT_FP_ERROR_7' => 'Error: Card หมดอายุ',
	'VM_CHECKOUT_FP_ERROR_8' => 'Error: ระบบติดต่อล้มเหลว',
	'VM_CHECKOUT_FP_ERROR_9' => 'Error: ระบบภายในล้มเหลว',
	'VM_CHECKOUT_FP_ERROR_10' => 'Error: Card ไม่ได้ลงทะเบียน',
	'VM_CHECKOUT_FP_ERROR_DEFAULT' => 'ผิดพลาด: ไม่พบข้อผิดพลาด',
	'VM_CHECKOUT_WF_ERROR_1' => 'Transaktionen blev ikke godkendt',
	'VM_CHECKOUT_WF_ERROR_2' => 'Mulig snyd',
	'VM_CHECKOUT_WF_ERROR_3' => 'Kommunikations fejl',
	'VM_CHECKOUT_WF_ERROR_4' => 'Kort udlobet',
	'VM_CHECKOUT_WF_ERROR_5' => 'Intern fejl',
	'VM_CHECKOUT_WF_ERROR_6' => 'Invalid Transaktion',
	'VM_CHECKOUT_WF_ERROR_7' => 'System fejl',
	'VM_CHECKOUT_WF_ERROR_8' => 'Forkert forretningsnummer',
	'VM_CHECKOUT_WF_ERROR_9' => 'Kortet eksistere ikke',
	'VM_CHECKOUT_WF_ERROR_10' => 'Kort l?ngen er for kort.',
	'VM_CHECKOUT_WF_ERROR_11' => 'Transaktion kan ikke gennemfores igennem denne terminal',
	'VM_CHECKOUT_WF_ERROR_12' => 'Kortejeren har ikke rettigheder til at gennemfore denne transaktion.',
	'VM_CHECKOUT_WF_ERROR_13' => 'Kortnummeret eksistere ikke',
	'VM_CHECKOUT_WF_ERROR_14' => 'ไม่ทราบข้อผิดพลาด',
	'PHPSHOP_EPAY_PAYMENT_CARDTYPE' => 'การชำระเงิน สร้างขึ้นโดย %s <img
src="/components/com_virtuemart/shop_image/ps_image/epay_images/%s"
border="0">'
); $VM_LANG->initModule( 'checkout', $langvars );
?>