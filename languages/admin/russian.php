<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @package VirtueMart
* @subpackage languages
* @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
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
	'CHARSET' => 'utf-8',
	'PHPSHOP_USER_LIST_LBL' => 'Список пользователей',
	'PHPSHOP_USER_LIST_USERNAME' => 'Имя пользователя',
	'PHPSHOP_USER_LIST_FULL_NAME' => 'Полное имя (ФИО)',
	'PHPSHOP_USER_LIST_GROUP' => 'Группа',
	'PHPSHOP_USER_FORM_LBL' => 'Добавить/Обновить информацию о пользователе',
	'PHPSHOP_USER_FORM_PERMS' => 'Разрешения',
	'PHPSHOP_USER_FORM_CUSTOMER_NUMBER' => 'Номер клиента / ID',
	'PHPSHOP_MODULE_LIST_LBL' => 'Список модулей',
	'PHPSHOP_MODULE_LIST_NAME' => 'Название модуля',
	'PHPSHOP_MODULE_LIST_PERMS' => 'Права на модуль',
	'PHPSHOP_MODULE_LIST_FUNCTIONS' => 'Функции',
	'PHPSHOP_MODULE_FORM_LBL' => 'Информация о модуле',
	'PHPSHOP_MODULE_FORM_MODULE_LABEL' => 'Заголовок модуля (Для главного меню)',
	'PHPSHOP_MODULE_FORM_NAME' => 'Название модуля',
	'PHPSHOP_MODULE_FORM_PERMS' => 'Права на модуль',
	'PHPSHOP_MODULE_FORM_HEADER' => 'Заголовок модуля',
	'PHPSHOP_MODULE_FORM_FOOTER' => 'Нижний колонтитул модуля',
	'PHPSHOP_MODULE_FORM_MENU' => 'Показать модуль в разделе Администрирования?',
	'PHPSHOP_MODULE_FORM_ORDER' => 'Порядок отображения',
	'PHPSHOP_MODULE_FORM_DESCRIPTION' => 'Описание модуля',
	'PHPSHOP_MODULE_FORM_LANGUAGE_CODE' => 'Языковая кодировка',
	'PHPSHOP_MODULE_FORM_LANGUAGE_FILE' => 'Языковой файл',
	'PHPSHOP_FUNCTION_LIST_LBL' => 'Список функций',
	'PHPSHOP_FUNCTION_LIST_NAME' => 'Имя функции',
	'PHPSHOP_FUNCTION_LIST_CLASS' => 'Имя класса',
	'PHPSHOP_FUNCTION_LIST_METHOD' => 'Метод класса',
	'PHPSHOP_FUNCTION_LIST_PERMS' => 'Права на функцию',
	'PHPSHOP_FUNCTION_FORM_LBL' => 'Информация о функции',
	'PHPSHOP_FUNCTION_FORM_NAME' => 'Имя функции',
	'PHPSHOP_FUNCTION_FORM_CLASS' => 'Имя класса',
	'PHPSHOP_FUNCTION_FORM_METHOD' => 'Метод класса',
	'PHPSHOP_FUNCTION_FORM_PERMS' => 'Права на функцию',
	'PHPSHOP_FUNCTION_FORM_DESCRIPTION' => 'Описание функции',
	'PHPSHOP_CURRENCY_LIST_LBL' => 'Список валют',
	'PHPSHOP_CURRENCY_LIST_NAME' => 'Название валюты',
	'PHPSHOP_CURRENCY_LIST_CODE' => 'Код валюты',
	'PHPSHOP_COUNTRY_LIST_LBL' => 'Список стран',
	'PHPSHOP_COUNTRY_LIST_NAME' => 'Название страны',
	'PHPSHOP_COUNTRY_LIST_3_CODE' => 'Код страны (3)',
	'PHPSHOP_COUNTRY_LIST_2_CODE' => 'Код страны (2)',
	'PHPSHOP_STATE_LIST_MNU' => 'Список регионов',
	'PHPSHOP_STATE_LIST_LBL' => 'Список регионов для: ',
	'PHPSHOP_STATE_LIST_ADD' => 'Добавить/Изменить регион',
	'PHPSHOP_STATE_LIST_NAME' => 'Название региона',
	'PHPSHOP_STATE_LIST_3_CODE' => 'Код региона (3)',
	'PHPSHOP_STATE_LIST_2_CODE' => 'Код региона (2)',
	'PHPSHOP_ADMIN_CFG_GLOBAL' => 'Общие настройки',
	'PHPSHOP_ADMIN_CFG_SITE' => 'Сайт',
	'PHPSHOP_ADMIN_CFG_SHIPPING' => 'Доставка',
	'PHPSHOP_ADMIN_CFG_CHECKOUT' => 'Оформление заказа',
	'PHPSHOP_ADMIN_CFG_DOWNLOADABLEGOODS' => 'Скачивание',
	'PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE' => 'Использовать только как каталог',
	'PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN' => 'Если отмечено, то магазин будет работать <b>только как каталог</b>. При этом все функции корзины будут отключены.',
	'PHPSHOP_ADMIN_CFG_SHOW_PRICES' => 'Показывать цены',
	'PHPSHOP_ADMIN_CFG_SHOW_PRICES_EXPLAIN' => 'Отметьте этот пункт, чтобы показывать цены. Если Вы используете магазин как каталог, Вы можете отключить отображение цен на сайте.',
	'PHPSHOP_ADMIN_CFG_VIRTUAL_TAX' => 'Виртуальный налог',
	'PHPSHOP_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN' => 'Этот пункт определяет, облагаются ли налогом товары с нулевым весом или нет. Измените <b>ps_checkout.php->calc_order_taxable()</b>, чтобы настроить под собственные нужды эту функцию.',
	'PHPSHOP_ADMIN_CFG_TAX_MODE' => 'Способ расчёта налога:',
	'PHPSHOP_ADMIN_CFG_TAX_MODE_SHIP' => 'Основан на адресе доставки',
	'PHPSHOP_ADMIN_CFG_TAX_MODE_VENDOR' => 'Основан на адресе продавца',
	'PHPSHOP_ADMIN_CFG_TAX_MODE_EXPLAIN' => 'Этот пункт определяет, какая налоговая ставка используется для расчёта налога:<br />
		<ul><li>на основе региона/страны владельца магазина;</li>
		<li>на основе адреса покупателя;</li>
		<li>режим "Cтавка EC", когда налог определяется для каждого товара по отдельности, если покупатель из Евросоюза, в противном случае налог рассчитывается исходя из адреса покупателя.</li></ul>',
	'PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE' => 'Разрешить различные налоговые ставки?',
	'PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN' => 'Отметьте этот пункт, если у Вас есть товары с различной налоговой ставкой<br>(например, 10% для книг и еды, 18% для остальных товаров)',
	'PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE' => 'Вычитать скидку перед добавлением налогов/доставки?',
	'PHPSHOP_ADMIN_CFG_REVIEW' => 'Разрешить клиентам оставлять отзывы/рейтинги',
	'PHPSHOP_ADMIN_CFG_REVIEW_EXPLAIN' => 'Отметьте этот пункт, если Вы хотите разрешить вашим клиентам <strong>оценивать товары</strong> и <strong>писать отзывы</strong> на них. <br />
                                                                                 Таким образом, Ваши клиенты смогут оставлять свои отзывы о товарах для других клиентов.<br />',
	'PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN' => 'Этот пункт определяет последовательность расчёта скидки на заказанные товары: до (пункт отмечен) или после начисления суммы налогов и суммы за доставку.',
	'PHPSHOP_ADMIN_CFG_AGREE_TERMS' => 'Покупатели должны соглашаться с Условиями обслуживания?',
	'PHPSHOP_ADMIN_CFG_AGREE_TERMS_EXPLAIN' => 'Отметьте этот пункт, если Вы хотите, чтобы Ваши клиенты соглашались с Условиями обслуживания, во время регистрации в магазине.',
	'PHPSHOP_ADMIN_CFG_CHECK_STOCK' => 'Проверять наличие на складе?',
	'PHPSHOP_ADMIN_CFG_CHECK_STOCK_EXPLAIN' => 'Отметьте этот пункт, если Вы хотите, чтобы система проверяла количество доступного товара на складе. Если Вы отметите этот пункт, то система не разрешит добавить в корзину товара больше, чем доступно на складе.',
	'PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE' => 'Включить партнёрскую программу?',
	'PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE_EXPLAIN' => 'Этот пункт включает работу партнёрской программы в магазине. Включите его, если Вы добавили партнеров через панель администрирования.',
	'PHPSHOP_ADMIN_CFG_MAIL_FORMAT' => 'Формат письма:',
	'PHPSHOP_ADMIN_CFG_MAIL_FORMAT_TEXT' => 'Текст',
	'PHPSHOP_ADMIN_CFG_MAIL_FORMAT_HTML' => 'HTML',
	'PHPSHOP_ADMIN_CFG_MAIL_FORMAT_EXPLAIN' => 'Определяет формат письма, высылаемого покупателю при подтверждении заказа:<br />
		<ul><li>как простой текст</li>
		<li>или в формате html с изображениями.</li></ul>',
	'PHPSHOP_ADMIN_CFG_FRONTENDAMDIN' => 'Разрешить администрирование через магазин (frontend) пользователям, не допущенным в панель администрирования?',
	'PHPSHOP_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN' => 'Включив эту опцию, Вы можете разрешить пользователям, не имеющим доступа к панели администрирования, администрировать магазин через магазин (frontend)(например пользователям с правами Registered / Editor).',
	'PHPSHOP_ADMIN_CFG_URLSECURE' => 'Адрес для защищённого режима',
	'PHPSHOP_ADMIN_CFG_URLSECURE_EXPLAIN' => 'Адрес для защищенного режима (SSL) Вашего сайта (https со слешем в конце!)',
	'PHPSHOP_ADMIN_CFG_HOMEPAGE' => 'Главная страница',
	'PHPSHOP_ADMIN_CFG_HOMEPAGE_EXPLAIN' => 'Эта страница будет загружаться по умолчанию.',
	'PHPSHOP_ADMIN_CFG_ERRORPAGE' => 'Страница для вывода ошибок',
	'PHPSHOP_ADMIN_CFG_ERRORPAGE_EXPLAIN' => 'Страница по умолчанию, для отображения сообщений об ошибках.',
	'PHPSHOP_ADMIN_CFG_DEBUG' => 'Режим отладки?',
	'PHPSHOP_ADMIN_CFG_DEBUG_EXPLAIN' => 'Включить режим отладки. При включении данного режима, внизу каждой страницы будет выводиться информация для отладки магазина. Очень полезно во время разработки и модификации магазина, так как там будет отображено содержание корзины, значение полей форм и другая информация.',
	'PHPSHOP_ADMIN_CFG_FLYPAGE' => 'Страница товара (flypage)',
	'PHPSHOP_ADMIN_CFG_FLYPAGE_EXPLAIN' => 'Это страница будет показывать информацию о товаре по умолчанию.',
	'PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE' => 'Шаблон категории',
	'PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN' => 'Страница шаблона категории (по-умолчанию) для отображения товаров в категории<br />Вы можете создавать новые шаблоны, модифицируя существующие файлы шаблонов, которые находятся в папке <b>COMPONENTPATH/html/templates/</b> и начинаются с <b>browse_</b>)',
	'PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW' => 'Количество товаров в строке',
	'PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN' => 'Этот пункт определяет количество товаров в строке.<br />Например, если Вы установите 4, шаблон категории отобразит 4 товара в строке. <b>Для корректной работы не забудьте поменять шаблон, на соответствующий</b>.',
	'PHPSHOP_ADMIN_CFG_NOIMAGEPAGE' => 'Изображение для товара без картинки',
	'PHPSHOP_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN' => 'Это изображение будет показано, когда нет изображения товара.',
	'PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION' => 'Показывать эмблему магазина ',
	'PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION_EXPLAIN' => 'Показывает картинку "Работает на VirtueMart" внизу страницы.',
	'PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_STANDARD' => 'Стандартный модуль доставки с индивидуальными данными о расценках. <strong>РЕКОМЕНДУЕТСЯ !</strong>',
	'PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_ZONE' => '  	Модуль регионов доставки Версия 1.0<br />
		За более подробной информацией, посетите <a href="http://ZephWare.com">http://ZephWare.com</a><br />
		или свяжитесь по адресу <a href="mailto:zephware@devcompany.com">ZephWare.com</a><br /> Отметьте опцию, чтобы включить данный модуль доставки',
	'PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_DISABLE' => 'Отключить выбор варианта доставки. Выбирается, если покупатели приобретают скачиваемый товар, который не нужно доставлять.',
	'PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR' => 'Включить баннер оформления заказа',
	'PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR_EXPLAIN' => 'Отметьте, если хотите чтобы показывался покупателю \'баннер оформления заказа\' в течение процесса оформления заказа ( 1 - 2 - 3 - 4 с графикой).',
	'PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS' => 'Выберите форму оформления заказа для Вашего магазина',
	'PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS' => 'Включить скачивание товара',
	'PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN' => 'Отметьте для включения возможности скачивания товара. Только в том случае, если Вы хотите продавать скачиваемый товар.',
	'PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS' => 'Статус заказа на скачивание',
	'PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN' => 'Выберите статус заказа, при котором будет выслано письмо покупателю с напоминанием о том, что он может скачать товар.',
	'PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS' => 'Статус заказа, при котором невозможно скачивание',
	'PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN' => 'Статус заказа, при котором скачивание отключено для покупателя.',
	'PHPSHOP_ADMIN_CFG_DOWNLOADROOT' => 'Путь к файлам для скачивания',
	'PHPSHOP_ADMIN_CFG_DOWNLOADROOT_EXPLAIN' => 'Путь к файлам для скачивания покупателями. (обязательно поставить слеш в конце \'/ \' !)<br>
        <span class="message">Для безопасности Вашего магазина: Если Вы можете, установите директорию ЗА ПРЕДЕЛАМИ КОРНЕВОЙ ПАПКИ ВЕБСЕРВЕРА</span>',
	'PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX' => 'Макс. кол-во скачиваний',
	'PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN' => 'Устанавливает количество скачиваний, которое можно сделать на одно ID скачивания, (для одного заказа)',
	'PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE' => 'Возможность скачивания истекает через (сек.)',
	'PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN' => 'Установите интервал <strong>в секундах</strong>, в течение которого покупатель может скачивать товар. 
  Этот интервал начинает отсчитываться после первого скачивания! Когда временной интервал истек, ID скачивания отключается.<br />Заметьте: 86400сек=24ч.',
	'PHPSHOP_COUPONS' => 'Купоны',
	'PHPSHOP_COUPONS_ENABLE' => 'Включить использование купонов',
	'PHPSHOP_COUPONS_ENABLE_EXPLAIN' => 'Если Вы включите Использование купонов, Вы позволите покупателям вводить Номер купона для получения скидок при покупке.',
	'PHPSHOP_ADMIN_CFG_PDF_BUTTON' => 'PDF - Кнопка',
	'PHPSHOP_ADMIN_CFG_PDF_BUTTON_EXPLAIN' => 'Показать или скрыть PDF - Кнопку в магазине',
	'PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER' => 'Покупатели должны соглашаться с условиями обслуживания при каждом заказе?',
	'PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN' => 'Отметьте, если хотите, чтобы покупатель каждый раз соглашался с условиями обслуживания при каждом заказе товара (перед оформлением заказа).',
	'PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS' => 'Показывать товары, которых нет на складе',
	'PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS_EXPLAIN' => 'Отметьте, если хотите, чтобы товары, которых временно нет на складе, отображались в магазине. В противном случае, такие товары не будут показаны в магазине.',
	'PHPSHOP_ADMIN_CFG_SHOP_OFFLINE' => 'Магазин закрыт?',
	'PHPSHOP_ADMIN_CFG_SHOP_OFFLINE_TIP' => 'Отметьте, если необходимо закрыть магазин. Соответствующее уведомление будет показано при заходе в магазин.',
	'PHPSHOP_ADMIN_CFG_SHOP_OFFLINE_MSG' => 'Уведомление о том, что магазин закрыт',
	'PHPSHOP_ADMIN_CFG_TABLEPREFIX' => 'Префикс для таблиц VirtueMart',
	'PHPSHOP_ADMIN_CFG_TABLEPREFIX_TIP' => 'По умолчанию <strong>vm</strong>',
	'PHPSHOP_ADMIN_CFG_NAV_AT_TOP' => 'Показывать панель навигации вверху списка товаров?',
	'PHPSHOP_ADMIN_CFG_NAV_AT_TOP_TIP' => 'Включает или выключает показ панели навигации вверху списка товаров в магазине.',
	'PHPSHOP_ADMIN_CFG_SHOW_PRODUCT_COUNT' => 'Показывать количество товаров?',
	'PHPSHOP_ADMIN_CFG_SHOW_PRODUCT_COUNT_TIP' => 'Показывать количество товаров в категории, например: Категория (4)?',
	'PHPSHOP_ADMIN_CFG_DYNAMIC_THUMBNAIL_RESIZING' => 'Включить динамическое изменение размеров для мини-изображения?',
	'PHPSHOP_ADMIN_CFG_DYNAMIC_THUMBNAIL_RESIZING_TIP' => 'Отметьте, если хотите включить динамическое изменение размеров изображения. Это означает, что все изображения изменят размеры до указанных вами ниже, путем применения функций GD2 библиотеки РНР (Вы можете проверить, установлена библиотека GD2 зайдя в "Помощь"->"Информация о системе" -> " Информация PHP" ->  gd. 
        Качество мини-изображений, полученное при использовании GD2 выше, чем, если бы масштабирование произвел браузер. Новые изображения генерируются и складываются в папку /shop_image/product/resized. Если изображение уже сгенерировано, то копия его отсылается браузеру, а не генерируется каждый раз.',
	'PHPSHOP_ADMIN_CFG_THUMBNAIL_WIDTH' => 'Ширина мини-изображения',
	'PHPSHOP_ADMIN_CFG_THUMBNAIL_WIDTH_TIP' => '<strong>Ширина</strong> сгенерированных изображений.',
	'PHPSHOP_ADMIN_CFG_THUMBNAIL_HEIGHT' => 'Высота мини-изображения',
	'PHPSHOP_ADMIN_CFG_THUMBNAIL_HEIGHT_TIP' => '<strong>Высота</strong> сгенерированных изображений.',
	'PHPSHOP_ADMIN_CFG_SHIPPING_NO_SELECTION' => 'Пожалуйста, выберите вариант доставки!',
	'PHPSHOP_ADMIN_CFG_PRICE_CONFIGURATION' => 'Цена',
	'PHPSHOP_ADMIN_CFG_PRICE_ACCESS_LEVEL' => 'Группа пользователей, которым показывать цены',
	'PHPSHOP_ADMIN_CFG_PRICE_ACCESS_LEVEL_TIP' => 'Цены на товары в магазине будут показаны только выбранной группе пользователей и всем группам с правами выше выбранной.',
	'PHPSHOP_ADMIN_CFG_PRICE_SHOW_INCLUDINGTAX' => 'Показать "(включая XX% налогов)", когда они применяются?',
	'PHPSHOP_ADMIN_CFG_PRICE_SHOW_INCLUDINGTAX_TIP' => 'Отметьте, если хотите, чтобы пользователи видели текст "(включая xx% налоги)" - когда цены показываются, включая налоги.',
	'PHPSHOP_ADMIN_CFG_PRICE_SHOW_PACKAGING_PRICELABEL' => 'Показать стоимость упаковки?',
	'PHPSHOP_ADMIN_CFG_PRICE_SHOW_PACKAGING_PRICELABEL_TIP' => 'Когда отмечено, цена формируется из цены товара и упаковки:<br/>
<strong>Цена за единицу (10 штук)</strong><br/>
Когда не отмечено, цена выглядит так: <strong>Цена: xx.xx руб.</strong>',
	'PHPSHOP_ADMIN_CFG_MORE_CORE_SETTINGS' => 'Дополнительные настройки',
	'PHPSHOP_ADMIN_CFG_CORE_SETTINGS' => 'Дополнительные настройки',
	'PHPSHOP_ADMIN_CFG_FRONTEND_FEATURES' => 'Возможности магазина',
	'PHPSHOP_ADMIN_CFG_TAX_CONFIGURATION' => 'Налоги',
	'PHPSHOP_ADMIN_CFG_USER_REGISTRATION_SETTINGS' => 'Регистрация пользователей',
	'PHPSHOP_ADMIN_CFG_ALLOW_REGISTRATION' => 'Разрешить регистрацию пользователей?',
	'PHPSHOP_ADMIN_CFG_ACCOUNT_ACTIVATION' => 'Необходима ли активация новых учетных записей?',
	'VM_FIELDMANAGER_NAME' => 'Название поля',
	'VM_FIELDMANAGER_TITLE' => 'Заголовок поля',
	'VM_FIELDMANAGER_TYPE' => 'Тип поля',
	'VM_FIELDMANAGER_REQUIRED' => 'Требуется',
	'VM_FIELDMANAGER_PUBLISHED' => 'Опубликовать',
	'VM_FIELDMANAGER_SHOW_ON_REGISTRATION' => 'Показывать в регистрационной форме?',
	'VM_FIELDMANAGER_SHOW_ON_ACCOUNT' => 'Показать в разделе управления учетной записью пользователя?',
	'VM_USERFIELD_FORM_LBL' => 'Добавить / Изменить поля',
	'VM_BROWSE_ORDERBY_DEFAULT_FIELD_LBL' => 'Сортировка товаров по умолчанию',
	'VM_BROWSE_ORDERBY_DEFAULT_FIELD_LBL_TIP' => 'Укажите? по каким полям проводить сортировку товара по умолчанию',
	'VM_BROWSE_ORDERBY_FIELDS_LBL' => 'Доступные поля сортировки',
	'VM_BROWSE_ORDERBY_FIELDS_LBL_TIP' => 'Выберите поля, по которым будет разрешена сортировка. Если Вы ничего не выделите, то форма для сортировки показана не будет.',
	'VM_GENERALLY_PREVENT_HTTPS' => 'Обычно предотвращать соединение по протоколу https?',
	'VM_GENERALLY_PREVENT_HTTPS_TIP' => 'Если включить опцию, то пользователь будет перенаправляться на <strong>http</strong> ссылки, когда посещает разделы магазины, для которых жестко не установлена необходимость использования https.',
	'VM_MODULES_FORCE_HTTPS' => 'Разделы магазина, которые должны использовать https',
	'VM_MODULES_FORCE_HTTPS_TIP' => 'Через запятую укажите те модули, где должно использоваться соединение через https (См. "Администрирование" => "Список модулей").',
	'VM_SHOW_REMEMBER_ME_BOX' => 'Показать "Запомнить" на форме авторизации?',
	'VM_SHOW_REMEMBER_ME_BOX_TIP' => 'Если включить опцию, то пользователь сможет отметить поле "Запомнить", чтобы система запоминала его. В целях безопасности не рекомендуется включать при использовании совместного (shared) ssl.',
	'VM_ADMIN_CFG_REVIEW_MINIMUM_COMMENT_LENGTH' => 'Минимальная длина комментария',
	'VM_ADMIN_CFG_REVIEW_MINIMUM_COMMENT_LENGTH_TIP' => 'Укажите минимальное количество знаков, которое пользователь должен будет написать, прежде чем сможет отправить свой отзыв.',
	'VM_ADMIN_CFG_REVIEW_MAXIMUM_COMMENT_LENGTH' => 'Максимальная длина комментария',
	'VM_ADMIN_CFG_REVIEW_MAXIMUM_COMMENT_LENGTH_TIP' => 'Укажите максимальное количество знаков, которое может написать пользователь.',
	'VM_ADMIN_SHOW_EMAILFRIEND' => 'Показывать ссылку "Рекомендовать другу"?',
	'VM_ADMIN_SHOW_EMAILFRIEND_TIP' => 'Если включить опцию, то будет показана небольшая ссылка, которая позволит пользователю отправить по e-mail ссылку на данный товар.',
	'VM_ADMIN_SHOW_PRINTICON' => 'Показывать ссылку "Вид для печати"?',
	'VM_ADMIN_SHOW_PRINTICON_TIP' => 'Если включить опцию, то будет показана небольшая ссылка, которая откроет данную страницу в новом окне в формате удобном для печати.',
	'VM_REVIEWS_AUTOPUBLISH' => 'Разрешить автоматическую публикацию отзывов?',
	'VM_REVIEWS_AUTOPUBLISH_TIP' => 'Если включить опцию, то отзывы пользователей будут публиковаться автоматически, в противном случае отзывы должны быть одобрены администратором.',
	'VM_ADMIN_CFG_PROXY_SETTINGS' => 'Настройки proxy',
	'VM_ADMIN_CFG_PROXY_URL' => 'URL-ссылка proxy сервера',
	'VM_ADMIN_CFG_PROXY_URL_TIP' => 'Например: <strong>http://10.42.21.1</strong>.<br />
Оставьте поле пустым, если Вы не уверены, что надо указать. Это значение будет использоваться, чтобы установить связь с интернетом из магазина (с сервера, где расположен магазин) (например, если требуется получить данные от UPS/USPS).',
	'VM_ADMIN_CFG_PROXY_PORT' => 'Порт proxy',
	'VM_ADMIN_CFG_PROXY_PORT_TIP' => 'Номер порта, который используется для соединения с proxy сервером (обычно <b>80</b> или <b>8080</b>).',
	'VM_ADMIN_CFG_PROXY_USER' => 'Имя пользователя proxy',
	'VM_ADMIN_CFG_PROXY_USER_TIP' => 'Если proxy сервер требует авторизации, введите здесь имя пользователя, используемое для авторизации.',
	'VM_ADMIN_CFG_PROXY_PASS' => 'Пароль для proxy',
	'VM_ADMIN_CFG_PROXY_PASS_TIP' => 'Если proxy сервер требует авторизации, введите здесь пароль, используемый для авторизации.',
	'VM_ADMIN_ONCHECKOUT_SHOW_LEGALINFO' => 'Показывать короткую информацию о "Политике возврата" на странице подтверждения заказа?',
	'VM_ADMIN_ONCHECKOUT_SHOW_LEGALINFO_TIP' => 'В большинстве европейских стран законы требуют от владельцев магазинов информировать своих клиентов о политике возврата товара и отмены заказов. Так что, в большинстве случаях, эта опция должна быть включена.',
	'VM_ADMIN_ONCHECKOUT_LEGALINFO_SHORTTEXT' => 'Правовая информация (короткая версия).',
	'VM_ADMIN_ONCHECKOUT_LEGALINFO_SHORTTEXT_TIP' => 'Этот текст коротко сообщает Вашим покупателям о политике возврата товара и отмены заказов. Он будет показан на странице подтверждения заказа, над кнопкой "Подтвердить заказ".',
	'VM_ADMIN_ONCHECKOUT_LEGALINFO_LINK' => 'Полная версия политики возврата (Ссылка на описание).',
	'VM_ADMIN_ONCHECKOUT_LEGALINFO_LINK_TIP' => 'Пожалуйста, напишите подробную политику по возврату товара и отмене заказов.
После этого, Вы сможете указать ее здесь.',
	'VM_SELECT_THEME' => 'Выберите шаблон для магазина',
	'VM_SELECT_THEME_TIP' => 'Шаблоны позволяют изменить облик Вашего магазина. <br />Если кроме шаблона "default" никаких других нет, это значит, что у Вас не установлены другие шаблоны.',
	'VM_CFG_CONTENT_PLUGINS_ENABLE' => 'Разрешить использование мамботов / плагинов в описании товара и категории?',
	'VM_CFG_CONTENT_PLUGINS_ENABLE_TIP' => 'Если включить опцию, то в описании категории и товара будут работать все опубликованные мамботы/плагины.',
	'VM_CFG_CURRENCY_MODULE' => 'Выберите модуль конвертора валют',
	'VM_CFG_CURRENCY_MODULE_TIP' => 'Здесь Вы можете выбрать модуль, который будет подтягивать данные курсов валют с сервера (например: ЦБ РФ) и на основе которых будет производиться пересчет из одной валюты в другую.',
	'PHPSHOP_ADMIN_CFG_TAX_MODE_EU' => 'Ставка ЕС',
	'VM_ADMIN_CFG_DOWNLOAD_KEEP_STOCKLEVEL' => 'Не уменьшать количество товара на складе при покупке?',
	'VM_ADMIN_CFG_DOWNLOAD_KEEP_STOCKLEVEL_TIP' => 'Если включить опцию, то количество товара на складе не будет уменьшаться для скачиваемых товаров.',
	'VM_USERGROUP_FORM_LBL' => 'Добавить/Редактировать группу пользователя',
	'VM_USERGROUP_NAME' => 'Имя группы пользователя',
	'VM_USERGROUP_LEVEL' => 'Уровень группы пользователя',
	'VM_USERGROUP_LEVEL_TIP' => 'Важно! Более большое значение обозначает <b>меньшее</b> количество прав. Группа <b>Администраторы (admin)</b> имеет <em>уровень 0</em>, администратор магазина (storeadmin) - уровень 250, пользователь - 500.',
	'VM_USERGROUP_LIST_LBL' => 'Группы пользователей',
	'VM_ADMIN_CFG_COOKIE_CHECK' => 'Включить проверку куки?',
	'VM_ADMIN_CFG_COOKIE_CHECK_EXPLAIN' => 'Если включить опцию, то VirtueMart будет проверять, принимает ли браузер пользователя куки или нет. Это повышает дружелюбие системы для пользователя, но может негативно сказать на индексации сторонними поисковыми системами.',
	'VM_CFG_REGISTRATION_TYPE' => 'Тип регистрации пользователя',
	'VM_CFG_REGISTRATION_TYPE_TIP' => 'Выберите тип регистрации пользователя в Вашем магазине!<br />
<strong>Нормальная регистрация</strong><br />
Это стандартная регистрация, при которой пользователь должен выбрать имя пользователя (логин) и пароль.<br /><br />
<strong>Скрытая регистрация</strong><br />
Скрытая регистрация означает, что пользователь не должен выбирать имя пользователя и пароль, а они создаются автоматически и посылаются по предоставленному e-mail.
<br /><br />
<strong>Опциональная регистрация</strong><br />
Опциональная регистрация позволяет выбрать пользователю, хочет он создать свою учетную запись (Стандартная регистрация) или нет (Скрытая регистрация).
<br /><br />
<strong>Регистрация не требуется</strong><br />
Пользователь не должен и не сможет зарегистрироваться.',
	'VM_CFG_REGISTRATION_TYPE_NORMAL_REGISTRATION' => 'Нормальное создание учетной записи',
	'VM_CFG_REGISTRATION_TYPE_SILENT_REGISTRATION' => 'Скрытое создание учетной записи',
	'VM_CFG_REGISTRATION_TYPE_OPTIONAL_REGISTRATION' => 'Опциональное создание учетной записи',
	'VM_CFG_REGISTRATION_TYPE_NO_REGISTRATION' => 'Учетная запись не создается',
	'VM_ADMIN_CFG_FEED_CONFIGURATION' => 'Настройки ленты новостей',
	'VM_ADMIN_CFG_FEED_ENABLE' => 'Включить ленту новостей',
	'VM_ADMIN_CFG_FEED_ENABLE_TIP' => 'Если включить опцию, то пользователь сможет подписаться на ленту новостей по последним товарам (из всех категорий или только некоторых) в Вашем магазине.',
	'VM_ADMIN_CFG_FEED_CACHE' => 'Настройки кэша ленты новостей',
	'VM_ADMIN_CFG_FEED_CACHE_ENABLE' => 'Включить кэширование?',
	'VM_ADMIN_CFG_FEED_CACHETIME' => 'Время кэширования (в секундах)',
	'VM_ADMIN_CFG_FEED_CACHE_TIP' => 'Кэширование ускоряет доставку ленты новостей и уменьшает нагрузку на сервер, т.к. лента создается единожды и сохраняется в файле, а не каждый раз берется из базы данных.',
	'VM_ADMIN_CFG_FEED_SHOWPRICES' => 'Включить цену товара в описание?',
	'VM_ADMIN_CFG_FEED_SHOWPRICES_TIP' => 'Если включить опцию, то стандартная цена будет добавлена в описание товара',
	'VM_ADMIN_CFG_FEED_SHOWDESC' => 'Включить описание товара?',
	'VM_ADMIN_CFG_FEED_SHOWDESC_TIP' => 'Если включить опцию, то описание товара будет добавлено в ленту новостей',
	'VM_ADMIN_CFG_FEED_SHOWIMAGES' => 'Включить изображение товара?',
	'VM_ADMIN_CFG_FEED_SHOWIMAGES_TIP' => 'Если включить опцию, то изображение товара будет добавлено в ленту новостей.',
	'VM_ADMIN_CFG_FEED_DESCRIPTION_TYPE' => 'Тип описания товара',
	'VM_ADMIN_CFG_FEED_DESCRIPTION_TYPE_TIP' => 'Выберите тип описания товара, которое будет включаться в ленту новостей.',
	'VM_ADMIN_CFG_FEED_LIMITTEXT' => 'Размер описания?',
	'VM_ADMIN_CFG_FEED_MAX_TEXT_LENGTH' => 'Максимальная длина описания',
	'VM_ADMIN_CFG_MAX_TEXT_LENGTH_TIP' => 'Укажите максимальную длину описания для ленты новостей.',
	'VM_ADMIN_CFG_FEED_TITLE_TIP' => 'Заголовок ленты (тег {storename} обозначает название магазина)',
	'VM_ADMIN_CFG_FEED_TITLE_CATEGORIES_TIP' => 'Заголовок для категории ({catname} - тег для обозначения названия категории, {storename} - обозначает название магазина)',
	'VM_ADMIN_CFG_FEED_TITLE' => 'Заголовок ленты',
	'VM_ADMIN_CFG_FEED_TITLE_CATEGORIES' => 'Заголовок для категории',
	'VM_ADMIN_SECURITY' => 'Безопасность',
	'VM_ADMIN_SECURITY_SETTINGS' => 'Настройки безопасности',
	'VM_CFG_ENABLE_FEATURE' => 'Включить эту опцию',
	'VM_CFG_CHECKOUT_SHOWSTEP_TIP' => 'Здесь Вы можете включить, выключить или изменить порядок шагов при оформлении заказа. Также Вы можете отобразить на одной странице несколько шагов (например: способ доставки и способ оплаты), присвоив им один и тот же номер.',
	'PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_FLEX' => 'Гибкий тариф. Фиксированный тариф плюс % от стоимости общей продажи выше установленного уровня',
	'PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_SHIPVALUE' => 'Фиксированный тариф, на основе введенных данных.',
	'VM_CFG_CHECKOUT_SHOWSTEPINCHECKOUT' => 'Показать на шаге: %s процесса оформления заказа.',
	'VM_ADMIN_ENCRYPTION_KEY' => 'Ключ шифрования',
	'VM_ADMIN_ENCRYPTION_KEY_TIP' => 'Используется для кодирования личной информации пользователя в базе данных (например, номер кредитных карточек).',
	'VM_ADMIN_STORE_CREDITCARD_DATA' => 'Сохранять информацию о кредитной карточке?',
	'VM_ADMIN_STORE_CREDITCARD_DATA_TIP' => 'VirtueMart может хранить информацию о кредитной карточке в зашифрованном виде в базе данных. Это происходит даже, если обработка карточки происходит внешним платежным оператором. <strong>Если Вы НЕ производите обработку платежей по карточкам вручную, после размещения заказа, Вы должны отключить данную опцию.</strong>',
	'VM_USERFIELDS_URL_ONLY' => 'Только URL',
	'VM_USERFIELDS_HYPERTEXT_URL' => 'Гипертекст и URL',
	'VM_FIELDS_TEXTFIELD' => 'Текстовое поле',
	'VM_FIELDS_CHECKBOX_SINGLE' => 'Check Box (один раз)',
	'VM_FIELDS_CHECKBOX_MULTIPLE' => 'Check Box (несколько раз)',
	'VM_FIELDS_DATE' => 'Дата',
	'VM_FIELDS_DROPDOWN_SINGLE' => 'Ниспадающее меню (один выбор)',
	'VM_FIELDS_DROPDOWN_MULTIPLE' => 'Ниспадающее меню (несколько выборов)',
	'VM_FIELDS_EMAIL' => 'E-mail адрес',
	'VM_FIELDS_EUVATID' => 'НДС ID для ЕС (только в ЕС)',
	'VM_FIELDS_EDITORAREA' => 'Область для текстового редактора',
	'VM_FIELDS_TEXTAREA' => 'Область для текста',
	'VM_FIELDS_RADIOBUTTON' => 'Кнопка типа Radio',
	'VM_FIELDS_WEBADDRESS' => 'Адрес в интернет',
	'VM_FIELDS_DELIMITER' => '=== Разделитель поля ===',
	'VM_FIELDS_NEWSLETTER' => 'Подписка на новости',
	'VM_USERFIELDS_READONLY' => 'Только для чтения',
	'VM_USERFIELDS_SIZE' => 'Размер поля',
	'VM_USERFIELDS_MAXLENGTH' => 'Макс. длина',
	'VM_USERFIELDS_DESCRIPTION' => 'Описание, подсказка: текст или HTML',
	'VM_USERFIELDS_COLUMNS' => 'Колонок',
	'VM_USERFIELDS_ROWS' => 'Рядов',
	'VM_USERFIELDS_EUVATID_MOVESHOPPER' => 'Переместить пользователя в следующую группу, после успешной проверки НДС ID (только в ЕС)',
	'VM_USERFIELDS_ADDVALUES_TIP' => 'Используйте таблицу ниже, чтобы добавить новые значения.',
	'VM_ADMIN_CFG_DISPLAY' => 'Отображение',
	'VM_ADMIN_CFG_LAYOUT' => 'Вид',
	'VM_ADMIN_CFG_THEME_SETTINGS' => 'Настройки шаблона',
	'VM_ADMIN_CFG_THEME_PARAMETERS' => 'Параметры',
	'VM_ADMIN_ENCRYPTION_FUNCTION' => 'Функция шифрования',
	'VM_ADMIN_ENCRYPTION_FUNCTION_TIP' => 'Здесь Вы можете выбрать функцию шифрования для шифрования личной информации пользователей перед сохранением ее в базе данных. Рекомендуется использовать функцию AES_ENCRYPT, т.к. она высокоэффективна. Функция ENCODE не осуществляет настоящее шифрование.',
	'SAVE_PERMISSIONS' => 'Сохранить разрешения',
	'VM_ADMIN_THEME_CFG_NOT_EXISTS' => 'Файл конфигурации для этого шаблона не существует и не может быть создан. Настройка невозможна.',
	'VM_ADMIN_THEME_NOT_EXISTS' => 'Шаблон "{theme}" не существует.',
	'VM_USERFIELDS_ADDVALUE' => 'Добавить значения',
	'VM_USERFIELDS_TITLE' => 'Заголовок',
	'VM_USERFIELDS_VALUE' => 'Значение',
	'VM_USER_FORM_LASTVISIT_NEVER' => 'Никогда',
	'VM_USER_FORM_TAB_GENERALINFO' => 'Общая информация о пользователях',
	'VM_USER_FORM_LEGEND_USERDETAILS' => 'Детали пользователя',
	'VM_USER_FORM_LEGEND_PARAMETERS' => 'Параметры',
	'VM_USER_FORM_LEGEND_CONTACTINFO' => 'Контактная информация',
	'VM_USER_FORM_NAME' => 'Имя',
	'VM_USER_FORM_USERNAME' => 'Имя пользователя (логин)',
	'VM_USER_FORM_EMAIL' => 'E-mail',
	'VM_USER_FORM_NEWPASSWORD' => 'Новый пароль',
	'VM_USER_FORM_VERIFYPASSWORD' => 'Подтвердите пароль',
	'VM_USER_FORM_GROUP' => 'Группа',
	'VM_USER_FORM_BLOCKUSER' => 'Заблокировать пользователя',
	'VM_USER_FORM_RECEIVESYSTEMEMAILS' => 'Получать системные e-mail\'ы',
	'VM_USER_FORM_REGISTERDATE' => 'Дата регистрации',
	'VM_USER_FORM_LASTVISITDATE' => 'Дата последнего посещения',
	'VM_USER_FORM_NOCONTACTDETAILS_1' => 'Нет контактной информации для этого пользователя:',
	'VM_USER_FORM_NOCONTACTDETAILS_2' => 'Подробнее смотрите \'Компоненты -> Контакты -> Контакты.',
	'VM_USER_FORM_CONTACTDETAILS_NAME' => 'Имя',
	'VM_USER_FORM_CONTACTDETAILS_POSITION' => 'Должность',
	'VM_USER_FORM_CONTACTDETAILS_TELEPHONE' => 'Телефон',
	'VM_USER_FORM_CONTACTDETAILS_FAX' => 'Факс',
	'VM_USER_FORM_CONTACTDETAILS_CHANGEBUTTON' => 'Изменить контактную информацию',
	'VM_ADMIN_CFG_LOGFILE_HEADER' => 'Настройки log-файла',
	'VM_ADMIN_CFG_LOGFILE_ENABLED' => 'Включить формирование log-файла?',
	'VM_ADMIN_CFG_LOGFILE_ENABLED_EXPLAIN' => 'Если отключить эту опцию, то будет создан "нулевой" файл, так что vmFileLogger не будет выдавать ошибку.',
	'VM_ADMIN_CFG_LOGFILE_NAME' => 'Названия log-файла',
	'VM_ADMIN_CFG_LOGFILE_NAME_EXPLAIN' => 'Путь к log-файлу. К файлу должен быть доступ и в файл можно писать.',
	'VM_ADMIN_CFG_LOGFILE_LEVEL' => 'Уровень занесения информации в log-файл',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_EXPLAIN' => 'Сообщения с уровнем выше установленного будут игнорироваться.',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_TIP' => 'Совет - 8',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_DEBUG' => 'Отладка - 7',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_INFO' => 'Информация - 6',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_NOTICE' => 'Уведомление - 5',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_WARNING' => 'Предупреждение - 4',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_ERR' => 'Ошибка - 3',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_CRIT' => 'Критическая ошибка - 2',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_ALERT' => 'Предупреждение - 1',
	'VM_ADMIN_CFG_LOGFILE_LEVEL_EMERG' => 'Важно - 0',
	'VM_ADMIN_CFG_LOGFILE_FORMAT' => 'Формат log-файла',
	'VM_ADMIN_CFG_LOGFILE_FORMAT_EXPLAIN' => 'Формат каждой строки Формат log-файла.',
	'VM_ADMIN_CFG_LOGFILE_FORMAT_EXPLAIN_EXTRA' => 'Log-файл может содержать следующие поля: %{timestamp} %{ident} [%{priority}] [%{remoteip}] [%{username}] %{message} %{vmsessionid}.',
	'VM_ADMIN_CFG_LOGFILE_ERROR' => 'Нельзя создать или получить доступ к log-файлу. Свяжитесь с администратором.',
	'VM_ADMIN_CFG_DEBUG_MODE_ENABLED' => 'Включить режим отладки?',
	'VM_ADMIN_CFG_DEBUG_IP_ENABLED' => 'Ограничение по IP адресу?',
	'VM_ADMIN_CFG_DEBUG_IP_ENABLED_EXPLAIN' => 'Ограничить вывод отладочной информации для указанного IP адреса?',
	'VM_ADMIN_CFG_DEBUG_IP_ADDRESS' => 'IP адрес',
	'VM_ADMIN_CFG_DEBUG_IP_ADDRESS_EXPLAIN' => 'Если включить данную опцию и указать IP адрес, тогда отладочная информация будет отображаться только для пользователя с указанным IP адресом. Все другие клиенты не увидят отладочную информацию.',
	'VM_USER_NOSHIPPINGADDR' => 'No shipping addresses.'
); $VM_LANG->initModule( 'admin', $langvars );
?>