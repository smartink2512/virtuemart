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

	public function __construct (OffAmazonPaymentsNotifications_Model_RefundNotification $refundNotification, $method) {
		parent::__construct($refundNotification, $method);
	}

	function onNotificationUpdateOrderHistory ($order, $payments) {

		$order_history = array();
		$amazonState = "";
		$reasonCode = "";
		if (!$this->amazonData->isSetRefundDetails()) {
			$this->debugLog('NO isSetRefundDetails' . __FUNCTION__ . var_export($this->amazonData, true), 'error');
			return;
		}
		$details = $this->amazonData->getRefundDetails();
		if (!$details->isSetRefundStatus()) {
			$this->debugLog('NO isSetRefundStatus' . __FUNCTION__ . var_export($this->amazonData, true), 'error');
			return;
		}
		$status = $details->getRefundStatus();
		if (!$status->isSetState()) {
			$this->debugLog('NO isSetState' . __FUNCTION__ . var_export($this->amazonData, true), 'error');
return;
		}
		$amazonState = $status->getState();

		if ($status->isSetReasonCode()) {
			$reasonCode = $status->getReasonCode();
		}
		// default value
		$order_history['customer_notified'] = 1;
		if ($amazonState == 'Completed') {
			$order_history['order_status'] = $this->_currentMethod->status_refunded;
			$order_history['comments'] = vmText::_('VMPAYMENT_AMAZON_COMMENT_STATUS_REFUND_COMPLETED');
		} elseif ($amazonState == 'Declined') {
			$order_history['customer_notified'] = 0;
			$order_history['comments'] = vmText::sprintf('VMPAYMENT_AMAZON_COMMENT_STATUS_REFUND_DECLINED', $reasonCode);
			$order_history['order_status'] = $order['details']['BT']->order_status;

		} elseif ($amazonState == 'Pending') {
			$order_history['comments'] = vmText::_('VMPAYMENT_AMAZON_COMMENT_STATUS_REFUND_PENDING');
			$order_history['order_status'] = $this->_currentMethod->status_orderconfirmed;
		}

		$orderModel = VmModel::getModel('orders');
		$orderModel->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order_history, TRUE);
		return $amazonState;
	}

	public function getReferenceId () {
		if ($this->amazonData->isSetRefundDetails()) {
			$details = $this->amazonData->getRefundDetails();
			if ($details->isSetRefundReferenceId()) {
				return $this->getVmReferenceId($details->getRefundReferenceId());
			}
		}
		return NULL;
	}

	public function getAmazonId () {
		if ($this->amazonData->isSetRefundDetails()) {
			$details = $this->amazonData->getRefundDetails();
			if ($details->isSetAmazonRefundId()) {
				return $details->getAmazonRefundId();
			}
		}
		return NULL;
	}

	public function getStoreInternalData () {
		//$amazonInternalData = $this->getStoreResultParams();
		$amazonInternalData = new stdClass();
		if ($this->amazonData->isSetRefundDetails()) {
			$details = $this->amazonData->getRefundDetails();
			if ($details->isSetAmazonRefundId()) {
				$amazonInternalData->amazon_response_amazonRefundId = $details->getAmazonRefundId();
			}
			if ($details->isSetRefundStatus()) {
				$status = $details->getRefundStatus();
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
		$contents = "<br />Refund Notification";
		$contents .= "<br />===============================";
		if ($this->amazonData->isSetRefundDetails()) {
			$contents .= "<br />  RefundDetails";
			$refundDetails = $this->amazonData->getRefundDetails();
			if ($refundDetails->isSetAmazonRefundId()) {
				$contents .= "<br />      AmazonRefundId: " . $refundDetails->getAmazonRefundId();
			}
			if ($refundDetails->isSetRefundReferenceId()) {
				$contents .= "<br />  RefundReferenceId: " . $refundDetails->getRefundReferenceId();
			}
			if ($refundDetails->isSetRefundType()) {
				$contents .= "<br />  RefundType: " . $refundDetails->getRefundType();
			}
			if ($refundDetails->isSetRefundAmount()) {
				$contents .= "<br />  RefundAmount";
				$refundAmount = $refundDetails->getRefundAmount();
				if ($refundAmount->isSetAmount()) {
					$contents .= "<br />      Amount " . $refundAmount->getAmount();
				}
				if ($refundAmount->isSetCurrencyCode()) {
					$contents .= "<br />      CurrencyCode: " . $refundAmount->getCurrencyCode();
				}
			}
			if ($refundDetails->isSetFeeRefunded()) {
				$contents .= "<br />  FeeRefunded";
				$feeRefunded = $refundDetails->getFeeRefunded();
				if ($feeRefunded->isSetAmount()) {
					$contents .= "<br />      Amount " . $feeRefunded->getAmount();
				}
				if ($feeRefunded->isSetCurrencyCode()) {
					$contents .= "<br />      CurrencyCode " . $feeRefunded->getCurrencyCode();
				}
			}
			if ($refundDetails->isSetCreationTimestamp()) {
				$contents .= "<br />  CreationTimestamp " . $refundDetails->getCreationTimestamp();
			}
			if ($refundDetails->isSetRefundStatus()) {
				$contents .= "<br />  RefundStatus";
				$refundStatus = $refundDetails->getRefundStatus();
				if ($refundStatus->isSetState()) {
					$contents .= "<br />      State " . $refundStatus->getState();
				}
				if ($refundStatus->isSetLastUpdateTimestamp()) {
					$contents .= "<br />      LastUpdateTimestamp " . $refundStatus->getLastUpdateTimestamp();
				}
				if ($refundStatus->isSetReasonCode()) {
					$contents .= "<br />      ReasonCode " . $refundStatus->getReasonCode();
				}
				if ($refundStatus->isSetReasonDescription()) {
					$contents .= "<br />      ReasonDescription " . $refundStatus->getReasonDescription();
				}
			}
			if ($refundDetails->isSetSoftDescriptor()) {
				$contents .= "<br />  SoftDescriptor " . $refundDetails->getSoftDescriptor();
			}
		}
		return $contents;
	}


}