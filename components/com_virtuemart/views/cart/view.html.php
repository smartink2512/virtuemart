<?php

/**
 *
 * View for the shopping cart
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers
 * @author Oscar van Eijk
 * @author RolandD
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: view.html.php 6292 2012-07-20 12:27:44Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// Load the view framework
if(!class_exists('VmViewCart'))require(JPATH_VM_SITE.DS.'helpers'.DS.'vmviewcart.php');

/**
 * View for the shopping cart
 * @package VirtueMart
 * @author Max Milbers
 * @author Patrick Kohl
 */
class VirtueMartViewCart extends VmViewCart {

	public function display($tpl = null) {
		$mainframe = JFactory::getApplication();
		$pathway = $mainframe->getPathway();
		$document = JFactory::getDocument();
		$document->setMetaData('robots','NOINDEX, NOFOLLOW, NOARCHIVE, NOSNIPPET');

		// add javascript for price and cart, need even for quantity buttons, so we need it almost anywhere
		//vmJsApi::jPrice();

		$layoutName = $this->getLayout();
		if (!$layoutName) $layoutName = JRequest::getWord('layout', 'default');
		$this->assignRef('layoutName', $layoutName);
		$format = vRequest::getCmd('format');

		if (!class_exists('VirtueMartCart'))
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		$cart = VirtueMartCart::getCart();
		//$cart->getCartPrices();
		$this->assignRef('cart', $cart);

		// this has been moved because of payment cart layout: the cart content is always displayed
		if (!class_exists ('CurrencyDisplay')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'currencydisplay.php');
		}
		$currencyDisplay = CurrencyDisplay::getInstance($this->cart->pricesCurrency);
		$this->assignRef('currencyDisplay',$currencyDisplay);

		//Why is this here, when we have view.raw.php
		if ($format == 'raw') {
			$cart->prepareCartViewData();
			JRequest::setVar('layout', 'mini_cart');
			$this->setLayout('mini_cart');
			$this->prepareContinueLink();
		}

		/*
	  if($layoutName=='edit_coupon'){

		$cart->prepareCartViewData();
		$this->lSelectCoupon();
		$pathway->addItem(JText::_('COM_VIRTUEMART_CART_OVERVIEW'),JRoute::_('index.php?option=com_virtuemart&view=cart'));
		$pathway->addItem(JText::_('COM_VIRTUEMART_CART_SELECTCOUPON'));
		$document->setTitle(JText::_('COM_VIRTUEMART_CART_SELECTCOUPON'));

		} else */
		if ($layoutName == 'select_shipment') {
			$cart->prepareCartViewData();
			if (!class_exists('vmPSPlugin')) require(JPATH_VM_PLUGINS . DS . 'vmpsplugin.php');
			JPluginHelper::importPlugin('vmshipment');
			$this->lSelectShipment();

			$pathway->addItem(JText::_('COM_VIRTUEMART_CART_OVERVIEW'), JRoute::_('index.php?option=com_virtuemart&view=cart', FALSE));
			$pathway->addItem(JText::_('COM_VIRTUEMART_CART_SELECTSHIPMENT'));
			$document->setTitle(JText::_('COM_VIRTUEMART_CART_SELECTSHIPMENT'));
		} else if ($layoutName == 'select_payment') {

			/* Load the cart helper */
			//			$cartModel = VmModel::getModel('cart');
			$cart->prepareCartViewData();
			$this->lSelectPayment();

			$pathway->addItem(JText::_('COM_VIRTUEMART_CART_OVERVIEW'), JRoute::_('index.php?option=com_virtuemart&view=cart', FALSE));
			$pathway->addItem(JText::_('COM_VIRTUEMART_CART_SELECTPAYMENT'));
			$document->setTitle(JText::_('COM_VIRTUEMART_CART_SELECTPAYMENT'));
		} else if ($layoutName == 'order_done') {
			VmConfig::loadJLang('com_virtuemart_shoppers', TRUE);
			$this->lOrderDone();

			$pathway->addItem(JText::_('COM_VIRTUEMART_CART_THANKYOU'));
			$document->setTitle(JText::_('COM_VIRTUEMART_CART_THANKYOU'));
		} else  {
			VmConfig::loadJLang('com_virtuemart_shoppers', TRUE);

			$cart->prepareCartViewData();

			if (VmConfig::get('enable_content_plugin', 0)) {
				shopFunctionsF::triggerContentPlugin($cart->vendor, 'vendor','vendor_terms_of_service');
			}

			$cart->prepareAddressRadioSelection();

			$this->prepareContinueLink();
			$this->lSelectCoupon();


			$totalInPaymentCurrency = $this->getTotalInPaymentCurrency();

			$checkoutAdvertise =$this->getCheckoutAdvertise();
			if (!$cart->_inCheckOut and !VmConfig::get('use_as_catalog', 0)) {
				$cart->checkout(false);
			}

			if ($cart->getDataValidated()) {
				if($this->cart->_inConfirm){
					$pathway->addItem(vmText::_('COM_VIRTUEMART_CANCEL_CONFIRM_MNU'));
					$document->setTitle(vmText::_('COM_VIRTUEMART_CANCEL_CONFIRM_MNU'));
					$text = vmText::_('COM_VIRTUEMART_CANCEL_CONFIRM');
					$this->checkout_task = 'cancel';
				} else {
					$pathway->addItem(vmText::_('COM_VIRTUEMART_ORDER_CONFIRM_MNU'));
					$document->setTitle(vmText::_('COM_VIRTUEMART_ORDER_CONFIRM_MNU'));
					$text = vmText::_('COM_VIRTUEMART_ORDER_CONFIRM_MNU');
					$this->checkout_task = 'confirm';
				}
			} else {
				$pathway->addItem(JText::_('COM_VIRTUEMART_CART_OVERVIEW'));
				$document->setTitle(JText::_('COM_VIRTUEMART_CART_OVERVIEW'));
				$text = JText::_('COM_VIRTUEMART_CHECKOUT_TITLE');
				$this->checkout_task = 'checkout';
			}

			if (VmConfig::get('oncheckout_opc', 1)) {
				if (!class_exists('vmPSPlugin')) require(JPATH_VM_PLUGINS . DS . 'vmpsplugin.php');
				JPluginHelper::importPlugin('vmshipment');
				JPluginHelper::importPlugin('vmpayment');
				$this->lSelectShipment();
				$this->lSelectPayment();
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

			$layoutName = $this->cart->layout;
			//set order language
			$lang = JFactory::getLanguage();
			$order_language = $lang->getTag();
			$this->assignRef('order_language',$order_language);
		}
		//dump ($cart,'cart');
		$useSSL = VmConfig::get('useSSL', 0);
		$useXHTML = false;
		$this->assignRef('useSSL', $useSSL);
		$this->assignRef('useXHTML', $useXHTML);
		$this->assignRef('totalInPaymentCurrency', $totalInPaymentCurrency);
		$this->assignRef('checkoutAdvertise', $checkoutAdvertise);
		// @max: quicknirty
		$cart->setCartIntoSession();
		//$this->setLayout($this->cart->layout);
		shopFunctionsF::setVmTemplate($this, 0, 0, $layoutName);

		//We never want that the cart is indexed
		$document->setMetaData('robots','NOINDEX, NOFOLLOW, NOARCHIVE, NOSNIPPET');

		if($this->cart->_inConfirm) vmInfo('COM_VIRTUEMART_IN_CONFIRM');


		parent::display($tpl);
	}


	

}

//no closing tag
