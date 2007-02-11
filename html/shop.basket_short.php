<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
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

$cart = $_SESSION['cart'];
$auth = $_SESSION['auth'];
if ($cart["idx"] == 0) {
	echo "<div align=\"center\">";
	if (@$_SESSION['vmShowEmptyCart'] && !@$_SESSION['vmMiniCart']) {
		if (@$_SESSION['vmShowLogo']) {
			echo "<a href='http://virtuemart.net/' target='_blank'><img src=\"".$mm_action_url.'components/com_virtuemart/shop_image/ps_image/menu_logo.gif'."\" alt=\"VirtueMart\" width=\"80\" border=\"0\" valign=\"center\" align=\"center\" /></a>";
			echo "<br/>";
		}

		echo $VM_LANG->_PHPSHOP_EMPTY_CART;
	}
	if(@$_SESSION['vmMiniCart']) {
		echo $VM_LANG->_PHPSHOP_EMPTY_CART;
	}
	echo "</div>";
	$checkout = false;
}
else {
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

	//Start loop through cart
	do
	{
		//If we are not showing the minicart start the styling of the individual products
		if(!$_SESSION['vmMiniCart']) {
			echo "<div style=\"float: left;\">";
		}

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

		$weight_subtotal = ps_shipping_method::get_weight($cart[$i]["product_id"]) * $cart[$i]["quantity"];
		$weight_total += $weight_subtotal;
		$flypage = $ps_product->get_flypage($cart[$i]["product_id"]);
		if ($product_parent_id) {
			$url = $sess->url(URL . "index.php?page=shop.product_details&flypage=$flypage&product_id=$product_parent_id");
		}
		else {
			$url = $sess->url(URL . "index.php?page=shop.product_details&flypage=$flypage&product_id=" . $_SESSION['cart'][$i]["product_id"]);
		}
		$prod_url = "<a href=\"$url\">".$ps_product->get_field($_SESSION['cart'][$i]["product_id"], "product_name")."</a>";
		if (@$_SESSION['vmShowQuantity'] && !$_SESSION['vmMiniCart']) {
			echo $cart[$i]["quantity"]." * ";
		}
		if (@$_SESSION['vmShowName'] && !$_SESSION['vmMiniCart']) {
			echo  $prod_url." ";
		}
		if (@$_SESSION['vmShowPrice'] && !$_SESSION['vmMiniCart']) {
			If(@$_SESSION['vmAlignPrice']) //Align price to the right
			echo "</div><div style=\"float: right;\">";
			echo  $CURRENCY_DISPLAY->getFullValue( $subtotal );
			If(@$_SESSION['vmAlignPrice']) //End align price to the right
			echo "</div>";
		}
		if (@$_SESSION['vmShowAttrib'] && !$_SESSION['vmMiniCart']) {
			$html = $ps_product->getDescriptionWithTax( $_SESSION['cart'][$i]["description"], $_SESSION['cart'][$i]["product_id"] )." ";
			if ($product_parent_id) {
				$db_detail=$ps_product->attribute_sql($cart[$i]["product_id"],$product_parent_id);
				while ($db_detail->next_record()) {
					$html .= $db_detail->f("attribute_value") . " ";
				}
			}
			if($html != "")
			echo "<br style=\"clear: both;\" />".$html;
		}

		if(!$_SESSION['vmMiniCart']) {
			If(!@$_SESSION['vmAlignPrice'])
			echo "</div>";
			if(!@$_SESSION['vmShowAttrib'] && !$_SESSION['vmMiniCart'])
			echo  "<br style=\"clear: both;\" />";
		}
		if(@$_SESSION['vmCartDirection']) {
			$i++;
		}
		else {
			$i--;
		}
		echo '</div>';
		
	} while ($i != $up_limit);
	//End loop through cart

	if(!$_SESSION['vmMiniCart']) {
		if(!@$_SESSION['vmShowAttrib']) {
			echo "<hr />\n";
		}
		else {
			echo "<hr style=\"clear: both;\" />\n";
		}
	}
	if( !empty($_SESSION['coupon_discount']) ) {
		$total -= $_SESSION['coupon_discount'];
	}
	echo "<div style=\"float: left;\" >";
	if ($amount > 1) {
		echo $amount ." ". $VM_LANG->_PHPSHOP_PRODUCTS_LBL;
	}
	else {
		echo $amount ." ". $VM_LANG->_PHPSHOP_PRODUCT_LBL;
	}

	echo "</div>";
	$price_align_start = "&nbsp;";
	$price_align_end = '';
	if(!$_SESSION['vmMiniCart'] && @$_SESSION['vmAlignPrice']) {
		$price_align_start = "<div style=\"float: right;\">";
		$price_align_end = "</div>";
	}
	echo $price_align_start.$CURRENCY_DISPLAY->getFullValue( $total ).$price_align_end;
	// Display clear cart
	if(@$_SESSION['vmEnableEmptyCart'] && !$_SESSION['vmMiniCart']) {
		// Output the empty cart button
		echo vmCommonHTML::scriptTag( $mosConfig_live_site.'/components/'.$option.'/js/wz_tooltip.js' );
		$empty_cart = "<a href=\"".$_SERVER['PHP_SELF'] . "?page=shop.cart_reset&option=com_virtuemart&option2=$option&product_id=$prodid&category_id=$catid&return=$page&flypage=$flypage&Itemid=$Itemid\" title=\"". $VM_LANG->_PHPSHOP_EMPTY_YOUR_CART ." \"><img src=\"". $mosConfig_live_site ."/images/cancel_f2.png\" width=\"12\"border=\"0\" style=\"float: right;vertical-align: middle;\"   alt=\"". $VM_LANG->_PHPSHOP_EMPTY_YOUR_CART ." \" />
      </a>"; 
		$html1 = vmToolTip("Clear the cart of all contents", "Empty Cart",'','',$empty_cart,true);
		$empty_cart = $html1;
		echo $empty_cart;
	}
	// Display show cart button
	if ($cart["idx"] != 0 && !$_SESSION['vmMiniCart']) {
		echo '<br/><br style="clear:both" /><div align="center">';

		$href = $sess->url($mm_action_url."index.php?page=shop.cart");
		$href2 = $sess->url($mm_action_url."index2.php?page=shop.cart");
		$text = $VM_LANG->_PHPSHOP_CART_SHOW;
		if( $_SESSION['vmUseGreyBox'] ) {
			echo vmCommonHTML::getGreyboxPopUpLink( $href2, $text, '', $text, '', 500, 600, $href );
		}
		else {
			echo vmCommonHTML::hyperlink( $href, $text, '', $text, '' );
		}
		echo '</div><br/>';
	}
}
?>
