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
$langvars = array (
	'CHARSET' => 'ISO-8859-15',
	'PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL' => 'Historique des paiements',
	'PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL' => 'Prix Exp�dition',
	'PHPSHOP_ORDER_STATUS_LIST_CODE' => 'Code de l\'�tat de la commande',
	'PHPSHOP_ORDER_STATUS_LIST_NAME' => 'Nom de l\'�tat de la commande',
	'PHPSHOP_ORDER_STATUS_FORM_LBL' => 'Etat de la commande',
	'PHPSHOP_ORDER_STATUS_FORM_CODE' => 'Code de l\'�tat de la commande',
	'PHPSHOP_ORDER_STATUS_FORM_NAME' => 'Nom de l\'�tat de la commande',
	'PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER' => 'Ordre d\\\'affichage',
	'PHPSHOP_COMMENT' => 'Commentaire',
	'PHPSHOP_ORDER_LIST_NOTIFY' => 'Avertir le client ?',
	'PHPSHOP_ORDER_LIST_NOTIFY_ERR' => 'Veuillez d\'abord modifier de l\'�tat de la commande',
	'PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT' => 'Inclure ce commentaire ?',
	'PHPSHOP_ORDER_HISTORY_DATE_ADDED' => 'Date ajout�e',
	'PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED' => 'Avertir cient ?',
	'PHPSHOP_ORDER_STATUS_CHANGE' => 'Etat de commande',
	'PHPSHOP_ORDER_LIST_PRINT_LABEL' => 'Libell� Imprimer',
	'PHPSHOP_ORDER_LIST_VOID_LABEL' => 'Libell� void',
	'PHPSHOP_ORDER_LIST_TRACK' => 'Track',
	'VM_DOWNLOAD_STATS' => 'DOWNLOAD STATS',
	'VM_DOWNLOAD_NOTHING_LEFT' => 'Aucun t�l�chargement en attente',
	'VM_DOWNLOAD_REENABLE' => 'Re-activer le t�l�chargement',
	'VM_DOWNLOAD_REMAINING_DOWNLOADS' => 'T�l�chargement en attente',
	'VM_DOWNLOAD_RESEND_ID' => 'Renvoyer l\'ID de  t�l�chargement',
	'VM_EXPIRY' => 'Ech�ance',
	'VM_UPDATE_STATUS' => 'Mise � jour de l\'etat',
	'VM_ORDER_LABEL_ORDERID_NOTVALID' => 'Merci de fournir un ID de commande valide et num�rique et non pas "(order_id )"',
	'VM_ORDER_LABEL_NOTFOUND' => 'Commande introuvable dans la base de donn�es des llib�ll�s d\'exp�dition.',
	'VM_ORDER_LABEL_NEVERGENERATED' => 'Label has not been generated yet',
	'VM_ORDER_LABEL_CLASSCANNOT' => 'Class {ship_class} cannot get label images, why are we here?',
	'VM_ORDER_LABEL_SHIPPINGLABEL_LBL' => 'Libell� d\'exp�dition',
	'VM_ORDER_LABEL_SIGNATURENEVER' => 'Signature was never retrieved',
	'VM_ORDER_LABEL_TRACK_TITLE' => 'Track',
	'VM_ORDER_LABEL_VOID_TITLE' => 'Void Label',
	'VM_ORDER_LABEL_VOIDED_MSG' => 'Label for waybill {tracking_number} a �t� annul�e.',
	'VM_ORDER_PRINT_PO_IPADDRESS' => 'ADDRESS IP',
	'VM_ORDER_STATUS_ICON_ALT' => 'Ic�ne status',
	'VM_ORDER_PAYMENT_CCV_CODE' => 'Code CVV',
	'VM_ORDER_NOTFOUND' => 'Aucune command n\'a �t� trouv�e. Elle a peut �tre �t� effac�e.'
); $VM_LANG->initModule( 'order', $langvars );
?>