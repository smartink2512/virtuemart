<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : vietnamese.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'CHARSET' => 'UTF-8',
	'PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL' => 'Nhật ký thanh toán',
	'PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL' => 'Giá vận chuyển',
	'PHPSHOP_ORDER_STATUS_LIST_CODE' => 'Mã',
	'PHPSHOP_ORDER_STATUS_LIST_NAME' => 'Tên',
	'PHPSHOP_ORDER_STATUS_FORM_LBL' => 'Tình trạng hóa đơn',
	'PHPSHOP_ORDER_STATUS_FORM_CODE' => 'Mã',
	'PHPSHOP_ORDER_STATUS_FORM_NAME' => 'Tên',
	'PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER' => 'Số thứ tự',
	'PHPSHOP_COMMENT' => 'Bình luận',
	'PHPSHOP_ORDER_LIST_NOTIFY' => 'Báo cho khách hàng?',
	'PHPSHOP_ORDER_LIST_NOTIFY_ERR' => 'Please change the Order Tình trạng first!',
	'PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT' => 'Bao gồm bình luận này?',
	'PHPSHOP_ORDER_HISTORY_DATE_ADDED' => 'Ngày thêm',
	'PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED' => 'Báo cho khách hàng?',
	'PHPSHOP_ORDER_STATUS_CHANGE' => 'Thay đổi tình trạng hóa đơn',
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