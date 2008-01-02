<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : czechiso.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL' => 'Z�znam plateb',
	'PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL' => 'Dopravn�',
	'PHPSHOP_ORDER_STATUS_LIST_CODE' => 'K�d stavu objedn�vky',
	'PHPSHOP_ORDER_STATUS_LIST_NAME' => 'N�zev stavu objedn�vky',
	'PHPSHOP_ORDER_STATUS_FORM_LBL' => 'Stav objedn�vky',
	'PHPSHOP_ORDER_STATUS_FORM_CODE' => 'K�d stavu objedn�vky',
	'PHPSHOP_ORDER_STATUS_FORM_NAME' => 'N�zev stavu objedn�vky',
	'PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER' => 'Po�ad�',
	'PHPSHOP_COMMENT' => 'Koment��',
	'PHPSHOP_ORDER_LIST_NOTIFY' => 'Informovat z�kazn�ka?',
	'PHPSHOP_ORDER_LIST_NOTIFY_ERR' => 'Vyberte nejd��ve zm�nu stavu!',
	'PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT' => 'P�idat pozn�mku?',
	'PHPSHOP_ORDER_HISTORY_DATE_ADDED' => 'P�id�no dne',
	'PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED' => 'Z�kazn�k upozorn�n?',
	'PHPSHOP_ORDER_STATUS_CHANGE' => 'Zm�na stavu objedn�vky',
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