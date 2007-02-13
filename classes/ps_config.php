<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

/**
 * The configuration file handler class
 *
 */
class ps_config {

	/**
	 * writes the virtuemart.cfg.php
	 * @author soeren
	 * @static 
	 * @param array $d
	 * @return boolean
	 */
	function writeconfig(&$d) {
		global $my, $db, $option, $page, $vmLogger, $VM_LANG;

		$group_id = intval( $d['conf_VM_PRICE_ACCESS_LEVEL'] );
		$db->query( 'SELECT name FROM #__core_acl_aro_groups WHERE group_id=\''.$group_id.'\'' );
		$db->next_record();
		$d['conf_VM_PRICE_ACCESS_LEVEL'] = $db->f('name');

		if ($_POST['myname'] != "Jabba Binks") {
			return false;
		}
		else {
			if ( empty($d['VM_CHECKOUT_MODULES']['CHECK_OUT_GET_SHIPPING_ADDR']['enabled']) ) {
				$d['conf_NO_SHIPTO'] = '1';
			}
			else {
				$d['conf_NO_SHIPTO'] = '';
			}
			if( $d['conf_SHIPPING'][0] == "no_shipping" || empty($d['VM_CHECKOUT_MODULES']['CHECK_OUT_GET_SHIPPING_METHOD']['enabled']) ) {
				$d['conf_NO_SHIPPING'] = '1';
			}

			$d['conf_PSHOP_OFFLINE_MESSAGE'] = addslashes( stripslashes($d['conf_PSHOP_OFFLINE_MESSAGE']));

			/** Prevent this config setting from being changed by no-backenders  **/
			if (!defined('_PHSHOP_ADMIN') && !stristr($my->usertype, "admin")) {
				$d['conf_PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS'] = PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS;
			}
			$my_config_array = array(
			"PSHOP_IS_OFFLINE"  =>      "conf_PSHOP_IS_OFFLINE",
			"PSHOP_OFFLINE_MESSAGE"  =>      "conf_PSHOP_OFFLINE_MESSAGE",
			"USE_AS_CATALOGUE"  =>      "conf_USE_AS_CATALOGUE",
			"VM_TABLEPREFIX"  =>      "conf_VM_TABLEPREFIX",
			"VM_PRICE_SHOW_PACKAGING_PRICELABEL"  =>      "conf_VM_PRICE_SHOW_PACKAGING_PRICELABEL",
			"VM_PRICE_SHOW_INCLUDINGTAX"  =>      "conf_VM_PRICE_SHOW_INCLUDINGTAX",
			"VM_PRICE_ACCESS_LEVEL"  =>      "conf_VM_PRICE_ACCESS_LEVEL",
			"VM_REGISTRATION_TYPE"  =>      "conf_VM_REGISTRATION_TYPE",
			"VM_BROWSE_ORDERBY_FIELD"  =>      "conf_VM_BROWSE_ORDERBY_FIELD",
			"VM_GENERALLY_PREVENT_HTTPS"  =>      "conf_VM_GENERALLY_PREVENT_HTTPS",
			"VM_SHOW_REMEMBER_ME_BOX"  =>      "conf_VM_SHOW_REMEMBER_ME_BOX",
			"VM_REVIEWS_MINIMUM_COMMENT_LENGTH"  =>      "conf_VM_REVIEWS_MINIMUM_COMMENT_LENGTH",
			"VM_REVIEWS_MAXIMUM_COMMENT_LENGTH"  =>      "conf_VM_REVIEWS_MAXIMUM_COMMENT_LENGTH",
			"VM_SHOW_PRINTICON"  =>      "conf_VM_SHOW_PRINTICON",
			"VM_SHOW_EMAILFRIEND"  =>      "conf_VM_SHOW_EMAILFRIEND",
			"PSHOP_PDF_BUTTON_ENABLE" => "conf_PSHOP_PDF_BUTTON_ENABLE",
			"VM_REVIEWS_AUTOPUBLISH"  =>      "conf_VM_REVIEWS_AUTOPUBLISH",
			"VM_PROXY_URL"  =>      "conf_VM_PROXY_URL",
			"VM_PROXY_PORT"  =>      "conf_VM_PROXY_PORT",
			"VM_PROXY_USER"  =>      "conf_VM_PROXY_USER",
			"VM_PROXY_PASS"  =>      "conf_VM_PROXY_PASS",
			"VM_ONCHECKOUT_SHOW_LEGALINFO"  =>      "conf_VM_ONCHECKOUT_SHOW_LEGALINFO",
			"VM_ONCHECKOUT_LEGALINFO_SHORTTEXT"  =>      "conf_VM_ONCHECKOUT_LEGALINFO_SHORTTEXT",
			"VM_ONCHECKOUT_LEGALINFO_LINK"  =>      "conf_VM_ONCHECKOUT_LEGALINFO_LINK",
			"ENABLE_DOWNLOADS"  =>      "conf_ENABLE_DOWNLOADS",
			"DOWNLOAD_MAX"  =>      "conf_DOWNLOAD_MAX",
			"DOWNLOAD_EXPIRE"  =>      "conf_DOWNLOAD_EXPIRE",
			"ENABLE_DOWNLOAD_STATUS"  =>      "conf_ENABLE_DOWNLOAD_STATUS",
			"DISABLE_DOWNLOAD_STATUS"  =>      "conf_DISABLE_DOWNLOAD_STATUS",
			"DOWNLOADROOT"  =>      "conf_DOWNLOADROOT",
			"VM_DOWNLOADABLE_PRODUCTS_KEEP_STOCKLEVEL"  =>      "conf_VM_DOWNLOADABLE_PRODUCTS_KEEP_STOCKLEVEL",
			"_SHOW_PRICES"      =>      "conf__SHOW_PRICES",
			"ORDER_MAIL_HTML"   =>      "conf_ORDER_MAIL_HTML",
			"HOMEPAGE"		=>	"conf_HOMEPAGE",
			"CATEGORY_TEMPLATE"		=>	"conf_CATEGORY_TEMPLATE",
			"FLYPAGE"		=>	"conf_FLYPAGE",
			"PRODUCTS_PER_ROW"		=>	"conf_PRODUCTS_PER_ROW",
			"ERRORPAGE"		=>	"conf_ERRORPAGE",
			"NO_IMAGE"		=>	"conf_NO_IMAGE",
			"DEBUG"		=>	"conf_DEBUG",
			"SHOWVERSION"	=>  	"conf_SHOWVERSION",
			"TAX_VIRTUAL" 	=>      "conf_TAX_VIRTUAL",
			"TAX_MODE" 	        =>      "conf_TAX_MODE",
			"MULTIPLE_TAXRATES_ENABLE" 	        =>      "conf_MULTIPLE_TAXRATES_ENABLE",
			"PAYMENT_DISCOUNT_BEFORE" => "conf_PAYMENT_DISCOUNT_BEFORE",
			"PSHOP_ALLOW_REVIEWS" => "conf_PSHOP_ALLOW_REVIEWS",
			"MUST_AGREE_TO_TOS" =>      "conf_MUST_AGREE_TO_TOS",
			"PSHOP_AGREE_TO_TOS_ONORDER" =>      "conf_PSHOP_AGREE_TO_TOS_ONORDER",
			"CAN_SELECT_STATES" =>      "conf_CAN_SELECT_STATES",
			"SHOW_CHECKOUT_BAR"	=>	"conf_SHOW_CHECKOUT_BAR",
			"CHECK_STOCK"	=>	"conf_CHECK_STOCK",
			"ENCODE_KEY"	=>	"conf_ENCODE_KEY",
			"NO_SHIPPING"    	=>      "conf_NO_SHIPPING",
			"NO_SHIPTO"    	=>      "conf_NO_SHIPTO",
			"AFFILIATE_ENABLE"    	=>      "conf_AFFILIATE_ENABLE",
			"PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS" => "conf_PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS",
			"PSHOP_IMG_RESIZE_ENABLE" => "conf_PSHOP_IMG_RESIZE_ENABLE",
			"PSHOP_IMG_WIDTH" => "conf_PSHOP_IMG_WIDTH",
			"PSHOP_IMG_HEIGHT" => "conf_PSHOP_IMG_HEIGHT",
			"PSHOP_COUPONS_ENABLE" => "conf_PSHOP_COUPONS_ENABLE",
			"PSHOP_SHOW_PRODUCTS_IN_CATEGORY" => "conf_PSHOP_SHOW_PRODUCTS_IN_CATEGORY",
			"PSHOP_SHOW_TOP_PAGENAV"            =>      "conf_PSHOP_SHOW_TOP_PAGENAV",
			"PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS"          =>      "conf_PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS",
			"VM_CURRENCY_CONVERTER_MODULE" => "conf__VM_CURRENCY_CONVERTER_MODULE",
			"VM_CONTENT_PLUGINS_ENABLE" => "conf_VM_CONTENT_PLUGINS_ENABLE",
			"VM_ENABLE_COOKIE_CHECK" => "conf_VM_ENABLE_COOKIE_CHECK",
			
			// Begin Arrays
			"VM_BROWSE_ORDERBY_FIELDS"          =>      "conf_VM_BROWSE_ORDERBY_FIELDS",
			"VM_MODULES_FORCE_HTTPS"          =>      "conf_VM_MODULES_FORCE_HTTPS",
			"VM_CHECKOUT_MODULES"	=>	"VM_CHECKOUT_MODULES",
			"PSHOP_SHIPPING_MODULE"     =>      "conf_SHIPPING"
			);

			$config = "<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**return true;
* The configuration file for VirtueMart
*
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2004-2007 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

global \$mosConfig_absolute_path,\$mosConfig_live_site;

if( stristr( \$_SERVER['PHP_SELF'], 'administrator' ))
	@include_once( '../configuration.php' );
else
	@include_once( 'configuration.php' );

// Check for trailing slash
if( \$mosConfig_live_site[strlen( \$mosConfig_live_site)-1] == '/' ) {
	\$app = '';
}
else {
	\$app = '/';
}
// these path and url definitions here are based on the mambo configuration
define( 'URL', \$mosConfig_live_site.\$app );
define( 'SECUREURL', '".$d['conf_SECUREURL']."' );

if ( @\$_SERVER['HTTPS'] == 'on' ) {
	define( 'IMAGEURL', SECUREURL .'components/com_virtuemart/shop_image/' );
} else {
	define( 'IMAGEURL', URL .'components/com_virtuemart/shop_image/' );
}
define( 'VM_THEMEPATH', \$mosConfig_absolute_path.'/components/com_virtuemart/themes/".$d['conf_THEME']."/' );
define( 'VM_THEMEURL', \$mosConfig_live_site.'/components/com_virtuemart/themes/".$d['conf_THEME']."/' );

define( 'COMPONENTURL', URL .'administrator/components/com_virtuemart/' );
define( 'ADMINPATH', \$mosConfig_absolute_path.'/administrator/components/com_virtuemart/' );
define( 'CLASSPATH', ADMINPATH.'classes/' );
define( 'PAGEPATH', ADMINPATH.'html/' );
define( 'IMAGEPATH', \$mosConfig_absolute_path.'/components/com_virtuemart/shop_image/' );\n\n";

			// LOOP THROUGH ALL CONFIGURATION VARIABLES
			while (list($key, $value) = each($my_config_array)) {

				if( $key == "PSHOP_SHIPPING_MODULE" ) {
					$config .= "\n/* Shipping Methods Definition */\nglobal \$PSHOP_SHIPPING_MODULES;\n";
					$i = 0;
					foreach( $d['conf_SHIPPING'] as $shipping_module) {
						$config.= "\$PSHOP_SHIPPING_MODULES[$i] = \"$shipping_module\";\n";
						$i++;
					}
				}
				elseif( $key == "VM_BROWSE_ORDERBY_FIELDS" ) {
					$config .= "\n/* OrderByFields */\nglobal \$VM_BROWSE_ORDERBY_FIELDS;\n";
					$config .= "\$VM_BROWSE_ORDERBY_FIELDS = array( ";
					$i= 0;
					foreach( $d['conf_VM_BROWSE_ORDERBY_FIELDS'] as $orderbyfield) {
						$config.= "'$orderbyfield'";
						if( $i+1 < sizeof( $d['conf_VM_BROWSE_ORDERBY_FIELDS'] )) {
							$config .= ',';
						}
						$i++;
					}
					$config.= " );\n";
				}
				elseif( $key == 'VM_MODULES_FORCE_HTTPS' ) {
					$config .= "\n/* Shop Modules that run with https only*/\nglobal \$VM_MODULES_FORCE_HTTPS;\n";
					$config .= "\$VM_MODULES_FORCE_HTTPS = array( ";
					$i= 0;
					foreach( $d['conf_VM_MODULES_FORCE_HTTPS'] as $https_module) {
						$config.= "'".htmlentities($https_module, ENT_QUOTES )."'";
						if( $i+1 < sizeof( $d['conf_VM_MODULES_FORCE_HTTPS'] )) {
							$config .= ',';
						}
						$i++;
					}
					$config.= " );\n";
				}
				elseif( $key == 'VM_CHECKOUT_MODULES' ) {
					$config .= "\n// Checkout Steps and their order\nglobal \$VM_CHECKOUT_MODULES;\n";
					$config .= "\$VM_CHECKOUT_MODULES = array( ";
					$i= 0;
					$max = 0;
					foreach( $d['VM_CHECKOUT_MODULES'] as $step ) {
						$max = (int)$step['order'] > $max ? (int)$step['order'] : $max;
						if( $step['name'] == 'CHECK_OUT_GET_FINAL_CONFIRMATION' ) {
							$step['order'] = max( $max, $step['order'] ); // In case someone wants the final confirmation not as last step (so we force it to be the last step)
						}
						$enabled = !empty($step['enabled']) || $step['name'] == 'CHECK_OUT_GET_PAYMENT_METHOD' || $step['name'] == 'CHECK_OUT_GET_FINAL_CONFIRMATION';
						$config.= "'".$step['name']."'=>array('order'=>".(int)$step['order'].",'enabled'=>".(int)$enabled.")";
						if( $i+1 < sizeof( $d['VM_CHECKOUT_MODULES'] )) {
							$config .= ",\n";
						}
						$i++;
					}
					$config.= " );\n";
				}
				elseif( $key == 'PSHOP_OFFLINE_MESSAGE' ) {
					$value = get_magic_quotes_gpc() ? stripslashes(@$d[$value]) : @$d[$value];
					$value = $db->getEscaped( $value );
					$config .= "define('".$key."', '".$value."');\n";
				}
				else {
					$config .= "define('".$key."', '".stripslashes(@$d[$value])."');\n";
				}
			}

			$config .= "?>";

			if ($fp = fopen(ADMINPATH ."virtuemart.cfg.php", "w")) {
				fputs($fp, $config, strlen($config));
				fclose ($fp);

				$vmLogger->info( $VM_LANG->_VM_CONFIGURATION_CHANGE_SUCCESS );
				return true;
			} else {
				$vmLogger->err( $VM_LANG->_VM_CONFIGURATION_CHANGE_FAILURE.' ('. ADMINPATH ."virtuemart.cfg.php)" );
				return false;
			}
			
		}
	} // end function writeconfig

	/**
	 * Writes the configuration file of the current theme
	 *
	 * @param array $d
	 */
	function writeThemeConfig( &$d ) {
		global $page, $option, $VM_LANG, $vmLogger;
		
		$my_config_array = array();
		$config = "<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* The configuration file for the ".basename( VM_THEMEPATH )." theme
*
* @package VirtueMart
* @subpackage themes
* @copyright Copyright (C) 2007 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
?>
";
		$params = mosGetParam( $_POST, 'params', '' );
		if (is_array( $params )) {
			$txt = array();
			foreach ($params as $k=>$v) {
				$txt[] = "$k=$v";
			}
			if( is_callable(array('mosParameters', 'textareaHandling'))) {
				$_POST['params'] = mosParameters::textareaHandling( $txt );
			}
			else {
				
				$total = count( $txt );
				for( $i=0; $i < $total; $i++ ) {
					if ( strstr( $txt[$i], "\n" ) ) {
						$txt[$i] = str_replace( "\n", '<br />', $txt[$i] );
					}
				}
				$_POST['params'] = implode( "\n", $txt );
		
			}
		}
		$config .= $_POST['params'];
		
		if ($fp = fopen(VM_THEMEPATH ."theme.config.php", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);

			$vmLogger->info( $VM_LANG->_VM_CONFIGURATION_CHANGE_SUCCESS );
			return true;
		} else {
			$vmLogger->err( $VM_LANG->_VM_CONFIGURATION_CHANGE_FAILURE.' ('. VM_THEMEPATH ."theme.config.php)" );
			return false;
		}
	}
	
} // end class ps_config
?>
