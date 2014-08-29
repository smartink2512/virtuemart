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
		$contents = '<table>';
		$contents .= '	<tr><th colspan="3">';
		$contents .= "CaptureResponse";
		$contents .= '</th></tr>';
		if ($this->amazonData->isSetCaptureResult()) {
			$contents .= '<tr>';
			$contents .= "<td>";
			$contents .= "CaptureResult";
			$contents .= "</td>";
			$contents .= "<td></td>";
			$contents .= '</tr>';
			$authorizeResult = $this->amazonData->getCaptureResult();
			if ($authorizeResult->isSetCaptureDetails()) {
				$contents .=$this->getContentsCaptureDetails($authorizeResult->getCaptureDetails());
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