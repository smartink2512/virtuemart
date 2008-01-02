<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : dutch.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Sorry, maar u bent geen geregistreerde klant. Registreert u zich eerst voordat u verder winkelt.',
	'PHPSHOP_THANKYOU' => 'Bedankt voor Uw bestelling.',
	'PHPSHOP_EMAIL_SENDTO' => 'Een bevestigings e-mail is verzonden naar',
	'PHPSHOP_CHECKOUT_NEXT' => 'Volgende',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Rekenings Informatie',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Bedrijf',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Naam',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adres',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'E-mail',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Verzendings Informatie',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Bedrijf',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Naam',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adres',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefoon',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Betalings Methode',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'Verplichte informatie wanneer men kiest voor betaling met kredietkaart',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Bedankt voor de betaling. 
        De transactie was succesvol. U krijgt een bevestigings e-mail voor deze transactie van PayPal. 
        U kan doorgaan of U aanmelden op <a href=http://www.paypal.com>www.paypal.com</a> om de details van de transactie te bekijken.',
	'PHPSHOP_PAYPAL_ERROR' => 'Een fout is opgetreden bij de verwerking van Uw transactie. De status van de bestelling kan niet aangepast worden.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Uw bestelling is succesvol geplaatst',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>