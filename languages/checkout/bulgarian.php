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
$langvars = array (
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
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s',
	'VM_CHECKOUT_ORDERIDNOTSET' => 'Order ID is not set or emtpy!',
	'VM_CHECKOUT_FAILURE' => 'Failure',
	'VM_CHECKOUT_SUCCESS' => 'Success',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_1' => 'This page is located on the webshop\'s website.',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_2' => 'The gateway execute the page on the website, and the shows the result SSL Encrypted.',
	'VM_CHECKOUT_CCV_CODE' => 'Credit Card Validation Code',
	'VM_CHECKOUT_CCV_CODE_TIPTITLE' => 'What\'s the Credit Card Validation Code?',
	'VM_CHECKOUT_MD5_FAILED' => 'MD5 Check failed',
	'VM_CHECKOUT_ORDERNOTFOUND' => 'Order not found',
	'VM_CHECKOUT_PBS_APPROVED_ORDERCOMMENT' => '
                The Payment Transaction was approved by PBS. \n
                The Transaction has received the following Transaction Number:\n\n
                Transaction Number: {transactionnumber}\n',
	'VM_CHECKOUT_PBS_NOTAPPROVED_ORDERCOMMENT' => '
                The Payment Transaction was not approved by PBS. \n
                The Transaction has received the following Transaction Number:\n\n
                Transaction Number: {transactionnumber}\n',
	'VM_CHECKOUT_DD_ERROR_0' => 'Merchant/forretningsnummer ugyldigt',
	'VM_CHECKOUT_DD_ERROR_1' => 'Ugyldigt kreditkortnummer',
	'VM_CHECKOUT_DD_ERROR_2' => 'Ugyldigt belob',
	'VM_CHECKOUT_DD_ERROR_3' => 'OrderID mangler eller er ugyldig',
	'VM_CHECKOUT_DD_ERROR_4' => 'PBS afvisning - (Oftest - ugyldig kortdata, sp?rret kort osv...)',
	'VM_CHECKOUT_DD_ERROR_5' => 'Intern server fejl hos DanDomain eller PBS',
	'VM_CHECKOUT_DD_ERROR_6' => 'E-dankort ikke tilladt. Kontakt DanDomain',
	'VM_CHECKOUT_DD_ERROR_DEFAULT' => 'System fejl',
	'VM_CHECKOUT_FP_ERROR_1' => 'Error: Transaction declined',
	'VM_CHECKOUT_FP_ERROR_2' => 'Error: Transaction declined',
	'VM_CHECKOUT_FP_ERROR_3' => 'Error: wrong number format',
	'VM_CHECKOUT_FP_ERROR_4' => 'Error: illegal transaction',
	'VM_CHECKOUT_FP_ERROR_5' => 'Error: no answer',
	'VM_CHECKOUT_FP_ERROR_6' => 'Error_system_failure',
	'VM_CHECKOUT_FP_ERROR_7' => 'Error: Card expired',
	'VM_CHECKOUT_FP_ERROR_8' => 'Error: Communication Failure',
	'VM_CHECKOUT_FP_ERROR_9' => 'Error: Internal Failure',
	'VM_CHECKOUT_FP_ERROR_10' => 'Error: Card not registered',
	'VM_CHECKOUT_FP_ERROR_DEFAULT' => 'Error: unknown Error',
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
	'VM_CHECKOUT_WF_ERROR_14' => 'Error unknown'
); $VM_LANG->initModule( 'checkout', $langvars );
?>