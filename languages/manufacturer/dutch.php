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
$langvars = array (
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_MANUFACTURER_LIST_LBL' => 'Fabrikanten Lijst',
	'PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME' => 'Fabrikanten Lijst',
	'PHPSHOP_MANUFACTURER_FORM_LBL' => 'Informatie Toevoegen',
	'PHPSHOP_MANUFACTURER_FORM_CATEGORY' => 'Fabrikant Categorie',
	'PHPSHOP_MANUFACTURER_FORM_EMAIL' => 'E-mail',
	'PHPSHOP_MANUFACTURER_CAT_LIST_LBL' => 'Fabrikanten Categorie Lijst',
	'PHPSHOP_MANUFACTURER_CAT_NAME' => 'Categorie Naam',
	'PHPSHOP_MANUFACTURER_CAT_DESCRIPTION' => 'Categorie Omschrijving',
	'PHPSHOP_MANUFACTURER_CAT_MANUFACTURERS' => 'Fabrikanten',
	'PHPSHOP_MANUFACTURER_CAT_FORM_LBL' => 'Fabrikant Categorie Formulier',
	'PHPSHOP_MANUFACTURER_CAT_FORM_INFO_LBL' => 'Categorie Informatie',
	'PHPSHOP_MANUFACTURER_CAT_FORM_NAME' => 'Categorie Naam',
	'PHPSHOP_MANUFACTURER_CAT_FORM_DESCRIPTION' => 'Categorie Omschrijving'
); $VM_LANG->initModule( 'manufacturer', $langvars );
?>