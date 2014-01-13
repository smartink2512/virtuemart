<?php

/**
 *
 * Controller for the cart
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author RolandD
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id$
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// Load the controller framework
jimport('joomla.application.component.controller');

/**
 * Controller for the cart view
 *
 * @package VirtueMart
 * @subpackage Cart
 * @author RolandD
 * @author Max Milbers
 */
class VirtueMartControllerCart extends JControllerLegacy {

	/**
	 * Construct the cart
	 *
	 * @access public
	 * @author Max Milbers
	 */
	public function __construct() {
		parent::__construct();
		if (VmConfig::get('use_as_catalog', 0)) {
			$app = JFactory::getApplication();
			$app->redirect('index.php');
		} else {
			if (!class_exists('VirtueMartCart'))
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
			if (!class_exists('calculationHelper'))
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'calculationh.php');
		}
		$this->useSSL = VmConfig::get('useSSL', 0);
		$this->useXHTML = true;
	}

	/**
	 * Override of display
	 *
	 * @return  JController  A JController object to support chaining.
	 *
	 * @since   11.1
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$document = JFactory::getDocument();
		$viewType = $document->getType();
		$viewName = VmRequest::getCmd('view', $this->default_view);
		$viewLayout = VmRequest::getCmd('layout', 'default');

		$view = $this->getView($viewName, $viewType, '', array('layout' => $viewLayout));

		$view->assignRef('document', $document);

		vmdebug('checkout my post, get and so on',$_POST,$_GET);

		$cart = VirtueMartCart::getCart();
		$cart->getFilterCustomerComment();
		$cart->tosAccepted = VmRequest::getInt('tosAccepted', $cart->tosAccepted);

		$cart->updateProductCart();
		$this->setcoupon();

		$virtuemart_shipmentmethod_id = VmRequest::getInt('virtuemart_shipmentmethod_id', 0);
		$cart->setShipment($virtuemart_shipmentmethod_id);

		$virtuemart_paymentmethod_id = VmRequest::getInt('virtuemart_paymentmethod_id', 0);
		$cart->setPaymentMethod($virtuemart_paymentmethod_id);


		if($cart && !VmConfig::get('use_as_catalog', 0)){
			if (isset($_POST['checkout'])) {
				$cart->checkout();
			} else if(isset($_POST['confirm'])){
				$cart->confirmDone();
				$view = $this->getView('cart', 'html');
				$view->setLayout('order_done');
				$view->display();
				return true;
			}
		}
		//$this->display();
		$view->display();

		return $this;
	}

	/**
	 * Add the product to the cart
	 *
	 * @author RolandD
	 * @author Max Milbers
	 * @access public
	 */
	public function add() {
		$mainframe = JFactory::getApplication();
		if (VmConfig::get('use_as_catalog', 0)) {
			$msg = vmText::_('COM_VIRTUEMART_PRODUCT_NOT_ADDED_SUCCESSFULLY');
			$type = 'error';
			$mainframe->redirect('index.php', $msg, $type);
		}
		$cart = VirtueMartCart::getCart();
		if ($cart) {
			$virtuemart_product_ids = VmRequest::getInt('virtuemart_product_id');
			$success = true;
			if ($cart->add($virtuemart_product_ids,$success)) {
				$msg = vmText::_('COM_VIRTUEMART_PRODUCT_ADDED_SUCCESSFULLY');
				$type = '';
			} else {
				$msg = vmText::_('COM_VIRTUEMART_PRODUCT_NOT_ADDED_SUCCESSFULLY');
				$type = 'error';
			}

			$mainframe->enqueueMessage($msg, $type);
			$mainframe->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart', FALSE));

		} else {
			$mainframe->enqueueMessage('Cart does not exist?', 'error');
		}
	}

	/**
	 * Add the product to the cart, with JS
	 *
	 * @author Max Milbers
	 * @access public
	 */
	public function addJS() {

		$this->json = new stdClass();
		$cart = VirtueMartCart::getCart(false);
		if ($cart) {
			$view = $this->getView ('cart', 'json');
			$virtuemart_category_id = shopFunctionsF::getLastVisitedCategoryId();
			if ($virtuemart_category_id) {
				$categoryLink = '&view=category&virtuemart_category_id=' . $virtuemart_category_id;
			}
			$categoryLink = '';
			$continue_link = JRoute::_('index.php?option=com_virtuemart' . $categoryLink);
			//VmConfig::$echoDebug=true;
			$virtuemart_product_ids = VmRequest::getInt('virtuemart_product_id', array());
			//vmdebug('vmRequest get ',$virtuemart_product_ids);
			//VmConfig::$echoDebug=false;jExit();
			$view = $this->getView ('cart', 'json');
			$errorMsg = 0;//vmText::_('COM_VIRTUEMART_CART_PRODUCT_ADDED');

			$product = $cart->add($virtuemart_product_ids, $errorMsg );
			if ($product) {
				$view->setLayout('padded');
				$this->json->stat = '1';
			} else {
				$view->setLayout('perror');
				$this->json->stat = '2';
			}
			$view->assignRef('product',$product);
			$view->assignRef('errorMsg',$errorMsg);
			ob_start();
			$view->display ();
			$this->json->msg = ob_get_clean();
		} else {
			$this->json->msg = '<a href="' . JRoute::_('index.php?option=com_virtuemart', FALSE) . '" >' . vmText::_('COM_VIRTUEMART_CONTINUE_SHOPPING') . '</a>';
			$this->json->msg .= '<p>' . vmText::_('COM_VIRTUEMART_MINICART_ERROR') . '</p>';
			$this->json->stat = '0';
		}
		echo json_encode($this->json);
		jExit();
	}

	/**
	 * Add the product to the cart, with JS
	 *
	 * @author Max Milbers
	 * @access public
	 */
	public function viewJS() {

		if (!class_exists('VirtueMartCart'))
		require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		$cart = VirtueMartCart::getCart(false);
		$cart -> prepareCartData();
		$data = $cart -> prepareAjaxData(true);

		echo json_encode($data);
		Jexit();
	}

	/**
	 * For selecting couponcode to use, opens a new layout
	 *
	 * @author Max Milbers
	 */
	public function edit_coupon() {

		$view = $this->getView('cart', 'html');
		$view->setLayout('edit_coupon');

		// Display it all
		$view->display();
	}

	/**
	 * Store the coupon code in the cart
	 * @author Max Milbers
	 */
	public function setcoupon() {

		/* Get the coupon_code of the cart */
		$coupon_code = VmRequest::getVar('coupon_code', ''); //TODO VAR OR INT OR WORD?
		if ($coupon_code) {

			$cart = VirtueMartCart::getCart();
			if ($cart) {
				$app = JFactory::getApplication();
				$msg = $cart->setCouponCode($coupon_code);

				//$cart->setDataValidation(); //Not needed already done in the getCart function
				/*if ($cart->getInCheckOut()) {
					$app = JFactory::getApplication();
					$app->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart&task=checkout', FALSE),$msg);
				} else {*/
					$app->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart', FALSE),$msg);
				//}
			}
		}
		//$this->display();

	}

	/**
	 * For selecting shipment, opens a new layout
	 *
	 * @author Max Milbers
	 */
	public function edit_shipment() {


		$view = $this->getView('cart', 'html');
		$view->setLayout('select_shipment');

		// Display it all
		$view->display();
	}

	/**
	 * To select a payment method
	 *
	 * @author Max Milbers
	 */
	public function editpayment() {

		$view = $this->getView('cart', 'html');
		$view->setLayout('select_payment');

		// Display it all
		$view->display();
	}

	/**
	 * Delete a product from the cart
	 *
	 * @author RolandD
	 * @access public
	 */
	public function delete() {
		$mainframe = JFactory::getApplication();
		/* Load the cart helper */
		$cart = VirtueMartCart::getCart();
		if ($cart->removeProductCart())
		$mainframe->enqueueMessage(vmText::_('COM_VIRTUEMART_PRODUCT_REMOVED_SUCCESSFULLY'));
		else
		$mainframe->enqueueMessage(vmText::_('COM_VIRTUEMART_PRODUCT_NOT_REMOVED_SUCCESSFULLY'), 'error');

		$mainframe->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart', FALSE));
	}

	/**
	 * Change the shopper
	 *
	 * @author Maik K�nnemann
	 *
	 */
	public function changeShopper() {
		JSession::checkToken () or jexit ('Invalid Token');

		//check for permissions
		if(!JFactory::getUser(JFactory::getSession()->get('vmAdminID'))->authorise('core.admin', 'com_virtuemart') || !VmConfig::get ('oncheckout_change_shopper')){
			$mainframe = JFactory::getApplication();
			$mainframe->enqueueMessage(vmText::sprintf('COM_VIRTUEMART_CART_CHANGE_SHOPPER_NO_PERMISSIONS', $newUser->name .' ('.$newUser->username.')'), 'error');
			$mainframe->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart'));
		}

		//get data of current and new user
		$usermodel = VmModel::getModel('user');
		$user = $usermodel->getCurrentUser();
		$newUser = JFactory::getUser(VmRequest::getCmd('userID'));

		//update session
		$session = JFactory::getSession();
		$adminID = $session->get('vmAdminID');
		if(!isset($adminID)) $session->set('vmAdminID', $user->virtuemart_user_id);
		$session->set('user', $newUser);

		//update cart data
		$cart = VirtueMartCart::getCart();
		$data = $usermodel->getUserAddressList(VmRequest::getCmd('userID'), 'BT');
		foreach($data[0] as $k => $v) {
			$data[$k] = $v;
		}
		$cart->BT['email'] = $newUser->email;
		unset($cart->ST);
		$cart->saveAddressInCart($data, 'BT');

		$mainframe = JFactory::getApplication();
		$mainframe->enqueueMessage(vmText::sprintf('COM_VIRTUEMART_CART_CHANGED_SHOPPER_SUCCESSFULLY', $newUser->name .' ('.$newUser->username.')'), 'info');
		$mainframe->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart'));
	}


	function cancel() {

		$cart = VirtueMartCart::getCart();
		if ($cart) {
			$cart->setOutOfCheckout();
		}
		$mainframe = JFactory::getApplication();
		$mainframe->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart', FALSE), 'Cancelled');
	}

}

//pure php no Tag
