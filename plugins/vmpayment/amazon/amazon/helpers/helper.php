<?php

defined('_JEXEC') or die('Direct Access to ' . basename(__FILE__) . 'is not allowed.');

/**
 *
 * @package    VirtueMart
 * @subpackage vmpayment Amazon
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

abstract class amazonHelper {
	var $amazonData = null;
	var $plugin = null;
	var $_currentMethod = null;

	public function __construct ($amazonData, $method) {
		$this->amazonData = $amazonData;
		$this->_currentMethod = $method;
	}

	function getAmazonResponseState ($status) {
		$amazonResponseState = new stdClass();

		if ($status->isSetState()) {
			$amazonResponseState->amazon_response_state = $status->getState();
		}
		if ($status->isSetReasonCode()) {
			$amazonResponseState->amazon_response_reasonCode = $status->getReasonCode();
		}
		if ($status->isSetReasonDescription()) {
			$amazonResponseState->amazon_response_reasonDescription = $status->getReasonDescription();
		}


		return $amazonResponseState;
	}

	function getVmReferenceId($referenceId) {
		$pos= strrpos($referenceId, '-');
		return substr($referenceId,0,$pos);
	}


	protected abstract function getContents ();
function tableStart($title) {
	$contents = '<table class="adminlist table">';
	$contents .= '	<tr><th colspan="3">';
	$contents .= $title;
	$contents .= '</th></tr>';
	return $contents;
}
	function tableEnd() {
		$contents = '</table>';
		return $contents;
	}
function getRow($title, $value) {
	$contents = '<tr><td></td><td>';

	$contents .= $title;
	$contents .= '</td><td>';

	$contents .= $value;
	$contents .= '</td></tr>';
	return $contents;
}

	function getRowFirstCol($title) {
		$contents = '<tr><td colspan="3">';
		$contents .= $title;
		$contents .='</td><td>';

		return $contents;
	}


	public function getContentsAuthorizationDetails ($authorizationDetails) {
$contents='';

			if ($authorizationDetails->isSetAmazonAuthorizationId()) {
				$contents .= '<tr><td></td><td>';

				$contents .= "AmazonAuthorizationId: ";
				$contents .= '</td><td>';

				$contents .= $authorizationDetails->getAmazonAuthorizationId();
				$contents .= '</td></tr>';
			}
			if ($authorizationDetails->isSetAuthorizationReferenceId()) {
				$contents .= '<tr><td></td><td>';
				$contents .= "AuthorizationReferenceId: ";
				$contents .= '</td><td>';
				$contents .= $authorizationDetails->getAuthorizationReferenceId();
				$contents .= '</td></tr>';
			}
			if ($authorizationDetails->isSetAuthorizationAmount()) {
				$contents .= '<tr><td></td><td>';
				$contents .= "AuthorizationAmount";
				$contents .= '</td><td>';

				$authorizationAmount = $authorizationDetails->getAuthorizationAmount();
				if ($authorizationAmount->isSetAmount()) {
					$contents .= "Amount: " . $authorizationAmount->getAmount() . "<br />";
				}
				if ($authorizationAmount->isSetCurrencyCode()) {
					$contents .= "CurrencyCode: " . $authorizationAmount->getCurrencyCode() . "<br />";
				}
				$contents .= '</td></tr>';
			}
			if ($authorizationDetails->isSetCapturedAmount()) {
				$contents .= '<tr><td></td><td>';

				$contents .= "CapturedAmount";
				$contents .= '</td><td>';

				$capturedAmount = $authorizationDetails->getCapturedAmount();
				if ($capturedAmount->isSetAmount()) {
					$contents .= "Amount: " . $capturedAmount->getAmount() . "<br />";
				}
				if ($capturedAmount->isSetCurrencyCode()) {
					$contents .= "CurrencyCode: " . $capturedAmount->getCurrencyCode() . "<br />";
				}
				$contents .= '</td></tr>';
			}
			if ($authorizationDetails->isSetAuthorizationFee()) {
				$contents .= '<tr><td></td><td>';

				$contents .= "AuthorizationFee";
				$contents .= '</td><td>';

				$authorizationFee = $authorizationDetails->getAuthorizationFee();
				if ($authorizationFee->isSetAmount()) {
					$contents .= "Amount: " . $authorizationFee->getAmount() . "<br />";
				}
				if ($authorizationFee->isSetCurrencyCode()) {
					$contents .= "CurrencyCode: " . $authorizationFee->getCurrencyCode() . "<br />";
				}
				$contents .= '</td></tr>';
			}
			if ($authorizationDetails->isSetIdList()) {
				$contents .= '<tr><td></td><td>';

				$contents .= "IdList";
				$contents .= '</td><td>';

				$idList = $authorizationDetails->getIdList();
				$memberList = $idList->getId();
				foreach ($memberList as $member) {
					$contents .= "<br /> member: " . $member;
				}
				$contents .= '</td></tr>';
			}
			if ($authorizationDetails->isSetCreationTimestamp()) {
				$contents .= '<tr><td></td><td>';
				$contents .= "CreationTimestamp: ";
				$contents .= '</td><td>';
				$contents .= $authorizationDetails->getCreationTimestamp();
				$contents .= '</td></tr>';
			}
			if ($authorizationDetails->isSetExpirationTimestamp()) {
				$contents .= '<tr><td></td><td>';
				$contents .= " ExpirationTimestamp";$contents .= '</td><td>';
				$contents .= $authorizationDetails->getExpirationTimestamp();
				$contents .= '</td></tr>';
			}
			if ($authorizationDetails->isSetAuthorizationStatus()) {
				$contents .= '<tr><td></td><td>';
				$contents .= "AuthorizationStatus";
				$contents .= '</td><td>';
				$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
				if ($authorizationStatus->isSetState()) {
					$contents .= "State: " . $authorizationStatus->getState() . "<br />";
				}
				if ($authorizationStatus->isSetLastUpdateTimestamp()) {
					$contents .= "LastUpdateTimestamp: " . $authorizationStatus->getLastUpdateTimestamp() . "<br />";
				}
				if ($authorizationStatus->isSetReasonCode()) {
					$contents .= "ReasonCode: " . $authorizationStatus->getReasonCode() . "<br />";
				}
				if ($authorizationStatus->isSetReasonDescription()) {
					$contents .= "ReasonDescription: " . $authorizationStatus->getReasonDescription() . "<br />";
				}
				$contents .= '</td></tr>';
			}
			if ($authorizationDetails->isSetOrderItemCategories()) {
				$contents .= '<tr><td></td><td>';
				$contents .= "OrderItemCategories";
				$contents .= '</td><td>';
				$orderItemCategories = $authorizationDetails->getOrderItemCategories();
				$orderItemCategoryList = $orderItemCategories->getOrderItemCategory();
				foreach ($orderItemCategoryList as $orderItemCategory) {
					$contents .= "OrderItemCategory: " . $orderItemCategory . "<br />";
				}
				$contents .= '</td></tr>';
			}
			if ($authorizationDetails->isSetCaptureNow()) {
				$contents .= '<tr><td></td><td>';
				$contents .= "CaptureNow";
				$contents .= '</td><td>';
				$contents .= $authorizationDetails->getCaptureNow();
				$contents .= '</td></tr>';
			}
			if ($authorizationDetails->isSetSoftDescriptor()) {
				$contents .= '<tr><td></td><td>';
				$contents .= "SoftDescriptor";
				$contents .= '</td><td>';
				$contents .= $authorizationDetails->getSoftDescriptor();
				$contents .= '</td></tr>';
			}

		return $contents;
	}
	public function getContentsCaptureDetails ($captureDetails) {
		$contents='';

		if ($captureDetails->isSetAmazonCaptureId()) {
			$contents .= '<tr><td></td><td>';

			$contents .= "AmazonCaptureId: ";
			$contents .= '</td><td>';

			$contents .= $captureDetails->getAmazonCaptureId();
			$contents .= '</td></tr>';
		}
		if ($captureDetails->isSetCaptureReferenceId()) {
			$contents .= '<tr><td></td><td>';
			$contents .= "tCaptureReferenceId: ";
			$contents .= '</td><td>';
			$contents .= $captureDetails->getCaptureReferenceId();
			$contents .= '</td></tr>';
		}
		if ($captureDetails->isSetSellerCaptureNote()) {
			$contents .= '<tr><td></td><td>';
			$contents .= "SellerCaptureNote: ";
			$contents .= '</td><td>';
			$contents .= $captureDetails->getSellerCaptureNote();
			$contents .= '</td></tr>';
		}

		if ($captureDetails->isSetCapturedAmount()) {
			$contents .= '<tr><td></td><td>';

			$contents .= "CapturedAmount";
			$contents .= '</td><td>';

			$capturedAmount = $captureDetails->getCapturedAmount();
			if ($capturedAmount->isSetAmount()) {
				$contents .= "Amount: " . $capturedAmount->getAmount() . "<br />";
			}
			if ($capturedAmount->isSetCurrencyCode()) {
				$contents .= "CurrencyCode: " . $capturedAmount->getCurrencyCode() . "<br />";
			}
			$contents .= '</td></tr>';
		}
		if ($captureDetails->isSetRefundedAmount()) {
			$contents .= '<tr><td></td><td>';

			$contents .= "RefundedAmount";
			$contents .= '</td><td>';

			$refundedAmount = $captureDetails->getRefundedAmount();
			if ($refundedAmount->isSetAmount()) {
				$contents .= "Amount: " . $refundedAmount->getAmount() . "<br />";
			}
			if ($refundedAmount->isSetCurrencyCode()) {
				$contents .= "CurrencyCode: " . $refundedAmount->getCurrencyCode() . "<br />";
			}
			$contents .= '</td></tr>';
		}


		if ($captureDetails->isSetCaptureFee()) {
			$contents .= '<tr><td></td><td>';

			$contents .= "CaptureFee";
			$contents .= '</td><td>';

			$captureFee = $captureDetails->getCaptureFee();
			if ($captureFee->isSetAmount()) {
				$contents .= "Amount: " . $captureFee->getAmount() . "<br />";
			}
			if ($captureFee->isSetCurrencyCode()) {
				$contents .= "CurrencyCode: " . $captureFee->getCurrencyCode() . "<br />";
			}
			$contents .= '</td></tr>';
		}
		if ($captureDetails->isSetIdList()) {
			$contents .= '<tr><td></td><td>';

			$contents .= "IdList";
			$contents .= '</td><td>';

			$idList = $captureDetails->getIdList();
			$memberList = $idList->getId();
			foreach ($memberList as $member) {
				$contents .= "<br /> member: " . $member;
			}
			$contents .= '</td></tr>';
		}
		if ($captureDetails->isSetCreationTimestamp()) {
			$contents .= '<tr><td></td><td>';
			$contents .= "CreationTimestamp: ";
			$contents .= '</td><td>';
			$contents .= $captureDetails->getCreationTimestamp();
			$contents .= '</td></tr>';
		}
		if ($captureDetails->isSetExpirationTimestamp()) {
			$contents .= '<tr><td></td><td>';
			$contents .= " ExpirationTimestamp";$contents .= '</td><td>';
			$contents .= $captureDetails->getExpirationTimestamp();
			$contents .= '</td></tr>';
		}
		if ($captureDetails->isSetCaptureStatus()) {
			$contents .= '<tr><td></td><td>';
			$contents .= "CaptureStatus";
			$contents .= '</td><td>';
			$captureStatus = $captureDetails->getCaptureStatus();
			if ($captureStatus->isSetState()) {
				$contents .= "State: " . $captureStatus->getState() . "<br />";
			}
			if ($captureStatus->isSetLastUpdateTimestamp()) {
				$contents .= "LastUpdateTimestamp: " . $captureStatus->getLastUpdateTimestamp() . "<br />";
			}
			if ($captureStatus->isSetReasonCode()) {
				$contents .= "ReasonCode: " . $captureStatus->getReasonCode() . "<br />";
			}
			if ($captureStatus->isSetReasonDescription()) {
				$contents .= "ReasonDescription: " . $captureStatus->getReasonDescription() . "<br />";
			}
			if ($captureStatus->isSetReasonDescription()) {
				$contents .= "ReasonDescription: " . $captureStatus->getReasonDescription() . "<br />";
			}
			$contents .= '</td></tr>';
		}

		if ($captureDetails->isSetSoftDescriptor()) {
			$contents .= '<tr><td></td><td>';
			$contents .= "SoftDescriptor";
			$contents .= '</td><td>';
			$contents .= $captureDetails->getSoftDescriptor();
			$contents .= '</td></tr>';
		}

		return $contents;
	}
	public function getContentsRefundDetails ($refundDetails) {
		$contents='';

			if ($refundDetails->isSetAmazonRefundId()) {
				$contents .= '<tr><td></td><td>';

				$contents .= "AmazonRefundId: ";
				$contents .= '</td><td>';

				$contents .= $refundDetails->getAmazonRefundId();
				$contents .= '</td></tr>';
			}
			if ($refundDetails->isSetRefundReferenceId()) {
				$contents .= '<tr><td></td><td>';
				$contents .= "RefundReferenceId: ";
				$contents .= '</td><td>';
				$contents .= $refundDetails->getRefundReferenceId();
				$contents .= '</td></tr>';
			}

		if ($refundDetails->isSetRefundType()) {
			$contents .= '<tr><td></td><td>';
			$contents .= "RefundType: ";
			$contents .= '</td><td>';
			$contents .= $refundDetails->getRefundType();
			$contents .= '</td></tr>';
		}



			if ($refundDetails->isSetRefundAmount()) {
				$contents .= '<tr><td></td><td>';
				$contents .= "RefundAmount";
				$contents .= '</td><td>';

				$refundAmount = $refundDetails->getRefundAmount();
				if ($refundAmount->isSetAmount()) {
					$contents .= "Amount: " . $refundAmount->getAmount() . "<br />";
				}
				if ($refundAmount->isSetCurrencyCode()) {
					$contents .= "CurrencyCode: " . $refundAmount->getCurrencyCode() . "<br />";
				}
				$contents .= '</td></tr>';
			}


			if ($refundDetails->isSetRefundFee()) {
				$contents .= '<tr><td></td><td>';

				$contents .= "RefundFee";
				$contents .= '</td><td>';

				$refundFee = $refundDetails->getRefundFee();
				if ($refundFee->isSetAmount()) {
					$contents .= "Amount: " . $refundFee->getAmount() . "<br />";
				}
				if ($refundFee->isSetCurrencyCode()) {
					$contents .= "CurrencyCode: " . $refundFee->getCurrencyCode() . "<br />";
				}
				$contents .= '</td></tr>';
			}



			if ($refundDetails->isSetCreationTimestamp()) {
				$contents .= '<tr><td></td><td>';
				$contents .= "CreationTimestamp: ";
				$contents .= '</td><td>';
				$contents .= $refundDetails->getCreationTimestamp();
				$contents .= '</td></tr>';
			}

			if ($refundDetails->isSetRefundStatus()) {
				$contents .= '<tr><td></td><td>';
				$contents .= "RefundStatus";
				$contents .= '</td><td>';
				$refundStatus = $refundDetails->getRefundStatus();
				if ($refundStatus->isSetState()) {
					$contents .= "State: " . $refundStatus->getState() . "<br />";
				}
				if ($refundStatus->isSetLastUpdateTimestamp()) {
					$contents .= "LastUpdateTimestamp: " . $refundStatus->getLastUpdateTimestamp() . "<br />";
				}
				if ($refundStatus->isSetReasonCode()) {
					$contents .= "ReasonCode: " . $refundStatus->getReasonCode() . "<br />";
				}
				if ($refundStatus->isSetReasonDescription()) {
					$contents .= "ReasonDescription: " . $refundStatus->getReasonDescription() . "<br />";
				}
				$contents .= '</td></tr>';
			}

			if ($refundDetails->isSetSoftDescriptor()) {
				$contents .= '<tr><td></td><td>';
				$contents .= "SoftDescriptor";
				$contents .= '</td><td>';
				$contents .= $refundDetails->getSoftDescriptor();
				$contents .= '</td></tr>';
			}

		return $contents;
	}


	
	
public function getContentsResponseMetadata($responseMetadata) {
	$contents='';
	if ($responseMetadata->isSetRequestId()) {
		$contents .= '<tr><td>';
		$contents .= "RequestId: " ;
		$contents .= '</td><td>';

		$contents .= $responseMetadata->getRequestId();
		$contents .= '</td><td>';
		$contents .= '</td><td>';
		$contents .= '</td></tr>';

	}
	return $contents;

}

	public function getContentsResponseHeaderMetadata($responseHeaderMetadata) {
		$contents='';
			$contents .= '<tr><td>';
			$contents .= "ResponseHeaderMetadata: " ;
			$contents .= '</td><td>';

			$contents .= $responseHeaderMetadata;
			$contents .= '</td><td>';
			$contents .= '</td><td>';
			$contents .= '</td></tr>';

		return $contents;

	}
}