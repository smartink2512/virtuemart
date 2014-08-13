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

class amazonHelperSetOrderReferenceDetailsRequest extends amazonHelper
{
	protected $SetOrderReferenceDetailsRequest = null;
	public function __construct(OffAmazonPaymentsService_Model_SetOrderReferenceDetailsRequest $SetOrderReferenceDetailsRequest) {
		$this->setOrderReferenceDetailsRequest = $SetOrderReferenceDetailsRequest;
	}

	public function storeResultParams() {
		$authorizationDetails = $this->setOrderReferenceDetailsRequest->getAuthorizationDetails();
		$storeResult = $this->getStoreResultParams();
		if ($authorizationDetails->isSetAuthorizationStatus()) {

			$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
			if ($authorizationStatus->isSetState()) {
				$storeResult->amazon_state= $authorizationStatus->getState();
			}
			if ($authorizationStatus->isSetReasonCode()) {
				$storeResult->amazon_reasonCode= $authorizationStatus->getReasonCode();
			}
			if ($authorizationStatus->isSetReasonDescription()) {
				$storeResult->amazon_reasonDescription= $authorizationStatus->getReasonDescription();
			}
		}
		return $storeResult;
	}
	/**
	 * Log the authorization detail contents
	 *
	 * @return void
	 */


}