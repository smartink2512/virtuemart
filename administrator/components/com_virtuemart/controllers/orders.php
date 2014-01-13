<?php
/**
 *
 * Orders controller
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
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

if(!class_exists('VmController'))require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'vmcontroller.php');


/**
 * Orders Controller
 *
 * @package    VirtueMart
 * @author
 */
class VirtuemartControllerOrders extends VmController {

	/**
	 * Method to display the view
	 *
	 * @access	public
	 * @author
	 */
	function __construct() {
		VmConfig::loadJLang('com_virtuemart_orders',TRUE);
		parent::__construct();

	}

	/**
	 * Shows the order details
	 */
	public function edit($layout='order'){

		parent::edit($layout);
	}

	/**
	 * NextOrder
	 * renamed, the name was ambigous notice by Max Milbers
	 * @author Kohl Patrick
	 */
	public function nextItem($dir = 'ASC'){
		$model = VmModel::getModel('orders');
		$id = VmRequest::getInt('virtuemart_order_id');
		if (!$order_id = $model->getOrderId($id, $dir)) {
			$order_id  = $id;
			$msg = vmText::_('COM_VIRTUEMART_NO_MORE_ORDERS');
		} else {
			$msg ='';
		}
		$this->setRedirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id='.$order_id ,$msg );
	}

	/**
	 * NextOrder
	 * renamed, the name was ambigous notice by Max Milbers
	 * @author Kohl Patrick
	 */
	public function prevItem(){

		$this->nextItem('DESC');
	}
	/**
	 * Generic cancel task
	 *
	 * @author Max Milbers
	 */
	public function cancel(){
		// back from order
		$this->setRedirect('index.php?option=com_virtuemart&view=orders' );
	}
	/**
	 * Shows the order details
	 * @deprecated
	 */
	public function editOrderStatus() {

		/* Create the view object */
		$view = $this->getView('orders', 'html');

		/* Default model */
		$model = VmModel::getModel('orders');
		$model->updateOrderStatus();
		/* Now display the view. */
		$view->display();
	}

	/**
	 * Update an order status
	 *
	 * @author Max Milbers
	 */
	public function updatestatus() {
		//vmdebug('updatestatus');
		$mainframe = Jfactory::getApplication();
		$lastTask = VmRequest::getCmd('last_task');


		/* Load the view object */
		$view = $this->getView('orders', 'html');

		/* Update the statuses */
		$model = VmModel::getModel('orders');

		if ($lastTask == 'updatestatus') {
			// single order is in POST but we need an array
			$order = array() ;
			$virtuemart_order_id = VmRequest::getInt('virtuemart_order_id');
			$order[$virtuemart_order_id] = (vmRequest::getRequest());
			//vmdebug(  'order',$order);
			$result = $model->updateOrderStatus($order);
		} else {
			$result = $model->updateOrderStatus();
		}

		$msg='';
		if ($result['updated'] > 0)
		$msg = vmText::sprintf('COM_VIRTUEMART_ORDER_UPDATED_SUCCESSFULLY', $result['updated'] );
		else if ($result['error'] == 0)
		$msg .= vmText::_('COM_VIRTUEMART_ORDER_NOT_UPDATED');
		if ($result['error'] > 0)
		$msg .= vmText::sprintf('COM_VIRTUEMART_ORDER_NOT_UPDATED_SUCCESSFULLY', $result['error'] , $result['total']);
		if ('updatestatus'== $lastTask ) {
			$mainframe->redirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id='.$virtuemart_order_id , $msg);
		}
		else {
			$mainframe->redirect('index.php?option=com_virtuemart&view=orders', $msg);
		}
	}


	/**
	 * Save changes to the order item status
	 *
	 */
	public function saveItemStatus() {
		//vmdebug('saveItemStatus');
		$mainframe = Jfactory::getApplication();

		/* Load the view object */
		$view = $this->getView('orders', 'html');

		$data = vmRequest::getRequest();
		$model = VmModel::getModel();
		$model->updateItemStatus(JArrayHelper::toObject($data), $data['new_status']);

		$mainframe->redirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id='.$data['virtuemart_order_id']);
	}


	/**
	 * Display the order item details for editing
	 */
	public function editOrderItem() {
		//vmdebug('editOrderItem');
		VmRequest::setVar('layout', 'orders_editorderitem');
		// 	    VmRequest::setVar('hidemenu', 1);

		parent::display();
	}


	/**
	 * correct position, working with json? actually? WHat ist that?
	 *
	 * Get a list of related products
	 * @author Max Milbers
	 */
	public function getProducts() {
		/* Create the view object */
		$view = $this->getView('orders', 'json');

		$view->setLayout('orders_editorderitem');

		/* Now display the view. */
		$view->display();
	}


	/**
	 * Update status for the selected order items
	 */
	public function updateOrderItemStatus()
	{
		//vmdebug('updateOrderItemStatus');
		$mainframe = Jfactory::getApplication();
		$model = VmModel::getModel();
		$_items = VmRequest::getVar('item_id',  0, '', 'array');

		$_orderID = VmRequest::getInt('virtuemart_order_id', '');

		foreach ($_items as $key=>$value) {
			//vmdebug('updateOrderItemStatus VAL  ',$value);
			if (!isset($value['comments'])) $value['comments'] = '';

			$data = (object)$value;
			$data->virtuemart_order_id = $_orderID;
			// 			$model->updateSingleItem((int)$key, $value['order_status'],$value['comments'],$_orderID);
			$model->updateSingleItem((int)$key, $data, true);
		}
		$model->deleteInvoice($_orderID);
		$mainframe->redirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id='.$_orderID);
	}

	public function updateOrderHead()
	{
		$mainframe = Jfactory::getApplication();
		$model = VmModel::getModel();
		$_items = VmRequest::getVar('item_id',  0, '', 'array');
		$_orderID = VmRequest::getInt('virtuemart_order_id', '');
		$model->UpdateOrderHead((int)$_orderID, vmRequest::getRequest());
		$model->deleteInvoice($_orderID);
		$mainframe->redirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id='.$_orderID);
	}

	public function CreateOrderHead()
	{
		$mainframe = Jfactory::getApplication();
		$model = VmModel::getModel();
		$orderid = $model->CreateOrderHead();
		$mainframe->redirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id='.$orderid );
	}

	/**
	 * Update a single order item

	 public function updateOrderItem()
	 {
		//vmdebug('updateOrderItem');
		$mainframe = Jfactory::getApplication();
		$model = VmModel::getModel('orders');
		//	$model->updateSingleItem();
		$mainframe->redirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id='.VmRequest::getInt('virtuemart_order_id', ''));
		}
		*/

	public function newOrderItem() {
		//vmdebug('newOrderItem');
		$orderId = VmRequest::getInt('virtuemart_order_id', '');
		$model = VmModel::getModel();
		$msg = '';
		$data = vmRequest::getRequest();
		if (!$model->saveOrderLineItem($data)) {
			$msg = $model->getError();
		}
		$model->deleteInvoice($orderId);
		$editLink = 'index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id=' . $orderId;
		$this->setRedirect($editLink, $msg);
	}

	/**
	 * Removes the given order item
	 */
	public function removeOrderItem() {
		//vmdebug('removeOrderItem');
		$model = VmModel::getModel();
		$msg = '';
		$orderId = VmRequest::getInt('orderId', '');
		// TODO $orderLineItem as int ???
		$orderLineItem = VmRequest::getVar('orderLineId', '');

		if (!$model->removeOrderLineItem($orderLineItem)) {
			$msg = $model->getError();
		}
		$model->deleteInvoice($orderId);
		$editLink = 'index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id=' . $orderId;
		$this->setRedirect($editLink, $msg);
	}

	public function exportOrdersAsCSV(){

		$model = VmModel::getModel();

		$idArray = VmRequest::getVar('cid', array() );

		$orders = array();
		foreach($idArray as $orderId){
			$orders[] = $model -> getOrder($orderId);
		}

		$csv = '';

		$head = array('virtuemart_order_userinfo_id','virtuemart_vendor_id','order_number','order_total','order_subtotal','order_tax','order_status','user_currency_rate','customer_note');

		foreach($head as $item){
			$csv .= '"'.$item.'";"';
		}

		foreach($orders as $order){
// 			$order = (array) $order;7
// 			$order['details']
// 			$order['items']
// 			$order['calc_rules']
			$attribs = get_object_vars($order['details']['BT']);

// 			$csv = '"BT"';
// 			foreach($attribs as $k=>$v){
// 				$csv .= ';"'.$k.':'$v;
// 			}
// 			$csv .= "\n";
		}

		$jUser = JFactory::getUser();
		$date = date("Y-m-d");
		$name = $jUser->name.$date.'.csv';
// 		header("Content-Disposition: attachment; filename=\"".JFile::getName($media->file_url)."\"");
// 		header("Content-Disposition: attachment; filename=\"".$name."\"");
// 		echo $csv;
		parent::display();
// 		jExit();
	}


}
// pure php no closing tag

