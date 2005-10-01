<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
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

global $mosConfig_absolute_path, $product_id;

/* Load the virtuemart main parse code */
require_once( $mosConfig_absolute_path.'/components/'.$option.'/virtuemart_parser.php' );

$my_page= explode ( '.', $page );
$modulename = $my_page[0];
$pagename = $my_page[1];
	
/* Page Navigation Parameters */
$mainframe->_userstate =& $_SESSION['session_userstate'];
$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
$limitstart = $mainframe->getUserStateFromRequest( "view{$keyword}{$category_id}limitstart", 'limitstart', 0 );
/* Get all the other paramters */
$manufacturer_id = mosGetParam( $_REQUEST, 'manufacturer_id', null );
$keyword1 = urldecode(mosGetParam( $_REQUEST, 'keyword1', null ));
$keyword2 = urldecode(mosGetParam( $_REQUEST, 'keyword2', null ));
$search_category= mosGetParam( $_REQUEST, 'search_category', null );
$DescOrderBy = mosGetParam( $_REQUEST, 'DescOrderBy', "ASC" );
$search_limiter= mosGetParam( $_REQUEST, 'search_limiter', null );
$search_op= mosGetParam( $_REQUEST, 'search_op', null );
$orderby = mosGetParam( $_REQUEST, 'orderby', '{vm}_product.product_name' );
$product_type_id = mosgetparam($_REQUEST, 'product_type_id', null); // Changed Product Type

if( PSHOP_IS_OFFLINE == "1" ) {
  echo PSHOP_OFFLINE_MESSAGE;
}
else {
  
  // The Vendor ID is important
  $ps_vendor_id = $_SESSION['ps_vendor_id'];
  
  // The authentication array
  $auth = $_SESSION['auth'];
  
  $no_menu = mosGetParam( $_REQUEST, 'no_menu', 0 );
  
  // Timer Start
  if ( DEBUG == "1" ) {
    $start = utime();
    $GLOBALS["mosConfig_debug"] = 1;
  }
  
  // update the cart because something could have 
  // changed while running a function
  $cart = $_SESSION["cart"];
  
    
  if (( !$pagePermissionsOK || !$funcParams ) && $_REQUEST['page'] != 'checkout.index') {
  
    if( !$pagePermissionsOK && $error == $VM_LANG->_PHPSHOP_MOD_NO_AUTH ) {
      $page = @$_REQUEST['page'];
      echo '<br/><br/>'._DO_LOGIN.'<br/><br/>';
      $modulename = "checkout";
      $pagename= "login_form";
    }
    else {
      mosRedirect('index.php?option='.$option.'&page='.$_SESSION['last_page'], $error." Error Type: ".$error_type);
      exit();
    }
  }
  
  // For there's no errorpage to display the error,
  // we must echo it before the page is loaded
  if (!empty($error) && $page != ERRORPAGE) 
    echo "<span class=\"shop_error\">".$error."</span>";
    
    /*****************************
    ** FRONTEND ADMIN - MOD
    **/
    $pshop_mode = mosgetparam($_REQUEST, 'pshop_mode', "");
    if (($pshop_mode == "admin" 
        || stristr($page,"form") 
        || stristr($page, "list")
        || stristr($page, "cfg")
        || stristr($page, "print") 
        || stristr($page, "display"))
        && ($perm->check("admin,storeadmin")
            && ((!stristr($my->usertype, "admin") ^ PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS == '' ) 
                || stristr($my->usertype, "admin")
               )
            && !stristr($page, "shop.")
            )
        && $no_menu != "1"
    ) {
		define( '_FRONTEND_ADMIN_LOADED', '1' );
		$mainframe->loadEditor = 1;
		require_once( $mosConfig_absolute_path."/editor/editor.php" );
		initEditor();
		
		$editor1_array = Array('product.product_form' => 'product_desc',
								'product.product_category_form' => 'category_description',
								'store.store_form' => 'vendor_store_desc',
								'vendor.vendor_form' => 'vendor_store_desc');
		$editor2_array = Array('store.store_form' => 'vendor_terms_of_service',
								'vendor.vendor_form' => 'vendor_terms_of_service');
		editorScript(isset($editor1_array[$page]) ? $editor1_array[$page] : '', isset($editor2_array[$page]) ? $editor2_array[$page] : '');
		?>
		<link type="text/css" rel="stylesheet" media="screen, projection" href="components/<?php echo $option ?>/css/admin.css" />
		<script type="text/javascript" src="<?php echo $mosConfig_live_site ?>/components/<?php echo $option ?>/js/functions.js"></script>
		<?php
		  
		// The admin header with dropdown menu
		include( ADMINPATH."header.php" );
	
		include( ADMINPATH."toolbar.virtuemart.php" );
		echo '<br style="clear:both;" />';
      
      }
    /**
	** END: FRONTEND ADMIN - MOD
	*****************************/
    
    /*****************************
	** BEGIN affiliate additions
	** by nhyde <nhyde@bigDrift.com> for virtuemart v0.6.1
	*/
      if (AFFILIATE_ENABLE == '1') {
          $unset_affiliate = false;
          if (!isset($ps_affiliate)) {
            include_class ( 'affiliate' );
            $unset_affiliate = true;
          }
          
          //keep tracking the affiliate
          if(isset($_SESSION['afid'])){
           $ps_affiliate->visit_update();
          }
          
          //register the affiliated visit but only if the 
          // aid is in our database and it is active.
          else{
            //set the affiliate_id = 0 to log any visitors that are not affiliate visitors
             $aff_details = $ps_affiliate->get_affiliate_details($auth['user_id']);
             $affiliate_id = $aff_details['id'];
            
          
           //the logout function may have wiped out the session so search the database
           //and re-register it.
           $q = "SELECT visit_id FROM #__{vm}_visit WHERE visit_id = '".session_id()."'";
           $db->query($q);
           
           if($db->next_record()){
             $ps_affiliate->visit_update();
           }
           
           else {
              
              $ps_affiliate->visit_register();
          }
        }
        if (isset($affiliate_id)) {
          $_SESSION['afid'] = $affiliate_id;
          $GLOBALS['afid'] = $affiliate_id;
        }
      }
      /**
      *    END added for affiliate module
      ****************************/

// Here is the most important part of the whole Shop:
// LOADING the requested page for displaying it to the customer.
// I have wrapped it with a function, because it becomes
// cacheable that way.
// It's just an "include" statement which loads the page

if( !function_exists( "load_that_shop_page" )) {
  function load_that_shop_page( $modulename, $pagename) {
      global $my, $db, $perm, $ps_function, $ps_module, $ps_html, $ps_vendor_id, $page, $database,$mosConfig_absolute_path, $cart, $start, $option, 
      $product_id,$VM_LANG, $sess,$vendor_image,$vendor_country_2_code, $vendor_country_3_code , $vendor_image_url, $PSHOP_SHIPPING_MODULES,
      $_VERSION, $vendor_name, $vendor_address, $vendor_city,$vendor_country,$vendor_mail, $category_id, $mainframe, $mosConfig_list_limit, $limitstart, $limit,
      $vendor_store_name, $vendor_state, $vendor_zip, $vendor_phone, $vendor_currency, $vendor_store_desc, $vendor_freeshipping, $ps_shipping, $ps_order_status,
      $module_description, $vendor_currency_display_style, $vendor_full_image, $mosConfig_live_site, $vendor_id, $CURRENCY_DISPLAY, $keyword, $mm_action_url,
      $ps_payment_method,$ps_zone,$ps_product, $ps_product_category, $ps_order, $sess, $page, $func, $pagename, $modulename, $vars, $cmd, $ok, $mosConfig_lang, $mosConfig_useractivation,
      $auth, $ps_checkout,$error, $error_type, $func_perms, $func_list, $func_class, $func_method, $func_list, $dir_list, $mosConfig_allowUserRegistration ;
      
      if( is_callable( array("mosMainFrame", "addCustomHeadTag" ) ) && !stristr( $_SERVER['PHP_SELF'], "index2.php") ) {
        $mainframe->addCustomHeadTag( "<script type=\"text/javascript\" src=\"components/$option/js/sleight.js\"></script>
<script type=\"text/javascript\" src=\"components/$option/js/sleightbg.js\"></script>
<link type=\"text/css\" rel=\"stylesheet\" media=\"screen, projection\" href=\"components/$option/css/shop.css\" />" );
      } else {
      ?>
      <script type="text/javascript" src="components/<?php echo $option ?>/js/sleight.js"></script>
      <script type="text/javascript" src="components/<?php echo $option ?>/js/sleightbg.js"></script>
	<link type="text/css" rel="stylesheet" media="screen, projection" href="components/<?php echo $option ?>/css/shop.css" />
      <?php
      }
      
	  // Show the PDF Button?
      if( PSHOP_PDF_BUTTON_ENABLE=='1' && !isset($_REQUEST['output']) && ($page=="shop.browse" || $page=="shop.product_details")) {
        echo "<table align=\"right\"><tr><td><a title=\"PDF\" target=\"_blank\" href=\"index2.php?option=$option&page=shop.pdf_output&showpage=$page&pop=1&output=pdf&product_id=$product_id&category_id=$category_id\">
            <img src=\"".IMAGEURL."ps_image/acroread.png\" alt=\"PDF\" height=\"32\" width=\"32\" border=\"0\" /></a></td></tr></table>";
      }
      // Load requested PAGE
      include( PAGEPATH.$modulename.".".$pagename.".php" );
    
      if (SHOWVERSION) {
        include(PAGEPATH ."/VERSION.php");
      }
    
      // Set debug option on/off
      if (DEBUG) {
          $end = utime();
          $runtime = $end - $start;
          $my_debug_page= explode ( '.', DEBUGPAGE );
          $modname = $my_debug_page[0];
          $pagename = $my_debug_page[1];  
          include( PAGEPATH . "$modname.$pagename.php" );
      }
      return $mainframe;
    }
  }
  // Caching is a sensible thing. We must take care of caching
  // only pages that are the same again and again
  //  We only cache: shop.browse, shop.product_details
  if ( !empty($mosConfig_caching) && ($page=="shop.browse" || $page=="shop.product_details") && class_exists("mosCache")) {
      
      // Get the Cache_Lite_Function object
      $cache =& mosCache::getCache( 'com_content' );
      
      // The function we let call remotely here has only two arguments: the Modulename(shop) and the Pagename(browse or product_details),
      // But Cache_Lite takes the arguments for identifying common calls to cacheable functions.
      // The Page will change with every different parameter / argument, so provide this for identification
      // "call" will call the function load_that_shop_page when it is not yet cached with exactly THESE parameters
      // or the caching time range has expired
      $return = $cache->call('load_that_shop_page', $modulename, $pagename, $product_id, $category_id, $auth["shopper_group_id"], $limitstart, $limit, @$_REQUEST['orderby'], @$_REQUEST['DescOrderBy'] );
      if( get_class( $return ) == "mosMainFrame" ) {
        $mainframe = $return;
      }
  }
  else {
      load_that_shop_page( $modulename, $pagename);
  }
}
if( defined( '_FRONTEND_ADMIN_LOADED' ) || DEBUG == '1')
	echo '<script language="Javascript" type="text/javascript" src="'. $mosConfig_live_site.'/components/'.$option.'/js/wz_tooltip.js"></script>';
?>
