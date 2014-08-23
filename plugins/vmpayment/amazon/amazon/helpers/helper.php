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

	public function __construct ($amazonData, $plugin) {
		$this->amazonData = $amazonData;
		$this->plugin = $plugin;
		$this->_currentMethod = $this->_currentMethod;
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

}