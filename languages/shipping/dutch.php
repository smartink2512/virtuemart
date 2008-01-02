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
$VM_LANG->initModule('shipping',array (
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_CARRIER_LIST_LBL' => 'Vervoerder Lijst',
	'PHPSHOP_RATE_LIST_LBL' => 'Verzendingstarieven Lijst',
	'PHPSHOP_CARRIER_LIST_NAME_LBL' => 'Naam',
	'PHPSHOP_CARRIER_LIST_ORDER_LBL' => 'Volgorde',
	'PHPSHOP_CARRIER_FORM_LBL' => 'Vervoerder Wijzigen / Aanmaken',
	'PHPSHOP_RATE_FORM_LBL' => 'Verzendtarief Wijzigen / Aanmaken',
	'PHPSHOP_RATE_FORM_NAME' => 'Verzendingstarief Beschrijving',
	'PHPSHOP_RATE_FORM_CARRIER' => 'Vervoerder',
	'PHPSHOP_RATE_FORM_COUNTRY' => 'Land',
	'PHPSHOP_RATE_FORM_ZIP_START' => 'Start Postcode Bereik',
	'PHPSHOP_RATE_FORM_ZIP_END' => 'Einde Postcode Bereik',
	'PHPSHOP_RATE_FORM_WEIGHT_START' => 'Minimaal Gewicht',
	'PHPSHOP_RATE_FORM_WEIGHT_END' => 'Maximum Gewicht',
	'PHPSHOP_RATE_FORM_PACKAGE_FEE' => 'Pakket Kosten',
	'PHPSHOP_RATE_FORM_CURRENCY' => 'Valuta',
	'PHPSHOP_RATE_FORM_LIST_ORDER' => 'Volgorde',
	'PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL' => 'Vervoerder',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME' => 'Verzendingstarief omschrijving',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART' => 'Gewicht van ...',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND' => '... tot',
	'PHPSHOP_CARRIER_FORM_NAME' => 'Vervoerder Bedrijf',
	'PHPSHOP_CARRIER_FORM_LIST_ORDER' => 'Volgorde'
	));
?>