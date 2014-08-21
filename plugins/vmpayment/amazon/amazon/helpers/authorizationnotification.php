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

class amazonHelperAuthorizationNotification extends amazonHelper {

	public function __construct (OffAmazonPaymentsNotifications_Model_authorizationNotification $authorizationNotification) {
		parent::__construct($authorizationNotification);
	}

	function handleNotification () {
		$authorizationDetails = $this->amazonData->getAuthorizationDetails();
		$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
		$amazonState = $authorizationStatus->getState();
		return $amazonState;
	}

	public function getStoreInternalData () {
		//$amazonInternalData = $this->getStoreResultParams();
		$amazonInternalData = new stdClass();
		if ($this->amazonData->isSetAuthorizationDetails()) {
			$authorizationDetails = $this->amazonData->getAuthorizationDetails();
			if ($authorizationDetails->isSetAmazonAuthorizationId()) {
				$amazonInternalData->amazon_response_amazonAuthorizationId = $authorizationDetails->notification();
			}
			if ($authorizationDetails->isSetAuthorizationStatus()) {
				$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
				if ($authorizationStatus->isSetState()) {
					$amazonInternalData->amazon_response_state = $authorizationStatus->getState();
				}
				if ($authorizationStatus->isSetLastUpdateTimestamp()) {
					$amazonInternalData->amazon_response_reasonCode = $authorizationStatus->getReasonCode();
				}
				if ($authorizationStatus->isSetReasonCode()) {
					$amazonInternalData->amazon_response_reasonCode = $authorizationStatus->getReasonCode();
				}
				if ($authorizationStatus->isSetReasonDescription()) {
					$amazonInternalData->amazon_response_reasonDescription = $authorizationStatus->getReasonDescription();
				}
			}
		}
		return $amazonInternalData;
	}

	public function getContents () {
		$contents = "Authorization Notification";
		$contents .= "\n=============================================================================";
		if ($this->amazonData->isSetAuthorizationDetails()) {
			$contents .= "\n    AuthorizeDetails";
			$authorizationDetails = $this->amazonData->getAuthorizationDetails();
			if ($authorizationDetails->isSetAmazonAuthorizationId()) {
				$contents .= "\n    AmazonAuthorizationId: ".$authorizationDetails->getAmazonAuthorizationId();
			}
			if ($authorizationDetails->isSetAuthorizationReferenceId()) {
				$contents .= "\n      AuthorizationReferenceId: ".$authorizationDetails->getAuthorizationReferenceId();
			}
			if ($authorizationDetails->isSetAuthorizationAmount()) {
				$contents .= "\n      AuthorizationAmount";
				$authorizationAmount = $authorizationDetails->getAuthorizationAmount();
				if ($authorizationAmount->isSetAmount()) {
					$contents .= "\n          Amount: ". $authorizationAmount->getAmount();
				}
				if ($authorizationAmount->isSetCurrencyCode()) {
					$contents .= "\n          CurrencyCode: ".$authorizationAmount->getCurrencyCode();
				}
			}
			if ($authorizationDetails->isSetCapturedAmount()) {
				$contents .= "\n       CapturedAmount";
				$capturedAmount = $authorizationDetails->getCapturedAmount();
				if ($capturedAmount->isSetAmount()) {
					$contents .= "\n          Amount: ". $capturedAmount->getAmount();
				}
				if ($capturedAmount->isSetCurrencyCode()) {
					$contents .= "\n          CurrencyCode: ". $capturedAmount->getCurrencyCode();
				}
			}
			if ($authorizationDetails->isSetAuthorizationFee()) {
				$contents .= "\n      AuthorizationFee";
				$authorizationFee = $authorizationDetails->getAuthorizationFee();
				if ($authorizationFee->isSetAmount()) {
					$contents .= "\n          Amount: ". $authorizationFee->getAmount();
				}
				if ($authorizationFee->isSetCurrencyCode()) {
					$contents .= "\n          CurrencyCode: ". $authorizationFee->getCurrencyCode();
				}
			}
			if ($authorizationDetails->isSetIdList()) {
				$contents .= "\n      IdList";
				$idList = $authorizationDetails->getIdList();
				$memberList = $idList->getId();
				foreach ($memberList as $member) {
					$contents .= "\n          member: ".$member;
				}
			}
			if ($authorizationDetails->isSetCreationTimestamp()) {
				$contents .= "\n      CreationTimestamp: ".$authorizationDetails->getCreationTimestamp();
			}
			if ($authorizationDetails->isSetExpirationTimestamp()) {
				$contents .= "\n      ExpirationTimestamp";
				$contents .= "\n           " . $authorizationDetails->getExpirationTimestamp();
			}
			if ($authorizationDetails->isSetAuthorizationStatus()) {
				$contents .= "\n      AuthorizationStatus";
				$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
				if ($authorizationStatus->isSetState()) {
					$contents .= "\n          State: ". $authorizationStatus->getState();
				}
				if ($authorizationStatus->isSetLastUpdateTimestamp()) {
					$contents .= "\n          LastUpdateTimestamp: ".$authorizationStatus->getLastUpdateTimestamp();
				}
				if ($authorizationStatus->isSetReasonCode()) {
					$contents .= "\n          ReasonCode: ".$authorizationStatus->getReasonCode();
				}
				if ($authorizationStatus->isSetReasonDescription()) {
					$contents .= "\n          ReasonDescription: ". $authorizationStatus->getReasonDescription();
				}
			}
			if ($authorizationDetails->isSetOrderItemCategories()) {
				$contents .= "\n       OrderItemCategories";
				$orderItemCategories = $authorizationDetails->getOrderItemCategories();
				$orderItemCategoryList = $orderItemCategories->getOrderItemCategory();
				foreach ($orderItemCategoryList as $orderItemCategory) {
					$contents .= "\n          OrderItemCategory: ".$orderItemCategory;
				}
			}
			if ($authorizationDetails->isSetCaptureNow()) {
				$contents .= "\n      CaptureNow: ".$authorizationDetails->getCaptureNow();
			}
			if ($authorizationDetails->isSetSoftDescriptor()) {
				$contents .= "\n      SoftDescriptor: ".$authorizationDetails->getSoftDescriptor();
			}
		}
		return $contents;
	}


}