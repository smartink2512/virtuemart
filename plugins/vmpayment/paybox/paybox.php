<?php

defined('_JEXEC') or die('Direct Access to ' . basename(__FILE__) . 'is not allowed.');

/**
 *
 * @package    VirtueMart
 * @subpackage Plugins  - Elements
 * @package VirtueMart
 * @subpackage
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - ${PHING.VM.RELDATE} VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: view.html.php 2796 2011-03-01 11:29:16Z Milbo $
 *
 * http://www1.paybox.com/telechargements/ManuelIntegrationPaybox_V5.08_FR.pdf
 * Pour accéder au Back-office commerçant: https://preprod-admin.paybox.com
 */
if (!class_exists('vmPSPlugin')) {
	require(JPATH_VM_PLUGINS . DS . 'vmpsplugin.php');
}
if (!class_exists('PayboxHelperPaybox')) {
	require(JPATH_SITE . '/plugins/vmpayment/paybox/paybox/helpers/paybox.php');
}
if (!class_exists('pbxRequest')) {
	require(JPATH_SITE . '/plugins/vmpayment/paybox/paybox/helpers/pbxrequest.php');
}
class plgVmpaymentPaybox extends vmPSPlugin {
	const PAYBOX_FOLDERNAME = "paybox";
	const PBX_MAX_URL_LEN = 150;

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
		if (!JFactory::getApplication()->isSite()) {
			$doc = JFactory::getDocument();
			$doc->addScript(JURI::root(true) . '/plugins/vmpayment/' . $this->_name . '/' . $this->_name . '/assets/js/admin.js');
		}
		if (method_exists($this, 'setCryptedFields')) {
			$this->setCryptedFields(array('key'));
		}

	}

	protected function getVmPluginCreateTableSQL () {

		return $this->createTableSQL('Payment paybox Table');
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
			'paybox_custom'               => 'varchar(255) ',
// ONLY SAVE THE ONE WE EVENTUALLY WANT TO DO A SEARCH
			'paybox_response_T'           => 'smallint(1) DEFAULT NULL',
			//Numéro d’appel Paybox
			'paybox_response_A'           => 'char(10) DEFAULT NULL',
			//numéro d’Autorisation (numéro remis par le centre d’autorisation) : URL encodé
			'paybox_response_B'           => 'char(13) DEFAULT NULL',
			// numéro d’aBonnement (numéro remis par Paybox)
			//'paybox_response_C'            => 'char(13) DEFAULT NULL', // Type de Carte retenu (cf. PBX_TYPECARTE)
			//'paybox_response_D'           => 'char(28) DEFAULT NULL', // Date de fin de validité de la carte du porteur. Format : AAMM
			'paybox_response_E'           => 'char(6) DEFAULT NULL',
			// Code réponse de la transaction (cf. Tableau 3 : Codes réponse PBX_RETOUR)
			//'paybox_response_F'             => 'char(1) DEFAULT NULL', //Etat de l’authentiFication du porteur vis-à-vis du programme 3-D Secure :
			//'paybox_response_G'              => 'char(1) DEFAULT NULL', // Garantie du paiement par le programme 3-D Secure. Format : O ou N
			//'paybox_response_J'       => 'smallint(1) DEFAULT NULL', // 2 derniers chiffres du numéro de carte du porteur
			//'paybox_response_N'       => 'smallint(1) DEFAULT NULL', // 6 premiers chiffres (« biN6 ») du numéro de carte de l’acheteur
			//'paybox_response_O'       => 'char(1) DEFAULT NULL', // 6 premiers chiffres (« biN6 ») du numéro de carte de l’acheteur
			'paybox_response_S'           => 'smallint(1) DEFAULT NULL',
			//Numéro de TranSaction Paybox


			'paybox_fullresponse'         => 'text DEFAULT NULL'
		);
		return $SQLfields;
	}

	function plgVmConfirmedOrder ($cart, $order) {

		if (!($this->_currentMethod = $this->getVmPluginMethod($order['details']['BT']->virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			return FALSE;
		}

		$pbxInterface = $this->_loadPayboxInterface($this);
		$this->logInfo('plgVmConfirmedOrder order number: ' . $order['details']['BT']->order_number, 'message');

		if (!class_exists('VirtueMartModelOrders')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
		}
		if (!class_exists('VirtueMartModelCurrency')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'currency.php');
		}


		$this->getPaymentCurrency($this->_currentMethod);
		$q = 'SELECT `currency_numeric_code` FROM `#__virtuemart_currencies` WHERE `virtuemart_currency_id`="' . $this->_currentMethod->payment_currency . '" ';
		$db = JFactory::getDBO();
		$db->setQuery($q);
		$currency_numeric_code = $db->loadResult();
		$totalInPaymentCurrency = vmPSPlugin::getAmountInCurrency($order['details']['BT']->order_total, $this->_currentMethod->payment_currency);
		$orderTotalVendorCurrency = $order['details']['BT']->order_total;
		$pbxOrderTotalInPaymentCurrency = $pbxInterface->getPbxAmount($totalInPaymentCurrency['value']);
		$email_currency = $this->getEmailCurrency($this->_currentMethod);

		// If the file is not there anylonger, just create it
		$this->createRootFile($this->_currentMethod->virtuemart_paymentmethod_id);

		if (!$pbxInterface->getPayboxServerUrl()) {
			$this->redirectToCart();
			return false;
		}
		if (!($payboxReturnUrls = $this->getPayboxReturnUrls($pbxInterface))) {
			$this->redirectToCart();
			return false;
		}


		$post_variables = Array(
			"PBX_SITE"        => $this->_currentMethod->site_id,
			"PBX_RANG"        => $this->_currentMethod->rang,
			"PBX_IDENTIFIANT" => $this->_currentMethod->identifiant,
			"PBX_TOTAL"       => $pbxInterface->getPbxTotal($pbxOrderTotalInPaymentCurrency),
			"PBX_DEVISE"      => $currency_numeric_code,
			"PBX_CMD"         => $order['details']['BT']->order_number,
			"PBX_PORTEUR"     => $order['details']['BT']->email,
			"PBX_RETOUR"      => $pbxInterface->getReturn(),
			"PBX_HASH"        => $pbxInterface->getHashAlgo(),
			"PBX_TIME"        => $pbxInterface->getTime(),
			"PBX_LANGUE"      => $pbxInterface->getLangue(),
			//"PBX_TYPEPAIEMENT" => $pbxInterface->getTypePaiement(),
			//"PBX_TYPECARTE"    => $pbxInterface->getTypeCarte(),
			"PBX_EFFECTUE"    => $payboxReturnUrls['url_effectue'],
			/*	"PBX_ATTENTE"     => $payboxReturnUrls['url_attente'],*/
			"PBX_ANNULE"      => $payboxReturnUrls['url_annule'],
			"PBX_REFUSE"      => $payboxReturnUrls['url_refuse'],
			"PBX_ERREUR"      => $payboxReturnUrls['url_erreur'],
			"PBX_REPONDRE_A"  => $payboxReturnUrls['url_notification'],
			"PBX_RUF1"        => 'POST',
		);
		if ($this->_currentMethod->debit_type == 'authorization_capture') {
			$post_variables["PBX_DIFF"] = str_pad($this->_currentMethod->diff, 2, '0', STR_PAD_LEFT);
		}

		// min_amount_3dsecure is in vendor currency
		if (!($this->_currentMethod->activate_3dsecure AND ($orderTotalVendorCurrency > $this->_currentMethod->min_amount_3dsecure))) {
			$post_variables["PBX_3DS"] = 'N';
		}
		jimport('joomla.environment.browser');
		$browser = JBrowser::getInstance();
		if ($browser->isMobile()) {
			$post_variables["PBX_SOURCE"] = 'XHTML';
		}
		$subscribe = array();
		$recurring = array();
		$post_variables["PBX_CMD"] = $order['details']['BT']->order_number;
		if ($this->_currentMethod->integration == "recurring" AND ($orderTotalVendorCurrency > $this->_currentMethod->recurring_min_amount)) {
			$recurring = $pbxInterface->getRecurringPayments($pbxOrderTotalInPaymentCurrency);
			// PBX_TOTAL will be replaced in the array_merge.
			$post_variables = array_merge($post_variables, $recurring);
		} else {
			if ($this->_currentMethod->integration == "subscribe" /*AND ($orderTotalVendorCurrency > $this->_currentMethod->subscribe_min_amount)*/) {
				$subscribe_data = $pbxInterface->getSubscribePayments($cart, $pbxInterface->getPbxAmount($orderTotalVendorCurrency));
				if ($subscribe_data) {
					// PBX_TOTAL is the order total in this case
					$post_variables["PBX_TOTAL"] = $subscribe_data["PBX_TOTAL"];
					$post_variables["PBX_CMD"] .= $subscribe_data['PBX_CMD'];
				}
			}
		}

		$post_variables["PBX_HMAC"] = $pbxInterface->getHmac($post_variables, $this->_currentMethod->key);

		// Prepare data that should be stored in the database
		$dbValues['order_number'] = $order['details']['BT']->order_number;
		$dbValues['virtuemart_order_id'] = $order['details']['BT']->virtuemart_order_id;
		$dbValues['payment_name'] = $this->renderPluginName($this->_currentMethod);
		$dbValues['virtuemart_paymentmethod_id'] = $cart->virtuemart_paymentmethod_id;
		$dbValues['paybox_custom'] = $this->getContext();
		$dbValues['cost_per_transaction'] = $this->_currentMethod->cost_per_transaction;
		$dbValues['cost_percent_total'] = $this->_currentMethod->cost_percent_total;
		$dbValues['payment_currency'] = $this->_currentMethod->payment_currency;
		$dbValues['email_currency'] = $email_currency;
		$dbValues['payment_order_total'] = $post_variables["PBX_TOTAL"];
		if (!empty($recurring)) {
			$dbValues['recurring'] = json_encode($recurring);
			$dbValues['recurring_number'] = $this->_currentMethod->recurring_number;
			$dbValues['recurring_periodicity'] = $this->_currentMethod->recurring_periodicity;
		} else {
			$dbValues['recurring'] = NULL;
		}
		if (!empty($subscribe)) {
			$dbValues['subscribe'] = json_encode($subscribe);
			//$dbValues['recurring_number'] = $this->_currentMethod->recurring_number;
			//$dbValues['recurring_periodicity'] = $this->_currentMethod->recurring_periodicity;
		} else {
			$dbValues['subscribe'] = NULL;
		}

		$dbValues['tax_id'] = $this->_currentMethod->tax_id;
		$this->storePSPluginInternalData($dbValues);

		$html = $this->getConfirmedHtml($post_variables, $pbxInterface);

		// 	2 = don't delete the cart, don't send email and don't redirect
		$cart->_confirmDone = FALSE;
		$cart->_dataValidated = FALSE;
		$cart->setCartIntoSession();
		JRequest::setVar('display_title', false);
		JRequest::setVar('html', $html);

		return;
	}

	function getPayboxReturnUrls ($pbxInterface) {
		$urlLength = true;
		$test=false;
		if ($test) {

				$payboxURLs['url_effectue'] = JURI::root() . $this->getPayboxFileName($this->_currentMethod->virtuemart_paymentmethod_id) . '?pbx=ok&lang=' . JRequest::getCmd('lang', '') . '&Itemid=' . pbxRequest::getInt('Itemid');
				$url_cancelled = JURI::root() . $this->getPayboxFileName($this->_currentMethod->virtuemart_paymentmethod_id) . '?pbx=ko&lang=' . JRequest::getCmd('lang', '') . '&Itemid=' . pbxRequest::getInt('Itemid');
				$payboxURLs['url_annule'] = $url_cancelled;
				$payboxURLs['url_refuse'] = $url_cancelled;
				$payboxURLs['url_erreur'] = $url_cancelled;
				$payboxURLs['url_notification'] = JURI::root() . $this->getPayboxFileName($this->_currentMethod->virtuemart_paymentmethod_id) . '?pbx=no&lang=' . JRequest::getCmd('lang', '');
				$payboxURLs['url_attente'] = JURI::root() . $this->getPayboxFileName($this->_currentMethod->virtuemart_paymentmethod_id) . '?pbx=no&lang=' . JRequest::getCmd('lang', '');


		} else {
			$url_cancelled = JURI::root() . 'index.php?option=com_virtuemart&view=cart&lang=' . JRequest::getCmd('lang', '') . '&Itemid=' . pbxRequest::getInt('Itemid');
			$payboxURLs['url_annule'] = $url_cancelled;
			$payboxURLs['url_refuse'] = $url_cancelled;
			$payboxURLs['url_erreur'] = $url_cancelled;
			$payboxURLs['url_notification'] = JURI::root() . 'index.php?option=com_virtuemart&format=raw&view=pluginresponse&task=pluginnotification&tmpl=component&pm=' . $this->_currentMethod->virtuemart_paymentmethod_id;
			$payboxURLs['url_effectue'] = $this->getUrlOk($pbxInterface);
		}




		foreach ($payboxURLs as $payboxURL) {
			//$this->debugLog($payboxURL, 'getPayboxReturnUrls','debug');
			if (!$this->checkURLsLength($payboxURL)) {
				$urlLength = false;
			}
		}
		if ($urlLength) {
			return $payboxURLs;
		} else {
			$this->debugLog('FALSE', 'getPayboxReturnUrls','debug');
			return false;
		}
	}

	function checkURLsLength ($url) {
		$public_msg = "";
		if (strlen($url) > self::PBX_MAX_URL_LEN) {
			$msg = 'checking URL length<br />Your URL:' . $url . ' has ' . strlen($url) . '  characters.';
			$msg .= 'The maximum allowed by the payment is ' . self::PBX_MAX_URL_LEN;
			$msg .= 'Please contact your payment provider';
			$this->pbxError($msg);
			$this->debugLog($msg, 'checkURLsLength FALSE','debug');
			return false;
		}
		return true;
	}


	function getUrlOk ($pbxInterface) {
		$urlOkParms = $this->getUrlOkParms();
		$query = $pbxInterface->stringifyArray($urlOkParms);
		$urlOk = JURI::root() . 'index.php?' . $query;
		return $urlOk;
	}

	/**
	 *        $url_ok = JURI::root() . 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginresponsereceived&pm=' . $order['details']['BT']->virtuemart_paymentmethod_id . '&Itemid=' . pbxRequest::getInt('Itemid');
	 * @return array
	 */
	function getUrlOkParms () {
		$urlOkParms = array(
			"option" => "com_virtuemart",
			"view"   => "pluginresponse",
			"task"   => "pluginresponsereceived",
			"pm"     => $this->_currentMethod->virtuemart_paymentmethod_id,
			"lang"   => pbxRequest::uWord('lang', ''),
			"Itemid" => pbxRequest::getInt('Itemid'),
		);
		return $urlOkParms;
	}

	function plgVmgetPaymentCurrency ($virtuemart_paymentmethod_id, &$paymentCurrencyId) {

		if (!($method = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($method->payment_element)) {
			return FALSE;
		}
		$this->getPaymentCurrency($method);
		$paymentCurrencyId = $method->payment_currency;
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
		if (!class_exists('pbxRequest')) {
			require(JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'pbxRequest.php');
		}

		VmConfig::loadJLang('com_virtuemart_orders', TRUE);

		$virtuemart_paymentmethod_id = pbxRequest::getInt('pm', 0);

		if (!($this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			return NULL;
		}
		$paybox_data = pbxRequest::getGet();

		$this->debugLog('"<pre>plgVmOnPaymentResponseReceived :' . var_export($paybox_data, true) . "</pre>", 'debug');
		$pbxInterface = $this->_loadPayboxInterface($this);
		if ($payboxResponseValid = $this->isPayboxResponseValid($pbxInterface, $paybox_data, false, true)) {
			// we don't do anything actually, it is probably an invalid signature.
			// we do not update order status and let IPN do his job
		}
		$order_number = $pbxInterface->getOrderNumber($paybox_data['R']);
		if (empty($order_number)) {
			$this->debugLog($order_number, 'getOrderNumber not correct' . $paybox_data['R'], 'debug', false);
			return FALSE;
		}
		if (!($virtuemart_order_id = VirtueMartModelOrders::getOrderIdByOrderNumber($order_number))) {
			return FALSE;
		}

		if (!($payments = $this->getDatasByOrderId($virtuemart_order_id))) {
			$this->debugLog('no payments found', 'getDatasByOrderId', 'debug', false);
			return FALSE;
		}

		$orderModel = VmModel::getModel('orders');
		$order = $orderModel->getOrder($virtuemart_order_id);
		$paybox_data = $pbxInterface->unsetNonPayboxData($paybox_data);
		$success = ($paybox_data['E'] == $pbxInterface::RESPONSE_SUCCESS);
		$extra_comment = "";
		// The order status is nly updated if the validation is ok

		if ($payboxResponseValid) {
			if (count($payments) == 1) {
				// NOTIFY not received
				$order_history = $this->updateOrderStatus($pbxInterface, $paybox_data, $order, $payments);
				if (isset($order_history['extra_comment'])) {
					$extra_comment = $order_history['extra_comment'];
				}
			}
		}


		$html = $this->getResponseHTML($order, $paybox_data, $success, $extra_comment);
		$cart = VirtueMartCart::getCart();
		$cart->emptyCart();
		JRequest::setVar('display_title', false);
		JRequest::setVar('html', $html);

		return TRUE;

	}


	function redirectToCart () {
		$app = JFactory::getApplication();
		$app->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart&lg=&Itemid=' . pbxRequest::getInt('Itemid'), false), vmText::_('VMPAYMENT_PAYBOX_ERROR_TRY_AGAIN'));
	}

	function plgVmOnUserPaymentCancel () {

		if (!class_exists('VirtueMartModelOrders')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
		}
		if (!class_exists('pbxRequest')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'pbxRequest.php');
		}
		//  $order_number = pbxRequest::getUword('on');
		$order_number = pbxRequest::getUword('on');
		if (!$order_number) {
			return FALSE;
		}
		$numerr = JRequest::getString('E', '');
		if ($numerr) {
			VmInfo('VMPAYMENT_PAYBOX_PBX_NUMERR_' . abs($numerr));
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
	 *   plgVmOnPaymentNotification() - This event is fired by Offline Payment. It can be used to validate the payment data as entered by the user.
	 * Return:
	 * Parameters:
	 *  None
	 * @author Valerie Isaksen
	 */

	function plgVmOnPaymentNotification () {

		if (!class_exists('VirtueMartModelOrders')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
		}
		if (!class_exists('pbxRequest')) {
			require(JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'pbxRequest.php');
		}
		$paybox_data = pbxRequest::getPost();
		$virtuemart_paymentmethod_id = pbxRequest::getInt('pm', 0);
		$this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id);
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			//$this->debugLog('Not this one', 'selectedThisElement', 'debug', false);
			return;
		}
		$this->debugLog(var_export($paybox_data, true), 'plgVmOnPaymentNotification pbxRequest::getPost', 'debug', false);
		$pbxInterface = $this->_loadPayboxInterface($this);

		if (!$this->isPayboxResponseValid($pbxInterface, $paybox_data,  true, false)) {
			return FALSE;
		}
		$order_number = $pbxInterface->getOrderNumber($paybox_data['R']);
		if (empty($order_number)) {
			$this->debugLog($order_number, 'getOrderNumber not correct' . $paybox_data['R'], 'debug', false);
			return FALSE;
		}
		if (!($virtuemart_order_id = VirtueMartModelOrders::getOrderIdByOrderNumber($order_number))) {
			return FALSE;
		}

		if (!($payments = $this->getDatasByOrderId($virtuemart_order_id))) {
			$this->debugLog('no payments found', 'getDatasByOrderId', 'debug', false);
			return FALSE;
		}

		$orderModel = VmModel::getModel('orders');
		$order = $orderModel->getOrder($virtuemart_order_id);
		$extra_comment = "";
		if (count($payments) == 1) {
			// NOTIFY not received
			$order_history = $this->updateOrderStatus($pbxInterface, $paybox_data, $order, $payments);
			if (isset($order_history['extra_comment'])) {
				$extra_comment = $order_history['extra_comment'];
			}
		}

		if (!empty($payments[0]->paybox_custom)) {
			$this->emptyCart($payments[0]->paybox_custom, $order['details']['BT']->order_number);
			$this->setEmptyCartDone($payments[0]);
		}


		return TRUE;
	}

	/**
	 * @param      $pbxInterface
	 * @param      $paybox_data
	 * @param      $payments
	 * @param      $order
	 * @param bool $checkIps
	 * @param bool $useQuery
	 * @return bool
	 */
	function isPayboxResponseValid ($pbxInterface, $paybox_data,  $checkIps = false, $useQuery = false) {
		if ($checkIps) {
			if (($msg = $pbxInterface->checkIps()) !== true) {
				$this->debugLog($msg, 'checkIps', 'error', false);
				return FALSE;
			}
		}
		$unsetNonPayboxData=true;
		if ($this->checkSignature($pbxInterface, $paybox_data, $unsetNonPayboxData,$useQuery) != 1) {
			$msg = 'Got a Paybox request with invalid signature';
			$this->debugLog($msg, 'checkSignature', 'error', false);
			return FALSE;
		} else {
			$this->debugLog('Got a Paybox request VALID signature', 'checkSignature', 'debug', false);
		}

		$order_number = $pbxInterface->getOrderNumber($paybox_data['R']);
		if (empty($order_number)) {
			$this->debugLog($order_number, 'getOrderNumber not correct' . $paybox_data['R'], 'debug', false);
			return FALSE;
		}
		if (!($virtuemart_order_id = VirtueMartModelOrders::getOrderIdByOrderNumber($order_number))) {
			return FALSE;
		}

		if (!($payments = $this->getDatasByOrderId($virtuemart_order_id))) {
			$this->debugLog('no payments found', 'getDatasByOrderId', 'debug', false);
			return FALSE;
		}

		$orderModel = VmModel::getModel('orders');
		$order = $orderModel->getOrder($virtuemart_order_id);


		return true;
	}

	/**
	 * @param $firstPayment
	 */
	function setEmptyCartDone ($firstPayment) {
		$firstPayment = (array)$firstPayment;
		$firstPayment['paybox_custom'] = NULL;
		$this->storePSPluginInternalData($firstPayment, $this->_tablepkey, true);
	}

	/**
	 * @param $pbxInterface
	 * @param $paybox_data
	 * @param $order
	 * @return bool
	 */
	function updateOrderStatus ($pbxInterface, $paybox_data, $order, $payments) {

		$success = ($paybox_data['E'] == $pbxInterface::RESPONSE_SUCCESS);
		if ($success) {
			$order_history = $pbxInterface->getOrderHistory($paybox_data, $order, $payments);

		} else {
			$order_history['comments'] = JText::sprintf('VMPAYMENT_PAYBOX_PAYMENT_STATUS_CANCELLED', $order['details']['BT']->order_number);
			$order_history['order_status'] = $this->_currentMethod->status_canceled;
			$order_history['customer_notified'] = true;
		}
		//$this->debugLog($success, 'updateOrderStatus', 'error', false);


		$db_values['virtuemart_order_id'] = $order['details']['BT']->virtuemart_order_id;
		$db_values['order_number'] = $order['details']['BT']->order_number;
		$db_values['virtuemart_paymentmethod_id'] = $this->_currentMethod->virtuemart_paymentmethod_id;
		// get all know columns of the table
		$db = JFactory::getDBO();
		$query = 'SHOW COLUMNS FROM `' . $this->_tablename . '` ';
		$db->setQuery($query);
		$columns = $db->loadResultArray(0);
		foreach ($paybox_data as $key => $value) {
			$table_key = 'paybox_response_' . $key;
			if (in_array($table_key, $columns)) {
				$db_values[$table_key] = $value;
			}
		}
		$db_values['paybox_fullresponse'] = json_encode($paybox_data);

		$this->debugLog('updateOrderStatus storePSPluginInternalData:' . var_export($db_values, true), 'debug');

		$this->storePSPluginInternalData($db_values);

		$modelOrder = VmModel::getModel('orders');
		$modelOrder->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order_history, TRUE);
		return $order_history;
	}


	/**
	 * Display stored payment data for an order
	 *
	 * @see components/com_virtuemart/helpers/vmPSPlugin::plgVmOnShowOrderBEPayment()
	 */
	function plgVmOnShowOrderBEPayment ($virtuemart_order_id, $payment_method_id) {

		if (!$this->selectedThisByMethodId($payment_method_id)) {
			return NULL; // Another method was selected, do nothing
		}

		$db = JFactory::getDBO();
		$q = 'SELECT * FROM `' . $this->_tablename . '` WHERE ';
		$q .= ' `virtuemart_order_id` = ' . $virtuemart_order_id;

		$db->setQuery($q);
		$payments = $db->loadObjectList();

		$html = '<table class="adminlist" width="50%">' . "\n";
		$html .= $this->getHtmlHeaderBE();
		$first = TRUE;
		$lang = JFactory::getLanguage();
		foreach ($payments as $payment) {
			$html .= '<tr class="row1"><td>' . JText::_('VMPAYMENT_PAYBOX_DATE') . '</td><td align="left">' . $payment->created_on . '</td></tr>';
			// Now only the first entry has this data when creating the order
			if ($first) {
				$html .= $this->getHtmlRowBE('PAYBOX_PAYMENT_NAME', $payment->payment_name);
				// keep that test to have it backwards compatible. Old version was deleting that column  when receiving an IPN notification
				if ($payment->payment_order_total and  $payment->payment_order_total != 0.00) {
					$html .= $this->getHtmlRowBE('PAYBOX_PAYMENT_ORDER_TOTAL', ($payment->payment_order_total * 0.01) . " " . shopFunctions::getCurrencyByID($payment->payment_currency, 'currency_code_3'));
				}
				if ($payment->email_currency and  $payment->email_currency != 0) {
					//$html .= $this->getHtmlRowBE('PAYBOX_PAYMENT_EMAIL_CURRENCY', shopFunctions::getCurrencyByID($payment->email_currency, 'currency_code_3'));
				}
				if ($payment->recurring) {

					$recurring_html = '<table class="adminlist">' . "\n";
					$recurring = json_decode($payment->recurring);
					$recurring_html .= $this->getHtmlRowBE('PAYBOX_CONF_RECURRING_PERIODICTY', $payment->recurring_periodicity);
					$recurring_html .= $this->getHtmlRowBE('PAYBOX_CONF_RECURRING_NUMBER', $payment->recurring_number);
					//$recurring_html .= $this->getHtmlRowBE(VmText::_('VMPAYMENT_PAYBOX_CONF_RECURRING_PERIODICTY').' '. $payment->recurring_periodicity, VmText::_('VMPAYMENT_PAYBOX_CONF_RECURRING_NUMBER').' '. $payment->recurring_number);
					for ($i = 1; $i < $payment->recurring_number; $i++) {
						$index_mont = "PBX_2MONT" . $i;
						$index_date = "PBX_DATE" . $i;
						$text_mont = vmText::_('VMPAYMENT_PAYBOX_PAYMENT_RECURRING_2MONT') . " " . $i;
						$text_date = vmText::_('VMPAYMENT_PAYBOX_PAYMENT_RECURRING_DATE') . " " . $i;
						//$recurring_html .= $this->getHtmlRowBE($text_date, $recurring->$index_date);
						//$recurring_html .= $this->getHtmlRowBE($text_mont, ($recurring->$index_mont * 0.01) . " " . shopFunctions::getCurrencyByID($payment->payment_currency, 'currency_code_3'));
						$recurring_html .= $this->getHtmlRowBE($recurring->$index_date, ($recurring->$index_mont * 0.01) . " " . shopFunctions::getCurrencyByID($payment->payment_currency, 'currency_code_3'));
					}
					$recurring_html .= '</table>' . "\n";
					$html .= $this->getHtmlRowBE('PAYBOX_RECURRING', $recurring_html);
				}
				$first = FALSE;
			} else {
				if (!empty($payment->paybox_fullresponse)) {
					$paybox_data = json_decode($payment->paybox_fullresponse);
					$showOrderBEFields = $this->getOrderBEFields();
					$prefix = 'PAYBOX_RESPONSE_';
					foreach ($showOrderBEFields as $showOrderBEField) {
						if (isset($paybox_data->$showOrderBEField) and !empty($paybox_data->$showOrderBEField)) {
							$key = $prefix . $showOrderBEField;
							if (method_exists($this, 'getValueBE_' . $showOrderBEField)) {
								$function = 'getValueBE_' . $showOrderBEField;
								$paybox_data->$showOrderBEField = $this->$function($paybox_data->$showOrderBEField);
							}
							$html .= $this->getHtmlRowBE($key, $paybox_data->$showOrderBEField);
						}
					}
					$html .= '<tr><td></td><td>
    <a href="#" class="PayboxLogOpener" rel="' . $payment->id . '" >
        <div style="background-color: white; z-index: 100; right:0; display: none; border:solid 2px; padding:10px;" class="vm-absolute" id="PayboxLog_' . $payment->id . '">';
					foreach ($paybox_data as $key => $value) {
						$langKey = 'VMPAYMENT_' . $prefix . $key;
						if ($lang->hasKey($langKey)) {
							$label = vmText::_($langKey);
						} else {
							$label = $key;
						}
						$html .= ' <b>' . $label . '</b>:&nbsp;' . wordwrap($value, 50, "\n", true) . '<br />';
					}

					$html .= ' </div>
        <span class="icon-nofloat vmicon vmicon-16-xml"></span>&nbsp;';
					$html .= vmText::_('VMPAYMENT_PAYBOX_VIEW_TRANSACTION_LOG');
					$html .= '  </a>';
					$html .= ' </td></tr>';
				}
			}
		}

		$html .= '</table>' . "\n";
		$doc = JFactory::getDocument();
		$js = "
	jQuery().ready(function($) {
		$('.PayboxLogOpener').click(function() {
			var logId = $(this).attr('rel');
			$('#PayboxLog_'+logId).toggle();
			return false;
		});
	});";
		$doc->addScriptDeclaration($js);

		return $html;
	}

	function getValueBE_M ($value) {
		return $value * 0.01;
	}

	function getValueBE_D ($value) {
		return substr($value, 0, -2) . "/" . substr($value, -2);
	}

	function getOrderBEFields () {
		$fields = array(
			'M',
			//'R',
			//'T',
			'E',
			//	'A',
			'B',
			'P',
			'C',
			'S',
			//'Y',
			'N',
			'J',
			'D',
			//'H',
			'G',
			'O',
			'F',
			//	'W',
			//		'Z',
//			'K', // MUST BE THE LAST ONE
		);
		return $fields;

	}


	private function getExtraPluginNameInfo ($activeMethod) {
		$this->_currentMethod = $activeMethod;

		$payboxInterface = $this->_loadPayboxInterface();
		$extraInfo = $payboxInterface->getExtraPluginNameInfo();

		return $extraInfo;

	}

	/**
	 * @param plugin $method
	 * @return mixed|string
	 */
	protected function renderPluginName ($method) {
		$logos = $method->payment_logos;
		$display_logos = '';
		if (!empty($logos)) {
			$display_logos = $this->displayLogos($logos) . ' ';
		}
		$payment_name = $method->payment_name;
		if (!class_exists('VirtueMartCart')) {
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		}
		$this->_currentMethod = $method;
		$extraInfo = $this->getExtraPluginNameInfo($method);

		$html = $this->renderByLayout('render_pluginname', array(
		                                                        'shop_mode'                   => $method->shop_mode,
		                                                        'virtuemart_paymentmethod_id' => $method->virtuemart_paymentmethod_id,
		                                                        'logo'                        => $display_logos,
		                                                        'payment_name'                => $payment_name,
		                                                        'payment_description'         => $method->payment_desc,
		                                                        'extraInfo'                   => $extraInfo,
		                                                   ));
		$html = $this->rmspace($html);
		return $html;
	}

	private function rmspace ($buffer) {
		return preg_replace('~>\s*\n\s*<~', '><', $buffer);
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
		$payboxInterface = $this->_loadPayboxInterface();
		if (!$payboxInterface->getPayboxServerUrl()) {
			$this->debugLog('getPayboxServerUrl FALSE', 'checkConditions','debug');
			$this->PbxError('No Pbx server available');
			return false;
		}
		if (!$this->getPayboxReturnUrls($payboxInterface)) {
			$this->debugLog('getPayboxReturnUrls FALSE', 'checkConditions','debug');
			return false;
		}
		$this->convert_condition_amount($method);
		$address = (($cart->ST == 0) ? $cart->BT : $cart->ST);

		$amount = $cart_prices['salesPrice'];
		$amount_cond = true;

		if ($method->integration == 'recurring' AND $amount <= $method->recurring_min_amount) {
			$this->debugLog('recurring_min_amount FALSE'.$amount.' '.$method->recurring_min_amount, 'checkConditions','debug');
			return false;
		}



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
		$this->debugLog(' FALSE', 'checkConditions','debug');
		return FALSE;
	}

	function convert_condition_amount (&$method) {
		$method->recurring_min_amount = (float)str_replace(',', '.', $method->recurring_min_amount);
		$method->min_amount_3dsecure = (float)str_replace(',', '.', $method->min_amount_3dsecure);
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
		if ($res = $this->selectedThisByJPluginId($jplugin_id)) {

			$virtuemart_paymentmethod_id = pbxRequest::getInt('virtuemart_paymentmethod_id');
			$method = $this->getPluginMethod($virtuemart_paymentmethod_id);
			vmdebug('plgVmOnStoreInstallPaymentPluginTable', $method, $virtuemart_paymentmethod_id);
			//$this->createRootFile($method->virtuemart_paymentmethod_id);
			/*
						$mandatory_fields = array('site_id', 'rang', 'identifiant', 'key');
						foreach ($mandatory_fields as $mandatory_field) {
							if (empty($method->$mandatory_field)) {
								vmError(vmText::sprintf('VMPAYMENT_PAYBOX_CONF_MANDATORY_PARAM', vmText::_('VMPAYMENT_PAYBOX_CONF_' . $mandatory_field)));
							}
						}
			*/
			if (!extension_loaded('curl')) {
				vmError(vmText::sprintf('VMPAYMENT_PAYBOX_CONF_MANDATORY_PHP_EXTENSION', 'curl'));
			}
			if (!extension_loaded('openssl')) {
				vmError(vmText::sprintf('VMPAYMENT_PAYBOX_CONF_MANDATORY_PHP_EXTENSION', 'openssl'));
			}
		}

		return $this->onStoreInstallPluginTable($jplugin_id);
	}


	/**
	 * @param $virtuemart_paymentmethod_id
	 * @return bool
	 */
	function createRootFile ($virtuemart_paymentmethod_id) {
		$created = false;
		$filename = $this->getPayboxRootFileName($virtuemart_paymentmethod_id);
		if (!JFile::exists($filename)) {
			$content = '
<?php
	/**
	* File used by the Paybox VirtueMart Payment plugin
	**/
	$get=filter_var_array($_GET, FILTER_SANITIZE_STRING);
	$_GET["option"]="com_virtuemart";
	$_GET["element"]="paybox";
	$_GET["pm"]=' . $virtuemart_paymentmethod_id . ';
	$_REQUEST["option"]="com_virtuemart";
	$_REQUEST["element"]="paybox";
	$_REQUEST["pm"]=' . $virtuemart_paymentmethod_id . ';
    if ($get["pbx"]=="ok") {
		$_GET["view"]="pluginresponse";
		$_GET["task"]="pluginresponsereceived";
		$_REQUEST["view"]="pluginresponse";
		$_REQUEST["task"]="pluginresponsereceived";
	} elseif ($get["pbx"]=="no") {
		$_GET["view"]="pluginresponse";
		$_GET["task"]="pluginnotification";
		$_GET["format"]="raw";
		$_GET["tmpl"]="component";
		$_REQUEST["view"]="pluginresponse";
		$_REQUEST["task"]="pluginnotification";
		$_REQUEST["format"]="raw";
		$_REQUEST["tmpl"]="component";
	} elseif ($get["pbx"]=="ko") {
		$_GET["view"]="pluginresponse";
		$_REQUEST["view"]="pluginresponse";
		$_REQUEST["view"]="pluginUserPaymentCancel";
	}
	include("index.php");
';
			if (!JFile::write($filename, $content)) {
				$msg = 'Could not write in file  ' . $filename . ' to store paybox information. Check your file ' . $filename . ' permissions.';
				vmError($msg);
			}
			$created = true;
		}
		return $created;
	}

	function getPayboxRootFileName ($virtuemart_paymentmethod_id) {
		$filename = JPATH_SITE . '/' . $this->getPayboxFileName($virtuemart_paymentmethod_id);
		return $filename;
	}

	function getPayboxFileName ($virtuemart_paymentmethod_id) {
		return 'vmpayment' . '_' . $virtuemart_paymentmethod_id . '.php';
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

	public function plgVmonSelectedCalculatePricePayment (VirtueMartCart $cart, array &$cart_prices, &$cart_prices_name) {

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
	 */
	public function plgVmOnCheckoutCheckDataPayment (VirtueMartCart $cart) {
		return true;
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


	function getHash () {

		return "SHA512";
	}


	function getSignedData ($qrystr, &$data, &$sig, $url) { // renvoi les donnes signees et la signature

		$pos = strrpos($qrystr, '&'); // cherche dernier separateur
		$data = substr($qrystr, 0, $pos); // et voila les donnees signees
		$pos = strpos($qrystr, '=', $pos) + 1; // cherche debut valeur signature
		$sig = substr($qrystr, $pos); // et voila la signature
		if ($url) {
			$sig = urldecode($sig);
		} // decodage signature url
		$sig = base64_decode($sig); // decodage signature base 64
	}

	/**
	 * @param $post_variables
	 * @return string
	 */
	function getConfirmedHtml ($post_variables, $pbxInterface) {
		$pbxServer = $pbxInterface->getPayboxServerUrl();

		// add spin image
		$html = '<html><head><title>Redirection</title></head><body><div style="margin: auto; text-align: center;">';
		if ($this->_currentMethod->debug) {
			$html .= '<form action="' . $pbxServer . '" method="post" name="vm_paybox_form" target="paybox">';
		} else {
			$html .= '<form action="' . $pbxServer . '" method="post" name="vm_paybox_form" >';
		}

		foreach ($post_variables as $name => $value) {
			$html .= '<input type="hidden" name="' . $name . '" value="' . $value . '" />';
		}

		if ($this->_currentMethod->debug) {
			$this->debugLog($this->_currentMethod->virtuemart_paymentmethod_id, 'sendPostRequest: payment method', 'debug');
			$this->debugLog($pbxServer, 'sendPostRequest: Server', 'debug');
			$html .= '<div style="background-color:red;color:white;padding:10px;">
						<input type="submit"  value="The method is in debug mode. Click here to be redirected to Paybox" />
						</div>';
			$this->debugLog($post_variables, 'sendPostRequest:', 'debug');

		} else {

			$html .= '<input type="submit"  value="' . JText::_('VMPAYMENT_PAYBOX_REDIRECT_MESSAGE') . '" />
					<script type="text/javascript">';
			$html .= '		document.vm_paybox_form.submit();';
			$html .= '	</script>';
		}
		$html .= '</form></div>';
		$html .= '</body></html>';

		return $html;
	}


	function verif_ip ($method) {

		$ip_adresses = explode("-", $method->ips);
		if (is_array($ip_adresses)) {
			foreach ($ip_adresses as $ip_adresse) {
				if (trim($ip_adresse) == $_SERVER['REMOTE_ADDR']) {
					return TRUE;
				}
			}
			return FALSE;
		}
		// it is not an array: the customer does not want ot check for IP
		return TRUE;
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
	private function _loadPayboxInterface () {

		if ($this->_currentMethod->integration == 'recurring') {
			if (!class_exists('PayboxHelperPayboxRecurring')) {
				require(JPATH_SITE . '/plugins/vmpayment/paybox/paybox/helpers/recurring.php');
			}
			$payboxInterface = new PayboxHelperPayboxRecurring($this->_currentMethod, $this);
		} elseif ($this->_currentMethod->integration == 'subscribe') {
			if (!class_exists('PayboxHelperPayboxSubscribe')) {
				require(JPATH_SITE . '/plugins/vmpayment/paybox/paybox/helpers/subscribe.php');
			}
			$payboxInterface = new PayboxHelperPayboxSubscribe($this->_currentMethod, $this);
		} else {
			$payboxInterface = new PayboxHelperPaybox($this->_currentMethod, $this);
		}
		return $payboxInterface;
	}

	private static function getPayboxSafepath () {

		$safePath = VmConfig::get('forSale_path', '');
		if (empty($safePath)) {
			return NULL;
		}
		$payboxSafePath = $safePath . self::PAYBOX_FOLDERNAME;
		return $payboxSafePath;
	}

	function getEmailCurrency (&$method) {

		if (!isset($method->email_currency)  or $method->email_currency == 'vendor') {
			// 	    if (!class_exists('VirtueMartModelVendor')) require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'vendor.php');
			$vendorId = 1; //VirtueMartModelVendor::getLoggedVendor();
			$db = JFactory::getDBO();

			$q = 'SELECT   `vendor_currency` FROM `#__virtuemart_vendors` WHERE `virtuemart_vendor_id`=' . $vendorId;
			$db->setQuery($q);
			return $db->loadResult();
		} else {
			return $method->payment_currency; // either the vendor currency, either same currency as payment
		}
	}

	private function getKeyFileName () {
		return 'pubkey.pem';
	}

	private function checkSignature ($pbxInterface, $paybox_data, $unsetNonPayboxData = true, $useQuery = true) {
		if (!$useQuery) {
			//
			// some SEF components changes the variable order !!!!!!!
			$paybox_data = $this->getVariablesInPbxOrder($pbxInterface, $paybox_data);
			if ($unsetNonPayboxData) {
				$paybox_data = $pbxInterface->unsetNonPayboxData($paybox_data);
			}
			$query_string = $pbxInterface->stringifyArray($paybox_data);
		} else {
			$this->debugLog('TAKE QUERY' ,'checkSignature', 'debug');
			parse_str($_SERVER['QUERY_STRING'], $paybox_data);
			$paybox_data = $this->getVariablesInPbxOrder($pbxInterface, $paybox_data);
			$query_string = $pbxInterface->stringifyArray($paybox_data);
			$query_string=$_SERVER['QUERY_STRING'];
		}
		$this->debugLog('checkSignature query:' . $query_string, 'debug');
		$keyFile = $this->getPayboxSafepath() . '/' . $this->getKeyFileName();
		$this->debugLog('checkSignature :' . $keyFile, 'debug');

		$pbxIsValidSignature = $pbxInterface->pbxIsValidSignature($keyFile, $query_string);
		if (!$useQuery) {
			// only send an error message if the error does not come from PBX_EFFECTUE
			//$msg .= '            ' . 'sig ' . $sig . '<br />';
			// we cannot send an error at this stage because may be the signature is not valid from the
			$this->debugLog(JText::_('VMPAYMENT_PAYBOX_ERROR_SIGNATURE_INVALID').var_export($paybox_data, true),'pbxIsValidSignature', 'error');
		}
		$this->debugLog('pbxIsValidSignature :' . $pbxIsValidSignature,'checkSignature', 'debug');
		return $pbxIsValidSignature;

	}

	/**
	 * some SEF components changes the variable order !!!!!!! ^
	 * we need to have them in the same order as they are recieved to check the signature
	 * @param $paybox_data
	 * @return mixed
	 */
	private function getVariablesInPbxOrder ($pbxInterface, $paybox_data) {
		$this->debugLog('getVariablesInPbxOrder :' . var_export($paybox_data, true), 'debug');

		$paybox_data_ordered = array();
		$urlOkParms = $this->getUrlOkParms();
		foreach ($urlOkParms as $key => $urlOkParm) {
			$paybox_data_ordered[$key] = $paybox_data[$key];
		}
		$returnFields = $pbxInterface->getReturnFields();
		foreach ($returnFields as $returnField) {
			if (isset($paybox_data[$returnField])) {
				$paybox_data_ordered[$returnField] = $paybox_data[$returnField];
			}
		}
		$this->debugLog('getVariablesInPbxOrder PBX order:' . var_export($paybox_data_ordered, true), 'debug');

		return $paybox_data_ordered;


	}

	private function getContext () {

		$session = JFactory::getSession();
		return $session->getId();
	}

	/**
	 * @param $message
	 */
	function pbxError ($message) {
		$public = "";
		if ($this->_currentMethod->debug) {
			$public = $message;
		}
		vmError($message, $public);
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
