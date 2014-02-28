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

class plgVmpaymentPaybox extends vmPSPlugin {
	const PAYBOX_FOLDERNAME = "paybox";

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

		$this->setConfigParameterable($this->_configTableFieldName, $varsToPush);
		if (!JFactory::getApplication()->isSite()) {
			$doc = JFactory::getDocument();
			$doc->addScript(JURI::root(true) . '/plugins/vmpayment/' . $this->_name . '/' . $this->_name . '/assets/js/admin.js');
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

		$pbxHelper = new PayboxHelperPaybox($this);
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
		$pbx_total = $totalInPaymentCurrency['value'] * 100;
		$email_currency = $this->getEmailCurrency($this->_currentMethod);

		$url_cancelled = JURI::root() . 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginUserPaymentCancel&on=' . $order['details']['BT']->order_number . '&pm=' . $order['details']['BT']->virtuemart_paymentmethod_id . '&Itemid=' . JRequest::getInt('Itemid');
		$url_notification = JURI::root() . 'index.php?option=com_virtuemart&format=raw&view=pluginresponse&task=pluginnotification&tmpl=component&element=paybox';
		$url_ok = JURI::root() . 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginresponsereceived&pm=' . $order['details']['BT']->virtuemart_paymentmethod_id . '&Itemid=' . JRequest::getInt('Itemid');


		$post_variables = Array(
			"PBX_SITE"         => $this->_currentMethod->site_id,
			"PBX_RANG"         => $this->_currentMethod->rang,
			"PBX_IDENTIFIANT"  => $this->_currentMethod->identifiant,
			"PBX_TOTAL"        => $pbx_total,
			"PBX_DEVISE"       => $currency_numeric_code,
			"PBX_CMD"          => $order['details']['BT']->order_number,
			"PBX_PORTEUR"      => $order['details']['BT']->email,
			"PBX_RETOUR"       => $pbxHelper->getReturn(),
			"PBX_HASH"         => $pbxHelper->getHashAlgo(),
			"PBX_TIME"         => $pbxHelper->getTime(),
			"PBX_LANGUE"       => $pbxHelper->getLangue(),
			"PBX_TYPEPAIEMENT" => $pbxHelper->getTypePaiement(),
			"PBX_TYPECARTE"    => $pbxHelper->getTypeCarte(),
			"PBX_EFFECTUE"     => $url_ok,
			"PBX_ANNULE"       => $url_cancelled,
			"PBX_REFUSE"       => $url_cancelled,
			"PBX_ERREUR"       => $url_cancelled,
			"PBX_REPONDRE_A"   => $url_notification,
			//"PBX_RUF1"         => 'POST',
		);
		if ($this->_currentMethod->debit_type == 'authorization_capture') {
			$post_variables["PBX_DIFF"] = $this->_currentMethod->diff;
		}
		// min_amount_3dsecure is in vendor currency
		if (!($this->_currentMethod->activate_3dsecure AND ($order['details']['BT']->order_total * 100) > $this->_currentMethod->min_amount_3dsecure)) {
			$post_variables["PBX_3DS"] = 'N';
		}
		if ($this->_currentMethodactivate_paymentplans) {
			$post_variables["PBX_NBPAIE"] = str_pad($this->_currentMethod, 2, '0', STR_PAD_LEFT);
			$post_variables["PBX_FREQ"] = str_pad($this->_currentMethod, 2, '0', STR_PAD_LEFT);
			$post_variables["PBX_QUAND"] = str_pad($this->_currentMethod, 2, '0', STR_PAD_LEFT);
			$post_variables["PBX_DELAIS"] = str_pad($this->_currentMethod, 2, '0', STR_PAD_LEFT);

		}
		$post_variables["PBX_HMAC"] = $pbxHelper->getHmac($post_variables, $this->_currentMethod->key);

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
		$dbValues['payment_order_total'] = $pbx_total;
		$dbValues['tax_id'] = $this->_currentMethod->tax_id;
		$this->storePSPluginInternalData($dbValues);

		$html = $this->getConfirmedHtml($post_variables, $pbxHelper);


		// 	2 = don't delete the cart, don't send email and don't redirect
		// 	2 = don't delete the cart, don't send email and don't redirect
		$cart->_confirmDone = FALSE;
		$cart->_dataValidated = FALSE;
		$cart->setCartIntoSession();
		JRequest::setVar('display_title', false);
		JRequest::setVar('html', $html);

		return;
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
		VmConfig::loadJLang('com_virtuemart_orders', TRUE);

		$virtuemart_paymentmethod_id = JRequest::getInt('pm', 0);

		if (!($this->_currentMethod = $this->getVmPluginMethod($virtuemart_paymentmethod_id))) {
			return NULL; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			return NULL;
		}
		$paybox_data = vmRequest::getGet();
		if (!($virtuemart_order_id = VirtueMartModelOrders::getOrderIdByOrderNumber($paybox_data['R']))) {
			return FALSE;
		}
		$orderModel = VmModel::getModel('orders');
		$order = $orderModel->getOrder($virtuemart_order_id);
		$pbxHelper = new PayboxHelperPaybox($this);
		if (!$this->checkSignature($pbxHelper) ) {
			$msg = 'Got a Paybox request with invalid signature';
			$this->debugLog($msg, 'checkSignature', 'error', false);
			return FALSE;
		}
		$success = ($paybox_data['E'] == $pbxHelper::RESPONSE_SUCCESS);
		  $this->updateOrderStatus($success, $paybox_data, $order);
		$html = $this->getResponseHTML($order, $success);
		$cart = VirtueMartCart::getCart();
		$cart->emptyCart();
		JRequest::setVar('display_title', false);
		JRequest::setVar('html', $html);

		return TRUE;

	}

	function plgVmOnUserPaymentCancel () {

		if (!class_exists('VirtueMartModelOrders')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
		}

		$order_number = JRequest::getWord('on');
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

		$paybox_data = vmRequest::getPost();
		$order_number = $paybox_data['R'];
		if (empty($order_number)) {
			return FALSE;
		}

		if (!($virtuemart_order_id = VirtueMartModelOrders::getOrderIdByOrderNumber($order_number))) {
			return FALSE;
		}

		if (!($payments = $this->getDatasByOrderId($virtuemart_order_id))) {
			return FALSE;
		}

		$this->_currentMethod = $this->getVmPluginMethod($payments[0]->virtuemart_paymentmethod_id);
		if (!$this->selectedThisElement($this->_currentMethod->payment_element)) {
			return FALSE;
		}

		$this->debugLog('plgVmOnPaymentNotification :' . var_export($paybox_data, true), 'debug');
		$orderModel = VmModel::getModel('orders');
		$order = $orderModel->getOrder($virtuemart_order_id);
		$order_number = $paybox_data['R'];
		$pbxHelper = new PayboxHelperPaybox($this);

		if (($msg = $pbxHelper->checkIps()) !== true) {
			$this->debugLog($msg, 'checkIps', 'error', false);
			//return FALSE;
		}
		if ($this->checkSignature($pbxHelper, $paybox_data) != 1) {
			$msg = 'Got a Paybox request with invalid signature';
			$this->debugLog($msg, 'checkSignature', 'error', false);
			return FALSE;
		}
		$success = ($paybox_data['E'] == $pbxHelper::RESPONSE_SUCCESS);

		$success = $this->updateOrderStatus($success,$paybox_data, $order);
		if ($success) {
			if (isset($payments[0]->paybox_custom)) {
				$this->emptyCart($payments[0]->paybox_custom, $order_number);
			}
		}


		return TRUE;
	}

	function updateOrderStatus ($success, $paybox_data,$order) {

		if ($success) {
			$status = $this->_currentMethod->status_success;
			$amountInCurrency = vmPSPlugin::getAmountInCurrency($order['details']['BT']->order_total, $order['details']['BT']->order_currency);
			$order_history['comments'] = vmText::sprintf('VMPAYMENT_PAYBOX_PAYMENT_STATUS_CONFIRMED', $amountInCurrency['display'], $order['details']['BT']->order_number);

		} else {
			$order_history['comments'] = JText::sprintf('VMPAYMENT_PAYBOX_PAYMENT_STATUS_CANCELLED', $order['details']['BT']->order_number);
			$status = $this->_currentMethod->status_canceled;
		}

		$order_history['customer_notified'] = true;
		$order_history['order_status'] = $status;

		$db_values['payment_name'] = $this->renderPluginName($this->_currentMethod);
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
		return true;
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
				$first = FALSE;
			} else {
				if (!empty($payment->paybox_fullresponse)) {
					$paybox_data = json_decode($payment->paybox_fullresponse);
					$showOrderBEFields = $this->getOrderBEFields();
					$prefix = 'PAYBOX_RESPONSE_';
					foreach ($showOrderBEFields as $showOrderBEField) {
						if (isset($paybox_data->$showOrderBEField) and !empty($paybox_data->$showOrderBEField)) {
							$key = $prefix . $showOrderBEField;
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

	function getOrderBEFields () {
		$fields = array(
			//'M',
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

	function _getPaymentResponseHtml ($paybox_data, $payment_name, $order) {

		vmdebug('paybox response', $paybox_data);

		$html = '<table>' . "\n";
		$html .= $this->getHtmlRow('PAYBOX_PAYMENT_NAME', $payment_name);
		$html .= $this->getHtmlRow('PAYBOX_ORDER_NUMBER', $paybox_data->order_number);

		$html .= '<a class="vm-button-correct" href="' . JRoute::_('index.php?option=com_virtuemart&view=orders&layout=details&order_number=' . $order['details']['BT']->order_number . '&order_pass=' . $order['details']['BT']->order_pass, false) . '">' . JText::_('COM_VIRTUEMART_ORDER_VIEW_ORDER') . '</a>';

//$html .= $this->getHtmlRow ('PAYBOX_AMOUNT', $paybox_data['montant'] . " " . $paybox_data['mc_currency']);
		$html .= '</table>' . "\n";

		return $html;
	}

	protected function renderPluginName ($method) {
		$logos = $method->payment_logos;
		if (!empty($logos)) {
			$display_logos = $this->displayLogos($logos) . ' ';
		}
		$payment_name = $method->payment_name;

		$html = $this->renderByLayout('render_pluginname', array(
		                                                        'shop_mode'                   => $method->shop_mode,
		                                                        'virtuemart_paymentmethod_id' => $method->virtuemart_paymentmethod_id,
		                                                        'logo'                        => $display_logos,
		                                                        'payment_name'                => $payment_name,
		                                                        'payment_description'         => $method->payment_desc,
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
			$method = $this->getPluginMethod(JRequest::getInt('virtuemart_paymentmethod_id'));
			$mandatory_fields = array('site_id', 'rang', 'identifiant', 'key');
			foreach ($mandatory_fields as $mandatory_field) {
				if (empty($method->$mandatory_field)) {
					vmError(vmText::sprintf('VMPAYMENT_PAYBOX_CONF_MANDATORY_PARAM', vmText::_('VMPAYMENT_PAYBOX_CONF_' . $mandatory_field)));
				}
			}
			if (!extension_loaded('curl')) {
				vmError(vmText::sprintf('VMPAYMENT_PAYBOX_CONF_MANDATORY_PHP_EXTENSION', 'curl'));
			}
			if (!extension_loaded('openssl')) {
				vmError(vmText::sprintf('VMPAYMENT_PAYBOX_CONF_MANDATORY_PHP_EXTENSION', 'openssl'));
			}
			return $this->onStoreInstallPluginTable($jplugin_id);
		}
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
	function getConfirmedHtml ($post_variables, $pbxHelper) {


		// add spin image
		$html = '<html><head><title>Redirection</title></head><body><div style="margin: auto; text-align: center;">';
		if ($this->_currentMethod->debug) {
			$html .= '<form action="' . $pbxHelper->getPayboxUrl($this->_currentMethod->shop_mode) . '" method="post" name="vm_paybox_form" target="paybox">';
		} else {
			$html .= '<form action="' . $pbxHelper->getPayboxUrl($this->_currentMethod->shop_mode) . '" method="post" name="vm_paybox_form" accept-charset="UTF-8">';
		}

		foreach ($post_variables as $name => $value) {
			$html .= '<input type="hidden" name="' . $name . '" value="' . $value . '" />';
		}

		if ($this->_currentMethod->debug) {

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
	function getResponseHTML ($order, $success) {

		$payment_name = $this->renderPluginName($this->_method);
		VmConfig::loadJLang('com_virtuemart_orders', TRUE);


		$html = $this->renderByLayout('response', array(
		                                               "success"      => $success,
		                                               "payment_name" => $payment_name,
		                                               "order_number" => $order['details']['BT']->order_number,
		                                               "order_pass"   => $order['details']['BT']->order_pass,
		                                          ));
		return $html;


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
		return 'pubkey-3.pem';
	}

	private function checkSignature ($pbxHelper) {
		// TODO pbxVerSign
		//return true;
		$keyFile = $this->getPayboxSafepath() . '/' . $this->getKeyFileName();

		$checkSig = $pbxHelper->pbxVerSign($keyFile, $_SERVER['QUERY_STRING']);

		return $checkSig;

	}

	function redirectToCart () {
		$app = JFactory::getApplication();
		$app->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart&Itemid=' . vmRequest::getInt('Itemid'), false), vmText::_('VMPAYMENT_PAYBOX_ERROR_TRY_AGAIN'));
	}

	private function getContext () {

		$session = JFactory::getSession();
		return $session->getId();
	}

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
			$debug .= str_replace("=>", "&#8658;", str_replace("Array", "<font color=\"red\"><b>Array</b></font>", (str_replace(" ", " &nbsp; ", print_r($subject, true)))));

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