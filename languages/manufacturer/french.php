<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : french.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'CHARSET' => 'ISO-8859-15',
	'PHPSHOP_MANUFACTURER_LIST_LBL' => 'Liste des Fabricants',
	'PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME' => 'Nom du Fabricant',
	'PHPSHOP_MANUFACTURER_FORM_LBL' => 'Ajouter une Information',
	'PHPSHOP_MANUFACTURER_FORM_CATEGORY' => 'Cat�gorie de Fabricant',
	'PHPSHOP_MANUFACTURER_FORM_EMAIL' => 'Email',
	'PHPSHOP_MANUFACTURER_CAT_LIST_LBL' => 'Liste des Cat�gories de Fabricants',
	'PHPSHOP_MANUFACTURER_CAT_NAME' => 'Nom de la Cat�gorie',
	'PHPSHOP_MANUFACTURER_CAT_DESCRIPTION' => 'Description Cat�gorie',
	'PHPSHOP_MANUFACTURER_CAT_MANUFACTURERS' => 'Fabricants',
	'PHPSHOP_MANUFACTURER_CAT_FORM_LBL' => 'Formulaire Cat�gorie Fabricant',
	'PHPSHOP_MANUFACTURER_CAT_FORM_INFO_LBL' => 'Information de la Cat�gorie',
	'PHPSHOP_MANUFACTURER_CAT_FORM_NAME' => 'Nom de la Cat�gorie',
	'PHPSHOP_MANUFACTURER_CAT_FORM_DESCRIPTION' => 'Description de la Cat�gorie'
); $VM_LANG->initModule( 'manufacturer', $langvars );
?>