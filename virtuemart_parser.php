<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* This file prepares the VirtueMart framework
* It should be included whenever a VirtueMart function is needed
*
* @version $Id$
* @package VirtueMart
* @subpackage core
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
global $my, $db, $perm, $ps_function, $ps_module, $ps_html, $ps_vendor_id, $vendor_image,$vendor_image_url, $keyword,
	$ps_payment_method,$ps_zone,$sess, $page, $func, $pagename, $modulename, $vars, $VM_LANG, $cmd, $ok, $mosConfig_lang,
	$auth, $ps_checkout,$error, $error_type, $func_perms, $func_list, $func_class, $func_method, $func_list, $dir_list,
	$vendor_currency_display_style, $vendor_freeshipping, $mm_action_url, $limit, $limitstart, $mainframe;

// Raise memory_limit to 16M when it is too low
// Especially the product section needs much memory
$memLimit = @ini_get('memory_limit');
if( stristr( $memLimit, 'k') ) {
	$memLimit = str_replace( 'k', '', str_replace( 'K', '', $memLimit )) * 1024;
}
elseif( stristr( $memLimit, 'm') ) {
	$memLimit = str_replace( 'm', '', str_replace( 'M', '', $memLimit )) * 1024 * 1024;
}
if( $memLimit < 16777216 ) {
	@ini_set('memory_limit', '16M');
}

$option = mosGetParam( $_REQUEST, 'option' );

if( !defined( '_VM_PARSER_LOADED' )) {
	global $my;
	
	$page = mosgetparam($_REQUEST, 'page', "");
	$func = mosgetparam($_REQUEST, 'func', "");
	$ajax_request = mosgetparam($_REQUEST, 'ajax_request', "0" );
	
	if( $my->id > 0 ) {
		// This is necessary to get the real GID
		$my->load( $my->id );
	}

	if( !file_exists( $mosConfig_absolute_path. "/administrator/components/com_virtuemart/virtuemart.cfg.php" )) {
		die( "<h3>The configuration file for VirtueMart is missing!</h3>It should be here: <strong>"
		. $mosConfig_absolute_path. "/administrator/components/com_virtuemart/virtuemart.cfg.php</strong>" );
	}
	// the configuration file for the Shop
	require_once( $mosConfig_absolute_path. "/administrator/components/com_virtuemart/virtuemart.cfg.php" );
	
	// the global file for VirtueMart
	require_once( ADMINPATH . 'global.php' );

	// This makes it possible to use Shared SSL
	$sess->prepare_SSL_Session();

	if( $option == "com_virtuemart" ) {

		// Get sure that we have float values with a decimal point!
		@setlocale( LC_NUMERIC, 'en_US', 'en' );
		
		// some input validation for limitstart
		if (!empty($_REQUEST['limitstart'])) {
			$_REQUEST['limitstart'] = intval( $_REQUEST['limitstart'] );
		}

		$mosConfig_list_limit = isset( $mosConfig_list_limit ) ? $mosConfig_list_limit : SEARCH_ROWS;

		$keyword = substr( urldecode(mosgetparam($_REQUEST, 'keyword', '')), 0, 50 );
	
		unset( $_REQUEST["error"] );
		$user_id = intval( mosgetparam($_REQUEST, 'user_id', 0) );
		$_SESSION['session_userstate']['product_id'] = $product_id = intval( mosgetparam($_REQUEST, 'product_id', 0) );
		$_SESSION['session_userstate']['category_id'] = $category_id = intval( mosgetparam($_REQUEST, 'category_id', 0) );
		$user_info_id = mosgetparam($_REQUEST, 'user_info_id', 0);

		$myInsecureArray = array('keyword' => $keyword,
									'user_info_id' => $user_info_id,
									'page' => $page,
									'func' => $func
									);
		/**
		 * This InputFiler Object will help us filter malicious variable contents
		 * @global vmInputFiler vmInputFiler
		 */
		$GLOBALS['vmInputFilter'] = new vmInputFilter();
		// prevent SQL injection
		$myInsecureArray = $GLOBALS['vmInputFilter']->safeSQL( $myInsecureArray );
		// Re-insert the escaped strings into $_REQUEST
		foreach( $myInsecureArray as $requestvar => $requestval) {
				$_REQUEST[$requestvar] = $requestval;
		}
		// Limit the keyword (=search string) length to 50
		$_SESSION['session_userstate']['keyword'] = $keyword = substr(mosgetparam($_REQUEST, 'keyword', ''), 0, 50);
		
		$user_info_id = mosgetparam($_REQUEST, 'user_info_id', 0);
		
		$vars = $_REQUEST;
	}

	// Get default and this users's Shopper Group
	$shopper_group = $ps_shopper_group->get_shoppergroup_by_id( $my->id );

	// User authentication
	$auth = $perm->doAuthentication( $shopper_group );

	if( $option == "com_virtuemart" ) {
		// Check if we have to run a Shop Function
		// and if the user is allowed to execute it
		$funcParams = $ps_function->checkFuncPermissions( $func );

		/**********************************************
		** Get Page/Directory Permissions
		** Displays error if directory is not registered,
		** user has no permission to view it , or file doesn't exist
		************************************************/
		if (empty($page)) {// default page
			if (defined('_PSHOP_ADMIN')) {
				$page = "store.index";
			} 
			else {
				$page = HOMEPAGE;
			}
		}
		// Let's check if the user is allowed to view the page
		// if not, $page is set to ERROR_PAGE
		$pagePermissionsOK = $ps_module->checkModulePermissions( $page );

		$ok = true;

		if ( !empty( $funcParams["method"] ) ) {
			// Get the function parameters: function name and class name
			$q = "SELECT #__{vm}_module.module_name,#__{vm}_function.function_class";
			$q .= " FROM #__{vm}_module,#__{vm}_function WHERE ";
			$q .= "#__{vm}_module.module_id=#__{vm}_function.module_id AND ";
			$q .= "#__{vm}_function.function_method='".$funcParams["method"]."' AND ";
			$q .= "#__{vm}_function.function_class='".$funcParams["class"]."'";
			
			$db->query($q);
			$db->next_record();
			$class = $db->f('function_class');
			if( file_exists( CLASSPATH."$class.php" ) ) {
				// Load class definition file
				require_once( CLASSPATH.$db->f("function_class").".php" );
				$classname = str_replace( '.class', '', $funcParams["class"]);
				// create an object
				$string = "\$$classname = new $classname;";
				eval( $string );

				// RUN THE FUNCTION
				// $ok  = $class->function( $vars );
				$cmd = "\$ok = \$".$classname."->" . $funcParams["method"] . "(\$vars);";
				eval( $cmd );

				if ($ok == false) {
					$no_last = 1;
					if( $_SESSION['last_page'] != HOMEPAGE ) {
						$page = $_SESSION['last_page'];
					}
					$my_page= explode ( '.', $page );
					$modulename = $my_page[0];
					$pagename = $my_page[1];
					$_REQUEST['keyword']= $_SESSION['session_userstate']['keyword'];
					$_REQUEST['category_id']= $_SESSION['session_userstate']['category_id'];
					$_REQUEST['product_id']=$product_id = $_SESSION['session_userstate']['product_id'];
				}
			}
			else {
				$vmLogger->debug( "Could not include the class file $class" );
			}
			

			if (!empty($vars["error"])) {
				$error = $vars["error"];
			}
			if (!empty($error)) {
				echo vmCommonHTML::getErrorField($error);
			}
			
		}
		else {
			$no_last = 0;
			//$error="";
		}

		if ($ok == true && empty($error) && !defined('_DONT_VIEW_PAGE')) {
			$_SESSION['last_page'] = $page;
		}
	}
	// I don't get it, why Joomla uses masked gid values!
	if( !defined( '_PSHOP_ADMIN' )) {
		$my = $mainframe->getUser();
		if( isset( $my->_model )) {
			$my = $my->_model;
		}
	}
    // The Page will change with every different parameter / argument, so provide this for identification
    // "call" will call the function load_that_shop_page when it is not yet cached with exactly THESE parameters
    // or the caching time range has expired
	$GLOBALS['cache_id'] = 'vm_' . @md5( $modulename. $pagename. $product_id. $category_id .$manufacturer_id. $auth["shopper_group_id"]. $limitstart. $limit. @$_REQUEST['orderby']. @$_REQUEST['DescOrderBy'] );
		
	// If this is an asynchronous page load,
	// we clear the output buffer and just send the log messages.
	// the variable named 'ajax_request' has to be set to 1.
	if( $func && $ajax_request) {
		require_once( CLASSPATH . 'connectionTools.class.php' );
		vmConnector::sendHeaderAndContent( 200 );
		// Send an indicator wether the function call return true or false
		echo vmCommonHTML::getSuccessIndicator( $ok );
		$vmLogger->printLog();
		exit;
	}
	
	if( empty($_REQUEST['only_page']) ) {
		// the Log object holds all error messages
		// here we flush the buffer and print out all messages
		$vmLogger->printLog();
		
		// Now we can switch to implicit flushing
		$vmLogger->_buffering = false;
	}
	
	define( '_VM_PARSER_LOADED', 1 );
}
?>