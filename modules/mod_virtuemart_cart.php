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

if( $params->get('useGreyBox', 0)) {
	
	vmCommonHTML::loadGreyBox( true );
	$href = $sess->url($mm_action_url."index.php?page=shop.cart");
	$href2 = $sess->url($mm_action_url."index2.php?page=shop.cart");
	echo vmCommonHTML::getGreyboxPopUpLink( $href2, $VM_LANG->_PHPSHOP_CART_SHOW, '', $VM_LANG->_PHPSHOP_CART_TITLE, 'class="mainlevel'.$params->get('class_sfx') .'"', 500, 600, $href );
}
else {
	echo '<a class="mainlevel'.$params->get('class_sfx') .'" href="'.$sess->url($mm_action_url."index.php?page=shop.cart").'">
		'. $VM_LANG->_PHPSHOP_CART_SHOW .'
	</a>';
}

echo '<div class="vmCartModule">';
include (PAGEPATH.'shop.basket_short.php');
echo '</div>'; 

?>