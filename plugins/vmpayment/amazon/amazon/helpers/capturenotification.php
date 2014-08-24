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

	public function __construct (OffAmazonPaymentsNotifications_Model_CaptureNotification $captureNotification,$method) {
		parent::__construct($captureNotification,$method);
	}

	/**
	 * if synchronous, then should not update order status
	 * @param $order
	 * @param $payments
	 */
	function onNotificationUpdateOrderHistory ($order, $payments) {
		if ($this->_currentMethod->authorization_mode_erp_disabled=='automatic_synchronous') {
			return;
		}
		$order_history = array();
		$amazonState = "";
		$reasonCode = "";
		if ($this->amazonData->isSetCaptureDetails()) {
			$details = $this->amazonData->getCaptureDetails();
			if ($details->isSetCaptureStatus()) {
				$status = $details->getCaptureStatus();
				if ($status->isSetState()) {
					$amazonState = $status->getState();
				} else {
					// TODO THIS IS AN ERROR
				}
				if ($status->isSetReasonCode()) {
					$reasonCode = $status->getReasonCode();
				}
			}
			// default value
			$order_history['customer_notified'] = 1;
			if ($amazonState == 'Completed') {
				$order_history['order_status'] = $this->_currentMethod->status_capture;
				$order_history['comments'] = vmText::_('VMPAYMENT_AMAZON_COMMENT_STATUS_CAPTURE_COMPLETED');

			} elseif ($amazonState == 'Declined') {
				if ($reasonCode == 'AmazonRejected') {
					$order_history['order_status'] = $this->_currentMethod->status_cancel;
				} elseif ($reasonCode == 'ProcessingFailure') {
					// TODO  retry the Capture again if in Open State, and then call the capture again
					$order_history['order_status'] = $this->_currentMethod->status_cancel;
				}
				$order_history['comments'] = vmText::sprintf('VMPAYMENT_AMAZON_COMMENT_STATUS_CAPTURE_DECLINED',$reasonCode );
			} elseif ($amazonState == 'Pending') {
				$order_history['order_status'] = $this->_currentMethod->status_orderconfirmed;
				$order_history['comments'] = vmText::_('VMPAYMENT_AMAZON_COMMENT_STATUS_CAPTURE_PENDING');
				$order_history['customer_notified'] = 0;

			} elseif ($amazonState == 'Closed') {
				// keep old status
				$order_history['customer_notified'] = 0;
				$order_history['order_status'] = $order['details']['BT']->order_status;
				$order_history['comments'] = vmText::sprintf('VMPAYMENT_AMAZON_COMMENT_STATUS_CAPTURE_CLOSED',$reasonCode );

			}

			$order_history['amazonState'] = $amazonState;
			$orderModel = VmModel::getModel('orders');
			$orderModel->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order_history, TRUE);
		}
	}

	public function getReferenceId () {
		if ($this->amazonData->isSetCaptureDetails()) {
			$details = $this->amazonData->getCaptureDetails();
			if ($details->isSetCaptureReferenceId()) {
				return $this->getVmReferenceId($details->getCaptureReferenceId());
			}
		}
		return NULL;
	}

	public function getAmazonId () {
		if ($this->amazonData->isSetCaptureDetails()) {
			$details = $this->amazonData->getCaptureDetails();
			if ($details->isSetAmazonCaptureId()) {
				return $details->getAmazonCaptureId();
			}
		}
		return NULL;
	}
	public function getStoreInternalData () {
		//$amazonInternalData = $this->getStoreResultParams();
		$amazonInternalData = new stdClass();
		if ($this->amazonData->isSetCaptureDetails()) {
			$details = $this->amazonData->getCaptureDetails();
			if ($details->isSetAmazonCaptureId()) {
				$amazonInternalData->amazon_response_amazonCaptureId = $details->getAmazonCaptureId();
			}
			if ($details->isSetCaptureStatus()) {
				$status = $details->getCaptureStatus();
				if ($status->isSetState()) {
					$amazonInternalData->amazon_response_state = $status->getState();
				}
				if ($status->isSetReasonCode()) {
					$amazonInternalData->amazon_response_reasonCode = $status->getReasonCode();
				}
				if ($status->isSetReasonDescription()) {
					$amazonInternalData->amazon_response_reasonDescription = $status->getReasonDescription();
				}
			}
		}
		return $amazonInternalData;
	}

	 function getContents () {
		$contents = "Capture Notification";
		$contents .= "<br />===================================";
		if ($this->amazonData->isSetCaptureDetails()) {
			$contents .= "<br /> CaptureDetails";
			$captureDetails = $this->amazonData->getCaptureDetails();
			if ($captureDetails->isSetAmazonCaptureId()) {
				$contents .= "<br /> AmazonCaptureId: " . $captureDetails->getAmazonCaptureId();
			}
			if ($captureDetails->isSetCaptureReferenceId()) {
				$contents .= "<br />     CaptureReferenceId: " . $captureDetails->getCaptureReferenceId();
			}
			if ($captureDetails->isSetCaptureAmount()) {
				$contents .= "<br />     CaptureAmount";
				$captureAmount = $captureDetails->getCaptureAmount();
				if ($captureAmount->isSetAmount()) {
					$contents .= "<br />         Amount: " . $captureAmount->getAmount();
				}
				if ($captureAmount->isSetCurrencyCode()) {
					$contents .= "<br />      CurrencyCode: " . $captureAmount->getCurrencyCode();
				}
			}
			if ($captureDetails->isSetRefundedAmount()) {
				$contents .= "<br />      RefundedAmount";
				$refundedAmount = $captureDetails->getRefundedAmount();
				if ($refundedAmount->isSetAmount()) {
					$contents .= "<br />          Amount: " . $refundedAmount->getAmount();
				}
				if ($refundedAmount->isSetCurrencyCode()) {
					$contents .= "<br />          CurrencyCode: " . $refundedAmount->getCurrencyCode();
				}
			}
			if ($captureDetails->isSetCaptureFee()) {
				$contents .= "<br />      CaptureFee";
				$captureFee = $captureDetails->getCaptureFee();
				if ($captureFee->isSetAmount()) {
					$contents .= "<br />          Amount: " . $captureFee->getAmount();
				}
				if ($captureFee->isSetCurrencyCode()) {
					$contents .= "<br />         CurrencyCode: " . $captureFee->getCurrencyCode();
				}
			}
			if ($captureDetails->isSetIdList()) {
				$contents .= "<br />  IdList";
				$idList = $captureDetails->getIdList();
				$memberList = $idList->getId();
				foreach ($memberList as $member) {
					$contents .= "<br />      member: " . $member;
				}
			}
			if ($captureDetails->isSetCreationTimestamp()) {
				$contents .= "<br />     CreationTimestamp: " . $captureDetails->getCreationTimestamp();
			}
			if ($captureDetails->isSetCaptureStatus()) {
				$contents .= "<br />    CaptureStatus";
				$captureStatus = $captureDetails->getCaptureStatus();
				if ($captureStatus->isSetState()) {
					$contents .= "<br />          State";
					$contents .= "<br />              " . $captureStatus->getState();
				}
				if ($captureStatus->isSetLastUpdateTimestamp()) {
					$contents .= "<br />         LastUpdateTimestamp: " . $captureStatus->getLastUpdateTimestamp();
				}
				if ($captureStatus->isSetReasonCode()) {
					$contents .= "<br />          ReasonCode: " . $captureStatus->getReasonCode();
				}
				if ($captureStatus->isSetReasonDescription()) {
					$contents .= "<br />          ReasonDescription: " . $captureStatus->getReasonDescription();
				}
			}
			if ($captureDetails->isSetSoftDescriptor()) {
				$contents .= "<br />      SoftDescriptor: " . $captureDetails->getSoftDescriptor();
			}

		}
		return $contents;
	}


}