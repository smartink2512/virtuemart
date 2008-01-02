<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : norwegian.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Du er enda ikke registrert som kunde. Vennligst skriv inn faktura informasjon.',
	'PHPSHOP_THANKYOU' => 'Takk for bestillingen.',
	'PHPSHOP_EMAIL_SENDTO' => 'Bekreftelse har blitt sendt på e-post til',
	'PHPSHOP_CHECKOUT_NEXT' => 'Neste',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Faktura informasjon',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Firma',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Navn',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adresse',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'E-post',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Leverings informasjon',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Firma',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Navn',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adresse',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefon',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Faks',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Betalingsmåte',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'pliktig informasjon når kredittkort er valgt',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Takk for din betaling. 
',
	'PHPSHOP_PAYPAL_ERROR' => 'En feil har oppstått under betalingstransaksjonen. Statusen på din ordre kan ikke oppdateres.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Din ordre er sendt!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>