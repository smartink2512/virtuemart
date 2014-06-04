<?php

defined('_JEXEC') or die();

/**
 *
 * Realex payment plugin
 *
 * @author Valerie Isaksen
 * @version $Id$
 * @package VirtueMart
 * @subpackage payment
 * ${PHING.VM.COPYRIGHT}
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */

defined('_JEXEC') or die('Restricted access');
if (!class_exists('vmPSPlugin')) {
	require(JPATH_VM_PLUGINS . DS . 'vmpsplugin.php');
}

if (!class_exists('RealexHelperRealex')) {
	require(JPATH_SITE . '/plugins/vmpayment/realex/realex/helpers/helper.php');
}
if (!class_exists('RealexHelperCustomerData')) {
	require(JPATH_SITE . '/plugins/vmpayment/realex/realex/helpers/customerdata.php');
}

if (!class_exists('vmPSPlugin')) {
	require(JPATH_VM_PLUGINS . DS . 'vmpsplugin.php');
}

class plgVmPaymentRealex extends vmPSPlugin {

	private $customerData;

	function __construct (& $subject, $config) {
		parent::__construct($subject, $config);
		if (!class_exists('RealexHelperCustomerData')) {
			require(JPATH_SITE . '/plugins/vmpayment/realex/realex/helpers/customerdata.php');
		}
		$this->customerData = new RealexHelperCustomerData();
		$this->_loggable = TRUE;
		$this->tableFields = array_keys($this->getTableSQLFields());
		$this->_tablepkey = 'id';
		$this->_tableId = 'id';
		$varsToPush = $this->getVarsToPush();
		$this->setCryptedFields(array('secret', 'rebate_password'));
		$this->setConfigParameterable($this->_configTableFieldName, $varsToPush);


	}

	/**
	 * Create the table for this plugin if it does not yet exist.
	 */
	protected function getVmPluginCreateTableSQL () {
		return $this->createTableSQL('Payment Realex Table');
	}

	/**
	 * Fields to create the payment table
	 * @return string SQL Fileds
	 */
	function getTableSQLFields () {
		$SQLfields = array(
			'id'                           => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT',
			'virtuemart_order_id'          => 'int(11) UNSIGNED',
			'order_number'                 => 'char(64)',
			'virtuemart_paymentmethod_id'  => 'mediumint(1) UNSIGNED',
			'payment_name'                 => 'varchar(5000)',
			'payment_order_total'          => 'decimal(15,5) NOT NULL',
			'payment_currency'             => 'smallint(1)',
			'email_currency'               => 'smallint(1)',
			'cost_per_transaction'         => 'decimal(10,2)',
			'cost_percent_total'           => 'decimal(10,2)',
			'tax_id'                       => 'smallint(1)',
			'realex_custom'                => 'varchar(255)',
			'realex_request_type_response' => 'varchar(32) DEFAULT NULL',
			'realex_response_result'       => 'varchar(3) DEFAULT NULL',
			'realex_response_pasref'       => 'varchar(50) DEFAULT NULL',
			'realex_response_authcode'     => 'varchar(10) DEFAULT NULL',
			'realex_fullresponse_format'   => 'varchar(10) DEFAULT NULL',
			'realex_fullresponse'          => 'text',
		);
		return $SQLfields;
	}

	/**
	 * @param $cart
	 * @param $order
	 * @return bool|null
	 */
	public function plgVmConfirmedOrder ($cart, $order) {

		if (!($this->_currentMethod = $this->getVmPluginMethod($order['details']['BT']->virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			return FALSE;
		}

		if (!class_exists('VirtueMartModelOrders')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
		}
		if (!class_exists('VirtueMartModelCurrency')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'currency.php');
		}

		$email_currency = $this->getEmailCurrency($this->_currentMethod);

		$payment_name = $this->renderPluginName($this->_currentMethod, 'order');

		$realexInterface = $this->_loadRealexInterface();
		$realexInterface->loadCustomerData();

		$realexInterface->debugLog('order number: ' . $order['details']['BT']->order_number, 'plgVmConfirmedOrder', 'debug');
		$realexInterface->setCart($cart);
		if (!$realexInterface->validateConfirmedOrder()) {
			vmInfo('VMPAYMENT_REALEX_PLEASE_SELECT_OPTION');
			return false;
		}
		$realexInterface->setOrder($order);
		$realexInterface->setPaymentCurrency();
		$realexInterface->setTotalInPaymentCurrency($order['details']['BT']->order_total);


		// Prepare data that should be stored in the database
		$dbValues['order_number'] = $order['details']['BT']->order_number;
		$dbValues['payment_name'] = str_replace(array('\t', '\n'), '', $payment_name);

		$dbValues['virtuemart_paymentmethod_id'] = $cart->virtuemart_paymentmethod_id;
		$dbValues['realex_custom'] = $realexInterface->getContext();
		$dbValues['cost_per_transaction'] = $this->_currentMethod->cost_per_transaction;
		$dbValues['cost_percent_total'] = $this->_currentMethod->cost_percent_total;
		$dbValues['payment_currency'] = $realexInterface->getPaymentCurrency();
		$dbValues['email_currency'] = $email_currency;
		$dbValues['payment_order_total'] = $realexInterface->getTotalInPaymentCurrency();
		$dbValues['tax_id'] = $this->_currentMethod->tax_id;
		$this->storePSPluginInternalData($dbValues);

		VmConfig::loadJLang('com_virtuemart_orders', TRUE);

		$selectedCCParams = array();
		if ($this->_currentMethod->integration == 'redirect') {
			if (!$realexInterface->doRealvault($selectedCCParams)) {
				$html = $realexInterface->sendPostRequest();
				vRequest::setVar('html', $html);
				$cart->_confirmDone = FALSE;
				$cart->_dataValidated = FALSE;
				$cart->setCartIntoSession();
			} else {
				$response = $realexInterface->requestReceiptIn($selectedCCParams);
				$request_type = $realexInterface->request_type . '_request';
				$this->_storeRealexInternalData($realexInterface->xml_request, $this->_currentMethod->virtuemart_paymentmethod_id, $order['details']['BT']->virtuemart_order_id, $order['details']['BT']->order_number, $request_type);

				$realexInterface->manageResponseRequestReceiptIn($response);
				$xml_response = simplexml_load_string($response);
				$success = $realexInterface->isResponseSuccess($xml_response);
				if ($success) {
					$status = $this->_currentMethod->status_success;
					$amountInCurrency = vmPSPlugin::getAmountInCurrency($order['details']['BT']->order_total, $order['details']['BT']->order_currency);
					$currencyDisplay = CurrencyDisplay::getInstance($cart->pricesCurrency);
					$order_history['comments'] = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_STATUS_CONFIRMED', $amountInCurrency['display'], $order_number);

				} else {
					$order_history['comments'] = vmText::_('VMPAYMENT_REALEX_PAYMENT_STATUS_CANCELLED');
					$status = $this->_currentMethod->status_canceled;
				}
				$order_history['customer_notified'] = true;
				$order_history['order_status'] = $status;

				$modelOrder = VmModel::getModel('orders');
				$modelOrder->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order_history, TRUE);

				$payments = $this->getDatasByOrderId($realexInterface->order['details']['BT']->virtuemart_order_id);
				$html = $realexInterface->getResponseHTML($payments);
				vRequest::setVar('html', $html);
				$this->customerData->clear();

				if ($success) {
					if (isset($payments[0]->realex_custom)) {
						$cart->emptyCart();
					}
				}

			}
		} else {
			$realexInterface->displayRemoteCCForm();
		}


		return true;


	}


	function updateOrderStatus ($order) {
		$realexInterface = $this->_loadRealexInterface();
		$realexInterface->setOrder($order);
		$realexInterface->setPaymentCurrency();
		$realexInterface->setTotalInPaymentCurrency($order['details']['BT']->order_total);
		$cart = VirtueMartCart::getCart();
		$realexInterface->setCart($cart, false);
		if (!($payments = $this->getDatasByOrderId($order['details']['BT']->virtuemart_order_id))) {
			// JError::raiseWarning(500, $db->getErrorMsg());
			return null;
		}
		$payment = end($payments);
		$xml_response = simplexml_load_string($payment->realex_fullresponse);
		$order_history = array();

		$success = $realexInterface->isResponseSuccess($xml_response);
		if ($success) {
			$status = $this->_currentMethod->status_success;
			$amountValue = vmPSPlugin::getAmountInCurrency($order['details']['BT']->order_total, $order['details']['BT']->order_currency);
			//$amountValueInPaymentCurrency = vmPSPlugin::getAmountInCurrency($realexInterface->getTotalInPaymentCurrency(), $realexInterface->getPaymentCurrency());
			$currencyDisplay = CurrencyDisplay::getInstance($realexInterface->cart->pricesCurrency);

			$order_history['comments'] = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_STATUS_CONFIRMED', $amountValue['display'], $order['details']['BT']->order_number);
			$order_history['success'] = true;

			if (isset($xml_response->dccinfo) AND isset($xml_response->dccinfo->cardholderrate)) {
				$order_history['comments'] .= "<br />";
				if ($xml_response->dccinfo->cardholderrate != 1.0) {
					$order_history['comments'] .= vmText::sprintf('VMPAYMENT_REALEX_DCC_PAY_OWN_CURRENCY_CHARGED', $this->getCardHolderAmount($xml_response->dccinfo->merchantamount), $xml_response->dccinfo->merchantcurrency, $this->getCardHolderAmount($xml_response->dccinfo->cardholderamount), $xml_response->dccinfo->cardholdercurrency);
				} else {
					$order_history['comments'] .= vmText::sprintf('VMPAYMENT_REALEX_DCC_PAY_MERCHANT_CURRENCY', $this->getCardHolderAmount($xml_response->dccinfo->merchantamount), $xml_response->dccinfo->merchantcurrency);
				}
				$order_history['comments'] .= "<br />";
			} else {

			}


		} else {
			if ($realexInterface->isResponseDeclined($xml_response)) {
				$order_history['comments'] = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_DECLINED', $realexInterface->order['details']['BT']->order_number);

			} else {
				$order_history['comments'] = vmText::_('VMPAYMENT_REALEX_PAYMENT_STATUS_CANCELLED');
			}
			$status = $this->_currentMethod->status_canceled;
			$order_history['success'] = false;
		}

		$order_history['customer_notified'] = true;
		$order_history['order_status'] = $status;

		$modelOrder = VmModel::getModel('orders');
		$modelOrder->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order_history, TRUE);
		return $order_history;
	}

	function redirectToCart ($msg = NULL) {
		if (!$msg) {
			$msg = vmText::_('VMPAYMENT_REALEX_ERROR_TRY_AGAIN');
		}
		$this->customerData->clear();
		$app = JFactory::getApplication();
		$app->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart&Itemid=' . vRequest::getInt('Itemid'), false), $msg);
	}


	/*********************/
	/* Private functions */
	/*********************/
	private function _loadRealexInterface () {

		if ($this->_currentMethod->integration == 'redirect') {
			if (!class_exists('RealexHelperRealexRedirect')) {
				require(JPATH_SITE . '/plugins/vmpayment/realex/realex/helpers/redirect.php');
			}
			$realexInterface = new RealexHelperRealexRedirect($this->_currentMethod, $this);
		} else {
			if ($this->_currentMethod->integration == 'remote') {
				if (!class_exists('RealexHelperRealexRemote')) {
					require(JPATH_SITE . '/plugins/vmpayment/realex/realex/helpers/remote.php');
				}
				$realexInterface = new RealexHelperRealexRemote($this->_currentMethod, $this);
			} else {
				Vmerror('Wrong Realex Integration method - developer error ', 'Wrong Realex Integration method ');
				return NULL;
			}
		}
		return $realexInterface;
	}


	public function plgVmOnPaymentResponseReceived (&$html) {

		if (!class_exists('VirtueMartCart')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		}
		if (!class_exists('shopFunctionsF')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'shopfunctionsf.php');
		}
		if (!class_exists('VirtueMartModelOrders')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
		}
		VmConfig::loadJLang('com_virtuemart_orders', TRUE);

		// the payment itself should send the parameter needed.
		$virtuemart_paymentmethod_id = vRequest::getInt('pm', 0);

		$order_number = vRequest::getString('on', 0);
		if (!($this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			return NULL;
		}

		if (!($virtuemart_order_id = VirtueMartModelOrders::getOrderIdByOrderNumber($order_number))) {
			return NULL;
		}

		$payments = $this->getDatasByOrderId($virtuemart_order_id);

		VmConfig::loadJLang('com_virtuemart');
		$orderModel = VmModel::getModel('orders');
		$order = $orderModel->getOrder($virtuemart_order_id);

		$realexInterface = $this->_loadRealexInterface();
		$realexInterface->loadCustomerData();
		$realexInterface->setOrder($order);

		$html = $realexInterface->getResponseHTML($payments);
		$this->customerData->clear();
		$cart = VirtueMartCart::getCart();
		$cart->emptyCart();
		vRequest::setVar('display_title', false);
		vRequest::setVar('html', $html);

		return TRUE;
	}


	/**
	 * Display stored payment data for an order
	 *
	 * @see components/com_virtuemart/helpers/vmPSPlugin::plgVmOnShowOrderBEPayment()
	 */
	public function plgVmOnShowOrderBEPayment ($virtuemart_order_id, $payment_method_id) {

		if (!$this->selectedThisByMethodId($payment_method_id)) {
			return NULL; // Another method was selected, do nothing
		}
		if (!($this->_currentMethod = $this->getVmPluginMethod($payment_method_id))) {
			return FALSE;
		}
		if (!($payments = $this->getDatasByOrderId($virtuemart_order_id))) {
			// JError::raiseWarning(500, $db->getErrorMsg());
			return '';
		}

		//$html = $this->renderByLayout('orderbepayment', array($payments, $this->_psType));
		$html = '<table class="adminlist" width="50%">' . "\n";
		$html .= $this->getHtmlHeaderBE();
		$code = "realex_response_";
		$first = TRUE;
		foreach ($payments as $payment) {
			$html .= '<tr class="row1"><td>' . vmText::_('VMPAYMENT_REALEX_DATE') . '</td><td align="left">' . $payment->created_on . '</td></tr>';
			// Now only the first entry has this data when creating the order
			if ($first) {
				$html .= $this->getHtmlRowBE('COM_VIRTUEMART_PAYMENT_NAME', $payment->payment_name);
				// keep that test to have it backwards compatible. Old version was deleting that column  when receiving an IPN notification
				if ($payment->payment_order_total and  $payment->payment_order_total != 0.00) {
					$html .= $this->getHtmlRowBE('COM_VIRTUEMART_TOTAL', $payment->payment_order_total * 0.01 . " " . $payment->payment_currency);
				}

				$first = FALSE;
			} else {
				$realexInterface = $this->_loadRealexInterface();

				if (isset($payment->realex_fullresponse) and !empty($payment->realex_fullresponse)) {
					//$realex_data = json_decode($payment->realex_fullresponse);
					if ($payment->realex_fullresponse_format == 'json') {
						$realex_data = json_decode($payment->realex_fullresponse);
					} elseif ($payment->realex_fullresponse_format == 'xml') {
						$html .= $this->getHtmlRowBE('VMPAYMENT_REALEX_RESPONSE_TYPE', $payment->realex_request_type_response);

						$realex_data = simplexml_load_string($payment->realex_fullresponse);
					}

					$html .= $realexInterface->onShowOrderBEPayment($realex_data, $payment->realex_fullresponse_format, $payment->realex_request_type_response, $virtuemart_order_id);

					$html .= '<tr><td></td><td>
    <a href="#" class="RealexLogOpener" rel="' . $payment->id . '" >
        <div style="background-color: white; z-index: 100; right:0; display: none; border:solid 2px; padding:10px;" class="vm-absolute" id="RealexLog_' . $payment->id . '">';
					if ($payment->realex_fullresponse_format != 'xml') {
						foreach ($realex_data as $key => $value) {
							$html .= ' <b>' . $key . '</b>:&nbsp;' . $value . '<br />';
						}
					} else {
						$html .= "<pre>" . htmlentities(wordwrap($payment->realex_fullresponse, 100, "\n", true)) . "</pre>";
					}


					$html .= ' </div>
        <span class="icon-nofloat vmicon vmicon-16-xml"></span>&nbsp;';
					$html .= vmText::_('VMPAYMENT_REALEX_VIEW_TRANSACTION_LOG');
					$html .= '  </a>';
					$html .= ' </td></tr>';
				} else {
					//$html .= $realexInterface->onShowOrderBEPaymentByFields($payment);
				}
			}


		}
		$html .= '</table>' . "\n";

		$doc = JFactory::getDocument();
		$js = "
	jQuery().ready(function($) {
		$('.RealexLogOpener').click(function() {
			var logId = $(this).attr('rel');
			$('#RealexLog_'+logId).toggle();
			return false;
		});
	});";
		$doc->addScriptDeclaration($js);
		return $html;

	}

	/**
	 *  Order status changed
	 * @param $order
	 * @param $old_order_status
	 * @return bool|null
	 */
	public function plgVmOnUpdateOrderPayment (&$order, $old_order_status) {

		//Load the method
		if (!($this->_currentMethod = $this->getVmPluginMethod($order->virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->_currentMethod ->payment_element)) {
			return FALSE;
		}
		//Load the payments
		if (!($payments = $this->getDatasByOrderId($order->virtuemart_order_id))) {
			// JError::raiseWarning(500, $db->getErrorMsg());
			return null;
		}
		$updateOrderPaymentStatus = array(
			$this->_currentMethod->status_capture,
			$this->_currentMethod->status_canceled,
			$this->_currentMethod->status_rebate,
		);
		if (!in_array($order->order_status, $updateOrderPaymentStatus)) {
			return true;
		}
		$orderModel = VmModel::getModel('orders');
		$orderData = $orderModel->getOrder($order->virtuemart_order_id);
		$requestSent = false;
		$order_history_comment = '';
		$realexInterface = $this->_loadRealexInterface();
		if ($order->order_status == $this->_currentMethod->status_capture AND $this->canDoSettle($realexInterface, $old_order_status, $payments)) {
			$requestSent = true;
			$order_history_comment = vmText::_('VMPAYMENT_REALEX_UPDATE_STATUS_CAPTURE');
			$realexInterface->setOrder($orderData);
			$realexInterface->setPaymentCurrency();
			$realexInterface->setTotalInPaymentCurrency($orderData['details']['BT']->order_total);
			$realexInterface->loadCustomerData();
			$response = $realexInterface->settleTransaction($payments);

		} elseif ($order->order_status == $this->_currentMethod->status_canceled AND $this->canDoVoid($realexInterface, $old_order_status, $payments)) {
			$requestSent = true;
			$order_history_comment = vmText::_('VMPAYMENT_REALEX_UPDATE_STATUS_CANCELED');
			$realexInterface->setOrder($orderData);
			$realexInterface->setPaymentCurrency();
			$realexInterface->setTotalInPaymentCurrency($orderData['details']['BT']->order_total);
			$realexInterface->loadCustomerData();
			$response = $realexInterface->voidTransaction($payments);

		} elseif ($order->order_status == $this->_currentMethod->status_rebate AND $this->canDoRebate($realexInterface, $old_order_status, $payments)) {
			$requestSent = true;
			$order_history_comment = vmText::_('VMPAYMENT_REALEX_UPDATE_STATUS_REBATE');
			$realexInterface->setOrder($orderData);
			$realexInterface->setPaymentCurrency();
			$realexInterface->setTotalInPaymentCurrency($orderData['details']['BT']->order_total);
			$realexInterface->loadCustomerData();
			$response = $realexInterface->rebateTransaction($payments);

		}
		if ($requestSent) {
			if ($response) {
				$db_values = $this->_storeRealexInternalData($response, $this->_currentMethod->virtuemart_paymentmethod_id, $orderData['details']['BT']->virtuemart_order_id, $orderData['details']['BT']->order_number, $realexInterface->request_type);

				$xml_response = simplexml_load_string($response);
				$success = $realexInterface->isResponseSuccess($xml_response);
				if (!$success) {
					$error = $xml_response->message . " (" . (string)$xml_response->result . ")";
					$realexInterface->displayError($error);
					return false;
					//return NULL;
				} else {
					$order_history = array();
					$order_history['comments'] = $order_history_comment;
					$order_history['customer_notified'] = false;
					$order_history['order_status'] = $order->order_status;
					$modelOrder = VmModel::getModel('orders');
					$modelOrder->updateStatusForOneOrder($orderData['details']['BT']->virtuemart_order_id, $order_history, false);
				}
			} else {
				vmError('VMPAYMENT_REALEX_NO_RESPONSE');
			}

		}
		return false;
	}

	private function canDoSettle ($realexInterface, $old_order_status, $payments) {
		if (!($this->_currentMethod->dcc == 0  AND $this->_currentMethod->settlement == 'auto')) {
			return false;
		}
		if ($this->transactionIsSettled($realexInterface, $payments)) {
			return false;
		}
		return true;
	}

	/**
	 * Before settlement, it is possible to void an authorisation
	 * Void (if same day or delayed settlement)
	 *
	 * @param $old_order_status
	 * @param $payments
	 * @param $realexInterface
	 * @return bool
	 */
	private function canDoVoid ($realexInterface, $old_order_status, $payments) {
		if (!($old_order_status == $this->_currentMethod->status_success OR $old_order_status == $this->_currentMethod->status_capture)) {
			return false;
		}
		// Option 0 is delayed settlement
		if ($this->_currentMethod->settlement == 'auto') {
			return false;
		}
		if (!($authTime = $this->transactionIsAuth($realexInterface, $payments))) {
			vmError('VMPAYMENT_REALEX_ERROR_CANNOT_VOID_LAST_TRANSACTION_NOT_AUTH');
			return false;
		}
		/*
		if ($old_order_status == $this->_currentMethod->status_success) {
			if (strtotime('+1 day', strtotime($authTime)) > time()) {
				vmDebug('canDoVoid', $authTime, strtotime('+1 day', strtotime($authTime)), time());
				vmError(vmText::sprintf('VMPAYMENT_REALEX_ERROR_CANNOT_VOID_TIME', $authTime));
				return false;
			}
		}
		*/
		return true;
	}

	/**
	 * And in live mode, merchants can only rebate transactions the day after they've settled.
	 * It maybe would be best not to allow merchants to attempt rebate on the same day a transactions is processed.
	 * @param $old_order_status
	 * @param $payments
	 * @param $realexInterface
	 * @return bool
	 */
	private function canDoRebate ($realexInterface, $old_order_status, $payments) {
		if ($this->transactionIsDcc($realexInterface, $payments)) {
			vmError(vmText::_('VMPAYMENT_REALEX_ERROR_REBATE_DCC_TRANSACTION'));
			return false;
		}
		if ($this->_currentMethod->settlement=='auto') return true;
		if (!($settleTime = $this->transactionIsSettled($realexInterface, $payments))) {
			vmError(vmText::sprintf('VMPAYMENT_REALEX_ERROR_REBATE_SETTLE_FIRST', $payments[0]->order_number));
			return false;
		}
		//And in live mode, merchants can only rebate transactions the day after they've settled.
		if ($this->_currentMethod->shop_mode == 'sandbox') {
			return true;
		}

		return true;
	}

	private function transactionIsSettled ($realexInterface, $payments) {
		$payment = $realexInterface->getTransactionData($payments, array($realexInterface::REQUEST_TYPE_SETTLE));
		if (!$payment) {
			return false;
		}
		return $payment->created_on;
	}


	private function transactionIsDcc ($realexInterface, $payments) {
		if (!$this->_currentMethod->dcc) {
			return false;
		}

		$payment = $realexInterface->getTransactionData($payments, array($realexInterface::REQUEST_TYPE_SETTLE));
		if (!$payment) {
			return false;
		}
		return true;
	}

	private function transactionIsAuth ($realexInterface, $payments) {
		$payment = $realexInterface->getLastTransactionData($payments, array(
		                                                                    $realexInterface::REQUEST_TYPE_AUTH,
		                                                                    $realexInterface::REQUEST_TYPE_RECEIPT_IN
		                                                               ));
		if (!$payment) {
			return false;
		}
		return $payment->created_on;
	}


	/**
	 * Create the table for this plugin if it does not yet exist.
	 * This functions checks if the called plugin is active one.
	 * When yes it is calling the standard method to create the tables
	 *
	 */

	public function plgVmOnStoreInstallPaymentPluginTable ($jplugin_id) {
		if ($jplugin_id != $this->_jid) {
			return FALSE;
		}
		$this->_currentMethod = $this->getPluginMethod(vRequest::getInt('virtuemart_paymentmethod_id'));
		if ($this->_currentMethod->published) {

			$required_parameters = array('merchant_id', 'shared_secret', 'subaccount');
			foreach ($required_parameters as $required_parameter) {
				if (empty ($this->_currentMethod->$required_parameter)) {
					$text = vmText::sprintf('VMPAYMENT_REALEX_PARAMETER_REQUIRED', vmText::_('VMPAYMENT_REALEX_' . $required_parameter), $this->_currentMethod->payment_name, $this->_currentMethod->virtuemart_paymentmethod_id);
					vmWarn($text);
				}
			}

		}

		return $this->onStoreInstallPluginTable($jplugin_id);
	}

	/**
	 * This event is fired after the payment method has been selected. It can be used to store
	 * additional payment info in the cart.
	 *
	 * @param VirtueMartCart $cart: the actual cart
	 * @return null if the payment was not selected, true if the data is valid, error message if the data is not vlaid
	 *
	 */
	public function plgVmOnSelectCheckPayment (VirtueMartCart $cart) {
		if (!$this->selectedThisByMethodId($cart->virtuemart_paymentmethod_id)) {
			return NULL; // Another method was selected, do nothing
		}
		if (!($this->_currentMethod = $this->getVmPluginMethod($cart->virtuemart_paymentmethod_id))) {
			return FALSE;
		}
		$realexInterface = $this->_loadRealexInterface($this->_currentMethod);
		$realexInterface->loadCustomerData();
		if ($this->customerData->getVar('selected_method') == $cart->virtuemart_paymentmethod_id) {

			if (!$realexInterface->validateSelectCheckPayment()) {
				return false;
			}
		}

		return true;


	}

	/**
	 * This is for checking the input data of the payment method within the checkout
	 *
	 */
	public function plgVmOnCheckoutCheckDataPayment (VirtueMartCart $cart) {

		if (!$this->selectedThisByMethodId($cart->virtuemart_paymentmethod_id)) {
			return NULL; // Another method was selected, do nothing
		}
		if (!($this->_currentMethod = $this->getVmPluginMethod($cart->virtuemart_paymentmethod_id))) {
			return NULL;
		}
		$realexInterface = $this->_loadRealexInterface($this->_currentMethod);
		$realexInterface->loadCustomerData();

		if (!$realexInterface->validateCheckoutCheckDataPayment()) {
			vmInfo('VMPAYMENT_REALEX_PLEASE_SELECT_OPTION');
			return false;
		}


		return true;
	}


	/**
	 * plgVmDisplayListFEPayment
	 * This event is fired to display the pluginmethods in the cart (edit shipment/payment) for exampel
	 *
	 * @param object  $cart Cart object
	 * @param integer $selected ID of the method selected
	 * @return boolean True on succes, false on failures, null when this plugin was not selected.
	 * On errors, JError::raiseWarning (or JError::raiseError) must be used to set a message.
	 *
	 */
	public function plgVmDisplayListFEPayment (VirtueMartCart $cart, $selected = 0, &$htmlIn) {

		if ($this->getPluginMethods($cart->vendorId) === 0) {
			if (empty($this->_name)) {
				$app = JFactory::getApplication();
				$app->enqueueMessage(vmText::_('COM_VIRTUEMART_CART_NO_' . strtoupper($this->_psType)));
				return false;
			} else {
				return false;
			}
		}

		$htmla = array();
		foreach ($this->methods as $this->_currentMethod) {
			if ($this->checkConditions($cart, $this->_currentMethod, $cart->pricesUnformatted)) {

				$html = '';
				$cart_prices = array();
				$cart_prices['withTax'] = '';
				$cart_prices['salesPrice'] = '';
				$methodSalesPrice = $this->setCartPrices($cart, $cart_prices, $this->_currentMethod);
				//if ($selected == $method->virtuemart_paymentmethod_id) {
				//	$this->customerData->load();
				//}
				$html .= '<br />';
				$payment_name = $this->renderPluginName($this->_currentMethod, 'DisplayListFEPayment');
				//$html .= $this->getPluginHtml($this->_currentMethod, $selected, $methodSalesPrice);
				$realexInterface = $this->_loadRealexInterface();
				if ($realexInterface == NULL) {
					vmdebug('renderPluginName', $this->_currentMethod);
					break;
				}
				$realexInterface->loadCustomerData();

				if ($selected == $this->_currentMethod->virtuemart_paymentmethod_id) {
					$checked = 'checked="checked"';
				} else {
					$checked = '';
				}
				$ccDropdown = "";
			//	if ($this->_currentMethod->integration == 'redirect') {
					if (!JFactory::getUser()->guest AND $this->_currentMethod->realvault) {
						$selected_cc = $this->customerData->getVar('saved_cc_selected');
						$ccDropdown = $realexInterface->getCCDropDown($this->_currentMethod->virtuemart_paymentmethod_id, JFactory::getUser()->id, $selected_cc);
					}
				//}

				$html .= $this->renderByLayout('redirect_form', array(
				                                                     'creditcardsDropDown'         => $ccDropdown,
				                                                     'virtuemart_paymentmethod_id' => $this->_currentMethod->virtuemart_paymentmethod_id,
				                                                     'payment_name'                => $payment_name,
				                                                     'checked'                     => $checked,
				                                                ));

				$htmla[] = $html;
			}
		}
		$htmlIn[] = $htmla;
		return true;

	}

	/**
	 * getSelectable
	 * This method returns the number of valid methods
	 *
	 * @param VirtueMartCart cart: the cart object
	 * @param $method_id eg $virtuemart_shipmentmethod_id
	 *
	 */

	function getSelectable (VirtueMartCart $cart, &$method_id, $cart_prices) {

		$nbMethod = 0;
		$hasStoredCCs = false;
		if ($this->getPluginMethods($cart->vendorId) === 0) {
			return FALSE;
		}

		foreach ($this->methods as $method) {
			if (!$this->hasStoredCCs($method)) {
				if ($nb = (int)$this->checkConditions($cart, $method, $cart_prices)) {
					$nbMethod = $nbMethod + $nb;
					$idName = $this->_idName;
					$method_id = $method->$idName;
				}
			} else {
				$hasStoredCCs = true;
			}

		}
		if ($hasStoredCCs) {
			return 2;
		} else {
			return $nbMethod;
		}
	}

	/**
	 * @param $method
	 * @return bool
	 */
	function hasStoredCCs ($method) {
		if (!JFactory::getUser()->guest AND $method->realvault) {
			$this->_currentMethod = $method;
			$realexInterface = $this->_loadRealexInterface();
			$saved_cc_selected = $this->customerData->getVar('saved_cc_selected', 0);
			$storedCCs = $realexInterface->getStoredCCs(JFactory::getUser()->id);
			if ($storedCCs) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Check if the payment conditions are fulfilled for this payment method
	 * @param VirtueMartCart $cart
	 * @param int            $activeMethod
	 * @param array          $cart_prices
	 * @return bool
	 */
	protected function checkConditions ($cart, $method, $cart_prices) {


		$method->min_amount = (float)$method->min_amount;
		$method->max_amount = (float)$method->max_amount;

		$address = (($cart->ST == 0) ? $cart->BT : $cart->ST);

		$amount = $this->getCartAmount($cart_prices);
		$amount_cond = ($amount >= $method->min_amount AND $amount <= $method->max_amount
			OR
			($method->min_amount <= $amount AND ($method->max_amount == 0)));

		$countries = array();
		if (!empty($method->countries)) {
			if (!is_array($method->countries)) {
				$countries[0] = $method->countries;
			} else {
				$countries = $method->countries;
			}
		}
		// probably did not gave his BT:ST address
		if (!is_array($address)) {
			$address = array();
			$address['virtuemart_country_id'] = 0;
		}

		if (!isset($address['virtuemart_country_id'])) {
			$address['virtuemart_country_id'] = 0;
		}
		if (in_array($address['virtuemart_country_id'], $countries) || count($countries) == 0) {
			if ($amount_cond) {
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 * plgVmonSelectedCalculatePricePayment
	 * Calculate the price (value, tax_id) of the selected method
	 * It is called by the calculator
	 * This function does NOT to be reimplemented. If not reimplemented, then the default values from this function are taken.
	 * @cart: VirtueMartCart the current cart
	 * @cart_prices: array the new cart prices
	 * @return null if the method was not selected, false if the shiiping rate is not valid any more, true otherwise
	 *
	 *
	 */

	public function plgVmonSelectedCalculatePricePayment (VirtueMartCart $cart, array &$cart_prices, &$cart_prices_name) {
		return $this->onSelectedCalculatePrice($cart, $cart_prices, $cart_prices_name);
	}

	/*
			 * @param $method plugin
		 *  @param $where from where tis function is called
			 */

	function renderPluginName ($method, $where = 'checkout') {

		$display_logos = "";
		if (!class_exists('RealexHelperCustomerData')) {
			require(JPATH_SITE . '/plugins/vmpayment/realex/realex/helpers/customerdata.php');
		}
		$this->_currentMethod = $method;
		$realexInterface = $this->_loadRealexInterface();
		if ($realexInterface == NULL) {
			vmdebug('renderPluginName', $method);
			return;
		}
		$realexInterface->getCustomerData();
		$extraInfo = '';
		if ($realexInterface->customerData->getVar('selected_method') == $method->virtuemart_paymentmethod_id) {
			//$extraInfo = $realexInterface->getExtraPluginInfo();
			//$extraInfo['cc_number'] =$realexInterface->cc_mask($extraInfo['cc_number']);
		}


		$logos = $method->payment_logos;
		if (!empty($logos)) {
			$display_logos = $this->displayLogos($logos) . ' ';
		}
		$payment_name = $method->payment_name;

		$html = $this->renderByLayout('render_pluginname', array(
		                                                        'where'                       => $where,
		                                                        'shop_mode'                   => $method->shop_mode,
		                                                        'virtuemart_paymentmethod_id' => $method->virtuemart_paymentmethod_id,
		                                                        'logo'                        => $display_logos,
		                                                        'payment_name'                => $payment_name,
		                                                        'extraInfo'                   => $extraInfo,
		                                                        'payment_description'         => $method->payment_desc,
		                                                   ));
		$html = $this->rmspace($html);
		return $html;
	}

	private function rmspace ($buffer) {
		return preg_replace('~>\s*\n\s*<~', '><', $buffer);
	}

	public function plgVmgetPaymentCurrency ($virtuemart_paymentmethod_id, &$paymentCurrencyId) {

		if (!($method = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return null; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($method->payment_element)) {
			return false;
		}
		$this->getPaymentCurrency($method);

		$paymentCurrencyId = $method->payment_currency;
		//! $method->payment_currency might not be correct
	}

	/**
	 * plgVmOnCheckAutomaticSelectedPayment
	 * Checks how many plugins are available. If only one, the user will not have the choice. Enter edit_xxx page
	 * The plugin must check first if it is the correct type
	 * @param VirtueMartCart cart: the cart object
	 * @return null if no plugin was found, 0 if more then one plugin was found,  virtuemart_xxx_id if only one plugin is found
	 *
	 */
	public function plgVmOnCheckAutomaticSelectedPayment (VirtueMartCart $cart, array $cart_prices = array()) {
		return $this->onCheckAutomaticSelected($cart, $cart_prices);
	}

	/**
	 * This method is fired when showing the order details in the frontend.
	 * It displays the method-specific data.
	 *
	 * @param integer $order_id The order ID
	 * @return mixed Null for methods that aren't active, text (HTML) otherwise
	 */
	public function plgVmOnShowOrderFEPayment ($virtuemart_order_id, $virtuemart_paymentmethod_id, &$payment_name) {
		$this->onShowOrderFE($virtuemart_order_id, $virtuemart_paymentmethod_id, $payment_name);

		return true;
	}


	/**
	 * This method is fired when showing when priting an Order
	 * It displays the the payment method-specific data.
	 *
	 * @param integer $_virtuemart_order_id The order ID
	 * @param integer $method_id  method used for this order
	 * @return mixed Null when for payment methods that were not selected, text (HTML) otherwise
	 */
	public function plgVmonShowOrderPrintPayment ($order_number, $method_id) {
		return $this->onShowOrderPrint($order_number, $method_id);
	}

	public function plgVmDeclarePluginParamsPayment ($name, $id, &$data) {
		return $this->declarePluginParams('payment', $name, $id, $data);
	}

	public function plgVmSetOnTablePluginParamsPayment ($name, $id, &$table) {
		return $this->setOnTablePluginParams($name, $id, $table);
	}


	public function plgVmOnPaymentNotification () {

		if (!class_exists('VirtueMartModelOrders')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
		}
		$notificationTask = vRequest::getCmd('notificationTask', '');
		// this is not our notification
		if (empty($notificationTask)) {
			return;
		}
		if ($notificationTask == 'handleRedirect') {
			$this->handleRedirect();
		} elseif ($notificationTask == 'handleRemoteDccForm') {
			$this->handleRemoteDccForm();
		} elseif ($notificationTask == 'handleRemoteCCForm') {
			$this->handleRemoteCCForm();
		} elseif ($notificationTask == 'handleVerify3D') {
			$this->handleVerify3D();
		} elseif ($notificationTask == 'handle3DSRequest') {
			$this->handle3DSRequest();
		}
		return true;
	}

	private function handleRedirect () {

		$realex_data = vRequest::getPost();

		$this->debugLog('plgVmOnPaymentNotification :' . var_export($realex_data, true), 'debug');

		$order_number = $realex_data['ORDER_ID'];
		if (empty($order_number)) {
			return FALSE;
		}

		if (!($virtuemart_order_id = VirtueMartModelOrders::getOrderIdByOrderNumber($order_number))) {
			return FALSE;
		}

		if (!($payments = $this->getDatasByOrderId($virtuemart_order_id))) {
			return FALSE;
		}

		$this->_currentMethod = $this->getVmPluginMethod($payments[0]->virtuemart_paymentmethod_id);
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			//echo "selectedThisElement PB";
			return FALSE;
		}

		$realexInterface = $this->_loadRealexInterface();

		if (!$realexInterface->validateResponseHash($realex_data)) {
			$this->redirectToCart();
			return FALSE;
		}

		$result = $realex_data['RESULT'];
		$orderModel = VmModel::getModel('orders');
		$order = $orderModel->getOrder($virtuemart_order_id);
		$realexInterface->setOrder($order);
		$cart = VirtueMartCart::getCart();
		$realexInterface->setCart($cart, false);

		$order_history = array();
		$success = ($result == $realexInterface::RESPONSE_CODE_SUCCESS);
		if ($success) {
			$status = $this->_currentMethod->status_success;

			$amountInCurrency = vmPSPlugin::getAmountInCurrency($order['details']['BT']->order_total, $order['details']['BT']->order_currency);
			$currencyDisplay = CurrencyDisplay::getInstance($cart->pricesCurrency);

			$order_history['comments'] = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_STATUS_CONFIRMED', $amountInCurrency['display'], $order_number);

			if (isset($realex_data['DCCCHOICE']) and $realex_data['DCCCHOICE'] == $realexInterface::RESPONSE_DCC_CHOICE_YES) {
				$order_history['comments'] .= "<br />";
				$order_history['comments'] .= vmText::sprintf('VMPAYMENT_REALEX_DCC_PAY_OWN_CURRENCY_CHARGED', $this->getCardHolderAmount($realex_data['DCCMERCHANTAMOUNT']), $realex_data['DCCMERCHANTCURRENCY'], $this->getCardHolderAmount($realex_data['DCCCARDHOLDERAMOUNT']), $realex_data['DCCCARDHOLDERCURRENCY']);
			}

		} else {
			/**
			 * Note: If a transaction is processed through your account that triggers one of the scenarios that you have set up to reject,
			 * HPP will send a post back to your response script with a Result Code of 110 and a relevant error message. The transaction will not be processed.
			 */

			$order_history['comments'] = vmText::_('VMPAYMENT_REALEX_PAYMENT_STATUS_CANCELLED');
			// here we check if wee need to add the message
			/*
			if ($realex_data['RESULT'] == (int)$realexInterface::RESPONSE_CODE_NOT_VALIDATED) {
				$order_history['comments'] .= "<br />";
				$order_history['comments'] .= $realex_data['MESSAGE'];
			}
			*/
			$status = $this->_currentMethod->status_canceled;
		}


		$order_history['customer_notified'] = true;
		$order_history['order_status'] = $status;
		$cardStorageResponse = $this->cardStorageResponse($realex_data, $virtuemart_order_id);
		if (isset($realex_data['REALWALLET_CHOSEN']) and  $realex_data['REALWALLET_CHOSEN'] == 1) {
			if ($cardStorageResponse) {
				$cardStorageResponseText = vmText::_('VMPAYMENT_REALEX_CARD_STORAGE_SUCCESS');
			} else {
				$cardStorageResponseText = vmText::_('VMPAYMENT_REALEX_CARD_STORAGE_FAILED');
			}
			$order_history['comments'] .= "<br />";
			$order_history['comments'] .= $cardStorageResponseText;
		}

		$db_values['payment_name'] = $this->renderPluginName($this->_currentMethod, 'order');
		$db_values['virtuemart_order_id'] = $virtuemart_order_id;
		$db_values['order_number'] = $order_number;
		$db_values['virtuemart_paymentmethod_id'] = $this->_currentMethod->virtuemart_paymentmethod_id;
		$db_values['realex_response_result'] = $realex_data['RESULT'];
		$db_values['realex_request_type_response'] = $realexInterface::REQUEST_TYPE_AUTH;
		$db_values['realex_response_pasref'] = isset($realex_data['PASREF']) ? $realex_data['PASREF'] : "";
		$db_values['realex_response_authcode'] = isset($realex_data['AUTHCODE']) ? $realex_data['AUTHCODE'] : "";
		$db_values['realex_fullresponse'] = json_encode($realex_data);
		$db_values['realex_fullresponse_format'] = 'json';

		$this->storePSPluginInternalData($db_values);

		$modelOrder = VmModel::getModel('orders');
		$modelOrder->updateStatusForOneOrder($virtuemart_order_id, $order_history, TRUE);
		if ($result == $realexInterface::RESPONSE_CODE_SUCCESS) {
			if (isset($payments[0]->realex_custom)) {
				$this->emptyCart($payments[0]->realex_custom, $order_number);
			}
		}
		$this->displayMessageToRealex($realexInterface, $realex_data, $success, $order_history['comments'], $payments[0]->virtuemart_paymentmethod_id);

	}


	private function initRealexInterface ($loadCDFromPost = true) {
		// TODO check if cart is empty
		$virtuemart_paymentmethod_id = vRequest::getInt('pm', false);

		$this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id);
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			vmError('Programmer error: missing the pm parameter');
			$this->redirectToCart();
			return FALSE;
		}

		$realexInterface = $this->_loadRealexInterface();
		$realexInterface->loadCustomerData($loadCDFromPost);

		$order_number = vRequest::getString('order_number', false);
		if (!($virtuemart_order_id = VirtueMartModelOrders::getOrderIdByOrderNumber($order_number))) {
			$this->redirectToCart();
			return FALSE;
		}
		$orderModel = VmModel::getModel('orders');
		$order = $orderModel->getOrder($virtuemart_order_id);
		$realexInterface->setOrder($order);
		$realexInterface->setPaymentCurrency();
		$realexInterface->setTotalInPaymentCurrency($order['details']['BT']->order_total);
		return $realexInterface;
	}

	private function handleRemoteDccForm () {

		$realexInterface = $this->initRealexInterface(false);
		$cart = VirtueMartCart::getCart();
		$realexInterface->setCart($cart, false);
		if (!($payments = $this->getDatasByOrderId($realexInterface->order['details']['BT']->virtuemart_order_id))) {
			$this->redirectToCart();
			return FALSE;
		}
		$dcc_payment = $realexInterface->getTransactionData($payments, array(
		                                                                    $realexInterface::REQUEST_TYPE_DCCRATE,
		                                                                    $realexInterface::REQUEST_TYPE_REALVAULT_DCCRATE
		                                                               ));
		if (!$dcc_payment) {
			$this->redirectToCart();
			return FALSE;
		}

		$this->handleRemoteCCForm($dcc_payment->realex_fullresponse);
		/*
				$realexInterface->confirmedOrderDccRequest($dcc_payment->realex_fullresponse);
				$this->updateOrderStatus($realexInterface->order);

				$this->customerData->clear();

				$cart->emptyCart();
				$submit_url = JURI::root() . 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginresponsereceived&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id . '&on=' . $realexInterface->order['details']['BT']->order_number . '&Itemid=' . vRequest::getInt('Itemid') . '&lang=' . vRequest::getCmd('lang', '');
				$app = JFactory::getApplication();
				$app->redirect(JRoute::_($submit_url));
		*/
	}

	private function handleRemoteCCForm ($response_dcc = NULL,$loadFromPost=true) {
		$realexInterface = $this->initRealexInterface($loadFromPost);
		$realvault = false;

		if (!JFactory::getUser()->guest AND $this->_currentMethod->realvault) {
			$saved_cc_selected = $this->customerData->getVar('saved_cc_selected');
			if ($saved_cc_selected > 0) {
				$realvault = $realexInterface->getStoredCCsData($saved_cc_selected);
				if (!$cvv_realvault = $realexInterface->validateCvv()) {
					$html = $realexInterface->displayRemoteCCForm();
					echo $html;
					return;
				}
				$realvault->cc_cvv_realvault = vRequest::getInt('cc_cvv_realvault', '');
			} else {
				if (!$realexInterface->validateRemoteCCForm()) {
					$html = $realexInterface->displayRemoteCCForm();
					echo $html;
					return;
				}
				$realexInterface->confirmedOrderRealVault($saved_cc_selected);
			}
		} else {

		}


		if ($this->_currentMethod->dcc AND empty($response_dcc)) {
			$response = $realexInterface->requestDccRate($realvault);
			$realexInterface->manageResponseDccRate($response);
			//$this->_storeRealexInternalData($response, $this->_currentMethod->virtuemart_paymentmethod_id, $realexInterface->order['details']['BT']->virtuemart_order_id, $realexInterface->order['details']['BT']->order_number, $realexInterface->request_type);
			$xml_response = simplexml_load_string($response);
			/*
			* 105: Card not supported by eDCC
			* 00: Card supported by eDCC
			*/
			$success = $realexInterface->isResponseSuccess($xml_response);
			if ($success) {
				$realexInterface->displayRemoteDCCForm($xml_response);
				return;
			} else {
				//vmError($xml_response->message);
				//$this->redirectToCart();
				//$response = $realexInterface->requestAuth();
				//$realexInterface->manageResponseRequestAuth($response);
			}

		}
		if ($realvault) {
			$pmt_type = $realvault->realex_saved_pmt_type;
		} else {
			$pmt_type = NULL;
		}
		if ($this->_currentMethod->threedsecure and $realexInterface->isCC3DSVerifyEnrolled($pmt_type)) {
			$response3DSVerifyEnrolled = $realexInterface->request3DSVerifyEnrolled($realvault);
			$realexInterface->manageResponse3DSVerifyEnrolled($response3DSVerifyEnrolled);
			$eci = $realexInterface->getEciFrom3DSVerifyEnrolled($response3DSVerifyEnrolled);
			if ($eci === false) {
				//$this->_storeRealexInternalData($response, $this->_currentMethod->virtuemart_paymentmethod_id, $realexInterface->order['details']['BT']->virtuemart_order_id, $realexInterface->order['details']['BT']->order_number, $realexInterface->request_type);
				$xml_response3DSVerifyEnrolled = simplexml_load_string($response3DSVerifyEnrolled);
				$result = (string)$xml_response3DSVerifyEnrolled->result;
				if ($result == $realexInterface::RESPONSE_CODE_SUCCESS) {
					$realexInterface->redirect3DSRequest($response3DSVerifyEnrolled);
					return;
				} else {
					// we should be here if Result=110 + enrolled =U // result=5xx and enrolled not available // result =220 (ENROLLED_RESULT_FATAL_ERROR)
					$this->redirectToCart();
					return FALSE;
				}
			} else {
				//$realexInterface->confirmedOrderRealVault($saved_cc_selected);
				$xml_response3DSVerifyEnrolled = simplexml_load_string($response3DSVerifyEnrolled);
				$xml_response3DSVerifyEnrolled->addChild('eci', $eci);
				$xml_response_dcc = simplexml_load_string($response_dcc);
				//$response = $realexInterface->requestAuth($response_dcc, $xml_response3DSVerifyEnrolled);
				if ($realvault) {
					$response = $realexInterface->requestReceiptIn($realvault, $xml_response_dcc, $xml_response3DSVerifyEnrolled);
				} else {
					$response = $realexInterface->requestAuth($xml_response_dcc, $xml_response3DSVerifyEnrolled);
				}
				$realexInterface->manageResponseRequestAuth($response);
			}

		} else {
			$realexInterface->confirmedOrderRealVault($saved_cc_selected);
			// TODO eci missing?
			$xml_response_dcc = NULL;
			if ($response_dcc) {
				$xml_response_dcc = simplexml_load_string($response_dcc);
			}
			$response = $realexInterface->requestAuth($xml_response_dcc);
			$realexInterface->manageResponseRequestAuth($response);
		}
		//$payments = $this->getDatasByOrderId($realexInterface->order['details']['BT']->virtuemart_order_id);
		$this->updateOrderStatus($realexInterface->order);
		$this->customerData->clear();
		$cart = VirtueMartCart::getCart();
		$cart->emptyCart();
		$submit_url = JURI::root() . 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginresponsereceived&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id . '&on=' . $realexInterface->order['details']['BT']->order_number . '&Itemid=' . vRequest::getInt('Itemid') . '&lang=' . vRequest::getCmd('lang', '');
		$app = JFactory::getApplication();
		$app->redirect(JRoute::_($submit_url));

	}

	/**
	 * @return bool
	 */
	private function handleVerify3D () {
		$realexInterface = $this->initRealexInterface();
		$cart = VirtueMartCart::getCart();
		$realexInterface->setCart($cart, false);

		$response3DSVerifyEnrolled = $realexInterface->request3DSVerifyEnrolled();
		$eci = $realexInterface->manageResponse3DSVerifyEnrolled($response3DSVerifyEnrolled);

		if (!$eci) {
			$realexInterface->redirect3dsRequest($response3DSVerifyEnrolled);
			return;
		}

		if ($eci !== false) {
			$realexInterface->confirmedOrderRealVault($saved_cc_selected);
			$xml_response3DSVerifyEnrolled = simplexml_load_string($response3DSVerifyEnrolled);
			$response = $realexInterface->requestAuth(NULL, $xml_response3DSVerifyEnrolled);
			$realexInterface->manageResponseRequestAuth($response);
			$xml_response = simplexml_load_string($response);
			$success = $realexInterface->isResponseSuccess($xml_response);
		} else {
			$success = false;
		}

		$order_history = array();

		if ($success) {
			$status = $this->_currentMethod->status_success;
			$amountValue = vmPSPlugin::getAmountInCurrency($realexInterface->order['details']['BT']->order_total, $realexInterface->order['details']['BT']->order_currency);
			$currencyDisplay = CurrencyDisplay::getInstance($realexInterface->cart->pricesCurrency);

			$order_history['comments'] = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_STATUS_CONFIRMED', $amountValue['display'], $realexInterface->order['details']['BT']->order_number);

		} else {
			$order_history['comments'] = vmText::_('VMPAYMENT_REALEX_PAYMENT_STATUS_CANCELLED');
			$status = $this->_currentMethod->status_canceled;
		}

		$order_history['customer_notified'] = true;
		$order_history['order_status'] = $status;

		$modelOrder = VmModel::getModel('orders');
		$modelOrder->updateStatusForOneOrder($realexInterface->order['details']['BT']->virtuemart_order_id, $order_history, TRUE);

		//$payments = $this->getDatasByOrderId($realexInterface->order['details']['BT']->virtuemart_order_id);

		//$html = $realexInterface->getResponseHTML($payments);
		$this->customerData->clear();
		$cart->emptyCart();
		$submit_url = JURI::root() . 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginresponsereceived&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id . '&on=' . $realexInterface->order['details']['BT']->order_number . '&Itemid=' . vRequest::getInt('Itemid') . '&lang=' . vRequest::getCmd('lang', '');
		$app = JFactory::getApplication();
		$app->redirect(JRoute::_($submit_url));

		return true;
	}

	private function handle3DSRequest () {
		$realexInterface = $this->initRealexInterface(false);
		$cart = VirtueMartCart::getCart();
		$realexInterface->setCart($cart, false);
		$saved_cc_selected = $this->customerData->getVar('saved_cc_selected');
		$realvault = false;
		if ($saved_cc_selected > 0) {
			$realvault = $realexInterface->getStoredCCsData($saved_cc_selected);
		}
		if (!($payments = $this->getDatasByOrderId($realexInterface->order['details']['BT']->virtuemart_order_id))) {
			$this->redirectToCart();
			return FALSE;
		}
		$dcc_payment = $realexInterface->getTransactionData($payments, array(
		                                                                    $realexInterface::REQUEST_TYPE_DCCRATE,
		                                                                    $realexInterface::REQUEST_TYPE_REALVAULT_DCCRATE
		                                                               ));
		if ($dcc_payment) {
			$xml_dcc_payment = simplexml_load_string($dcc_payment->realex_fullresponse);
		} else {
			$xml_dcc_payment=NULL;
		}

		$response3DSVerifysig = $realexInterface->request3DSVerifysig($realvault);
		$realexInterface->manageResponse3DSVerifysig($response3DSVerifysig);

		$eci = $realexInterface->getEciFrom3DSVerifysig($response3DSVerifysig, $this->_currentMethod->require_liability);
		$xml_response3DSVerifysig = simplexml_load_string($response3DSVerifysig);
		if ($eci !== false) {
			$xml_response3DSVerifysig->threedsecure->eci = $eci;
			$realexInterface->confirmedOrderRealVault($saved_cc_selected);
			if ($realvault) {
				$response = $realexInterface->requestReceiptIn($realvault, $xml_dcc_payment, $xml_response3DSVerifysig);
			} else {
				$response = $realexInterface->requestAuth($xml_dcc_payment, $xml_response3DSVerifysig);
			}

			$realexInterface->manageResponseRequestAuth($response);
			$xml_response = simplexml_load_string($response);
			$success = $realexInterface->isResponseSuccess($xml_response);
		} else {
			$success = false;
		}


		$order_history = array();
		$redirectToCart = false;
		if ($success) {
			$status = $this->_currentMethod->status_success;
			$amountValue = vmPSPlugin::getAmountInCurrency($realexInterface->order['details']['BT']->order_total, $realexInterface->order['details']['BT']->order_currency);
			$currencyDisplay = CurrencyDisplay::getInstance($realexInterface->cart->pricesCurrency);

			$order_history['comments'] = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_STATUS_CONFIRMED', $amountValue['display'], $realexInterface->order['details']['BT']->order_number);
			if (isset($xml_response->dccinfo) AND isset($xml_response->dccinfo->cardholderrate)) {
				$order_history['comments'] .= "<br />";
				if ($xml_response->dccinfo->cardholderrate != 1.0) {
					$order_history['comments'] .= vmText::sprintf('VMPAYMENT_REALEX_DCC_PAY_OWN_CURRENCY_CHARGED', $this->getCardHolderAmount($xml_response->dccinfo->merchantamount), $xml_response->dccinfo->merchantcurrency, $this->getCardHolderAmount($xml_response->dccinfo->cardholderamount), $xml_response->dccinfo->cardholdercurrency);
				} else {
					$order_history['comments'] .= vmText::sprintf('VMPAYMENT_REALEX_DCC_PAY_MERCHANT_CURRENCY', $this->getCardHolderAmount($xml_response->dccinfo->merchantamount), $xml_response->dccinfo->merchantcurrency);
				}
				$order_history['comments'] .= "<br />";
			} else {

			}
		} else {
			if ($realexInterface->isResponseDeclined($xml_response3DSVerifysig)) {
				$order_history['comments'] = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_DECLINED', $realexInterface->order['details']['BT']->order_number);
			} elseif ($realexInterface->isResponseWrongPhrase($xml_response3DSVerifysig)) {
				$order_history['comments'] = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_STATUS_CANCELLED', $realexInterface->order['details']['BT']->order_number);
				$redirectToCart = true;
			} elseif ($realexInterface->isResponseAlreadyProcessed($xml_response3DSVerifysig)) {
				$order_history['comments'] = $xml_response3DSVerifysig->message;
				$redirectToCart = true;
			} else {
				$order_history['comments'] = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_STATUS_CANCELLED', $realexInterface->order['details']['BT']->order_number);
			}
			$status = $this->_currentMethod->status_canceled;
		}

		$order_history['customer_notified'] = true;
		$order_history['order_status'] = $status;
		//	$this->updateOrderStatus($realexInterface->order, $redirectToCart);

		$modelOrder = VmModel::getModel('orders');
		$modelOrder->updateStatusForOneOrder($realexInterface->order['details']['BT']->virtuemart_order_id, $order_history, TRUE);

		/*
				$payments = $this->getDatasByOrderId($realexInterface->order['details']['BT']->virtuemart_order_id);

				$html = $realexInterface->getResponseHTML($payments);
				$this->customerData->clear();
				$cart = VirtueMartCart::getCart();
				$cart->emptyCart();
				vRequest::setVar('display_title', false);
				vRequest::setVar('html', $html);
				echo $html;
		*/
		//$html = $realexInterface->getResponseHTML($payments);
		if ($redirectToCart) {
			$this->redirectToCart();
		} else {
			$this->customerData->clear();
			$cart = VirtueMartCart::getCart();
			$cart->emptyCart();
			$submit_url = JURI::root() . 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginresponsereceived&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id . '&on=' . $realexInterface->order['details']['BT']->order_number . '&Itemid=' . vRequest::getInt('Itemid') . '&lang=' . vRequest::getCmd('lang', '');
			$app = JFactory::getApplication();
			$app->redirect(JRoute::_($submit_url));
		}


		return true;
	}

	private function cardStorageResponse ($realex_data, $virtuemart_order_id) {
		$orderModel = VmModel::getModel('orders');
		$order = $orderModel->getOrder($virtuemart_order_id);
		$virtuemart_user_id = $order['details']['BT']->virtuemart_user_id;
		if (isset($realex_data['REALWALLET_CHOSEN']) and  $realex_data['REALWALLET_CHOSEN'] == 0) {
			return true;
		}
		$realexInterface = $this->_loadRealexInterface();
		if (isset($realex_data['PAYER_SETUP']) and  $realex_data['PAYER_SETUP'] != $realexInterface::PAYER_SETUP_SUCCESS) {
			return false;
		}
		$fields = array(
			'SAVED_PAYER_REF',
			'SAVED_PMT_TYPE',
			'SAVED_PMT_REF',
			'SAVED_PMT_DIGITS',
			'SAVED_PMT_EXPDATE',
			'SAVED_PMT_NAME',
		);
		$userfield['virtuemart_user_id'] = $virtuemart_user_id;
		$userfield['virtuemart_paymentmethod_id'] = $this->_currentMethod->virtuemart_paymentmethod_id;
		foreach ($fields as $field) {
			if (isset($realex_data[$field])) {
				if ($field == 'SAVED_PMT_DIGITS') {
					$realex_data[$field] = shopFunctionsF::mask_string($realex_data[$field], '*');
				}
				if ($field == 'SAVED_PMT_EXPDATE') {
					$realex_data[$field] = substr($realex_data[$field], 0, 2) . "/" . substr($realex_data[$field], -2);
				}
				$userfield['realex_' . strtolower($field)] = $realex_data[$field];
			}
		}
		if (!class_exists('VmTableData')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmtabledata.php');
		}
		JLoader::import('joomla.plugin.helper');
		JPluginHelper::importPlugin('vmuserfield');
		$app = JFactory::getApplication();
		$data = array();
		$value = '';
		$app->triggerEvent('plgVmPrepareUserfieldDataSave', array(
		                                                         'pluginrealex',
		                                                         'realex',
		                                                         &$userfield,
		                                                         &$value,
		                                                         $userfield
		                                                    ));

		return true;
	}

	private function displayMessageToRealex ($realexInterface, $realex_data, $success, $order_history_comments, $virtuemart_paymentmethod_id) {

		$declined_message = '';
		if (!$success) {
			$try_again = $this->processResult($realex_data['RESULT'], $declined_message);
		}

		$return_success = JURI::root(false) . 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginresponsereceived&on=' . $realex_data['ORDER_ID'] . '&pm=' . $virtuemart_paymentmethod_id . '&Itemid=' . vRequest::getInt('Itemid') . '&lang=' . vRequest::getCmd('lang', '');
		$return_declined = JURI::root() . 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginUserPaymentCancel&Itemid=' . vRequest::getInt('Itemid') . '&lang=' . vRequest::getCmd('lang', '');
		$shop_name = $realexInterface->getVendorInfo('vendor_store_name');
		$html = $this->renderByLayout('redirect_notify', array(
		                                                      "success"                => $success,
		                                                      "shop_name"              => $shop_name,
		                                                      "order_number"           => $realex_data['ORDER_ID'],
		                                                      "return_success"         => $return_success,
		                                                      "return_declined"        => $return_declined,
		                                                      "declined_message"       => $declined_message,
		                                                      "order_history_comments" => $order_history_comments,
		                                                 ));
// This echoes the message on Realex

		echo $html;
	}

	private function processResult ($result, &$declined_message) {
		$try_again = true;
		switch ($result) {

			case '101':
			case '102':
			case '103':
			case $result >= 200 && $result < 300:
			case $result >= 300 && $result < 400:
				$declined_message = vmText::_('VMPAYMENT_REALEX_ERROR_TRY_AGAIN');
				$try_again = false;
				break;

			case $result >= 500 && $result < 600:
				$declined_message = vmText::_('VMPAYMENT_REALEX_ERROR_CHOOSE_ANOTHER_PAYMENT');
				break;
			case '666':
				$declined_message = vmText::_('VMPAYMENT_REALEX_ERROR_CHOOSE_ANOTHER_PAYMENT');
				break;
			default:
				$declined_message = vmText::_('VMPAYMENT_REALEX_ERROR_TRY_AGAIN');

				break;
		}
		return $try_again;
	}

	function getCardHolderAmount ($dcccardholderamount) {
		return sprintf("%01.2f", $dcccardholderamount * 0.01);
	}

	/*******************/
	/* Credit Card API */
	/*******************/
	public function _getCVVImages ($cvv_images) {
		$img = '';
		if ($cvv_images) {
			$img = $this->displayLogos($cvv_images);
			$img = str_replace('"', "'", $img);
		}
		return $img;
	}


	public function plgVmOnRealexDeletedStoredCard ($element, $storedCC, &$success) {
		if (!$this->selectedThisElement($element)) {
			return FALSE;
		}
		if (!isset($storedCC['virtuemart_paymentmethod_id'])) {
			return FALSE;
		}
		if (!($this->_currentMethod = $this->getVmPluginMethod($storedCC['virtuemart_paymentmethod_id']))) {
			return FALSE; // Another method was selected, do nothing
		}
		$realexInterface = $this->_loadRealexInterface();
		if (!$realexInterface) {
			return false;
		}
		$success = $realexInterface->deleteStoredCard($storedCC);
		return $success;
	}


	function _storeRealexInternalData ($response, $virtuemart_paymentmethod_id, $virtuemart_order_id, $order_number, $request_type) {
		$xml_response = simplexml_load_string($response);
		//$db_values['payment_name'] = $this->renderPluginName($this->_currentMethod, 'order');
		$db_values['virtuemart_order_id'] = $virtuemart_order_id;
		$db_values['order_number'] = $order_number;
		$db_values['virtuemart_paymentmethod_id'] = $virtuemart_paymentmethod_id;
		$db_values['realex_response_result'] = (string)$xml_response->result;
		if (isset($xml_response->pasref)) {
			$db_values['realex_response_pasref'] = (string)$xml_response->pasref;
		}
		if (isset($xml_response->authcode)) {
			$db_values['realex_response_authcode'] = (string)$xml_response->authcode;
		}
		$db_values['realex_request_type_response'] = $request_type;
		$db_values['realex_fullresponse_format'] = 'xml';
		$db_values['realex_fullresponse'] = $response;


		$this->storePSPluginInternalData($db_values);
		return $db_values;
	}


	private function displayExtraPluginNameInfo ($activeMethod) {
		$this->_currentMethod = $activeMethod;

		$realexInterface = $this->_loadRealexInterface();
		$realexInterface->loadCustomerData();
		$extraInfo = $realexInterface->displayExtraPluginInfo();

		return $extraInfo;

	}


	static function _createKeyFolder () {
		if (!class_exists('vmCrypt')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmcrypt.php');
		}

		if (!vmEncrypt::createEncryptFolder()) {

			$uri = JFactory::getURI();
			$link = $uri->root() . 'administrator/index.php?option=com_virtuemart&view=config';
			VmError(vmText::sprintf('VMUSERFIELD_REALEX_CANNOT_STORE_CONFIG', '<a href="' . $link . '">' . $link . '</a>', vmText::_('COM_VIRTUEMART_ADMIN_CFG_MEDIA_FORSALE_PATH')));

		}

		return FALSE;
	}
} // class

// No closing tag
