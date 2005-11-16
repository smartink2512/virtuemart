<?php
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.'); 
/**
*
* @version $Id: ups.php,v 1.3 2005/09/29 20:02:18 soeren_nb Exp $
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
* using a part of the UPS Online(R) Tools:
* = Rates and Service Selection =
*
* UPS OnLine(R) is a registered trademark of United Parcel Service of America. 
*
*/
class ups {

  var $classname = "ups";
  
  function list_rates( &$d ) {
	global $vendor_country_2_code, $vendor_currency, $vmLogger; 
	global $VM_LANG, $CURRENCY_DISPLAY, $mosConfig_absolute_path;
	$db =& new ps_DB;
	$dbv =& new ps_DB;
	
	$cart = $_SESSION['cart'];
	
	/** Read current Configuration ***/
	require_once(CLASSPATH ."shipping/".$this->classname.".cfg.php");

    $q  = "SELECT * FROM #__{vm}_user_info, #__{vm}_country WHERE user_info_id='" . $d["ship_to_info_id"]."' AND ( country=country_2_code OR country=country_3_code)";
	$db->query($q);
	
	$q  = "SELECT * FROM #__{vm}_vendor WHERE vendor_id='".$_SESSION['ps_vendor_id']."'";
	$dbv->query($q);
	$dbv->next_record();  
	
	$order_weight = $d['weight'];  

	if($order_weight > 0) {
	  if( $order_weight > 150.00 )
		$order_weight = 150.00;
		
	  //Access code for online tools at ups.com
	  $ups_access_code = UPS_ACCESS_CODE;
		
	  //Username from registering for online tools at ups.com
	  $ups_user_id = UPS_USER_ID;
		
	  //Password from registering for online tools at ups.com
	  $ups_user_password = UPS_PASSWORD;
		
	  //Title for your request
	  $request_title = "Shipping Estimate";
		
	  //The zip that you are shipping from
	  $source_zip = $dbv->f("vendor_zip");
		
	  //The zip that you are shipping to
	  $dest_country = $db->f("country_2_code");
	  $dest_zip = $db->f("zip");
	   
	  //LBS  = Pounds
	  //KGS  = Kilograms
	  $weight_measure = (WEIGHT_UOM == 'KG') ? "KGS" : "LBS";
  
	  // The XML that will be posted to UPS
	  $xmlPost  = "<?xml version=\"1.0\"?>";
	  $xmlPost .= "<AccessRequest xml:lang=\"en-US\">";
	  $xmlPost .= " <AccessLicenseNumber>".$ups_access_code."</AccessLicenseNumber>";
	  $xmlPost .= " <UserId>".$ups_user_id."</UserId>";
	  $xmlPost .= " <Password>".$ups_user_password."</Password>";
	  $xmlPost .= "</AccessRequest>";
	  $xmlPost .= "<?xml version=\"1.0\"?>";
	  $xmlPost .= "<RatingServiceSelectionRequest xml:lang=\"en-US\">";
	  $xmlPost .= " <Request>";
	  $xmlPost .= "  <TransactionReference>";
	  $xmlPost .= "  <CustomerContext>".$request_title."</CustomerContext>";
	  $xmlPost .= "  <XpciVersion>1.0001</XpciVersion>";
	  $xmlPost .= "  </TransactionReference>";
	  $xmlPost .= "  <RequestAction>rate</RequestAction>";
	  $xmlPost .= "  <RequestOption>shop</RequestOption>";
	  $xmlPost .= " </Request>";
	  $xmlPost .= " <PickupType>";
	  $xmlPost .= "  <Code>".UPS_PICKUP_TYPE."</Code>";
	  $xmlPost .= " </PickupType>";
	  $xmlPost .= " <Shipment>";
	  $xmlPost .= "  <Shipper>";
	  $xmlPost .= "   <Address>";
	  $xmlPost .= "    <PostalCode>".$source_zip."</PostalCode>";
	  $xmlPost .= "    <CountryCode>$vendor_country_2_code</CountryCode>";
	  $xmlPost .= "   </Address>";
	  $xmlPost .= "  </Shipper>";
	  $xmlPost .= "  <ShipTo>";
	  $xmlPost .= "   <Address>";
	  $xmlPost .= "    <PostalCode>".$dest_zip."</PostalCode>";
	  $xmlPost .= "    <CountryCode>$dest_country</CountryCode>";
	  if( UPS_RESIDENTIAL=="yes" )
		$xmlPost .= "    <ResidentialAddressIndicator/>";
	  $xmlPost .= "   </Address>";
	  $xmlPost .= "  </ShipTo>";
	  $xmlPost .= "  <ShipFrom>";
	  $xmlPost .= "   <Address>";
	  $xmlPost .= "    <PostalCode>".$source_zip."</PostalCode>";
	  $xmlPost .= "    <CountryCode>$vendor_country_2_code</CountryCode>";
	  $xmlPost .= "   </Address>";
	  $xmlPost .= "  </ShipFrom>";
	  
	  // Service is only required, if the Tag "RequestOption" contains the value "rate"
	  // We don't want a specific servive, but ALL Rates
	  //$xmlPost .= "  <Service>";
	  //$xmlPost .= "   <Code>".$shipping_type."</Code>";
	  //$xmlPost .= "  </Service>";
	  
	  $xmlPost .= "  <Package>";
	  $xmlPost .= "   <PackagingType>";
	  $xmlPost .= "    <Code>".UPS_PACKAGE_TYPE."</Code>";
	  $xmlPost .= "   </PackagingType>";
	  $xmlPost .= "   <PackageWeight>";
	  $xmlPost .= "    <UnitOfMeasurement>";
	  $xmlPost .= "     <Code>".$weight_measure."</Code>";
	  $xmlPost .= "    </UnitOfMeasurement>";
	  $xmlPost .= "    <Weight>".(int)$order_weight."</Weight>";
	  $xmlPost .= "   </PackageWeight>";
	  $xmlPost .= "  </Package>";
	  $xmlPost .= " </Shipment>";
	  $xmlPost .= "</RatingServiceSelectionRequest>";
	   
	  // echo htmlentities( $xmlPost );
	  $host = "www.ups.com";
	  $path = "/ups.app/xml/Rate";
	  $port = 443;
	  $protocol = "https";

	  // Using cURL is Up-To-Date and easier!!
	  if( function_exists( "curl_init" )) {
		$CR = curl_init();
		curl_setopt($CR, CURLOPT_URL, $protocol."://".$host.$path);
		curl_setopt($CR, CURLOPT_POST, 1);
		curl_setopt($CR, CURLOPT_FAILONERROR, true); 
		curl_setopt($CR, CURLOPT_POSTFIELDS, $xmlPost);
		curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);
		 
		// No PEER certificate validation...as we don't have 
		// a certificate file for it to authenticate the host www.ups.com against!
		curl_setopt($CR, CURLOPT_SSL_VERIFYPEER, 0);
		//curl_setopt($CR, CURLOPT_SSLCERT , "/usr/locale/xxxx/clientcertificate.pem");
		
		$xmlResult = curl_exec( $CR );
		
		$error = curl_error( $CR );
		if( !empty( $error )) {
		  $vmLogger->err( curl_error( $CR ) );
		  $html = "<br/><span class=\"message\">".$VM_LANG->_PHPSHOP_INTERNAL_ERROR." UPS.com</span>";
		  $error = true;
		}
		else {
		  /* XML Parsing */
		  require_once( $mosConfig_absolute_path. '/includes/domit/xml_domit_lite_include.php' );
		  $xmlDoc =& new DOMIT_Lite_Document();
		  $xmlDoc->parseXML( $xmlResult, false, true );
		  
		  /* Let's check wether the response from UPS is Success or Failure ! */
		  if( strstr( $xmlResult, "Failure" ) ) {
			$error = true;
			$html = "<span class=\"message\">".$VM_LANG->_PHPSHOP_UPS_RESPONSE_ERROR."</span><br/>";
			$error_code = $xmlDoc->getElementsByTagName( "ErrorCode" );
			$error_code = $error_code->item(0);
			$error_code = $error_code->getText();
			$html .= $VM_LANG->_PHPSHOP_ERROR_CODE.": ".$error_code."<br/>";
			
			$error_desc = $xmlDoc->getElementsByTagName( "ErrorDescription" );
			$error_desc = $error_desc->item(0);
			$error_desc = $error_desc->getText();
			$html .= $VM_LANG->_PHPSHOP_ERROR_DESC.": ".$error_desc."<br/>";
			
		  }

		}
		curl_close( $CR );
	   
	  }
	  else {

		$protocol = "ssl";
		$fp = fsockopen("$protocol://".$host, $port, $errno, $errstr, $timeout = 60);
		if( !$fp ) {
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
		  // Cut off the HTTP Header and get the Body
		  $xmlResult = trim(substr( $xmlResult, strpos( $xmlResult, "\r\n\r\n" )+2 ));
		  
		  if( stristr( $xmlResult, "Success" )) {		  
			/* XML Parsing */
			require_once( $mosConfig_absolute_path. '/includes/domit/xml_domit_lite_include.php' );
			$xmlDoc =& new DOMIT_Lite_Document();
			if( $xmlDoc->parseXML( $xmlResult, false, true ))
			  $error = false;
			else {
			  $error = true;
			  $html = "Error parsing the XML Response from UPS.com";
			}
		  }
		  else {
			$html = "Error processing the Request to UPS.com";
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
	  // retrieve the list of all "RatedShipment" Elements
	  $rate_list =& $xmlDoc->getElementsByTagName( "RatedShipment" );
	  
	  // Loop through the rate List
	  for ($i = 0; $i < $rate_list->getLength(); $i++) {
		  $currNode =& $rate_list->item($i);
		  
		  // First Element: Service Code
		  $shipment[$i]["ServiceCode"] = $currNode->childNodes[0]->getText();
		  
		  // Second Element: BillingWeight
		  $shipment[$i]["BillingWeight"] = $currNode->childNodes[1];
		  
		  // Third Element: TransportationCharges
		  $shipment[$i]["TransportationCharges"] = $currNode->childNodes[2];
		  $shipment[$i]["TransportationCharges"] = $shipment[$i]["TransportationCharges"]->getElementsByTagName("MonetaryValue");
		  $shipment[$i]["TransportationCharges"] = $shipment[$i]["TransportationCharges"]->item(0);
		  $shipment[$i]["TransportationCharges"] = $shipment[$i]["TransportationCharges"]->getText();
		  
		  // Fourth Element: ServiceOptionsCharges
		  $shipment[$i]["ServiceOptionsCharges"] = $currNode->childNodes[3];
		  
		  // Fifth Element: TotalCharges
		  $shipment[$i]["TotalCharges"] = $currNode->childNodes[4];
		  
		  // Sixth Element: GuarenteedDaysToDelivery
		  $shipment[$i]["GuaranteedDaysToDelivery"] = $currNode->childNodes[5]->getText();
		  
		  // Seventh Element: ScheduledDeliveryTime
		  $shipment[$i]["ScheduledDeliveryTime"] = $currNode->childNodes[6]->getText();
		  
		  // Eighth Element: RatedPackage
		  $shipment[$i]["RatedPackage"] = $currNode->childNodes[7];
		  
		  // map ServiceCode to ServiceName
		  switch( $shipment[$i]["ServiceCode"] ) {

			  case "01": $shipment[$i]["ServiceName"] = "UPS Next Day Air"; break;
			  case "02": $shipment[$i]["ServiceName"] = "UPS 2nd Day Air"; break;
			  case "03": $shipment[$i]["ServiceName"] = "UPS Ground"; break;
			  case "07": $shipment[$i]["ServiceName"] = "UPS Worldwide Express SM"; break;
			  case "08": $shipment[$i]["ServiceName"] = "UPS Worldwide Expedited SM"; break;
			  case "11": $shipment[$i]["ServiceName"] = "UPS Standard"; break;
			  case "12": $shipment[$i]["ServiceName"] = "UPS 3 Day Select"; break;
			  case "13": $shipment[$i]["ServiceName"] = "UPS Next Day Air Saver"; break;
			  case "14": $shipment[$i]["ServiceName"] = "UPS Next Day Air Early A.M."; break;
			  case "54": $shipment[$i]["ServiceName"] = "UPS Worldwide Express Plus SM"; break;
			  case "59": $shipment[$i]["ServiceName"] = "UPS 2nd Day Air A.M."; break;
			  case "64": $shipment[$i]["ServiceName"] = "n/a"; break;
			  case "65": $shipment[$i]["ServiceName"] = "UPS Express Saver"; break;
			  
		  }
		  unset( $currNode );
	  }
	  $html = "";
	  
	  // UPS returns Charges in USD ONLY. 
	  // So we have to convert from USD to Vendor Currency if necessary
	  if( $_SESSION['vendor_currency'] != "USD" ) {
		
		require_once( CLASSPATH. "currency_convert.php" );
		$convert = true;
	  }
	  else
		$convert = false;
		
	  if ( $_SESSION['auth']['show_price_including_tax'] != 1 ) {
		$taxrate = 1;
	  }
	  else {
		$taxrate = $this->get_tax_rate() + 1;
	  }
	  
	  foreach( $shipment as $key => $value ) {
		  if( $convert ) {
			$tmp = convertECB( $value['TransportationCharges'], "USD", $vendor_currency );
			
			
			// tmp is empty when the Vendor Currency could not be converted!!!!
			if( !empty( $tmp )) {
			  // add Handling Fee
			  $charge = $tmp + intval( UPS_HANDLING_FEE );
			  $value['TransportationCharges'] = $CURRENCY_DISPLAY->getFullValue($tmp);
			}
			// So let's show the value in $$$$
			else {
			  $charge = $value['TransportationCharges'] + intval( UPS_HANDLING_FEE );
			  $charge *= $taxrate;
			  $value['TransportationCharges'] = $value['TransportationCharges']. " USD";
			}
			
		  }
		  else {
			$charge = $value['TransportationCharges'] + intval( UPS_HANDLING_FEE );
			$charge *= $taxrate;
			$value['TransportationCharges'] = $CURRENCY_DISPLAY->getFullValue($charge);
		  }
		  $shipping_rate_id = urlencode($this->classname."|UPS|".$value['ServiceName']."|".$charge);
		  $checked = (@$d["shipping_rate_id"] == $value) ? "checked=\"checked\"" : "";
		  $html .= "\n<input type=\"radio\" name=\"shipping_rate_id\" $checked value=\"$shipping_rate_id\" />\n";
		  
		  $_SESSION[$shipping_rate_id] = 1;
		  
		  $html .= $value['ServiceName']." ";
		  $html .= "<strong>(".$value['TransportationCharges'].")</strong>";
		  if( !empty($value['GuaranteedDaysToDelivery'])) {
			$html .= "&nbsp;&nbsp;-&nbsp;&nbsp;".$value['GuaranteedDaysToDelivery']." ".$VM_LANG->_PHPSHOP_UPS_SHIPPING_GUARANTEED_DAYS;
		  }
		  $html .= "<br />";
		  
	  }
	}
	echo $html;
	return true;
  }
	
  function get_rate( &$d ) {	
  
	$shipping_rate_id = $d["shipping_rate_id"];
	$is_arr = explode("|", urldecode(urldecode($shipping_rate_id)) );
	$order_shipping = $is_arr[3];
	
	return $order_shipping;
	
  }
	
  function get_tax_rate() {
	
    /** Read current Configuration ***/
	require_once(CLASSPATH ."shipping/".$this->classname.".cfg.php");
	
	if( intval(UPS_TAX_CLASS)== 0 )
	  return( 0 );
	else {
	  require_once( CLASSPATH. "ps_tax.php" );
	  $tax_rate = ps_tax::get_taxrate_by_id( intval(UPS_TAX_CLASS) );
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
	}
	
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
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE ?></strong></td>
		<td>
            <input type="text" name="UPS_ACCESS_CODE" class="inputbox" value="<? echo UPS_ACCESS_CODE ?>" />
		</td>
		<td>
          <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_ACCESS_CODE_EXPLAIN) ?>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID ?></strong>
		</td>
		<td>
            <input type="text" name="UPS_USER_ID" class="inputbox" value="<? echo UPS_USER_ID ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_USER_ID_EXPLAIN) ?>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD ?></strong>
		</td>
		<td>
            <input type="text" name="UPS_PASSWORD" class="inputbox" value="<? echo UPS_PASSWORD ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS_PASSWORD_EXPLAIN) ?>
        </td>
    </tr>
	<tr>
	  <td><strong><?php echo $VM_LANG->_PHPSHOP_UPS_PICKUP_METHOD ?></strong></td>
	  <td>
		<select class="inputbox" name="pickup_type">
		  <option <?php if(UPS_PICKUP_TYPE=="01") echo "selected=\"selected\"" ?> value="01">Daily Pickup</option>
		  <option <?php if(UPS_PICKUP_TYPE=="03") echo "selected=\"selected\"" ?> value="03">Customer Counter</option>
		  <option <?php if(UPS_PICKUP_TYPE=="06") echo "selected=\"selected\"" ?> value="06">One Time Pickup</option>
		  <option <?php if(UPS_PICKUP_TYPE=="07") echo "selected=\"selected\"" ?> value="07">On Call Air Pickup</option>
		  <option <?php if(UPS_PICKUP_TYPE=="19") echo "selected=\"selected\"" ?> value="19">Letter Center</option>
		  <option <?php if(UPS_PICKUP_TYPE=="20") echo "selected=\"selected\"" ?> value="20">Air Service Center</option>
		</select>
	  </td>
	  <td><?php echo mm_ToolTip($VM_LANG->_PHPSHOP_UPS_PICKUP_METHOD_TOOLTIP) ?></td>
	</tr>
	  <td><strong><?php echo $VM_LANG->_PHPSHOP_UPS_PACKAGE_TYPE ?></strong></td>
	  <td>
		<select class="inputbox" name="package_type">
		  <option <?php if(UPS_PACKAGE_TYPE=="00") echo "selected=\"selected\"" ?> value="00">Unknown
		  <option <?php if(UPS_PACKAGE_TYPE=="01") echo "selected=\"selected\"" ?> value="01">UPS letter</option>
		  <option <?php if(UPS_PACKAGE_TYPE=="02") echo "selected=\"selected\"" ?> value="02">Package</option>
		  <option <?php if(UPS_PACKAGE_TYPE=="03") echo "selected=\"selected\"" ?> value="03">UPS Tube</option>
		  <option <?php if(UPS_PACKAGE_TYPE=="04") echo "selected=\"selected\"" ?> value="04">UPS Pak</option>
		  <option <?php if(UPS_PACKAGE_TYPE=="21") echo "selected=\"selected\"" ?> value="21">UPS Express Box</option>
		  <option <?php if(UPS_PACKAGE_TYPE=="24") echo "selected=\"selected\"" ?> value="24">UPS 25Kg Box</option>
		  <option <?php if(UPS_PACKAGE_TYPE=="25") echo "selected=\"selected\"" ?> value="25">UPS 10Kg Box</option>
		</select>
	  </td>
	  <td><?php echo mm_ToolTip($VM_LANG->_PHPSHOP_UPS_PACKAGE_TYPE_TOOLTIP) ?></td>
	</tr>
	<tr>
	  <td><strong><?php echo $VM_LANG->_PHPSHOP_UPS_TYPE_RESIDENTIAL ?></strong></td>
	  <td>
		<select class="inputbox" name="residential">
			<option <?php if(UPS_RESIDENTIAL=="yes") echo "selected=\"selected\"" ?> value="yes"><?php echo $VM_LANG->_PHPSHOP_UPS_RESIDENTIAL ?></option>
			<option <?php if(UPS_RESIDENTIAL=="no") echo "selected=\"selected\"" ?> value="no"><?php echo $VM_LANG->_PHPSHOP_UPS_COMMERCIAL ?></option>
		</select>
	  </td>
	  <td><?php echo mm_ToolTip($VM_LANG->_PHPSHOP_UPS_RESIDENTIAL_TOOLTIP) ?></td>
	</tr>
	<tr>
	  <td><strong><?php echo $VM_LANG->_PHPSHOP_UPS_HANDLING_FEE ?></strong></td>
	  <td><input class="inputbox" type="text" name="handling_fee" value="<?php echo UPS_HANDLING_FEE ?>" /></td>
	  <td><?php echo mm_ToolTip($VM_LANG->_PHPSHOP_UPS_HANDLING_FEE_TOOLTIP) ?></td>
	</tr>
	<tr>
	  <td><strong><?php echo $VM_LANG->_PHPSHOP_UPS_TAX_CLASS ?></strong></td>
	  <td>
        <?php
        require_once(CLASSPATH.'ps_tax.php');
        ps_tax::list_tax_value("tax_class", UPS_TAX_CLASS) ?>
	  </td>
	  <td><?php echo mm_ToolTip($VM_LANG->_PHPSHOP_UPS_TAX_CLASS_TOOLTIP) ?><td>
	</tr>	
	</table>
   <?php
      // return false if there's no configuration
      return true;
   }
  /**
  * Returns the "is_writeable" status of the configuration file
  * @param void
  * @returns boolean True when the configuration file is writeable, false when not
  */
   function configfile_writeable() {
      return is_writeable( CLASSPATH."shipping/".$this->classname.".cfg.php" );
   }
   
	/**
	* Writes the configuration file for this shipping method
	* @param array An array of objects
	* @returns boolean True when writing was successful
	*/
   function write_configuration( &$d ) {
      global $vmLogger;
      
      $my_config_array = array("UPS_ACCESS_CODE" => $d['UPS_ACCESS_CODE'],
							  "UPS_USER_ID" => $d['UPS_USER_ID'],
							  "UPS_PASSWORD" => $d['UPS_PASSWORD'],
							  "UPS_PICKUP_TYPE" => $d['pickup_type'],
							  "UPS_PACKAGE_TYPE" => $d['package_type'],
							  "UPS_RESIDENTIAL" => $d['residential'],
							  "UPS_HANDLING_FEE" => $d['handling_fee'],
							  "UPS_TAX_CLASS" => $d['tax_class']
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
   }
}

?>
