<?php
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
* @version $Id: global.php 1768 2009-05-11 22:24:39Z macallf $
* @package JMart
* @subpackage core
* @copyright Copyright (C) 2004-2008 soeren - 2009 Jmart Team All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* JMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
* http://joomlacode.org/gf/project/jmart/
*/

global  $vm_mainframe, $module_description;

//should be removed later
global $vendor_currency_display_style;
/*
 * 
 Removed global variables
$vendor_image,$vendor_country_2_code, ,$vendor_country_3_code, $vendor_image_url, $vendor_name, $vendor_state_name,
		$vendor_address,$vendor_address_2, $vendor_url, $vendor_city,$vendor_country,$vendor_mail,$vendor_store_name,
		$vendor_state, $vendor_zip, $vendor_phone, $vendor_currency, $vendor_store_desc, $vendor_freeshipping,
		 $vendor_currency_display_style, $vendor_full_image, $vendor_accepted_currencies,
        $vendor_address_format, $vendor_date_format
*/

if( @JM_ENCRYPT_FUNCTION == 'AES_ENCRYPT') {
	define('JM_DECRYPT_FUNCTION', 'AES_DECRYPT');
} else {
	define('JM_DECRYPT_FUNCTION', 'DECODE');
}
if( !defined('JM_COMPONENT_NAME')) {
	echo '<div class="shop_warning">You seem to have upgraded to a new JMart Version recently.<br />
			Your Configuration File must be updated. so please proceed to the <a href="'.$_SERVER['PHP_SELF'].'?page=admin.show_cfg&amp;option=com_jmart">Configuration Form</a> and save the Configuration once you are done with the settings.</div>';
	define('JM_COMPONENT_NAME', 'com_jmart');
	define('JM_CURRENCY_CONVERTER_MODULE', 'convertECB');
	defined('JM_THEMEPATH ') or define('JM_THEMEPATH', $mosConfig_absolute_path. '/components/com_jmart/themes/default/');
	defined('JM_THEMEURL') or define('JM_THEMEURL', $mosConfig_live_site. '/components/com_jmart/themes/default/');
}

// bass28 8/24/09 - Hack to keep this code working without jmart.cfg
$adminPath = JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_jmart'.DS;
$classPath = JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_jmart'.DS.'classes'.DS;

// Instantiate the MainFrame class for JMart
require_once( $classPath."ps_database.php");
require_once( $classPath."mainframe.class.php" );
require_once( $classPath."plugin.class.php" );
require_once( $classPath."dispatcher.class.php" );

/* @MWM1: Load debug utility functions (currently just vmShouldDebug())
   Replaces test (DEBUG == '1') and also checks if DEBUG_IP_ADDRESS is
   enabled. */
require_once($classPath."DebugUtil.php");

/* @MWM1: Initialize Logging */
$vmLogIdentifier = 'JMart';
require_once($classPath."Log/LogInit.php");
$vm_mainframe = new vmMainFrame();

vmPluginHelper::importPlugin('system');

if (file_exists( $adminPath.'plugins/currency_converter/'.@JM_CURRENCY_CONVERTER_MODULE.'.php' )) {
	$module_filename = JM_CURRENCY_CONVERTER_MODULE;
	require_once($adminPath.'plugins/currency_converter/'.JM_CURRENCY_CONVERTER_MODULE.'.php');
	if( class_exists( $module_filename )) {
		$GLOBALS['CURRENCY'] = $CURRENCY = new $module_filename();
	}
}
else {
	require_once($adminPath.'plugins/currency_converter/convertECB.php');
	/**
	 * @global convertECB $GLOBALS['CURRENCY']
	 */
	$GLOBALS['CURRENCY'] = $CURRENCY = new convertECB();
}

// stores the exchange rate array
$GLOBALS['converter_array'] = '';

/** @global Array $product_info: Stores Product Information for re-use */
$GLOBALS['product_info'] = Array();

/** @global Array $category_info: Stores Category Information for re-use */
$GLOBALS['category_info'] = Array();

/** @global Array $category_info: Stores Vendor Information for re-use */
$GLOBALS['vendor_info'] = Array();

// load the MAIN CLASSES
// $classPath is defined in the config file
require_once($classPath."ps_main.php");
require_once($classPath."request.class.php");
require_once($classPath."vmAbstractObject.class.php");
require_once($classPath."ps_cart.php");
require_once($classPath."ps_html.php");
require_once($classPath."ps_session.php");
require_once($classPath."ps_function.php");
require_once($classPath."ps_module.php");
require_once($classPath."ps_perm.php");
require_once($classPath."ps_shopper_group.php");
require_once($classPath."ps_vendor.php");
require_once($classPath.'template.class.php' );
require_once($classPath."htmlTools.class.php");
require_once($classPath."phpInputFilter/class.inputfilter.php");

$vm_mainframe->triggerEvent('onAfterInitialise');

// Instantiate the DB class
$db = new ps_DB();

// Instantiate the permission class
$perm = new ps_perm();

// Instantiate the HTML helper class
$ps_html = new ps_html();

// Constructor initializes the session!
$sess = new ps_session();

// Instantiate the ps_shopper_group class
$ps_shopper_group = new ps_shopper_group();
// Get default and this users's Shopper Group
$shopper_group = $ps_shopper_group->get_shoppergroup_by_id( $my->id );

// User authentication
$auth = $perm->doAuthentication( $shopper_group );
// Initialize the cart
$cart = ps_cart::initCart();
// Initialise Recent Products
$recentproducts = ps_session::initRecentProducts();
// Instantiate the module class
$ps_module = new ps_module();
// Instantiate the function class
$ps_function = new ps_function();

// Set the mosConfig_live_site to its' SSL equivalent
$GLOBALS['real_mosConfig_live_site'] = $GLOBALS['mosConfig_live_site'];
if( $_SERVER['SERVER_PORT'] == 443 || @$_SERVER['HTTPS'] == 'on' || @strstr( $page, "checkout." )) {
	// Change the global Live Site Value to HTTPS
	$GLOBALS['mosConfig_live_site'] = ereg_replace('/$','',SECUREURL);
	$mm_action_url = SECUREURL;
}
else {
	$mm_action_url = URL;
}

// Enable Mambo Debug Mode when Shop Debug is on
if( vmShouldDebug() ) {   /*@MWM1: Log/Debug enhancements */
	$GLOBALS['mosConfig_debug'] = 1;
	$database->_debug = 1;
}

//require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'vendor_helper.php');
//We cant use JPATH_COMPONENT_ADMINISTRATOR here, because this file is used during the installationscript
require_once(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_jmart'.DS.'helpers'.DS.'vendor_helper.php');

global $hVendor;
$hVendor = new vendor_helper;
 	
//Lets life make easy, To be exact this value shouldnt be global but we leave it for now as a quckfix
//In the most cases a shop with vendors will use a standard currency anyway.
//This call here is very strange, because we dont need it in the backend ! TODO move it to the right place only for frontend
$mainvendor = 1;
$db = ps_vendor::get_vendor_fields($mainvendor,array('vendor_currency', 'vendor_currency_display_style','vendor_accepted_currencies','vendor_store_desc'));
if(!empty($db)){
	$vendor_currency = $db->f("vendor_currency");
	$_SESSION["vendor_currency"] = $vendor_currency;

	$vendor_currency_display_style = $db->f("vendor_currency_display_style");
	$vendor_accepted_currencies = $db->f("vendor_accepted_currencies");
	$vendor_store_desc = $db->f("vendor_store_desc");
}


// see /classes/currency_convert.php
vmSetGlobalCurrency();

$currency_display = $hVendor -> get_currency_display_style( $vendor_currency_display_style );
//if( $GLOBALS['product_currency'] != $vendor_currency ) {
//	$currency_display["symbol"] = $GLOBALS['product_currency'];
//}
/** load Currency Display Class **/
// require_once( $classPath.'class_currency_display.php' );
require_once(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_jmart'.DS.'helpers'.DS.'currencydisplay.php');
/**
 *  @global CurrencyDisplay $GLOBALS['CURRENCY_DISPLAY']
 *  @global CurrencyDisplay $CURRENCY_DISPLAY
 */
$CURRENCY_DISPLAY = $GLOBALS['CURRENCY_DISPLAY'] =& new CurrencyDisplay($currency_display["id"], $currency_display["symbol"], $currency_display["nbdecimal"], $currency_display["sdecimal"], $currency_display["thousands"], $currency_display["positive"], $currency_display["negative"]);
	
// Include the theme
if( file_exists( JM_THEMEPATH.'theme.php' )) {
	include( JM_THEMEPATH.'theme.php' );
}
elseif( file_exists( $mosConfig_absolute_path.'/components/'.$option.'/themes/default/theme.php' )) {
	include( $mosConfig_absolute_path.'/components/'.$option.'/themes/default/theme.php' );
}
else {
	$vmLogger->crit( 'Theme file not found.' );
	return;
}
$GLOBALS['JM_THEMECLASS'] = 'vmTheme';

/**
 * Returns the variable names of all global variables in VM
 *
 * @return array
 */
function vmGetGlobalsArray() {
	static $vm_globals = array(  'perm', 'page', 'sess', 'func', 'cart', 'JM_LANG', 'PSHOP_SHIPPING_MODULES', 'JM_BROWSE_ORDERBY_FIELDS', 
					'JM_MODULES_FORCE_HTTPS', 'vmLogger', 'CURRENCY_DISPLAY', 'CURRENCY', 'ps_html', 
					'ps_vendor_id', 'keyword', 'vmPaymentMethod', 'pagename', 'modulename', 
					'vars', 'auth', 'ps_checkout', 'vendor_image','vendor_country_2_code','vendor_country_3_code', 'vendor_state_name',
					'vendor_image_url', 'vendor_name', 'vendor_address', 'vendor_address_2', 'vendor_city','vendor_country','vendor_mail',
					'vendor_store_name', 'vendor_state', 'vendor_zip', 'vendor_phone', 'vendor_currency', 'vendor_store_desc', 
					'vendor_freeshipping', 'vendor_currency_display_style', 'vendor_freeshipping', 'vendor_date_format', 'vendor_address_format',
					'mm_action_url', 'limit', 'limitstart', 'vmInputFilter', 'vm_mainframe', 'mainframe', 'mosConfig_lang',
					'option', 'my', 'Itemid', 'mosConfig_live_site', 'mosConfig_absolute_path' );
	return $vm_globals;
}
?>
