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

class amazonHelperSetOrderReferenceDetailsResponse extends amazonHelper
{
	protected $setOrderReferenceDetailsResponse = null;
	public function __construct(OffAmazonPaymentsService_Model_SetOrderReferenceDetailsResponse $setOrderReferenceDetailsResponse) {
		$this->setOrderReferenceDetailsResponse = $setOrderReferenceDetailsResponse;
	}

	public function storeResultParams() {
$response=$this->setOrderReferenceDetailsResponse;
		$storeResult=new stdClass();
		if ($response->isSetSetOrderReferenceDetailsResult()) {

			$setOrderReferenceDetailsResult = $response->getSetOrderReferenceDetailsResult();
			if ($setOrderReferenceDetailsResult->isSetOrderReferenceDetails()) {

				$orderReferenceDetails = $setOrderReferenceDetailsResult->getOrderReferenceDetails();
				if ($orderReferenceDetails->isSetAmazonOrderReferenceId())
				{
					$storeResult->amazon_response_amazonAuthorizationId= $orderReferenceDetails->getAmazonOrderReferenceId() ;
				}



				if ($orderReferenceDetails->isSetOrderReferenceStatus()) {

					$orderReferenceStatus = $orderReferenceDetails->getOrderReferenceStatus();
					if ($orderReferenceStatus->isSetState())
					{
						$storeResult->amazon_response_reasonCode= $orderReferenceStatus->getReasonCode();
					}

					if ($orderReferenceStatus->isSetReasonCode())
					{			$storeResult->amazon_response_reasonCode= $orderReferenceStatus->getReasonCode();


					}
					if ($orderReferenceStatus->isSetReasonDescription())
					{			$storeResult->amazon_response_reasonDescription= $orderReferenceStatus->getReasonDescription();

					}
				}

			}
		}

		return $storeResult;
	}


}