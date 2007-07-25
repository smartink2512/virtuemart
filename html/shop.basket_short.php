<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2007 Soeren Eberhardt. All rights reserved.
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
$ps_product =& new ps_product;
require_once(CLASSPATH. 'ps_shipping_method.php' );
require_once(CLASSPATH. 'ps_checkout.php' );
$ps_checkout =& new ps_checkout;

global $CURRENCY_DISPLAY, $VM_LANG, $vars,$mosConfig_live_site, $sess, $mm_action_url;

$catid = mosgetparam($_REQUEST, "category_id", null);
$prodid = mosgetparam($_REQUEST, "product_id", null);
$page = mosgetparam($_REQUEST, "page", null);
$flypage = mosgetparam($_REQUEST, "flypage", null);
$Itemid = mosgetparam($_REQUEST, "Itemid", null);
$option = mosgetparam($_REQUEST, "option", null);
$page =mosGetParam( $_REQUEST, 'page', null );
$tpl = new $GLOBALS['VM_THEMECLASS']();
$cart = $_SESSION['cart'];
$saved_cart = @$_SESSION['savedcart'];
$auth = $_SESSION['auth'];
$empty_cart = false;
$minicart = array();
if ($cart["idx"] == 0) {
	$empty_cart = true;
	$checkout = false;
}
else {
	$empty_cart = false;
	$checkout = True;
	$total = $order_taxable = $order_tax = 0;
	$amount = 0;
	$weight_total = 0;
	$html="";

	// Determiine the cart direction and set vars
	if (@$_SESSION['vmCartDirection']) {
		$i=0;
		$up_limit = $cart["idx"] ;
	}
	else {
		$i=$cart["idx"]-1;
		$up_limit = -1;
	}
	$ci = 0;

	//Start loop through cart
	do
	{
		//If we are not showing the minicart start the styling of the individual products

		$price = $ps_product->get_adjusted_attribute_price($cart[$i]["product_id"],$cart[$i]["description"]);
		$price["product_price"] = $GLOBALS['CURRENCY']->convert( $price["product_price"], $price["product_currency"] );
		$amount += $cart[$i]["quantity"];
		$product_parent_id=$ps_product->get_field($cart[$i]["product_id"],"product_parent_id");
		if (@$auth["show_price_including_tax"] == 1) {
			$my_taxrate = $ps_product->get_product_taxrate($cart[$i]["product_id"] );
			$price["product_price"] *= ($my_taxrate+1);
		}
		$subtotal = round( $price["product_price"], 2 ) * $cart[$i]["quantity"];
		$total += $subtotal;
		$flypage_id = $product_parent_id;
		if($flypage_id == 0) {
			$flypage_id = $cart[$i]["product_id"];
		}
		$flypage = $ps_product->get_flypage($flypage_id);
		$category_id=$cart[$i]["category_id"];
		if ($product_parent_id) {
			$url = $sess->url(URL . "index.php?page=shop.product_details&flypage=$flypage&product_id=$product_parent_id&category_id=$category_id");
		}
		else {
			$url = $sess->url(URL . "index.php?page=shop.product_details&flypage=$flypage&category_id=$category_id&product_id=" . $_SESSION['cart'][$i]["product_id"]);
		}
		$html = str_replace("_"," ",$ps_product->getDescriptionWithTax( $_SESSION['cart'][$i]["description"], $_SESSION['cart'][$i]["product_id"] ))." ";
		if ($product_parent_id) {
			$db_detail=$ps_product->attribute_sql($cart[$i]["product_id"],$product_parent_id);
			while ($db_detail->next_record()) {
				$html .= $db_detail->f("attribute_value") . " ";
			}
		}
		$minicart[$ci]['url'] = $url;
		$minicart[$ci]['product_name'] = $ps_product->get_field($_SESSION['cart'][$i]["product_id"], "product_name");
		$minicart[$ci]['quantity'] = $cart[$i]["quantity"];
		$minicart[$ci]['price'] = $CURRENCY_DISPLAY->getFullValue( $subtotal );
		$minicart[$ci]['attributes'] = $html;
		if(@$_SESSION['vmCartDirection']) {
			$i++;
		}
		else {
			$i--;
		}

		$ci++;
	} while ($i != $up_limit);
	//End loop through cart


}
if( !empty($_SESSION['coupon_discount']) ) {
	$total -= $_SESSION['coupon_discount'];
}
if(!$empty_cart) {
	if ($amount > 1) {
		$total_products = $amount ." ". $VM_LANG->_PHPSHOP_PRODUCTS_LBL;
	}
	else {
		$total_products = $amount ." ". $VM_LANG->_PHPSHOP_PRODUCT_LBL;
	}


	$total_price = $CURRENCY_DISPLAY->getFullValue( $total );
}
// Display clear cart
if(@$_SESSION['vmEnableEmptyCart'] && !@$_SESSION['vmMiniCart']) {
	// Output the empty cart button
	//echo vmCommonHTML::scriptTag( $mosConfig_live_site.'/components/'.$option.'/js/wz_tooltip.js' );
	$delete_cart = "<a href=\"".$_SERVER['PHP_SELF'] . "?page=shop.cart_reset&option=com_virtuemart&option2=$option&product_id=$prodid&category_id=$catid&return=$page&flypage=$flypage&Itemid=$Itemid\" title=\"". $VM_LANG->_PHPSHOP_EMPTY_YOUR_CART ." \"><img src=\"". $mosConfig_live_site ."/images/cancel_f2.png\" width=\"12\"border=\"0\" style=\"float: right;vertical-align: middle;\"   alt=\"". $VM_LANG->_PHPSHOP_EMPTY_YOUR_CART ." \" />
      </a>"; 
	$html1 = vmToolTip("Clear the cart of all contents", "Empty Cart",'','',$empty_cart,true);
	$delete_cart = $html1;
	//echo $empty_cart;
}


$href = $sess->url($mm_action_url."index.php?page=shop.cart");
$href2 = $sess->url($mm_action_url."index2.php?page=shop.cart");
$text = $VM_LANG->_PHPSHOP_CART_SHOW;
if( $_SESSION['vmUseGreyBox'] ) {
	$show_cart = vmCommonHTML::getGreyboxPopUpLink( $href2, $text, '', $text, '', 500, 600, $href );
}
else {
	$show_cart = vmCommonHTML::hyperlink( $href, $text, '', $text, '' );
}
print @$_SESSION['vmMiniCart'];
$tpl->set('minicart',$minicart);
$tpl->set('empty_cart', $empty_cart);
$tpl->set('vmMinicart', @$_SESSION['vmMiniCart']);
$tpl->set('total_products', @$total_products);
$tpl->set('total_price', @$total_price);
$tpl->set('show_cart', @$show_cart);
$saved_cart_text = "";
if($saved_cart['idx'] != 0) {
	$saved_cart_text = "<a href=\"".str_replace("Itemid=26","Itemid=34",$sess->url($mm_action_url."index.php?page=shop.savedcart"))."\" class=\"savedCart\">".$VM_LANG->_VM_RECOVER_CART."</a>";
}
$tpl->set('saved_cart',$saved_cart_text);
echo $tpl->fetch( 'common/minicart.tpl.php');
?>
