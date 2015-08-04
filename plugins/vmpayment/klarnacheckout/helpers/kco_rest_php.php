<?php
/**
 *
 * KlarnaCheckout payment plugin
 *
 * @author Valérie Isaksen
 * @version $Id:$
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

class KlarnaCheckoutHelperKCO_rest_php extends KlarnaCheckoutHelperKlarnaCheckout {
	var $_currentMethod;
	function __construct($method) {
		$this->_currentMethod = $method;
		/*
		require_once( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout'.DS.'kco_rest_php/Klarna'.DS.'Rest'.DS.'Resource.php');
		require_once( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout'.DS.'kco_rest_php/Klarna'.DS.'Rest'.DS.'Checkout'.DS.'Order.php');
		require_once( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout'.DS.'kco_rest_php/Klarna'.DS.'Rest'.DS.'OrderManagement'.DS.'Capture.php');
		require_once( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout'.DS.'kco_rest_php/Klarna'.DS.'Rest'.DS.'OrderManagement'.DS.'Capture.php');
		require_once( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout'.DS.'kco_rest_php/Klarna'.DS.'Rest'.DS.'Transport'.DS.'ConnectorInterface.php');
		require_once( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout'.DS.'kco_rest_php/Klarna'.DS.'Rest'.DS.'Transport'.DS.'Connector.php');
		require_once( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout'.DS.'kco_rest_php/Klarna'.DS.'Rest'.DS.'Transport'.DS.'ResponseValidator.php');
		require_once( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout'.DS.'kco_rest_php/Klarna'.DS.'Rest'.DS.'Transport'.DS.'UserAgentInterface.php');
		require_once( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout'.DS.'kco_rest_php/Klarna'.DS.'Rest'.DS.'Transport'.DS.'UserAgent.php');
*/
		require_once dirname(__file__) . '/../kco_rest_php/vendor/autoload.php';

	}

	function getSnippet($klarna_checkout_order) {
		return $klarna_checkout_order['html_snippet'];
	}

	function getKlarnaUrl() {

		if ($this->_currentMethod->server == 'beta') {
			if ($this->_currentMethod->zone=='EU') {
				return \Klarna\Rest\Transport\ConnectorInterface::EU_TEST_BASE_URL;
			}  else {
				return \Klarna\Rest\Transport\ConnectorInterface::NA_TEST_BASE_URL;
			}
		} else {
			if ($this->_currentMethod->zone=='EU') {
				return \Klarna\Rest\Transport\ConnectorInterface::EU_BASE_URL;
			}  else {
				return \Klarna\Rest\Transport\ConnectorInterface::NA_BASE_URL;
			}
		}
	}

	function getKlarnaConnector() {
		return \Klarna\Rest\Transport\Connector::create(
			$this->_currentMethod->merchantid,
			$this->_currentMethod->sharedsecret,
			$this->getKlarnaUrl()
		);

	}

	function checkoutOrder($klarna_checkout_connector, $klarna_checkout_id) {
		return new Klarna\Rest\Checkout\Order($klarna_checkout_connector, $klarna_checkout_id);
	}




	function getMerchantData(&$klarnaOrderData, $cart) {
		$merchantUrls ['terms'] = $this->getTermsURI($cart->vendorId);
		$merchantUrls ['checkout'] = JURI::root() . 'index.php?option=com_virtuemart&view=cart' . '&Itemid=' . JRequest::getInt('Itemid');
		$merchantUrls['confirmation'] = JURI::root() . 'index.php?option=com_virtuemart&view=vmplg&task=pluginresponsereceived&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id . '&Itemid=' . JRequest::getInt('Itemid') . '&klarna_order={checkout.order.id}';
		// You can not receive push notification on non publicly available uri
		$merchantUrls['push'] = JURI::root() . 'index.php?option=com_virtuemart&view=vmplg&task=pluginnotification&tmpl=component&nt=kco-push-uri&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id . '&klarna_order={checkout.order.id}';
		// attention if used must be https
		//$create['merchant']['validation_uri'] = JURI::root() .  'index.php?option=com_virtuemart&view=vmplg&task=pluginnotification&tmpl=component&nt=kco-validation&pm=' . $virtuemart_paymentmethod_id . '&klarna_order={checkout.order.uri}';
		$klarnaOrderData['merchant_urls'] = $merchantUrls;
	}

	function getCartItems($cart, &$klarnaOrderData) {
		//vmdebug('getProductItems', $cart->pricesUnformatted);
		//self::includeKlarnaFiles();
		$i = 0;
		if (!class_exists('CurrencyDisplay'))
			require(VMPATH_ADMIN . DS . 'helpers' . DS . 'currencydisplay.php');

		foreach ($cart->products as $pkey => $product) {
// Possible values: physical (default) , discount, shipping_fee
			$items[$i]['type'] = 'physical';
			$items[$i]['reference'] = !empty($product->sku) ? $product->sku : $product->virtuemart_product_id; //Article number, SKU or similar.
			$items[$i]['name'] = substr(strip_tags($product->product_name), 0, 127);
			$items[$i]['quantity'] = (int)$product->quantity;
			if (!empty($product->product_unit) ) {
				// quantity_unit: Max 10 characters. Unit used to describe the quantity, e.g. kg, pcs.
				$items[$i]['quantity_unit'] =  $product->product_unit ;
			}

			$price = !empty($product->prices['basePriceWithTax']) ? $product->prices['basePriceWithTax'] : $product->prices['basePriceVariant'];

			$itemInPaymentCurrency = vmPSPlugin::getAmountInCurrency($price, $this->_currentMethod->payment_currency);
			$items[$i]['unit_price'] = round($itemInPaymentCurrency['value'] * 100, 0); // Minor units. Includes tax, excludes discount.

			$tax_rate = round($this->getVatTaxProduct($cart->cartPrices[$pkey]['VatTax']));
			$items[$i]['tax_rate'] = $tax_rate * 100; // Non-negative. In percent, two implicit decimals. I.e 2500 = 25%.

			// ADD A DISCOUNT AS A NEGATIVE VALUE FOR THAT PRODUCT
			if ($cart->cartPrices[$pkey]['discountAmount'] != 0.0) {
				$discount_tax_percent = 0.0;
				$discountInPaymentCurrency = vmPSPlugin::getAmountInCurrency(abs($cart->cartPrices[$pkey]['discountAmount']), $this->_currentMethod->payment_currency);
				$discountAmount = -abs(round($discountInPaymentCurrency['value'] * 100, 0));
				$items[$i]['discount_rate'] = round($discountAmount * (1 + ($tax_rate * 0.01)), 0);
			}
			// total_discount_amount	integer	O	Non-negative minor units. Includes tax.
			$items[$i]['total_discount_amount'] = 0;

			//total_tax_amount Must be within ±1 of total_amount - total_amount * 10000 / (10000 + tax_rate). Negative when type is discount.
			$totalTaxInPaymentCurrency = vmPSPlugin::getAmountInCurrency($product->prices['taxAmount']*$product->quantity, $this->_currentMethod->payment_currency);
			$items[$i]['total_tax_amount'] = round($totalTaxInPaymentCurrency['value'] * 100, 0);

			// total_amount: Includes tax and discount. Must match (quantity * unit_price) - total_discount_amount within ±quantity.
			$totalAmountInPaymentCurrency = vmPSPlugin::getAmountInCurrency($product->prices['salesPrice']*$product->quantity, $this->_currentMethod->payment_currency);
			$items[$i]['total_amount'] = round($totalAmountInPaymentCurrency['value'] * 100, 0);


		}
		if ($cart->cartPrices['salesPriceCoupon']) {
			$items[$i]['type'] = 'physical';
			$items[$i]['reference'] = 'COUPON';
			$items[$i]['name'] = 'Coupon discount';// TODO GET coupon NAME
			$items[$i]['quantity'] = 1;
			$couponInPaymentCurrency = vmPSPlugin::getAmountInCurrency($cart->cartPrices['salesPriceCoupon'], $this->_currentMethod->payment_currency);
			$items[$i]['unit_price'] = round($couponInPaymentCurrency['value'] * 100, 0);
			$items[$i]['tax_rate'] = 0;
			//$this->debugLog($cart->cartPrices['salesPriceCoupon'], 'getCartItems Coupon', 'debug');
			//$this->debugLog($items[$i], 'getCartItems', 'debug');
			$i++;
		}
		if ($cart->cartPrices['salesPriceShipment']) {
			$items[$i]['reference'] = 'SHIPPING';
			$items[$i]['name'] = 'Shipping Fee'; // TODO GET SHIPMENT NAME
			$items[$i]['quantity'] = 1;
			$shipmentInPaymentCurrency = vmPSPlugin::getAmountInCurrency($cart->cartPrices['salesPriceShipment'], $this->_currentMethod->payment_currency);
			$items[$i]['unit_price'] = round($shipmentInPaymentCurrency['value'] * 100, 0);
			$items[$i]['tax_rate'] = $this->getTaxShipment($cart->cartPrices['shipment_calc_id']);
			//$this->debugLog($cart->cartPrices['salesPriceShipment'], 'getCartItems Shipment', 'debug');
			//$this->debugLog($items[$i], 'getCartItems', 'debug');
		}


		$klarnaOrderData['order_lines'] = $items;

		$orderAmountInPaymentCurrency = vmPSPlugin::getAmountInCurrency($cart->cartPrices['salesPrice'], $this->_currentMethod->payment_currency);
		$klarnaOrderData['order_amount'] =  round($orderAmountInPaymentCurrency['value'] * 100, 0);

		$orderTaxAmountInPaymentCurrency = vmPSPlugin::getAmountInCurrency($cart->cartPrices['taxAmount'], $this->_currentMethod->payment_currency);
		$klarnaOrderData['order_tax_amount'] = round($orderTaxAmountInPaymentCurrency['value'] * 100, 0);

		$currency = CurrencyDisplay::getInstance($cart->paymentCurrency);
		return ;

	}

	function getCheckoutOrderId($klarna_checkout_order) {
		return $klarna_checkout_order->getId();
	}

	/**
	 * @param $klarna_checkout_connector
	 * @param $klarna_checkout_id
	 * @return \Klarna\Rest\OrderManagement\Order
	 */

	function checkoutOrderManagement($klarna_checkout_connector, $klarna_checkout_id) {
		return new Klarna\Rest\OrderManagement\Order($klarna_checkout_connector, $klarna_checkout_id);
	}
	/**
	 * You must now send a request to Klarna saying that you've acknowledged the order.
	 *
	 * Note: Klarna will send the push notifications every two hours for a total of 48 hours or until you confirm that you have received the order.
	 * @param $klarna_checkout_order
	 */
	function acknowledge($klarna_checkout_ordermanagement) {
		$klarna_checkout_ordermanagement->acknowledge();

	}


}
