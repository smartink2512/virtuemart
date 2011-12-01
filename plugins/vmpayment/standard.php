<?php

if (!defined('_VALID_MOS') && !defined('_JEXEC'))
die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');

/**
 * @version $Id: standard.php,v 1.4 2005/05/27 19:33:57 ei
 *
 * a special type of 'cash on delivey':
 * @author Max Milbers
 * @version $Id$
 * @package VirtueMart
 * @subpackage payment
 * @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */

if(!class_exists('vmPSPlugin')) require(JPATH_VM_PLUGINS.DS.'vmpsplugin.php');

class plgVmPaymentStandard extends vmPSPlugin {


	// instance of class
	public static $_this = false;

	function __construct(& $subject, $config) {
		if(self::$_this) return self::$_this;
		parent::__construct($subject, $config);

		$this->_loggable = true;
		$this->tableFields = array('id','virtuemart_order_id','order_number','virtuemart_paymentmethod_id',
						'payment_name','cost','cost','tax_id');//,'created_on','created_by','modified_on','modified_by','locked_on');

		$varsToPush = array('payment_logos'=>array('','char'),
							  	'countries'=>array(0,'int'),
							  	'min_amount'=>array(0,'int'),
								'max_amount'=>array(0,'int'),
								'cost'=>array(0,'int'),
								'tax_id'=>array(0,'int'),
								'payment_info'=>array('','string')
	);

	$this->setConfigParameterable($this->_configTableFieldName,$varsToPush);



		self::$_this = $this;
	}

	/**
	 * Create the table for this plugin if it does not yet exist.
	 * @author Valérie Isaksen
	 */
	protected function getVmPluginCreateTableSQL() {

		return "CREATE TABLE IF NOT EXISTS `".$this->_tablename."` (
	    `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
	    `virtuemart_order_id` int(11) UNSIGNED DEFAULT NULL,
	    `order_number` char(32) DEFAULT NULL,
	    `virtuemart_paymentmethod_id` mediumint(1) UNSIGNED DEFAULT NULL,
	    `payment_name` char(255) NOT NULL DEFAULT '',
	    `cost` decimal(10,2) DEFAULT NULL ,
	    `tax_id` smallint(11) DEFAULT NULL,
	    `created_on` datetime NOT NULL default '0000-00-00 00:00:00',
	    `created_by` int(11) NOT NULL DEFAULT 0,
	    `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	    `modified_by` int(11) NOT NULL DEFAULT 0,
	    `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	    `locked_by` int(11) NOT NULL DEFAULT 0,
	      PRIMARY KEY (`id`)
	    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Payment Standard Table' AUTO_INCREMENT=1 ;";

	}


	/**
	 * Reimplementation of vmPaymentPlugin::plgVmConfirmedOrderRenderPaymentForm()
	 *
	 * @author Valérie Isaksen
	 */
	function plgVmConfirmedOrder($psType,VirtueMartCart $cart, $order, $return_context) {
		if (!$this->selectedThisType($psType)) {
			return null;
		}
		 if (!($method = $this->getVmPluginMethod($cart->virtuemart_paymentmethod_id))) {
			return null; // Another method was selected, do nothing
		}
		if (!$this->selectedThisElement($method->payment_element)) {
		    return false;
		}
// 		$params = new JParameter($payment->payment_params);
		$lang = JFactory::getLanguage();
		$filename = 'com_virtuemart';
		$lang->load($filename, JPATH_ADMINISTRATOR);
		$vendorId = 0;

		$payment_info = $method->payment_info;

		$html = "";
		$new_status = false;

		if (!class_exists('VirtueMartModelOrders'))
		require( JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'orders.php' );

		// END printing out HTML Form code (Payment Extra Info)
		$order_number= $order->getOrderNumber($cart->virtuemart_order_id);

		$this->_virtuemart_paymentmethod_id = $cart->virtuemart_paymentmethod_id;
		$dbValues['payment_name'] = parent::renderPluginName($method);
		$dbValues['order_number'] = $order_number;
		$dbValues['virtuemart_paymentmethod_id'] = $this->_virtuemart_paymentmethod_id;
		$dbValues['cost'] = $method->cost;
		$dbValues['tax_id'] = $method->tax_id;
		$this->storePSPluginInternalData($dbValues);

		$html = '<table>' . "\n";
		$html .= $this->getHtmlRow('STANDARD_PAYMENT_INFO', $dbValues['payment_name']);
		if (!empty($payment_info)) {
			$html .= $this->getHtmlRow('STANDARD_INFO', $payment_info);
		}

		$html .= $this->getHtmlRow('STANDARD_ORDER_NUMBER', $order_number);
		$html .= $this->getHtmlRow('STANDARD_AMOUNT', $cart->prices['billTotal']);


		$html .= '</table>' . "\n";

		return $this->processConfirmedOrderPaymentResponse(true,$cart, $order, $html,$new_status);
// 		return true;  // empty cart, send order
	}

	/**
	 * Display stored payment data for an order
	 * @see components/com_virtuemart/helpers/vmPaymentPlugin::plgVmOnShowOrderBE()
	 */
	function plgVmOnShowOrderBE($psType, $virtuemart_order_id, $virtuemart_payment_id) {
		if (!$this->selectedThisByMethodId($psType, $virtuemart_payment_id)) {
			return null; // Another method was selected, do nothing
		}
		$db = JFactory::getDBO();
		$q = 'SELECT * FROM `' . $this->_tablename . '` '
		. 'WHERE `virtuemart_order_id` = ' . $virtuemart_order_id;
		$db->setQuery($q);
		if (!($paymentTable = $db->loadObject())) {
			JError::raiseWarning(500, $db->getErrorMsg());
			return '';
		}

		$html = '<table class="admintable">' . "\n";
		$html .=$this->getHtmlHeaderBE();
		$html .= $this->getHtmlRowBE('STANDARD_PAYMENT_NAME', $paymentTable->payment_name);

		$html .= '</table>' . "\n";
		return $html;
	}

	 function getCosts(VirtueMartCart $cart, $method, $cart_prices) {
		return $method->cost;
	}

	/**
	 * Check if the payment conditions are fulfilled for this payment method
	 * @author: Valerie Isaksen
	 *
	 * @param $cart_prices: cart prices
	 * @param $payment
	 * @return true: if the conditions are fulfilled, false otherwise
	 *
	 */
	 function checkConditions($cart, $method, $cart_prices) {

// 		$params = new JParameter($payment->payment_params);
		$address = (($cart->ST == 0) ? $cart->BT : $cart->ST);

		$amount = $cart_prices['salesPrice'];
		$amount_cond = ($amount >= $method->min_amount AND $amount <= $method->max_amount
		OR
		($method->min_amount <= $amount AND ($method->max_amount == 0) ));
		if (!$amount_cond) {
		    return false;
		}
		$countries = array();
		if (!empty($method->countries)) {
		    if (!is_array($method->countries)) {
			$countries[0] = $method->countries;
		    } else {
			$countries = $method->countries;
		    }
		}

		// probably did not gave his BT:ST address
		if (!is_array($address)) {
			$address = array();
			$address['virtuemart_country_id'] = 0;
		}

		if (!isset($address['virtuemart_country_id']))
		$address['virtuemart_country_id'] = 0;
		if (count($countries) == 0  || in_array($address['virtuemart_country_id'], $countries) || count($countries) == 0) {
				return true;
		}

		return false;
	}
 /**
	 * Create the table for this plugin if it does not yet exist.
	 * This functions checks if the called plugin is active one.
	 * When yes it is calling the standard method to create the tables
	 * @author Valérie Isaksen
	 *
	 */

    function plgVmOnStoreInstallPluginTable($psType, $jplugin_id) {
		 return parent::plgVmOnStoreInstallPluginTable($psType, $jplugin_id) ;
}


	/**
	 * This event is fired after the payment method has been selected. It can be used to store
	 * additional payment info in the cart.
	 *
	 * @author Max Milbers
	 * @author Valérie isaksen
	 *
	 * @param VirtueMartCart $cart: the actual cart
	 * @return null if the payment was not selected, true if the data is valid, error message if the data is not vlaid
	 *
	 */
	public function plgVmOnSelectCheck($psType, VirtueMartCart $cart) {
		return parent::plgVmOnSelectCheck($psType,   $cart);
	}

	/**
	 * plgVmDisplayListFE
	 * This event is fired to display the pluginmethods in the cart (edit shipment/payment) for exampel
	 *
	 * @param object $cart Cart object
	 * @param integer $selected ID of the method selected
	 * @return boolean True on succes, false on failures, null when this plugin was not selected.
	 * On errors, JError::raiseWarning (or JError::raiseError) must be used to set a message.
	 *
	 * @author Valerie Isaksen
	 * @author Max Milbers
	 */
	public function plgVmDisplayListFE($psType, VirtueMartCart $cart, $selected = 0) {
		 return parent::plgVmDisplayListFE($psType,  $cart, $selected );
	}

	/*
	 * plgVmOnSelectedCalculatePrice
	* Calculate the price (value, tax_id) of the selected method
	* It is called by the calculator
	* This function does NOT to be reimplemented. If not reimplemented, then the default values from this function are taken.
	* @author Valerie Isaksen
	* @cart: VirtueMartCart the current cart
	* @cart_prices: array the new cart prices
	* @return null if the method was not selected, false if the shiiping rate is not valid any more, true otherwise
	*
	*
	*/

	public function plgVmOnSelectedCalculatePrice($psType, VirtueMartCart $cart, array &$cart_prices, &$cart_prices_name) {
		 return parent::plgVmOnSelectedCalculatePrice($psType, $cart,  $cart_prices, $cart_prices_name);
	}

	/**
	 * plgVmOnCheckAutomaticSelected
	 * Checks how many plugins are available. If only one, the user will not have the choice. Enter edit_xxx page
	 * The plugin must check first if it is the correct type
	 * @author Valerie Isaksen
	 * @param VirtueMartCart cart: the cart object
	 * @return null if no plugin was found, 0 if more then one plugin was found,  virtuemart_xxx_id if only one plugin is found
	 *
	 */
	function plgVmOnCheckAutomaticSelected($psType, VirtueMartCart $cart, array $cart_prices = array()) {
		 return parent::plgVmOnCheckAutomaticSelected($psType,   $cart,  $cart_prices );
	}

	/**
	 * This method is fired when showing the order details in the frontend.
	 * It displays the method-specific data.
	 *
	 * @param integer $order_id The order ID
	 * @return mixed Null for methods that aren't active, text (HTML) otherwise
	 * @author Max Milbers
	 * @author Valerie Isaksen
	 */
	protected function plgVmOnShowOrderFE($psType, $virtuemart_order_id) {
		return parent::plgVmOnShowOrderFE($psType, $virtuemart_order_id);
	}



	/**
	 * This event is fired during the checkout process. It can be used to validate the
	 * method data as entered by the user.
	 *
	 * @return boolean True when the data was valid, false otherwise. If the plugin is not activated, it should return null.
	 * @author Max Milbers
	 */
	public function plgVmOnCheckoutCheckData($psType, VirtueMartCart $cart) {
		return parent::plgVmOnCheckoutCheckData($psType, $cart);
	}



	/**
	 * This method is fired when showing when priting an Order
	 * It displays the the payment method-specific data.
	 *
	 * @param integer $_virtuemart_order_id The order ID
	 * @param integer $method_id  method used for this order
	 * @return mixed Null when for payment methods that were not selected, text (HTML) otherwise
	 * @author Valerie Isaksen
	 */
	function plgVmOnShowOrderPrint($order_number, $method_id) {
		return parent::plgVmOnShowOrderPrint($order_number, $method_id);
	}


	//Notice: We only need to add the events, which should work for the specific plugin, when an event is doing nothing, it should not be added

	/**
	 * Save updated order data to the method specific table
	 *
	 * @param array $_formData Form data
	 * @return mixed, True on success, false on failures (the rest of the save-process will be
	 * skipped!), or null when this method is not actived.
	 * @author Oscar van Eijk
	 *
	public function plgVmOnUpdateOrder($psType, $_formData) {
		return null;
	}

	/**
	 * Save updated orderline data to the method specific table
	 *
	 * @param array $_formData Form data
	 * @return mixed, True on success, false on failures (the rest of the save-process will be
	 * skipped!), or null when this method is not actived.
	 * @author Oscar van Eijk
	 *
	public function plgVmOnUpdateOrderLine($psType, $_formData) {
		return null;
	}

	/**
	 * plgVmOnEditOrderLineBE
	 * This method is fired when editing the order line details in the backend.
	 * It can be used to add line specific package codes
	 *
	 * @param integer $_orderId The order ID
	 * @param integer $_lineId
	 * @return mixed Null for method that aren't active, text (HTML) otherwise
	 * @author Oscar van Eijk
	 *
	public function plgVmOnEditOrderLineBE($psType, $_orderId, $_lineId) {
		return null;
	}

	/**
	 * This method is fired when showing the order details in the frontend, for every orderline.
	 * It can be used to display line specific package codes, e.g. with a link to external tracking and
	 * tracing systems
	 *
	 * @param integer $_orderId The order ID
	 * @param integer $_lineId
	 * @return mixed Null for method that aren't active, text (HTML) otherwise
	 * @author Oscar van Eijk
	 *
	public function plgVmOnShowOrderLineFE($psType, $_orderId, $_lineId) {
		return null;
	}

	/**
	 * This event is fired when the  method notifies you when an event occurs that affects the order.
	 * Typically,  the events  represents for payment authorizations, Fraud Management Filter actions and other actions,
	 * such as refunds, disputes, and chargebacks.
	 *
	 * NOTE for Plugin developers:
	 *  If the plugin is NOT actually executed (not the selected payment method), this method must return NULL
	 *
	 * @param $return_context: it was given and sent in the payment form. The notification should return it back.
	 * Used to know which cart should be emptied, in case it is still in the session.
	 * @param int $virtuemart_order_id : payment  order id
	 * @param char $new_status : new_status for this order id.
	 * @return mixed Null when this method was not selected, otherwise the true or false
	 *
	 * @author Valerie Isaksen
	 *
	 *
	public function plgVmOnNotification($psType, &$return_context, &$virtuemart_order_id, &$new_status) {
		return null;
	}

	/**
	 * plgVmOnResponseReceived
	 * This event is fired when the  method returns to the shop after the transaction
	 *
	 *  the method itself should send in the URL the parameters needed
	 * NOTE for Plugin developers:
	 *  If the plugin is NOT actually executed (not the selected payment method), this method must return NULL
	 *
	 * @param int $virtuemart_order_id : should return the virtuemart_order_id
	 * @param text $html: the html to display
	 * @return mixed Null when this method was not selected, otherwise the true or false
	 *
	 * @author Valerie Isaksen
	 *
	 *
	function plgVmOnResponseReceived($psType, &$virtuemart_order_id, &$html) {
		return null;
	}
*/
}

// No closing tag
