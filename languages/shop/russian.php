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
$VM_LANG->initModule('shop',array (
	'CHARSET' => 'cp1251',
	'PHPSHOP_BROWSE_LBL' => 'Просмотр',
	'PHPSHOP_FLYPAGE_LBL' => 'Описание товара',
	'PHPSHOP_ERROR' => 'ОШИБКА',
	'PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT' => 'Редактировать этот товар',
	'PHPSHOP_DOWNLOADS_START' => 'Начать загрузку',
	'PHPSHOP_DOWNLOADS_INFO' => 'Пожалуйста, введите идентификатор загрузки (Download-ID), который Вы получили по e-mail и нажмите \'Начать загрузку\'.',
	'PHPSHOP_WAITING_LIST_MESSAGE' => 'Пожалуйста, укажите свой адрес электронной почты, чтобы мы могли уведомить Вас когда товар появится на складе. Мы не будем передавать этот адрес третьим лицам и использовать его для каких-либо целей, кроме уведомлений о наличии товара.<br /><br />Спасибо!',
	'PHPSHOP_WAITING_LIST_THANKS' => 'Спасибо за ожидание <br />Мы хотели бы уведомить Вас о том, что на склад поступил нужный Вам товар.',
	'PHPSHOP_WAITING_LIST_NOTIFY_ME' => 'Уведомите меня!',
	'PHPSHOP_SEARCH_ALL_CATEGORIES' => 'Во всех категориях',
	'PHPSHOP_SEARCH_ALL_PRODINFO' => 'По всей информации о товаре',
	'PHPSHOP_SEARCH_PRODNAME' => 'Только в названии товара',
	'PHPSHOP_SEARCH_MANU_VENDOR' => 'Только в URL товара',
	'PHPSHOP_SEARCH_DESCRIPTION' => 'Только в описании товара',
	'PHPSHOP_SEARCH_AND' => 'И',
	'PHPSHOP_SEARCH_NOT' => 'НЕ',
	'PHPSHOP_SEARCH_TEXT1' => 'Первый выпадающий список позволяет Вам искать только в заданной категории. Второй выпадающий список позволяет Вам искать только в конкретной части информации о товаре (например, в названии). После того, как Вы выберете необходимые пункты в этих списках (или оставите все как есть), не забудте ввести ключевое слово в первую строку поиска.',
	'PHPSHOP_SEARCH_TEXT2' => 'Вы можете еще больше уточнить критерии поиска, добавив ключевое слово кроме первой строки поиска еще и во вторую и выбрав оператор \'И\' или \'НЕ\'. 
        Выбор оператора \'И\' означает, что оба слова должны быть найдены, чтобы товар был показан в результатах поиска.
        Выбор оператора \'НЕ\' означает, что результатом поиска будут только те товары, в информации о которых первое ключевое слово присутствует, а второе - нет.',
	'PHPSHOP_CONTINUE_SHOPPING' => 'Продолжить покупки',
	'PHPSHOP_AVAILABLE_IMAGES' => 'Доступные картинки для',
	'PHPSHOP_BACK_TO_DETAILS' => 'Вернуться к подробностям товара',
	'PHPSHOP_IMAGE_NOT_FOUND' => 'Картинка не найдена!',
	'PHPSHOP_PARAMETER_SEARCH_TEXT1' => 'Для поиска товара по дополнительным параметрам<BR>выберите категорию поиска, пожалуйста:',
	'PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE' => 'По Вашему запросу ничего не найдено.',
	'PHPSHOP_PARAMETER_SEARCH_BAD_PRODUCT_TYPE' => 'I am sorry. There is no published Product Type with this name.',
	'PHPSHOP_PARAMETER_SEARCH_IS_LIKE' => 'равно',
	'PHPSHOP_PARAMETER_SEARCH_IS_NOT_LIKE' => 'не равно',
	'PHPSHOP_PARAMETER_SEARCH_FULLTEXT' => 'Полнотекстовый поиск',
	'PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ALL' => 'All Selected',
	'PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ANY' => 'Any Selected',
	'PHPSHOP_PARAMETER_SEARCH_RESET_FORM' => 'Очистить все поля',
	'PHPSHOP_PRODUCT_NOT_FOUND' => 'Извините, но запрошенный Вами товар не найден!',
	'PHPSHOP_PRODUCT_PACKAGING1' => 'Number {unit}s in packaging:',
	'PHPSHOP_PRODUCT_PACKAGING2' => 'Number {unit}s in box:',
	'PHPSHOP_CART_PRICE_PER_UNIT' => 'Price per Unit',
	'VM_PRODUCT_ENQUIRY_LBL' => 'Ask a question about this product',
	'VM_RECOMMEND_FORM_LBL' => 'Recommend this product to a friend',
	'PHPSHOP_EMPTY_YOUR_CART' => 'Empty Cart',
	'VM_RETURN_TO_PRODUCT' => 'Return to product',
	'EMPTY_CATEGORY' => 'This Category is currently empty.',
	'ENQUIRY' => 'Enquiry',
	'NAME_PROMPT' => 'Enter your Name',
	'EMAIL_PROMPT' => 'E-mail Address',
	'MESSAGE_PROMPT' => 'Enter your Message',
	'SEND_BUTTON' => 'Send',
	'THANK_MESSAGE' => 'Thank you for your Enquiry. We will contact you as soon as possible.',
	'PROMPT_CLOSE' => 'Close',
	'VM_RECOVER_CART' => 'Recover Saved Cart',
	'VM_RECOVER_CART_REPLACE' => 'Replace Cart with Saved Cart',
	'VM_RECOVER_CART_MERGE' => 'Add Saved Cart to Current Cart',
	'VM_RECOVER_CART_DELETE' => 'Delete Saved Cart'
	));
?>