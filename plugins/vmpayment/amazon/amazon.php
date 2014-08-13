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
	var $_amazonOrderReferenceId = NULL;
	const AMAZON_EMPTY_USER_FIELD = "amazon";
	const AMAZON_EMPTY_USER_FIELD_EMAIL = "dummy@domain.com";

	function __construct (& $subject, $config) {

		//if (self::$_this)
		//   return self::$_this;
		parent::__construct($subject, $config);

		$this->_loggable = TRUE;
		$this->tableFields = array_keys($this->getTableSQLFields());
		$this->_tablepkey = 'id';
		$this->_tableId = 'id';
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
			//'amazon_response_amazonRequestId' => 'char(64) DEFAULT NULL',
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


	private function renderSignInButton ($cart = NULL) {
		$display = '';
		if ($cart == NULL) {
			$this->vmClassLoad('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
			$cart = VirtueMartCart::getCart();
		}


		if (!$this->checkConditionSignIn()) {
			return NULL;
		}

		$client = $this->getOffAmazonPaymentsService_Client();
		$buttonWidgetImageURL = $this->getButtonWidgetImageURL();
		if (!empty($buttonWidgetImageURL)) {

			$this->addWidgetUrlScript($client);
			/** we do not need that. The button or the payment method do not appear atm in the displayListFE trigger
			if ($selected == $this->_currentMethod->virtuemart_paymentmethod_id) {
			$checked = 'checked="checked"';
			} else {
			$checked = '';
			}
			 */

			$redirect_page = $this->getSignInRedirectPage();

			$onlyDigitalGoods = $this->isOnlyDigitalGoods($cart);

			$signInButton = $this->renderByLayout('signin', array(
			                                                     'buttonWidgetImageURL'        => $buttonWidgetImageURL,
			                                                     'virtuemart_paymentmethod_id' => $this->_currentMethod->virtuemart_paymentmethod_id,
			                                                     'sellerId'                    => $this->_currentMethod->sellerId,
			                                                     'sign_in_css'                 => $this->_currentMethod->sign_in_css,
			                                                     'renderAmazonAddressBook'     => (!$onlyDigitalGoods),
			                                                     'redirect_page'               => $redirect_page,
			                                                     'addressbook_billto_shipto'   => $this->_currentMethod->addressbook_billto_shipto,
			                                                     'loginform'                   => $this->_currentMethod->loginform,
			                                                     'paymentForm'                 => $this->_currentMethod->paymentForm,
			                                                     'layout'                      => $cart->layout,

			                                                ));
			return $signInButton;
		}


	}


	private function renderAddressbookWallet ($readOnlyWidgets = false) {
		//if ($this->getRenderAddressDoneFromSession()) { return;}
		$this->vmClassLoad('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');

		$cart = VirtueMartCart::getCart();
		$this->setCartLayout($cart);

		$client = $this->getOffAmazonPaymentsService_Client();
		$this->addWidgetUrlScript($client);
		if (empty($this->_amazonOrderReferenceId)) {
			$this->_amazonOrderReferenceId = $this->getAmazonOrderReferenceId();
			if (empty($this->_amazonOrderReferenceId)) {
				$this->debug('no $_amazonOrderReferenceId', 'renderAddressbookWallet', 'debug');
				return;
			}
		}
		//$this->setRenderAddressDoneInSession();
		$this->_amazonOrderReferenceId = $this->getAmazonOrderReferenceIdFromSession();
		$onlyDigitalGoods = $this->isOnlyDigitalGoods($cart);
		$html = $this->renderByLayout('addressbook_wallet', array(
		                                                         'virtuemart_paymentmethod_id' => $this->_currentMethod->virtuemart_paymentmethod_id,
		                                                         'sellerId'                    => $this->_currentMethod->sellerId,
		                                                         'addressbook_designWidth'     => $this->getPixelValue($this->_currentMethod->addressbook_designWidth),
		                                                         'addressbook_designHeight'    => $this->getPixelValue($this->_currentMethod->addressbook_designHeight),
		                                                         'wallet_designWidth'          => $this->getPixelValue($this->_currentMethod->wallet_designWidth),
		                                                         'wallet_designHeight'         => $this->getPixelValue($this->_currentMethod->wallet_designHeight),
		                                                         'amazonOrderReferenceId'      => $this->_amazonOrderReferenceId,
		                                                         'renderAddressBook'           => (!$onlyDigitalGoods),
		                                                         'renderWalletBook'            => $cart->virtuemart_shipmentmethod_id,
		                                                         'addressbook_billto_shipto'   => $this->_currentMethod->addressbook_billto_shipto,
		                                                         'loginform'                   => $this->_currentMethod->loginform,
		                                                         'paymentForm'                 => $this->_currentMethod->paymentForm,
		                                                         'readOnlyWidgets'             => $readOnlyWidgets ? 'Read' : "Edit",
		                                                    ));
		echo $html;
	}


	private function checkConditionSignIn () {
		$cart_prices = array();
		$this->vmClassLoad('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');

		$cart = VirtueMartCart::getCart();
		// atm, we only display the SignIn button via the trigger plgVmOnCheckoutAdvertise
		//if ($this->doSignInDisplay($sign_in_display) && $this->checkConditions($cart, $this->_currentMethod, $cart_prices) && $this->checkProductConditions($product, $this->_currentMethod)) {
		if ($this->checkConditions($cart, $this->_currentMethod, $cart_prices)) {
			return true;
		}
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
		if ($this->isValidCountry($cart) && $this->isValidLanguage() && $this->isValidAmount($cart) && $this->isValidProductCategories($cart) && $this->isValidIP()
		) {
			return true;
		}
		return false;
	}

	/**
	 * @return bool
	 */
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

	/**
	 * @return bool
	 */
	private function isValidAmount () {
		return true;
	}


	/**
	 * Exclusion of unsupported items: product categories as “not available via Amazon Payments”.
	 * @param $cart
	 * @return bool
	 */
	private function isValidProductCategories ($cart) {
		if (!is_array($this->_currentMethod->exclude_categories)) {
			$exclude_categories[0] = $this->_currentMethod->exclude_categories;
		} else {
			$exclude_categories = $this->_currentMethod->exclude_categories;
		}


		foreach ($cart->products as $product) {
			if (array_intersect($exclude_categories, $product->categories)) {
				return false;
			}
		}
		return true;
	}

	/**
	 * to find out if the sign in button should be displayed or not in the product page
	 * @param $product
	 * @return bool
	 */
	private function checkProductConditions ($product) {
		if (!is_array($this->_currentMethod->exclude_categories)) {
			$exclude_categories[0] = $this->_currentMethod->exclude_categories;
		} else {
			$exclude_categories = $this->_currentMethod->exclude_categories;
		}

		if (array_intersect($exclude_categories, $product->categories)) {
			return false;
		}

		return true;
	}

	/**
	 * Switch for enabling / disabling Hidden Button Mode.
	 * @return bool
	 */

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
			$this->amazonError(__FUNCTION__ . ' ' . $e->getMessage(), $e->getCode());
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

	/**
	 * @return
	 */
	function getSignInRedirectPage () {

		$url = 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginnotification&format=raw&nt=getAmazonSessionId&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id . '&Itemid=' . vRequest::getInt('Itemid') . '&lang=' . vRequest::getCmd('lang', '');

		//$_amazonOrderReferenceId = $this->getAmazonOrderReferenceId();
		if ($this->_amazonOrderReferenceId) {
			//$url .= '&session=' . $this->_amazonOrderReferenceId;
		}
		$cart = VirtueMartCart::getCart();
		return JRoute::_($url, $cart->useXHTML, $cart->useSSL);

	}

	/**
	 * @param $product
	 * @param $productDisplay
	 * @return bool

	function plgVmOnProductDisplayPayment ($product, &$productDisplay) {

	$vendorId = 1;
	if ($this->getPluginMethods($vendorId) === 0) {
	return FALSE;
	}

	$productDisplay = $this->renderSignInButton('product', false, $product);
	return TRUE;
	}
	 */


	/**
	 * @return null
	 */
	public function plgVmOnPaymentNotification () {

		$virtuemart_paymentmethod_id = vRequest::getInt('pm', 0);
		if (!($this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			return FALSE;
		}

		$notificationTask = vRequest::getCmd('nt', '');

		switch ($notificationTask) {

			case 'getAmazonSessionId':

				if (!class_exists('VirtueMartCart')) {
					require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
				}
				$cart = VirtueMartCart::getCart(false);
				$this->saveAmazonOrderReferenceId($cart);
				$this->setCartLayout($cart);
				$this->redirectToCart();
				break;
			case 'ipn':
				$this->ipn();
				break;
			default:
				$this->amazonError(vmText::_('VMPAYMENT_AMAZON_INVALID_NOTIFICATION_TASK'));
				return;
		}

	}

	function plgVmOnSelfCallFE ($type, $name, &$render) {
		if ($name != $this->_name || $type != 'vmpayment') {
			return FALSE;
		}
		$action = vRequest::getCmd('action');
		$virtuemart_paymentmethod_id = vRequest::getInt('virtuemart_paymentmethod_id');
		//Load the method
		if (!($this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}

		if (!class_exists('VirtueMartCart')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		}
		switch ($action) {
			/*
			case 'getAmazonSessionId':
				//$client = $this->getOffAmazonPaymentsService_Client();
				//$this->setOrderReferenceDetails()
				$this->getAmazonSessionId();
				$this->redirectToCart(NULL,$this->_currentMethod->cart_layout);
				break;
			*/
			case 'updateCartWithAmazonAddress':
				//$client = $this->getOffAmazonPaymentsService_Client();
				//$this->setOrderReferenceDetails()
				$return = $this->updateCartWithAmazonAddress();
				$json = array();
				$json['reload'] = $return;

				JResponse::setHeader('Cache-Control', 'no-cache, must-revalidate');
				JResponse::setHeader('Expires', 'Mon, 6 Jul 2000 10:00:00 GMT');
				// Set the MIME type for JSON output.
				$document = JFactory::getDocument();
				$document->setMimeEncoding('application/json');
				JResponse::setHeader('Content-Disposition', 'attachment;filename="amazon.json"', TRUE);
				JResponse::sendHeaders();

				echo json_encode($json);
				jExit();
				//JFactory::getApplication()->close();
				break;
			case 'selectShipments':
				$data["shipments"] = $this->lSelectShipment();
				echo json_encode($data);
				JFactory::getApplication()->close();
				break;

			case 'leaveAmazon':
				if (!class_exists('VmConfig')) {
					require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'config.php');
				}
				VmConfig::loadConfig();
				$cart = VirtueMartCart::getCart();
				$this->unsetcartLayout($cart);
				break;
			case 'resetAmazonReferenceId':
				$this->clearAmazonSession();
				break;
			default:
				$this->amazonError(vmText::_('VMPAYMENT_AMAZON_INVALID_NOTIFICATION_TASK'));
				return;
		}

	}

	/**
	 * this function is a copy/paste of the one in the VirtueMartViewCart
	 * @return array
	 */
	function lSelectShipment () {
		$this->vmClassLoad('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');

		$cart = VirtueMartCart::getCart(false);
		$found_shipment_method = false;
		$shipment_not_found_text = JText::_('COM_VIRTUEMART_CART_NO_SHIPPING_METHOD_PUBLIC');

		$shipments_shipment_rates = array();
		/*
		if (!$this->checkShipmentMethodsConfigured()) {
			$this->shipments_shipment_rates=$shipments_shipment_rates;
			$this->found_shipment_method=$found_shipment_method;
			return;
		}
		*/
		$selectedShipment = (empty($cart->virtuemart_shipmentmethod_id) ? 0 : $cart->virtuemart_shipmentmethod_id);

		$shipments_shipment_rates = array();
		if (!class_exists('vmPSPlugin')) {
			require(JPATH_VM_PLUGINS . DS . 'vmpsplugin.php');
		}
		JPluginHelper::importPlugin('vmshipment');
		$dispatcher = JDispatcher::getInstance();

		$returnValues = $dispatcher->trigger('plgVmDisplayListFEShipment', array(
		                                                                        $cart,
		                                                                        $selectedShipment,
		                                                                        &$shipments_shipment_rates
		                                                                   ));
		// if no shipment rate defined
		$found_shipment_method = false;
		foreach ($returnValues as $returnValue) {
			if ($returnValue) {
				$found_shipment_method = true;
				break;
			}
		}
		$shipment_not_found_text = JText::_('COM_VIRTUEMART_CART_NO_SHIPPING_METHOD_PUBLIC');

		$shipments = array();
		foreach ($shipments_shipment_rates as $items) {
			if (is_array($items)) {
				foreach ($items as $item) {
					$shipments[] = $item;
				}
			} else {
				$shipments[] = $items;
			}
		}
		/*
				$shipments['shipment_not_found_text']=$shipment_not_found_text;
				$shipments['shipments_shipment_rates']=$shipments;
				$shipments['found_shipment_method']=$found_shipment_method;
		*/
		return $shipments;
	}

	/**
	 * @param VirtueMartCart $cart
	 */

	public function plgVmOnCheckoutCheckDataPayment (VirtueMartCart $cart) {
		if (!$this->selectedThisByMethodId($cart->virtuemart_paymentmethod_id)) {
			return NULL; // Another method was selected, do nothing
		}
		if (!($this->_currentMethod = $this->getVmPluginMethod($cart->virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		static $plgVmOnCheckoutCheckDataPayment = 1;
		vmdebug('AMAZON plgVmOnCheckoutCheckDataPayment called', $plgVmOnCheckoutCheckDataPayment);
		$plgVmOnCheckoutCheckDataPayment = $plgVmOnCheckoutCheckDataPayment + 1;;
		$this->_amazonOrderReferenceId = $this->getAmazonOrderReferenceIdFromSession();
		if (empty($this->_amazonOrderReferenceId)) {
			$message = vmText::_('VMPAYMENT_AMAZON_PAYWITHAMAZON_BUTTON');
			vmError($message, $message);
			return false;
		}
		$client = $this->getOffAmazonPaymentsService_Client();

		// setOrderReferenceDetails
		if (!$setOrderReferenceDetailsResponse = $this->setOrderReferenceDetails($client, $cart)) {
			$this->removeAmazonAddressFromCart($cart);
			$this->clearAmazonSession();
			$cart->emptyCart();
			$this->onErrorRedirectToCart();
			return FALSE;
		}
		// getOrderReferenceDetails
		if (!$getOrderReferenceDetailsResponse = $this->getOrderReferenceDetails($client, $cart)) {
			$this->removeAmazonAddressFromCart($cart);
			$this->clearAmazonSession();
			$cart->emptyCart();
			$this->onErrorRedirectToCart();
			return FALSE;
		}

		$orderReferenceDetails = $getOrderReferenceDetailsResponse->GetOrderReferenceDetailsResult->getOrderReferenceDetails();
		if ($this->isSetConstraints($cart, $orderReferenceDetails)) {
			return false;
		}

		return true;
	}

	/**
	 * Constraints indicates if mandatory information is missing or incorrect in the Order Reference Object
	 * @param $cart
	 * @param $orderReferenceDetails
	 * @return bool
	 */
	private function isSetConstraints ($cart, $orderReferenceDetails) {
		if ($orderReferenceDetails->isSetConstraints()) {
			$constraints = $orderReferenceDetails->getConstraints();
			$constraintList = $constraints->getConstraint();
			foreach ($constraintList as $constraint) {
				if ($constraint->isSetDescription()) {
					$this->setInConfirmOrder($cart, false);
					switch ($constraint->isSetConstraintID($constraint)) {
						case 'ShippingAddressNotSet':
							$this->handleShippingAddressNotSetConstraint($constraint);
							break;
						case 'PaymentPlanNotSet':
							$this->handlePaymentPlanNotSetConstraint($constraint);
							break;
						case 'AmountNotSet':
							//$this->handleAmountNotSetConstraint($constraint);
							// PROGRAMMING ERRROR TODO
							break;
						case 'PaymentMethodNotAllowed':
							$this->handlePaymentMethodNotAllowedConstraint($constraint);
							break;
						default:
							vmError('VMPAYMENT_AMAZON_CONSTRAINTID_UNKOWN');
							$this->onErrorRedirectToCart();
							return true;
					}
					return true;
				}
			}

		}
		return false;
	}

	/**
	 * Display again the Amazon AddressBook widget to the buyer to collect shipping Information
	 * @param $constraint
	 */
	private function handleShippingAddressNotSetConstraint ($constraint) {
		$this->renderAddressbookWallet();
	}

	/**
	 * Display again the Amazon Wallet widget to the buyer to collect payment Information
	 * @param $constraint
	 */
	private function handlePaymentPlanNotSetConstraint ($constraint) {
		$this->renderAddressbookWallet();
	}

	/**
	 * Call again the SetOrderReferenceDetails operation with the order amount
	 * This constraint should not happen. It is a programming error
	 * @param $constraint
	 */
	private function handleAmountNotSetConstraint ($constraint) {
		$this->amazonError('handleAmountNotSetConstraint: ' . $constraint->getDescription());

	}

	/**
	 * Display again the Amazon Wallet widget and Request the buyer to select a different payment method
	 * @param $constraint
	 */
	private function handlePaymentMethodNotAllowedConstraint ($constraint) {
		$this->renderAddressbookWallet('VMPAYMENT_AMAZON_SELECT_ANOTHER_PAYMENT');
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
		//$this->setInConfirmOrder($cart);

		$this->_amazonOrderReferenceId = $this->getAmazonOrderReferenceIdFromSession();
		if (!$this->_amazonOrderReferenceId) {
			$this->onErrorRedirectToCart();
			return FALSE;
		}

		$this->storeAmazonInternalData($order, NULL, NULL, NULL, $this->renderPluginName($this->_currentMethod));

		$client = $this->getOffAmazonPaymentsService_Client();
		/*
				if (!$this->updateAmazonFullShipmentAddressInOrder($client, $cart, $order)) {
					return FALSE;
				}
		*/
		/*
				// setOrderReferenceDetails has been done in CheckoutData, ther should not be any changes here
				if (!$setOrderReferenceDetailsResponse = $this->setOrderReferenceDetails($client, $cart, $order)) {
					$this->removeAmazonAddressFromCart($cart);
					$this->clearAmazonSession();
					$cart->emptyCart();
					$this->onErrorRedirectToCart();
					return FALSE;
				}
		// getOrderReferenceDetails
				if (!$getOrderReferenceDetailsResponse = $this->getOrderReferenceDetails($client, $cart)) {
					$this->removeAmazonAddressFromCart($cart);
					$this->clearAmazonSession();
					$cart->emptyCart();
					$this->onErrorRedirectToCart();
					return FALSE;
				}
		*/
		/*
				if ($this->isSetConstraints($cart, $orderReferenceDetails)) {
					return FALSE;
				}
		*/
		//confirmOrderReference
		$this->confirmOrderReference($client, $order);
		// getorderdetails et  address email
		if (!$this->updateBuyerInOrder($client, $cart, $order)) {
			return FALSE;
		}

		// at this point, since the authorization and capturing takes additional time to process
		// let's do that with a trigger
		$modelOrder = VmModel::getModel('orders');
		if ($this->canDoAuthorization()) {
			if (!($amazonAuthorizationId = $this->getAuthorization($client, $cart, $order))) {
				$this->onErrorRedirectToCart();
				return FALSE;
			}

			$order_history['order_status'] = $this->onAuthorizationSuccessGetNewStatus();
			$order_history['customer_notified'] = 1;
			$order_history['comments'] = '';
			$modelOrder->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order_history, TRUE);

		}
		if (!class_exists('CurrencyDisplay')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'currencydisplay.php');
		}
		$success = true;
		$currency = CurrencyDisplay::getInstance('', $order['details']['BT']->virtuemart_vendor_id);
		$payment_name = $this->renderPluginName($this->_currentMethod);
		$html = $this->renderByLayout('response', array(
		                                               "success"               => $success,
		                                               "payment_name"          => $payment_name,
		                                               "amazonAuthorizationId" => $amazonAuthorizationId,
		                                               "order"                 => $order,
		                                               "currency"              => $currency,
		                                          ));

		vRequest::setVar('html', $html);
		$this->removeAmazonAddressFromCart($cart);
		$this->clearAmazonSession();
		$cart = VirtueMartCart::getCart();
		$cart->emptyCart();
		return TRUE;


	}


	private function canDoAuthorization () {
		if ($this->_currentMethod->erp_mode == "erp_mode_disabled" OR ($this->_currentMethod->erp_mode == "erp_mode_enabled" AND $this->_currentMethod->authorization_mode_erp_enabled != "authorization_done_by_erp")) {
			return true;
		} else {
			return false;
		}
	}

	private function isERPMode () {
		if ($this->_currentMethod->erp_mode == "erp_mode_enabled") {
			return true;
		} else {
			return false;
		}
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
	private function storeAmazonInternalData ($order, $request, $response, $notification = NULL, $payment_name = NULL, $amazonParams = NULL) {

		$db_values['order_number'] = $order['details']['BT']->order_number;
		$db_values['virtuemart_order_id'] = $order['details']['BT']->virtuemart_order_id;
		$db_values['virtuemart_paymentmethod_id'] = $this->_currentMethod->virtuemart_paymentmethod_id;
		$db_values['payment_order_total'] = $order['details']['BT']->order_total;
		$db_values['payment_currency'] = $order['details']['BT']->user_currency_id;
		$db_values['amazon_request'] = $request ? serialize($request) : "";
		$db_values['amazon_response'] = $response ? serialize($response) : "";
		$db_values['amazon_notification'] = $notification ? serialize($notification) : "";
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

// TODO:  address line 3, district
	private function updateBuyerInOrder ($client, $cart, $order) {

		$orderModel = VmModel::getModel('orders');
		$BT['virtuemart_order_id'] = $order['details']['BT']->virtuemart_order_id;
		$order_userinfosTable = $orderModel->getTable('order_userinfos');

		$getOrderReferenceDetailsResponse = $this->getOrderReferenceDetails($client);
		$getOrderReferenceDetailsResult = $getOrderReferenceDetailsResponse->getGetOrderReferenceDetailsResult();
		$orderReferenceDetails = $getOrderReferenceDetailsResult->getOrderReferenceDetails();

		if ($orderReferenceDetails->isSetBuyer()) {
			$buyer = $orderReferenceDetails->getBuyer();
			$BT = $this->getUserInfoFromAmazon($buyer, '', false, true);
			$BT['virtuemart_order_id'] = $order['details']['BT']->virtuemart_order_id;
			$BT['address_type'] = 'BT';

			$order_userinfosTable->load($order['details']['BT']->virtuemart_order_id, 'virtuemart_order_id', " AND address_type='BT'");
			if (!$order_userinfosTable->bindChecknStore($BT, true)) {
				vmError($order_userinfosTable->getError());
				return false;
			}

		}

		// at this step, we should get it from amazon
		$onlyDigitalGoods = $this->isOnlyDigitalGoods($cart);
		if (!$onlyDigitalGoods) {

			$physicalDestination = $orderReferenceDetails->getDestination()->getPhysicalDestination();

			if ($physicalDestination) {
				$ST = $this->getUserInfoFromAmazon($physicalDestination);
				$ST['virtuemart_order_id'] = $order['details']['BT']->virtuemart_order_id;
				$ST['address_type'] = 'ST';

				$order_userinfosTable->load($order['details']['BT']->virtuemart_order_id, 'virtuemart_order_id', " AND address_type='ST'");
				if (!$order_userinfosTable->bindChecknStore($ST, true)) {
					vmError($order_userinfosTable->getError());
					return false;
				}

			}
		}

		return true;
	}


	/**
	 * Only returned if authorization is in Open state or in Closed with reason code=MaxCaptureProcessed
	 *
	 * @param $cart
	 * @param $order
	 * @param $amazonAuthorizationId
	 * @return bool
	 */
	private function updateAmazonBillingAddressInOrder ($cart, $order, $amazonAuthorizationId) {

		$billingAddress = $this->getAmazonBillingAddress($amazonAuthorizationId);
		if (!$billingAddress) {
			return;
		}

		$orderModel = VmModel::getModel('orders');
		$userInfoData['virtuemart_order_id'] = $order['details']['BT']->virtuemart_order_id;
		$userInfoData = $this->getUserInfoFromAmazon($billingAddress);

		$order_userinfosTable = $orderModel->getTable('order_userinfos');
		$order_userinfosTable->load($order['details']['BT']->virtuemart_order_id, 'virtuemart_order_id', " AND address_type='BT'");
		if (!$order_userinfosTable->bindChecknStore($userInfoData, true)) {
			vmError($order_userinfosTable->getError());
			return false;
		}

		return true;
	}


	private function getUserInfoFromAmazon ($amazonAddress, $prefix = '', $all = true, $getEmail = false) {
		$userInfoData = array(
			'title'       => "&nbsp;",
			'first_name'  => "&nbsp;",
			'middle_name' => "&nbsp;",
		);
		if ($amazonAddress->isSetName()) {
			$userInfoData[$prefix . 'last_name'] = $amazonAddress->getName();
		}

		if ($getEmail AND $amazonAddress->isSetEmail()) {
			$userInfoData['email'] = $amazonAddress->getEmail();
		}
		if ($amazonAddress->isSetPhone()) {
			$userInfoData['phone_1'] = $amazonAddress->getPhone();

		}
		if ($all) {
			if ($amazonAddress->isSetAddressLine1()) {
				$userInfoData[$prefix . 'address_1'] = $amazonAddress->getAddressLine1();
				if ($amazonAddress->isSetAddressLine2()) {
					$userInfoData[$prefix . 'address_2'] = $amazonAddress->getAddressLine2();
				}
				if ($amazonAddress->isSetAddressLine3()) {
					$userInfoData[$prefix . 'address_3'] = $amazonAddress->getAddressLine3();
				}
			} else {
				if ($amazonAddress->isSetAddressLine2()) {
					$userInfoData[$prefix . 'address_1'] = $amazonAddress->getAddressLine2();
				}
				if ($amazonAddress->isSetAddressLine3()) {
					$userInfoData[$prefix . 'address_2'] = $amazonAddress->getAddressLine3();
				}
			}

			if ($amazonAddress->isSetCity()) {
				$userInfoData[$prefix . 'city'] = $amazonAddress->getCity();
			}
			if ($amazonAddress->isSetCounty()) {
				//$userInfoData['county'] = $amazonAddress->getCounty();
			}
			if ($amazonAddress->isSetDistrict()) {
				//$userInfoData['district'] = $amazonAddress->GetDistrict();
			}
			if ($amazonAddress->isSetStateOrRegion()) {
				$stateId = shopFunctions::getStateIDByName($amazonAddress->GetStateOrRegion());
				if ($stateId) {
					$userInfoData[$prefix . 'state'] = $amazonAddress->GetStateOrRegion();
				} else {
					$userInfoData[$prefix . 'state'] = 0;
				}
			}
			if ($amazonAddress->isSetPostalCode()) {
				$userInfoData[$prefix . 'zip'] = $amazonAddress->GetPostalCode();
			}
			if ($amazonAddress->isSetCountryCode()) {
				$userInfoData[$prefix . 'virtuemart_country_id'] = shopFunctions::getCountryIDByName($amazonAddress->GetCountryCode());
			}
		}


		return $userInfoData;
	}


	function getAmazonShipmentAddress () {
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_GetOrderReferenceDetailsRequest');

		$client = $this->getOffAmazonPaymentsService_Client();
		try {
			$getOrderReferenceDetailsRequest = new OffAmazonPaymentsService_Model_GetOrderReferenceDetailsRequest();
			$getOrderReferenceDetailsRequest->setSellerId($this->_currentMethod->sellerId);
			$getOrderReferenceDetailsRequest->setAmazonOrderReferenceId($this->getAmazonOrderReferenceIdFromSession());
			$referenceDetailsResultWrapper = $client->getOrderReferenceDetails($getOrderReferenceDetailsRequest);
			$physicalDestination = $referenceDetailsResultWrapper->GetOrderReferenceDetailsResult->getOrderReferenceDetails()->getDestination()->getPhysicalDestination();

		} catch (Exception $e) {
			$this->amazonError(__FUNCTION__ . ' ' . $e->getMessage(), $e->getCode());
			return;
		}

		return $physicalDestination;
	}

	function getAmazonBillingAddress ($amazonAuthorizationId) {

		$client = $this->getOffAmazonPaymentsService_Client();
		try {

			$authDetailsRequest = new OffAmazonPaymentsService_Model_GetAuthorizationDetailsRequest();
			$authDetailsRequest->setSellerId($this->_currentMethod->sellerId);
			$authDetailsRequest->setAmazonAuthorizationId($amazonAuthorizationId);
			$authDetailsResponseWrapper = $client->getAuthorizationDetails($authDetailsRequest);
			$billingAddress = $authDetailsResponseWrapper->getGetAuthorizationDetailsResult()->getAuthorizationDetails()->getAuthorizationBillingAddress();

		} catch (Exception $e) {
			$this->amazonError(__FUNCTION__ . ' ' . $e->getMessage(), $e->getCode());
			return;
		}

		return $billingAddress;
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
	private function setOrderReferenceDetails ($client, $cart) {
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_OrderReferenceAttributes');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_OrderTotal');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_SellerOrderAttributes');

		//$_amazonOrderReferenceId = $this->getAmazonOrderReferenceIdFromSession();
		if (empty($this->_amazonOrderReferenceId)) {
			$this->amazonError(__FUNCTION__ . ' setOrderReferenceDetails, No $_amazonOrderReferenceId');
			return FALSE;
		}
		try {

			$setOrderReferenceDetailsRequest = new OffAmazonPaymentsService_Model_SetOrderReferenceDetailsRequest();
			$setOrderReferenceDetailsRequest->setSellerId($this->_currentMethod->sellerId);
			$setOrderReferenceDetailsRequest->setAmazonOrderReferenceId($this->_amazonOrderReferenceId);
			$setOrderReferenceDetailsRequest->setOrderReferenceAttributes(new OffAmazonPaymentsService_Model_OrderReferenceAttributes());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setOrderTotal(new OffAmazonPaymentsService_Model_OrderTotal());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getOrderTotal()->setCurrencyCode($this->getCurrencyCode3($client));
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getOrderTotal()->setAmount($this->getTotalInPaymentCurrency($client, $cart->pricesUnformatted['salesPrice'], $cart->pricesCurrency));
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setSellerNote($this->getSellerNote());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setSellerOrderAttributes(new OffAmazonPaymentsService_Model_SellerOrderAttributes());
			//$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getSellerOrderAttributes()->setSellerOrderId($order['details']['BT']->order_number);
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getSellerOrderAttributes()->setStoreName($this->getStoreName());
			//$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getSellerOrderAttributes()->setCustomInformation($order['details']['BT']->customer_note);
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setPlatformId($this->getPlatformId());

			$setOrderReferenceDetailsResponse = $client->setOrderReferenceDetails($setOrderReferenceDetailsRequest);

		} catch (Exception $e) {
			$this->amazonError(__FUNCTION__ . ' ' . $e->getMessage(), $e->getCode());
			$this->clearAmazonSession();
			return FALSE;
		}
		$this->debugLog("<pre>" . var_export($setOrderReferenceDetailsRequest, true) . "</pre>", __FUNCTION__, 'debug');
		$this->debugLog("<pre>" . var_export($setOrderReferenceDetailsResponse, true) . "</pre>", __FUNCTION__, 'debug');
		/*
				$this->helperClassLoad('amazonHelperSetOrderReferenceDetailsResponse');
				$amazonHelperSetOrderReferenceDetailsResponse = new amazonHelperSetOrderReferenceDetailsResponse($setOrderReferenceDetailsResponse);

				//$this->storeAmazonInternalData(NULL, $setOrderReferenceDetailsRequest, $setOrderReferenceDetailsResponse, NULL, $amazonHelperSetOrderReferenceDetailsResponse->storeResultParams());
				// update order status ??
				return $setOrderReferenceDetailsResponse;
		*/
		return $setOrderReferenceDetailsResponse;
	}

	/**
	 * @return bool
	 */
	private function getOrderReferenceDetails ($client) {
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_GetOrderReferenceDetailsRequest');

		//$_amazonOrderReferenceId = $this->getAmazonOrderReferenceIdFromSession();
		if (empty($this->_amazonOrderReferenceId)) {
			$this->amazonError(__FUNCTION__ . ' setOrderReferenceDetails, No $_amazonOrderReferenceId');
			return FALSE;
		}
		try {

			$getOrderReferenceDetailsRequest = new OffAmazonPaymentsService_Model_GetOrderReferenceDetailsRequest();
			$getOrderReferenceDetailsRequest->setSellerId($this->_currentMethod->sellerId);
			$getOrderReferenceDetailsRequest->setAmazonOrderReferenceId($this->_amazonOrderReferenceId);

			$getOrderReferenceDetailsResponse = $client->getOrderReferenceDetails($getOrderReferenceDetailsRequest);

		} catch (Exception $e) {
			$this->amazonError(__FUNCTION__ . ' ' . $e->getMessage(), $e->getCode());
			$this->clearAmazonSession();
			return FALSE;
		}
		$this->debugLog("<pre>" . var_export($getOrderReferenceDetailsRequest, true) . "</pre>", __FUNCTION__, 'debug');
		$this->debugLog("<pre>" . var_export($getOrderReferenceDetailsResponse, true) . "</pre>", __FUNCTION__, 'debug');
		/*
				$this->helperClassLoad('amazonHelperSetOrderReferenceDetailsResponse');
				$amazonHelperSetOrderReferenceDetailsResponse = new amazonHelperSetOrderReferenceDetailsResponse($setOrderReferenceDetailsResponse);

				//$this->storeAmazonInternalData(NULL, $setOrderReferenceDetailsRequest, $setOrderReferenceDetailsResponse, NULL, $amazonHelperSetOrderReferenceDetailsResponse->storeResultParams());
				// update order status ??
				return $setOrderReferenceDetailsResponse;
		*/
		return $getOrderReferenceDetailsResponse;
	}


	/**
	 * @param $client
	 * @param $total
	 * @param $backToPricesCurrency
	 * @return array
	 */
	private function getTotalInPaymentCurrency ($client, $total, $backToPricesCurrency) {
		if (!class_exists('CurrencyDisplay')) {
			require(JPATH_VM_ADMINISTRATOR . '/helpers/currencydisplay.php');
		}
		$virtuemart_currency_id = $this->getCurrencyId($client);
		$totalInPaymentCurrency = vmPSPlugin::getAmountValueInCurrency($total, $virtuemart_currency_id);

		$cd = CurrencyDisplay::getInstance($backToPricesCurrency);

		return $totalInPaymentCurrency;
	}

	/**
	 * @param $client
	 * @return int
	 */
	private function getCurrencyId ($client) {
		$currencyCode3 = $this->getCurrencyCode3($client);
		$virtuemart_currency_id = shopFunctions::getCurrencyIDByName($currencyCode3);
		return $virtuemart_currency_id;
	}

	/**
	 * @param $client
	 * @return mixed
	 */
	private function getCurrencyCode3 ($client) {
		return $client->getMerchantValues()->getCurrency();
	}

	/**
	 * SellerNote can contain Sandbox Simulation string to test the Constraints
	 * @return null|string
	 */
	private function getSellerNote () {
		return $this->getSetOrderReferenceSandboxSimulationString();
	}

	/**
	 * @return string
	 */
	private function getSellerAuthorizationNote () {
		return $this->getAuthorizeSandboxSimulationString();
	}


	/**
	 * @return null|string
	 */
	private function getSellerRefundNote () {
		return $this->getRefundSandboxSimulationString();
	}

	/**
	 *
	 */
	private function getSetOrderReferenceSandboxSimulationString () {
		$setOrderReferenceSandboxSimulation = array(
			'InvalidPaymentMethod',
			//	'AmazonRejected',
			//	'TransactionTimedOut',
			//	'ExpiredUnused',
			//	'AmazonClosed',
		);
		return $this->getSandboxSimulationString($setOrderReferenceSandboxSimulation, $this->_currentMethod->sandbox_error_simulation);
	}

	/**
	 *
	 */
	private function getAuthorizeSandboxSimulationString () {
		$authorizeSandboxSimulation = array(
			'InvalidPaymentMethod',
			'AmazonRejected',
			'TransactionTimedOut',
			'ExpiredUnused',
			'AmazonClosed',
		);
		return $this->getSandboxSimulationString($authorizeSandboxSimulation, $this->_currentMethod->sandbox_error_simulation);
	}

	/**
	 *
	 */
	private function getClosedSandboxSimulationString () {
		$closedSandboxSimulation = array(
			'AmazonClosed',
		);
		return $this->getSandboxSimulationString($closedSandboxSimulation, $this->_currentMethod->sandbox_error_simulation);
	}

	/**
	 *
	 */
	private function getCaptureSandboxSimulationString () {
		$captureSandboxSimulation = array(
			'Pending',
			'AmazonRejected',
			'AmazonClosed',
		);
		return $this->getSandboxSimulationString($captureSandboxSimulation, $this->_currentMethod->sandbox_error_simulation);
	}

	/**
	 *
	 */
	private function getRefundSandboxSimulationString () {

		$refundSandboxSimulation = array(
			'AmazonRejected'
		);
		return $this->getSandboxSimulationString($refundSandboxSimulation, $this->_currentMethod->sandbox_error_simulation);
	}

	/**
	 *
	 * @param $authorizedSimulationReasons
	 * @param $reason
	 * @return null|string
	 */
	private function getSandboxSimulationString ($authorizedSimulationReasons, $reason) {
		if ($this->_currentMethod->environment != 'sandbox' OR $this->_currentMethod->sandbox_error_simulation == 0) {
			return NULL;
		}

		if (in_array($this->_currentMethod->sandbox_error_simulation, $authorizedSimulationReasons)) {

			$sandboxSimulationStrings = array(
				'InvalidPaymentMethod' => '{"SandboxSimulation": {"State":"Declined","ReasonCode":"InvalidPaymentMethod","PaymentMethodUpdateTimeInMins":100}}',
				'AmazonRejected'       => '{"SandboxSimulation": {"State":"Declined","ReasonCode":"AmazonRejected" }}',
				'TransactionTimedOut'  => '{"SandboxSimulation": {"State":"Declined","ReasonCode":"TransactionTimedOut"}}',
				'ExpiredUnused'        => '{"SandboxSimulation": {"State":"Declined","ReasonCode":"ExpiredUnused" ,"ExpirationTimeInMins":1}}',
				'AmazonClosed'         => '{"SandboxSimulation": {"State":"Closed","ReasonCode":"AmazonClosed"}}',
				'Pending'              => '{"SandboxSimulation": {"State":"Pending"}}',

			);

			$simulationString = $sandboxSimulationStrings[$reason];
			return urlencode($simulationString);
		}
		return NULL;
	}

	/**
	 * @return mixed
	 */
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


	private function onErrorRedirectToCart ($msg = NULL) {
		if (!$msg) {
			$msg = vmText::_('VMPAYMENT_AMAZON_ERROR_TRY_AGAIN');
		} else {
		}
		$this->redirectToCart($msg, true);
	}

	private function redirectToCart ($msg = NULL, $clearAmazonSession = false) {


		if ($clearAmazonSession) {
			$this->clearAmazonSession();
		}

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
			$confirmOrderReferenceRequest->setAmazonOrderReferenceId($this->_amazonOrderReferenceId);
			$confirmOrderReferenceRequest->setSellerId($this->_currentMethod->sellerId);
			$confirmOrderReferenceResponse = $client->confirmOrderReference($confirmOrderReferenceRequest);
			$this->debugLog("<pre>" . var_export($confirmOrderReferenceRequest, true) . "</pre>", __FUNCTION__, 'debug');

		} catch (Exception $e) {
			$this->amazonError(__FUNCTION__ . ' ' . $e->getMessage(), $e->getCode());
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
		$authorizeRequest->setAmazonOrderReferenceId($this->_amazonOrderReferenceId);
		$authorizeRequest->setSellerId($this->_currentMethod->sellerId);
		$authorizeRequest->setAuthorizationReferenceId($order['details']['BT']->order_number);
		$authorizeRequest->setSellerAuthorizationNote($this->getSellerAuthorizationNote());
		$authorizeRequest->setTransactionTimeout(0);
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
			$this->amazonError(__FUNCTION__ . ' ' . $msg);
			return false;
		}

		$this->updateAuthorizeBillingAddressInOrder($authorizeResponse, $order);
		$storeResult = new stdClass();
		$storeResult->amazon_response_amazonAuthorizationId = $amazonAuthorizationId;
		$this->storeAmazonInternalData($order, $authorizeRequest, $authorizeResponse, NULL, $this->renderPluginName($this->_currentMethod), $storeResult);


		return $amazonAuthorizationId;
	}

	function updateAuthorizeBillingAddressInOrder ($authorizeResponse, $order) {
		if ($authorizeResponse->isSetAuthorizeResult()) {
			$authorizeResult = $authorizeResponse->getAuthorizeResult();
			if ($authorizeResult->isSetAuthorizationDetails()) {
				$authorizationDetails = $authorizeResult->getAuthorizationDetails();

				if ($authorizationDetails->isSetAuthorizationBillingAddress()) {
					$authorizationBillingAddress = $authorizationDetails->getAuthorizationBillingAddress();
					$BT = $this->getUserInfoFromAmazon($authorizationBillingAddress);


				}
			}
		}

		$orderModel = VmModel::getModel('orders');
		$BT['virtuemart_order_id'] = $order['details']['BT']->virtuemart_order_id;
		$order_userinfosTable = $orderModel->getTable('order_userinfos');
		$BT['address_type'] = 'BT';

		$order_userinfosTable->load($order['details']['BT']->virtuemart_order_id, 'virtuemart_order_id', " AND address_type='ST'");
		if (!$order_userinfosTable->bindChecknStore($BT, true)) {
			vmError($order_userinfosTable->getError());
			return false;
		}
	}

	/**
	 * @return bool
	 */
	private function isImmediateCapture () {
		return ($this->_currentMethod->capture_mode == "immediate_capture");
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
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
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
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_ResponseHeaderMetadata');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_ResponseMetadata');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_AuthorizeResult');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_AuthorizationDetails');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_Address');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_IdList');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_Status');
		$this->amazonClassLoad('OffAmazonPaymentsNotifications_Model_AuthorizationNotification');

		$db = JFactory::getDBO();
		$q = 'SELECT * FROM `' . $this->_tablename . '` WHERE ';
		$q .= ' `virtuemart_order_id` = ' . $virtuemart_order_id;

		$db->setQuery($q);
		$payments = $db->loadObjectList();

		$query = 'SHOW COLUMNS FROM `' . $this->_tablename . '` ';
		$db->setQuery($query);
		$columns = $db->loadResultArray(0);

		$html = '<table class="adminlist table-striped"  >' . "\n";
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
					$html .= $this->getHtmlRowBE('COM_VIRTUEMART_TOTAL', ($payment->payment_order_total * 0.01) . " " . shopFunctions::getCurrencyByID($payment->payment_currency, 'currency_code_3'));
				}
				if ($payment->email_currency and  $payment->email_currency != 0) {
					//$html .= $this->getHtmlRowBE($this->_name.'_PAYMENT_EMAIL_CURRENCY', shopFunctions::getCurrencyByID($payment->email_currency, 'currency_code_3'));
				}

				$first = FALSE;
			} else {

				$code = 'amazon_response_';
				foreach ($payment as $key => $value) {
					// only displays if there is a value or the value is different from 0.00 and the value
					if ($value) {
						if (substr($key, 0, strlen($code)) == $code) {
							$html .= $this->getHtmlRowBE($key, $value);
						}
					}
				}
				$amazon_classes = array();
				/*
				if (!empty($payment->amazon_request)) {
					$amazon_data = unserialize($payment->amazon_request);
					$amazon_classes[get_class($amazon_data)] = $payment->amazon_request;
				}
				*/
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
				vmError(vmText::sprintf('VMPAYMENT_AMAZON_CONF_MANDATORY_PHP_EXTENSION', 'curl'));
			}
			if (!extension_loaded('openssl')) {
				vmError(vmText::sprintf('VMPAYMENT_AMAZON_CONF_MANDATORY_PHP_EXTENSION', 'openssl'));
			}
		}

		return $this->onStoreInstallPluginTable($jplugin_id);
	}

	/**
	 * This event is fired after the payment method has been selected. It can be used to store
	 * additional payment info in the cart.
	 *
	 * @author Valérie isaksen
	 *
	 * @param VirtueMartCart $cart: the actual cart
	 * @return null if the payment was not selected, true if the data is valid, error message if the data is not vlaid
	 *
	 */
	public function plgVmOnSelectCheckPayment (VirtueMartCart $cart, &$msg) {
		if (!$this->selectedThisByMethodId($cart->virtuemart_paymentmethod_id)) {
			$this->removeAmazonAddressFromCart($cart);
			$this->clearAmazonSession(); // Another method was selected, clear the session
			return NULL;
		}
		if (!($this->_currentMethod = $this->getVmPluginMethod($cart->virtuemart_paymentmethod_id))) {

			$this->clearAmazonSession();
			return NULL;
		}
		$_amazonOrderReferenceId = $this->getAmazonOrderReferenceIdFromSession();
		if (!$_amazonOrderReferenceId) {
			$msg = vmText::_('VMPAYMENT_AMAZON_PAYWITHAMAZON_BUTTON');
			return false;
		}
		return TRUE; // this method was selected , and the data is valid by default


	}

	function removeAmazonAddressFromCart ($cart) {
		$data = $this->getDataFromSession();
		if (isset($data['BT'])) {
			$data['BT']['address_type'] = 'BT';
			$cart->saveAddressInCart($data['BT'], $data['BT']['address_type'], TRUE);
		}
		if (isset($data['BT'])) {
			$data['BS']['address_type'] = 'ST';
			$cart->saveAddressInCart($data['ST'], $data['BT']['address_type'], TRUE);
		}
		return;
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
	 */
	public function plgVmDisplayListFEPayment (VirtueMartCart $cart, $selected = 0, &$htmlIn) {

		return $this->displayListFE($cart, $selected, $htmlIn);
	}

	/**
	 * @param $plugin
	 * @param $selectedPlugin
	 * @param $pluginSalesPrice
	 * @return string
	 */
	protected function getPluginHtml ($method, $selectedPlugin, $pluginSalesPrice) {

		if ($selectedPlugin == $method->virtuemart_paymentmethod_id) {
			$checked = 'checked="checked"';
			//return NULL;
		} else {
			$checked = '';
		}

		$layout = JRequest::getWord('layout', '');
		if ($layout == $this->_currentMethod->cart_layout) {
			//return NULL;
		}

		if (!class_exists('CurrencyDisplay')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'currencydisplay.php');
		}
		$currency = CurrencyDisplay::getInstance();
		$costDisplay = "";
		if ($pluginSalesPrice) {
			$costDisplay = $currency->priceDisplay($pluginSalesPrice);
			$costDisplay = '<span class="' . $this->_type . '_cost"> (' . JText::_('COM_VIRTUEMART_PLUGIN_COST_DISPLAY') . $costDisplay . ")</span>";
		}
		//$html = '<input type="radio" name="virtuemart_paymentmethod_id" id="' . $this->_psType . '_id_' . $plugin->virtuemart_paymentmethod_id . '"   value="' . $plugin->virtuemart_paymentmethod_id . '" ' . $checked . ">\n". '<label for="' . $this->_psType . '_id_' . $plugin->virtuemart_paymentmethod_id . '">' . '<span class="' . $this->_type . '">' . $plugin->payment_name . $costDisplay . "</span></label>\n";

		// IF NOT SELECTED Then display the Pay With amazon Button
		$this->vmClassLoad('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');

		//$this->debug('', 'updateCartWithAmazonAddress', 'debug');
		$cart = VirtueMartCart::getCart();
		if (empty($cart->products) and $cart->layout == $this->_currentMethod->cart_layout) {
			$this->unsetCartLayout($cart);
		}
		$amazonOrderReferenceIdWeight = $this->getAmazonOrderReferenceIdWeightFromSession();
		$this->_amazonOrderReferenceId = $amazonOrderReferenceIdWeight['_amazonOrderReferenceId'];
		$referenceIdIsOnlyDigitalGoods = $amazonOrderReferenceIdWeight['isOnlyDigitalGoods'];
		if (!$this->_amazonOrderReferenceId OR $this->shouldLoginAgain($referenceIdIsOnlyDigitalGoods, $this->isOnlyDigitalGoods($cart))) {
			$html = $this->renderSignInButton();
		}

		return $html;
	}


	private function unsetCartLayout ($cart) {
		if (!class_exists('VmConfig')) {
			require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'config.php');
		}
		VmConfig::loadConfig();
		$cart->layout = VmConfig::get('cartlayout', 'default');
		$cart->setCartIntoSession();
	}


	private function setCartLayout ($cart) {
		$cart->layout = $this->_currentMethod->cart_layout;
		$cart->setCartIntoSession();
	}

	/**
	 * plgVmonSelectedCalculatePricePayment
	 * Calculate the price (value, tax_id) of the selected method
	 * It is called by the calculator
	 * This function does NOT to be reimplemented. If not reimplemented, then the default values from this function are taken.
	 * @cart: VirtueMartCart the current cart
	 * @cart_prices: array the new cart prices
	 * @return null if the method was not selected, false if the shipping rate is not valid any more, true otherwise
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
		$amazonOrderReferenceIdWeight = $this->getAmazonOrderReferenceIdWeightFromSession();
		$this->_amazonOrderReferenceId = $amazonOrderReferenceIdWeight['_amazonOrderReferenceId'];
		$referenceIdIsOnlyDigitalGoods = $amazonOrderReferenceIdWeight['isOnlyDigitalGoods'];
		$cart_prices_name = '';
		$cart_prices['cost'] = 0;

		if (!$this->checkConditions($cart, $this->_currentMethod, $cart_prices)) {
			return FALSE;
		}
		$layout = $cart->layout;

		//$cart->layout='amazon';
		//$layout = JRequest::getWord('layout', '');

		if ($this->shouldLoginAgain($referenceIdIsOnlyDigitalGoods, $this->isOnlyDigitalGoods($cart))) {
			//$html = $this->renderSignInButton($cart);
			//echo $html;
		} else {
			$addressBookWallet = $this->renderAddressbookWallet($cart->getDataValidated());

		}

		$cart_prices_name = $this->renderPluginName($this->_currentMethod);

		$this->setCartPrices($cart, $cart_prices, $method);

		return TRUE;
	}

	private function shouldLoginAgain ($referenceIdIsOnlyDigitalGoods, $isOnlyDigitalGoods) {
		if (($isOnlyDigitalGoods and $referenceIdIsOnlyDigitalGoods) OR (!$isOnlyDigitalGoods and !$referenceIdIsOnlyDigitalGoods)) {
			return false;
		}
		return true;
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


	private function saveAmazonOrderReferenceId ($cart) {

		$this->_amazonOrderReferenceId = vRequest::getString('session', '');
		$this->setAmazonOrderReferenceIdInSession($this->_amazonOrderReferenceId, $this->isOnlyDigitalGoods($cart));
		$cart->virtuemart_paymentmethod_id = vRequest::getInt('pm');


	}


	/*********************/
	/* Private functions */
	/*********************/


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
	 * get the partial shipping address (city, state, postal code, and country) by calling the GetOrderReferenceDetails operation
	 * to compute taxes and shipping costs or possible applicable shipping speed, and options.
	 * @param $client
	 * @param $cart
	 */
	function updateCartWithAmazonAddress ($saveShimentAsBillTo = true) {

		$this->vmClassLoad('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');

		//$this->debug('', 'updateCartWithAmazonAddress', 'debug');
		$cart = VirtueMartCart::getCart();
		// this should be done only the first time.
		$this->saveBTandSTInSession($cart);
		$this->_amazonOrderReferenceId = $this->getAmazonOrderReferenceIdFromSession();
		if (empty($this->_amazonOrderReferenceId)) {
			//vmError('VMPAYMENT_AMAZON_LOGIN');
			return FALSE;
		}
		$orderReferenceDetails = $this->getOrderReferenceDetailsResponse();
		if (!$orderReferenceDetails) {
			return false;
		}
		$destination = $orderReferenceDetails->GetOrderReferenceDetailsResult->getOrderReferenceDetails()->getDestination();
		if (empty($destination)) {
			// plgVmonSelectedCalculatePricePayment is also called in the module
			//$this->debug('Destination is empty, noot saving', 'saveAmazonPartialShipmentAddressIncart', 'debug');
			return false;
		}
		$physicalDestination = $destination->getPhysicalDestination();

		if (!$physicalDestination) {
			return false;
		}

		$update_data = $this->getUserInfoFromAmazon($physicalDestination);
		$update_data['address_1'] = self::AMAZON_EMPTY_USER_FIELD;
		$update_data['email'] = self::AMAZON_EMPTY_USER_FIELD_EMAIL;
		$update_data['first_name'] = self::AMAZON_EMPTY_USER_FIELD;
		$update_data['last_name'] = self::AMAZON_EMPTY_USER_FIELD;
		$update_data ['address_type'] = 'BT';
		if ($this->isSameAddress($update_data, $cart)) {
			return false;
		}

		$cart->saveAddressInCart($update_data, $update_data['address_type'], TRUE);


		// update BT and ST with Amazon Partial Address
		$prefix = 'shipto_';
		$update_data = $this->getUserInfoFromAmazon($physicalDestination, $prefix);
		$update_data[$prefix . 'last_name'] = self::AMAZON_EMPTY_USER_FIELD;
		$update_data[$prefix . 'first_name'] = self::AMAZON_EMPTY_USER_FIELD;
		$update_data[$prefix . 'address_1'] = self::AMAZON_EMPTY_USER_FIELD;

		$update_data ['address_type'] = 'ST';
		$cart->saveAddressInCart($update_data, $update_data['address_type'], TRUE);


		return true;
	}


	private function isSameAddress ($update_data, $cart) {
		if ($cart->BT['city'] == $update_data['city'] and $cart->BT['virtuemart_country_id'] == $update_data['virtuemart_country_id'] AND $cart->BT['zip'] == $update_data['zip']) {
			return true;
		}
		return false;
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
		$this->debugLog("AMAZON IPN", 'debug');
		$headers = getallheaders();
		$body = file_get_contents('php://input');
		/*
				$fp=fopen("/Applications/MAMP/htdocs/VM2/VM2024/AMAZON-ipnhandler.php",'w');
				fwrite($fp,var_export($headers,true));
				fwrite($fp,var_export($body,true));
				fclose($fp);
		*/
		$headers = array(
			'x-amz-sns-message-type'     => 'Notification',
			'x-amz-sns-message-id'       => 'bb775cbe-4bc0-59dd-aabd-10e36f80411d',
			'x-amz-sns-topic-arn'        => 'arn:aws:sns:eu-west-1:291180941288:A3M3RRFO9XDT2GAA3KB5JD2CWIH',
			'x-amz-sns-subscription-arn' => 'arn:aws:sns:eu-west-1:291180941288:A3M3RRFO9XDT2GAA3KB5JD2CWIH:21953ab6-f671-41ab-b8ed-acde085ff9af',
			'Content-Length'             => '2560',
			'Content-Type'               => 'text/plain; charset=UTF-8',
			'Host'                       => 'joomla-virtuemart.org',
			'Connection'                 => 'Keep-Alive',
			'User-Agent'                 => 'Amazon Simple Notification Service Agent',
			'Accept-Encoding'            => 'gzip,deflate',
		);

		$body = '{
  "Type" : "Notification",
  "MessageId" : "bb775cbe-4bc0-59dd-aabd-10e36f80411d",
  "TopicArn" : "arn:aws:sns:eu-west-1:291180941288:A3M3RRFO9XDT2GAA3KB5JD2CWIH",
  "Message" : "{\\"NotificationReferenceId\\":\\"a5f994ad-75d3-48a3-81fb-c8963fd64746\\",\\"MarketplaceID\\":\\"136291\\",\\"NotificationType\\":\\"PaymentAuthorize\\",\\"SellerId\\":\\"AA3KB5JD2CWIH\\",\\"ReleaseEnvironment\\":\\"Sandbox\\",\\"Version\\":\\"2013-01-01\\",\\"NotificationData\\":\\"<?xml version=\\\\\\"1.0\\\\\\" encoding=\\\\\\"UTF-8\\\\\\"?><AuthorizationNotification xmlns=\\\\\\"https://mws.amazonservices.com/ipn/OffAmazonPayments/2013-01-01\\\\\\">\\\\n    <AuthorizationDetails>\\\\n        <AmazonAuthorizationId>S02-3174360-5556899-A075667<\\\\/AmazonAuthorizationId>\\\\n        <AuthorizationReferenceId>773a0213<\\\\/AuthorizationReferenceId>\\\\n        <AuthorizationAmount>\\\\n            <Amount>22.51<\\\\/Amount>\\\\n            <CurrencyCode>GBP<\\\\/CurrencyCode>\\\\n        <\\\\/AuthorizationAmount>\\\\n        <CapturedAmount>\\\\n            <Amount>0.0<\\\\/Amount>\\\\n            <CurrencyCode>GBP<\\\\/CurrencyCode>\\\\n        <\\\\/CapturedAmount>\\\\n        <AuthorizationFee>\\\\n            <Amount>0.0<\\\\/Amount>\\\\n            <CurrencyCode>GBP<\\\\/CurrencyCode>\\\\n        <\\\\/AuthorizationFee>\\\\n        <IdList/>\\\\n        <CreationTimestamp>2014-08-07T06:51:42.831Z<\\\\/CreationTimestamp>\\\\n        <ExpirationTimestamp>2014-09-06T06:51:42.831Z<\\\\/ExpirationTimestamp>\\\\n        <AuthorizationStatus>\\\\n            <State>Open<\\\\/State>\\\\n            <LastUpdateTimestamp>2014-08-07T06:51:42.831Z<\\\\/LastUpdateTimestamp>\\\\n        <\\\\/AuthorizationStatus>\\\\n        <OrderItemCategories/>\\\\n        <CaptureNow>false<\\\\/CaptureNow>\\\\n        <SoftDescriptor/>\\\\n    <\\\\/AuthorizationDetails>\\\\n<\\\\/AuthorizationNotification>\\",\\"Timestamp\\":\\"2014-08-07T06:51:44Z\\"}",
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "Timestamp" : "2014-08-07T06:51:44.404Z",
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "SignatureVersion" : "1",
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "Signature" : "GuOvtLQQaR0Wk1KzTqypn5kqDmsrHN69AigKSNYPFeQ6EVkkQPI+T9sTQ+THU5HTtyxc5HusU2gQYv3kaFoLhn4MX4e9dRZlS9Vs7BI9pLGweGzVTjyzJbI7pi0MFC8wjXDEWHpnaF3uB0Tble2yMEN9w8sHWwr+0G/L9mDsp9rPmp72R9D+1l3PH0KzbsIVJJXVMqFfbHSEt9cu9vrZaF8cpJPbqXrePOSW1VZZzhSOotdXxz6alzaCuNJPqKs+VEgbneNvKRZSika4ZiA+lCSa4Nye74nv3x6G13SNVGfz3qjQmaUi1jtJ9LIH+x6DwSMpjCPG1sLG9wZB4gLs7A==",
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "SigningCertURL" : "https://sns.eu-west-1.amazonaws.com/SimpleNotificationService-e372f8ca30337fdb084e8ac449342c77.pem",
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "UnsubscribeURL" : "https://sns.eu-west-1.amazonaws.com/?Action=Unsubscribe&SubscriptionArn=arn:aws:sns:eu-west-1:291180941288:A3M3RRFO9XDT2GAA3KB5JD2CWIH:21953ab6-f671-41ab-b8ed-acde085ff9af"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      }';


		$this->debugLog($headers, 'AMAZON IPN HEADERS debug');
		$this->debugLog($body, 'AMAZON IPN HEADERS debug');

		$this->amazonClassLoad('OffAmazonPaymentsNotifications_Client');
		$this->vmClassLoad('VirtueMartModelOrders', JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');

		try {
			$client = new OffAmazonPaymentsNotifications_Client();
			$notification = $client->parseRawMessage($headers, $body);
		} catch (OffAmazonPaymentsNotifications_InvalidMessageException $e) {
			$this->debugLog($e->getMessage() . __FUNCTION__ . ' $body', 'error');
			header("HTTP/1.1 503 Service Unavailable");
			exit(0);
		}
		$notificationType = $notification->getNotificationType();
		$this->debugLog($notificationType, 'ipn', 'debug');

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

		$this->debugLog($notificationType, 'ipn', 'debug');

		$notificationResponse = new $newClass($notification);
		//$this->debugLog("<pre>" . var_export($notificationResponse->notification, true) . "</pre>", __FUNCTION__, 'debug');


		if (!($order_number = $notificationResponse->getAuthorizationId())) {
			$this->debugLog('no Authorization in IPN received', $newClass, 'error');
			return true;
		}
		if (!($virtuemart_order_id = VirtueMartModelOrders::getOrderIdByOrderNumber($order_number))) {
			$this->debugLog('Received a ' . $newClass . ' with order number ' . $order_number . 'but no order in DB with that number', $newClass, 'error');
			return true;
		}
		$orderModel = VmModel::getModel('orders');
		$order = $orderModel->getOrder($virtuemart_order_id);

		if (!($payments = $this->getDatasByOrderId($virtuemart_order_id))) {
			$this->debugLog('Received a ' . $newClass . ' with order number ' . $order_number . 'but no order in DB with that number in AMAZON payment table', $newClass, 'error');
			return true;
		}
		// get payments
		$amazonState = $notificationResponse->handleNotification($order, $payments);
		$order_history['order_status'] = $this->getOrderStatus($amazonState);
		$order_history['customer_notified'] = 1;
		$order_history['comments'] = '';
		$this->storeAmazonInternalData($order, NULL, NULL, $notification, NULL, $notificationResponse->storeResultParams());
		$orderModel->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order_history, TRUE);

	}

	private function getOrderStatus ($amazonState) {
		return $this->_currentMethod->status_authorization;
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


	/**
	 * save the BT and ST in case the shopper has already given one
	 * @param $cart
	 */
	private function saveBTandSTInSession ($cart) {
		$session = JFactory::getSession();
		$sessionAmazon = $session->get('amazon', 0, 'vm');
		$sessionAmazonData = unserialize($sessionAmazon);
		// check if it is already saved or not
		if (!isset($sessionAmazonData['BT'])) {
			$sessionAmazonData['BT'] = $cart->BT;
			$sessionAmazonData['ST'] = $cart->ST;
			$session->set('amazon', serialize($sessionAmazonData), 'vm');
		}

	}

	/**
	 * @return null
	 */
	private function getAmazonOrderReferenceIdWeightFromSession () {
		$session = JFactory::getSession();
		$sessionAmazon = $session->get('amazon', 0, 'vm');

		if ($sessionAmazon) {
			$sessionAmazonData = unserialize($sessionAmazon);
			if (isset($sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id])) {
				return $sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id];
			}
		}

		return NULL;

	}

	/**
	 * @return null
	 */
	private function clearAmazonSession () {

		$session = JFactory::getSession();
		$session->clear('amazon', 'vm');
		return NULL;

	}

	/**
	 * @return null
	 */
	private function getAmazonOrderReferenceIdFromSession () {
		$session = JFactory::getSession();
		$sessionAmazon = $session->get('amazon', 0, 'vm');

		if ($sessionAmazon) {
			$sessionAmazonData = unserialize($sessionAmazon);
			if (isset($sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id])) {
				return $sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id]['_amazonOrderReferenceId'];
			}
		}

		return NULL;

	}

	private function setAmazonOrderReferenceIdInSession ($amazonOrderReferenceId, $isOnlyDigitalGoods) {
		$session = JFactory::getSession();
		$sessionAmazon = $session->get('amazon', 0, 'vm');
		$sessionAmazonData = unserialize($sessionAmazon);

		$sessionAmazonData['virtuemart_paymentmethod_id'] = $this->_currentMethod->virtuemart_paymentmethod_id;
		$sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id]['_amazonOrderReferenceId'] = $amazonOrderReferenceId;
		$sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id]['isOnlyDigitalGoods'] = $isOnlyDigitalGoods;
		$session->set('amazon', serialize($sessionAmazonData), 'vm');

	}

	private function setRenderAddressDoneInSession () {
		$session = JFactory::getSession();
		$sessionAmazon = $session->get('amazon', 0, 'vm');
		$sessionAmazonData = unserialize($sessionAmazon);

		$sessionAmazonData['virtuemart_paymentmethod_id'] = $this->_currentMethod->virtuemart_paymentmethod_id;
		$sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id]['addressDone'] = true;
		$session->set('amazon', serialize($sessionAmazonData), 'vm');

	}

	private function getRenderAddressDoneFromSession () {
		$session = JFactory::getSession();
		$sessionAmazon = $session->get('amazon', 0, 'vm');

		if ($sessionAmazon) {
			$sessionAmazonData = unserialize($sessionAmazon);
			if (isset($sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id])) {
				return $sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id]['addressDone'];
			}
		}
		return false;

	}

	private function setAmazonAction ($action) {
		//$_amazonOrderReferenceId = $this->getAmazonOrderReferenceId();
		if (!$this->_amazonOrderReferenceId) {
			$this->amazonError(__FUNCTION__ . ' ' . "setAmazonAction getAmazonOrderReferenceId  is NULL");
		}
		$session = JFactory::getSession();
		$sessionAmazon = $session->get('amazon', 0, 'vm');

		$sessionAmazonData = unserialize($sessionAmazon);
		if (!isset($sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id][$this->_amazonOrderReferenceId])) {
			$this->amazonError(__FUNCTION__ . ' ' . 'setAmazonAction $sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id][$_amazonOrderReferenceId]  is not set');
		}
		$sessionAmazonData[$this->_currentMethod->virtuemart_paymentmethod_id][$this->_amazonOrderReferenceId][$action] = true;
		$session->set('amazon', serialize($sessionAmazonData), 'vm');
	}


	/**
	 * Use the order reference object to query the order information, including
	 * the current physical delivery address as selected by the buyer
	 *
	 * @return OffAmazonPaymentsService_Model_GetOrderReferenceDetailsResponse service response
	 */

	function getOrderReferenceDetailsResponse ($addressConsentToken = null) {
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_GetOrderReferenceDetailsRequest');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_GetOrderReferenceDetailsResponse');
		$this->amazonClassLoad('OffAmazonPaymentsService_Model_OrderReferenceDetails');
		//$_amazonOrderReferenceId = $this->getAmazonOrderReferenceId();
		if (empty($this->_amazonOrderReferenceId)) {
			vmError('VMPAYMENT_AMAZON_LOGIN');
			return FALSE;
		}
		$client = $this->getOffAmazonPaymentsService_Client();
		try {
			$getOrderReferenceDetailsRequest = new OffAmazonPaymentsService_Model_GetOrderReferenceDetailsRequest();
			$getOrderReferenceDetailsRequest->setSellerId($this->_currentMethod->sellerId);
			$getOrderReferenceDetailsRequest->setAmazonOrderReferenceId($this->_amazonOrderReferenceId);
			if (is_null($addressConsentToken) == FALSE) {
				$decodedToken = urldecode($addressConsentToken);
				$getOrderReferenceDetailsRequest->setAddressConsentToken($decodedToken);
			}
			$orderReferenceDetailsResponse = $client->getOrderReferenceDetails($getOrderReferenceDetailsRequest);

		} catch (Exception $e) {
			$this->amazonError(__FUNCTION__ . ' ' . $e->getMessage(), $e->getCode());
			return FALSE;
		}

		return $orderReferenceDetailsResponse;
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

	private function getDataFromSession () {
		$session = JFactory::getSession();
		$sessionAmazon = $session->get('amazon', 0, 'vm');

		if ($sessionAmazon) {
			$sessionAmazonData = unserialize($sessionAmazon);

			return $sessionAmazonData;
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
