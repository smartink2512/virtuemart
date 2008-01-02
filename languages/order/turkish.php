<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : turkish.php 1071 2007-12-03 08:42:28Z thepisu $
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
$VM_LANG->initModule('order',array (
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL' => 'Ödeme Logu',
	'PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL' => 'Nakliye Fiyatý',
	'PHPSHOP_ORDER_STATUS_LIST_CODE' => 'Sipariþ Durum Kodu',
	'PHPSHOP_ORDER_STATUS_LIST_NAME' => 'Sipariþ Durum  Adý',
	'PHPSHOP_ORDER_STATUS_FORM_LBL' => 'Sipariþ Durumu',
	'PHPSHOP_ORDER_STATUS_FORM_CODE' => 'Sipariþ Durum Kodu',
	'PHPSHOP_ORDER_STATUS_FORM_NAME' => 'Sipariþ Durum Adý',
	'PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER' => 'Sipariþ Listeleme',
	'PHPSHOP_COMMENT' => 'Yorum',
	'PHPSHOP_ORDER_LIST_NOTIFY' => 'Müþteriyi haberdar et.',
	'PHPSHOP_ORDER_LIST_NOTIFY_ERR' => 'Önce sipariþ durumunu deðiþtirin',
	'PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT' => 'Bu yorumu kapsasýn mý?',
	'PHPSHOP_ORDER_HISTORY_DATE_ADDED' => 'Ekleme tarihi',
	'PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED' => 'Müþteri bilgilendirilsin mi?',
	'PHPSHOP_ORDER_STATUS_CHANGE' => 'Sipariþ Durum Deðiþikliði',
	'PHPSHOP_ORDER_LIST_PRINT_LABEL' => 'Print Label',
	'PHPSHOP_ORDER_LIST_VOID_LABEL' => 'Void Label',
	'PHPSHOP_ORDER_LIST_TRACK' => 'Track',
	'VM_DOWNLOAD_STATS' => 'DOWNLOAD STATS',
	'VM_DOWNLOAD_NOTHING_LEFT' => 'no downloads remaining',
	'VM_DOWNLOAD_REENABLE' => 'Re-Enable Download',
	'VM_DOWNLOAD_REMAINING_DOWNLOADS' => 'Remaining Downloads',
	'VM_DOWNLOAD_RESEND_ID' => 'Resend Download ID',
	'VM_EXPIRY' => 'Expiry',
	'VM_UPDATE_STATUS' => 'Update Status'
	));
?>