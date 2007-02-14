<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* This file prepares the VirtueMart framework
* It should be included whenever a VirtueMart function is needed
*
* @version $Id:virtuemart_parser.php 431 2006-10-17 21:55:46 +0200 (Di, 17 Okt 2006) soeren_nb $
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

	// Raise memory_limit to 16M when it is too low
	// Especially the product section needs much memory
	vmRaiseMemoryLimit( '16M' );
	
	// This makes it possible to use Shared SSL
	$sess->prepare_SSL_Session();

	// Get default and this users's Shopper Group
	$shopper_group = $ps_shopper_group->get_shoppergroup_by_id( $my->id );

	// User authentication
	$auth = $perm->doAuthentication( $shopper_group );
	
	if( $option == "com_virtuemart" ) {

		// Get sure that we have float values with a decimal point!
		@setlocale( LC_NUMERIC, 'en_US', 'en' );
		
		// some input validation for limitstart
		if (!empty($_REQUEST['limitstart'])) {
			$_REQUEST['limitstart'] = intval( $_REQUEST['limitstart'] );
		}

		$mosConfig_list_limit = isset( $mosConfig_list_limit ) ? $mosConfig_list_limit : SEARCH_ROWS;

		$keyword = substr( urldecode(mosgetparam($_REQUEST, 'keyword', '')), 0, 50 );
		$user_info_id = mosgetparam($_REQUEST, 'user_info_id' );
	
		unset( $_REQUEST["error"] );
		
		// Cast all the following fields to INT
		$parseToIntFields = array('user_id','product_id','category_id','manufacturer_id','id','cid','vendor_id','country_id','currency_id',
								'order_id','module_id','function_id','payment_method_id','coupon_id') ;
		foreach( $parseToIntFields as $intField ) {
			if( !empty($_REQUEST[$intField]) && is_array($_REQUEST[$intField]) ) {
				mosArrayToInts( $_REQUEST[$intField]);
			} else {
				$_REQUEST[$intField] = $$intField = intval( mosgetparam($_REQUEST, $intField, 0) );
			}
		}
		
		$_SESSION['session_userstate']['product_id'] = $product_id = $_REQUEST['product_id'];
		$_SESSION['session_userstate']['category_id'] = $category_id = $_REQUEST['category_id'];
		
		$myInsecureArray = array('keyword' => $keyword,
									'user_info_id' => $user_info_id,
									'page' => $page,
									'func' => $func
									);
		/**
		 * This InputFiler Object will help us filter malicious variable contents
		 * @global vmInputFiler vmInputFiler
		 */
		$GLOBALS['vmInputFilter'] = $vmInputFilter = new vmInputFilter();
		// prevent SQL injection
		if( $perm->check('admin,storeadmin') ) {
			$myInsecureArray = $vmInputFilter->safeSQL( $myInsecureArray );
			$myInsecureArray = $vmInputFilter->process( $myInsecureArray );
			// Re-insert the escaped strings into $_REQUEST
			foreach( $myInsecureArray as $requestvar => $requestval) {
					$_REQUEST[$requestvar] = $requestval;
			}
		} else {
			// Strip all tags from all input values
			$_REQUEST = $vmInputFilter->process( $_REQUEST );
			$_REQUEST = $vmInputFilter->safeSQL( $_REQUEST );
		}
		// Limit the keyword (=search string) length to 50
		$_SESSION['session_userstate']['keyword'] = $keyword = substr(mosgetparam($_REQUEST, 'keyword', ''), 0, 50);
		
		$vars = $_REQUEST;
	}

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
				if( $ajax_request ) {
					require_once( CLASSPATH . 'connectionTools.class.php' );
					vmConnector::sendHeaderAndContent( 200 );
				}
				// Load class definition file
				require_once( CLASSPATH."$class.php" );
				$classname = str_replace( '.class', '', $funcParams["class"]);
				if( !class_exists(strtolower($classname))) {
					$classname = 'vm'.$classname;
				}
				// create an object
				$string = "\$$classname = new $classname;";
				eval( $string );

				// RUN THE FUNCTION
				// $ok  = $class->function( $vars );
				$cmd = "\$ok = \$".$classname."->" . $funcParams["method"] . "(\$vars);";
				eval( $cmd );

				if ($ok == false) {
					$no_last = 1;
					if( $_SESSION['last_page'] != HOMEPAGE && empty($_REQUEST['ignore_last_page']) ) {
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
	
		// If this is an asynchronous page load,
		// we clear the output buffer and just send the log messages.
		// the variable named 'ajax_request' has to be set to 1.
		if( $func && $ajax_request) {
			// Send an indicator wether the function call return true or false
			vmCommonHTML::getSuccessIndicator( $ok, $vmLogger );		
			if( is_callable( array( $mainframe, 'close' ) ) ) {				
				$mainframe->close();
			} else {
				exit;
			}
		}
		
		if ($ok == true && empty($error) && !defined('_DONT_VIEW_PAGE')) {
			$_SESSION['last_page'] = $page;
		}
	}
	// I don't get it, why Joomla uses masked gid values!
	if( !defined( '_PSHOP_ADMIN' )) {
		if( class_exists('jfactory')) {
			$my =& JFactory::getUser();
		} else {
			$my = $mainframe->getUser();
		}
		if( isset( $my->_table )) {
			$my = $my->_table;
		}
	}
    // The Page will change with every different parameter / argument, so provide this for identification
    // "call" will call the function load_that_shop_page when it is not yet cached with exactly THESE parameters
    // or the caching time range has expired
	$GLOBALS['cache_id'] = 'vm_' . @md5( $modulename. $pagename. $product_id. $category_id .$manufacturer_id. $auth["shopper_group_id"]. $limitstart. $limit. @$_REQUEST['orderby']. @$_REQUEST['DescOrderBy'] );
	
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