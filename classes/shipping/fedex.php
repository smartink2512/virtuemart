<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
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
global $mosConfig_live_site;

define('FEDEX_REQUEST_REFERER', $mosConfig_live_site);
define('FEDEX_REQUEST_TIMEOUT', 20);
define('FEDEX_IMG_DIR', '/tmp/');

class fedex {

    var $classname = 'fedex';
    
    function list_rates( &$d ) {
		global $vendor_country_2_code, $vendor_currency, $vmLogger;
		global $VM_LANG, $CURRENCY_DISPLAY, $mosConfig_absolute_path;
		$db =& new ps_DB;
		$dbv =& new ps_DB;

		$cart = $_SESSION['cart'];

		/** Read current Configuration ***/
		require_once(CLASSPATH ."shipping/".$this->classname.".cfg.php");
		
		// Include the Main FedEx class
		require_once( CLASSPATH . 'shipping/fedex/fedexdc.php' );
		
		// The meter number is needed for all services except tracking
		if( FEDEX_METER_NUMBER=='') {
			if( !$this->update_meter_number() ) {
				$vmLogger->err( 'Error updating the Meter Number.');
				return false;
			}
		}
		
		$q  = "SELECT * FROM #__{vm}_user_info, #__{vm}_country WHERE user_info_id='" . $d["ship_to_info_id"]."' AND ( country=country_2_code OR country=country_3_code)";
		$db->query($q);
		$db->next_record();

		$q  = "SELECT * FROM #__{vm}_vendor WHERE vendor_id='".$_SESSION['ps_vendor_id']."'";
		$dbv->query($q);
		$dbv->next_record();

		$order_weight = number_format( (float)$d['weight'], 1, '.', '' );
		
		// config values
		$fed_conf = array();
		
		// create new FedExDC object
		$meter_number = defined('FEDEX_METER_NUMBER_TEMP') ? FEDEX_METER_NUMBER_TEMP : FEDEX_METER_NUMBER;
		$fed = new FedExDC( FEDEX_ACCOUNT_NUMBER, $meter_number, $fed_conf );
		
		// rate services example
		// You can either pass the FedEx tag value or the field name in the
		// $FE_RE array
		$rate_Ret = $fed->services_rate (
		    array(
		        'weight_units' =>	WEIGHT_UOM.'S'
		        ,8 => 	$dbv->f('vendor_state')// Sender State
		        ,9 => 	$dbv->f('vendor_zip')//Sender Postal Code
		        ,117 =>	$vendor_country_2_code// Sender Country Code
		        
		        ,16=>   $db->f('state')// Recipient State
		        ,17=>   $db->f('zip')//Recipient Postal Code
		        ,50=>   $db->f('country_2_code')//Recipient Country Code
		        
		        ,57 =>	'12'//Dimensions: Height
		        ,58 =>	'24'//Dimensions: Width
		        ,59 =>	'10'//Dimensions: Length
		        ,1116 =>	'IN'// Dimensions Unit of measure
		        ,1401 =>	$order_weight//Total Package Weight/ Shipment total weight
		        ,1333 =>	'1'//Drop Off Type
		    )
		);		
		
		if ($error = $fed->getError()) {
		    $vmLogger->err( $error );

		   	// Switch to StandardShipping on Error !!!
			require_once( CLASSPATH . 'shipping/standard_shipping.php' );
			$shipping =& new standard_shipping();
			$shipping->list_rates( $d );
			return;
		} 
		elseif( DEBUG ) {
			echo "<pre>";
		    echo $fed->debug_str. "\n<br />";
		    print_r($rate_Ret);
		    echo "\n";
		    echo "ZONE: ".$rate_Ret[1092]."\n\n";
		
		    for ($i=1; $i<=$rate_Ret[1133]; $i++) {
		        echo "SERVICE : ".$fed->service_type($rate_Ret['1274-'.$i])."\n";
		        echo "SURCHARGE : ".$rate_Ret['1417-'.$i]."\n";
		        echo "DISCOUNT : ".$rate_Ret['1418-'.$i]."\n";
		        echo "NET CHARGE : ".$rate_Ret['1419-'.$i]."\n";
		        echo "DELIVERY DAY : ".@$rate_Ret['194-'.$i]."\n";
		        echo "DELIVERY DATE : ".@$rate_Ret['409-'.$i]."\n\n";
		    }
		    echo "</pre>";
		}
		if ( $_SESSION['auth']['show_price_including_tax'] != 1 ) {
			$taxrate = 1;
		}
		else {
			$taxrate = $this->get_tax_rate() + 1;
		}
		$html = '';
		// Loop through all rates
		for ($i=1; $i<=$rate_Ret[1133]; $i++) {
			$charge = $rate_Ret['1419-'.$i] + floatval( FEDEX_HANDLINGFEE );
			$charge *= $taxrate;
			$surcharge = $CURRENCY_DISPLAY->getFullValue($charge);
			
			$shipping_rate_id = urlencode($this->classname."|FedEx|".$fed->service_type($rate_Ret['1274-'.$i])."|".$charge);
			
			$checked = (@$d["shipping_rate_id"] == $shipping_rate_id) ? "checked=\"checked\"" : "";
			
			$html .= "\n<input type=\"radio\" id=\"$shipping_rate_id\" name=\"shipping_rate_id\" $checked value=\"$shipping_rate_id\" />\n";
			  
			$_SESSION[$shipping_rate_id] = 1;
			  
			$html .= "<label for=\"$shipping_rate_id\">".$fed->service_type($rate_Ret['1274-'.$i])." ";
			$html .= "<strong>(".$surcharge.")</strong>";
			if( !empty( $rate_Ret['194-'.$i] ) && !empty($rate_Ret['409-'.$i])) {
				$html .= ", expected delivery: ".$rate_Ret['194-'.$i].', '.$rate_Ret['409-'.$i];
			}

			$html .= "</label><br />";
		}
		echo $html;
		return true;
    }
 	/**
 	 * Return the rate amount
 	 *
 	 * @param array $d
 	 * @return float Shipping rate value
 	 */
	function get_rate( &$d ) {

		$shipping_rate_id = $d["shipping_rate_id"];
		$is_arr = explode("|", urldecode(urldecode($shipping_rate_id)) );
		$order_shipping = $is_arr[3];

		return $order_shipping;

	} //end function get_rate

	/**
	 * Returns the tax rate for this shipping method
	 *
	 * @return float The tax rate (e.g. 0.16)
	 */
	function get_tax_rate() {

		/** Read current Configuration ***/
		require_once(CLASSPATH ."shipping/".$this->classname.".cfg.php");

		if( intval(FEDEX_TAX_CLASS)== 0 )
		return( 0 );
		else {
			require_once( CLASSPATH. "ps_tax.php" );
			$tax_rate = ps_tax::get_taxrate_by_id( intval(FEDEX_TAX_CLASS) );
			return $tax_rate;
		}
	}

	/**
    * Validate this Shipping method by checking if the SESSION contains the key
    * @returns boolean False when the Shipping method is not in the SESSION
    */
	function validate( $d ) {

		$shipping_rate_id = $d["shipping_rate_id"];

		if( array_key_exists( $shipping_rate_id, $_SESSION )) {
			return true;
		}
		else {
			return false;
		}
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
		<table class="adminform">
		    <tr>
		        <td class="labelcell"><?php echo $VM_LANG->_VM_FEDEX_ACCOUNT_NUMBER ?></td>
				<td>
		            <input type="text" name="FEDEX_ACCOUNT_NUMBER" class="inputbox" value="<?php echo FEDEX_ACCOUNT_NUMBER ?>" />
				</td>
				<td>
		          &nbsp;
		        </td>
		    </tr>
		    <tr>
		        <td class="labelcell"><?php echo $VM_LANG->_VM_FEDEX_METER_NUMBER ?></td>
				<td>
		            <input type="text" name="FEDEX_METER_NUMBER" class="inputbox" value="<?php echo FEDEX_METER_NUMBER ?>" />
				</td>
				<td>
		            <?php echo mm_ToolTip($VM_LANG->_VM_FEDEX_METER_NUMBER_TIP) ?>
		        </td>
		    </tr>
		    <tr>
		        <td class="labelcell"><?php echo $VM_LANG->_VM_FEDEX_URI ?></td>
				<td class="labelcell">
		            <input type="text" name="FEDEX_URI" class="inputbox" value="<?php echo FEDEX_URI ?>" size="60" />
				</td>
				<td>
		            <?php echo mm_ToolTip( $VM_LANG->_VM_FEDEX_URI_TIP ) ?>
		        </td>
		    </tr>
			  <tr>
				<td class="labelcell"><?php echo $VM_LANG->_PHPSHOP_UPS_TAX_CLASS ?></td>
				<td>
				  <?php
				  require_once(CLASSPATH.'ps_tax.php');
				  ps_tax::list_tax_value("FEDEX_TAX_CLASS", FEDEX_TAX_CLASS) ?>
				</td>
				<td><?php echo mm_ToolTip($VM_LANG->_PHPSHOP_UPS_TAX_CLASS_TOOLTIP) ?><td>
			  </tr>	
				<tr>
				  <td colspan="3"><hr /></td>
				</tr>
			<tr>
			  <td class="labelcell"><?php echo $VM_LANG->_PHPSHOP_USPS_HANDLING_FEE ?></td>
			  <td><input class="inputbox" type="text" name="FEDEX_HANDLINGFEE" value="<?php echo FEDEX_HANDLINGFEE ?>" /></td>
			  <td><?php echo mm_ToolTip($VM_LANG->_PHPSHOP_USPS_HANDLING_FEE_TOOLTIP) ?></td>
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

		$my_config_array = array("FEDEX_ACCOUNT_NUMBER" => $d['FEDEX_ACCOUNT_NUMBER']
		,"FEDEX_METER_NUMBER" => $d['FEDEX_METER_NUMBER']
		,"FEDEX_URI" => $d['FEDEX_URI']
		,"FEDEX_TAX_CLASS" => $d['FEDEX_TAX_CLASS']
		,"FEDEX_HANDLINGFEE" => $d['FEDEX_HANDLINGFEE']
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
   
	function update_meter_number() {
		global $vendor_name,$vendor_address,$vendor_city,$vendor_state,$vendor_zip,
			$vendor_country_2_code, $vendor_phone, $vmLogger;
			
		$fed = new FedExDC( FEDEX_ACCOUNT_NUMBER );
		$db = new ps_DB();
		$db->query( ('SELECT `contact_first_name`, `contact_last_name` FROM `#__{vm}_vendor` WHERE `vendor_id` ='.intval($_SESSION['ps_vendor_id'])));
		$db->next_record();
	    $aRet = $fed->subscribe(
	    array(
	        1 => uniqid( 'vmFed_' ), // Don't really need this but can be used for ref
	        4003 => $db->f('contact_first_name').' '.$db->f('contact_last_name'),
	        4008 => $vendor_address,
	        4011 => $vendor_city,
	        4012 => $vendor_state,
	        4013 => $vendor_zip,
	        4014 => $vendor_country_2_code,
	        4015 => $vendor_phone
	    ));
	    if ($error = $fed->getError() ) {
		    $vmLogger->err( $error );
		    return false;
	    }
	    $meter_number = $aRet[498];

	    $d['FEDEX_ACCOUNT_NUMBER'] = FEDEX_ACCOUNT_NUMBER;
	   	$d['FEDEX_METER_NUMBER'] = $meter_number;
		$d['FEDEX_URI'] = FEDEX_URI;
		$d['FEDEX_TAX_CLASS'] = FEDEX_TAX_CLASS;
		$d['FEDEX_HANDLINGFEE'] = FEDEX_HANDLINGFEE;
		
		$this->write_configuration( $d );
		
		define( 'FEDEX_METER_NUMBER_TEMP', $meter_number );
		
		return true;
	}
}

?>