<?php

defined('_JEXEC') or die('Direct Access to ' . basename(__FILE__) . 'is not allowed.');

/**
 *
 * @package    VirtueMart
 * @subpackage vmpayment
 * @version $Id: amazon.php 7939 2014-05-16 17:52:12Z alatak $
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - ${PHING.VM.RELDATE} VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 *
 */
if (!class_exists('vmPSPlugin')) {
	require(JPATH_VM_PLUGINS . DS . 'vmpsplugin.php');
}
/**
 * Class plgVmpaymentAmazon
 *     * payments.amazon.co.uk
 * payments.amazon.de
 * https://sellercentral.amazon.co.uk
 */
class plgVmpaymentAmazon extends vmPSPlugin {

	// instance of class

	function __construct (& $subject, $config) {

		//if (self::$_this)
		//   return self::$_this;
		parent::__construct($subject, $config);

		$this->_loggable = TRUE;
		$this->tableFields = array_keys($this->getTableSQLFields());
		$this->_tablepkey = 'id'; //virtuemart_paybox_id';
		$this->_tableId = 'id'; //'virtuemart_paybox_id';
		$varsToPush = $this->getVarsToPush();
		//$this->setEncryptedFields(array('params'));
		$this->setConfigParameterable($this->_configTableFieldName, $varsToPush);

		if (method_exists($this, 'setCryptedFields')) {
			$this->setCryptedFields(array('accessKey', 'secretKey'));
		}
		$inlucde_path = get_include_path();
		$amazon_library = JPATH_SITE . '/plugins/' . $this->_type . '/' . $this->_name . '/' . $this->_name . '/library/PaywithAmazonSDK-php-1.0.7_UK/src';

		//set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__) . "/../../."));
		set_include_path($amazon_library);

		//require_once "OffAmazonPayments/.autoloader.php";
		if (!class_exists('OffAmazonPaymentsService_Client')) {
			require('OffAmazonPaymentsService/Client.php');
		}

	}

	protected function getVmPluginCreateTableSQL () {

		return $this->createTableSQL('Payment Amazon Table');
	}

	function getTableSQLFields () {

		$SQLfields = array(
			'id'                          => 'int(1) unsigned NOT NULL AUTO_INCREMENT',
			'virtuemart_order_id'         => 'int(11) UNSIGNED DEFAULT NULL',
			'order_number'                => 'char(64) DEFAULT NULL',
			'virtuemart_paymentmethod_id' => 'mediumint(1) UNSIGNED DEFAULT NULL',
			'payment_name'                => 'varchar(5000)',
			'payment_order_total'         => 'decimal(15,5) NOT NULL DEFAULT \'0.00000\'',
			'payment_currency'            => 'smallint(1)',
			'email_currency'              => 'smallint(1)',
			'recurring'                   => 'varchar(512)',
			'recurring_number'            => 'smallint(1)',
			'recurring_periodicity'       => 'smallint(1)',
			'cost_per_transaction'        => 'decimal(10,2) DEFAULT NULL',
			'cost_percent_total'          => 'decimal(10,2) DEFAULT NULL',
			'tax_id'                      => 'smallint(1) DEFAULT NULL',
			'amazon_fullresponse'         => 'text DEFAULT NULL'
		);
		return $SQLfields;
	}

	function plgVmDisplayLogin (VirtuemartViewUser $user, &$html, $from_cart = FALSE) {
return NULL;
		// only to display it in the cart, not in list orders view
		if (!$from_cart) {
			return NULL;
		}
		$task = vRequest::getString('task', '');
		if ($task == 'editaddresscheckout') {
			return null;
		}
		$vendorId = 1;
		if (!class_exists('VirtueMartCart')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		}

		$cart = VirtueMartCart::getCart();
		if ($cart->BT != 0 or $cart->virtuemart_paymentmethod_id) {
			//return;
		}
		if ($this->getPluginMethods($vendorId) === 0) {
			if (empty($this->_name)) {
				$app = JFactory::getApplication();
				$app->enqueueMessage(vmText::_('COM_VIRTUEMART_CART_NO_' . strtoupper($this->_psType)));
				return FALSE;
			} else {
				return FALSE;
			}
		}
		$signInButton = $this->renderSignInButton('login');
		$html = implode("\n", $signInButton);

	}

	function plgVmOnCheckoutAdvertise ($cart, &$payment_advertise) {

		$vendorId = 1;

		if ($this->getPluginMethods($cart->vendorId) === 0) {
			return FALSE;
		}
		$payment_advertise = $this->renderSignInButton('advertise');

	}

	/**
	 * @param $product
	 * @param $productDisplay
	 * @return bool
	 */
	function plgVmOnProductDisplayPayment ($product, &$productDisplay) {

		$vendorId = 1;
		if ($this->getPluginMethods($vendorId) === 0) {
			return FALSE;
		}

		$productDisplay = $this->renderSignInButton('product');
		return TRUE;
	}


	private function renderSignInButton ($sign_in_display) {
		$display = array();
		if (!class_exists('VirtueMartCart')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		}
		$this->debugLog($sign_in_display, "renderSignInButton", 'debug');
		$cart = VirtueMartCart::getCart();
		foreach ($this->methods as $this->_currentMethod) {
			if ($this->checkConditionSignIn($sign_in_display)) {
				$amazonOrderReferenceId = $this->getAmazonOrderReferenceId();
				$client = $this->getOffAmazonPaymentsService_Client();
				$buttonWidgetImageURL = $this->getButtonWidgetImageURL();
				if (!empty($buttonWidgetImageURL)) {

					$this->addWidgetUrlScript($client);

					$redirect_page = $this->getRenderAddressbookWalletRedirectPage($cart);
					$display[] = $this->renderByLayout('signin', array(
					                                                  'buttonWidgetImageURL'        => $buttonWidgetImageURL,
					                                                  'virtuemart_paymentmethod_id' => $this->_currentMethod->virtuemart_paymentmethod_id,
					                                                  'sellerId'                    => $this->_currentMethod->sellerId,
					                                                  'amazonOrderReferenceId'      => $amazonOrderReferenceId,
					                                                  'redirect_page'               => $redirect_page,
					                                                  'sign_in_display'             => $sign_in_display,
					                                             ));
				}
			}

		}
		return $display;
	}

	function getRenderAddressbookWalletRedirectPage ($cart) {
		$url = 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginnotification&notificationTask=renderAddressbookWallet&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id . '&Itemid=' . vRequest::getInt('Itemid') . '&lang=' . vRequest::getCmd('lang', '');
		$AmazonOrderReferenceId = $this->getAmazonOrderReferenceId();
		if ($AmazonOrderReferenceId) {
			$url .= '&session=' . $AmazonOrderReferenceId;
		}
		return JRoute::_($url, $cart->useXHTML, $useSSL);

	}

	private function checkConditionSignIn ($sign_in_display) {
		$cart_prices = array();
		if (!class_exists('VirtueMartCart')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		}
		$cart = VirtueMartCart::getCart();
		if ($this->doSignInDisplay($sign_in_display) && $this->checkConditions($cart, $this->_currentMethod, $cart_prices)) {
			return true;
		}
		return false;
	}

	private function doSignInDisplay ($sign_in_display) {
		if (in_array($sign_in_display, $this->_currentMethod->sign_in_display)) {
			return true;
		}
		return false;

	}

	private function getWidgetURL () {
		$region = $this->_currentMethod->region;
		$region_europe = array('UK', 'DE');

		$url = '';
		if (in_array($region, $region_europe)) {
			if ($this->_method->shop_mode == 'sandbox') {
				$url = 'https://static-eu.payments-amazon.com/OffAmazonPayments/' . strtolower($region) . '/sandbox/js/Widgets.js';
			} else {
				$url = 'https://static-eu.payments-amazon.com/OffAmazonPayments/' . strtolower($region) . '/js/Widgets.js';
			}
			$url .= '?sellerId=' . $this->_method->sellerId;
		} else {
			if ($this->_currentMethod->environment == 'sandbox') {
				$url = $this->_currentMethod->sandbox_signin;
			} else {
				$url = $this->_currentMethod->production_signin;
			}
		}
		return $url;
	}

	private function  getButtonWidgetImageURL () {
		$region = $this->_currentMethod->region;
		$region_europe = array('UK', 'DE');

		$url = '';

		if (in_array($region, $region_europe)) {
			if ($region == "UK") {
				$domain = "co.uk";
			} else {
				$domain = "de";
			}
			if ($this->_currentMethod->environment == 'sandbox') {
				$mode = "-sandbox";
			} else {
				//TODO
				$mode = "";
			}
			$url = "https://payments" . $mode . ".amazon." . $domain . "/gp/widgets/button?sellerId=" . $this->_currentMethod->sellerId . "&size=" . $this->_currentMethod->sign_in_widget_size . "&color=" . $this->_currentMethod->sign_in_widget_color . "";
		} else {
			if ($this->_currentMethod->environment == 'sandbox') {
				$url = $this->_currentMethod->sandbox_signin;
			} else {
				$url = $this->_currentMethod->production_signin;
			}
		}

		return $url;
	}

	/**
	 * @return null
	 */
	public function plgVmOnPaymentNotification () {

		$notificationTask = vRequest::getCmd('notificationTask', '');
		$validNotificationTasks = array('renderAddressbookWallet', 'returnRenderAddressbookWallet');

		if (!in_array($notificationTask, $validNotificationTasks)) {
			return;
		}

		$virtuemart_paymentmethod_id = vRequest::getInt('pm', 0);
		if (!($this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			$this->debug('THIS SHOULD NOT HAPPENNED', 'plgVmOnPaymentNotification', 'debug');
			return NULL; // Another method was selected, do nothing
		}

		$this->$notificationTask($amazonOrderReferenceId);


	}

	function renderAddressbookWallet ($amazonOrderReferenceId) {
		$client = $this->getOffAmazonPaymentsService_Client();
		$this->addWidgetUrlScript($client);
		$redirect_page = JRoute::_('index.php?option=com_virtuemart&view=pluginresponse&task=pluginnotification&format=raw&notificationTask=returnRenderAddressbookWallet&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id . '&Itemid=' . vRequest::getInt('Itemid') . '&lang=' . vRequest::getCmd('lang', ''), $cart->useXHTML, $useSSL);
		$amazonOrderReferenceId = vRequest::getString('session', '');
		if (empty($amazonOrderReferenceId)) {
			$this->debug('no $amazonOrderReferenceId', 'renderAddressbookWallet', 'debug');
			return;
		}
		$this->setAmazonOrderReferenceId($amazonOrderReferenceId);

		$cart = VirtueMartCart::getCart();
		$cart->virtuemart_paymentmethod_id = vRequest::getInt('pm');
		$cart->setCartIntoSession();
		$onlyDigitalGoods = $this->isOnlyDigitalGoods($cart);
		$html = $this->renderByLayout('addressbook_wallet', array(
		                                                         'virtuemart_paymentmethod_id' => $this->_currentMethod->virtuemart_paymentmethod_id,
		                                                         'sellerId'                    => $this->_currentMethod->sellerId,
		                                                         'addressbook_designWidth'     => $this->getPixelValue($this->_currentMethod->addressbook_designWidth),
		                                                         'addressbook_designHeight'    => $this->getPixelValue($this->_currentMethod->addressbook_designHeight),
		                                                         'wallet_designWidth'          => $this->getPixelValue($this->_currentMethod->wallet_designWidth),
		                                                         'wallet_designHeight'         => $this->getPixelValue($this->_currentMethod->wallet_designHeight),
		                                                         'amazonOrderReferenceId'      => $amazonOrderReferenceId,
		                                                         'renderAddressBook'           => (!$onlyDigitalGoods),
		                                                         'redirect_page'               => $redirect_page,
		                                                    ));
		echo $html;
	}

	private function returnRenderAddressbookWallet () {
		$this->setAmazonAction('returnRenderAddressbookWallet');

		$this->saveAmazonPartialShipmentAddressIncart();
		$redirect_page = JRoute::_("index.php?option=com_virtuemart&view=cart" . $taskRoute, true, VmConfig::get('useSSL', 0));
		$app = JFactory::getApplication();
		$app->redirect($redirect_page);

	}

	static $widgetScriptLoaded = false;

	private function addWidgetUrlScript ($client) {
		if (!self::$widgetScriptLoaded) {
			$widgetURL = $client->getMerchantValues()->getWidgetUrl();
			$doc = JFactory::getDocument();
			JHTML::script('', $widgetURL, false);
			self::$widgetScriptLoaded = true;
		}

	}

	/**
	 * @param $cart
	 * @return bool
	 */
	private function isOnlyDigitalGoods ($cart) {
		$weight = $this->getOrderWeight($cart, 'GR');
		return !(boolean)$weight;
	}

	/**
	 * $requiredKeys = array('merchantId',
	 * 'accessKey',
	 * 'secretKey',
	 * 'region',
	 * 'environment',
	 * 'applicationName',
	 * 'applicationVersion'
	 */
	private function  getOffAmazonPaymentsService_Client () {


		$config['merchantId'] = $this->_currentMethod->sellerId;
		$config['accessKey'] = $this->_currentMethod->accessKey;
		$config['secretKey'] = $this->_currentMethod->secretKey;
		$config['applicationName'] = 'VirtueMart';
		$config['applicationVersion'] = '${PHING.VM.RELEASE}';
		$config['region'] = $this->_currentMethod->region;
		$config['environment'] = $this->_currentMethod->environment;

		if ($this->_currentMethod->region == "other") {
			$prefix = $this->_currentMethod->environment;
			$serviceURL = $prefix . "_serviceURL";
			$widgetURL = $prefix . "_widgetURL";
			$config['serviceURL'] = $this->_currentMethod->$serviceURL;
			$config['widgetURL'] == $this->_currentMethod->$widgetURL;
		}


		try {
			$client = new OffAmazonPaymentsService_Client($config);

		} catch (Exception $e) {
			$this->amazonError($e->getMessage(), $e->getCode());
			return NULL;
		}

		return $client;
	}

	/**
	 * @return null|string
	 */
	private function getPlatformId () {
		if ($this->_currentMethod->region == "UK") {
			return "AA3KB5JD2CWIH";
		}
		// TODO this is not the correct one
		if ($this->_currentMethod->region == "DE") {
			return "AA3KB5JD2CWIH";
		}
		return NULL;
	}


	/**
	 * @param VirtueMartCart $cart
	 */
	function plgVmOnCheckoutCheckDataPayment (VirtueMartCart $cart) {


	}

	private function getSellerNote () {
		if ($this->_currentMethod->environment != 'sandbox' OR $this->_currentMethod->sandbox_error_simulation == 0) {
			return NULL;
		}

		if ($this->_currentMethod->sandbox_error_simulation != 'AmazonClosed') {
			$simString = '{"SandboxSimulation":{"State":"Closed","ReasonCode":"AmazonClosed"}';
		} elseif ($this->_currentMethod->sandbox_error_simulation != 'InvalidPaymentMethod') {
			$simString = '{"SandboxSimulation": {"State":"Declined","ReasonCode":"InvalidPaymentMethod","PaymentMethodUpdateTimeInMins":100}';
		}


		return urlencode($simString);


	}

	private function getSellerNoteAuthorization () {
		if ($this->_currentMethod->sandbox_error_simulation != 'authorization_InvalidPaymentMethod') {
			$simString = '{"SandboxSimulation": {"State":"Declined","ReasonCode":"InvalidPaymentMethod","PaymentMethodUpdateTimeInMins":100}';
		}
	}


	/**
	 * @param $cart
	 * @param $order
	 * @return bool|null
	 */
	function plgVmConfirmedOrder ($cart, $order) {

		if (!($this->_currentMethod = $this->getVmPluginMethod($order['details']['BT']->virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			return FALSE;
		}

		$client = $this->getOffAmazonPaymentsService_Client();
		if (!$this->updateAmazonFullShipmentAddressInOrder($client, $cart, $order)) {
			return FALSE;
		}
		if (!$this->setOrderDetails($client, $cart, $order)) {
			return FALSE;
		}
		$this->confirmPurchase($client);


		return;
	}

	/**
	 * @return bool
	 */
	function setOrderDetails ($client,$cart, $order) {
		if (!class_exists('OffAmazonPaymentsService_Model_OrderReferenceAttributes')) {
			require('OffAmazonPaymentsService/Model/OrderReferenceAttributes.php');
		}
		if (!class_exists('OffAmazonPaymentsService_Model_OrderTotal')) {
			require('OffAmazonPaymentsService/Model/OrderTotal.php');
		}
		if (!class_exists('OffAmazonPaymentsService_Model_SellerOrderAttributes')) {
			require('OffAmazonPaymentsService/Model/SellerOrderAttributes.php');
		}
		$amazonOrderReferenceId = $this->getAmazonOrderReferenceId();
		if (empty($amazonOrderReferenceId)) {
			$this->amazonError('plgVmOnCheckoutCheckDataPayment, No $amazonOrderReferenceId');
			return FALSE;
		}
		try {

			$setOrderReferenceDetailsRequest = new OffAmazonPaymentsService_Model_SetOrderReferenceDetailsRequest();
			$setOrderReferenceDetailsRequest->setSellerId($this->_currentMethod->sellerId);
			$setOrderReferenceDetailsRequest->setAmazonOrderReferenceId($amazonOrderReferenceId);
			$setOrderReferenceDetailsRequest->setOrderReferenceAttributes(new OffAmazonPaymentsService_Model_OrderReferenceAttributes());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setOrderTotal(new OffAmazonPaymentsService_Model_OrderTotal());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getOrderTotal()->setCurrencyCode($this->getCurrencyCode3($client));
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getOrderTotal()->setAmount($this->getTotalInPaymentCurrency($client, $order['details']['BT']->order_total,  $cart->pricesCurrency));
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setSellerNote($this->getSellerNote());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setSellerOrderAttributes(new OffAmazonPaymentsService_Model_SellerOrderAttributes());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getSellerOrderAttributes()->setSellerOrderId($order['details']['BT']->order_number);
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getSellerOrderAttributes()->setStoreName($this->getStoreName());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getSellerOrderAttributes()->setCustomInformation($order['details']['BT']->customer_note);
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setPlatformId($this->getPlatformId());

			$client->setOrderReferenceDetails($setOrderReferenceDetailsRequest);
		} catch (Exception $e) {
			$this->amazonError($e->getMessage(), $e->getCode());
			$this->clearAmazonSession();
			return FALSE;
		}

		return true;
	}

	function updateAmazonFullShipmentAddressInOrder ($client, $cart, $order) {
		$this->debug($client, 'saveAmazonPartialShipmentAddressIncart', 'debug');
		$onlyDigitalGoods = $this->isOnlyDigitalGoods($cart);
		if ($onlyDigitalGoods) {
			return;
		}

		$physicalDestination = $this->getAmazonShipmentAddress();
		if (!$physicalDestination) {
			return;
		}

		$orderModel = VmModel::getModel('orders');
		$_userInfoData['virtuemart_order_id'] = $order['details']['BT']->virtuemart_order_id;
		$_userInfoData['address_type'] = 'ST';

		$prefix = 'shipto_';
		$_userInfoData = array(
			$prefix . 'title'                 => "&nbsp;",
			$prefix . 'first_name'            => "&nbsp;",
			$prefix . 'middle_name'           => "&nbsp;",
			$prefix . 'last_name'             => $physicalDestination->GetName(),
			$prefix . 'address_1'             => $physicalDestination->GetAddressLine1(),
			$prefix . 'address_2'             => $physicalDestination->GetAddressLine2(),
			$prefix . 'address_3'             => $physicalDestination->GetAddressLine3(),
			$prefix . 'district'              => $physicalDestination->GetDistrict(),
			$prefix . 'zip'                   => $physicalDestination->GetPostalCode(),
			$prefix . 'city'                  => $physicalDestination->GetCity(),
			$prefix . 'virtuemart_country_id' => shopFunctions::getCountryIDByName($physicalDestination->GetCountryCode()),
			$prefix . 'state'                 => $physicalDestination->GetStateOrRegion(),
			$prefix . 'phone_1'               => $physicalDestination->GetPhone(),
			'address_type'                    => 'ST'
		);
		$order_userinfosTable = $orderModel->getTable('order_userinfos');
		$order_userinfosTable->load($virtuemart_order_id, 'virtuemart_order_id', " AND address_type='ST'");
		if (!$order_userinfosTable->bindChecknStore($_userInfoData, true)) {
			vmError($order_userinfosTable->getError());
			return false;
		}

return true;
	}

	/**
	 *
	 */
	private function confirmPurchase ($client) {
		try {
			$confirmOrderReferenceRequest = new OffAmazonPaymentsService_Model_ConfirmOrderReferenceRequest();
			$confirmOrderReferenceRequest->setAmazonOrderReferenceId($this->getAmazonOrderReferenceId());
			$confirmOrderReferenceRequest->setSellerId($this->_currentMethod->sellerId);
			$client->confirmOrderReference($confirmOrderReferenceRequest);
		} catch (Exception $e) {
			$this->amazonError($e->getMessage(), $e->getCode());
			return;
		}
	}


	function plgVmgetPaymentCurrency ($virtuemart_paymentmethod_id, &$paymentCurrencyId) {

		if (!($method = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($method->payment_element)) {
			return FALSE;
		}
		$client = $this->getOffAmazonPaymentsService_Client();
		$method->payment_currency = $this->getCurrencyId($client);

		$paymentCurrencyId = $method->payment_currency;
		$client = $this->getOffAmazonPaymentsService_Client();

		return TRUE;
	}


	function plgVmOnPaymentResponseReceived (&$html) {

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

		$virtuemart_paymentmethod_id = vRequest::getInt('pm', 0);

		if (!($this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			return NULL;
		}

		$html = "We will send you an email confirmation with your order details shortly";
		$html .= "Our order number";
		$html .= "Amazon Reference";
		$html .= "Go tot payments.amazon... to see your payment history and other account information.";
		vRequest::setVar('display_title', false);
		vRequest::setVar('html', $html);
		return true;
	}


	function plgVmOnUserPaymentCancel () {

		if (!class_exists('VirtueMartModelOrders')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
		}

		$order_number = vRequest::getUword('on');
		if (!$order_number) {
			return FALSE;
		}

		if (!$virtuemart_order_id = VirtueMartModelOrders::getOrderIdByOrderNumber($order_number)) {
			return NULL;
		}
		if (!($paymentTable = $this->getDataByOrderId($virtuemart_order_id))) {
			return NULL;
		}

		$session = JFactory::getSession();
		$return_context = $session->getId();
		$field = $this->_name . '_custom';
		if (strcmp($paymentTable->$field, $return_context) === 0) {
			$this->handlePaymentUserCancel($virtuemart_order_id);
		}
		return TRUE;
	}


	/**
	 * @param $firstPayment
	 */
	function setEmptyCartDone ($firstPayment) {
		$firstPayment = (array)$firstPayment;
		$firstPayment['amazon_custom'] = NULL;
		$this->storePSPluginInternalData($firstPayment, $this->_tablepkey, true);
	}

	function   storePSPluginInternalData ($values, $primaryKey = 0, $preload = FALSE) {
		parent::storePSPluginInternalData($values, $primaryKey, $preload);
	}

	/**
	 * Get Method Datas for a given Payment ID
	 *
	 * @author Valérie Isaksen
	 * @param int $virtuemart_order_id The order ID
	 * @return  $methodData
	 */
	function getPluginDatasByOrderId ($virtuemart_order_id) {

		return $this->getDatasByOrderId($virtuemart_order_id);
	}

	/**
	 * Display stored payment data for an order
	 *
	 * @see components/com_virtuemart/helpers/vmPSPlugin::plgVmOnShowOrderBEPayment()
	 */
	function plgVmOnShowOrderBEPayment ($virtuemart_order_id, $virtuemart_paymentmethod_id) {

		if (!$this->selectedThisByMethodId($virtuemart_paymentmethod_id)) {
			return NULL; // Another method was selected, do nothing
		}
		if (!($this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}

		//$html = $interface->showOrderBEPayment($virtuemart_order_id);


		return $html;
	}

	function getHtmlHeaderBE () {
		//return parent:: getHtmlHeaderBE();
	}

	/**
	 * @param plugin $method
	 * @return mixed|string
	 */
	function renderRoAddressbookWallet () {

// TODO : readonly Addressbook and Wallet only if it has been selected
		$amazonOrderReferenceId = $this->getAmazonOrderReferenceId();
		if (!$amazonOrderReferenceId) {
			$this->amazonError("renderRoAddressbookWallet getAmazonOrderReferenceId  is NULL");
			return NULL;
		}
		// buyer can change/edit Payment / shipment address in the cart
		$redirect_page = $this->getRenderAddressbookWalletRedirectPage();

		$html = $this->renderByLayout('ro_addressbook_wallet', array(
		                                                            'virtuemart_paymentmethod_id' => $this->_currentMethod->virtuemart_paymentmethod_id,
		                                                            'sellerId'                    => $this->_currentMethod->sellerId,
		                                                            'ro_addressbook_designWidth'  => $this->getPixelValue($this->_currentMethod->ro_addressbook_designWidth),
		                                                            'ro_addressbook_designHeight' => $this->getPixelValue($this->_currentMethod->ro_addressbook_designHeight),
		                                                            'ro_wallet_designWidth'       => $this->getPixelValue($this->_currentMethod->ro_wallet_designWidth),
		                                                            'ro_wallet_designHeight'      => $this->getPixelValue($this->_currentMethod->ro_wallet_designHeight),
		                                                            'amazonOrderReferenceId'      => $amazonOrderReferenceId,
		                                                            'redirect_page'               => $redirect_page,
		                                                       ));

		return $html;
	}


	private function getPixelValue ($value) {
		$value = str_replace("px", "", $value);
		$value = $value . 'px';
		return trim($value);
	}

	private function getExtraPluginNameInfo ($activeMethod) {
		$this->_method = $activeMethod;


		return $extraInfo;

	}


	function getCosts (VirtueMartCart $cart, $method, $cart_prices) {

		if (preg_match('/%$/', $method->cost_percent_total)) {
			$cost_percent_total = substr($method->cost_percent_total, 0, -1);
		} else {
			$cost_percent_total = $method->cost_percent_total;
		}
		return ($method->cost_per_transaction + ($cart_prices['salesPrice'] * $cost_percent_total * 0.01));
	}

	/**
	 * Check if the payment conditions are fulfilled for this payment method
	 *
	 * @author: Valerie Isaksen
	 *
	 * @param $cart_prices: cart prices
	 * @param $payment
	 * @return true: if the conditions are fulfilled, false otherwise
	 *
	 */
	protected function checkConditions ($cart, $method, $cart_prices) {
		//vmTrace('checkConditions', true);
		//$this->debugLog( $cart_prices['salesPrice'], 'checkConditions','debug');
		$this->_currentMethod = $method;
		if ($this->isValidCountry() && $this->isValidLanguage() && $this->isValidAmount() && $this->isValidProductCategories() && $this->isValidIP()
		) {
			return true;
		}
		return false;
	}

	private function isValidCountry () {
		return true;
	}


	/**
	 * in VM2, the payment is not showed if the buyer browse in another language
	 * @return bool
	 */

	private function isValidLanguage () {

		return true;
	}

	private function isValidAmount () {
		return true;
	}

	private function isValidProductCategories () {
		return true;
	}

	private function isValidIP () {
		if (empty($this->_currentMethod->ip_whitelist)) {
			return true;
		}

		$ip_whitelist = explode(";", $this->_currentMethod->ip_whitelist);
		if (in_array($_SERVER['REMOTE_ADDR'], $ip_whitelist)) {
			return true;
		}
		return false;
	}


	/**
	 * Create the table for this plugin if it does not yet exist.
	 * This functions checks if the called plugin is active one.
	 * When yes it is calling the standard method to create the tables
	 *
	 * @author Valérie Isaksen
	 *
	 */
	function plgVmOnStoreInstallPaymentPluginTable ($jplugin_id) {
		if ($res = $this->selectedThisByJPluginId($jplugin_id)) {

			$virtuemart_paymentmethod_id = vRequest::getInt('virtuemart_paymentmethod_id');
			$method = $this->getPluginMethod($virtuemart_paymentmethod_id);
			vmdebug('plgVmOnStoreInstallPaymentPluginTable', $method, $virtuemart_paymentmethod_id);
			//$this->createRootFile($method->virtuemart_paymentmethod_id);
			/*
						$mandatory_fields = array('site_id', 'rang', 'identifiant', 'key');
						foreach ($mandatory_fields as $mandatory_field) {
							if (empty($method->$mandatory_field)) {
								vmError(vmText::sprintf('VMPAYMENT_'.$this->_name.'_CONF_MANDATORY_PARAM', vmText::_('VMPAYMENT_'.$this->_name.'_CONF_' . $mandatory_field)));
							}
						}
			*/
			if (!extension_loaded('curl')) {
				vmError(vmText::sprintf('VMPAYMENT_' . $this->_name . '_CONF_MANDATORY_PHP_EXTENSION', 'curl'));
			}
			if (!extension_loaded('openssl')) {
				vmError(vmText::sprintf('VMPAYMENT_' . $this->_name . '_CONF_MANDATORY_PHP_EXTENSION', 'openssl'));
			}
		}

		return $this->onStoreInstallPluginTable($jplugin_id);
	}


	/**
	 * This event is fired after the payment method has been selected. It can be used to store
	 * additional payment info in the cart.
	 *
	 * @author Max Milbers
	 * @author Valérie isaksen
	 *
	 * @param VirtueMartCart $cart: the actual cart
	 * @return null if the payment was not selected, true if the data is valid, error message if the data is not vlaid
	 *
	 */
	public function plgVmOnSelectCheckPayment (VirtueMartCart $cart, &$msg) {

		return $this->OnSelectCheck($cart);
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
	 * @author Valerie Isaksen
	 * @author Max Milbers
	 */
	public function plgVmDisplayListFEPayment (VirtueMartCart $cart, $selected = 0, &$htmlIn) {

		return $this->displayListFE($cart, $selected, $htmlIn);
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

		if (!($method = $this->selectedThisByMethodId($cart->virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}

		if (!($this->_currentMethod = $this->getVmPluginMethod($cart->virtuemart_paymentmethod_id))) {
			$this->clearAmazonSession();
			return NULL;
		}

		$cart_prices_name = '';
		$cart_prices['cost'] = 0;

		if (!$this->checkConditions($cart, $this->_currentMethod, $cart_prices)) {
			return FALSE;
		}

		$client = $this->getOffAmazonPaymentsService_Client();
		$this->addWidgetUrlScript($client);
		//$this->saveAmazonPartialShipmentAddressIncart($client, $cart);

		$cart_prices_name = $this->renderRoAddressbookWallet();
		$this->setCartPrices($cart, $cart_prices, $method);

		return TRUE;
	}


	function getAmazonShipmentAddress () {


		$client = $this->getOffAmazonPaymentsService_Client();
		try {
			$getOrderReferenceDetailsRequest = new OffAmazonPaymentsService_Model_GetOrderReferenceDetailsRequest();
			$getOrderReferenceDetailsRequest->setSellerId($this->_currentMethod->sellerId);
			$getOrderReferenceDetailsRequest->setAmazonOrderReferenceId($this->getAmazonOrderReferenceId());
			$referenceDetailsResultWrapper = $client->getOrderReferenceDetails($getOrderReferenceDetailsRequest);
			$physicalDestination = $referenceDetailsResultWrapper->GetOrderReferenceDetailsResult->getOrderReferenceDetails()->getDestination()->getPhysicalDestination();

		} catch (Exception $e) {
			$this->amazonError($e->getMessage(), $e->getCode());
			return;
		}

		return $physicalDestination;
	}

	/**
	 * get the partial shipping address (city, state, postal code, and country) by calling the GetOrderReferenceDetails operation
	 * to compute taxes and shipping costs or possible applicable shipping speed, and options.
	 * @param $client
	 * @param $cart
	 */
	function saveAmazonPartialShipmentAddressIncart () {

		$this->debug($client, 'saveAmazonPartialShipmentAddressIncart', 'debug');
		$cart = VirtueMartCart::getCart();
		$onlyDigitalGoods = $this->isOnlyDigitalGoods($cart);
		if ($onlyDigitalGoods) {
			return;
		}

		$physicalDestination = $this->getAmazonShipmentAddress();
		if (!$physicalDestination) {
			return;
		}


		$prefix = 'shipto_';
		$update_data = array(
			$prefix . 'title'                 => "&nbsp;",
			$prefix . 'first_name'            => "&nbsp;",
			$prefix . 'middle_name'           => "&nbsp;",
			$prefix . 'last_name'             => "&nbsp;",
			$prefix . 'address_1'             => "&nbsp;",
			$prefix . 'address_2'             => "&nbsp;",
			$prefix . 'address_3'             => "&nbsp;",
			$prefix . 'district'              => "&nbsp;",
			$prefix . 'zip'                   => $physicalDestination->GetPostalCode(),
			$prefix . 'city'                  => $physicalDestination->GetCity(),
			$prefix . 'virtuemart_country_id' => shopFunctions::getCountryIDByName($physicalDestination->GetCountryCode()),
			$prefix . 'state'                 => $physicalDestination->GetStateOrRegion(),
			$prefix . 'phone_1'               => "&nbsp;",
			'address_type'                    => 'ST'
		);
		$cart->saveAddressInCart($update_data, $update_data['address_type'], TRUE);
	}

	/**
	 * plgVmOnCheckAutomaticSelectedPayment
	 * Checks how many plugins are available. If only one, the user will not have the choice. Enter edit_xxx page
	 * The plugin must check first if it is the correct type
	 *
	 * @author Valerie Isaksen
	 * @param VirtueMartCart cart: the cart object
	 * @return null if no plugin was found, 0 if more then one plugin was found,  virtuemart_xxx_id if only one plugin is found
	 *
	 */
	function plgVmOnCheckAutomaticSelectedPayment (VirtueMartCart $cart, array $cart_prices = array()) {

		return $this->onCheckAutomaticSelected($cart, $cart_prices);
	}

	/**
	 * This method is fired when showing the order details in the frontend.
	 * It displays the method-specific data.
	 *
	 * @param integer $order_id The order ID
	 * @return mixed Null for methods that aren't active, text (HTML) otherwise
	 * @author Max Milbers
	 * @author Valerie Isaksen
	 */
	public function plgVmOnShowOrderFEPayment ($virtuemart_order_id, $virtuemart_paymentmethod_id, &$payment_name) {

		$this->onShowOrderFE($virtuemart_order_id, $virtuemart_paymentmethod_id, $payment_name);
	}

	/**
	 * This event is fired during the checkout process. It can be used to validate the
	 * method data as entered by the user.
	 *
	 * @return boolean True when the data was valid, false otherwise. If the plugin is not activated, it should return null.
	 * @author Max Milbers

	public function plgVmOnCheckoutCheckDataPayment (VirtueMartCart $cart) {
	return NULL;
	}
	 */

	/**
	 * This method is fired when showing when priting an Order
	 * It displays the the payment method-specific data.
	 *
	 * @param integer $_virtuemart_order_id The order ID
	 * @param integer $method_id  method used for this order
	 * @return mixed Null when for payment methods that were not selected, text (HTML) otherwise
	 * @author Valerie Isaksen
	 */
	function plgVmonShowOrderPrintPayment ($order_number, $method_id) {

		return $this->onShowOrderPrint($order_number, $method_id);
	}

	/**
	 * Save updated order data to the method specific table
	 *
	 * @param array $_formData Form data
	 * @return mixed, True on success, false on failures (the rest of the save-process will be
	 * skipped!), or null when this method is not actived.

	public function plgVmOnUpdateOrderPayment(  $_formData) {
	return null;
	}
	 */
	/**
	 * Save updated orderline data to the method specific table
	 *
	 * @param array $_formData Form data
	 * @return mixed, True on success, false on failures (the rest of the save-process will be
	 * skipped!), or null when this method is not actived.

	public function plgVmOnUpdateOrderLine(  $_formData) {
	return null;
	}
	 */
	/**
	 * plgVmOnEditOrderLineBE
	 * This method is fired when editing the order line details in the backend.
	 * It can be used to add line specific package codes
	 *
	 * @param integer $_orderId The order ID
	 * @param integer $_lineId
	 * @return mixed Null for method that aren't active, text (HTML) otherwise

	public function plgVmOnEditOrderLineBE(  $_orderId, $_lineId) {
	return null;
	}
	 */

	/**
	 * This method is fired when showing the order details in the frontend, for every orderline.
	 * It can be used to display line specific package codes, e.g. with a link to external tracking and
	 * tracing systems
	 *
	 * @param integer $_orderId The order ID
	 * @param integer $_lineId
	 * @return mixed Null for method that aren't active, text (HTML) otherwise

	public function plgVmOnShowOrderLineFE(  $_orderId, $_lineId) {
	return null;
	}
	 */
	function plgVmDeclarePluginParamsPayment ($name, $id, &$data) {
		return $this->declarePluginParams('payment', $name, $id, $data);
	}

	function plgVmSetOnTablePluginParamsPayment ($name, $id, &$table) {
		return $this->setOnTablePluginParams($name, $id, $table);
	}


	/**
	 * @param $response
	 * @param $order
	 * @return null|string
	 */
	function getResponseHTML ($order, $paybox_data, $success, $extra_comment) {

		$payment_name = $this->renderPluginName($this->_currentMethod);
		VmConfig::loadJLang('com_virtuemart_orders', TRUE);
		$q = 'SELECT `currency_code_3` FROM `#__virtuemart_currencies` WHERE `virtuemart_currency_id`="' . $order['details']['BT']->order_currency . '" ';
		$db = JFactory::getDBO();
		$db->setQuery($q);
		$currency_numeric_code = $db->loadResult();
		$html = $this->renderByLayout('response', array(
		                                               "success"       => $success,
		                                               "payment_name"  => $payment_name,
		                                               "transactionId" => $paybox_data['S'],
		                                               "amount"        => $paybox_data['M'] * 0.01,
		                                               "extra_comment" => $extra_comment,
		                                               "currency"      => $currency_numeric_code,
		                                               "order_number"  => $order['details']['BT']->order_number,
		                                               "order_pass"    => $order['details']['BT']->order_pass,
		                                          ));
		return $html;


	}

	/*********************/
	/* Private functions */
	/*********************/


	function getEmailCurrency (&$method) {

		return $method->payment_currency; // either the vendor currency, either same currency as payment
	}

	private function getCurrencyId ($client) {
		$currencyCode3 = $this->getCurrencyCode3($client);
		$virtuemart_currency_id = shopFunctions::getCurrencyIDByName($currencyCode3);
		return $virtuemart_currency_id;
	}

	private function getCurrencyCode3 ($client) {
		return $client->getMerchantValues()->getCurrency();
	}

	private function getTotalInPaymentCurrency ($client, $total, $backToPricesCurrency) {
		if (!class_exists('CurrencyDisplay')) {
			require(JPATH_VM_ADMINISTRATOR . '/helpers/currencydisplay.php');
		}
		$virtuemart_currency_id = $this->getCurrencyId($client);
		$totalInPaymentCurrency = vmPSPlugin::getAmountValueInCurrency($total, $virtuemart_currency_id);

		$cd = CurrencyDisplay::getInstance($backToPricesCurrency);

		return $totalInPaymentCurrency;
	}

	private function setAmazonOrderReferenceId ($amazonOrderReferenceId) {
		$session = JFactory::getSession();
		$sessionAmazonData['virtuemart_paymentmethod_id'] = $this->_currentMethod->virtuemart_paymentmethod_id;
		$sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id]['amazonOrderReferenceId'] = $amazonOrderReferenceId;
		$sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id][$amazonOrderReferenceId] = array();
		$session->set('amazon', serialize($sessionAmazonData), 'vm');
	}


	private function setAmazonAction ($action) {
		$amazonOrderReferenceId = $this->getAmazonOrderReferenceId();
		if (!$amazonOrderReferenceId) {
			$this->amazonError("setAmazonAction getAmazonOrderReferenceId  is NULL");
		}
		$session = JFactory::getSession();
		$sessionAmazon = $session->get('amazon', 0, 'vm');

		$sessionAmazonData = unserialize($sessionAmazon);
		if (!isset($sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id][$amazonOrderReferenceId])) {
			$this->amazonError('setAmazonAction $sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id][$amazonOrderReferenceId]  is not set');
		}
		$sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id][$amazonOrderReferenceId][$action] = true;
		$session->set('amazon', serialize($sessionAmazonData), 'vm');
	}

	private function getAmazonOrderReferenceId () {
		$session = JFactory::getSession();
		$sessionAmazon = $session->get('amazon', 0, 'vm');

		if ($sessionAmazon) {
			$sessionAmazonData = unserialize($sessionAmazon);
			if (isset($sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id])) {
				return $sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id]['amazonOrderReferenceId'];
			}
		}

		return NULL;

	}

	private function getAmazonAction ($action) {
		$session = JFactory::getSession();
		$sessionAmazon = $session->get('amazon', 0, 'vm');

		if ($sessionAmazon) {
			$sessionAmazonData = unserialize($sessionAmazon);
			if (isset($sessionAmazonData[$action])) {
				return $sessionAmazonData[$action];
			}
		}

		return false;

	}

	private function clearAmazonSession () {

		$session = JFactory::getSession();
		$session->clear('amazon', 'vm');
		return NULL;

	}

	private function getStoreName () {
		if (!class_exists('VirtueMartModelVendor')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'vendor.php');
		}
		$virtuemart_vendor_id = 1;
		$vendorModel = VmModel::getModel('vendor');
		$vendor = $vendorModel->getVendor($virtuemart_vendor_id);
		return $vendor->vendor_store_name;

	}

	private function amazonError ($message, $code = '') {
		$public = '';
		if ($this->_currentMethod->debug) {
			$public_msg = $message;
		}
		vmError($message . " (" . $code . ")", $public_msg);
	}

	/**
	 * @param string $message
	 * @param string $title
	 * @param string $type
	 * @param bool   $echo
	 * @param bool   $doVmDebug
	 */
	public function debugLog ($message, $title = '', $type = 'message', $echo = false, $doVmDebug = false) {

		if ($this->_currentMethod->debug) {
			$this->debug($message, $title, true);
		}

		if ($echo) {
			echo $message . '<br/>';
		}


		parent::debugLog($message, $title, $type, $doVmDebug);
	}

	public function debug ($subject, $title = '', $echo = true) {

		$debug = '<div style="display:block; margin-bottom:5px; border:1px solid red; padding:5px; text-align:left; font-size:10px;white-space:nowrap; overflow:scroll;">';
		$debug .= ($title) ? '<br /><strong>' . $title . ':</strong><br />' : '';
		//$debug .= '<pre>';
		if (is_array($subject)) {
			$debug .= str_replace("=>", "&#8658;", str_replace("Array", "<font color=\"red\"><b>Array</b></font>", nl2br(str_replace(" ", " &nbsp; ", print_r($subject, true)))));
		} else {
			//$debug .= str_replace("=>", "&#8658;", str_replace("Array", "<font color=\"red\"><b>Array</b></font>", (str_replace(" ", " &nbsp; ", print_r($subject, true)))));
			$debug .= str_replace("=>", "&#8658;", str_replace("Array", "<font color=\"red\"><b>Array</b></font>", print_r($subject, true)));

		}

		//$debug .= '</pre>';
		$debug .= '</div>';
		if ($echo) {
			echo $debug;
		} else {
			return $debug;
		}
	}

}

// No closing tag
