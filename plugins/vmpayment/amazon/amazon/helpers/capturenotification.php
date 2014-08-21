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

class amazonHelperCaptureNotification extends amazonHelper {

	public function __construct (OffAmazonPaymentsNotifications_Model_CaptureNotification $captureNotification) {
		parent::__construct($captureNotification);
	}

	protected function getContents () {
		$contents = "Capture Notification";
		$contents .= "\n=============================================================================";
		if ($this->amazonData->isSetCaptureDetails()) {
			$contents .= "\n CaptureDetails";
			$captureDetails = $this->amazonData->getCaptureDetails();
			if ($captureDetails->isSetAmazonCaptureId()) {
				$contents .= "\n AmazonCaptureId: ".$captureDetails->getAmazonCaptureId();
			}
			if ($captureDetails->isSetCaptureReferenceId()) {
				$contents .= "\n     CaptureReferenceId: ".$captureDetails->getCaptureReferenceId();
			}
			if ($captureDetails->isSetCaptureAmount()) {
				$contents .= "\n     CaptureAmount";
				$captureAmount = $captureDetails->getCaptureAmount();
				if ($captureAmount->isSetAmount()) {
					$contents .= "\n         Amount: ".$captureAmount->getAmount();
				}
				if ($captureAmount->isSetCurrencyCode()) {
					$contents .= "\n      CurrencyCode: ".$captureAmount->getCurrencyCode();
				}
			}
			if ($captureDetails->isSetRefundedAmount()) {
				$contents .= "\n      RefundedAmount";
				$refundedAmount = $captureDetails->getRefundedAmount();
				if ($refundedAmount->isSetAmount()) {
					$contents .= "\n          Amount: ". $refundedAmount->getAmount();
				}
				if ($refundedAmount->isSetCurrencyCode()) {
					$contents .= "\n          CurrencyCode: ".$refundedAmount->getCurrencyCode();
				}
			}
			if ($captureDetails->isSetCaptureFee()) {
				$contents .= "\n      CaptureFee";
				$captureFee = $captureDetails->getCaptureFee();
				if ($captureFee->isSetAmount()) {
					$contents .= "\n          Amount: ". $captureFee->getAmount();
				}
				if ($captureFee->isSetCurrencyCode()) {
					$contents .= "\n         CurrencyCode: ". $captureFee->getCurrencyCode();
				}
			}
			if ($captureDetails->isSetIdList()) {
				$contents .= "\n  IdList";
				$idList = $captureDetails->getIdList();
				$memberList = $idList->getId();
				foreach ($memberList as $member) {
					$contents .= "\n      member: ". $member;
				}
			}
			if ($captureDetails->isSetCreationTimestamp()) {
				$contents .= "\n     CreationTimestamp: ". $captureDetails->getCreationTimestamp();
			}
			if ($captureDetails->isSetCaptureStatus()) {
				$contents .= "\n    CaptureStatus";
				$captureStatus = $captureDetails->getCaptureStatus();
				if ($captureStatus->isSetState()) {
					$contents .= "\n          State";
					$contents .= "\n              " . $captureStatus->getState();
				}
				if ($captureStatus->isSetLastUpdateTimestamp()) {
					$contents .= "\n         LastUpdateTimestamp: ".$captureStatus->getLastUpdateTimestamp();
				}
				if ($captureStatus->isSetReasonCode()) {
					$contents .= "\n          ReasonCode: ". $captureStatus->getReasonCode();
				}
				if ($captureStatus->isSetReasonDescription()) {
					$contents .= "\n          ReasonDescription: ".$captureStatus->getReasonDescription();
				}
			}
			if ($captureDetails->isSetSoftDescriptor()) {
				$contents .= "\n      SoftDescriptor: ".$captureDetails->getSoftDescriptor();
			}

		}
		return $contents;
	}


}