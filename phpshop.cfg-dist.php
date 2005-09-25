<?php
	
global $mosConfig_absolute_path,$mosConfig_live_site;
if( stristr( $_SERVER['PHP_SELF'], 'administrator' ))
	require_once( '../configuration.php' );
else
	require_once( 'configuration.php' );

// these path and url definitions here are based on the mambo configuration
define( 'URL', $mosConfig_live_site.'/' );
define( 'SECUREURL', 'https://localhost/joomla/' );
if( $_SERVER['SERVER_PORT'] == 443 )
	define( 'IMAGEURL', SECUREURL .'/components/com_phpshop/shop_image/' );
else
	define( 'IMAGEURL', URL .'/components/com_phpshop/shop_image/' );
define( 'COMPONENTURL', URL .'administrator/components/com_phpshop/' );
define( 'ADMINPATH', $mosConfig_absolute_path.'/administrator/components/com_phpshop/' );
define( 'CLASSPATH', ADMINPATH.'classes/' );
define( 'PAGEPATH', ADMINPATH.'html/' );
define( 'IMAGEPATH', $mosConfig_absolute_path.'/components/com_phpshop/shop_image/' );

define('PSHOP_IS_OFFLINE', '');
define('PSHOP_OFFLINE_MESSAGE', '<h2>Our Shop is currently down for maintenance.</h2> Please check back again soon.');
define('USE_AS_CATALOGUE', '');
define('ENABLE_DOWNLOADS', '');
define('DOWNLOAD_MAX', '3');
define('DOWNLOAD_EXPIRE', '432000');
define('ENABLE_DOWNLOAD_STATUS', 'C');
define('DISABLE_DOWNLOAD_STATUS', 'X');
define('DOWNLOADROOT', '/opt/lampp/htdocs/joomla/');
define('_SHOW_PRICES', '1');
define('ORDER_MAIL_HTML', '1');
define('HOMEPAGE', 'shop.index');
define('FLYPAGE', 'shop.flypage');
define('CATEGORY_TEMPLATE', 'browse_1');
define('PRODUCTS_PER_ROW', '1');
define('ERRORPAGE', 'shop.error');
define('DEBUGPAGE', 'shop.debug');
define('NO_IMAGE', '/ps_image/noimage.gif');
define('SEARCH_ROWS', '20');
define('SEARCH_COLOR_1', '#f9f9f9');
define('SEARCH_COLOR_2', '#f0f0f0');
define('DEBUG', '');
define('SHOWVERSION', '1');
define('PSHOP_ADD_TO_CART_STYLE', 'add-to-cart_orange.gif');
define('TAX_VIRTUAL', '1');
define('TAX_MODE', '1');
define('MULTIPLE_TAXRATES_ENABLE', '');
define('PAYMENT_DISCOUNT_BEFORE', '');
define('PSHOP_ALLOW_REVIEWS', '1');
define('MUST_AGREE_TO_TOS', '1');
define('PSHOP_AGREE_TO_TOS_ONORDER', '');
define('LEAVE_BANK_DATA', '');
define('CAN_SELECT_STATES', '');
define('SHOW_CHECKOUT_BAR', '1');
define('CHECKOUT_STYLE', '1');
define('CHECK_STOCK', '');
define('ENCODE_KEY', 'mambophpShopIsCool');
define('NO_SHIPPING', '');
define('NO_SHIPTO', '');
define('AFFILIATE_ENABLE', '');
define('PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS', '');
define('PSHOP_IMG_RESIZE_ENABLE', '');
define('PSHOP_IMG_WIDTH', '90');
define('PSHOP_IMG_HEIGHT', '90');
define('PSHOP_COUPONS_ENABLE', '1');
define('PSHOP_PDF_BUTTON_ENABLE', '1');
define('PSHOP_SHOW_PRODUCTS_IN_CATEGORY', '1');
define('PSHOP_SHOW_TOP_PAGENAV', '1');
define('PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS', '1');

/* Shipping Methods Definition */
global $PSHOP_SHIPPING_MODULES;
$PSHOP_SHIPPING_MODULES[0] = "flex";
$PSHOP_SHIPPING_MODULES[1] = "standard_shipping";
?>