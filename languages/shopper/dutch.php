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
* Dutch Translation for Dutchjoomla.org by Frans and Ton  
*
* http://virtuemart.net
*/
global $VM_LANG;
$langvars = array (
        'CHARSET' => 'ISO-8859-1',
        'PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX' => 'Toon prijzen inclusief BTW',
        'PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX_EXPLAIN' => 'Optie om de klanten prijzen te tonen met of zonder belasting.',
        'PHPSHOP_SHOPPER_FORM_ADDRESS_LABEL' => 'Adreslabel',
        'PHPSHOP_SHOPPER_GROUP_LIST_LBL' => 'Klantgroep lijst',
        'PHPSHOP_SHOPPER_GROUP_LIST_NAME' => 'Groep naam',
        'PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION' => 'Groep omschrijving',
        'PHPSHOP_SHOPPER_GROUP_FORM_LBL' => 'Klantengroep formulier',
        'PHPSHOP_SHOPPER_GROUP_FORM_NAME' => 'Groep naam',
        'PHPSHOP_SHOPPER_GROUP_FORM_DESC' => 'Groep omschrijving',
        'PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT' => 'Prijs korting op standaard klantgroep (in %)',
        'PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP' => 'Een positief getal X betekent: Als het product geen prijs heeft toegewezen gekregen aan DEZE klant groep, de standaard prijs wordt verminderd met X %. Een negatief getal heeft het tegenovergestelde effect.'
); $VM_LANG->initModule( 'shopper', $langvars );
?>
