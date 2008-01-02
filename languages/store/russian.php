<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : russian.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'CHARSET' => 'cp1251',
	'PHPSHOP_USER_FORM_FIRST_NAME' => 'Имя',
	'PHPSHOP_USER_FORM_LAST_NAME' => 'Фамилия',
	'PHPSHOP_USER_FORM_MIDDLE_NAME' => 'Отчество',
	'PHPSHOP_USER_FORM_COMPANY_NAME' => 'Название компании',
	'PHPSHOP_USER_FORM_ADDRESS_1' => 'Адрес 1',
	'PHPSHOP_USER_FORM_ADDRESS_2' => 'Адрес 2',
	'PHPSHOP_USER_FORM_CITY' => 'Город',
	'PHPSHOP_USER_FORM_STATE' => 'Область/Район',
	'PHPSHOP_USER_FORM_ZIP' => 'Почтовый индекс',
	'PHPSHOP_USER_FORM_COUNTRY' => 'Страна',
	'PHPSHOP_USER_FORM_PHONE' => 'Телефон',
	'PHPSHOP_USER_FORM_PHONE2' => 'Mobile Phone',
	'PHPSHOP_USER_FORM_FAX' => 'Факс',
	'PHPSHOP_ISSHIP_LIST_PUBLISH_LBL' => 'Активные',
	'PHPSHOP_ISSHIP_FORM_UPDATE_LBL' => 'Сконфигурировать способ доставки',
	'PHPSHOP_STORE_FORM_FULL_IMAGE' => 'Картинка-логотип',
	'PHPSHOP_STORE_FORM_UPLOAD' => 'Загрузить картинку',
	'PHPSHOP_STORE_FORM_STORE_NAME' => 'Название магазина',
	'PHPSHOP_STORE_FORM_COMPANY_NAME' => 'Название компании, которой принадлежит магазин',
	'PHPSHOP_STORE_FORM_ADDRESS_1' => 'Поле для адреса 1',
	'PHPSHOP_STORE_FORM_ADDRESS_2' => 'Поле для адреса 2',
	'PHPSHOP_STORE_FORM_CITY' => 'Город',
	'PHPSHOP_STORE_FORM_STATE' => 'Область/Район/Регион',
	'PHPSHOP_STORE_FORM_COUNTRY' => 'Страна',
	'PHPSHOP_STORE_FORM_ZIP' => 'Почтовый индекс',
	'PHPSHOP_STORE_FORM_CURRENCY' => 'Валюта',
	'PHPSHOP_STORE_FORM_LAST_NAME' => 'Фамилия',
	'PHPSHOP_STORE_FORM_FIRST_NAME' => 'Имя',
	'PHPSHOP_STORE_FORM_MIDDLE_NAME' => 'Отчество',
	'PHPSHOP_STORE_FORM_TITLE' => 'Титул',
	'PHPSHOP_STORE_FORM_PHONE_1' => 'Телефон 1',
	'PHPSHOP_STORE_FORM_PHONE_2' => 'Телефон 2',
	'PHPSHOP_STORE_FORM_DESCRIPTION' => 'Описание',
	'PHPSHOP_PAYMENT_METHOD_LIST_LBL' => 'Список способов оплаты',
	'PHPSHOP_PAYMENT_METHOD_LIST_NAME' => 'Название',
	'PHPSHOP_PAYMENT_METHOD_LIST_CODE' => 'Код',
	'PHPSHOP_PAYMENT_METHOD_LIST_SHOPPER_GROUP' => 'Группа покупателей',
	'PHPSHOP_PAYMENT_METHOD_LIST_ENABLE_PROCESSOR' => 'Тип способа оплаты',
	'PHPSHOP_PAYMENT_METHOD_FORM_LBL' => 'Форма способа оплаты',
	'PHPSHOP_PAYMENT_METHOD_FORM_NAME' => 'Название способа оплаты',
	'PHPSHOP_PAYMENT_METHOD_FORM_SHOPPER_GROUP' => 'Группа покупателей',
	'PHPSHOP_PAYMENT_METHOD_FORM_DISCOUNT' => 'Скидка',
	'PHPSHOP_PAYMENT_METHOD_FORM_CODE' => 'Код',
	'PHPSHOP_PAYMENT_METHOD_FORM_LIST_ORDER' => 'Порядок вывода',
	'PHPSHOP_PAYMENT_METHOD_FORM_ENABLE_PROCESSOR' => 'Тип способа оплаты',
	'PHPSHOP_PAYMENT_FORM_CC' => 'Кредитная карта',
	'PHPSHOP_PAYMENT_FORM_USE_PP' => 'Использовать платежный процессор. Use Payment Processor',
	'PHPSHOP_PAYMENT_FORM_BANK_DEBIT' => 'Банк. Bank debit',
	'PHPSHOP_PAYMENT_FORM_AO' => 'Только адрес / Оплата при получении',
	'PHPSHOP_STATISTIC_STATISTICS' => 'Статистика',
	'PHPSHOP_STATISTIC_CUSTOMERS' => 'Заказчики',
	'PHPSHOP_STATISTIC_ACTIVE_PRODUCTS' => 'активные товары',
	'PHPSHOP_STATISTIC_INACTIVE_PRODUCTS' => 'неактивные товары',
	'PHPSHOP_STATISTIC_NEW_ORDERS' => 'Новые заказы',
	'PHPSHOP_STATISTIC_NEW_CUSTOMERS' => 'Новые заказчики',
	'PHPSHOP_CREDITCARD_NAME' => 'Название кредитной карты',
	'PHPSHOP_CREDITCARD_CODE' => 'Короткий код кредитной карты',
	'PHPSHOP_YOUR_STORE' => 'Ваш магазин',
	'PHPSHOP_CONTROL_PANEL' => 'Панель управления',
	'PHPSHOP_CHANGE_PASSKEY_FORM' => 'Показать/изменить пароль/ключ транзакции',
	'PHPSHOP_TYPE_PASSWORD' => 'Пожалуйста, введите Ваш пароль пользователя',
	'PHPSHOP_CURRENT_TRANSACTION_KEY' => 'Текущий ключ транзакций',
	'PHPSHOP_CHANGE_PASSKEY_SUCCESS' => 'Ключ транзакций был успешно изменён.',
	'VM_PAYMENT_CLASS_NAME' => 'Payment class name',
	'VM_PAYMENT_CLASS_NAME_TIP' => '(e.g. <strong>ps_netbanx</strong>) :<br />
default: ps_payment<br />
<i>Leave blank if you\\\'re not sure what to fill in!</i>',
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
	'VM_STORE_FORM_ACCEPTED_CURRENCIES_TIP' => 'This list defines all those currencies you accept when people are buying something in your store. <strong>Note:</strong> All currencies selected here can be used at checkout! If you don\\\'t want that, just select your country\\\'s currency (=default).',
	'VM_EXPORT_MODULE_FORM_LBL' => 'Export Module Form',
	'VM_EXPORT_MODULE_FORM_NAME' => 'Export Module Name',
	'VM_EXPORT_MODULE_FORM_DESC' => 'Description',
	'VM_EXPORT_CLASS_NAME' => 'Export Class Name',
	'VM_EXPORT_CLASS_NAME_TIP' => '(e.g. <strong>ps_orders_csv</strong>) :<br /> default: ps_xmlexport<br /> <i>Leave blank if you\\\'re not sure what to fill in!</i>',
	'VM_EXPORT_CONFIG' => 'Export Extra Configuration',
	'VM_EXPORT_CONFIG_TIP' => 'Define Export configuration for user-defined export modules or define additional configuration. Code must be valid PHP-Code.',
	'VM_SHIPPING_MODULE_LIST_NAME' => 'Name',
	'VM_SHIPPING_MODULE_LIST_E_VERSION' => 'Version',
	'VM_SHIPPING_MODULE_LIST_HEADER_AUTHOR' => 'Author',
	'PHPSHOP_STORE_ADDRESS_FORMAT' => 'Store Address Format',
	'PHPSHOP_STORE_ADDRESS_FORMAT_TIP' => 'You can use the following placeholders here',
	'PHPSHOP_STORE_DATE_FORMAT' => 'Store Date Format'
	));
?>