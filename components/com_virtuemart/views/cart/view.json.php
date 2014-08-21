<?php

/**
 *
 * View for the shopping cart
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2013 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id$
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// Load the view framework
if(!class_exists('VmViewCart'))require(JPATH_VM_SITE.DS.'helpers'.DS.'vmviewcart.php');

/**
 * View for the shopping cart
 * @package VirtueMart
 * @author Max Milbers, Valérie Isaksen
 */
class VirtueMartViewCart extends VmViewCart {

	public function display($tpl = null) {


		$layoutName = $this->getLayout();
		if (!$layoutName) $layoutName = JRequest::getWord('layout', 'default');
		$this->assignRef('layoutName', $layoutName);
		$format = JRequest::getWord('format');

		if (!class_exists('VirtueMartCart'))
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		$cart = VirtueMartCart::getCart();
		$this->assignRef('cart', $cart);
		if ($cart->layout != VmConfig::get('cartlayout', 'default')) {
			$this->checkout($tpl);
		}


		$this->prepareContinueLink();
		shopFunctionsF::setVmTemplate($this, 0, 0, $layoutName);

		parent::display($tpl);
	}



	private function checkout($tpl) {
		VmConfig::loadJLang('com_virtuemart_shoppers', TRUE);
		if (!class_exists('VirtueMartCart'))
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		$cart = VirtueMartCart::getCart();
		$cart->prepareCartViewData();

		if (VmConfig::get('enable_content_plugin', 0)) {
			shopFunctionsF::triggerContentPlugin($cart->vendor, 'vendor','vendor_terms_of_service');
		}

		$cart->prepareAddressRadioSelection();

		$this->prepareContinueLink();
		$this->lSelectCoupon();
		if (!class_exists ('CurrencyDisplay')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'currencydisplay.php');
		}
		$currencyDisplay = CurrencyDisplay::getInstance($this->cart->pricesCurrency);
		$this->assignRef('currencyDisplay',$currencyDisplay);

		$totalInPaymentCurrency = $this->getTotalInPaymentCurrency();

		$checkoutAdvertise =$this->getCheckoutAdvertise();
		if (!$cart->_inCheckOut and !VmConfig::get('use_as_catalog', 0)) {
			$cart->checkout(false);
		}

		if ($cart->getDataValidated()) {
			if($this->cart->_inConfirm){
				//$pathway->addItem(vmText::_('COM_VIRTUEMART_CANCEL_CONFIRM_MNU'));
				//$document->setTitle(vmText::_('COM_VIRTUEMART_CANCEL_CONFIRM_MNU'));
				$text = vmText::_('COM_VIRTUEMART_CANCEL_CONFIRM');
				$this->checkout_task = 'cancel';
			} else {
				//$pathway->addItem(vmText::_('COM_VIRTUEMART_ORDER_CONFIRM_MNU'));
				//$document->setTitle(vmText::_('COM_VIRTUEMART_ORDER_CONFIRM_MNU'));
				$text = vmText::_('COM_VIRTUEMART_ORDER_CONFIRM_MNU');
				$this->checkout_task = 'confirm';
			}
		} else {
			//$pathway->addItem(JText::_('COM_VIRTUEMART_CART_OVERVIEW'));
			//$document->setTitle(JText::_('COM_VIRTUEMART_CART_OVERVIEW'));
			$text = JText::_('COM_VIRTUEMART_CHECKOUT_TITLE');
			$this->checkout_task = 'checkout';
		}

		if (VmConfig::get('oncheckout_opc', 1)) {
			if (!class_exists('vmPSPlugin')) require(JPATH_VM_PLUGINS . DS . 'vmpsplugin.php');
			JPluginHelper::importPlugin('vmshipment');
			JPluginHelper::importPlugin('vmpayment');
			$this->lSelectShipment();
			//$this->lSelectPayment();
		} else {
			$this->checkPaymentMethodsConfigured();
			$this->checkShipmentMethodsConfigured();
		}

		if ($cart->virtuemart_shipmentmethod_id) {
			$shippingText =  JText::_('COM_VIRTUEMART_CART_CHANGE_SHIPPING');
		} else {
			$shippingText = JText::_('COM_VIRTUEMART_CART_EDIT_SHIPPING');
		}
		$this->assignRef('select_shipment_text', $shippingText);

		if ($cart->virtuemart_paymentmethod_id) {
			$paymentText = JText::_('COM_VIRTUEMART_CART_CHANGE_PAYMENT');
		} else {
			$paymentText = JText::_('COM_VIRTUEMART_CART_EDIT_PAYMENT');
		}
		$this->assignRef('select_payment_text', $paymentText);

		if (!VmConfig::get('use_as_catalog')) {
			//$checkout_link_html = '<a name="'.$checkout_task.'"  class="vm-button-correct" href="javascript:document.checkoutForm.submit();" ><span>' . $text . '</span></a>';
			$checkout_link_html = '<button name="'.$this->checkout_task.'" id="checkoutFormSubmit" class="vm-button-correct"  ><span>' . $text . '</span></button>';
		} else {
			$checkout_link_html = '';
		}
		$this->assignRef('checkout_link_html', $checkout_link_html);

		//set order language
		$lang = JFactory::getLanguage();
		$order_language = $lang->getTag();
		$this->assignRef('order_language',$order_language);
		//dump ($cart,'cart');
		$useSSL = VmConfig::get('useSSL', 0);
		$useXHTML = false;
		$this->assignRef('useSSL', $useSSL);
		$this->assignRef('useXHTML', $useXHTML);
		$this->assignRef('totalInPaymentCurrency', $totalInPaymentCurrency);
		$this->assignRef('checkoutAdvertise', $checkoutAdvertise);
		// @max: quicknirty
		$cart->setCartIntoSession();
		$layoutName = $this->cart->layout;
		shopFunctionsF::setVmTemplate($this, 0, 0, $layoutName);
		$data['cartview'] = $this->loadTemplate($tpl);
		echo json_encode($data);
		JFactory::getApplication()->close();

	}

}

//no closing tag
