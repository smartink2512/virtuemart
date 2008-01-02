<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : finnish.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'CHARSET' => 'ISO-8859-15',
	'PHPSHOP_NO_CUSTOMER' => 'Valitan, mutta et ole rekisteröitynyt asiakas.<BR>
                                    Ole hyvä ja rekisteröidy ensin.',
	'PHPSHOP_THANKYOU' => 'Kiitoksia Tilauksestasi.',
	'PHPSHOP_EMAIL_SENDTO' => 'Vahvistus on lähetetty sähköpostilla',
	'PHPSHOP_CHECKOUT_NEXT' => 'Seuraava',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Laskutus Tiedot',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Yritys',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Nimi',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Osoite',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Huolinta Tiedot',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Yritys',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Nimi',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Oosite',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Puhelin',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Maksu Tapa',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'tarvittavat tiedot Luottokortilla maksettaessa',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Kiitoksia maksusta. 
        Suoritus onnistui. Sinulle lähetään vahvistus sähköpostilla suorituksesta PayPal:ista. 
        Voit nyt jatkaa tai kirjautua sisään <a href=http://www.paypal.com>www.paypal.com</a> nähdäksesi tiedot suorituksesta.',
	'PHPSHOP_PAYPAL_ERROR' => 'Suorituksesi käsittelyn aikana tapahtui VIRHE. Tilauksesi tilaa ei voitu päivittää.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Your order has been successfully placed!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>