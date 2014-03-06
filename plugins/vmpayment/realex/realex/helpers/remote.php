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


class RealexHelperRealexRemote extends RealexHelperRealex {

	const ECI_AUTHENTICATED_VISA = 5;
	const ECI_LIABILITY_SHIFT_VISA = 6;
	const ECI_NO_LIABILITY_SHIFT_VISA = 7;

	const ECI_AUTHENTICATED_MASTERCARD = '2';
	const ECI_LIABILITY_SHIFT_MASTERCARD = '1';
	const ECI_NO_LIABILITY_SHIFT_MASTERCARD = '0';


	/**
	 * Response results from threedsecure = "3ds-verifysig";
	 */
	const THREEDSECURE_STATUS_AUTHENTICATED = 'Y';
	const THREEDSECURE_STATUS_NOT_AUTHENTICATED = 'N';
	const THREEDSECURE_STATUS_ACKNOWLEDGED = 'A';
	const THREEDSECURE_STATUS_UNAVAILABLE = 'U';

	/**
	 * Response results REQUEST_TYPE_3DS_VERIFYSIG = "3ds-verifysig";
	 */
	const VERIFYSIG_RESULT_VALIDATED = '00';
	const VERIFYSIG_RESULT_NOT_VALIDATED = '110';
	const VERIFYSIG_RESULT_INVALID_ACS_RESPONSE = '5xx';


	function __construct ($method, $plugin) {
		parent::__construct($method, $plugin);

	}

	public function confirmedOrder (&$postRequest, &$request3DSecure) {
		$postRequest = false;
		$request3DSecure = false;
		if ($this->_method->dcc) {
			$response = $this->requestDccRate();
		} elseif ($this->_method->threedsecure and $this->isCC3DSVerifyEnrolled()) {
			$request3DSecure = true;
			$response = $this->request3DSecure();
		} else {
			$response = $this->requestAuth();
		}


		return $response;

	}


	/**
	 * @return bool
	 */
	function isCC3DSVerifyEnrolled () {
		$CC3DSVerifyEnrolled = array('AMEX','VISA', 'MC', 'SWITCH');
		return in_array($this->customerData->getVar('cc_type'), $CC3DSVerifyEnrolled);
	}

	function redirect3DSRequest ($response) {
		$xml_response = simplexml_load_string($response);

		// Merchant Data. Any data that you would like echoed back to you by the ACS.
		// Useful data here is your order id and the card details (so that you can send the authorisation message on receipt of a positive authentication).
		// Any information in this field must be encrypted then compressed and base64 encoded.
		$md = $this->setMd();

		// The URL that the ACS should reply to. This should be on your website and must be an HTTPS address.
		$url_validation = JURI::root() . 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginnotification&notificationTask=handle3DSRequest&order_number=' . $this->order['details']['BT']->order_number . '&pm=' . $this->order['details']['BT']->virtuemart_paymentmethod_id . '&Itemid=' . vmRequest::getInt('Itemid') . '&lang=' . vmRequest::getCmd('lang', '');

		$this->display3DSForm((string)$xml_response->url, (string)$xml_response->pareq, $md, $url_validation);
	}

	function setMd () {
		if (!class_exists('vmCrypt')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmCrypt.php');
		}

		$md = array(
			'cc_type' => $this->customerData->getVar('cc_type'),
			'cc_name' =>$this->customerData->getVar('cc_name'),
			'cc_number' =>$this->customerData->getVar('cc_number'),
			'cc_cvv' =>$this->customerData->getVar('cc_cvv'),
			'cc_expire_month' =>$this->customerData->getVar('cc_expire_month'),
			'cc_expire_year' =>$this->customerData->getVar('cc_expire_year'),
		);
		$serializedMd = serialize($md);
		$encryptMd = vmCrypt::encrypt($serializedMd);
		return $encryptMd;

	}

	function getMd ($cryptedMd) {
		if (!class_exists('vmCrypt')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmCrypt.php');
		}
		$decryptedMd = vmCrypt::decrypt($cryptedMd);
		$md = unserialize($decryptedMd);
		return $md;
	}

	/**
	 * 4a. Realex send the URL of the cardholder’s bank ACS
	 * (this is the webpage that the cardholder uses to enter their password). Also included is the PAReq (this is needed by the ACS).
	 * POST this encoded PAReq (along with the TermURL and any merchant data you require).
	 * This will result in the cardholder being presented with the authenticaton page where they will be asked to confirm the amount and enter their password.
	 * 6. Once the cardholder enters their password, the ACS POSTS the encoded PARes to the merchants TermURL.
	 * @param $url_redirect
	 * @param $pareq
	 * @param $md64
	 */
	public function display3DSForm ($url_redirect, $pareq, $md, $url_validation) {
		?>
		<HTML>
		<HEAD>
			<TITLE><?php echo vmText::_('VMPAYMENT_REALEX_3DS_VERIFICATION') ?></TITLE>
			<SCRIPT LANGUAGE="Javascript">
				<!--
				function OnLoadEvent() {
					document.form.submit();
				}
				//-->
			</SCRIPT>
		</HEAD>
		<BODY onLoad="OnLoadEvent()">
		<FORM NAME="form" ACTION="<?php echo $url_redirect ?>" METHOD="POST">
			<INPUT TYPE="hidden" NAME="PaReq" VALUE="<?php echo $pareq ?>">
			<INPUT TYPE="hidden" NAME="TermUrl" VALUE="<?php echo $url_validation ?>">
			<INPUT TYPE="hidden" NAME="MD" VALUE="<?php echo $md ?>">
			<NOSCRIPT><INPUT TYPE="submit"></NOSCRIPT>
		</FORM>
		</BODY>
		</HTML>
		<?php
		exit;
	}

	function displayRemoteDCCForm ($response_dcc) {
		$html = $this->displayRemoteCCForm($response_dcc);
		echo $html;

	}

	function displayRemoteCCForm ($response_dcc = NULL) {

		$useSSL = $this->useSSL();
		$submit_url = JRoute::_('index.php?option=com_virtuemart&Itemid=' . vmRequest::getInt('Itemid') . '&lang=' . vmRequest::getCmd('lang', ''), $this->cart->useXHTML, $useSSL);
		$card_payment_button = $this->getPaymentButton();
		$xml_response_dcc = "";
		if ($this->isCC3DSVerifyEnrolled() and $this->_method->threedsecure) {
			$notificationTask = "handleVerify3D";
		} elseif ($response_dcc) {
			$xml_response_dcc = simplexml_load_string($response_dcc);
			$notificationTask = "handleRemoteDccForm";
		} else {
			$notificationTask = "handleRemoteCCForm";
		}


		if (empty($this->_method->creditcards)) {
			$this->_method->creditcards = RealexHelperRealex::getRealexCreditCards();
		} elseif (!is_array($this->_method->creditcards)) {
			$this->_method->creditcards = (array)$this->_method->creditcards;
		}
		$ccDropdown = "";
		if (!JFactory::getUser()->guest AND $this->_method->realvault) {
			//$selected_cc = $realexInterface->customerData->_redirect_cc_selected;
			//$ccDropdown = $realexInterface->getCCDropDown($this->_currentMethod->virtuemart_paymentmethod_id, JFactory::getUser()->id, $selected_cc, false);

		}
		$amountInCurrency = $this->plugin->getAmountInCurrency($this->order['details']['BT']->order_total, $this->_method->payment_currency);
		$order_amount = vmText::sprintf('VMPAYMENT_REALEX_PAYMENT_TOTAL', $amountInCurrency['display']);
		$payment_name = $this->plugin->renderPluginName($this->_method);
		$cvv_images = $this->_method->cvv_images;
		$cvv_info = "";
		$dccinfo = "";
		if ($xml_response_dcc) {
			$success = $this->isResponseSuccess($xml_response_dcc);
			if ( $success AND isset($xml_response_dcc->dccinfo)) {
				$dccinfo = $xml_response_dcc->dccinfo;
			}
		}

		$html = $this->plugin->renderByLayout('remote_cc_form', array(
		                                                             "order_amount"                => $order_amount,
		                                                             "payment_name"                => $payment_name,
		                                                             "submit_url"                  => $submit_url,
		                                                             "card_payment_button"         => $card_payment_button,
		                                                             "notificationTask"            => $notificationTask,
		                                                             'creditcardsDropDown'         => $ccDropdown,
		                                                             "dccinfo"                     => $dccinfo,
		                                                             "customerData"                => $this->customerData,
		                                                             'creditcards'                 => $this->_method->creditcards,
		                                                             'offer_save_card'             => $this->_method->offer_save_card,
		                                                             'order_number'                => $this->order['details']['BT']->order_number,
		                                                             'virtuemart_paymentmethod_id' => $this->_method->virtuemart_paymentmethod_id,
		                                                             'cvv_info'                    => $cvv_info,
		                                                             'cvv_images'                    => $cvv_images,
		                                                        ));
		JRequest::setVar('html', $html);
		JRequest::setVar('display_title', false);
		return $html;
	}

	/**
	 * @return bool|mixed
	 */
	function request3DSVerifyEnrolled () {
		$timestamp = $this->getTimestamp();
		$xml_request = $this->setHeader($timestamp, self::REQUEST_TYPE_3DS_VERIFYENROLLED);
		$xml_request .= $this->getXmlRequestCard();
		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, $this->getTotalInPaymentCurrency(), $this->getPaymentCurrency(), $this->getCCnumber());
		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);
		return $response;
	}

	/**
	 * const VERIFYSIG_RESULT_VALIDATED = '00';
	const VERIFYSIG_RESULT_NOT_VALIDATED = '110';
	const VERIFYSIG_RESULT_INVALID_ACS_RESPONSE = '5xx';
	 *
	 * /**
	 * Response results from threedsecure = "3ds-verifysig";

	const THREEDSECURE_STATUS_AUTHENTICATED = 'Y';
	const THREEDSECURE_STATUS_NOT_AUTHENTICATED = 'N';
	const THREEDSECURE_STATUS_ACKNOWLEDGED = 'A';
	const THREEDSECURE_STATUS_UNAVAILABLE = 'U';


	 * 6. Take these values returned from the issuer, and create a 3ds-verifysig request. Send it to Realex.
	7. Depending on the result take the following action:
	a. If the result is “00” the message has not been tampered with. Continue:
	i. If the status is “Y”, the cardholder entered their passphrase correctly.
	 * This is a full 3DSecure transaction, go to step 8b.
	ii. If the status is “N”, the cardholder entered the wrong passphrase.
	 * No shift in liability, do not proceed to authorisation.
	iii. If the status is “U”, then the Issuer was having problems with their systems at the time
	 * and was unable to check the passphrase. You may continue with the transaction (go to step 8c) but there will be no shift in liability.
	iv. If the status is “A” the issuing bank acknowledges the attempt made by the merchant and accepts the liability shift. Continue to step 8a.
	19
	￼
	￼￼￼8.
	b. If the result is “110”, the digital signatures do not match the message and most likely the message has been tampered with. No shift in liability, do not proceed to authorisation.
	 * @param $response
	 * @return bool|int|string
	 */
	function  getEciFrom3DSVerifysig ($response, $requireLiabilityShift = true) {
		$xml_response = simplexml_load_string($response);
		$result = (string)$xml_response->result;

		if (substr($result, 0, 1) == '5') {
			$result = '5xx';
		}
		$allowLiabilityShift = false;
		$threedsecure = $xml_response->threedsecure;
		$threedsecure_status = (string)$threedsecure->status;
		if ($result == self::VERIFYSIG_RESULT_VALIDATED) {
			switch ($threedsecure_status) {
				case self::THREEDSECURE_STATUS_AUTHENTICATED:
					$allowLiabilityShift = true;
					$threedSecureAuthentication = true;
					break;

				case self::THREEDSECURE_STATUS_ACKNOWLEDGED:
					/**
					 * If the status is “A” the issuing bank acknowledges the attempt made by the merchant and
					 * accepts the liability shift.
					 * Continue to step 8a.
					 * a. Send a normal Realex authorisation message (set the ECI field to 6 or 1).
					 * The merchant will not be liable for repudiation chargebacks.
					 * */
					$allowLiabilityShift = true;
					$threedSecureAuthentication = false;
					break;

				case self::THREEDSECURE_STATUS_NOT_AUTHENTICATED:
					/**
					 * If the status is “N”, the cardholder entered the wrong passphrase.
					 * No shift in liability, do not proceed to authorisation.
					 * if the merchants chooses "Require liability shift" as "No"
					 * then the transaction will proceed to authorisation
					 * but there will not be a liability shift and the ECI value should be 7
					 */
					$allowLiabilityShift = false;
					$threedSecureAuthentication = false;
					break;

				default:
				case self::THREEDSECURE_STATUS_UNAVAILABLE:
					/**
					 * If the status is “U”, then the Issuer was having problems with their systems at the time
					 * and was unable to check the passphrase.
					 * You may continue with the transaction (go to step 8c) but there will be no shift in liability.
					 * Send a normal Realex authorisation message (set the ECI field to 7 or 0).
					 * The merchant will be liable for repudiation chargebacks.
					 */
				$allowLiabilityShift = false;
				$threedSecureAuthentication = false;
					break;
			}
		} else {
			/**
			 * If the result is “110”, the digital signatures do not match the message
			 * and most likely the message has been tampered with. No shift in liability, do not proceed to authorisation.
			 */
			$allowLiabilityShift = false;
			$threedSecureAuthentication = false;
		}
		if (!$allowLiabilityShift and $requireLiabilityShift) {
			vmError("Transaction Requires Liability Shit");
		}
		$eci = $this->getEciValue($allowLiabilityShift, $threedSecureAuthentication);
		return $eci;
	}

	/**
	 * 4. Depending on the response take the following action:
	a. If the response code is “00” and the enrolled tag is “Y” there will also be a URL returned. Redirect the cardholder to this URL using a hidden form.
	b. If the response code is “110” and the enrolled tag is “N” the cardholder is not enrolled. Skip to step 8a.
	c. If the enrolled tag is “U” the enrolled status could not be verified. Skip to step 8c.
	d. If the response is “220” the card scheme directory server may be unavailable. You may
	still proceed to authorisation but no liability shift will be received. Skip to step 8c.
	 * @param $xml_response
	 * @return bool|int|null
	 */

	public function getEciFrom3DSVerifyEnrolled ($response) {
		$xml_response = simplexml_load_string($response);
		$result = (string)$xml_response->result;

		if (substr($result, 0, 1) == '5') {
			$result = '5xx';
		}

		switch ($result) {
			case self::ENROLLED_RESULT_ENROLLED:
				$liabilityShift = true;
				break;

			case self::ENROLLED_RESULT_NOT_ENROLLED:
				if ($xml_response->enrolled == self::ENROLLED_TAG_NOT_ENROLLED) {
					$liabilityShift = true;
				} else {
					$liabilityShift = false;
				}
				break;

			default:
			case self::ENROLLED_RESULT_INVALID_RESPONSE:
			case self::ENROLLED_RESULT_FATAL_ERROR:
				$liabilityShift = false;
				break;
		}

		// if there is no liability shift, and it is required by the client, throw exception
		$eci = false;
		if (!$liabilityShift && $this->_method->require_liability) {
			vmError("Transaction Requires Liability Shit");
			return $eci;
		}

		// determine the eci value to use if the card is not enrolled in the 3D Secure scheme
		$eci = false;
		if ($xml_response->enrolled != self::ENROLLED_TAG_ENROLLED) {
			$eci = $this->getEciValue($liabilityShift);
		}

		return $eci;
	}

	/**
	 * Retrieve the ECI value for the provided card type, liability and 3D Secure result.
	 *
	 */
	public function getEciValue ($allowLiabilityShift, $threedSecureAuthentication = false) {
		$eci_value = false;
		$cc_type = $this->customerData->getVar('cc_type');

		if ($cc_type == 'VISA' or $cc_type=='AMEX') {
			if ($threedSecureAuthentication === true) {
				$eci_value = RealexHelperRealexRemote::ECI_AUTHENTICATED_VISA;

			} else {
				if ($allowLiabilityShift === true) {
					$eci_value = RealexHelperRealexRemote::ECI_LIABILITY_SHIFT_VISA;
				} else {
					$eci_value = RealexHelperRealexRemote::ECI_NO_LIABILITY_SHIFT_VISA;
				}
			}
		} else {
			if ($threedSecureAuthentication === true) {
				$eci_value = RealexHelperRealexRemote::ECI_LIABILITY_SHIFT_MASTERCARD;

			} else {
				if ($allowLiabilityShift === true) {
					$eci_value = RealexHelperRealexRemote::ECI_LIABILITY_SHIFT_MASTERCARD;
				} else {
					$eci_value = RealexHelperRealexRemote::ECI_NO_LIABILITY_SHIFT_MASTERCARD;

				}
			}
		}

		return $eci_value;
	}

	/**
	 * @return array
	 */

	function getExtraPluginInfo () {
		return NULL;


	}

	function confirmedOrderDccRequest ($response_dcc) {
		$request3DSecure = false;
		if ($this->_currentMethod->threedsecure and $this->isCC3DSVerifyEnrolled()) {
			$request3DSecure = true;
			$response = $this->request3DSecure();
		} else {
			$selectedCCParams = array();
			if ($this->doRealVault($selectedCCParams)) {
				$newPayerRef = "";
				$responseNewPayer = $this->setNewPayer($newPayerRef);
				$setNewPayerSuccess = $this->manageSetNewPayer($responseNewPayer);
				if ($setNewPayerSuccess) {
					$newPaymentRef = "";
					$responseNewPayment = $this->setNewPayment($newPayerRef, $newPaymentRef);
					$setNewPaymentSuccess = $this->manageSetNewPayment($responseNewPayment, $newPayerRef, $newPaymentRef);
				}
			}
			$xml_response_dcc = simplexml_load_string($response_dcc);

			$response = $this->requestAuth($xml_response_dcc);
			$this->manageResponseRequestAuth($response);
		}


	}

	function confirmedOrderRealVault () {

		$selectedCCParams = array();
		if ($this->doRealVault($selectedCCParams)) {
			$newPayerRef = "";
			$responseNewPayer = $this->setNewPayer($newPayerRef);
			$setNewPayerSuccess = $this->manageSetNewPayer($responseNewPayer);
			if ($setNewPayerSuccess) {
				$newPaymentRef = "";
				$responseNewPayment = $this->setNewPayment($newPayerRef, $newPaymentRef);
				$setNewPaymentSuccess = $this->manageSetNewPayment($responseNewPayment, $newPayerRef, $newPaymentRef);
			}
		}
		return;
	}

	/**
	 * @param $response
	 * @param $order
	 * @return null|string
	 */
	private function manageResponse3DSecure ($response) {
		$this->_storeRealexInternalData($response, $this->_currentMethod->virtuemart_paymentmethod_id, $this->order['details']['BT']->virtuemart_order_id, $this->order['details']['BT']->order_number, $this->request_type);

		$xml_response_3DSecure = simplexml_load_string($response);
		$responseAuth = '';

		$BT = $this->order['details']['BT'];
		$order_number = $BT->order_number;
		$success = $this->isResponseSuccess($xml_response_3DSecure);

		$eci = $this->getEciFrom3DSVerifyEnrolled($xml_response_3DSecure);
		if ($eci == NULL) {
			return NULL;
		}
		if (!$eci) {
			$this->redirect3DSRequest($xml_response_3DSecure);

		} else {
			$xml_response_3DSecure->addChild('eci', $eci);
			$responseAuth = $this->requestAuth(NULL, $xml_response_3DSecure);
			$this->manageResponseRequestAuth($response);
		}


		return $responseAuth;

	}

	/**
	 * @param $response
	 * @param $realexInterface
	 * @return bool
	 */
	private function manageSetNewPayer ($response) {
		$this->plugin->_storeRealexInternalData($response, $this->_currentMethod->virtuemart_paymentmethod_id, $this->order['details']['BT']->virtuemart_order_id, $this->order['details']['BT']->order_number, $this->request_type);

		$xml_response = simplexml_load_string($response);

		$success = $this->isResponseSuccess($xml_response);

		if (!$success) {
			$error = $xml_response->message . " (" . (string)$xml_response->result . ")";
			$this->displayError($error);
			vmInfo('VMPAYMENT_REALEX_CARD_STORAGE_FAILED');
			return false;
		}
		return true;
	}

	/**
	 * @param $response
	 * @param $realexInterface
	 * @return bool
	 */
	private function manageSetNewPayment ($response, $newPayerRef, $newPaymentRef) {
		$this->plugin->_storeRealexInternalData($response, $this->_currentMethod->virtuemart_paymentmethod_id, $this->order['details']['BT']->virtuemart_order_id, $this->order['details']['BT']->order_number, $this->request_type);

		$xml_response = simplexml_load_string($response);

		$success = $this->isResponseSuccess($xml_response);

		if (!$success) {
			$error = $xml_response->message . " (" . (string)$xml_response->result . ")";
			$this->displayError($error);
			vmInfo('VMPAYMENT_REALEX_CARD_STORAGE_FAILED');
			return false;
		}

		$userfield['virtuemart_user_id'] = $this->order['details']['BT']->virtuemart_user_id;
		$userfield['virtuemart_paymentmethod_id'] = $this->_currentMethod->virtuemart_paymentmethod_id;
		$userfield['realex_saved_pmt_ref'] = $newPaymentRef;
		$userfield['realex_saved_payer_ref'] = $newPayerRef;
		$userfield['realex_saved_pmt_type'] = $this->customerData->getVar('remote_cc_type');
		$userfield['realex_saved_pmt_digits'] = $this->cc_mask($this->customerData->getVar('remote_cc_number'));
		$userfield['realex_saved_pmt_name'] = $this->customerData->getVar('remote_cc_name');
		if (!class_exists('VmTableData')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmtabledata.php');
		}
		JLoader::import('joomla.plugin.helper');
		JPluginHelper::importPlugin('vmuserfield');
		$app = JFactory::getApplication();
		$data = array();
		$value = '';
		$app->triggerEvent('plgVmPrepareUserfieldDataSave', array(
		                                                         'pluginrealex',
		                                                         'realex',
		                                                         &$userfield,
		                                                         &$value,
		                                                         $userfield
		                                                    ));


		vmInfo('VMPAYMENT_REALEX_CARD_STORAGE_SUCCESS');


		return true;
	}


	/**
	 * @return bool|mixed
	 */
	function request3DSVerifysig () {
		$paRes = vmRequest::getVar('PaRes', '');
		$serializedMd = vmRequest::getVar('MD', '');
		$md=$this->getMd($serializedMd);
		$this->customerData->setCustomerData($md);

		if (empty($paRes)) {
			$this->plugin->redirectToCart(vmText::_('VMPAYMENT_REALEX_ERROR_TRY_AGAIN'));
		}
		$timestamp = $this->getTimestamp();
		$xml_request = $this->setHeader($timestamp, self::REQUEST_TYPE_3DS_VERIFYSIG);
		$xml_request .= $this->getXmlRequestCard();
		$xml_request .= '<pares>' . $paRes . '</pares>
		';


		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, $this->getTotalInPaymentCurrency(), $this->getPaymentCurrency(), $this->getCCnumber());
		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);
		return $response;
	}


	/**
	 * @param null $xml_response_dcc
	 * @param null $xml_3Dresponse
	 * @return bool|mixed
	 */
	function requestAuth ($xml_response_dcc = NULL, $xml_3Dresponse = NULL) {

		$timestamp = $this->getTimestamp();
		$xml_request = $this->setHeader($timestamp, self::REQUEST_TYPE_AUTH);
		$xml_request .= '<card>
				<number>' . $this->getCCnumber() . '</number>
				<expdate>' . $this->getFormattedExpiryDateForRequest() . '</expdate>
				<chname>' . $this->customerData->getVar('cc_name') . '</chname>
				<type>' . $this->customerData->getVar('cc_type') . '</type>
				<issueno></issueno>
				<cvn>
				<number>' . $this->customerData->getVar('cc_cvv') . '</number>
				<presind>1</presind>
				</cvn>
				</card>
				';
		if ($this->_method->dcc) {
			$xml_request .= '<autosettle flag="1" />';
		} else {
			$xml_request .= '<autosettle flag="' . $this->_method->settlement . '" />
			';
		}
		if (!empty($xml_3Dresponse->eci) AND isset($xml_3Dresponse->eci)) {
			$xml_request .= '<eci>' . $xml_3Dresponse->eci . '</eci>
				 ';
		}
		/**
		 * MPI: Merchant Plug In - it is the component that communicates with the other components during the actual transaction.
		 */
		if ($xml_3Dresponse AND !empty($xml_3Dresponse->threedsecure) AND isset($xml_3Dresponse->threedsecure)) {
			$xml_request .= '<mpi>
				 <eci>' . $xml_3Dresponse->threedsecure->eci . '</eci>
				  <cavv>' . $xml_3Dresponse->threedsecure->cavv . '</cavv>
				  <xid>' . $xml_3Dresponse->threedsecure->xid . '</xid>
				 </mpi>
				 ';
		}

		if ($this->_method->dcc ) {
			$dcc_choice = vmRequest::getInt('dcc_choice', 0);
			if ($dcc_choice) {
				$rate = $xml_response_dcc->dccinfo->cardholderrate;
				$currency = $xml_response_dcc->dccinfo->cardholdercurrency;
				$amount = $xml_response_dcc->dccinfo->cardholderamount;
			} else {
				$rate = 1;
				if ($xml_response_dcc) {
					$currency = $xml_response_dcc->dccinfo->merchantcurrency;
					$amount = $xml_response_dcc->dccinfo->merchantamount;
				} else {
					$currency = $this->getPaymentCurrency();
					$amount = $this->getTotalInPaymentCurrency();
				}

			}
			$xml_request .= '<dccinfo>
						<ccp>' . $this->_method->dcc_service . '</ccp>
						<type>1</type>
						<rate>' . $rate . '</rate>
						<ratetype>S</ratetype>
						<amount currency="' . $currency . '">' . $amount . '</amount>
						</dccinfo>
				';
		}
		$xml_request .= $this->setComments();
		$xml_request .= $this->setTssInfo();

		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, $this->getTotalInPaymentCurrency(), $this->getPaymentCurrency(), $this->getCCnumber());
		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '<md5hash></md5hash>';
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);

		return $response;
	}

	/**
	 * @param bool $realvault
	 * @return bool|mixed
	 */
	public function requestDccrate ($realvault = false) {

		$request_type = ($realvault) ? self::REQUEST_TYPE_REALVAULT_DCCRATE : self::REQUEST_TYPE_DCCRATE;
		$timestamp = $this->getTimestamp();
		$xml_request = $this->setHeader($timestamp, $request_type);

		if ($realvault) {
			$xml_request .= '<payerref>' . $xml_request->payerref . '</payerref>
			<paymentmethod>' . $xml_request->pmtref . '</paymentmethod>';
		} else {
			$xml_request .= $this->getXmlRequestCard();
		}
		$xml_request .= '<dccinfo>
			<ccp>' . $this->_method->dcc_service . '</ccp>
			<type>1</type>
		</dccinfo>';


		$xml_request .= $this->setComments();
		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, $this->getTotalInPaymentCurrency(), $this->getPaymentCurrency(), $this->getCCnumber());

		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '<md5hash></md5hash>';
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);

		return $response;
	}


	/**
	 *
	 *7. Depending on the result take the following action:
	a. If the result is “00” the message has not been tampered with. Continue:
	i. If the status is “Y”, the cardholder entered their passphrase correctly. This is a full 3DSecure transaction, go to step 8b.
	ii. If the status is “N”, the cardholder entered the wrong passphrase. No shift in liability, do not proceed to authorisation.
	iii. If the status is “U”, then the Issuer was having problems with their systems at the time and was unable to check the passphrase. You may continue with the transaction (go to step 8c) but there will be no shift in liability.
	iv. If the status is “A” the issuing bank acknowledges the attempt made by the merchant and accepts the liability shift. Continue to step 8a.
	19
	￼
	￼￼￼8.
	b. If the result is “110”, the digital signatures do not match the message and most likely the message has been tampered with. No shift in liability, do not proceed to authorisation.
	 *
	 * @param $response3D
	 * @return bool|mixed
	 */
	function manageResponse3DSVerifyEnrolled ($response3D) {
		$this->manageResponseRequest($response3D);
	}

	function manageResponse3DSVerifysig ($response3DSVerifysig) {
		$this->manageResponseRequest($response3DSVerifysig);

	}

	/**
	 * @param $response
	 */
	function manageResponseRequestAuth ($response) {
		$this->manageResponseRequest($response);
	}

	/**
	 * @param $response
	 */

	function manageResponseRequest3DSecure ($response) {
		$this->manageResponseRequest($response);


	}

	/**
	 * possible results:
	 * 105: Card not supported by eDCC
	 * 00: Card supported by eDCC
	 * @param $response
	 * @param $order
	 * @return null|string
	 */
	function manageResponseDccRate ($response) {
		$this->manageResponseRequest($response);
	}

	function getXmlRequestCard () {

		$xml_request = '<card>';
		$xml_request .= '<number>' . $this->getCCnumber() . '</number>';
		$xml_request .= '<expdate>' . $this->getFormattedExpiryDateForRequest() . '</expdate>';
		$xml_request .= '<chname>' . $this->customerData->getVar('cc_name') . '</chname>';
		$xml_request .= '<type>' . $this->customerData->getVar('cc_type') . '</type>';
		$xml_request .= '</card>';
		return $xml_request;
	}


	function getCCnumber () {
		return str_replace(" ", "", $this->customerData->getVar('cc_number'));
	}

	/**
	 * @return string
	 */
	function displayExtraPluginInfo () {

		return NULL;
	}

	/**
	 * @param bool $enqueueMessage
	 * @return bool
	 */
	function validateRemoteCCForm ($enqueueMessage = true) {
		if (!class_exists('Creditcard')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'creditcard.php');
		}
		$html = '';
		$cc_valid = true;
		$errormessages = array();

		$cc_type = $this->customerData->getVar('cc_type');
		$cc_number = $this->customerData->getVar('cc_number');
		$cc_name = $this->customerData->getVar('cc_name');
		$cc_cvv = $this->customerData->getVar('cc_cvv');
		$cc_expire_month = $this->customerData->getVar('cc_expire_month');
		$cc_expire_year = $this->customerData->getVar('cc_expire_year');

		if (!Creditcard::validate_credit_card_number($cc_type, $cc_number)) {
			$errormessages[] = 'VMPAYMENT_REALEX_CC_CARD_NUMBER_INVALID';
			$cc_valid = false;
		}

		if (!Creditcard::validate_credit_card_cvv($cc_type, $cc_cvv, true)) {
			$errormessages[] = 'VMPAYMENT_REALEX_CC_CARD_CVV_INVALID';
			$cc_valid = false;
		}
		if (!Creditcard::validate_credit_card_date($cc_type, $cc_expire_month, $cc_expire_year)) {
			$errormessages[] = 'VMPAYMENT_REALEX_CC_CARD_DATE_INVALID';
			$cc_valid = false;
		}
		if (empty($cc_name)) {
			$errormessages[] = 'VMPAYMENT_REALEX_CC_NAME_INVALID';
			$cc_valid = false;
		}
		if (!$cc_valid) {
			foreach ($errormessages as $msg) {
				$html .= Jtext::_($msg) . "<br/>";
			}
		}
		if (!$cc_valid) {
			$app = JFactory::getApplication();
			$app->enqueueMessage($html, 'error');
			return false;
		}
		return true;


	}

	function useSSL () {
		return false;
	}

}