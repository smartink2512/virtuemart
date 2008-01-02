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
$VM_LANG->initModule('affiliate',array (
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_USER_FORM_EMAIL' => 'E-mail',
	'PHPSHOP_SHOPPER_LIST_LBL' => 'Klanten Lijst',
	'PHPSHOP_SHOPPER_FORM_BILLTO_LBL' => 'Facturatiegegevens',
	'PHPSHOP_SHOPPER_FORM_USERNAME' => 'Gebruikersnaam',
	'PHPSHOP_AFFILIATE_MOD' => 'Wederverkopers Administratie',
	'PHPSHOP_AFFILIATE_LIST_LBL' => 'Wederverkopers Lijst',
	'PHPSHOP_AFFILIATE_LIST_AFFILIATE_NAME' => 'Wederverkoper Naam',
	'PHPSHOP_AFFILIATE_LIST_AFFILIATE_ACTIVE' => 'Actief',
	'PHPSHOP_AFFILIATE_LIST_RATE' => 'Percentage',
	'PHPSHOP_AFFILIATE_LIST_MONTH_TOTAL' => 'Maand Totaal',
	'PHPSHOP_AFFILIATE_LIST_MONTH_COMMISSION' => 'Maandelijkse Commissie',
	'PHPSHOP_AFFILIATE_LIST_ORDERS' => 'Bekijk Orders',
	'PHPSHOP_AFFILIATE_EMAIL_WHO' => 'E-mail naar wie (* = Allemaal)',
	'PHPSHOP_AFFILIATE_EMAIL_CONTENT' => 'Uw E-mail',
	'PHPSHOP_AFFILIATE_EMAIL_SUBJECT' => 'Het onderwerp',
	'PHPSHOP_AFFILIATE_EMAIL_STATS' => 'Invoegen huidige statistieken',
	'PHPSHOP_AFFILIATE_FORM_RATE' => 'Commisie percentage',
	'PHPSHOP_AFFILIATE_FORM_ACTIVE' => 'Actief?'
	));
?>