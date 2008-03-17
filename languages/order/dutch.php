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
* Dutch Translation for Dutchjoomla.org by Frans and Ton  
*
* http://virtuemart.net
*/
global $VM_LANG;
$langvars = array (
        'CHARSET' => 'ISO-8859-1',
        'PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL' => 'Betalingslegenda',
        'PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL' => 'Verzendingsprijs',
        'PHPSHOP_ORDER_STATUS_LIST_CODE' => 'Order status code',
        'PHPSHOP_ORDER_STATUS_LIST_NAME' => 'Order status naam',
        'PHPSHOP_ORDER_STATUS_FORM_LBL' => 'Order status',
        'PHPSHOP_ORDER_STATUS_FORM_CODE' => 'Order status code',
        'PHPSHOP_ORDER_STATUS_FORM_NAME' => 'Order status naam',
        'PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER' => 'Bekijk order',
        'PHPSHOP_COMMENT' => 'Commentaar',
        'PHPSHOP_ORDER_LIST_NOTIFY' => 'Klant informeren?',
        'PHPSHOP_ORDER_LIST_NOTIFY_ERR' => 'Wijzig eerst de status van de bestelling!',
        'PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT' => 'Commentaar toevoegen?',
        'PHPSHOP_ORDER_HISTORY_DATE_ADDED' => 'Toegevoegd op datum',
        'PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED' => 'Klant op de hoogte gebracht?',
        'PHPSHOP_ORDER_STATUS_CHANGE' => 'Order status wijziging',
        'PHPSHOP_ORDER_LIST_PRINT_LABEL' => 'Print label',
        'PHPSHOP_ORDER_LIST_VOID_LABEL' => 'Ongeldig label',
        'PHPSHOP_ORDER_LIST_TRACK' => 'Traceren',
        'VM_DOWNLOAD_STATS' => 'DOWNLOAD STATISTIEKEN',
        'VM_DOWNLOAD_NOTHING_LEFT' => 'Geen overgebleven downloads',
        'VM_DOWNLOAD_REENABLE' => 'Maak download opnieuw mogelijk',
        'VM_DOWNLOAD_REMAINING_DOWNLOADS' => 'Overgebleven downloads',
        'VM_DOWNLOAD_RESEND_ID' => 'Verstuur download ID opnieuw',
        'VM_EXPIRY' => 'Verlopen',
        'VM_UPDATE_STATUS' => 'Update status',
        'VM_ORDER_LABEL_ORDERID_NOTVALID' => 'Vul alstublieft een geldig, numeriek, Order ID, not "{order_id}" in',
        'VM_ORDER_LABEL_NOTFOUND' => 'Bestelling niet gevonden in shipping label database.',
        'VM_ORDER_LABEL_NEVERGENERATED' => 'Label is nog niet gegenereerd',
        'VM_ORDER_LABEL_CLASSCANNOT' => 'Class {ship_class} cannot get label images, why are we here?',
        'VM_ORDER_LABEL_SHIPPINGLABEL_LBL' => 'Verzend label',
        'VM_ORDER_LABEL_SIGNATURENEVER' => 'Handtekening was niet Signature was never retrieved',
        'VM_ORDER_LABEL_TRACK_TITLE' => 'Traceren',
        'VM_ORDER_LABEL_VOID_TITLE' => 'Ongeldig label',
        'VM_ORDER_LABEL_VOIDED_MSG' => 'Label voor waybill {tracking_number} is ongeldig gemaakt.',
        'VM_ORDER_PRINT_PO_IPADDRESS' => 'IP-ADDRESS',
        'VM_ORDER_STATUS_ICON_ALT' => 'Status icoon',
        'VM_ORDER_PAYMENT_CCV_CODE' => 'CVV Code',
        'VM_ORDER_NOTFOUND' => 'Bestelling niet gevonden! Het kan verwijderd zijn.'
); $VM_LANG->initModule( 'order', $langvars );
?>
