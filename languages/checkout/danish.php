<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : danish.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'De er endnu ikke registreret som kunde. Vær venlig at indtaste faktureringsoplysningerne.',
	'PHPSHOP_THANKYOU' => 'Tak for Deres ordre.',
	'PHPSHOP_EMAIL_SENDTO' => 'En email der bekræfter Deres ordre er blevet sendt til',
	'PHPSHOP_CHECKOUT_NEXT' => 'Næste',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Billing Information',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Firma',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Navn',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adresse',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Leveringsinformation',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Firma',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Navn',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adresse',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefon',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Betalingsform',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'krævet information når betaling via betalingskort er valgt',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Tak for Deres betaling. 
        Overførslen lykkedes. De vil modtage en bekræftelsese-mail for transaktionen fra PayPal. 
        De kan nu vælge at fortsætte eller at logge ind på <a href=http://www.paypal.com>www.paypal.com</a> for at se transaktionsdetaljerne.',
	'PHPSHOP_PAYPAL_ERROR' => 'Der opstod en fejl under overførslen. Ordrestatus for Deres ordre kunne ikke opdateres.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Deres ordre er modtaget!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>