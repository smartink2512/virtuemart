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
$VM_LANG->initModule('shopper',array (
	'CHARSET' => 'ISO-8859-15',
	'PHPSHOP_SHOPPER_FORM_ADDRESS_LABEL' => 'Nom de l\'Adresse',
	'PHPSHOP_SHOPPER_GROUP_LIST_LBL' => 'Liste des Groupes de Clients',
	'PHPSHOP_SHOPPER_GROUP_LIST_NAME' => 'Nom du Groupe',
	'PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION' => 'Description du Groupe',
	'PHPSHOP_SHOPPER_GROUP_FORM_LBL' => 'Formulaire du Groupe de Clients',
	'PHPSHOP_SHOPPER_GROUP_FORM_NAME' => 'Nom du Groupe',
	'PHPSHOP_SHOPPER_GROUP_FORM_DESC' => 'Description du Groupe',
	'PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT' => 'Remise sur Prix dans le Groupe des Acheteurs par défaut (en %)',
	'PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP' => 'Un montant positif de X veut dire: si le Produit n\'a aucun prix affecté à CE groupe d\'acheteurs, le prix par défaut est diminué de X %. Un montant négatif a l\'effet inverse'
	));
?>