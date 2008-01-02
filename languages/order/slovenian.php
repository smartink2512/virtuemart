<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : slovenian.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL' => 'dnevnik',
	'PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL' => 'Cena dostave',
	'PHPSHOP_ORDER_STATUS_LIST_CODE' => 'koda narocila',
	'PHPSHOP_ORDER_STATUS_LIST_NAME' => 'ime narocila',
	'PHPSHOP_ORDER_STATUS_FORM_LBL' => 'status narocila',
	'PHPSHOP_ORDER_STATUS_FORM_CODE' => 'koda narocila',
	'PHPSHOP_ORDER_STATUS_FORM_NAME' => 'Ime narocila',
	'PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER' => 'narocila',
	'PHPSHOP_COMMENT' => 'Comment',
	'PHPSHOP_ORDER_LIST_NOTIFY' => 'Notify Customer?',
	'PHPSHOP_ORDER_LIST_NOTIFY_ERR' => 'Please change the Order Status first!',
	'PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT' => 'Include this comment?',
	'PHPSHOP_ORDER_HISTORY_DATE_ADDED' => 'Date Added',
	'PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED' => 'Customer Notified?',
	'PHPSHOP_ORDER_STATUS_CHANGE' => 'Order Status Change',
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