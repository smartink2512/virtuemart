<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
* mambo-phphop Product Categories Module
* NOTE: THIS MODULE REQUIRES AN INSTALLED MAMBO-PHPSHOP COMPONENT!
*
* @version $Id$
* @package VirtueMart
* @subpackage modules
* 
* @copyright (C) 2004-2005 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* VirtueMart is Free Software.
* VirtueMart comes with absolute no warranty.
*
* www.virtuemart.net
*/
global $jscook_type, $jscookMenu_style, $jscookTree_style;

// Load the virtuemart main parse code
if( file_exists(dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' )) {
	require_once( dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' );
} else {
	require_once( dirname(__FILE__).'/../components/com_virtuemart/virtuemart_parser.php' );
}

$category_id = vmGet( $_REQUEST, 'category_id');

/* Get module parameters */
$class_sfx = $params->get( 'class_sfx', "" );
$menutype = $params->get( 'menutype', "links" );
$jscookMenu_style = $params->get( 'jscookMenu_style', 'ThemeOffice' );
$jscookTree_style = $params->get( 'jscookTree_style', 'ThemeXP' );
$jscook_type = $params->get( 'jscook_type', 'menu' );
$menu_orientation = $params->get( 'menu_orientation', 'hbr' );
$_REQUEST['root_label'] = $params->get( 'root_label', 'Shop' );

$class_mainlevel = "mainlevel".$class_sfx;

global $VM_LANG, $sess;

if ( $menutype == 'links' ) {
	/* MENUTPYE LINK LIST */
	require_once(CLASSPATH.'ps_product_category.php');
	$ps_product_category = new ps_product_category();

	echo $ps_product_category->get_category_tree( $category_id, $class_mainlevel );

}
elseif( $menutype == "transmenu" ) {
	/* TransMenu script to display a DHTML Drop-Down Menu */
	include( $mosConfig_absolute_path . '/components/'.VM_COMPONENT_NAME.'/js/vm_transmenu.php' );

}
elseif( $menutype == "dtree" ) {
	/* dTree script to display structured categories */
	include( $mosConfig_absolute_path . '/components/'.VM_COMPONENT_NAME.'/js/vm_dtree.php' );

}
elseif( $menutype == "jscook" ) {
	/* JSCook Script to display structured categories */
	include( $mosConfig_absolute_path . '/components/'.VM_COMPONENT_NAME.'/js/vm_JSCook.php' );

}
elseif( $menutype == "tigratree" ) {
	/* TigraTree script to display structured categories */
	include( $mosConfig_absolute_path . '/components/'.VM_COMPONENT_NAME.'/js/vm_tigratree.php' );
}

 ?>