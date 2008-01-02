<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : hungarian.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'CHARSET' => 'UTF-8',
	'PHPSHOP_COUPON_EDIT_HEADER' => 'Szelvény frissítése',
	'PHPSHOP_COUPON_CODE_HEADER' => 'Kód',
	'PHPSHOP_COUPON_PERCENT_TOTAL' => 'Százalék vagy Összesen',
	'PHPSHOP_COUPON_TYPE' => 'Szelvény típus',
	'PHPSHOP_COUPON_TYPE_TOOLTIP' => 'Az ajándékutalvány törlodik, miután fel lett használva egy megrendelésnél. Az állandó szelvény használható valahányszor az ügyfél jónak látja.',
	'PHPSHOP_COUPON_TYPE_GIFT' => 'Ajándékutalvány',
	'PHPSHOP_COUPON_TYPE_PERMANENT' => 'Állandó szelvény',
	'PHPSHOP_COUPON_VALUE_HEADER' => 'Érték',
	'PHPSHOP_COUPON_PERCENT' => 'Százalék',
	'PHPSHOP_COUPON_TOTAL' => 'Összesen'
	));
?>