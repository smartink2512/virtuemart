<?php
/*
* @version $Id: phpshop.cfg-dist.php,v 1.17 2005/05/26 19:55:24 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage Core
*
* @copyright (C) 2004 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
global $mosConfig_absolute_path,$mosConfig_live_site, $mosConfig_list_limit;

if( empty( $mosConfig_list_limit )) $mosConfig_list_limit = 20;

define('PSHOP_IS_OFFLINE', '');
define('PSHOP_OFFLINE_MESSAGE', '<h2>Our Shop is currently down for maintenance.</h2> Please check back again soon.');
define ('USE_AS_CATALOGUE', '');
define ('_SHOW_PRICES', '1');
define ('URL', $mosConfig_live_site.'/');
define ('ORDER_MAIL_HTML', '1');
define ('SECUREURL', $mosConfig_live_site.'/');
define ('COMPONENTURL', $mosConfig_live_site.'/administrator/components/com_phpshop/');
define ('IMAGEURL', $mosConfig_live_site.'/components/com_phpshop/shop_image/');
define ('ADMINPATH', $mosConfig_absolute_path.'/administrator/components/com_phpshop/');
define ('CLASSPATH', $mosConfig_absolute_path.'/administrator/components/com_phpshop/classes/');
define ('PAGEPATH', $mosConfig_absolute_path.'/administrator/components/com_phpshop/html/');
define ('IMAGEPATH', $mosConfig_absolute_path.'/components/com_phpshop/shop_image/');
define ('HOMEPAGE', 'shop.index');
define ('FLYPAGE', 'shop.flypage');
define ('ERRORPAGE', 'shop.error');
define ('DEBUGPAGE', 'shop.debug');
define ('NO_IMAGE', '/ps_image/noimage.gif');
define ('SEARCH_ROWS', $mosConfig_list_limit);
define ('SEARCH_COLOR_1', '#f9f9f9');
define ('SEARCH_COLOR_2', '#f0f0f0');
define ('MAX_ROWS', '5');
define ('DEBUG', '');
define ('SHOWVERSION', '1');
define ('TAX_VIRTUAL', '1');
define ('TAX_MODE', '1');
define ('MULTIPLE_TAXRATES_ENABLE', '');
define ('SHOW_PRICE_WITH_TAX', '');
define ('PAYMENT_DISCOUNT_BEFORE', '');
define ('MUST_AGREE_TO_TOS', '1');
define ('PSHOP_AGREE_TO_TOS_ONORDER', '');
define ('LEAVE_BANK_DATA', '');
define ('CAN_SELECT_STATES', '');
define ('SHOW_CHECKOUT_BAR', '1');
define ('CHECKOUT_STYLE', '1');
define ('CHECK_STOCK', '');
define ('ENCODE_KEY', 'mambophpShopIsCool');
define ('PSHOP_SHIPPING_MODULE', 'standard_shipping');
define ('NO_SHIPPING', '');
define ('NO_SHIPTO', '');
define ('ENABLE_DOWNLOADS', '');
define ('ENABLE_DOWNLOAD_STATUS', 'C');
define ('DISABLE_DOWNLOAD_STATUS', 'X');
define ('DOWNLOADROOT', $mosConfig_absolute_path."/");
define ('DOWNLOAD_MAX', '3');
define ('DOWNLOAD_EXPIRE', '432000');
define ('AFFILIATE_ENABLE', '');
define('PSHOP_ALLOW_REVIEWS', '1');
define ('CATEGORY_TEMPLATE', 'browse_1');
define ('PRODUCTS_PER_ROW', '1');
define ('PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS', '');
define('PSHOP_ADD_TO_CART_STYLE', 'add-to-cart_orange.gif');
define('PSHOP_IMG_RESIZE_ENABLE', '');
define('PSHOP_IMG_WIDTH', '90');
define('PSHOP_IMG_HEIGHT', '90');
define('PSHOP_COUPONS_ENABLE', '1');
define('PSHOP_PDF_BUTTON_ENABLE', '1');
define('CFG_MAILER', 'mail');
define('CFG_MAILFROM', '');
define('CFG_MAILFROM_NAME', '');
define('CFG_SMTPHOST', '');
define('CFG_SMTPAUTH', '0');
define('CFG_SMTPUSER', '');
define('CFG_SMTPPASS', '');
define('PSHOP_SHOW_PRODUCTS_IN_CATEGORY', '1');
define('PSHOP_SHOW_TOP_PAGENAV', '1');
define('PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS', '1');

/* Shipping Methods Definition */
global $PSHOP_SHIPPING_MODULES;
$PSHOP_SHIPPING_MODULES[0] = "flex";
$PSHOP_SHIPPING_MODULES[1] = "standard_shipping";
?>
