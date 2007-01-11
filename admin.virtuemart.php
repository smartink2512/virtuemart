<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) {
	die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
}
/**
*
* @version $Id:admin.virtuemart.php 431 2006-10-17 21:55:46 +0200 (Di, 17 Okt 2006) soeren_nb $
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

defined( '_PSHOP_ADMIN' ) or define( '_PSHOP_ADMIN', '1' );

include( dirname(__FILE__).'/compat.joomla1.5.php');

global $VM_LANG;
/*** INSTALLER SECTION ***/
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
/*** END INSTALLER ***/

/* Load the virtuemart main parse code */
require_once( $mosConfig_absolute_path.'/components/'.$option.'/virtuemart_parser.php' );

$vmLayout = $_SESSION['vmLayout'] = mosGetParam( $_SESSION, 'vmLayout', 'extended' );

if( !empty( $_GET['vmLayout'])) {
	$vmLayout = $_SESSION['vmLayout'] = $_GET['vmLayout'] == 'standard' ? $_GET['vmLayout'] : 'extended';
}

$no_menu_default = strstr( $_SERVER['PHP_SELF'], 'index3.php') ? 1 : 0;
$no_menu = $_REQUEST['no_menu'] = mosGetParam( $_REQUEST, 'no_menu', $no_menu_default );

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
	echo '<div align="right" class="menudottedline">';
	if( $vmLayout == 'standard' ) {
		include( ADMINPATH.'toolbar.virtuemart.php');
	} else {
		include( ADMINPATH.'toolbar.php');
	}
	echo '</div>';
}
// Include the Stylesheet
echo '<link rel="stylesheet" href="'.VM_THEMEURL.'admin.styles.css" type="text/css" />';
echo '<link href="'.VM_THEMEURL.'theme.css" type="text/css" rel="stylesheet" media="screen, projection" />';
echo '<script type="text/javascript" src="../components/'.$option.'/js/functions.js"></script>';

if( $no_menu != 1 ) {
	echo '<div id="vmMenu">';	
	include(ADMINPATH.'header.php');
	echo '</div>';
}
if( $only_page != 1 && $vmLayout == 'extended') {
	
	echo '<iframe id="vmPage" name="vmPage" style="width:100%;border: 1px solid silver;padding:4px;"></iframe>';
	vmCommonHTML::loadYUIEXT();
	echo vmCommonHTML::scriptTag('',"var vmLayout = function(){
    var layout, center;
    var classClicked = function(e){
        // find the 'a' element that was clicked
        var a = e.findTarget(null, 'a');
        if(a){
            e.preventDefault();
            vmLayout.loadPage(a.href );
        }  
	};
    return {
	    init : function(){
	    	var layout = new YAHOO.ext.BorderLayout(document.body, {
			    /*north: {
			        split:true,
			        initialSize: 75,
			        titlebar: false,
			        collapsible: true
			    },*/
			    west: {
			        split:true,
			        initialSize: 225,
			        minSize: 150,
			        maxSize: 400,
			        titlebar: true,
			        collapsible: true,
			        autoScroll:true
			    },
			    south: {
			        split:true,
			        initialSize: 50,
			        minSize: 100,
			        maxSize: 200,
			        collapsible: true,
			        autoScroll:true
			    },
			    center: {
			        autoScroll:true,
			        tabPosition: 'top',
			        closeOnTab: true,
					alwaysShowTabs: true,
			        resizeTabs: true,
			        minTabWidth: 50
			    }
			});
			// shorthand
			var CP = YAHOO.ext.ContentPanel;
			
			layout.beginUpdate();
			//layout.add('north', new CP('wrapper', 'North'));
			//layout.add('south', new CP('footer', {title: 'Footer', closable: true}));
			layout.add('west', new CP('vmMenu', {title: '<a style=\'font-weight: bold;\' href=\'{$_SERVER['PHP_SELF']}\'>Back to Joomla! Administration</a>'}));
			layout.add('center', new CP('vmPage', {title: 'VirtueMart Administration Panel', closable: false, fitToFrame:true, tabPosition: 'top'}));
			layout.getRegion('center').showPanel('center');
			layout.endUpdate();

            var vmMenu = getEl('masterdiv2');
            vmMenu.mon('click', classClicked);
            var page = window.location.href.split('#')[1];
            if(!page){
                page = 'index3.php?option=com_virtuemart';
            }
            this.loadPage(page);
            this.layout = layout;
		},

        loadPage : function(page){
            getEl('vmPage').dom.src = page.replace(/index2.php/, 'index3.php') + '&only_page=1&no_menu=1';
        }
	}
}();
YAHOO.ext.EventManager.onDocumentReady(vmLayout.init, vmLayout, true);");
	
} else {
	if( $vmLayout == 'extended' ) {
		echo '<div id="vm-toolbar"></div>';
	
		if( $no_toolbar != 1 ) {
			$bar =& vmToolBar::getInstance('virtuemart');
			$bar->render();
		}
	} else {
		echo '<table width="78%"><tr><td>';
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
			if( @$_REQUEST['format'] == 'raw' ) exit;
		} else {
			include( PAGEPATH.$modulename.".".$pagename.".php" );
		}
	}
	else {
		include( PAGEPATH.'store.index.php' );
	}
	include_once( ADMINPATH. 'version.php' );
	
	if( empty( $no_menu )) {
		echo '<br style="clear:both;"/><div class="smallgrey" align="center">'
	                .$VMVERSION->PRODUCT.' '.$VMVERSION->RELEASE
	                .' (<a href="http://virtuemart.net/index2.php?option=com_versions&amp;catid=1&amp;myVersion='.@$VMVERSION->RELEASE.'" onclick="javascript:void window.open(\'http://virtuemart.net/index2.php?option=com_versions&catid=1&myVersion='.$VMVERSION->RELEASE .'\', \'win2\', \'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=580,directories=no,location=no\'); return false;" title="VirtueMart Version Check" target="_blank">Check for latest version</a>)</div>';
	}
	if( DEBUG == '1' && $no_menu != 1 ) {
	        // Load PAGE
		include( PAGEPATH."shop.debug.php" );
	}
	if( defined( 'vmToolTipCalled')) {
		echo vmCommonHTML::scriptTag( $mosConfig_live_site.'/components/'.$option.'/js/wz_tooltip.js' );
	}
	if( defined( '_LITEBOX_LOADED')) {
		echo vmCommonHTML::scriptTag( '', 'var prev_onload = document.body.onload; 
											window.onload = function() { if( prev_onload ) prev_onload(); initLightbox(); }' );
	}
	if( $vmLayout == 'extended' ) {
		echo '</div>';	
	} else {
		echo '</td></tr></table>';
	}
}
?>