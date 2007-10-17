<?php
define( '_VALID_MOS', 1);
define( '_JEXEC', 1);

require(dirname(__FILE__).'/../../../configuration.php');
require(dirname(__FILE__).'/../../../administrator/components/com_virtuemart/compat.joomla1.5.php');
require(dirname(__FILE__).'/../../../administrator/components/com_virtuemart/virtuemart.cfg.php');
require_once( CLASSPATH . 'language.class.php');
require_once( CLASSPATH . 'ps_main.php');
// load the Language File
if (file_exists( ADMINPATH. 'languages/'.basename($mosConfig_lang).'.php' )) {
	require_once( ADMINPATH. 'languages/'.basename($mosConfig_lang).'.php' );
}
else {
	require_once( ADMINPATH. 'languages/english.php' );
}
session_name('virtuemart');
session_start();
header( 'Content-Type: application/x-javascript;');
echo "vmLayout = function(){
    var layout, center;
    var classClicked = function(e, target){            
        vmLayout.layout.showPanel('vmPage');
        vmLayout.loadPage(target.href );
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
			layout.add('west', new CP('vmMenu', {title: '<a style=\'font-weight: bold;\' href=\'index2.php\'>{$VM_LANG->_VM_ADMIN_BACKTOJOOMLA}</a>'}));
			layout.add('center', new CP('vmPage', {title: '{$VM_LANG->_VM_ADMIN_PANELTITLE}', closable: false, fitToFrame:true, tabPosition: 'top'}));
			
			//layout.restoreState();
			layout.endUpdate();

            var vmMenuLinks = Ext.get('masterdiv2');
            vmMenuLinks.on('click', classClicked, null, {delegate: 'a', stopEvent:true});
            
            if( getURLParam('page') != '' ) {
            	page = 'index3.php?option=com_virtuemart&page=' + getURLParam('page');
            }
            else {
                page = 'index3.php?option=com_virtuemart&page=store.index';
            }         
            if( page != Ext.get('vmPage').dom.src ) {
               this.loadPage(page);
            }
            this.layout = layout;
		},

        loadPage : function(page){

        	php_self = page.replace(/index2.php/, 'index3.php');
        	php_self = php_self.replace(/index.php/, 'index3.php');
            Ext.get('vmPage').dom.src = php_self + '&only_page=1&no_menu=1';
        }
	}
}();
";
if( !class_exists('jconfig')) {
	echo "if( Ext.isIE ) Ext.EventManager.addListener( window, 'load', vmLayout.init, vmLayout, true );
	else Ext.onReady( vmLayout.init, vmLayout, true );";
} else {
	echo "Ext.onReady( vmLayout.init, vmLayout, true );
";
}
?>