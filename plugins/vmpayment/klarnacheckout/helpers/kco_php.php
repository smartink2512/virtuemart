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

class KlarnaCheckoutHelperKCO_php extends KlarnaCheckoutHelperKlarnaCheckout {
	var $_currentMethod;

	function __construct($method) {
		$this->_currentMethod = $method;
	}

	function getSnippet($klarna_checkout_order) {
		return $klarna_checkout_order['gui']['snippet'];
	}

	function getKlarnaUrl() {

		if ($this->_currentMethod->server == 'beta') {
			return Klarna_Checkout_Connector::BASE_TEST_URL;
		} else {
			return Klarna_Checkout_Connector::BASE_URL;
		}
	}

	function getKlarnaConnector() {
		return Klarna_Checkout_Connector::create($this->_currentMethod->sharedsecret, $this->getKlarnaUrl());
	}

	function checkoutOrder($klarna_checkout_connector, $klarna_checkout_uri) {
		return new Klarna_Checkout_Order($klarna_checkout_connector, $klarna_checkout_uri);

	}


	function getMerchantData(&$klarnaOrderData, $cart) {
		$klarnaOrderData['merchant']['id'] = $this->_currentMethod->merchantid;
		$klarnaOrderData['merchant']['terms_uri'] = $this->getTermsURI($cart->vendorId);
		$klarnaOrderData['merchant']['checkout_uri'] = JURI::root() . 'index.php?option=com_virtuemart&view=cart' . '&Itemid=' . JRequest::getInt('Itemid');
		$klarnaOrderData['merchant']['confirmation_uri'] = JURI::root() . 'index.php?option=com_virtuemart&view=vmplg&task=pluginresponsereceived&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id . '&Itemid=' . JRequest::getInt('Itemid') . '&klarna_order={checkout.order.id}';
		// You can not receive push notification on non publicly available uri
		$klarnaOrderData['merchant']['push_uri'] = JURI::root() . 'index.php?option=com_virtuemart&view=vmplg&task=pluginnotification&tmpl=component&nt=kco-push-uri&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id . '&klarna_order={checkout.order.id}';
		// attention if used must be https
		//$create['merchant']['validation_uri'] = JURI::root() .  'index.php?option=com_virtuemart&view=vmplg&task=pluginnotification&tmpl=component&nt=kco-validation&pm=' . $virtuemart_paymentmethod_id . '&klarna_order={checkout.order.uri}';

	}

	function getCartItems($cart, &$klarnaOrderData) {

		//vmdebug('getProductItems', $cart->pricesUnformatted);
		//self::includeKlarnaFiles();
		$i = 0;
		if (!class_exists('CurrencyDisplay'))
			require(VMPATH_ADMIN . DS . 'helpers' . DS . 'currencydisplay.php');

		foreach ($cart->products as $pkey => $product) {

			$items[$i]['reference'] = !empty($product->sku) ? $product->sku : $product->virtuemart_product_id;
			$items[$i]['name'] = substr(strip_tags($product->product_name), 0, 127);
			$items[$i]['quantity'] = (int)$product->quantity;
			$price = !empty($product->prices['basePriceWithTax']) ? $product->prices['basePriceWithTax'] : $product->prices['basePriceVariant'];

			$itemInPaymentCurrency = vmPSPlugin::getAmountInCurrency($price, $this->_currentMethod->payment_currency);
			$items[$i]['unit_price'] = round($itemInPaymentCurrency['value'] * 100, 0);
			//$items[$i]['discount_rate'] = $discountRate;
			// Bug indoc: discount is not supported
			//$items[$i]['discount'] = abs($cart->cartPrices[$pkey]['discountAmount']*100);
			$tax_rate = round($this->getVatTaxProduct($cart->cartPrices[$pkey]['VatTax']));
			$items[$i]['tax_rate'] = $tax_rate * 100;
			//$this->debugLog($unitPriceCentsInPaymentCurrency, 'getCartItems', 'debug');
			//$this->debugLog($cart->cartPrices[$pkey], 'getCartItems Products', 'debug');
			//$this->debugLog($items[$i], 'getCartItems', 'debug');
			$i++;
			// ADD A DISCOUNT AS A NEGATIVE VALUE FOR THAT PRODUCT
			if ($cart->cartPrices[$pkey]['discountAmount'] != 0.0) {
				$items[$i]['reference'] = $items[$i - 1]['reference'];
				$items[$i]['name'] = $items[$i - 1]['name'] . ' (' . vmText::_('VMPAYMENT_KLARNACHECKOUT_PRODUCTDISCOUNT') . ')';
				$items[$i]['quantity'] = (int)$product->quantity;
				$discount_tax_percent = 0.0;
				$discountInPaymentCurrency = vmPSPlugin::getAmountInCurrency(abs($cart->cartPrices[$pkey]['discountAmount']), $this->_currentMethod->payment_currency);
				$discountAmount = -abs(round($discountInPaymentCurrency['value'] * 100, 0));
				if ($cart->cartPrices[$pkey]['discountAmount'] > 0.0) {
					$items[$i]['tax_rate'] = $items[$i - 1]['tax_rate'];
				} else {
					$items[$i]['tax_rate'] = 0.0;
					$tax_rate = 0.0;
				}
				$items[$i]['unit_price'] = round($discountAmount * (1 + ($tax_rate * 0.01)), 0);

				//$this->debugLog($items[$i], 'getCartItems', 'debug');
				$i++;
			}
		}
		if ($cart->cartPrices['salesPriceCoupon']) {
			$items[$i]['reference'] = 'COUPON';
			$items[$i]['name'] = 'Coupon discount';
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
			$items[$i]['name'] = 'Shipping Fee';
			$items[$i]['quantity'] = 1;
			$shipmentInPaymentCurrency = vmPSPlugin::getAmountInCurrency($cart->cartPrices['salesPriceShipment'], $this->_currentMethod->payment_currency);
			$items[$i]['unit_price'] = round($shipmentInPaymentCurrency['value'] * 100, 0);
			$items[$i]['tax_rate'] = $this->getTaxShipment($cart->cartPrices['shipment_calc_id']);
			//$this->debugLog($cart->cartPrices['salesPriceShipment'], 'getCartItems Shipment', 'debug');
			//$this->debugLog($items[$i], 'getCartItems', 'debug');
		}
		$currency = CurrencyDisplay::getInstance($cart->paymentCurrency);
		$klarnaOrderData['cart']['items'] = $items;
		return;

	}

	function getCheckoutOrderId($klarna_checkout_order) {
		return $klarna_checkout_order['id'];
	}

	function checkoutOrderManagement($klarna_checkout_connector, $klarna_checkout_uri) {
		return new Klarna_Checkout_Order($klarna_checkout_connector, $klarna_checkout_uri);
	}


}
