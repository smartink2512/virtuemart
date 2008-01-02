<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : turkish.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Henüz kayýtlý kullnýcý deðilsiniz. Lütfen Fatura bilgilerinizi giriniz.',
	'PHPSHOP_THANKYOU' => 'Sipariþiniz için teþekkürler.',
	'PHPSHOP_EMAIL_SENDTO' => 'Teyit iletisinin gönderildiði e-posta adresi',
	'PHPSHOP_CHECKOUT_NEXT' => 'Sonraki',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Ödeme Bilgisi',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Firma',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Ýsim',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adres',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'E-posta',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Nakliye Bilgisi',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Firma',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Ýsim',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adres',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Tel.',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Faks',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Ödeme Yöntemi',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'Kredi Kartý ile Ödeme seçildiðinde istenen bilgi',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Ödemeniz için teþekkürler. 
        Ödeme Ýþleminiz baþarýyla gerçekleþmiþtir. Bu iþleminiz için PayPal. tarafýndan e-posta adresinize bir teyit iletisi gönderilecektir.
        Alýþveriþinize devam edebilir ya da  <a href=http://www.paypal.com>www.paypal.com</a> sitesinde bir oturum açarak ödeme iþleminizin detaylarýný görebilirsiniz.',
	'PHPSHOP_PAYPAL_ERROR' => 'Ödeme iþleminiz gerçekleþirken bir HATA oluþtu. Sipariþ durumu günlenemiyecek.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Sipariþiniz alýndý!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>