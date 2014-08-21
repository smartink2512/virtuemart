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

class amazonHelperRefundNotification extends amazonHelper {

	public function __construct (OffAmazonPaymentsService_Model_refundNotification $refundNotification) {
		parent::__construct($refundNotification);
	}


	protected function getContents () {
		$contents = "\nRefund Notification";
		$contents .= "\n=============================================================================";
		if ($this->amazonData->isSetRefundDetails()) {
			$contents .= "\n  RefundDetails";
			$refundDetails = $this->amazonData->getRefundDetails();
			if ($refundDetails->isSetAmazonRefundId()) {
				$contents .= "\n      AmazonRefundId: ".$refundDetails->getAmazonRefundId();
			}
			if ($refundDetails->isSetRefundReferenceId()) {
				$contents .= "\n  RefundReferenceId: ".$refundDetails->getRefundReferenceId();
			}
			if ($refundDetails->isSetRefundType()) {
				$contents .= "\n  RefundType: ".$refundDetails->getRefundType();
			}
			if ($refundDetails->isSetRefundAmount()) {
				$contents .= "\n  RefundAmount";
				$refundAmount = $refundDetails->getRefundAmount();
				if ($refundAmount->isSetAmount()) {
					$contents .= "\n      Amount ".$refundAmount->getAmount();
				}
				if ($refundAmount->isSetCurrencyCode()) {
					$contents .= "\n      CurrencyCode: ".$refundAmount->getCurrencyCode();
				}
			}
			if ($refundDetails->isSetFeeRefunded()) {
				$contents .= "\n  FeeRefunded";
				$feeRefunded = $refundDetails->getFeeRefunded();
				if ($feeRefunded->isSetAmount()) {
					$contents .= "\n      Amount ".$feeRefunded->getAmount();
				}
				if ($feeRefunded->isSetCurrencyCode()) {
					$contents .= "\n      CurrencyCode ". $feeRefunded->getCurrencyCode();
				}
			}
			if ($refundDetails->isSetCreationTimestamp()) {
				$contents .= "\n  CreationTimestamp ".$refundDetails->getCreationTimestamp();
			}
			if ($refundDetails->isSetRefundStatus()) {
				$contents .= "\n  RefundStatus";
				$refundStatus = $refundDetails->getRefundStatus();
				if ($refundStatus->isSetState()) {
					$contents .= "\n      State ". $refundStatus->getState();
				}
				if ($refundStatus->isSetLastUpdateTimestamp()) {
					$contents .= "\n      LastUpdateTimestamp ".$refundStatus->getLastUpdateTimestamp();
				}
				if ($refundStatus->isSetReasonCode()) {
					$contents .= "\n      ReasonCode ". $refundStatus->getReasonCode();
				}
				if ($refundStatus->isSetReasonDescription()) {
					$contents .= "\n      ReasonDescription ". $refundStatus->getReasonDescription();
				}
			}
			if ($refundDetails->isSetSoftDescriptor()) {
				$contents .= "\n  SoftDescriptor ".$refundDetails->getSoftDescriptor();
			}
		}
		return $contents;
	}


}