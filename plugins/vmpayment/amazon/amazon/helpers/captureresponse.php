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

class amazonHelperCaptureResponse extends amazonHelper {

	public function __construct (OffAmazonPaymentsService_Model_CaptureResponse $captureResponse,$method) {
		parent::__construct($captureResponse,$method);

	}
	public function onResponseUpdateOrderHistory($order) {

	}
	function getStoreInternalData () {
		$amazonInternalData = new stdClass();
		if ($this->amazonData->isSetCaptureResult()) {
			$captureResult = $this->amazonData->getCaptureResult();
			if ($captureResult->isSetCaptureDetails()) {
				$captureDetails = $captureResult->getCaptureDetails();
				if ($captureDetails->isSetAmazonCaptureId()) {
					$amazonInternalData->amazon_response_amazonCaptureId = $captureDetails->getAmazonCaptureId();
				}
				if ($captureDetails->isSetCaptureReferenceId()) {
					$amazonInternalData->amazon_response_captureReferenceId = $captureDetails->getCaptureReferenceId();
				}
				if ($captureDetails->isSetCaptureStatus()) {
					$captureStatus = $captureDetails->getCaptureStatus();
					if ($captureStatus->isSetState()) {
						$amazonInternalData->amazon_response_state = $captureStatus->getState();
					}

					if ($captureStatus->isSetReasonCode()) {
						$amazonInternalData->amazon_response_reasonCode = $captureStatus->getReasonCode();
					}
					if ($captureStatus->isSetReasonDescription()) {
						$amazonInternalData->amazon_response_reasonDescription = $captureStatus->getReasonDescription();
					}

				}
				return $amazonInternalData;
			}


		}
		return NULL;
	}
	function getContents () {
		$contents = "";
		$contents .= "<br />Service Response";
		$contents .= "<br />=============================================================================";

		$contents .= "<br />\tCaptureResponse";
		if ($this->amazonData->isSetCaptureResult()) {
			$contents .= "<br />\t\tCaptureResult";
			$captureResult = $this->amazonData->getCaptureResult();
			if ($captureResult->isSetCaptureDetails()) {
				$contents .= "<br />\t\t\tCaptureDetails";
				$captureDetails = $captureResult->getCaptureDetails();
				if ($captureDetails->isSetAmazonCaptureId()) {
					$contents .= "<br />\t\t\t\tAmazonCaptureId: " . $captureDetails->getAmazonCaptureId();
				}
				if ($captureDetails->isSetCaptureReferenceId()) {
					$contents .= "<br />\t\t\t\tCaptureReferenceId: " . $captureDetails->getCaptureReferenceId();
				}
				if ($captureDetails->isSetSellerCaptureNote()) {
					$contents .= "<br />\t\t\t\tSellerCaptureNote: " . $captureDetails->getSellerCaptureNote();
				}
				if ($captureDetails->isSetCaptureAmount()) {
					$contents .= "<br />\t\t\t\tCaptureAmount";
					$captureAmount = $captureDetails->getCaptureAmount();
					if ($captureAmount->isSetAmount()) {
						$contents .= "<br />\t\t\t\t\tAmount: " . $captureAmount->getAmount();
					}
					if ($captureAmount->isSetCurrencyCode()) {
						$contents .= "<br />\t\t\t\t\tCurrencyCode: " . $captureAmount->getCurrencyCode();
					}
				}
				if ($captureDetails->isSetRefundedAmount()) {
					$contents .= "<br />\t\t\t\tRefundedAmount";
					$refundedAmount = $captureDetails->getRefundedAmount();
					if ($refundedAmount->isSetAmount()) {
						$contents .= "<br />\t\t\t\t\tAmount: " . $refundedAmount->getAmount();
					}
					if ($refundedAmount->isSetCurrencyCode()) {
						$contents .= "<br />\t\t\t\t\tCurrencyCode: " . $refundedAmount->getCurrencyCode();
					}
				}
				if ($captureDetails->isSetCaptureFee()) {
					$contents .= "<br />\t\t\t\tCaptureFee";
					$captureFee = $captureDetails->getCaptureFee();
					if ($captureFee->isSetAmount()) {
						$contents .= "<br />\t\t\t\t\tAmount: " . $captureFee->getAmount();
					}
					if ($captureFee->isSetCurrencyCode()) {
						$contents .= "<br />\t\t\t\t\tCurrencyCode: " . $captureFee->getCurrencyCode();
					}
				}
				if ($captureDetails->isSetIdList()) {
					$contents .= "<br />\t\t\t\tIdList";
					$idList = $captureDetails->getIdList();
					$memberList = $idList->getmember();
					foreach ($memberList as $member) {
						$contents .= "<br />\t\t\t\t\tmember: " . $member;
					}
				}
				if ($captureDetails->isSetCreationTimestamp()) {
					$contents .= "<br />\t\t\t\tCreationTimestamp: " . $captureDetails->getCreationTimestamp();
				}
				if ($captureDetails->isSetCaptureStatus()) {
					$contents .= "<br />\t\t\t\tCaptureStatus";
					$captureStatus = $captureDetails->getCaptureStatus();
					if ($captureStatus->isSetState()) {
						$contents .= "<br />\t\t\t\t\tState: " . $captureStatus->getState();
					}
					if ($captureStatus->isSetLastUpdateTimestamp()) {
						$contents .= "<br />\t\t\t\t\tLastUpdateTimestamp: " . $captureStatus->getLastUpdateTimestamp();
					}
					if ($captureStatus->isSetReasonCode()) {
						$contents .= "<br />\t\t\t\t\tReasonCode: " . $captureStatus->getReasonCode();
					}
					if ($captureStatus->isSetReasonDescription()) {
						$contents .= "<br />\t\t\t\t\tReasonDescription: " . $captureStatus->getReasonDescription();
					}
					if ($captureDetails->isSetSoftDescriptor()) {
						$contents .= "<br />\t\t\t\t\tSoftDescriptor: " . $captureDetails->getSoftDescriptor();
					}
				}
			}
		}
		if ($this->amazonData->isSetResponseMetadata()) {
			$contents .= "<br />\t\tResponseMetadata";
			$responseMetadata = $this->amazonData->getResponseMetadata();
			if ($responseMetadata->isSetRequestId()) {
				$contents .= "<br />\t\t\tRequestId: " . $responseMetadata->getRequestId();
			}
		}

		$contents .= "<br />\t\tResponseHeaderMetadata: " . $this->amazonData->getResponseHeaderMetadata();
		return $contents;
	}


}