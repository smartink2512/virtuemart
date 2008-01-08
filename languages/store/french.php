<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : french.php 1071 2007-12-03 08:42:28Z thepisu $
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
$VM_LANG->initModule('store',array (
	'CHARSET' => 'ISO-8859-15',
	'PHPSHOP_USER_FORM_FIRST_NAME' => 'Prénom',
	'PHPSHOP_USER_FORM_LAST_NAME' => 'Nom',
	'PHPSHOP_USER_FORM_MIDDLE_NAME' => '2ème prénom',
	'PHPSHOP_USER_FORM_COMPANY_NAME' => 'Nom de la société',
	'PHPSHOP_USER_FORM_ADDRESS_1' => 'Adresse 1',
	'PHPSHOP_USER_FORM_ADDRESS_2' => 'Adresse 2',
	'PHPSHOP_USER_FORM_CITY' => 'Ville',
	'PHPSHOP_USER_FORM_STATE' => 'Etat/Province/Région',
	'PHPSHOP_USER_FORM_ZIP' => 'Code postal',
	'PHPSHOP_USER_FORM_COUNTRY' => 'Pays',
	'PHPSHOP_USER_FORM_PHONE' => 'Téléphone',
	'PHPSHOP_USER_FORM_PHONE2' => 'Portable',
	'PHPSHOP_USER_FORM_FAX' => 'Fax',
	'PHPSHOP_ISSHIP_LIST_PUBLISH_LBL' => 'Actif',
	'PHPSHOP_ISSHIP_FORM_UPDATE_LBL' => 'Configurer la Méthode de Livraison',
	'PHPSHOP_STORE_FORM_FULL_IMAGE' => 'Image Grande Taille',
	'PHPSHOP_STORE_FORM_UPLOAD' => 'Envoyer une Image',
	'PHPSHOP_STORE_FORM_STORE_NAME' => 'Nom de la Boutique',
	'PHPSHOP_STORE_FORM_COMPANY_NAME' => 'Nom de la Société Boutique',
	'PHPSHOP_STORE_FORM_ADDRESS_1' => 'Adresse 1',
	'PHPSHOP_STORE_FORM_ADDRESS_2' => 'Adresse 2',
	'PHPSHOP_STORE_FORM_CITY' => 'Ville',
	'PHPSHOP_STORE_FORM_STATE' => 'Etat/Province/Région',
	'PHPSHOP_STORE_FORM_COUNTRY' => 'Pays',
	'PHPSHOP_STORE_FORM_ZIP' => 'Code Postal',
	'PHPSHOP_STORE_FORM_CURRENCY' => 'Devise',
	'PHPSHOP_STORE_FORM_LAST_NAME' => 'Nom',
	'PHPSHOP_STORE_FORM_FIRST_NAME' => 'Prénom',
	'PHPSHOP_STORE_FORM_MIDDLE_NAME' => '2ème Prénom',
	'PHPSHOP_STORE_FORM_TITLE' => 'Civilité',
	'PHPSHOP_STORE_FORM_PHONE_1' => 'Téléphone 1',
	'PHPSHOP_STORE_FORM_PHONE_2' => 'Téléphone 2',
	'PHPSHOP_STORE_FORM_DESCRIPTION' => 'Description',
	'PHPSHOP_PAYMENT_METHOD_LIST_LBL' => 'Liste des Méthodes de Paiement',
	'PHPSHOP_PAYMENT_METHOD_LIST_NAME' => 'Nom',
	'PHPSHOP_PAYMENT_METHOD_LIST_CODE' => 'Code',
	'PHPSHOP_PAYMENT_METHOD_LIST_SHOPPER_GROUP' => 'Groupe de Client',
	'PHPSHOP_PAYMENT_METHOD_LIST_ENABLE_PROCESSOR' => 'Activer Type Méthode de Paiement',
	'PHPSHOP_PAYMENT_METHOD_FORM_LBL' => 'Formulaire de Méthode de Paiement',
	'PHPSHOP_PAYMENT_METHOD_FORM_NAME' => 'Nom de la Méthode de Paiement',
	'PHPSHOP_PAYMENT_METHOD_FORM_SHOPPER_GROUP' => 'Groupe de Client',
	'PHPSHOP_PAYMENT_METHOD_FORM_DISCOUNT' => 'Remise',
	'PHPSHOP_PAYMENT_METHOD_FORM_CODE' => 'Code',
	'PHPSHOP_PAYMENT_METHOD_FORM_LIST_ORDER' => 'Ordre dans la liste',
	'PHPSHOP_PAYMENT_METHOD_FORM_ENABLE_PROCESSOR' => 'Activer Type Méthode de Paiement',
	'PHPSHOP_PAYMENT_FORM_CC' => 'Carte de Crédit',
	'PHPSHOP_PAYMENT_FORM_USE_PP' => 'Utiliser un Terminal de Paiement',
	'PHPSHOP_PAYMENT_FORM_BANK_DEBIT' => 'Virement Bancaire',
	'PHPSHOP_PAYMENT_FORM_AO' => 'Adresse Seulement / Paiement à la Livraison',
	'PHPSHOP_STATISTIC_STATISTICS' => 'Statistiques',
	'PHPSHOP_STATISTIC_CUSTOMERS' => 'Clients',
	'PHPSHOP_STATISTIC_ACTIVE_PRODUCTS' => 'Produits actifs',
	'PHPSHOP_STATISTIC_INACTIVE_PRODUCTS' => 'Produits inactifs',
	'PHPSHOP_STATISTIC_NEW_ORDERS' => 'Nouvelles Commandes',
	'PHPSHOP_STATISTIC_NEW_CUSTOMERS' => 'Nouveaux Clients',
	'PHPSHOP_CREDITCARD_NAME' => 'Nom Carte de Crédit',
	'PHPSHOP_CREDITCARD_CODE' => 'Carte de Crédit - Code Court',
	'PHPSHOP_YOUR_STORE' => 'Votre Boutique',
	'PHPSHOP_CONTROL_PANEL' => 'Panneau de Contrôle',
	'PHPSHOP_CHANGE_PASSKEY_FORM' => 'Afficher/Modifier les Mot de Passe/Clé de Transaction',
	'PHPSHOP_TYPE_PASSWORD' => 'Veuillez saisir votre Mot de Passe Utilisateur',
	'PHPSHOP_CURRENT_TRANSACTION_KEY' => 'Clé de Transaction en cours',
	'PHPSHOP_CHANGE_PASSKEY_SUCCESS' => 'La Clé de Transaction a été modifiée avec succès.',
	'VM_PAYMENT_CLASS_NAME' => 'Payment class name',
	'VM_PAYMENT_CLASS_NAME_TIP' => '(e.g. <strong>ps_netbanx</strong>) :<br />
default: ps_payment<br />
<i>Leave blank if you\'re not sure what to fill in!</i>',
	'VM_PAYMENT_EXTRAINFO' => 'Payment Extra Info',
	'VM_PAYMENT_EXTRAINFO_TIP' => 'Is shown on the Order Confirmation Page. Can be: HTML Form Code from your Payment Service Provider, Hints to the customer etc.',
	'VM_PAYMENT_ACCEPTED_CREDITCARDS' => 'Accepted Credit Card Types',
	'VM_PAYMENT_METHOD_DISCOUNT_TIP' => 'To turn the discount into a fee, use a negative value here (Example: <strong>-2.00</strong>).',
	'VM_PAYMENT_METHOD_DISCOUNT_MAX_AMOUNT' => 'Maximum discount amount',
	'VM_PAYMENT_METHOD_DISCOUNT_MIN_AMOUNT' => 'Minimum discount amount',
	'VM_PAYMENT_FORM_FORMBASED' => 'HTML-Form based (e.g. PayPal)',
	'VM_ORDER_EXPORT_MODULE_LIST_LBL' => 'Order Export Module List',
	'VM_ORDER_EXPORT_MODULE_LIST_NAME' => 'Name',
	'VM_ORDER_EXPORT_MODULE_LIST_DESC' => 'Description',
	'VM_STORE_FORM_ACCEPTED_CURRENCIES' => 'List of accepted currencies',
	'VM_STORE_FORM_ACCEPTED_CURRENCIES_TIP' => 'This list defines all those currencies you accept when people are buying something in your store. <strong>Note:</strong> All currencies selected here can be used at checkout! If you don\'t want that, just select your country\'s currency (=default).',
	'VM_EXPORT_MODULE_FORM_LBL' => 'Export Module Form',
	'VM_EXPORT_MODULE_FORM_NAME' => 'Export Module Name',
	'VM_EXPORT_MODULE_FORM_DESC' => 'Description',
	'VM_EXPORT_CLASS_NAME' => 'Export Class Name',
	'VM_EXPORT_CLASS_NAME_TIP' => '(e.g. <strong>ps_orders_csv</strong>) :<br /> default: ps_xmlexport<br /> <i>Leave blank if you\'re not sure what to fill in!</i>',
	'VM_EXPORT_CONFIG' => 'Export Extra Configuration',
	'VM_EXPORT_CONFIG_TIP' => 'Define Export configuration for user-defined export modules or define additional configuration. Code must be valid PHP-Code.',
	'VM_SHIPPING_MODULE_LIST_NAME' => 'Name',
	'VM_SHIPPING_MODULE_LIST_E_VERSION' => 'Version',
	'VM_SHIPPING_MODULE_LIST_HEADER_AUTHOR' => 'Author',
	'PHPSHOP_STORE_ADDRESS_FORMAT' => 'Store Address Format',
	'PHPSHOP_STORE_ADDRESS_FORMAT_TIP' => 'You can use the following placeholders here',
	'PHPSHOP_STORE_DATE_FORMAT' => 'Store Date Format',
	'VM_PAYMENT_METHOD_ID_NOT_PROVIDED' => 'Error: Payment Method ID was not provided.',
	'VM_SHIPPING_MODULE_CONFIG_LBL' => 'Shipping Module Configuration',
	'VM_SHIPPING_MODULE_CLASSERROR' => 'Could not instantiate Class {shipping_module}'
	));
?>