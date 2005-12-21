<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: basket.php,v 1.6 2005/11/05 14:11:57 soeren_nb Exp $
* @package VirtueMart
* @subpackage html
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
mm_showMyFileName( __FILE__ );

require_once(CLASSPATH. 'ps_product.php' );
$ps_product = new ps_product;
require_once(CLASSPATH. 'ps_checkout.php' );
$ps_checkout = new ps_checkout;
require_once(CLASSPATH . 'ps_shipping_method.php' );

global $weight_total, $total, $tax_total, $cart;

/* make sure this is the checkout screen */
if ($cart["idx"] == 0) {
	echo $VM_LANG->_PHPSHOP_EMPTY_CART;
	$checkout = False;
}
else {
	$checkout = True;

	$total = 0;
	// Added for the zone shipping module
	$vars["zone_qty"] = 0;
	$weight_total = 0;
	$weight_subtotal = 0;
	$tax_total = 0;
	$shipping_total = 0;
	$shipping_tax = 0;
	$order_total = 0;
	$discount_before=$discount_after=$show_tax=$shipping=false;
	$product_rows = Array();

	for ($i=0;$i<$cart["idx"];$i++) {
		// Added for the zone shipping module
		$vars["zone_qty"] += $cart[$i]["quantity"];

		if ($i % 2) $product_rows[$i]['row_color'] = "sectiontableentry2";
		else $product_rows[$i]['row_color'] = "sectiontableentry1";

		// Get product parent id if exists
		$product_parent_id=$ps_product->get_field($cart[$i]["product_id"],"product_parent_id");

		// Get flypage for this product
		$flypage = $ps_product->get_flypage($cart[$i]["product_id"]);

		// Build URL based on whether item or product
		if ($product_parent_id) {
			$url = $sess->url(URL . "index.php?page=shop.product_details&flypage=$flypage&product_id=$product_parent_id");
		}
		else {
			$url = $sess->url(URL . "index.php?page=shop.product_details&flypage=$flypage&product_id=" . $_SESSION['cart'][$i]["product_id"]);
		}

		$product_rows[$i]['product_name'] = "<a href=\"$url\"><strong>"
		. $ps_product->get_field($_SESSION['cart'][$i]["product_id"], "product_name")
		. "</strong></a><br />"
		. $ps_product->getDescriptionWithTax( $_SESSION['cart'][$i]["description"], $_SESSION['cart'][$i]["product_id"] );

		// Display attribute values if this an item
		$product_rows[$i]['product_attributes'] = "";
		if ($product_parent_id) {
			$db_detail=$ps_product->attribute_sql($cart[$i]["product_id"],$product_parent_id);
			while ($db_detail->next_record()) {
				$product_rows[$i]['product_attributes'] .= "<br />" . $db_detail->f("attribute_name") . "&nbsp;";
				$product_rows[$i]['product_attributes'] .= "(" . $db_detail->f("attribute_value") . ")";
			}
		}
		$product_rows[$i]['product_sku'] = $ps_product->get_field($cart[$i]["product_id"], "product_sku");

		/* WEIGHT CALCULATION */
		$weight_subtotal = ps_shipping_method::get_weight($cart[$i]["product_id"]) * $cart[$i]['quantity'];
		$weight_total += $weight_subtotal;

		/* Product PRICE */
		$my_taxrate = $ps_product->get_product_taxrate($cart[$i]["product_id"], $weight_subtotal);
		$tax = $my_taxrate * 100;

		$price = $ps_product->get_adjusted_attribute_price($cart[$i]["product_id"], $cart[$i]["description"]);

		if( $auth["show_price_including_tax"] == 1 ) {
			$product_price = $price["product_price"] * ($my_taxrate+1);
		} else {
			$product_price = $price["product_price"];
		}

		$product_price = round( $product_price, 2 );
		$product_rows[$i]['product_price'] = $CURRENCY_DISPLAY->getFullValue($product_price);

		/* Quantity Box */
		$product_rows[$i]['quantity_box'] = "<input type=\"text\" title=\"". $VM_LANG->_PHPSHOP_CART_UPDATE ."\" class=\"inputbox\" size=\"4\" maxlength=\"4\" name=\"quantity\" value=\"".$cart[$i]["quantity"]."\" />";

		/* SUBTOTAL CALCULATION */
		$subtotal = $product_price * $cart[$i]["quantity"];

		$total += $subtotal;
		$product_rows[$i]['subtotal'] = $CURRENCY_DISPLAY->getFullValue($subtotal);
		if (!empty($my_taxrate) && MULTIPLE_TAXRATES_ENABLE=='1') {
			if( $auth["show_price_including_tax"] == 1 ) {
				eval( "\$message = \"".$VM_LANG->_PHPSHOP_INCLUDING_TAX."\";" );
				$product_rows[$i]['subtotal'] .= "&nbsp;".$message;
			}
			else {
				$product_rows[$i]['subtotal'] .= "&nbsp;(+ $tax% ".$VM_LANG->_PHPSHOP_CART_TAX.")";
			}
		}

		/* UPDATE CART / DELETE FROM CART */
		$action_url = $mm_action_url."index.php";
		$product_rows[$i]['update_form'] = "<input type=\"hidden\" name=\"page\" value=\"". $_REQUEST['page'] ."\" />
        <input type=\"hidden\" name=\"func\" value=\"cartUpdate\" />
        <input type=\"hidden\" name=\"product_id\" value=\"". $_SESSION['cart'][$i]["product_id"] ."\" />
        <input type=\"hidden\" name=\"Itemid\" value=\"". @$_REQUEST['Itemid'] ."\" />
        <input type=\"hidden\" name=\"description\" value=\"". $cart[$i]["description"]."\" />
        <input type=\"image\" name=\"update\" title=\"". $VM_LANG->_PHPSHOP_CART_UPDATE ."\" src=\"". IMAGEURL ."ps_image/edit_f2.gif\" border=\"0\"  alt=\"". $VM_LANG->_PHPSHOP_UPDATE ."\" />
      </form>";
		$product_rows[$i]['delete_form'] = "<form action=\"$action_url\" method=\"post\" name=\"delete\" >
        <input type=\"hidden\" name=\"option\" value=\"com_virtuemart\" />
        <input type=\"hidden\" name=\"page\" value=\"". $_REQUEST['page'] ."\" />
        <input type=\"hidden\" name=\"Itemid\" value=\"". @$_REQUEST['Itemid'] ."\" />
        <input type=\"hidden\" name=\"func\" value=\"cartDelete\" />
        <input type=\"hidden\" name=\"product_id\" value=\"". $_SESSION['cart'][$i]["product_id"] ."\" />
        <input type=\"hidden\" name=\"description\" value=\"". $cart[$i]["description"]."\" />
      <input type=\"image\" name=\"delete\" title=\"". $VM_LANG->_PHPSHOP_CART_DELETE ."\" src=\"". IMAGEURL ."ps_image/delete_f2.gif\" border=\"0\" alt=\"". $VM_LANG->_PHPSHOP_CART_DELETE ."\" />
      </form>";
	} // End of for loop through the Cart

	$total = $total_undiscounted = round($total, 2);
	$subtotal_display = $CURRENCY_DISPLAY->getFullValue($total);

	if (!empty($_POST["do_coupon"])) {
		/* process the coupon */

		/* make sure they arent trying to run it twice */
		if (@$_SESSION['coupon_redeemed'] == true && $page != 'shop.cart') {
			$vmLogger->warning( $VM_LANG->_PHPSHOP_COUPON_ALREADY_REDEEMED );
		}
		else {
			require_once( CLASSPATH . "ps_coupon.php" );
			$vars["total"] = $total;
			ps_coupon::process_coupon_code( $vars );
		}
	}

	/* COUPON DISCOUNT */
	if( PSHOP_COUPONS_ENABLE=='1' && @$_SESSION['coupon_redeemed']=="1" && PAYMENT_DISCOUNT_BEFORE=='1') {
		$total -= $_SESSION['coupon_discount'];
		$coupon_display = "- ".$CURRENCY_DISPLAY->getFullValue( $_SESSION['coupon_discount'] );
		$discount_before=true;
	}

	/* SHOW SHIPPING COSTS */
	if( !empty($shipping_rate_id) && (CHECKOUT_STYLE =='1' || CHECKOUT_STYLE=='3')) {
		$shipping = true;
		$vars["weight"] = $weight_total;
		$shipping_total = round( $ps_checkout->_SHIPPING->get_rate ( $vars ), 2 );
		$shipping_taxrate = $ps_checkout->_SHIPPING->get_tax_rate();

		// When the Shipping rate is shown including Tax
		// we have to extract the Tax from the Shipping Total
		if( $auth["show_price_including_tax"] == 1 ) {
			$shipping_tax = round($shipping_total- ($shipping_total / (1+$shipping_taxrate)), 2);
		}
		else {
			$shipping_tax = round($shipping_total * $shipping_taxrate, 2);
		}
		$shipping_display = $CURRENCY_DISPLAY->getFullValue($shipping_total);
	}
	else {
		$shipping_total = 0;
		$shipping_display = "";
	}

	/* SHOW TAX */
	if (!empty($_REQUEST['ship_to_info_id']) || $auth["show_price_including_tax"] == 1) {
		$coupon_discount = mosGetParam( $_SESSION, 'coupon_discount', 0 );
		$show_tax = true;
		if ($auth["show_price_including_tax"] == 1 || PAYMENT_DISCOUNT_BEFORE == '1') {
			// Here we need to re-calculate the Discount
			// because we assume the Discount is "including Tax"
			$taxrate = ps_product::get_taxrate();
			$coupon_discount_untaxed = round( $coupon_discount / ($taxrate+1), 2);
		}
		else {
			$coupon_discount_untaxed = $coupon_discount;
		}
		if ($weight_total != 0 or TAX_VIRTUAL=='1') {
			$order_taxable = $ps_checkout->calc_order_taxable($vars);
			$tax_total = $ps_checkout->calc_order_tax($order_taxable-$coupon_discount_untaxed, $vars);
		} else {
			$tax_total = 0;
		}
		$tax_total += $shipping_tax;
		$tax_total = round( $tax_total, 2 );
		$tax_display = $CURRENCY_DISPLAY->getFullValue($tax_total);
	}

	/* COUPON DISCOUNT */
	if( PSHOP_COUPONS_ENABLE=='1' && @$_SESSION['coupon_redeemed']=="1" && PAYMENT_DISCOUNT_BEFORE != '1') {
		$discount_after=true;
		$total -= $_SESSION['coupon_discount'];
		$coupon_display = "- ".$CURRENCY_DISPLAY->getFullValue( $_SESSION['coupon_discount'] );
	}

	// Attention: When show_price_including_tax is 1,
	// we already have an order_total including the Tax!
	if( $auth["show_price_including_tax"] == 0 ) {
		$order_total += $tax_total;
		$total_undiscounted += $tax_total;
	}
	$order_total += $shipping_total + $total;
	$total_undiscounted += $shipping_total;

	/* check if the minimum purchase order value has already been reached */
	if (round($_SESSION['minimum_pov'], 2) > 0.00) {
		if ($total_undiscounted >= $_SESSION['minimum_pov']) {
			// OKAY!
			define ('_MIN_POV_REACHED', '1');
		}
	} else
	define ('_MIN_POV_REACHED', '1');

	$order_total_display = $CURRENCY_DISPLAY->getFullValue($order_total);
	if( $show_basket ) {
		if( $auth["show_price_including_tax"] == 1) {
			include (PAGEPATH."templates/basket/basket_b2c.html.php");
		}
		else {
			include (PAGEPATH."templates/basket/basket_b2b.html.php");
		}
	}
   	/* Input Field for the Coupon Code */
	if( PSHOP_COUPONS_ENABLE=='1' 
		&& !@$_SESSION['coupon_redeemed']
		&& ( @$checkout_this_step == CHECK_OUT_GET_PAYMENT_METHOD
			|| @$checkout_this_step == CHECK_OUT_GET_SHIPPING_ADDR && CHECKOUT_STYLE != 3 
			|| @$checkout_this_step == CHECK_OUT_GET_SHIPPING_METHOD && CHECKOUT_STYLE == 3 
			)
		) {  
	 	include (PAGEPATH."coupon.coupon_field.php"); 	
	}
}
?>
