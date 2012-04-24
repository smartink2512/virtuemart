<?php

defined('_JEXEC') or die();

/**
 *
 * Klarna
 * @author Val√©rie Isaksen
 * @version $Id:
 * @package VirtueMart
 * @subpackage payment
 * @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */
if (!class_exists('vmPSPlugin'))
require(JPATH_VM_PLUGINS . DS . 'vmpsplugin.php');

if (JVM_VERSION === 2) {
	require ( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarna' . DS . 'klarna' . DS . 'helpers' . DS . 'define.php');
} else {
	require ( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarna' . DS . 'helpers' . DS . 'define.php');
}
if (!class_exists('Klarna'))
require (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'api' . DS . 'klarna.php');
if (!class_exists('klarna_virtuemart'))
require (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'helpers' . DS . 'klarna_virtuemart.php');
if (!class_exists('PCStorage'))
require (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'api' . DS . 'pclasses' . DS . 'storage.intf.php');

if (!class_exists('KlarnaConfig'))
require (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'api' . DS . 'klarnaconfig.php');
if (!class_exists('KlarnaPClass'))
require (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'api' . DS . 'klarnapclass.php');
if (!class_exists('KlarnaCalc'))
require (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'api' . DS . 'klarnacalc.php');

if (!class_exists('KlarnaHandler'))
require (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'helpers' . DS . 'klarnahandler.php');


require_once (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'api' . DS . 'transport' . DS . 'xmlrpc-3.0.0.beta' . DS . 'lib' . DS . 'xmlrpc.inc');
require_once (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'api' . DS . 'transport' . DS . 'xmlrpc-3.0.0.beta' . DS . 'lib' . DS . 'xmlrpc_wrappers.inc');

if (is_file(VMKLARNA_CONFIG_FILE))
require_once (VMKLARNA_CONFIG_FILE);

class plgVmPaymentKlarna extends vmPSPlugin {

	// instance of class
	public static $_this = false;
	var $_vendor_currency = '';

	function __construct(& $subject, $config) {

		parent::__construct($subject, $config);

		$this->_loggable = true;
		$this->tableFields = array_keys($this->getTableSQLFields());
		$this->_tablepkey = 'id';
		$this->_tableId = 'id';
		$varsToPush = $this->getVarsToPush();
		$this->setConfigParameterable($this->_configTableFieldName, $varsToPush);
		// Get vendor currency ???
		$this->_vendor_currency = $this->_getVendorCurrency();

		$jlang = JFactory::getLanguage();
		$jlang->load('plg_vmpayment_klarna', JPATH_ADMINISTRATOR, 'en-GB', true);
		$jlang->load('plg_vmpayment_klarna', JPATH_ADMINISTRATOR, $jlang->getDefault(), true);
		$jlang->load('plg_vmpayment_klarna', JPATH_ADMINISTRATOR, null, true);
	}

	public function getVmPluginCreateTableSQL() {

		return $this->createTableSQL('Payment Klarna Table');
	}

	function getTableSQLFields() {

		$SQLfields = array(
	    'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT',
	    'virtuemart_order_id' => 'int(1) UNSIGNED',
	    'order_number' => ' char(64)',
	    'virtuemart_paymentmethod_id' => 'mediumint(1) UNSIGNED',
	    'payment_name' => 'varchar(5000)',
	    'payment_order_total' => 'decimal(15,5) NOT NULL DEFAULT \'0.00000\'',
	    'payment_fee' => 'decimal(10,2)',
	    'tax_id' => 'smallint(1)',
	    'klarna_eid' => 'int(10)',
	    'klarna_status_code' => 'tinyint(4)',
	    'klarna_status_text' => 'varchar(255)',
	    'klarna_invoice_no' => 'varchar(255)',
	    'klarna_log' => 'varchar(255)',
	    'klarna_pclass' => 'int(1)',
	    'klarna_pdf_invoice_url' => 'varchar(512)',
		);
		return $SQLfields;
	}

	function plgVmDeclarePluginParamsPayment($name, $id, &$data) {
		return $this->declarePluginParams('payment', $name, $id, $data);
	}

	function plgVmSetOnTablePluginParamsPayment($name, $id, &$table) {

		return $this->setOnTablePluginParams($name, $id, $table);
	}

	function plgVmOnProductDisplayPayment($product, &$productDisplay) {

		$vendorId = 1;
		if ($this->getPluginMethods($vendorId) === 0) {
			return false;
		}
		if (!class_exists('klarna_productPrice'))
		require (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'helpers' . DS . 'klarna_productprice.php');

		if (!class_exists('VirtueMartCart'))
		require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		$cart = VirtueMartCart::getCart();

		$html = array();
		foreach ($this->methods as $method) {
			//if (in_array('klarna_partpay', (array) $method->klarna_modules)) {
			$productPrice = new klarna_productPrice($method, $product, $cart);
			//vmdebug('plgVmOnProductDisplayPayment', $product);
			$productDisplay [] = $productPrice->showProductPrice($product);
			// }
		}
		JHTML::stylesheet('style.css', VMKLARNAPLUGINWEBROOT . '/klarna/assets/css/', false);
		return true;
	}

	/*
	 * TODO: check if ST or BT address
	*/

	function _getCartAddressCountryCode(VirtueMartCart $cart = null, &$countryCode, &$countryId, $fld = 'country_3_code') {
		if ($cart == '') {
			if (!class_exists('VirtueMartCart'))
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
			$cart = VirtueMartCart::getCart();
		}
		$address = (($cart->ST == 0 or empty($cart->ST)) ? $cart->BT : $cart->ST);
		if (!isset($address['virtuemart_country_id']) or empty($address['virtuemart_country_id'])) {
			if ($fld == 'country_3_code') {
				$countryCode = 'swe';
			} else {
				$countryCode = 'se';
			}
			$countryId = ShopFunctions::getCountryIDByName($countryCode);
		} else {
			$countryId = $address['virtuemart_country_id'];
			$countryCode = shopFunctions::getCountryByID($address['virtuemart_country_id'], $fld);
		}
	}

	function _getCartAddressCountryId(VirtueMartCart $cart, $fld = 'country_3_code') {

		$address = (($cart->ST == 0 or empty($cart->ST)) ? $cart->BT : $cart->ST);
		if (!isset($address['virtuemart_country_id'])) {
			return null;
		}

		return $address['virtuemart_country_id'];
	}

	/*
	 * TODO: check if ST or BT address
	*/

	function getCountryCodeByOrderId($virtuemart_order_id, $fld = 'country_3_code') {
		$db = JFactory::getDBO();
		$q = 'SELECT `virtuemart_country_id`,  `address_type` FROM #__virtuemart_order_userinfos  WHERE virtuemart_order_id=' . $virtuemart_order_id;

		$db->setQuery($q);
		$results = $db->loadObjectList();
		if (count($results) == 1) {
			$virtuemart_country_id = $results[0]->virtuemart_country_id;
		} else {
			foreach ($results as $result) {
				if ($result->address_type == 'ST') {
					$virtuemart_country_id = $result->virtuemart_country_id;
					break;
				}
			}
		}


		return shopFunctions::getCountryByID($virtuemart_country_id, $fld);
	}

	/**
	 * plgVmDisplayListFEPayment
	 * This event is fired to display the pluginmethods in the cart (edit shipment/payment) for exampel
	 *
	 * @param object $cart Cart object
	 * @param integer $selected ID of the method selected
	 * @return boolean True on succes, false on failures, null when this plugin was not selected.
	 * On errors, JError::raiseWarning (or JError::raiseError) must be used to set a message.
	 *
	 * @author Valerie Isaksen
	 */
	public function plgVmDisplayListFEPayment(VirtueMartCart $cart, $selected = 0, &$htmlIn) {

		$html = $this->displayListFEPayment($cart);
		if (!empty($html)) {
			$htmlIn[] = $html;
		}
	}

	/*
	 * @param $plugin plugin
	*/

	protected function displayListFEPayment(VirtueMartCart $cart) {
		if (!class_exists('Klarna_payments'))
		require (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'helpers' . DS . 'klarna_payments.php');
		if (!class_exists('KlarnaVm2API'))
		require (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'helpers' . DS . 'klarna_vm2api.php');
		if ($this->getPluginMethods($cart->vendorId) === 0) {
			if (empty($this->_name)) {
				$app = JFactory::getApplication();
				$app->enqueueMessage(JText::_('COM_VIRTUEMART_CART_NO_' . strtoupper($this->_psType)));
				return false;
			} else {
				return false;
			}
		}

		$html = array();
		$method_name = $this->_psType . '_name';
		foreach ($this->methods as $method) {
			$temp = $this->getListFEPayment($cart, $method);
			if (!empty($temp)) {
				$html[] = $temp;
			}
		}
		if (!empty($html)) {
			$this->loadScriptAndCss();
		}
		return $html;
	}

	/*
	 * @param $plugin plugin
	*/

	protected function getListFEPayment(VirtueMartCart $cart, $method) {

		$currency_code = ShopFunctions::getCurrencyByID($cart->pricesCurrency, 'currency_code_3');
		$this->_getCartAddressCountryCode($cart, $country_code, $countryId);
		if (!( $countrySettings = $this->checkCountryCondition($method, $country_code, $cart) )) {
			return null;
		}

		$pclasses = KlarnaHandler::getPClasses(null, $country_code, KlarnaHandler::getKlarnaMode($method), $countrySettings);
		$this->getNbPClasses($pclasses, $speccamp, $partpay);
		$sessionKlarnaData = $this->getKlarnaSessionData();

		$klarna_paymentmethod = "";
		if (isset($sessionKlarnaData->KLARNA_DATA['klarna_paymentmethod'])) {
			$klarna_paymentmethod = $sessionKlarnaData->KLARNA_DATA['klarna_paymentmethod'];
		}
		$min_amount = 'klarna_min_amount_part_' . strtolower($countrySettings['country_code_3']);

		if ($cart->pricesUnformatted['salesPrice'] <= $method->$min_amount OR !empty($method->$min_amount)) {
			$partpay = 0;
		}
		$html = '';

		$payments = new klarna_payments($method, $countrySettings['country_code_3'], $cart);
		$klarna_pm = $payments->invoice($method);
		$html .= $this->renderByLayout('displaypayment', array('klarna_pm' => $klarna_pm, 'virtuemart_paymentmethod_id' => $method->virtuemart_paymentmethod_id, 'klarna_paymentmethod' => $klarna_paymentmethod));
		if ($partpay > 0) {
			if ($klarna_pm = $payments->partPay($method, $cart)) {
				$html .= $this->renderByLayout('displaypayment', array('klarna_pm' => $klarna_pm, 'virtuemart_paymentmethod_id' => $method->virtuemart_paymentmethod_id, 'klarna_paymentmethod' => $klarna_paymentmethod));
			}
		}
		if ($speccamp > 0) {
			if ($klarna_pm = $payments->specCamp($method, $cart)) {
				$html .= $this->renderByLayout('displaypayment', array('klarna_pm' => $klarna_pm, 'virtuemart_paymentmethod_id' => $method->virtuemart_paymentmethod_id, 'klarna_paymentmethod' => $klarna_paymentmethod));
			}
		}

		$html_js = '<script type="text/javascript">
            setTimeout(\'jQuery(":radio[value=' . $klarna_paymentmethod . ']").click();\', 200);
        </script>';

		// TO DO add html:
		$pluginHtml = $html . $html_js;

		return $pluginHtml;
	}

	function getNbPClasses($pclasses, &$speccamp, &$partpay) {

		$speccamp = 0;
		$partpay = 0;
		foreach ($pclasses as $pclass) {
			if ($pclass->getType() == KlarnaPClass::SPECIAL)
			$speccamp += 1;
			if ($pclass->getType() == KlarnaPClass::CAMPAIGN ||
			$pclass->getType() == KlarnaPClass::ACCOUNT ||
			$pclass->getType() == KlarnaPClass::FIXED ||
			$pclass->getType() == KlarnaPClass::DELAY)
			$partpay += 1;
		}
	}

	function getKlarnaSessionData() {
		$session = JFactory::getSession();
		$sessionKlarna = $session->get('Klarna', 0, 'vm');
		if ($sessionKlarna) {
			$sessionKlarnaData = unserialize($sessionKlarna);
			return $sessionKlarnaData;
		}
		return null;
	}

	function checkCountryCondition($method, $country_code, $cart) {

		$active_country = "klarna_active_" . strtolower($country_code);
		if (!isset($method->$active_country) or !$method->$active_country) {
			return false;
		}
		if (empty($country_code)) {
			$app = JFactory::getApplication();
			$msg = JText::_('VMPAYMENT_KLARNA_GET_SWEDISH_ADDRESS');
			$country_code = "swe";
			vmWarn($msg);
			//return false;
		}
		// convert price in euro
		$currency = CurrencyDisplay::getInstance();
		//$euro_currency_id = ShopFunctions::getCurrencyByName( 'EUR');
		$price = KlarnaHandler::convertPrice($cart->pricesUnformatted['salesPrice'], 'EUR');

		if (strtolower($country_code) == 'nld' && $price > 250) {
			// We can't show our payment options for Dutch customers
			// if price exceeds 250 euro. Will be replaced with ILT in
			// the future.
			return false;
		}
		// Get the country settings
		if (!class_exists('KlarnaHandler'))
		require (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'helpers' . DS . 'klarnahandler.php');

		$countrysettings = KlarnaHandler::getCountryData($method, $country_code);
		if ($countrysettings['eid'] == '' || $countrysettings['eid'] == 0) {
			return false;
		}


		return $countrysettings;
	}

	/*
	 * @depredecated
	*/

	function _getLangTag($country_code, $currency_code, &$langTag) {
		$accepted = false;
		$langTag = 'en';
		switch ($country_code) {
			case 'SWE':
				$langTag = 'se';
				$accepted = ($currency_code == "SEK");
				break;
			case 'NOR':
				$langTag = 'no';
				$accepted = ($currency_code == "NOK");
				break;
			case 'DNK':
				$langTag = 'dk';
				$accepted = ($currency_code == "DKK");
				break;
			case 'FIN':
				$langTag = 'fi';
				$accepted = ($currency_code == "EUR");
				break;
			case 'DEU':
				$langTag = 'de';
				$accepted = ($currency_code == "EUR");
				break;
			case 'NLD':
				$langTag = 'nl';
				$accepted = ($currency_code == "EUR");
				break;
		}
		return $accepted;
	}

	function plgVmConfirmedOrder($cart, $order) {
		$testing = true;
		if (!($method = $this->getVmPluginMethod($order['details']['BT']->virtuemart_paymentmethod_id))) {
			return null; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($method->payment_element)) {
			return false;
		}
		if (!class_exists('VirtueMartModelOrders'))
		require( JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php' );

		$sessionKlarnaData = $this->getKlarnaSessionData();

		try {
			$result = KlarnaHandler::addTransaction($method, $order, $sessionKlarnaData->KLARNA_DATA['pclass']);
		} catch (Exception $e) {
			$log = $e->getMessage();
			vmError($e->getMessage() . ' #' . $e->getCode());
			//KlarnaHandler::redirectPaymentMethod('error', $e->getMessage() . ' #' . $e->getCode());
		}
		//vmdebug('addTransaction result', $result);
		// Delete all Klarna data
		//unset($sessionKlarnaData->KLARNA_DATA, $_SESSION['SSN_ADDR']);
		$modelOrder = VmModel::getModel('orders');
		if ($result['status_code'] == KlarnaFlags::DENIED) {
			$order['customer_notified'] = 0;
			$order['order_status'] = $method->status_denied;
			$order['comments'] = JText::sprintf('VMPAYMENT_KLARNA_PAYMENT_KLARNA_STATUS_DENIED');
			if ($method->remove_order) {
				$order['comments'] .= "<br />" . $result['status_text'];
			}
			$modelOrder->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order, true);
			vmdebug('addTransaction remove order?', $method->remove_order);
			if ($method->remove_order) {
				$modelOrder->remove(array('virtuemart_order_id' => $virtuemart_order_id));
			} else {
				$dbValues['order_number'] = $order['details']['BT']->order_number;
				$dbValues['payment_name'] = $this->renderPluginName($method, $order);
				$dbValues['virtuemart_paymentmethod_id'] = $order['details']['BT']->virtuemart_paymentmethod_id;
				$dbValues['order_payment'] = $order['details']['BT']->order_payment;
				$dbValues['klarna_pclass'] = $sessionKlarnaData->KLARNA_DATA['PCLASS'];
				$dbValues['klarna_log'] = $log;
				$dbValues['klarna_status_code'] = $result['status_code'];
				$dbValues['klarna_status_text'] = $result['status_text'];
				$this->storePSPluginInternalData($dbValues);
			}
			$app = JFactory::getApplication();
			$app->enqueueMessage($result['status_text']);
			$app->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart&task=editpayment'), JText::_('COM_VIRTUEMART_CART_ORDERDONE_DATA_NOT_VALID'));
		} else {
			$invoiceno = $result[1];
			if ($invoiceno && is_numeric($invoiceno)) {
				//Get address id used for this order.
				$country = $sessionKlarnaData->KLARNA_DATA['country'];
				// $lang = KlarnaHandler::getLanguageForCountry($method, KlarnaHandler::convertToThreeLetterCode($country));
				// $d['order_payment_name'] = $kLang->fetch('MODULE_INVOICE_TEXT_TITLE', $lang);
				// Add a note in the log
				$log = Jtext::sprintf('VMPAYMENT_KLARNA_INVOICE_CREATED_SUCCESSFULLY', $invoiceno);

				// Prepare data that should be stored in the database
				$dbValues['order_number'] = $order['details']['BT']->order_number;
				$dbValues['payment_name'] = $this->renderPluginName($method, $order);
				$dbValues['virtuemart_paymentmethod_id'] = $order['details']['BT']->virtuemart_paymentmethod_id;
				$dbValues['order_payment'] = $order['details']['BT']->order_payment;
				$dbValues['order_payment_tax'] = $order['details']['BT']->order_payment_tax;
				$dbValues['klarna_pclass'] = $sessionKlarnaData->KLARNA_DATA['pclass'];
				$dbValues['klarna_invoice_no'] = $invoiceno;
				$dbValues['klarna_log'] = $log;
				$dbValues['klarna_eid'] = $result['eid'];
				$dbValues['klarna_status_code'] = $result['status_code'];
				$dbValues['klarna_status_text'] = $result['status_text'];

				$this->storePSPluginInternalData($dbValues);

				/*
				 * Klarna's order status
				*  Integer - 1,2 or 3.
				*  1 = OK: KlarnaFlags::ACCEPTED
				*  2 = Pending: KlarnaFlags::PENDING
				*  3 = Denied: KlarnaFlags::DENIED
				*/
				if ($result['status_code'] == KlarnaFlags::PENDING) {
					/* if Klarna's order status is pending: add it in the history */
					/* The order is under manual review and will be accepted or denied at a later stage.
					 Use cronjob with checkOrderStatus() or visit Klarna Online to check to see if the status has changed.
					You should still show it to the customer as it was accepted, to avoid further attempts to fraud. */
					$order['order_status'] = $method->status_pending;
				} else {
					$order['order_status'] = $method->status_success;
				}
				$order['customer_notified'] = 1;
				$order['comments'] = $log;
				$modelOrder->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order, true);

				$html = $this->renderByLayout('orderdone', array('payment_name' => $dbValues['payment_name'], 'klarna_invoiceno' => $invoiceno));

				//We delete the old stuff
				if (!$testing) {
					$session->clear('Klarna', 'vm');
					$cart->emptyCart();
				}

				JRequest::setVar('html', $html);

				return true;
			} else {
				vmError('Error with invoice number');
			}
		}
	}

	function plgVmOnUserInvoice($orderDetails, &$data) {
		if (!($method = $this->getVmPluginMethod($orderDetails['virtuemart_paymentmethod_id']))) {
			return null; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($method->payment_element)) {
			return false;
		}
		if (!($payments = $this->_getKlarnaInternalData($orderDetails['virtuemart_order_id']) )) {
			vmError(JText::sprintf('VMPAYMENT_KLARNA_ERROR_NO_DATA', $orderDetails['virtuemart_order_id']));
			return null;
		}
		if (!($klarna_invoice_no = $this->_getKlarnaInvoiceNo($payments) )) {
			return null;
		}
		$data['invoice_number'] = $klarna_invoice_no;
	}

	function plgVmgetPaymentCurrency($virtuemart_paymentmethod_id, &$paymentCurrencyId) {

		if (!($method = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return null; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($method->payment_element)) {
			return false;
		}
		$paymentCurrencyId = $this->getKlarnaPaymentCurrency($method);
	}

	function getKlarnaPaymentCurrency(&$method) {
		if (!class_exists('VirtueMartCart'))
		require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		$cart = VirtueMartCart::getCart();

		$this->_getCartAddressCountryCode($cart, $country, $countrId);
		$cData = KlarnaHandler::countryData($method, $country);
		return shopFunctions::getCurrencyIDByName($cData['currency_code']);
	}

	function plgVmOnPaymentResponseReceived(&$html) {
		return null;
	}

	function plgVmOnUserPaymentCancel() {
		return null;
	}

	/*
	 *
	* An order gets cancelled, because order status='X'
	*/

	function plgVmOnCancelPayment($order, $old_order_status) {
		if (!$this->selectedThisByMethodId($order->virtuemart_paymentmethod_id)) {
			return null; // Another method was selected, do nothing
		}

		if (!($method = $this->getVmPluginMethod($order->virtuemart_paymentmethod_id))) {
			return null; // Another method was selected, do nothing
		}
		if (!($payments = $this->_getKlarnaInternalData($order->virtuemart_order_id) )) {
			vmError(JText::sprintf('VMPAYMENT_KLARNA_ERROR_NO_DATA', $order->virtuemart_order_id));
			return null;
		}
		// Status code is === 3==> active invoice. Cannot be be deleted
		// the invoice is active
		//if ($order->order_status == $method->status_success) {
		if ($invNo = $this->_getKlarnaInvoiceNo($payments)) {
			//vmDebug('order',$order);return;
			$country = $this->getCountryCodeByOrderId($order->virtuemart_order_id);
			$klarna = new Klarna_virtuemart();
			$cData = KlarnaHandler::countryData($method, $country);
			$mode = KlarnaHandler::getKlarnaMode($method);
			$klarna->config($cData['eid'], $cData['secret'], $cData['country_code'], null, $cData['currency_code'], $mode);

			try {
				//remove a passive invoice from Klarna.
				$result = $klarna->deleteInvoice($invNo);
				if ($result) {
					$message = Jtext::_('VMPAYMENT_KLARNA_INVOICE_DELETED', $invNo);
				} else {
					$message = Jtext::_('VMPAYMENT_KLARNA_INVOICE_NOT_DELETED', $invNo);
				}
				$dbValues['order_number'] = $order->order_number;
				$dbValues['virtuemart_order_id'] = $order->virtuemart_order_id;
				$dbValues['virtuemart_paymentmethod_id'] = $order->virtuemart_paymentmethod_id;
				$dbValues['klarna_invoice_no'] = 0; // it has been deleted
				$dbValues['klarna_pdf_invoice_url'] = 0; // it has been deleted
				$dbValues['klarna_log'] = $message;
				$dbValues['klarna_eid'] = $cData['eid'];
				$this->storePSPluginInternalData($dbValues);
				VmInfo($message);
			} catch (Exception $e) {
				$log = $e->getMessage() . " (#" . $e->getCode() . ")";
				$this->_updateKlarnaInternalData($order, $log, $invNo);
				VmError($e->getMessage() . " (#" . $e->getCode() . ")");
				if ($e->getCode() == '8113') {
					VmError('invoice_not_passive');
				}
				return false;
			}
		}
		//} else {
		//   VmError('VMPAYMENT_KLARNA_CANNOT_DELETE');
		//    return false;
		//}
		return true;
}

function _getKlarnaInvoiceNo($payments) {
	$nb = count($payments);
	return $payments[$nb - 1]->klarna_invoice_no;
}

function _getKlarnaPlcass($payments) {
	$nb = count($payments);
	return $payments[$nb - 1]->klarna_pclass;
}

function _getKlarnaStatusCode($payments) {

	$nb = count($payments);
	return $payments[$nb - 1]->klarna_status_code;
}

/*
 *   plgVmOnPaymentNotification() - This event is fired by Offline Payment. It can be used to validate the payment data as entered by the user.
* Return:
* Parameters:
*  None
*  @author Valerie Isaksen
*/

function plgVmOnPaymentNotification() {

	if (!class_exists('VirtueMartModelOrders'))
	require( JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php' );

	$payment_methodid = JRequest::getInt('payment_methodid');
	$invNo = JRequest::getInt('invNo');
	$country = JRequest::getInt('country');
	KlarnaHandler::checkOrderStatus($payment_methodid, $invNo, $country);
	$vendorId = 0;
	if (!($payment = $this->getDataByOrderId($virtuemart_order_id))) {
		return;
	}

	$method = $this->getVmPluginMethod($payment->virtuemart_paymentmethod_id);
	if (!$this->selectedThisElement($method->payment_element)) {
		return false;
	}
	$invNo = JRequest::getInt('invNo');
	$country = JRequest::getInt('country');
	$order_status = KlarnaHandler::checkOrderStatus($payment_methodid, $invNo, $country);

	$order['customer_notified'] = 1;

	if ($order_status == 0) {
		$order['order_status'] = $method->status_success;
		$order['comments'] = JText::sprintf('VMPAYMENT_KLARNA_PAYMENT_STATUS_CONFIRMED', $order_number);
	} else {
		$order['order_status'] = $method->status_canceled;
	}

	$this->logInfo('plgVmOnPaymentNotification return new_status:' . $order['order_status'], 'message');

	$modelOrder->updateStatusForOneOrder($virtuemart_order_id, $order, true);
	//// remove vmcart
	$this->emptyCart($paypal_data['custom']);
	//die();
}

/*
 * @author Patrick Kohl
*/

function plgVmOnSelfCallFE($type, $name, &$render) {


	//Klarna Ajax
	require (JPATH_VMKLARNAPLUGIN . '/klarna/helpers/klarna_ajax.php');

	if (!class_exists('VmModel'))
	require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmmodel.php');
	$model = VmModel::getModel('paymentmethod');
	$payment = $model->getPayment();
	if (!class_exists('vmParameters'))
	require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'parameterparser.php');
	$parameters = new vmParameters($payment, $payment->payment_element, 'plugin', 'vmpayment');
	$method = $parameters->getParamByName('data');

	$country = JRequest::getWord('country');
	$country = KlarnaHandler::convertToThreeLetterCode($country);

	if (!class_exists('klarna_virtuemart'))
	require (JPATH_VMKLARNAPLUGIN . '/klarna/helpers/klarna_virtuemart.php');

	$settings = KlarnaHandler::getCountryData($method, $country);

	$klarna = new Klarna_virtuemart();
	$klarna->config($settings['eid'], $settings['secret'], $settings['country'], $settings['language'], $settings['currency'], KlarnaHandler::getKlarnaMode($method), KlarnaHandler::getKlarna_pc_type(), KlarnaHandler::getKlarna_pc_type(), true);

	$SelfCall = new KlarnaAjax($klarna, (int) $settings['eid'], JPATH_VMKLARNAPLUGIN, Juri::base());
	$action = JRequest::getWord('action');

	echo $SelfCall->$action();
	jexit();
}

/*
 * @author Patrick Kohl
*/

function plgVmOnSelfCallBE($type, $name, &$render) {

	// fetches PClasses From XML file
	$call = jrequest::getWord('call');
	// 	require (JPATH_VMKLARNAPLUGIN . '/klarna/helpers/selfcall.php');
	// 	$SelfCall = new KlarnaSelfCall;
	$this->$call();
	// 	jexit();
}

function getPclasses() {

	$jlang = JFactory::getLanguage();
	$jlang->load('plg_vmpayment_klarna', JPATH_ADMINISTRATOR, 'en-GB', true);
	$jlang->load('plg_vmpayment_klarna', JPATH_ADMINISTRATOR, $jlang->getDefault(), true);
	$jlang->load('plg_vmpayment_klarna', JPATH_ADMINISTRATOR, null, true);
	$handler = new KlarnaHandler();
	// call klarna server for pClasses
	//$methodid = jrequest::getInt('methodid');
	if (!class_exists('VmModel'))
	require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmmodel.php');
	$model = VmModel::getModel('paymentmethod');
	$payment = $model->getPayment();
	if (!class_exists('vmParameters'))
	require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'parameterparser.php');
	$parameters = new vmParameters($payment, $payment->payment_element, 'plugin', 'vmpayment');
	$data = $parameters->getParamByName('data');
	// echo "<pre>";print_r($data);
	$json = $handler->fetchPClasses($data);
	ob_start();
	require (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'helpers' . DS . 'pclasses_html.php');
	$json['pclasses'] = ob_get_clean();
	$document = JFactory::getDocument();
	$document->setMimeEncoding('application/json');
	//echo json_encode($json, true);
	echo json_encode($json);
	jexit();
	// echo result with tmpl ?
}

/*
 * @author Valérie Isaksen
*
*/

function checkOrderStatus() {
	if (!class_exists('VirtueMartModelOrders'))
	require( JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php' );

	$payment_methodid = JRequest::getInt('payment_methodid');
	$invNo = JRequest::getInt('invNo');
	$orderNumber = JRequest::getString('order_number');
	$orderPass = JRequest::getString('order_pass');

	if (!($method = $this->getVmPluginMethod($payment_methodid))) {
		return null; // Another method was selected, do nothing
	}

	$modelOrder = VmModel::getModel('orders');
	// If the user is not logged in, we will check the order number and order pass
	$orderId = $modelOrder->getOrderIdByOrderPass($orderNumber, $orderPass);
	if (empty($orderId)) {
		VmError('Invalid order_number/password ' . JText::_('COM_VIRTUEMART_RESTRICTED_ACCESS'));
		return 0;
	}

	$country = $this->getCountryCodeByOrderID($orderId);
	$settings = KlarnaHandler::countryData($method, $country);
	$mode = KlarnaHandler::getKlarnaMode($method);
	$klarna_order_status = KlarnaHandler::checkOrderStatus($settings, $mode, $invNo);
	if ($klarna_order_status == KlarnaFlags::ACCEPTED) {
		/* if Klarna's order status is pending: add it in the history */
		/* The order is under manual review and will be accepted or denied at a later stage.
		 Use cronjob with checkOrderStatus() or visit Klarna Online to check to see if the status has changed.
		You should still show it to the customer as it was accepted, to avoid further attempts to fraud. */
		$order['order_status'] = $method->status_success;
		$order['comments'] = JText::_('VMPAYMENT_KLARNA_PAYMENT_ACCEPTED');
		$order['customer_notified'] = 0;
		$dbValues['klarna_log'] = JText::_('VMPAYMENT_KLARNA_PAYMENT_ACCEPTED');
	} elseif ($klarna_order_status == KlarnaFlags::DENIED) {
		$order['order_status'] = $method->status_canceled;
		$order['customer_notified'] = 0;
		$dbValues['klarna_log'] = JText::_('VMPAYMENT_KLARNA_PAYMENT_NOT_ACCEPTED');
	} else {
		$dbValues['klarna_log'] = $klarna_order_status;
		$order['comments'] = $klarna_order_status;
		$order['customer_notified'] = 0;
	}
	$dbValues['order_number'] = $orderNumber;
	$dbValues['virtuemart_order_id'] = $orderId;
	$dbValues['virtuemart_paymentmethod_id'] = $payment_methodid;
	$dbValues['klarna_invoice_no'] = $invNo;
	$this->storePSPluginInternalData($dbValues);



	$modelOrder->updateStatusForOneOrder($orderId, $order, true);
	$app = JFactory::getApplication();
	$app->redirect('index.php?option=com_virtuemart&view=orders&task=edit&virtuemart_order_id=' . $orderId);
	// 	jexit();
}

function _getTablepkeyValue($virtuemart_order_id) {
	$db = JFactory::getDBO();
	$q = 'SELECT ' . $this->_tablepkey . ' FROM `' . $this->_tablename . '` '
	. 'WHERE `virtuemart_order_id` = ' . $virtuemart_order_id;
	$db->setQuery($q);

	if (!($pkey = $db->loadResult())) {
		JError::raiseWarning(500, $db->getErrorMsg());
		return '';
	}
	return $pkey;
}

/**
 * Display stored payment data for an order
 * @see components/com_virtuemart/helpers/vmPSPlugin::plgVmOnShowOrderBEPayment()
 */
function plgVmOnShowOrderBEPayment($virtuemart_order_id, $payment_method_id, $order) {

	if (!( $this->selectedThisByMethodId($payment_method_id))) {
		return null; // Another method was selected, do nothing
	}

	if (!($payments = $this->_getKlarnaInternalData($virtuemart_order_id) )) {
		// JError::raiseWarning(500, $db->getErrorMsg());
		return '';
	}
	if (!($method = $this->getVmPluginMethod($payment_method_id))) {
		return null; // Another method was selected, do nothing
	}
	$html = '<table class="adminlist">' . "\n";
	$html .=$this->getHtmlHeaderBE();

	$code = "klarna_";
	$class = 'class="row1"';
	foreach ($payments as $payment) {

		$html .= '<tr class="row1"><td>' . JText::_('VMPAYMENT_KLARNA_DATE') . '</td><td align="left">' . $payment->created_on . '</td></tr>';
		//$html .= $this->getHtmlRow('KLARNA_DATE', "<strong>".$payment->created_on."</strong>", $class);
		if ($payment->payment_name) {
			$html .= $this->getHtmlRowBE('KLARNA_PAYMENT_NAME', $payment->payment_name);
		}
		foreach ($payment as $key => $value) {
			if ($value) {
				if (substr($key, 0, strlen($code)) == $code) {
					if ($key == 'klarna_pdf_invoice_url' and !empty($value)) {
						$value = '<a target="_blank" href="' . $value . '">' . JText::_('VMPAYMENT_KLARNA_GET_INVOICE') . '</a>';
					}
					$html .= $this->getHtmlRowBE($key, $value);
				}
			}
		}
	}

	$nb = count($payments);
	if ($order['details']['BT']->order_status == $method->status_pending) {
		if (!class_exists('VirtueMartModelOrders'))
		require( JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php' );

		$country = $this->getCountryCodeByOrderId($virtuemart_order_id);
		$invNo = $payments[$nb - 1]->klarna_invoice_no;
		$checkOrderStatus = JURI::root() . 'administrator/index.php?option=com_virtuemart&view=plugin&type=vmpayment&name=klarna&call=checkOrderStatus&payment_methodid=' . (int) $payment_method_id . '&order_number=' . $order['details']['BT']->order_number . '&order_pass=' . $order['details']['BT']->order_pass . '&country=' . $country . '&invNo=' . $invNo;

		$link = '<a href="' . $checkOrderStatus . '">' . JText::_('VMPAYMENT_KLARNA_GET_NEW_STATUS') . '</a>';
		$html .= $this->getHtmlRowBE('KLARNA_PAYMENT_CHECK_ORDER_STATUS', $link);
	}
	$html .= '</table>' . "\n";
	return $html;
}

function _getKlarnaInternalData($virtuemart_order_id, $order_number = '') {
	$db = JFactory::getDBO();
	$q = 'SELECT * FROM `' . $this->_tablename . '` WHERE ';
	if ($order_number) {
		$q .= " `order_number` = '" . $order_number . "'";
	} else {
		$q .= ' `virtuemart_order_id` = ' . $virtuemart_order_id;
	}

	$db->setQuery($q);
	if (!($payments = $db->loadObjectList())) {
		// JError::raiseWarning(500, $db->getErrorMsg());
		return '';
	}
	return $payments;
}

function getCosts(VirtueMartCart $cart, $method, $cart_prices) {
	$this->_getCartAddressCountryCode($cart, $country_code, $countryId);
	return KlarnaHandler::getInvoiceFee($method, $country_code);
}

/**
 * Save updated order data to the method specific table
 *
 * @param array $order Form data
 * @return mixed, True on success, false on failures (the rest of the save-process will be
 * skipped!), or null when this method is not actived.

 */
public function plgVmOnUpdateOrderPayment(&$order, $old_order_status) {
	if (!$this->selectedThisByMethodId($order->virtuemart_paymentmethod_id)) {
		return null; // Another method was selected, do nothing
	}

	if (!($method = $this->getVmPluginMethod($order->virtuemart_paymentmethod_id))) {
		return null; // Another method was selected, do nothing
	}
	if (!($payments = $this->_getKlarnaInternalData($order->virtuemart_order_id) )) {
		vmError(JText::sprintf('VMPAYMENT_KLARNA_ERROR_NO_DATA', $order->virtuemart_order_id));
		return null;
	}

	if (!($invNo = $this->_getKlarnaInvoiceNo($payments))) {
		return null;
	}
	// to actiavte the order
	if ($order->order_status == $method->status_shipped) {
		$country = $this->getCountryCodeByOrderId($order->virtuemart_order_id);
		$klarna = new Klarna_virtuemart();
		$cData = KlarnaHandler::countryData($method, $country);
		/*
		 * The activateInvoice function is used to activate a passive invoice.
		* Please note that this function call cannot activate an invoice created in test mode.
		* It is however possible to manually activate that type of invoices.
		*/

		$mode = KlarnaHandler::getKlarnaMode($method);
		$klarna->config($cData['eid'], $cData['secret'], $cData['country_code'], null, $cData['currency_code'], $mode);

		try {
			//You can specify a new pclass ID if the customer wanted to change it before you activate.

			$invoice_url = $klarna->activateInvoice($invNo);
			$dbValues['order_number'] = $order->order_number;
			$dbValues['virtuemart_order_id'] = $order->virtuemart_order_id;
			$dbValues['virtuemart_paymentmethod_id'] = $order->virtuemart_paymentmethod_id;
			$dbValues['klarna_invoice_no'] = $invNo;
			$dbValues['klarna_log'] = Jtext::_('VMPAYMENT_KLARNA_ACTIVATE_INVOICE', $invNo);
			$dbValues['klarna_eid'] = $cData['eid'];
			$dbValues['klarna_status_code'] = KLARNA_INVOICE_ACTIVE; // Invoice is active
			$dbValues['klarna_status_text'] = '';
			$dbValues['klarna_pdf_invoice_url'] = $invoice_url;

			$this->storePSPluginInternalData($dbValues);

			//The url points to a PDF file for the invoice.
			//Invoice activated, proceed accordingly.
		} catch (Exception $e) {

			$log = $e->getMessage() . " (#" . $e->getCode() . ")";
			$this->_updateKlarnaInternalData($order, $log);
			VmError($e->getMessage() . " (#" . $e->getCode() . ")");
			return false;
		}

		return true;
	}



	return null;
}

function _updateKlarnaInternalData($order, $log) {
	$dbValues['virtuemart_order_id'] = $order->virtuemart_order_id;
	$dbValues['order_number'] = $order->order_number;
	$dbValues['klarna_log'] = $log;
	$this->storePSPluginInternalData($dbValues);
}

/**
 * Create the table for this plugin if it does not yet exist.
 * This functions checks if the called plugin is active one.
 * When yes it is calling the standard method to create the tables
 * @author Val√©rie Isaksen
 *
 */
function plgVmOnStoreInstallPaymentPluginTable($jplugin_id) {
	/*
	 * if the file Klarna.cfg does not exist, then create it

	*/
	$filename = VMKLARNA_CONFIG_FILE;
	if (!JFile::exists($filename)) {
		$filecontents = "defined('_JEXEC') or die();
	define('VMKLARNA_SHIPTO_SAME_AS_BILLTO', '1'); ?>";

		$result = JFile::write($filename, $filecontents);

		if (!$result) {
			VmInfo(JText::sprintf('VMPAYMENT_KLARNA_CANT_WRITE_CONFIG', $filename, $result));
		}
	}

	$method = $this->getPluginMethod(JRequest::getInt('virtuemart_paymentmethod_id'));

	// we have to chek that the foolowing Shopper fields are there
	$vm_shopperfields = array("first_name", "last_name", "address_1", "city", "zip", "company", "phone_1");

	$shopperfields_country = array(
	    "socialNumber" => array("SWE", "DNK", "NOR", "FIN"),
	    "year_salary" => array("DNK"),
	    "birthday" => array("DEU", "NLD"),
	    "house_extension" => array("NLD")
	);

	$userFieldsModel = VmModel::getModel('UserFields');
	$userFields = $userFieldsModel->getUserFields();

	foreach ($userFields as $userField) {
		$field = $userField->name;
		if (array_key_exists($userField->name, $vm_shopperfields)) {
			$vm_shopperfields_error[$userField->name] = 1;
		}

		if (array_key_exists($userField->name, $shopperfields_country)) {
			foreach ($shopperfields_country[$userField->name] as $country) {
				$field = 'klarna_active_' . strtolower($country);
				if ($method->$field) {
					$shopperfields_country[$userField->name]["found"] = 1;
				}
			}
		}
	}
	foreach ($shopperfields_country as $key => $shopperfield_country) {
		if (!isset($shopperfield_country["found"])) {
			// create shooperfield
		}
	}
	vmDebug('plgVmOnStoreInstallPaymentPluginTable', $create_shopperfield, $vm_shopperfields_error);
	/*
	 * we check the shopper fields
	*
	*/


	$result = $this->onStoreInstallPluginTable($jplugin_id);

	if (jrequest::getvar('redirect') == "no" and $result) {
		echo ('ok');
		jexit();
	}
	return $result;
}

/**
 * This event is fired after the payment method has been selected. It can be used to store
 * additional payment info in the cart.

 * @author Val√©rie isaksen
 *
 * @param VirtueMartCart $cart: the actual cart
 * @return null if the payment was not selected, true if the data is valid, error message if the data is not vlaid
 *
 */
public function plgVmOnSelectCheckPayment(VirtueMartCart $cart) {

	if (!$this->selectedThisByMethodId($cart->virtuemart_paymentmethod_id)) {
		return null; // Another method was selected, do nothing
	}
	if (!($method = $this->getVmPluginMethod($cart->virtuemart_paymentmethod_id))) {
		return null; // Another method was selected, do nothing
	}
	if (!class_exists('KlarnaAddr'))
	require (JPATH_VMKLARNAPLUGIN . DS . 'klarna' . DS . 'api' . DS . 'klarnaaddr.php');

	$session = JFactory::getSession();
	$sessionKlarna = new stdClass();
	//$post = JRequest::get('post');

	$klarnaData_paymentmethod = JRequest::getVar('klarna_paymentmethod', '');
	if ($klarnaData_paymentmethod == 'klarna_invoice') {
		$kIndex = "klarna_";
		$klarnaData_payment = "klarna_invoice";
		$sessionKlarna->klarna_option = 'invoice';
	} elseif ($klarnaData_paymentmethod == 'klarna_partPayment') {
		$kIndex = "klarna_part_"; //"klarna_partPayment";
		$klarnaData_payment = "klarna_partpay";
		$sessionKlarna->klarna_option = 'part';
	} elseif ($klarnaData_paymentmethod == 'klarna_speccamp') {
		$kIndex = "klarna_spec_";
		$klarnaData_payment = "klarna_speccamp";
		$sessionKlarna->klarna_option = 'spec';
	} else {
		return;
	}

	// Store payment_method_id so we can activate the
	// right payment in case something goes wrong.
	$sessionKlarna->virtuemart_payment_method_id = $cart->virtuemart_paymentmethod_id;
	$sessionKlarna->klarna_paymentmethod = $klarnaData_paymentmethod;

	$this->_getCartAddressCountryCode($cart, $country3, $countryId, 'country_3_code');
	// $country2=  strtolower($country2);
	if (empty($country3)) {
		$country3 = "SWE";
		$countryId = ShopFunctions::getCountryIDByName($country3);
	}

	$cData = KlarnaHandler::countryData($method, strtoupper($country3));

	$klarnaData = KlarnaHandler::getDataFromEditPayment($kIndex);
	$klarnaData['country'] = $cData['country_code'];
	//$country = $cData['country_code']; //KlarnaHandler::convertCountry($method, $country2);
	//$lang = $cData['language_code']; //KlarnaHandler::getLanguageForCountry($method, $country);
	// Get the correct data
	//Removes spaces, tabs, and other delimiters.
	// If it is a swedish customer we use the information from getAddress
	if (strtolower($cData['country_code']) == "se") {
		if (empty($klarnaData['pno'])) {
			VmInfo('VMPAYMENT_KLARNA_MUST_VALID_PNO');
			return false;
		}
		$swedish_addresses = klarnaHandler::getAddresses($klarnaData['pno'], $cData, $method);
		if (empty($swedish_addresses)) {
			VmInfo('VMPAYMENT_KLARNA_NO_GETADDRESS');
			return false;
		}
		//This example only works for GA_GIVEN.
		foreach ($swedish_addresses as $index => $addr) {
			if ($addr->isCompany) {
				$klarnaData['company_name'] = $addr->getCompanyName();
			} else {
				$klarnaData['first_name'] = $addr->getFirstName();
				$klarnaData['last_name'] = $addr->getLastName();
			}
			$klarnaData['street'] = $addr->getStreet();
			$klarnaData['zip'] = $addr->getZipCode();
			$klarnaData['city'] = $addr->getCity();
			$klarnaData['country'] = $addr->getCountryCode();
			$countryId= $klarnaData['virtuemart_country_id'] = shopFunctions::getCountryIDByName($klarnaData['country']);
		}
	} // end of sweden
	if (VMKLARNA_SHIPTO_SAME_AS_BILLTO) {
		$st = $cart->BT;
		$address_type = 'BT';
		$prefix = '';
	} elseif ($cart->BT == 0 or empty($cart->BT)) {
		$address_type = 'BT';
		$prefix = '';
	} else {
		$st = $cart->BT;
		$address_type = 'ST';
		$prefix = 'shipto_';
	}

	// Update the Shipping Address to what is specified in the register.
	$update_data = array(
	$prefix . 'address_type_name' => 'Klarna',
	$prefix . 'company' => mb_convert_encoding ( $klarnaData['company_name'] , 'UTF-8', 'ISO-8859-1'),
	$prefix . 'first_name' => mb_convert_encoding ( $klarnaData['first_name'] , 'UTF-8', 'ISO-8859-1'),
	$prefix . 'last_name' => mb_convert_encoding ( $klarnaData['last_name'] , 'UTF-8', 'ISO-8859-1'),
	$prefix . 'address_1' => mb_convert_encoding ( $klarnaData['street'] , 'UTF-8', 'ISO-8859-1'),
	$prefix . 'address_2' => mb_convert_encoding ($klarnaData['house_ext'] , 'UTF-8', 'ISO-8859-1'),
	$prefix . 'house_number' => html_entity_decode($klarnaData['house_no']),
	$prefix . 'zip' => html_entity_decode($klarnaData['zip']),
	$prefix . 'city' => mb_convert_encoding ( $klarnaData['city'] , 'UTF-8', 'ISO-8859-1'),
	$prefix . 'virtuemart_country_id' => $countryId, //$klarnaData['virtuemart_country_id'],
	$prefix . 'state' => '',
	$prefix . 'phone_1' => $klarnaData['phone'],
	$prefix . 'email' => $klarnaData['email'],
	$prefix . 'birthday' => !isset($klarnaData['birthday']) ? $st['birthday'] : $klarnaData['birthday'],
	$prefix . 'social_number' => !isset($klarnaData['pno']) ? $st['social_number'] : $klarnaData['pno'],
	    'address_type' => $address_type
	);
	// save address in cart if different
	// 	if (false) {
	$cart->saveAddressInCart($update_data, $update_data['address_type'], true);
	//vmdebug('plgVmOnSelectCheckPayment $cart',$cart);
	//vmInfo(JText::_('VMPAYMENT_KLARNA_ADDRESS_UPDATED_NOTICE'));
	// 	}
	//}
	// Store the Klarna data in a session variable so
	// we can retrevie it later when we need it
	//$klarnaData['pclass'] = ($klarnaData_paymentmethod == 'klarna_invoice' ? -1 : intval(JRequest::getVar($kIndex . "paymentPlan")));
	$klarnaData['pclass'] = ($klarnaData_paymentmethod == 'klarna_invoice' ? -1 : intval(JRequest::getVar("paymentPlan")));

	$sessionKlarna->KLARNA_DATA = $klarnaData;

	// 2 letters small
	//$settings = KlarnaHandler::getCountryData($method, $cart_country2);

	try {
		$addr = new KlarnaAddr(
		$klarnaData['email'],
		$klarnaData['phone'],
			    "",
		$klarnaData['first_name'],
		$klarnaData['last_name'], '',
		$klarnaData['street'],
		$klarnaData['zip'],
		$klarnaData['city'],
		$klarnaData['country'], // $settings['country'],
		$klarnaData['house_no'],
		$klarnaData['house_ext']
		);
	} catch (Exception $e) {
		VmInfo($e->getMessage());
		return false;
		//KlarnaHandler::redirectPaymentMethod('message', $e->getMessage());
	}


	if (isset($errors) && count($errors) > 0) {
		$msg = JText::_('VMPAYMENT_KLARNA_ERROR_TITLE_1');
		foreach ($errors as $error) {
			$msg .= "<li> -" . $error . "</li>";
		}
		$msg .= JText::_('VMPAYMENT_KLARNA_ERROR_TITLE_2');
		unset($errors);
		VmError($msg);
		return false;
		//KlarnaHandler::redirectPaymentMethod('error', $msg);
	}
	$session->set('Klarna', serialize($sessionKlarna), 'vm');
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
* @return null if the method was not selected, false if the shiiping rate is not valid any more, true otherwise
*
*
*/

public function plgVmonSelectedCalculatePricePayment(VirtueMartCart $cart, array &$cart_prices, &$cart_prices_name) {

	return $this->onKlarnaSelectedCalculatePrice($cart, $cart_prices, $cart_prices_name);
}

function plgVmDisplayLogin(VirtuemartViewUser $user, &$html) {
	$vendorId = 1;
	if ($this->getPluginMethods($vendorId) === 0) {
		if (empty($this->_name)) {
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('COM_VIRTUEMART_CART_NO_' . strtoupper($this->_psType)));
			return false;
		} else {
			return false;
		}
	}
	//vmdebug('plgVmDisplayLogin', $user);
	//$html = $this->renderByLayout('displaylogin', array('klarna_pm' => $klarna_pm, 'virtuemart_paymentmethod_id' => $method->virtuemart_paymentmethod_id, 'klarna_paymentmethod' => $klarna_paymentmethod));
	$link = JRoute::_('index.php?option=com_virtuemart&view=cart&task=editpayment');
	foreach ($this->methods as $method) {
		$html .= $this->renderByLayout('displaylogin', array('editpayment_link' => $link));
	}
}

/*
 function plgVmDisplayLogin(VirtuemartViewUser $user, &$html) {
if (!class_exists('VirtueMartCart'))
require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
$cart = VirtueMartCart::getCart();

$html=$this->displayListFEPayment($cart);
}
*/

public function onKlarnaSelectedCalculatePrice(VirtueMartCart $cart, array &$cart_prices, &$cart_prices_name) {

	$id = $this->_idName;
	if (!($method = $this->selectedThisByMethodId($cart->$id))) {
		return null; // Another method was selected, do nothing
	}

	if (!($method = $this->getVmPluginMethod($cart->$id) )) {
		return null;
	}

	$sessionKlarnaData = $this->getKlarnaSessionData();
	if (empty($sessionKlarnaData)) {
		return '';
	}

	$cart_prices_name = '';
	$cart_prices[$this->_psType . '_tax_id'] = 0;
	$cart_prices['cost'] = 0;

	$this->_getCartAddressCountryCode($cart, $country_code, $countryId, 'country_2_code');
	if (strcasecmp($country_code, $sessionKlarnaData->KLARNA_DATA['country']) != 0) {
		return false;
	}
	$paramsName = $this->_psType . '_params';
	$cart_prices_name = $this->renderPluginName($method);
	if ($sessionKlarnaData->klarna_option == 'invoice') {
		$this->setKlarnaCartPrices($cart, $cart_prices, $method);
	}
	return true;
}

/*
 * update the plugin cart_prices
*
* @author Valérie Isaksen
*
* @param $cart_prices: $cart_prices['salesPricePayment'] and $cart_prices['paymentTax'] updated. Displayed in the cart.
* @param $value :   fee
* @param $tax_id :  tax id
*/

function setKlarnaCartPrices(VirtueMartCart $cart, &$cart_prices, $method) {
	$this->_getCartAddressCountryCode(null, $country, $countryId);
	$invoice_fee = KlarnaHandler::getInvoiceFee($method, $country);
	$invoice_tax_id = KlarnaHandler::getInvoiceTaxId($method, $country);

	$_psType = ucfirst($this->_psType);
	$cart_prices[$this->_psType . 'Value'] = $invoice_fee;

	$taxrules = array();
	if (!empty($method->tax_id)) {
		$db = JFactory::getDBO();
		$q = 'SELECT * FROM #__virtuemart_calcs WHERE `virtuemart_calc_id`="' . $invoice_tax_id . '" ';
		$db->setQuery($q);
		$taxrules = $db->loadAssocList();
	}
	if (!class_exists('calculationHelper'))
	require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'calculationh.php');
	$calculator = calculationHelper::getInstance();
	if (count($taxrules) > 0) {
		$cart_prices['salesPrice' . $_psType] = $calculator->roundInternal($calculator->executeCalculation($taxrules, $cart_prices[$this->_psType . 'Value']));
		$cart_prices[$this->_psType . 'Tax'] = $calculator->roundInternal($cart_prices['salesPrice' . $_psType]) - $cart_prices[$this->_psType . 'Value'];
	} else {
		$cart_prices['salesPrice' . $_psType] = $invoice_fee;
		$cart_prices[$this->_psType . 'Tax'] = 0;
	}
}

/*
 * @param $plugin plugin
*/

protected function renderPluginName($method) {
	$return = '';
	$plugin_name = $this->_psType . '_name';
	$plugin_desc = $this->_psType . '_desc';
	$description = '';

	$return = $this->displayLogos($method) . ' ';

	if (!empty($method->$plugin_desc)) {
		$description = '<span class="' . $this->_type . '_description">' . $method->$plugin_desc . '</span>';
	}
	$pluginName = $return . '<span class="' . $this->_type . '_name">' . $method->$plugin_name . '</span>' . $description;
	return $pluginName;
}

function displayLogos($method) {

	$session = JFactory::getSession();
	$sessionKlarna = $session->get('Klarna', 0, 'vm');
	if (empty($sessionKlarna)) {
		return '';
	}
	$sessionKlarnaData = unserialize($sessionKlarna);
	$this->_getCartAddressCountryCode(null, $country, $countryId, 'country_2_code');
	$this->_getCartAddressCountryCode(null, $country3, $countryId, 'country_3_code');
	KlarnaHandler::convertCountry($method, $country);
	$country = strtolower($country);
	$logo = '<img src="' . JURI::base() . VMKLARNAPLUGINWEBROOT . '/klarna/assets/images/logo';

	switch ($sessionKlarnaData->klarna_option) {
		case 'invoice':
			$image = '/klarna_invoice_' . $country . '.png';
			$klarna_invoice_fee = KlarnaHandler::getInvoiceFeeInclTax($method, $country3);
			//$currency = CurrencyDisplay::getInstance();
			//$display_fee = $currency->priceDisplay($klarna_invoice_fee);
			//$text = JText::sprintf('VMPAYMENT_KLARNA_INVOICE_TITLE', $display_fee);
			$text = '';
			break;
		case 'partpayment':
		case 'part':
			$image = '/klarna_account_' . $country . '.png';
			//$result = KlarnaHandler::fetchPClasses($method);
			//$pclass = $sessionKlarnaData->KLARNA_DATA['pclass'];

			$text = ''; // JText::sprintf('VMPAYMENT_KLARNA_PARTPAY_TITLE', $sFee);

			break;
		case 'speccamp':
			$image = 'klarna_logo.png';
			$text = JText::_('VMPAYMENT_KLARNA_SPEC_TITLE');
			break;
		default:
			$image = '';
		$text = '';
		break;
	}
	$logo = $logo . $image . '"/>';

	$html = '  <div class="klarna_info">
        <span style="">
            <a href="http://www.klarna.com/">' . $logo . '</a><br />
            ' . $text . '
        </span>
    </div>

    <div class="clear"></div>';
	return $html;
}

/**
 * plgVmOnCheckAutomaticSelectedPayment
 * Checks how many plugins are available. If only one, the user will not have the choice. Enter edit_xxx page
 * The plugin must check first if it is the correct type
 * @author Valerie Isaksen
 * @param VirtueMartCart cart: the cart object
 * @return null if no plugin was found, 0 if more then one plugin was found,  virtuemart_xxx_id if only one plugin is found
 *
 */
function plgVmOnCheckAutomaticSelectedPayment(VirtueMartCart $cart, array $cart_prices = array()) {
	return 0;
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
public function plgVmOnShowOrderFEPayment($virtuemart_order_id, $virtuemart_paymentmethod_id, &$payment_name) {

	$this->onShowOrderFE($virtuemart_order_id, $virtuemart_paymentmethod_id, $payment_name);

	return false;
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
function plgVmonShowOrderPrintPayment($order_number, $method_id) {
	return $this->onShowOrderPrint($order_number, $method_id);
}

function _getVendorCurrency() {
	if (!class_exists('VirtueMartModelVendor'))
	require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'vendor.php');
	$vendor_id = 1;
	$vendor_currency = VirtueMartModelVendor::getVendorCurrency($vendor_id);
	return $vendor_currency->currency_code_3;
}

function loadScriptAndCss() {
	$assetsPath = VMKLARNAPLUGINWEBROOT . '/klarna/assets/';
	JHTML::stylesheet('style.css', $assetsPath . 'css/', false);
	JHTML::stylesheet('klarna.css', $assetsPath . 'css/', false);
	JHTML::script('klarna_general.js', $assetsPath . 'js/', false);
	JHTML::script('klarnaConsentNew.js', 'http://static.klarna.com/external/js/', false);
	$document = JFactory::getDocument();
	$document->addScriptDeclaration('
		 klarna.ajaxPath = "' . juri::root() . '/index.php?option=com_virtuemart&view=plugin&vmtype=vmpayment&name=klarna";
	');
}

}

// No closing tag
