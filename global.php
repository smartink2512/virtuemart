<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) {
	die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
}
/**
* @version $Id$
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2004-2007 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
* http://virtuemart.net
*/

global $vendor_image,$vendor_country_2_code ,$vendor_country_3_code, $vendor_image_url, $vendor_name, 
		$vendor_address, $vendor_city,$vendor_country,$vendor_mail,$vendor_store_name, $vm_mainframe,
        $vendor_state, $vendor_zip, $vendor_phone, $vendor_currency, $vendor_store_desc, $vendor_freeshipping,
        $module_description, $VM_LANG, $vendor_currency_display_style, $vendor_full_image, $vendor_accepted_currencies;

define( 'VM_COMPONENT_NAME', 'com_virtuemart' );

// The abstract language class
require_once( CLASSPATH."language.class.php" );

// load the Language File
if (file_exists( ADMINPATH. 'languages/'.$mosConfig_lang.'.php' )) {
	require_once( ADMINPATH. 'languages/'.$mosConfig_lang.'.php' );
}
else {
	require_once( ADMINPATH. 'languages/english.php' );
}
// Instantiate the MainFrame class for VirtueMart
require_once( CLASSPATH."mainframe.class.php" );
$vm_mainframe = new vmMainFrame();

if (file_exists( CLASSPATH.'currency/'.VM_CURRENCY_CONVERTER_MODULE.'.php' )) {
	$module_filename = VM_CURRENCY_CONVERTER_MODULE;
	require_once(CLASSPATH.'currency/'.VM_CURRENCY_CONVERTER_MODULE.'.php');
	if( class_exists( $module_filename )) {
		$GLOBALS['CURRENCY'] = $CURRENCY = new $module_filename();
	}
}
else {
	require_once(CLASSPATH.'currency/convertECB.php');
	/**
	 * @global convertECB $GLOBALS['CURRENCY']
	 */
	$GLOBALS['CURRENCY'] = $CURRENCY = new convertECB();
}

// stores the exchange rate array
$GLOBALS['converter_array'] = '';

/** @global vmLanguage $GLOBALS['VM_LANG'] */
$GLOBALS['VM_LANG'] = $GLOBALS['PHPSHOP_LANG'] =& new vmLanguage();

/** @global Array $product_info: Stores Product Information for re-use */
$GLOBALS['product_info'] = Array();

/** @global Array $category_info: Stores Category Information for re-use */
$GLOBALS['category_info'] = Array();

/** @global Array $category_info: Stores Vendor Information for re-use */
$GLOBALS['vendor_info'] = Array();

// load the MAIN CLASSES
// CLASSPATH is defined in the config file
require_once(CLASSPATH."ps_database.php");
require_once(CLASSPATH."ps_main.php");
require_once(CLASSPATH."vmAbstractObject.class.php");
require_once(CLASSPATH."ps_cart.php");
require_once(CLASSPATH."ps_html.php");
require_once(CLASSPATH."ps_session.php");
require_once(CLASSPATH."ps_function.php");
require_once(CLASSPATH."ps_module.php");
require_once(CLASSPATH."ps_perm.php");
require_once(CLASSPATH."ps_shopper_group.php");
require_once(CLASSPATH.'template.class.php' );
require_once(CLASSPATH."htmlTools.class.php");
require_once(CLASSPATH."phpInputFilter/class.inputfilter.php");
require_once(CLASSPATH."Log/Log.php");
$vmLoggerConf = array(
	'buffering' => true
	);
/**
 * This Log Object will help us log messages and errors
 * See http://pear.php.net/package/Log
 * @global vmLog $GLOBALS['vmLogger']
 */
$vmLogger = &vmLog::singleton('display', '', '', $vmLoggerConf, PEAR_LOG_TIP);
$GLOBALS['vmLogger'] =& $vmLogger;

// Instantiate the DB class
$db = new ps_DB();

// Instantiate the permission class
$perm = new ps_perm();
// Instantiate the HTML helper class
$ps_html = new ps_html();

// Constructor initializes the session!
$sess = new ps_session();

// Initialize the cart
$cart = ps_cart::initCart();
// Initialise Recent Products
$recentproducts = ps_session::initRecentProducts();
// Instantiate the module class
$ps_module = new ps_module();
// Instantiate the function class
$ps_function = new ps_function();
// Instantiate the ps_shopper_group class
$ps_shopper_group = new ps_shopper_group();

// Set the mosConfig_live_site to its' SSL equivalent
if( $_SERVER['SERVER_PORT'] == 443 || @$_SERVER['HTTPS'] == 'on' || @strstr( $page, "checkout." )) {
	// temporary solution until we have
	// $mosConfig_secure_site
	$GLOBALS['real_mosConfig_live_site'] = $GLOBALS['mosConfig_live_site'];
	$GLOBALS['mosConfig_live_site'] = ereg_replace('/$','',SECUREURL);
	$mm_action_url = SECUREURL;
}
else {
	$mm_action_url = URL;
}

// Enable Mambo Debug Mode when Shop Debug is on
if( DEBUG == "1" ) {
	$GLOBALS['mosConfig_debug'] = 1;
	$database->_debug = 1;
}

	
# Some database values we will need throughout
# Get Vendor Information
// Benjamin: change this using a dynamic global variable...
$default_vendor = 1;

if( $my->id ) {
	$db->query( 'SELECT `vendor_id` FROM `#__{vm}_auth_user_vendor` WHERE `user_id` ='.$my->id );
	$db->next_record();
	if( $db->f( 'vendor_id' ) ) {
		$default_vendor = $db->f( 'vendor_id' );
	}
}
	
$_SESSION["ps_vendor_id"] = $ps_vendor_id = $default_vendor;

$q = "SELECT vendor_id, vendor_min_pov,vendor_name,vendor_store_name,contact_email,vendor_full_image, vendor_freeshipping,
			vendor_address_1, vendor_city, vendor_state, vendor_country, country_2_code, country_3_code,
			vendor_zip, vendor_phone, vendor_store_desc, vendor_currency, vendor_currency_display_style,
			vendor_accepted_currencies
		FROM (`#__{vm}_vendor`, `#__{vm}_country`)
		WHERE `vendor_id`=$default_vendor
		AND (vendor_country=country_2_code OR vendor_country=country_3_code);";

$db->query($q);
$db->next_record();

$_SESSION['minimum_pov'] = $db->f("vendor_min_pov"); 
$vendor_name = $db->f("vendor_name");
$vendor_store_name = $db->f("vendor_store_name");
$vendor_mail = $db->f("contact_email");
$vendor_freeshipping = $db->f("vendor_freeshipping");
$vendor_image = "<img border=\"0\" src=\"" .IMAGEURL ."vendor/" . $db->f("vendor_full_image") . "\" />";
$vendor_full_image = $db->f("vendor_full_image");
$vendor_image_url = IMAGEURL."vendor/".$db->f("vendor_full_image");
$vendor_address = $db->f("vendor_address_1");
$vendor_city = $db->f("vendor_city");
$vendor_state = $db->f("vendor_state");
$vendor_state = empty($vendor_state) ? "" : $db->f("vendor_state");
$vendor_country = $db->f("vendor_country");
$vendor_country_2_code = $db->f("country_2_code");
$vendor_country_3_code = $db->f("country_3_code");
$vendor_zip = $db->f("vendor_zip");
$vendor_phone = $db->f("vendor_phone");
$vendor_store_desc = $db->f("vendor_store_desc");
$vendor_currency = $db->f("vendor_currency");
$vendor_currency_display_style = $db->f("vendor_currency_display_style");
$vendor_accepted_currencies = $db->f("vendor_accepted_currencies");
$_SESSION["vendor_currency"] = $vendor_currency;


// see /classes/currency_convert.php
vmSetGlobalCurrency();

$currency_display = vendor_currency_display_style( $vendor_currency_display_style );
if( $GLOBALS['product_currency'] != $vendor_currency ) {
	$currency_display["symbol"] = $GLOBALS['product_currency'];
}
/** load Currency Display Class **/
require_once( CLASSPATH.'currency/class_currency_display.php' );
/**
 *  @global CurrencyDisplay $GLOBALS['CURRENCY_DISPLAY']
 *  @global CurrencyDisplay $CURRENCY_DISPLAY
 */
$GLOBALS['CURRENCY_DISPLAY'] =& new CurrencyDisplay($currency_display["id"], $currency_display["symbol"], $currency_display["nbdecimal"], $currency_display["sdecimal"], $currency_display["thousands"], $currency_display["positive"], $currency_display["negative"]);
	
// Include the theme
if( file_exists( VM_THEMEPATH.'theme.php' )) {
	include( VM_THEMEPATH.'theme.php' );
}
elseif( file_exists( $mosConfig_absolute_path.'/components/'.$option.'/themes/default/theme.php' )) {
	include( $mosConfig_absolute_path.'/components/'.$option.'/themes/default/theme.php' );
}
else {
	$vmLogger->crit( 'Theme file not found.' );
	return;
}
$GLOBALS['VM_THEMECLASS'] = 'vmTemplate_'.basename(VM_THEMEPATH);

/**
 * Returns the variable names of all global variables in VM
 *
 * @return array
 */
function vmGetGlobalsArray() {
	return array(  'perm', 'page', 'sess', 'func', 'cart', 'VM_LANG', 'PSHOP_SHIPPING_MODULES', 'VM_BROWSE_ORDERBY_FIELDS', 'VM_MODULES_FORCE_HTTPS',
					'vmLogger', 'CURRENCY_DISPLAY', 'CURRENCY', 'ps_html', 'ps_vendor_id', 'keyword', 'Itemid',
					'ps_payment_method', 'pagename', 'modulename', 'vars', 'mosConfig_lang',
					'auth', 'ps_checkout', 'vendor_image','vendor_country_2_code','vendor_country_3_code', 'vendor_image_url', 'vendor_name', 
					'vendor_address', 'vendor_city','vendor_country','vendor_mail','vendor_store_name', 'vendor_state', 'vendor_zip', 'vendor_phone', 'vendor_currency', 'vendor_store_desc', 'vendor_freeshipping', 'vendor_currency_display_style', 'vendor_freeshipping', 
					'mm_action_url', 'limit', 'limitstart', 'mainframe', 'vmInputFilter',
					'option', 'my', 'mosConfig_live_site', 'mosConfig_absolute_path' );
}
?>