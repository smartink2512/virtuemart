<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : romanian.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Nu sunteti client inregistrat. Va rugam completati cu datele de achitare.',
	'PHPSHOP_THANKYOU' => 'Va multumim pentru comanda.',
	'PHPSHOP_EMAIL_SENDTO' => 'Un email de confirmare a fost trimis la',
	'PHPSHOP_CHECKOUT_NEXT' => 'Urmatorul',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Informatii facturare',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Companie',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Nume',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adresa',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Informatii expediere',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Companie',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Nume',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adresa',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefon',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Modalitate plata',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'informatii cerute cand plata se face prin credit card',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Multumim pentru plata. 
        Tranzactia s-a incheiat cu succes. Veti primi un e-mail de confirmare a tranzactiei prin PayPal. 
        Acm puteti continua sau sa va logati la <a href=http://www.paypal.com>www.paypal.com</a> pentru a vedea detaliile tranzactiei.',
	'PHPSHOP_PAYPAL_ERROR' => 'A aparut o eroare in timpul procesarii tranzactiei dvs. Statutul comenzii dvs nu a putut fi updatat.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Comanda dvs a fost luata cu succes!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>