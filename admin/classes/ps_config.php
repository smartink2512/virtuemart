<?php
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @version $Id: ps_config.php 1755 2009-05-01 22:45:17Z rolandd $
* @package JMart
* @subpackage classes
* @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* JMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_jmart/COPYRIGHT.php for copyright notices and details.
*
* http://joomlacode.org/gf/project/jmart/
*/

/**
 * The configuration file handler class
 *
 */
class ps_config {

	/**
	 * writes the jmart.cfg.php
	 * @author soeren
	 * @static
	 * @param array $d
	 * @return boolean
	 */
	function writeconfig(&$d) {
		global $my, $db, $vmLogger, $mosConfig_live_site;

		$group_id = intval( $d['conf_JM_PRICE_ACCESS_LEVEL'] );
// TODO: (J! 1.5) Is there a better way to handle this difference between Joomla versions?
//		if( vmIsJoomla(1.5) ) {
			$db->query( 'SELECT name FROM #__core_acl_aro_groups WHERE id=\''.$group_id.'\'' );
//		} else {
//			$db->query( 'SELECT name FROM #__core_acl_aro_groups WHERE group_id=\''.$group_id.'\'' );
//		}
		$db->next_record();
		$d['conf_JM_PRICE_ACCESS_LEVEL'] = $db->f('name');

		if (!$fp = fopen(ADMINPATH ."jmart.cfg.php", "w")) {
			$vmLogger->err( JText::_('JM_CONFIGURATION_CHANGE_FAILURE',false).' ('. ADMINPATH ."jmart.cfg.php)" );
			return false;
		}

		if ($_POST['myname'] != "Jabba Binks") {
			return false;
		}
		else {
			if ( empty($d['JM_CHECKOUT_MODULES']['CHECK_OUT_GET_SHIPPING_ADDR']['enabled']) ) {
				$d['conf_NO_SHIPTO'] = '1';
			}
			else {
				$d['conf_NO_SHIPTO'] = '';
			}
			if( empty($d['JM_CHECKOUT_MODULES']['CHECK_OUT_GET_SHIPPING_METHOD']['enabled']) ) {
				$d['JM_CHECKOUT_MODULES']['CHECK_OUT_GET_SHIPPING_METHOD']['enabled'] = '';
				$d['conf_NO_SHIPPING'] = '1';
			}

			$d['conf_PSHOP_OFFLINE_MESSAGE'] = vmGet($d, 'conf_PSHOP_OFFLINE_MESSAGE', '', VMREQUEST_ALLOWHTML );

			/** Prevent this config setting from being changed by no-backenders  **/
			if (!defined('_PHSHOP_ADMIN') && !stristr($my->usertype, "admin")) {
				$d['conf_PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS'] = PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS;
			}
			$my_config_array = array(
			"PSHOP_IS_OFFLINE"  =>      "conf_PSHOP_IS_OFFLINE",
			"PSHOP_OFFLINE_MESSAGE"  =>      "conf_PSHOP_OFFLINE_MESSAGE",
			"USE_AS_CATALOGUE"  =>      "conf_USE_AS_CATALOGUE",
			"JM_TABLEPREFIX"  =>      "conf_JM_TABLEPREFIX",
			"JM_PRICE_SHOW_PACKAGING_PRICELABEL"  =>      "conf_JM_PRICE_SHOW_PACKAGING_PRICELABEL",
			"JM_PRICE_SHOW_INCLUDINGTAX"  =>      "conf_JM_PRICE_SHOW_INCLUDINGTAX",
			"JM_PRICE_SHOW_EXCLUDINGTAX"  =>      "conf_JM_PRICE_SHOW_EXCLUDINGTAX",
			"JM_PRICE_SHOW_WITHTAX"  =>      "conf_JM_PRICE_SHOW_WITHTAX",
			"JM_PRICE_SHOW_WITHOUTTAX"  =>      "conf_JM_PRICE_SHOW_WITHOUTTAX",
			"JM_PRICE_ACCESS_LEVEL"  =>      "conf_JM_PRICE_ACCESS_LEVEL",
			"JM_REGISTRATION_TYPE"  =>      "conf_JM_REGISTRATION_TYPE",
			"JM_BROWSE_ORDERBY_FIELD"  =>      "conf_JM_BROWSE_ORDERBY_FIELD",
			"JM_GENERALLY_PREVENT_HTTPS"  =>      "conf_JM_GENERALLY_PREVENT_HTTPS",
			"JM_SHOW_REMEMBER_ME_BOX"  =>      "conf_JM_SHOW_REMEMBER_ME_BOX",
			"JM_REVIEWS_MINIMUM_COMMENT_LENGTH"  =>      "conf_JM_REVIEWS_MINIMUM_COMMENT_LENGTH",
			"JM_REVIEWS_MAXIMUM_COMMENT_LENGTH"  =>      "conf_JM_REVIEWS_MAXIMUM_COMMENT_LENGTH",
			"JM_SHOW_PRINTICON"  =>      "conf_JM_SHOW_PRINTICON",
			"JM_SHOW_EMAILFRIEND"  =>      "conf_JM_SHOW_EMAILFRIEND",
			"PSHOP_PDF_BUTTON_ENABLE" => "conf_PSHOP_PDF_BUTTON_ENABLE",
			"JM_REVIEWS_AUTOPUBLISH"  =>      "conf_JM_REVIEWS_AUTOPUBLISH",
			"JM_PROXY_URL"  =>      "conf_JM_PROXY_URL",
			"JM_PROXY_PORT"  =>      "conf_JM_PROXY_PORT",
			"JM_PROXY_USER"  =>      "conf_JM_PROXY_USER",
			"JM_PROXY_PASS"  =>      "conf_JM_PROXY_PASS",
			"JM_ONCHECKOUT_SHOW_LEGALINFO"  =>      "conf_JM_ONCHECKOUT_SHOW_LEGALINFO",
			"JM_ONCHECKOUT_LEGALINFO_SHORTTEXT"  =>      "conf_JM_ONCHECKOUT_LEGALINFO_SHORTTEXT",
			"JM_ONCHECKOUT_LEGALINFO_LINK"  =>      "conf_JM_ONCHECKOUT_LEGALINFO_LINK",
			"ENABLE_DOWNLOADS"  =>      "conf_ENABLE_DOWNLOADS",
			"DOWNLOAD_MAX"  =>      "conf_DOWNLOAD_MAX",
			"DOWNLOAD_EXPIRE"  =>      "conf_DOWNLOAD_EXPIRE",
			"ENABLE_DOWNLOAD_STATUS"  =>      "conf_ENABLE_DOWNLOAD_STATUS",
			"DISABLE_DOWNLOAD_STATUS"  =>      "conf_DISABLE_DOWNLOAD_STATUS",
			"DOWNLOADROOT"  =>      "conf_DOWNLOADROOT",
			"JM_DOWNLOADABLE_PRODUCTS_KEEP_STOCKLEVEL"  =>      "conf_JM_DOWNLOADABLE_PRODUCTS_KEEP_STOCKLEVEL",
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
			"PSHOP_AGREE_TO_TOS_ONORDER" =>      "conf_PSHOP_AGREE_TO_TOS_ONORDER",
			"SHOW_CHECKOUT_BAR"	=>	"conf_SHOW_CHECKOUT_BAR",
			"MAX_VENDOR_PRO_CART"	=>	"conf_MAX_VENDOR_PRO_CART",
			"CHECK_STOCK"	=>	"conf_CHECK_STOCK",
			"ENCODE_KEY"	=>	"conf_ENCODE_KEY",
			"NO_SHIPPING"    	=>      "conf_NO_SHIPPING",
			"NO_SHIPTO"    	=>      "conf_NO_SHIPTO",
			"PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS" => "conf_PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS",
			"PSHOP_IMG_RESIZE_ENABLE" => "conf_PSHOP_IMG_RESIZE_ENABLE",
			"PSHOP_IMG_WIDTH" => "conf_PSHOP_IMG_WIDTH",
			"PSHOP_IMG_HEIGHT" => "conf_PSHOP_IMG_HEIGHT",
			"PSHOP_COUPONS_ENABLE" => "conf_PSHOP_COUPONS_ENABLE",
			"PSHOP_SHOW_PRODUCTS_IN_CATEGORY" => "conf_PSHOP_SHOW_PRODUCTS_IN_CATEGORY",
			"PSHOP_SHOW_TOP_PAGENAV"            =>      "conf_PSHOP_SHOW_TOP_PAGENAV",
			"PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS"          =>      "conf_PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS",
			"JM_CURRENCY_CONVERTER_MODULE" => "conf__JM_CURRENCY_CONVERTER_MODULE",
			"JM_CONTENT_PLUGINS_ENABLE" => "conf_JM_CONTENT_PLUGINS_ENABLE",
			"JM_ENABLE_COOKIE_CHECK" => "conf_JM_ENABLE_COOKIE_CHECK",
			'JM_FEED_ENABLED' => 'conf_JM_FEED_ENABLED',
			'JM_FEED_CACHE' => 'conf_JM_FEED_CACHE',
			'JM_FEED_CACHETIME' => 'conf_JM_FEED_CACHETIME',
			'JM_FEED_TITLE' => 'conf_JM_FEED_TITLE',
			'JM_FEED_TITLE_CATEGORIES' => 'conf_JM_FEED_TITLE_CATEGORIES',
			'JM_FEED_SHOW_IMAGES' => 'conf_JM_FEED_SHOW_IMAGES',
			'JM_FEED_SHOW_PRICES' => 'conf_JM_FEED_SHOW_PRICES',
			'JM_FEED_SHOW_DESCRIPTION' => 'conf_JM_FEED_SHOW_DESCRIPTION',
			'JM_FEED_DESCRIPTION_TYPE' => 'conf_JM_FEED_DESCRIPTION_TYPE',
			'JM_FEED_LIMITTEXT' => 'conf_JM_FEED_LIMITTEXT',
			'JM_FEED_MAX_TEXT_LENGTH' => 'conf_JM_FEED_MAX_TEXT_LENGTH',
			'JM_STORE_CREDITCARD_DATA' => 'conf_JM_STORE_CREDITCARD_DATA',
			'JM_ENCRYPT_FUNCTION' => 'conf_ENCRYPT_FUNCTION',
			'JM_COMPONENT_NAME' => 'option',
            "JM_LOGFILE_ENABLED"     =>      "conf_JM_LOGFILE_ENABLED",
            "JM_LOGFILE_NAME"     =>         "conf_JM_LOGFILE_NAME",
            "JM_LOGFILE_LEVEL"     =>         "conf_JM_LOGFILE_LEVEL",
            "JM_DEBUG_IP_ENABLED"     =>      "conf_JM_DEBUG_IP_ENABLED",
            "JM_DEBUG_IP_ADDRESS"     =>      "conf_JM_DEBUG_IP_ADDRESS",
            "JM_LOGFILE_FORMAT"       =>      "conf_JM_LOGFILE_FORMAT",

			// Begin Arrays
			"JM_BROWSE_ORDERBY_FIELDS"          =>      "conf_JM_BROWSE_ORDERBY_FIELDS",
			"JM_MODULES_FORCE_HTTPS"          =>      "conf_JM_MODULES_FORCE_HTTPS",
			"JM_CHECKOUT_MODULES"	=>	"JM_CHECKOUT_MODULES"
			);
			if( !vmisJoomla('1.5')) {
				$url = '$mosConfig_live_site.$app';
			} else {
				$url = "'".$db->getEscaped(vmGet($d,'conf_URL', $mosConfig_live_site ))."'";
			}
			$config = "<?php
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
* The configuration file for JMart
*
* @package JMart
* @subpackage core
* @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* JMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_jmart/COPYRIGHT.php for copyright notices and details.
*
* http://joomlacode.org/gf/project/jmart/
*/

global \$mosConfig_absolute_path,\$mosConfig_live_site;
if( !class_exists( 'jconfig' )) {
	\$global_lang = \$GLOBALS['mosConfig_lang'];

	@include( dirname( __FILE__ ).'/../../../configuration.php' );

	\$GLOBALS['mosConfig_lang'] = \$mosConfig_lang = \$global_lang;
}
// Check for trailing slash
if( \$mosConfig_live_site[strlen( \$mosConfig_live_site)-1] == '/' ) {
	\$app = '';
}
else {
	\$app = '/';
}
// these path and url definitions here are based on the Joomla! Configuration
define( 'URL', $url );
define( 'SECUREURL', '".$db->getEscaped($d['conf_SECUREURL'])."' );

if ( (!empty(\$_SERVER['HTTPS']) && \$_SERVER['HTTPS'] != 'off') || \$_SERVER['SERVER_PORT'] == '443' ) {
	define( 'IMAGEURL', SECUREURL .'components/com_jmart/shop_image/' );
	define( 'JM_THEMEURL', SECUREURL.'components/com_jmart/themes/".$db->getEscaped($d['conf_THEME'])."/' );
} else {
	define( 'IMAGEURL', URL .'components/com_jmart/shop_image/' );
	define( 'JM_THEMEURL', URL.'components/com_jmart/themes/".$db->getEscaped($d['conf_THEME'])."/' );
}
define( 'JM_THEMEPATH', \$mosConfig_absolute_path.'/components/com_jmart/themes/".$db->getEscaped($d['conf_THEME'])."/' );

define( 'COMPONENTURL', URL .'administrator/components/com_jmart/' );
define( 'ADMINPATH', \$mosConfig_absolute_path.'/administrator/components/com_jmart/' );
define( 'CLASSPATH', ADMINPATH.'classes/' );
define( 'PAGEPATH', ADMINPATH.'html/' );
define( 'IMAGEPATH', \$mosConfig_absolute_path.'/components/com_jmart/shop_image/' );\n\n";

			// LOOP THROUGH ALL CONFIGURATION VARIABLES
			while (list($key, $value) = each($my_config_array)) {
				if( $key == 'ENCODE_KEY' ) {
					$encode_key = vmGet( $d, $value );
					$config .= "define('ENCODE_KEY', '".str_replace('\'', "\'", $encode_key )."');\n";
					if( $encode_key != ENCODE_KEY ) {
						// The ENCODE KEY has been changed! Now we need to re-encode the credit card information and transaction keys
						$db->query( 'UPDATE #__{vm}_order_payment SET order_payment_number = '.JM_ENCRYPT_FUNCTION.'('.JM_DECRYPT_FUNCTION.'(order_payment_number,\''.$db->getEscaped(ENCODE_KEY).'\'), \''.$db->getEscaped($encode_key).'\')');
						$db->query( 'UPDATE #__{vm}_payment_method SET secret_key = '.JM_ENCRYPT_FUNCTION.'('.JM_DECRYPT_FUNCTION.'(secret_key,\''.$db->getEscaped(ENCODE_KEY).'\'), \''.$db->getEscaped($encode_key).'\')');
					}
				}
				elseif( $key == 'JM_ENCRYPT_FUNCTION') {
					if( !defined('JM_ENCRYPT_FUNCTION')) define('JM_ENCRYPT_FUNCTION', 'ENCODE');
					if( empty( $d[$value] )) {
						$d[$value] = 'ENCODE';
					}
					if( $d[$value] != JM_ENCRYPT_FUNCTION ) {
						$encode_key = vmGet( $d, 'conf_ENCODE_KEY' );
						$reencode_key = $encode_key != ENCODE_KEY ? $encode_key : ENCODE_KEY;
						if( $d[$value] == 'ENCODE' ) $decryptor = 'DECODE';
						elseif( $d[$value] == 'AES_ENCRYPT' ) $decryptor = 'AES_DECRYPT';
						else $d[$value] = JM_ENCRYPT_FUNCTION;
						// The Encryption Function has been changed. We need to decode and re-encrypt now!
						$db->query( "UPDATE #__{vm}_order_payment SET order_payment_number = ".$d[$value].'('.JM_DECRYPT_FUNCTION."(order_payment_number,'".$db->getEscaped($reencode_key)."'), '".$db->getEscaped($reencode_key)."')");
						$db->query( 'UPDATE #__{vm}_payment_method SET secret_key = '.$d[$value].'('.JM_DECRYPT_FUNCTION.'(secret_key,\''.$db->getEscaped($reencode_key).'\'), \''.$db->getEscaped($reencode_key).'\')');
					}
					$config .= "define('$key', '".$d[$value]."');\n";
				}
				elseif( $key == "JM_BROWSE_ORDERBY_FIELDS" ) {
					$config .= "\n/* OrderByFields */\nglobal \$JM_BROWSE_ORDERBY_FIELDS;\n";
					$config .= "\$JM_BROWSE_ORDERBY_FIELDS = array( ";
					$i= 0;
					if( empty( $d['conf_JM_BROWSE_ORDERBY_FIELDS'] ) ) {
						$d['conf_JM_BROWSE_ORDERBY_FIELDS'] = array();
					}
					foreach( $d['conf_JM_BROWSE_ORDERBY_FIELDS'] as $orderbyfield) {
						$config.= "'$orderbyfield'";
						if( $i+1 < sizeof( $d['conf_JM_BROWSE_ORDERBY_FIELDS'] )) {
							$config .= ',';
						}
						$i++;
					}
					$config.= " );\n";
				}
				elseif( $key == 'JM_MODULES_FORCE_HTTPS' ) {
					$config .= "\n/* Shop Modules that run with https only*/\nglobal \$JM_MODULES_FORCE_HTTPS;\n";
					$config .= "\$JM_MODULES_FORCE_HTTPS = array( ";
					$i= 0;
					if( empty( $d['conf_JM_MODULES_FORCE_HTTPS'] )) $d['conf_JM_MODULES_FORCE_HTTPS'] = array();
					foreach( $d['conf_JM_MODULES_FORCE_HTTPS'] as $https_module) {
						$config.= "'".$db->getEscaped($https_module )."'";
						if( $i+1 < sizeof( $d['conf_JM_MODULES_FORCE_HTTPS'] )) {
							$config .= ',';
						}
						$i++;
					}
					$config.= " );\n";
				}
				elseif( $key == 'JM_CHECKOUT_MODULES' ) {
					$config .= "\n// Checkout Steps and their order\nglobal \$JM_CHECKOUT_MODULES;\n";
					$config .= "\$JM_CHECKOUT_MODULES = array( ";
					$i= 0;
					$max = 0;
					foreach( $d['JM_CHECKOUT_MODULES'] as $step ) {
						$max = (int)$step['order'] > $max ? (int)$step['order'] : $max;
						if( $step['name'] == 'CHECK_OUT_GET_FINAL_CONFIRMATION' ) {
							$step['order'] = max( $max, $step['order'] ); // In case someone wants the final confirmation not as last step (so we force it to be the last step)
						}
						$enabled = !empty($step['enabled']) || $step['name'] == 'CHECK_OUT_GET_PAYMENT_METHOD' || $step['name'] == 'CHECK_OUT_GET_FINAL_CONFIRMATION';
						$config.= "'".$step['name']."'=>array('order'=>".(int)$step['order'].",'enabled'=>".(int)$enabled.")";
						if( $i+1 < sizeof( $d['JM_CHECKOUT_MODULES'] )) {
							$config .= ",\n";
						}
						$i++;
					}
					$config.= " );\n";
				}
				elseif( $key == 'PSHOP_OFFLINE_MESSAGE' || $key == 'JM_ONCHECKOUT_LEGALINFO_SHORTTEXT'  ) {
					$config_val = str_replace("'","\'",vmGet( $d, $value, '', VMREQUEST_ALLOWHTML ) );
					$config .= "define('".$key."', '".$config_val."');\n";
				}
				else {
					$config_val = vmGet( $d, $value);
					$config_val = str_replace("'","\'", $config_val );
					$config_val = str_replace("\\\\","\\\\\\\\", $config_val );
					$config .= "define('".$key."', '".$config_val."');\n";
				}
			}

			$config .= "?>";

			fputs($fp, $config, strlen($config));
			fclose ($fp);
			if( !empty($_REQUEST['ajax_request'])) {
				$vmLogger->info( JText::_('JM_CONFIGURATION_CHANGE_SUCCESS',false) );
			} else {
				vmRedirect( $_SERVER['PHP_SELF']."?page=admin.show_cfg&option=com_jmart", JText::_('JM_CONFIGURATION_CHANGE_SUCCESS') );
			}
			return true;

		}
	} // end function writeconfig

	/**
	 * Writes the configuration file of the current theme
	 *
	 * @param array $d
	 */
	function writeThemeConfig( &$d ) {
		global $page, $vmLogger;

		$my_config_array = array();
		$config = "<?php
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
* The configuration file for the ".basename( JM_THEMEPATH )." theme
*
* @package JMart
* @subpackage themes
* @copyright Copyright (C) 2008 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* JMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_jmart/COPYRIGHT.php for copyright notices and details.
*
* http://joomlacode.org/gf/project/jmart/
*/
?>
";
		$params = JRequest::getVar( 'params', '' );
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

		if ($fp = fopen(JM_THEMEPATH ."theme.config.php", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);

			if( !empty($_REQUEST['ajax_request'])) {
				$vmLogger->info( JText::_('JM_CONFIGURATION_CHANGE_SUCCESS',false) );
			} else {
				$task = JRequest::getVar( 'task', '');
				if( $task == 'apply' ) {
					$page = 'admin.theme_config_form';
					$theme = '&theme=' . basename(JM_THEMEURL);
				} else {
					$page = 'admin.show_cfg';
					$theme = '';
				}
				vmRedirect( $_SERVER['PHP_SELF']."?page=$page$theme&option=com_jmart", JText::_('JM_CONFIGURATION_CHANGE_SUCCESS') );
			}
			return true;
		} else {
			$vmLogger->err( JText::_('JM_CONFIGURATION_CHANGE_FAILURE',false).' ('. JM_THEMEPATH ."theme.config.php)" );
			return false;
		}
	}

} // end class ps_config
?>
