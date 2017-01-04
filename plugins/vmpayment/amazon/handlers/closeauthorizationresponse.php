<?php

defined('_JEXEC') or die('Direct Access to ' . basename(__FILE__) . 'is not allowed.');

/**
 *
 * @package    VirtueMart
 * @subpackage vmpayment
 * @version $Id$
 * @author Valérie Isaksen
 * @link ${PHING.VM.MAINTAINERURL}
 * @copyright Copyright (c) 2004 - ${PHING.VM.RELDATE} VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 */
class amazonHelperCloseAuthorizationResponse extends amazonHelper {

	public function __construct (OffAmazonPaymentsService_Model_CloseAuthorizationResponse $closeAuthorizationResponse, $method) {
		parent::__construct($closeAuthorizationResponse, $method);
	}



	public function getStoreInternalData () {
		return NULL;
	}



	function getContents () {

		$contents = $this->tableStart("CloseAuthorizationResponse");
		$contents .= $this->getRow("Dump: ", var_export($this->amazonData, true));

		$contents .= $this->tableEnd();

		return $contents;
	}


}