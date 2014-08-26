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
 * payments.amazon.co.uk
 * payments.amazon.de
 * https://sellercentral.amazon.co.uk
 */
class plgVmpaymentAmazon extends vmPSPlugin {

	// instance of class

	static $widgetScriptLoaded = false;
	var $_amazonOrderReferenceId = NULL;
	const AMAZON_EMPTY_USER_FIELD = "amazon";
	const AMAZON_EMPTY_USER_FIELD_EMAIL = "dummy@domain.com";
	const AUTHORIZE_TRANSACTION_TIMEOUT = 5;
	var $_currentMethod = NULL;
	var $languages_region = array(
		'en' => 'UK',
		'de' => 'DE',
	);

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
		$this->loadAmazonClass('OffAmazonPaymentsService_Client');


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
			'amazonOrderReferenceId'                => 'char(64) DEFAULT NULL',
			'amazon_response_state'                 => 'char(32) DEFAULT NULL',
			//'amazon_response_amazonRequestId' => 'char(64) DEFAULT NULL',
			'amazon_response_requestId'             => 'char(64) DEFAULT NULL',
			'amazon_response_amazonAuthorizationId' => 'char(64) DEFAULT NULL',
			//'amazon_response_authorizationReferenceId'       => 'char(64) DEFAULT NULL',
			'amazon_response_amazonCaptureId'       => 'char(64) DEFAULT NULL',
			'amazon_response_amazonRefundId'        => 'char(64) DEFAULT NULL',
			//'amazon_response_captureReferenceId'       => 'char(64) DEFAULT NULL',
			'amazon_response_state'                 => 'char(64) DEFAULT NULL',
			'amazon_response_reasonCode'            => 'char(64) DEFAULT NULL',
			'amazon_response_reasonDescription'     => 'char(64) DEFAULT NULL',
			'amazon_request_type'                   => 'text DEFAULT NULL',
			'amazon_request'                        => 'text DEFAULT NULL',
			'amazon_class_response_type'            => 'text DEFAULT NULL',
			'amazon_response'                       => 'text DEFAULT NULL',
			'amazon_notification'                   => 'text DEFAULT NULL',
			'amazon_class_notification_type'        => 'text DEFAULT NULL'
		);
		return $SQLfields;
	}


	private function renderSignInButton ($cart) {
		$display = '';

		if (!$this->checkConditionSignIn($cart)) {
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
			                                                     'layout'                      => $cart->layout,

			                                                ));
			return $signInButton;
		}


	}


	private function renderAddressbookWallet ($readOnlyWidgets = false) {
		//if ($this->getRenderAddressDoneFromSession()) { return;}
		$this->loadVmClass('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		$cart = VirtueMartCart::getCart();
		$this->setCartLayout($cart);

		$client = $this->getOffAmazonPaymentsService_Client();
		$this->addWidgetUrlScript($client);
		if (empty($this->_amazonOrderReferenceId)) {
			$this->_amazonOrderReferenceId = $this->getAmazonOrderReferenceIdFromSession();
			if (empty($this->_amazonOrderReferenceId)) {
				$this->debug('no $_amazonOrderReferenceId', 'renderAddressbookWallet', 'debug');
				$this->leaveAmazonCheckout();

				return;
			}
		}
		$renderWalletBook = $cart->virtuemart_shipmentmethod_id;
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
		                                                         'renderWalletBook'            => $renderWalletBook,
		                                                         'readOnlyWidgets'             => $readOnlyWidgets ? 'Read' : "Edit",
		                                                    ));
		echo $html;
	}


	private function checkConditionSignIn ($cart) {
		$cart_prices = array();
		$cart_prices['salesPrice'] = $cart->pricesUnformatted['billTotal'];
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
		if ($this->isValidLanguage() && $this->isValidAmount($cart_prices['salesPrice']) && $this->isValidProductCategories($cart) && $this->isValidIP()
		) {
			return true;
		}
		return false;
	}

	/**
	 * @return bool
	 */
	private function isValidCountry ($virtuemart_country_id) {
		$countries = array();
		if (!empty($this->_currentMethod->countries)) {
			if (!is_array($this->_currentMethod->countries)) {
				$countries[0] = $this->_currentMethod->countries;
			} else {
				$countries = $this->_currentMethod->countries;
			}
		}
		if (count($countries) == 0 || in_array($virtuemart_country_id, $countries)) {
			return TRUE;
		}
		return false;
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
				$this->setCartLayout($cart, false);
				$this->updateCartWithDefaultAmazonAddress($cart, $this->isOnlyDigitalGoods($cart));
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

			case 'updateCartWithAmazonAddress':
				//$client = $this->getOffAmazonPaymentsService_Client();
				//$this->setOrderReferenceDetails()
				$return = $this->updateCartWithAmazonAddress();
				$json = array();
				$json['reload'] = $return['error'];
				$json['error_msg'] = '';
				if (isset($return['error_msg'])) {
					$json['error_msg'] = $this->rendererErrorMessage($return['error_msg']);
				}


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


			case 'leaveAmazonCheckout':
				$this->leaveAmazonCheckout();
				$json = array();
				JResponse::setHeader('Cache-Control', 'no-cache, must-revalidate');
				JResponse::setHeader('Expires', 'Mon, 6 Jul 2000 10:00:00 GMT');
				// Set the MIME type for JSON output.
				$document = JFactory::getDocument();
				$document->setMimeEncoding('application/json');
				JResponse::setHeader('Content-Disposition', 'attachment;filename="amazon.json"', TRUE);
				JResponse::sendHeaders();

				echo json_encode($json);
				jExit();
				break;

			case 'resetAmazonReferenceId':
				$this->clearAmazonSession();
				break;
			default:
				$this->amazonError(vmText::_('VMPAYMENT_AMAZON_INVALID_NOTIFICATION_TASK'));
				return;
		}

	}


	function rendererErrorMessage ($msg) {
		return '<dl id="system-message"><dt class="error">Error</dt><dd class="error message"><ul><li>' . $msg . '</li></ul></dd></dl>';

	}


	/**
	 * @param VirtueMartCart $cart
	 */

	public function plgVmOnCheckoutCheckDataPayment (VirtueMartCart $cart) {

		if (!$this->selectedThisByMethodId($cart->virtuemart_paymentmethod_id)) {
			/*
			if ($cart->layout==$this->_name) {
				if (!class_exists('VmConfig')) {
					require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'config.php');
				}
				VmConfig::loadConfig();
				$cart->layout = VmConfig::get('cartlayout', 'default');
				$cart->setCartIntoSession();
			}
			*/
			return NULL; // Another method was selected, do nothing
		}
		if (!($this->_currentMethod = $this->getVmPluginMethod($cart->virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		$this->_amazonOrderReferenceId = $this->getAmazonOrderReferenceIdFromSession();
		if (empty($this->_amazonOrderReferenceId)) {
			//$message = vmText::_('VMPAYMENT_AMAZON_PAYWITHAMAZON_BUTTON');
			//vmError($message, $message);
			return false;
		}
		$client = $this->getOffAmazonPaymentsService_Client();

		$physicalDestination = $this->getPhysicalDestination();
		if (!$physicalDestination) {
			// may be we have just logged in, so there is no physical destination
			//$this->leaveAmazonCheckout();
			return false;
		}

		$update_data = $this->getUserInfoFromAmazon($physicalDestination);
		if (!$this->isValidCountry($update_data['virtuemart_country_id'])) {
			$country = shopFunctions::getCountryByID($update_data['virtuemart_country_id']);
			$app = JFactory::getApplication();
			$leaveAmazonCheckoutLink = $this->getLeaveAmazonCheckoutLink();
			//$app->enqueueMessage(vmText::sprintf('VMPAYMENT_AMAZON_UPDATECART_DELIVERYCOUNTRYNOTALLOWED', $country, $leaveAmazonCheckoutLink));
			$app->enqueueMessage(vmText::sprintf('VMPAYMENT_AMAZON_UPDATECART_DELIVERYCOUNTRYNOTALLOWED', $country));
			//$this->leaveAmazonCheckout();
			return false;
		}


		// setOrderReferenceDetails
		if (!$setOrderReferenceDetailsResponse = $this->setOrderReferenceDetails($client, $cart)) {
			$this->leaveAmazonCheckout();
			$this->onErrorRedirectToCart();
			return FALSE;
		}
		// getOrderReferenceDetails
		if (!$getOrderReferenceDetailsResponse = $this->getOrderReferenceDetails($client)) {
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


	private function        getLeaveAmazonCheckoutLink () {
		$leaveAmazonCheckoutLink = '<a href="#" class="leaveAmazonCheckout">' . vmText::_('VMPAYMENT_AMAZON_LEAVE_PAY_WITH_AMAZON') . '</a>';
		return $leaveAmazonCheckoutLink;
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
		$this->debugLog("<pre>" . var_export($constraint, true) . "</pre>", __FUNCTION__, 'debug');
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
		$this->setInConfirmOrder($cart);

		$this->_amazonOrderReferenceId = $this->getAmazonOrderReferenceIdFromSession();
		if (!$this->_amazonOrderReferenceId) {
			$this->onErrorRedirectToCart();
			return FALSE;
		}

		$this->storeAmazonInternalData($order, NULL, NULL, NULL, $this->renderPluginName($this->_currentMethod), NULL, $this->_amazonOrderReferenceId);

		$client = $this->getOffAmazonPaymentsService_Client();

		//confirmOrderReference
		$this->confirmOrderReference($client, $order);
		// getorderdetails et  address email
		if (!$this->updateBuyerInOrder($client, $cart, $order)) {
			return FALSE;
		}

		// at this point, since the authorization and capturing takes additional time to process
		// let's do that with a trigger
		if ($this->canDoAuthorization()) {
			if (!($amazonAuthorizationId = $this->getAuthorization($client, $cart, $order))) {
				$this->debugLog('getAuthorization return no $amazonAuthorizationId', __FUNCTION__, 'debug');
				$this->onErrorRedirectToCart();
				return FALSE;
			}

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
		$this->leaveAmazonCheckout();
		//$this->removeAmazonAddressFromCart($cart);
		//$this->clearAmazonSession();
		//$cart = VirtueMartCart::getCart();
		// TODO: Shall we remove the address or take back the old one?
		$cart->BT = 0;;
		$cart->ST = 0;;
		$cart->emptyCart();
		return TRUE;


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
	private function storeAmazonInternalData ($order, $request, $response, $notification = NULL, $payment_name = NULL, $amazonParams = NULL, $amazonOrderReferenceId) {

		$db_values['order_number'] = $order['details']['BT']->order_number;
		$db_values['virtuemart_order_id'] = $order['details']['BT']->virtuemart_order_id;
		$db_values['virtuemart_paymentmethod_id'] = $this->_currentMethod->virtuemart_paymentmethod_id;
		$db_values['payment_order_total'] = $order['details']['BT']->order_total;
		$db_values['payment_currency'] = $order['details']['BT']->user_currency_id;
		$db_values['amazon_request'] = $request ? serialize($request) : "";
		$db_values['amazon_request_type'] = $request ? get_class($request) : '';
		$db_values['amazon_response'] = $response ? serialize($response) : "";
		$db_values['amazon_class_response_type'] = $response ? get_class($response) : '';
		$db_values['amazon_notification'] = $notification ? serialize($notification) : "";
		$db_values['amazon_class_notification_type'] = $notification ? get_class($notification) : '';
		$db_values['amazonOrderReferenceId'] = $amazonOrderReferenceId ? $amazonOrderReferenceId : '';
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
			$BTFromAmazon = $this->getUserInfoFromAmazon($buyer, '', false, true);
			$BTFromAmazon['virtuemart_order_id'] = $order['details']['BT']->virtuemart_order_id;
			$BTFromAmazon['address_type'] = 'BT';
			$this->debugLog("<pre>" . var_export($BTFromAmazon, true) . "</pre>", __FUNCTION__, 'debug');
			$order_userinfosTable->emptyCache();
			$order_userinfosTable->load($order['details']['BT']->virtuemart_order_id, 'virtuemart_order_id', " AND address_type='BT'");
			if (!$order_userinfosTable->bindChecknStore($BTFromAmazon, true)) {
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
				$order_userinfosTable->emptyCache();
				$order_userinfosTable->load($order['details']['BT']->virtuemart_order_id, 'virtuemart_order_id', " AND address_type='ST'");
				if (!$order_userinfosTable->bindChecknStore($ST, true)) {
					vmError($order_userinfosTable->getError());
					return false;
				}

			}
		}

		return true;
	}

	private function getEmptyShopperFields () {
		$update_data['title'] = '';
		$update_data['first_name'] = '';
		$update_data['address_1'] = '';
		$update_data['email'] = '';
		$update_data['last_name'] = '';
		$update_data['virtuemart_country_id'] = '';
		$update_data['city'] = '';
		$update_data['zip'] = '';
		$update_data['virtuemart_state_id'] = '';
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
		$order_userinfosTable->emptyCache();
		$order_userinfosTable->load($order['details']['BT']->virtuemart_order_id, 'virtuemart_order_id', " AND address_type='BT'");
		if (!$order_userinfosTable->bindChecknStore($userInfoData, true)) {
			vmError($order_userinfosTable->getError());
			return false;
		}

		return true;
	}


	private function getUserInfoFromAmazon ($amazonAddress, $prefix = '', $all = true, $getEmail = false) {

		if ($amazonAddress->isSetName()) {
			$userInfoData[$prefix . 'last_name'] = $amazonAddress->getName();
			$userInfoData[$prefix . 'first_name'] = '';
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
					$userInfoData[$prefix . 'address_2'] .= ", " . $amazonAddress->getAddressLine3();
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
					$userInfoData[$prefix . 'virtuemart_state_id'] = $stateId;
				} else {
					$userInfoData[$prefix . 'virtuemart_state_id'] = 0;
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
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_GetOrderReferenceDetailsRequest');

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
	 * @return bool
	 */
	private function setOrderReferenceDetails ($client, $cart) {
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_OrderReferenceAttributes');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_OrderTotal');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_SellerOrderAttributes');

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
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getOrderTotal()->setAmount($this->getTotalInPaymentCurrency($client, $cart->pricesUnformatted['billTotal'], $cart->pricesCurrency));
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setSellerNote($this->getSellerNote());
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->setSellerOrderAttributes(new OffAmazonPaymentsService_Model_SellerOrderAttributes());
			//$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getSellerOrderAttributes()->setSellerOrderId($order['details']['BT']->order_number);
			$setOrderReferenceDetailsRequest->getOrderReferenceAttributes()->getSellerOrderAttributes()->setSellerOrderId('123456789');
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
				$this->loadHelperClass('amazonHelperSetOrderReferenceDetailsResponse');
				$amazonHelperSetOrderReferenceDetailsResponse = new amazonHelperSetOrderReferenceDetailsResponse($setOrderReferenceDetailsResponse);

				//$this->storeAmazonInternalData(NULL, $setOrderReferenceDetailsRequest, $setOrderReferenceDetailsResponse, NULL, $amazonHelperSetOrderReferenceDetailsResponse->getStoreInternalData());
				// update order status ??
				return $setOrderReferenceDetailsResponse;
		*/
		return $setOrderReferenceDetailsResponse;
	}

	/**
	 * @return bool
	 */
	private function getOrderReferenceDetails ($client) {
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_GetOrderReferenceDetailsRequest');

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
				$this->loadHelperClass('amazonHelperSetOrderReferenceDetailsResponse');
				$amazonHelperSetOrderReferenceDetailsResponse = new amazonHelperSetOrderReferenceDetailsResponse($setOrderReferenceDetailsResponse);

				//$this->storeAmazonInternalData(NULL, $setOrderReferenceDetailsRequest, $setOrderReferenceDetailsResponse, NULL, $amazonHelperSetOrderReferenceDetailsResponse->getStoreInternalData());
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
		//$this->debugLog($totalInPaymentCurrency, __FUNCTION__, 'debug');

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
		if (empty($this->_currentMethod->sandbox_error_simulation)) {
			return NULL;
		}
		return $this->getAuthorizeSandboxSimulationString();
	}


	/**
	 * @return null|string
	 */
	private function getSellerRefundNote () {
		if (empty($this->_currentMethod->sandbox_error_simulation)) {
			return NULL;
		}
		return $this->getRefundSandboxSimulationString();
	}

	/**
	 *
	 */
	private function getSetOrderReferenceSandboxSimulationString () {
		if (empty($this->_currentMethod->sandbox_error_simulation)) {
			return NULL;
		}
		$setOrderReferenceSandboxSimulation = array(
			'InvalidPaymentMethod',
			//'PaymentMethodNotAllowed',
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
			'PaymentMethodNotAllowed',
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
		if ($this->_currentMethod->environment != 'sandbox' OR $this->_currentMethod->sandbox_error_simulation == '') {
			return NULL;
		}

		if (in_array($this->_currentMethod->sandbox_error_simulation, $authorizedSimulationReasons)) {

			$sandboxSimulationStrings = array(
				'InvalidPaymentMethod' => '{"SandboxSimulation":{"State":"Declined","ReasonCode":"InvalidPaymentMethod"}}',
				//'PaymentMethodNotAllowed' => '{"SandboxSimulation": {"State":"Declined","ReasonCode":"InvalidPaymentMethod","PaymentMethodUpdateTimeInMins":100}}',
				'AmazonRejected'       => '{"SandboxSimulation":{"State":"Declined","ReasonCode":"AmazonRejected" }}',
				'TransactionTimedOut'  => '{"SandboxSimulation":{"State":"Declined","ReasonCode":"TransactionTimedOut"}}',
				'ExpiredUnused'        => '{"SandboxSimulation":{"State":"Declined","ReasonCode":"ExpiredUnused" ,"ExpirationTimeInMins":1}}',
				'AmazonClosed'         => '{"SandboxSimulation":{"State":"Closed", "ReasonCode":"AmazonClosed"}}',
				'Pending'              => '{"SandboxSimulation":{"State":"Pending"}}',

			);
			//$simString = urlencode('{"SandboxSimulation": {"State":"Declined","ReasonCode":"InvalidPaymentMethod","PaymentMethodUpdateTimeInMins":100}}'); // softDecline / InvalidPaymentMethod

			$simulationString = $sandboxSimulationStrings[$reason];
			//$app = JFactory::getApplication();
			//$app->enqueueMessage(vmText::_('VMPAYMENT_AMAZON_CONF_SANDBOX_SIMULATION_'.strtoupper($this->_currentMethod->sandbox_error_simulation)));
			//$app->enqueueMessage($simulationString);
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

		$this->loadHelperClass('amazonHelperConfirmOrderReferenceResponse');
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

		$amazonHelperconfirmOrderReferenceResponse = new amazonHelperConfirmOrderReferenceResponse($confirmOrderReferenceResponse, $this->_currentMethod);
		$amazonHelperconfirmOrderReferenceResponse->onResponseUpdateOrderHistory($order);
		$storeInternalData = $amazonHelperconfirmOrderReferenceResponse->getStoreInternalData();
		$this->storeAmazonInternalData($order, $confirmOrderReferenceRequest, $confirmOrderReferenceResponse, NULL, NULL, $storeInternalData);


		return true;
	}

	/**
	 * @param $client
	 * @param $cart
	 * @param $order
	 */
	private function getAuthorization ($client, $cart, $order) {
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_AuthorizeRequest');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_Price');
		$this->loadHelperClass('amazonHelperAuthorizeResponse');

		$authorizeRequest = new OffAmazonPaymentsService_Model_AuthorizeRequest();
		$authorizeRequest->setAmazonOrderReferenceId($this->_amazonOrderReferenceId);
		$authorizeRequest->setSellerId($this->_currentMethod->sellerId);
		$authorizeRequest->setAuthorizationReferenceId($order['details']['BT']->order_number);
		$authorizeRequest->setSellerAuthorizationNote($this->getSellerAuthorizationNote());
		$authorizeRequest->setTransactionTimeout($this->getAuthorizationTransactionTimeout());
		// directly do the capture without the need to call the Capture Request
		if ($this->isCaptureImmediate($cart)) {
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

		$amazonHelperAuthorizeResponse = new amazonHelperAuthorizeResponse($authorizeResponse, $this->_currentMethod);
		$amazonState = $amazonHelperAuthorizeResponse->onResponseUpdateOrderHistory($order);

		$storeInternalData = $amazonHelperAuthorizeResponse->getStoreInternalData();
		$this->storeAmazonInternalData($order, $authorizeRequest, $authorizeResponse, NULL, $this->renderPluginName($this->_currentMethod), $storeInternalData);

		if ($amazonState == 'Declined') {
			$this->handledDeclinedAuthorizationResponse($authorizeResponse);

		}
		return $amazonAuthorizationId;
	}


	function updateAuthorizeBillingAddressInOrder ($authorizeResponse, $order) {
		if (!$authorizeResponse->isSetAuthorizeResult()) {
			return;
		}
		$authorizeResult = $authorizeResponse->getAuthorizeResult();
		if (!$authorizeResult->isSetAuthorizationDetails()) {
			return;
		}
		$authorizationDetails = $authorizeResult->getAuthorizationDetails();
		if (!$authorizationDetails->isSetAuthorizationBillingAddress()) {
			return;
		}
		$authorizationBillingAddress = $authorizationDetails->getAuthorizationBillingAddress();
		$BT = $this->getUserInfoFromAmazon($authorizationBillingAddress );

		$orderModel = VmModel::getModel('orders');
		$BT['virtuemart_order_id'] = $order['details']['BT']->virtuemart_order_id;
		$order_userinfosTable = $orderModel->getTable('order_userinfos');
		$BT['address_type'] = 'BT';
		$order_userinfosTable->emptyCache();
		$order_userinfosTable->load($order['details']['BT']->virtuemart_order_id, 'virtuemart_order_id', " AND address_type='BT'");
		if (!$order_userinfosTable->bindChecknStore($BT, true)) {
			vmError($order_userinfosTable->getError());
			return false;
		}

	}


	/**
	 * @return int
	 */
	function getAuthorizationTransactionTimeout () {
		if ($this->_currentMethod->erp_mode == "erp_mode_disabled") {
			if ($this->_currentMethod->authorization_mode_erp_disabled == "automatic_synchronous") {
				return 0;
			} else {
				return self::AUTHORIZE_TRANSACTION_TIMEOUT;
			}
		} else {
			if ($this->_currentMethod->authorization_mode_erp_enabled == "automatic_synchronous") {
				return 0;
			} else {
				return self::AUTHORIZE_TRANSACTION_TIMEOUT;
			}
		}
	}


	private function handledDeclinedAuthorizationResponse ($authorizeResponse) {
		$authorizeResult = $authorizeResponse->getAuthorizeResult();
		$authorizationDetails = $authorizeResult->getAuthorizationDetails();
		$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
		if ($authorizationStatus->isSetReasonCode()) {
			$reasonCode = $authorizationStatus->getReasonCode();
		}

		if ($reasonCode == 'InvalidPaymentMethod') {
			$this->onErrorRedirectToCart(vmText::_('VMPAYMENT_AMAZON_INVALIDPAYMENTMETHOD'));
		} elseif ($reasonCode == 'AmazonRejected' or $reasonCode == 'ProcessingFailure') {
			// should try again later ...
			// Redirect to cart and and buyer can select another payment method (VM)
			$this->leaveAmazonCheckout(vmText::_('VMPAYMENT_AMAZON_SELECT_ANOTHER_PAYMENT'));
		}
	}


	public function plgVmOnUpdateOrderPayment (&$order, $old_order_status) {
		// we don't do anything from the front end
		if (JFactory::getApplication()->isSite()) {
			return NULL;
		}
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
		if (!($payments = $this->getDatasByOrderId($order->virtuemart_order_id))) {
			// JError::raiseWarning(500, $db->getErrorMsg());
			return null;
		}
		$orderModel = VmModel::getModel('orders');
		$orderData = $orderModel->getOrder($order->virtuemart_order_id);

		if ($order->order_status == $this->_currentMethod->status_refunded and $this->canDoRefund($payments)) {
			return $this->refundPayment($orderData, $payments);
		} elseif ($order->order_status == $this->_currentMethod->status_capture and $this->canDoCapture($payments)) {
			return $this->capturePayment($orderData, $payments);
		} elseif ($order->order_status == $this->_currentMethod->status_cancel and $this->canDoCancel($payments)) {
			return $this->cancelPayment($orderData);
		}


		return false;
	}


	/**
	 * @param $payments
	 * @return bool
	 */

	private function canDoRefund ($payments) {
		return true;
		$payment = end($payments);
		if ($payment->amazon_response_state == 'Open') {
			return true;
		} else {
			vmInfo(vmText::sprintf('VMPAYMENT_AMAZON_UPDATEPAYMENT_CANTDOREFUND', $payment->amazon_response_state));
			return false;
		}
	}

	/**
	 * if authorization object is in Open State, then the funds can be captured
	 */
	private function canDoCapture ($payments) {
		return true;
		$payment = end($payments);
		if ($payment->amazon_response_state == 'Open') {
			return true;
		} else {
			vmInfo(vmText::sprintf('VMPAYMENT_AMAZON_UPDATEPAYMENT_CANTDOCAPTURE', $payment->amazon_response_state));
			return false;
		}
	}

	private function canDoAuthorization () {
		if ($this->_currentMethod->erp_mode == "erp_mode_disabled" OR ($this->_currentMethod->erp_mode == "erp_mode_enabled" AND $this->_currentMethod->authorization_mode_erp_enabled != "authorization_done_by_erp")) {
			return true;
		} else {
			return false;
		}
	}


	private function capturePayment ($order, $payments) {
		$payment = $this->getAuthorizationResponse($payments);
		if ($payment == NULL OR empty($payment->amazon_response_amazonAuthorizationId)) {
			vmError(vmText::_('VMPAYMENT_AMAZON_UPDATEPAYMENT_NOAMAZONAUTHORIZATIONID'));
			return false;
		}

		$amazonAuthorizationId = $payment->amazon_response_amazonAuthorizationId;

		$this->loadAmazonClass('OffAmazonPaymentsService_Model_CaptureRequest');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_Price');
		$client = $this->getOffAmazonPaymentsService_Client();
		$captureRequest = new OffAmazonPaymentsService_Model_CaptureRequest();
		$captureRequest->setSellerId($this->_currentMethod->sellerId);
		$captureRequest->setAmazonAuthorizationId($amazonAuthorizationId);
		$captureRequest->setCaptureReferenceId($this->getUniqueReferenceId($order['details']['BT']->order_number)); // random string
		$captureRequest->setCaptureAmount(new OffAmazonPaymentsService_Model_Price());
		$captureRequest->getCaptureAmount()->setAmount($this->getTotalInPaymentCurrency($client, $order['details']['BT']->order_total, $order['details']['BT']->order_currency));
		$captureRequest->getCaptureAmount()->setCurrencyCode($this->getCurrencyCode3($client));

		try {
			$captureResponse = $client->capture($captureRequest);
			$amazonCaptureId = $captureResponse->getCaptureResult()->getCaptureDetails()->getAmazonCaptureId();
			$this->debugLog("<pre>" . var_export($captureRequest, true) . "</pre>", __FUNCTION__, 'debug');
			$this->debugLog("<pre>" . var_export($captureResponse, true) . "</pre>", __FUNCTION__, 'debug');

		} catch (Exception $e) {
			$msg = $e->getMessage();
			$log = "An exception was thrown when trying to capture payment:" . $e->getMessage() . "\n" . $e->getTraceAsString();
			while ($e = $e->getPrevious()) {
				$log .= ("Caused by: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "");
				$msg .= "Reason: " . $e->getMessage();
				$log .= "\n";
			}
			$this->debugLog($log, __FUNCTION__, 'debug');
			$this->amazonError(__FUNCTION__ . ' ' . $msg);
			return false;
		}
		$this->loadHelperClass('amazonHelperCaptureResponse');
		$amazonHelperCaptureResponse = new amazonHelperCaptureResponse($captureResponse, $this->_currentMethod);
		$amazonHelperCaptureResponse->onResponseUpdateOrderHistory($order);
		//$orderModel = VmModel::getModel('orders');

		//$orderModel->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order_history, TRUE);
		$storeInternalData = $amazonHelperCaptureResponse->getStoreInternalData();
		$this->storeAmazonInternalData($order, $captureRequest, $captureResponse, NULL, $this->renderPluginName($this->_currentMethod), $storeInternalData);

		return $amazonCaptureId;
	}

	private function refundPayment ($order, $payments) {

		$amazonCaptureId = $this->getAmazonCaptureId($payments);
		if (empty($amazonCaptureId)) {
			vmError(vmText::_('VMPAYMENT_AMAZON_UPDATEPAYMENT_NOAMAZONCAPTUREID'));
			return false;
		}

		$this->loadAmazonClass('OffAmazonPaymentsService_Model_RefundRequest');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_Price');

		$client = $this->getOffAmazonPaymentsService_Client();
		$refund = new OffAmazonPaymentsService_Model_Price();
		$refund->setCurrencyCode($this->getCurrencyCode3($client));
		$refund->setAmount($this->getTotalInPaymentCurrency($client, $order['details']['BT']->order_total, $order['details']['BT']->order_currency));

		$refundRequest = new OffAmazonPaymentsService_Model_RefundRequest();
		$refundRequest->setSellerId($this->_currentMethod->sellerId);
		$refundRequest->setAmazonCaptureId($amazonCaptureId);
		$refundRequest->setRefundReferenceId($this->getUniqueReferenceId($order['details']['BT']->order_number)); // random string
		$refundRequest->setRefundAmount($refund);
		try {
			$refundResponse = $client->refund($refundRequest);
			$amazonRefundId = $refundResponse->getRefundResult()->getRefundDetails()->getAmazonRefundId();
			$this->debugLog("<pre>" . var_export($refundRequest, true) . "</pre>", __FUNCTION__, 'debug');
			$this->debugLog("<pre>" . var_export($refundResponse, true) . "</pre>", __FUNCTION__, 'debug');

		} catch (Exception $e) {
			$msg = $e->getMessage();
			$log = "An exception was thrown when trying to refund payment:" . $e->getMessage() . "\n" . $e->getTraceAsString();
			while ($e = $e->getPrevious()) {
				$log .= ("Caused by: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "");
				$msg .= "Reason: " . $e->getMessage();
				$log .= "\n";
			}
			$this->debugLog($log, __FUNCTION__, 'debug');
			$this->amazonError(__FUNCTION__ . ' ' . $msg);
			return false;
		}
		$this->loadHelperClass('amazonHelperRefundResponse');
		$amazonHelperRefundResponse = new amazonHelperRefundResponse($refundResponse, $this->_currentMethod);
		$storeInternalData = $amazonHelperRefundResponse->getStoreInternalData();
		$this->storeAmazonInternalData($order, $refundRequest, $refundResponse, NULL, $this->renderPluginName($this->_currentMethod), $storeInternalData);

		return $amazonRefundId;
	}


	function getOrderReferenceState () {
		$client = $this->getOffAmazonPaymentsService_Client();

		$getOrderReferenceDetailsResponse = $this->getOrderReferenceDetails($client);
		if ($getOrderReferenceDetailsResponse) {
			return $getOrderReferenceDetailsResponse->getGetOrderReferenceDetailsResult()->getOrderReferenceDetails()->getOrderReferenceStatus()->getState();
		}
		return false;
	}

	/**
	 * Capture reference Id must always be unique
	 * @param $order_number
	 * @return string
	 */
	private function getUniqueReferenceId ($order_number) {
		return $order_number . '-' . time();
	}

	function getAuthorizationResponse ($payments) {
		foreach ($payments as $payment) {
			if ($payment->amazon_response_type == 'OffAmazonPaymentsService_Model_AuthorizeResponse') {
				return $payment;
			}
		}
		return NULL;
	}

	function getAmazonCaptureId ($payments) {
		$payments_reverse = array_reverse($payments);
		foreach ($payments_reverse as $payment) {
			if ($payment->amazon_response_type == 'OffAmazonPaymentsService_Model_CaptureResponse') {
				return $payment->amazon_response_amazonCaptureId;
			}
		}
		return NULL;
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

		$this->loadVmClass('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');

		if (!class_exists('shopFunctionsF')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'shopfunctionsf.php');
		}
		$this->loadVmClass('VirtueMartModelOrders', JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');


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

		$this->loadVmClass('VirtueMartModelOrders', JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');


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
		$this->loadAmazonClass('OffAmazonPaymentsService_Client');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_SetOrderReferenceDetailsResponse');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_Price');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_OrderTotal');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_SellerOrderAttributes');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_ResponseHeaderMetadata');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_ResponseMetadata');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_AuthorizeResult');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_AuthorizationDetails');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_Address');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_IdList');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_Status');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_CaptureDetails');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_CaptureResult');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_RefundResult');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_RefundDetails');

		$this->loadAmazonClass('OffAmazonPaymentsNotifications_Model_AuthorizationNotification');

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
					$response_class = get_class($amazon_data);
					$pos = strrpos($response_class, '_');
					$vmClass = substr($response_class, $pos + 1);
					$html .= $this->getHtmlRowBE(vmText::_('VMPAYMENT_AMAZON_RESPONSE_TYPE'), vmText::_('VMPAYMENT_AMAZON_RESPONSE_TYPE_' . $vmClass));
				}
				if (!empty($payment->amazon_notification)) {
					$this->loadAmazonClass('OffAmazonPaymentsNotifications_Model_AuthorizationDetails');
					$this->loadAmazonClass('OffAmazonPaymentsNotifications_Model_Price');
					$this->loadAmazonClass('OffAmazonPaymentsNotifications_Model_IdList');
					$this->loadAmazonClass('OffAmazonPaymentsNotifications_Model_Status');
					$this->loadAmazonClass('OffAmazonPaymentsNotifications_Model_OrderItemCategories');
					$this->loadAmazonClass('OffAmazonPaymentsNotifications_Model_RefundNotification');
					$this->loadAmazonClass('OffAmazonPaymentsNotifications_Model_RefundDetails');
					$this->loadAmazonClass('OffAmazonPaymentsNotifications_Model_CaptureNotification');
					$this->loadAmazonClass('OffAmazonPaymentsNotifications_Model_CaptureDetails');
					$amazon_data = unserialize($payment->amazon_notification);
					$amazon_classes[get_class($amazon_data)] = $payment->amazon_notification;
					$notification_class = get_class($amazon_data);
					$pos = strrpos($notification_class, '_');
					$vmClass = substr($notification_class, $pos + 1);
					$html .= $this->getHtmlRowBE(vmText::_('VMPAYMENT_AMAZON_NOTIFICATION_TYPE'), vmText::_('VMPAYMENT_AMAZON_NOTIFICATION_TYPE_' . $vmClass));

				}
				$code = 'amazon_response_';
				foreach ($payment as $key => $value) {
					// only displays if there is a value or the value is different from 0.00 and the value
					if ($value) {
						if (substr($key, 0, strlen($code)) == $code) {
							$html .= $this->getHtmlRowBE($key, $value);
						}
					}
				}


				foreach ($amazon_classes as $amazon_class => $amazon_data_serialized) {
					$this->loadAmazonClass($amazon_class);
					$vmClassName = 'amazonHelper' . $vmClass;
					$amazon_data = unserialize($amazon_data_serialized);
					$this->loadHelperClass($vmClassName);
					if (class_exists($vmClassName)) {
						$obj = new $vmClassName($amazon_data, $this->_currentMethod);
						$contents = $obj->getContents();
						if (!empty($contents)) {
							$html .= '<tr><td></td><td>' . '
<a href="#" class="amazonPrintOpener" rel="' . $payment->id . '" >
	<div style="background-color: white; z-index: 100; right:0; display: none; border:solid 2px; padding:10px;" class="vm-absolute" id="amazonPrint_' . $payment->id . '">';
							$html .= $contents;
							$html .= ' </div>
	<span class="icon-nofloat vmicon vmicon-16-xml"></span>&nbsp;';
							$html .= vmText::_('VMPAYMENT_' . $this->_name . '_VIEW_TRANSACTION_PRINT');
							$html .= '  </a>';
							$html .= ' </td></tr>';
						}
					}
					if ($this->_currentMethod->debug) {
						//$html .= '<tr><td></td><td>' . $amazon_class . '
						$html .= '<tr><td></td><td>' . '
<a href="#" class="amazonLogOpener" rel="' . $payment->id . '" >
	<div style="background-color: white; z-index: 100; right:0; display: none; border:solid 2px; padding:10px;" class="vm-absolute" id="amazonLog_' . $payment->id . '">';
						$html .= "<pre>" . var_export($amazon_data, true) . "</pre>";
						//$html .= $obj->getContents();

						$html .= ' </div>
	<span class="icon-nofloat vmicon vmicon-16-xml"></span>&nbsp;';
						$html .= vmText::_('VMPAYMENT_' . $this->_name . '_VIEW_TRANSACTION_LOG');
						$html .= '  </a>';
						$html .= ' </td></tr>';
					}

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
	$('.amazonPrintOpener').click(function() {
		var logId = $(this).attr('rel');
		$('#amazonPrint_'+logId).toggle();
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
			/*
			if ($cart->layout==$this->_name) {
				if (!class_exists('VmConfig')) {
					require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'config.php');
				}
				VmConfig::loadConfig();
				$cart->layout = VmConfig::get('cartlayout', 'default');
				$cart->setCartIntoSession();
			}
			*/
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
		$this->loadVmClass('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');

		//$this->debug('', 'updateCartWithAmazonAddress', 'debug');
		$cart = VirtueMartCart::getCart();
		$cartLayout = $cart->getCartLayout();
		if (empty($cart->products) and $cartLayout == $this->_name) {
			$this->unsetCartLayoutAndPaymentMethod($cart);
		}
		$amazonOrderReferenceIdWeight = $this->getAmazonOrderReferenceIdWeightFromSession();
		if ($amazonOrderReferenceIdWeight) {
			$this->_amazonOrderReferenceId = $amazonOrderReferenceIdWeight['_amazonOrderReferenceId'];
			$referenceIdIsOnlyDigitalGoods = $amazonOrderReferenceIdWeight['isOnlyDigitalGoods'];
		}

		if (!$this->_amazonOrderReferenceId OR $this->shouldLoginAgain($referenceIdIsOnlyDigitalGoods, $this->isOnlyDigitalGoods($cart))) {
			$html = $this->renderSignInButton($cart);
		}

		return $html;
	}

	private function unsetCartLayoutAndPaymentMethod ($cart) {
		if (!class_exists('VmConfig')) {
			require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'config.php');
		}
		VmConfig::loadConfig();
		$cart->layout = VmConfig::get('cartlayout', 'default');
		$cart->virtuemart_paymentmethod_id = 0;
		$cart->setCartIntoSession();
		return;
	}

	/**
	 * reset the cart layout, unset the paymentmethod, put back the storeAddress
	 */
	private function leaveAmazonCheckout ($msg = NULL) {
		if (!class_exists('VmConfig')) {
			require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'config.php');
		}
		VmConfig::loadConfig();
		$cart = VirtueMartCart::getCart();
		$cart->layout = VmConfig::get('cartlayout', 'default');
		$cart->virtuemart_paymentmethod_id = 0;
		$previousAddress = $this->getBTandSTFromSession();
		$cart->BT = $previousAddress['BT'];
		$cart->ST = $previousAddress['ST'];
		$cart->setCartIntoSession();
		$this->clearAmazonSession();
		if ($msg) {
			$app = JFactory::getApplication();
			$app->enqueueMessage($msg);
		}
		return;
	}


	private function setCartLayout ($cart) {
		$cart->setCartLayout($this->_name);

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
			vmInfo('VMPAYMENT_AMAZON_PAYMENT_NOT_AVAILABLE');
			$this->unsetCartLayoutAndPaymentMethod($cart);
			return FALSE;
		}
		$layout = $cart->layout;

		//$cart->layout='amazon';
		//$layout = JRequest::getWord('layout', '');

		if ($this->shouldLoginAgain($referenceIdIsOnlyDigitalGoods, $this->isOnlyDigitalGoods($cart))) {
			//$html = $this->renderSignInButton($cart);
			//echo $html;
		} else {
			$task = JRequest::getWord('task', '');
			$readOnlyWidget = $cart->_dataValidated;
			//$addressBookWallet = $this->renderAddressbookWallet($cart->getDataValidated());
			$addressBookWallet = $this->renderAddressbookWallet($readOnlyWidget);

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
	function updateCartWithAmazonAddress () {

		$this->loadVmClass('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		$return = array();
		//$this->debug('', 'updateCartWithAmazonAddress', 'debug');
		$cart = VirtueMartCart::getCart();

		$physicalDestination = $this->getPhysicalDestination();
		if (!$physicalDestination) {
			$return['error'] = 'NoPhysicalDestination';
			$return['error_msg'] = vmText::_('VMPAYMENT_AMAZON_UPDATECART_ERROR');
			return $return;
		}

		$update_data = $this->getUserInfoFromAmazon($physicalDestination);
		if (!$this->isValidCountry($update_data['virtuemart_country_id'])) {
			$this->updateCartWithDefaultAmazonAddress($cart, $this->isOnlyDigitalGoods($cart));
			$country = shopFunctions::getCountryByID($update_data['virtuemart_country_id']);
			$cart->_dataValidated = false;
			$cart->BT['virtuemart_country_id'] = 0;
			$cart->setCartIntoSession();
			$return['error'] = 'deliveryCountryNotAllowed';
			$leaveAmazonCheckoutLink = $this->getLeaveAmazonCheckoutLink();
			$return['error_msg'] = vmText::sprintf('VMPAYMENT_AMAZON_UPDATECART_DELIVERYCOUNTRYNOTALLOWED', $country);
			return $return;

		}
		if ($this->isSameAddress($update_data, $cart)) {
			$return['error'] = 'sameAddress';
			return $return;

		}
		$update_data ['address_type'] = 'BT';
		$cart->saveAddressInCart($update_data, $update_data['address_type'], TRUE);


		// update BT and ST with Amazon Partial Address
		$prefix = 'shipto_';
		$update_data = $this->getUserInfoFromAmazon($physicalDestination, $prefix);
		$update_data ['address_type'] = 'ST';
		$cart->saveAddressInCart($update_data, $update_data['address_type'], TRUE);
		$cart->STsameAsBT = 0;
		$cart->setCartIntoSession();

		$return['error'] = 'addressUpdated';
		return $return;
	}


	function getPhysicalDestination () {
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
		return $physicalDestination;

	}

	function updateCartWithDefaultAmazonAddress ($cart, $STsameAsBT = true) {

		$this->loadVmClass('VirtueMartCart', JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');

		// this should be done only the first time.
		$this->saveBTandSTInSession($cart);
		$this->_amazonOrderReferenceId = $this->getAmazonOrderReferenceIdFromSession();
		if (empty($this->_amazonOrderReferenceId)) {
			//vmError('VMPAYMENT_AMAZON_LOGIN');
			return FALSE;
		}
		$virtuemart_vendor_id = 1;
		$vendorModel = VmModel::getModel('vendor');
		$vendorModel->setId($virtuemart_vendor_id);
		$vendorFields = $vendorModel->getVendorAddressFields($virtuemart_vendor_id);
		$skips = array('name', 'username', 'agreed');
		// TODO:  to take only the required fields for the BT and ST
		// TODO: only set the address if NOT logged in , or address is not already set
		// TODO if asynchronous authorization: merchant must set fields to NOT REQUIRED
		$update_dataBT = array();
		$update_dataST = array();
		$prefix = 'shipto_';
		foreach ($vendorFields['fields'] as $field) {
			if (in_array($field['name'], $skips)) {
				continue;
			}
			if (!empty($field['value'])) {
				if (isset($field[$field['name']])) {
					$update_dataBT[$field['name']] = $field[$field['name']];
					$update_dataST[$prefix . $field['name']] = $field[$field['name']];
				} else {
					$update_dataBT[$field['name']] = $field['value'];
					$update_dataST[$prefix . $field['name']] = $field['value'];
				}

			}
		}
		$update_dataBT ['address_type'] = 'BT';

		$cart->saveAddressInCart($update_dataBT, $update_dataBT['address_type'], TRUE);

		if (!$STsameAsBT) {
			$update_dataST ['address_type'] = 'ST';

			$cart->saveAddressInCart($update_dataST, $update_dataST['address_type'], TRUE);
		} else {
			$cart->STsameAsBT = 1;
			$cart->setCartIntoSession();
		}

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
		// ERP mode turns off all automated authorization and capture functionality
		// as well as IPN reception and / or polling, and disables any admin UI functionality that may trigger
		//If the authorization is done by ERP then the IPN URL set in amazon should not be this one.
		// we keep it anyway, for testing purposes
		if ($this->isERPModeEnabled() and $this->isAuthorizationDoneByErp()) {
			return;
		}
		// Fetch all HTTP request headers
		$headers = getallheaders();
		$body = file_get_contents('php://input');
		// TODO REMOVE THIS TESTING ALONE
		/*
				 $fp = fopen("/Applications/MAMP/htdocs/VM2/VM2024/AMAZON-ipnhandler.php", 'a+');
				fwrite($fp, var_export($headers, true));
				fwrite($fp, var_export($body, true));
				fclose($fp);
		*/


		$this->debugLog($headers, 'AMAZON IPN HEADERS debug', 'debug');
		$this->debugLog($body, 'AMAZON IPN HEADERS debug', 'debug');

		$this->loadAmazonClass('OffAmazonPaymentsNotifications_Client');
		$this->loadVmClass('VirtueMartModelOrders', JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');

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

		if (!$this->isValidNotificationtype($notificationType)) {
			$this->debugLog($notificationType, 'ipn NOT isValidNotificationtype', 'error');
			return;
		}

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

		$notificationResponse = new $newClass($notification, $this->_currentMethod);
		$this->debugLog("<pre>" . var_export($notificationResponse->amazonData, true) . "</pre>", __FUNCTION__, 'debug');


		if (!($order_number = $notificationResponse->getReferenceId())) {
			$this->debugLog('no ReferenceId IPN received', $newClass, 'error');
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
		$order_history = $notificationResponse->onNotificationUpdateOrderHistory($order, $payments);
		$this->storeAmazonInternalData($order, NULL, NULL, $notification, NULL, $notificationResponse->getStoreInternalData());

	}


	private function isValidNotificationType ($notificationType) {
		$validNotificationType = array(
			"OrderReferenceNotification",
			"BillingAgreementNotification",
			"AuthorizationNotification",
			"CaptureNotification",
			"RefundNotification",
		);
		if (in_array($notificationType, $validNotificationType)) {
			$this->debugLog("received notificationType: " . $notificationType, __FUNCTION__, 'debug');
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


	private function getBTandSTFromSession () {
		$session = JFactory::getSession();
		$sessionAmazon = $session->get('amazon', 0, 'vm');
		$address['BT'] = NULL;
		$address['ST'] = NULL;
		if ($sessionAmazon) {
			$sessionAmazonData = unserialize($sessionAmazon);
			if (isset($sessionAmazonData['BT']) OR ($sessionAmazonData['ST'])) {
				$address['BT'] = $sessionAmazonData['BT'];
				$address['ST'] = $sessionAmazonData['ST'];
			}
		}

		return $address;
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
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_GetOrderReferenceDetailsRequest');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_GetOrderReferenceDetailsResponse');
		$this->loadAmazonClass('OffAmazonPaymentsService_Model_OrderReferenceDetails');
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

	//
	// IsValidxxx functions
	//


	private function isValidUpdateOrderStatus ($orderStatus) {
		$validOrderStatus = array(
			$this->_currentMethod->status_capture,
			$this->_currentMethod->status_refunded,
			$this->_currentMethod->status_cancel,
		);
		if (!in_array($orderStatus, $validOrderStatus)) {
			return false;
		}
		return true;
	}

	/**
	 * @return bool
	 */
	private function isCaptureImmediate ($cart) {
		return ($this->_currentMethod->capture_mode == "capture_immediate" OR $this->isSomeDigitalGoods($cart));
	}


	private function isERPModeEnabled () {
		if ($this->_currentMethod->erp_mode == "erp_mode_enabled") {
			return true;
		} else {
			return false;
		}
	}


	private function isAuthorizationDoneByErp () {
		if ($this->_currentMethod->authorization_mode_erp_enabled == "authorization_done_by_erp") {
			return true;
		} else {
			return false;
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
	 * @param $cart
	 * @return bool
	 */
	private function isSomeDigitalGoods ($cart) {
		foreach ($cart->products as $product) {
			if ($product->product_weight == 0) {
				return true;
			}
		}
		return false;
	}

	/**
	 * in VM, the payment is not showed if the buyer browse in another language
	 * @return bool
	 */

	private function isValidLanguage () {
		$lang = JFactory::getLanguage();
		$tag = strtolower(substr($lang->get('tag'), 0, 2));
		if (array_key_exists($tag, $this->languages_region) AND $this->languages_region[$tag] == $this->_currentMethod->region) {
			return true;
		}
		return false;
	}

	/**
	 * @return bool
	 */
	private function isValidAmount ($amount) {
		$this->_currentMethod->min_amount = (float)str_replace(',', '.', $this->_currentMethod->min_amount);
		$this->_currentMethod->max_amount = (float)str_replace(',', '.', $this->_currentMethod->max_amount);
		$amount_cond = ($amount >= $this->_currentMethod->min_amount AND $amount <= $this->_currentMethod->max_amount
			OR
			($this->_currentMethod->min_amount <= $amount AND ($this->_currentMethod->max_amount == 0)));
		if (!$amount_cond) {
			vmdebug('AMAZON checkConditions $amount_cond false');
			return false;
		}
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


	//
	// Session functions
	//
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


	//
	// DEBUG AND LOG FUNCTIONS
	//
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


	//
	// Load classes / files  if not exists
	//
	function loadAmazonClass ($className) {
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

	function loadHelperClass ($className) {
		if (!class_exists('amazonHelper')) {
			require('amazon/helpers/helper.php');
		}
		if (!class_exists($className)) {
			$fileName = strtolower(str_replace('amazonHelper', '', $className)) . '.php';
			require('amazon/helpers/' . $fileName);
		}

	}

	function loadVmClass ($className, $fileName) {
		if (!class_exists($className)) {
			require($fileName);
		}
	}
}

// No closing tag
