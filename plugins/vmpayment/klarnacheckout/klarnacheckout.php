<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @author Valérie Isaksen
 * @version $Id: klarnacheckout.php 8886 2015-06-24 16:31:58Z alatak $
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

if (!defined('JPATH_VMKLARNACHEKOUTCHEKOUTPLUGIN')) {
	define('JPATH_VMKLARNACHEKOUTCHEKOUTPLUGIN', JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout');
}
if (!defined('VMKLARNACHEKOUTPLUGINWEBROOT')) {
	define('VMKLARNACHEKOUTPLUGINWEBROOT', 'plugins/vmpayment/klarnacheckout');
}
if (!defined('VMKLARNACHEKOUTPLUGINWEBASSETS')) {
	define('VMKLARNACHEKOUTPLUGINWEBASSETS', JURI::root() . VMKLARNACHEKOUTPLUGINWEBROOT . '/assets');
}

if (!class_exists('Klarna')) {
	require(JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarna' . DS . 'klarna' . DS . 'api' . DS . 'klarna.php');
}


class plgVmPaymentKlarnaCheckout extends vmPSPlugin {
	const RELEASE = 'VM ${PHING.VM.RELEASE}';
	protected $currency_code_3;
	protected $currency_id;
	protected $country_code_2;
	protected $country_code_3;
	protected $locale;
	protected $sharedsecret;
	protected $merchantid;
	protected $mode;
	protected $ssl;
	protected $kco_php_countries = array('SE', 'DK', 'AT', 'FI', 'DE', 'NL', 'NO');
	protected $klarnaCheckoutInterface;

	function __construct(& $subject, $config) {

		parent::__construct($subject, $config);

		$this->_loggable = TRUE;
		$this->tableFields = array_keys($this->getTableSQLFields());
		$varsToPush = $this->getVarsToPush();
		$this->setConfigParameterable($this->_configTableFieldName, $varsToPush);
		plgVmPaymentKlarnaCheckout::includeKlarnaFiles();
		VmConfig::loadJLang('plg_vmpayment_klarna');

	}

	/**
	 * @return string
	 */
	public function getVmPluginCreateTableSQL() {

		return $this->createTableSQL('Payment KlarnaCheckout Table');
	}

	/**
	 * @return array
	 */
	function getTableSQLFields() {

		$SQLfields = array(
			'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT',
			'virtuemart_order_id' => 'int(11) UNSIGNED',
			'order_number' => 'char(64)',
			'virtuemart_paymentmethod_id' => 'mediumint(1) UNSIGNED',
			'payment_name' => 'varchar(1000)',
			'payment_order_total' => 'decimal(15,5)',
			'payment_currency' => 'smallint(1)',
			'email_currency' => 'smallint(1)',
			'action' => 'varchar(20)', // BC
			'format' => 'varchar(5)',// BC
			'data' => 'mediumtext', // BC
			'klarna_id' => 'varchar(64)',
			'klarna_status' => 'varchar(64)',
			'klarna_reservation' => 'varchar(64)',
			'klarna_started_at' => 'varchar(64)',
			'klarna_completed_at' => 'varchar(64)',
			'klarna_expires_at' => 'varchar(64)',
			'klarna_invoicenumber' => 'varchar(255)',
			'klarna_invoicepdf' => 'varchar(512)',
		);
		return $SQLfields;
	}

	/**
	 * This shows the plugin for choosing in the payment list of the checkout process.
	 *
	 * @author Valerie Cartan Isaksen
	 */
	function plgVmDisplayListFEPayment(VirtueMartCart $cart, $selected = 0, &$htmlIn) {

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
		$html = '';
		$logo = '';

		VmConfig::loadJLang('com_virtuemart');
		$currency = CurrencyDisplay::getInstance();
		$showallform = true;

		foreach ($this->methods as $this->_currentMethod) {
			if ($this->checkConditions($cart, $this->_currentMethod, $cart->pricesUnformatted)) {


				if (isset($this->_currentMethod->cost_method)) {
					$cost_method = $this->_currentMethod->cost_method;
				} else {
					$cost_method = true;
				}
				$cartPrices = $cart->cartPrices;

				$methodSalesPrice = $this->setCartPrices($cart, $cartPrices, $this->_currentMethod, $cost_method);

				$logo = $this->displayLogoKlarna('listfe');

				$payment_cost = '';
				if ($methodSalesPrice) {
					$payment_cost = $currency->priceDisplay($methodSalesPrice);
				}
				if ($selected == $this->_currentMethod->virtuemart_paymentmethod_id) {
					$checked = 'checked="checked"';
				} else {
					$checked = '';
				}
				if ($cart->virtuemart_paymentmethod_id == $this->_currentMethod->virtuemart_paymentmethod_id) {
					$showallform = false;
				}
				$html = $this->renderByLayout('display_payment', array(
					'plugin' => $this->_currentMethod,
					'checked' => $checked,
					'payment_logo' => $logo,
					'payment_tooltip' => empty($this->_currentMethod->payment_logo_display_tooltip) ? false : $this->_currentMethod->payment_logo_display_tooltip,
					'payment_cost' => $payment_cost,
					'showallform' => $showallform
				));

				$htmla[] = $html;
			}
		}


		if ($showallform) {
			$js = '
	jQuery(document).ready(function( $ ) {
		      $("#checkoutForm").show();
		      $(".billto-shipto").show();
		      $("#com-form-login").show();

	});
	';
			vmJsApi::addJScript('vm.showallform', $js);
		}


		if (!empty($htmla)) {
			$htmlIn[] = $htmla;
		}

		return true;
	}

	function displayLogoKlarna($where) {
		$logo = '';
		if (empty($this->_currentMethod->payment_logo_display)) $this->_currentMethod->payment_logo_display = array('listfe', 'selected');
		if (empty($this->_currentMethod->payment_logo_display_tooltip)) $this->_currentMethod->payment_logo_display_tooltip = 0;
		if ($this->_currentMethod->payment_logos !== '0') {
			if (in_array($where, $this->_currentMethod->payment_logo_display)) {
				if ($this->_currentMethod->payment_logos == 1) $this->_currentMethod->payment_logos = 'short-blue';
				$folder = str_replace('-', '_', $this->_currentMethod->locale);
				if (strpos($this->_currentMethod->payment_logos, 'short') === false) $width = '440';
				else $width = '385';
				if ($this->_currentMethod->payment_logo_display_tooltip === 0 or $where == 'checkout') {

					$logo = '<img src="https://cdn.klarna.com/1.0/shared/image/generic/badge/' . $folder . '/checkout/' . $this->_currentMethod->payment_logos . '.png?width=' . $width . '" />';
				} else {
					$logo = '<div class="klarna-widget klarna-badge-tooltip"
                                data-eid="' . $this->_currentMethod->merchantid . '"
                                data-locale="' . $this->_currentMethod->locale . '"
							    data-badge-name="' . $this->_currentMethod->payment_logos . '"
							    data-badge-width="' . $width . '">
							</div>';
				}
			}
		}
		return $logo;
	}


	function plgVmOnCheckoutAdvertise($cart, &$payment_advertise) {
		if (vRequest::getCmd('view') !== 'cart') return;
		if (empty($cart->products)) {
			return;
		}

		// check we are in the correct payment
		if ($this->getPluginMethods($cart->vendorId) === 0) {
			return FALSE;
		}
		$klarnaPaymentMethodActive = $this->getKlarnaPaymentMethodActive();
		if ($klarnaPaymentMethodActive !== false and $klarnaPaymentMethodActive != $cart->virtuemart_paymentmethod_id) {
			$this->clearKlarnaParams($cart);
			return;
		}
		/*
		$virtuemart_paymentmethod_id = 0;
		foreach ($this->methods as $method) {
			if ($cart->virtuemart_paymentmethod_id == $method->virtuemart_paymentmethod_id) {
				$virtuemart_paymentmethod_id = $cart->virtuemart_paymentmethod_id;
				break;
			}
		}
		if ($virtuemart_paymentmethod_id == 0) return;
*/

		if (!($this->_currentMethod = $this->getVmPluginMethod($klarnaPaymentMethodActive))) {
			return NULL; // Another method was selected, do nothing
		}


		if (!$this->initKlarnaParams($this->_currentMethod)) {
			return;
		}
		$klarnaCheckoutInterface = $this->_loadKlarnaCheckoutInterface();

		$message = '';
		$snippet = '';
		$hide_BTST = true;

		if ($cart->virtuemart_shipmentmethod_id < 0) {
			$message = vmText::_('VMPAYMENT_KLARNACHECKOUT_PLEASE_SELECT_SHIPMENT_FIRST');
		}

		$hide_BTST = true;
		$setBTatKlarna = false;
		$cart->prepareAddressFieldsInCart();
		$isDefaultKCOemail = $this->isDefaultKCOemail($cart->BT['email']);
		if (!$isDefaultKCOemail and empty($cart->BT['email'])) {
			$this->updateCartWithDefaultKCOemail($cart->BT['email']);
		}
		if (!$isDefaultKCOemail) {
			$hide_BTST = false;
		}
		$this->updateCartFields($cart);
		$cart->setCartIntoSession();

		$klarna_checkout_order = null;
		$klarna_checkout_connector = $klarnaCheckoutInterface->getKlarnaConnector();

		$klarna_checkout_id = $this->getKlarnaCheckoutIdFromSession();

		if (!empty($klarna_checkout_id)) {
			$klarna_checkout_order = $klarnaCheckoutInterface->checkoutOrder($klarna_checkout_connector, $klarna_checkout_id);

			try {
				$klarna_checkout_order->fetch();

				$update = array();
				$klarnaCheckoutInterface->getCartItems($cart, $update);
				// TODO we only update if there was a BT address before
				if (!$hide_BTST) {
					$update['shipping_address']['email'] = $cart->BT['email'];
					$hide_BTST = false;
					$address = (($cart->ST == 0) ? $cart->BT : $cart->ST);
					if (isset($address['zip']) and !empty($address['zip'])) {
						$update['shipping_address']['postal_code'] = $cart->BT['zip'];
					}
				}
				$klarna_checkout_order->update($update);

			} catch (Exception $e) {
				// Reset session
				$klarna_checkout_order = null;
				$this->clearKlarnaParams($cart);
			}
		}
		jimport('joomla.environment.browser');
		$browser = JBrowser::getInstance();
		if ($klarna_checkout_order == null) {
			// Start new session

			// Start new session
			$create['purchase_country'] = $this->country_code_2;
			$create['purchase_currency'] = $this->currency_code_3;
			$create['locale'] = $this->locale;

			$create['gui']['layout'] = $browser->isMobile() ? 'mobile' : 'desktop';
			$klarnaCheckoutInterface->getMerchantData($create, $cart);
			$this->getTemplateOptions($create);

			if (!$this->isDefaultKCOemail($cart->BT['email'])) {
				$create['shipping_address']['email'] = $cart->BT['email'];
				$address = (($cart->ST == 0) ? $cart->BT : $cart->ST);
				if (isset($address['zip']) and !empty($address['zip'])) {
					$create['shipping_address']['postal_code'] = $cart->BT['zip'];
				}
			}


			$klarnaCheckoutInterface->getCartItems($cart, $create);
			try {
				$klarna_checkout_order = $klarnaCheckoutInterface->checkoutOrder($klarna_checkout_connector, $klarna_checkout_id);

				$klarna_checkout_order->create($create);
				$klarna_checkout_order->fetch();

			} catch (Exception $e) {
				$this->clearKlarnaParams($cart);
				$admin_msg = $e->getMessage();
				$this->KlarnacheckoutError($admin_msg, vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_ERROR_OCCURRED', $this->_currentMethod->payment_name));
				return NULL;
			}
			$this->setKlarnaParamsInSession($klarnaCheckoutInterface->getCheckoutOrderId($klarna_checkout_order), $klarnaPaymentMethodActive, $cart->BT);
		}

		$this->displayJSSnippet();

		$snippet = $klarnaCheckoutInterface->getSnippet($klarna_checkout_order);
		if ($snippet == NULL) {
			$admin_msg = "No snippet returned";
			$this->KlarnacheckoutError($admin_msg, vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_ERROR_OCCURRED', $this->_currentMethod->payment_name));

		}


		$payment_advertise[] = $this->renderByLayout('cart_advertisement', array(
			'snippet' => $snippet,
			'message' => $message,
			'payment_form_position' => isset($this->_currentMethod->payment_form_position) ? $this->_currentMethod->payment_form_position : 'bottom',
			'klarna_create_account' => '' // let's do that later if needed $createAccount,
		));

	}


	/**
	 * @param $snippet
	 * @param $message
	 * @return string
	 */
	function displayJSSnippet() {


// DESKTOP: Width of containing block shall be at least 750px
// MOBILE: Width of containing block shall be 100% of browser window (No
// padding or margin)

		vmJsApi::addJScript('/plugins/vmpayment/klarnacheckout/assets/js/klarnacheckout.js', false, true, false, true);
		vmJsApi::jPrice();
		$updateCartScript = '
			jQuery(document).ready(function($) {
				window._klarnaCheckout(function(api) {
					api.on({
						"change": function(data) {
							console.log("window._klarnaCheckout calls klarnaCheckoutPayment.updateCart ");
							klarnaCheckoutPayment.updateCart(data,"' . $this->_currentMethod->virtuemart_paymentmethod_id . '");
						}
					});
				});
        });

';
		$updateSnippetScript = '
		jQuery(document).ready(function($) {
			klarnaCheckoutPayment.updateSnippet();
		});
';

		vmJsApi::addJScript('vm.kco_updatecart', $updateCartScript);
		vmJsApi::addJScript('vm.kco_updatesnippet', $updateSnippetScript);

		$hide_BTST = false;

		return;
	}


	function getTemplateOptions(&$create) {

		if (!empty($this->_currentMethod->button_color)) {
			$create['options']['color_button'] = $this->_currentMethod->button_color;
		}
		if (!empty($this->_currentMethod->color_button_text)) {
			$create['options']['color_button_text'] = $this->_currentMethod->color_button_text;
		}
		if (!empty($this->_currentMethod->color_checkbox)) {
			$create['options']['color_checkbox'] = $this->_currentMethod->color_checkbox;
		}
		if (!empty($this->_currentMethod->color_checkbox_checkmark)) {
			$create['options']['color_checkbox_checkmark'] = $this->_currentMethod->color_checkbox_checkmark;
		}
		if (!empty($this->_currentMethod->color_header)) {
			$create['options']['color_header'] = $this->_currentMethod->color_header;
		}
		if (!empty($this->_currentMethod->color_link)) {
			$create['options']['color_link'] = $this->_currentMethod->color_link;
		}

	}

	function clearKlarnaParams($cart) {
		$cart->BT = $this->getBTFromSession();
		$cart->setCartIntoSession();
		$this->debugLog('', 'clearKlarnaParams', 'debug');
		JFactory::getSession()->clear('klarnacheckout', 'vm');
	}


	function setKlarnaParamsInSession($klarna_checkout_id, $virtuemart_paymentmethod_id, $BT) {

		$sessionData = JFactory::getSession()->get('klarnacheckout', 0, 'vm');
		if (!empty($sessionData)) {
			$data = (object)json_decode($sessionData, true);
		} else {
			$data = new stdClass();
		}
		$data->klarna_checkout_id = $klarna_checkout_id;
		$data->klarna_paymentmethod_id_active = $virtuemart_paymentmethod_id;
		$data->BT = $BT;

		JFactory::getSession()->set('klarnacheckout', json_encode($data), 'vm');
	}

	function setDefaultKCOEmailInSession($email) {
		$sessionData = JFactory::getSession()->get('klarnacheckout', 0, 'vm');
		if (!empty($sessionData)) {
			$data = (object)json_decode($sessionData, true);
		} else {
			$data = new stdClass();
		}

		$data->defaultKCOemail = $email;
		JFactory::getSession()->set('klarnacheckout', json_encode($data), 'vm');
	}

	function getDefaultKCOEmailFromSession() {
		$sessionData = JFactory::getSession()->get('klarnacheckout', 0, 'vm');
		$data = (object)json_decode($sessionData, true);
		if (isset($data->defaultKCOemail)) {
			return $data->defaultKCOemail;
		}
		return NULL;
	}

	// TODO
	function isDefaultKCOemail($email) {
		$defaultKCOemail = $this->getDefaultKCOEmailFromSession();
		if ($email == $defaultKCOemail) return true;
		return false;
	}


	function getKlarnaPaymentMethodActive() {

		$sessionData = JFactory::getSession()->get('klarnacheckout', 0, 'vm');

		if (!empty($sessionData)) {
			$data = (object)json_decode($sessionData, true);
			if (isset($data->klarna_paymentmethod_id_active)) {
				return $data->klarna_paymentmethod_id_active;
			}
		}
		return false;
	}

	function getKlarnaCheckoutIdFromSession() {
		$sessionData = JFactory::getSession()->get('klarnacheckout', 0, 'vm');
		$this->debugLog(var_export($sessionData, true), 'getKlarnaCheckoutIdFromSession', 'debug');
		if (!empty($sessionData)) {
			$data = (object)json_decode($sessionData, true);
			if (isset($data->klarna_checkout_id))
				return $data->klarna_checkout_id;
		}
		return NULL;
	}

	function getBTFromSession() {
		$sessionData = JFactory::getSession()->get('klarnacheckout', 0, 'vm');
		$this->debugLog(var_export($sessionData, true), 'getHasBTFromSession', 'debug');
		if (!empty($sessionData)) {
			$data = (object)json_decode($sessionData, true);
			return $data->BT;
		}
		return NULL;
	}


	function isSavedAddressInSession($cart) {
		$cartAddress = $cart->BT;
		$BTFromSession = $this->getBTFromSession();
		if (json_encode($cartAddress) == json_encode($BTFromSession)) {
			return true;
		}
		return false;
	}

	/**
	 * cf https://docs.klarna.com/en/rest-api#supported_locales
	 * @param $method
	 */
	function initKlarnaParams() {

		$return = true;
		$db = JFactory::getDBO();
		$q = 'SELECT country_2_code , country_3_code FROM `#__virtuemart_countries` WHERE virtuemart_country_id = ' . (int)$this->_currentMethod->purchase_country;
		$db->setQuery($q);
		$country = $db->loadObject();
		if (!$country) {
			$this->KlarnacheckoutError('Klarna Checkout: No country has been found with country id=' . $this->_currentMethod->purchase_country, vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_ERROR_OCCURRED', $this->_currentMethod->payment_name));
			$this->debugLog('No country has been found with country id=' . $this->_currentMethod->purchase_country, 'initKlarnaParams', 'debug');
			$return = false;
		}
		$this->country_code_2 = $country->country_2_code;
		$this->country_code_3 = $country->country_3_code;


		$this->getPaymentCurrency($this->_currentMethod);
		$this->currency_code_3 = shopFunctions::getCurrencyByID($this->_currentMethod->payment_currency, 'currency_code_3');
		if (!$this->currency_code_3) {
			$this->KlarnacheckoutError('Klarna Checkout: No currency has been found with currency id=' . $this->_currentMethod->payment_currency, vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_ERROR_OCCURRED', $this->_currentMethod->payment_name));
			$this->debugLog('No currency has been found with currency id=' . $this->_currentMethod->payment_currency, 'initKlarnaParams', 'debug');
			$return = false;
		}
		$this->currency_id = $this->_currentMethod->payment_currency;
		if (empty($this->_currentMethod->sharedsecret) or empty($this->_currentMethod->merchantid)) {
			$this->KlarnacheckoutError('Klarna Checkout: Missing mandatory values merchant id=' . $this->_currentMethod->merchantid . ' shared secret=' . $this->_currentMethod->sharedsecret, vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_ERROR_OCCURRED', $this->_currentMethod->payment_name));
			$this->debugLog('Missing mandatory values merchant id=' . $this->_currentMethod->merchantid . ' shared secret=' . $this->_currentMethod->sharedsecret, 'initKlarnaParams', 'debug');
			$return = false;
		}
		$this->locale = $this->_currentMethod->locale;
		$this->sharedsecret = $this->_currentMethod->sharedsecret;
		$this->merchantid = $this->_currentMethod->merchantid;
		if ($this->_currentMethod->server == 'beta') {
			$this->mode = Klarna::BETA;
		} else {
			$this->mode = Klarna::LIVE;
		}
		$this->ssl = KlarnaHandler::getKlarnaSSL($this->mode);
		if (!isset($this->_currentMethod->email_currency)) $this->_currentMethod->email_currency = 'vendor';
		if (!isset($this->_currentMethod->terms_uri)) $this->_currentMethod->terms_uri = '';
		return $return;
	}


	private function _loadKlarnaCheckoutInterface() {
		if (!class_exists('KlarnaCheckoutHelperKlarnaCheckout')) {
			require(JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout' . DS . 'helpers' . DS . 'klarnacheckout.php');
		}
		if (in_array($this->country_code_2, $this->kco_php_countries)) {
			// vmpayment/klarnacheckout/kco_php/Checkout/UserAgent.php version 4.0.0
			if (!class_exists('KlarnaCheckoutHelperKCO_php')) {
				require(JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout' . DS . 'helpers' . DS . 'kco_php.php');
			}
			if (!class_exists('Klarna_Checkout_Order')) {
				require_once dirname(__file__) . DS . 'kco_php' . DS . 'Checkout.php';
			}
			$klarnaCheckoutInterface = new KlarnaCheckoutHelperKCO_php($this->_currentMethod);
		} else {
			// plugins/vmpayment/klarnacheckout/kco_rest_php/Transport/UserAgent.php     const VERSION = '2.1.0';
			if (!class_exists('KlarnaCheckoutHelperKCO_rest_php')) {
				require(JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarnacheckout' . DS . 'helpers' . DS . 'kco_rest_php.php');
			}

			$klarnaCheckoutInterface = new KlarnaCheckoutHelperKCO_rest_php($this->_currentMethod);

		}
		return $klarnaCheckoutInterface;
	}


	/**
	 * @param $method plugin
	 * @param $where from where tis function is called
	 */

	protected function renderPluginName($method, $where = 'checkout') {

		$payment_logo = "";
		$this->_currentMethod = $method;
		$payment_logo = $this->displayLogoKlarna('selected');

		$payment_name = $method->payment_name;
		$html = $this->renderByLayout('render_pluginname', array(
			'where' => $where,
			'logo' => $payment_logo,
			'payment_name' => $payment_name,
			'payment_description' => $method->payment_desc,
		));

		return $html;
	}


	/**
	 * @param $html
	 * @return bool
	 * @throws Exception
	 */
	function plgVmOnPaymentResponseReceived(&$html) {

		if (!class_exists('VirtueMartCart')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		}
		if (!class_exists('shopFunctionsF')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'shopfunctionsf.php');
		}
		if (!class_exists('VirtueMartModelOrders')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
		}

// check we are in the good payment plugin
		$virtuemart_paymentmethod_id = vRequest::getInt('pm', 0);
		if (!($this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			return NULL;
		}

		$this->debugLog('BOF', 'plgVmOnPaymentResponseReceived', 'debug');

		$klarna_checkout_id = JRequest::getString('klarna_order', '');

		if (empty($klarna_checkout_id)) {
			// not the good payment ?
			$this->debugLog(' because no klarna_order ', 'plgVmOnPaymentResponseReceived ', 'debug');
			//return NULL;

			$klarna_checkout_id = $this->getKlarnaCheckoutIdFromSession();
			if (empty($klarna_checkout_id)) {
				$this->debugLog('Missing klarna_checkout in session', 'plgVmOnPaymentResponseReceived ', 'debug');
				return NULL;
			}
		}

		// fetch the order at klarna
		if (!$this->initKlarnaParams($this->_currentMethod)) {
			return;
		}
		$klarnaCheckoutInterface = $this->_loadKlarnaCheckoutInterface();
		$klarna_checkout_connector = $klarnaCheckoutInterface->getKlarnaConnector();

		$klarna_checkout_ordermanagement = $klarnaCheckoutInterface->checkoutOrderManagement($klarna_checkout_connector, $klarna_checkout_id);
		$klarnaCheckoutInterface->acknowledge($klarna_checkout_ordermanagement);

		$klarna_checkout_order = $klarnaCheckoutInterface->checkoutOrder($klarna_checkout_connector, $klarna_checkout_id);
		$klarna_checkout_order->fetch();

		$this->debugLog($klarna_checkout_order['status'], 'plgVmOnPaymentResponseReceived ' . ' klarna status', 'debug');

		if ($klarna_checkout_order['status'] == 'checkout_incomplete') {
			JFactory::getApplication()->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart', false), vmText::_('VMPAYMENT_KLARNACHECKOUT_INCOMPLETE'));
		}
		// update the cart with klarna infos

		// update VM with Klarna Infos
		$cart = VirtueMartCart::getCart();
		$this->updateBTSTAddressInCart($cart, $klarna_checkout_order);
		//$this->updateCartFields($cart);
		$cart->prepareCartData();
		// force validation
		$cart->_dataValidated = true;
		$cart->_confirmDone = true;

		$cart->confirmedOrder();

		$this->debugLog($cart->order_number, 'plgVmOnPaymentResponseReceived ' . ' confirmDone FINAL', 'debug');

		// 	Notify shopper
		$modelOrder = VmModel::getModel('orders');
		$update_status['order_status'] = $this->_currentMethod->status_checkout_complete;
		$update_status['customer_notified'] = 1;
		$update_status['comments'] = vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_PAYMENT_STATUS_CONFIRMED', $cart->order_number);

		if (!class_exists('VirtueMartModelOrders')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
		}
		$orders = new VirtueMartModelOrders();
		$virtuemart_order_id = $orders->getOrderIdByOrderNumber($cart->order_number);

		$modelOrder->updateStatusForOneOrder($virtuemart_order_id, $update_status, TRUE);
		$order = $modelOrder->getOrder($virtuemart_order_id);

		// store data in Klarna payment table
		$dbValues['order_number'] = $cart->order_number;
		$dbValues['virtuemart_paymentmethod_id'] = $cart->virtuemart_paymentmethod_id;
		$dbValues['payment_name'] = "hhum";//TODO $this->renderPluginName($this->_currentMethod, $order);
		$dbValues['payment_order_total'] = $klarna_checkout_order['cart']['total_price_including_tax'] / 100;
		$dbValues['payment_currency'] = ShopFunctions::getCurrencyIDByName($klarna_checkout_order['purchase_currency']);;
		$dbValues['email_currency'] = $this->getEmailCurrency($this->_currentMethod);
		$dbValues['klarna_id'] = $klarna_checkout_order['id'];
		$dbValues['klarna_status'] = $klarna_checkout_order['status'];
		$dbValues['klarna_reservation'] = $klarna_checkout_order['reservation'];
		$dbValues['klarna_reference'] = $klarna_checkout_order['reference'];
		$dbValues['klarna_started_at'] = $klarna_checkout_order['started_at'];
		$dbValues['klarna_completed_at'] = $klarna_checkout_order['completed_at'];
		$dbValues['klarna_expires_at'] = $klarna_checkout_order['expires_at'];
		$dbValues['format'] = 'none';

		$this->debugLog(var_export($dbValues, true), 'plgVmConfirmedOrder storePSPluginInternalData', 'debug');
		$this->storePSPluginInternalData($dbValues);


// render Thank you page

		$html = $this->renderByLayout('response_received', array(
			'snippet' => $klarnaCheckoutInterface->getSnippet($klarna_checkout_order),
			'order_number' => $order['details']['BT']->order_number,
			'order_pass' => $order['details']['BT']->order_pass
		));

// clean everything
		$this->clearKlarnaParams($cart);
		$cart->emptyCart();
		$cart->removeCartFromSession();

		return TRUE;
	}


	/**
	 * Specific to KlarnaCheckout
	 * @param $cart
	 */
	function updateCartFields($cart) {
		if ($cart->cartfields) {
			foreach ($cart->cartfields as $cartfield => $value) {
				if ($cartfield == 'tos') {
					$cart->cartfields['tos'] = 1;
					$cart->setCartIntoSession(true);
					break;
				}
			}
		}

		return;

	}

	/*
	 *
	 */
	function updateCartWithDefaultKCOAddress($cart) {
		$update_dataBT = array();
		$virtuemart_vendor_id = 1;
		$vendorModel = VmModel::getModel('vendor');
		$vendorModel->setId($virtuemart_vendor_id);
		$vendorFields = $vendorModel->getVendorAddressFields($virtuemart_vendor_id);

		foreach ($cart->BTaddress['fields'] as $field) {
			if (!$field['required']) {
				continue;
			}
			if ($field['name'] == 'virtuemart_country_id') {
				// Can only ship to the payment form country
				$update_dataBT[$field['name']] = $this->_currentMethod->purchase_country;
			} elseif ($field['name'] == 'zip') {
				// as a temp value , we put the vendor email
				$update_dataBT[$field['name']] = empty($this->_currentMethod->default_zip) ? '-' : $this->_currentMethod->default_zip;
			} elseif ($field['type'] == 'emailaddress') {
				// as a temp value , we put the vendor email
				$update_dataBT[$field['name']] = $vendorFields['fields'][$field['name']]['value'];
			} elseif ($field['type'] == 'text' and empty($field['value'])) {
				// fields that are text, required, and no default value ie mainly address field, set a default value
				$update_dataBT[$field['name']] = "-";
			} else {
				// any other fields which is not text, but are required will use the default value
				$update_dataBT[$field['name']] = $field['value'];
			}
		}


		$update_dataBT ['address_type'] = 'BT';
		$cart->STsameAsBT = 1;
		$cart->saveAddressInCart($update_dataBT, $update_dataBT['address_type'], TRUE);
		$this->setDefaultKCOEmailInSession($cart->BT['email']);
		return true;
	}


	/**
	 * @return bool|null
	 */
	function plgVmOnPaymentNotification() {

		if (!class_exists('VirtueMartModelOrders')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
		}

		$virtuemart_paymentmethod_id = vRequest::getInt('pm', '');
		$notificationTask = vRequest::getInt('nt', '');
		$validNotificationTasks = array('kco-validation', 'kco-push-uri');
		if (!in_array($notificationTask, $validNotificationTasks)) {
			return NULL;
		}
		if (empty($virtuemart_paymentmethod_id) or !$this->selectedThisByMethodId($virtuemart_paymentmethod_id) or empty($klarna_checkout_uri)) {
			return NULL;
		}
		if (!($this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		$this->debugLog('starting', 'plgVmOnPaymentNotification', 'debug');
		$this->debugLog($_POST, 'plgVmOnPaymentNotification', 'debug');

		$klarna_checkout_uri = vRequest::getString('klarna_order', '');
		if (preg_match("/\/([^\/]+)$/", $klarna_checkout_uri, $match)) {
			$klarna_checkout_id = $match[1];
		} else {
			return NULL;
		}


		sleep(2);


		$this->initKlarnaParams();
		$klarnaCheckoutInterface = $this->_loadKlarnaCheckoutInterface();
		$klarna_checkout_connector = $klarnaCheckoutInterface->getKlarnaConnector();

		$klarna_checkout_order = $klarnaCheckoutInterface->checkoutOrder($klarna_checkout_connector, $klarna_checkout_id);


		$klarna_checkout_order->fetch();
		$this->debugLog('fetch order', 'plgVmOnPaymentNotification', 'debug');

		if ($klarna_checkout_order['status'] != "checkout_complete") {
			$this->debugLog($klarna_checkout_order, 'plgVmOnPaymentNotification Klarna_Checkout_Order', 'debug');
			//return NULL;
		}
		//  find the saved data in payment table
		$vm_payment_data = $this->getDataByKlarnaID($klarna_checkout_id);
		$this->debugLog(var_export($vm_payment_data, true), 'plgVmOnPaymentNotification getDataByKlarnaID', 'debug');
		if ($vm_payment_data == NULL) {
			// will push again later
			// the order was not yet saved, will push again later
			return;
		}

		// send order number to klarna
		$klarna_update['status'] = 'created';
		$klarna_update['merchant_reference'] = array(
			'orderid1' => $vm_payment_data['order_number']
		);
		$klarna_checkout_order->update($klarna_update);

		// update vm payment table
		$db_values['virtuemart_order_id'] = $vm_payment_data['virtuemart_order_id'];
		$db_values['order_number'] = $vm_payment_data['order_number'];
		$db_values['klarna_status'] = $klarna_update['status'];

		$db_values['data'] = json_encode($klarna_update);
		$dbValues['format'] = 'json';
		$this->storePluginInternalData($db_values);
		/*
				// update VM order status and send an email to client
				$modelOrder = VmModel::getModel('orders');
				$order['customer_notified'] = 1;
				$order['order_status'] = $this->_currentMethod->status_checkout_complete;
				$order['comments'] = vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_PAYMENT_STATUS_CONFIRMED', $vm_payment_data['order_number']);
				$modelOrder->updateStatusForOneOrder($vm_payment_data['virtuemart_order_id'], $order, TRUE);
		*/


	}


	function plgVmOnSelfCallFE($type, $name, &$render) {
		if ($name != $this->_name || $type != 'vmpayment') {
			return FALSE;
		}
		$action = vRequest::getCmd('action');
		$virtuemart_paymentmethod_id = vRequest::getInt('virtuemart_paymentmethod_id');
		//Load the method
		if (!($this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}

		$this->debugLog($action, 'plgVmOnSelfCallFE', 'debug');

		switch ($action) {

			case 'updateCartWithKlarnacheckoutAddress':

				$updated = $this->updateCartWithKlarnacheckoutAddress();
				if ($updated) {

				}
				break;
			case 'leaveKlarnaCheckout':
				$this->leaveKlarnaCheckout();
			default:
				//$this->amazonError(vmText::_('VMPAYMENT_AMAZON_INVALID_NOTIFICATION_TASK'));
				return;
		}

	}

	function updateCartWithKlarnacheckoutAddress() {
		if (!class_exists('VirtueMartCart')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		}
		$cart = VirtueMartCart::getCart();

		$updated = false;
		$zip = vRequest::getWord('zip', '');
		$email = vRequest::getWord('email', '');
		$first_name = vRequest::getWord('given_name', '');
		$last_name = vRequest::getWord('family_name', '');

		if ($zip) {
			$cart->BT['zip'] = $zip;
			$updated = true;
		}
		if ($email) {
			$cart->BT['email'] = $email;
			$updated = true;
		}
		if ($first_name) {
			$cart->BT['first_name'] = $first_name;
			$updated = true;
		}
		if ($last_name) {
			$cart->BT['last_name'] = $last_name;
			$updated = true;
		}
		if (!$updated) return $updated;

		$cart->setCartIntoSession();

		return $updated;
	}

	function updateBTSTAddressInCart($cart, $klarna_checkout_order) {

		$this->updateAddressInCart($cart, $klarna_checkout_order['billing_address'], 'BT');
		$this->updateAddressInCart($cart, $klarna_checkout_order['shipping_address'], 'ST');

	}

	function updateAddressInCart($cart, $klarna_address, $address_type) {


		if ($address_type == 'BT') {
			$prefix = '';
			$vmAddress = $cart->BT;
		} else {
			$prefix = 'shipto_';
			$vmAddress = $cart->ST;
		}
		$this->debugLog($klarna_address, 'updateAddressInCart', 'debug');

		// Update the Shipping Address to what is specified in the register.
		$update_data = array(
			$prefix . 'address_type_name' => 'klarnacheckout',
			$prefix . 'company' => isset($klarna_address['company_name']) ? $klarna_address['company_name'] : '',
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
			$update_data ['email'] = strtolower($klarna_address['email']);
		}
		$update_data ['tos'] = 1;
		if (!empty($st)) {
			$update_data = array_merge($vmAddress, $update_data);
		}
		$cart->saveAddressInCart($update_data, $update_data['address_type'], TRUE, $prefix);
	}

	function getKlarnaData($klarna_order) {
		$push_params = $this->getKlarnaDisplayParams();
		foreach ($push_params as $key => $value) {
			$klarna_data[$key] = $klarna_order[$key];
		}

		return $klarna_data;

	}

	function getKlarnaDisplayParams() {
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
	 * @param $virtuemart_paymentmethod_id
	 * @param $paymentCurrencyId
	 * @return bool|null
	 */
	function plgVmgetEmailCurrency($virtuemart_paymentmethod_id, $virtuemart_order_id, &$emailCurrencyId) {

		if (!($this->method = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->method->payment_element)) {
			return FALSE;
		}
		if (!($payments = $this->getDatasByOrderId($virtuemart_order_id))) {
			return '';
		}
		if (empty($payments[0]->email_currency)) {
			$vendorId = 1; //VirtueMartModelVendor::getLoggedVendor();
			$db = JFactory::getDBO();
			$q = 'SELECT   `vendor_currency` FROM `#__virtuemart_vendors` WHERE `virtuemart_vendor_id`=' . $vendorId;
			$db->setQuery($q);
			$emailCurrencyId = $db->loadResult();
		} else {
			$emailCurrencyId = $payments[0]->email_currency;
		}

	}

	/**
	 * @param $virtuemart_paymentmethod_id
	 * @param $paymentCurrencyId
	 * @return bool|null
	 */
	function plgVmgetPaymentCurrency($virtuemart_paymentmethod_id, &$paymentCurrencyId) {

		if (!($this->method = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->method->payment_element)) {
			return FALSE;
		}
		$this->getPaymentCurrency($this->method);
		$paymentCurrencyId = $this->method->payment_currency;
	}

	/**
	 * @param $virtuemart_order_id
	 * @param $payment_method_id
	 * @return null|string
	 */
	function plgVmOnShowOrderBEPayment($virtuemart_order_id, $payment_method_id) {
		if (!$this->selectedThisByMethodId($payment_method_id)) {
			return NULL; // Another method was selected, do nothing
		}
		if (!($this->_currentMethod = $this->getVmPluginMethod($payment_method_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!($payments = $this->getDatasByOrderId($virtuemart_order_id))) {
			// JError::raiseWarning(500, $db->getErrorMsg());
			return '';
		}
		$this->initKlarnaParams();
		$klarnaCheckoutInterface = $this->_loadKlarnaCheckoutInterface();

		$html = '<table class="adminlist table" width="50%">' . "\n";
		$html .= $this->getHtmlHeaderBE();
		$first = TRUE;


		$code = "klarna";
		$prefix = "KLARNACHECKOUT_";
		foreach ($payments as $payment) {
			if ($payment->klarna_status != 'created') {
				$html .= '<tr class="row1"><td>' . JText::_('VMPAYMENT_KLARNACHECKOUT_DATE') . '</td><td align="left">' . $payment->created_on . '</td></tr>';
				// Now only the first entry has this data when creating the order
				if ($first) {
					$html .= $this->getHtmlRowBE('KLARNACHECKOUT_PAYMENT_NAME', $payment->payment_name);
					// keep that test to have it backwards compatible. Old version was deleting that column  when receiving an IPN notification
					if ($payment->payment_order_total and $payment->payment_order_total != 0.00) {
						$html .= $this->getHtmlRowBE('KLARNACHECKOUT_PAYMENT_ORDER_TOTAL', $payment->payment_order_total . " " . shopFunctions::getCurrencyByID($payment->payment_currency, 'currency_code_3'));
					}
					if (!empty($payment->email_currency) and $payment->email_currency != 0) {
						$html .= $this->getHtmlRowBE('KLARNACHECKOUT_PAYMENT_EMAIL_CURRENCY', shopFunctions::getCurrencyByID($payment->email_currency, 'currency_code_3'));
					}
					$first = FALSE;
				}


				if ($payment->action) {
					$display_action = 'onShowOrderBE_' . $payment->action;
					$row_html = $this->$display_action($payment);
					if ($row_html) {
						//$html .= '<tr class="row1"><td>' . vmText::_('VMPAYMENT_KLARNACHECKOUT_DATE') . '</td><td align="left">' . $payment->created_on . '</td></tr>';
						$html .= $row_html;
					}
				} else {

					// TODO go though the SQL table to have the fields in the correct order
					foreach ($payment as $key => $value) {
						// only displays if there is a value or the value is different from 0.00 and the value

						if ($value) {
							if (substr($key, 0, strlen($code)) == $code) {
								$html .= $this->getHtmlRowBE($prefix . $key, $value);
							}
						}
					}
				}
			}
		}
		$html .= '</table>' . "\n";
		return $html;

	}

	function onShowOrderBE_activate($payment) {
		if (!class_exists('VirtueMartModelOrders')) {
			require(VMPATH_ADMIN . DS . 'models' . DS . 'orders.php');
		}
		$html = $this->getHtmlRowBE(vmText::_('VMPAYMENT_KLARNACHECKOUT_STATUS'), $payment->klarna_status);
		$activate_data = $this->getStoredData($payment);

		$html .= $this->getHtmlRowBE(vmText::_('VMPAYMENT_KLARNACHECKOUT_INVOICE_NUMBER'), $activate_data->InvoiceNumber);
		if (!empty($activate_data->InvoicePdf)) {

			$invoicePdfLink = $this->getInvoicePdfLink($payment->virtuemart_order_id);
			$value = '<a target="_blank" href="' . $invoicePdfLink . '">' . vmText::_('VMPAYMENT_KLARNACHECKOUT_VIEW_INVOICE') . '</a>';

			$html .= $this->getHtmlRowBE("", $value);
		}
		return $html;
	}

	function onShowOrderBE_update($payment) {
		$html = $this->getHtmlRowBE(vmText::_('VMPAYMENT_KLARNACHECKOUT_STATUS'), $payment->klarna_status);

		return $html;

	}

	function onShowOrderBE_cancelReservation($payment) {

		return $this->getHtmlRowBE(vmText::_('VMPAYMENT_KLARNACHECKOUT_STATUS'), $payment->klarna_status);
	}

	/**
	 * @param $type
	 * @param $name
	 * @param $render
	 */
	function plgVmOnSelfCallBE($type, $name, &$render) {
		if ($name != $this->_name || $type != 'vmpayment') {
			return FALSE;
		}
		// fetches PClasses From XML file
		$call = vRequest::getWord('call');
		$this->$call();
		// 	jexit();
	}


	function onShowOrderBE_createOrder($payment) {
		// we don't need to show that to merchant
		return;
		if ($this->_currentMethod->debug) {
			$show_fields = array("display", "debug");
		} else {
			$show_fields = array("display");
		}
		if (empty($payment->data)) {
			$html = "<tr>\n<td class='key' >" . vmText::_('id') . "</td>\n <td align='left'>" . 'ERROR NO DATA' . "</td>\n</tr>\n";

		} else {
			$klarna_order = $this->getStoredData($payment);
			//$klarna_order =  ($payment->data);
			$push_params = $this->getKlarnaDisplayParams();
			$html = '';
			$lang = JFactory::getLanguage();
			foreach ($push_params as $key => $value) {
				if (in_array($value, $show_fields)) {
					$display_value = isset($klarna_order->$key) ? $klarna_order->$key : "???";
					$text_key = strtoupper('VMPAYMENT_KLARNACHECKOUT_' . $key);
					if ($lang->hasKey($text_key)) {
						$text = vmText::_('VMPAYMENT_KLARNACHECKOUT_' . $key);
					} else {
						$text = $key;
					}
					if (!is_array($display_value)) {
						$html .= "<tr>\n<td class='key' >" . $text . "</td>\n <td align='left'>" . $display_value . "</td>\n</tr>\n";
					} else {
						$html .= "<tr>\n<td class='key' ><strong>" . $text . "</strong></td>\n <td align='left'></td>\n</tr>\n";

						foreach ($klarna_order->$key as $order_key => $order_value) {
							$text_key = strtoupper('VMPAYMENT_KLARNACHECKOUT_' . $order_key);

							if ($lang->hasKey($text_key)) {
								$text = vmText::_('VMPAYMENT_KLARNACHECKOUT_' . $order_key);
							} else {
								$text = $order_key;
							}
							if (!is_array($order_value)) {
								$display_order_value = isset($klarna_order->$key->$order_key) ? $klarna_order->$key->$order_key : "????";
								$html .= "<tr>\n<td class='key' >" . $text . "</td>\n <td align='left'>" . $display_order_value . "</td>\n</tr>\n";
							} else {
								$html .= "<tr>\n<td class='key' >" . $text . "</td>\n <td align='left'><pre>" . var_export($klarna_order->$key->$order_key, true) . "</pre></td>\n</tr>\n";
							}
						}
					}

				}
			}
		}

		return $html;

	}


	function getStoredData($payment) {
		if ($payment->format == 'json') {
			$data = (object)json_decode($payment->data, true);
		} elseif ($payment->format == 'none') {
			return $payment;
		} else {
			$data = unserialize($payment->data);
		}
		return $data;
	}

	/**
	 *
	 * Can be usefull for debugging
	 * @param $payment
	 * @return string
	 */
	function onShowOrderBE_storeCart($payment) {
		return NULL;

	}


	/**
	 * Check if the payment conditions are fulfilled for this payment method
	 *
	 * @author: Valerie Isaksen
	 *
	 * @param $cart_prices : cart prices
	 * @param $payment
	 * @return true: if the conditions are fulfilled, false otherwise
	 *
	 */
	protected function checkConditions($cart, $method, $cart_prices) {

		$this->convert($method);

		$address = $cart->BT;

		$amount = $cart_prices['salesPrice'];
		$amount_cond = ($amount >= $method->min_amount AND $amount <= $method->max_amount OR ($method->min_amount <= $amount AND ($method->max_amount == 0)));

		$countries = array();
		if (!empty($method->purchase_country)) {
			if (!is_array($method->purchase_country)) {
				$countries[0] = $method->purchase_country;
			} else {
				$countries = $method->purchase_country;
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
		if ((!empty($address) or $address['virtuemart_country_id'] != 0) and in_array($address['virtuemart_country_id'], $countries) || count($countries) == 0) {
			if ($amount_cond) {
				return TRUE;
			}
		} elseif (empty($address) or $address['virtuemart_country_id'] == 0) {
			if ($amount_cond) {
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 * @param $method
	 */
	function convert($method) {

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
	function plgVmOnStoreInstallPaymentPluginTable($jplugin_id) {

		return $this->onStoreInstallPluginTable($jplugin_id);
	}


	/**
	 * This event is fired after the payment method has been selected. It can be used to store
	 * additional payment info in the cart.
	 *
	 * @author Valérie isaksen
	 *
	 * @param VirtueMartCart $cart : the actual cart
	 * @return null if the payment was not selected, true if the data is valid, error message if the data is not vlaid
	 *
	 */
	public function plgVmOnSelectCheckPayment(VirtueMartCart $cart, &$msg) {

		if (!$this->selectedThisByMethodId($cart->virtuemart_paymentmethod_id)) {
			return NULL;
		}

		$klarnaPaymentMethodActive = $this->getKlarnaPaymentMethodActive();
		if ($klarnaPaymentMethodActive !== false and $klarnaPaymentMethodActive != $cart->virtuemart_paymentmethod_id) {
			$this->clearKlarnaParams($cart);
			return;
		}
		if (!($this->_currentMethod = $this->getVmPluginMethod($cart->virtuemart_paymentmethod_id))) {
			return NULL;
		}
		$cart->prepareAddressFieldsInCart();
		if (empty($cart->BT['email'])) {
			$this->updateCartWithDefaultKCOAddress($cart);
		}
		$cart->prepareCartData();

		$this->updateCartFields($cart);
		$cart->setCartIntoSession();
		if (!$this->initKlarnaParams($this->_currentMethod)) {
			return;
		}
		$klarnaCheckoutInterface = $this->_loadKlarnaCheckoutInterface();

		$klarna_checkout_order = null;

		$klarna_checkout_connector = $klarnaCheckoutInterface->getKlarnaConnector();

		$klarna_checkout_id = $this->getKlarnaCheckoutIdFromSession();
		jimport('joomla.environment.browser');
		$browser = JBrowser::getInstance();
		if ($klarna_checkout_id == null) {

			// Start new session
			$create['purchase_country'] = $this->country_code_2;
			$create['purchase_currency'] = $this->currency_code_3;
			$create['locale'] = $this->locale;

			$create['gui']['layout'] = $browser->isMobile() ? 'mobile' : 'desktop';
			$klarnaCheckoutInterface->getMerchantData($create, $cart);
			$this->getTemplateOptions($create);

			if (!$this->isDefaultKCOemail($cart->BT['email'])) {
				$create['shipping_address']['email'] = $cart->BT['email'];
				$address = (($cart->ST == 0) ? $cart->BT : $cart->ST);
				if (isset($address['zip']) and !empty($address['zip'])) {
					$create['shipping_address']['postal_code'] = $cart->BT['zip'];
				}
			}

			$klarnaCheckoutInterface->getCartItems($cart, $create);
			try {
				$klarna_checkout_order = $klarnaCheckoutInterface->checkoutOrder($klarna_checkout_connector, $klarna_checkout_id);
				$klarna_checkout_order->create($create);
				$klarna_checkout_order->fetch();

			} catch (Exception $e) {
				$this->clearKlarnaParams($cart);
				$admin_msg = $e->getMessage();
				$this->KlarnacheckoutError($admin_msg, vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_ERROR_OCCURRED', $this->_currentMethod->payment_name));
				return NULL;
			}
			$this->setKlarnaParamsInSession($klarnaCheckoutInterface->getCheckoutOrderId($klarna_checkout_order), $cart->virtuemart_paymentmethod_id, $cart->BT);


		}
		if ($this->_currentMethod->payment_form_position == 'specific') {
			$this->setCartLayout($cart, true);
		}

		return true;
	}

	private function setCartLayout($cart, $intoSession = true) {
		if (!class_exists('VmConfig')) {
			require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'config.php');
		}
		VmConfig::loadConfig();
		$olgConfig = VmConfig::get('oncheckout_opc', true);
		VmConfig::set('oncheckout_opc', true);
		$cart->layoutPath = vmPlugin::getTemplatePath($this->_name, 'payment', 'cart');
		$cart->layout = 'cart';
		if ($intoSession) {
			$cart->setCartIntoSession();
		}

	}

	/**
	 * @param VirtueMartCart $cart
	 * @param array $cart_prices
	 * @param                $cart_prices_name
	 * @return bool|null
	 */

	public function plgVmOnSelectedCalculatePricePayment(VirtueMartCart $cart, array &$cart_prices, &$cart_prices_name) {

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
	function plgVmOnCheckAutomaticSelectedPayment(VirtueMartCart $cart, array $cart_prices = array(), &$paymentCounter) {

		return $this->onCheckAutomaticSelected($cart, $cart_prices, $paymentCounter);

	}

	/**
	 * This method is fired when showing the order details in the frontend.
	 * It displays the method-specific data.
	 *
	 * @param integer $order_id The order ID
	 * @return mixed Null for methods that aren't active, text (HTML) otherwise
	 * @author Valerie Isaksen
	 */
	public function plgVmOnShowOrderFEPayment($virtuemart_order_id, $virtuemart_paymentmethod_id, &$payment_name) {

		$this->onShowOrderFE($virtuemart_order_id, $virtuemart_paymentmethod_id, $payment_name);
	}


	/**
	 * This method is fired when showing when priting an Order
	 * It displays the the payment method-specific data.
	 *
	 * @param integer $_virtuemart_order_id The order ID
	 * @param integer $method_id method used for this order
	 * @return mixed Null when for payment methods that were not selected, text (HTML) otherwise
	 * @author Valerie Isaksen
	 */
	function plgVmonShowOrderPrintPayment($order_number, $method_id) {

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
	public function plgVmOnUpdateOrderPayment(&$order, $old_order_status) {

		// get latest info from DB
		/*if (!$this->selectedThisByMethodId($order->virtuemart_paymentmethod_id)) {
			return NULL; // Another method was selected, do nothing
		}*/

		if (!($this->_currentMethod = $this->getVmPluginMethod($order->virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}

		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			return NULL;
		}

		if (!($payments = $this->getDatasByOrderId($order->virtuemart_order_id))) {
			return NULL;
		}

		//plgVmPaymentKlarnaCheckout::includeKlarnaFiles();
		$new_order_status = $order->order_status;
		$lastPayment = $payments[(count($payments)) - 1];
		$klarna_status = $lastPayment->klarna_status;
		$actions = array('activate', 'cancelReservation', 'changeReservation', 'creditInvoice');
		foreach ($actions as $action) {
			$status = 'status_' . $action;
			//$this->KlarnacheckoutError($action.' '.$this->method->$status.' '.$new_order_status);

			if ($this->_currentMethod->$status == $new_order_status and $this->authorizedAction($klarna_status, $new_order_status, $old_order_status, $action, $this->_currentMethod)) {
				$this->$action($order, $payments);
				return true;
			}
		}
		// may be it is another new order status unknown?
		// TO DO ... how can we disply that when not in push
		//$this->KlarnacheckoutError(vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_ACTION_NOT_AUTHORIZED', $new_order_status, $lastPayment->klarna_status), vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_ERROR_OCCURRED', $this->method->payment_name));
		//$this->debugLog(vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_ACTION_NOT_AUTHORIZED', $action, $lastPayment->klarna_status), 'plgVmOnUpdateOrderPayment', 'debug');


		// true means plugin call was successfull
		return true;
	}

	function authorizedAction($klarna_status, $new_order_status, $old_order_status, $action) {
		if ($old_order_status == $this->_currentMethod->status_checkout_complete) {
			$authorize = array(
				'cancelReservation' => $this->_currentMethod->status_cancelReservation,
				'changeReservation' => $this->_currentMethod->status_changeReservation,
				'activate' => $this->_currentMethod->status_activate,
			);
			if (in_array($new_order_status, $authorize)) {
				return TRUE;
			}
		} elseif ($old_order_status == $this->_currentMethod->status_activate) {
			$authorize = array(
				'creditInvoice' => $this->_currentMethod->status_creditInvoice,
				'returnAmount' => $this->_currentMethod->status_returnAmount,
				'creditPart' => $this->_currentMethod->status_creditPart,
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
	function activate($order, $payments) {
		$rno = $this->getReservationNumber($payments);


		if (!$rno) {
			return; // error already sent
		}
		// TO DO ASK KLARNA ABOUT KLARNA MODE
		//$mode = KlarnaHandler::getKlarnaMode($method,  $this->getPurchaseCountry($method));
		//$ssl = KlarnaHandler::getKlarnaSSL($mode);
		// Instantiate klarna object.
		$this->initKlarnaParams($this->_currentMethod);
		$klarnaCheckoutInterface = $this->_loadKlarnaCheckoutInterface();

		$klarna = new Klarna_virtuemart();
		$klarna->config($this->merchantid, $this->sharedsecret, $this->country_code_3, NULL, $this->currency_code_3, $this->mode, VMKLARNA_PC_TYPE, KlarnaHandler::getKlarna_pc_type(), $this->ssl);
		$modelOrder = VmModel::getModel('orders');

		try {
			$return = $klarna->activate($rno);
			if ($return[0] == 'ok') {
				VmInfo(vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_ACTIVATE_RESERVATION', $rno));
				$vm_invoice_name = '';
				$invoice_number = $return[1];
				$invoiceURL = $this->getInvoice($invoice_number, $vm_invoice_name);

				$history = array();
				$history['customer_notified'] = 0;
				$history['order_status'] = $this->_currentMethod->status_activate;
				$history['comments'] = vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_PAYMENT_STATUS_ACTIVATE', $rno); // $order['details']['BT']->order_number);
				$modelOrder->updateStatusForOneOrder($order->virtuemart_order_id, $history, TRUE);

				$dbValues['order_number'] = $order->order_number;
				$dbValues['virtuemart_order_id'] = $order->virtuemart_order_id;
				$dbValues['payment_name'] = '';
				$dbValues['virtuemart_paymentmethod_id'] = $payments[0]->virtuemart_paymentmethod_id;
				$dbValues['action'] = 'activate';
				$dbValues['klarna_status'] = 'activate';
				$data["InvoiceNumber"] = $invoice_number;
				$data["InvoicePdf"] = $invoiceURL;
				$dbValues['format'] = 'json';
				$dbValues['data'] = json_encode($data);


				$values = $this->storePSPluginInternalData($dbValues);

			} else {
				$this->KlarnacheckoutError('activate returned KO', vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_ERROR_OCCURRED', $this->method->payment_name));
			}

		} catch (Exception $e) {
			$this->KlarnacheckoutError($e->getMessage(), vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_ERROR_OCCURRED', $this->method->payment_name));
			$this->debugLog($e->getMessage(), 'activate', 'debug');

			return FALSE;
		}


		return true;
	}

	/**
	 *
	 */
	function cancelReservation($order, $payments) {
		$rno = $this->getReservationNumber($payments);
		if (!$rno) {
			return; // error already sent
		}
		$this->initKlarnaParams($this->_currentMethod);
		$klarnaCheckoutInterface = $this->_loadKlarnaCheckoutInterface();

		$klarna = new Klarna_virtuemart();
		$klarna->config($this->merchantid, $this->sharedsecret, $this->country_code_3, NULL, $this->currency_code_3, $this->mode, VMKLARNA_PC_TYPE, KlarnaHandler::getKlarna_pc_type(), $this->ssl);
		$modelOrder = VmModel::getModel('orders');

		try {
			$result = $klarna->cancelReservation($rno);
			$info = vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_RESERVATION_CANCELED', $rno);
			VmInfo($info);
			$history = array();
			$history['customer_notified'] = 1;
			//$history['order_status'] = $this->method->checkout_complete;
			$history['comments'] = $info; // $order['details']['BT']->order_number);
			$modelOrder->updateStatusForOneOrder($order->virtuemart_order_id, $history, TRUE);

			$dbValues['order_number'] = $order->order_number;
			$dbValues['virtuemart_order_id'] = $order->virtuemart_order_id;
			$dbValues['payment_name'] = '';
			$dbValues['virtuemart_paymentmethod_id'] = $payments[0]->virtuemart_paymentmethod_id;
			$dbValues['action'] = 'cancelReservation';
			$dbValues['klarna_status'] = 'cancelReservation';
			$dbValues['data'] = $info;
			$dbValues['format'] = 'none';
			$this->debugLog($dbValues, 'storePSPluginInternalData cancelReservation', 'debug');

			$values = $this->storePSPluginInternalData($dbValues);

		} catch (Exception $e) {
			$error = $e->getMessage();
			$this->KlarnacheckoutError($e->getMessage(), vmText::sprintf('VMPAYMENT_KLARNACHECKOUT_ERROR_OCCURRED', $this->_currentMethod->payment_name));
			$this->debugLog($e->getMessage(), 'cancelReservation', 'debug');

			return FALSE;
		}


		//$dbValues['data'] = $vm_invoice_name;

		return true;
	}

	function changeReservation() {

	}

	function creditInvoice() {

	}

	function creditPart() {

	}

	function getReservationNumber($payments) {
		foreach ($payments as $payment) {
			if ($payment->klarna_status == "checkout_complete") {
				$klarna_order = $this->getStoredData($payment);
				// BC
				if (isset($klarna_order->reservation)) {
					return $klarna_order->reservation;
				} else {
					return $klarna_order->klarna_reservation;
				}
			}
		}
		$this->KlarnacheckoutError('VMPAYMENT_KLARNACHECKOUT_ERROR_NO_RNO', 'VMPAYMENT_KLARNACHECKOUT_ERROR_NO_RNO');
		return null;
	}

	/**
	 * @param $orderDetails
	 */
	function plgVmOnUserOrder(&$orderDetails) {
		// the order has not been created, the payment table has not been updated
		return;
		if (!($this->_currentMethod = $this->getVmPluginMethod($orderDetails->virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			return NULL;
		}
		$klarna_checkout_uri = vRequest::getString('klarna_order', '');
		if (preg_match("/\/([^\/]+)$/", $klarna_checkout_uri, $match)) {
			$klarna_checkout_id = $match[1];
		} else {
			return NULL;
		}
		if (!($payment = $this->getDataByKlarnaID($klarna_checkout_id))) {
			return NULL;
		}
		if ($payment->klarna_status == "checkout_complete") {
			$orderDetails->order_number = $payment->klarna_reservation;
		}

		return NULL;

	}

	/**
	 * @param $orderDetails
	 * @param $data
	 * @return null
	 */
	/*
	function plgVmOnUserInvoice($orderDetails, &$data)
	{

		if (!($this->method = $this->getVmPluginMethod($orderDetails['virtuemart_paymentmethod_id']))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->method->payment_element)) {
			return NULL;
		}

		$data['invoice_number'] = 'reservedByPayment_' . $orderDetails['order_number']; // Never send the invoice via email
	}
*/
	/**
	 * Save updated orderline data to the method specific table
	 *
	 * @param array $_formData Form data
	 * @return mixed, True on success, false on failures (the rest of the save-process will be
	 * skipped!), or null when this method is not actived.
	 */
	public function plgVmOnUpdateOrderLine($_formData) {
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
	 *
	 * public function plgVmOnEditOrderLineBE(  $_orderId, $_lineId) {
	 * return null;
	 * }
	 */

	/**
	 * This method is fired when showing the order details in the frontend, for every orderline.
	 * It can be used to display line specific package codes, e.g. with a link to external tracking and
	 * tracing systems
	 *
	 * @param integer $_orderId The order ID
	 * @param integer $_lineId
	 * @return mixed Null for method that aren't active, text (HTML) otherwise
	 *
	 * public function plgVmOnShowOrderLineFE(  $_orderId, $_lineId) {
	 * return null;
	 * }
	 */
	function plgVmDeclarePluginParamsPaymentVM3(&$data) {
		return $this->declarePluginParams('payment', $data);
	}

	/**
	 * @param $name
	 * @param $id
	 * @param $table
	 * @return bool
	 */
	function plgVmSetOnTablePluginParamsPayment($name, $id, &$table) {

		return $this->setOnTablePluginParams($name, $id, $table);
	}


	/**
	 * @return mixed
	 */
	function _getVendorCurrencyId() {

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
	static function includeKlarnaFiles() {


		require(VMPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarna' . DS . 'klarna' . DS . 'helpers' . DS . 'define.php');

		if (!class_exists('KlarnaHandler')) {
			require(JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'helpers' . DS . 'klarnahandler.php');
		}
		if (!class_exists('klarna_virtuemart')) {
			require(JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'helpers' . DS . 'klarna_virtuemart.php');
		}
		require_once(JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'api' . DS . 'transport' . DS . 'xmlrpc-3.0.0.beta' . DS . 'lib' . DS . 'xmlrpc.inc');
		require_once(JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'api' . DS . 'transport' . DS . 'xmlrpc-3.0.0.beta' . DS . 'lib' . DS . 'xmlrpc_wrappers.inc');


	}

	/**
	 * @param $klarna_invoice_pdf
	 * @param $vm_invoice_name
	 * @return bool
	 */
	function getInvoice($invoice_number, &$vm_invoice_name) {


		//$klarna_invoice = explode ('/', $klarna_invoice_pdf);
		if ($this->_currentMethod->server == 'live') {
			$klarna_invoice_name = "https://online.klarna.com/packslips/" . $invoice_number . '.pdf';
		} else {
			$klarna_invoice_name = "https://online.testdrive.klarna.com/packslips/" . $invoice_number . '.pdf';
		}

		$vm_invoice_name = 'klarna_' . $invoice_number . '.pdf';

		return $klarna_invoice_name;
	}

	/**
	 * @return int|null|string
	 */
	function getInvoicePdfLink($virtuemart_order_id) {

		if (!class_exists('VirtueMartModelOrders')) {
			require(VMPATH_ADMIN . DS . 'models' . DS . 'orders.php');
		}

		if (!class_exists('JFile')) {
			require(JPATH_SITE . DS . 'libraries' . DS . 'joomla' . DS . 'filesystem' . DS . 'file.php');
		}


		if (!($payments = $this->getDatasByOrderId($virtuemart_order_id))) {
			return '';
		}
		foreach ($payments as $payment) {
			if ($payment->klarna_status == 'activate') {
				$data = $this->getStoredData($payment);
				$path = VmConfig::get('forSale_path', 0);
				$path .= 'invoices' . DS;
				$fileName = $data->InvoicePdf;
				break;
			}
		}


		return $fileName;
	}

	function KlarnacheckoutError($admin_msg, $public_msg = '') {
		if ($this->_currentMethod->debug) {
			$public_msg = $admin_msg;
		}
		vmError($admin_msg, $public_msg);
	}

	function getDataByKlarnaID($klarna_id) {

		$db = JFactory::getDBO();
		$q = 'SELECT * FROM `' . $this->_tablename . '` WHERE `klarna_id` = \'' . $klarna_id . '\'';
		$db->setQuery($q);
		$paymentData = $db->loadAssoc();
		$this->debugLog($q, 'getDataByKlarnaID', 'debug');
		$this->debugLog(var_export($paymentData, true), 'getDataByKlarnaID', 'debug');

		return $paymentData;
	}


}


// No closing tag
