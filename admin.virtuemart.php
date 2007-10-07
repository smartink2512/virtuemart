<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) {
	die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
}
/**
*
* @version $Id:admin.virtuemart.php 431 2006-10-17 21:55:46 +0200 (Di, 17 Okt 2006) soeren_nb $
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

defined( '_PSHOP_ADMIN' ) or define( '_PSHOP_ADMIN', '1' );

include( dirname(__FILE__).'/compat.joomla1.5.php');

global $VM_LANG;
/***********************
 * INSTALLER SECTION *
 **********************
 */
include( $mosConfig_absolute_path.'/administrator/components/com_virtuemart/install.virtuemart.php' );

if (isset($_REQUEST['install_type']) && file_exists( $mosConfig_absolute_path.'/administrator/components/'.$option.'/install.php' )) {
	virtuemart_is_installed();
	include( $mosConfig_absolute_path.'/administrator/components/'.$option.'/install.php' );

	/** can be update and newinstall **/
	$install_type = mosgetparam( $_REQUEST, 'install_type', 'newinstall' );

	/** true or false **/
	$install_sample_data = mosgetparam( $_GET, 'install_sample_data', false );

	installvirtuemart( $install_type, $install_sample_data );
	$error = "";
	$page = "store.index";

	$installfile = dirname( __FILE__ ) . "/install.php";
	if( !@unlink( $installfile ) ) {
		echo "<br /><span class=\"message\">Something went wrong when trying to delete the file <strong>install.php</strong>!<br />";
		echo "You'll have to delete the file manually before being able to use VirtueMart!</span>";
	}

}
elseif( file_exists( $mosConfig_absolute_path.'/administrator/components/'.$option.'/install.php' )) {
	virtuemart_is_installed();
	com_install();
	exit();
	
}
/***********************
 * END INSTALLER SECTION *
 **********************
 */

// Load the virtuemart main parse code
require_once( $mosConfig_absolute_path.'/components/'.$option.'/virtuemart_parser.php' );

// Get the Layout Type from the session
$vmLayout = $_SESSION['vmLayout'] = mosGetParam( $_SESSION, 'vmLayout', 'extended' );
// Change the Layout Type if it is provided through GET
if( !empty( $_GET['vmLayout'])) {
	$vmLayout = $_SESSION['vmLayout'] = $_GET['vmLayout'] == 'standard' ? $_GET['vmLayout'] : 'extended';
}
// pages, which are called through index3.php are PopUps, they should not need a menu (but it can be overridden by $_REQUEST['no_menu'])
$no_menu_default = strstr( $_SERVER['PHP_SELF'], 'index3.php') ? 1 : 0;
$no_menu = $_REQUEST['no_menu'] = mosGetParam( $_REQUEST, 'no_menu', $no_menu_default );

// Display the toolbar?
$no_toolbar = mosGetParam( $_REQUEST, 'no_toolbar', 0 );

// Display just the naked page without toolbar, menu and footer?
$only_page_default = strstr( $_SERVER['PHP_SELF'], 'index3.php') ? 1 : 0;
$only_page = $_REQUEST['only_page'] = mosGetParam( $_REQUEST, 'only_page', $only_page_default );

if( empty( $page ) || empty( $_REQUEST['page'])) {
	if( !empty($_REQUEST['amp;page'])) {
		$page = $_REQUEST['amp;page'];
		foreach( $_REQUEST as $key => $val ) {
			if( strstr( $key, 'amp;')) {
				$key = str_replace( 'amp;', '', $key );
				$_REQUEST[$key] = $val;
			}
		}
	}
	else {
		$page = 'store.index';
	}
}

$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
$limitstart = $mainframe->getUserStateFromRequest( "view{$page}{$product_id}{$category_id}limitstart", 'limitstart', 0 );

if (defined('_DONT_VIEW_PAGE') && !isset($install_type) ) {
    echo "<script type=\"text/javascript\">alert('$error. Your permissions: ".$_SESSION['auth']['perms']."')</script>\n";
}

// renew Page-Information
if( $pagePermissionsOK ) {
	$my_page= explode ( '.', $page );
	$modulename = $my_page[0];
	$pagename = $my_page[1];
	$_SESSION['last_page'] = $page;
}
if( !defined('_VM_TOOLBAR_LOADED') && $no_toolbar != 1 ) {
	if( $vmLayout == 'standard' && strstr($_SERVER['PHP_SELF'], 'index3.php')) {
		echo '<div align="right" class="menudottedline">';
		include_once( ADMINPATH.'toolbar.virtuemart.php');
		echo '</div>';
	} else {
		include( ADMINPATH.'toolbar.php');
	}
	
}
// Include the Stylesheet
$vm_mainframe->addStyleSheet( VM_THEMEURL.'admin.styles.css' );
$vm_mainframe->addStyleSheet( VM_THEMEURL.'theme.css' );
$vm_mainframe->addScript( $mosConfig_live_site.'/components/'.VM_COMPONENT_NAME.'/js/functions.js' );

if( $no_menu != 1 ) {
	
	include(ADMINPATH.'header.php');
	
}
if( $only_page != 1 && $vmLayout == 'extended') {
	
	vmCommonHTML::loadExtjs();
	$vm_mainframe->addScript( $mosConfig_live_site.'/components/com_virtuemart/js/extlayout.js.php');
	
	echo '<iframe id="vmPage" src="'.$mosConfig_live_site.'/administrator/index3.php?option=com_virtuemart&page='.$_SESSION['last_page'].'" style="width:78%;height: 100%; display: block;min-height:500px; border: 1px solid silver;padding:4px;"></iframe>';

} else {
	if( $vmLayout == 'extended' ) {
		echo '<div id="vm-toolbar"></div>';
	
		if( $no_toolbar != 1 ) {
			$bar =& vmToolBar::getInstance('virtuemart');
			$bar->render();
		}
		echo '<div id="vmPage">';
	} else {
		echo '<table width="78%"><tr><td id="vmPage">';
	}
	// Load PAGE
	if( !$pagePermissionsOK ) {
		include( PAGEPATH. ERRORPAGE .'.php');
		return;
	}
		
	if(file_exists(PAGEPATH.$modulename.".".$pagename.".php")) {
		
		if( $only_page ) {
			if( @$_REQUEST['format'] == 'raw' ) while( @ob_end_clean());
			if( $func ) echo vmCommonHTML::getSuccessIndicator( $ok, $vmLogger );
			include( PAGEPATH.$modulename.".".$pagename.".php" );
			if( @$_REQUEST['format'] == 'raw' ) {
				$vm_mainframe->close(true);
			}
		} else {
			include( PAGEPATH.$modulename.".".$pagename.".php" );
		}
	}
	else {
		include( PAGEPATH.'store.index.php' );
	}
	include_once( ADMINPATH. 'version.php' );
	if( !isset( $VMVERSION ) ) {
		$VMVERSION =& new vmVersion();
	}
	
	if( empty( $no_menu )) {
		echo '<br style="clear:both;"/><div class="smallgrey" align="center">'
	                .$VMVERSION->PRODUCT.' '.$VMVERSION->RELEASE
	                .' (<a href="http://virtuemart.net/index2.php?option=com_versions&amp;catid=1&amp;myVersion='.@$VMVERSION->RELEASE.'" onclick="javascript:void window.open(\'http://virtuemart.net/index2.php?option=com_versions&catid=1&myVersion='.$VMVERSION->RELEASE .'\', \'win2\', \'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=580,directories=no,location=no\'); return false;" title="'.$VM_LANG->_VM_VERSIONCHECK_TITLE.'" target="_blank">'.$VM_LANG->_VM_VERSIONCHECK_NOW.'</a>)</div>';
	}
	if( DEBUG == '1' && $no_menu != 1 ) {
	        // Load PAGE
		include( PAGEPATH."shop.debug.php" );
	}
	if( $vmLayout == 'extended' ) {
		echo '</div>';
		if( stristr($page, '_list') && $page != 'product.file_list' ) {
			echo vmCommonHTML::scriptTag('', 'var listItemClicked = function(e){
        // find the <a> element that was clicked
        var a = e.getTarget(null, "a");
        try {
	        if(a && typeof a.onclick == "undefined" && a.href.indexOf("javascript:") == -1 && a.href.indexOf("func=") == -1 ) {
	            e.preventDefault();
	            parent.addSimplePanel( a.title != "" ? a.title : a.innerHTML, a.href );
	        }  
	     } catch(e) {}
	};
	Ext.get("vmPage").mon("click", listItemClicked );');
		}
	} else {
		echo '</td></tr></table>';
	}
}
$vm_mainframe->close();
?>