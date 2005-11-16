<?php
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');
/**
*
* @version $Id: usps.php,v 1.5 2005/10/28 09:35:36 soeren_nb Exp $
* @package VirtueMart
* @subpackage shipping
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

/**
* This is the Shipping class for 
* using a part of the USPS Online Tools:
* = Rates and Service Selection =
*
* @copyright (C) 2005 E-Z E
*/
class usps {

	var $classname = "usps";

	function list_rates( &$d ) {
		global $vendor_country_2_code, $vendor_currency, $vmLogger;
		global $VM_LANG, $CURRENCY_DISPLAY, $mosConfig_absolute_path;
		$db =& new ps_DB;
		$dbv =& new ps_DB;

		$cart = $_SESSION['cart'];

		/** Read current Configuration ***/
		require_once(CLASSPATH ."shipping/".$this->classname.".cfg.php");

		$q  = "SELECT * FROM #__users, #__{vm}_country WHERE user_info_id='" . $d["ship_to_info_id"]."' AND ( country=country_2_code OR country=country_3_code)";
		$db->query($q);
		if( !$db->next_record()) {
			$q  = "SELECT * FROM #__{vm}_user_info, #__{vm}_country WHERE user_info_id='" . $d["ship_to_info_id"]."' AND ( country=country_2_code OR country=country_3_code)";
			$db->query($q);
		}

		$q  = "SELECT * FROM #__{vm}_vendor WHERE vendor_id='".$_SESSION['ps_vendor_id']."'";
		$dbv->query($q);
		$dbv->next_record();

		$order_weight = $d['weight'];

		if($order_weight > 0) {
			if( $order_weight > 150.00 )
			$order_weight = 150.00;

			//USPS Username
			$usps_username = USPS_USERNAME;

			//USPS Password
			$usps_password = USPS_PASSWORD;

			//USPS Server
			$usps_server = USPS_SERVER;

			//USPS Path
			$usps_path = USPS_PATH;

			//USPS container
			$usps_container = USPS_CONTAINER;

			//USPS package size
			$usps_packagesize = USPS_PACKAGESIZE;

			//USPS Package ID
			$usps_packageid = USPS_PACKAGEID;

			//USPS International Per Pound Rate
			$usps_intllbrate = USPS_INTLLBRATE;

			//USPS International handling fee
			$usps_intlhandlingfee = USPS_INTLHANDLINGFEE;

			//Title for your request
			$request_title = "Shipping Estimate";

			//The zip that you are shipping from
			$source_zip = $dbv->f("vendor_zip");

			$shpService = USPS_SHIPSERVICE; //"Priority";

			//The zip that you are shipping to
			$dest_country = $db->f("country_2_code");
			$dest_state = $db->f("state");
			$dest_zip = $db->f("zip");
			//$weight_measure
			$shipping_pounds_intl = ceil ($order_weight);
			$shipping_pounds = floor ($order_weight);
			$shipping_ounces = round(16 * ($order_weight - floor($order_weight)));

			$os = array("Mac", "NT", "Irix", "Linux");
			$states = array("AK","AR","AZ","CA","CO","CT","DC","DE","FL","GA","HI","IA","ID","IL","IN","KS","KY","LA","MA","MD","ME","MI","MN","MO","MS","MT","NC","ND","NE","NH","NJ","NM","NV","NY","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VT","VA","WA","WI","WV","WY");

			if( ($dest_country = "USA" || $dest_country = "US") && in_array($dest_state,$states) )
			{
				/******START OF DOMESTIC RATE******/
				//the xml that will be posted to usps
				$xmlPost = 'API=Rate&XML=<RateRequest USERID="'.$usps_username.'" PASSWORD="'.$usps_password.'">';
				$xmlPost .= '<Package ID="'.$usps_packageid.'">';
				$xmlPost .= "<Service>".$shpService."</Service>";
				$xmlPost .= "<ZipOrigination>".$source_zip."</ZipOrigination>";
				$xmlPost .= "<ZipDestination>".$dest_zip."</ZipDestination>";
				$xmlPost .= "<Pounds>".$shipping_pounds."</Pounds>";
				$xmlPost .= "<Ounces>".$shipping_ounces."</Ounces>";
				$xmlPost .= "<Container>".$usps_container."</Container>";
				$xmlPost .= "<Size>".$usps_packagesize."</Size>";
				$xmlPost .= "<Machinable></Machinable>";
				$xmlPost .= "</Package></RateRequest>";


				// echo htmlentities( $xmlPost );
				$host = $usps_server;
				//$host = "production.shippingapis.com";
				$path = $usps_path; //"/ups.app/xml/Rate";
				//$path = "/ShippingAPI.dll";
				$port = 80;
				$protocol = "http";

				//echo "<textarea>".$protocol."://".$host.$path."?API=Rate&XML=".$xmlPost."</textarea>";
				// Using cURL is Up-To-Date and easier!!
				if( function_exists( "curl_init" )) {
					$CR = curl_init();
					curl_setopt($CR, CURLOPT_URL, $protocol."://".$host.$path); //"?API=Rate&XML=".$xmlPost);
					curl_setopt($CR, CURLOPT_POST, 1);
					curl_setopt($CR, CURLOPT_FAILONERROR, true);
					curl_setopt($CR, CURLOPT_POSTFIELDS, $xmlPost);
					curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);


					$xmlResult = curl_exec( $CR );
					//echo "<textarea>".$xmlResult."</textarea>";
					$error = curl_error( $CR );
					if( !empty( $error )) {
						$vmLogger->err( curl_error( $CR ) );
						$html = "<br/><span class=\"message\">".$VM_LANG->_PHPSHOP_INTERNAL_ERROR." USPS.com</span>";
						$error = true;
					}
					else {
						/* XML Parsing */
						require_once( $mosConfig_absolute_path. '/includes/domit/xml_domit_lite_include.php' );
						$xmlDoc =& new DOMIT_Lite_Document();
						$xmlDoc->parseXML( $xmlResult, false, true );

						/* Let's check wether the response from USPS is Success or Failure ! */
						if( strstr( $xmlResult, "Error" ) ) {
							$error = true;
							$html = "<span class=\"message\">".$VM_LANG->_PHPSHOP_USPS_RESPONSE_ERROR."</span><br/>";
							$error_code = $xmlDoc->getElementsByTagName( "Number" );
							$error_code = $error_code->item(0);
							$error_code = $error_code->getText();
							$html .= $VM_LANG->_PHPSHOP_ERROR_CODE.": ".$error_code."<br/>";

							$error_desc = $xmlDoc->getElementsByTagName( "Description" );
							$error_desc = $error_desc->item(0);
							$error_desc = $error_desc->getText();
							$html .= $VM_LANG->_PHPSHOP_ERROR_DESC.": ".$error_desc."<br/>";

						}

					}
					curl_close( $CR );

				}
				else {
					$protocol = "http";
					$fp = fsockopen("$protocol://".$host, $port, $errno, $errstr, $timeout = 60);
					if( !$fp ) {
						$error = true;
						$html = $VM_LANG->_PHPSHOP_INTERNAL_ERROR.": $errstr ($errno)";
					}
					else {
						//send the server request
						fputs($fp, "POST $path HTTP/1.1\r\n");
						fputs($fp, "Host: $host\r\n");
						fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
						fputs($fp, "Content-length: ".strlen($xmlPost)."\r\n");
						fputs($fp, "Connection: close\r\n\r\n");
						fputs($fp, $xmlPost . "\r\n\r\n");

						$xmlResult = '';
						while(!feof($fp)) {
							$xmlResult .= fgets($fp, 4096);
						}
						if( stristr( $xmlResult, "Success" )) {
							/* XML Parsing */
							require_once( $mosConfig_absolute_path. '/includes/domit/xml_domit_lite_include.php' );
							$xmlDoc =& new DOMIT_Lite_Document();
							$xmlDoc->parseXML( $xmlResult, false, true );
							$error = false;
						}
						else {
							$html = "Error processing the Request to USPS.com";
							$error = true;
						}
					}

				}

				if( $error ) {
					// comment out, if you don't want the Errors to be shown!!
					$vmLogger->err( $html );
					// Switch to StandardShipping on Error !!!
					require_once( CLASSPATH . 'shipping/standard_shipping.php' );
					$shipping =& new standard_shipping();
					$shipping->list_rates( $d );
					return;
				}
				// retrieve the service and postage items
				if( isset( $xmlDoc)) {
					$ship_service = $xmlDoc->getElementsByTagName( "Service" );
					$ship_service = $ship_service->item(0);
					$ship_service = $ship_service->getText();

					$ship_postage = $xmlDoc->getElementsByTagName( "Postage" );
					$ship_postage = $ship_postage->item(0);
					$ship_postage = $ship_postage->getText();
					$ship_postage = $ship_postage + intval( USPS_HANDLINGFEE );
				}
				/******END OF DOMESTIC RATE******/
			}
			else
			{
				/******START INTERNATIONAL RATE******/
				$ship_service = "Priority";
				$ship_postage = ($usps_intllbrate * $shipping_pounds_intl) + $usps_intlhandlingfee;
				/******END INTERNATIONAL RATE******/
			}

			$html = "";

			// USPS returns Charges in USD.
			$charge = $ship_postage;
			$ship_postage = $CURRENCY_DISPLAY->getFullValue($charge);

			$shipping_rate_id = urlencode($this->classname."|USPS|".$ship_service."|".$charge);
			//$checked = (@$d["shipping_rate_id"] == $value) ? "checked=\"checked\"" : "";
			$html .= "\n<input type=\"radio\" name=\"shipping_rate_id\" checked=\"checked\" value=\"$shipping_rate_id\" />\n";

			$_SESSION[$shipping_rate_id] = 1;

			$html .= "USPS ".$ship_service." ";
			$html .= "<strong>(".$ship_postage.")</strong>";
			$html .= "<br />";
		}
		echo $html;
		return true;
	} //end function list_rates


	function get_rate( &$d ) {

		$shipping_rate_id = $d["shipping_rate_id"];
		$is_arr = explode("|", urldecode(urldecode($shipping_rate_id)) );
		$order_shipping = $is_arr[3];

		return $order_shipping;

	} //end function get_rate


	function get_tax_rate() {

		/** Read current Configuration ***/
		require_once(CLASSPATH ."shipping/".$this->classname.".cfg.php");

		if( intval(USPS_TAX_CLASS)== 0 )
		return( 0 );
		else {
			require_once( CLASSPATH. "ps_tax.php" );
			$tax_rate = ps_tax::get_taxrate_by_id( intval(USPS_TAX_CLASS) );
			return $tax_rate;
		}
	}

	/**
    * Validate this Shipping method by checking if the SESSION contains the key
    * @returns boolean False when the Shipping method is not in the SESSION
    */
	function validate( $d ) {

		$shipping_rate_id = $d["shipping_rate_id"];

		if( array_key_exists( $shipping_rate_id, $_SESSION ))
		return true;
		else
		return false;
	} //end function validate

	/**
    * Show all configuration parameters for this Shipping method
    * @returns boolean False when the Shipping method has no configration
    */
	function show_configuration() {

		global $VM_LANG;
		/** Read current Configuration ***/
		require_once(CLASSPATH ."shipping/".$this->classname.".cfg.php");
    ?>
	<table>
    <tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_USERNAME ?></strong></td>
		<td>
            <input type="text" name="USPS_USERNAME" class="inputbox" value="<? echo USPS_USERNAME ?>" />
		</td>
		<td>
          <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_USERNAME_TOOLTIP) ?>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_PASSWORD" class="inputbox" value="<? echo USPS_PASSWORD ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD_TOOLTIP) ?>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_SERVER" class="inputbox" value="<? echo USPS_SERVER ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER_TOOLTIP) ?>
        </td>
    </tr>
	<tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_PATH" class="inputbox" value="<? echo USPS_PATH ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH_TOOLTIP) ?>
        </td>
    </tr>
	<tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_CONTAINER ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_CONTAINER" class="inputbox" value="<? echo USPS_CONTAINER ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_CONTAINER_TOOLTIP) ?>
        </td>
    </tr>
	<tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_PACKAGESIZE" class="inputbox" value="<? echo USPS_PACKAGESIZE ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE_TOOLTIP) ?>
        </td>
    </tr>
	<tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGEID ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_PACKAGEID" class="inputbox" value="<? echo USPS_PACKAGEID ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGEID_TOOLTIP) ?>
        </td>
    </tr>
	<tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SHIPSERVICE ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_SHIPSERVICE" class="inputbox" value="<? echo USPS_SHIPSERVICE ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SHIPSERVICE_TOOLTIP) ?>
        </td>
    </tr>
	  <tr>
		<td><strong><?php echo $VM_LANG->_PHPSHOP_UPS_TAX_CLASS ?></strong></td>
		<td>
		  <?php
		  require_once(CLASSPATH.'ps_tax.php');
		  ps_tax::list_tax_value("USPS_TAX_CLASS", USPS_TAX_CLASS) ?>
		</td>
		<td><?php echo mm_ToolTip($VM_LANG->_PHPSHOP_UPS_TAX_CLASS_TOOLTIP) ?><td>
	  </tr>	
		<tr>
		  <td colspan="3"><hr /></td>
		</tr>
	<tr>
	  <td><strong><?php echo $VM_LANG->_PHPSHOP_USPS_HANDLING_FEE ?></strong></td>
	  <td><input class="inputbox" type="text" name="USPS_HANDLINGFEE" value="<?php echo USPS_HANDLINGFEE ?>" /></td>
	  <td><?php echo mm_ToolTip($VM_LANG->_PHPSHOP_USPS_HANDLING_FEE_TOOLTIP) ?></td>
	</tr>
	<tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLLBRATE ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_INTLLBRATE" class="inputbox" value="<? echo USPS_INTLLBRATE ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLLBRATE_TOOLTIP) ?>
        </td>
    </tr>
	<tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_INTLHANDLINGFEE" class="inputbox" value="<? echo USPS_INTLHANDLINGFEE ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE_TOOLTIP) ?>
        </td>
    </tr>
	</table>
   <?php
   // return false if there's no configuration
   return true;
	} //end function show_configuration

	/**
  * Returns the "is_writeable" status of the configuration file
  * @param void
  * @returns boolean True when the configuration file is writeable, false when not
  */
	function configfile_writeable() {
		return is_writeable( CLASSPATH."shipping/".$this->classname.".cfg.php" );
	} //end function configfile_writable

	/**
	* Writes the configuration file for this shipping method
	* @param array An array of objects
	* @returns boolean True when writing was successful
	*/
	function write_configuration( &$d ) {
	    global $vmLogger;

		$my_config_array = array("USPS_USERNAME" => $d['USPS_USERNAME'],
		"USPS_PASSWORD" => $d['USPS_PASSWORD'],
		"USPS_SERVER" => $d['USPS_SERVER'],
		"USPS_PATH" => $d['USPS_PATH'],
		"USPS_CONTAINER" => $d['USPS_CONTAINER'],
		"USPS_PACKAGESIZE" => $d['USPS_PACKAGESIZE'],
		"USPS_PACKAGEID" => $d['USPS_PACKAGEID'],
		"USPS_SHIPSERVICE" => $d['USPS_SHIPSERVICE'],
		"USPS_TAX_CLASS" => $d['USPS_TAX_CLASS'],
		"USPS_HANDLINGFEE" => $d['USPS_HANDLINGFEE'],
		"USPS_INTLLBRATE" => $d['USPS_INTLLBRATE'],
		"USPS_INTLHANDLINGFEE" => $d['USPS_INTLHANDLINGFEE']
		);
		$config = "<?php\n";
		$config .= "defined('_VALID_MOS') or die('Direct Access to this location is not allowed.'); \n\n";
		foreach( $my_config_array as $key => $value ) {
			$config .= "define ('$key', '$value');\n";
		}

		$config .= "?>";

		if ($fp = fopen(CLASSPATH ."shipping/".$this->classname.".cfg.php", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
			return true;
		}
		else {
			$vmLogger->err( "Error writing to configuration file" );
			return false;
		}
	} //end function write_configuration

}
?>
