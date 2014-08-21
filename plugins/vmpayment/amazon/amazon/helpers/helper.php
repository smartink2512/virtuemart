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

abstract class amazonHelper
{
	var $amazonData = null;
	public function __construct($amazonData)
	{

			$this->amazonData = $amazonData;

	}

	function getAmazonReponseState($status) {
		$storeResult =new stdClass();

		if ($status->isSetState()) {
			$storeResult->amazon_response_state= $status->getState();
		}
		if ($status->isSetReasonCode()) {
			$storeResult->amazon_response_reasonCode= $status->getReasonCode();
		}
		if ($status->isSetReasonDescription()) {
			$storeResult->amazon_response_reasonDescription= $status->getReasonDescription();
		}


		return 	$storeResult;
	}


	function getAuthorizationId() {
		if ($this->amazonData->isSetAuthorizationDetails()) {
			$authorizationDetails = $this->amazonData->getAuthorizationDetails();

			if ($authorizationDetails->isSetAuthorizationReferenceId()) {
				return $authorizationDetails->getAuthorizationReferenceId();
			}
		}
		return FALSE;
	}
function storeResults(){

}

	protected abstract function getContents();

}