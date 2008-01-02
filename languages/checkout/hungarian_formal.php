<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : hungarian_formal.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => '�n m�g nem nyilv�ntartott �gyf�l. K�rem, adja meg a sz�ml�z�si inform�ci�it.',
	'PHPSHOP_THANKYOU' => 'K�sz�nj�k a megrendel�st!',
	'PHPSHOP_EMAIL_SENDTO' => 'A meger�s�t� e-mail elk�ldve az al�bbi c�mre',
	'PHPSHOP_CHECKOUT_NEXT' => 'K�vetkez�',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Sz�ml�z�si inform�ci�',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'C�g',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'N�v',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'C�m',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'E-mail',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Sz�ll�t�si inform�ci�',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'C�g',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'N�v',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'C�m',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefon',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Kifizet�si elj�r�s',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'k�rt inform�ci� amikor hitelk�rty�s kifizet�s van kiv�lasztva',
	'PHPSHOP_PAYPAL_THANKYOU' => 'K�sz�nj�k a kifizet�st. A tranzakci� sikeres volt. A PayPal e-mailben fogja �rtes�teni a tranzakci� r�szleteir�l. Most folytathatja, vagy bejelentkezhet a <a href=http://www.paypal.com>www.paypal.com</a> -ra hogy megtekintse a tranzakci� r�szleteit.',
	'PHPSHOP_PAYPAL_ERROR' => 'A tranzakci� feldolgoz�sa k�zben hiba t�rt�nt. A megrendel�se st�tus�t nem lehet friss�teni.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'A megrendel�se sikeresen meg�rkezett!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>