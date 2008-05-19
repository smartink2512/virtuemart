<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
mm_showMyFileName( __FILE__ );

require_once(CLASSPATH . 'payment/paypal_lib/ps_paypal_wpp.functions.php');
require_once(CLASSPATH . 'payment/ps_paypal_wpp.cfg.php');

require_once(CLASSPATH . 'ps_checkout.php');
$checkout = new ps_checkout();

require_once(CLASSPATH . 'ps_product.php');
require_once(CLASSPATH . 'ps_shipping_method.php');
require_once(CLASSPATH . 'ps_payment_method.php');
$ps_payment_method = new ps_payment_method;

$_SESSION['CURL_ERROR'] = false;
$_SESSION['CURL_ERROR_TXT'] = '';

$zone_qty = mosgetparam( $_REQUEST, 'zone_qty');
$ship_to_info_id = mosgetparam( $_REQUEST, 'ship_to_info_id');
$shipping_rate_id = urldecode(mosGetParam( $_REQUEST, 'shipping_rate_id', null ));
$payment_method_id = mosgetparam( $_REQUEST, 'payment_method_id');
$Itemid = mosgetparam( $_REQUEST, 'Itemid', null);
$checkout_next_step = mosgetparam( $_REQUEST, 'checkout_next_step', 2);
$checkout_this_step = mosgetparam( $_REQUEST, 'checkout_this_step', 2);
if( empty($vars["error"])) {
    $checkout_this_step = $checkout_next_step;
}
$auth = $_SESSION['auth'];
$cart = $_SESSION['cart'];
$confirmation = '';
$database = new ps_DB;
global $my;

//*******************************************************
// Send SetExpressCheckoutRequest SOAP to Paypal
// Get Token back
// Redirect to Paypal for payment
//*******************************************************

if(empty($_GET[token])) {
	// First time here (we will call paypal)	

	$ps_product = new ps_product;
	$ps_checkout = new ps_checkout;
		
	global $weight_total, $total, $tax_total, $cart;
		
	if ($cart["idx"] == 0) {
		echo $VM_LANG->_PHPSHOP_EMPTY_CART;
		$checkout = False;
	}else{
		$checkout = True;
		
		$total = 0;
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
			$vars["zone_qty"] += $cart[$i]["quantity"];
			if ($i % 2) {$product_rows[$i]['row_color'] = "sectiontableentry2";}
			else {$product_rows[$i]['row_color'] = "sectiontableentry1";}
			// Get product parent id if exists
			$product_parent_id=$ps_product->get_field($cart[$i]["product_id"],"product_parent_id");
		      
			// Get flypage for this product
			$flypage = $ps_product->get_flypage($cart[$i]["product_id"]);
		      
			// Build URL based on whether item or product
			if ($product_parent_id) {
				$url = $sess->url(URL . "index.php?page=shop.product_details&flypage=$flypage&product_id=$product_parent_id");
			}else{
				$url = $sess->url(URL . "index.php?page=shop.product_details&flypage=$flypage&product_id=" . $_SESSION['cart'][$i]["product_id"]);
			}
			$product_rows[$i]['product_name'] = "<a href=\"$url\"><strong>" 
			. $ps_product->get_field($_SESSION['cart'][$i]["product_id"], "product_name") 
			. "</strong></a><br />"
			. $_SESSION['cart'][$i]["description"];
		      
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
		  
			// Weight calculation
			$weight_subtotal = ps_shipping_method::get_weight($cart[$i]["product_id"]) * $cart[$i]['quantity'];
			$weight_total += $weight_subtotal;
		      
			// Product price calculation
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
		      
		  // Quantity box
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
		        <input type=\"image\" name=\"update\" title=\"". $VM_LANG->_PHPSHOP_CART_UPDATE ."\" src=\"". IMAGEURL ."ps_image/edit_f2.gif\" border=\"0\"  value=\"". $VM_LANG->_PHPSHOP_UPDATE ."\" />
		      </form>";
		      $product_rows[$i]['delete_form'] = "<form action=\"$action_url\" method=\"post\" name=\"delete\" />
		        <input type=\"hidden\" name=\"option\" value=\"com_virtuemart\" />
		        <input type=\"hidden\" name=\"page\" value=\"". $_REQUEST['page'] ."\" />
		        <input type=\"hidden\" name=\"Itemid\" value=\"". @$_REQUEST['Itemid'] ."\" />
		        <input type=\"hidden\" name=\"func\" value=\"cartDelete\" />
		        <input type=\"hidden\" name=\"product_id\" value=\"". $_SESSION['cart'][$i]["product_id"] ."\" />
		        <input type=\"hidden\" name=\"description\" value=\"". $cart[$i]["description"]."\" />
		      <input type=\"image\" name=\"delete\" title=\"". $VM_LANG->_PHPSHOP_CART_DELETE ."\" src=\"". IMAGEURL ."ps_image/delete_f2.gif\" border=\"0\" value=\"". $VM_LANG->_PHPSHOP_CART_DELETE ."\" />
		      </form>";
		  } // End of for loop through the Cart
		  
		  if ($_REQUEST["page"] == "checkout.index" && !empty($_POST["do_coupon"])) {
		    /* process the coupon */
		          
		    /* make sure they arent trying to run it twice */
		    if (@$_SESSION['coupon_redeemed'] == true) { 
		        echo $VM_LANG->_PHPSHOP_COUPON_ALREADY_REDEEMED;
		    }
		    else {
		        require_once( CLASSPATH . "ps_coupon.php" );
		        ps_coupon::process_coupon_code( $vars );
		    }
		  }
		  $total = $total_undiscounted = round($total, 2);
		  $subtotal_display = $CURRENCY_DISPLAY->getFullValue($total);
		  
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
		    $show_tax = true;
		    if ($weight_total != 0 or TAX_VIRTUAL=='1') {
		        $order_taxable = $ps_checkout->calc_order_taxable($vars);
		        $tax_total = $ps_checkout->calc_order_tax($order_taxable, $vars);
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
		      //include (PAGEPATH."templates/basket/basket_b2c.html.php");
		    }
		    else {
		      //include (PAGEPATH."templates/basket/basket_b2b.html.php");
		    }
		    
		    /* Input Field for the Coupon Code */
		    if( PSHOP_COUPONS_ENABLE=='1' && $page == "checkout.index" && !@$_SESSION['coupon_redeemed']) {  
		      //include (PAGEPATH."coupon.coupon_field.php");
		    }
		  }
		}
		
		$order_total = round ($order_total, 2);
		//*********************************************************************************
		// END OF ORDER TOTAL CALC
		//***********************************************************************


	$returnUrl = SECUREURL.'index.php?page=checkout.paypal_wpp_ec&amp;option=com_virtuemart';
	$cancelUrl = SECUREURL.'index.php?page=checkout.paypal_wpp_ec_error&amp;option=com_virtuemart';

	$reqConfirmedShipping = 0;  // Dont require confirmed shipping address
	$noShipping = 0;			// Ask user for shipping at paypal
	if (!empty($auth["user_id"])) {
		$q  = "SELECT * from #__users WHERE ";
		$q .= "id='" . $auth["user_id"] . "' ";
		$q .= "AND address_type='BT'";
		$db->query($q);
		if(!$db->num_rows()) {
		    $q  = "SELECT * from #__{vm}_user_info WHERE ";
		    $q .= "user_id='" . $auth["user_id"] . "' ";
		    $q .= "AND address_type='BT'";
		    $db->query($q);
		}
		$db->next_record();
		if (!$db->f("user_email")) { 
			if (!$db->f("email")) {
				$buyerEmail = 'guest@shopper.com'; 
			} else {
				$buyerEmail = $db->f("email"); 
			}
		} else {
			$buyerEmail = $db->f("user_email");
		}
	} else {
		$buyerEmail = 'guest@shopper.com';
	}
		
	$invoiceID = '';
	$language_code = 'US';
		
	$apiusername = PP_WPP_USERNAME;
	$apipassword = PP_WPP_PASSWORD;
	$apiemail = PP_WPP_EMAIL;
	$apisignature = PP_WPP_SIGNATURE;
	$apiurl = PP_WPP_SANDBOX;
	$ip_address = $_SERVER['REMOTE_ADDR'];
	if ($apiurl == '1'){
       	$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		$apiurl = 'https://api.sandbox.paypal.com/2.0/';  
	}else{
       	$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
		$apiurl = 'https://api-3t.paypal.com/2.0/';  	
	}
	
	// Get SOAP data for SetExpressCheckoutRequest
	$soapData = SOAP_SetExpressCheckoutRequest($apiusername, $apipassword, $apisignature, $apiemail, $order_total, $returnUrl, $cancelUrl, $buyerEmail, $invoiceID, $reqConfirmedShipping, $noShipping, $language_code, $d);
	$response = SendSoap($apiurl, $soapData);
	$arr_vals = xml2php($response);

	$errorOut = TRUE;
	$errorOut2 = FALSE;
	$displayMsg = '';
	foreach ($arr_vals AS $name => $value) {
		if (is_array($value)){
			foreach ($value AS $name2 => $value2) {
				if ($name2 == "tag") $tag_value = $value2;
				if ($name2 == "value") {
					if ($tag_value == "ACK" && ($value2 != "Success" && $value2 != "SuccessWithWarning")) {
						$displayMsg .= 'Error: Paypal could not complete order.<br />';
						$errorOut2 = TRUE;
					} elseif ($tag_value == "ERRORCODE") {
						$displayMsg .= $tag_value . '=' . $value2 . '<br />';
					} elseif ($tag_value == "LONGMESSAGE") {
						$displayMsg .= $tag_value . '=' . $value2 . '<br />';
					} elseif ($tag_value == "TOKEN") {
						$errorOut = FALSE;
						$token = $value2;
					} else {
					}
				}
			}
		}else{
			if ($name == "tag") $tag_value = $value;
			if ($name == "value") {
				if ($tag_value == "ACK" && ($value != "Success" && $value != "SuccessWithWarning")) {
					$displayMsg .= 'Error: Paypal did not complete order<br />';
					$errorOut2 = TRUE;
				}elseif ($tag_value == "ERRORCODE") {
					$displayMsg .= $tag_value . '=' . $value . '<br />';
				}elseif ($tag_value == "LONGMESSAGE") {
					$displayMsg .= $tag_value . '=' . $value . '<br />';
				}elseif ($tag_value == "TOKEN") {
					$errorOut = FALSE;
					$token = $value;
				}else {
				}
			}
		}		
	}

	if ($errorOut || $errorOut2) {
		if ($_SESSION['CURL_ERROR'] == true) { 
			header('Location:'.SECUREURL.'index.php?option=com_virtuemart&page=checkout.paypal_wpp_ec_error&message='.urlencode($displayMsg.'PAYPAL ERROR: '.$_SESSION['CURL_ERROR_TXT']));
		}else{
			header('Location:'.SECUREURL.'index.php?option=com_virtuemart&page=checkout.paypal_wpp_ec_error&message='.urlencode($displayMsg));
		}
	}else{
		if ($_SESSION['CURL_ERROR'] == true) { echo '<br />' . $displayMsg . 'PAYPAL ERROR: ' . $_SESSION['CURL_ERROR_TXT'] . '<br /><br />' . $response; }
		header('Location:'.$paypal_url.'?cmd=_express-checkout&token='.$token.'&login_email='.$buyerEmail);
	}
}else{

	//*******************************************************
	// Already Sent SetExpressCheckoutRequest SOAP to Paypal
	// We should have Gotten Token back - plus it should be in $_GET[token]
	// Send GetExpressCheckoutRequest SOAP to Paypal
	// Get response and output confirmation
	//*******************************************************

	// Obtain the totals

		//*********************************************************************************
		//	CODE TO CALCULATE ORDER_TOTAL
		//*********************************************************************************
		$ps_product = new ps_product;
		$ps_checkout = new ps_checkout;
		
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
		      if ($product_parent_id)
		         $url = $sess->url(URL . "index.php?page=shop.product_details&flypage=$flypage&product_id=$product_parent_id");
		      else
		         $url = $sess->url(URL . "index.php?page=shop.product_details&flypage=$flypage&product_id=" . $_SESSION['cart'][$i]["product_id"]);
		      
		      $product_rows[$i]['product_name'] = "<a href=\"$url\"><strong>" 
		        . $ps_product->get_field($_SESSION['cart'][$i]["product_id"], "product_name") 
		        . "</strong></a><br />"
		        .$_SESSION['cart'][$i]["description"];
		      
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
		        <input type=\"image\" name=\"update\" title=\"". $VM_LANG->_PHPSHOP_CART_UPDATE ."\" src=\"". IMAGEURL ."ps_image/edit_f2.gif\" border=\"0\"  value=\"". $VM_LANG->_PHPSHOP_UPDATE ."\" />
		      </form>";
		      $product_rows[$i]['delete_form'] = "<form action=\"$action_url\" method=\"post\" name=\"delete\" />
		        <input type=\"hidden\" name=\"option\" value=\"com_virtuemart\" />
		        <input type=\"hidden\" name=\"page\" value=\"". $_REQUEST['page'] ."\" />
		        <input type=\"hidden\" name=\"Itemid\" value=\"". @$_REQUEST['Itemid'] ."\" />
		        <input type=\"hidden\" name=\"func\" value=\"cartDelete\" />
		        <input type=\"hidden\" name=\"product_id\" value=\"". $_SESSION['cart'][$i]["product_id"] ."\" />
		        <input type=\"hidden\" name=\"description\" value=\"". $cart[$i]["description"]."\" />
		      <input type=\"image\" name=\"delete\" title=\"". $VM_LANG->_PHPSHOP_CART_DELETE ."\" src=\"". IMAGEURL ."ps_image/delete_f2.gif\" border=\"0\" value=\"". $VM_LANG->_PHPSHOP_CART_DELETE ."\" />
		      </form>";
		  } // End of for loop through the Cart
		  
		  if ($_REQUEST["page"] == "checkout.index" && !empty($_POST["do_coupon"])) {
		    /* process the coupon */
		          
		    /* make sure they arent trying to run it twice */
		    if (@$_SESSION['coupon_redeemed'] == true) { 
		        echo $VM_LANG->_PHPSHOP_COUPON_ALREADY_REDEEMED;
		    }
		    else {
		        require_once( CLASSPATH . "ps_coupon.php" );
		        ps_coupon::process_coupon_code( $vars );
		    }
		  }
		  $total = $total_undiscounted = round($total, 2);
		  $subtotal_display = $CURRENCY_DISPLAY->getFullValue($total);
		  
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
		    $show_tax = true;
		    if ($weight_total != 0 or TAX_VIRTUAL=='1') {
		        $order_taxable = $ps_checkout->calc_order_taxable($vars);
		        $tax_total = $ps_checkout->calc_order_tax($order_taxable, $vars);
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
		      //include (PAGEPATH."templates/basket/basket_b2c.html.php");
		    }
		    else {
		      //include (PAGEPATH."templates/basket/basket_b2b.html.php");
		    }
		    
		    /* Input Field for the Coupon Code */
		    if( PSHOP_COUPONS_ENABLE=='1' && $page == "checkout.index" && !@$_SESSION['coupon_redeemed']) {  
		      //include (PAGEPATH."coupon.coupon_field.php");
		    }
		  }
		}
		
		$order_total = round ($order_total, 2);
		//*********************************************************************************
		// END OF ORDER TOTAL CALC
		//***********************************************************************

	// Coming back from PAYPAL site - time to get GetExpressCheckoutDetailsRequestType
	$token = $_REQUEST['token'];

	$apiusername = PP_WPP_USERNAME;
	$apipassword = PP_WPP_PASSWORD;
	$apiemail = PP_WPP_EMAIL;
	$apisignature = PP_WPP_SIGNATURE;
	$apiurl = PP_WPP_SANDBOX;
	if ($apiurl == '1'){
		$apiurl = 'https://api.sandbox.paypal.com/2.0/';  
	} else {
		$apiurl = 'https://api-3t.paypal.com/nvp/';  	
	}

	// Get SOAP for GetExpressCheckoutDetailsRequest
	$soapData = SOAP_GetExpressCheckoutDetailsRequest($apiusername, $apipassword, $apisignature, $apiemail, $token);
	$response = SendSoap($apiurl, $soapData);
	$arr_vals = xml2php($response);
		
	// Parse out all the data and store in database
	$errorOut = TRUE;
	$errorOut2 = FALSE;
	$order_array = array("email" => '', "payer_id" => '', "first_name" => '', "last_name" => '', "phone_1" => '', "company" => '', "name" => '', "address_1" => '', "address_2" => '', "city" => '', "state" => '', "country" => '', "zip" => '');

	$displayMsg = '';
	foreach ($arr_vals AS $array_list) {
		foreach ($array_list AS $name => $value) {
			if (is_array($value)){
				foreach ($value AS $name2 => $value2) {
					if ($name2 == "tag") $tag_value = $value2;
					if ($name2 == "value") {
						if ($tag_value == "ACK" && ($value2 != "Success" && $value2 != "SuccessWithWarning")) {
							$displayMsg .= 'Error: Paypal could not complete your order.<br />';
							$errorOut2 = TRUE;
						} elseif ($tag_value == "ERRORCODE") {
							$displayMsg .= $tag_value . '=' . $value2 . '<br />';
						} elseif ($tag_value == "LONGMESSAGE") {
							$displayMsg .= $tag_value . '=' . $value2 . '<br />';
						} elseif ($tag_value == "PAYERID") {
							$errorOut = FALSE;
							$paypal_payer_id = $value2;
							$order_array = buildOrderArray($tag_value, $value2, $userExists, $user_name, "ec", $entry_page, $order_array);
						} else {
							$order_array = buildOrderArray($tag_value, $value2, $userExists, $user_name, "ec", $entry_page, $order_array);
						}
					}
				}
			} else {
				if ($name == "tag") $tag_value = $value;
				if ($name == "value") {
					if ($tag_value == "ACK" && ($value != "Success" && $value != "SuccessWithWarning")) {
						$displayMsg .= 'Error: Paypal could not complete your order.<br />';
						$errorOut2 = TRUE;
					} elseif ($tag_value == "ERRORCODE") {
						$displayMsg .= $tag_value . '=' . $value . " -- ";
					} elseif ($tag_value == "LONGMESSAGE") {
						$displayMsg .= $tag_value . '=' . $value . " -- ";
					} elseif ($tag_value == "PAYERID") {
						$errorOut = FALSE;
						$paypal_payer_id = $value;
						$order_array = buildOrderArray($tag_value, $value, $userExists, $user_name, "ec", $entry_page, $order_array);
					} else {
						$order_array = buildOrderArray($tag_value, $value, $userExists, $user_name, "ec", $entry_page, $order_array);
					}
				}
			}		
		}
	}

	if ($errorOut || $errorOut2) {
		if ($_SESSION['CURL_ERROR'] == true) { 
			header('Location:'.SECUREURL.'index.php?option=com_virtuemart&page=checkout.paypal_wpp_ec_error&message='.urlencode($displayMsg.'PAYPAL ERROR: '.$_SESSION['CURL_ERROR_TXT']));
		} else {
			header('Location:'.SECUREURL.'index.php?option=com_virtuemart&page=checkout.paypal_wpp_ec_error&message='.urlencode($displayMsg));
		}
	} else {
		if ($_SESSION['CURL_ERROR'] == true) { 
			echo '<br />'.$displayMsg.'PAYPAL ERROR: '.$_SESSION['CURL_ERROR_TXT'].'<br /><br />'.$response;
		}
	}
 
	$order_detail_array = $order_array["order"];
	$shipping_array = $order_array["address"];

	$confirmation =	'First Name: '.$order_detail_array['first_name'].'<br />' .
					'Last Name: '.$order_detail_array['last_name'].'<br />' .
					'Order Total: '.$order_total.'<br />' .
					'Paypal Account: '.$order_detail_array['email'].'<br />';

	$process_button_string =	'<input type="hidden" name="token" value="'.$token.'">' .
								'<input type="hidden" name="order_total" value="'.$order_total.'">' .
								'<input type="hidden" name="item_total" value="'.$item_total.'">' .
	   							'<input type="hidden" name="tax_total" value="'.$tax_total.'">' .
	   							'<input type="hidden" name="shipping_total" value="'.$ship_total.'">' .
	   							'<input type="hidden" name="shipping_tax" value="'.$order_detail['shipping_tax'].'">' .
	   							'<input type="hidden" name="payment_discount" value="'.$order_detail['payment_discount'].'">' .
	   							'<input type="hidden" name="coupon_discount" value="'.$order_detail['coupon_discount'].'">' .
					            '<input type="hidden" name="ship_to_info_id" value="'.$ship_to_info_id.'">' .
					            '<input type="hidden" name="shipping_rate_id" value="'.urlencode($shipping_rate_id).'">' .
					            '<input type="hidden" name="payment_method_id" value="'.$payment_method_id.'">';

	   if (!empty($order_detail_array)) {
		   foreach ($order_detail_array AS $name => $value) {
			   $process_button_string .= '<input type="hidden" name="'.$name.'" value="'.$value.'">';
		   }
	   }
	   if (!empty($shipping_array)) {
		   foreach ($shipping_array AS $name => $value) {
			   $process_button_string .= '<input type="hidden" name="'.$name.'" value="'.$value.'">';
		   }
	   }
	  
	   if (empty($shipping_rate_id) && !$my->id){
	   		saveRegistration($order_detail, $order_detail_array, $shipping_array);
	   }
}
	
// ***********************************

echo '<h3>'.$VM_LANG->_PHPSHOP_CHECKOUT_TITLE.'</h3><br />';

// *********************
// CART
if(empty($_REQUEST['token'])) {
	echo '<h4>Connecting to Paypal...</h4>';
} else {
	$token = $_REQUEST['token'];
	require_once(PAGEPATH . 'ro_basket.php');
	ob_start();
	if (empty($shipping_rate_id) || !empty($_POST[doagain])){
		echo '<h4>Please wait while we calculate your shipping options...</h4>';
	}elseif( $auth['show_price_including_tax'] == 1) {
		include (VM_THEMEPATH.'templates/basket/ro_basket_b2c.html.php');
	}
	else {
		include (VM_THEMEPATH.'templates/basket/ro_basket_b2b.html.php');
	}
	$basket_html = ob_get_contents();
	ob_end_clean();

//*********************
// SHIPPING METHOD
			echo '<form name="shipmethod" method="POST" enctype="multipart/form-data" action="' . SECUREURL . 'index.php?option=com_virtuemart&page=checkout.paypal_wpp_ec&token='.$token.'">';
            if( empty( $ship_to_info_id )) {
                // Get the Bill to user_info_id
                $database->setQuery( "SELECT user_info_id FROM #__{vm}_user_info WHERE user_id='".$my->id."'" );
                $vars["ship_to_info_id"] = $ship_to_info_id = $database->loadResult();
            }
            $vars["weight"] = $weight_total;
            $i = 0;
            foreach( $PSHOP_SHIPPING_MODULES as $shipping_module ) {
                include_once(CLASSPATH . 'shipping/'.$shipping_module.'.php');
                eval("\$SHIPPING = new ".$shipping_module."();");
                $SHIPPING->list_rates( $vars );
                echo '<br /><hr />';
            }
			if (empty($shipping_rate_id)){
				echo '<input type="hidden" name="doagain" value="1">';
			}
			echo '<input type="submit" value=" Recalculate Shipping "></form><br /><hr />';
			if (empty($shipping_rate_id) || !empty($_POST[doagain])){
				echo '<script language="JavaScript">document.shipmethod.submit();</script>';
			}
			
//*********************
//COUPON
	if( PSHOP_COUPONS_ENABLE=='1' && !@$_SESSION['coupon_redeemed']) {  

		if (@$_SESSION['invalid_coupon'] == true) { 
		  echo '<strong>'.$VM_LANG->_PHPSHOP_COUPON_CODE_INVALID.'</strong><br/>'; 
		}
		if( !empty($_REQUEST['coupon_error']) ) {
		 echo $_REQUEST['coupon_error'].'<br />';
		}
		echo $VM_LANG->_PHPSHOP_COUPON_ENTER_HERE . '<br/>
		    <form action="'.SECUREURL.'index.php?option=com_virtuemart&page=checkout.paypal_wpp_ec&token='.$token.'" method="post">
				<input type="text" name="coupon_code" width="10" maxlength="30" />
				<input type="hidden" name="Itemid" value="'.@$_REQUEST['Itemid'].'" />
				<input type="hidden" name="shipping_rate_id" value="'.$shipping_rate_id.'" /> 
				<input type="hidden" name="do_coupon" value="yes" /><br />
				<input type="submit" value=" Apply Coupon " />
				</form><br/><hr/>';

    }
//*********************
//CONFIRMATION	
	
	if (!empty($shipping_rate_id)){
		if ($confirmation != '') {
			echo '<b>Confirm Details:</b><br />' . $confirmation;
		}
		echo '<form method="post" enctype="multipart/form-data" action="'.SECUREURL.'index.php?option=com_virtuemart&page=checkout.paypal_wpp_ec_success">';
		if ($process_button_string != '') {
			echo ($process_button_string);
		}
                ?>
                <br /><div>
                <?php echo $VM_LANG->_PHPSHOP_CHECKOUT_CUSTOMER_NOTE ?>:<br />
                <textarea title="<?php echo $VM_LANG->_PHPSHOP_CHECKOUT_CUSTOMER_NOTE ?>" cols="50" rows="5" name="customer_note"></textarea>
                <br />
                <?php
                if (PSHOP_AGREE_TO_TOS_ONORDER == '1') { ?>
                    <br />
                  <input type="checkbox" name="agreed" value="1" class="inputbox" />&nbsp;&nbsp;
                  <script type="text/javascript">
                    document.write('<a href="javascript:void window.open(\'<?php echo $mosConfig_live_site ?>/index2.php?option=com_virtuemart&page=shop.tos&pop=1&Itemid=<?php echo $_REQUEST['Itemid'] ?>\', \'win2\', \'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no\');">');
                    </script>
                    <noscript><a target="_blank" href="<?php echo $mosConfig_live_site ?>/index.php?option=com_virtuemart&page=shop.tos&Itemid=<?php echo $_REQUEST['Itemid'] ?>" title="<?php echo $VM_LANG->_PHPSHOP_I_AGREE_TO_TOS ?>"></noscript>
                    &nbsp;
                  <?php
                    echo $VM_LANG->_PHPSHOP_I_AGREE_TO_TOS.'</a><br />';
                }
                ?>
                </div>
				<br /><input type="submit" name="submit" value=" Process Payment "></form><br /><hr/>
				<?php
	}

}
?>