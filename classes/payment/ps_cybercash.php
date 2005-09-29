<?php
/**
* @version $Id: ps_cybercash.php,v 1.1 2005/09/06 20:04:20 soeren_nb Exp $
* @package VirtueMart
* @subpackage Payment
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.virtuemart.org, forums.virtuemart.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* VirtueMart is Free Software.
* VirtueMart comes with absolute no warranty.
*
* www.virtuemart.net
*
* The ps_cybercash class, containing the payment processing code
*  for transactions with deprecated cybercash
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class ps_cybercash {

    var $payment_code = "CC";
    var $classname = "ps_cybercash";
  
    /**
    * Show all configuration parameters for this payment method
    * @returns boolean False when the Payment method has no configration
    */
    function show_configuration() {
      global $VM_LANG;
      
      /** Read current Configuration ***/
      require_once(CLASSPATH ."payment/".$this->classname.".cfg.php");
    ?>
      <table>
        <tr>
            <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND ?></strong></td>
            <td>
                <input type="text" name="CC_MERCHANT" class="inputbox" value="<? echo CC_MERCHANT ?>" />
            </td>
            <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_EXPLAIN ?>
            </td>
        </tr>
        <tr>
            <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY ?></strong></td>
            <td>
                <input type="text" name="CC_MERCHANT_KEY" class="inputbox" value="<? echo CC_MERCHANT_KEY ?>" />
            </td>
            <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CYBERCASH_MERCHAND_KEY_EXPLAIN ?>
            </td>
        </tr>
        <tr>
            <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CYBERCASH_URL ?></strong></td>
            <td>
                <input type="text" name="CC_PAYMENT_URL" class="inputbox" value="<? echo CC_PAYMENT_URL ?>" />
            </td>
            <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CYBERCASH_URL_EXPLAIN ?>
            </td>
        </tr>
        <tr>
            <td><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE ?></strong></td>
            <td>
                <input type="text" name="CC_AUTH_TYPE" class="inputbox" value="<? echo CC_AUTH_TYPE ?>" />
            </td>
            <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CYBERCASH_AUTENTICATIONTYPE_EXPLAIN ?>
            </td>
        </tr>
      </table>
   <?php
    }
    
    function has_configuration() {
      // return false if there's no configuration
      return true;
   }
   
  /**
	* Returns the "is_writeable" status of the configuration file
	* @param void
	* @returns boolean True when the configuration file is writeable, false when not
	*/
   function configfile_writeable() {
      return is_writeable( CLASSPATH."payment/".$this->classname.".cfg.php" );
   }
   
  /**
	* Returns the "is_readable" status of the configuration file
	* @param void
	* @returns boolean True when the configuration file is writeable, false when not
	*/
   function configfile_readable() {
      return is_readable( CLASSPATH."payment/".$this->classname.".cfg.php" );
   }
   
  /**
	* Writes the configuration file for this payment method
	* @param array An array of objects
	* @returns boolean True when writing was successful
	*/
   function write_configuration( &$d ) {
      if(!isset($d['CC_ENABLE'])) $d['CC_ENABLE'] = '0';
      $my_config_array = array("CC_MERCHANT" => $d['CC_MERCHANT'],
                                              "CC_MERCHANT_KEY" => $d['CC_MERCHANT_KEY'],
                                              "CC_PAYMENT_URL" => $d['CC_PAYMENT_URL'],
                                              "CC_AUTH_TYPE" => $d['CC_AUTH_TYPE']
                                      );
      $config = "<?php\n";
      $config .= "defined('_VALID_MOS') or die('Direct Access to this location is not allowed.'); \n\n";
      foreach($my_config_array as $key => $value) {
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
   
  /**************************************************************************
  ** name: process_payment()
  ** created by: pablo
  ** description: Based on the cyberlib class found in the PHP extensions library.
  ** parameters: $order_number, the number of the order, we're processing here
  **            $order_total, the total $ of the order
  ** returns: 
  ***************************************************************************/
   function process_payment($order_number, $order_total, &$d) {
   
     $ps_vendor_id = $_SESSION["ps_vendor_id"];
     $auth = $_SESSION['auth'];
        
     /*** Get the Configuration File for cybercash ***/
     require_once(CLASSPATH ."payment/".$this->classname.".cfg.php");
      
     require_once(CLASSPATH.'ps_cyberlib.php');
     
     // Get user billing information
     $dbbt = new ps_DB;
     $qt = "SELECT * from #__users ";
     $qt .= "WHERE id='".$auth["user_id"]."' ";
     $qt .= "AND address_type='BT'";
     $dbbt->query($qt);
     if (!$db->num_rows()) {
         $qt = "SELECT * from #__{vm}_user_info ";
         $qt .= "WHERE user_id='".$auth["user_id"]."' ";
         $qt .= "AND address_type='BT'";
         $dbbt->query($qt);
     }
     $dbbt->next_record();     

     $merchant=CC_MERCHANT;
     $merchant_key=CC_MERCHANT_KEY;
     $payment_url=CC_PAYMENT_URL;
     $auth_type=CC_AUTH_TYPE;
     
     $expire_date = date("m/y",$d["order_payment_expire"]);

     $response=SendCC2_1Server($merchant,$merchant_key,$payment_url,
			       $auth_type,
			       array(
				     "Order-ID" => $order_number,
				     "Amount" => $this->get_vendor_currency($ps_vendor_id) . " " . $order_number,
				     "Card-Number" => $d["order_payment_number"],
				     "Card-Address" => $dbbt->f("address_1"),
				     "Card-City" => $dbbt->f("city"),
				     "Card-State" => $dbbt->f("state"),
				     "Card-Zip" => $dbbt->f("zip"),
				     "Card-Country" => $dbbt->f("country"),
				     "Card-Exp" => $expire_date,
				     "Card-Name" => $dbbt->f("first_name")." ".$dbbt->f("last_name")
				     )
			       );
    
     $d["order_payment_log"] = "";
     while(list($key,$val)=each($response)) {
       $d["order_payment_log"] .= $key."=".$val."<br>";
     }   
     
     if ($response["MStatus"] == "success")
       return True;
     else {
       $d["error"] = $response["MErrMsg"];
       return False;
     }
    }
   
}
