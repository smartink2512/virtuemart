<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @author Valérie Isaksen
 * @version $Id$
 * @package VirtueMart
 * @subpackage payment
 * @copyright Copyright (C) 2004-${PHING.VM.COPYRIGHT}   - All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */
if (!class_exists('vmPSPlugin')) {
	require(JPATH_VM_PLUGINS . DS . 'vmpsplugin.php');
}
if (JVM_VERSION === 2) {
	if (!defined('JPATH_VMKLARNACHEKOUTCHEKOUTPLUGIN')) {
		define('JPATH_VMKLARNACHEKOUTCHEKOUTPLUGIN', JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout');
	}
	if (!defined('VMKLARNACHEKOUTPLUGINWEBROOT')) {
		define('VMKLARNACHEKOUTPLUGINWEBROOT', 'plugins/vmpayment/klarnacheckout');
	}
	if (!defined('VMKLARNACHEKOUTPLUGINWEBASSETS')) {
		define('VMKLARNACHEKOUTPLUGINWEBASSETS', JURI::root() . VMKLARNACHEKOUTPLUGINWEBROOT . '/klarnacheckout/assets');
	}
} else {
	if (!defined('JPATH_VMKLARNACHEKOUTCHEKOUTPLUGIN')) {
		define('JPATH_VMKLARNACHEKOUTCHEKOUTPLUGIN', JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment');
	}
	if (!defined('VMKLARNACHEKOUTPLUGINWEBROOT')) {
		define('VMKLARNACHEKOUTPLUGINWEBROOT', 'plugins/vmpayment');
	}
	if (!defined('VMKLARNACHEKOUTPLUGINWEBASSETS')) {
		define('VMKLARNACHEKOUTPLUGINWEBASSETS', JURI::root() . VMKLARNACHEKOUTPLUGINWEBROOT . '/klarnacheckout/assets');
	}
}
class plgVmPaymentKlarnaCheckout extends vmPSPlugin {
	const RELEASE = 'VM ${PHING.VM.RELEASE}';
	const CURRENCY_CODE_3 = 'SEK';
	const COUNTRY_CODE_2 = 'SE';
	const COUNTRY_CODE_3 = 'SWE';

	//protected $_cartTablename = 0;

	function __construct (& $subject, $config) {

		parent::__construct($subject, $config);

		$this->_loggable = TRUE;
		$this->tableFields = array_keys($this->getTableSQLFields());
		$this->_tablepkey = 'id'; //virtuemart_sofort_id';
		$this->_tableId = 'id'; //'virtuemart_sofort_id';
		$varsToPush = $this->getVarsToPush();
		//$this->_cartTablename = $this->_tablename . '_cart';
		$this->setConfigParameterable($this->_configTableFieldName, $varsToPush);

	}

	/**
	 * @return string
	 */
	public function getVmPluginCreateTableSQL () {

		return $this->createTableSQL('Payment KlarnaCheckout Table');
	}

	/**
	 * @return array
	 */
	function getTableSQLFields () {

		$SQLfields = array(
			'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT',
			'virtuemart_order_id' => 'int(1) UNSIGNED',
			'order_number' => 'char(64)',
			'virtuemart_paymentmethod_id' => 'mediumint(1) UNSIGNED',
			'payment_name' => 'varchar(1000)',
			/*
			'response_id' => 'varchar(255)',
			'response_purchase_country' => 'varchar(2)',
			'response_purchase_currency' => 'varchar(3)',
			'response_status' => 'varchar(128)',
			'response_reference' => 'varchar(128)',
			'response_reservation' => 'varchar(128)',
			'response_total_price_excluding_tax' => 'smallint(1)',
			'response_total_tax_amount' => 'smallint(1)',
			'response_total_price_including_tax' => 'smallint(1)',
			*/
			'action' => 'varchar(20)', // to_klarna, from_klarna
			'klarna_status' => 'varchar(20)', // pre-purchase, purchase, pre-delivery, delivery, post-delivery
			'data' => 'text', // what was sent
		);
		return $SQLfields;
	}

	/**
	 * This shows the plugin for choosing in the payment list of the checkout process.
	 *
	 * @author Valerie Cartan Isaksen
	 */
	function plgVmDisplayListFEPayment (VirtueMartCart $cart, $selected = 0, &$htmlIn) {


		//return $this->displayListFE($cart, $selected, $htmlIn);


		if ($this->getPluginMethods($cart->vendorId) === 0) {
			if (empty($this->_name)) {
				$app = JFactory::getApplication();
				$app->enqueueMessage(JText::_('COM_VIRTUEMART_CART_NO_' . strtoupper($this->_psType)));
				return false;
			} else {
				return false;
			}
		}
		$htmla = array();
		$html = '';
		VmConfig::loadJLang('com_virtuemart');
		$currency = CurrencyDisplay::getInstance();
		foreach ($this->methods as $method) {
			if ($this->checkConditions($cart, $method, $cart->pricesUnformatted)) {
				$methodSalesPrice = $this->calculateSalesPrice($cart, $method, $cart->pricesUnformatted);

				$logo = $this->displayLogos($method->payment_logos);
				$payment_cost = '';
				if ($methodSalesPrice) {
					$payment_cost = $currency->priceDisplay($methodSalesPrice);
				}
				if ($selected == $method->virtuemart_paymentmethod_id) {
					$checked = 'checked="checked"';
				} else {
					$checked = '';
				}
				$html = $this->renderByLayout('display_payment', array(
				                                                      'plugin' => $method,
				                                                      'checked' => $checked,
				                                                      'payment_logo' => $logo,
				                                                      'payment_cost' => $payment_cost,
 				                                                 ));

				$htmla[] = $html;
			}
		}
		if (!empty($htmla)) {
			$htmlIn[] = $htmla;
		}

		return true;
	}


	function getCartItems ($cart) {
		vmdebug('getProductItems', $cart->pricesUnformatted);
		self::includeKlarnaFiles();
		$i = 0;
		$vendor_currency = $this->_getVendorCurrencyId();
		foreach ($cart->products as $pkey => $product) {

			$items[$i]['reference'] = !empty($product->sku) ? $product->sku : $product->virtuemart_product_id;
			$items[$i]['name'] = $product->product_name;
			$items[$i]['quantity'] = $product->quantity;
			// prices are always in vendor currency
			$items[$i]['unit_price'] = 100 * Klarnahandler::convertPrice($cart->pricesUnformatted[$pkey]['basePriceWithTax'], $vendor_currency, $this->getPurchaseCurrency());
			$discount_rate = (($cart->pricesUnformatted[$pkey]['basePriceWithTax'] - $cart->pricesUnformatted[$pkey]['salesPrice']) * 100) / $cart->pricesUnformatted[$pkey]['basePriceWithTax'];
			$items[$i]['discount_rate'] = abs(round($discount_rate * 100));
			// Bug indoc: discount is not supported
			//$items[$i]['discount'] = abs($cart->pricesUnformatted[$pkey]['discountAmount']*100);
			$items[$i]['tax_rate'] = round($this->getVatTaxProduct($cart->pricesUnformatted[$pkey]['VatTax']) * 100);
			$i++;
		}
		if ($cart->pricesUnformatted['salesPriceCoupon']) {
			$items[$i]['reference'] = 'COUPON';
			$items[$i]['name'] = 'Coupon discount';
			$items[$i]['quantity'] = 1;
			$items[$i]['unit_price'] = 100 * $cart->pricesUnformatted['salesPriceCoupon'];
			$items[$i]['tax_rate'] = 0;
			$i++;
		}
		if ($cart->pricesUnformatted['salesPriceShipment']) {
			$items[$i]['reference'] = 'SHIPPING';
			$items[$i]['name'] = 'Shipping Fee';
			$items[$i]['quantity'] = 1;
			$items[$i]['unit_price'] = 100 * $cart->pricesUnformatted['salesPriceShipment'];
			$items[$i]['tax_rate'] = $this->getTaxShipment($cart->pricesUnformatted['shipment_calc_id']);
		}

		vmdebug('getCartItems', $items);
		return $items;

	}

	function getTaxShipment ($shipment_calc_id) {
		// TO DO add shipmentTaxRate in the cart
		// assuming there is only one rule +%
		$db = JFactory::getDBO();
		$q = 'SELECT * FROM #__virtuemart_calcs WHERE `virtuemart_calc_id`="' . $shipment_calc_id . '" ';
		$db->setQuery($q);
		$taxrule = $db->loadObject();
		if ($taxrule->calc_value_mathop != "+%") {
			VmError('KlarnaCheckout getTaxShipment: expecting math operation to be +% but is ' . $taxrule->calc_value_mathop);
		}
		return $taxrule->calc_value * 100;

	}

	function getVatTaxProduct ($vatTax) {
		$countRules = count($vatTax);
		if ($countRules == 0) {
			return 0;
		}
		if ($countRules > 1) {
			VmError('KlarnaCheckout: More then one VATax for the product:' . $countRules);
		}
		$tax = current($vatTax);
		if ($tax[2] != "+%") {
			VmError('KlarnaCheckout: expecting math operation to be +% but is ' . $tax[2]);
		}
		return $tax[1];

	}

	function plgVmOnCheckoutAdvertise ($cart, &$payment_advertise) {


		if ($this->getPluginMethods($cart->vendorId) === 0) {
			return FALSE;
		}
		$virtuemart_paymentmethod_id = 0;
		foreach ($this->methods as $method) {
			if ($cart->virtuemart_paymentmethod_id == $method->virtuemart_paymentmethod_id) {
				$virtuemart_paymentmethod_id = $method->virtuemart_paymentmethod_id;
			}
		}
		if ($virtuemart_paymentmethod_id == 0) {
			return;
		}
		if (!($method = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		$message = '';
		$snippet = '';
		if ($cart->virtuemart_shipmentmethod_id == 0) {
			$message = JText::_('VMPAYMENT_KLARNACHECKOUT_SELECT_SHIPMENT_FIRST');
		} else {
			$session = JFactory::getSession();
			$cartIdInTable = $this->storeCartInTable($cart);

			require_once 'klarnacheckout/library/Checkout.php';

			Klarna_Checkout_Order::$baseUri = 'https://checkout.testdrive.klarna.com/checkout/orders';
			Klarna_Checkout_Order::$contentType = "application/vnd.klarna.checkout.aggregated-order-v2+json";

			//session_start();
			$klarna_checkout = $session->get('klarna_checkout', '', 'vm');
			$connector = Klarna_Checkout_Connector::create($method->klarna_sharedsecret_swe);

			$klarnaOrder = null;
			//if (array_key_exists('klarna_checkout', $_SESSION)) {
			if (!empty($klarna_checkout)) {
				// Resume session
				$klarnaOrder = new Klarna_Checkout_Order($connector, $klarna_checkout);
				try {
					$klarnaOrder->fetch();

					// Reset cart
					$update['cart']['items'] = array();
					$update['cart']['items'] = $this->getCartItems($cart);

					$klarnaOrder->update($update);
				} catch (Exception $e) {
					// Reset session
					$klarnaOrder = null;
					//unset($_SESSION['klarna_checkout']);
					$session->clear('klarna_checkout', 'vm');
				}
			}

			if ($klarnaOrder == null) {
				// Start new session
				$create['purchase_country'] = $this->getPurchaseCountry();
				$create['purchase_currency'] = $this->getPurchaseCurrency();
				$create['locale'] = $this->getLocale();
				$create['merchant']['id'] = $method->klarna_merchantid_swe;
				$create['merchant']['terms_uri'] = $this->getTermsURI($cart->vendorId);
				$create['merchant']['checkout_uri'] = substr(JURI::root(false, ''), 0, -1) . JROUTE::_('index.php?option=com_virtuemart&view=cart', false);
				$create['merchant']['confirmation_uri'] = substr(JURI::root(false, ''), 0, -1) . JROUTE::_('index.php?option=com_virtuemart&view=pluginresponse&task=pluginresponsereceived&t&pm=' . $virtuemart_paymentmethod_id . '&cartId=' . $cartIdInTable . '&klarna_order={checkout.order.uri}', false);
				// You can not receive push notification on non publicly available uri
				$create['merchant']['push_uri'] = substr(JURI::root(false, ''), 0, -1) . JROUTE::_('index.php?option=com_virtuemart&view=pluginresponse&task=pluginnotification&tmpl=component&pm=' . $virtuemart_paymentmethod_id . '&cartId=' . $cartIdInTable . '&klarna_order={checkout.order.uri}', false);

				$create['cart']['items'] = $this->getCartItems($cart);
				try {
					$klarnaOrder = new Klarna_Checkout_Order($connector);
				} catch (Exception $e) {
					// hum
					vmError($e->getMessage(), $e->getMessage());
					return NULL;
				}
				$klarnaOrder->create($create);
				$klarnaOrder->fetch();
			}

// Store location of checkout session
			//$_SESSION['klarna_checkout'] = $sessionId = $order->getLocation();
			$session->set('klarna_checkout', $klarnaOrder->getLocation(), 'vm');
// Display checkout
			$snippet = $klarnaOrder['gui']['snippet'];

// DESKTOP: Width of containing block shall be at least 750px
// MOBILE: Width of containing block shall be 100% of browser window (No
// padding or margin)
		}
		$payment_advertise[] = $this->renderByLayout('cart_advertisement', array(
		                                                                        'snippet' => $snippet,
		                                                                        'message' => $message,
		                                                                   ));


	}

	function getPurchaseCountry () {
		return self::COUNTRY_CODE_2;
	}


	function getPurchaseCurrency () {
		return self::CURRENCY_CODE_3;
	}

	/** cf https://docs.klarna.com/en/rest-api#supported_locales
	 * @return string
	 */
	function getlocale () {
		return 'sv-se';
	}

	function getTermsURI ($vendorId) {

		return JURI::root() . 'index.php?option=com_virtuemart&view=vendor&layout=tos&virtuemart_vendor_id=' . $vendorId;

	}

	/** Insert or Update the cart content in the  table
	 * will be used by the push notification to retrieve the cart and save the order
	 * @param $cart
	 */

	function storeCartInTable ($cart, $cartId = 0, $dbValues = array()) {
		if (empty($dbValues)) {
			$dbValues['order_number'] = '';
			$dbValues['payment_name'] = '';
			$dbValues['virtuemart_paymentmethod_id'] = $cart->virtuemart_paymentmethod_id;
			$dbValues['action'] = 'storeCart';
			$dbValues['klarna_status'] = 'pre-purchase';
		}

		if (empty($cartId)) {
			$session = JFactory::getSession();
			$cartIdInTable = $session->get('cartId', 0, 'vm');
			$dbValues['data'] = serialize($cart);
			$preload = false;
		} else {
			$cartIdInTable = $cartId;
			$dbValues['data'] = $this->getCartFromTable($cartId, true);
			$preload = true;
		}

		$dbValues ['id'] = $cartIdInTable;

		$this->logInfo('storeCartInTable  dbvalues' . var_export($dbValues, true), 'message');
		$this->logInfo('storeCartInTable  pkey' . $this->_tablepkey, 'message');
		$this->logInfo('storeCartInTable  preload' . $preload, 'message');
		$this->logInfo('storeCartInTable  ID' . $dbValues ['id'], 'message');

		$values = $this->storePSPluginInternalData($dbValues, $this->_tablepkey, $preload);
		if (empty($cartId)) {
			$session->set('cartId', $values ['id'], 'vm');
		}
		return $values ['id'];

	}

	/** get  the cart saved in the cart table
	 *  used by the push notification to retrieve the cart and save the order
	 * @param $cart
	 */

	function getCartFromTable ($cartId, $serialized = false) {

		$db = JFactory::getDBO();
		$q = 'SELECT * FROM `' . $this->_tablename . '` ' . 'WHERE `id` = ' . $cartId . ' AND `action` = "storeCart"';

		$db->setQuery($q);
		$result = $db->loadObject();
		if ($serialized) {
			return $result->data;
		} else {
			return unserialize($result->data);
		}

	}

	/** get  the cart saved in the cart table
	 *  used by the push notification to retrieve the cart and save the order
	 * @param $cart
	 */

	function clearCartFromTable () {


		//$session = JFactory::getSession();
		//$session->clear('cartId', 'vm');

		/*
				$db = JFactory::getDBO();
				$q = 'DELETE  FROM ' . $db->quoteName($this->_cartTablename) . ' WHERE `session_id`=' . $db->quote($sessionId);
				$db->setQuery($q);
				$db->query();
		*/
	}

	/*
		 * @param $method plugin
	 *  @param $where from where tis function is called
		 */

	protected function renderPluginName ($method, $where = 'checkout') {

		$display_logos = "";


		$logos = $method->payment_logos;
		if (!empty($logos)) {
			$display_logos = $this->displayLogos($logos) . ' ';
		}
		$payment_name = $method->payment_name;
		$html = $this->renderByLayout('render_pluginname', array(
		                                                        'where' => $where,
		                                                        'logo' => $display_logos,
		                                                        'payment_name' => $payment_name,
		                                                        'payment_description' => $method->payment_desc,
		                                                   ));

		return $html;
	}

	/**
	 * This is for checking the input data of the payment method within the checkout
	 *
	 * @author Valerie Cartan Isaksen
	 */
	function plgVmOnCheckoutCheckDataPayment (VirtueMartCart $cart) {

		if (!$this->selectedThisByMethodId($cart->virtuemart_paymentmethod_id)) {
			return NULL; // Another method was selected, do nothing
		}

		return true;
	}





	/**
	 * @return bool|null
	 */
	/**
	 * @param $html
	 * @return bool|null|string
	 */
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
		require_once 'klarnacheckout/library/Checkout.php';
		$virtuemart_paymentmethod_id = JRequest::getInt('pm', 0);
		if (!($method = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($method->payment_element)) {
			return NULL;
		}
		//session_start();
		$session = JFactory::getSession();

		Klarna_Checkout_Order::$contentType = "application/vnd.klarna.checkout.aggregated-order-v2+json";

		$connector = Klarna_Checkout_Connector::create($method->klarna_sharedsecret_swe);

		//$checkoutId = $_SESSION['klarna_checkout'];
		$checkoutId = $session->get('klarna_checkout', 0, 'vm');
		if (empty($checkoutId)) {
			vmError('Missing klarna_checkout in session', 'Missing klarna_checkout in session');
			return NULL;
		}
		$order = new Klarna_Checkout_Order($connector, $checkoutId);
		$order->fetch();

		if ($order['status'] == 'checkout_incomplete') {
			$app = JFactory::getApplication();
			$app->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart'), JText::_('VMPAYMENT_KLARNACHECKOUT_INCOMPLETE'));
		}

		$snippet = $order['gui']['snippet'];
// DESKTOP: Width of containing block shall be at least 750px
// MOBILE: Width of containing block shall be 100% of browser window (No
// padding or margin)
		//$html .= var_export($order->_data);

		$html = $this->renderByLayout('response_received', array(
		                                                                        'snippet' => $snippet,
		                                                                   ));


		//unset($_SESSION['klarna_checkout']);
		$session->clear('klarna_checkout', 'vm');
		$session->clear('cartId', 'vm');

		// let's do


		//We delete the old stuff
		// get the correct cart / session
		$cart = VirtueMartCart::getCart();
		$cart->emptyCart();
		return TRUE;
	}



	/*
		 *   plgVmOnPaymentNotification() - This event is fired by Offline Payment. It can be used to validate the payment data as entered by the user.
		 * Return:
		 * Parameters:
		 *  None
		 *  @author Valerie Isaksen
		 */

	/**
	 * @return bool|null
	 */
	function plgVmOnPaymentNotification () {

		$this->_debug = true;
		$this->logInfo('plgVmOnPaymentNotification START ', 'message');

		$virtuemart_paymentmethod_id = JRequest::getInt('pm', '');
		$checkoutId = JRequest::getString('klarna_order', '');
		$cartId = JRequest::getString('cartId', '');

		if (empty($virtuemart_paymentmethod_id) or !$this->selectedThisByMethodId($virtuemart_paymentmethod_id) or empty($checkoutId) or empty($cartId)) {
			$this->logInfo('plgVmOnPaymentNotification OUT ' . $virtuemart_paymentmethod_id . "/" . $checkoutId . "/" . $cartId, 'message');
			return NULL;
		}
		if (!($method = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			$this->logInfo('plgVmOnPaymentNotification OUT getVmPluginMethod', 'message');
			return NULL; // Another method was selected, do nothing
		}

		if (!($cartDataFromTable = $this->getCartFromTable($cartId))) {
			$this->logInfo('plgVmOnPaymentNotification OUT getCartFromTable' . $cartId, 'message');
			return NULL; // No cart with this  Id
		}

		require_once 'klarnacheckout/library/Checkout.php';
		Klarna_Checkout_Order::$contentType = "application/vnd.klarna.checkout.aggregated-order-v2+json";

		$connector = Klarna_Checkout_Connector::create($method->klarna_sharedsecret_swe);

		$klarna_order = new Klarna_Checkout_Order($connector, $checkoutId);
		$klarna_order->fetch();
		$this->logInfo('plgVmOnPaymentNotification klarna order ' . var_export($klarna_order, true), 'message');

		if ($klarna_order['status'] != "checkout_complete") {
			return NULL;
		}
		// At this point make sure the order is created in your system and send a
		// confirmation email to the customer

		$this->createVmOrder($klarna_order, $cartDataFromTable, $method, (int)$cartId);
		// update Order status
		$update['status'] = 'created';
		$update['merchant_reference'] = array(
			'orderid1' => uniqid()
		);
		$this->logInfo('plgVmOnPaymentNotification AFTER CREATE VM ORDER ', 'message');

		$klarna_order->update($update);


	}

	/**
	 * Create the VM order with the saved cart, and the users infos from klarna
	 * @param $klarna_order return data from Klarna
	 * @param $cartData cart unserialized saved in the table
	 * @param $method
	 * @param $cartId pkey of the cart saved in the table
	 *
	 */
	function createVmOrder ($klarna_order, $cartData, $method, $cartId) {
		//$this->logInfo('createOrder  cartData' . var_export($cartData, true), 'message');
		//$this->logInfo('createOrder  $klarna_order' . var_export($klarna_order, true), 'message');

		if (!class_exists('VirtueMartCart')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		}
		if (!class_exists('shopFunctionsF')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'shopfunctionsf.php');
		}
		if (!class_exists('VirtueMartModelOrders')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
		}

		$cartData->_confirmDone = true;
		$cartData->_dataValidated = true;


		if (!class_exists('VirtueMartCart')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		}
		$this->logInfo('plgVmOnPaymentNotification AVANTR updateBTSTAddressInCart ' . var_export($cartData, true), 'message');

		$cart = VirtueMartCart::getCart(false, array(), serialize($cartData));
		$this->updateBTSTAddressInCart($cart, $klarna_order);

		$orderId = $cart->confirmedOrder();

		//$this->logInfo('plgVmOnPaymentNotification AFTER confirmDone EVERYTHING SHOULD BE OK orderId is '. $orderId  , 'message');
		if (!class_exists('VirtueMartModelOrders')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
		}
		$modelOrder = VmModel::getModel('orders');
		$order_number = VirtueMartModelOrders::getOrderNumber($orderId);
		$history = array();
		$history['customer_notified'] = 1;
		$history['order_status'] = $method->status_checkout_complete;
		$history['comments'] = JText::sprintf('VMPAYMENT_KLARNACHECKOUT_PAYMENT_STATUS_CHECKOUT_COMPLETE', $order_number);
		$modelOrder->updateStatusForOneOrder($orderId, $history, TRUE);

		$this->logInfo('plgVmOnPaymentNotification updateStatusForOneOrder PP' . $orderId . " " . var_export($history, true), 'message');


		$klarna_data = $this->getKlarnaData($klarna_order);

		//$this->logInfo('plgVmOnPaymentNotification KLARNA DATA ' . var_export($klarna_data, true), 'message');
		$order_number = VirtueMartModelOrders::getOrderNumber($orderId);

		$dbValues = array(
			'virtuemart_order_id' => $orderId,
			'order_number' => $order_number,
			'virtuemart_paymentmethod_id' => $method->virtuemart_paymentmethod_id,
			'payment_name' => $this->renderPluginName($method, 'create_order'),
			'action' => 'createOrder',
			'klarna_status' => $klarna_order['status'],
			'data' => serialize($klarna_data),

		);
		$this->storePSPluginInternalData($dbValues);

		$dbValues = array(
			'virtuemart_order_id' => $orderId,
			'order_number' => VirtueMartModelOrders::getOrderNumber($orderId),
			'virtuemart_paymentmethod_id' => $method->virtuemart_paymentmethod_id,
			'payment_name' => 'Klarna Checkout',
			'action' => 'storeCart',
			'klarna_status' => 'pre-purchase',
		);
		$this->storeCartInTable($cartData, $cartId, $dbValues);

	}

	function updateBTSTAddressInCart ($cart, $klarna_order) {

		$result = $this->updateAddressInCart($cart, $klarna_order['billing_address'], 'BT');
		$result = $this->updateAddressInCart($cart, $klarna_order['shipping_address'], 'ST');


	}

	function updateAddressInCart ($cart, $klarna_address, $address_type) {


		if ($address_type == 'BT') {
			$prefix = '';
			$vmAddress = $cart->BT;
		} else {
			$prefix = 'shipto_';
			$vmAddress = $cart->ST;
		}

		// Update the Shipping Address to what is specified in the register.
		$update_data = array(
			$prefix . 'address_type_name' => 'klarnacheckout',
			$prefix . 'company' => $klarna_address['company_name'],
			$prefix . 'first_name' => $klarna_address['given_name'],
			$prefix . 'last_name' => $klarna_address['family_name'],
			$prefix . 'address_1' => $klarna_address['street_address'],
			$prefix . 'zip' => $klarna_address['postal_code'],
			$prefix . 'city' => $klarna_address['city'],
			$prefix . 'virtuemart_country_id' => shopFunctions::getCountryIDByName($klarna_address['country']),
			$prefix . 'state' => '',
			$prefix . 'phone_1' => $klarna_address['phone'],
			'address_type' => $address_type
		);
		if ($address_type == 'BT') {
			$update_data ['email'] = $klarna_address['email'];
		}

		if (!empty($st)) {
			$update_data = array_merge($vmAddress, $update_data);
		}
		$cart->saveAddressInCart($update_data, $update_data['address_type'], FALSE);
	}

	function getKlarnaData ($klarna_order) {
		$push_params = $this->getKlarnaDisplayParams();
		foreach ($push_params as $key => $value) {
			$klarna_data[$key] = $klarna_order[$key];
		}

		return $klarna_data;

	}

	function getKlarnaDisplayParams () {
		return array(
			'id' => 'debug',
			'purchase_country' => 'display',
			'purchase_currency' => 'display',
			'locale' => 'debug',
			'status' => 'display',
			'reference' => 'display',
			'reservation' => 'display',
			'started_at' => 'debug',
			'completed_at' => 'debug',
			'last_modified_at' => 'debug',
			'expires_at' => 'debug',
			'cart' => 'debug',
			'customer' => 'debug',
			'shipping_address' => 'debug',
			'billing_address' => 'debug',
			'options' => 'debug',
			'merchant' => 'debug',
		);
	}



	/**
	 * Display stored payment data for an order
	 * @param  int $virtuemart_order_id
	 * @param  int $payment_method_id
	 * @see components/com_virtuemart/helpers/vmPSPlugin::plgVmOnShowOrderBEPayment()
	 */
	function plgVmOnShowOrderBEPayment ($virtuemart_order_id, $payment_method_id) {

		if (!$this->selectedThisByMethodId($payment_method_id)) {
			return NULL; // Another method was selected, do nothing
		}

		if (!($payments = $this->getDatasByOrderId($virtuemart_order_id))) {
			// JError::raiseWarning(500, $db->getErrorMsg());
			return '';
		}
		$html = '<table class="adminlist" width="50%">' . "\n";
		$html .= $this->getHtmlHeaderBE();
		$first = TRUE;
		if (VMConfig::showDebug()) {
			$html .= '<tr class="row1"><td></td><td align="left">' . JText::_('VMPAYMENT_KLARNACHECKOUT_ORDER_BE_WARNING') . '</td></tr>';

		}
		foreach ($payments as $payment) {
			$display_action = 'onShowOrderBE_' . $payment->action;
			$row_html = $this->$display_action($payment);
			if ($row_html) {
				$html .= '<tr class="row1"><td>' . JText::_('VMPAYMENT_KLARNACHECKOUT_DATE') . '</td><td align="left">' . $payment->created_on . '</td></tr>';
				$html .= $row_html;
			}
		}
		$html .= '</table>' . "\n";
		return $html;

	}

	function onShowOrderBE_createOrder ($payment) {

		if (VMConfig::showDebug()) {
			$show_fields = array("display", "debug");
		} else {
			$show_fields = array("display");
		}
		if (empty($payment->data)) {
			$html = "<tr>\n<td class='key' >" . JText::_('id') . "</td>\n <td align='left'>" . 'ERROR NO DATA' . "</td>\n</tr>\n";

		} else {
			$klarna_order = unserialize($payment->data);
			$push_params = $this->getKlarnaDisplayParams();
			$html = '';
			$lang = JFactory::getLanguage();
			foreach ($push_params as $key => $value) {
				if (in_array($value, $show_fields)) {
					$display_value = isset($klarna_order[$key]) ? $klarna_order[$key] : "???";
					$text_key=strtoupper('VMPAYMENT_KLARNACHECKOUT_'.$key);
					if ($lang->hasKey($text_key)) {
						$text=JText::_('VMPAYMENT_KLARNACHECKOUT_'.$key);
					} else {
						$text=$key;
					}
					if (!is_array($display_value)) {
						$html .= "<tr>\n<td class='key' >" . $text . "</td>\n <td align='left'>" . $display_value . "</td>\n</tr>\n";
					} else {
						$html .= "<tr>\n<td class='key' ><strong>" . $text . "</strong></td>\n <td align='left'></td>\n</tr>\n";

						foreach ($klarna_order[$key] as $order_key => $order_value) {
							if (!is_array($order_value)) {
								$display_order_value = isset($klarna_order[$key][$order_key]) ? $klarna_order[$key][$order_key] : "???";
								$html .= "<tr>\n<td class='key' >" . JText::_('VMPAYMENT_KLARNACHECKOUT_'.$order_key) . "</td>\n <td align='left'>" . $display_order_value . "</td>\n</tr>\n";
							} else {
								$html .= "<tr>\n<td class='key' >" . JText::_('VMPAYMENT_KLARNACHECKOUT_'.$order_key) . "</td>\n <td align='left'><pre>" . var_export($klarna_order[$key][$order_key], true) . "</pre></td>\n</tr>\n";
							}
						}
					}

				}
			}
		}

		return $html;

	}

	/**
	 * Can be usufull for debuggong
	 * @param $payment
	 * @return string
	 */
	function onShowOrderBE_storeCart ($payment) {
		$html = '';

		if (VMConfig::showDebug()) {
			if (!class_exists('VirtueMartCart')) {
				require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
			}
			$cart = VirtueMartCart::getCart(false, array(), $payment->data);
			$html = "<tr>\n<td class='key'>" . JText::_('storeCart') . "</td>\n <td align='left'><pre>" . var_export($cart->products, true) . "</pre></td>\n</tr>\n";
		}
		return $html;

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

		$this->convert($method);

		$address = (($cart->ST == 0) ? $cart->BT : $cart->ST);

		$amount = $cart_prices['salesPrice'];
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
	 * @param $method
	 */
	function convert ($method) {

		$method->min_amount = (float)$method->min_amount;
		$method->max_amount = (float)$method->max_amount;
	}

	/**
	 * We must reimplement this triggers for joomla 1.7
	 */

	/**
	 * Create the table for this plugin if it does not yet exist.
	 * This functions checks if the called plugin is active one.
	 * When yes it is calling the standard method to create the tables
	 *
	 * @author Valérie Isaksen
	 *
	 */
	function plgVmOnStoreInstallPaymentPluginTable ($jplugin_id) {

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
			return NULL; // Another method was selected, do nothing
		}


		return true;
	}


	/*
		 * plgVmonSelectedCalculatePricePayment
		 * Calculate the price (value, tax_id) of the selected method
		 * It is called by the calculator
		 * This function does NOT to be reimplemented. If not reimplemented, then the default values from this function are taken.
		 * @author Valerie Isaksen
		 * @cart: VirtueMartCart the current cart
		 * @cart_prices: array the new cart prices
		 * @return null if the method was not selected, false if the payment is not valid any more, true otherwise
		 *
		 *
		 */

	/**
	 * @param VirtueMartCart $cart
	 * @param array          $cart_prices
	 * @param                $cart_prices_name
	 * @return bool|null
	 */

	public function plgVmOnSelectedCalculatePricePayment (VirtueMartCart $cart, array &$cart_prices, &$cart_prices_name) {

		return $this->onSelectedCalculatePrice($cart, $cart_prices, $cart_prices_name);
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
	function plgVmOnCheckAutomaticSelectedPayment (VirtueMartCart $cart, array $cart_prices = array(), &$paymentCounter) {

		return false;
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
	function plgVmonShowOrderPrintPayment ($order_number, $method_id) {

		return $this->onShowOrderPrint($order_number, $method_id);
	}

	/**
	 * Triggered by updateStatusForOneOrder
	 * When status= pre delivery, possible action CancelReservation or ChangeReservation
	 * When status=  delivery, possible action ActivateReservation
	 * When status=  post delivery, possible action CreditInvoice, Return Amount, CreditPart
	 *
	 * @param array $order order data
	 * @return mixed, True on success, false on failures (the rest of the save-process will be
	 * skipped!), or null when this method is not actived.
	 */
	public function plgVmOnUpdateOrderPayment (&$order, $old_order_status) {
		// get latest info from DB
		if (!$this->selectedThisByMethodId($order->virtuemart_paymentmethod_id)) {
			return NULL; // Another method was selected, do nothing
		}

		if (!($method = $this->getVmPluginMethod($order->virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!($payments = $this->getDatasByOrderId($order->virtuemart_order_id))) {
			vmError(JText::sprintf('VMPAYMENT_KLARNA_ERROR_NO_DATA', $order->virtuemart_order_id));
			return NULL;
		}

		plgVmPaymentKlarnaCheckout::includeKlarnaFiles();
		$new_order_status = $order->order_status;
		$lastPayment = $payments[(count($payments)) - 1];
		$klarna_status = $lastPayment->klarna_status;
		$actions = array('activate', 'cancelReservation', 'changeReservation', 'creditInvoice');
		foreach ($actions as $action) {
			$status = 'status_' . $action;
			if ($method->$status == $new_order_status and $this->authorizedAction($klarna_status, $new_order_status, $old_order_status, $action, $method)) {
				$this->$action($order, $method, $payments);
				return true;
			}
		}
		// may be it is another new order status unknown?
		// TO DO ... how can we disply that when not in push
		vmError(JText::sprintf('VMPAYMENT_KLARNACHECKOUT_ACTION_NOT_AUTHORIZED', $action, $lastPayment->klarna_status));


		// true means plugin call was successfull
		return true;
	}

	function authorizedAction ($klarna_status, $new_order_status, $old_order_status, $action, $method) {
		return true;
		if ($old_order_status == $method->status_checkout_complete) {
			$authorize = array(
				'cancelReservation' => $method->status_cancelReservation,
				'changeReservation' => $method->status_changeReservation,
				'activateReservation' => $method->status_activateReservation,
			);
			if (in_array($new_order_status, $authorize)) {
				return TRUE;
			}
		} elseif ($old_order_status == $method->status_activateReservation) {
			$authorize = array(
				'creditInvoice' => $method->status_creditInvoice,
				'returnAmount' => $method->status_returnAmount,
				'creditPart' => $method->status_creditPart,
			);
			if (in_array($new_order_status, $authorize)) {
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 * The following variables are no longer order specific and should be fixed:

	* pclass, -1 for all Klarna Checkout orders
	* pno, null for all Klarna Checkout orders
	 * @param $order
	 * @param $method
	 * @param $payments
	 * @return bool
	 */
	function activateReservation ($order, $method, $payments){
		$rno = $this->getReservationNumber($payments);
		$pno=NULL;
		$pclass= -1;
		$gender= NULL;
		$ocr = "";
		if (!$rno) {
			return; // error already sent
		}
		// TO DO ASK KLARNA ABOUT KLARNA MODE
		$mode = KlarnaHandler::getKlarnaMode($method,  $this->getPurchaseCountry());
		$ssl = KlarnaHandler::getKlarnaSSL($mode);
		// Instantiate klarna object.
		$klarna = new Klarna_virtuemart();
		$klarna->config($method->klarna_merchantid_swe, $method->klarna_sharedsecret_swe, $this->getPurchaseCountry(), NULL, $this->getPurchaseCurrency(), $mode, VMKLARNA_PC_TYPE, KlarnaHandler::getKlarna_pc_type(), $ssl);


		try {
			$invoice_url = $klarna->activateReservation($pno, $rno, $gender, $ocr ,  KlarnaFlags::NO_FLAG, $pclass  )
				//VmInfo(JText::sprintf('VMPAYMENT_KLARNACHECKOUT_ACTIVATE_RESERVATION', $rno) );
			$vm_invoice_name ='';
			$this->copyInvoice ($invoice_url, $vm_invoice_name);

			$modelOrder = VmModel::getModel('orders');
			$history = array();
			$history['customer_notified'] = 1;
			$history['order_status'] = $method->checkout_complete;
			$history['comments'] = JText::sprintf('VMPAYMENT_KLARNACHECKOUT_PAYMENT_STATUS_CHECKOUT_COMPLETE', 12345); // $order['details']['BT']->order_number);
			$modelOrder->updateStatusForOneOrder($order->virtuemart_paymentmethod_id, $history, TRUE);
		}

		catch (Exception $e) {
			VmError($e->getMessage(), $e->getMessage());
			return FALSE;
		}

		return true;
	}

	/**
	 *
	 */
	function cancelReservation ($order, $method, $payments) {
		$rno = $this->getReservationNumber($payments);
		if (!$rno) {
			return; // error already sent
		}
		// TO DO ASK KLARNA ABOUT KLARNA MODE
		$mode = KlarnaHandler::getKlarnaMode($method, 'swe');
		$ssl = KlarnaHandler::getKlarnaSSL($mode);
		// Instantiate klarna object.
		$klarna = new Klarna_virtuemart();
		$klarna->config($method->klarna_merchantid_swe, $method->klarna_sharedsecret_swe, $this->getPurchaseCountry(), NULL, $this->getPurchaseCurrency(), $mode, VMKLARNA_PC_TYPE, KlarnaHandler::getKlarna_pc_type(), $ssl);


		try {

			$result = $klarna->cancelReservation($rno);
			VmInfo(JText::sprintf('VMPAYMENT_KLARNACHECKOUT_RESERVATION_CANCELED', $rno));
			$modelOrder = VmModel::getModel('orders');
			$history = array();
			$history['customer_notified'] = 1;
			$history['order_status'] = $method->checkout_complete;
			$history['comments'] = JText::sprintf('VMPAYMENT_KLARNACHECKOUT_PAYMENT_STATUS_CHECKOUT_COMPLETE', 12345); // $order['details']['BT']->order_number);
			$modelOrder->updateStatusForOneOrder($order->virtuemart_paymentmethod_id, $history, TRUE);
		} catch (Exception $e) {
			VmError($e->getMessage(), $e->getMessage());
			return FALSE;
		}
		return true;
	}

	function changeReservation () {

	}

	function creditInvoice () {

	}

	function creditPart () {

	}

	function getReservationNumber ($payments) {
		foreach ($payments as $payment) {
			if ($payment->klarna_status == "checkout_complete") {
				$klarna_order = unserialize($payment->data);
				return $klarna_order['reservation'];
			}
		}
		vmError('VMPAYMENT_KLARNACHECKOUT_ERROR_NO_RNO', 'VMPAYMENT_KLARNACHECKOUT_ERROR_NO_RNO');
		return null;
	}

	/**
	 * @param $orderDetails
	 */
	function plgVmOnUserOrder (&$orderDetails) {
		if (!($method = $this->getVmPluginMethod($orderDetails->virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($method->payment_element)) {
			return NULL;
		}
		if (!($payments = $this->getDatasByOrderId($orderDetails->virtuemart_order_id))) {
			vmError(JText::sprintf('VMPAYMENT_KLARNA_ERROR_NO_DATA', $orderDetails->virtuemart_order_id));
			return NULL;
		}
		$orderDetails->order_number = $this->getReservationNumber($payments);
		return;
	}

	/**
	 * @param $orderDetails
	 * @param $data
	 * @return null
	 */
	function plgVmOnUserInvoice ($orderDetails, &$data) {

		if (!($method = $this->getVmPluginMethod($orderDetails['virtuemart_paymentmethod_id']))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($method->payment_element)) {
			return NULL;
		}

		$data['invoice_number'] = 'reservedByPayment_' . $orderDetails['order_number']; // Never send the invoice via email
	}

	/**
	 * Save updated orderline data to the method specific table
	 *
	 * @param array $_formData Form data
	 * @return mixed, True on success, false on failures (the rest of the save-process will be
	 * skipped!), or null when this method is not actived.
	 */
	public function plgVmOnUpdateOrderLine ($_formData) {
		return null;
	}

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

	/**
	 * @param $name
	 * @param $id
	 * @param $table
	 * @return bool
	 */
	function plgVmSetOnTablePluginParamsPayment ($name, $id, &$table) {

		return $this->setOnTablePluginParams($name, $id, $table);
	}


	static function   getSuccessUrl ($order) {
		return JURI::base() . JROUTE::_("index.php?option=com_virtuemart&view=pluginresponse&task=pluginresponsereceived&pm=" . $order['details']['BT']->virtuemart_paymentmethod_id . '&on=' . $order['details']['BT']->order_number . "&Itemid=" . JRequest::getInt('Itemid'), false);
	}

	static function   getCancelUrl ($order) {
		return JURI::base() . JROUTE::_("index.php?option=com_virtuemart&view=pluginresponse&task=pluginUserPaymentCancel&pm=" . $order['details']['BT']->virtuemart_paymentmethod_id . '&on=' . $order['details']['BT']->order_number . '&Itemid=' . JRequest::getInt('Itemid'), false);
	}

	static function   getNotificationUrl ($order_number) {

		return JURI::base() . JROUTE::_("index.php?option=com_virtuemart&view=pluginresponse&task=pluginnotification&on=" . $order_number, false);
	}

	/**
	 * @return mixed
	 */
	function _getVendorCurrencyId () {

		if (!class_exists('VirtueMartModelVendor')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'vendor.php');
		}
		$vendor_id = 1;
		$vendor_currency = VirtueMartModelVendor::getVendorCurrency($vendor_id);
		return $vendor_currency->virtuemart_currency_id;
	}

	/**
	 *
	 */
	static function includeKlarnaFiles () {

		if (JVM_VERSION === 2) {
			require(JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarna' . DS . 'klarna' . DS . 'helpers' . DS . 'define.php');
		} else {
			require(JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarna' . DS . 'helpers' . DS . 'define.php');
		}
		if (!class_exists('KlarnaHandler')) {
			require(JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'helpers' . DS . 'klarnahandler.php');
		}

		require_once(JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'api' . DS . 'transport' . DS . 'xmlrpc-3.0.0.beta' . DS . 'lib' . DS . 'xmlrpc.inc');
		require_once(JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'api' . DS . 'transport' . DS . 'xmlrpc-3.0.0.beta' . DS . 'lib' . DS . 'xmlrpc_wrappers.inc');

	}
}

// No closing tag
