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
$VM_LANG->initModule('order',array (
	'CHARSET' => 'UTF-8',
	'PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL' => 'Kifizetési napló',
	'PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL' => 'Leszállítási ár',
	'PHPSHOP_ORDER_STATUS_LIST_CODE' => 'Megrendelés státuskód',
	'PHPSHOP_ORDER_STATUS_LIST_NAME' => 'Megrendelés státus neve',
	'PHPSHOP_ORDER_STATUS_FORM_LBL' => 'Megrendelés státusa',
	'PHPSHOP_ORDER_STATUS_FORM_CODE' => 'Megrendelés státuskód',
	'PHPSHOP_ORDER_STATUS_FORM_NAME' => 'Megrendelés státus neve',
	'PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER' => 'Megrendelés listázás',
	'PHPSHOP_COMMENT' => 'Megjegyzés',
	'PHPSHOP_ORDER_LIST_NOTIFY' => 'Értesítsem az ügyfelet?',
	'PHPSHOP_ORDER_LIST_NOTIFY_ERR' => 'Kérlek változtasd meg elobb a megrendelés státusát!',
	'PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT' => 'Befoglaljuk ezt a megjegyzést?',
	'PHPSHOP_ORDER_HISTORY_DATE_ADDED' => 'Dátum hozzáadva',
	'PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED' => 'Ügyfél értesítve?',
	'PHPSHOP_ORDER_STATUS_CHANGE' => 'Megrendelés státusa megváltoztatása',
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