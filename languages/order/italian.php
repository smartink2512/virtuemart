<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : italian.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL' => 'Registro dei Pagamenti',
	'PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL' => 'Prezzo Spedizione',
	'PHPSHOP_ORDER_STATUS_LIST_CODE' => 'Codice Stato Ordine',
	'PHPSHOP_ORDER_STATUS_LIST_NAME' => 'Nome Stato Ordine',
	'PHPSHOP_ORDER_STATUS_FORM_LBL' => 'Stato Ordine',
	'PHPSHOP_ORDER_STATUS_FORM_CODE' => 'Codice Stato Ordine',
	'PHPSHOP_ORDER_STATUS_FORM_NAME' => 'Nome Stato Ordine',
	'PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER' => 'Lista Ordini',
	'PHPSHOP_COMMENT' => 'Commento',
	'PHPSHOP_ORDER_LIST_NOTIFY' => 'Avvisa il Cliente?',
	'PHPSHOP_ORDER_LIST_NOTIFY_ERR' => 'Prima modifica lo Stato dell\'Ordine!',
	'PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT' => 'Includi questo commento?',
	'PHPSHOP_ORDER_HISTORY_DATE_ADDED' => 'Data Inserimento',
	'PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED' => 'Cliente Notificato?',
	'PHPSHOP_ORDER_STATUS_CHANGE' => 'Cambia Stato Ordine',
	'PHPSHOP_ORDER_LIST_PRINT_LABEL' => 'Etichetta Stampa',
	'PHPSHOP_ORDER_LIST_VOID_LABEL' => 'Etichetta Vuota',
	'PHPSHOP_ORDER_LIST_TRACK' => 'Track',
	'VM_DOWNLOAD_STATS' => 'STATISTICHE DOWNLOAD',
	'VM_DOWNLOAD_NOTHING_LEFT' => 'nessun download residuo',
	'VM_DOWNLOAD_REENABLE' => 'Ri-Abilita Download',
	'VM_DOWNLOAD_REMAINING_DOWNLOADS' => 'Download Residui',
	'VM_DOWNLOAD_RESEND_ID' => 'Reinvia Download ID',
	'VM_EXPIRY' => 'Scadenza',
	'VM_UPDATE_STATUS' => 'Aggiorna Stato'
	));
?>