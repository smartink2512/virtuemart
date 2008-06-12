<?php

function xml2php($data) {
	// Turns XML tags into the PHP Array, $arr_vals
	$xml_parser = xml_parser_create();
	xml_parse_into_struct($xml_parser, $data, $arr_vals);
	xml_parser_free($xml_parser);

	return $arr_vals;
}

function SendSoap($url, $api_data) {
	global $VM_LANG, $_SESSION;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $api_data);

	if( stristr( $api_data, '<Signature>' ) === FALSE ) {
		// Use certificate
		curl_setopt($ch, CURLOPT_SSLCERTTYPE, "PEM"); 
		curl_setopt($ch, CURLOPT_SSLCERT, '/opt/lampp/htdocs/vm/vm110/j153/cert_key_pem.txt');
	}

	$temp = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$returnData = curl_exec ($ch);
    $error = curl_error( $ch );
    if( !empty( $error )) {
		echo "<br/><span class=\"message\">".$VM_LANG->_PHPSHOP_PAYMENT_INTERNAL_ERROR." PayPal CURL error: ".$error."</span>";
		curl_close ($ch);
		$_SESSION['CURL_ERROR'] = true;
		$_SESSION['CURL_ERROR_TXT'] = $error;
		return $returnData;
    }
	curl_close ($ch);
	return $returnData;
}

function buildOrderArray($tagName, $value, $userExists, $user_name, $payMethod, $entry_page, $order_array) {
	$fieldName = "";
	switch($tagName)
	{
		case "PAYER":
			$fieldName = "email";
			$database = "order_detail";
			break;
		case "PAYERID":
			$fieldName = "payer_id";
			$database = "order_detail";
			break;
		case "FIRSTNAME":
			$fieldName = "first_name";
			$database = "order_detail";
			break;
		case "LASTNAME":
			$fieldName = "last_name";
			$database = "order_detail";
			break;
		case "CONTACTPHONE":
			$fieldName = "phone_1";
			$database = "order_detail";
			break;
		case "PAYERBUSINESS":
			$fieldName = "company";
			$database = "order_detail";
			break;
		case "NAME":
			$fieldName = "name";
			$database = "address";
			break;
		case "STREET1":
			$fieldName = "address_1";
			$database = "address";
			break;
		case "STREET2":
			$fieldName = "address_2";
			$database = "address";
			break;
		case "CITYNAME":
			$fieldName = "city";
			$database = "address";
			break;
		case "STATEORPROVINCE":
			$fieldName = "state";
			$database = "address";
			break;
		case "COUNTRY":
			$fieldName = "country";
			$database = "address";
			break;
		case "POSTALCODE":
			$fieldName = "zip";
			$database = "address";
			break;

		default:
			return $order_array;
			break;
	}


	if ($database == "address") {
		$order_array["address"][$fieldName] = $value;
	} elseif ($database == "order_detail") {
		$order_array["order"][$fieldName] = $value;
	}

	return $order_array;
}

function Get_Order_Details( &$d ){
	global $VM_LANG, $CURRENCY_DISPLAY, $weight_total, $total, $tax_total, $shipping_rate_id;

	require_once(CLASSPATH. 'ps_product.php' );
	$ps_product = new ps_product;
	
	require_once(CLASSPATH. 'ps_checkout.php' );
	$ps_checkout = new ps_checkout;
	
	require_once(CLASSPATH . 'ps_shipping_method.php' );
	
	$auth = $_SESSION['auth'];
	$cart = $_SESSION['cart'];

	$checkout = True;
	$payment_method_id = mosGetParam( $_REQUEST, "payment_method_id" );
	$total = 0;
	
  // Added for the zone shipping module
  $vars["zone_qty"] = 0;
  $weight_total = 0;
  $weight_subtotal = 0;
  $tax_total = 0;
  $shipping_total = $shipping_tax = 0;
  $order_total = 0;
  $coupon_discount = mosGetParam( $_SESSION, 'coupon_discount', 0 );
  $coupon_discount_before=$coupon_discount_after=$payment_discount_before=$payment_discount_after=$tax=$shipping=false;
  $product_rows = Array();
  $subtotal = 0;
  $tax_subtotal = 0;
  $running_tax=0;

  for ($i=0;$i<$cart["idx"];$i++) {
      // Added for the zone shipping module
      $vars["zone_qty"] += $cart[$i]["quantity"];

  // Product PRICE
      $my_taxrate = $ps_product->get_product_taxrate($cart[$i]["product_id"], $weight_subtotal);
      $tax = $my_taxrate * 100;

      $price = $ps_product->get_adjusted_attribute_price($cart[$i]["product_id"], $cart[$i]["description"]);
      $running_tax = $price["product_price"] * $my_taxrate;
      $product_price = $price["product_price"] * ($my_taxrate+1);

      $product_price = round( $product_price, 2 );
	  $running_tax = round( $running_tax, 2 );

  /* WEIGHT CALCULATION */
      $weight_subtotal = ps_shipping_method::get_weight($cart[$i]["product_id"]) * $cart[$i]['quantity'];
      $weight_total += $weight_subtotal;

  /* SUBTOTAL CALCULATION */
      $subtotal = $product_price * $cart[$i]["quantity"];
      $tax_subtotal += ($running_tax * $cart[$i]["quantity"]);

      $total += $subtotal;
  } // End of for loop through the Cart
  $total = $total_undiscounted = round($total, 2);
  $tax_subtotal = round ($tax_subtotal, 2);

  /* DISCOUNT BEFORE TAX*/
  $payment_discount = $ps_checkout->get_payment_discount($payment_method_id, $total);
  if ( PAYMENT_DISCOUNT_BEFORE == '1') {
    if( $payment_discount != 0.00 ) {
      $payment_discount_before = true;
      $total -= $payment_discount;
    }
    /* COUPON DISCOUNT */
    if( PSHOP_COUPONS_ENABLE=='1' && @$_SESSION['coupon_redeemed']==true ) {
      $total -= $_SESSION['coupon_discount'];
      $coupon_discount_before = true;
    }
  }

  /* SHOW SHIPPING COSTS */
    $shipping = true;
    $vars["weight"] = $weight_total;
    $shipping_total = round( $ps_checkout->calc_order_shipping ( $vars ), 2 );
    $shipping_taxrate = $ps_checkout->_SHIPPING->get_tax_rate();

    $shipping_tax = round( $shipping_total * $shipping_taxrate, 2);

  /* SHOW TAX */
  if (!empty($_REQUEST['ship_to_info_id']) || $auth["show_price_including_tax"] == 1) {
    $tax = true;

    $payment_discount_untaxed = $payment_discount;
    $coupon_discount_untaxed = $coupon_discount;

    if ($weight_total != 0 or TAX_VIRTUAL=='1') {
        $order_taxable = $ps_checkout->calc_order_taxable($vars);
        $tax_total = $ps_checkout->calc_order_tax($order_taxable-$payment_discount_untaxed-$coupon_discount_untaxed, $vars);
    } else {
        $tax_total = 0;
    }
	$tax_total_ns = round( $tax_total, 2 );
    $tax_total += $shipping_tax;
    $tax_total = round( $tax_total, 2 );
  }

  if ( PAYMENT_DISCOUNT_BEFORE != '1') {
    if( $payment_discount != 0.00 ) {
      $payment_discount_after = true;
      $total -= $payment_discount;
    }
    /* COUPON DISCOUNT */
    if( PSHOP_COUPONS_ENABLE=='1' && @$_SESSION['coupon_redeemed']==true ) {
      $total -= $_SESSION['coupon_discount'];
      $coupon_discount_after = true;
    }
  }
  $subtotal = round( $total - $tax_total_ns, 2 );
  $order_total = $shipping_total + $subtotal + $tax_total;
  $order_total =  round( $order_total, 2 );

  $order_detail['subtotal'] = $subtotal;
  $order_detail['tax'] = $tax_total;
  $order_detail['shipping'] =  $shipping_total;
  $order_detail['total'] = $order_total;

  return $order_detail;
}

function SOAP_SetExpressCheckoutRequest($username, $password, $signature, $accountEmail, $order_total, $returnUrl, $cancelUrl, $buyerEmail, $invoiceID="", $reqConfirmedShipping=0, $noShipping=0, $language_code,  &$d ){
	global $vendor_mail, $vendor_currency, $VM_LANG, $database, $mainframe;

	// Get checkout functions
	require_once( CLASSPATH . "ps_checkout.php" );
	$checkout =& new ps_checkout();
	//Get_Order_Details($d);
	$subject = '';
	$currency_type =  $vendor_currency;

/*	// Obtain the totals
	$totals = $checkout->calc_order_totals($d);
	$order_detail['subtotal'] = $totals['order_subtotal'];
	$order_detail['tax'] = $totals['order_tax'];
	$order_detail['shipping'] =  $totals['order_shipping'];
	$order_total = $order_detail['total'] = $totals['order_total'];
	$order_detail['shipping_tax'] = $totals['order_shipping_tax'];
	$order_detail['payment_discount'] = $totals['payment_discount'];
	$order_detail['coupon_discount'] = $totals['coupon_discount'];
*/
	//$item_total = round($order_detail['subtotal'], 2);
	//$ship_total = round($order_detail['shipping'], 2);
	//$tax_total = round($order_detail['tax'], 2);
	//$order_total = round($order_detail['total'], 2);

	$setExpressCheckoutRequest = <<<END
	<?xml version="1.0" encoding="UTF-8"?>
	<SOAP-ENV:Envelope
		xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/"
		xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
		xmlns:xsd="http://www.w3.org/2001/XMLSchema"
		SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
		<SOAP-ENV:Header>
			<RequesterCredentials xmlns="urn:ebay:api:PayPalAPI" SOAP-ENV:mustUnderstand="1">
				<Credentials xmlns="urn:ebay:apis:eBLBaseComponents">
					<Username>$username</Username>
					<Password>$password</Password>
					<Signature>$signature</Signature>
					<Subject/>
				</Credentials>
			</RequesterCredentials>
		</SOAP-ENV:Header>
		<SOAP-ENV:Body>
			<SetExpressCheckoutReq xmlns="urn:ebay:api:PayPalAPI">
				<SetExpressCheckoutRequest>
					<Version xmlns="urn:ebay:apis:eBLBaseComponents">1.0</Version>
					<SetExpressCheckoutRequestDetails xmlns="urn:ebay:apis:eBLBaseComponents">
						<OrderTotal currencyID="$currency_type" xsl:type="cc:BasicAmountType">$order_total</OrderTotal>
						<MaxAmount>10000.00</MaxAmount>
						<OrderDescription>Online Payment</OrderDescription>
						<ReturnURL>$returnUrl</ReturnURL>
						<CancelURL>$cancelUrl</CancelURL>
						<BuyerEmail>$buyerEmail</BuyerEmail>
						<InvoiceID>$invoiceID</InvoiceID>
						<ReqConfirmShipping>$reqConfirmedShipping</ReqConfirmShipping>
						<NoShipping>$noShipping</NoShipping>
						<LocaleCode>$language_code</LocaleCode>
					</SetExpressCheckoutRequestDetails>
				</SetExpressCheckoutRequest>
			</SetExpressCheckoutReq>
		</SOAP-ENV:Body>
	</SOAP-ENV:Envelope>
END;

	return $setExpressCheckoutRequest;
}

function SOAP_GetExpressCheckoutDetailsRequest($username, $password, $signature, $accountEmail, $token){
	$getExpressCheckoutDetailsRequest = <<<END
	<?xml version="1.0" encoding="UTF-8"?>
	<SOAP-ENV:Envelope
		xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/"
		xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
		xmlns:xsd="http://www.w3.org/2001/XMLSchema"
		SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
		<SOAP-ENV:Header>
			<RequesterCredentials xmlns="urn:ebay:api:PayPalAPI"
	SOAP-ENV:mustUnderstand="1">
				<Credentials xmlns="urn:ebay:apis:eBLBaseComponents">
					<Username>$username</Username>
					<Password>$password</Password>
					<Signature>$signature</Signature>
					<Subject/>
				</Credentials>
			</RequesterCredentials>
		</SOAP-ENV:Header>
		<SOAP-ENV:Body>
			<GetExpressCheckoutDetailsReq xmlns="urn:ebay:api:PayPalAPI">
				<GetExpressCheckoutDetailsRequest>
	        <Version xmlns="urn:ebay:apis:eBLBaseComponents">1.0</Version>
	        <Token>$token</Token>
	      </GetExpressCheckoutDetailsRequest>
	    </GetExpressCheckoutDetailsReq>
		</SOAP-ENV:Body>
	</SOAP-ENV:Envelope>
END;

	return $getExpressCheckoutDetailsRequest;
}

function SOAP_DoExpressCheckoutPaymentRequest($username, $password, $signature, $accountEmail, $d, $payment_action){

	$cart = $_SESSION['cart'];
	require_once(CLASSPATH. 'ps_product.php' );
	$ps_product =& new ps_product;

	require_once( CLASSPATH . "ps_checkout.php" );
	$checkout =& new ps_checkout();
	$subject = '';
	$token = $_REQUEST['token'];
	$order_total = $_REQUEST['order_total'];
	$currency_type =  "USD";
/*	  
	// Obtain the totals
	$totals = $checkout->calc_order_totals($d);
	$order_detail['subtotal'] = $totals['order_subtotal'];
	$order_detail['tax'] = $totals['order_tax'];
	$order_detail['shipping'] =  $totals['order_shipping'];
	$order_total = $order_detail['total'] = $totals['order_total'];
	$order_detail['shipping_tax'] = $totals['order_shipping_tax'];
	$order_detail['payment_discount'] = $totals['payment_discount'];
	$order_detail['coupon_discount'] = $totals['coupon_discount'];

	$item_total = round($order_detail['subtotal'], 2);
	$ship_total = round($order_detail['shipping'], 2);
	$tax_total = round($order_detail['tax'], 2);
	$order_total = round($order_detail['total'], 2);
*/
	$ship_name = $d['first_name'].' '.$d['last_name'];
	$ship_street1 = $d['address_1'];
	$ship_street2 = $d['address_2'];
	$ship_city = $d['city'];
	$ship_state = $d['state'];
	$ship_zip = $d['zip'];
	$ship_country = $d['country'];

	$payer_id = $d['payer_id'];

	//BUILD SOAP
	$doExpressCheckoutPaymentRequest = <<<END
	<?xml version="1.0" encoding="UTF-8" ?>
	<SOAP-ENV:Envelope
		xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/"
		xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
		xmlns:xsd="http://www.w3.org/2001/XMLSchema"
		SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
		<SOAP-ENV:Header>
			<RequesterCredentials xmlns="urn:ebay:api:PayPalAPI"
	SOAP-ENV:mustUnderstand="1">
				<Credentials xmlns="urn:ebay:apis:eBLBaseComponents">
					<Username>$username</Username>
					<Password>$password</Password>
					<Signature>$signature</Signature>
					<Subject/>
				</Credentials>
			</RequesterCredentials>
		</SOAP-ENV:Header>
		<SOAP-ENV:Body>
	
	
	<DoExpressCheckoutPaymentReq xmlns="urn:ebay:api:PayPalAPI">
				<DoExpressCheckoutPaymentRequest>
					<Version xmlns="urn:ebay:apis:eBLBaseComponents">1.0</Version>
			           <DoExpressCheckoutPaymentRequestDetails xmlns="urn:ebay:apis:eBLBaseComponents">
	
	    <PaymentAction>$payment_action</PaymentAction>
	    <Token>$token</Token>
	    <PayerID>$payer_id</PayerID>
	    <PaymentDetails>
			<OrderTotal currencyID="$currency_type">$order_total</OrderTotal>
			<ShippingTotal currencyID="$currency_type">$ship_total</ShippingTotal>
			<TaxTotal currencyID="$currency_type">$tax_total</TaxTotal>
			<ItemTotal currencyID="$currency_type">$item_total</ItemTotal>
			<OrderDescription>$subject</OrderDescription>
END;

	 $db = new ps_DB;
     for($i = 0; $i < $cart["idx"]; $i++) {
      
        $r = "SELECT product_in_stock,product_sales,product_id,product_sku,product_name ";
        $r .= "FROM #__{vm}_product WHERE product_id='".$cart[$i]["product_id"]."'";
        $db->query($r);
        $db->next_record();
      
        $product_price_arr = $ps_product->get_adjusted_attribute_price($cart[$i]["product_id"], $cart[$i]["description"]);
        $product_price = round( $product_price_arr["product_price"],2);
        $my_taxrate = $ps_product->get_product_taxrate($cart[$i]["product_id"] );
        $product_tax = round( ($product_price * $my_taxrate), 2 );
        $product_currency = $product_price_arr["product_currency"];
		$product_name = $db->f("product_name");
		$product_number = $db->f("product_sku");
		$product_quantity = $cart[$i]["quantity"];
		$doExpressCheckoutPaymentRequest .= <<<END
			<PaymentDetailsItem>
			  <Name>$product_name</Name>
			  <Number>$product_number</Number>
			  <Quantity>$product_quantity</Quantity>
			  <Amount currencyID="$product_currency">$product_price</Amount>
			</PaymentDetailsItem>
END;
	  }

	$doExpressCheckoutPaymentRequest .= <<<END
		</PaymentDetails>
	
	  </DoExpressCheckoutPaymentRequestDetails>
	</DoExpressCheckoutPaymentRequest>
	</DoExpressCheckoutPaymentReq>
	
		</SOAP-ENV:Body>
	</SOAP-ENV:Envelope>

END;

	return $doExpressCheckoutPaymentRequest;
}

function SOAP_DoDirectPaymentRequest($username, $password, $signature, $certificate, $accountEmail, &$d, $dbbt, $dbst, $order_array, $REMOTE_ADDR, $payment_action){
	global $vendor_mail, $vendor_currency, $VM_LANG, $database;
	require_once( CLASSPATH . "ps_checkout.php" );
	$checkout =& new ps_checkout();

	$cc_first_digit = substr($_SESSION['ccdata']['order_payment_number'], 0, 1);
	$cc_first_2_digits = substr($_SESSION['ccdata']['order_payment_number'], 0, 2);

		// Figure out the card type.
		switch ($cc_first_digit) {
		 case "4" : $cc_type = "Visa";
					break;
		 case "5" : $cc_type = "MasterCard";
					break;
		 case "3" :
		 	switch ($cc_first_2_digits) {
				case "34" : $cc_type = "Amex";
							break;
				case "37" : $cc_type = "Amex";
							break;
				case "30" : $cc_type = "Discover";
							break;
				case "36" : $cc_type = "Discover";
							break;
				case "38" : $cc_type = "Discover";
							break;
				default : echo ("There was a problem getting the credit card number."); exit;
							break;
			}
			break;
		 case "6" : $cc_type = "Discover";
			break;
		 default : echo ("There was a problem getting the credit card number."); exit;
					break;
		}

	$cc_number = $_SESSION['ccdata']['order_payment_number'];
	$cc_cvv2 = $_SESSION['ccdata']['credit_card_code'];
	$cc_expires_month = $_SESSION['ccdata']['order_payment_expire_month'];
	$cc_expires_year = $_SESSION['ccdata']['order_payment_expire_year'];
	$cc_owner = $_SESSION['ccdata']['order_payment_name'];

	$subject = '';
	$invoiceID = substr($order_number, 0, 20);
	$payer = $dbbt->f("email");
	$first_name = substr($dbst->f("first_name"), 0, 50);
	$last_name = substr($dbst->f("last_name"), 0, 50);
	$currency_type = "USD";
    $order_total = number_format( $order_array['amount'], 2, '.', '' );
    $tax_total = ( $d['tax_total'] == 0 ) ? '0.00' : round($d['tax_total'], 2);
	$shipping = round($d['shipping_total'],2);
	$shipping_tax = round($d['shipping_tax'],2);
    $ship_total = $shipping + $shipping_tax;
    $item_total = number_format( round($order_total - ($tax_total+$ship_total), 2), 2, '.', '' );


    $db_new = new ps_DB;
    $query_str = "SELECT * FROM #__{vm}_country WHERE country_3_code='" . substr($dbbt->f("country"), 0, 60) . "'";
    $db_new->setQuery($query_str);
    $db_new->query();
    $db_new->next_record();

	$address_street1 = substr($dbbt->f("address_1"), 0, 60);
	$address_city = substr($dbbt->f("city"), 0, 40);
	$address_state = substr($dbbt->f("state"), 0, 40);
	$address_country = $db_new->f("country_2_code");
	$address_zip = substr($dbbt->f("zip"), 0, 20);

    $query_str = "SELECT * FROM #__{vm}_country WHERE country_3_code='" . substr($dbst->f("country"), 0, 60) . "'";
    $db_new->setQuery($query_str);
    $db_new->query();
    $db_new->next_record();

	$ship_name = substr($dbst->f("first_name"), 0, 50).' '.substr($dbst->f("last_name"), 0, 50);
	$ship_street1 = substr($dbst->f("address_1"), 0, 60);
	$ship_street2 = substr($dbst->f("address_2"), 0, 60);
	$ship_city = substr($dbst->f("city"), 0, 40);
	$ship_state = substr($dbst->f("state"), 0, 40);
	$ship_country = $db_new->f("country_2_code");
	$ship_zip = substr($dbst->f("zip"), 0, 20);
	$no_shipping = false;
	if ( (!empty($ship_street1)) && ($ship_street1 != "") ) {
		$no_shipping = true;
 	}
 	
 	// Use the certificate method?
 	$use_certificate = false;
 	if( !empty( $certificate ) && empty( $signature ) ) {
 		if ( file_exists( $certificate ) ) {
 			$use_certificate = true;
 		}
 	}

	//BUILD SOAP
	$doDirectPaymentRequest = <<<END
	<?xml version="1.0" encoding="UTF-8" ?>
	<SOAP-ENV:Envelope
		xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/"
		xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
		xmlns:xsd="http://www.w3.org/2001/XMLSchema"
		SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
		<SOAP-ENV:Header>
			<RequesterCredentials xmlns="urn:ebay:api:PayPalAPI"
	SOAP-ENV:mustUnderstand="1">
				<Credentials xmlns="urn:ebay:apis:eBLBaseComponents">
					<Username>$username</Username>
					<Password>$password</Password>
END;

	// If not using the certificate method, add the signature
	if( !$use_certificate ) {
		$doDirectPaymentRequest .= "\t\t\t\t\t<Signature>$signature</Signature>";
	}

	$doDirectPaymentRequest .= <<<END
					<Subject/>
				</Credentials>
			</RequesterCredentials>
		</SOAP-ENV:Header>
		<SOAP-ENV:Body>

			<DoDirectPaymentReq xmlns="urn:ebay:api:PayPalAPI">
				<DoDirectPaymentRequest xmlns="urn:ebay:api:PayPalAPI">
					<Version xmlns="urn:ebay:apis:eBLBaseComponents">1.0</Version>
						<DoDirectPaymentRequestDetails xmlns="urn:ebay:apis:eBLBaseComponents">
							<PaymentAction>$payment_action</PaymentAction>
							<PaymentDetails>
								<OrderTotal currencyID="$currency_type">$order_total</OrderTotal>
								<ItemTotal currencyID="$currency_type">$item_total</ItemTotal>
								<ShippingTotal currencyID="$currency_type">$ship_total</ShippingTotal>
								<TaxTotal currencyID="$currency_type">$tax_total</TaxTotal>
								<OrderDescription>$subject</OrderDescription>

END;

if ($no_shipping == false) {
			$doDirectPaymentRequest .= <<<END
			<ShipToAddress>
				<Name>$ship_name</Name>
		        <Street1>$ship_street1</Street1>
		        <Street2>$ship_street2</Street2>
		        <CityName>$ship_city</CityName>
		        <StateOrProvince>$ship_state</StateOrProvince>
		        <Country>$ship_country</Country>
          		<Phone></Phone>
		  		<PostalCode>$ship_zip</PostalCode>
			</ShipToAddress>
END;
}

	$auth = $_SESSION['auth'];
	$cart = $_SESSION['cart'];
	$order_subtotal = 0;

	require_once(CLASSPATH.'ps_product.php');
	$ps_product= new ps_product;

	for($i = 0; $i < $cart["idx"]; $i++) {
		$price = $ps_product->get_adjusted_attribute_price($cart[$i]["product_id"], $cart[$i]["description"]);
		$product_price = number_format( round( $price["product_price"], 2 ), 2, '.', '' );
		$product_name = $ps_product->get_field($cart[$i]["product_id"], "product_name");
		$product_number = $cart[$i]["product_id"];
		$product_quantity = $cart[$i]["quantity"];
		if( $auth["show_price_including_tax"] == 1 ) {
			if( empty( $_SESSION['product_info'][$cart[$i]["product_id"]]['tax_rate'] )){
				$my_taxrate = $ps_product->get_product_taxrate($cart[$i]["product_id"] );
			}else{
                $my_taxrate = $_SESSION['product_info'][$cart[$i]["product_id"]]['tax_rate'];
				$product_tax = round( ($product_price * $my_taxrate), 2 );
			}
		} else {
			$product_tax = '0.00';
		}
			$doDirectPaymentRequest .= <<<END
			<PaymentDetailsItem>
				<Name>$product_name</Name>
				<Number>$product_number</Number>
				<Quantity>$product_quantity</Quantity>
				<SalesTax currencyID="$currency_type">$product_tax</SalesTax>
				<Amount currencyID="$currency_type">$product_price</Amount>
			</PaymentDetailsItem>
END;
	}

	$doDirectPaymentRequest .= <<<END
	</PaymentDetails>
		<CreditCard>
			<CreditCardType>$cc_type</CreditCardType>
			<CreditCardNumber>$cc_number</CreditCardNumber>
			<ExpMonth>$cc_expires_month</ExpMonth>
			<ExpYear>$cc_expires_year</ExpYear>
			<CardOwner>
				<Payer>$payer</Payer>
				<PayerName>
					<FirstName>$first_name</FirstName>
					<LastName>$last_name</LastName>
				</PayerName>
				<Address>
					<Name>$cc_owner</Name>
					<Street1>$address_street1</Street1>
					<CityName>$address_city</CityName>
					<StateOrProvince>$address_state</StateOrProvince>
					<Country>$address_country</Country>
					<Phone>$phone_1</Phone>
					<PostalCode>$address_zip</PostalCode>
				</Address>
	      </CardOwner>
		  <CVV2>$cc_cvv2</CVV2>
	    </CreditCard>
	    <IPAddress>$REMOTE_ADDR</IPAddress>
	    <MerchantSessionId></MerchantSessionId>



					</DoDirectPaymentRequestDetails>
				</DoDirectPaymentRequest>
			</DoDirectPaymentReq>


		</SOAP-ENV:Body>
	</SOAP-ENV:Envelope>

END;

	return $doDirectPaymentRequest;

}

	function saveIt() {
		global $database, $acl, $VM_LANG, $vmLogger;
		global $mosConfig_sitename, $mosConfig_live_site, $mosConfig_useractivation, $mosConfig_allowUserRegistration;
		global $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mailfrom, $mosConfig_fromname;

		if ($mosConfig_allowUserRegistration=='0') {
			mosNotAuth();
			return false;
		}

		$row = new mosUser( $database );

		if (!$row->bind( $_POST, 'usertype' )) {
			$error = vmHtmlEntityDecode( $row->getError() );
			$vmLogger->err( $error );
			echo "<script type=\"text/javascript\"> alert('". $error. "');</script>\n";
			return false;
		}

		mosMakeHtmlSafe($row);

		$usergroup = 'Registered';
		$row->id = 0;
		$row->usertype = $usergroup;
		$row->gid = $acl->get_group_id( $usergroup, 'ARO' );

		if ($mosConfig_useractivation == '1') {
			$row->activation = md5( mosMakePassword() );
			$row->block = '1';
		}

		if (!$row->check()) {
			$error = vmHtmlEntityDecode( $row->getError() );
			$vmLogger->err( $error );
			echo "<script type=\"text/javascript\"> alert('". $error. "');</script>\n";
			return false;
		}

		$pwd 				= $row->password;
		$row->password 		= md5( $row->password );
		$row->registerDate 	= date('Y-m-d H:i:s');

		if (!$row->store()) {
			$error = vmHtmlEntityDecode( $row->getError() );
			$vmLogger->err( $error );
			echo "<script type=\"text/javascript\"> alert('". $error. "');</script>\n";
			return false;
		}
		$row->checkin();

		$name 		= $row->name;
		$email 		= $row->email;
		$username 	= $row->username;

		$subject 	= sprintf (_SEND_SUB, $name, $mosConfig_sitename);
		$subject 	= vmHtmlEntityDecode($subject, ENT_QUOTES);
		if ($mosConfig_useractivation=="1"){
			$message = sprintf (_USEND_MSG_ACTIVATE, $name, $mosConfig_sitename, $mosConfig_live_site."/index.php?option=com_registration&task=activate&activation=".$row->activation, $mosConfig_live_site, $username, $pwd);
		} else {
			$message = sprintf ($VM_LANG->_PHPSHOP_USER_SEND_REGISTRATION_DETAILS, $name, $mosConfig_sitename, $mosConfig_live_site, $username, $pwd);
		}

		$message = vmHtmlEntityDecode($message, ENT_QUOTES);
		// Send email to user
		if ($mosConfig_mailfrom != "" && $mosConfig_fromname != "") {
			$adminName2 = $mosConfig_fromname;
			$adminEmail2 = $mosConfig_mailfrom;
		} else {
			$query = "SELECT name, email"
			. "\n FROM #__users"
			. "\n WHERE LOWER( usertype ) = 'superadministrator'"
			. "\n OR LOWER( usertype ) = 'super administrator'"
			;
			$database->setQuery( $query );
			$rows = $database->loadObjectList();
			$row2 			= $rows[0];
			$adminName2 	= $row2->name;
			$adminEmail2 	= $row2->email;
		}

		mosMail($adminEmail2, $adminName2, $email, $subject, $message);

		// Send notification to all administrators
		$subject2 = sprintf (_SEND_SUB, $name, $mosConfig_sitename);
		$message2 = sprintf (_ASEND_MSG, $adminName2, $mosConfig_sitename, $row->name, $email, $username);
		$subject2 = vmHtmlEntityDecode($subject2, ENT_QUOTES);
		$message2 = vmHtmlEntityDecode($message2, ENT_QUOTES);

		// get superadministrators id
		$admins = $acl->get_group_objects( 25, 'ARO' );

		foreach ( $admins['users'] AS $id ) {
			$query = "SELECT email, sendEmail"
			. "\n FROM #__users"
			."\n WHERE id = $id"
			;
			$database->setQuery( $query );
			$rows = $database->loadObjectList();

			$row = $rows[0];

			if ($row->sendEmail) {
				mosMail($adminEmail2, $adminName2, $row->email, $subject2, $message2);
			}
		}

		if ( $mosConfig_useractivation == 1 ){
			echo _REG_COMPLETE_ACTIVATE;
		} else {
			echo _REG_COMPLETE;
		}
		return true;
	}


function saveRegistration( $order_detail, $order_info, $shipping_info) {
	global $database, $my, $acl, $mainframe, $vars, $sess, $_VERSION, $VM_LANG,
		$mosConfig_sitename, $mosConfig_live_site, $mosConfig_useractivation, $mosConfig_allowUserRegistration,
		$mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mailfrom, $mosConfig_fromname;
 
	if ($mosConfig_allowUserRegistration=="0") {
		mosNotAuth();
		return;
	}
	
	
	
	//Check if user has registered but is not logged in
	
	$regquery = "SELECT * FROM #__users WHERE email = '".$order_info['email']."'" ;
	$database->setQuery( $regquery );
	$rows = $database->loadObjectList();
	
		if (count($rows) > 0 ) {
			$row2 		= $rows[0];
			$user_id1	= $row2->id;
			$username1 	= $row2->username;
			$password1 	= $row2->password;
			
			$harden = mosHash( @$_SERVER['HTTP_USER_AGENT'] );
			$username1_hash = md5( $username1 . $harden );
			list($hash, $salt) = explode( ':', $password1 );
			$password1_hash = md5( $hash . $harden );
			$mainframe->login( $username1_hash, $password1_hash, 1, $user_id1 );
		} else {
	
	// User isn't in database so we will register them
	$row = new mosUser( $database );

	$row->id = "";
	$row->name = $order_info['first_name'] ." ". $order_info['last_name'];
	$row->email = $order_info['email'];
	$row->username = $order_info['email'];
	$row->password = mosMakePassword();
	
	$row->gid = $acl->get_group_id('Registered','ARO');
	// save usertype to usetype column
	$row->usertype = 'Registered';
	if ($mosConfig_useractivation=="1") {
		$row->activation = md5( $row->password);
		$row->block = "1";
	} else {
	$row->activation = "";
	$row->block = "0";
	}	
	
	$row->sendEmail = 0;
	$row->registerDate = date("Y-m-d H:i:s");
	$row->lastvisitDate = "";
	$row->params = "";

	mosMakeHtmlSafe($row);



	//////////////////////////////
	// PHPSHOP MODIFICATION
	$provided_required = true;
	$missing = "";

	$row->email = $order_info['email'];
	if (empty($order_info['email'])) { $provided_required = false; $missing .= "email,"; }
	if (empty($order_info['first_name'])) { $provided_required = false; $missing .= "first_name,"; }
	if (empty($order_info['last_name']))  { $provided_required = false; $missing .= "last_name,"; }
	if (empty($shipping_info['address_1']))  { $provided_required = false; $missing .= "address_1,"; }
	if (empty($shipping_info['city']))  { $provided_required = false; $missing .= "city,"; }
	if (empty($shipping_info['zip'])) { $provided_required = false; $missing .= "zip,"; }
	if (CAN_SELECT_STATES == '1') {
		if (empty($shipping_info['state'])) { $provided_required = false; $missing .= "state,"; }
	}
	if (empty($shipping_info['country'])) { $provided_required = false; $missing .= "country,"; }


	if (!$provided_required) {
			mosRedirect("index.php?option=com_virtuemart&page=checkout.index&missing=$missing",_CONTACT_FORM_NC);
			exit();
	}


	
	$pwd = $row->password;
	
	$salt				= mosMakePassword(16);
	$crypt				= md5($row->password.$salt);
	$row->password		= $crypt.':'.$salt;


	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	} 
	
	// Send account details email to new user
	
	$subject = $VM_LANG->_NEW_USER_MESSAGE_SUBJECT;
	$message = sprintf ( $VM_LANG->_NEW_USER_MESSAGE, $row->name, $mosConfig_sitename, $mosConfig_live_site, $row->username, $pwd );
	
			
				$adminName 	= $mosConfig_fromname;
				$adminEmail = $mosConfig_mailfrom;
			
	mosMail( $adminEmail, $adminName, $row->email, $subject, $message );
	
	
	
	// get the user id
	$query1 = "SELECT id FROM #__users WHERE username='".$row->username."' AND email='".$row->email."'";
	$database->setQuery( $query1 );
	$my_user_id = $database->loadResult();
	
	
	// fix the core_acl_aro value
	$query2 = "SELECT MAX(aro_id) FROM #__core_acl_aro";
	$database->setQuery( $query2);
	$aroid = $database->loadResult();
		

	$q5 = "UPDATE #__core_acl_aro SET value = ".$my_user_id." WHERE aro_id = ".$aroid ;
	
	$database->setQuery($q5);
	$database->query();
	
	
	// add the core_acl_groups_aro_map value
	$query = "INSERT INTO #__core_acl_groups_aro_map"
			. "\n VALUES ('".$row->gid."','','".$aroid."')";
			$database->setQuery( $query );
			$database->query() or die( $database->stderr() );
	

	// Get the 2 character country code

	$query_str = "SELECT country_3_code FROM #__{vm}_country WHERE country_2_code='" . $shipping_info['country'] . "'";
	$database->setQuery($query_str);
	$address_country = $database->loadResult();




	////////////////////////////////////////////////////
	// BEGIN PHPSHOP MODIFICATION
	//
	// Shoppers must have a
	// * shopper-vendor entry
	// and a
	// *auth_user_vendor entry
	// otherwise they are not assigned to any user group
	// and get into real trouble (no payment methods, products....)!!


	// insert shopper-vendor-xref
	$my_q =  "SELECT shopper_group_id from #__{vm}_shopper_group WHERE ";
	$my_q .= "`default`='1'";

	$database->setQuery($my_q);
	$my_shopper_id = $database->loadResult();
	$customer_nr = uniqid( rand() );
	
	
	$q2  = "INSERT INTO #__{vm}_shopper_vendor_xref ";
	$q2 .= "(user_id,vendor_id,shopper_group_id,customer_number) ";
	$q2 .= "VALUES ('";
	$q2 .= $my_user_id . "','";
	$q2 .= $_SESSION['ps_vendor_id'] . "','";
	$q2 .= $my_shopper_id . "','";
	$q2 .= $customer_nr . "')";
	$database->setQuery($q2);
	$database->query();
	

	// Insert vendor relationship
	$q3 = "INSERT INTO #__{vm}_auth_user_vendor (user_id,vendor_id)";
	$q3 .= " VALUES ";
	$q3 .= "('" . $my_user_id . "','";
	$q3 .= $_SESSION['ps_vendor_id'] . "') ";
	$database->setQuery($q3);
	$database->query();
	
	
	//
	// END PHPSHOP MODIFICATION
	////////////////////////////////////////////////////
	$user_info_id = "a" . md5 (uniqid (rand()));
	$address_type = 'BT';
	$first_name = $order_info['first_name'];
	$last_name = $order_info['last_name'];
	$address_type_name = '-default-';
	$company = $order_info['company'];
	$address_1 = $shipping_info['address_1'];
	$address_2 = $shipping_info['address_2'];
	$city = $shipping_info['city'];
	$zip = $shipping_info['zip'];
	$state = @$shipping_info['state'];
	$phone_1 = @$shipping_info['phone_1'];
	$timestamp = time();


// Insert billing address
	$q6 = "INSERT INTO #__{vm}_user_info";
	$q6 .= " VALUES ";
	$q6 .= "('".$user_info_id."','".$my_user_id ."','BT','-default-', '', '', '".$last_name."','".$first_name."','',";
	$q6 .= "'".$phone_1."', '', '', '".$address_1."', '".$address_2."', '".$city."', '".$state."', '".$address_country."', '".$zip."', '".$row->email."',";
	$q6 .= " '', '', '', '', '', ".$timestamp.",".$timestamp.", 'shopper', '', '', '', '', '', '')";
	$database->setQuery($q6);
	$database->query();
	
	$vars["ship_to_info_id"] = $user_info_id;
	$ship_to_info_id =$user_info_id;



	$name = $row->name;
	$email = $row->email;
	$username = $row->username;


	//Log the user in
	$mainframe->login($username, $pwd );
	}
}


	function test_login( $username=null,$passwd=null ) {
		global $acl;
		global $database, $mainframe;

		$usercookie 	= mosGetParam( $_COOKIE, 'usercookie', '' );
		$sessioncookie 	= mosGetParam( $_COOKIE, 'sessioncookie', '' );

		if (!$username || !$passwd) {

			$username 	= mosGetParam( $_POST, 'username', '' );
			$passwd 	= mosGetParam( $_POST, 'passwd', '' );
			$passwd 	= md5($passwd);
			$bypost 	= 1;
			echo ("Hiya");
		}
		$remember = mosGetParam( $_POST, 'remember', '' );

		if (!$username || !$passwd) {

			echo "<script> alert(\""._LOGIN_INCOMPLETE."\"); window.history.go(-1); </script>\n";
			exit();
		} else {

			$query = "SELECT *"
			. "\n FROM #__users"
			. "\n WHERE username = '$username'"
			. "\n AND password = '$passwd'"
			;
			$database->setQuery( $query );
			$database->loadObject( $row );
			echo(" - " .$row->password. " - ");
			$query = "SELECT *"
			. "\n FROM #__users"
			. "\n WHERE username = '$username'"
			. "\n AND password = '$passwd'"
			;
			$database->setQuery( $query );

			$row = null;
			if ($database->loadObject( $row )) {

				if ($row->block == 1) {
					mosErrorAlert(_LOGIN_BLOCKED);
				}
				$grp = $acl->getAroGroup( $row->id );
				$row->gid = 1;

				if ($acl->is_group_child_of( $grp->name, 'Registered', 'ARO' ) ||
				$acl->is_group_child_of( $grp->name, 'Public Backend', 'ARO' )) {
					$row->gid = 2;
				}

				$row->usertype = $grp->name;

				$session =& $mainframe->_session;
				$session->guest 		= 0;
				$session->username 		= $username;
				$session->userid 		= intval( $row->id );
				$session->usertype 		= $row->usertype;
				$session->gid 			= intval( $row->gid );


				$session->update();


				$currentDate = date("Y-m-d H:i:s");
				$query = "UPDATE #__users"
				. "\n SET lastvisitDate = '$currentDate'"
				. "\n WHERE id = $session->userid"
				;

				$database->setQuery($query);
				$database->query();


				if ($remember=="yes") {
					$lifetime = time() + 365*24*60*60;
					setcookie( "usercookie[username]", $username, $lifetime, "/" );
					setcookie( "usercookie[password]", $passwd, $lifetime, "/" );
				}
				mosCache::cleanCache();
			} else {
				exit();
				if (isset($bypost)) {
					mosErrorAlert(_LOGIN_INCORRECT);
				} else {
					$database->logout();
					mosRedirect("index.php");
				}
				exit();
			}
		}
	}


function complete_order(&$d, $method) {
	global $HTTP_POST_VARS, $afid, $database, $VM_LANG, $mosConfig_debug, $mosConfig_offset;

	if ($method != 'ec') { $method='dc'; }
	$_SESSION['CURL_ERROR'] = false;
	$_SESSION['CURL_ERROR_TXT'] = '';
	$ps_vendor_id = $_SESSION["ps_vendor_id"];
	$auth = $_SESSION['auth'];
	$cart = $_SESSION['cart'];
	$d['error'] = '';
	require_once(CLASSPATH . 'ps_payment_method.php');
	$ps_payment_method = new ps_payment_method;
	require_once(CLASSPATH . 'ps_product.php');
	$ps_product = new ps_product;
	require_once(CLASSPATH . 'ps_checkout.php');
	$ps_checkout = new ps_checkout;
	require_once(CLASSPATH .'ps_cart.php');
	$ps_cart = new ps_cart;
	require_once(CLASSPATH . 'payment/ps_paypal_wpp.cfg.php');

	if (AFFILIATE_ENABLE == '1') {
		require_once(CLASSPATH . 'ps_affiliate.php');
		$ps_affiliate = new ps_affiliate;
	}

	$db_new = new ps_DB;

	$my_q =  "SELECT user_info_id FROM #__vm_user_info WHERE user_id='".$auth["user_id"]."'" ;
	$database->setQuery($my_q);
	$ship_to_info_id = $database->loadResult();

	$query_str = "SELECT * FROM #__{vm}_payment_method WHERE payment_method_name='ps_paypal_wpp'";
	$db_new->setQuery($query_str);
	$db_new->query();
	$db_new->next_record();
	$payment_method_id = $db_new->f("payment_method_id");
	if (!empty($payment_method_id) ){
		$d["payment_method_id"] = $payment_method_id;
	} else {
		$d["payment_method_id"] = 1;
	}

	$db = new ps_DB;
	
	// There's no need to validate the form with express checkout. Paypal has already verified the information.
	if ($method != 'ec') {
		if (!$ps_checkout->validate_form($d)){
			echo ('Error With Form<br />' . $d['error']);
			return false;
		}

		if (!$ps_checkout->validate_add($d)) {
			echo ('Error With Validate Add<br />' . $d['error']);
			return false;
		}
	}

	// Set the order number
	$order_number = $ps_checkout->get_order_number();
	$order_total = round($d['order_total'],2);
	$order_subtotal = round($d['item_total'],2);
	$order_tax = round($d['tax_total'],2);
	$order_shipping = round($d['shipping_total'],2);
	$order_shipping_tax  = round($d['shipping_tax'],2);
	$payment_discount = round($d['payment_discount'],2);
	$coupon_discount = round($d['coupon_discount'],2);


	// sets _order_tax
	$d['order_tax'] = round($d['tax'],2);
	$d['order_shipping'] = round($d['shipping'],2);
	$d['order_shipping_tax'] = round($d['shipping_tax'],2);

	$timestamp = time() + ($mosConfig_offset*60*60);

	if( $order_total < 0 ) { $order_total = 0; }

	// ****************************************************
	// PROCESS PAYMENT WITH PAYPAL
	// ****************************************************
	
	$apiusername = PP_WPP_USERNAME;
	$apipassword = PP_WPP_PASSWORD;
	$apisignature = PP_WPP_SIGNATURE;
	$apiemail = PP_WPP_ACCOUNT;
	$apiurl = PP_WPP_SANDBOX;
	if ($apiurl == '1'){
		$apiurl = 'https://api.sandbox.paypal.com/2.0/';
	} else {
		$apiurl = 'https://api-3t.paypal.com/2.0/';
	}

		$api_data = SOAP_DoExpressCheckoutPaymentRequest($apiusername, $apipassword, $apisignature, $apiemail, $d, PP_WPP_PAYMENT_ACTION);
		$response = SendSoap($apiurl, $api_data);
		$arr_vals = xml2php($response);
		if ($response == false) { echo "<br />" . $displayMsg; exit; }

		// Parse out all the data and store in database
		$errorOut = TRUE;
		$errorOut2 = FALSE;
		$pending_reason = "none";
		$displayMsg = "";
		foreach ($arr_vals AS $name => $value) {
			if (is_array($value)){
				foreach ($value AS $name2 => $value2) {
					if ($name2 == "tag") $tag_value = $value2;
					if ($name2 == "value") {
						if ($tag_value == "ACK" && ($value2 != "Success" && $value2 != "SuccessWithWarning")) {
							$displayMsg .= "<br /><b>Paypal did not complete order</b><br />";
							$errorOut2 = TRUE;
						} elseif ($tag_value == "ERRORCODE") {
							$displayMsg .= "Error Code: $value2<br />";
						} elseif ($tag_value == "LONGMESSAGE") {
							$displayMsg .= "<br /><b>Paypal Response:</b><br /><b>$value2<br />";
						} elseif ($tag_value == "PAYMENTSTATUS" && ($value2 != "Completed" && $value2 != "Processed" && $value2 != "Pending")) {
							$displayMsg .= "<br /><br />Your payment did not process. Please call us, or select another form of payment.<br />";
							$payment_status = $value2;
						} elseif ($tag_value == "PAYMENTSTATUS" && ($value2 == "Completed" || $value2 == "Processed" || $value2 == "Pending")) {
							$errorOut = FALSE;
							$payment_status = $value2;
							$displayMsg .= "Your order has been processed<br />";
						} elseif ($tag_value == "PENDINGREASON" && ($value2 != "none")) {
							$pending_reason = $value2;
							$displayMsg .= "Your order has been processed and is currently pending.<br />";
							if ($value2 != "address") {
								$displayMsg .= "Pending reason: We must manually check your order because you are using a unconfirmed address.<br />Please call for more info. -- ";
							} elseif ($value2 != "echeck") {
								$displayMsg .= "Pending reason: You paid with Echeck which takes a few days to clear - once cleared your order will be complete. -- ";
							} elseif ($value2 != "verify") {
								$displayMsg .= "Pending reason: Our account has not yet been verified - we may not know this is the case - please call. -- ";
							} elseif ($value2 != "other") {
								$displayMsg .= "Pending reason: There is some unknown reason that your order is pending - please call to verify.  -- ";
							}
						} elseif ($tag_value == "PAYMENTTYPE") {
							$payment_type = $value2;
						} elseif ($tag_value == "TRANSACTIONID") {
							$trans_id = $value2;
						} else {
						}
					}
				}
			} else {
				if ($name == "tag") $tag_value = $value;
				if ($name == "value") {
					if ($tag_value == "ACK" && ($value != "Success" && $value != "SuccessWithWarning")) {
						$displayMsg .= "Error - Paypal did not complete order -- ";
						$errorOut2 = TRUE;
					} elseif ($tag_value == "ERRORCODE") {
						$displayMsg .= $tag_value . "=" . $value . " -- ";
					} elseif ($tag_value == "LONGMESSAGE") {
						$displayMsg .= $tag_value . "=" . $value . " --- ";
					} elseif ($tag_value == "PAYMENTSTATUS" && ($value != "Completed" && $value != "Processed" && $value != "Pending")) {
						$displayMsg .= "Your payment did not process - please call in. -- ";
						$payment_status = $value;
					} elseif ($tag_value == "PAYMENTSTATUS" && ($value == "Completed" || $value == "Processed" || $value == "Pending")) {
						$displayMsg .= "Your order has been processed <br /> ";
						$payment_status = $value;
						$errorOut = FALSE;
						//safe_query("UPDATE order_detail SET status=2 WHERE token='$_GET[token]'");
					} elseif ($tag_value == "PENDINGREASON" && ($value != "none")) {
						$pending_reason = $value;
						$displayMsg .= " and is currently pending. <br /> ";
						if ($value != "address") {
							$displayMsg .= "<b>Pending reason: We must manually check your order because you are using a unconfirmed address.<br />Please call for more info. </b><br /> ";
						} elseif ($value != "echeck") {
							$displayMsg .= "<b>Pending reason: You paid with Echeck which takes a few days to clear - once cleared your order will be complete. </b><br /> ";
						} elseif ($value != "verify") {
							$displayMsg .= "<b>Pending reason: Our account has not yet been verified - we may not know this is the case - please call. </b><br /> ";
						} elseif ($value != "other") {
							$displayMsg .= "<b>Pending reason: There is some unknown reason that your order is pending - please call to verify.</b><br /> ";
						}
					} elseif ($tag_value == "PAYMENTTYPE") {
						$payment_type = $value;
					} elseif ($tag_value == "TRANSACTIONID") {
						$trans_id = $value;
					} else {
					}
				}
			}
		}


		$d["order_payment_trans_id"] = $trans_id;

		if ($errorOut || $errorOut2) {
			if ($_SESSION['CURL_ERROR'] == true) {
    	       $d["error"] .= "\n Payment Error:" . $displayMsg . "-CURL ERROR: " . $_SESSION['CURL_ERROR_TXT'];
			} else {
    	       $d["error"] .= "\n Payment Error:" . $displayMsg;
			}
		   echo ($d["error"]);
		   return false;
		} else {
			if ($_SESSION['CURL_ERROR'] == true) { echo "<br />" . $displayMsg . "-CURL ERROR: " . $_SESSION['CURL_ERROR_TXT'] . "<br /><br />" . $response; $d["error"] .= "\n Payment Error:" . $displayMsg . "-CURL ERROR: " . $_SESSION['CURL_ERROR_TXT'];}
		  	switch ($payment_status) {
		  	  case 'Completed': $d['order_status'] = "C"; break;
		  	  case 'Processed': $d['order_status'] = "C"; break;
		  	  case 'Pending':
				// set order status to 'Pending'
				$d['order_status'] = "P";
				$d['order_comment'] = $pending_reason;
				break;
			  default:
	            $d["error"] .= "\n Payment Error:" . $displayMsg;
			    echo ($d["error"]);
	 		    return false;
			    break;
		  	}
			$update_order = true;
		}


	 // ****************************************************

     // Kill the coupon if it was a gift coupon
     if( @$_SESSION['coupon_type'] == "gift" ) {
       $d['coupon_id'] = $_SESSION['coupon_id'];
       include_once( CLASSPATH.'ps_coupon.php' );
       ps_coupon::remove_coupon_code( $d );
     }

   	 // ****************************************************
	 // STORE IN DB - ORDER INFO
	 // ****************************************************
     $q = "INSERT INTO #__{vm}_orders ";
     $q .= "(user_id, vendor_id, order_number, user_info_id, ";
     $q .= "ship_method_id, order_total, order_subtotal, order_tax, order_shipping, ";
     $q .= "order_shipping_tax,  order_discount, coupon_discount,order_currency, order_status, cdate, ";
     $q .= "mdate,customer_note,ip_address) ";
     $q .= "VALUES (";
     $q .= "'" . $auth["user_id"] . "', ";
     $q .= $ps_vendor_id . ", ";
     $q .= "'" . $order_number . "', '";
     $q .= $ship_to_info_id . "', '";

     if (!empty($d["shipping_rate_id"]))
         $q .= urldecode($d["shipping_rate_id"]) . "', '";
     else
         $q .= "', '";
     $q .= $order_total . "', '";
     $q .= $order_subtotal . "', '";
     $q .= $order_tax . "', '";
     $q .= $order_shipping . "', '";
     $q .= $order_shipping_tax . "', '";
     $q .= $payment_discount . "', '";
     $q .= $coupon_discount . "', '";
     $q .= $_SESSION['vendor_currency']."', ";
     $q .= "'P', '";
     $q .= $timestamp . "', '";
     $q .= $timestamp. "', '";
     $q .= htmlspecialchars(strip_tags($d['customer_note'])) . "', '";
     if (!empty($_SERVER['REMOTE_ADDR']))
        $q .= $_SERVER['REMOTE_ADDR'] . "') ";
     else
        $q .= $HTTP_SERVER_VARS['REMOTE_ADDR'] . "') ";
     $db->query($q);
     $db->next_record();

	 // RETRIEVE ORDER ID FROM LAST QUERY
     $q = "SELECT order_id FROM #__{vm}_orders WHERE order_number = '" . $order_number . "'";
     $db->query($q);
     $db->next_record();

     $d["order_id"] = $order_id = $db->f("order_id");

	 // ****************************************************
     // INSERT ORDER HISTORY IN DB
	 // ****************************************************
	 $q = "INSERT INTO #__{vm}_order_history ";
	 $q .= "(order_id,order_status_code,date_added,customer_notified,comments) VALUES (";
	 $q .= "'$order_id', 'P', NOW(), '1', '')";
	 $db->query($q);

	 // ****************************************************
	 // INSERT ORDER PAYMENT INFO
	 // ****************************************************
     $payment_number = ereg_replace(" |-", "", $_SESSION['ccdata']['order_payment_number']);

     $d["order_payment_code"] = $_SESSION['ccdata']['credit_card_code'];

     // Payment number is encrypted using mySQL ENCODE function.
     $q = "INSERT INTO #__{vm}_order_payment ";
     $q .= "(order_id, order_payment_code, payment_method_id, order_payment_number, ";
     $q .= "order_payment_expire, order_payment_log, order_payment_name, order_payment_trans_id) ";
     $q .= "VALUES ('$order_id', ";
     $q .= "'" . $d["order_payment_code"] . "', ";
     $q .= "'" . $d["payment_method_id"] . "', ";
     $q .= "ENCODE(\"$payment_number\",\"" . ENCODE_KEY . "\"), ";
     $q .= "'" . $_SESSION["ccdata"]["order_payment_expire"] . "',";
     $q .= "'" . @$d["order_payment_log"] . "',";
     $q .= "'" . $_SESSION["ccdata"]["order_payment_name"] . "',";
     $q .= "'" . @$d["order_payment_trans_id"] . "'";
     $q .= ")";
     $db->query($q);
     $db->next_record();

	 // ****************************************************
	 // INSERT ADDRESS INFO
	 // ****************************************************
     // Billing
     $db->query( "SELECT * FROM #__{vm}_user_info WHERE user_id='".$auth['user_id']."' AND user_info_id='".$ship_to_info_id."'" );
     $db->next_record();
     $q = "INSERT INTO `#__{vm}_order_user_info` ";
     $q .= "(`order_id` , `user_id` , `address_type` , `address_type_name` , `company` , `title` , `last_name` , `first_name` , `middle_name` , `phone_1` , `phone_2` , `fax` , `address_1` , `address_2` , `city` , `state` , `country` , `zip` , `user_email` ) ";
     $q .= "VALUES ('$order_id', '".$auth['user_id']."', 'BT', '', '".addslashes($db->f("company"))."', '".addslashes($db->f("title"))."', '".addslashes($db->f("last_name"))."', '".addslashes($db->f("first_name"))."', '".addslashes($db->f("middle_name"))."', '".addslashes($db->f("phone_1"))."', '".addslashes($db->f("phone_2"))."', '".addslashes($db->f("fax"))."', '".addslashes($db->f("address_1"))."', '".addslashes($db->f("address_2"))."', '".addslashes($db->f("city"))."', '".addslashes($db->f("state"))."', '".addslashes($db->f("country"))."', '".addslashes($db->f("zip"))."', '".addslashes($db->f("user_email"))."')";
     $db->query( $q );

     // Shipping
     $db->query( "SELECT * FROM #__{vm}_user_info WHERE user_id='".$auth['user_id']."' AND user_info_id='".$ship_to_info_id."'" );
     if( $db->next_record() ) {
       $q = "INSERT INTO `#__{vm}_order_user_info` ";
       $q .= "(`order_id` , `user_id` , `address_type` , `address_type_name` , `company` , `title` , `last_name` , `first_name` , `middle_name` , `phone_1` , `phone_2` , `fax` , `address_1` , `address_2` , `city` , `state` , `country` , `zip` , `user_email` ) ";
       $q .= "VALUES ('$order_id', '".$auth['user_id']."', 'ST', '', '".addslashes($db->f("company"))."', '".addslashes($db->f("title"))."', '".addslashes($db->f("last_name"))."', '".addslashes($db->f("first_name"))."', '".addslashes($db->f("middle_name"))."', '".addslashes($db->f("phone_1"))."', '".addslashes($db->f("phone_2"))."', '".addslashes($db->f("fax"))."', '".addslashes($db->f("address_1"))."', '".addslashes($db->f("address_2"))."', '".addslashes($db->f("city"))."', '".addslashes($db->f("state"))."', '".addslashes($db->f("country"))."', '".addslashes($db->f("zip"))."', '".addslashes($db->f("user_email"))."')";
       $db->query( $q );
     }

	 // ****************************************************
	 // INSERT CART ITEMS INTO ORDER - ONE ITEM PER ROW
	 // ****************************************************
     $dboi = new ps_DB;

     for($i = 0; $i < $cart["idx"]; $i++) {

        $r = "SELECT product_in_stock,product_sales,product_id,product_sku,product_name ";
        $r .= "FROM #__{vm}_product WHERE product_id='".$cart[$i]["product_id"]."'";
        $dboi->query($r);
        $dboi->next_record();

        $product_price_arr = $ps_product->get_adjusted_attribute_price($cart[$i]["product_id"], $cart[$i]["description"]);
        $product_price = $product_price_arr["product_price"];

        if( empty( $_SESSION['product_info'][$cart[$i]["product_id"]]['tax_rate'] ))
          $my_taxrate = $ps_product->get_product_taxrate($cart[$i]["product_id"] );
        else
          $my_taxrate = $_SESSION['product_info'][$cart[$i]["product_id"]]['tax_rate'];

        $product_final_price = round( ($product_price *($my_taxrate+1)), 2 );

        $vendor_id = $ps_vendor_id;

        $product_currency = $product_price_arr["product_currency"];

        $q = "INSERT INTO #__{vm}_order_item ";
        $q .= "(order_id, user_info_id, vendor_id, product_id, order_item_sku, order_item_name, ";
        $q .= "product_quantity, product_item_price, product_final_price, ";
        $q .= "order_item_currency, order_status, product_attribute, cdate, mdate) ";
        $q .= "VALUES ('";
        $q .= $order_id . "', '";
        $q .= $ship_to_info_id . "', '";
        $q .= $vendor_id . "', '";
        $q .= $cart[$i]["product_id"] . "', '";
        $q .= addslashes($dboi->f("product_sku")) . "', '";
        $q .= addslashes($dboi->f("product_name")) . "', '";
        $q .= $cart[$i]["quantity"] . "', '";
        $q .= $product_price . "', '";
        $q .= $product_final_price . "', '";
        $q .= $product_currency . "', ";
        $q .= "'P','";
        // added for advanced attribute storage
        $q .= addslashes($_SESSION['cart'][$i]["description"]) . "', '";
        // END advanced attribute modifications
        $q .= $timestamp . "','";
        $q .= $timestamp . "'";
        $q .= ")";

         $db->query($q);
         $db->next_record();

      // UPDATE THE STOCK LEVELS
      if ($dboi->f("product_in_stock")) {
         $q = "UPDATE #__{vm}_product ";
         $q .= "SET product_in_stock = product_in_stock - ".$cart[$i]["quantity"];
         $q .= " WHERE product_id = '" . $cart[$i]["product_id"]. "'";
         $db->query($q);
         $db->next_record();
      }

	  // UPDATE PRODUCT SALES
      $q = "UPDATE #__{vm}_product ";
      $q .= "SET product_sales= product_sales + ".$cart[$i]["quantity"];
      $q .= " WHERE product_id='".$cart[$i]["product_id"]."'";
      $db->query($q);
      $db->next_record();

     }

	 // ****************************************************
	 // DOWNLOAD MODULE - IN CASE PRODUCT IS DOWNLOADABLE
	 // ****************************************************
    if( ENABLE_DOWNLOADS == "1" ) {
      for($i = 0; $i < $cart["idx"]; $i++) {
        $dlnum=0;
        $dl = "SELECT attribute_name,attribute_value ";
        $dl .= "FROM #__{vm}_product_attribute WHERE product_id='".$cart[$i]["product_id"]."'";
        $dl .= " AND attribute_name='download'";
        $db->query($dl);
        $db->next_record();

        if ($db->f("attribute_name") =="download") {

            $str = $order_id;
            $str .=$cart[$i]["product_id"];
            $str .=$dlnum;
            $str .=time();

            $download_id = md5($str);

            $q = "INSERT INTO #__{vm}_product_download ";
            $q .= "(product_id, user_id, order_id, end_date, download_max, download_id, file_name)";
            $q .= " VALUES ('";
            $q .= $cart[$i]["product_id"] . "', '";
            $q .= $auth["user_id"] . "', '";
            $q .= $order_id . "', '";
            $q .= " 0" . "', '";
            $q .= DOWNLOAD_MAX . "', '";
            $q .= $download_id . "', '";
            $q .= $db->f("attribute_value") . "')";
            $db->query($q);
            $db->next_record();
       }
     }
    }


	 // ****************************************************
	 // UPDATE AFFILIATE SALES
	 // ****************************************************
    if (AFFILIATE_ENABLE == '1') {
      $ps_affiliate->register_sale($order_id);
    }


     $d["order_id"] = $order_id;

     // Unset the payment_method variables

     $d["payment_method_id"] = "";
     $d["order_payment_number"] = "";
     $d["order_payment_expire"] = "";
     $d["order_payment_name"] = "";
     $d["credit_card_code"] = "";
     $_SESSION['ccdata']['order_payment_name']  = "";
     $_SESSION['ccdata']['order_payment_number']  = "";
     $_SESSION['ccdata']['order_payment_expire_month'] = "";
     $_SESSION['ccdata']['order_payment_expire_year'] = "";
     $_SESSION['ccdata']['credit_card_code'] = "";
     $HTTP_POST_VARS["payment_method_id"] = "";
     $HTTP_POST_VARS["order_payment_number"] = "";
     $HTTP_POST_VARS["order_payment_expire"] = "";
     $HTTP_POST_VARS["order_payment_name"] = "";
     $_SESSION['coupon_discount'] = "";
     $_SESSION['coupon_id'] = "";
     $_SESSION['coupon_redeemed'] = false;
     $_SESSION["PPCheckoutArray"] = "";

	 // ****************************************************
	 // UPDATE ORDER STATUS
	 // ****************************************************
      if ( $update_order ) {
        require_once(CLASSPATH."ps_order.php");
        $ps_order =& new ps_order();
        $ps_order->order_status_update($d);
      }

	 // ****************************************************
	 // SEND EMAIL CONFIRMATIONS
	 // ****************************************************
     $ps_checkout->email_receipt($order_id);

	 // ****************************************************
	 // CLEAR CART
	 // ****************************************************
     $ps_cart->reset();

     return $order_id;
}
?>