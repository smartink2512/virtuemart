<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : german.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Sie sind leider noch kein registrierter Kunde. Bitte hinterlassen Sie uns Ihre Rechnungsadresse.',
	'PHPSHOP_THANKYOU' => 'Danke f�r Ihre Bestellung.',
	'PHPSHOP_EMAIL_SENDTO' => 'Eine Best�tigungs-email wurde versandt an',
	'PHPSHOP_CHECKOUT_NEXT' => 'Weiter',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Rechnungsinformationen',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Firma',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Name',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adresse',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Lieferinformationen',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Firma',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Name',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adresse',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefon',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Bezahlung per',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'nur notwendig, falls Zahlung per Kreditkarte gew�hlt wird.',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Danke f�r Ihre Zahlung. 
        Ihre Transaktion wurde abgeschlossen und Sie erhalten per E-Mail eine Quittung f�r Ihren Kauf. 
        Sie k�nnen sich unter <a href=http://www.paypal.com>www.paypal.com</a> in Ihr Konto einloggen, um die Transaktionsdetails anzuzeigen.',
	'PHPSHOP_PAYPAL_ERROR' => 'Achtung, bei der Transaktion ist m�glicherweise ein Fehler aufgetreten. Der Status der Bestellung
        konnte nicht aktualisiert werden.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Ihre Bestellung wurde erfolgreich gespeichert! Wir werdem umgehend mit der Bearbeitung der Bestellung beginnen.',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>