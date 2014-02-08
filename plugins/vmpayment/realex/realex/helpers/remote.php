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

	const ECI_VISA_AUTHENTICATED = 5;
	const ECI_VISA_LIABILITY_SHIFT = 6;
	const ECI_VISA_NO_LIABILITY_SHIFT = 7;


	const ENROLLED_RESULT_ENROLLED = '00';
	const ENROLLED_RESULT_NOT_ENROLLED = '110';
	const ENROLLED_RESULT_INVALID_RESPONSE = '5xx';
	const ENROLLED_RESULT_FATAL_ERROR = '220';


	const ENROLLED_TAG_ENROLLED = 'Y';
	const ENROLLED_TAG_UNABLE_TO_VERIFY = 'U';
	const ENROLLED_TAG_NOT_ENROLLED = 'N';


	const VERIFY_SIGNATURE_STATUS_AUTHENTICATED       = 'Y';
	const VERIFY_SIGNATURE_STATUS_NOT_AUTHENTICATED   = 'N';
	const VERIFY_SIGNATURE_STATUS_ACKNOWLEDGED        = 'A';
	const VERIFY_SIGNATURE_STATUS_UNAVAILABLE         = 'U';


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

	function request3DSecure () {

		$response = $this->request3DSVerifyEnrolled();

		return $response;

	}

	function isCC3DSVerifyEnrolled () {
		$CC3DSVerifyEnrolled = array('VISA', 'MC', 'SWITCH');
		return in_array($this->customerData->_remote_cc_type, $CC3DSVerifyEnrolled);
	}

	function redirect3dsRequest ($xml_response) {
		// Merchant Data. Any data that you would like echoed back to you by the ACS.
		// Useful data here is your order id and the card details (so that you can send the authorisation message on receipt of a positive authentication).
		// Any information in this field must be encrypted then compressed and base64 encoded.
		$md = $this->getSha1Hash($this->_method->shared_secret, $this->_method->merchant_id, $this->order['details']['BT']->order_number, $this->getTotalInPaymentCurrency(), $this->getPaymentCurrency(), $this->customerData->_remote_cc_number);
		$md_base64 = base64_encode($md);

		// The URL that the ACS should reply to. This should be on your website and must be an HTTPS address.
		$url_validation = JURI::root() . 'index.php?option=com_virtuemart&view=pluginresponse&task=pluginresponsereceived&verify3D=1&on=' . $this->order['details']['BT']->order_number . '&pm=' . $this->order['details']['BT']->virtuemart_paymentmethod_id . '&Itemid=' . JRequest::getInt('Itemid') . '&lang=' . JRequest::getCmd('lang', '');

		$this->display3dsForm((string)$xml_response->url, (string)$xml_response->pareq, $md_base64, $url_validation);
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
	public function display3dsForm ($url_redirect, $pareq, $md_base64, $url_validation) {
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
			<INPUT TYPE="hidden" NAME="MD" VALUE="<?php echo $md_base64 ?>">
			<NOSCRIPT><INPUT TYPE="submit"></NOSCRIPT>
		</FORM>
		</BODY>
		</HTML>
		<?php
		exit;
	}

	function request3DSVerifyEnrolled () {
		$timestamp = $this->getTimestamp();
		$xml_request = $this->setHeader($timestamp, self::REQUEST_TYPE_3DS_VERIFYENROLLED);
		$xml_request .= '<card>
				<number>' . $this->customerData->_remote_cc_number . '</number>
				<expdate>' . $this->getExpiryDate() . '</expdate>
				<chname>' . $this->customerData->_remote_cc_name . '</chname>
				<type>' . $this->customerData->_remote_cc_type . '</type>
				</card>
				';
		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, $this->getTotalInPaymentCurrency(), $this->getPaymentCurrency(), $this->customerData->_remote_cc_number);
		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);
		return $response;
	}

	/**
	 * @param $xml_response
	 * @return bool|mixed
	 */


	public function getEciFrom3DSVerifyEnrolled($xml_response)
	{

		if ( !$this->isCC3DSVerifyEnrolled()) {
			return false;
		}

		// default liability shift to false, to be proven otherwise
		$liabilityShift = false;
$result=(string)$xml_response->result;

		if (substr($result, 0, 1) == '5') {
			$result = '5xx';
		}


		switch ($result) {
			case self::ENROLLED_RESULT_ENROLLED:
				$liabilityShift = true;
				break;

			case self::ENROLLED_RESULT_NOT_ENROLLED:
				if($xml_response->enrolled==self::ENROLLED_TAG_NOT_ENROLLED) {
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
		if (!$liabilityShift && $this->_method->require_liability) {

			vmInfo('VMPAYMENT_REALEX_NOT_PROCESS_TRANSACTION_LIABILITY');
			return NULL;
		}

		// determine the eci value to use if the card is not enrolled in the 3D Secure scheme
		$eci = false;
		if ($xml_response->enrolled != self::ENROLLED_TAG_ENROLLED) {
			$eci = $this->getEciValue( $liabilityShift);
		}

		return $eci;
	}

	/**
	 * Retrieve the ECI value for the provided card type, liability and 3D Secure result.
	 *
	 */
	public function getEciValue(  $liabilityShift)
	{
		$eci = false;

		if ($this->customerData->_remote_cc_type== 'VISA') {
					if ($liabilityShift === true) {
						$eci = self::ECI_VISA_LIABILITY_SHIFT;
					} else {
						$eci = self::ECI_VISA_NO_LIABILITY_SHIFT;
					}
		} else {
			$eci = false;
		}

		return $eci;
	}


	function getExtraPluginInfo () {

		$extraPluginInfo = array();
		if ($this->_method->virtuemart_paymentmethod_id == $this->customerData->_selected_paymentmethod) {
			$extraPluginInfo['cc_type'] = $this->customerData->_remote_cc_type;
			$extraPluginInfo['cc_number'] = $this->customerData->_remote_cc_number;
			$extraPluginInfo['cc_name'] = $this->customerData->_remote_cc_name;
			$extraPluginInfo['cc_valid'] = $this->customerData->_remote_cc_valid;
			$extraPluginInfo['cc_expire_month'] = $this->customerData->_remote_cc_expire_month;
			$extraPluginInfo['cc_expire_year'] = $this->customerData->_remote_cc_expire_year;
			$extraPluginInfo['cc_cvv'] = $this->customerData->_remote_cc_cvv;
			$extraPluginInfo['remote_save_card'] = $this->customerData->_remote_save_card;

			$extraPluginInfo['from_realvault'] = false;
			$extraPluginInfo['dcc'] = false;
		}
		return $extraPluginInfo;


	}

	/**
	 * @return bool|mixed
	 */
function setNewPayer(&$newPayerRef) {
	$timestamp = $this->getTimestamp();
	$xml_request = '<request timestamp="' . $timestamp . '" type="' . self::REQUEST_TYPE_PAYER_NEW . '">
						<merchantid>' . $this->_method->merchant_id . '</merchantid>
						 <account>' . $this->_method->subaccount . '</account>
						 <orderid>' . $this->order['details']['BT']->order_number . '</orderid>';



	$BT = $this->order['details']['BT'];
	$ST = ((isset($this->order['details']['ST'])) ? $this->order['details']['ST'] : $this->order['details']['BT']);
	$newPayerRef=  $this->getUniqueId($BT->customer_number);
	$xml_request .= '<payer type="Business" ref="' . $newPayerRef. '">
				<firstname>' . $BT->first_name. '</firstname>
				<surname>' . $BT->last_name. '</surname>
				';
	if (!empty($BT->company)) {
		$xml_request .= '<company>' . $BT->company. '</company>
		';
	}


	$xml_request .='<address>
				<line1>' . $BT->address_1. '</line1>
				<line2 >' . $BT->address_2 . '</line2>
				<line3 />
				<city>' . $BT->city. '</city>
				<county>' . ShopFunctions::getCountryByID($BT->virtuemart_country_id, 'country_2_code') . '</county>
				<postcode>' . $this->stripnonnumeric($BT->zip) . '</postcode>
				<country code="' . ShopFunctions::getCountryByID($BT->virtuemart_country_id, 'country_2_code') . '"> ' . ShopFunctions::getCountryByID($BT->virtuemart_country_id, 'country_name') . ' </country>
				</address>
				<phonenumbers>
				<home />
				<work>' . $BT->phone_1 . '</work>
				<fax />
				<mobile>' . $BT->phone_2 . '</mobile>
				</phonenumbers>
				<email>' . $BT->email. '</email>
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

	/**
	 * @return bool|mixed
	 */
	function setNewPayment($newPayerRef, &$newPaymentRef) {
		$timestamp = $this->getTimestamp();
		$xml_request = '<request timestamp="' . $timestamp . '" type="' . self::REQUEST_TYPE_CARD_NEW . '">
						<merchantid>' . $this->_method->merchant_id . '</merchantid>
						 <account>' . $this->_method->subaccount . '</account>
						 <orderid>' . $this->order['details']['BT']->order_number . '</orderid>';
		$newPaymentRef=  $this->getUniqueId($this->order['details']['BT']->order_number) ;
		$xml_request .= '<card>
		 <ref>' . $newPaymentRef . '</ref>
		<payerref>' . $newPayerRef . '</payerref>
		<number>' . $this->customerData->_remote_cc_number . '</number>
		<expdate>' . $this->getExpiryDate() . '</expdate>
		<chname>' . $this->customerData->_remote_cc_name . '</chname>
		<type>' . $this->customerData->_remote_cc_type . '</type>
		<issueno />
		</card>
		';
		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, '', '', $newPayerRef,$this->customerData->_remote_cc_name,$this->customerData->_remote_cc_number);
		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);
		return $response;

	}

	function getUniqueId($value) {
		return $value.'-' . time();
	}
	function request3dsVerifysig () {
		$realex_data = JRequest::get('post');
		$paRes = JRequest::getVar('PaRes', '');
		if (empty($paRes)) {
			// TODO
		}
		$paRes = $realex_data['PaRes'];
		$timestamp = $this->getTimestamp();
		$xml_request = $this->setHeader($timestamp, self::REQUEST_TYPE_3DS_VERIFYSIG);
		$xml_request .= '<card>
				<number>' . $this->customerData->_remote_cc_number . '</number>
				<expdate>' . $this->getExpiryDate() . '</expdate>
				<chname>' . $this->customerData->_remote_cc_name . '</chname>
				<type>' . $this->customerData->_remote_cc_type . '</type>
				</card>
				';
		$xml_request .= '<pares>' . $paRes . '</pares>
		';


		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, $this->getTotalInPaymentCurrency(), $this->getPaymentCurrency(), $this->customerData->_remote_cc_number);
		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);
		return $response;
	}

	function manage3dsVerifysig ($response3D) {
		$BT = $this->order['details']['BT'];
		$xml_response3D = simplexml_load_string($response3D);
		$result = (string)$xml_response3D->result;
		$success = ($result == '00');

		if (!$success) {
			$error = $xml_response3D->message . " (" . (string)$xml_response3D->result . ")";
			$this->displayError($error);
			$app = JFactory::getApplication();
			$app->redirect(JRoute::_('index.php?option=com_virtuemart&view=cart&Itemid=' . JRequest::getInt('Itemid'), false), vmText::_('VMPAYMENT_REALEX_ERROR_TRY_AGAIN'));
		}
		if ($xml_response3D->threedsecure->status==self::VERIFY_SIGNATURE_STATUS_AUTHENTICATED) {
			$response = $this->requestAuth($xml_response3D);
		}

		return $response;
	}


	function requestAuth ($xml_response_dcc=NULL,$xml_3Dresponse = NULL) {

		$timestamp = $this->getTimestamp();
		$xml_request = $this->setHeader($timestamp, self::REQUEST_TYPE_AUTH);
		$xml_request .= '<card>
				<number>' . $this->customerData->_remote_cc_number . '</number>
				<expdate>' . $this->getExpiryDate() . '</expdate>
				<chname>' . $this->customerData->_remote_cc_name . '</chname>
				<type>' . $this->customerData->_remote_cc_type . '</type>
				<issueno></issueno>
				<cvn>
				<number>' . $this->customerData->_remote_cc_cvv . '</number>
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
		if (!empty($xml_3Dresponse->threedsecure) AND isset($xml_3Dresponse->threedsecure)) {
			$xml_request .= '<mpi>
				 <eci>' . $xml_3Dresponse->threedsecure->eci . '</eci>
				  <cavv>' . $xml_3Dresponse->threedsecure->cavv . '</cavv>
				  <xid>' . $xml_3Dresponse->threedsecure->xid . '</xid>
				 </mpi>
				 ';
		}

		if ($this->_method->dcc  ) {
			$dcc_choice=JRequest::getInt('dcc_choice',0);
			if ($dcc_choice) {
				$rate=$xml_response_dcc->dccinfo->cardholderrate;
				$currency=$xml_response_dcc->dccinfo->cardholdercurrency;
				$amount=$xml_response_dcc->dccinfo->cardholderamount;
			} else {
				$rate=1;
				$currency=$xml_response_dcc->dccinfo->merchantcurrency;
				$amount=$xml_response_dcc->dccinfo->merchantamount;
			}
				$xml_request .= '<dccinfo>
						<ccp>' .  $this->_method->dcc_service . '</ccp>
						<type>1</type>
						<rate>' . $rate . '</rate>
						<ratetype>S</ratetype>
						<amount currency="' . $currency . '">' . $amount . '</amount>
						</dccinfo>
				';
		}
		$xml_request .= $this->setComments();
		$xml_request .= $this->setTssInfo();

		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, $this->getTotalInPaymentCurrency(), $this->getPaymentCurrency(), $this->customerData->_remote_cc_number);
		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '<md5hash></md5hash>';
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);

		return $response;
	}
	public function requestDccrate (  $realvault=false) {

		$request_type = ($realvault) ? self::REQUEST_TYPE_REALVAULT_DCCRATE : self::REQUEST_TYPE_DCCRATE;
		$timestamp = $this->getTimestamp();
		$xml_request = $this->setHeader($timestamp, $request_type);

		if ($realvault) {
			$xml_request .= '<payerref>' . $xml_request->payerref . '</payerref>
			<paymentmethod>' . $xml_request->pmtref . '</paymentmethod>';
		} else {
			$xml_request .= '<card>';
			$xml_request .= '<number>' . $this->customerData->_remote_cc_number . '</number>';
			$xml_request .= '<expdate>' .$this->getExpiryDate() . '</expdate>';
			$xml_request .= '<chname>' . $this->customerData->_remote_cc_name . '</chname>';
			$xml_request .= '<type>' . $this->customerData->_remote_cc_type . '</type>';
			$xml_request .= '</card>';
		}
		$xml_request .= '<dccinfo>
			<ccp>' . $this->_method->dcc_service . '</ccp>
			<type>1</type>
		</dccinfo>';


		$xml_request .= $this->setComments();
		$sha1 = $this->getSha1Hash($this->_method->shared_secret, $timestamp, $this->_method->merchant_id, $this->order['details']['BT']->order_number, $this->getTotalInPaymentCurrency(), $this->getPaymentCurrency(), $this->customerData->_remote_cc_number);

		$xml_request .= $this->setSha1($sha1);
		$xml_request .= '<md5hash></md5hash>';
		$xml_request .= '</request>';
		$response = $this->getXmlResponse($xml_request);

		return $response;
	}


	function displayExtraPluginInfo() {
		$extraInfo = '';
		//if ($this->customerData->getVar('cc_number') && $this->validate()) {
		if ($this->customerData->getVar('cc_number') ) {
			$cc_number = "**** **** **** " . substr($this->customerData->getVar('cc_number'), -4);
			$creditCardInfos = '<br /><span class="vmpayment_cardinfo">' . JText::_('VMPAYMENT_REALEX_CC_CCTYPE') . $this->customerData->getVar('cc_type') . '<br />';
			$creditCardInfos .=JText::_('VMPAYMENT_REALEX_CC_CCNUM') . $cc_number . '<br />';
			$creditCardInfos .= JText::_('VMPAYMENT_REALEX_CC_CVV2') . '****' . '<br />';
			$creditCardInfos .= JText::_('VMPAYMENT_REALEX_CC_EXDATE') . $this->customerData->getVar('cc_expire_month') . '/' . $this->customerData->getVar('cc_expire_year');
			$creditCardInfos .="</span>";
			$extraInfo .= $creditCardInfos;
		} else {
			$extraInfo .= '<br/><a href="'.JRoute::_('index.php?option=com_virtuemart&view=cart&task=editpayment&Itemid=' . JRequest::getInt('Itemid'), false).'">'.JText::_('VMPAYMENT_REALEX_CC_ENTER_INFO').'</a>';
		}
		$extraInfo .= parent::getExtraPluginInfo();
		return $extraInfo;
	}


	function validate ($enqueueMessage = true) {

		if (!class_exists('Creditcard')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'creditcard.php');
		}
		$html = '';
		$cc_valid = true;
		$errormessages = array();

		if (!Creditcard::validate_credit_card_number($this->customerData->_remote_cc_type, $this->customerData->_remote_cc_number)) {
			$errormessages[] = 'VMPAYMENT_REALEX_CC_CARD_NUMBER_INVALID';
			$cc_valid = false;
		}


		if (!Creditcard::validate_credit_card_cvv($this->customerData->_remote_cc_type, $this->customerData->_remote_cc_cvv, true)) {
			$errormessages[] = 'VMPAYMENT_REALEX_CC_CARD_CVV_INVALID';
			$cc_valid = false;
		}
		if (!Creditcard::validate_credit_card_date($this->customerData->_remote_cc_type, $this->customerData->_remote_cc_expire_month, $this->customerData->_remote_cc_expire_year)) {
			$errormessages[] = 'VMPAYMENT_REALEX_CC_CARD_DATE_INVALID';
			$cc_valid = false;
		}
		if (!$cc_valid) {
			foreach ($errormessages as $msg) {
				$html .= Jtext::_($msg) . "<br/>";
			}
		}
		if (!$cc_valid && $enqueueMessage) {
			vmError($html, $html);
		}
		$displayInfoMsg = "";
		if (!$cc_valid) {
			$displayInfoMsg = false;
			return false;
		} else {
			return parent::validate($displayInfoMsg);
		}
	}

	function getExpiryDate () {
		return $this->customerData->_remote_cc_expire_month . substr($this->customerData->_remote_cc_expire_year, -2);
	}


}