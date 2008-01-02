<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : swedish.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Du är inte en registrerad användare. Vänligen fyll i dina uppgifter.',
	'PHPSHOP_THANKYOU' => 'Tack för din beställning!',
	'PHPSHOP_EMAIL_SENDTO' => 'En orderbekräftelse har skickats till',
	'PHPSHOP_CHECKOUT_NEXT' => 'Nästa',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Fakturainformation',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Företag',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Namn',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adress',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'E-post',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Leveransinformation',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Företag',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Namn',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adress',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefon',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Betalningsmetod',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'Information som behövs när betalning via kreditkort är valt.',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Tack för din betalning. Transaktionen lyckades. 
                                                                         Du kommer att få ett bekräftelsemail av PayPal. 
                                                                         Du kan nu fortsätta eller logga in på <a href=http://www.paypal.com>www.paypal.com</a> för att se transaktionsdetaljer.',
	'PHPSHOP_PAYPAL_ERROR' => 'An error occured while processing your transaction. The status of your order could not be updated.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Ordern är registrerad',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>