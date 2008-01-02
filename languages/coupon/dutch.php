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
$VM_LANG->initModule('coupon',array (
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_COUPON_EDIT_HEADER' => 'Kortingsbon Updaten',
	'PHPSHOP_COUPON_CODE_HEADER' => 'Code',
	'PHPSHOP_COUPON_PERCENT_TOTAL' => 'Procent of Totaal',
	'PHPSHOP_COUPON_TYPE' => 'Krotings Type',
	'PHPSHOP_COUPON_TYPE_TOOLTIP' => 'Een cadeau kortingsbon wordt verwijderd zodra deze is gebruikt. Een permanente kortingsbon kan onbeperkt gebruikt worden door klanten.',
	'PHPSHOP_COUPON_TYPE_GIFT' => 'Cadeau kortingsbon',
	'PHPSHOP_COUPON_TYPE_PERMANENT' => 'Permanente Kortingsbon',
	'PHPSHOP_COUPON_VALUE_HEADER' => 'Waarde',
	'PHPSHOP_COUPON_PERCENT' => 'Procent',
	'PHPSHOP_COUPON_TOTAL' => 'Totaal'
	));
?>