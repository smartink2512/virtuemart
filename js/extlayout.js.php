<?php
/**
* This file provides the Ext Layout for VirtueMart Administration
* It is located here, because this provides an easy way to include it using the standard VirtueMart Call
* and allows to keep the current Session.
*
* @version $Id: compat.joomla1.5.php 1133 2008-01-08 20:40:56Z gregdev $
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
define( '_VALID_MOS', 1);
define( '_JEXEC', 1);

require(dirname(__FILE__).'/../../../configuration.php');
require(dirname(__FILE__).'/../../../administrator/components/com_virtuemart/compat.joomla1.5.php');
require(dirname(__FILE__).'/../../../administrator/components/com_virtuemart/virtuemart.cfg.php');
$vmLogIdentifier = 'extlayout.js.php';
require_once( CLASSPATH . 'Log/LogInit.php' );
require_once(CLASSPATH."DebugUtil.php");
require_once( CLASSPATH . 'language.class.php');
require_once( CLASSPATH . 'ps_main.php');

global $mosConfig_lang;
$mosConfig_lang = $_REQUEST["lang"];

$GLOBALS['VM_LANG'] = $GLOBALS['PHPSHOP_LANG'] =& new vmLanguage();
$VM_LANG->load('common');
if( vmIsJoomla(1.5 )) {
	$mainframe =& JFactory::getApplication('administrator');
	/* @var $mainframe JApplication */
		
	$mainframe->initialise();
} else {
	session_name('virtuemart');
	session_start();
}
header( 'Content-Type: application/x-javascript');

echo "if( typeof Ext == \"undefined\" ) {
			document.location=\"index2.php?option=".VM_COMPONENT_NAME."&vmLayout=standard&usefetchscript=0\";
		}
		// Check if this Window is a duplicate and opens in an iframe
		if( parent.vmLayout )
			if( typeof parent.vmLayout.loadPage == \"function\" ) {
				// then load the pure page, not again the whole VirtueMart Admin interface
				parent.vmLayout.loadPage();
			}
		vmLayout = function(){
    var layout, center;
    var classClicked = function(e, target) {
		if (target.target!='_top' && target.target!='_blank') {
			e.stopEvent();
	        vmLayout.layout.showPanel('vmPage');
	        vmLayout.loadPage(target.href );
		}
	};
    return {
	    init : function(){
	    	try{ Ext.get('header-box').hide(); } catch(e) {} // Hide the Admin Menu under Joomla! 1.5
            
	    	// initialize state manager, we will use cookies
            Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
            
	    	var layout = new Ext.BorderLayout(document.body, {
			    west: {
			        initialSize: 225,
			        animate: true,
			        minSize: 150,
			        maxSize: 400,
			        titlebar: true,
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
			var CP = Ext.ContentPanel;
			
			layout.beginUpdate();
			//layout.add('north', new CP('wrapper', 'North'));
			//layout.add('south', new CP('footer', {title: 'Footer', closable: true}));
			layout.add('west', new CP('vmMenu', {title: '<a style=\'font-weight: bold;\' href=\'index2.php\'>" . addslashes($VM_LANG->_('VM_ADMIN_BACKTOJOOMLA')) . "</a>'}));
			layout.add('center', new CP('vmPage', {title: '" . addslashes($VM_LANG->_('VM_ADMIN_PANELTITLE')) . "', closable: false, fitToFrame:true, tabPosition: 'top'}));
			layout.getRegion(\"center\").on(\"panelactivated\", function(region, panel) { document.title=panel.getTitle() } );
			layout.restoreState();
			layout.endUpdate();

            var vmMenuLinks = Ext.get('masterdiv2');
            vmMenuLinks.on('click', classClicked, null, {delegate: 'a'});
            
            this.layout = layout;
		},

        loadPage : function(page){
        	if( !page || page == '' ) {
        		defaultpage = \"index3.php?option=com_virtuemart&page=store.index\";
        		page = Ext.state.Manager.get( \"vmlastpage\", defaultpage );
        	}
			if( page.indexOf( \"http://virtuemart.net\" ) == -1 ) {
	        	php_self = page.replace(/index2.php/, 'index3.php');
	        	php_self = php_self.replace(/index.php/, 'index3.php');
	        	Ext.get('vmPage').dom.src = php_self + '&only_page=1&no_menu=1';
	        } else {
	        	Ext.get('vmPage').dom.src = page;
            }            
            Ext.state.Manager.set( 'vmlastpage', page );
        }
	}
}();
";

echo "if( Ext.isIE ) Ext.EventManager.addListener( window, 'load', vmLayout.init, vmLayout, true );
	else Ext.onReady( vmLayout.init, vmLayout, true );";
?>
