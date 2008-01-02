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
$VM_LANG->initModule('checkout',array (
	'CHARSET' => 'cp1251',
	'PHPSHOP_NO_CUSTOMER' => 'Вы еще не зарегистрированы как покупатель. Пожалуйста, укажите Ваши платежные реквизиты.',
	'PHPSHOP_THANKYOU' => 'Спасибо за Ваш заказ!',
	'PHPSHOP_EMAIL_SENDTO' => 'Подтверждение заказа было отправлено по электронной почте в адрес',
	'PHPSHOP_CHECKOUT_NEXT' => 'Следующий',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Платежная информация',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Компания',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Имя',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Адрес',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Информация о доставке',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Компания',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Имя',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Адрес',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Телефон',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Факс',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Форма оплаты',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'Обязательная информация при оплате кредитной картой',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Благодарим за оплату. Трансакция завершена успешно. Вы получите от PayPal подтверждение трансакции по электронной почте (e-mail). Сейчас Вы можете продолжить или зайти на <a href=http://www.paypal.com>www.paypal.com</a> чтобы посмотреть детали трансакции.',
	'PHPSHOP_PAYPAL_ERROR' => 'Во время выполнения Вашей трансакции произошла ошибка. Ваш заказ не подтвержден. (The status of your order could not be updated.)',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Ваш заказ принят!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>