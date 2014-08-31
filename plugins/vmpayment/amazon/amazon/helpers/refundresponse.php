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

class amazonHelperRefundResponse extends amazonHelper {

	public function __construct (OffAmazonPaymentsService_Model_RefundResponse $refundResponse,$method) {
		parent::__construct($refundResponse,$method);

	}
	public function onResponseUpdateOrderHistory($order) {

	}
	function getStoreInternalData () {
		$amazonInternalData = new stdClass();
		if ($this->amazonData->isSetRefundResult()) {
			$refundResult = $this->amazonData->getRefundResult();
			if ($refundResult->isSetRefundDetails()) {
				$refundDetails = $refundResult->getRefundDetails();
				if ($refundDetails->isSetAmazonRefundId()) {
					$amazonInternalData->amazon_response_amazonRefundId = $refundDetails->getAmazonRefundId();
				}

				if ($refundDetails->isSetRefundStatus()) {
					$refundStatus = $refundDetails->getRefundStatus();
					if ($refundStatus->isSetState()) {
						$amazonInternalData->amazon_response_state = $refundStatus->getState();
					}

					if ($refundStatus->isSetReasonCode()) {
						$amazonInternalData->amazon_response_reasonCode = $refundStatus->getReasonCode();
					}
					if ($refundStatus->isSetReasonDescription()) {
						$amazonInternalData->amazon_response_reasonDescription = $refundStatus->getReasonDescription();
					}

				}
				return $amazonInternalData;
			}


		}
		return NULL;
	}



	function getContents () {
		$contents = "";
		$contents .= "Service Response: ". "<br/>";;
		$contents .= "=====================: ". "<br/>";;

		$contents .= "        RefundResponse: " . "<br/>";;
		if ($this->amazonData->isSetRefundResult()) {
			$contents .= "            RefundResult: " . "<br/>";;
			$refundResult = $this->amazonData->getRefundResult();
			if ($refundResult->isSetRefundDetails()) {
				$contents .= "                RefundDetails: " . "<br/>";;
				$refundDetails = $refundResult->getRefundDetails();
				if ($refundDetails->isSetAmazonRefundId()) {
					$contents .= "                    AmazonRefundId: ";
					$contents .= "                        " . $refundDetails->getAmazonRefundId() . "<br/>";;
				}
				if ($refundDetails->isSetRefundReferenceId()) {
					$contents .= "                    RefundReferenceId: ";
					$contents .= "                        " . $refundDetails->getRefundReferenceId() . "<br/>";;
				}
				if ($refundDetails->isSetSellerRefundNote()) {
					$contents .= "                    SellerRefundNote: ";
					$contents .= "                        " . $refundDetails->getSellerRefundNote() . "<br/>";;
				}
				if ($refundDetails->isSetRefundType()) {
					$contents .= "                    RefundType: " ;
					$contents .= "                        " . $refundDetails->getRefundType() . "<br/>";;
				}
				if ($refundDetails->isSetRefundAmount()) {
					$contents .= "                    RefundAmount: " . "<br/>";;
					$refundAmount = $refundDetails->getRefundAmount();
					if ($refundAmount->isSetAmount()) {
						$contents .= "                        Amount: ";
						$contents .= "                            " . $refundAmount->getAmount() . "<br/>";;
					}
					if ($refundAmount->isSetCurrencyCode()) {
						$contents .= "                        CurrencyCode: ";
						$contents .= "                            " . $refundAmount->getCurrencyCode() . "<br/>";;
					}
				}
				if ($refundDetails->isSetFeeRefunded()) {
					$contents .= "                    FeeRefunded:  ". "<br/>";;
					$feeRefunded = $refundDetails->getFeeRefunded();
					if ($feeRefunded->isSetAmount()) {
						$contents .= "                        Amount: ";
						$contents .= "                            " . $feeRefunded->getAmount() . "<br/>";;
					}
					if ($feeRefunded->isSetCurrencyCode()) {
						$contents .= "                        CurrencyCode: ";
						$contents .= "                            " . $feeRefunded->getCurrencyCode() . "<br/>";;
					}
				}
				if ($refundDetails->isSetCreationTimestamp()) {
					$contents .= "                    CreationTimestamp: ";
					$contents .= "                        " . $refundDetails->getCreationTimestamp() . "<br/>";;
				}
				if ($refundDetails->isSetRefundStatus()) {
					$contents .= "                    RefundStatus: " . "<br/>";;
					$refundStatus = $refundDetails->getRefundStatus();
					if ($refundStatus->isSetState()) {
						$contents .= "                        State: ";
						$contents .= "                            " . $refundStatus->getState() . "<br/>";;
					}
					if ($refundStatus->isSetLastUpdateTimestamp()) {
						$contents .= "                        LastUpdateTimestamp: ";
						$contents .= "                            " . $refundStatus->getLastUpdateTimestamp() . "<br/>";;
					}
					if ($refundStatus->isSetReasonCode()) {
						$contents .= "                        ReasonCode: ";
						$contents .= "                            " . $refundStatus->getReasonCode() . "<br/>";;
					}
					if ($refundStatus->isSetReasonDescription()) {
						$contents .= "                        ReasonDescription: ";
						$contents .= "                            " . $refundStatus->getReasonDescription() . "<br/>";;
					}
				}
				if ($refundDetails->isSetSoftDescriptor()) {
					$contents .= "        SoftDescriptor: ";
					$contents .= "            " . $refundDetails->getSoftDescriptor() . "<br/>";;
				}
			}
		}
		if ($this->amazonData->isSetResponseMetadata()) {
			$contents .= "            ResponseMetadata: " . "<br/>";;
			$responseMetadata = $this->amazonData->getResponseMetadata();
			if ($responseMetadata->isSetRequestId()) {
				$contents .= "                RequestId: ";
				$contents .= "                    " . $responseMetadata->getRequestId() . "<br/>";;
			}
		}

		$contents .= "            ResponseHeaderMetadata: " . $this->amazonData->getResponseHeaderMetadata() . "<br/>";;

		return $contents;
	}



}