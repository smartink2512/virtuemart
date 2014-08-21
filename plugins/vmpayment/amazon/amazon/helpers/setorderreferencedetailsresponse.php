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

class amazonHelperSetOrderReferenceDetailsResponse extends amazonHelper {

	public function __construct (OffAmazonPaymentsService_Model_SetOrderReferenceDetailsResponse $setOrderReferenceDetailsResponse) {
		parent::__construct($setOrderReferenceDetailsResponse);
	}

	public function getStoreInternalData () {
		$response = $this->amazonData;
		$amazonInternalData = new stdClass();
		if ($response->isSetSetOrderReferenceDetailsResult()) {

			$setOrderReferenceDetailsResult = $response->getSetOrderReferenceDetailsResult();
			if ($setOrderReferenceDetailsResult->isSetOrderReferenceDetails()) {

				$orderReferenceDetails = $setOrderReferenceDetailsResult->getOrderReferenceDetails();
				if ($orderReferenceDetails->isSetAmazonOrderReferenceId()) {
					$amazonInternalData->amazon_response_amazonAuthorizationId = $orderReferenceDetails->getAmazonOrderReferenceId();
				}


				if ($orderReferenceDetails->isSetOrderReferenceStatus()) {

					$orderReferenceStatus = $orderReferenceDetails->getOrderReferenceStatus();
					if ($orderReferenceStatus->isSetState()) {
						$amazonInternalData->amazon_response_reasonCode = $orderReferenceStatus->getReasonCode();
					}

					if ($orderReferenceStatus->isSetReasonCode()) {
						$amazonInternalData->amazon_response_reasonCode = $orderReferenceStatus->getReasonCode();


					}
					if ($orderReferenceStatus->isSetReasonDescription()) {
						$amazonInternalData->amazon_response_reasonDescription = $orderReferenceStatus->getReasonDescription();

					}
				}

			}
		}

		return $amazonInternalData;
	}

	/**
	 * @return string
	 */
	function getContents () {
$contents="";
		$contents .= "Service Response" . "\n";
		$contents .= "=============================================================================" . "\n";

		$contents .= "        SetOrderReferenceDetailsResponse" . "\n";
		if ($this->amazonData->isSetSetOrderReferenceDetailsResult()) {
			$contents .= "            SetOrderReferenceDetailsResult" . "\n";
			$setOrderReferenceDetailsResult = $this->amazonData->getSetOrderReferenceDetailsResult();
			if ($setOrderReferenceDetailsResult->isSetOrderReferenceDetails()) {
				$contents .= "                OrderReferenceDetails" . "\n";
				$orderReferenceDetails = $setOrderReferenceDetailsResult->getOrderReferenceDetails();
				if ($orderReferenceDetails->isSetAmazonOrderReferenceId()) {
					$contents .= "                    AmazonOrderReferenceId: " .  $orderReferenceDetails->getAmazonOrderReferenceId() . "\n";
				}
				if ($orderReferenceDetails->isSetBuyer()) {
					$contents .= "                    Buyer" . "\n";
					$buyer = $orderReferenceDetails->getBuyer();
					if ($buyer->isSetName()) {
						$contents .= "                        Name: ".$buyer->getName() . "\n";
					}
					if ($buyer->isSetEmail()) {
						$contents .= "                        Email: ". $buyer->getEmail() . "\n";
					}
					if ($buyer->isSetPhone()) {
						$contents .= "                        Phone: ". $buyer->getPhone() . "\n";
					}
				}
				if ($orderReferenceDetails->isSetOrderTotal()) {
					$contents .= "                    OrderTotal" . "\n";
					$orderTotal = $orderReferenceDetails->getOrderTotal();
					if ($orderTotal->isSetCurrencyCode()) {
						$contents .= "                        CurrencyCode: ".$orderTotal->getCurrencyCode() . "\n";
					}
					if ($orderTotal->isSetAmount()) {
						$contents .= "                        Amount: ". $orderTotal->getAmount() . "\n";
					}
				}
				if ($orderReferenceDetails->isSetSellerNote()) {
					$contents .= "                    SellerNote: ". $orderReferenceDetails->getSellerNote() . "\n";
				}
				if ($orderReferenceDetails->isSetDestination()) {
					$contents .= "                    Destination" . "\n";
					$destination = $orderReferenceDetails->getDestination();
					if ($destination->isSetDestinationType()) {
						$contents .= "                        DestinationType: ".$destination->getDestinationType() . "\n";
					}
					if ($destination->isSetPhysicalDestination()) {
						$contents .= "                        PhysicalDestination" . "\n";
						$physicalDestination = $destination->getPhysicalDestination();
						if ($physicalDestination->isSetName()) {
							$contents .= "                            Name: ". $physicalDestination->getName() . "\n";
						}
						if ($physicalDestination->isSetAddressLine1()) {
							$contents .= "                            AddressLine1: ".$physicalDestination->getAddressLine1() . "\n";
						}
						if ($physicalDestination->isSetAddressLine2()) {
							$contents .= "                            AddressLine2: ".$physicalDestination->getAddressLine2() . "\n";
						}
						if ($physicalDestination->isSetAddressLine3()) {
							$contents .= "                            AddressLine3: ". $physicalDestination->getAddressLine3() . "\n";
						}
						if ($physicalDestination->isSetCity()) {
							$contents .= "                            City: ". $physicalDestination->getCity() . "\n";
						}
						if ($physicalDestination->isSetCounty()) {
							$contents .= "                            County: ". $physicalDestination->getCounty() . "\n";
						}
						if ($physicalDestination->isSetDistrict()) {
							$contents .= "                            District: ". $physicalDestination->getDistrict() . "\n";
						}
						if ($physicalDestination->isSetStateOrRegion()) {
							$contents .= "                            StateOrRegion: ". $physicalDestination->getStateOrRegion() . "\n";
						}
						if ($physicalDestination->isSetPostalCode()) {
							$contents .= "                            PostalCode: ".$physicalDestination->getPostalCode() . "\n";
						}
						if ($physicalDestination->isSetCountryCode()) {
							$contents .= "                            CountryCode: ".$physicalDestination->getCountryCode() . "\n";
						}
						if ($physicalDestination->isSetPhone()) {
							$contents .= "                            Phone: ". $physicalDestination->getPhone() . "\n";
						}
					}
				}
				if ($orderReferenceDetails->isSetReleaseEnvironment()) {
					$contents .= "                    ReleaseEnvironment" . "\n";
					$contents .= "                        " . $orderReferenceDetails->getReleaseEnvironment() . "\n";
				}
				if ($orderReferenceDetails->isSetIdList()) {
					$contents .= "                    IdList" . "\n";
					$idList = $orderReferenceDetails->getIdList();
					$memberList = $idList->getmember();
					foreach ($memberList as $member) {
						$contents .= "                        member: ".$member . "\n";;
					}
				}
				if ($orderReferenceDetails->isSetSellerOrderAttributes()) {
					$contents .= "                    SellerOrderAttributes" . "\n";
					$sellerOrderAttributes = $orderReferenceDetails->getSellerOrderAttributes();
					if ($sellerOrderAttributes->isSetSellerOrderId()) {
						$contents .= "                        SellerOrderId: ".$sellerOrderAttributes->getSellerOrderId() . "\n";
					}
					if ($sellerOrderAttributes->isSetStoreName()) {
						$contents .= "                        StoreName: ". $sellerOrderAttributes->getStoreName() . "\n";
					}
					if ($sellerOrderAttributes->isSetOrderItemCategories()) {
						$contents .= "                        OrderItemCategories" . "\n";
						$orderItemCategories = $sellerOrderAttributes->getOrderItemCategories();
						$orderItemCategoryList = $orderItemCategories->getOrderItemCategory();
						foreach ($orderItemCategoryList as $orderItemCategory) {
							$contents .= "                            OrderItemCategory: ". $orderItemCategory;
						}
					}
					if ($sellerOrderAttributes->isSetCustomInformation()) {
						$contents .= "                        CustomInformation: ".$sellerOrderAttributes->getCustomInformation() . "\n";
					}
				}
				if ($orderReferenceDetails->isSetOrderReferenceStatus()) {
					$contents .= "                    OrderReferenceStatus" . "\n";
					$orderReferenceStatus = $orderReferenceDetails->getOrderReferenceStatus();
					if ($orderReferenceStatus->isSetState()) {
						$contents .= "                        State: ". $orderReferenceStatus->getState() . "\n";
					}
					if ($orderReferenceStatus->isSetLastUpdateTimestamp()) {
						$contents .= "                        LastUpdateTimestamp: ".$orderReferenceStatus->getLastUpdateTimestamp() . "\n";
					}
					if ($orderReferenceStatus->isSetReasonCode()) {
						$contents .= "                        ReasonCode: ".$orderReferenceStatus->getReasonCode() . "\n";
					}
					if ($orderReferenceStatus->isSetReasonDescription()) {
						$contents .= "                        ReasonDescription: ".$orderReferenceStatus->getReasonDescription() . "\n";
					}
				}
				if ($orderReferenceDetails->isSetConstraints()) {
					$contents .= "                    Constraints" . "\n";
					$constraints = $orderReferenceDetails->getConstraints();
					$constraintList = $constraints->getConstraint();
					foreach ($constraintList as $constraint) {
						$contents .= "                        Constraint" . "\n";
						if ($constraint->isSetConstraintID()) {
							$contents .= "                            ConstraintID: ".$constraint->getConstraintID() . "\n";
						}
						if ($constraint->isSetDescription()) {
							$contents .= "                            Description: ". $constraint->getDescription() . "\n";
						}
					}
				}
				if ($orderReferenceDetails->isSetCreationTimestamp()) {
					$contents .= "                    CreationTimestamp: ".$orderReferenceDetails->getCreationTimestamp() . "\n";
				}
				if ($orderReferenceDetails->isSetExpirationTimestamp()) {
					$contents .= "                    ExpirationTimestamp: ".$orderReferenceDetails->getExpirationTimestamp() . "\n";
				}
				if ($orderReferenceDetails->isSetParentDetails()) {
					$contents .= "                    ParentDetails" . "\n";
					$parentDetails = $orderReferenceDetails->getParentDetails();
					if ($parentDetails->isSetId()) {
						$contents .= "                        Id: ". $parentDetails->getId() . "\n";
					}
					if ($parentDetails->isSetType()) {
						$contents .= "                        Type: ". $parentDetails->getType() . "\n";
					}
				}
			}
		}
		if ($this->amazonData->isSetResponseMetadata()) {
			$contents .= "            ResponseMetadata" . "\n";
			$responseMetadata = $this->amazonData->getResponseMetadata();
			if ($responseMetadata->isSetRequestId()) {
				$contents .= "                RequestId: ".$responseMetadata->getRequestId() . "\n";
			}
		}

		$contents .= "            ResponseHeaderMetadata: " . $this->amazonData->getResponseHeaderMetadata() . "\n";

		return $contents;
	}

}