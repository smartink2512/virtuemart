<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id:virtuemart.php 431 2006-10-17 21:55:46 +0200 (Di, 17 Okt 2006) soeren_nb $
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2004-2006 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

global $mosConfig_absolute_path, $product_id, $vmInputFilter, $vmLogger;
        
/* Load the virtuemart main parse code */
require_once( $mosConfig_absolute_path.'/components/'.$option.'/virtuemart_parser.php' );

$my_page= explode ( '.', $page );
$modulename = $my_page[0];
$pagename = $my_page[1];

/* Page Navigation Parameters */
$mainframe->_userstate =& $_SESSION['session_userstate'];
$limit = intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$keyword}{$category_id}limitstart", 'limitstart', 0 )) ;

/* Get all the other paramters */
$manufacturer_id = intval( mosGetParam( $_REQUEST, 'manufacturer_id', null ) );
$search_category= intval( mosGetParam( $_REQUEST, 'search_category', null ) );
$product_type_id = intval( mosgetparam($_REQUEST, 'product_type_id', null) );
// Display just the naked page without toolbar, menu and footer?
$only_page = mosGetParam( $_REQUEST, 'only_page', 0 );

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

		if( !$pagePermissionsOK && defined('_VM_PAGE_NOT_AUTH') ) {
			$page = 'checkout.login_form';
			echo '<br/><br/>'._DO_LOGIN.'<br/><br/>';
		}
		elseif( !$pagePermissionsOK && defined('_VM_PAGE_NOT_FOUND') ) {
			$page = HOMEPAGE;
		}
		else {
			$page = $_SESSION['last_page'];
		}
	}

	$my_page= explode ( '.', $page );
	$modulename = $my_page[0];
	$pagename = $my_page[1];

	// For there's no errorpage to display the error,
	// we must echo it before the page is loaded
	if (!empty($error) && $page != ERRORPAGE) {
		echo '<span class="shop_error">'.$error.'</span>';
	}

	/*****************************
	** FRONTEND ADMIN - MOD
	**/
	$pshop_mode = mosgetparam($_REQUEST, 'pshop_mode', "");
	if ( vmIsAdminMode()
		&& $perm->check("admin,storeadmin")
		&& ((!stristr($my->usertype, "admin") ^ PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS == '' )
			|| stristr($my->usertype, "admin")
			)
		&& !stristr($page, "shop.")
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
		
		$mainframe->addCustomHeadTag( vmCommonHTML::linkTag( VM_THEMEURL .'admin.css' ));
		$mainframe->addCustomHeadTag( vmCommonHTML::linkTag( VM_THEMEURL .'admin.styles.css' ));
		$mainframe->addCustomHeadTag( vmCommonHTML::scriptTag( "$mosConfig_live_site/components/$option/js/functions.js" ));
		echo '<table width="100%" align="left"><tr>';
		if( $no_menu != "1" ) {
			$vmLayout = 'standard';
			echo '<td valign="top" width="15%">';
			// The admin header with dropdown menu
			include( ADMINPATH."header.php" );
			echo '</td>';
		}
		echo '<td width="80%" valign="top" style="border: 1px solid silver;padding:4px;">';
		include( ADMINPATH."toolbar.virtuemart.php" );
		echo '<br style="clear:both;" />';

	}
	/**
	** END: FRONTEND ADMIN - MOD
	*****************************/

	/*****************************
	** BEGIN affiliate additions
	** by nhyde <nhyde@bigDrift.com> for phpShop v0.6.1
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
        $vmDoCaching = ($page=="shop.browse" || $page=="shop.product_details") 
                        && (empty($keyword) && empty($keyword1) && empty($keyword2));
		
        // IE6 PNG transparency fix
        $mainframe->addCustomHeadTag( vmCommonHTML::scriptTag( "$mosConfig_live_site/components/$option/js/sleight.js" ));

		echo '<div id="vmMainPage">'."\n";
		
		// Load requested PAGE
		if( file_exists( PAGEPATH.$modulename.".".$pagename.".php" )) {
			if( $only_page) {
				require_once( CLASSPATH . 'connectionTools.class.php' );
				vmConnector::sendHeaderAndContent( 200 );
				if( $func ) echo vmCommonHTML::getSuccessIndicator( $ok, $vmLogger );
				include( PAGEPATH.$modulename.".".$pagename.".php" );
				// Exit gracefully
				$vm_mainframe->close(true);
			}
			include( PAGEPATH.$modulename.".".$pagename.".php" );
		}
		elseif( file_exists( PAGEPATH . HOMEPAGE.'.php' )) {
			include( PAGEPATH . HOMEPAGE.'.php' );
		}
	    else {
	        include( PAGEPATH.'shop.index.php');
	    }
	    if ( !empty($mosConfig_caching) && $vmDoCaching) {
	        echo '<span class="small">'.$VM_LANG->_LAST_UPDATED.': '.strftime( $vendor_date_format ).'</span>';
	    }
	    
	    echo "\n<div id=\"statusBox\" style=\"text-align:center;display:none;visibility:hidden;\"></div></div>\n";
	    
	    if(SHOWVERSION && !mosGetParam( $_REQUEST, 'pop' )) {
			include(PAGEPATH ."footer.php");
	    }

		// Set debug option on/off
		if (DEBUG) {
			$end = utime();
			$runtime = $end - $start;
			
			include( PAGEPATH . "shop.debug.php" );
		}

}
$vm_mainframe->close();
?>
