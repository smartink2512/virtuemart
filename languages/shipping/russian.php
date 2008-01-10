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
$langvars = array (
	'CHARSET' => 'cp1251',
	'PHPSHOP_CARRIER_LIST_LBL' => 'Список служб доставки',
	'PHPSHOP_RATE_LIST_LBL' => 'Список тарифов доставки',
	'PHPSHOP_CARRIER_LIST_NAME_LBL' => 'Название',
	'PHPSHOP_CARRIER_LIST_ORDER_LBL' => 'Порядок вывода',
	'PHPSHOP_CARRIER_FORM_LBL' => 'Редактирование/создание службы доставки',
	'PHPSHOP_RATE_FORM_LBL' => 'Редактирование/создание тарифа доставки',
	'PHPSHOP_RATE_FORM_NAME' => 'Описание тарифа доставки',
	'PHPSHOP_RATE_FORM_CARRIER' => 'Служба доставки',
	'PHPSHOP_RATE_FORM_COUNTRY' => 'Страна',
	'PHPSHOP_RATE_FORM_ZIP_START' => 'Начало диапазона почтовых индексов',
	'PHPSHOP_RATE_FORM_ZIP_END' => 'Конец диапазона почтовых индексов',
	'PHPSHOP_RATE_FORM_WEIGHT_START' => 'Наименьший вес',
	'PHPSHOP_RATE_FORM_WEIGHT_END' => 'Наибольший вес',
	'PHPSHOP_RATE_FORM_PACKAGE_FEE' => 'Стоимость Вашей упаковки',
	'PHPSHOP_RATE_FORM_CURRENCY' => 'Валюта',
	'PHPSHOP_RATE_FORM_LIST_ORDER' => 'Порядок вывода',
	'PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL' => 'Служба доставки',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME' => 'Описание тарифа доставки',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART' => 'Вес от ...',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND' => '... до',
	'PHPSHOP_CARRIER_FORM_NAME' => 'Компания службы доставки',
	'PHPSHOP_CARRIER_FORM_LIST_ORDER' => 'Порядок вывода'
); $VM_LANG->initModule( 'shipping', $langvars );
?>