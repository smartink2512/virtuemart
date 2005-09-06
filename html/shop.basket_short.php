<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shop.basket_short.php,v 1.12 2005/05/21 16:08:00 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.phpshop.org, forums.phpshop.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );

require_once(CLASSPATH. 'ps_product.php' );
$ps_product =& new ps_product;
require_once(CLASSPATH. 'ps_shipping_method.php' );
require_once(CLASSPATH. 'ps_checkout.php' );
$ps_checkout =& new ps_checkout;

global $CURRENCY_DISPLAY, $vars;

$cart = $_SESSION['cart'];
$auth = $_SESSION['auth'];
  if ($cart["idx"] == 0) {
     echo $PHPSHOP_LANG->_PHPSHOP_EMPTY_CART;
     $checkout = false;
  }
  else {
    $checkout = True;

    $total = $order_taxable = $order_tax = 0;
    $amount = 0;
    $weight_total = 0;
    
    for ($i=0;$i<$cart["idx"];$i++) {

      $price = $ps_product->get_adjusted_attribute_price($cart[$i]["product_id"],$cart[$i]["description"]);
      $amount += $cart[$i]["quantity"];

      if (@$auth["show_price_including_tax"] == 1) {
        $my_taxrate = $ps_product->get_product_taxrate($cart[$i]["product_id"] );
        $price["product_price"] *= ($my_taxrate+1);
      }
      $subtotal = round( $price["product_price"], 2 ) * $cart[$i]["quantity"];
      $total += $subtotal;

      $weight_subtotal = ps_shipping_method::get_weight($cart[$i]["product_id"]);
      $weight_total += $weight_subtotal;
    }
    
    if( !empty($_SESSION['coupon_discount']) ) {
        $total -= $_SESSION['coupon_discount'];
    }
    
    if ($amount > 1) 
      echo $amount ." ". $PHPSHOP_LANG->_PHPSHOP_PRODUCTS_LBL;
    else
      echo $amount ." ". $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LBL;
    
    echo ",<br /> ";
    
    echo $CURRENCY_DISPLAY->getFullValue( $total );
  }
?>
