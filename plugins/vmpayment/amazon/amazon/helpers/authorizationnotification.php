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

	public function __construct (OffAmazonPaymentsNotifications_Model_authorizationNotification $authorizationNotification, $plugin) {
		parent::__construct($authorizationNotification, $plugin);
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
	function onNotificationUpdateOrderHistory ($order, $payments) {
		$order_history = array();
		$amazonState = "";
		$reasonCode = "";
		if (!$this->amazonData->isSetAuthorizationDetails()) {
			$this->debugLog('NO isSetAuthorizationDetails' . __FUNCTION__ . var_export($this->amazonData, true), 'error');
			return false;
		}
		$authorizationDetails = $this->amazonData->getAuthorizationDetails();
		if (!$authorizationDetails->isSetAuthorizationStatus()) {
			$this->debugLog('NO isSetAuthorizationStatus' . __FUNCTION__ . var_export($this->amazonData, true), 'error');
			return false;
		}
		$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
		if (!$authorizationStatus->isSetState()) {
			$this->debugLog('NO isSetState' . __FUNCTION__ . var_export($this->amazonData, true), 'error');
			return false;
		}
		$amazonState = $authorizationStatus->getState();

		if ($authorizationStatus->isSetReasonCode()) {
			$reasonCode = $authorizationStatus->getReasonCode();
		}
		$order_history['customer_notified'] = 1;

		if ($amazonState == 'Open') {
			$order_history['order_status'] = $this->_currentMethod->status_authorization_synchronous;
			$order_history['comments'] = vmText::_('VMPAYMENT_AMAZON_COMMENT_STATUS_AUTHORIZATION_OPEN');
		} elseif ($amazonState == 'Declined') {
			if ($reasonCode == 'InvalidPaymentMethod') {
				// contact the buyer bye email
				$order_history['order_status'] = $this->_currentMethod->status_orderconfirmed;
			} elseif ($reasonCode == 'AmazonRejected') {
				$order_history['order_status'] = $this->_currentMethod->status_cancel;
			} elseif ($reasonCode == 'TransactionTimedOut') {
// TODO  retry the authorization again
				$order_history['order_status'] = $this->_currentMethod->status_cancel;
			}
			$order_history['comments'] = vmText::sprintf('VMPAYMENT_AMAZON_COMMENT_STATUS_AUTHORIZATION_DECLINED', $reasonCode);
			$order_history['customer_notified'] = 0;
		} elseif ($amazonState == 'Pending') {
			$order_history['order_status'] = $this->_currentMethod->status_orderconfirmed;
			$order_history['comments'] = vmText::_('VMPAYMENT_AMAZON_COMMENT_STATUS_AUTHORIZATION_PENDING');
			$order_history['customer_notified'] = 0;
		} elseif ($amazonState == 'Closed') {
			$order_history['order_status'] = $this->_currentMethod->status_orderconfirmed;
			$order_history['comments'] = vmText::sprintf('VMPAYMENT_AMAZON_COMMENT_STATUS_AUTHORIZATION_CLOSED', $reasonCode);
			$order_history['customer_notified'] = 0;
		}

		$orderModel = VmModel::getModel('orders');
		$orderModel->updateStatusForOneOrder($order['details']['BT']->virtuemart_order_id, $order_history, TRUE);

	}

	public function getStoreInternalData () {
		//$amazonInternalData = $this->getStoreResultParams();
		$amazonInternalData = new stdClass();
		if ($this->amazonData->isSetAuthorizationDetails()) {
			$authorizationDetails = $this->amazonData->getAuthorizationDetails();
			if ($authorizationDetails->isSetAmazonAuthorizationId()) {
				$amazonInternalData->amazon_response_amazonAuthorizationId = $authorizationDetails->getAmazonAuthorizationId();
			}
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
			}
		}
		return $amazonInternalData;
	}


	public function getReferenceId () {
		if ($this->amazonData->isSetAuthorizationDetails()) {
			$authorizationDetails = $this->amazonData->getAuthorizationDetails();
			if ($authorizationDetails->isSetAuthorizationReferenceId()) {
				return $authorizationDetails->getAuthorizationReferenceId();
			}
		}
		return NULL;
	}

	public function getAmazonId () {
		if ($this->amazonData->isSetAuthorizationDetails()) {
			$authorizationDetails = $this->amazonData->getAuthorizationDetails();
			if ($authorizationDetails->isSetAmazonAuthorizationId()) {
				return $authorizationDetails->getAmazonAuthorizationId();
			}
		}
		return NULL;
	}

	public function getContents () {
		$contents = "Authorization Notification";
		$contents .= "<br />====================================";
		if ($this->amazonData->isSetAuthorizationDetails()) {
			$contents .= "<br />    AuthorizeDetails";
			$authorizationDetails = $this->amazonData->getAuthorizationDetails();
			if ($authorizationDetails->isSetAmazonAuthorizationId()) {
				$contents .= "<br />    AmazonAuthorizationId: " . $authorizationDetails->getAmazonAuthorizationId();
			}
			if ($authorizationDetails->isSetAuthorizationReferenceId()) {
				$contents .= "<br />      AuthorizationReferenceId: " . $authorizationDetails->getAuthorizationReferenceId();
			}
			if ($authorizationDetails->isSetAuthorizationAmount()) {
				$contents .= "<br />      AuthorizationAmount";
				$authorizationAmount = $authorizationDetails->getAuthorizationAmount();
				if ($authorizationAmount->isSetAmount()) {
					$contents .= "<br /> Amount: " . $authorizationAmount->getAmount();
				}
				if ($authorizationAmount->isSetCurrencyCode()) {
					$contents .= "<br /> CurrencyCode: " . $authorizationAmount->getCurrencyCode();
				}
			}
			if ($authorizationDetails->isSetCapturedAmount()) {
				$contents .= "<br />       CapturedAmount";
				$capturedAmount = $authorizationDetails->getCapturedAmount();
				if ($capturedAmount->isSetAmount()) {
					$contents .= "<br /> Amount: " . $capturedAmount->getAmount();
				}
				if ($capturedAmount->isSetCurrencyCode()) {
					$contents .= "<br /> CurrencyCode: " . $capturedAmount->getCurrencyCode();
				}
			}
			if ($authorizationDetails->isSetAuthorizationFee()) {
				$contents .= "<br />      AuthorizationFee";
				$authorizationFee = $authorizationDetails->getAuthorizationFee();
				if ($authorizationFee->isSetAmount()) {
					$contents .= "<br /> Amount: " . $authorizationFee->getAmount();
				}
				if ($authorizationFee->isSetCurrencyCode()) {
					$contents .= "<br /> CurrencyCode: " . $authorizationFee->getCurrencyCode();
				}
			}
			if ($authorizationDetails->isSetIdList()) {
				$contents .= "<br />      IdList";
				$idList = $authorizationDetails->getIdList();
				$memberList = $idList->getId();
				foreach ($memberList as $member) {
					$contents .= "<br /> member: " . $member;
				}
			}
			if ($authorizationDetails->isSetCreationTimestamp()) {
				$contents .= "<br />      CreationTimestamp: " . $authorizationDetails->getCreationTimestamp();
			}
			if ($authorizationDetails->isSetExpirationTimestamp()) {
				$contents .= "<br />      ExpirationTimestamp";
				$contents .= "<br />  " . $authorizationDetails->getExpirationTimestamp();
			}
			if ($authorizationDetails->isSetAuthorizationStatus()) {
				$contents .= "<br />      AuthorizationStatus";
				$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
				if ($authorizationStatus->isSetState()) {
					$contents .= "<br /> State: " . $authorizationStatus->getState();
				}
				if ($authorizationStatus->isSetLastUpdateTimestamp()) {
					$contents .= "<br /> LastUpdateTimestamp: " . $authorizationStatus->getLastUpdateTimestamp();
				}
				if ($authorizationStatus->isSetReasonCode()) {
					$contents .= "<br /> ReasonCode: " . $authorizationStatus->getReasonCode();
				}
				if ($authorizationStatus->isSetReasonDescription()) {
					$contents .= "<br /> ReasonDescription: " . $authorizationStatus->getReasonDescription();
				}
			}
			if ($authorizationDetails->isSetOrderItemCategories()) {
				$contents .= "<br />       OrderItemCategories";
				$orderItemCategories = $authorizationDetails->getOrderItemCategories();
				$orderItemCategoryList = $orderItemCategories->getOrderItemCategory();
				foreach ($orderItemCategoryList as $orderItemCategory) {
					$contents .= "<br /> OrderItemCategory: " . $orderItemCategory;
				}
			}
			if ($authorizationDetails->isSetCaptureNow()) {
				$contents .= "<br />      CaptureNow: " . $authorizationDetails->getCaptureNow();
			}
			if ($authorizationDetails->isSetSoftDescriptor()) {
				$contents .= "<br />      SoftDescriptor: " . $authorizationDetails->getSoftDescriptor();
			}
		}
		return $contents;
	}


}