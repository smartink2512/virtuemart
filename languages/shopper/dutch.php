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
$VM_LANG->initModule('shopper',array (
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_SHOPPER_FORM_ADDRESS_LABEL' => 'Nickname Adres',
	'PHPSHOP_SHOPPER_GROUP_LIST_LBL' => 'Klantgroep Lijst',
	'PHPSHOP_SHOPPER_GROUP_LIST_NAME' => 'Groep Naam',
	'PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION' => 'Groep Omschrijving',
	'PHPSHOP_SHOPPER_GROUP_FORM_LBL' => 'Klantengroep Formulier',
	'PHPSHOP_SHOPPER_GROUP_FORM_NAME' => 'Groep Naam',
	'PHPSHOP_SHOPPER_GROUP_FORM_DESC' => 'Groep Omschrijving',
	'PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT' => 'Prijs Korting op standaard Klant Groep (in %)',
	'PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP' => 'Een positief getal X betekent: Als het product geen prijs heeft toegewezen gekregen aan DEZE Klant Groep, de standaard prijs wordt verminderd met X %. Een negatief getal heeft het tegenovergestelde effect.'
	));
?>