<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* This file prepares the VirtueMart framework
* It should be included whenever a VirtueMart function is needed
*
* @version $Id: COPYRIGHT.php 70 2005-09-15 20:45:51Z spacemonkey $
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_phpshop/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

/** 
* This file has nearly the same functionality as the old phpShop Parser - index.php -
*/
$option = mosGetParam( $_REQUEST, 'option' );

if( !defined( 'CLASSPATH' )) {

    global $my, $db, $perm, $ps_function, $ps_module, $ps_html, $ps_vendor_id, $vendor_image,$vendor_image_url, $keyword,
            $ps_payment_method,$ps_zone,$sess, $page, $func, $pagename, $modulename, $vars, $PHPSHOP_LANG, $cmd, $ok, $mosConfig_lang,
            $auth, $ps_checkout,$error, $error_type, $func_perms, $func_list, $func_class, $func_method, $func_list, $dir_list, 
            $vendor_currency_display_style, $vendor_freeshipping, $mm_action_url, $limit, $limitstart;
	
	if( !file_exists( $mosConfig_absolute_path. "/administrator/components/com_phpshop/phpshop.cfg.php" ))
		die( "<h3>The configuration file for mambo-phpShop is missing!</h3>It should be here: <strong>"
				. $mosConfig_absolute_path. "/administrator/components/com_phpshop/phpshop.cfg.php</strong>" );
    // the configuration file for the Shop
    require_once( $mosConfig_absolute_path. "/administrator/components/com_phpshop/phpshop.cfg.php" );
    
	// The abstract language class
	require_once( CLASSPATH."language.class.php" );
	
    // load the Language File
    if (file_exists( ADMINPATH. 'languages/'.$mosConfig_lang.'.php' ))
        require_once( ADMINPATH. 'languages/'.$mosConfig_lang.'.php' );
    else
        require_once( ADMINPATH. 'languages/english.php' );
    
    /** @global phpShopLanguage $PHPSHOP_LANG */
    $GLOBALS['PHPSHOP_LANG'] =& new phpShopLanguage();
    
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
    require_once(CLASSPATH."ps_html.php");
    require_once(CLASSPATH."ps_session.php");
    require_once(CLASSPATH."ps_function.php");
    require_once(CLASSPATH."ps_module.php");
    require_once(CLASSPATH."ps_perm.php");
    //require_once(CLASSPATH."ps_user.php");
    //require_once(CLASSPATH."ps_user_address.php");
    require_once(CLASSPATH."ps_shopper_group.php");
    require_once(CLASSPATH."phpInputFilter/class.inputfilter.php");
    require_once(CLASSPATH."htmlTools.class.php");
    
    // Instantiate the DB class
    $db = new ps_DB;
    // Instantiate the permission class
    $perm = new ps_perm;
    // Instantiate the permission class
    $ps_html = new ps_html;
    // Instantiate the session class
    $sess = new ps_session;
    // Instantiate the module class
    $ps_module = new ps_module;
    // Instantiate the function class
    $ps_function = new ps_function;
    // Instantiate the ps_shopper_group class
    $ps_shopper_group = new ps_shopper_group;
        
    // Set the mosConfig_live_site to its' SSL equivalent
    if( $_SERVER['SERVER_PORT'] == 443 || strstr( "checkout.", $page )) {
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
    
    // IMPORTANT! mambo-phpShop needs this session
    // to keep the Cart contents
    if (!defined('_PSHOP_ADMIN')) {
    
      // Set Mambo's Cookies for the SSL Domain as well
      // This makes it possible to use Shared SSL
      $sess->prepare_SSL_Session();
      
      if( empty($_SESSION)) {
       //Session not yet started!";
          session_name( 'phpshop' );
          session_start();
          if( !empty($_SESSION) && !empty($_COOKIE['phpshop'])) {
            echo DEBUG ? '<div style="border: green 2px solid;padding: 3px;margin: 2px;"><strong>Shop Debug:</strong> A Session called <i>phpShop</i> was successfully started!</div>' : '';
          }
      }
      else
          echo DEBUG ? '<div style="border: orange 2px dotted;padding: 3px;margin: 2px;"><strong>Shop Debug:</strong> A Session had already been started...you seem to be using SMF, phpBB or another Sesson based Software.</div>' : '';
      if( empty($_COOKIE['phpshop'] )) {
        setCookie( 'phpshop', md5(uniqid('phpshop')), 0, "/" );
        echo DEBUG ? '<div style="border: red 2px dotted;padding: 3px;margin: 2px;"><strong>Shop Debug:</strong> A phpShop Cookie had to be set (there was none - does your Browser keep the Cookie?) although a Session already has been started! If you see this message on each page load, your browser doesn\'t accept Cookies from this site.</div>' : '';
      }
      
    }
    // the global file for PHPShop
    require_once( ADMINPATH . 'global.php' );
    
    $curreny_display =& vendor_currency_display_style( $vendor_currency_display_style );
    /** load Currency Display Class **/
     require_once( CLASSPATH.'class_currency_display.php' );
    /** @superglobal CurrencyDisplay $CURRENCY_DISPLAY */
    $GLOBALS['CURRENCY_DISPLAY'] =& new CurrencyDisplay($curreny_display["id"], $curreny_display["symbol"], $curreny_display["nbdecimal"], $curreny_display["sdecimal"], $curreny_display["thousands"], $curreny_display["positive"], $curreny_display["negative"]);
    
	if( $option == "com_phpshop" ) {
		// some input validation for limitstart
		if (!empty($_REQUEST['limitstart'])) {
		  if (!is_string($_REQUEST['limitstart']) and $_REQUEST['limitstart'] != (string)(int) $_REQUEST['limitstart'])
			die('Please provide a valid value for limitstart');
		}
		
		$mosConfig_list_limit = isset( $mosConfig_list_limit ) ? $mosConfig_list_limit : SEARCH_ROWS;
		
		$_SESSION['session_userstate']['keyword'] = $keyword = urldecode(mosgetparam($_REQUEST, 'keyword', ''));
		$_SESSION['session_userstate']['category_id'] = $category_id = mosgetparam($_REQUEST, 'category_id', 0);
		$_SESSION['session_userstate']['product_id'] = $product_id = mosgetparam($_REQUEST, 'product_id', 0);
		
		$user_id = mosgetparam($_REQUEST, 'user_id', 0);
		$user_info_id = mosgetparam($_REQUEST, 'user_info_id', 0);
		$page = mosgetparam($_REQUEST, 'page', "");
		$func = mosgetparam($_REQUEST, 'func', "");
		
		// basic SQL inject detection
		$my_insecure_array = array('keyword' => $keyword,
                    'category_id' => $category_id,
                    'product_id' => $product_id,
                    'user_id' => $user_id,
                    'user_info_id' => $user_info_id,
                    'page' => $page,
                    'func' => $func);
                    
		while(list($key,$value)=each($my_insecure_array)) {
			if( !is_array( $value ))
				if (stristr($value,'FROM ') ||
					stristr($value,'UPDATE ') ||
					stristr($value,'WHERE ') ||
					stristr($value,'ALTER ')  ||
					stristr($value,'SELECT ')  ||
					stristr($value,'SHUTDOWN ') ||
					stristr($value,'CREATE ') ||
					stristr($value,'DROP ') ||
					stristr($value,'DELETE FROM') ||
					stristr($value,'script') ||
					stristr($value,'<>') ||
					//stristr($value,'=') ||
					stristr($value,'SET ')) 
						die('Please provide a permitted value for '.$key);
		}
		$vars = $_REQUEST;
    }
    // Register the cart
    if (empty($_SESSION["cart"])) {
        $cart = array();
        $cart["idx"] = 0;
        $_SESSION["cart"] = $cart ;
    } 
    else {
     if( ( @$_SESSION['auth']['user_id'] != @$my->id ) && empty( $my->id ) ) {
        session_name( 'phpshop' );
        session_destroy();
        $cart = array();
        $cart["idx"] = 0;
        $_SESSION["cart"] = $cart ;
     }
     else {
        $cart = $_SESSION["cart"];
      }
    }
    
    // Get default and this users's Shopper Group
	$shopper_group = $ps_shopper_group->get_shoppergroup_by_id( $my->id );
	
	// User authentication
    $auth = $perm->doAuthentication();
    
	if( $option == "com_phpshop" ) {
		// Check if we have to run a Shop Function 
		// and if the user is allowed to execute it
		$funcParams = $ps_function->checkFuncPermissions( $func );
	
		/**********************************************
		** Get Page/Directory Permissions
		** Displays error if directory is not registered, 
		** user has no permission to view it , or file doesn't exist
		************************************************/
		if (empty($page)) {// default page
		  if (defined('_PSHOP_ADMIN'))
			$page = "store.index";
		  else
			$page = HOMEPAGE;
		
		}
		// Let's check if the user is allowed to view the page
		// if not, $page is set to ERROR_PAGE
		$pagePermissionsOK = $ps_module->checkModulePermissions( $page );
		
		$ok = false;
		
		if ( $funcParams ) {
			// Get the function parameters: function name and class name
			$q = "SELECT #__pshop_module.module_name,#__pshop_function.function_class"; 
			$q .= " FROM #__pshop_module,#__pshop_function WHERE ";
			$q .= "#__pshop_module.module_id=#__pshop_function.module_id AND ";
			$q .= "#__pshop_function.function_method='".$funcParams["method"]."' AND ";
			$q .= "#__pshop_function.function_class='".$funcParams["class"]."'";
			$db->setQuery($q);
			$db->query();
			$db->next_record();
			
			if( file_exists( CLASSPATH.$db->f("function_class").".php" ) ) {
				// Load class definition file
				require_once( CLASSPATH.$db->f("function_class").".php" );
				
				// create an object
				$string = "\$" . $funcParams["class"] . " = new " . $funcParams["class"] . ";";
				eval( $string );
			  
				// RUN THE FUNCTION
				// $ok  = $class->function( $vars );
				$cmd = "\$ok = \$" . $funcParams["class"] . "->" . $funcParams["method"] . "(\$vars);";
				eval( $cmd );
			 
				if ($ok == false) {
					$no_last = 1;
					if( $_SESSION['last_page'] != HOMEPAGE )
						$page = $_SESSION['last_page'];
					$my_page= explode ( '.', $page );
					$modulename = $my_page[0];
					$pagename = $my_page[1];
					$_REQUEST['keyword']= $_SESSION['session_userstate']['keyword'];
					$_REQUEST['category_id']= $_SESSION['session_userstate']['category_id'];
					$_REQUEST['product_id']=$product_id = $_SESSION['session_userstate']['product_id'];
				}
			}
			elseif( DEBUG )
				echo "<div class=\"shop_error\">Fatal Error: Could include the class file ".$db->f("function_class")."</div>";
				
			if (!empty($vars["error"]))
				$error = $vars["error"];
			
			if (!empty($error))
				echo "<script type=\"text/javascript\">alert('".mysql_escape_string($error)."');</script>";
		}
		else {
			$no_last = 0;
			//$error="";
		}
		  
		if ($ok == true && empty($error) && !defined('_DONT_VIEW_PAGE'))
		  $_SESSION['last_page'] = $page;
    }
}
?>