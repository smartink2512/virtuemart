<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: phpshop.php,v 1.27 2005/09/01 19:58:06 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

global $mosConfig_absolute_path, $product_id;

/* Load the phpshop main parse code */
require_once( $mosConfig_absolute_path.'/components/com_phpshop/phpshop_parser.php' );

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
$orderby = mosGetParam( $_REQUEST, 'orderby', 'pshop_product.product_name' );
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
  
    if( !$pagePermissionsOK && $error == $PHPSHOP_LANG->_PHPSHOP_MOD_NO_AUTH ) {
      $page = @$_REQUEST['page'];
      echo "<br/><br/>"._DO_LOGIN;
      $modulename = "checkout";
      $pagename= "login_form";
    }
    else {
      mosRedirect('index.php?option=com_phpshop&page='.$_SESSION['last_page'], $error." Error Type: ".$error_type);
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
      if ( stristr( $_SERVER['PHP_SELF'], "index2.php" ) && !stristr( $_SERVER['PHP_SELF'], "administrator" )) {
        if( !function_exists( "initEditor"))
          include( $mosConfig_absolute_path."/editor/editor.php" );
          
        initEditor();
      }
      // The admin header with dropdown menu
      include( ADMINPATH."header.php" );

      // Toolbar (save & back)
      if ( $page == "admin.show_cfg" || stristr($page, "form")) {
      
          require_once( "includes/HTML_toolbar.php" );
          function editorScript($editor1='', $editor2='') {    
            ?>
                 <script type="text/javascript">
                    function submitbutton(pressbutton) {
                      var form = document.adminForm;
                      if (pressbutton == 'cancel') {
                        submitform( pressbutton );
                        return;
                      }
                        <?php 
                        if ($editor1 != '')
                          getEditorContents( 'editor1', $editor1 ) ; ?>
                        <?php
                        if ($editor2 != '')
                          getEditorContents( 'editor2', $editor2 ) ; ?>
                        submitform( pressbutton );
            
                    }
                    </script><?php
            }
            $editor1_array = Array('product.product_form' => 'product_desc',
                                              'product.product_category_form' => 'category_description',
                                              'store.store_form' => 'vendor_store_desc',
                                              'vendor.vendor_form' => 'vendor_store_desc');
            $editor2_array = Array('store.store_form' => 'vendor_terms_of_service',
                                              'vendor.vendor_form' => 'vendor_terms_of_service');
           editorScript(isset($editor1_array[$page]) ? $editor1_array[$page] : '', isset($editor2_array[$page]) ? $editor2_array[$page] : '');
            ?>
          <table cellspacing="0" cellpadding="0" border="0" width="100%">
          <tr>
            <td >&nbsp;</td>
            <td width="50%">
              <?php
		mosToolBar::startTable();
			mosToolBar::spacer();
			$image = 'images/save.png';
			$image2 = 'images/save_f2.png'; ?>
			<td width="25" align="center">
				<a href="javascript:submitbutton('Save');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('save','','<?php echo $image2;?>',1);">
				<img src="<?php echo $image;?>" width="32" height="32" alt="Save" border="0" name="save" /></a>
			</td>
			<?php  mosToolBar::spacer(25);?>
			<td width="25" align="center">
				<a href="javascript:window.history.back();" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('cancel','','administrator/images/back_f2.png',1);">
				<img src="administrator/images/back.png" width="32" height="32" alt="Back" border="0" name="cancel" /></a>
			</td>
		<?php	
		mosToolBar::endtable(); 
	  ?>
            </td>
          </tr>
        </table>
        <?php
        }
      }
    /**
	** END: FRONTEND ADMIN - MOD
	*****************************/
    
    /*****************************
    ** BEGIN affiliate additions
    ** by nhyde <nhyde@bigDrift.com> for phpshop v0.6.1
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
           $q = "SELECT visit_id FROM #__pshop_visit WHERE visit_id = '".session_id()."'";
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
      global $my, $db, $perm, $ps_function, $ps_module, $ps_html, $ps_vendor_id, $page, $database,$mosConfig_absolute_path, $cart, $start,
      $product_id,$PHPSHOP_LANG, $sess,$vendor_image,$vendor_country_2_code, $vendor_country_3_code , $vendor_image_url, $PSHOP_SHIPPING_MODULES,
      $_VERSION, $vendor_name, $vendor_address, $vendor_city,$vendor_country,$vendor_mail, $category_id, $mainframe, $mosConfig_list_limit, $limitstart, $limit,
      $vendor_store_name, $vendor_state, $vendor_zip, $vendor_phone, $vendor_currency, $vendor_store_desc, $vendor_freeshipping, $ps_shipping, $ps_order_status,
      $module_description, $vendor_currency_display_style, $vendor_full_image, $mosConfig_live_site, $vendor_id, $CURRENCY_DISPLAY, $keyword, $mm_action_url,
      $ps_payment_method,$ps_zone,$ps_product, $ps_product_category, $ps_order, $sess, $page, $func, $pagename, $modulename, $vars, $cmd, $ok, $mosConfig_lang, $mosConfig_useractivation,
      $auth, $ps_checkout,$error, $error_type, $func_perms, $func_list, $func_class, $func_method, $func_list, $dir_list, $mosConfig_allowUserRegistration ;
      
      if( is_callable( array("mosMainFrame", "addCustomHeadTag" ) ) ) {
        $mainframe->addCustomHeadTag( "<script type=\"text/javascript\" src=\"components/com_phpshop/js/sleight.js\"></script>
<script type=\"text/javascript\" src=\"components/com_phpshop/js/sleightbg.js\"></script>
<link type=\"text/css\" rel=\"stylesheet\" media=\"screen, projection\" href=\"components/com_phpshop/css/shop.css\" />" );
      } else {
      ?>
      <script type="text/javascript" src="components/com_phpshop/js/sleight.js"></script>
      <script type="text/javascript" src="components/com_phpshop/js/sleightbg.js"></script>
	<link type="text/css" rel="stylesheet" media="screen, projection" href="components/com_phpshop/css/shop.css" />
      <?php
      }
      
	  // Show the PDF Button?
      if( PSHOP_PDF_BUTTON_ENABLE=='1' && !isset($_REQUEST['output']) && ($page=="shop.browse" || $page=="shop.product_details")) {
        echo "<table align=\"right\"><tr><td><a title=\"PDF\" target=\"_blank\" href=\"index2.php?option=com_phpshop&page=shop.pdf_output&showpage=$page&pop=1&output=pdf&product_id=$product_id&category_id=$category_id\">
            <img src=\"".IMAGEURL."ps_image/acroread.png\" alt=\"PDF\" height=\"32\" width=\"32\" border=\"0\" /></a></td></tr></table>";
      }
      // Load requested PAGE
      include( PAGEPATH.$modulename.".".$pagename.".php" );
    
      if (SHOWVERSION) {
        include(PAGEPATH ."/VERSION.txt");
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
?>
