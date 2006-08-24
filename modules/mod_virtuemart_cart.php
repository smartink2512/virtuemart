<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* VirtueMart MiniCart Module
*
* @version $Id$
* @package VirtueMart
* @subpackage modules
*
* @copyright (C) 2004-2006 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* VirtueMart is Free Software.
* VirtueMart comes with absolute no warranty.
*
* www.virtuemart.net
*/

/* Load the virtuemart main parse code */
require_once( $mosConfig_absolute_path.'/components/com_virtuemart/virtuemart_parser.php' );

global $VM_LANG, $sess, $mm_action_url, $option;

$moduleID = $params->get('moduleID', 'vmCartModule' );

if( $params->get('useThickBox', 0)) {
	$scripttag = vmCommonHTML::scriptTag( '', 'var thickboxURL = \''.$mosConfig_live_site .'/components/'. $option .'/js/thickbox\';' );
	$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $option .'/js/thickbox/jquery-compressed.js' );
	$scripttag .= vmCommonHTML::scriptTag( $mosConfig_live_site .'/components/'. $option .'/js/thickbox/thickbox.js' );
	$scripttag .= vmCommonHTML::linkTag( $mosConfig_live_site .'/components/'. $option .'/js/thickbox/thickbox.css' );
	
	echo $scripttag;
	
	echo vmCommonHTML::getThickboxPopUpLink( $sess->url($mm_action_url."index2.php?page=shop.cart"), $VM_LANG->_PHPSHOP_CART_SHOW, '', '', 640, 600, true );
}
else {
	echo '<a class="mainlevel'.$params->get('class_sfx') .'" href="'.$sess->url($mm_action_url."index.php?page=shop.cart").'">
		'. $VM_LANG->_PHPSHOP_CART_SHOW .'
	</a>';
}

echo "<div id=\"$moduleID\">";
include (PAGEPATH.'shop.basket_short.php');
echo '</div>'; 

?>