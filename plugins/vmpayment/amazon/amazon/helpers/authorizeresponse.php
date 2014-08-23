<?php

defined('_JEXEC') or die('Direct Access to ' . basename(__FILE__) . 'is not allowed.');

/**
 *
 * @package    VirtueMart
 * @subpackage vmpayment
 * @version $Id$
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - ${PHING.VM.RELDATE} VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 *
 */

class amazonHelperAuthorizeResponse extends amazonHelper {

	public function __construct (OffAmazonPaymentsService_Model_AuthorizeResponse $authorizationResponse, $plugin) {
		parent::__construct($authorizationResponse, $plugin);
	}

	/**
	 * if asynchronous mode= state= pending
	 * if asynchronous mode=> timeOut was set to > 0
	 * if synchronous mode=> timeOut ==0
	 * -- if InvalidPaymentMethod and asynchronous mode, the state= suspended ==> send an email
	 * -- if InvalidPaymentMethod and synchronous mode: return to cart, redisplay wallet widget
	 * -- AmazonRejected: if state == open, then retry authorization, else Declined
	 * -- Processing failure: retry the request in 2 minutes ???
	 * --
	 * @return mixed
	 */


	public function onResponseUpdateOrderHistory ($order) {

		$order_history = array();
		$amazonState = "";
		$reasonCode = "";
		$authorizeResponse = $this->amazonData;
		$authorization_mode = ($this->plugin->getAuthorizationTransactionTimeout() == 0) ? 'synchronous' : 'asynchronous';
		$authorizeResult = $authorizeResponse->getAuthorizeResult();
		$authorizationDetails = $authorizeResult->getAuthorizationDetails();
		if ($authorizationDetails->isSetAuthorizationStatus()) {
			$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
			if (!$authorizationStatus->isSetState()) {
				return false;
			}
				$amazonState = $authorizationStatus->getState();

			if ($authorizationStatus->isSetReasonCode()) {
				$reasonCode = $authorizationStatus->getReasonCode();
			}
		}
		if ($authorization_mode == 'asynchronous') {
			if ($amazonState == 'Pending') {
				$order_history['order_status'] = $this->_currentMethod->status_orderconfirmed;
				$order_history['customer_notified'] = 0;
				$order_history['comments'] = vmText::_('VMPAYMENT_AMAZON_COMMENT_STATUS_ORDERCONFIRMED');

			} else {
				// we should only get pending..
				// the final status will be return by the IPN
				$this->debugLog('AYNCHRONOUS MODE AND STATS is not PENDING' . __FUNCTION__ . var_export($authorizeResponse, true), 'error');
				return false;
			}
		} else {
			// SYNCHRONOUS MODE: amazon returns in real time the final process status
			if ($amazonState == 'Open') {
				// it should always be the case if the CaptureNow == false
				$order_history['order_status'] = $this->_currentMethod->status_authorization_synchronous;
				$order_history['comments'] = vmText::_('VMPAYMENT_AMAZON_COMMENT_STATUS_AUTHORIZATION_OPEN');
				$order_history['customer_notified'] = 1;
			} elseif ($amazonState == 'Closed') {
				// it should always be the case if the CaptureNow == true
				if (! ($authorizationDetails->isSetCaptureNow() and $authorizationDetails->getCaptureNow())) {
					$this->debugLog('SYNCHRONOUS , capture Now, and Amazon State is NOT CLOSED' . __FUNCTION__ . var_export($authorizeResponse, true), 'error');
					return false;
				}
					$order_history['order_status'] = $this->_currentMethod->status_capture;
					$order_history['comments'] = vmText::_('VMPAYMENT_AMAZON_COMMENT_STATUS_CAPTURED');
					$order_history['customer_notified'] = 1;

			} elseif ($amazonState == 'Declined') {
				// handling Declined Authorizations
				$order_history['order_status'] = $this->_currentMethod->status_cancel;
				$order_history['comments'] = $reasonCode;
				if ($authorizationStatus->isSetReasonDescription()) {
					$order_history['comments'] .= " " . $authorizationStatus->getReasonDescription();
				}
				$order_history['customer_notified'] = 0;

			}
		}
		$order_history['amazonState'] = $amazonState;
		$modelOrder = VmModel::getModel('orders');
		$modelOrder->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order_history, TRUE);


		return $amazonState;
	}




	public function getStoreInternalData () {
		$amazonInternalData = new stdClass();
		if ($this->amazonData->isSetAuthorizeResult()) {
			$authorizeResult = $this->amazonData->getAuthorizeResult();
			$authorizationDetails = $authorizeResult->getAuthorizationDetails();
			if ($authorizationDetails->isSetAuthorizationStatus()) {
				$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
				if ($authorizationStatus->isSetState()) {
					$amazonInternalData->amazon_response_state = $authorizationStatus->getState();
				}
				if ($authorizationStatus->isSetReasonCode()) {
					$amazonInternalData->amazon_response_reasonCode = $authorizationStatus->getReasonCode();
				}
				if ($authorizationStatus->isSetReasonDescription()) {
					$amazonInternalData->amazon_response_reasonDescription = $authorizationStatus->getReasonDescription();
				}
				if ($authorizationDetails->isSetAmazonAuthorizationId()) {
					$amazonInternalData->amazon_response_amazonAuthorizationId = $authorizationDetails->getAmazonAuthorizationId();
				}
			}
			if ($this->amazonData->isSetResponseMetadata()) {
				$responseMetadata = $this->amazonData->getResponseMetadata();
				if ($responseMetadata->isSetRequestId()) {
					$amazonInternalData->amazon_response_requestId = $responseMetadata->getRequestId();
				}
			}
		}
		return $amazonInternalData;
	}

	function getAmazonAuthorizationId () {

	}

	function getContents () {
		$contents = "";
		$contents .= "<br />Service Response";
		$contents .= "<br />================================";

		$contents .= "<br />         AuthorizeResponse";
		if ($this->amazonData->isSetAuthorizeResult()) {
			$contents .= "<br />             AuthorizeResult";
			$authorizeResult = $this->amazonData->getAuthorizeResult();
			if ($authorizeResult->isSetAuthorizationDetails()) {
				$contents .= "<br />                 AuthorizationDetails";
				$authorizationDetails = $authorizeResult->getAuthorizationDetails();
				if ($authorizationDetails->isSetAmazonAuthorizationId()) {
					$contents .= "<br />AmazonAuthorizationId: " . $authorizationDetails->getAmazonAuthorizationId();
				}
				if ($authorizationDetails->isSetAuthorizationReferenceId()) {
					$contents .= "<br />AuthorizationReferenceId: " . $authorizationDetails->getAuthorizationReferenceId();
				}
				if ($authorizationDetails->isSetAuthorizationBillingAddress()) {
					$contents .= "<br />AuthorizationBillingAddress";
					$authorizationBillingAddress = $authorizationDetails->getAuthorizationBillingAddress();
					if ($authorizationBillingAddress->isSetName()) {
						$contents .= "<br />Name: " . $authorizationBillingAddress->getName();
					}
					if ($authorizationBillingAddress->isSetAddressLine1()) {
						$contents .= "<br />AddressLine1: " . $authorizationBillingAddress->getAddressLine1();
					}
					if ($authorizationBillingAddress->isSetAddressLine2()) {
						$contents .= "<br />AddressLine2: " . $authorizationBillingAddress->getAddressLine2();
					}
					if ($authorizationBillingAddress->isSetAddressLine3()) {
						$contents .= "<br />AddressLine3: " . $authorizationBillingAddress->getAddressLine3();
					}
					if ($authorizationBillingAddress->isSetCity()) {
						$contents .= "<br />City: " . $authorizationBillingAddress->getCity();
					}
					if ($authorizationBillingAddress->isSetCounty()) {
						$contents .= "<br />County: " . $authorizationBillingAddress->getCounty();
					}
					if ($authorizationBillingAddress->isSetDistrict()) {
						$contents .= "<br />District: " . $authorizationBillingAddress->getDistrict();
					}
					if ($authorizationBillingAddress->isSetStateOrRegion()) {
						$contents .= "<br />StateOrRegion: " . $authorizationBillingAddress->getStateOrRegion();
					}
					if ($authorizationBillingAddress->isSetPostalCode()) {
						$contents .= "<br />PostalCode: " . $authorizationBillingAddress->getPostalCode();
					}
					if ($authorizationBillingAddress->isSetCountryCode()) {
						$contents .= "<br />CountryCode: " . $authorizationBillingAddress->getCountryCode();
					}
					if ($authorizationBillingAddress->isSetPhone()) {
						$contents .= "<br />Phone: " . $authorizationBillingAddress->getPhone();
					}
				}
				if ($authorizationDetails->isSetSellerAuthorizationNote()) {
					$contents .= "<br />SellerAuthorizationNote";
					$contents .= "<br />    " . $authorizationDetails->getSellerAuthorizationNote();
				}
				if ($authorizationDetails->isSetAuthorizationAmount()) {
					$contents .= "<br />AuthorizationAmount";
					$authorizationAmount = $authorizationDetails->getAuthorizationAmount();
					if ($authorizationAmount->isSetAmount()) {
						$contents .= "<br />    Amount: " . $authorizationAmount->getAmount();
					}
					if ($authorizationAmount->isSetCurrencyCode()) {
						$contents .= "<br />    CurrencyCode: " . $authorizationAmount->getCurrencyCode();
					}
				}
				if ($authorizationDetails->isSetCapturedAmount()) {
					$contents .= "<br />CapturedAmount";
					$capturedAmount = $authorizationDetails->getCapturedAmount();
					if ($capturedAmount->isSetAmount()) {
						$contents .= "<br />    Amount: " . $capturedAmount->getAmount();
					}
					if ($capturedAmount->isSetCurrencyCode()) {
						$contents .= "<br />    CurrencyCode: " . $capturedAmount->getCurrencyCode();
					}
				}
				if ($authorizationDetails->isSetAuthorizationFee()) {
					$contents .= "<br />AuthorizationFee";
					$authorizationFee = $authorizationDetails->getAuthorizationFee();
					if ($authorizationFee->isSetAmount()) {
						$contents .= "<br />    Amount: " . $authorizationFee->getAmount();
					}
					if ($authorizationFee->isSetCurrencyCode()) {
						$contents .= "<br />    CurrencyCode: " . $authorizationFee->getCurrencyCode();
					}
				}
				if ($authorizationDetails->isSetIdList()) {
					$contents .= "<br />IdList";
					$idList = $authorizationDetails->getIdList();
					$memberList = $idList->getmember();
					foreach ($memberList as $member) {
						$contents .= "<br />    member: " . $member;
					}
				}
				if ($authorizationDetails->isSetCreationTimestamp()) {
					$contents .= "<br />CreationTimestamp: " . $authorizationDetails->getCreationTimestamp();
				}
				if ($authorizationDetails->isSetExpirationTimestamp()) {
					$contents .= "<br />ExpirationTimestamp :" . $authorizationDetails->getExpirationTimestamp();
				}
				if ($authorizationDetails->isSetAuthorizationStatus()) {
					$contents .= "<br />AuthorizationStatus";
					$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
					if ($authorizationStatus->isSetState()) {
						$contents .= "<br />    State: " . $authorizationStatus->getState();
					}
					if ($authorizationStatus->isSetLastUpdateTimestamp()) {
						$contents .= "<br />    LastUpdateTimestamp: " . $authorizationStatus->getLastUpdateTimestamp();
					}
					if ($authorizationStatus->isSetReasonCode()) {
						$contents .= "<br />    ReasonCode: " . $authorizationStatus->getReasonCode();
					}
					if ($authorizationStatus->isSetReasonDescription()) {
						$contents .= "<br />    ReasonDescription: " . $authorizationStatus->getReasonDescription();
					}
				}
				if ($authorizationDetails->isSetOrderItemCategories()) {
					$contents .= "<br />OrderItemCategories";
					$orderItemCategories = $authorizationDetails->getOrderItemCategories();
					$orderItemCategoryList = $orderItemCategories->getOrderItemCategory();
					foreach ($orderItemCategoryList as $orderItemCategory) {
						$contents .= "<br />    OrderItemCategory";
						$contents .= "<br />" . $orderItemCategory;
					}
				}
				if ($authorizationDetails->isSetCaptureNow()) {
					$contents .= "<br />CaptureNow: " . $authorizationDetails->getCaptureNow();
				}
				if ($authorizationDetails->isSetSoftDescriptor()) {
					$contents .= "<br />SoftDescriptor: " . $authorizationDetails->getSoftDescriptor();
				}
				if ($authorizationDetails->isSetAddressVerificationCode()) {
					$contents .= "<br />AddressVerificationCode: " . $authorizationDetails->getAddressVerificationCode();
				}
			}
		}
		if ($this->amazonData->isSetResponseMetadata()) {
			$contents .= "<br />             ResponseMetadata";
			$responseMetadata = $this->amazonData->getResponseMetadata();
			if ($responseMetadata->isSetRequestId()) {
				$contents .= "<br />                 RequestId: " . $responseMetadata->getRequestId();
			}
		}

		$contents .= "<br />             ResponseHeaderMetadata: " . $this->amazonData->getResponseHeaderMetadata();

		return $contents;
	}


}