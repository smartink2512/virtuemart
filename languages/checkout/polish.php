<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : polish.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Nie jeste¶ jeszcze zarejestrowanym klientem. Prosimy o wprowadzenie swoich danych.',
	'PHPSHOP_THANKYOU' => 'Dziêkujemy za zamówienie.',
	'PHPSHOP_EMAIL_SENDTO' => 'Potwierdzenie zamówienia zosta³o wys³ane do',
	'PHPSHOP_CHECKOUT_NEXT' => 'Nastêpny',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Dane klienta',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Firma',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Nazwa',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adres',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Informacje o wysy³ce',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Firma',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Nazwa',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adres',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefon',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Faks',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Metoda p³atno¶ci',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'informacja wymagana je¶li wybrana zosta³a p³atno¶æ kart± kredytow±',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Dziêkujemy za dokonan± p³atno¶æ. 
        Transakcja przebieg³a pomy¶lnie. Otrzymasz potwierdzenie transakcji od PayPal poprzez email. 
        Mo¿esz teraz kontynuowaæ lub zalogowaæ siê na <a href=http://www.paypal.com>www.paypal.com</a>, aby zobaczyæ szczegó³y transakcji.',
	'PHPSHOP_PAYPAL_ERROR' => 'Podczas transakcji wyst±pi³ b³±d. Stan Twojego zamówienia nie mo¿e zostaæ zaktualizowany.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Twoje zamówienie zosta³o pomy¶lnie wys³ane!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>