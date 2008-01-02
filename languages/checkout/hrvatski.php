<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : hrvatski.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Jo� niste registrirani. Molimo vas da upi�ete podatke za slanje ra�una.',
	'PHPSHOP_THANKYOU' => 'Hvala na Va�oj narud�bi.',
	'PHPSHOP_EMAIL_SENDTO' => 'E-mail sa potvrdom je poslan',
	'PHPSHOP_CHECKOUT_NEXT' => 'Nastavak',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Pla�anje',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Poduze�e',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Naziv',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adresa',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Dostava',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Poduze�e',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Naziv',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adresa',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefon',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Na�in pla�anja',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'potrebne informacije prilikom pla�anja kreditnom karticom',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Hvala na uplati.
        Transakcija je uspje�no dovr�ena. Primit �ete konfirmacijski Email za transakciju putem PayPala.
        Mo�ete se prijaviti na <a href=http://www.paypal.com>www.paypal.com</a> da vidite detalje transakcije.',
	'PHPSHOP_PAYPAL_ERROR' => 'Gre�ka prilikom obrade transakcije. Status va�e narud�be nije mogao biti a�uriran.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Va�a narud�ba je uspje�no primljena!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>