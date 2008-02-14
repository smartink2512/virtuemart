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
	'PHPSHOP_ORDER_PRINT_PAYMENT_LOG_LBL' => 'История платежей',
	'PHPSHOP_ORDER_PRINT_SHIPPING_PRICE_LBL' => 'Стоимость доставки',
	'PHPSHOP_ORDER_STATUS_LIST_CODE' => 'Код состояния заказа',
	'PHPSHOP_ORDER_STATUS_LIST_NAME' => 'Название состояния заказа',
	'PHPSHOP_ORDER_STATUS_FORM_LBL' => 'Состояния заказа',
	'PHPSHOP_ORDER_STATUS_FORM_CODE' => 'Код состояния заказа',
	'PHPSHOP_ORDER_STATUS_FORM_NAME' => 'Название состояния заказа',
	'PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER' => 'Порядок отображения',
	'PHPSHOP_COMMENT' => 'Комментарий',
	'PHPSHOP_ORDER_LIST_NOTIFY' => 'Уведомить покупателя?',
	'PHPSHOP_ORDER_LIST_NOTIFY_ERR' => 'Пожалуйста, сначала измените статус заказа!',
	'PHPSHOP_ORDER_HISTORY_INCLUDE_COMMENT' => 'Включить этот комментарий?',
	'PHPSHOP_ORDER_HISTORY_DATE_ADDED' => 'Дата добавлена',
	'PHPSHOP_ORDER_HISTORY_CUSTOMER_NOTIFIED' => 'Покупатель уведомлен?',
	'PHPSHOP_ORDER_STATUS_CHANGE' => 'Изменить статус заказа',
	'PHPSHOP_ORDER_LIST_PRINT_LABEL' => 'Печатать этикетку',
	'PHPSHOP_ORDER_LIST_VOID_LABEL' => 'Пропустить этикетку',
	'PHPSHOP_ORDER_LIST_TRACK' => 'Следить',
	'VM_DOWNLOAD_STATS' => 'Статистика скачиваний',
	'VM_DOWNLOAD_NOTHING_LEFT' => 'скачиваний не осталось',
	'VM_DOWNLOAD_REENABLE' => 'Разрешить снова скачивание',
	'VM_DOWNLOAD_REMAINING_DOWNLOADS' => 'Оставшиеся скачивания',
	'VM_DOWNLOAD_RESEND_ID' => 'Послать снова ID для скачивания',
	'VM_EXPIRY' => 'Истек',
	'VM_UPDATE_STATUS' => 'Обновить статус',
	'VM_ORDER_LABEL_ORDERID_NOTVALID' => 'Пожалуйста, укажите правильный, цифровой номер заказа, не "{order_id}"',
	'VM_ORDER_LABEL_NOTFOUND' => 'Заказ не найден в базе этикеток по отправленным товарам.',
	'VM_ORDER_LABEL_NEVERGENERATED' => 'Этикетка еще не была сгенерирована',
	'VM_ORDER_LABEL_CLASSCANNOT' => 'Класс {ship_class} не может получить изображения этикетки, почему мы здесь?',
	'VM_ORDER_LABEL_SHIPPINGLABEL_LBL' => 'Этикетка на отправку',
	'VM_ORDER_LABEL_SIGNATURENEVER' => 'Подпись никогда не была получена',
	'VM_ORDER_LABEL_TRACK_TITLE' => 'Следить',
	'VM_ORDER_LABEL_VOID_TITLE' => 'Пропустить этикетку',
	'VM_ORDER_LABEL_VOIDED_MSG' => 'Этикетка для накладной {tracking_number} была пропущена.',
	'VM_ORDER_PRINT_PO_IPADDRESS' => 'IP адрес',
	'VM_ORDER_STATUS_ICON_ALT' => 'Статус',
	'VM_ORDER_PAYMENT_CCV_CODE' => 'CVV код',
	'VM_ORDER_NOTFOUND' => 'Заказ не найден! Он мог быть удален.'
); $VM_LANG->initModule( 'order', $langvars );
?>