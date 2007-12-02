<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ) ;
/**
 * @version $Id: ps_epay.php,v 1.4 2005/05/17 20:31:31 soeren_nb Exp $
 * @package VirtueMart
 * @subpackage Payment
 * @copyright (C) 2007 Soeren Eberhardt
 *
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * VirtueMart is Free Software.
 * VirtueMart comes with absolute no warranty.
 *
 * virtuemart.net

 * The ps_epay class, containing the payment processing code
 *  for transactions with PBS, Nordea, Danske Bank, eWire etc 
 *  supported by the ePay Payment Gateway (www.epay.dk)
 */

class ps_epay {
	
	var $payment_code = "EPAY" ;
	
	/**
	 * Show all configuration parameters for this payment method
	 * @returns boolean False when the Payment method has no configration
	 */
	function show_configuration() {
		
		global $VM_LANG, $mosConfig_live_site ;
		$db = & new ps_DB( ) ;
		/** Read current Configuration ***/
		require_once (CLASSPATH . "payment/" . __CLASS__ . ".cfg.php") ;
		?>
<table style="text-align: left;">
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_MERCHANTNUMBER') ?></strong></td>
		<td><input type="text" name="EPAY_MERCHANTNUMBER" class="inputbox"
			value="<?php
		echo EPAY_MERCHANTNUMBER ?>" /></td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_MERCHANTNUMBER_EXPLAIN') ?></td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_PAYMENT_ORDERSTATUS_SUCC') ?></strong></td>
		<td><select name="EPAY_VERIFIED_STATUS" class="inputbox">
                <?php
		$q = "SELECT order_status_name,order_status_code FROM #__{vm}_order_status where order_status_code != 'P' ORDER BY list_order" ;
		$db->query( $q ) ;
		$order_status_code = Array( ) ;
		$order_status_name = Array( ) ;
		
		while( $db->next_record() ) {
			$order_status_code[] = $db->f( "order_status_code" ) ;
			$order_status_name[] = $db->f( "order_status_name" ) ;
		}
		for( $i = 0 ; $i < sizeof( $order_status_code ) ; $i ++ ) {
			echo "<option value=\"" . $order_status_code[$i] ;
			if( EPAY_VERIFIED_STATUS == $order_status_code[$i] )
				echo "\" selected=\"selected\">" ; else
				echo "\">" ;
			echo $order_status_name[$i] . "</option>\n" ;
		}
		?>
                    </select></td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_PAYMENT_ORDERSTATUS_SUCC_EXPLAIN') ?></td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_PAYMENT_ORDERSTATUS_FAIL') ?></strong></td>
		<td><select name="EPAY_INVALID_STATUS" class="inputbox">
                <?php
		$q = "SELECT order_status_name,order_status_code FROM #__{vm}_order_status ORDER BY list_order" ;
		$db->query( $q ) ;
		$order_status_code = Array( ) ;
		$order_status_name = Array( ) ;
		
		while( $db->next_record() ) {
			$order_status_code[] = $db->f( "order_status_code" ) ;
			$order_status_name[] = $db->f( "order_status_name" ) ;
		}
		for( $i = 0 ; $i < sizeof( $order_status_code ) ; $i ++ ) {
			echo "<option value=\"" . $order_status_code[$i] ;
			if( EPAY_INVALID_STATUS == $order_status_code[$i] )
				echo "\" selected=\"selected\">" ; else
				echo "\">" ;
			echo $order_status_name[$i] . "</option>\n" ;
		}
		?>
                    </select></td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_PAYMENT_ORDERSTATUS_FAIL_EXPLAIN') ?></td>
	</tr>
	<script language="JavaScript">
          function enableDisableAll() {
            if (document.all.EPAY_CARDTYPES_0.checked) {
              document.all.EPAY_CARDTYPES_1.disabled = true;
              document.all.EPAY_CARDTYPES_2.disabled = true;
              document.all.EPAY_CARDTYPES_3.disabled = true;
              document.all.EPAY_CARDTYPES_4.disabled = true;
              document.all.EPAY_CARDTYPES_5.disabled = true;
              document.all.EPAY_CARDTYPES_6.disabled = true;
              document.all.EPAY_CARDTYPES_7.disabled = true;
              document.all.EPAY_CARDTYPES_8.disabled = true;
              document.all.EPAY_CARDTYPES_9.disabled = true;
              document.all.EPAY_CARDTYPES_10.disabled = true;
              document.all.EPAY_CARDTYPES_11.disabled = true;
              document.all.EPAY_CARDTYPES_12.disabled = true;
              document.all.EPAY_CARDTYPES_13.disabled = true;
              document.all.EPAY_CARDTYPES_14.disabled = true;
              document.all.EPAY_CARDTYPES_15.disabled = true;
              document.all.EPAY_CARDTYPES_16.disabled = true;
            } else {
              document.all.EPAY_CARDTYPES_1.disabled = false;
              document.all.EPAY_CARDTYPES_2.disabled = false;
              document.all.EPAY_CARDTYPES_3.disabled = false;
              document.all.EPAY_CARDTYPES_4.disabled = false;
              document.all.EPAY_CARDTYPES_5.disabled = false;
              document.all.EPAY_CARDTYPES_6.disabled = false;
              document.all.EPAY_CARDTYPES_7.disabled = false;
              document.all.EPAY_CARDTYPES_8.disabled = false;
              document.all.EPAY_CARDTYPES_9.disabled = false;
              document.all.EPAY_CARDTYPES_10.disabled = false;
              document.all.EPAY_CARDTYPES_11.disabled = false;
              document.all.EPAY_CARDTYPES_12.disabled = false;
              document.all.EPAY_CARDTYPES_13.disabled = false;
              document.all.EPAY_CARDTYPES_14.disabled = false;
              document.all.EPAY_CARDTYPES_15.disabled = false;
              document.all.EPAY_CARDTYPES_16.disabled = false;
            }
          }
        </script>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_CARDTYPES') ?></strong></td>
		<td><input type="checkbox" name="EPAY_CARDTYPES_0"
			<?php
		if( EPAY_CARDTYPES_0 == '1' )
			echo "checked" ;
		?> value="1"
			onclick="javascript:enableDisableAll();">All/alle/alles <br>
		<input type="checkbox" name="EPAY_CARDTYPES_1"
			<?php
		if( EPAY_CARDTYPES_1 == '1' )
			echo "checked" ;
		?> value="1">Dankort
		<br>
		<input type="checkbox" name="EPAY_CARDTYPES_2"
			<?php
		if( EPAY_CARDTYPES_2 == '1' )
			echo "checked" ;
		?> value="1">eDankort
		<br>
		<input type="checkbox" name="EPAY_CARDTYPES_3"
			<?php
		if( EPAY_CARDTYPES_3 == '1' )
			echo "checked" ;
		?> value="1">VISA<br>
		<input type="checkbox" name="EPAY_CARDTYPES_4"
			<?php
		if( EPAY_CARDTYPES_4 == '1' )
			echo "checked" ;
		?> value="1">Visa
		Electron <br>
		<input type="checkbox" name="EPAY_CARDTYPES_5"
			<?php
		if( EPAY_CARDTYPES_5 == '1' )
			echo "checked" ;
		?> value="1">MasterCard
		<br>
		<input type="checkbox" name="EPAY_CARDTYPES_6"
			<?php
		if( EPAY_CARDTYPES_6 == '1' )
			echo "checked" ;
		?> value="1">Maestro
		<br>
		<input type="checkbox" name="EPAY_CARDTYPES_7"
			<?php
		if( EPAY_CARDTYPES_7 == '1' )
			echo "checked" ;
		?> value="1">JCB <br>
		<input type="checkbox" name="EPAY_CARDTYPES_8"
			<?php
		if( EPAY_CARDTYPES_8 == '1' )
			echo "checked" ;
		?> value="1">Diners
		<br>
		<input type="checkbox" name="EPAY_CARDTYPES_9"
			<?php
		if( EPAY_CARDTYPES_9 == '1' )
			echo "checked" ;
		?> value="1">American
		Express <br>
		<input type="checkbox" name="EPAY_CARDTYPES_10"
			<?php
		if( EPAY_CARDTYPES_10 == '1' )
			echo "checked" ;
		?> value="1">Forbrugsforeningens
		kontokort <br>
		<input type="checkbox" name="EPAY_CARDTYPES_11"
			<?php
		if( EPAY_CARDTYPES_11 == '1' )
			echo "checked" ;
		?> value="1">eWire
		<br>
		<input type="checkbox" name="EPAY_CARDTYPES_12"
			<?php
		if( EPAY_CARDTYPES_12 == '1' )
			echo "checked" ;
		?> value="1">Vertified
		by Visa (3D-Secure) <br>
		<input type="checkbox" name="EPAY_CARDTYPES_13"
			<?php
		if( EPAY_CARDTYPES_13 == '1' )
			echo "checked" ;
		?> value="1">JCB
		Secure (3D-Secure) <br>
		<input type="checkbox" name="EPAY_CARDTYPES_14"
			<?php
		if( EPAY_CARDTYPES_14 == '1' )
			echo "checked" ;
		?> value="1">MasterCard
		SecureCode (3D-Secure) <br>
		<input type="checkbox" name="EPAY_CARDTYPES_15"
			<?php
		if( EPAY_CARDTYPES_15 == '1' )
			echo "checked" ;
		?> value="1">Danske
		Netbetaling <br>
		<input type="checkbox" name="EPAY_CARDTYPES_16"
			<?php
		if( EPAY_CARDTYPES_16 == '1' )
			echo "checked" ;
		?> value="1">Nordea
		e-betaling (SOLO) <br>
		</td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_CARDTYPES_EXPLAIN') ?></td>
	</tr>
	<script language="JavaScript">enableDisableAll();</script>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_LANGUAGE') ?></strong></td>
		<td><select name="EPAY_LANGUAGE" class="inputbox">
			<option
				<?php
		if( EPAY_LANGUAGE == '1' )
			echo "selected=\"selected\"" ;
		?>
				value="1">Danish</option>
			<option
				<?php
		if( EPAY_LANGUAGE == '2' )
			echo "selected=\"selected\"" ;
		?>
				value="2">English</option>
			<option
				<?php
		if( EPAY_LANGUAGE == '3' )
			echo "selected=\"selected\"" ;
		?>
				value="3">Swedish</option>
			<option
				<?php
		if( EPAY_LANGUAGE == '4' )
			echo "selected=\"selected\"" ;
		?>
				value="4">Norwegian</option>
			<option
				<?php
		if( EPAY_LANGUAGE == '5' )
			echo "selected=\"selected\"" ;
		?>
				value="5">Greenland</option>
			<option
				<?php
		if( EPAY_LANGUAGE == '6' )
			echo "selected=\"selected\"" ;
		?>
				value="6">Icelandic</option>
			<option
				<?php
		if( EPAY_LANGUAGE == '7' )
			echo "selected=\"selected\"" ;
		?>
				value="7">German</option>
		</select></td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_LANGUAGE_EXPLAIN') ?></td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_INSTANT_CAPTURE') ?></strong></td>
		<td><select name="EPAY_INSTANT_CAPTURE" class="inputbox">
			<option
				<?php
		if( EPAY_INSTANT_CAPTURE == '0' )
			echo "selected=\"selected\"" ;
		?>
				value="0"><?php echo $VM_LANG->_('VM_DISABLED') ?></option>
			<option
				<?php
		if( EPAY_INSTANT_CAPTURE == '1' )
			echo "selected=\"selected\"" ;
		?>
				value="1"><?php echo $VM_LANG->_('VM_ENABLED') ?></option>
		</select></td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_INSTANT_CAPTURE_EXPLAIN') ?></td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_GROUP') ?></strong></td>
		<td><input type="text" name="EPAY_GROUP" class="inputbox"
			value="<?php
		EPAY_GROUP ;
		?>"></td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_GROUP_EXPLAIN') ?></td>
	</tr>
	<tr>
		<td><strong>MD5</strong></td>
		<td><select name="EPAY_MD5_TYPE" class="inputbox">
			<option
				<?php
		if( EPAY_MD5_TYPE == '0' )
			echo "selected=\"selected\"" ;
		?>
				value="0"><?php echo $VM_LANG->_('VM_DISABLED') ?> (0)</option>
			<option
				<?php
		if( EPAY_MD5_TYPE == '1' )
			echo "selected=\"selected\"" ;
		?>
				value="1"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_MD5_TYPE_1') ?> (1)</option>
			<option
				<?php
		if( EPAY_MD5_TYPE == '2' )
			echo "selected=\"selected\"" ;
		?>
				value="2"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_MD5_TYPE_2') ?> (2)</option>
		</select></td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_MD5_TYPE_EXPLAIN') ?></td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_MD5_KEY') ?></strong></td>
		<td><input type="text" name="EPAY_MD5_KEY" class="inputbox"
			value="<?php
		EPAY_MD5_KEY ;
		?>"></td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_MD5_KEY_EXPLAIN') ?></td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_AUTHSMS') ?></strong></td>
		<td><input type="text" name="EPAY_AUTH_SMS" class="inputbox"
			value="<?php
		EPAY_AUTH_SMS ;
		?>"></td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_AUTHSMS_EXPLAIN') ?></td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_AUTHEMAIL') ?></strong></td>
		<td><input type="text" name="EPAY_AUTH_MAIL" class="inputbox"
			value="<?php
		EPAY_AUTH_MAIL ;
		?>"></td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_AUTHEMAIL_EXPLAIN') ?></td>	
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_WINDOWSTATE') ?></strong></td>
		<td><select name="EPAY_WINDOW_STATE" class="inputbox">
			<option
				<?php
		if( EPAY_WINDOW_STATE == '1' )
			echo "selected=\"selected\"" ;
		?>
				value="1"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_WINDOWSTATE_1') ?> (1)</option>
			<option
				<?php
		if( EPAY_WINDOW_STATE == '2' )
			echo "selected=\"selected\"" ;
		?>
				value="2"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_WINDOWSTATE_2') ?> (2)</option>
		</select></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_3DSECURE') ?></strong></td>
		<td><select name="EPAY_3DSECURE" class="inputbox">
			<option
				<?php
		if( EPAY_3DSECURE == '1' )
			echo "selected=\"selected\"" ;
		?>
				value="1"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_3DSECURE_1') ?> (1)</option>
			<option
				<?php
		if( EPAY_3DSECURE == '2' )
			echo "selected=\"selected\"" ;
		?>
				value="2"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_3DSECURE_2') ?> (2)</option>
			<option
				<?php
		if( EPAY_3DSECURE == '3' )
			echo "selected=\"selected\"" ;
		?>
				value="3"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_3DSECURE_3') ?> (3)</option>
		</select></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_CALLBACK') ?></strong></td>
		<td><select name="EPAY_CALLBACK" class="inputbox">
			<option <?php
		if( EPAY_CALLBACK == '0' )
			echo "selected" ;
		?> value="0"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_CALLBACK_0') ?> (0)</option>
			<option <?php
		if( EPAY_CALLBACK == '1' )
			echo "selected" ;
		?> value="1"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_CALLBACK_1') ?> (1)</option>
		</select></td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_CALLBACK_EXPLAIN') ?></td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_ADDFEE') ?></strong></td>
		<td><select name="EPAY_ADDFEE" class="inputbox">
			<option
				<?php
		if( EPAY_ADDFEE == '0' )
			echo "selected=\"selected\"" ;
		?>
				value="0"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_ADDFEE_0') ?> (0)</option>
			<option
				<?php
		if( EPAY_ADDFEE == '1' )
			echo "selected=\"selected\"" ;
		?>
				value="1"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_ADDFEE_1') ?> (1)</option>
		</select></td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_ADDFEE_EXPLAIN') ?></td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_SUBSCRIPTION') ?></strong></td>
		<td><select name="EPAY_SUBSCRIPTION" class="inputbox">
			<option
				<?php
		if( EPAY_SUBSCRIPTION == '0' )
			echo "selected=\"selected\"" ;
		?>
				value="0"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_SUBSCRIPTION_0') ?> (0)</option>
			<option
				<?php
		if( EPAY_SUBSCRIPTION == '1' )
			echo "selected=\"selected\"" ;
		?>
				value="1"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_SUBSCRIPTION_1') ?> (1)</option>
		</select></td>
		<td><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_EPAY_SUBSCRIPTION_EXPLAIN') ?></td>
	</tr>

</table>

<?php
		// return false if there\'s no configuration
		return true ;
	}
	
	function has_configuration() {
		// return false if there's no configuration
		return true ;
	}
	
	/**
	 * Returns the "is_writeable" status of the configuration file
	 * @param void
	 * @returns boolean True when the configuration file is writeable, false when not
	 */
	function configfile_writeable() {
		return is_writeable( CLASSPATH . "payment/" . __CLASS__ . ".cfg.php" ) ;
	}
	
	/**
	 * Returns the "is_readable" status of the configuration file
	 * @param void
	 * @returns boolean True when the configuration file is writeable, false when not
	 */
	function configfile_readable() {
		return is_readable( CLASSPATH . "payment/" . __CLASS__ . ".cfg.php" ) ;
	}
	/**
	 * Writes the configuration file for this payment method
	 * @param array An array of objects
	 * @returns boolean True when writing was successful
	 */
	function write_configuration( &$d ) {
		
		$my_config_array = array( "EPAY_MERCHANTNUMBER" => $d['EPAY_MERCHANTNUMBER'] , "EPAY_LANGUAGE" => $d['EPAY_LANGUAGE'] , "EPAY_CALLBACK" => $d['EPAY_CALLBACK'] , "EPAY_VERIFIED_STATUS" => $d['EPAY_VERIFIED_STATUS'] , "EPAY_INVALID_STATUS" => $d['EPAY_INVALID_STATUS'] , "EPAY_INSTANT_CAPTURE" => $d['EPAY_INSTANT_CAPTURE'] , "EPAY_GROUP" => $d['EPAY_GROUP'] , "EPAY_MD5_TYPE" => $d['EPAY_MD5_TYPE'] , "EPAY_MD5_KEY" => $d['EPAY_MD5_KEY'] , "EPAY_AUTH_SMS" => $d['EPAY_AUTH_SMS'] , "EPAY_AUTH_MAIL" => $d['EPAY_AUTH_MAIL'] , "EPAY_WINDOW_STATE" => $d['EPAY_WINDOW_STATE'] , "EPAY_3DSECURE" => $d['EPAY_3DSECURE'] , "EPAY_SUBSCRIPTION" => $d['EPAY_SUBSCRIPTION'] , "EPAY_ADDFEE" => $d['EPAY_ADDFEE'] , "EPAY_CARDTYPES_0" => $d['EPAY_CARDTYPES_0'] , "EPAY_CARDTYPES_1" => $d['EPAY_CARDTYPES_1'] , "EPAY_CARDTYPES_2" => $d['EPAY_CARDTYPES_2'] , "EPAY_CARDTYPES_3" => $d['EPAY_CARDTYPES_3'] , "EPAY_CARDTYPES_4" => $d['EPAY_CARDTYPES_4'] , "EPAY_CARDTYPES_5" => $d['EPAY_CARDTYPES_5'] , "EPAY_CARDTYPES_6" => $d['EPAY_CARDTYPES_6'] , "EPAY_CARDTYPES_7" => $d['EPAY_CARDTYPES_7'] , "EPAY_CARDTYPES_8" => $d['EPAY_CARDTYPES_8'] , "EPAY_CARDTYPES_9" => $d['EPAY_CARDTYPES_9'] , "EPAY_CARDTYPES_10" => $d['EPAY_CARDTYPES_10'] , "EPAY_CARDTYPES_11" => $d['EPAY_CARDTYPES_11'] , "EPAY_CARDTYPES_12" => $d['EPAY_CARDTYPES_12'] , "EPAY_CARDTYPES_13" => $d['EPAY_CARDTYPES_13'] , "EPAY_CARDTYPES_14" => $d['EPAY_CARDTYPES_14'] , "EPAY_CARDTYPES_15" => $d['EPAY_CARDTYPES_15'] , "EPAY_CARDTYPES_16" => $d['EPAY_CARDTYPES_16'] ) ;
		
		$config = "<?php\n" ;
		$config .= "defined('_VALID_MOS') or die('Direct Access to this location is not allowed.'); \n\n" ;
		foreach( $my_config_array as $key => $value ) {
			$config .= "define ('$key', '$value');\n" ;
		}
		
		$config .= "?>" ;
		
		if( $fp = fopen( CLASSPATH . "payment/" . __CLASS__ . ".cfg.php", "w" ) ) {
			fputs( $fp, $config, strlen( $config ) ) ;
			fclose( $fp ) ;
			
			//
			// Store the form which is posted to ePay
			//
			$d['payment_extrainfo'] = '<' . '?php\n' . '//NOTE! Dette section is hardcoded. Therefore changes created in this textarea will not be saved.' . 'The file /administrator/com_virtualmart/classes/payment/ps_epay.php must be modified  in the function write_configuration' . '// This is the Session ID\n' . 'require_once(CLASSPATH ."payment/ps_epay.cfg.php");\n' . '$url=basename($mosConfig_live_site);\n' . 'function get_iso_code($code) {\n' . 'switch ($code) {\n' . 'case "ADP": return "020"; break;\n' . 'case "AED": return "784"; break;\n' . 'case "AFA": return "004"; break;\n' . 'case "ALL": return "008"; break;\n' . 'case "AMD": return "051"; break;\n' . 'case "ANG": return "532"; break;\n' . 'case "AOA": return "973"; break;\n' . 'case "ARS": return "032"; break;\n' . 'case "AUD": return "036"; break;\n' . 'case "AWG": return "533"; break;\n' . 'case "AZM": return "031"; break;\n' . 'case "BAM": return "977"; break;\n' . 'case "BBD": return "052"; break;\n' . 'case "BDT": return "050"; break;\n' . 'case "BGL": return "100"; break;\n' . 'case "BGN": return "975"; break;\n' . 'case "BHD": return "048"; break;\n' . 'case "BIF": return "108"; break;\n' . 'case "BMD": return "060"; break;\n' . 'case "BND": return "096"; break;\n' . 'case "BOB": return "068"; break;\n' . 'case "BOV": return "984"; break;\n' . 'case "BRL": return "986"; break;\n' . 'case "BSD": return "044"; break;\n' . 'case "BTN": return "064"; break;\n' . 'case "BWP": return "072"; break;\n' . 'case "BYR": return "974"; break;\n' . 'case "BZD": return "084"; break;\n' . 'case "CAD": return "124"; break;\n' . 'case "CDF": return "976"; break;\n' . 'case "CHF": return "756"; break;\n' . 'case "CLF": return "990"; break;\n' . 'case "CLP": return "152"; break;\n' . 'case "CNY": return "156"; break;\n' . 'case "COP": return "170"; break;\n' . 'case "CRC": return "188"; break;\n' . 'case "CUP": return "192"; break;\n' . 'case "CVE": return "132"; break;\n' . 'case "CYP": return "196"; break;\n' . 'case "CZK": return "203"; break;\n' . 'case "DJF": return "262"; break;\n' . 'case "DKK": return "208"; break;\n' . 'case "DOP": return "214"; break;\n' . 'case "DZD": return "012"; break;\n' . 'case "ECS": return "218"; break;\n' . 'case "ECV": return "983"; break;\n' . 'case "EEK": return "233"; break;\n' . 'case "EGP": return "818"; break;\n' . 'case "ERN": return "232"; break;\n' . 'case "ETB": return "230"; break;\n' . 'case "EUR": return "978"; break;\n' . 'case "FJD": return "242"; break;\n' . 'case "FKP": return "238"; break;\n' . 'case "GBP": return "826"; break;\n' . 'case "GEL": return "981"; break;\n' . 'case "GHC": return "288"; break;\n' . 'case "GIP": return "292"; break;\n' . 'case "GMD": return "270"; break;\n' . 'case "GNF": return "324"; break;\n' . 'case "GTQ": return "320"; break;\n' . 'case "GWP": return "624"; break;\n' . 'case "GYD": return "328"; break;\n' . 'case "HKD": return "344"; break;\n' . 'case "HNL": return "340"; break;\n' . 'case "HRK": return "191"; break;\n' . 'case "HTG": return "332"; break;\n' . 'case "HUF": return "348"; break;\n' . 'case "IDR": return "360"; break;\n' . 'case "ILS": return "376"; break;\n' . 'case "INR": return "356"; break;\n' . 'case "IQD": return "368"; break;\n' . 'case "IRR": return "364"; break;\n' . 'case "ISK": return "352"; break;\n' . 'case "JMD": return "388"; break;\n' . 'case "JOD": return "400"; break;\n' . 'case "JPY": return "392"; break;\n' . 'case "KES": return "404"; break;\n' . 'case "KGS": return "417"; break;\n' . 'case "KHR": return "116"; break;\n' . 'case "KMF": return "174"; break;\n' . 'case "KPW": return "408"; break;\n' . 'case "KRW": return "410"; break;\n' . 'case "KWD": return "414"; break;\n' . 'case "KYD": return "136"; break;\n' . 'case "KZT": return "398"; break;\n' . 'case "LAK": return "418"; break;\n' . 'case "LBP": return "422"; break;\n' . 'case "LKR": return "144"; break;\n' . 'case "LRD": return "430"; break;\n' . 'case "LSL": return "426"; break;\n' . 'case "LTL": return "440"; break;\n' . 'case "LVL": return "428"; break;\n' . 'case "LYD": return "434"; break;\n' . 'case "MAD": return "504"; break;\n' . 'case "MDL": return "498"; break;\n' . 'case "MGF": return "450"; break;\n' . 'case "MKD": return "807"; break;\n' . 'case "MMK": return "104"; break;\n' . 'case "MNT": return "496"; break;\n' . 'case "MOP": return "446"; break;\n' . 'case "MRO": return "478"; break;\n' . 'case "MTL": return "470"; break;\n' . 'case "MUR": return "480"; break;\n' . 'case "MVR": return "462"; break;\n' . 'case "MWK": return "454"; break;\n' . 'case "MXN": return "484"; break;\n' . 'case "MXV": return "979"; break;\n' . 'case "MYR": return "458"; break;\n' . 'case "MZM": return "508"; break;\n' . 'case "NAD": return "516"; break;\n' . 'case "NGN": return "566"; break;\n' . 'case "NIO": return "558"; break;\n' . 'case "NOK": return "578"; break;\n' . 'case "NPR": return "524"; break;\n' . 'case "NZD": return "554"; break;\n' . 'case "OMR": return "512"; break;\n' . 'case "PAB": return "590"; break;\n' . 'case "PEN": return "604"; break;\n' . 'case "PGK": return "598"; break;\n' . 'case "PHP": return "608"; break;\n' . 'case "PKR": return "586"; break;\n' . 'case "PLN": return "985"; break;\n' . 'case "PYG": return "600"; break;\n' . 'case "QAR": return "634"; break;\n' . 'case "ROL": return "642"; break;\n' . 'case "RUB": return "643"; break;\n' . 'case "RUR": return "810"; break;\n' . 'case "RWF": return "646"; break;\n' . 'case "SAR": return "682"; break;\n' . 'case "SBD": return "090"; break;\n' . 'case "SCR": return "690"; break;\n' . 'case "SDD": return "736"; break;\n' . 'case "SEK": return "752"; break;\n' . 'case "SGD": return "702"; break;\n' . 'case "SHP": return "654"; break;\n' . 'case "SIT": return "705"; break;\n' . 'case "SKK": return "703"; break;\n' . 'case "SLL": return "694"; break;\n' . 'case "SOS": return "706"; break;\n' . 'case "SRG": return "740"; break;\n' . 'case "STD": return "678"; break;\n' . 'case "SVC": return "222"; break;\n' . 'case "SYP": return "760"; break;\n' . 'case "SZL": return "748"; break;\n' . 'case "THB": return "764"; break;\n' . 'case "TJS": return "972"; break;\n' . 'case "TMM": return "795"; break;\n' . 'case "TND": return "788"; break;\n' . 'case "TOP": return "776"; break;\n' . 'case "TPE": return "626"; break;\n' . 'case "TRL": return "792"; break;\n' . 'case "TRY": return "949"; break;\n' . 'case "TTD": return "780"; break;\n' . 'case "TWD": return "901"; break;\n' . 'case "TZS": return "834"; break;\n' . 'case "UAH": return "980"; break;\n' . 'case "UGX": return "800"; break;\n' . 'case "USD": return "840"; break;\n' . 'case "UYU": return "858"; break;\n' . 'case "UZS": return "860"; break;\n' . 'case "VEB": return "862"; break;\n' . 'case "VND": return "704"; break;\n' . 'case "VUV": return "548"; break;\n' . 'case "XAF": return "950"; break;\n' . 'case "XCD": return "951"; break;\n' . 'case "XOF": return "952"; break;\n' . 'case "XPF": return "953"; break;\n' . 'case "YER": return "886"; break;\n' . 'case "YUM": return "891"; break;\n' . 'case "ZAR": return "710"; break;\n' . 'case "ZMK": return "894"; break;\n' . 'case "ZWD": return "716"; break;\n' . '}\n' . 'return "XXX"; // return invalid code if the currency is not found \n' . '}\n' . '\n\n' . 'function calculateePayCurrency($order_id)\n' . '{\n' . '$db =& new ps_DB;\n' . '$currency_code = "208";\n' . '$q = "SELECT order_currency FROM #__{vm}_orders where order_id = " . $order_id;\n' . '$db->query($q);\n' . 'if ($db->next_record()) {\n' . '	$currency_code = get_iso_code($db->f("order_currency"));\n' . '}\n' . 'return $currency_code;\n' . '}\n' . ' echo $VM_LANG->_("PHPSHOP_EPAY_PAYMENT_CHECKOUT_HEADER");\n' . '?>\n' . '<script type="text/javascript" src="http://www.epay.dk/js/standardwindow.js"></script>\r\n' . '<script type="text/javascript">' . 'function printCard(cardId)\r\n' . '{\r\n' . 'document.write ("<table border=0 cellspacing=10 cellpadding=10>");\r\n' . 'switch (cardId) {\r\n' . 'case 1: document.write ("<input type=hidden name=cardtype value=1>"); break;\r\n' . 'case 2: document.write ("<input type=hidden name=cardtype value=2>"); break;\r\n' . 'case 3: document.write ("<input type=hidden name=cardtype value=3>"); break;\r\n' . 'case 4: document.write ("<input type=hidden name=cardtype value=4>"); break;\r\n' . 'case 5: document.write ("<input type=hidden name=cardtype value=5>"); break;\r\n' . 'case 6: document.write ("<input type=hidden name=cardtype value=6>"); break;\r\n' . 'case 7: document.write ("<input type=hidden name=cardtype value=7>"); break;\r\n' . 'case 8: document.write ("<input type=hidden name=cardtype value=8>"); break;\r\n' . 'case 9: document.write ("<input type=hidden name=cardtype value=9>"); break;\r\n' . 'case 10: document.write ("<input type=hidden name=cardtype value=10>"); break;\r\n' . 'case 11: document.write ("<input type=hidden name=cardtype value=11>"); break;\r\n' . 'case 12: document.write ("<input type=hidden name=cardtype value=12>"); break;\r\n' . 'case 13: document.write ("<input type=hidden name=cardtype value=13>"); break;\r\n' . 'case 14: document.write ("<input type=hidden name=cardtype value=14>"); break;\r\n' . 'case 15: document.write ("<input type=hidden name=cardtype value=15>"); break;\r\n' . 'case 16: document.write ("<input type=hidden name=cardtype value=16>"); break;\r\n' . '}\r\n' . 'document.write ("</table>");\r\n' . '}\r\n' . 'var flashLoaderStatus = 0;' . 'function startFlashLoader() {' . '' . '}' . 'function timerFlashLoader() {' . '' . '}' . '</script>\r\n' . '<form action="https://ssl.ditonlinebetalingssystem.dk/popup/default.asp" method="post" name="ePay" target="ePay_window" id="ePay">\n' . '<input type="hidden" name="merchantnumber" value="<' . '?php echo EPAY_MERCHANTNUMBER ?>">\n' . '<input type="hidden" name="amount" value="<' . '?php echo round($db->f("order_total")*100, 2 ) ?>">\n' . '<input type="hidden" name="currency" value="<' . '?php echo calculateePayCurrency($order_id)?>">\n' . '<input type="hidden" name="orderid" value="<' . '?php echo $order_id ?>">\n' . '<input type="hidden" name="ordretext" value="">\n' . $this->genAcceptUrl( false ) . $this->genAcceptUrl( true ) . '<input type="hidden" name="declineurl" value="<' . '?php echo $mosConfig_live_site ?>/index.php?page=checkout.epay_result&accept=0&sessionid=<' . '?php echo $sessionid ?>&option=com_virtuemart&Itemid=1">\n' . '<input type="hidden" name="group" value="<' . '?php echo EPAY_GROUP ?>">\n' . '<input type="hidden" name="instant" value="<' . '?php echo EPAY_INSTANT_CAPTURE ?>">\n' . '<input type="hidden" name="language" value="<' . '?php echo EPAY_LANGUAGE ?>">\n' . '<input type="hidden" name="authsms" value="<' . '?php echo EPAY_AUTH_SMS ?>">\n' . '<input type="hidden" name="authmail" value="<' . '?php echo EPAY_AUTH_MAIL ?>">\n' . '<input type="hidden" name="windowstate" value="<' . '?php echo EPAY_WINDOW_STATE ?>">\n' . '<input type="hidden" name="use3D" value="<' . '?php echo EPAY_3DSECURE ?>">\n' . '<input type="hidden" name="addfee" value="<' . '?php echo EPAY_ADDFEE ?>">\n' . '<input type="hidden" name="subscription" value="<' . '?php echo EPAY_SUBSCRIPTION ?>">\n' . '<input type="hidden" name="MD5Key" value="<' . '?php if (EPAY_MD5_TYPE == 2) echo md5( calculateePayCurrency($order_id) . round($db->f("order_total")*100, 2 ) . $order_id  . EPAY_MD5_KEY)?>">\n' . $this->generateCreditCardList() . '</form>\n' . '<script>open_ePay_window();</script>\r\n' . '<br>' . '<table border="0" width="100%"><tr><td><input type="button" onClick="open_ePay_window()" value="<' . '?php echo $VM_LANG->_("PHPSHOP_EPAY_BUTTON_OPEN_WINDOW") ?>"></td><td width="100%" id="flashLoader"></td></tr></table><br><br><br>\r\n' . '<script language="JavaScript">startFlashLoader();</script>' . '<' . '?php echo $VM_LANG->_("PHPSHOP_EPAY_PAYMENT_CHECKOUT_FOOTER") ?>' . '<br><br>' . '<img src="components/com_virtuemart/shop_image/ps_image/epay_images/epay_logo.gif" border="0">&nbsp;&nbsp;&nbsp;' . '<img src="components/com_virtuemart/shop_image/ps_image/epay_images/mastercard_securecode.gif" border="0">&nbsp;&nbsp;&nbsp;' . '<img src="components/com_virtuemart/shop_image/ps_image/epay_images/pci.gif" border="0">&nbsp;&nbsp;&nbsp;' . '<img src="components/com_virtuemart/shop_image/ps_image/epay_images/verisign_secure.gif" border="0">&nbsp;&nbsp;&nbsp;' . '<img src="components/com_virtuemart/shop_image/ps_image/epay_images/visa_secure.gif" border="0">&nbsp;&nbsp;&nbsp;' ;
			
			return true ;
		} else {
			$d["error"] = "Could not write to configuration file " . CLASSPATH . "payment/" . __CLASS__ . ".cfg.php" ;
			return false ;
		}
	}
	
	//
	// The complete list of country currency codes. 
	//
	function get_iso_code( $code ) {
		switch( $code) {
			case 'ADP' :
				return '020' ;
			break ;
			case 'AED' :
				return '784' ;
			break ;
			case 'AFA' :
				return '004' ;
			break ;
			case 'ALL' :
				return '008' ;
			break ;
			case 'AMD' :
				return '051' ;
			break ;
			case 'ANG' :
				return '532' ;
			break ;
			case 'AOA' :
				return '973' ;
			break ;
			case 'ARS' :
				return '032' ;
			break ;
			case 'AUD' :
				return '036' ;
			break ;
			case 'AWG' :
				return '533' ;
			break ;
			case 'AZM' :
				return '031' ;
			break ;
			case 'BAM' :
				return '977' ;
			break ;
			case 'BBD' :
				return '052' ;
			break ;
			case 'BDT' :
				return '050' ;
			break ;
			case 'BGL' :
				return '100' ;
			break ;
			case 'BGN' :
				return '975' ;
			break ;
			case 'BHD' :
				return '048' ;
			break ;
			case 'BIF' :
				return '108' ;
			break ;
			case 'BMD' :
				return '060' ;
			break ;
			case 'BND' :
				return '096' ;
			break ;
			case 'BOB' :
				return '068' ;
			break ;
			case 'BOV' :
				return '984' ;
			break ;
			case 'BRL' :
				return '986' ;
			break ;
			case 'BSD' :
				return '044' ;
			break ;
			case 'BTN' :
				return '064' ;
			break ;
			case 'BWP' :
				return '072' ;
			break ;
			case 'BYR' :
				return '974' ;
			break ;
			case 'BZD' :
				return '084' ;
			break ;
			case 'CAD' :
				return '124' ;
			break ;
			case 'CDF' :
				return '976' ;
			break ;
			case 'CHF' :
				return '756' ;
			break ;
			case 'CLF' :
				return '990' ;
			break ;
			case 'CLP' :
				return '152' ;
			break ;
			case 'CNY' :
				return '156' ;
			break ;
			case 'COP' :
				return '170' ;
			break ;
			case 'CRC' :
				return '188' ;
			break ;
			case 'CUP' :
				return '192' ;
			break ;
			case 'CVE' :
				return '132' ;
			break ;
			case 'CYP' :
				return '196' ;
			break ;
			case 'CZK' :
				return '203' ;
			break ;
			case 'DJF' :
				return '262' ;
			break ;
			case 'DKK' :
				return '208' ;
			break ;
			case 'DOP' :
				return '214' ;
			break ;
			case 'DZD' :
				return '012' ;
			break ;
			case 'ECS' :
				return '218' ;
			break ;
			case 'ECV' :
				return '983' ;
			break ;
			case 'EEK' :
				return '233' ;
			break ;
			case 'EGP' :
				return '818' ;
			break ;
			case 'ERN' :
				return '232' ;
			break ;
			case 'ETB' :
				return '230' ;
			break ;
			case 'EUR' :
				return '978' ;
			break ;
			case 'FJD' :
				return '242' ;
			break ;
			case 'FKP' :
				return '238' ;
			break ;
			case 'GBP' :
				return '826' ;
			break ;
			case 'GEL' :
				return '981' ;
			break ;
			case 'GHC' :
				return '288' ;
			break ;
			case 'GIP' :
				return '292' ;
			break ;
			case 'GMD' :
				return '270' ;
			break ;
			case 'GNF' :
				return '324' ;
			break ;
			case 'GTQ' :
				return '320' ;
			break ;
			case 'GWP' :
				return '624' ;
			break ;
			case 'GYD' :
				return '328' ;
			break ;
			case 'HKD' :
				return '344' ;
			break ;
			case 'HNL' :
				return '340' ;
			break ;
			case 'HRK' :
				return '191' ;
			break ;
			case 'HTG' :
				return '332' ;
			break ;
			case 'HUF' :
				return '348' ;
			break ;
			case 'IDR' :
				return '360' ;
			break ;
			case 'ILS' :
				return '376' ;
			break ;
			case 'INR' :
				return '356' ;
			break ;
			case 'IQD' :
				return '368' ;
			break ;
			case 'IRR' :
				return '364' ;
			break ;
			case 'ISK' :
				return '352' ;
			break ;
			case 'JMD' :
				return '388' ;
			break ;
			case 'JOD' :
				return '400' ;
			break ;
			case 'JPY' :
				return '392' ;
			break ;
			case 'KES' :
				return '404' ;
			break ;
			case 'KGS' :
				return '417' ;
			break ;
			case 'KHR' :
				return '116' ;
			break ;
			case 'KMF' :
				return '174' ;
			break ;
			case 'KPW' :
				return '408' ;
			break ;
			case 'KRW' :
				return '410' ;
			break ;
			case 'KWD' :
				return '414' ;
			break ;
			case 'KYD' :
				return '136' ;
			break ;
			case 'KZT' :
				return '398' ;
			break ;
			case 'LAK' :
				return '418' ;
			break ;
			case 'LBP' :
				return '422' ;
			break ;
			case 'LKR' :
				return '144' ;
			break ;
			case 'LRD' :
				return '430' ;
			break ;
			case 'LSL' :
				return '426' ;
			break ;
			case 'LTL' :
				return '440' ;
			break ;
			case 'LVL' :
				return '428' ;
			break ;
			case 'LYD' :
				return '434' ;
			break ;
			case 'MAD' :
				return '504' ;
			break ;
			case 'MDL' :
				return '498' ;
			break ;
			case 'MGF' :
				return '450' ;
			break ;
			case 'MKD' :
				return '807' ;
			break ;
			case 'MMK' :
				return '104' ;
			break ;
			case 'MNT' :
				return '496' ;
			break ;
			case 'MOP' :
				return '446' ;
			break ;
			case 'MRO' :
				return '478' ;
			break ;
			case 'MTL' :
				return '470' ;
			break ;
			case 'MUR' :
				return '480' ;
			break ;
			case 'MVR' :
				return '462' ;
			break ;
			case 'MWK' :
				return '454' ;
			break ;
			case 'MXN' :
				return '484' ;
			break ;
			case 'MXV' :
				return '979' ;
			break ;
			case 'MYR' :
				return '458' ;
			break ;
			case 'MZM' :
				return '508' ;
			break ;
			case 'NAD' :
				return '516' ;
			break ;
			case 'NGN' :
				return '566' ;
			break ;
			case 'NIO' :
				return '558' ;
			break ;
			case 'NOK' :
				return '578' ;
			break ;
			case 'NPR' :
				return '524' ;
			break ;
			case 'NZD' :
				return '554' ;
			break ;
			case 'OMR' :
				return '512' ;
			break ;
			case 'PAB' :
				return '590' ;
			break ;
			case 'PEN' :
				return '604' ;
			break ;
			case 'PGK' :
				return '598' ;
			break ;
			case 'PHP' :
				return '608' ;
			break ;
			case 'PKR' :
				return '586' ;
			break ;
			case 'PLN' :
				return '985' ;
			break ;
			case 'PYG' :
				return '600' ;
			break ;
			case 'QAR' :
				return '634' ;
			break ;
			case 'ROL' :
				return '642' ;
			break ;
			case 'RUB' :
				return '643' ;
			break ;
			case 'RUR' :
				return '810' ;
			break ;
			case 'RWF' :
				return '646' ;
			break ;
			case 'SAR' :
				return '682' ;
			break ;
			case 'SBD' :
				return '090' ;
			break ;
			case 'SCR' :
				return '690' ;
			break ;
			case 'SDD' :
				return '736' ;
			break ;
			case 'SEK' :
				return '752' ;
			break ;
			case 'SGD' :
				return '702' ;
			break ;
			case 'SHP' :
				return '654' ;
			break ;
			case 'SIT' :
				return '705' ;
			break ;
			case 'SKK' :
				return '703' ;
			break ;
			case 'SLL' :
				return '694' ;
			break ;
			case 'SOS' :
				return '706' ;
			break ;
			case 'SRG' :
				return '740' ;
			break ;
			case 'STD' :
				return '678' ;
			break ;
			case 'SVC' :
				return '222' ;
			break ;
			case 'SYP' :
				return '760' ;
			break ;
			case 'SZL' :
				return '748' ;
			break ;
			case 'THB' :
				return '764' ;
			break ;
			case 'TJS' :
				return '972' ;
			break ;
			case 'TMM' :
				return '795' ;
			break ;
			case 'TND' :
				return '788' ;
			break ;
			case 'TOP' :
				return '776' ;
			break ;
			case 'TPE' :
				return '626' ;
			break ;
			case 'TRL' :
				return '792' ;
			break ;
			case 'TRY' :
				return '949' ;
			break ;
			case 'TTD' :
				return '780' ;
			break ;
			case 'TWD' :
				return '901' ;
			break ;
			case 'TZS' :
				return '834' ;
			break ;
			case 'UAH' :
				return '980' ;
			break ;
			case 'UGX' :
				return '800' ;
			break ;
			case 'USD' :
				return '840' ;
			break ;
			case 'UYU' :
				return '858' ;
			break ;
			case 'UZS' :
				return '860' ;
			break ;
			case 'VEB' :
				return '862' ;
			break ;
			case 'VND' :
				return '704' ;
			break ;
			case 'VUV' :
				return '548' ;
			break ;
			case 'XAF' :
				return '950' ;
			break ;
			case 'XCD' :
				return '951' ;
			break ;
			case 'XOF' :
				return '952' ;
			break ;
			case 'XPF' :
				return '953' ;
			break ;
			case 'YER' :
				return '886' ;
			break ;
			case 'YUM' :
				return '891' ;
			break ;
			case 'ZAR' :
				return '710' ;
			break ;
			case 'ZMK' :
				return '894' ;
			break ;
			case 'ZWD' :
				return '716' ;
			break ;
		}
		//
		// As default return 208 for Danish Kroner
		//
		return '208' ;
	}
	
	function generateCreditCardList() {
		$res = '' ;
		$res = '<' . '?php if (EPAY_CARDTYPES_1 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(1)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_2 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(2)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_3 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(3)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_4 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(4)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_5 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(5)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_6 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(6)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_7 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(7)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_8 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(8)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_9 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(9)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_10 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(10)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_11 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(11)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_12 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(12)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_13 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(13)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_14 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(14)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_15 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(15)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_16 == "1" && EPAY_CARDTYPES_0 != "1") echo "<script>printCard(16)</script>"?>' ;
		return $res ;
	}
	
	function generateCreditCardListOld() {
		$res = '' ;
		$res = '<' . '?php if (EPAY_CARDTYPES_1 == "1") echo "<script>printCard(1)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_2 == "1") echo "<script>printCard(2)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_3 == "1") echo "<script>printCard(3)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_4 == "1") echo "<script>printCard(4)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_5 == "1") echo "<script>printCard(5)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_6 == "1") echo "<script>printCard(6)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_7 == "1") echo "<script>printCard(7)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_8 == "1") echo "<script>printCard(8)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_9 == "1") echo "<script>printCard(9)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_10 == "1") echo "<script>printCard(10)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_11 == "1") echo "<script>printCard(11)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_12 == "1") echo "<script>printCard(12)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_13 == "1") echo "<script>printCard(13)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_14 == "1") echo "<script>printCard(14)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_15 == "1") echo "<script>printCard(15)</script>"?>' . '<' . '?php if (EPAY_CARDTYPES_16 == "1") echo "<script>printCard(16)</script>"?>' ;
		return $res ;
	}
	
	function genAcceptUrl( $callback ) {
		if( $callback ) {
			return '<input type="hidden" name="callbackurl" value="<' . '?php if (EPAY_CALLBACK == "1") echo $mosConfig_live_site . "/index.php?page=checkout.epay_result&accept=1&sessionid=" . $sessionid . "&option=com_virtuemart&Itemid=1" ?>">' ;
		} else {
			return '<input type="hidden" name="accepturl" value="<' . '?php echo $mosConfig_live_site ?>/index.php?page=checkout.epay_result&accept=1&sessionid=<' . '?php echo $sessionid ?>&option=com_virtuemart&Itemid=1">' ;
		}
	}
	
	/**************************************************************************
	 ** name: process_payment()
	 ** created by: ryan
	 ** description: process transaction for PayMeNow
	 ** parameters: $order_number, the number of the order, we're processing here
	 **            $order_total, the total $ of the order
	 ** returns: 
	 ***************************************************************************/
	function process_payment( $order_number, $order_total, &$d ) {
		return true ;
	}
}
