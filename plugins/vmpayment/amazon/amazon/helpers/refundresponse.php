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
		$contents = '<table>';
		$contents .= '	<tr><th colspan="3">';
		$contents .= " RefundResponse";
		$contents .= '</th></tr>';
		if ($this->amazonData->isSetRefundResult()) {
			$contents .= '<tr>';
			$contents .= "<td>";
			$contents .= "RefundResult";
			$contents .= "</td>";
			$contents .= "<td></td>";
			$contents .= '</tr>';
			$refundResult = $this->amazonData->getRefundResult();
			if ($refundResult->isSetRefundDetails()) {
				$contents .=$this->getContentsRefundDetails($refundResult->getRefundDetails());
			}
		}
		if ($this->amazonData->isSetResponseMetadata()) {
			$contents .=$this->getContentsResponseMetadata($this->amazonData->getResponseMetadata());
		}
		$contents .=$this->getContentsResponseHeaderMetadata($this->amazonData->getResponseHeaderMetadata());

		$contents .= '</table>';

		return $contents;
	}


}