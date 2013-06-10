<?php

if (!defined('_JEXEC'))
die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');

/**
 * Calculation plugin for quantity based price rules
 *
 * @version $Id:$
 * @package VirtueMart
 * @subpackage Plugins - avalara
 * @author Max Milbers
 * @copyright Copyright (C) 2012 iStraxx - All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 *
 *
 */

if (!class_exists('vmCalculationPlugin')) require(JPATH_VM_PLUGINS.DS.'vmcalculationplugin.php');

defined('AVATAX_DEBUG') or define('AVATAX_DEBUG', 1);

function avadebug($string,$arg=NULL){
	if(AVATAX_DEBUG) vmdebug($string,$arg);
}

class plgVmCalculationAvalara extends vmCalculationPlugin {

	var $_connectionType = 'Production';
	var $vmVersion = '2.0.22';

	function __construct(& $subject, $config) {

		parent::__construct($subject, $config);

		$varsToPush = array(
			'activated'          => array(0, 'int'),
			'company_code'       => array('', 'char'),
			'account'       => array('', 'char'),
			'license'     => array('', 'char'),
			'committ'   => array(0,'int'),
			'only_cart' => array(1,'int'),
            'dev' => array(0,'int'),
			'avatax_virtuemart_country_id'  => array(0,'int'),
            'avatax_virtuemart_state_id'  => array(0,'int'),
			'accrual'		=> array(0,'int'),
		);

		$this->setConfigParameterable ('calc_params', $varsToPush);

		$this->setPluginLoggable();
		$this->tableFields = array('id', 'virtuemart_order_id', 'client_ip', 'sentValue','recievedValue');
		$this->_tableId = 'id';
		$this->_tablepkey = 'id';
		$this->_tableId = 'id';
		if (JVM_VERSION === 2) {
			define ('VMAVALARA_PATH', JPATH_ROOT . DS . 'plugins' . DS . 'vmcalculation' . DS . 'avalara' );
		} else {
			define ('VMAVALARA_PATH', JPATH_ROOT . DS . 'plugins' . DS . 'vmcalculation' );
		}
		define('VMAVALARA_CLASS_PATH', VMAVALARA_PATH . DS . 'classes' );

		require(VMAVALARA_PATH.DS.'AvaTax.php');	// include in all Avalara Scripts

		if(!class_exists('ATConfig')) require (VMAVALARA_CLASS_PATH.DS.'ATConfig.class.php');

	}


	function  plgVmOnStoreInstallPluginTable($jplugin_name) {

	}


	/**
	 * Gets the sql for creation of the table
	 * @author Max Milbers
	 */
	public function getVmPluginCreateTableSQL() {

 		return "CREATE TABLE IF NOT EXISTS `" . $this->_tablename . "` (
 			    `id` mediumint(1) unsigned NOT NULL AUTO_INCREMENT ,
 			    `virtuemart_calc_id` mediumint(1) UNSIGNED DEFAULT NULL,
 			    `activated` int(1),
 			    `account` char(255),
 			    `license` char(255),
 			    `created_on` datetime NOT NULL default '0000-00-00 00:00:00',
 			    `created_by` int(11) NOT NULL DEFAULT 0,
 			    `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
 			    `modified_by` int(11) NOT NULL DEFAULT 0,
 			    `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
 			    `locked_by` int(11) NOT NULL DEFAULT 0,
 			     PRIMARY KEY (`id`),
 			     KEY `idx_virtuemart_calc_id` (`virtuemart_calc_id`)
 			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Table for avalara' AUTO_INCREMENT=1 ;";

	}


	function plgVmAddMathOp(&$entryPoints){
 		$entryPoints[] = array('calc_value_mathop' => 'avalara', 'calc_value_mathop_name' => 'Avalara');
	}

	function plgVmOnDisplayEdit(&$calc,&$html){

		$html .= '<fieldset>
	<legend>'.JText::_('VMCALCULATION_AVALARA').'</legend>
	<table class="admintable">';

		$html .= VmHTML::row('checkbox','VMCALCULATION_AVALARA_ACTIVATED','activated',$calc->activated);
		$html .= VmHTML::row('input','VMCALCULATION_AVALARA_COMPANY_CODE','company_code',$calc->company_code);
		$html .= VmHTML::row('input','VMCALCULATION_AVALARA_ACCOUNT','account',$calc->account);
		$html .= VmHTML::row('input','VMCALCULATION_AVALARA_LICENSE','license',$calc->license);
		$html .= VmHTML::row('checkbox','VMCALCULATION_AVALARA_COMMITT','committ',$calc->committ);
		$html .= VmHTML::row('checkbox','VMCALCULATION_AVALARA_ONLYCART','only_cart',$calc->only_cart);
        $html .= VmHTML::row('checkbox','VMCALCULATION_AVALARA_ACCRUAL','accrual',$calc->accrual);
		$html .= VmHTML::row('checkbox','VMCALCULATION_AVALARA_DEV','dev',$calc->dev);
		$label = 'VMCALCULATION_AVALARA_VADDRESS';
		$lang =JFactory::getLanguage();
		$label = $lang->hasKey($label.'_TIP') ? '<span class="hasTip" title="'.JText::_($label.'_TIP').'">'.JText::_($label).'</span>' : JText::_($label) ;
        	$html .= '
            <tr>
                <td class="key">
                    '.$label.'
                </td>
                <td>
                    '.shopfunctions::renderCountryList($calc->avatax_virtuemart_country_id,TRUE,array(),'avatax_').'
                </td>';


    /*   $countriesList = ShopFunctions::renderCountryList($calc->calc_countries,True);
                $this->assignRef('countriesList', $countriesList);
                $statesList = ShopFunctions::renderStateList($calc->virtuemart_state_ids,'', True);
                $this->assignRef('statesList', $statesList);

            $label = 'VMCALCULATION_AVALARA_VADDRESS';
            $lang =JFactory::getLanguage();
            $label = $lang->hasKey($label.'_TIP') ? '<span class="hasTip" title="'.JText::_($label.'_TIP').'">'.JText::_($label).'</span>' : JText::_($label) ;
         $html .= '
			<td>
				'.shopfunctions::renderStateList($calc->avatax_virtuemart_state_id,'avatax_',TRUE).'
			</td> */
        $html .= '</tr>';

		//$html .= VmHTML::row('checkbox','VMCALCULATION_AVALARA_VADDRESS','vAddress',$calc->vAddress);
	//	$html .= VmHTML::row('checkbox','VMCALCULATION_ISTRAXX_AVALARA_TRACE','trace',$calc->trace);

		$html .= '</table>';
		if ($calc->activated) {
			$html .= $this->ping($calc);
		}
		$html .= JText::_('VMCALCULATION_AVALARA_MANUAL').'</fieldset>';
		return TRUE;
	}

	/**
	 * We can only calculate it for the productdetails view
	 * @param $calculationHelper
	 * @param $rules
	 */
	public function plgVmInGatherEffectRulesProduct(&$calculationHelper,&$rules){

		//If in cart, the tax is calculated per bill, so the rule per product must be removed
		if($calculationHelper->inCart){
			foreach($rules as $k=>$rule){
				if($rule['calc_value_mathop']=='avalara'){
					unset($rules[$k]);
				}
			}
		}
	}



	public function plgVmStorePluginInternalDataCalc(&$data){

		if (!class_exists ('TableCalcs')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'tables' . DS . 'calcs.php');
		}
		if(!empty($data['avatax_virtuemart_country_id'])){
			$data['avatax_virtuemart_country_id'] = serialize($data['avatax_virtuemart_country_id']);
		}

		$db = JFactory::getDBO ();
		$table = new TableCalcs($db);
		$table->setUniqueName('calc_name');
		$table->setObligatoryKeys('calc_kind');
		$table->setLoggable();
		$table->setParameterable ($this->_xParams, $this->_varsToPushParam);
		$table->bindChecknStore($data);
	}

	public function plgVmGetPluginInternalDataCalc(&$calcData){

		$calcData->setParameterable ($this->_xParams, $this->_varsToPushParam);

		if (!class_exists ('VmTable')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmtable.php');
		}
		VmTable::bindParameterable ($calcData, $this->_xParams, $this->_varsToPushParam);
		if(!is_array($calcData->avatax_virtuemart_country_id)){
			//Suppress Warning
			$calcData->avatax_virtuemart_country_id = @unserialize($calcData->avatax_virtuemart_country_id);

		}
		return TRUE;
	}

	public function plgVmDeleteCalculationRow($id){
		$this->removePluginInternalData($id);
	}

	function newATConfig($calc){

		if(is_object($calc)){
			$calc = get_object_vars($calc);
		}
		if(!class_exists('TextCase')) require (VMAVALARA_CLASS_PATH.DS.'TextCase.class.php');

		$__wsdldir = VMAVALARA_CLASS_PATH."/wsdl";
		$standard = array(
			'url'       => 'no url specified',
			'addressService' => '/Address/AddressSvc.asmx',
			'taxService' => '/Tax/TaxSvc.asmx',
			'batchService'=> '/Batch/BatchSvc.asmx',
			'avacertService'=> '/AvaCert/AvaCertSvc.asmx',
			'addressWSDL' => 'file://'.$__wsdldir.'/Address.wsdl',
			'taxWSDL'  => 'file://'.$__wsdldir.'/Tax.wsdl',
			'batchWSDL'  => 'file://'.$__wsdldir.'/BatchSvc.wsdl',
			'avacertWSDL'  => 'file://'.$__wsdldir.'/AvaCertSvc.wsdl',
			'account'   => '<your account number here>',
			'license'   => '<your license key here>',
			'adapter'   => 'avatax4php,5.10.0.0',
			'client'    => 'VirtueMart'.$this->vmVersion,
			'name'    => 'PHPAdapter',
			'TextCase' => TextCase::$Mixed,
			'trace'     => TRUE);

		//VmConfig::$echoDebug = TRUE;
		//if(!is_object())avadebug($calc);
		if(!class_exists('ATConfig')) require (VMAVALARA_CLASS_PATH.DS.'ATConfig.class.php');

		//Set this to TRUE for development account
		if($calc['dev']){
			$this->_connectionType = 'Development';
			$devValues = array(
				'url'       => 'https://development.avalara.net',
				'account'   => $calc['account'],
				'license'   => $calc['license'],
				'trace'     => TRUE); // change to false for production
			$resultingConfig = array_merge($standard,$devValues);
			$config = new ATConfig($this->_connectionType, $resultingConfig);

		} else {
			$this->_connectionType = 'Production';
			$prodValues = array(
				'url'       => 'https://avatax.avalara.net',
				'account'   => $calc['account'],
				'license'   => $calc['license'],
				'trace'     => FALSE);
			$resultingConfig = array_merge($standard,$prodValues);
			$config = new ATConfig($this->_connectionType, $resultingConfig);
		}

		return $config;
	}

	function ping ($calc) {

		$html = '';
		$this->newATConfig($calc);

		if(!class_exists('TaxServiceSoap')) require (VMAVALARA_CLASS_PATH.DS.'TaxServiceSoap.class.php');
		$client = new TaxServiceSoap($this->_connectionType);

		try
		{
			if(!class_exists('PingResult')) require (VMAVALARA_CLASS_PATH.DS.'PingResult.class.php');
			$result = $client->ping("TEST");
			vmInfo('Avalara Ping ResultCode is: '. $result->getResultCode() );

			if(!class_exists('SeverityLevel')) require (VMAVALARA_CLASS_PATH.DS.'SeverityLevel.class.php');
			if($result->getResultCode() != SeverityLevel::$Success){
				foreach($result->Messages() as $msg){
					$html .= $msg->Name().": ".$msg->Summary()."<br />";
				}
			} else {
				vmInfo('Avalara used Ping Version is: '. $result->getVersion() );
			}
		}
		catch(SoapFault $exception)
		{

			$err = "Exception: ping ";
			if($exception)
				$err .= $exception->faultstring;

			$err .='<br />';
			$err .='last request: '. $client->__getLastRequest().'<br />';
			$err .='last response: '. $client->__getLastResponse().'<br />';
			vmError($err);
			avadebug('AvaTax the ping throws exception ',$exception);
		}

		return $html;
	}

	public function plgVmInterpreteMathOp ($calculationHelper, $rule, $price,$revert){

		$rule = (object)$rule;

		$mathop = $rule->calc_value_mathop;
		$tax = 0.0;

		if ($mathop=='avalara') {
			$requestedProductId = JRequest::getVar ('virtuemart_product_id',0);
			if(is_array($requestedProductId) and count($requestedProductId) > 0) {
				$requestedProductId = $requestedProductId[0];
			}
			$requestedProductId = (int) $requestedProductId;

			if(isset($calculationHelper->_product)){
				$productId = $calculationHelper->_product->virtuemart_product_id;
			} else {
				$productId = $requestedProductId;
			}
			//avadebug('plgVmInterpreteMathOp avalara ',$rule);
			if(($productId!=0 and $productId==$requestedProductId) or $calculationHelper->inCart ){
				VmTable::bindParameterable ($rule, $this->_xParams, $this->_varsToPushParam);
				if($rule->activated==0) return $price;
				if(empty($this->addresses)){
					$vmadd = $this->getShopperDataFromCart($rule);
					$this->addresses = $this->fillValidateAvalaraAddress($rule,$vmadd);
				}

				if($this->addresses){
					$products = $this->getCartProducts($calculationHelper,$price);
					if(!$products){
						$this->blockCheckout();
						return $price;
					}
					$tax = $this->getAvaTax( $rule,$products);
					if($calculationHelper->inCart){
						$prices =  $calculationHelper->getCartPrices();
						if(isset($prices['shipmentValue']) and isset(self::$_taxResult['shipmentTax'] )) {
							self::$_taxResult['salesPriceShipment'] = ($prices['shipmentValue'] + self::$_taxResult['shipmentTax'] );
							self::$_taxResult['paymentTax'] = 0.0;
						}

						$calculationHelper->setCartPricesMerge(self::$_taxResult);
					}
				}
			}
		}

		if($revert){
			$tax = -$tax;
		}

		return $price + (float)$tax;
	}

	function plgVmConfirmedOrder ($cart, $order) {

		$avaTaxRule = 0;
		if(isset($order['calc_rules'])){
			foreach($order['calc_rules'] as $rule){
				if($rule->calc_mathop == 'avalara' and $rule->calc_kind == 'taxRulesBill'){
					$avaTaxRule=$rule;
					break;
				}
			}
		}

		if($avaTaxRule!==0){
			if(!empty($avaTaxRule->calc_params)){
				VmTable::bindParameterable ($avaTaxRule, $this->_xParams, $this->_varsToPushParam);

				if($rule->activated==0)return false;
				if($rule->accrual==0)return false;
				if(empty($this->addresses)){
					$vmadd = $this->getShopperDataFromCart($rule);
					$this->addresses = $this->fillValidateAvalaraAddress($rule,$vmadd);
				}
				if($this->addresses){
					if (!class_exists ('calculationHelper')) require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'calculationh.php');

					$orderModel = VmModel::getModel('orders');
					$invoiceNumber = 'onr_'.$order['details']['BT']->order_number;
					JRequest::setVar('create_invoice',1);
					$orderModel -> createInvoiceNumber($order['details']['BT'],$invoiceNumber);
					$calculator = calculationHelper::getInstance ();

					avadebug('avatax plgVmConfirmedOrder $order',$invoiceNumber,$order);
					if(is_array($invoiceNumber)) $invoiceNumber = $invoiceNumber[0];
					$products = $this->getCartProducts($calculator,0);
					$tax = $this->getAvaTax( $rule,$products,$invoiceNumber,$order['details']['BT']->order_number);
					//Todo adjust for BE
					$prices =  $calculator->getCartPrices();
					if($prices) {
						self::$_taxResult['salesPriceShipment'] = ($prices['shipmentValue'] + self::$_taxResult['shipmentTax'] );
						self::$_taxResult['paymentTax'] = 0.0;
					}
					$calculator->setCartPricesMerge(self::$_taxResult);
				}
			}
		}

	}

	static $vmadd = NULL;
	private function getShopperDataFromCart($calc){

		if(!isset(self::$vmadd)){

			$view = JRequest::getWord('view',0);
			if($calc->only_cart == 1 and $view != 'cart'){
				self::$vmadd = FALSE;
				return self::$vmadd;
			}
			//We need for the tax calculation the shipment Address
			//We have this usually in our cart.
			if (!class_exists('VirtueMartCart')) require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
			$cart = VirtueMartCart::getCart();

			//Test first for ST
			if($cart->STsameAsBT){
				if(!empty($cart->BT)) $vmadd = $cart->BT;
			} else if(!empty($cart->ST)){
				$vmadd = $cart->ST;
			} else {
				if(!empty($cart->BT)) $vmadd = $cart->BT;
			}
			$vmadd['customer_number'] = $cart->customer_number;

			if(empty($vmadd) or !is_array($vmadd) or (is_array($vmadd) and count($vmadd) <2) ){
				vmInfo('VMCALCULATION_AVALARA_INSUF_INFO');
				$vmadd=FALSE;
			}

			self::$vmadd = $vmadd;
		}

		return self::$vmadd;
	}


	static $validatedAddresses = NULL;

	private function fillValidateAvalaraAddress($calc,$vmadd){

		if(!isset(self::$validatedAddresses)){

			if(!empty($vmadd)){

				if(is_object($calc)){
					$calc = get_object_vars($calc);
				}
				if(is_object($vmadd)){
					$vmadd = get_object_vars($vmadd);
				}
				//vmdebug('my $vmadd',$vmadd);
				//First country check
				if(empty($vmadd['virtuemart_country_id'])){

					self::$validatedAddresses = FALSE;
					return self::$validatedAddresses;
				} else {
					if(empty($calc['avatax_virtuemart_country_id'])){
						vmError('AvaTax, please select countries, to validate');
						self::$validatedAddresses = FALSE;
						return self::$validatedAddresses;
					} else {
						if(!is_array($calc['avatax_virtuemart_country_id'])){
							//Suppress Warning
							$calc['avatax_virtuemart_country_id'] = @unserialize($calc['avatax_virtuemart_country_id']);
						}
						if(!in_array($vmadd['virtuemart_country_id'],$calc['avatax_virtuemart_country_id'])){
							avadebug('fillValidateAvalaraAddress not validated, country not set');
							self::$validatedAddresses = FALSE;
							return self::$validatedAddresses;
						}

					}
				}
				$config = $this->newATConfig($calc);

				if(!class_exists('AddressServiceSoap')) require (VMAVALARA_CLASS_PATH.DS.'AddressServiceSoap.class.php');
				$client = new AddressServiceSoap($this->_connectionType,$config);

				if(!class_exists('Address')) require (VMAVALARA_CLASS_PATH.DS.'Address.class.php');
				$address = new Address();
				if(isset($vmadd['address_1'])) $address->setLine1($vmadd['address_1']);
				if(isset($vmadd['address_2'])) $address->setLine2($vmadd['address_2']);
				if(isset($vmadd['city'])) $address->setCity($vmadd['city']);

				if(isset($vmadd['virtuemart_country_id'])){

					$vmadd['country'] = ShopFunctions::getCountryByID($vmadd['virtuemart_country_id'],'country_2_code');
					if(isset($vmadd['country'])) $address->setCountry($vmadd['country']);
				}
				if(isset($vmadd['virtuemart_state_id'])){
					$vmadd['state'] = ShopFunctions::getStateByID($vmadd['virtuemart_state_id'],'state_2_code');
					if(isset($vmadd['state'])) $address->setRegion($vmadd['state']);
				}

				if(isset($vmadd['zip'])) $address->setPostalCode($vmadd['zip']);

				if(!class_exists('SeverityLevel')) require (VMAVALARA_CLASS_PATH.DS.'SeverityLevel.class.php');
				if(!class_exists('Message')) require (VMAVALARA_CLASS_PATH.DS.'Message.class.php');

				//if($calc->vAddress==0){
			/*	if(isset($vmadd['country']) and $vmadd['country']!= 'US' and $vmadd['country']!= 'CA'){

					self::$validatedAddresses = array($address);
					return self::$validatedAddresses;
				}*/

				$address->Coordinates = 1;
				$address->Taxability = TRUE;
				$textCase = TextCase::$Mixed;
				$coordinates = 1;

				$hash = md5(implode($vmadd,','));
				$session = JFactory::getSession ();
				$validatedAddress = $session->get ('vm_avatax_address_checked.' . $hash, FALSE, 'vm');
				if(!$validatedAddress){

					if(!class_exists('ValidateResult')) require (VMAVALARA_CLASS_PATH.DS.'ValidateResult.class.php');
					if(!class_exists('ValidateRequest')) require (VMAVALARA_CLASS_PATH.DS.'ValidateRequest.class.php');
					if(!class_exists('ValidAddress')) require (VMAVALARA_CLASS_PATH.DS.'ValidAddress.class.php');

					//TODO add customer code //shopper_number
					try
					{
						$request = new ValidateRequest($address, ($textCase ? $textCase : TextCase::$Default), $coordinates);
						vmSetStartTime('avaValAd');
						//avadebug('my request for validate address ',$request);
						$result = $client->Validate($request);
						vmTime('Avatax validate Address','avaValAd');
						//avadebug('Validate ResultCode is: '. $result->getResultCode());;
						if($result->getResultCode() != SeverityLevel::$Success)
						{
							foreach($result->getMessages() as $msg)
							{
								avadebug('fillValidateAvalaraAddress ' . $msg->getName().": ".$msg->getSummary()."\n");
							}
						}
						else
						{

							self::$validatedAddresses = $result->getvalidAddresses();
							$session->set ('vm_avatax_address_checked.' . $hash, TRUE, 'vm');
						}

					}
					catch(SoapFault $exception)
					{
						$msg = "Exception: fillValidateAvalaraAddress ";
						if($exception)
							$msg .= $exception->faultstring;

						$msg .= "\n";
						$msg .= $client->__getLastRequest()."\n";
						$msg .= $client->__getLastResponse()."\n";
						vmError($msg);
					}
				} else {
					self::$validatedAddresses[] = $address;

				}

				if(empty(self::$validatedAddresses)){
					self::$validatedAddresses = FALSE;
				}

				//then for BT and/or $cart->STsameAsBT
			} else {
				self::$validatedAddresses = FALSE;
			}
		}

		return self::$validatedAddresses;
	}

	private function getCartProducts($calculationHelper,$price){

		if($calculationHelper->inCart){

			if(!class_exists('VirtueMartCart')) require(JPATH_VM_SITE.DS.'helpers'.DS.'cart.php');
			$cart = VirtueMartCart::getCart();
			$count = count($cart->products);
			if($count===0){
				vmdebug('getCartProducts No Product');
				return false;
			}
			$products = $cart->products;
			$prices = $calculationHelper->getCartPrices();
			foreach($products as $k => &$product){
				$product = (array) $product;
				if(!empty($prices[$k]['discountedPriceWithoutTax'])){
					$price = $prices[$k]['discountedPriceWithoutTax'];
				} else if(!empty($prices[$k]['basePriceVariant'])){
					$price = $prices[$k]['basePriceVariant'];
				} else {
					avadebug('There is no price in getTax for product '.$k.' ',$prices);
					$price = 0.0;
				}
				$product['price'] = $price;

				if(!empty($price[$k]['discountAmount'])){
					$product['discount'] = $price[$k]['discountAmount'];
				} else {
					$product['discount'] = FALSE;
				}
			}

			if(!empty($cart->virtuemart_shipmentmethod_id)){
				$shipment = array();
				$shipment['product_sku'] = 'VMShipmentId_'.$cart->virtuemart_shipmentmethod_id;
				$shipmentModel = VmModel::getModel('Shipmentmethod');
				$shipmentModel->setId($cart->virtuemart_shipmentmethod_id);
				$shipmentMethod = $shipmentModel->getShipment();
				$shipment['product_name'] = $shipmentMethod->shipment_name;
				$shipment['amount'] = 1;
				$shipment['price'] = $prices['shipmentValue'];              //decimal // TotalAmmount
				$shipment['discount'] = 0.0;
				$products[] = $shipment;
			}
			$products['discountAmount'] = $prices['discountAmount'];
		} else {

			$calculationHelper->_product->price = $price;

			$products[0] = $calculationHelper->_product;
			if(!isset($products[0]->amount)){
				$products[0]->amount = 1;
			}

			if(isset($calculationHelper->productPrices['discountAmount'])){
				$products[0]->discount = $calculationHelper->productPrices['discountAmount'];
			} else {
				$products[0]->discount = FALSE;
			}
		}

		return $products;
	}

	private static $_taxResult = NULL;
	function getAvaTax($calc,$products,$invoiceNumber=false,$orderNumber = false){

		if($calc->activated==0) return false;

		if(count($products) == 0){
			$this->blockCheckout();
			return false;
		}

		if(!self::$validatedAddresses){
			$this->blockCheckout();
			return false;
		}

		$request = $this->createStandardRequest($calc,$products);

		if($orderNumber){
			$request->setPurchaseOrderNo($orderNumber);     //string Optional
		}

		$totalTax = 0.0;
		$hash = '';
		$session = JFactory::getSession ();
		if($calc->committ and $invoiceNumber){
			$request->setDocType(DocumentType::$SalesInvoice);   	// Only supported types are SalesInvoice or SalesOrder
			$request->setCommit(true);
			//invoice number, problem is that the invoice number is at this time not known, but the order_number may reachable
			$request->setDocCode($invoiceNumber);

			self::$_taxResult = FALSE;
			avadebug('Request as SalesInvoice with invoiceNumber '.$invoiceNumber);
		} else {

			$hash .= serialize(self::$vmadd). serialize($products);
			$hash = md5($hash);

			$request->setDocType(DocumentType::$SalesOrder);
			$request->setCommit(false);
			//invoice number, problem is that the invoice number is at this time not known, neither the order_number
			$request->setDocCode('VM'.$this->vmVersion.'_order_request');

			//Requests are allowed to be cached
			self::$_taxResult = $session->get ('vm_avatax_tax.' . $hash, FALSE, 'vm');
		}
		//vmdebug('my request ',$request);
		if(!self::$_taxResult){
			vmSetStartTime('avagetTax');
			self::$_taxResult = $this->executeRequest($request);
			vmTime('Avalara executeRequest hash '.$hash,'avagetTax');
			$session->set ('vm_avatax_tax.' . $hash,  serialize(self::$_taxResult), 'vm');
		} else {
			if(is_string(self::$_taxResult )){
				self::$_taxResult =  unserialize(self::$_taxResult);
			}
		}

		if(self::$_taxResult){
			if(isset(self::$_taxResult['totalTax'])){
				$totalTax = self::$_taxResult['totalTax'];
			}
		}

		return $totalTax;
	}

	function createStandardRequest($calc,$products,$sign=1){

		if(!class_exists('TaxServiceSoap')) require (VMAVALARA_CLASS_PATH.DS.'TaxServiceSoap.class.php');
		if(!class_exists('DocumentType')) require (VMAVALARA_CLASS_PATH.DS.'DocumentType.class.php');
		if(!class_exists('DetailLevel')) require (VMAVALARA_CLASS_PATH.DS.'DetailLevel.class.php');
		if(!class_exists('Line')) require (VMAVALARA_CLASS_PATH.DS.'Line.class.php');
		if(!class_exists('ServiceMode')) require (VMAVALARA_CLASS_PATH.DS.'ServiceMode.class.php');
		if(!class_exists('Line')) require (VMAVALARA_CLASS_PATH.DS.'Line.class.php');
		if(!class_exists('GetTaxRequest')) require (VMAVALARA_CLASS_PATH.DS.'GetTaxRequest.class.php');
		if(!class_exists('GetTaxResult')) require (VMAVALARA_CLASS_PATH.DS.'GetTaxResult.class.php');
		if(!class_exists('Address')) require (VMAVALARA_CLASS_PATH.DS.'Address.class.php');

		if(is_object($calc)){
			$calc = get_object_vars($calc);
		}
		$request= new GetTaxRequest();
		$origin = new Address();

		//In Virtuemart we have not differenct warehouses, but we have a shipment address
		//So when the vendor has a shipment address, we assume that it is his warehouse
		//Later we can combine products with shipment addresses for different warehouse (yehye, future music)
		//But for now we just use the BT address
		if (!class_exists ('VirtueMartModelVendor')) require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'vendor.php');

		$userId = VirtueMartModelVendor::getUserIdByVendorId ($calc['virtuemart_vendor_id']);
		$userModel = VmModel::getModel ('user');
		$virtuemart_userinfo_id = $userModel->getBTuserinfo_id ($userId);
		// this is needed to set the correct user id for the vendor when the user is logged
		$userModel->getVendor($calc['virtuemart_vendor_id']);
		$vendorFieldsArray = $userModel->getUserInfoInUserFields ('mail', 'BT', $virtuemart_userinfo_id, FALSE, TRUE);
		$vendorFields = $vendorFieldsArray[$virtuemart_userinfo_id];
		//avadebug('my vendor fields',$vendorFields);
		$origin->setLine1($vendorFields['fields']['address_1']['value']);
		$origin->setLine2($vendorFields['fields']['address_2']['value']);
		$origin->setCity($vendorFields['fields']['city']['value']);

		$origin->setCountry($vendorFields['fields']['virtuemart_country_id']['country_2_code']);
		$origin->setRegion($vendorFields['fields']['virtuemart_state_id']['state_2_code']);
		$origin->setPostalCode($vendorFields['fields']['zip']['value']);

		$request->setOriginAddress($origin);	      //Address

		if(isset($this->addresses[0])){
			$destination = $this->addresses[0];
		} else {
			return FALSE;
		}
		$request->setDestinationAddress	($destination);     //Address
		$request->setCompanyCode($calc['company_code']);   // Your Company Code From the Dashboard
		$request->setDocDate(date('Y-m-d'));           //date
		$request->setCustomerCode(self::$vmadd['customer_number']);  //string Required

		if(isset(self::$vmadd['tax_usage_type'])){
			$request->setCustomerUsageType(self::$vmadd['tax_usage_type']);   //string   Entity Usage
		}

		if(isset(self::$vmadd['tax_exemption_number'])){
			$request->setExemptionNo(self::$vmadd['tax_exemption_number']);         //string   if not using ECMS which keys on customer code
		}

		if(isset(self::$vmadd['taxOverride'])){
			$request->setTaxOverride(self::$vmadd['taxOverride']);
		}
		if(!empty($products['discountAmount'])){
			$request->setDiscount($products['discountAmount']);            //decimal
			unset($products['discountAmount']);
		}

		$request->setDetailLevel('Tax');         //Summary or Document or Line or Tax or Diagnostic

		$lines = array();
		$n = 0;
		$this->_lineNumbersToCartProductId = array();

		foreach($products as $k=>$product){

			//Yehyeh nasty hack
			if($k==='discountAmount'){
				continue;
			}

			$n++;
			$this->_lineNumbersToCartProductId[$n] = $k;
			$line = new Line();
			$line->setNo ($n);                  //string  // line Number of invoice
			$line->setItemCode($product['product_sku']);            //string
			$line->setDescription($product['product_name']);         //product description, like in cart, atm only the name, todo add customfields

			if(!empty($product['categories'])){

				//avadebug('AvaTax setTaxCode Product has categories !',$catNames);
				if (!class_exists ('TableCategories')) {
					require(JPATH_VM_ADMINISTRATOR . DS . 'tables' . DS . 'categories.php');
				}
				$db = JFactory::getDbo();
				$catTable = new TableCategories($db);
				foreach($product['categories'] as $cat){
					$catTable->load ($cat);
					$catslug = $catTable->slug;

					if(strpos($catslug,'avatax-')!==FALSE){
						$taxCode = substr($catslug,7);
						if(!empty($taxCode)){
							$line->setTaxCode($taxCode);
						} else {
							vmError('AvaTax setTaxCode, category could not be parsed '.$catslug);
						}

						break;
					}
				}
			}
			//$line->setTaxCode("");             //string
			$line->setQty($product['amount']);                 //decimal
			$line->setAmount($sign * $product['price'] * $product['amount']);              //decimal // TotalAmmount
			$line->setDiscounted($product['discount'] * $product['amount']);          //boolean

			$line->setRevAcct("");             //string
			$line->setRef1("");                //string
			$line->setRef2("");                //string

			if(isset(self::$vmadd['tax_usage_type'])){
				$line->setCustomerUsageType(self::$vmadd['tax_usage_type']);   //string   Entity Usage
			}

			if(isset(self::$vmadd['tax_exemption_number'])){
				$line->setExemptionNo(self::$vmadd['tax_exemption_number']);         //string   if not using ECMS which keys on customer code
			}

			if(isset(self::$vmadd['taxOverride'])){
				$line->setTaxOverride(self::$vmadd['taxOverride']);
			}

			$lines[] = $line;
		}

		$request->setLines($lines);

		return $request;
	}

	function executeRequest($request){

		$prices = array();
		$client = new TaxServiceSoap($this->_connectionType);
		try
		{
			if(!class_exists('TaxLine')) require (VMAVALARA_CLASS_PATH.DS.'TaxLine.class.php');
			if(!class_exists('TaxDetail')) require (VMAVALARA_CLASS_PATH.DS.'TaxDetail.class.php');

			avadebug('executeRequest $request',$request);
			$_taxResult = $client->getTax($request);
			avadebug('executeRequest $_taxResult',$_taxResult);
			if ($_taxResult->getResultCode() == SeverityLevel::$Success){

				//avadebug("DocCode: ".$request->getDocCode() );
				//avadebug("DocId: ".self::$_taxResult->getDocId()."\n");
				//avadebug("TotalAmount: ".self::$_taxResult->getTotalAmount() );

				$totalTax = $_taxResult->getTotalTax();
				$taxlines = $_taxResult->getTaxLines();
				$taxlinexCount = count($taxlines);
				//avadebug('my $request, $taxlines',$taxlines);

				foreach($taxlines as $ctl){

					$nr = $ctl->getNo();
					if(isset($this->_lineNumbersToCartProductId[$nr]) and $nr <= $taxlinexCount){

						$line = $request->getLine($nr);
						//vmdebug('my $line',$line);

						if(strpos($line->getItemCode(),'VMShipmentId')===0){
							$prices['shipmentTax'] = $ctl->getTax();
							$totalTax = $totalTax - $ctl->getTax();
						} else {
							$quantity = $line->getQty();
							//avadebug('my $request qty ',$quantity);
							//on the long hand, the taxAmount must be replaced by taxAmountQuantity to avoid rounding errors
							$prices[$this->_lineNumbersToCartProductId[$nr]]['taxAmount'] = $ctl->getTax()/$quantity;
							$prices[$this->_lineNumbersToCartProductId[$nr]]['taxAmountQuantity'] = $ctl->getTax();
						}
					} else {
						avadebug('got more lines back, then requested => my $ctl',$ctl);
					}
				}
				$prices['totalTax'] = $totalTax;
			}
			else {
				$this->blockCheckout();
				foreach($_taxResult->getMessages() as $msg){
					vmError($msg->getName().": ".$msg->getSummary(),'AvaTax Error '.$msg->getSummary());
				}
				vmdebug('Error, but no exception in getAvaTax',self::$_taxResult);
			}
		}
		catch(SoapFault $exception)
		{
			$this->blockCheckout();
			$msg = "Exception: in getAvaTax, while executeRequest ";
			if($exception) $msg .= $exception->faultstring;
			avadebug( $msg,$request,$client->__getLastRequest(),$client->__getLastResponse());
		}

		return $prices;
	}

	public function plgVmOnUpdateOrderPayment($data,$old_order_status){

		if($data->order_status=='X'){
			avadebug('plgVmOnUpdateOrderPayment cancel order for Avatax '.$old_order_status,$data->order_status);
			$this->cancelOrder($data,$old_order_status);
		}

		$toInvoice = VmConfig::get('inv_os',array('C'));
		if(!is_array($toInvoice)) $toInvoice = (array)$toInvoice;
		if($data->order_status=='R' or in_array($data->order_status,$toInvoice)){
			$this->creditMemo($data);
		}
	}

	private function creditMemo($data){

		$orderModel = VmModel::getModel('orders');
		$orderDetails = $orderModel->getOrder($data->virtuemart_order_id);
		$calc = $this->getOrderCalc($orderDetails);
		if(!$calc) return false;

		if(!is_array($calc['avatax_virtuemart_country_id'])){
			$calc['avatax_virtuemart_country_id'] = @unserialize($calc['avatax_virtuemart_country_id']);
		}

		if($calc['activated']==0){
			avadebug('Avatax creditMemo rule not activated',$calc);
			return false;
		}

		//if($calc['accrual'] and $data->order_status == 'C'){
		/*$toInvoice = VmConfig::get('inv_os',array('C'));
		if(!is_array($toInvoice)) $toInvoice = (array)$toInvoice;
		if($calc['accrual'] and in_array($data->order_status,$toInvoice)){*/
		if($calc['accrual'] and $data->order_status != 'R'){
			avadebug('Avatax creditMemo, type is accrual and not a Refund',$calc);
			return false;
		}

		if(!class_exists('TaxServiceSoap')) require (VMAVALARA_CLASS_PATH.DS.'TaxServiceSoap.class.php');
		if(!class_exists('DocumentType')) require (VMAVALARA_CLASS_PATH.DS.'DocumentType.class.php');
		if(!class_exists('DetailLevel')) require (VMAVALARA_CLASS_PATH.DS.'DetailLevel.class.php');
		if(!class_exists('Line')) require (VMAVALARA_CLASS_PATH.DS.'Line.class.php');
		if(!class_exists('ServiceMode')) require (VMAVALARA_CLASS_PATH.DS.'ServiceMode.class.php');
		if(!class_exists('Line')) require (VMAVALARA_CLASS_PATH.DS.'Line.class.php');
		if(!class_exists('GetTaxResult')) require (VMAVALARA_CLASS_PATH.DS.'GetTaxResult.class.php');

		$this->addresses = $this->fillValidateAvalaraAddress($calc,$orderDetails['details']['BT']);

		if(!$this->addresses){
			vmdebug('Avatax: on order status update: no valid addresses');
			return false;
		}

		if(is_object($orderDetails['details']['BT'])){
			self::$vmadd = get_object_vars($orderDetails['details']['BT']);
		} else {
			self::$vmadd = $orderDetails['details']['BT'];
		}

		$toInvoice = VmConfig::get('inv_os',array('C'));
		if(!is_array($toInvoice)) $toInvoice = (array)$toInvoice;
		if($calc['accrual'] and in_array($data->order_status,$toInvoice)){
			$taxOverride = $orderDetails['details']['BT']->created_on;	//date of the order? or the actual date?
		} else if($data->order_status=='R'){
			$taxOverride = $orderDetails['details']['BT']->created_on;
		} else {
			$taxOverride = null;
		}
		self::$vmadd['taxOverride'] = $taxOverride;

		//create the products
		$products = array();
		foreach($orderDetails['items'] as $k => $item){
			$product = array();
			$item = (array)$item;
			$product['product_sku'] = $item['order_item_sku'];
			$product['product_name'] = $item['order_item_name'];
			$product['amount'] = $item['product_quantity'];
			$product['price'] = $item['product_item_price'];
			$product['discount'] = $item['product_subtotal_discount'];
			$model = VmModel::getModel('product');
			$rProduct = $model->getProduct($item['virtuemart_product_id']);
			$product['categories'] = $rProduct->categories;
			$products[] = $product;
		}
		if(!empty($orderDetails['details']['BT']->virtuemart_shipmentmethod_id)){
			$shipment = array();
			$shipment['product_sku'] = 'VMShipmentId_'.$orderDetails['details']['BT']->virtuemart_shipmentmethod_id;
			$shipmentModel = VmModel::getModel('Shipmentmethod');
			$shipmentModel->setId($orderDetails['details']['BT']->virtuemart_shipmentmethod_id);
			$shipmentMethod = $shipmentModel->getShipment();
			$shipment['product_name'] = $shipmentMethod->shipment_name;
			$shipment['amount'] = 1;
			$shipment['price'] = $orderDetails['details']['BT']->order_shipment;              //decimal // TotalAmmount
			$shipment['discount'] = 0.0;
			$products[] = $shipment;
		}
		$products['discountAmount'] = $orderDetails['details']['BT']->order_discountAmount;

		if($data->order_status=='R') {
			$sign = -1;
		} else {
			$sign = 1;
		}

		$request = $this->createStandardRequest($calc,$products,$sign);

		$request->setCompanyCode($calc['company_code']);   // Your Company Code From the Dashboard
		$request->setDocDate(date('Y-m-d'));           //date
		$request->setCustomerCode($orderDetails['details']['BT']->customer_number);  //string Required

		$totalTax = 0.0;

		$invoiceNumber = 'onr_'.$orderDetails['details']['BT']->order_number;
		JRequest::setVar('create_invoice',1);
		$orderModel -> createInvoiceNumber($orderDetails['details']['BT'],$invoiceNumber);

		if($calc['committ'] and $invoiceNumber){
			$request->setDocType(DocumentType::$SalesInvoice);   	// Only supported types are SalesInvoice or SalesOrder
			$request->setCommit(true);
			//invoice number, problem is that the invoice number is at this time not known, but the order_number may reachable
			//$request->setDocCode($invoiceNumber);
			self::$_taxResult = FALSE;
		}

		vmSetStartTime('avagetTax');
		self::$_taxResult = $this->executeRequest($request);
		vmTime('Avalara executeRequest ','avagetTax');

		if(self::$_taxResult){
			if(isset(self::$_taxResult['totalTax'])){
				$totalTax = self::$_taxResult['totalTax'];
			}
		}

		return $totalTax;
	}

	private function cancelOrder($data,$old_order_status){

		if(empty($data->invoice_number)) return false;

		if(!function_exists('EnsureIsArray')) require(VMAVALARA_PATH.DS.'AvaTax.php');	// include in all Avalara Scripts
		if(!class_exists('TaxServiceSoap')) require (VMAVALARA_CLASS_PATH.DS.'TaxServiceSoap.class.php');
		if(!class_exists('CancelTaxRequest')) require (VMAVALARA_CLASS_PATH.DS.'CancelTaxRequest.class.php');

		$orderModel = VmModel::getModel('orders');
		$orderDetails = $orderModel->getOrder($data->virtuemart_order_id);
		$calc = $this->getOrderCalc($orderDetails);
		if(!$calc) return false;

		$this->newATConfig($calc);

		$client = new TaxServiceSoap($this->_connectionType);
		$request= new CancelTaxRequest();

		$request->setDocCode($calc['invoice_number']);
		$request->setDocType('SalesInvoice');

		$request->setCompanyCode($calc['company_code']);	// Dashboard Company Code

		if($calc['committ']==0) return false;

		//CancelCode: Enter D for DocDeleted, or P for PostFailed: [D]
		//I do not know the difference, I use always D (I assume this means order got deleted, cancelled, or refund)
		$code = CancelCode::$DocDeleted;

		$request->setCancelCode($code);

		try
		{
			avadebug('plgVmOnCancelPayment used request',$request);
			$result = $client->cancelTax($request);

			if ($result->getResultCode() != "Success")
			{
				$msg = '';
				foreach($result->getMessages() as $rmsg)
				{
					$msg .= $rmsg->getName().": ".$rmsg->getSummary()."\n";
				}
				vmError($msg);
			} else {
				vmInfo('CancelTax ResultCode is: '.$result->getResultCode());
			}
		}
		catch(SoapFault $exception)
		{
			$msg = "Exception: ";
			if($exception)
				$msg .= $exception->faultstring;

			$msg .="\n";
			$msg .= $client->__getLastRequest()."\n";
			$msg .= $client->__getLastResponse()."\n";
			vmError($msg);
		}

	}

	private function getOrderCalc($orderDetails){
		$calc = 0;
		if(!empty($orderDetails['calc_rules'])){
			foreach($orderDetails['calc_rules'] as $rule){
				if($rule->calc_kind=='taxRulesBill' and $rule->calc_mathop == 'avalara'){
					$calc = $rule;
					break;
				}
			}
		}
		if(empty($calc)){
			avadebug('Retrieving calculation rule for avatax failed',$orderDetails->virtuemart_order_id);
			return false;
		}

		if(is_object($calc)){
			$calc = get_object_vars($calc);
		}
		if(!empty($calc['calc_params'])){
			VmTable::bindParameterable ($calc, $this->_xParams, $this->_varsToPushParam);
			return $calc;
		} else {
			avadebug('rule had no parameters',$calc);
			return false;
		}
	}

	public function blockCheckout(){

		$app = JFactory::getApplication();
		if($app->isSite()){
			if (!class_exists('VirtueMartCart')) require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
			$cart = VirtueMartCart::getCart();
			$cart->blockConfirm();
		}

	}
}

// No closing tag
