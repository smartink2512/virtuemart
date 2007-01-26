<?php
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');
/**
*
* @version $Id$
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
	var $ship_type = Array();

	function usps() {
		/** Read current Configuration ***/
		require_once(CLASSPATH ."shipping/".$this->classname.".cfg.php");
		$this->ship_type["local"] = Array();
		$this->ship_type["intl"] = Array();
/*
		$this->ship_type['local']['Express Mail PO to Addressee'] = USPS_LOCAL_EMPO;
		$this->ship_type['local']['Express Mail Flat Rate Envelope (12.5" x 9.5")'] = USPS_LOCAL_EMFRE;
		$this->ship_type['local']['Priority Mail'] = USPS_LOCAL_PRIORITY;
		$this->ship_type['local']['Priority Mail Flat Rate Envelope (12.5" x 9.5")'] = USPS_LOCAL_PMFRE;
		$this->ship_type['local']['Priority Mail Flat Rate Box (11.25" x 8.75" x 6")'] = USPS_LOCAL_PMFRB1;
		$this->ship_type['local']['Priority Mail Flat Rate Box (14" x 12" x 3.5")'] = USPS_LOCAL_PMFRB2;
		$this->ship_type['local']['First-Class Mail'] = USPS_LOCAL_FCM;
		$this->ship_type['local']['Parcel Post'] = USPS_LOCAL_PP;
		$this->ship_type['local']['Bound Printed Matter'] = USPS_LOCAL_BPM;
		$this->ship_type['local']['Media Mail'] = USPS_LOCAL_MM;
		$this->ship_type['local']['Library Mail'] = USPS_LOCAL_LM;
		$this->ship_type['intl']['Global Express Guaranteed Document Service'] = USPS_INTL_GEGDS;
		$this->ship_type['intl']['Global Express Guaranteed Non-Document Service'] = USPS_INTL_GEGNDS;
		$this->ship_type['intl']['Global Express Mail (EMS)'] = USPS_INTL_GEM;
		$this->ship_type['intl']['Global Priority Mail - Flat-rate Envelope (Large)'] = USPS_INTL_GPM_FRE_LRG;
		$this->ship_type['intl']['Global Priority Mail - Flat-rate Envelope (Small)'] = USPS_INTL_GPM_FRE_SML;
		$this->ship_type['intl']['Global Priority Mail - Variable Weight (Single)'] = USPS_INTL_GPM_VW;
		$this->ship_type['intl']['Airmail Letter Post'] = USPS_INTL_AIR_POST;
		$this->ship_type['intl']['Economy (Surface) Letter Post'] = USPS_INTL_SURFACE_POST;
*/
		$this->ship_type['local']['Express Mail PO to Addressee'] = array(USPS_LOCAL_EMPO, 'USPS_LOCAL_EMPO');
		$this->ship_type['local']['Express Mail Flat Rate Envelope (12.5" x 9.5")'] = array(USPS_LOCAL_EMFRE, 'USPS_LOCAL_EMFRE');
		$this->ship_type['local']['Priority Mail'] = array(USPS_LOCAL_PRIORITY, 'USPS_LOCAL_PRIORITY');
		$this->ship_type['local']['Priority Mail Flat Rate Envelope (12.5" x 9.5")'] = array(USPS_LOCAL_PMFRE, 'USPS_LOCAL_PMFRE');
		$this->ship_type['local']['Priority Mail Flat Rate Box (11.25" x 8.75" x 6")'] = array(USPS_LOCAL_PMFRB1, 'USPS_LOCAL_PMFRB1');
		$this->ship_type['local']['Priority Mail Flat Rate Box (14" x 12" x 3.5")'] = array(USPS_LOCAL_PMFRB2, 'USPS_LOCAL_PMFRB2');
		$this->ship_type['local']['First-Class Mail'] = array(USPS_LOCAL_FCM, 'USPS_LOCAL_FCM');
		$this->ship_type['local']['Parcel Post'] = array(USPS_LOCAL_PP, 'USPS_LOCAL_PP');
		$this->ship_type['local']['Bound Printed Matter'] = array(USPS_LOCAL_BPM, 'USPS_LOCAL_BPM');
		$this->ship_type['local']['Media Mail'] = array(USPS_LOCAL_MM, 'USPS_LOCAL_MM');
		$this->ship_type['local']['Library Mail'] = array(USPS_LOCAL_LM, 'USPS_LOCAL_LM');
		$this->ship_type['intl']['Global Express Guaranteed Document Service'] = array(USPS_INTL_GEGDS, 'USPS_INTL_GEGDS');
		$this->ship_type['intl']['Global Express Guaranteed Non-Document Service'] = array(USPS_INTL_GEGNDS, 'USPS_INTL_GEGNDS');
		$this->ship_type['intl']['Global Express Mail (EMS)'] = array(USPS_INTL_GEM, 'USPS_INTL_GEM');
		$this->ship_type['intl']['Global Priority Mail - Flat-rate Envelope (Large)'] = array(USPS_INTL_GPM_FRE_LRG, 'USPS_INTL_GPM_FRE_LRG');
		$this->ship_type['intl']['Global Priority Mail - Flat-rate Envelope (Small)'] = array(USPS_INTL_GPM_FRE_SML, 'USPS_INTL_GPM_FRE_SML');
		$this->ship_type['intl']['Global Priority Mail - Variable Weight (Single)'] = array(USPS_INTL_GPM_VW, 'USPS_INTL_GPM_VW');
		$this->ship_type['intl']['Airmail Letter Post'] = array(USPS_INTL_AIR_POST, 'USPS_INTL_AIR_POST');
		$this->ship_type['intl']['Economy (Surface) Letter Post'] = array(USPS_INTL_SURFACE_POST, 'USPS_INTL_SURFACE_POST');


	}

	function list_rates( &$d ) {
		global $vendor_country_2_code, $vendor_currency, $vmLogger;
		global $VM_LANG, $CURRENCY_DISPLAY, $mosConfig_absolute_path;
		$db =& new ps_DB;
		$dbv =& new ps_DB;

		$cart = $_SESSION['cart'];


		$q  = "SELECT * FROM `#__{vm}_user_info`, `#__{vm}_country` WHERE user_info_id='" . $d["ship_to_info_id"]."' AND ( country=country_2_code OR country=country_3_code)";
		$db->query($q);
		$db->next_record();

		$q  = "SELECT * FROM #__{vm}_vendor WHERE vendor_id='".$_SESSION['ps_vendor_id']."'";
		$dbv->query($q);
		$dbv->next_record();

		$order_weight = $d['weight'];

		if($order_weight > 0) {
			if( $order_weight > 150.00 ) {
				$order_weight = 150.00;
			}

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
			$dest_country_name = $db->f("country_name");
			$dest_state = $db->f("state");
			$dest_zip = $db->f("zip");
			//$weight_measure
			$shipping_pounds_intl = ceil ($order_weight);
			$shipping_pounds = floor ($order_weight);
			$shipping_ounces = round(16 * ($order_weight - floor($order_weight)));

			$os = array("Mac", "NT", "Irix", "Linux");
			$states = array('AL', "AK","AR","AZ","CA","CO","CT","DC","DE","FL","GA","HI","IA","ID","IL","IN","KS","KY","LA","MA","MD","ME","MI","MN","MO","MS","MT","NC","ND","NE","NH","NJ","NM","NV","NY","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VT","VA","WA","WI","WV","WY");
			if( ($dest_country == "USA" || $dest_country == "US") && in_array($dest_state,$states) )
			{
				$is_intl = 0;
				$ship_array = 'local';
				$xmlPost = 'API=RateV2&XML=<RateV2Request USERID="897DWELL1811" PASSWORD="125MF48YW809">'.
				'<Package ID="'.$usps_packageid.'">'.
				'<Service>All</Service>'.
				'<ZipOrigination>'.$source_zip.'</ZipOrigination>'.
				'<ZipDestination>'.$dest_zip.'</ZipDestination>'.
				'<Pounds>'.$shipping_pounds.'</Pounds>'.
				'<Ounces>'.$shipping_ounces.'</Ounces>'.
				'<Size>'.$usps_packagesize.'</Size>'.
				'<Machinable>TRUE</Machinable>'.
				'</Package>'.
				'</RateV2Request>';
			}
			else
			{
				$is_intl = 1;
				$ship_array = 'intl';
				$xmlPost = 'API=IntlRate&XML=<IntlRateRequest USERID="897DWELL1811" PASSWORD="125MF48YW809">'.
				'<Package ID="'.$usps_packageid.'">'.
				"<Pounds>$shipping_pounds</Pounds>".
				"<Ounces>$shipping_ounces</Ounces>".
				"<MailType>Envelope</MailType>".
				"<Country>$dest_country_name</Country>".
				"</Package>".
				"</IntlRateRequest>";
			}

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

			} //if( function_exists( "curl_init" ))
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

			} //if( function_exists( "curl_init" ))

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
			if (isset($xmlDoc))
			{
				if ($is_intl) {
					$pst_main = "Service";
					$pst_desc = "SvcDescription";
					$pst_cost = "Postage";
					$pst_time = "SvcCommitments";
				}
				else {
					$pst_main = "Postage";
					$pst_desc = "MailService";
					$pst_cost = "Rate";
					$pst_time = "";
				}
					
				$postage= $xmlDoc->getElementsByTagName($pst_main);
				$postage_max=$postage->getLength();
				for ($postage_count=0; $postage_count < $postage_max; $postage_count++)
				{
					$post_type = $postage->item($postage_count);
					$ship_service = $post_type->getElementsByTagName($pst_desc);
					$ship_service = $ship_service->item(0);
					$ship_service = $ship_service->getText();

					if ($this->ship_type[$ship_array][$ship_service][0]!=1)
						continue;
				
					$ship_postage = $post_type->getElementsByTagName($pst_cost);
					$ship_postage = $ship_postage->item(0);
					$ship_postage = $ship_postage->getText();
					
					if ($pst_time) {
						$ship_time = $post_type->getElementsByTagName($pst_time);
						$ship_time = $ship_time->item(0);
						$ship_time = $ship_time->getText();
					}

					
					$charge = $ship_postage;
					$ship_postage = $CURRENCY_DISPLAY->getFullValue($charge);
					$_rate_id = urlencode($this->classname."|USPS|".$ship_service."|".$charge);
					$checked = (@$d["shipping_rate_id"] == $value) ? "checked=\"checked\"" : "";
					$html .= "\n<input type=\"radio\" name=\"shipping_rate_id\" $checked value=\"$_rate_id\" /> ".
						"USPS $ship_service: <strong>$ship_time ($ship_postage)</strong><br />";
					$_SESSION[$_rate_id] = 1;
				}
					
			}
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
            <input type="text" name="USPS_USERNAME" class="inputbox" value="<?php echo USPS_USERNAME ?>" />
		</td>
		<td>
          <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_USERNAME_TOOLTIP) ?>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_PASSWORD" class="inputbox" value="<?php echo USPS_PASSWORD ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD_TOOLTIP) ?>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_SERVER" class="inputbox" value="<?php echo USPS_SERVER ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER_TOOLTIP) ?>
        </td>
    </tr>
	<tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_PATH" class="inputbox" value="<?php echo USPS_PATH ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH_TOOLTIP) ?>
        </td>
    </tr>
	<tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_CONTAINER ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_CONTAINER" class="inputbox" value="<?php echo USPS_CONTAINER ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_CONTAINER_TOOLTIP) ?>
        </td>
    </tr>
	<tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_PACKAGESIZE" class="inputbox" value="<?php echo USPS_PACKAGESIZE ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE_TOOLTIP) ?>
        </td>
    </tr>
	<tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGEID ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_PACKAGEID" class="inputbox" value="<?php echo USPS_PACKAGEID ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGEID_TOOLTIP) ?>
        </td>
    </tr>
    <!--
	<tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SHIPSERVICE ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_SHIPSERVICE" class="inputbox" value="<?php echo USPS_SHIPSERVICE ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SHIPSERVICE_TOOLTIP) ?>
        </td>
    </tr>
    -->
	<tr>
	  <td colspan="2" align="center" style="border-bottom: #c1c1c1 solid 1px">
	    <strong>USPS Local Shipping</strong>
	  </td>
	</tr>
<?php	foreach ($this->ship_type['local'] as $key => $value) { ?>
	<tr>
	  <td align="right"><strong><?php echo $key ?></strong></td>
	  <td><input type="checkbox" value="1" name="<?php echo $value[1]?>" <?php echo ($value[0]) ? "checked" : "" ?> /></td>
	</tr>

<?php	} ?>
	<tr>
	  <td colspan="2" align="center" style="border-bottom: #c1c1c1 solid 1px">
	    <strong>USPS International Shipping</strong>
	  </td>
	</tr>
<?php	foreach ($this->ship_type['intl'] as $key => $value) { ?>
	<tr>
	  <td align="right"><strong><?php echo $key?></strong></td>
	  <td><input type="checkbox" value="1" name="<?php echo $value[1]?>" <?php echo ($value[0]) ? "checked" : "" ?> /></td>
	</tr>
<?php	} ?>
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
            <input type="text" name="USPS_INTLLBRATE" class="inputbox" value="<?php echo USPS_INTLLBRATE ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLLBRATE_TOOLTIP) ?>
        </td>
    </tr>
	<tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE ?></strong>
		</td>
		<td>
            <input type="text" name="USPS_INTLHANDLINGFEE" class="inputbox" value="<?php echo USPS_INTLHANDLINGFEE ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE_TOOLTIP) ?>
        </td>
    </tr>
		<tr>
		  <td colspan="3"><hr /></td>
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
		"USPS_INTLHANDLINGFEE" => $d['USPS_INTLHANDLINGFEE'],
		"USPS_LOCAL_EMPO" => $d['USPS_LOCAL_EMPO'],
		"USPS_LOCAL_EMFRE" => $d['USPS_LOCAL_EMFRE'],
		"USPS_LOCAL_PRIORITY" => $d['USPS_LOCAL_PRIORITY'],
		"USPS_LOCAL_PMFRE" => $d['USPS_LOCAL_PMFRE'],
		"USPS_LOCAL_PMFRB1" => $d['USPS_LOCAL_PMFRB1'],
		"USPS_LOCAL_PMFRB2" => $d['USPS_LOCAL_PMFRB2'],
		"USPS_LOCAL_FCM" => $d['USPS_LOCAL_FCM'],
		"USPS_LOCAL_PP" => $d['USPS_LOCAL_PP'],
		"USPS_LOCAL_BPM" => $d['USPS_LOCAL_BPM'],
		"USPS_LOCAL_MM" => $d['USPS_LOCAL_MM'],
		"USPS_LOCAL_LM" => $d['USPS_LOCAL_LM'],
		"USPS_INTL_GEGDS" => $d['USPS_INTL_GEGDS'],
		"USPS_INTL_GEGNDS" => $d['USPS_INTL_GEGNDS'],
		"USPS_INTL_GEM" => $d['USPS_INTL_GEM'],
		"USPS_INTL_GPM_FRE_LRG" => $d['USPS_INTL_GPM_FRE_LRG'],
		"USPS_INTL_GPM_FRE_SML" => $d['USPS_INTL_GPM_FRE_SML'],
		"USPS_INTL_GPM_VW" => $d['USPS_INTL_GPM_VW'],
		"USPS_INTL_AIR_POST" => $d['USPS_INTL_AIR_POST'],
		"USPS_INTL_SURFACE_POST" => $d['USPS_INTL_SURFACE_POST']
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
