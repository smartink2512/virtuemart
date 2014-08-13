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
	protected $authorizationNotification = null;

	public function __construct (OffAmazonPaymentsNotifications_Model_authorizationNotification $authorizationNotification) {
		$this->authorizationNotification = $authorizationNotification;
		parent::__construct($authorizationNotification);


	}

	function handleNotification () {
		$authorizationDetails = $this->authorizationNotification->getAuthorizationDetails();
		$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
		$amazonState=$authorizationStatus->getState();
		return $amazonState;
	}

	public function storeResultParams () {
		//$storeResult = $this->getStoreResultParams();
		$storeResult = new stdClass();
		if ($this->authorizationNotification->isSetAuthorizationDetails()) {
			$authorizationDetails = $this->authorizationNotification->getAuthorizationDetails();
			if ($authorizationDetails->isSetAmazonAuthorizationId()) {
				$storeResult->amazon_response_amazonAuthorizationId = $authorizationDetails->getAmazonAuthorizationId();
			}
			if ($authorizationDetails->isSetAuthorizationStatus()) {
				$authorizationStatus = $authorizationDetails->getAuthorizationStatus();
				if ($authorizationStatus->isSetState()) {
					$storeResult->amazon_response_state = $authorizationStatus->getState();
				}
				if ($authorizationStatus->isSetLastUpdateTimestamp()) {
					$storeResult->amazon_response_reasonCode = $authorizationStatus->getReasonCode();
				}
				if ($authorizationStatus->isSetReasonCode()) {
					$storeResult->amazon_response_reasonCode = $authorizationStatus->getReasonCode();
				}
				if ($authorizationStatus->isSetReasonDescription()) {
					$storeResult->amazon_response_reasonDescription = $authorizationStatus->getReasonDescription();
				}
			}
		}
		return $storeResult;
	}


}