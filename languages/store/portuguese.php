<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : portuguese.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_USER_FORM_FIRST_NAME' => 'Primeiro Nome',
	'PHPSHOP_USER_FORM_LAST_NAME' => 'Ultimo Nome',
	'PHPSHOP_USER_FORM_MIDDLE_NAME' => 'Nome do Meio',
	'PHPSHOP_USER_FORM_COMPANY_NAME' => 'Empresa',
	'PHPSHOP_USER_FORM_ADDRESS_1' => 'Morada 1',
	'PHPSHOP_USER_FORM_ADDRESS_2' => 'Morada 2',
	'PHPSHOP_USER_FORM_CITY' => 'Cidade',
	'PHPSHOP_USER_FORM_STATE' => 'Distrito',
	'PHPSHOP_USER_FORM_ZIP' => 'Código Postal',
	'PHPSHOP_USER_FORM_COUNTRY' => 'País',
	'PHPSHOP_USER_FORM_PHONE' => 'Telefone',
	'PHPSHOP_USER_FORM_PHONE2' => 'Mobile Phone',
	'PHPSHOP_USER_FORM_FAX' => 'Fax',
	'PHPSHOP_ISSHIP_LIST_PUBLISH_LBL' => 'Activo',
	'PHPSHOP_ISSHIP_FORM_UPDATE_LBL' => 'Configurar Método de Envio',
	'PHPSHOP_STORE_FORM_FULL_IMAGE' => 'Imagem',
	'PHPSHOP_STORE_FORM_UPLOAD' => 'Enviar Imagem para o servidor',
	'PHPSHOP_STORE_FORM_STORE_NAME' => 'Nome da Loja',
	'PHPSHOP_STORE_FORM_COMPANY_NAME' => 'Nome da Empresa',
	'PHPSHOP_STORE_FORM_ADDRESS_1' => 'Morada 1',
	'PHPSHOP_STORE_FORM_ADDRESS_2' => 'Morada 2',
	'PHPSHOP_STORE_FORM_CITY' => 'Cidade',
	'PHPSHOP_STORE_FORM_STATE' => 'Distrito',
	'PHPSHOP_STORE_FORM_COUNTRY' => 'País',
	'PHPSHOP_STORE_FORM_ZIP' => 'Código Postal',
	'PHPSHOP_STORE_FORM_CURRENCY' => 'Moeda',
	'PHPSHOP_STORE_FORM_LAST_NAME' => 'Ultimo Nome',
	'PHPSHOP_STORE_FORM_FIRST_NAME' => 'Primeiro Nome',
	'PHPSHOP_STORE_FORM_MIDDLE_NAME' => 'Nome do Meio',
	'PHPSHOP_STORE_FORM_TITLE' => 'Título',
	'PHPSHOP_STORE_FORM_PHONE_1' => 'Telefone 1',
	'PHPSHOP_STORE_FORM_PHONE_2' => 'Telefone 2',
	'PHPSHOP_STORE_FORM_DESCRIPTION' => 'Descrição',
	'PHPSHOP_PAYMENT_METHOD_LIST_LBL' => 'Lista de Métodos de Pagamento',
	'PHPSHOP_PAYMENT_METHOD_LIST_NAME' => 'Nome',
	'PHPSHOP_PAYMENT_METHOD_LIST_CODE' => 'Código',
	'PHPSHOP_PAYMENT_METHOD_LIST_SHOPPER_GROUP' => 'Grupo de Cliente',
	'PHPSHOP_PAYMENT_METHOD_LIST_ENABLE_PROCESSOR' => 'Cybercash',
	'PHPSHOP_PAYMENT_METHOD_FORM_LBL' => 'Formulario Método de Pagamento',
	'PHPSHOP_PAYMENT_METHOD_FORM_NAME' => 'Nome Formulario de Pagamento',
	'PHPSHOP_PAYMENT_METHOD_FORM_SHOPPER_GROUP' => 'Grupo de Cliente',
	'PHPSHOP_PAYMENT_METHOD_FORM_DISCOUNT' => 'Desconto',
	'PHPSHOP_PAYMENT_METHOD_FORM_CODE' => 'Código',
	'PHPSHOP_PAYMENT_METHOD_FORM_LIST_ORDER' => 'Listar Encomendas',
	'PHPSHOP_PAYMENT_METHOD_FORM_ENABLE_PROCESSOR' => 'Usar Cybercash',
	'PHPSHOP_PAYMENT_FORM_CC' => 'Cartão de Crédito',
	'PHPSHOP_PAYMENT_FORM_USE_PP' => 'Use Payment Processor',
	'PHPSHOP_PAYMENT_FORM_BANK_DEBIT' => 'Débito Bancário',
	'PHPSHOP_PAYMENT_FORM_AO' => 'Apenas a Morada',
	'PHPSHOP_STATISTIC_STATISTICS' => 'Estatisticas',
	'PHPSHOP_STATISTIC_CUSTOMERS' => 'Clientes',
	'PHPSHOP_STATISTIC_ACTIVE_PRODUCTS' => 'Produtos Activos',
	'PHPSHOP_STATISTIC_INACTIVE_PRODUCTS' => 'Produtos inactivos',
	'PHPSHOP_STATISTIC_NEW_ORDERS' => 'Novas Encomendas',
	'PHPSHOP_STATISTIC_NEW_CUSTOMERS' => 'Novos Clientes',
	'PHPSHOP_CREDITCARD_NAME' => 'Credit Card Name',
	'PHPSHOP_CREDITCARD_CODE' => 'Credit Card - Short Code',
	'PHPSHOP_YOUR_STORE' => 'Your Store',
	'PHPSHOP_CONTROL_PANEL' => 'Control Panel',
	'PHPSHOP_CHANGE_PASSKEY_FORM' => 'Show/Change the Password/Transaction Key',
	'PHPSHOP_TYPE_PASSWORD' => 'Please type in your User Password',
	'PHPSHOP_CURRENT_TRANSACTION_KEY' => 'Current Transaction Key',
	'PHPSHOP_CHANGE_PASSKEY_SUCCESS' => 'The Transaction key was successfully changed.',
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