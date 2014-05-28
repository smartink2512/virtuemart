<?php
/**
 *
 * Realex payment plugin
 *
 * @author Valérie Isaksen
 * @version $Id$
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


/**
 * @property  request_type
 */
class  RealexHelperRealex {
	var $_method;
	var $cart;
	var $order;
	var $vendor;
	var $customerData;
	var $context;
	var $total;
	var $post_variables;
	var $post_string;
	var $requestData;
	var $response;
	var $currency_code_3;
	var $currency_display;
	var $plugin;

	const REQUEST_TYPE_AUTH = "auth";
	const REQUEST_TYPE_RECEIPT_IN = 'receipt-in';
	const REQUEST_TYPE_REBATE = "rebate";
	const REQUEST_TYPE_SETTLE = "settle";
	const REQUEST_TYPE_VOID = "void";
	const REQUEST_TYPE_REALVAULT_3DS_VERIFYENROLLED = "realvault-3ds-verifyenrolled";
	const REQUEST_TYPE_3DS_VERIFYENROLLED = "3ds-verifyenrolled";
	const REQUEST_TYPE_3DS_VERIFYSIG = "3ds-verifysig";
	const REQUEST_TYPE_DCCRATE = "dccrate";
	const REQUEST_TYPE_REALVAULT_DCCRATE = "realvault-dccrate";
	const REQUEST_TYPE_CARD_CANCEL_CARD = "card-cancel-card";
	const REQUEST_TYPE_CARD_UPDATE_CARD = "card-update-card";
	const REQUEST_TYPE_PAYER_NEW = "payer-new";
	const REQUEST_TYPE_CARD_NEW = "card-new";

	const RESPONSE_DCC_CHOICE_YES = "Yes";
	const DCCRATE_RESULT_SUCCESS = '00';


	const RESPONSE_CODE_SUCCESS = '00';
	const RESPONSE_CODE_DECLINED = '101';
	const RESPONSE_CODE_REFERRAL_B = '102';
	const RESPONSE_CODE_REFERRAL_A = '103';
	const RESPONSE_CODE_NOT_VALIDATED = '110';
	const RESPONSE_CODE_INVALID_ORDER_ID = '501'; // This order ID has already been used - please use another one
	const RESPONSE_CODE_PAYER_REF_NOTEXIST = '501'; // This Payer Ref payerref does not exist
	const RESPONSE_CODE_INVALID_PAYER_REF_USED = '501'; // This Payer Ref payerref has already been used - please use another one
	const PAYER_SETUP_SUCCESS = "00";

	const ENROLLED_RESULT_ENROLLED = '00';
	const ENROLLED_RESULT_NOT_ENROLLED = '110';
	const ENROLLED_RESULT_INVALID_RESPONSE = '5xx';
	const ENROLLED_RESULT_FATAL_ERROR = '220';


	const ENROLLED_TAG_ENROLLED = 'Y';
	const ENROLLED_TAG_UNABLE_TO_VERIFY = 'U';
	const ENROLLED_TAG_NOT_ENROLLED = 'N';

	/**
	 * Response results from threedsecure = "3ds-verifysig";
	 */
	const THREEDSECURE_STATUS_AUTHENTICATED = 'Y';
	const THREEDSECURE_STATUS_NOT_AUTHENTICATED = 'N';
	const THREEDSECURE_STATUS_ACKNOWLEDGED = 'A';
	const THREEDSECURE_STATUS_UNAVAILABLE = 'U';


	function __construct ($method, $plugin) {
		if ($method->dcc) {
			$method->settlement = 'auto';
			$method->rebate_password = "";
		}
		if (!$method->realvault) {
			$method->offer_save_card = 0;
		}
		$this->_method = $method;
		$this->plugin = $plugin;
		$session = JFactory::getSession();
		$this->context = $session->getId();
	}

	public function setTotalInPaymentCurrency ($total) {

		if (!class_exists('CurrencyDisplay')) {
			require(JPATH_VM_ADMINISTRATOR . '/helpers/currencydisplay.php');
		}
		$this->total = vmPSPlugin::getAmountValueInCurrency($total, $this->_method->payment_currency) * 100;

		$cd = CurrencyDisplay::getInstance($this->cart->pricesCurrency);
	}

	public function getTotalInPaymentCurrency () {

		return $this->total;

	}

	public function setPaymentCurrency () {
		vmPSPlugin::getPaymentCurrency($this->_method);
		$this->currency_code_3 = shopFunctions::getCurrencyByID($this->_method->payment_currency, 'currency_code_3');
	}

	public function getPaymentCurrency () {
		return $this->currency_code_3;
	}

	public function setContext ($context) {
		$this->context = $context;
	}

	public function getContext () {
		return $this->context;
	}

	public function setCart ($cart, $doGetCartPrices = true) {
		$this->cart = $cart;
		if ($doGetCartPrices AND !isset($this->cart->pricesUnformatted)) {
			$this->cart->getCartPrices();
		}
	}

	public function setOrder ($order) {
		$this->order = $order;
	}

	/**
	 * The digits from the first line of the address should be concatenated with the post code digits with a '|' in the middle.
	 * * For example: Flat 123, No. 7 Grove Park, E98 7QJ
	 * Billing Code: '987|123', the number of digits on each side of the '|' should also be restricted to 5.
	 * @param $address
	 */
	public function getCode ($address) {
		// get first digits of the address line,
		$digits_addr = $this->stripnonnumeric($address->address_1, 5);
		// get digits from zip,
		$digits_zip = $this->stripnonnumeric($address->zip, 5);
		// concatenate with |
		return $digits_zip . "|" . $digits_addr;
	}

	private function stripnonnumeric ($code, $maxLg) {
		$code = preg_replace("/[^0-9]/", "", $code);
		$code = substr($code, 0, $maxLg);
		return $code;
	}

	function _getRealexUrl () {
		if ($this->_method->shop_mode == 'sandbox') {
			//return 'https://realcontrol.sandbox.realexpayments.com';
			return $this->_method->sandbox_gateway_url;
		} else {
			//return ' https://realcontrol.realexpayments.com';
			return $this->_method->gateway_url;
		}

	}


	/*********************/
	/* Log and Reporting */
	/*********************/
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

	function highlight ($string) {
		return '<span style="color:red;font-weight:bold">' . $string . '</span>';
	}

	public function debugLog ($message, $title = '', $type = 'message', $echo = false, $doVmDebug = false) {

		//Nerver log the full credit card number nor the CVV code.
		if (is_array($message)) {
			if (array_key_exists('REALEX_SAVED_PMT_DIGITS', $message)) {
				$message['REALEX_SAVED_PMT_DIGITS'] = "**** **** **** " . substr($message['REALEX_SAVED_PMT_DIGITS'], -4);
			}
			if (array_key_exists('SHA1HASH', $message)) {
				$message['SHA1HASH'] = '**MASKED**';
			}
			if (array_key_exists('CVV2', $message)) {
				$message['CVV2'] = str_repeat('*', strlen($message['CVV2']));
			}
			if (array_key_exists('signature', $message)) {
				$message['signature'] = '**MASKED**';
			}
			if (array_key_exists('api_password', $message)) {
				$message['api_password'] = '**MASKED**';
			}
		}

		if ($this->_method->debug) {
			$this->debug($message, $title, true);
		}

		if ($echo) {
			echo $message . '<br/>';
		}


		$this->plugin->debugLog($message, $title, $type, $doVmDebug);
	}

	function getPaymentLang () {
		$available_languages = array(
			'en-GB' => 'en',
			'es-ES' => 'es',
		);
		$default_language = 'en';

		$language = JFactory::getLanguage();

		if (array_key_exists($language->getTag(), $available_languages)) {
			return $available_languages[$language->getTag()];
		} else {
			return $default_language;
		}
	}

	function getCardPaymentButton ($card_payment_button) {
		$lang = JFactory::getLanguage();
		if ($lang->hasKey($card_payment_button)) {
			return vmText::_($card_payment_button);
		} else {
			return $card_payment_button;
		}
	}

	/**
	 * @param $response
	 */

	function manageResponseRequest ($response) {
		if ($response == NULL) {
			$this->plugin->redirectToCart(vmText::_('VMPAYMENT_REALEX_ERROR_TRY_AGAIN'));
		}
		if (!$this->validateResponseHash($response)) {
			$this->plugin->redirectToCart(vmText::_('VMPAYMENT_REALEX_ERROR_TRY_AGAIN'));
		}
		$this->plugin->_storeRealexInternalData($response, $this->_method->virtuemart_paymentmethod_id, $this->order['details']['BT']->virtuemart_order_id, $this->order['details']['BT']->order_number, $this->request_type);
		/*
				$xml_response = simplexml_load_string($response);

				$success = $this->isResponseSuccess($xml_response);
				$reponse_enrolled=($xml_response->result==self::ENROLLED_RESULT_NOT_ENROLLED);
				$not_enrolled = ($xml_response->enrolled == self::ENROLLED_TAG_NOT_ENROLLED);
				if (! ($success OR $reponse_enrolled)) {
					$error = (string)$xml_response->message . " (" . (string)$xml_response->result . ")";
					$this->displayError($error);
					$this->plugin->redirectToCart(vmText::_('VMPAYMENT_REALEX_ERROR_TRY_AGAIN'));
				}
		*/
	}

	/**
	 * @param $response
	 */
	function manageResponseRequestReceiptIn ($response) {
		$this->manageResponseRequest($response);
	}

	public function validateConfirmedOrder ($enqueueMessage = true) {
		return true;
	}

	public function validateSelectCheckPayment ($enqueueMessage = true) {
		return true;
	}

	/**
	 * @param bool $enqueueMessage
	 * @return bool
	 */
	function validateCheckoutCheckDataPayment () {
		return true;
	}

	function getOrderBEFields () {
		$showOrderBEFields = array(

			'RESULT'            => 'RESULT',
			'PASREF'            => 'PASREF',
			'AUTHCODE'          => 'AUTHCODE',
			'MESSAGE'           => 'MESSAGE',
			'TSS'               => 'TSS',
			'CAVV'              => 'CAVV',
			'CVNRESULT'         => 'CVNRESULT',
			'AVSPOSTCODERESULT' => 'AVSPOSTCODERESULT',
			'DCCCHOICE'         => 'DCCCHOICE',
			'REALWALLET_CHOSEN' => 'REALWALLET_CHOSEN',

		);


		return $showOrderBEFields;
	}


	function getOrderBEFieldsDcc () {
		$showOrderBEFields = array(

			'DCCRATE'                        => 'DCCRATE',
			'DCCMERCHANTAMOUNT'              => 'DCCMERCHANTAMOUNT',
			'DCCMERCHANTCURRENCY'            => 'DCCMERCHANTCURRENCY',
			'DCCCARDHOLDERAMOUNT'            => 'DCCCARDHOLDERAMOUNT',
			'DCCCARDHOLDERCURRENCY'          => 'DCCCARDHOLDERCURRENCY',
			'DCCMARGINRATEPERCENTAGE'        => 'DCCMARGINRATEPERCENTAGE',
			'DCCEXCHANGERATESOURCENAME'      => 'DCCEXCHANGERATESOURCENAME',
			'DCCCOMMISSIONPERCENTAGE'        => 'DCCCOMMISSIONPERCENTAGE',
			'DCCEXCHANGERATESOURCETIMESTAMP' => 'DCCEXCHANGERATESOURCETIMESTAMP',

		);


		return $showOrderBEFields;
	}

	function getOrderBEFields3DS () {
		$showOrderBEFields = array(
			'status' => 'status',
		);


		return $showOrderBEFields;
	}

	function onShowOrderBEPayment ($data, $format, $request_type_response, $virtuemart_order_id) {

		$showOrderBEFields = $this->getOrderBEFields();
		$prefix = 'REALEX_RESPONSE_';

		$html = '';
		if ($request_type_response == 'receipt-in_request') {
			if (!class_exists('VirtueMartModelOrders')) {
				require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php');
			}
			$orderModel = VmModel::getModel('orders');
			$order = $orderModel->getOrder($virtuemart_order_id);
			$usedCC = $this->getStoredCCByPmt_ref($order['details']['BT']->virtuemart_user_id, $data->paymentmethod);
			VmConfig::loadJLang('plg_vmuserfield_realex');
			$display_fields = array(
				'realex_saved_pmt_type',
				'realex_saved_pmt_digits',
				'realex_saved_pmt_expdate',
				'realex_saved_pmt_name'
			);
			foreach ($display_fields as $display_field) {
				$complete_key = strtoupper('VMUSERFIELD_' . $display_field);

				$value = $usedCC->$display_field;
				$key_text = vmText::_($complete_key);
				$value = vmText::_($value);
				if (!empty($value)) {
					$html .= "<tr>\n<td>" . $key_text . "</label></td>\n <td align='left'>" . $value . "</td>\n</tr>\n";
				}
			}

		} else {
			foreach ($showOrderBEFields as $key => $showOrderBEField) {
				if ($format == "xml") {
					$showOrderBEField = strtolower($showOrderBEField);
				}
				if (isset($data->$showOrderBEField) and !empty($data->$showOrderBEField)) {
					$key = $prefix . $key;
					if ($showOrderBEField == 'tss') {
						$html .= $this->plugin->getHtmlRowBE($key, $data->tss->result);
					} else {
						$html .= $this->plugin->getHtmlRowBE($key, $data->$showOrderBEField);
					}
				}

			}


			$plugin = $this->plugin;
			/*
			if (isset($data->DCCCHOICE) and $data->DCCCHOICE == $plugin::DCCCHOICE_YES) {
				$showOrderBEFields = $this->getOrderBEFieldsDcc();
				$prefix = 'REALEX_RESPONSE_';
				foreach ($showOrderBEFields as $key => $showOrderBEField) {

					if (isset($data->$showOrderBEField)) {
						$key = $prefix . $key;
						$html .= $this->plugin->getHtmlRowBE($key, $data->$showOrderBEField);
					}

				}
			}
			*/
			if (isset($data->threedsecure)) {
				$showOrderBEFields = $this->getOrderBEFields3DS();
				$prefix = 'REALEX_RESPONSE_THREEDSECURE_';
				foreach ($showOrderBEFields as $key => $showOrderBEField) {
					if (isset($data->threedsecure->$showOrderBEField)) {
						$key = $prefix . $key;
						$html .= $this->plugin->getHtmlRowBE($key, $data->threedsecure->$showOrderBEField);
					}

				}
			}
		}
		return $html;
	}

	/**
	 * @param $response
	 * @param $order
	 * @return null|string
	 */
	function getResponseHTML ($payments) {

		$payment_name = $this->plugin->renderPluginName($this->_method, 'order');
		$dcc_info = "";
		$payer_info = "";
		$auth_info = "";
		$order_history = $this->order['history'];
		$last_history = end($order_history);
		if ($last_history->order_status_code == $this->_method->status_canceled) {
			$auth_info = $last_history->comments;
			$success = false;
		} else {

		}

		// FROM PAYMENT LOG??? why not from history
		if ($payments) {
			foreach ($payments as $payment) {
				if (isset($payment->realex_fullresponse) and !empty($payment->realex_fullresponse)) {
					if ($payment->realex_fullresponse_format == 'xml') {
						$xml_response = simplexml_load_string($payment->realex_fullresponse);
						if ($payment->realex_request_type_response == $this::REQUEST_TYPE_AUTH OR $payment->realex_request_type_response == $this::REQUEST_TYPE_RECEIPT_IN) {
							$success = $this->isResponseSuccess($xml_response);

							if ($success) {
								if (isset($xml_response->dccinfo) AND isset($xml_response->dccinfo->cardholderrate)) {
									if ($xml_response->dccinfo->cardholderrate != 1.0) {
										$dcc_info = vmText::sprintf('VMPAYMENT_REALEX_DCC_PAY_OWN_CURRENCY_CHARGED', $this->plugin->getCardHolderAmount($xml_response->dccinfo->merchantamount), $xml_response->dccinfo->merchantcurrency, $this->plugin->getCardHolderAmount($xml_response->dccinfo->cardholderamount), $xml_response->dccinfo->cardholdercurrency);
									} else {
										$dcc_info = vmText::sprintf('VMPAYMENT_REALEX_DCC_PAY_MERCHANT_CURRENCY', $this->plugin->getCardHolderAmount($xml_response->dccinfo->merchantamount), $xml_response->dccinfo->merchantcurrency);
									}
								}
								$amountValue = vmPSPlugin::getAmountInCurrency($this->order['details']['BT']->order_total, $this->order['details']['BT']->order_currency);
								$currencyDisplay = CurrencyDisplay::getInstance($this->cart->pricesCurrency);

								$auth_info = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_STATUS_CONFIRMED', $amountValue['display'], $this->order['details']['BT']->order_number);
								$pasref = $payment->realex_response_pasref;
							} else {
								if ($this->isResponseDeclined($xml_response)) {
									$auth_info = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_DECLINED', $this->order['details']['BT']->order_number);
								} else {
									$auth_info = vmText::_('VMPAYMENT_REALEX_PAYMENT_STATUS_CANCELLED');
								}
							}

						} elseif ($payment->realex_request_type_response == $this::REQUEST_TYPE_CARD_NEW) {
							$success = $this->isResponseSuccess($xml_response);
							if ($success) {
								$payer_info = vmText::_('VMPAYMENT_REALEX_CARD_STORAGE_SUCCESS');
							} else {
								$payer_info = vmText::_('VMPAYMENT_REALEX_CARD_STORAGE_FAILED');
							}
						}

					} else {
						if ($payment->realex_fullresponse_format == 'json') {
							$realex_data = json_decode($payment->realex_fullresponse);
							$result = $payment->realex_response_result;

							$success = ($this);
							if ($success) {
								$amountValue = vmPSPlugin::getAmountInCurrency($this->order['details']['BT']->order_total, $this->order['details']['BT']->order_currency);
								$currencyDisplay = CurrencyDisplay::getInstance($this->cart->pricesCurrency);

								$auth_info = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_STATUS_CONFIRMED', $amountValue['display'], $this->order['details']['BT']->order_number);
								if (isset($realex_data->DCCCHOICE) and $realex_data->DCCCHOICE == $this::RESPONSE_DCC_CHOICE_YES) {
									$dcc_info = vmText::sprintf('VMPAYMENT_REALEX_DCC_PAY_OWN_CURRENCY_CHARGED', $this->plugin->getCardHolderAmount($realex_data->DCCMERCHANTAMOUNT), $realex_data->DCCMERCHANTCURRENCY, $this->plugin->getCardHolderAmount($realex_data->DCCCARDHOLDERAMOUNT), $realex_data->DCCCARDHOLDERCURRENCY);
								}
								if (isset($realex_data->REALWALLET_CHOSEN) and  $realex_data->REALWALLET_CHOSEN == 1) {
									$payer_info = vmText::_('VMPAYMENT_REALEX_CARD_STORAGE_SUCCESS');
								}
								$pasref = $realex_data->PASREF;


							} else {
								if ($this->isResponseDeclined($xml_response)) {
									$auth_info = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_DECLINED', $this->order['details']['BT']->order_number);
								} else {
									$auth_info = vmText::_('VMPAYMENT_REALEX_PAYMENT_STATUS_CANCELLED');
								}
							}
						}
					}
				}
			}
		}
		VmConfig::loadJLang('com_virtuemart_orders', TRUE);


		$html = $this->plugin->renderByLayout('response', array(
		                                                       "success"      => $success,
		                                                       "payment_name" => $payment_name,
		                                                       "dcc_info"     => $dcc_info,
		                                                       "auth_info"    => $auth_info,
		                                                       "payer_info"   => $payer_info,
		                                                       "pasref"       => $pasref,
		                                                       "order_number" => $this->order['details']['BT']->order_number,
		                                                       "order_pass"   => $this->order['details']['BT']->order_pass,
		                                                  ));
		return $html;


	}

	public function loadCustomerData ($loadCDFromPost = true) {
		if (!class_exists('RealexHelperCustomerData')) {
			require(JPATH_SITE . '/plugins/vmpayment/realex/realex/helpers/customerdata.php');
		}
		$this->getCustomerData();
		if ($loadCDFromPost) {
			$this->customerData->loadPost();
		}

	}

	public function getCustomerData () {
		if (!class_exists('RealexHelperCustomerData')) {
			require(JPATH_SITE . '/plugins/vmpayment/realex/realex/helpers/customerdata.php');
		}
		$this->customerData = new RealexHelperCustomerData();
		$this->customerData->load();
	}

	/**
	 * @param $saved_cc_selected
	 * @return mixed
	 */
	function getStoredCCsData ($saved_cc_selected) {
		$realvault = false;
		$storedCCs = $this->getStoredCCs(JFactory::getUser()->id);
		foreach ($storedCCs as $storedCC) {
			if ($storedCC->id == $saved_cc_selected) {
				$realvault = $storedCC;
				break;
			}
		}
		return $realvault;
	}

	/**
	 * @return array
	 */
	static function getRealexCreditCards () {
		return array(
			'VISA',
			'MC',
			'AMEX',
			'MAESTRO',
			'DINERS',
		);

	}

	function getVendorInfo ($field) {

		$virtuemart_vendor_id = 1;
		$vendorModel = VmModel::getModel('vendor');
		$vendor = $vendorModel->getVendor($virtuemart_vendor_id);

		return $vendor->$field;

	}

	/**
	 * the reference to use for the payment method saved.
	 * If this field is not present an alphanumeric reference will be automatically generated.
	 * @return string
	 */
	function getPmtRef () {
		return '';
	}

	// todo
	/**
	 * This field contains the payer reference used for this cardholder.
	 * If this field is empty or missing and PAYER_EXIST = 0, then a PAYER_REF will be automatically generated.
	 * To add another card to an existing payer the PAYER_REF field should be set to their existing payer reference.
	 * This field is mandatory if the CARD_STORAGE_ENABLE is set to 1 and
	 * the PAYER_EXIST flag is set to 1. If PAYER_EXIST = 1 and CARD_STORAGE_ENABLE = 1, a 5xx error will be returned if the field is empty or missing:
	 * 5xx “Mandatory field missing. PAYER_REF not present in request”
	 * @return string
	 */
	function getPayerExist () {
		return 0;
	}

	/**
	 * @param $payer_exist
	 */
	function   getPayerRef ($payer_exist) {

	}

	function getSelectedCC ($storedCCs, $selected) {
		if (empty($storedCCs)) {
			return NULL;
		}
		foreach ($storedCCs as $storedCC) {
			if ($storedCC->id == $selected) {
				return $storedCC;
			}
		}

	}


	function getSelectedCCParams ($selected_cc_id) {


		if ($selected_cc_id == -1) {
			$selectedCCParams = new stdClass();
			$selectedCCParams->addNew = true;
			return $selectedCCParams;
		}
		$storedCCs = $this->getStoredCCs(JFactory::getUser()->id);

		$selectedCC = $this->getSelectedCC($storedCCs, $selected_cc_id);
		if ($selectedCC == NULL) {
			return NULL;
		}
		$selectedCCParams = $selectedCC;
		$selectedCCParams->addNew = false;
		return $selectedCCParams;
	}

	static $_storedCCsCache;

	function getStoredCCs ($virtuemart_user_id) {
		//$this->debugLog( $virtuemart_user_id, 'getStoredCCs', 'debug');

		if (!empty(self::$_storedCCsCache)) {
			if (isset(self::$_storedCCsCache[$virtuemart_user_id])) {
				$storedCCs = self::$_storedCCsCache[$virtuemart_user_id]['storedCC'];
				//$this->debugLog('from cache', 'getStoredCCs', 'debug');
				return $storedCCs;
			}
		}


		JLoader::import('joomla.plugin.helper');
		JPluginHelper::importPlugin('vmuserfield');
		$app = JFactory::getApplication();

		$storedCCs = "";
		$app->triggerEvent('plgVmOnPaymentDisplay', array('pluginrealex', $virtuemart_user_id, &$storedCCs));
		//$this->debugLog(var_export($storedCCs, true), 'getStoredCCs after plgVmOnPaymentDisplay', 'debug');
		if (empty(self::$_storedCCsCache)) {
			self::$_storedCCsCache = array();
		}
		if (empty(self::$_storedCCsCache[$virtuemart_user_id])) {
			self::$_storedCCsCache[$virtuemart_user_id] = array();
		}
		self::$_storedCCsCache[$virtuemart_user_id]['storedCC'] = $storedCCs;


		return $storedCCs;

	}

	function getStoredCCsByPaymentMethod ($virtuemart_user_id, $virtuemart_paymentmethod_id) {
		$storedCCsByPaymentMethod = array();
		$storeCCs = $this->getStoredCCs($virtuemart_user_id);
		if ($storeCCs) {
			foreach ($storeCCs as $storeCC) {
				if ($storeCC->virtuemart_paymentmethod_id == $virtuemart_paymentmethod_id) {
					$storedCCsByPaymentMethod[] = $storeCC;
				}
			}
		}

		return $storedCCsByPaymentMethod;
	}


	function getStoredCCByPmt_ref ($virtuemart_user_id, $pmt_ref) {
		$storedCCByPmt_ref = array();
		$storeCCs = $this->getStoredCCs($virtuemart_user_id);
		if ($storeCCs) {
			foreach ($storeCCs as $storeCC) {
				if ($storeCC->realex_saved_pmt_ref == $pmt_ref) {
					$storedCCByPmt_ref = $storeCC;
					break;
				}
			}
		}

		return $storedCCByPmt_ref;
	}


	/**
	 * @param $virtuemart_paymentmethod_id
	 * @param $virtuemart_user_id
	 * @param $selected_cc
	 * @return mixed|null
	 */
	function getCCDropDown ($virtuemart_paymentmethod_id, $virtuemart_user_id, $selected_cc, $use_another_cc = true, $radio = false) {

		//$storeCCs = $this->getStoredCCsByPaymentMethod($virtuemart_user_id, $virtuemart_paymentmethod_id);
		$storeCCs = $this->getStoredCCs($virtuemart_user_id);
		if (empty($storeCCs)) {
			return null;
		}
		if (!class_exists('VmHTML')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'html.php');
		}
		$attrs = 'class="inputbox vm-chzn-select"';
		$idA = $id = 'saved_cc_selected_' . $virtuemart_paymentmethod_id;
		//$idA = $id = 'saved_cc_selected_';
		//$options[] = array('value' => '', 'text' => vmText::_('VMPAYMENT_REALEX_PLEASE_SELECT'));
		if ($use_another_cc) {
			$options[] = JHTML::_('select.option', -1, vmText::_('VMPAYMENT_REALEX_USE_ANOTHER_CC'));
			$radioOptions[-1] = vmText::_('VMPAYMENT_REALEX_USE_ANOTHER_CC');
		}
		foreach ($storeCCs as $storeCC) {
			$cc_type = vmText::_('VMPAYMENT_REALEX_CC_' . $storeCC->realex_saved_pmt_type);
			$name = $cc_type . ' ' . $storeCC->realex_saved_pmt_digits . ' ' . $storeCC->realex_saved_pmt_expdate . ' (' . $storeCC->realex_saved_pmt_name . ')';
			$options[] = JHTML::_('select.option', $storeCC->id, $name);
			$radioOptions[$storeCC->id] = $name;
		}

		if ($radio) {
			return VmHTML::radioList($idA, $selected_cc, $radioOptions, 'class="realexListCC"');
		} else {
			return JHTML::_('select.genericlist', $options, $idA, 'class="realexListCC inputbox vm-chzn-select" style="width: 350px;"', 'value', 'text', $selected_cc);
		}

	}

	function getOfferSaveCard ($checked, $paymentmethod_id) {
		$param = '';
		if ($checked) {
			$param = "checked";
		}
		$id = 'realex_offersavecard_' . $paymentmethod_id;
		$html = vmText::_('VMPAYMENT_REALEX_OFFERSAVECARD');
		$html .= "<br />";
		$html .= '<input type="checkbox" name="' . $id . '" id="' . $id . '" value="1" ' . $param . '/>';
		$html .= ' <label for="' . $id . '">' . vmText::_('VMPAYMENT_REALEX_OFFERSAVECARD_YES') . '</label>';
		return $html;
	}

	function doRealVault () {

			if (!JFactory::getUser()->guest AND $this->_method->realvault AND $this->_method->integration == 'remote') {
			if (!($this->_method->offer_save_card) OR
				($this->_method->offer_save_card AND $this->customerData->getVar('save_card'))
			) {
				return true;
			}
			return false;
		}
		return false;
	}

	/**
	 * @return string
	 */
	function getRemoteURL () {
		return "https://epage.payandshop.com/epage-remote-plugins.cgi";

	}

	/**
	 * @return string
	 */

	function getPaymentButton () {
		if (empty($this->_method->card_payment_button)) {
			$card_payment_button = vmText::_('VMPAYMENT_REALEX_DCC_PAY_NOW');
		} else {
			$card_payment_button = $this->_method->card_payment_button;
		}
		return $card_payment_button;
	}

	/**
	 * Once the payer has been set up on the RealVault system, to raise a payment, use the receipt-in transaction.
	 * @param      $selectedCCParams
	 * @param bool $ask_dcc
	 * @param bool $set_dcc
	 * @return bool|mixed
	 */
	public function requestReceiptIn ($selectedCCParams, $xml_response_dcc = NULL, $xml_3Dresponse = NULL) {

		$timestamp = $this->getTimestamp();

		$xml_request = $this->setHeader($timestamp, self::REQUEST_TYPE_RECEIPT_IN);
		if (!empty($selectedCCParams->cc_cvv_realvault)) {
			$xml_request .= '<paymentdata>
					<cvn>
						<number>' . $selectedCCParams->cc_cvv_realvault . '</number>
					</cvn>
				</paymentdata>
				';
		}
		if ($this->_method->dcc) {
			$xml_request .= '<autosettle flag="1" />
			';
		} else {
			$xml_request .= '<autosettle flag="' . $this->getSettlement() . '" />
			';
		}
		if (!empty($xml_3Dresponse->eci) AND isset($xml_3Dresponse->eci)) {
			$xml_request .= '<mpi>' . '<eci>' . $xml_3Dresponse->eci . '</eci>
							</mpi>
							';
		}
		$xml_request .= '<payerref>' . $selectedCCParams->realex_saved_payer_ref . '</payerref>
		<paymentmethod>' . $selectedCCParams->realex_saved_pmt_ref . '</paymentmethod>';
		if ($xml_response_dcc) {
			$xml_request .= '
			<dccinfo>
				<ccp>' . $xml_response_dcc->dcc . '</ccp>
				<type>1</type>
				<rate>' . $xml_response_dcc->cardholderrate . '</rate>
				<ratetype>S</ratetype>
				<amount currency="' . $xml_response_dcc->cardholdercurrency . '">' . $xml_response_dcc->cardholderamount . '</amount>
			</dccinfo>';
		}
		$xml_request .= '<md5hash />
		';
		$hash = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, $this->getTotalInPaymentCurrency(), $this->getPaymentCurrency(), $selectedCCParams->realex_saved_payer_ref);
		$xml_request .= $this->setSha1($hash);
		$xml_request .= $this->setComments();
		$xml_request .= $this->setTSSinfo();
		$xml_request .= '</request>';


		$response = $this->getXmlResponse($xml_request);

		return $response;

	}

	function getSettlement () {
		return ($this->_method->settlement == 'auto') ? 1 : 0;

	}

	/**
	 * Hash Value Syntax: Timestamp.merchantID.payerref.pmtref
	 * @param $storedCC : the stored Credit card to delete
	 * @return bool
	 */

	function deleteStoredCard ($storedCC) {
		$timestamp = $this->getTimestamp();
		$xml_request = '
				<request timestamp="' . $timestamp . '" type="' . self::REQUEST_TYPE_CARD_CANCEL_CARD . '">
					<merchantid>' . $this->_method->merchant_id . '</merchantid>
					<card>
						<ref>' . $storedCC['realex_saved_pmt_ref'] . '</ref>
						<payerref>' . $storedCC['realex_saved_payer_ref'] . '</payerref>
					</card>';
		$sha1_request = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $storedCC['realex_saved_payer_ref'], $storedCC['realex_saved_pmt_ref']);
		$xml_request .= $this->setSha1($sha1_request);
		$xml_request .= '</request>';

		$response = $this->getXmlResponse($xml_request);
		$xml_response = simplexml_load_string($response);
		$result = (string)$xml_response->result;

		$merchantid = (string)$xml_response->merchantid;
		$sha1hash = (string)$xml_response->sha1hash;
		$sha1_temp_response = sha1($timestamp . '.' . $merchantid . '.' . $storedCC['realex_saved_payer_ref'] . '.' . $storedCC['realex_saved_pmt_ref']);
		$sha1_response = sha1($sha1_temp_response . '.' . $this->_method->shared_secret);
		// 501 : Card Ref and Payer combination does not exist: ignore those cases
		if (($result == '00' || $result == '501') && $sha1_response == $sha1_request) {
			return true;
		} else {
			$this->displayError((string)$xml_response->message);
			return false;
		}


	}

	/**
	 * set comment in request
	 * @return string
	 */
	function setComments () {
		$xml_request = '<comments>
				<comment id="1"></comment>
				<comment id="2" />
			</comments>
			';
		return $xml_request;
	}

	/**
	 * set TSS info in request
	 * @return string
	 */
	function setTSSinfo () {
		$BT = $this->order['details']['BT'];
		$ST = ((isset($this->order['details']['ST'])) ? $this->order['details']['ST'] : $this->order['details']['BT']);

		$xml_request = '<tssinfo>
		                <address type="billing">
		                <code>' . $this->getCode($BT) . '</code>
						 <country>' . ShopFunctions::getCountryByID($BT->virtuemart_country_id, 'country_2_code') . '</country>
						 </address>
						<address type="shipping">
					     <code>' . $this->getCode($ST) . '</code>
						 <country>' . ShopFunctions::getCountryByID($ST->virtuemart_country_id, 'country_2_code') . '</country>
						 </address>
						 <custnum></custnum>
						 <varref></varref>
						 <prodid></prodid>
						 </tssinfo>
						 ';

		return $xml_request;
	}

	/**
	 * @return bool|mixed
	 */
	function setNewPayer (&$newPayerRef) {
		$timestamp = $this->getTimestamp();

		$xml_request = $this->setHeader($timestamp, self::REQUEST_TYPE_PAYER_NEW, false);

		$BT = $this->order['details']['BT'];
		$newPayerRef = $this->getUniqueId($BT->customer_number);
		$xml_request .= '<payer type="Business" ref="' . $newPayerRef . '">
				<firstname>' . $this->sanitize($BT->first_name) . '</firstname>
				<surname>' . $this->sanitize($BT->last_name) . '</surname>
				';
		if (!empty($BT->company)) {
			$xml_request .= '<company>' . $BT->company . '</company>
		';
		}

		$xml_request .= '<address>
				<line1>' . $BT->address_1 . '</line1>
				<line2 >' . $BT->address_2 . '</line2>
				<line3 />
				<city>' . $BT->city . '</city>
				<county>' . ShopFunctions::getCountryByID($BT->virtuemart_country_id, 'country_2_code') . '</county>
				<postcode>' . $this->stripnonnumeric($BT->zip, 5) . '</postcode>
				<country code="' . ShopFunctions::getCountryByID($BT->virtuemart_country_id, 'country_2_code') . '"> ' . ShopFunctions::getCountryByID($BT->virtuemart_country_id, 'country_name') . ' </country>
				</address>
				<phonenumbers>
				<home />
				<work>' . $BT->phone_1 . '</work>
				<fax />
				<mobile>' . $BT->phone_2 . '</mobile>
				</phonenumbers>
				<email>' . $BT->email . '</email>
				<comments>
				<comment id="1" />
				<comment id="2" />
				</comments>
				</payer>
				';
		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, '', '', $newPayerRef);
		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);
		return $response;


	}

	function sanitize ($string) {
		$string = $this->replaceNonAsciiCharacters($string);
		$string = vRequest::filterUword($string, ' ');
		return $string;
	}

	/**
	 * @return bool|mixed
	 */
	function setNewPayment ($newPayerRef, &$newPaymentRef) {
		$timestamp = $this->getTimestamp();
		$cc_number = str_replace(" ", "", $this->customerData->getVar('cc_number'));
		$xml_request = $this->setHeader($timestamp, self::REQUEST_TYPE_CARD_NEW, false);
		$newPaymentRef = $this->getUniqueId($this->order['details']['BT']->order_number);
		$xml_request .= '<card>
		 <ref>' . $newPaymentRef . '</ref>
		<payerref>' . $newPayerRef . '</payerref>
		<number>' . $cc_number . '</number>
		<expdate>' . $this->getFormattedExpiryDateForRequest() . '</expdate>
		<chname>' . $this->sanitize($this->customerData->getVar('cc_name')) . '</chname>
		<type>' . $this->customerData->getVar('cc_type') . '</type>
		<issueno />
		</card>
		';
		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, '', '', $newPayerRef, $this->customerData->getVar('cc_name'), $cc_number);
		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);
		return $response;

	}

	/**
	 * @param $value
	 * @return string
	 */
	function getUniqueId ($value) {
		$value = $this->sanitize($value);
		return $value . '-' . time();
	}

	/**
	 * @return string
	 */
	function getFormattedExpiryDateForRequest () {
		return $this->customerData->getVar('cc_expire_month') . substr($this->customerData->getVar('cc_expire_year'), -2);
	}

	/**
	 * set header request
	 * @param $timestamp
	 * @param $type
	 * @return string
	 */
	function setHeader ($timestamp, $type, $include_amount = true) {
		$this->request_type = $type;
		$xml_request = '<request timestamp="' . $timestamp . '" type="' . $type . '">
						<merchantid>' . $this->_method->merchant_id . '</merchantid>
						 <account>' . $this->_method->subaccount . '</account>
						 <orderid>' . $this->order['details']['BT']->order_number . '</orderid>
						 ';
		if ($include_amount) {
			$xml_request .= '<amount currency="' . $this->getPaymentCurrency() . '">' . $this->getTotalInPaymentCurrency() . '</amount>
			';
		}
		return $xml_request;
	}

	/**
	 * set sha1 in request
	 * @param $sha1hash
	 * @return string
	 */
	function setSha1 ($sha1hash) {
		$xml_request = '<sha1hash>' . $sha1hash . '</sha1hash>
		';
		return $xml_request;
	}

	function rebateTransaction ($payments) {

		$payment = $this->getTransactionData($payments);
		if ($payment === NULL) {
			return NULL;
		}
		$timestamp = $this->getTimestamp();
		$xml_request = $this->setHeader($timestamp, self::REQUEST_TYPE_REBATE);
		$xml_request .= '<pasref>' . $payment->realex_response_pasref . '</pasref>
				<authcode>' . $payment->realex_response_authcode . '</authcode>
				';

		$refundhash = sha1($this->_method->rebate_password);
		$xml_request .= '<refundhash>' . $refundhash . '</refundhash>
				 ';

		$xml_request .= $this->setComments();

		// NOTE: There is no cardnumber included in the rebate so the cardnumber field can be left blank in the hash  .

		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, $this->getTotalInPaymentCurrency(), $this->getPaymentCurrency(), "");
		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '<md5hash></md5hash>
		';
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);

		return $response;
	}

	function settleTransaction ($payments) {
		$payment = $this->getTransactionData($payments);
		if ($payment === NULL) {
			return NULL;
		}
		$timestamp = $this->getTimestamp();
		$xml_request = $this->setHeader($timestamp, self::REQUEST_TYPE_SETTLE);
		$xml_request .= '
				<pasref>' . $payment->realex_response_pasref . '</pasref>
				<authcode>' . $payment->realex_response_authcode . '</authcode>
				';


		$xml_request .= $this->setComments();
		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, $this->getTotalInPaymentCurrency(), $this->getPaymentCurrency(), "");
		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '<md5hash></md5hash>
		';
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);

		return $response;
	}

	/**
	 * Before settlement, it is possible to void an authorisation, manual, offline, or rebate request.
	 * If the transaction has been settled or batched, then it cannot be voided, although it can be submitted using another authorisation or rebate.
	 *
	 * @param $payments
	 * @return bool|mixed|null
	 */
	function voidTransaction ($payments) {
		$payment = $this->getTransactionData($payments);
		if ($payment === NULL) {
			return NULL;
		}
		$timestamp = $this->getTimestamp();
		$xml_request = $this->setHeader($timestamp, self::REQUEST_TYPE_VOID);
		$xml_request .= '
				<pasref>' . $payment->realex_response_pasref . '</pasref>
				<authcode>' . $payment->realex_response_authcode . '</authcode>
				';

		$xml_request .= $this->setComments();
// timestamp.merchantid.orderid...

		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, $this->getTotalInPaymentCurrency(), $this->getPaymentCurrency(), "");
		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '<md5hash></md5hash>
		';
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);

		return $response;
	}

	/**
	 * @param        $payments
	 * @param string $request_type
	 * @return null
	 */
	function getTransactionData ($payments, $request_type = array(
		self::REQUEST_TYPE_AUTH,
		self::REQUEST_TYPE_RECEIPT_IN
	)) {
		foreach ($payments as $payment) {
			if (in_array($payment->realex_request_type_response, $request_type)) {
				return $payment;
			}
		}
		return NULL;
	}

	function getLastTransactionData ($payments, $request_type = array(
		self::REQUEST_TYPE_AUTH,
		self::REQUEST_TYPE_RECEIPT_IN
	)) {
		$payment = end($payments);
		if (in_array($payment->realex_request_type_response, $request_type)) {
			return $payment;
		}
		return NULL;
	}

	function  isResponseSuccess ($xml_response) {
		$result = (string)$xml_response->result;
		$success = ($result == self::RESPONSE_CODE_SUCCESS);
		return $success;
	}


	function  isResponseDeclined ($xml_response) {
		$result = (string)$xml_response->result;
		$result = ($result == self::RESPONSE_CODE_DECLINED);
		return $result;
	}

	function  isResponseWrongPhrase ($xml_response) {
		$threedsecure = $xml_response->threedsecure;
		$threedsecure_status = (string)$threedsecure->status;
		$result = (string)$xml_response->result;
		$result = ($result == self::RESPONSE_CODE_SUCCESS AND $threedsecure_status == self::THREEDSECURE_STATUS_NOT_AUTHENTICATED);
		return $result;
	}

	function  isResponseAlreadyProcessed ($xml_response) {
		$result = (string)$xml_response->result;
		$result = ($result == self::RESPONSE_CODE_INVALID_ORDER_ID);
		return $result;
	}

	function  isResponseNotValidated ($xml_response) {
		$result = (string)$xml_response->result;
		$success = ($result == self::RESPONSE_CODE_NOT_VALIDATED);
		return $success;
	}

	/**
	 * get HASH for Realex
	 * @param      $secret
	 * @param      $args
	 * @return string
	 */
	public function getSha1Hash ($secret, $args = null) {
		if (empty($secret)) {
			vmError('function getSha1Hash:no secret value for getSha1Hash', 'no secret value for getSha1Hash');
		}
		$args = func_get_args();
		array_shift($args);
		$hash = sha1(implode('.', $args));
		//$hash =$hash.$secret;
		$hash = sha1($hash . '.' . $secret);
		return $hash;
	}

	/**
	 * Validate the response hash from Realex.
	 * is always timestamp.merchantid.orderid.result.message.pasref.authcode
	 * @param      $xml_response simplexml_load_string
	 */
	protected function validateResponseHash ($response) {
		$xml_response = simplexml_load_string($response);
		if ($xml_response->result != '00') {
			return true;
		}
		$hash = $this->getSha1Hash($this->_method->shared_secret, $xml_response->attributes()->timestamp, $this->_method->merchant_id, (string)$xml_response->orderid, (string)$xml_response->result, (string)$xml_response->message, (string)$xml_response->pasref, (string)$xml_response->authcode);

		if ($hash != $xml_response->sha1hash) {
			$this->displayError(vmText::sprintf('VMPAYMENT_REALEX_ERROR_WRONG_HASH', $hash, $xml_response->sha1hash));
			return false;
		}

		return true;
	}

	/**
	 * @return string
	 */
	function getTimestamp () {
		return strftime("%Y%m%d%H%M%S");
	}

	/**
	 * @param $xml_request
	 * @return bool|mixed
	 */
	function getXmlResponse ($xml_request) {
		$this->xml_request = $xml_request;
		$requestToLog = $xml_request;
		$xml_requestToLog = simplexml_load_string($requestToLog);
		if ($xml_requestToLog) {
			if (isset($xml_requestToLog->card)) {
				$card_number = $xml_requestToLog->card->number;
				$cc_length = strlen($card_number);
				$xml_requestToLog->card->number = str_repeat("*", $cc_length);
			}
			if (isset($xml_requestToLog->sha1hash)) {
				$sha1hash = $xml_requestToLog->sha1hash;
				$sha1hash_length = strlen($sha1hash);
				$xml_requestToLog->sha1hash = str_repeat("*", $sha1hash_length);
			}

			//$this->debugLog(print_r($request, true), 'debug');
			$this->debugLog('<textarea style="margin: 0px; width: 100%; height: 250px;">' . $xml_requestToLog->asXML() . '</textarea>', 'Request', 'message');

		} else {
			// THIS IS AN ERROR: cannot log there was an error
			$this->debugLog('<textarea style="margin: 0px; width: 100%; height: 250px;">COULD NOT LOG INT THIS' . $requestToLog . '</textarea>', 'Request', 'error');
// we do not continue because anyway we will have   <message>Bad XML formation</message>
			return NULL;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->getRemoteURL());
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_request);
		$response = curl_exec($ch);
		curl_close($ch);

		$responseToLog = $response;
		$xml_responseToLog = simplexml_load_string($responseToLog);
		if (isset($xml_responseToLog->sha1hash)) {
			$sha1hash = $xml_responseToLog->sha1hash;
			$sha1hash_length = strlen($sha1hash);
			$xml_responseToLog->sha1hash = str_repeat("*", $sha1hash_length);
		}


		$this->debugLog('<textarea style="margin: 0px; width: 100%; height: 250px;">' . $xml_responseToLog->asXML() . '</textarea>', 'response :', 'message');

		if (empty($response)) {
			$this->displayError(vmText::_('VMPAYMENT_REALEX_EMPTY_RESPONSE'));
			return FALSE;
		}
		if (!$this->validateResponseHash($response)) {
			return FALSE;
		}

		return $response;
	}


	/**
	 * @param $message
	 */
	static $displayErrorDone = false;

	function displayError ($admin, $public = '') {
		if ($admin == NULL) {
			$admin = "an error occurred";
		}

		if (empty($public) AND $this->_method->debug) {
			$public = $admin;
		}
		vmError((string)$admin, (string)$public);
	}

	/**
	 * Realex requires that non asci characters are removed from the cc name
	 * @param $string
	 * @return string
	 */
	function replaceNonAsciiCharacters ($string) {
		$replacements = $this->getReplacements();
		$string = strtr($string, $replacements);
		return $string;
	}

	/**
	 * Return array of URL characters to be replaced.
	 *
	 * @return array
	 */
	public function getReplacements () {
		return array(
			'Á'  => 'A',
			'Â'  => 'A',
			'Å'  => 'A',
			'Ă'  => 'A',
			'Ä'  => 'A',
			'À'  => 'A',
			'Æ'  => 'A',
			'Ć'  => 'C',
			'Ç'  => 'C',
			'Č'  => 'C',
			'Ď'  => 'D',
			'É'  => 'E',
			'È'  => 'E',
			'Ë'  => 'E',
			'Ě'  => 'E',
			'Ê'  => 'E',
			'Ì'  => 'I',
			'Í'  => 'I',
			'Î'  => 'I',
			'Ï'  => 'I',
			'Ĺ'  => 'L',
			'ľ'  => 'l',
			'Ľ'  => 'L',
			'Ń'  => 'N',
			'Ň'  => 'N',
			'Ñ'  => 'N',
			'Ò'  => 'O',
			'Ó'  => 'O',
			'Ô'  => 'O',
			'Õ'  => 'O',
			'Ö'  => 'O',
			'Ø'  => 'O',
			'Ŕ'  => 'R',
			'Ř'  => 'R',
			'Š'  => 'S',
			'Ś'  => 'S',
			'Ť'  => 'T',
			'Ů'  => 'U',
			'Ú'  => 'U',
			'Ű'  => 'U',
			'Ü'  => 'U',
			'Û'  => 'U',
			'Ý'  => 'Y',
			'Ž'  => 'Z',
			'Ź'  => 'Z',
			'á'  => 'a',
			'â'  => 'a',
			'å'  => 'a',
			'ä'  => 'a',
			'à'  => 'a',
			'æ'  => 'a',
			'ć'  => 'c',
			'ç'  => 'c',
			'č'  => 'c',
			'ď'  => 'd',
			'đ'  => 'd',
			'é'  => 'e',
			'ę'  => 'e',
			'ë'  => 'e',
			'ě'  => 'e',
			'è'  => 'e',
			'ê'  => 'e',
			'ì'  => 'i',
			'í'  => 'i',
			'î'  => 'i',
			'ï'  => 'i',
			'ĺ'  => 'l',
			'ń'  => 'n',
			'ň'  => 'n',
			'ñ'  => 'n',
			'ò'  => 'o',
			'ó'  => 'o',
			'ô'  => 'o',
			'ő'  => 'o',
			'ö'  => 'o',
			'ø'  => 'o',
			'š'  => 's',
			'ś'  => 's',
			'ř'  => 'r',
			'ŕ'  => 'r',
			'ť'  => 't',
			'ů'  => 'u',
			'ú'  => 'u',
			'ù'  => 'u',
			'ű'  => 'u',
			'ü'  => 'u',
			'û'  => 'u',
			'ý'  => 'y',
			'ž'  => 'z',
			'ź'  => 'z',
			'˙'  => '-',
			'ß'  => 'ss',
			'Ą'  => 'A',
			'µ'  => 'u',
			'ą'  => 'a',
			'Ę'  => 'E',
			'ż'  => 'z',
			'Ż'  => 'Z',
			'ł'  => 'l',
			'Ł'  => 'L',
			'А'  => 'A',
			'а'  => 'a',
			'Б'  => 'B',
			'б'  => 'b',
			'В'  => 'V',
			'в'  => 'v',
			'Г'  => 'G',
			'г'  => 'g',
			'Д'  => 'D',
			'д'  => 'd',
			'Е'  => 'E',
			'е'  => 'e',
			'Ж'  => 'Zh',
			'ж'  => 'zh',
			'З'  => 'Z',
			'з'  => 'z',
			'И'  => 'I',
			'и'  => 'i',
			'Й'  => 'I',
			'й'  => 'i',
			'К'  => 'K',
			'к'  => 'k',
			'Л'  => 'L',
			'л'  => 'l',
			'М'  => 'M',
			'м'  => 'm',
			'Н'  => 'N',
			'н'  => 'n',
			'О'  => 'O',
			'о'  => 'o',
			'П'  => 'P',
			'п'  => 'p',
			'Р'  => 'R',
			'р'  => 'r',
			'С'  => 'S',
			'с'  => 's',
			'Т'  => 'T',
			'т'  => 't',
			'У'  => 'U',
			'у'  => 'u',
			'Ф'  => 'F',
			'ф'  => 'f',
			'Х'  => 'Kh',
			'х'  => 'kh',
			'Ц'  => 'Tc',
			'ц'  => 'tc',
			'Ч'  => 'Ch',
			'ч'  => 'ch',
			'Ш'  => 'Sh',
			'ш'  => 'sh',
			'Щ'  => 'Shch',
			'щ'  => 'shch',
			'Ы'  => 'Y',
			'ы'  => 'y',
			'Э'  => 'E',
			'э'  => 'e',
			'Ю'  => 'Iu',
			'ю'  => 'iu',
			'Я'  => 'Ia',
			'я'  => 'ia',
			'Ъ'  => '',
			'ъ'  => '',
			'Ь'  => '',
			'ь'  => '',
			'Ё'  => 'E',
			'ё'  => 'e',
			'ου' => 'ou',
			'ού' => 'ou',
			'α'  => 'a',
			'β'  => 'b',
			'γ'  => 'g',
			'δ'  => 'd',
			'ε'  => 'e',
			'ζ'  => 'z',
			'η'  => 'i',
			'θ'  => 'th',
			'ι'  => 'i',
			'κ'  => 'k',
			'λ'  => 'l',
			'μ'  => 'm',
			'ν'  => 'n',
			'ξ'  => 'ks',
			'ο'  => 'o',
			'π'  => 'p',
			'ρ'  => 'r',
			'σ'  => 's',
			'τ'  => 't',
			'υ'  => 'i',
			'φ'  => 'f',
			'χ'  => 'x',
			'ψ'  => 'ps',
			'ω'  => 'o',
			'ά'  => 'a',
			'έ'  => 'e',
			'ί'  => 'i',
			'ή'  => 'i',
			'ό'  => 'o',
			'ύ'  => 'i',
			'ώ'  => 'o',
			'Ου' => 'ou',
			'Ού' => 'ou',
			'Α'  => 'a',
			'Β'  => 'b',
			'Γ'  => 'g',
			'Δ'  => 'd',
			'Ε'  => 'e',
			'Ζ'  => 'z',
			'Η'  => 'i',
			'Θ'  => 'th',
			'Ι'  => 'i',
			'Κ'  => 'k',
			'Λ'  => 'l',
			'Μ'  => 'm',
			'Ν'  => 'n',
			'Ξ'  => 'ks',
			'Ο'  => 'o',
			'Π'  => 'p',
			'Ρ'  => 'r',
			'Σ'  => 's',
			'Τ'  => 't',
			'Υ'  => 'i',
			'Φ'  => 'f',
			'Χ'  => 'x',
			'Ψ'  => 'ps',
			'Ω'  => 'o',
			'ς'  => 's',
			'Ά'  => 'a',
			'Έ'  => 'e',
			'Ή'  => 'i',
			'Ί'  => 'i',
			'Ό'  => 'o',
			'Ύ'  => 'i',
			'Ώ'  => 'o',
			'ϊ'  => 'i',
			'ΐ'  => 'i',

		);

	}
}