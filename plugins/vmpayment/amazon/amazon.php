<?php

defined('_JEXEC') or die('Direct Access to ' . basename(__FILE__) . 'is not allowed.');

/**
 *
 * @package    VirtueMart
 * @subpackage vmpayment
 * @version $Id$
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

	static $widgetScriptLoaded = false;

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
		$amazon_library = JPATH_SITE . DS . 'plugins' . DS . 'vmpayment' . DS . 'amazon' . DS . 'amazon' . DS . 'library' . DS . 'PaywithAmazonSDK-php-1.0.7_UK' . DS . 'src';

		//set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__) . "/../../."));
		set_include_path($amazon_library);

		//require_once "OffAmazonPayments/.autoloader.php";
		$this->amazonClassLoad('OffAmazonPaymentsService_Client');

	}

	protected function getVmPluginCreateTableSQL () {

		return $this->createTableSQL('Payment Amazon Table');
	}

	function getTableSQLFields () {

		$SQLfields = array(
			'id'                                    => 'int(1) unsigned NOT NULL AUTO_INCREMENT',
			'virtuemart_order_id'                   => 'int(11) UNSIGNED DEFAULT NULL',
			'order_number'                          => 'char(64) DEFAULT NULL',
			'virtuemart_paymentmethod_id'           => 'mediumint(1) UNSIGNED DEFAULT NULL',
			'payment_name'                          => 'varchar(5000)',
			'payment_order_total'                   => 'decimal(15,5) NOT NULL DEFAULT \'0.00000\'',
			'payment_currency'                      => 'smallint(1)',
			'email_currency'                        => 'smallint(1)',
			'recurring'                             => 'varchar(512)',
			'recurring_number'                      => 'smallint(1)',
			'recurring_periodicity'                 => 'smallint(1)',
			'cost_per_transaction'                  => 'decimal(10,2) DEFAULT NULL',
			'cost_percent_total'                    => 'decimal(10,2) DEFAULT NULL',
			'tax_id'                                => 'smallint(1) DEFAULT NULL',
			'amazon_response_state'                 => 'char(32) DEFAULT NULL',
			'amazon_response_amazonAuthorizationId' => 'char(64) DEFAULT NULL',
			'amazon_response_state'                 => 'char(64) DEFAULT NULL',
			'amazon_response_reasonCode'            => 'char(64) DEFAULT NULL',
			'amazon_response_reasonDescription'     => 'char(64) DEFAULT NULL',
			'amazon_request'                        => 'text DEFAULT NULL',
			'amazon_response'                       => 'text DEFAULT NULL',
			'amazon_notification'                   => 'text DEFAULT NULL'
		);
		return $SQLfields;
	}

	public function plgVmDisplayLogin (VirtuemartViewUser $user, &$html, $from_cart = FALSE) {
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
		$this->vmClassLoad('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');

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

	public function plgVmOnCheckoutAdvertise ($cart, &$payment_advertise) {

		$vendorId = 1;

		if ($this->getPluginMethods($cart->vendorId) === 0) {
			return FALSE;
		}
		$payment_advertise = $this->renderSignInButton('advertise');

	}

	private function renderSignInButton ($sign_in_display, $selected = false) {
		$display = array();
		$this->vmClassLoad('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');


		$cart = VirtueMartCart::getCart();
		foreach ($this->methods as $this->_currentMethod) {
			if ($this->checkConditionSignIn($sign_in_display)) {
				$amazonOrderReferenceId = $this->getAmazonOrderReferenceId();
				$client = $this->getOffAmazonPaymentsService_Client();
				$buttonWidgetImageURL = $this->getButtonWidgetImageURL();
				if (!empty($buttonWidgetImageURL)) {

					$this->addWidgetUrlScript($client);
					if ($selected == $this->_currentMethod->virtuemart_paymentmethod_id) {
						$checked = 'checked="checked"';
					} else {
						$checked = '';
					}
					$redirect_page = $this->getRenderAddressbookWalletRedirectPage($cart);
					$display[] = $this->renderByLayout('signin', array(
					                                                  'buttonWidgetImageURL'        => $buttonWidgetImageURL,
					                                                  'virtuemart_paymentmethod_id' => $this->_currentMethod->virtuemart_paymentmethod_id,
					                                                  'sellerId'                    => $this->_currentMethod->sellerId,
					                                                  'amazonOrderReferenceId'      => $amazonOrderReferenceId,
					                                                  'redirect_page'               => $redirect_page,
					                                                  'sign_in_display'             => $sign_in_display,
					                                                  'checked'                     => $checked,
					                                             ));
				}
			}

		}
		return $display;
	}

	private function checkConditionSignIn ($sign_in_display) {
		$cart_prices = array();
		$this->vmClassLoad('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');

		$cart = VirtueMartCart::getCart();
		if ($this->doSignInDisplay($sign_in_display) && $this->checkConditions($cart, $this->_currentMethod, $cart_prices)) {
			return true;
		}
		return false;
	}

	private function doSignInDisplay ($sign_in_display) {
		if (in_array($sign_in_display, $this->_currentMethod->sign_in_display) OR empty($this->_currentMethod->sign_in_display)) {
			return true;
		}
		$this->debugLog($sign_in_display . ' is FALSE', __FUNCTION__, 'debug');
		return false;

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

	private function amazonError ($message, $code = '') {

		$public = '';
		if ($this->_currentMethod->debug) {
			$public_msg = $message;
		}
		vmError($message . " (" . $code . ")", $public_msg);
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

	private function addWidgetUrlScript ($client) {
		if (!self::$widgetScriptLoaded) {
			$widgetURL = $client->getMerchantValues()->getWidgetUrl();
			JHTML::script('', $widgetURL, false);
			self::$widgetScriptLoaded = true;
		}

	}

	function getRenderAddressbookWalletRedirectPage () {
		$url = 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginnotification&notificationTask=renderAddressbookWallet&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id . '&Itemid=' . vRequest::getInt('Itemid') . '&lang=' . vRequest::getCmd('lang', '');
		$AmazonOrderReferenceId = $this->getAmazonOrderReferenceId();
		if ($AmazonOrderReferenceId) {
			$url .= '&session=' . $AmazonOrderReferenceId;
		}
		$cart = VirtueMartCart::getCart();
		return JRoute::_($url, $cart->useXHTML, $cart->useSSL);

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

	public function onVmSiteController ($_controller) {

		$virtuemart_paymentmethod_id = vRequest::getInt('pm', 0);
		if (!($this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		$siteControllerTask = vRequest::getCmd('task', '');
		$validSiteControllerTask = array('ipn');

		if (!in_array($siteControllerTask, $validSiteControllerTask)) {
			return;
		}
		$this->$siteControllerTask();

		exit(0);
	}

	function plgVmOnMainController () {
		$doc = JFactory::getDocument();
		$js = "
jQuery(document).ready( function($) {
	$( '#checkout-advertise-box' ).append('klklkl');;
"; // addScriptDeclaration
		//$doc->addScriptDeclaration($js);
	}

	/**
	 *  index.php?option=com_virtuemart&view=pluginresponse&task=pluginnotification&notificationTask=ipn&format=raw
	 * @return null
	 */
	public function plgVmOnPaymentNotification () {

		$virtuemart_paymentmethod_id = vRequest::getInt('pm', 0);
		if (!($this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}

		$notificationTask = vRequest::getCmd('notificationTask', '');
		if (!$this->isValidNotificationTask($notificationTask)) {
			return;
		}
		$this->$notificationTask();

	}

	private function isValidNotificationTask ($notificationTask) {
		$validNotificationTasks = array('renderAddressbookWallet', 'returnRenderAddressbookWallet', 'ipn');

		if (!in_array($notificationTask, $validNotificationTasks)) {
			return false;
		}
		return true;
	}

	/**
	 * @param VirtueMartCart $cart
	 */
	public function plgVmOnCheckoutCheckDataPayment (VirtueMartCart $cart) {


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

		$this->storeAmazonInternalData($order, NULL, NULL, NULL, $this->renderPluginName($this->_currentMethod));

		$client = $this->getOffAmazonPaymentsService_Client();

		if (!$this->updateAmazonFullShipmentAddressInOrder($client, $cart, $order)) {
			return FALSE;
		}
		if (!$this->setOrderReferenceDetails($client, $cart, $order)) {
			$this->redirectToCart();
			return FALSE;
		}
		$this->confirmOrderReference($client, $order);
 // getorderdetails et doonne address email


		// at this point, since the authorization and capturing takes additional time to process
		// let's do that with a trigger
		if ($this->canDoAuthorization()) {
			if (!($amazonAuthorizationId = $this->getAuthorization($client, $cart, $order))) {
				$this->redirectToCart();
				return FALSE;
			}
			$order['order_status'] = $this->onAuthorizationSuccessGetNewStatus();
			$modelOrder = VmModel::getModel('orders');
			$order['order_status'] = $this->onAuthorizationSuccessGetNewStatus();
			$order['customer_notified'] = 1;
			$order['comments'] = '';
			$modelOrder->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order, TRUE);
		}


		return true;
	}


	private function canDoAuthorization() {
		if ($this->_currentMethod->erp_mode =="erp_mode_disabled" OR ($this->_currentMethod->erp_mode =="erp_mode_enabled" AND $this->_currentMethod->authorization_mode_erp_enabled !="authorization_done_by_erp")) {
			return true;
		} else {
			return false;
		}
	}
	private function isERPMode() {
		if ($this->_currentMethod->erp_mode =="erp_mode_enabled" ) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * @return bool
	 */
	function setOrderDetails ($client, $cart, $order) {
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_OrderReferenceAttributes');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_OrderTotal');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_SellerOrderAttributes');

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
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getOrderTotal()->setAmount($this->getTotalInPaymentCurrency($client, $order['details']['BT']->order_total, $cart->pricesCurrency));
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

	/**
	 * @param      $order
	 * @param      $request
	 * @param      $response
	 * @param      $notification
	 * @param null $payment_name
	 * @param null $amazonParams
	 * @return array
	 */
	private function storeAmazonInternalData ($order, $request, $response, $notification, $payment_name = NULL, $amazonParams = NULL) {

		$db_values['order_number'] = $order['details']['BT']->order_number;
		$db_values['virtuemart_order_id'] = $order['details']['BT']->virtuemart_order_id;
		$db_values['virtuemart_paymentmethod_id'] = $this->_currentMethod->virtuemart_paymentmethod_id;
		$db_values['amazon_request'] = serialize($request);
		$db_values['amazon_response'] = serialize($response);
		$db_values['amazon_notification'] = serialize($notification);
		$db_values['payment_name'] = $payment_name;
		if ($amazonParams) {
			$amazonParamsArray = (array)($amazonParams);
			$db_values = array_merge($db_values, $amazonParamsArray);
		}
		//$preload=true   preload the data here too preserve not updated data
		return $this->storePSPluginInternalData($db_values, $this->_tablepkey, 0);

	}

	/**
	 * @return mixed
	 */


	private function updateAmazonFullShipmentAddressInOrder ($client, $cart, $order) {
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
		$order_userinfosTable->load($order['details']['BT']->virtuemart_order_id, 'virtuemart_order_id', " AND address_type='ST'");
		if (!$order_userinfosTable->bindChecknStore($_userInfoData, true)) {
			vmError($order_userinfosTable->getError());
			return false;
		}

		return true;
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
	 * @param $cart
	 * @return bool
	 */
	private function isOnlyDigitalGoods ($cart) {
		$weight = $this->getOrderWeight($cart, 'GR');
		return !(boolean)$weight;
	}

	/**
	 * @return bool
	 */
	private function setOrderReferenceDetails ($client, $cart, $order) {
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_OrderReferenceAttributes');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_OrderTotal');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_SellerOrderAttributes');

		$amazonOrderReferenceId = $this->getAmazonOrderReferenceId();
		if (empty($amazonOrderReferenceId)) {
			$this->amazonError('setOrderReferenceDetails, No $amazonOrderReferenceId');
			return FALSE;
		}
		try {

			$setOrderReferenceDetailsRequest = new OffAmazonPaymentsService_Model_SetOrderReferenceDetailsRequest();
			$setOrderReferenceDetailsRequest->setSellerId($this->_currentMethod->sellerId);
			$setOrderReferenceDetailsRequest->setAmazonOrderReferenceId($amazonOrderReferenceId);
			$setOrderReferenceDetailsRequest->setOrderReferenceAttributes(new OffAmazonPaymentsService_Model_OrderReferenceAttributes());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setOrderTotal(new OffAmazonPaymentsService_Model_OrderTotal());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getOrderTotal()->setCurrencyCode($this->getCurrencyCode3($client));
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getOrderTotal()->setAmount($this->getTotalInPaymentCurrency($client, $order['details']['BT']->order_total, $cart->pricesCurrency));
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setSellerNote($this->getSellerNote());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setSellerOrderAttributes(new OffAmazonPaymentsService_Model_SellerOrderAttributes());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getSellerOrderAttributes()->setSellerOrderId($order['details']['BT']->order_number);
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getSellerOrderAttributes()->setStoreName($this->getStoreName());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getSellerOrderAttributes()->setCustomInformation($order['details']['BT']->customer_note);
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setPlatformId($this->getPlatformId());

			$setOrderReferenceDetailsResponse = $client->setOrderReferenceDetails($setOrderReferenceDetailsRequest);

		} catch (Exception $e) {
			$this->amazonError($e->getMessage(), $e->getCode());
			$this->clearAmazonSession();
			return FALSE;
		}
		$this->debugLog("<pre>" . var_export($setOrderReferenceDetailsRequest, true) . "</pre>", __FUNCTION__, 'debug');
		$this->debugLog("<pre>" . var_export($setOrderReferenceDetailsResponse, true) . "</pre>", __FUNCTION__, 'debug');

		$this->helperClassLoad('amazonHelperSetOrderReferenceDetailsResponse');
		$amazonHelperSetOrderReferenceDetailsResponse = new amazonHelperSetOrderReferenceDetailsResponse($setOrderReferenceDetailsResponse);

		$this->storeAmazonInternalData($order, $setOrderReferenceDetailsRequest, $setOrderReferenceDetailsResponse, NULL, $amazonHelperSetOrderReferenceDetailsResponse->storeResultParams());
		// update order status ??
		return true;
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

	private function getCurrencyId ($client) {
		$currencyCode3 = $this->getCurrencyCode3($client);
		$virtuemart_currency_id = shopFunctions::getCurrencyIDByName($currencyCode3);
		return $virtuemart_currency_id;
	}

	private function getCurrencyCode3 ($client) {
		return $client->getMerchantValues()->getCurrency();
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

	private function getStoreName () {
		if (!class_exists('VirtueMartModelVendor')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'vendor.php');
		}
		$virtuemart_vendor_id = 1;
		$vendorModel = VmModel::getModel('vendor');
		$vendor = $vendorModel->getVendor($virtuemart_vendor_id);
		return $vendor->vendor_store_name;

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

	private function clearAmazonSession () {

		$session = JFactory::getSession();
		$session->clear('amazon', 'vm');
		return NULL;

	}

	private function redirectToCart ($msg = NULL) {
		if (!$msg) {
			$msg = vmText::_('VMPAYMENT_AMAZON_ERROR_TRY_AGAIN');
		}
		$this->clearAmazonSession();
		$app = JFactory::getApplication();
		$app->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart&Itemid=' . vRequest::getInt('Itemid'), false), $msg);
	}

	/**
	 *
	 */
	private function confirmOrderReference ($client, $order) {

		$this->helperClassLoad('amazonHelperConfirmOrderReferenceResponse');
		try {
			$confirmOrderReferenceRequest = new OffAmazonPaymentsService_Model_ConfirmOrderReferenceRequest();
			$confirmOrderReferenceRequest->setAmazonOrderReferenceId($this->getAmazonOrderReferenceId());
			$confirmOrderReferenceRequest->setSellerId($this->_currentMethod->sellerId);
			$confirmOrderReferenceResponse = $client->confirmOrderReference($confirmOrderReferenceRequest);
			$this->debugLog("<pre>" . var_export($confirmOrderReferenceRequest, true) . "</pre>", __FUNCTION__, 'debug');

		} catch (Exception $e) {
			$this->amazonError($e->getMessage(), $e->getCode());
			return false;
		}
		$this->debugLog("<pre>" . var_export($confirmOrderReferenceResponse, true) . "</pre>", __FUNCTION__, 'debug');

		//	$amazonHelperconfirmOrderReferenceResponse = new amazonHelperConfirmOrderReferenceResponse($confirmOrderReferenceResponse);
		$this->storeAmazonInternalData($order, $confirmOrderReferenceRequest, $confirmOrderReferenceResponse, NULL);


		return true;
	}

	/**
	 * @param $client
	 * @param $cart
	 * @param $order
	 */
	private function getAuthorization ($client, $cart, $order) {
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_AuthorizeRequest');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_Price');
		$this->helperClassLoad('amazonHelperAuthorizeResponse');

		$authorizeRequest = new OffAmazonPaymentsService_Model_AuthorizeRequest();
		$authorizeRequest->setAmazonOrderReferenceId($this->getAmazonOrderReferenceId());
		$authorizeRequest->setSellerId($this->_currentMethod->sellerId);
		$authorizeRequest->setAuthorizationReferenceId($order['details']['BT']->order_number);
		$authorizeRequest->setSellerAuthorizationNote($this->getSellerAuthorizationNote());
		if ($this->isImmediateCapture()) {
			$authorizeRequest->setCaptureNow(true);
		} else {
			$authorizeRequest->setCaptureNow(false);
		}
		$authorizeRequest->setAuthorizationAmount(new OffAmazonPaymentsService_Model_Price());
		$authorizeRequest->getAuthorizationAmount()->setAmount($this->getTotalInPaymentCurrency($client, $order['details']['BT']->order_total, $cart->pricesCurrency));
		$authorizeRequest->getAuthorizationAmount()->setCurrencyCode($this->getCurrencyCode3($client));

		try {
			$authorizeResponse = $client->authorize($authorizeRequest);
			$amazonAuthorizationId = $authorizeResponse->getAuthorizeResult()->getAuthorizationDetails()->getAmazonAuthorizationId();
			$this->debugLog("<pre>" . var_export($authorizeRequest, true) . "</pre>", __FUNCTION__, 'debug');
			$this->debugLog("<pre>" . var_export($authorizeResponse, true) . "</pre>", __FUNCTION__, 'debug');

		} catch (Exception $e) {
			$msg = "An exception was thrown when trying to do the authorization:" . $e->getMessage() . "\n" . $e->getTraceAsString();
			while ($e = $e->getPrevious()) {
				$msg .= ("Caused by: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "");
				$msg .= "\n";
			}
			$this->debugLog($msg, __FUNCTION__, 'error');

			$this->amazonError($e->getMessage(), $e->getCode());
			return false;
		}
		$storeResult = new stdClass();
		$storeResult->amazon_response_amazonAuthorizationId = $amazonAuthorizationId;
		$this->storeAmazonInternalData($order, $authorizeRequest, $authorizeResponse, NULL, $this->renderPluginName($this->_currentMethod), $storeResult);


		return $amazonAuthorizationId;
	}

	/**
	 * @return bool
	 */
	private function isImmediateCapture () {
		return ($this->_currentMethod->capture_mode == "immediate_capture");
	}

	private function getSellerAuthorizationNote () {
		if ($this->_currentMethod->sandbox_error_simulation != 'authorization_InvalidPaymentMethod') {
			$simString = '{"SandboxSimulation": {"State":"Declined","ReasonCode":"InvalidPaymentMethod","PaymentMethodUpdateTimeInMins":100}';
		}
		return '';
	}

	/**
	 * @return mixed
	 */
	private function onAuthorizationSuccessGetNewStatus () {
		if ($this->isImmediateCapture()) {
			return $this->_currentMethod->status_capture;
		} else {
			return $this->_currentMethod->status_authorization;
		}
	}

	public function plgVmOnUpdateOrderPayment (&$order, $old_order_status) {

		//Load the method
		if (!($this->_currentMethod = $this->getVmPluginMethod($order->virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->_currentMethod ->payment_element)) {
			return NULL;
		}
		if (!$this->isValidUpdateOrderStatus($order->order_status)) {
			return;
		}

		//Load the payments
		if (!($payments = $this->_getAmazonInternalData($order->virtuemart_order_id))) {
			// JError::raiseWarning(500, $db->getErrorMsg());
			return null;
		}


		if ($order->order_status == $this->_currentMethod->status_refunded and $this->canDoRefund()) {
			$this->updateOrderStatusRefunded();
		} elseif ($order->order_status == $this->_currentMethod->status_capture and $this->canDoCapture()) {
			$this->updateOrderStatusCapture();
		}


		return true;
	}

	private function isValidUpdateOrderStatus ($orderStatus) {
		$validOrderStatus = array($this->_currentMethod->status_capture, $this->_currentMethod->status_refunded);
		if (!in_array($orderStatus, $validOrderStatus)) {
			return false;
		}
		return true;
	}

	private function canDoRefund () {


	}

	private function updateOrderStatusRefunded () {

	}

	private function canDoCapture () {


	}

	private function updateOrderStatusCapture () {
		// capture
		// close

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

		$this->vmClassLoad('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');

		if (!class_exists('shopFunctionsF')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'shopfunctionsf.php');
		}
		$this->vmClassLoad('VirtueMartModelOrders', JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');


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

		$this->vmClassLoad('VirtueMartModelOrders', JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');


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

		$html = $this->showOrderBEPayment($virtuemart_order_id);


		return $html;
	}

	function showOrderBEPayment ($virtuemart_order_id) {
		$this->amazonClassLoad('OffAmazonPaymentsService_Client');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_SetOrderReferenceDetailsResponse');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_Price');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_OrderTotal');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_SellerOrderAttributes');

		$db = JFactory::getDBO();
		$q = 'SELECT * FROM `' . $this->_tablename . '` WHERE ';
		$q .= ' `virtuemart_order_id` = ' . $virtuemart_order_id;

		$db->setQuery($q);
		$payments = $db->loadObjectList();

		$query = 'SHOW COLUMNS FROM `' . $this->_tablename . '` ';
		$db->setQuery($query);
		$columns = $db->loadResultArray(0);

		$html = '<table class="adminlist" width="50%">' . "\n";
		$html .= $this->getHtmlHeaderBE();
		$first = TRUE;
		$lang = JFactory::getLanguage();
		foreach ($payments as $payment) {
			$html .= '<tr class="row1"><td>' . vmText::_('VMPAYMENT_AMAZON_DATE') . '</td><td align="left">' . $payment->created_on . '</td></tr>';
			// Now only the first entry has this data when creating the order
			if ($first) {
				$html .= $this->getHtmlRowBE('AMAZON_PAYMENT_NAME', $payment->payment_name);
				// keep that test to have it backwards compatible. Old version was deleting that column  when receiving an IPN notification
				if ($payment->payment_order_total and  $payment->payment_order_total != 0.00) {
					$html .= $this->getHtmlRowBE('AMAZON_PAYMENT_ORDER_TOTAL', ($payment->payment_order_total * 0.01) . " " . shopFunctions::getCurrencyByID($payment->payment_currency, 'currency_code_3'));
				}
				if ($payment->email_currency and  $payment->email_currency != 0) {
					//$html .= $this->getHtmlRowBE($this->_name.'_PAYMENT_EMAIL_CURRENCY', shopFunctions::getCurrencyByID($payment->email_currency, 'currency_code_3'));
				}

				$first = FALSE;
			} else {
				foreach ($columns as $column) {
					$amazon_classes=   array();
					$table_key = 'amazon_response_' . $column;
					if (!empty($payment->$table_key)) {
						$html .= $this->getHtmlRowBE($table_key, $payment->$table_key);
					}
				}
				if (!empty($payment->amazon_request)) {
					$amazon_data = unserialize($payment->amazon_request);
					$amazon_classes[get_class($amazon_data)] = $payment->amazon_request;
				}
				if (!empty($payment->amazon_response)) {
					$amazon_data = unserialize($payment->amazon_response);
					$amazon_classes[get_class($amazon_data)] = $payment->amazon_response;

				}
				if (!empty($payment->amazon_notification)) {
					$amazon_data = unserialize($payment->amazon_notification);
					$amazon_classes[get_class($amazon_data)] = $payment->amazon_notification;

				}
				foreach ($amazon_classes as $amazon_class => $amazon_data_serialized) {
					$this->amazonClassLoad($amazon_class);

					$amazon_data = unserialize($amazon_data_serialized);

//if (!empty($logContents)) {
					$html .= '<tr><td></td><td>' . $amazon_class . '
<a href="#" class="amazonLogOpener" rel="' . $payment->id . '" >
	<div style="background-color: white; z-index: 100; right:0; display: none; border:solid 2px; padding:10px;" class="vm-absolute" id="amazonLog_' . $payment->id . '">';
					$html .= "<pre>" . var_export($amazon_data, true) . "</pre>";

					$html .= ' </div>
	<span class="icon-nofloat vmicon vmicon-16-xml"></span>&nbsp;';
					$html .= vmText::_('VMPAYMENT_' . $this->_name . '_VIEW_TRANSACTION_LOG');
					$html .= '  </a>';
					$html .= ' </td></tr>';
//}

				}

			}
		}

		$html .= '</table>' . "\n";
		$doc = JFactory::getDocument();
		$js = "
jQuery().ready(function($) {
	$('.amazonLogOpener').click(function() {
		var logId = $(this).attr('rel');
		$('#amazonLog_'+logId).toggle();
		return false;
	});
});";
		$doc->addScriptDeclaration($js);

		return $html;
	}

	function getHtmlHeaderBE () {
		//return parent:: getHtmlHeaderBE();
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
	 * Create the table for this plugin if it does not yet exist.
	 * This functions checks if the called plugin is active one.
	 * When yes it is calling the standard method to create the tables
	 *
	 * @author Valérie Isaksen
	 *
	 */
	public function plgVmOnStoreInstallPaymentPluginTable ($jplugin_id) {
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

		return $this->onSelectCheck($cart);
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


		if ($this->getPluginMethods($cart->vendorId) === 0) {
			if (empty($this->_name)) {
				vmAdminInfo('displayListFE cartVendorId=' . $cart->vendorId);
				$app = JFactory::getApplication();
				$app->enqueueMessage(JText::_('COM_VIRTUEMART_CART_NO_' . strtoupper($this->_psType)));
				return FALSE;
			} else {
				return FALSE;
			}
		}

		$signInButton = $this->renderSignInButton('listFE', $selected);
		if (!empty($signInButton)) {
			$htmlIn[] = $signInButton;
			return TRUE;
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

	/**
	 * @param plugin $method
	 * @return mixed|string
	 */
	private function renderRoAddressbookWallet () {

// TODO : readonly Addressbook and Wallet only if it has been selected
		$amazonOrderReferenceId = $this->getAmazonOrderReferenceId();
		if (!$amazonOrderReferenceId) {
			$this->amazonError("renderRoAddressbookWallet getAmazonOrderReferenceId  is NULL");
			return NULL;
		}
		// buyer can change/edit Payment / shipment address in the cart
		$redirect_page = $this->getRenderAddressbookWalletRedirectPage();

		$html = $this->renderByLayout('ro_addressbook_wallet', array(
		                                                            'virtuemart_paymentmethod_id'         => $this->_currentMethod->virtuemart_paymentmethod_id,
		                                                            'sellerId'                            => $this->_currentMethod->sellerId,
		                                                            'ro_addressbook_designWidth'          => $this->getPixelValue($this->_currentMethod->ro_addressbook_designWidth),
		                                                            'ro_addressbook_designHeight'         => $this->getPixelValue($this->_currentMethod->ro_addressbook_designHeight),
		                                                            'ro_wallet_designWidth'               => $this->getPixelValue($this->_currentMethod->ro_wallet_designWidth),
		                                                            'ro_wallet_designHeight'              => $this->getPixelValue($this->_currentMethod->ro_wallet_designHeight),
		                                                            'ro_addressbook_output_shipto_add_id' => $this->_currentMethod->ro_addressbook_output_shipto_add_id,
		                                                            'ro_addressbook_output_shipto_id'     => $this->_currentMethod->ro_addressbook_output_shipto_id,
		                                                            'amazonOrderReferenceId'              => $amazonOrderReferenceId,
		                                                            'redirect_page'                       => $redirect_page,
		                                                       ));

		return $html;
	}

	private function getPixelValue ($value) {
		$value = str_replace("px", "", $value);
		$value = $value . 'px';
		return trim($value);
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
	public function plgVmOnCheckAutomaticSelectedPayment (VirtueMartCart $cart, array $cart_prices = array()) {

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
	 * This method is fired when showing when priting an Order
	 * It displays the the payment method-specific data.
	 *
	 * @param integer $_virtuemart_order_id The order ID
	 * @param integer $method_id  method used for this order
	 * @return mixed Null when for payment methods that were not selected, text (HTML) otherwise
	 * @author Valerie Isaksen
	 */
	public function plgVmonShowOrderPrintPayment ($order_number, $method_id) {

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
	public function plgVmDeclarePluginParamsPayment ($name, $id, &$data) {
		return $this->declarePluginParams('payment', $name, $id, $data);
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

	public function plgVmSetOnTablePluginParamsPayment ($name, $id, &$table) {
		return $this->setOnTablePluginParams($name, $id, $table);
	}

	function getEmailCurrency (&$method) {

		return $method->payment_currency; // either the vendor currency, either same currency as payment
	}


	/**
	 * @param $response
	 * @param $order
	 * @return null|string
	 */
	private function getResponseHTML ($order, $paybox_data, $success, $extra_comment) {

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


	private function renderAddressbookWallet () {
		$this->vmClassLoad('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');

		$cart = VirtueMartCart::getCart();
		$client = $this->getOffAmazonPaymentsService_Client();
		$this->addWidgetUrlScript($client);
		$redirect_page = JRoute::_('index.php?option=com_virtuemart&view=pluginresponse&task=pluginnotification&format=raw&notificationTask=returnRenderAddressbookWallet&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id . '&Itemid=' . vRequest::getInt('Itemid') . '&lang=' . vRequest::getCmd('lang', ''), $cart->useXHTML, $useSSL);
		$amazonOrderReferenceId = vRequest::getString('session', '');
		if (empty($amazonOrderReferenceId)) {
			$this->debug('no $amazonOrderReferenceId', 'renderAddressbookWallet', 'debug');
			return;
		}
		$this->setAmazonOrderReferenceId($amazonOrderReferenceId);

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


	/*********************/
	/* Private functions */
	/*********************/

	private function setAmazonOrderReferenceId ($amazonOrderReferenceId) {
		$session = JFactory::getSession();
		$sessionAmazonData['virtuemart_paymentmethod_id'] = $this->_currentMethod->virtuemart_paymentmethod_id;
		$sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id]['amazonOrderReferenceId'] = $amazonOrderReferenceId;
		$sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id][$amazonOrderReferenceId] = array();
		$session->set('amazon', serialize($sessionAmazonData), 'vm');
	}

	/**
	 * @param $firstPayment
	 */
	private function setEmptyCartDone ($firstPayment) {
		$firstPayment = (array)$firstPayment;
		$firstPayment['amazon_custom'] = NULL;
		$this->storePSPluginInternalData($firstPayment, $this->_tablepkey, true);
	}

	/**
	 * Get Method Datas for a given Payment ID
	 *
	 * @author Valérie Isaksen
	 * @param int $virtuemart_order_id The order ID
	 * @return  $methodData
	 */
	private function getPluginDatasByOrderId ($virtuemart_order_id) {

		return $this->getDatasByOrderId($virtuemart_order_id);
	}

	/**
	 * IPN_Handler
	 *
	 * This trigger is invoked whenever a new notification needs to be processed,
	 * and will call the IPN API
	 *
	 *
	 */
	private function ipn () {
		// Fetch all HTTP request headers
		$headers = getallheaders();
		$body = file_get_contents('php://input');
/*
		$headers = array(
			'x-amz-sns-message-type'     => 'Notification',
			'x-amz-sns-message-id'       => 'fb446ef1-c2bd-5bb9-a998-22f365e7e95b',
			'x-amz-sns-topic-arn'        => 'arn:aws:sns:eu-west-1:291180941288:A3M3RRFO9XDT2GAA3KB5JD2CWIH',
			'x-amz-sns-subscription-arn' => 'arn:aws:sns:eu-west-1:291180941288:A3M3RRFO9XDT2GAA3KB5JD2CWIH:597ef7c5-e998-4814-a126-1d88f7041c5a',
			'Content-Length'             => '2561',
			'Content-Type'               => 'text/plain; charset=UTF-8',
			'Host'                       => 'joomla-virtuemart.org',
			'Connection'                 => 'Keep-Alive',
			'User-Agent'                 => 'Amazon Simple Notification Service Agent',
			'Cookie'                     => '53369989722c841763ad3ab697b54ad2=53b4961496dd90f495ff46cad6180295',
			'Cookie2'                    => '$Version=1',
			'Accept-Encoding'            => 'gzip,deflate',
		);
		$body = '{
  "Type" : "Notification",
  "MessageId" : "fb446ef1-c2bd-5bb9-a998-22f365e7e95b",
  "TopicArn" : "arn:aws:sns:eu-west-1:291180941288:A3M3RRFO9XDT2GAA3KB5JD2CWIH",
  "Message" : "{\\"NotificationReferenceId\\":\\"e85eed06-0c0d-468c-ac91-bf0555543388\\",\\"MarketplaceID\\":\\"136291\\",\\"NotificationType\\":\\"PaymentAuthorize\\",\\"SellerId\\":\\"AA3KB5JD2CWIH\\",\\"ReleaseEnvironment\\":\\"Sandbox\\",\\"Version\\":\\"2013-01-01\\",\\"NotificationData\\":\\"<?xml version=\\\\\\"1.0\\\\\\" encoding=\\\\\\"UTF-8\\\\\\"?><AuthorizationNotification xmlns=\\\\\\"https://mws.amazonservices.com/ipn/OffAmazonPayments/2013-01-01\\\\\\">\\\\n    <AuthorizationDetails>\\\\n        <AmazonAuthorizationId>S02-0077507-2642446-A065663<\\\\/AmazonAuthorizationId>\\\\n        <AuthorizationReferenceId>2966013<\\\\/AuthorizationReferenceId>\\\\n        <AuthorizationAmount>\\\\n            <Amount>1016.16<\\\\/Amount>\\\\n            <CurrencyCode>GBP<\\\\/CurrencyCode>\\\\n        <\\\\/AuthorizationAmount>\\\\n        <CapturedAmount>\\\\n            <Amount>0.0<\\\\/Amount>\\\\n            <CurrencyCode>GBP<\\\\/CurrencyCode>\\\\n        <\\\\/CapturedAmount>\\\\n        <AuthorizationFee>\\\\n            <Amount>0.0<\\\\/Amount>\\\\n            <CurrencyCode>GBP<\\\\/CurrencyCode>\\\\n        <\\\\/AuthorizationFee>\\\\n        <IdList/>\\\\n        <CreationTimestamp>2014-05-30T15:34:16.770Z<\\\\/CreationTimestamp>\\\\n        <ExpirationTimestamp>2014-06-29T15:34:16.770Z<\\\\/ExpirationTimestamp>\\\\n        <AuthorizationStatus>\\\\n            <State>Open<\\\\/State>\\\\n            <LastUpdateTimestamp>2014-05-30T15:34:49.449Z<\\\\/LastUpdateTimestamp>\\\\n        <\\\\/AuthorizationStatus>\\\\n        <OrderItemCategories/>\\\\n        <CaptureNow>false<\\\\/CaptureNow>\\\\n        <SoftDescriptor/>\\\\n    <\\\\/AuthorizationDetails>\\\\n<\\\\/AuthorizationNotification>\\",\\"Timestamp\\":\\"2014-05-30T03:34:50Z\\"}",
  "Timestamp" : "2014-05-30T15:34:50.623Z",
  "SignatureVersion" : "1",
  "Signature" : "ET982WPvxQoCu6FrCDRLWypmM8esqmD2N7sub2iP5WVrWYCW/iOPVYO09es9sb5YDrsfL3cTH1KbkN1iwzYaaTyAlAR7z20we5hdCtiFXTk5XWxJeRzDaEWj3fkqhqjzhKZpB88yhArihNTRCLoL16FeGQlW5wwhXVj2qpbgtBLuhSPys0LEtzvhNprVMSacWKFEHHsPf3VmPjOqE1QyhY8BtITqMqov+fRzpbmWijXeznmpvnRYOQ2aSacrucD1IdmFCw/b34rk3q6kz1ZD7eU90c0c60bdD66NUAVBg/Z5/ra46dqhebnklFVg9XhAQ6xlHdpVo5/2VE8IK/1BAw==",
  "SigningCertURL" : "https://sns.eu-west-1.amazonaws.com/SimpleNotificationService-e372f8ca30337fdb084e8ac449342c77.pem",
  "UnsubscribeURL" : "https://sns.eu-west-1.amazonaws.com/?Action=Unsubscribe&SubscriptionArn=arn:aws:sns:eu-west-1:291180941288:A3M3RRFO9XDT2GAA3KB5JD2CWIH:597ef7c5-e998-4814-a126-1d88f7041c5a"
}';
*/
		$this->amazonClassLoad('OffAmazonPaymentsNotifications_Client');
		$this->vmClassLoad('VirtueMartModelOrders', JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');

		try {
			$client = new OffAmazonPaymentsNotifications_Client();
			$notification = $client->parseRawMessage($headers, $body);
		} catch (OffAmazonPaymentsNotifications_InvalidMessageException $e) {
			$this->debugLog($e->getMessage(), __FUNCTION__ . ' $body', 'error');
			header("HTTP/1.1 503 Service Unavailable");
			exit(0);
		}
		$notificationType = $notification->getNotificationType();
		$this->debugLog($notificationType);

		$newClass = 'amazonHelper' . $notificationType;
		$newFile = JPATH_SITE . DS . 'plugins' . DS . 'vmpayment' . DS . 'amazon' . DS . 'amazon' . DS . 'helpers' . DS . strtolower($notificationType . '.php');
		if (!file_exists($newFile)) {
			$this->debugLog("Unknown notification Type: " . $notificationType, __FUNCTION__, 'error');
			return false;
		}
		if (!class_exists($newClass)) {
			require(JPATH_SITE . DS . 'plugins' . DS . 'vmpayment' . DS . 'amazon' . DS . 'amazon' . DS . 'helpers' . DS . 'helper.php');
			require($newFile);
		}
		$notificationResponse = new $newClass($notification);
		$this->debugLog("<pre>" . var_export($notificationResponse->notification, true) . "</pre>", __FUNCTION__, 'debug');


		if (!($order_number = $notificationResponse->getAuthorizationId())) {
			$this->debugLog('no Authorization in IPN received', $newClass, 'error');
			return FALSE;
		}
		if (!($virtuemart_order_id = VirtueMartModelOrders::getOrderIdByOrderNumber($order_number))) {
			$this->debugLog('Received a ' . $newClass . ' with order number ' . $order_number . 'but no order in DB with that number', $newClass, 'error');
			return FALSE;
		}
		$orderModel = VmModel::getModel('orders');
		$order = $orderModel->getOrder($virtuemart_order_id);

		if (!($payments = $this->getDatasByOrderId($virtuemart_order_id))) {
			$this->debugLog('Received a ' . $newClass . ' with order number ' . $order_number . 'but no order in DB with that number in AMAZON payment table', $newClass, 'error');
			return FALSE;
		}
		// get payments
		$order_history = $notificationResponse->handleNotification($order, $payments);
		$this->storeAmazonInternalData($order, NULL, NULL, $notificationResponse, NULL, $notificationResponse->storeResultParams());
		$orderModel->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order_history, TRUE);

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

	private function returnRenderAddressbookWallet () {
		$this->setAmazonAction('returnRenderAddressbookWallet');

		$this->saveAmazonPartialShipmentAddressIncart();
		$redirect_page = JRoute::_("index.php?option=com_virtuemart&view=cart" . $taskRoute, true, VmConfig::get('useSSL', 0));
		$app = JFactory::getApplication();
		$app->redirect($redirect_page);

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

	/**
	 * get the partial shipping address (city, state, postal code, and country) by calling the GetOrderReferenceDetails operation
	 * to compute taxes and shipping costs or possible applicable shipping speed, and options.
	 * @param $client
	 * @param $cart
	 */
	function saveAmazonPartialShipmentAddressIncart () {
		$this->vmClassLoad('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');

		$this->debug('', 'saveAmazonPartialShipmentAddressIncart', 'debug');
		$cart = VirtueMartCart::getCart();
		$onlyDigitalGoods = $this->isOnlyDigitalGoods($cart);
		if ($onlyDigitalGoods) {
			return;
		}

		$physicalDestination = $this->getOrderReferenceDetailsFullAddress();
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

	function getOrderReferenceDetailsFullAddress () {


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

	/**
	 * @param string $message
	 * @param string $title
	 * @param string $type
	 * @param bool   $echo
	 * @param bool   $doVmDebug
	 */
	function debugLog ($message, $title = '', $type = 'message', $echo = false, $doVmDebug = false) {

		if ($this->_currentMethod->debug) {
			$this->debug($message, $title, true);
		}

		if ($echo) {
			echo $message . '<br/>';
		}


		parent::debugLog($message, $title, $type, $doVmDebug);
	}

	private function debug ($subject, $title = '', $echo = true) {

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

	function amazonClassLoad ($className) {
		if (!class_exists($className)) {
			$filePath = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
			$includePaths = explode(PATH_SEPARATOR, get_include_path());
			foreach ($includePaths as $includePath) {
				if (file_exists($includePath . DIRECTORY_SEPARATOR . $filePath)) {
					require $filePath;
					return;
				}
			}
		}
	}

	function helperClassLoad ($className) {
		if (!class_exists('amazonHelper')) {
			require('amazon/helpers/helper.php');
		}
		if (!class_exists($className)) {
			$fileName = strtolower(str_replace('amazonHelper', '', $className)) . '.php';
			require('amazon/helpers/' . $fileName);
		}

	}

	function vmClassLoad ($className, $fileName) {
		if (!class_exists($className)) {
			require($fileName);
		}
	}
}

// No closing tag
