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
$VM_LANG->initModule('shipping',array (
	'CHARSET' => 'ISO-8859-15',
	'PHPSHOP_CARRIER_LIST_LBL' => 'Liste des Expéditeurs',
	'PHPSHOP_RATE_LIST_LBL' => 'Liste des Taux d\'Expéditions',
	'PHPSHOP_CARRIER_LIST_NAME_LBL' => 'Nom',
	'PHPSHOP_CARRIER_LIST_ORDER_LBL' => 'Ordre dans la liste',
	'PHPSHOP_CARRIER_FORM_LBL' => 'Créer/Éditer Expéditeur',
	'PHPSHOP_RATE_FORM_LBL' => 'Créer/Éditer Taux Expédition',
	'PHPSHOP_RATE_FORM_NAME' => 'Description Taux Expédition',
	'PHPSHOP_RATE_FORM_CARRIER' => 'Expéditeur',
	'PHPSHOP_RATE_FORM_COUNTRY' => 'Pays',
	'PHPSHOP_RATE_FORM_ZIP_START' => 'Fourchette de Codes Postaux commence à',
	'PHPSHOP_RATE_FORM_ZIP_END' => 'Fourchette de Codes Postaux termine à',
	'PHPSHOP_RATE_FORM_WEIGHT_START' => 'Poids Minimum',
	'PHPSHOP_RATE_FORM_WEIGHT_END' => 'Poids Maximum',
	'PHPSHOP_RATE_FORM_PACKAGE_FEE' => 'Vos Frais d\'Emballage',
	'PHPSHOP_RATE_FORM_CURRENCY' => 'Devise',
	'PHPSHOP_RATE_FORM_LIST_ORDER' => 'Ordre dans la liste',
	'PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL' => 'Expéditeur',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME' => 'Description Taux Expédition',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART' => 'Poids à partir de ...',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND' => '... jusqu\'à',
	'PHPSHOP_CARRIER_FORM_NAME' => 'Société Expéditrice',
	'PHPSHOP_CARRIER_FORM_LIST_ORDER' => 'Ordre dans la liste'
	));
?>