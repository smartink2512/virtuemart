<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: zone_shipping.php,v 1.6 2005/04/19 06:06:18 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage Shipping
*
* @copyright (C) 2000 - 2004 devcompany.com  All rights reserved.
* @author Mike Wattier - geek@devcompany.com
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license phpShop Public License (pSPL) Version 1.0
*
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
* 
* Welcome To The Shipping Zone =]
*/


class zone_shipping {

  var $classname = "zone_shipping";
  
  /**************************************************************************
  ** name: list_rates($d)
  ** created by: mwattier <geek@devcompany.com>
  ** description:  Get the rate according to what is in the basket AND
  **               the zone charge unless it hits the limit, then return that
  **               
  ** parameters: $ship_to_info_id - Where are we shipping to
  **             $zone_qty - This is what we use to see if we need to apply
  **             the limit or a per item cost
  ** returns: the cost to ship this order
  ***************************************************************************/  
  function list_rates( &$d ) {
      global $CURRENCY_DISPLAY;
      $db = new ps_DB;
      
      $q = "SELECT country FROM #__users WHERE ";
      $q .= "user_info_id='". $d["ship_to_info_id"] . "'";
      $db->query($q);
      
      if (!$db->num_rows()) {
          $q = "SELECT country FROM #__pshop_user_info WHERE ";
          $q .= "user_info_id='". $d["ship_to_info_id"] . "'";
          $db->query($q);
      }
      $db->next_record(); 
      $country = $db->f("country");
      
      $q2 = "SELECT country_name, zone_id FROM #__pshop_country WHERE country_3_code='$country' ";
      $db->query($q2);
      $db->next_record(); 
      $the_zone = $db->f("zone_id");
      $country_name = $db->f("country_name");

      if ( $_SESSION['auth']['show_price_including_tax'] != 1 ) {
          $taxrate = 1;
      }
      else {
          $taxrate = $this->get_tax_rate( $the_zone ) + 1;
      }
      
      $q3 = "SELECT * FROM #__pshop_zone_shipping WHERE zone_id ='$the_zone' ";
      $db->query($q3);
      $db->next_record(); 

      $cost_low = $db->f("zone_cost") * $d["zone_qty"];

      if($cost_low < $db->f("zone_limit")) {
         $rate = $cost_low;
      } 
      else {
         $rate = $db->f("zone_limit");
      }
      $rate *= $taxrate;
      
      // THE ORDER OF THOSE VALUES IS IMPORTANT:
      // carrier_name|rate_name|totalshippingcosts|rate_id
      $value = urlencode($this->classname."|".$the_zone."|".$country."|".$rate."|".$the_zone);
      
      $_SESSION[$value] = "1";
      $string = "<input type=\"radio\" checked=\"checked\" name=\"shipping_rate_id\" value=\"$value\" />";
      $string .= "Zone Shipping $country_name: <strong>". $CURRENCY_DISPLAY->getFullValue($rate )."</strong>";
      
      echo $string;
    }
    
  function get_rate( &$d ) {	
  
	  $shipping_rate_id = $_REQUEST["shipping_rate_id"];
	  $zone_arr = explode("|", urldecode(urldecode($shipping_rate_id)) );
	  $order_shipping = $zone_arr[3];
	  
	  return $order_shipping;
  }

	
  function get_tax_rate( $zone_id=0 ) {
      global $database;
      
	  if( $zone_id == 0 ) {
          $shipping_rate_id = $_REQUEST["shipping_rate_id"];
          $zone_arr = explode("|", urldecode(urldecode($shipping_rate_id)) );
          $zone_id = $zone_arr[4];
      }
	  $database->setQuery( "SELECT tax_rate FROM #__pshop_zone_shipping,#__pshop_tax_rate WHERE zone_id='$zone_id' AND zone_tax_rate=tax_rate_id" );
      $database->loadObject( $tax_rate );
	  if( $tax_rate ) 
        return $tax_rate->tax_rate;
      else
        return 0;
  }
	
	/**
    * Validate this Shipping method by checking if the SESSION contains the key
    * @returns boolean False when the Shipping method is not in the SESSION
    */
	function validate( $d ) {
	  $shipping_rate_id = $_REQUEST["shipping_rate_id"];
	  
	  if( array_key_exists( $shipping_rate_id, $_SESSION ))
		return true;
	  else
		return false;
	}

}
?>
