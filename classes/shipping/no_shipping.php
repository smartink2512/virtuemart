<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: no_shipping.php,v 1.3 2005/04/19 06:06:18 soeren_nb Exp $
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
* Just a dummy class for "NO SHIPPING"
*/

class no_shipping {

  var $classname = "no_shipping";
  
  /**************************************************************************
  ** name: list_rates( $d )
  ** created by: soeren
  ***************************************************************************/  
  function list_rates( &$d ) {
      return "";
    }
    
  /**************************************************************************
  ** name: get_rate( $d )
  ** created by: soeren
  ***************************************************************************/
   function get_rate( &$d ) {
      return 0;
   }
  /**************************************************************************
  ** name: get_tax_rate()
  ** created by: soeren
  ***************************************************************************/
   function get_tax_rate() {
      return 0;
   }

}
?>
