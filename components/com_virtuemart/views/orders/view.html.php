<?php
/**
 *
 * Handle the orders view
 *
 * @package	VirtueMart
 * @subpackage Orders
 * @author Oscar van Eijk
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

// Load the view framework
if(!class_exists('VmView'))require(JPATH_VM_SITE.DS.'helpers'.DS.'vmview.php');

// Set to '0' to use tabs i.s.o. sliders
// Might be a config option later on, now just here for testing.
define ('__VM_ORDER_USE_SLIDERS', 0);

/**
 * Handle the orders view
 */
class VirtuemartViewOrders extends VmView {

	public function display($tpl = null)
	{
		$mainframe = JFactory::getApplication();
		$pathway = $mainframe->getPathway();
		$task = JRequest::getWord('task', 'list');

		$layoutName = JRequest::getWord('layout', 'list');

		$this->setLayout($layoutName);

		$_currentUser = JFactory::getUser();
		$document = JFactory::getDocument();

		if(!empty($tpl)){
			$format = $tpl;
		} else {
			$format = JRequest::getWord('format', 'html');
		}
		$this->assignRef('format', $format);

		if($format=='pdf'){
			$document->setTitle( JText::_('COM_VIRTUEMART_INVOICE') );

			//PDF needs more RAM than usual
			$memory_limit = ini_get('memory_limit');
			if($memory_limit<40)  @ini_set( 'memory_limit', '40M' );

		} else {
		    if ($layoutName == 'details') {
			$document->setTitle( JText::_('COM_VIRTUEMART_ACC_ORDER_INFO') );
			$pathway->additem(JText::_('COM_VIRTUEMART_ACC_ORDER_INFO'));
		    } else {
			$document->setTitle( JText::_('COM_VIRTUEMART_ORDERS_VIEW_DEFAULT_TITLE') );
			$pathway->additem(JText::_('COM_VIRTUEMART_ORDERS_VIEW_DEFAULT_TITLE'));
		    }
		}

		$orderModel = VmModel::getModel('orders');

		if ($layoutName == 'details') {
			$order_list_link = false;
 			$cuid = $_currentUser->get('id');
// 			if(!empty($cuid)){
				$order_list_link = JRoute::_('index.php?option=com_virtuemart&view=orders&layout=list');
// 			} else {
// 				$order_list_link = false;
// 				$order_list_link = JRoute::_('index.php?option=com_virtuemart&view=orders');;
// 			}
			$this->assignRef('order_list_link', $order_list_link);
			if(empty($cuid)){
				// If the user is not logged in, we will check the order number and order pass
				if ($orderPass = JRequest::getString('order_pass',false)){
					$orderNumber = JRequest::getString('order_number',false);
					$orderId = $orderModel->getOrderIdByOrderPass($orderNumber,$orderPass);
					if(empty($orderId)){
						echo JText::_('COM_VIRTUEMART_RESTRICTED_ACCESS');
						return;
					}
					$orderDetails = $orderModel->getOrder($orderId);
				}
			}
			else {
				// If the user is logged in, we will check if the order belongs to him
				$virtuemart_order_id = JRequest::getInt('virtuemart_order_id',0) ;
				if (!$virtuemart_order_id) {
					$virtuemart_order_id = $orderModel->getOrderIdByOrderNumber(JRequest::getString('order_number'));
				}
				$orderDetails = $orderModel->getOrder($virtuemart_order_id);

				if(!class_exists('Permissions')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'permissions.php');
				if(!Permissions::getInstance()->check("admin")) {
					if(!empty($orderDetails['details']['BT']->virtuemart_user_id)){
						if ($orderDetails['details']['BT']->virtuemart_user_id != $cuid) {
							echo JText::_('COM_VIRTUEMART_RESTRICTED_ACCESS');
							return;
						}
					}
				}

			}

			if(empty($orderDetails['details'])){
				echo JText::_('COM_VIRTUEMART_ORDER_NOTFOUND');
				return;
			}

			$userFieldsModel = VmModel::getModel('userfields');
			$_userFields = $userFieldsModel->getUserFields(
				 'account'
			, array('captcha' => true, 'delimiters' => true) // Ignore these types
			, array('delimiter_userinfo','user_is_vendor' ,'username','password', 'password2', 'agreed', 'address_type') // Skips
			);
			$orderbt = $orderDetails['details']['BT'];
			$orderst = (array_key_exists('ST', $orderDetails['details'])) ? $orderDetails['details']['ST'] : $orderbt;
			$userfields = $userFieldsModel->getUserFieldsFilled(
			$_userFields
			,$orderbt
			);
			$_userFields = $userFieldsModel->getUserFields(
				 'shipment'
			, array() // Default switches
			, array('delimiter_userinfo', 'username', 'email', 'password', 'password2', 'agreed', 'address_type') // Skips
			);

			$shipmentfields = $userFieldsModel->getUserFieldsFilled(
			$_userFields
			,$orderst
			);

			$shipment_name='';
			if (!class_exists('vmPSPlugin')) require(JPATH_VM_PLUGINS . DS . 'vmpsplugin.php');
			JPluginHelper::importPlugin('vmshipment');
			$dispatcher = JDispatcher::getInstance();
			$returnValues = $dispatcher->trigger('plgVmOnShowOrderFEShipment',array(  $orderDetails['details']['BT']->virtuemart_order_id, $orderDetails['details']['BT']->virtuemart_shipmentmethod_id, &$shipment_name));

			$payment_name='';
			if(!class_exists('vmPSPlugin')) require(JPATH_VM_PLUGINS.DS.'vmpsplugin.php');
			JPluginHelper::importPlugin('vmpayment');
			$dispatcher = JDispatcher::getInstance();
			$returnValues = $dispatcher->trigger('plgVmOnShowOrderFEPayment',array( $orderDetails['details']['BT']->virtuemart_order_id, $orderDetails['details']['BT']->virtuemart_paymentmethod_id,  &$payment_name));

			if($format=='pdf'){

				$invoiceNumber = $orderModel->createInvoiceNumber($orderDetails['details']['BT']);
				$this->assignRef('invoiceNumber', $invoiceNumber);
			}

			$this->assignRef('userfields', $userfields);
			$this->assignRef('shipmentfields', $shipmentfields);
			$this->assignRef('shipment_name', $shipment_name);
			$this->assignRef('payment_name', $payment_name);
			$this->assignRef('orderdetails', $orderDetails);

			$tmpl = JRequest::getWord('tmpl');
			$print = false;
			if($tmpl){
				$print = true;
			}
			$this->prepareVendor();
			$this->assignRef('print', $print);

			// Implement the Joomla panels. If we need a ShipTo tab, make it the active one.
			// In tmpl/edit.php, this is the 4th tab (0-based, so set to 3 above)
			// jimport('joomla.html.pane');
			// $pane = JPane::getInstance((__VM_ORDER_USE_SLIDERS?'Sliders':'Tabs'));
			// $this->assignRef('pane', $pane);
		} else { // 'list' -. default
			$useSSL = VmConfig::get('useSSL',0);
			$useXHTML = true;
			$this->assignRef('useSSL', $useSSL);
			$this->assignRef('useXHTML', $useXHTML);
			if ($_currentUser->get('id') == 0) {
				// getOrdersList() returns all orders when no userID is set (admin function),
				// so explicetly define an empty array when not logged in.
				$orderList = array();
			} else {
				$orderList = $orderModel->getOrdersList($_currentUser->get('id'), true);
			}
			$this->assignRef('orderlist', $orderList);
		}

		if (!class_exists('CurrencyDisplay')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'currencydisplay.php');

		$currency = CurrencyDisplay::getInstance();
		$this->assignRef('currency', $currency);

		$orderStatusModel = VmModel::getModel('orderstatus');

		$_orderstatuses = $orderStatusModel->getOrderStatusList();
		$orderstatuses = array();
		foreach ($_orderstatuses as $_ordstat) {
			$orderstatuses[$_ordstat->order_status_code] = JText::_($_ordstat->order_status_name);
		}


		$this->assignRef('orderstatuses', $orderstatuses);

		if(!class_exists('ShopFunctions')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'shopfunctions.php');

		// this is no setting in BE to change the layout !
		//shopFunctionsF::setVmTemplate($this,0,0,$layoutName);

		parent::display($tpl);
	}

/*	public function renderMailLayout($doVendor=false) {


		// don't need to get the payment name, the Order is sent from the payment trigger
		if (VmConfig::get('order_mail_html')) {
		    $tpl = 'mail_html';
		} else {
		    $tpl = 'mail_raw';
		}
		if(!class_exists('shopFunctionsF')) require(JPATH_VM_SITE.DS.'helpers'.DS.'shopfunctionsf.php');
		if (!class_exists('CurrencyDisplay')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'currencydisplay.php');

		$currency = CurrencyDisplay::getInstance();

		$userFieldsModel = VmModel::getModel('userfields');
		$userFields = $userFieldsModel->getUserFields(
				     'account'
		, array('captcha' => true, 'delimiters' => true) // Ignore these types
		, array('delimiter_userinfo','user_is_vendor' ,'username','password', 'password2', 'agreed', 'address_type') // Skips
		);
		$orderbt = $this->orderdetails['details']['BT'];
		$orderst = (array_key_exists('ST', $this->orderdetails['details'])) ? $this->orderdetails['details']['ST'] : $orderbt;
		$billfields = $userFieldsModel->getUserFieldsFilled(
		$userFields
		,$orderbt
		);

		$userFields = $userFieldsModel->getUserFields(
				     'shipment'
		, array() // Default switches
		, array('delimiter_userinfo', 'username', 'email', 'password', 'password2', 'agreed', 'address_type') // Skips
		);

		$shipmentfields = $userFieldsModel->getUserFieldsFilled(
		$userFields
		,$orderst
		);

		if(!class_exists('VirtueMartModelOrderstatus')) require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'orderstatus.php');
		$this->prepareMailData();
		if ($doVendor) {
			$this->subject = JText::sprintf('COM_VIRTUEMART_VENDOR_NEW_ORDER_CONFIRMED', $this->shopperName, $currency->priceDisplay($this->orderdetails['details']['BT']['order_total']), $this->orderdetails['details']['BT']['order_number']);
			$recipient = 'vendor';
		} else {
			$this->subject = JText::sprintf('COM_VIRTUEMART_SHOPPER_NEW_ORDER_CONFIRMED', $this->vendor->vendor_store_name, $currency->priceDisplay($this->orderdetails['details']['BT']['order_total']), $this->orderdetails['details']['BT']['order_number'], $this->orderdetails['details']['BT']['order_pass'] );
			$recipient = 'shopper';
		}
		$this->doVendor = true;
		$this->assignRef('recipient', $recipient);
		$this->assignRef('currency', $currency);
		$this->assignRef('shipment_name', $this->orderdetails['shipmentName']);
		$this->assignRef('payment_name', $this->orderdetails['paymentName']);
		$this->assignRef('billfields', $billfields);
		$this->assignRef('shipmentfields', $shipmentfields);
		$vendorModel = VmModel::getModel('vendor');
		$this->vendorEmail = $vendorModel->getVendorEmail($this->vendor->virtuemart_vendor_id);
		$this->layoutName = $tpl;
		$this->setLayout($tpl);

		$path = VmConfig::get('forSale_path',0);

		vmdebug('renderMailLayout Frontend '.date('H:i:s'),$this->order);

		if($this->orderdetails['details']['BT']['order_status']  == 'C' and $path!==0){

			if(!class_exists('VirtueMartControllerInvoice')) require_once( JPATH_VM_SITE.DS.'controllers'.DS.'invoice.php' );
			$controller = new VirtueMartControllerInvoice( array(
							  'model_path' => JPATH_VM_SITE.DS.'models',
							  'view_path' => JPATH_VM_SITE.DS.'views'
			));

			$this->mediaToSend[] = $controller->checkStoreInvoice($this->order);
		}

		parent::display();
	}

/*	function prepareMailData(){

		if(!isset($this->vendor)) $this->prepareVendor();


		//TODO add orders, for the orderId
		//TODO add registering userdata
		// In general we need for every mail the shopperdata (with group), the vendor data, shopperemail, shopperusername, and so on
	}*/

	// add vendor for cart
	function prepareVendor(){

		$vendorModel = VmModel::getModel('vendor');
		$vendor = & $vendorModel->getVendor();
		$this->assignRef('vendor', $vendor);
		$vendorModel->addImages($this->vendor,1);

	}



}
