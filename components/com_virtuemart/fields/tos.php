<?php

/**
 *
 * field tos
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL2, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: cart.php 7682 2014-02-26 17:07:20Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$_return['fields'][$_fld->name]['formcode'] = '<input type="checkbox" name="'
						. $_prefix.$_fld->name . '" id="' . $_prefix.$_fld->name . '_field" value="1" '
. ($_return['fields'][$_fld->name]['value'] ? 'checked="checked"' : '') .'/>';

vmJsApi::popup('#full-tos','#terms-of-service');
if (!class_exists('VirtueMartCart')) require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
$cart = VirtuemartCart::getCart();
$cart->prepareVendor();
if(!class_exists('VmHtml')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'html.php');
if(is_array($cart->BT) and isset($cart->BT['tos'])){
	$tos = $cart->BT['tos'];
} else {
	$tos = 0;
}

$_return['fields'][$_fld->name]['formcode'] = VmHtml::checkbox ('tos', $tos, 1, 0, 'class="terms-of-service"');

if (VmConfig::get ('oncheckout_show_legal_info', 1)) {
$_return['fields'][$_fld->name]['formcode'] .= '
<div class="terms-of-service">

	<label for="tos">
		<a href="'.JRoute::_ ('index.php?option=com_virtuemart&view=vendor&layout=tos&virtuemart_vendor_id=1', FALSE) .'" class="terms-of-service" id="terms-of-service" rel="facebox"
		   target="_blank">
			<span class="vmicon vm2-termsofservice-icon"></span>
			' . vmText::_ ('COM_VIRTUEMART_CART_TOS_READ_AND_ACCEPTED') . '
		</a>
	</label>

	<div id="full-tos">
		<h2>' . vmText::_ ('COM_VIRTUEMART_CART_TOS') .'</h2>'.
		$cart->vendor->vendor_terms_of_service.
		'</div>
</div>';
}