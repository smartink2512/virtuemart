<?php
/**
* @version $Id: mod_mbt_transmenu.php
* @package Mambo
* @copyright (C) 2005 MamboTheme.com
* @license http://www.mambotheme.com
* Mambo is Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
/* Loads main class file
*/	
global $mosConfig_live_site, $mosConfig_absolute_path;

if( vmIsJoomla(1.5) ) {
	$live_module_dir = $mosConfig_live_site.'/modules/'.$module->module;
	$absolute_module_dir = $mosConfig_absolute_path.'/modules/'.$module->module;
} else {
	$live_module_dir = $mosConfig_live_site.'/modules';
	$absolute_module_dir = $mosConfig_absolute_path.'/modules';
}

$params->set( 'module_name', 'ShopMenu' );
$params->set( 'module', 'vm_transmenu' );
$params->set( 'absPath', $absolute_module_dir . '/' . $params->get( 'module' ) );
$params->set( 'LSPath', $live_module_dir . '/' . $params->get( 'module' ) );

include_once( $params->get( 'absPath' ) .'/Shop_Menu.php' );

global $my, $db;

$mbtmenu= new Shop_Menu($db, $params);

$mbtmenu->genMenu();

?>

