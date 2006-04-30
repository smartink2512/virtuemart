<?php
header( 'Content-Type: text/javascript;' );
require( dirname(__FILE__).'/../../../../configuration.php' );
?>
/*
	Feel free to use your custom icons for the tree. Make sure they are all of the same size.
	User icons collections are welcome, we'll publish them giving all regards.
*/

var TREE_TPL = {
	'target'  : '_self',	// name of the frame links will be opened in
							// other possible values are: _blank, _parent, _search, _self and _top

	'icon_e'  : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/empty.gif', // empty image
	'icon_l'  : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/line.gif',  // vertical line

        'icon_32' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/base.gif',   // root leaf icon normal
        'icon_36' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/base.gif',   // root leaf icon selected

	'icon_48' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/base.gif',   // root icon normal
	'icon_52' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/base.gif',   // root icon selected
	'icon_56' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/base.gif',   // root icon opened
	'icon_60' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/base.gif',   // root icon selected
	
	'icon_16' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/folder.gif', // node icon normal
	'icon_20' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/folderopen.gif', // node icon selected
	'icon_24' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/folderopen.gif', // node icon opened
	'icon_28' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/folderopen.gif', // node icon selected opened

	'icon_0'  : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/page.gif', // leaf icon normal
	'icon_4'  : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/page.gif', // leaf icon selected
	
	'icon_2'  : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/joinbottom.gif', // junction for leaf
	'icon_3'  : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/join.gif',       // junction for last leaf
	'icon_18' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/plusbottom.gif', // junction for closed node
	'icon_19' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/plus.gif',       // junctioin for last closed node
	'icon_26' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/minusbottom.gif',// junction for opened node
	'icon_27' : '<?php echo $mosConfig_live_site ?>/components/com_virtuemart/js/tigratree/icons/minus.gif'       // junctioin for last opended node
};
