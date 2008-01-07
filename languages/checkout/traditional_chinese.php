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
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s',
	'VM_CHECKOUT_ORDERIDNOTSET' => 'Order ID is not set or emtpy!',
	'VM_CHECKOUT_FAILURE' => 'Failure',
	'VM_CHECKOUT_SUCCESS' => 'Success',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_1' => 'This page is located on the webshop\'s website.',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_2' => 'The gateway execute the page on the website, and the shows the result SSL Encrypted.',
	'VM_CHECKOUT_CCV_CODE' => 'Credit Card Validation Code',
	'VM_CHECKOUT_CCV_CODE_TIPTITLE' => 'What\'s the Credit Card Validation Code?',
	'VM_CHECKOUT_MD5_FAILED' => 'MD5 Check failed',
	'VM_CHECKOUT_ORDERNOTFOUND' => 'Order not found',
	'VM_CHECKOUT_PBS_APPROVED_ORDERCOMMENT' => '
                The Payment Transaction was approved by PBS. \n
                The Transaction has received the following Transaction Number:\n\n
                Transaction Number: {transactionnumber}\n',
	'VM_CHECKOUT_PBS_NOTAPPROVED_ORDERCOMMENT' => '
                The Payment Transaction was not approved by PBS. \n
                The Transaction has received the following Transaction Number:\n\n
                Transaction Number: {transactionnumber}\n',
	'VM_CHECKOUT_DD_ERROR_0' => 'Merchant/forretningsnummer ugyldigt',
	'VM_CHECKOUT_DD_ERROR_1' => 'Ugyldigt kreditkortnummer',
	'VM_CHECKOUT_DD_ERROR_2' => 'Ugyldigt belob',
	'VM_CHECKOUT_DD_ERROR_3' => 'OrderID mangler eller er ugyldig',
	'VM_CHECKOUT_DD_ERROR_4' => 'PBS afvisning - (Oftest - ugyldig kortdata, sp?rret kort osv...)',
	'VM_CHECKOUT_DD_ERROR_5' => 'Intern server fejl hos DanDomain eller PBS',
	'VM_CHECKOUT_DD_ERROR_6' => 'E-dankort ikke tilladt. Kontakt DanDomain',
	'VM_CHECKOUT_DD_ERROR_DEFAULT' => 'System fejl',
	'VM_CHECKOUT_FP_ERROR_1' => 'Error: Transaction declined',
	'VM_CHECKOUT_FP_ERROR_2' => 'Error: Transaction declined',
	'VM_CHECKOUT_FP_ERROR_3' => 'Error: wrong number format',
	'VM_CHECKOUT_FP_ERROR_4' => 'Error: illegal transaction',
	'VM_CHECKOUT_FP_ERROR_5' => 'Error: no answer',
	'VM_CHECKOUT_FP_ERROR_6' => 'Error_system_failure',
	'VM_CHECKOUT_FP_ERROR_7' => 'Error: Card expired',
	'VM_CHECKOUT_FP_ERROR_8' => 'Error: Communication Failure',
	'VM_CHECKOUT_FP_ERROR_9' => 'Error: Internal Failure',
	'VM_CHECKOUT_FP_ERROR_10' => 'Error: Card not registered',
	'VM_CHECKOUT_FP_ERROR_DEFAULT' => 'Error: unknown Error',
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
	'VM_CHECKOUT_WF_ERROR_14' => 'Error unknown'
	));
?>