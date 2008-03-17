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
        'PHPSHOP_USER_FORM_EMAIL' => 'E-mail',
        'PHPSHOP_SHOPPER_LIST_LBL' => 'Klantenlijst',
        'PHPSHOP_SHOPPER_FORM_BILLTO_LBL' => 'Facturatiegegevens',
        'PHPSHOP_SHOPPER_FORM_USERNAME' => 'Gebruikersnaam',
        'PHPSHOP_AFFILIATE_MOD' => 'Wederverkopers administratie',
        'PHPSHOP_AFFILIATE_LIST_LBL' => 'Wederverkopers lijst',
        'PHPSHOP_AFFILIATE_LIST_AFFILIATE_NAME' => 'Wederverkoper naam',
        'PHPSHOP_AFFILIATE_LIST_AFFILIATE_ACTIVE' => 'Actief',
        'PHPSHOP_AFFILIATE_LIST_RATE' => 'Percentage',
        'PHPSHOP_AFFILIATE_LIST_MONTH_TOTAL' => 'Maand totaal',
        'PHPSHOP_AFFILIATE_LIST_MONTH_COMMISSION' => 'Maandelijkse commissie',
        'PHPSHOP_AFFILIATE_LIST_ORDERS' => 'Bekijk orders',
        'PHPSHOP_AFFILIATE_EMAIL_WHO' => 'E-mail naar wie (* = Allemaal)',
        'PHPSHOP_AFFILIATE_EMAIL_CONTENT' => 'Uw E-mail',
        'PHPSHOP_AFFILIATE_EMAIL_SUBJECT' => 'Het onderwerp',
        'PHPSHOP_AFFILIATE_EMAIL_STATS' => 'Invoegen huidige statistieken',
        'PHPSHOP_AFFILIATE_FORM_RATE' => 'Commisie percentage',
        'PHPSHOP_AFFILIATE_FORM_ACTIVE' => 'Actief?',
        'VM_AFFILIATE_SHOWINGDETAILS_FOR' => 'Toon details voor',
        'VM_AFFILIATE_LISTORDERS' => 'Toon bestellingen',
        'VM_AFFILIATE_MONTH' => 'Maand',
        'VM_AFFILIATE_CHANGEVIEW' => 'Verander overzicht',
        'VM_AFFILIATE_ORDERSUMMARY_LBL' => 'Bestelling overzicht',
        'VM_AFFILIATE_ORDERLIST_ORDERREF' => 'Bestelling referentie',
        'VM_AFFILIATE_ORDERLIST_DATEORDERED' => 'Datum besteld',
        'VM_AFFILIATE_ORDERLIST_ORDERTOTAL' => 'Bestelling totaal',
        'VM_AFFILIATE_ORDERLIST_COMMISSION' => 'Commissie (precentage)',
        'VM_AFFILIATE_ORDERLIST_ORDERSTATUS' => 'Status bestelling'
); $VM_LANG->initModule( 'affiliate', $langvars );
?>
