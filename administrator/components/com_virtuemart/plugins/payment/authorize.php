<?php
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
* The ps_authorize class, containing the payment processing code
*  for transactions with authorize.net 
*
* @version $Id: authorize.php 1760 2009-05-03 22:58:57Z Aravot $
* @package JMart
* @subpackage payment
* @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* JMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_jmart/COPYRIGHT.php for copyright notices and details.
*
* http://joomlacode.org/gf/project/jmart/
*/

class plgPaymentAuthorize extends vmPaymentPlugin {

	var $payment_code = "AN";
	
	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param object $subject The object to observe
	 * @param array  $config  An array that holds the plugin configuration
	 * @since 1.5
	 */
	function plgPaymentAuthorize(& $subject, $config) {
		parent::__construct($subject, $config);
	}
	/**
	 * process transaction with authorize.net
	 *
	 * @param string $order_number
	 * @param double $order_total
	 * @param array $d
	 * @return boolean
	 */
	function process_payment($order_number, $order_total, &$d) {

		global $vendor_mail, $vendor_currency, $vmLogger;
		$database = new ps_DB;
		
		//This is the id of the mainvendor because the payment mehthods are not vendorrelated yet
//		$hVendor_id = $_SESSION['ps_vendor_id'];
		$hVendor_id = 1; 
		$auth = $_SESSION['auth'];
		$transaction_key = $this->get_passkey();
		if( $transaction_key === false ) return false;
		
		// Get the Configuration File for authorize.net
		
		// connector class
		require_once(CLASSPATH ."connectionTools.class.php");

		// Get user billing information
		require_once(CLASSPATH ."ps_user.php");
		$dbbt = ps_user::get_user_details($auth["user_id"],"",""," AND address_type='BT'");
		
//		$dbbt = new ps_DB;
//		$qt = "SELECT * FROM #__{vm}_user_info WHERE user_id=".$auth["user_id"]." AND address_type='BT'";
//
//		$dbbt->query($qt);
//		$dbbt->next_record();
		$user_info_id = $dbbt->f("user_info_id");
		if( $user_info_id != $d["ship_to_info_id"]) {
			// Get user billing information
			$dbst =& new ps_DB;
			$qt = "SELECT * FROM #__{vm}_user_info u,#__{vm}_users ju WHERE u.user_info_id='".$d["ship_to_info_id"]."' AND address_type='ST' AND ju.id = '".$auth["user_id"]."'";
			$dbst->query($qt);
			$dbst->next_record();

		}
		else {
			$dbst = $dbbt;
		}

		// Option to send email to merchant from gateway
		if ($this->params->get('AN_EMAIL_MERCHANT') == '0') {
				$vendor_mail = "";
 		}
		if ($this->params->get('AN_EMAIL_CUSTOMER') == '1') {
			$email_customer = "TRUE";
		} else {
			$email_customer = "FALSE";
 		}
 		$test_request = $this->params->get('DEBUG') == 1 ? 'YES' : 'NO';
 		
		//Authnet vars to send
		$formdata = array (
		'x_version' => '3.1',
		'x_login' => $this->params->get('AN_LOGIN'),
		'x_tran_key' => $transaction_key,
		'x_test_request' => $test_request,

		// Gateway Response Configuration
		'x_delim_data' => 'TRUE',
		'x_delim_char' => '|',
		'x_relay_response' => 'FALSE',

		// Customer Name and Billing Address
		'x_first_name' => substr($dbbt->f("first_name"), 0, 50),
		'x_last_name' => substr($dbbt->f("last_name"), 0, 50),
		'x_company' => substr($dbbt->f("company"), 0, 50),
		'x_address' => substr($dbbt->f("address_1"), 0, 60),
		'x_city' => substr($dbbt->f("city"), 0, 40),
		'x_state' => substr($dbbt->f("state"), 0, 40),
		'x_zip' => substr($dbbt->f("zip"), 0, 20),
		'x_country' => substr($dbbt->f("country"), 0, 60),
		'x_phone' => substr($dbbt->f("phone_1"), 0, 25),
		'x_fax' => substr($dbbt->f("fax"), 0, 25),

		// Customer Shipping Address
		'x_ship_to_first_name' => substr($dbst->f("first_name"), 0, 50),
		'x_ship_to_last_name' => substr($dbst->f("last_name"), 0, 50),
		'x_ship_to_company' => substr($dbst->f("company"), 0, 50),
		'x_ship_to_address' => substr($dbst->f("address_1"), 0, 60),
		'x_ship_to_city' => substr($dbst->f("city"), 0, 40),
		'x_ship_to_state' => substr($dbst->f("state"), 0, 40),
		'x_ship_to_zip' => substr($dbst->f("zip"), 0, 20),
		'x_ship_to_country' => substr($dbst->f("country"), 0, 60),

		// Additional Customer Data
		'x_cust_id' => $auth['user_id'],
		'x_customer_ip' => $_SERVER["REMOTE_ADDR"],
		'x_customer_tax_id' => $dbbt->f("tax_id"),

		// Email Settings
		'x_email' => $dbbt->f("email"),
		'x_email_customer' => $email_customer,
		'x_merchant_email' => $vendor_mail,

		// Invoice Information
		'x_invoice_num' => substr($order_number, 0, 20),
		'x_description' => JText::_('JM_ORDER_PRINT_PO_LBL'),

		// Transaction Data
		'x_amount' => $order_total,
		'x_currency_code' => $vendor_currency,
		'x_method' => 'CC',
		'x_type' => AN_TYPE,
		'x_recurring_billing' => AN_RECURRING,

		'x_card_num' => $_SESSION['ccdata']['order_payment_number'],
		'x_card_code' => $_SESSION['ccdata']['credit_card_code'],
		'x_exp_date' => ($_SESSION['ccdata']['order_payment_expire_month']) . ($_SESSION['ccdata']['order_payment_expire_year']),

		// Level 2 data
		'x_po_num' => substr($order_number, 0, 20),
		'x_tax' => substr($d['order_tax'], 0, 15),
		'x_tax_exempt' => "FALSE",
		'x_freight' => $d['order_shipping'],
		'x_duty' => 0

		);

		//build the post string
		$poststring = '';
		foreach($formdata AS $key => $val){
			$poststring .= urlencode($key) . "=" . urlencode($val) . "&";
		}
		// strip off trailing ampersand
		$poststring = substr($poststring, 0, -1);
		
		$host = 'secure.authorize.net';
				
		$result = vmConnector::handleCommunication( "https://$host:443/gateway/transact.dll", $poststring );
		
		if( !$result ) {
			$vmLogger->err('The transaction could not be completed.' );
			return false;
		}
		$response = explode("|", $result);
		// Strip off quotes from the first response field
		$response[0] = str_replace( '"', '', $response[0] );
		
		$vmLogger->debug('Beginning to analyse the response from '.$host);

		// Approved - Success!
		if ($response[0] == '1') {
			$d["order_payment_log"] = JText::_('JM_PAYMENT_TRANSACTION_SUCCESS').": ";
			$d["order_payment_log"] .= $response[3];

			$vmLogger->debug( $d['order_payment_log']);

			// Catch Transaction ID
			$d["order_payment_trans_id"] = $response[6];

			return True;
		}
		// Payment Declined
		elseif ($response[0] == '2') {

			if ($this->params->get('AN_SHOW_ERROR_CODE') == '1') {
				$vmLogger->err( $response[0] . "-" . $response[1] . "-" . $response[2] . "-" .  $response[5] . "-" . $response[38] . "-" . $response[39] . "-" . $response[3] );
		   	} else {
           		$vmLogger->err( $response[3] );
			}

			$d["order_payment_log"] = $response[3];
			// Catch Transaction ID
			$d["order_payment_trans_id"] = $response[6];
			return False;
		}
		// Transaction Error
		elseif ($response[0] == '3') {

			if ($this->params->get('AN_SHOW_ERROR_CODE') == '1') {
				$vmLogger->err( $response[0] . "-" . $response[1] . "-" . $response[2] . "-" .  $response[5] . "-" . $response[38] . "-" . $response[39] . "-" . $response[3] );
		   	} 
		   	else {
           		$vmLogger->err( $response[3] );
			}

			$d["order_payment_log"] = $response[3];
			// Catch Transaction ID
			$d["order_payment_trans_id"] = $response[6];
			return False;
		}
	}

	/**************************************************************************
	** name: capture_payment()
	** created by: Soeren
	** description: Process a previous transaction with authorize.net, Capture the Payment
	** parameters: $order_number, the number of the order, we're processing here
	** returns:
	***************************************************************************/
	function capture_payment( &$d ) {

		global $vendor_mail, $vendor_currency, $vmLogger;
		$database = new ps_DB();

		require_once(CLASSPATH ."connectionTools.class.php");
		
		/*CERTIFICATION
		Visa Test Account           4007000000027
		Amex Test Account           370000000000002
		Master Card Test Account    6011000000000012
		Discover Test Account       5424000000000015

		$host = "certification.authorize.net";
		$port = 443;
		$path = "/gateway/transact.dll";
		*/
		if( empty($d['order_number'])) {
			$vmLogger->err("Error: No Order Number provided.");
			return false;
		}

		$transaction_key = $this->get_passkey();
		if( $transaction_key === false ) return false;
		
		$db = new ps_DB;
		$q = "SELECT * FROM #__{vm}_orders, #__{vm}_order_payment WHERE ";
		$q .= "order_number='".$d['order_number']."' ";
		$q .= "AND #__{vm}_orders.order_id=#__{vm}_order_payment.order_id";
		$db->query( $q );
		if( !$db->next_record() ) {
			$vmLogger->err("Error: Order not found.");
			return false;
		}
		$expire_date = date( "my", $db->f("order_payment_expire") );

		// DECODE Account Number
		$dbaccount = new ps_DB;
		$q = "SELECT ".JM_DECRYPT_FUNCTION."(order_payment_number,'".ENCODE_KEY."')
          AS account_number from #__{vm}_order_payment WHERE order_id='".$db->f("order_id")."'";
		$dbaccount->query($q);
		$dbaccount->next_record();

		// Get user billing information
		$dbbt = new ps_DB;
		$qt = "SELECT * FROM #__{vm}_user_info WHERE user_id='".$db->f("user_id")."'";
		$dbbt->query($qt);
		$dbbt->next_record();
		$user_info_id = $dbbt->f("user_info_id");
		if( $user_info_id != $db->f("user_info_id")) {
			// Get user's alternative shipping information
			$dbst =& new ps_DB;
			$qt = "SELECT * FROM #__{vm}_user_info WHERE user_info_id='".$db->f("user_info_id")."' AND address_type='ST'";
			$dbst->query($qt);
			$dbst->next_record();
		}
		else {
			$dbst = $dbbt;
		}

		//Authnet vars to send
		$formdata = array (
		'x_version' => '3.1',
		'x_login' => $this->params->get('AN_LOGIN'),
		'x_tran_key' => $transaction_key,
		'x_test_request' => ($this->params->get('DEBUG') == 1 ? 'YES' : 'NO'),

		// Gateway Response Configuration
		'x_delim_data' => 'TRUE',
		'x_delim_char' => '|',
		'x_relay_response' => 'FALSE',

		// Customer Name and Billing Address
		'x_first_name' => substr($dbbt->f("first_name"), 0, 50),
		'x_last_name' => substr($dbbt->f("last_name"), 0, 50),
		'x_company' => substr($dbbt->f("company"), 0, 50),
		'x_address' => substr($dbbt->f("address_1"), 0, 60),
		'x_city' => substr($dbbt->f("city"), 0, 40),
		'x_state' => substr($dbbt->f("state"), 0, 40),
		'x_zip' => substr($dbbt->f("zip"), 0, 20),
		'x_country' => substr($dbbt->f("country"), 0, 60),
		'x_phone' => substr($dbbt->f("phone_1"), 0, 25),
		'x_fax' => substr($dbbt->f("fax"), 0, 25),

		// Customer Shipping Address
		'x_ship_to_first_name' => substr($dbst->f("first_name"), 0, 50),
		'x_ship_to_last_name' => substr($dbst->f("last_name"), 0, 50),
		'x_ship_to_company' => substr($dbst->f("company"), 0, 50),
		'x_ship_to_address' => substr($dbst->f("address_1"), 0, 60),
		'x_ship_to_city' => substr($dbst->f("city"), 0, 40),
		'x_ship_to_state' => substr($dbst->f("state"), 0, 40),
		'x_ship_to_zip' => substr($dbst->f("zip"), 0, 20),
		'x_ship_to_country' => substr($dbst->f("country"), 0, 60),

		// Additional Customer Data
		'x_cust_id' => $db->f('user_id'),
		'x_customer_ip' => $dbbt->f("ip_address"),
		'x_customer_tax_id' => $dbbt->f("tax_id"),

		// Email Settings
		'x_email' => $dbbt->f("email"),
		'x_email_customer' => 'False',
		'x_merchant_email' => $vendor_mail,

		// Invoice Information
		'x_invoice_num' => substr($d['order_number'], 0, 20),
		'x_description' => '',

		// Transaction Data
		'x_amount' => $db->f("order_total"),
		'x_currency_code' => $vendor_currency,
		'x_method' => 'CC',
		'x_type' => 'PRIOR_AUTH_CAPTURE',
		'x_recurring_billing' => ($this->params->get('AN_RECURRING')=='1'?'YES':'NO'),

		'x_card_num' => $dbaccount->f("account_number"),
		'x_card_code' => $db->f('order_payment_code'),
		'x_exp_date' => $expire_date,
		'x_trans_id' => $db->f("order_payment_trans_id"),

		// Level 2 data
		'x_po_num' => substr($d['order_number'], 0, 20),
		'x_tax' => substr($db->f('order_tax'), 0, 15),
		'x_tax_exempt' => "FALSE",
		'x_freight' => $db->f('order_shipping'),
		'x_duty' => 0

		);

		//build the post string
		$poststring = '';
		foreach($formdata AS $key => $val){
			$poststring .= urlencode($key) . "=" . urlencode($val) . "&";
		}
		// strip off trailing ampersand
		$poststring = substr($poststring, 0, -1);
		
		$host = 'secure.authorize.net';
		
		$result = vmConnector::handleCommunication( "https://$host:443/gateway/transact.dll", $poststring );
		
		if( !$result ) {
			$vmLogger->err('We\'re sorry, but an error has occured when we tried to communicate with the authorize.net server. Please try again later, thank you.' );
			return false;
		}
		
		$response = explode("|", $result);

		// Approved - Success!
		if ($response[0] == '1') {
			$d["order_payment_log"] = JText::_('JM_PAYMENT_TRANSACTION_SUCCESS').": ";
			$d["order_payment_log"] .= $response[3];
			// Catch Transaction ID
			$d["order_payment_trans_id"] = $response[6];

			$q = "UPDATE #__{vm}_order_payment SET ";
			$q .="order_payment_log='".$d["order_payment_log"]."',";
			$q .="order_payment_trans_id='".$d["order_payment_trans_id"]."' ";
			$q .="WHERE order_id='".$db->f("order_id")."' ";
			$db->query( $q );

			return True;
		}
		// Payment Declined
		elseif ($response[0] == '2') {
			$vmLogger->err($response[3]);
			$d["order_payment_log"] = $response[3];
			// Catch Transaction ID
			$d["order_payment_trans_id"] = $response[6];
			return False;
		}
		// Transaction Error
		elseif ($response[0] == '3') {
			$vmLogger->err($response[3]);
			$d["order_payment_log"] = $response[3];
			// Catch Transaction ID
			$d["order_payment_trans_id"] = $response[6];
			return False;
		}
	}

}
?>