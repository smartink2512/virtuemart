<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: free_shipping.php,v 1.5 2005/07/19 20:18:46 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage Shipping
*
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license GNU General Public License (GPL)
*
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
* 
* Just a dummy class for "Free SHIPPING"
* You can set the Cart Total for Free Shipping in the Store Form (Edit Store)
*/

class free_shipping {

  var $classname = "free_shipping";
  
  /**************************************************************************
  ** name: list_rates( $d )
  ** created by: soeren
  ***************************************************************************/  
  function list_rates( &$d ) {
      global $vendor_name, $PHPSHOP_LANG;
      
      $html = "<strong>".$PHPSHOP_LANG->_PHPSHOP_FREE_SHIPPING_CUSTOMER_TEXT."</strong><br/>\n";
      $html .= "<input type=\"hidden\" name=\"shipping_rate_id\" value=\"free_shipping|$vendor_name|".$PHPSHOP_LANG->_PHPSHOP_FREE_SHIPPING."|0|1\" />";
      
      echo $html;
      return true;
    }
    
  /**************************************************************************
  ** name: get_rate( $d )
  ** created by: soeren
  ***************************************************************************/
   function get_rate( &$d ) {
   
      return 0;
      
   } 
   
  /**************************************************************************
  ** name:  get_tax_rate() {( $d )
  ** created by: soeren
  ***************************************************************************/
   function get_tax_rate() {
   
      return 0;
      
   }
   /**************************************************************************
   * name: validate()
   * created by: soeren
   * parameters: $vars
   * returns: true
   **************************************************************************/
  function validate( &$d ) {
    global $vendor_freeshipping;
    
    return true;
  }
}
?>
