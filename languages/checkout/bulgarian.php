<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : bulgarian.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Не сте регистриран като клиент. Трябва да ни предоставите информация за разплащане.',
	'PHPSHOP_THANKYOU' => 'Благодарим Ви за поръчката!',
	'PHPSHOP_EMAIL_SENDTO' => 'Изпратихме Ви email за потвърждение',
	'PHPSHOP_CHECKOUT_NEXT' => 'Напред',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Информация за плащане',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Организация',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Име',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Адрес',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Информация за доставка',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Организация',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Име',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Адрес',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Телефон',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Факс',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Начин за плащане',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'задължителна информация за плащане с кредитна карта',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Благодарим Ви! Транзакцията беше успешна. Ще получите email за потвърждение на тази транзакция от PayPal. Можете да продължите или да влезете в <a href=http://www.paypal.com>www.paypal.com</a>, за да видите детайлна информация за Вашата транзакция.',
	'PHPSHOP_PAYPAL_ERROR' => 'Възникна грешка при осъществяване на транзакцията. Статусът на поръчката Ви не е променен.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Поръчката Ви беше приета успешно!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>