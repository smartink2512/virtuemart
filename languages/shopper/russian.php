<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : russian.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'CHARSET' => 'cp1251',
	'PHPSHOP_SHOPPER_FORM_ADDRESS_LABEL' => 'Обозначение адреса',
	'PHPSHOP_SHOPPER_GROUP_LIST_LBL' => 'Список групп покупателей',
	'PHPSHOP_SHOPPER_GROUP_LIST_NAME' => 'Наименование группы',
	'PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION' => 'Описание группы',
	'PHPSHOP_SHOPPER_GROUP_FORM_LBL' => 'Форма группы покупателей',
	'PHPSHOP_SHOPPER_GROUP_FORM_NAME' => 'Наименование группы',
	'PHPSHOP_SHOPPER_GROUP_FORM_DESC' => 'Описание группы',
	'PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT' => 'Скидка по умолчанию для группы покупателей (в %)',
	'PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP' => 'Положительное значение Х означает: если товару не назначена цена для ЭТОЙ группы покупателей, то цена по умолчанию уменьшается на Х %. Отрицательное значение имеет противоположный эффект'
	));
?>