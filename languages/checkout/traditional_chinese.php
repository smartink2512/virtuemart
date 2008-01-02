<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : traditional_chinese.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'CHARSET' => 'BIG5',
	'PHPSHOP_NO_CUSTOMER' => '±zÁÙ¨S¦³µù¥U¦¨¬°·|­û¡C½Ð´£¨Ñ±zªº¤ä¥I¸ê°T¡C',
	'PHPSHOP_THANKYOU' => '·PÁÂ±zªº­qÁÊ.',
	'PHPSHOP_EMAIL_SENDTO' => '¤@«Ê½T»{¶l¥ó¤w±H©¹',
	'PHPSHOP_CHECKOUT_NEXT' => '¤U¤@­Ó',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => '¥I´Ú¸ê°T',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => '¤½¥q',
	'PHPSHOP_CHECKOUT_CONF_NAME' => '©m¦W',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => '¦a§}',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => '°e³f¸ê°T',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => '¤½¥q',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => '©m¦W',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => '¦a§}',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => '¹q¸Ü',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => '¶Ç¯u',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => '¥I´Ú¤è¦¡',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => '·í¿ï¥Î«H¥Î¥d¥I´Ú®Éªº¥²¶ñ¸ê°T',
	'PHPSHOP_PAYPAL_THANKYOU' => '·PÁÂ±zªº¥I´Ú. 
        ¥»¥æ©ö¤w¦¨¥. ±z±N·|¦¬¨ì¥Ñ paypal ©Òµo¥Xªº¥»¦¸¥æ©ö½T»{ email. 
        ±z¥i¥HÄ~Äò©Î¬O°¨¤Wµn¤J <a href=http://www.paypal.com>www.paypal.com</a> ¨Ó½T»{¥æ©ö²Ó¥Ø.',
	'PHPSHOP_PAYPAL_ERROR' => '³B²z¥æ©ö®Éµo¥Í¿ù»~¡A§Aªº­q³æª¬ºAµLªk§ó·s.',
	'PHPSHOP_THANKYOU_SUCCESS' => '±zªº­q³æ¤w¸g¦¨¥´£¥æ',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>