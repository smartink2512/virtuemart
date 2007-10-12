<?php
/**
* @version $Id$
* @package VirtueMart
* @copyright (C) 2005 MamboTheme.com
* @license http://www.mambotheme.com
* 
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
/* Loads main class file
*/	
global $mosConfig_live_site, $mosConfig_absolute_path;

$live_module_dir = $mosConfig_live_site.'/components/'.VM_COMPONENT_NAME.'/js';
$absolute_module_dir = $mosConfig_absolute_path.'/components/'.VM_COMPONENT_NAME.'/js';

$params->set( 'module_name', 'ShopMenu' );
$params->set( 'module', 'vm_transmenu' );
$params->set( 'absPath', $absolute_module_dir . '/' . $params->get( 'module' ) );
$params->set( 'LSPath', $live_module_dir . '/' . $params->get( 'module' ) );

include_once( $params->get( 'absPath' ) .'/Shop_Menu.php' );

global $my, $db;

$mbtmenu= new Shop_Menu($db, $params);

$mbtmenu->genMenu();

?>