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
	'PHPSHOP_NO_CUSTOMER' => 'Du �r inte en registrerad anv�ndare. V�nligen fyll i dina uppgifter.',
	'PHPSHOP_THANKYOU' => 'Tack f�r din best�llning!',
	'PHPSHOP_EMAIL_SENDTO' => 'En orderbekr�ftelse har skickats till',
	'PHPSHOP_CHECKOUT_NEXT' => 'N�sta',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Fakturainformation',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'F�retag',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Namn',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adress',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'E-post',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Leveransinformation',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'F�retag',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Namn',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adress',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefon',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Betalningsmetod',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'Information som beh�vs n�r betalning via kreditkort �r valt.',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Tack f�r din betalning. Transaktionen lyckades. 
                                                                         Du kommer att f� ett bekr�ftelsemail av PayPal. 
                                                                         Du kan nu forts�tta eller logga in p� <a href=http://www.paypal.com>www.paypal.com</a> f�r att se transaktionsdetaljer.',
	'PHPSHOP_PAYPAL_ERROR' => 'An error occured while processing your transaction. The status of your order could not be updated.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Ordern �r registrerad',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>