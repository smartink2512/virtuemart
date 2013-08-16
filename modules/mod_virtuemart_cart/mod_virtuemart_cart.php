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

$jsVars  = ' jQuery(document).ready(function(){
	jQuery(".vmCartModule").productUpdate();

});' ;

if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'helpers'.DS.'config.php');

VmConfig::loadConfig();
VmConfig::loadJLang('mod_virtuemart_cart', true);

//This is strange we have the whole thing again in controllers/cart.php public function viewJS()
if(!class_exists('VirtueMartCart')) require(JPATH_VM_SITE.DS.'helpers'.DS.'cart.php');
$cart = VirtueMartCart::getCart(false);
$cart -> prepareCartData();

//$data->totalProduct = $cart->totalProduct;

if(empty($cart)){
	vmError('Cart seems broken');
	return ;
}

if (!class_exists('CurrencyDisplay')) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'currencydisplay.php');
$currencyDisplay = CurrencyDisplay::getInstance( );
$lang = JFactory::getLanguage();
$extension = 'com_virtuemart';
$lang->load($extension);//  when AJAX it needs to be loaded manually here >> in case you are outside virtuemart !!!

if ($cart->cartData['totalProduct']>1) $cart->totalProductTxt = JText::sprintf('COM_VIRTUEMART_CART_X_PRODUCTS', $cart->totalProduct);
else if ($cart->cartData['totalProduct'] == 1) $cart->totalProductTxt = JText::_('COM_VIRTUEMART_CART_ONE_PRODUCT');
else $cart->totalProductTxt = JText::_('COM_VIRTUEMART_EMPTY_CART');
$dataValidated = $cart -> getDataValidated();
if (false && $dataValidated == true) {
	$taskRoute = '&task=confirm';
	$linkName = JText::_('COM_VIRTUEMART_ORDER_CONFIRM_MNU');
} else {
	$taskRoute = '';
	$linkName = JText::_('COM_VIRTUEMART_CART_SHOW');
}
$useSSL = VmConfig::get('useSSL',0);
$useXHTML = true;
$cart->cart_show = '<a style ="float:right;" href="'.JRoute::_("index.php?option=com_virtuemart&view=cart".$taskRoute,$useXHTML,$useSSL).'">'.$linkName.'</a>';
$cart->billTotal = $lang->_('COM_VIRTUEMART_CART_TOTAL').' : <strong>'. $cart->billTotal = $currencyDisplay->priceDisplay( $cart->pricesUnformatted['billTotal'] ) .'</strong>';

//vmJsApi::jPrice();
vmJsApi::cssSite();
$document = JFactory::getDocument();
//$document->addScriptDeclaration($jsVars);
$moduleclass_sfx = $params->get('moduleclass_sfx', '');
$show_price = (bool)$params->get( 'show_price', 1 ); // Display the Product Price?
$show_product_list = (bool)$params->get( 'show_product_list', 1 ); // Display the Product Price?
/* Laod tmpl default */


require(JModuleHelper::getLayoutPath('mod_virtuemart_cart'));
 ?>