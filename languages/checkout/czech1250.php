<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : czech1250.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Nejste ještì registrovaný zákazník, zadejte prosím fakturaèní údaje.',
	'PHPSHOP_THANKYOU' => 'Dìkujeme vám za vaši objednávku.',
	'PHPSHOP_EMAIL_SENDTO' => 'E-mail s potvrzením byl zaslán na adresu',
	'PHPSHOP_CHECKOUT_NEXT' => 'Další',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Fakturaèní údaje',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Firma',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Jméno',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adresa',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'e-mail',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Údaje pro dodání',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Firma',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Jméno',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adresa',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefon',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Zpùsob platby',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'požadované údaje pøi platbì kreditní kartou',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Dìkujeme Vám za Vaši platbu. 
        The transaction was successful. You will get a confirmation e-mail for the transaction by PayPal. 
        You can now continue or log in at <a href=http://www.paypal.com>www.paypal.com</a> to see the transaction details.',
	'PHPSHOP_PAYPAL_ERROR' => 'An error occured while processing your transaction. The status of your order could not be updated.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Vaše objednávka byla úspìšnì pøijata!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>