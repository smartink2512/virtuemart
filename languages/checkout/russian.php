<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version $Id: russian.php 1071 2008-02-03 08:42:28Z alex_rus $
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
* http://www.alex-rus.com
* http://www.virtuemart.ru
* http://www.joomlaforum.ru
*/

global $VM_LANG;
$langvars = array (
	'CHARSET' => 'utf-8',
	'PHPSHOP_NO_CUSTOMER' => 'Вы не являетесь зарегистрированным клиентом. Пожалуйста, введите информацию для оформления заказа.',
	'PHPSHOP_THANKYOU' => 'Спасибо за Ваш заказ.',
	'PHPSHOP_EMAIL_SENDTO' => 'Подтверждающее письмо было выслано по адресу',
	'PHPSHOP_CHECKOUT_NEXT' => 'Следующий',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Контактная информация плательщика',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Компания',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Имя',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Адрес',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'E-mail',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Информация о доставке',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Компания',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Имя',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Адрес',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Телефон',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Факс',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Способ оплаты',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'необходимая информация для оплаты по кредитной карте',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Благодарим за оплату. 
         Операция прошла успешно. Вы получите подтверждение по e-mail об оплате через PayPal. 
         Вы можете продолжить или пройти на <a href=http://www.paypal.com>www.paypal.com</a>, чтобы увидеть подробности операции.',
	'PHPSHOP_PAYPAL_ERROR' => 'При обработке операции произошла ошибка. Статус Вашего заказа не изменился.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Ваш заказ принят!',
	'VM_CHECKOUT_TITLE_TAG' => 'Оформление: Шаг %s из %s',
	'VM_CHECKOUT_ORDERIDNOTSET' => 'Номер заказа ну указан или пуст!',
	'VM_CHECKOUT_FAILURE' => 'Ошибка',
	'VM_CHECKOUT_SUCCESS' => 'Успешно',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_1' => 'Эта страница расположена на сайте продавца.',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_2' => 'Результаты выполнения запроса будут отображены на зашифрованной странице.',
	'VM_CHECKOUT_CCV_CODE' => 'Проверочный (CCV) код кредитной карты',
	'VM_CHECKOUT_CCV_CODE_TIPTITLE' => 'Что такое проверочный (CCV) код кредитной карты?',
	'VM_CHECKOUT_MD5_FAILED' => 'Контрольная сумма MD5 не совпадает',
	'VM_CHECKOUT_ORDERNOTFOUND' => 'Заказ не найдет',
	'VM_CHECKOUT_PBS_APPROVED_ORDERCOMMENT' => '
                Оплата одобрена PBS. \n
                Транзакции присвоен следующий номер:\n\n
                Номер транзакции: {transactionnumber}\n',
	'VM_CHECKOUT_PBS_NOTAPPROVED_ORDERCOMMENT' => '
                Оплата не одобрена PBS. \n
                Транзакции присвоен следующий номер:\n\n
                Номер транзакции: {transactionnumber}\n',
	'VM_CHECKOUT_DD_ERROR_0' => 'Merchant/forretningsnummer ugyldigt',
	'VM_CHECKOUT_DD_ERROR_1' => 'Ugyldigt kreditkortnummer',
	'VM_CHECKOUT_DD_ERROR_2' => 'Ugyldigt belob',
	'VM_CHECKOUT_DD_ERROR_3' => 'OrderID mangler eller er ugyldig',
	'VM_CHECKOUT_DD_ERROR_4' => 'PBS afvisning - (Oftest - ugyldig kortdata, sp?rret kort osv...)',
	'VM_CHECKOUT_DD_ERROR_5' => 'Intern server fejl hos DanDomain eller PBS',
	'VM_CHECKOUT_DD_ERROR_6' => 'E-dankort ikke tilladt. Kontakt DanDomain',
	'VM_CHECKOUT_DD_ERROR_DEFAULT' => 'System fejl',
	'VM_CHECKOUT_FP_ERROR_1' => 'Ошибка: Транзакция отклонена',
	'VM_CHECKOUT_FP_ERROR_2' => 'Ошибка: Транзакция отклонена',
	'VM_CHECKOUT_FP_ERROR_3' => 'Ошибка: неправильный формат чисел',
	'VM_CHECKOUT_FP_ERROR_4' => 'Ошибка: нелегальная транзакция',
	'VM_CHECKOUT_FP_ERROR_5' => 'Ошибка: нет ответа',
	'VM_CHECKOUT_FP_ERROR_6' => 'Error_system_failure',
	'VM_CHECKOUT_FP_ERROR_7' => 'Ошибка: Срок действия карты истек',
	'VM_CHECKOUT_FP_ERROR_8' => 'Ошибка: Ошибка связи',
	'VM_CHECKOUT_FP_ERROR_9' => 'Ошибка: Внутренняя ошибка',
	'VM_CHECKOUT_FP_ERROR_10' => 'Ошибка: Карта не зарегистрирована',
	'VM_CHECKOUT_FP_ERROR_DEFAULT' => 'Ошибка: неизвестная ошибка',
	'VM_CHECKOUT_WF_ERROR_1' => 'Transaktionen blev ikke godkendt',
	'VM_CHECKOUT_WF_ERROR_2' => 'Mulig snyd',
	'VM_CHECKOUT_WF_ERROR_3' => 'Kommunikations fejl',
	'VM_CHECKOUT_WF_ERROR_4' => 'Kort udlobet',
	'VM_CHECKOUT_WF_ERROR_5' => 'Intern fejl',
	'VM_CHECKOUT_WF_ERROR_6' => 'Invalid Transaktion',
	'VM_CHECKOUT_WF_ERROR_7' => 'System fejl',
	'VM_CHECKOUT_WF_ERROR_8' => 'Forkert forretningsnummer',
	'VM_CHECKOUT_WF_ERROR_9' => 'Kortet eksistere ikke',
	'VM_CHECKOUT_WF_ERROR_10' => 'Kort l?ngen er for kort.',
	'VM_CHECKOUT_WF_ERROR_11' => 'Transaktion kan ikke gennemfores igennem denne terminal',
	'VM_CHECKOUT_WF_ERROR_12' => 'Kortejeren har ikke rettigheder til at gennemfore denne transaktion.',
	'VM_CHECKOUT_WF_ERROR_13' => 'Kortnummeret eksistere ikke',
	'VM_CHECKOUT_WF_ERROR_14' => 'Ошибка неизвестна'
); $VM_LANG->initModule( 'checkout', $langvars );
?>