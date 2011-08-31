<?php
/**
*
* Layout for the shopper mail, when he confirmed an ordner
*
* The addresses are reachable with $this->BTaddress, take a look for an exampel at shopper_adresses.php
*
* With $this->cartData->paymentName or shippingName, you get the name of the used paymentmethod/shippmentmethod
*
* In the array order you have details and items ($this->order['details']), the items gather the products, but that is done directly from the cart data
*
* $this->order['details'] contains the raw address data (use the formatted ones, like BTaddress). Interesting informatin here is,
* order_number ($this->order['details']['BT']->order_number), order_pass, coupon_code, order_status, order_status_name,
* user_currency_rate, created_on, customer_note, ip_address
*
* @package	VirtueMart
* @subpackage Cart
* @author Max Milbers
*
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>

<html>
<head>
	<style type="text/css">
		table.html-email {margin:30px auto;background:#fff;border:solid #dad8d8 1px;padding:25px;}
		.html-email tr{border-bottom : 1px solid #eee;}
		span.grey {color:#666;}
		a.default:link, a.default:hover, a.default:visited {color:#666;line-height:25px;background: #f2f2f2;margin: 10px ;padding: 3px 8px 1px 8px;border: solid #CAC9C9 1px;border-radius: 4px;-webkit-border-radius: 4px;-moz-border-radius: 4px;text-shadow: 1px 1px 1px #f2f2f2;font-size: 12px;background-position: 0px 0px;display: inline-block;text-decoration: none;}
		a.default:hover {color:#888;background: #f8f8f8;}
		.cart-summary{font-size: 8px;}
		.sectiontableentry2, .cart-summary th{font-size:8px;background: #ccc;margin: 0px;padding: 10px;}
		.sectiontableentry1, .cart-summary td {font-size:8px;background: #fff;margin: 0px;padding: 10px;}
	</style>

</head>
	
<body style="background: f2f2f2;word-wrap: break-word;">
<?php
// Shop desc for shopper and vendor
echo $this->loadTemplate('header');
// Message for shopper or vendor
echo $this->loadTemplate($this->recipient);
// render shipto billto adresses
echo $this->loadTemplate('shopperadresses');
// render price list
echo $this->loadTemplate('pricelist');
// more infos
echo $this->loadTemplate($this->recipient.'_more');
// end of mail
echo $this->loadTemplate('footer');
?>
</body>
</html>