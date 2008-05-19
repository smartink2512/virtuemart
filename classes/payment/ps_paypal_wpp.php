<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 

class ps_paypal_wpp {
	
    var $classname = "ps_paypal_wpp";
    var $payment_code = "PP_WPP";

	/**
    * Show all configuration parameters for this payment method
    * @returns boolean False when the Payment method has no configration
    */
	function show_configuration() {

		global $VM_LANG, $sess;
		$db =& new ps_DB;
		//$payment_method_id = mosGetParam( $_REQUEST, 'payment_method_id', null );
		/** Read current Configuration ***/
		require_once(CLASSPATH ."payment/".$this->classname.".cfg.php");
?>
	<table>
		<tr>
			<td><strong><?php echo PP_WPP_TEXT_ENABLE_SANDBOX ?></strong></td>
			<td><select name="PP_WPP_SANDBOX" class="inputbox" >
                	<option <?php if (PP_WPP_SANDBOX == '1') {echo "selected=\"selected\"";} ?> value="1"><?php echo PP_WPP_TEXT_YES ?></option>
                	<option <?php if (PP_WPP_SANDBOX != '1') {echo "selected=\"selected\"";} ?> value="0"><?php echo PP_WPP_TEXT_NO ?></option>
                </select>
            </td>
            <td><?php echo PP_WPP_TEXT_ENABLE_SANDBOX_EXPLAIN ?>
            </td>
        </tr>
		<tr><td><strong><?php echo PP_WPP_TEXT_EXPRESS_ENABLE ?></strong></td>
            <td><select name="PP_WPP_EXPRESS_ON" class="inputbox" >
                	<option <?php if (PP_WPP_EXPRESS_ON == '1') echo "selected=\"selected\""; ?> value="1">
					<?php echo PP_WPP_TEXT_YES ?></option>
                	<option <?php if (PP_WPP_EXPRESS_ON != '1') echo "selected=\"selected\""; ?> value="0">
					<?php echo PP_WPP_TEXT_NO ?></option>
                </select>
            </td>
            <td><?php echo PP_WPP_TEXT_EXPRESS_ENABLE_EXPLAIN?></td>
        </tr>
		<tr>
            <td><strong><?php echo PP_WPP_TEXT_CHECK_CVV2 ?></strong></td>
            <td>
                <select name="PP_WPP_CHECK_CARD_CODE" class="inputbox">
                <option <?php if (PP_WPP_CHECK_CARD_CODE == 'YES') echo "selected=\"selected\""; ?> value="YES">
				<?php echo PP_WPP_TEXT_YES ?></option>
                <option <?php if (PP_WPP_CHECK_CARD_CODE == 'NO') echo "selected=\"selected\""; ?> value="NO">
                <?php echo PP_WPP_TEXT_NO ?></option>
                </select>
            </td>
            <td><?php echo PP_WPP_TEXT_CHECK_CVV2_EXPLAIN ?></td>
        </tr>
		<tr>
            <td><strong><?php echo PP_WPP_TEXT_USERNAME ?></strong></td>
            <td>
                <input type="text" name="PP_WPP_USERNAME" class="inputbox" value="<?php echo PP_WPP_USERNAME ?>" size="40" />
            </td>
            <td><?php echo PP_WPP_TEXT_USERNAME_EXPLAIN ?>
            </td>
        </tr>
        <tr>
            <td><strong><?php echo PP_WPP_TEXT_PASSWORD ?></strong></td>
            <td>
                <input type="text" name="PP_WPP_PASSWORD" class="inputbox" value="<?php echo PP_WPP_PASSWORD ?>" size="40" />
            </td>
            <td><?php echo PP_WPP_TEXT_PASSWORD_EXPLAIN ?>
            </td>
        </tr>
        <tr>
            <td><strong><?php echo PP_WPP_TEXT_SIGNATURE ?></strong></td>
            <td>
                <input type="text" name="PP_WPP_SIGNATURE" class="inputbox" value="<?php echo PP_WPP_SIGNATURE ?>" size="40" />
            </td>
            <td><?php echo PP_WPP_TEXT_SIGNATURE_EXPLAIN ?>
            </td>
        </tr>
		<tr>
            <td><strong><?php echo PP_WPP_TEXT_ACCOUNT ?></strong></td>
            <td>
                <input type="text" name="PP_WPP_ACCOUNT" class="inputbox" value="<?php echo PP_WPP_ACCOUNT ?>" size="40" />
            </td>
            <td><?php echo PP_WPP_TEXT_ACCOUNT_EXPLAIN ?>
            </td>
        </tr>
		<tr><td><strong><?php echo PP_WPP_TEXT_PAYMENT_ACTION ?></strong></td>
            <td><select name="PP_WPP_PAYMENT_ACTION" class="inputbox" >
                	<option <?php if (PP_WPP_PAYMENT_ACTION == 'Sale') echo "selected=\"selected\""; ?> value="Sale">Sale</option>
                	<option <?php if (PP_WPP_PAYMENT_ACTION == 'Authorize') echo "selected=\"selected\""; ?> value="Authorize">Authorize Only</option>
                </select>
            </td>
            <td><?php echo PP_WPP_TEXT_PAYMENT_ACTION_EXPLAIN?></td>
        </tr>
		<tr>
            <td><strong><?php echo PP_WPP_TEXT_USE_PROXY ?></strong></td>
            <td>
                <select name="PP_WPP_USE_PROXY" class="inputbox">
                	<option <?php if (PP_WPP_USE_PROXY == '1') echo "selected=\"selected\""; ?> value="1">
					<?php echo PP_WPP_TEXT_YES ?></option>
					<option <?php if (PP_WPP_USE_PROXY != '1') echo "selected=\"selected\""; ?> value="0">
					<?php echo PP_WPP_TEXT_NO ?></option>
                </select>
            </td>
            <td><?php echo PP_WPP_TEXT_USE_PROXY_EXPLAIN ?></td>
        </tr>
        </tr>
		<tr><td><strong><?php echo PP_WPP_TEXT_PROXY_HOST ?></strong></td>
            <td><input type="text" name="PP_WPP_PROXY_HOST" class="inputbox" value="<?php  echo PP_WPP_PROXY_HOST ?>" /></td>
            <td><?php echo PP_WPP_TEXT_PROXY_HOST_EXPLAIN ?></td>
        </tr> 
		<tr><td><strong><?php echo PP_WPP_TEXT_PROXY_PORT ?></strong></td>
            <td><input type="text" name="PP_WPP_PROXY_PORT" class="inputbox" value="<?php  echo PP_WPP_PROXY_PORT ?>" /></td>
            <td><?php echo PP_WPP_TEXT_PROXY_PORT_EXPLAIN ?></td>
        </tr> 
        <tr><td><strong><?php echo PP_WPP_TEXT_STATUS_SUCCESS ?></strong></td>
            <td><select name="PP_WPP_SUCCESS_STATUS" class="inputbox" >
                <?php
                    $q = "SELECT order_status_name,order_status_code FROM #__{vm}_order_status ORDER BY list_order";
                    $db->query($q);
                    $order_status_code = Array();
                    $order_status_name = Array();
                    
                    while ($db->next_record()) {
                      $order_status_code[] = $db->f("order_status_code");
                      $order_status_name[] =  $db->f("order_status_name");
                    }
                    for ($i = 0; $i < sizeof($order_status_code); $i++) {
                      echo "<option value=\"" . $order_status_code[$i];
                      if (PP_WPP_SUCCESS_STATUS == $order_status_code[$i]) 
                         echo "\" selected=\"selected\">";
                      else
                         echo "\">";
                      echo $order_status_name[$i] . "</option>\n";
                    }?>
                    </select>
            </td>
            <td><?php echo PP_WPP_TEXT_STATUS_SUCCESS_EXPLAIN ?></td>
        </tr>
        <tr><td><strong><?php echo PP_WPP_TEXT_STATUS_PENDING?></strong></td>
            <td>
                <select name="PP_WPP_PENDING_STATUS" class="inputbox" >
                <?php
                    for ($i = 0; $i < sizeof($order_status_code); $i++) {
                      echo "<option value=\"" . $order_status_code[$i];
                      if (PP_WPP_PENDING_STATUS == $order_status_code[$i]) 
                         echo "\" selected=\"selected\">";
                      else
                         echo "\">";
                      echo $order_status_name[$i] . "</option>\n";
                    } ?>
                    </select>
            </td>
            <td><?php echo PP_WPP_TEXT_STATUS_PENDING_EXPLAIN?></td>
        </tr>
        <tr><td><strong><?php echo PP_WPP_TEXT_STATUS_FAILED ?></strong></td>
            <td>
                <select name="PP_WPP_FAILED_STATUS" class="inputbox" >
                <?php
                    for ($i = 0; $i < sizeof($order_status_code); $i++) {
                      echo "<option value=\"" . $order_status_code[$i];
                      if (PP_WPP_FAILED_STATUS == $order_status_code[$i]) 
                         echo "\" selected=\"selected\">";
                      else
                         echo "\">";
                      echo $order_status_name[$i] . "</option>\n";
                    } ?>
                    </select>
            </td>
            <td><?php echo PP_WPP_TEXT_STATUS_FAILED_EXPLAIN ?></td>
		</tr>
      </table>
<?php
      return true;
	}
	
	function has_configuration() {
		return true;
	}
   
// Check to see if the config file is writeable
   function configfile_writeable() {
      return is_writeable( CLASSPATH."payment/".$this->classname.".cfg.php" );
   }
   
// Check to see if the config file is readable
   function configfile_readable() {
      return is_readable( CLASSPATH."payment/".$this->classname.".cfg.php" );
   }   

	/**
	* Writes the configuration file for this payment method
	* @param array An array of objects
	* @returns boolean True when writing was successful
	*/
	function write_configuration( &$d ) {
		$my_config_array = array("PP_WPP_SANDBOX" => $d['PP_WPP_SANDBOX'],
								 "PP_WPP_USERNAME" => $d['PP_WPP_USERNAME'],
								 "PP_WPP_PASSWORD" => $d['PP_WPP_PASSWORD'],
								 "PP_WPP_SIGNATURE" => $d['PP_WPP_SIGNATURE'],
								 "PP_WPP_ACCOUNT" => $d['PP_WPP_ACCOUNT'],
								 "PP_WPP_CHECK_CARD_CODE" => $d['PP_WPP_CHECK_CARD_CODE'],
								 "PP_WPP_SUCCESS_STATUS" => $d['PP_WPP_SUCCESS_STATUS'],
								 "PP_WPP_PENDING_STATUS" => $d['PP_WPP_PENDING_STATUS'],
								 "PP_WPP_FAILED_STATUS" => $d['PP_WPP_FAILED_STATUS'],
								 "PP_WPP_USE_PROXY" => $d['PP_WPP_USE_PROXY'],
								 "PP_WPP_PROXY_HOST" => $d['PP_WPP_PROXY_HOST'],
								 "PP_WPP_PROXY_PORT" => $d['PP_WPP_PROXY_PORT'],
								 "PP_WPP_EXPRESS_ON" => $d['PP_WPP_EXPRESS_ON'],
								 "PP_WPP_PAYMENT_ACTION" => $d['PP_WPP_PAYMENT_ACTION']
                            );
      $config = "<?php\n";
      $config .= "defined('_VALID_MOS') or die('Direct Access to this location is not allowed.'); \n";
	  $config .= "
define('PP_WPP_TEXT_CREDIT_CARD_TYPE', 'Credit Card Type:');
define('PP_WPP_TEXT_CREDIT_CARD_FIRSTNAME', 'Owner First Name:');
define('PP_WPP_TEXT_CREDIT_CARD_LASTNAME', 'Owner Last Name:');
define('PP_WPP_TEXT_CREDIT_CARD_NUMBER', 'Card Number:');
define('PP_WPP_TEXT_CREDIT_CARD_CVV', 'CVV/CVV2 Number');
define('PP_WPP_TEXT_CREDIT_CARD_EXPIRES', 'Expiration Date:');
define ('PP_WPP_TEXT_ERROR', 'Credit Card Error:');
define ('PP_WPP_TEXT_DECLINED_MESSAGE', 'Your credit card was declined. Please try another card or contact your bank for more info.');
define ('PP_WPP_TEXT_PROCESS_ERROR', 'There was an error processing your card.');

define ('PP_WPP_TEXT_ACCOUNT', 'Paypal Email Address:');
define ('PP_WPP_TEXT_ACCOUNT_EXPLAIN', 'This is your PayPal email address. (This will differ between Sandbox and Live)');
define ('PP_WPP_TEXT_USERNAME', 'API account name:');
define ('PP_WPP_TEXT_USERNAME_EXPLAIN', 'This is your API username. (This will differ between Sandbox and Live)');
define ('PP_WPP_TEXT_PASSWORD', 'API password:');
define ('PP_WPP_TEXT_PASSWORD_EXPLAIN', 'This is your API password. (This will differ between Sandbox and Live)');
define ('PP_WPP_TEXT_SIGNATURE', 'API Signature:');
define ('PP_WPP_TEXT_SIGNATURE_EXPLAIN', 'This is the API signature generated for you. (This will differ between Sandbox and Live)');

define ('PP_WPP_TEXT_STATUS_SUCCESS', 'Order status for successful transactions');
define ('PP_WPP_TEXT_STATUS_SUCCESS_EXPLAIN', 'Select the status you want the order set to for successful transactions.');
define ('PP_WPP_TEXT_STATUS_PENDING', 'Order status for pending transactions');
define ('PP_WPP_TEXT_STATUS_PENDING_EXPLAIN', 'Select the status you want the order set to for pending transactions.');
define ('PP_WPP_TEXT_STATUS_FAILED', 'Order status for failed transactions');
define ('PP_WPP_TEXT_STATUS_FAILED_EXPLAIN', 'Select the status you want the order set to for failed transactions.');

define ('PP_WPP_TEXT_YES', 'Yes');
define ('PP_WPP_TEXT_NO', 'No');

define ('PP_WPP_TEXT_ENABLE_SANDBOX', 'Sandbox Mode?');
define ('PP_WPP_TEXT_ENABLE_SANDBOX_EXPLAIN', 'Use sandbox account? (For development)');

define ('PP_WPP_TEXT_CHECK_CVV2', 'Check CVV2 code?');
define ('PP_WPP_TEXT_CHECK_CVV2_EXPLAIN', 'Select whether the processor will require and use the CVV2 code.');

define ('PP_WPP_TEXT_EXPRESS_ENABLE', 'Enable Paypal Express Checkout?');
define ('PP_WPP_TEXT_EXPRESS_ENABLE_EXPLAIN', 'Check to use Paypal Express Checkout.');

define ('PP_WPP_TEXT_PAYMENT_ACTION','Sale or Authorize Only');
define ('PP_WPP_TEXT_PAYMENT_ACTION_EXPLAIN','Do you want to send the final sales info to paypal or just authorize the card and return to the site to be processed later?');

define ('PP_WPP_TEXT_USE_PROXY','Use Proxy?');
define ('PP_WPP_TEXT_USE_PROXY_EXPLAIN','Should this request be sent through a proxy server? (Some hosting accounts, like GoDaddy, require the use of a proxy.)');
define ('PP_WPP_TEXT_PROXY_HOST','Proxy Host');
define ('PP_WPP_TEXT_PROXY_HOST_EXPLAIN','Enter the host IP of your proxy server.');
define ('PP_WPP_TEXT_PROXY_PORT','Proxy Port');
define ('PP_WPP_TEXT_PROXY_PORT_EXPLAIN','Enter the port number of your proxy server.');

define ('PP_WPP_TEXT_ACCEPT_VERIFIED','Accept only verified buyers?');
define ('PP_WPP_TEXT_ACCEPT_VERIFIED_EXPLAIN','Here you can choose if you want to accept payments only from buyers with a <strong>verified</strong> PayPal account. (When an account is not verified, PayPal does transfer the funds, but they do not fully guarantee the validity of the sale.)');
";
      foreach( $my_config_array as $key => $value ) {
        $config .= "define ('$key', '$value');\n";
      }
      
      $config .= "?>";
  
      if ($fp = fopen(CLASSPATH ."payment/".$this->classname.".cfg.php", "w")) {
          fputs($fp, $config, strlen($config));
          fclose ($fp);
          return true;
     }
     else
        return false;
   }
   
   function process_payment($order_number, $order_total, &$d) {
        global $vendor_mail, $vendor_currency, $VM_LANG, $vmLogger;
		$database = new ps_DB;
		$_SESSION['CURL_ERROR'] = false;
		$_SESSION['CURL_ERROR_TXT'] = "";
        $ps_vendor_id = $_SESSION["ps_vendor_id"];
        $auth = $_SESSION['auth'];

        $ps_checkout = new ps_checkout;
		require_once(CLASSPATH ."payment/".$this->classname.".cfg.php");
        require_once(CLASSPATH . 'payment/paypal_lib/ps_paypal_wpp.functions.php');

        // Get user billing information from the database
        $dbbt = new ps_DB;
        $qt = "SELECT * FROM #__{vm}_user_info WHERE user_id=".$auth["user_id"]." AND address_type='BT'";
        $dbbt->query($qt);
        $dbbt->next_record();
        $user_info_id = $dbbt->f("user_info_id");
        if( $user_info_id != $d["ship_to_info_id"]) {
		// There is a different shipping address than the billing address, get the shipping information
            $dbst = new ps_DB;
            $qt = "SELECT * FROM #__{vm}_user_info WHERE user_info_id='".$d["ship_to_info_id"]."' AND address_type='ST'";
            $dbst->query($qt);
            $dbst->next_record();
        }
        else {
			// Shipping address is the same as the billing address
            $dbst = $dbbt;
        }

        $order_array['amount'] = $order_total;
        $order_array['currency_code'] = $vendor_currency;
        $order_array['tax'] = substr($d['order_tax'], 0, 15);
		$order_array['freight'] = $d['order_shipping'];
        $order_array['subtotal'] = number_format($order_total, 2, '.', '') - (number_format($order_array['tax'], 2, '.', '') - number_format($order_array['freight'], 2, '.', ''));

		$apiusername = PP_WPP_USERNAME;
		$apipassword = PP_WPP_PASSWORD;
		$apiemail = PP_WPP_EMAIL;
		$apisignature = PP_WPP_SIGNATURE;
		$apiurl = PP_WPP_SANDBOX;
		$payment_action = PP_WPP_PAYMENT_ACTION;
		$ip_address = $_SERVER['REMOTE_ADDR'];
		if ($apiurl == '1'){
			$apiurl = "https://api.sandbox.paypal.com/2.0/";  
		} else {
			$apiurl = "https://api-3t.paypal.com/2.0";  	
		}
		
		$soapData = SOAP_DoDirectPaymentRequest($apiusername, $apipassword, $apisignature, $apiemail, $d, $dbbt, $dbst, $order_array, $ip_address, $payment_action);
		$paypalResponse = SendSoap($apiurl, $soapData);
		$arr_val = xml2php($paypalResponse);

	  
// Parse out all the data 
$errorOut = TRUE;
$errorOut2 = FALSE;
$displayMsg = "";
foreach ($arr_val AS $arr_vals) {
	foreach ($arr_vals AS $name => $value) {
		if (is_array($value)){
			foreach ($value AS $name2 => $value2) {
				if ($name2 == "tag") $tag_value = $value2;
				if ($name2 == "value") {
					if ($tag_value == "ACK" && ($value2 != "Success" && $value2 != "SuccessWithWarning")) {
						$displayMsg .= "Error - Paypal did not complete order - ";
						$errorOut2 = TRUE;
					} elseif ($tag_value == "ERRORCODE") {
						$displayMsg .= $tag_value . "=" . $value2 . " - ";
					} elseif ($tag_value == "LONGMESSAGE") {
						$displayMsg .= $tag_value . "=" . $value2 . " - ";
					} elseif ($tag_value == "AVSCODE") {
						if (($value2 == "P") || ($value2 == "W") || ($value2 == "X") || ($value2 == "Y") || ($value2 == "Z")) {
							$displayMsg .= "Your order has been processed";
						} else {
							$displayMsg .= "There was a problem with your address.";
						}
						$errorOut = FALSE;
						$avsCode = $value2;
					} elseif ($tag_value == "CVV2CODE") {
						if ($value2 == "N") {
							$displayMsg .= "The CVV Number was wrong.";
						}
						$cvv2Code = $value2;
					} elseif ($tag_value == "TRANSACTIONID") {
						$transactionID = $value2;
					} else {
					}
				}
			}
		} else {
			if ($name == "tag") $tag_value = $value;
			if ($name == "value") {
				if ($tag_value == "ACK" && ($value != "Success" && $value != "SuccessWithWarning")) {
					$displayMsg .= "Error - Paypal did not complete order - ";
					$errorOut2 = TRUE;
				} elseif ($tag_value == "ERRORCODE") {
					$displayMsg .= $tag_value . "=" . $value . " - ";
				} elseif ($tag_value == "LONGMESSAGE") {
					$displayMsg .= $tag_value . "=" . $value . " - ";
				} elseif ($tag_value == "AVSCODE") {
					if (($value == "P") || ($value == "W") || ($value == "X") || ($value == "Y") || ($value == "Z")) {
						$displayMsg .= "You order has been processed";
					} else {
						$displayMsg .= "There was a problem with your address.";
					}
					$errorOut = FALSE;
					$avsCode = $value;
				} elseif ($tag_value == "CVV2CODE") {
					if ($value == "N") {
						$displayMsg .= "The CVV Number was wrong.";
					}
					$cvv2Code = $value;
				} elseif ($tag_value == "TRANSACTIONID") {
					$transactionID = $value;
				} else {
				}
			}
		}
	}
}
	
	if ($errorOut || $errorOut2) {
        $d["error"] = $displayMsg;
        $d["order_payment_log"] = $displayMsg;
        // Catch Transaction ID
        $d["order_payment_trans_id"] = $transactionID;
        $html = "<br/><span class=\"message\">".$VM_LANG->_PHPSHOP_PAYMENT_INTERNAL_ERROR." Paypal Pro Direct Payment Error - " . $displayMsg . "</span>";
			if ($_SESSION['CURL_ERROR'] == true) { 
		        $d["error"] .= "-CURL ERROR: " . $_SESSION['CURL_ERROR_TXT'];
		        $d["order_payment_log"] .= "-CURL ERROR: " . $_SESSION['CURL_ERROR_TXT'];
		        $html .= "<br/><span class=\"message\">-CURL ERROR: " . $_SESSION['CURL_ERROR_TXT']."</span>";
			}
        $vmLogger->err( $displayMsg );
        return False;
	}
	if ($_SESSION['CURL_ERROR'] == true) { 
		echo "<br />" . $displayMsg . "PAYPAL ERROR: " . $_SESSION['CURL_ERROR_TXT'] . "<br /><br />" . $response; $d["error"] = "PAYPAL ERROR: " . $_SESSION['CURL_ERROR_TXT'];
	}
	  $avsCode = $avsCode;  
	  $cvv2Code = $cvv2Code;
      $d["order_payment_log"] = "Success: " . $order_number;
      // Catch Transaction ID
      $d["order_payment_trans_id"] = $transactionID;
      $vmLogger->debug( $d['order_payment_log']);

	  return True;
	} 

}

?>