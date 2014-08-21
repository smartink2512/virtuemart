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

	public function __construct (OffAmazonPaymentsService_Model_AuthorizeResponse $authorizationResponse) {
		parent::__construct($authorizationResponse);
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
		$contents .= "Service Response" . "\n";
		$contents .= "=============================================================================" . "\n";

		$contents .= "        AuthorizeResponse" . "\n";
		if ($this->amazonData->isSetAuthorizeResult()) {
			$contents .= "            AuthorizeResult" . "\n";
			$authorizeResult = $this->amazonData->getAuthorizeResult();
			if ($authorizeResult->isSetAuthorizationDetails()) {
				$contents .= "                AuthorizationDetails" . "\n";
				$authorizationDetails = $authorizeResult->getAuthorizationDetails();
				if ($authorizationDetails->isSetAmazonAuthorizationId()) {
					$contents .= "                    AmazonAuthorizationId: ".$authorizationDetails->getAmazonAuthorizationId() . "\n";
				}
				if ($authorizationDetails->isSetAuthorizationReferenceId()) {
					$contents .= "                    AuthorizationReferenceId: ".$authorizationDetails->getAuthorizationReferenceId() . "\n";
				}
				if ($authorizationDetails->isSetAuthorizationBillingAddress()) {
					$contents .= "                    AuthorizationBillingAddress" . "\n";
					$authorizationBillingAddress = $authorizationDetails->getAuthorizationBillingAddress();
					if ($authorizationBillingAddress->isSetName()) {
						$contents .= "                            Name: ". $authorizationBillingAddress->getName() . "\n";
					}
					if ($authorizationBillingAddress->isSetAddressLine1()) {
						$contents .= "                            AddressLine1: ".$authorizationBillingAddress->getAddressLine1() . "\n";
					}
					if ($authorizationBillingAddress->isSetAddressLine2()) {
						$contents .= "                            AddressLine2: ".$authorizationBillingAddress->getAddressLine2() . "\n";
					}
					if ($authorizationBillingAddress->isSetAddressLine3()) {
						$contents .= "                            AddressLine3: ". $authorizationBillingAddress->getAddressLine3() . "\n";
					}
					if ($authorizationBillingAddress->isSetCity()) {
						$contents .= "                            City: ".$authorizationBillingAddress->getCity() . "\n";
					}
					if ($authorizationBillingAddress->isSetCounty()) {
						$contents .= "                            County: ". $authorizationBillingAddress->getCounty() . "\n";
					}
					if ($authorizationBillingAddress->isSetDistrict()) {
						$contents .= "                            District: ". $authorizationBillingAddress->getDistrict() . "\n";
					}
					if ($authorizationBillingAddress->isSetStateOrRegion()) {
						$contents .= "                            StateOrRegion: ". $authorizationBillingAddress->getStateOrRegion() . "\n";
					}
					if ($authorizationBillingAddress->isSetPostalCode()) {
						$contents .= "                            PostalCode: ". $authorizationBillingAddress->getPostalCode() . "\n";
					}
					if ($authorizationBillingAddress->isSetCountryCode()) {
						$contents .= "                            CountryCode: ". $authorizationBillingAddress->getCountryCode() . "\n";
					}
					if ($authorizationBillingAddress->isSetPhone()) {
						$contents .= "                            Phone: ". $authorizationBillingAddress->getPhone() . "\n";
					}
				}
				if ($authorizationDetails->isSetSellerAuthorizationNote()) {
					$contents .= "                    SellerAuthorizationNote" . "\n";
					$contents .= "                        " . $authorizationDetails->getSellerAuthorizationNote() . "\n";
				}
				if ($authorizationDetails->isSetAuthorizationAmount()) {
					$contents .= "                    AuthorizationAmount" . "\n";
					$authorizationAmount = $authorizationDetails->getAuthorizationAmount();
					if ($authorizationAmount->isSetAmount()) {
						$contents .= "                        Amount: ".$authorizationAmount->getAmount() . "\n";
					}
					if ($authorizationAmount->isSetCurrencyCode()) {
						$contents .= "                        CurrencyCode: ".$authorizationAmount->getCurrencyCode() . "\n";
					}
				}
				if ($authorizationDetails->isSetCapturedAmount()) {
					$contents .= "                    CapturedAmount" . "\n";
					$capturedAmount = $authorizationDetails->getCapturedAmount();
					if ($capturedAmount->isSetAmount()) {
						$contents .= "                        Amount" . "\n";
						$contents .= "                            " . $capturedAmount->getAmount() . "\n";
					}
					if ($capturedAmount->isSetCurrencyCode()) {
						$contents .= "                        CurrencyCode" . "\n";
						$contents .= "                            " . $capturedAmount->getCurrencyCode() . "\n";
					}
				}
				if ($authorizationDetails->isSetAuthorizationFee()) {
					$contents .= "                    AuthorizationFee" . "\n";
					$authorizationFee = $authorizationDetails->getAuthorizationFee();
					if ($authorizationFee->isSetAmount()) {
						$contents .= "                        Amount: ".$authorizationFee->getAmount() . "\n";
					}
					if ($authorizationFee->isSetCurrencyCode()) {
						$contents .= "                        CurrencyCode: ". $authorizationFee->getCurrencyCode() . "\n";
					}
				}
				if ($authorizationDetails->isSetIdList()) {
					$contents .= "                    IdList" . "\n";
					$idList = $authorizationDetails->getIdList();
					$memberList = $idList->getmember();
					foreach ($memberList as $member) {
						$contents .= "                        member: ". $member;
					}
				}
				if ($authorizationDetails->isSetCreationTimestamp()) {
					$contents .= "                    CreationTimestamp" . "\n";
					$contents .= "                        " . $authorizationDetails->getCreationTimestamp() . "\n";
				}
				if ($authorizationDetails->isSetExpirationTimestamp()) {
					$contents .= "                    ExpirationTimestamp" . "\n";
					$contents .= "                        " . $authorizationDetails->getExpirationTimestamp() . "\n";
				}
				if ($authorizationDetails->isSetAuthorizationStatus()) {
					$contents .= "                    AuthorizationStatus" . "\n";
					$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
					if ($authorizationStatus->isSetState()) {
						$contents .= "                        State: ". $authorizationStatus->getState() . "\n";
					}
					if ($authorizationStatus->isSetLastUpdateTimestamp()) {
						$contents .= "                        LastUpdateTimestamp: ".$authorizationStatus->getLastUpdateTimestamp() . "\n";
					}
					if ($authorizationStatus->isSetReasonCode()) {
						$contents .= "                        ReasonCode: ".$authorizationStatus->getReasonCode() . "\n";
					}
					if ($authorizationStatus->isSetReasonDescription()) {
						$contents .= "                        ReasonDescription: ".$authorizationStatus->getReasonDescription() . "\n";
					}
				}
				if ($authorizationDetails->isSetOrderItemCategories()) {
					$contents .= "                    OrderItemCategories" . "\n";
					$orderItemCategories = $authorizationDetails->getOrderItemCategories();
					$orderItemCategoryList = $orderItemCategories->getOrderItemCategory();
					foreach ($orderItemCategoryList as $orderItemCategory) {
						$contents .= "                        OrderItemCategory" . "\n";
						$contents .= "                            " . $orderItemCategory;
					}
				}
				if ($authorizationDetails->isSetCaptureNow()) {
					$contents .= "                    CaptureNow: ".$authorizationDetails->getCaptureNow() . "\n";
				}
				if ($authorizationDetails->isSetSoftDescriptor()) {
					$contents .= "                    SoftDescriptor: ".$authorizationDetails->getSoftDescriptor() . "\n";
				}
				if ($authorizationDetails->isSetAddressVerificationCode()) {
					$contents .= "                    AddressVerificationCode: ".$authorizationDetails->getAddressVerificationCode() . "\n";
				}
			}
		}
		if ($this->amazonData->isSetResponseMetadata()) {
			$contents .= "            ResponseMetadata" . "\n";
			$responseMetadata = $this->amazonData->getResponseMetadata();
			if ($responseMetadata->isSetRequestId()) {
				$contents .= "                RequestId: ". $responseMetadata->getRequestId() . "\n";
			}
		}

		$contents .= "            ResponseHeaderMetadata: " . $this->amazonData->getResponseHeaderMetadata() . "\n";

		return $contents;
	}


}