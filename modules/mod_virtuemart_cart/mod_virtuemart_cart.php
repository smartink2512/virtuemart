<?php
defined('_JEXEC') or  die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/*
*Cart Ajax Module
*
* @version $Id$
* @package VirtueMart
* @subpackage modules
*
* 	@copyright (C) 2010 - Patrick Kohl
// W: demo.st42.fr
// E: cyber__fr|at|hotmail.com
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* VirtueMart is Free Software.
* VirtueMart comes with absolute no warranty.
*
* www.virtuemart.net
*/

if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'helpers'.DS.'config.php');

VmConfig::loadConfig();
VmConfig::loadJLang('mod_virtuemart_cart', true);
VmConfig::loadJLang('com_virtuemart', true);

//This is strange we have the whole thing again in controllers/cart.php public function viewJS()
if(!class_exists('VirtueMartCart')) require(JPATH_VM_SITE.DS.'helpers'.DS.'cart.php');
$cart = VirtueMartCart::getCart(false);
$data = $cart -> prepareAjaxData();

if (!class_exists('CurrencyDisplay'))
	require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'currencydisplay.php');
$currencyDisplay = CurrencyDisplay::getInstance();

vmJsApi::cssSite();

$moduleclass_sfx = $params->get('moduleclass_sfx', '');
$show_price = (bool)$params->get( 'show_price', 1 ); // Display the Product Price?
$show_product_list = (bool)$params->get( 'show_product_list', 1 ); // Display the Product Price?
/* Laod tmpl default */
require(JModuleHelper::getLayoutPath('mod_virtuemart_cart'));
 ?>