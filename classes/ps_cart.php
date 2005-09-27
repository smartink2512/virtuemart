<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: COPYRIGHT.php 70 2005-09-15 20:45:51Z spacemonkey $
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_phpshop/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

/**
 * CLASS DESCRIPTION
 *                   
 * ps_cart
 *
 * The cart class is used to store products and carry them through the user's
 * session in the store.
 * properties:  
 * 	item() - an array of items
 *       idx - the current count of items in the cart
 *       error - the error message returned by validation if any
 * methods:
 *       add()
 *       update()
 *       delete()
*************************************************************************/

class ps_cart {
  var $classname="ps_cart";


  /**************************************************************************
  ** name: add()
  ** created by: pablo
  ** description: adds an item to the shopping cart
  ** parameters:
  ** returns:
  ***************************************************************************/  
  function add(&$d) {
    global $sess, $PHPSHOP_LANG;
	
	include_class("product");
	
    $Itemid = mosgetparam($_REQUEST, "Itemid", null);
    $db = new ps_DB;
    $product_id = $d["product_id"];
    $quantity = isset($d["quantity"]) ? $d["quantity"] : 1;
	$_SESSION['last_page'] = "shop.product_details";

    // Check for negative quantity
    if ($quantity < 0) {
      $d["error"] = $PHPSHOP_LANG->_PHPSHOP_CART_ERROR_NO_NEGATIVE;
      return False;
    }

    if (!ereg("^[0-9]*$", $quantity)) {
     	$d["error"] = $PHPSHOP_LANG->_PHPSHOP_CART_ERROR_NO_VALID_QUANTITY;
        return False; 
    }

    // Check to see if checking stock quantity
    if (CHECK_STOCK) {
      $q = "SELECT product_in_stock ";
      $q .= "FROM #__pshop_product where product_id='$product_id'";
      $db->query($q);
      $db->next_record();
      $product_in_stock = $db->f("product_in_stock");
      if (empty($product_in_stock)) $product_in_stock = 0;
      if ($quantity > $product_in_stock) {
        $d["error"] = $PHPSHOP_LANG->_PHPSHOP_CART_STOCK_1;
        $msg = "\$msg = \"".$PHPSHOP_LANG->_PHPSHOP_CART_STOCK_2."\";";
        eval($msg);
        $d["error"] .= $msg;

        // added for the waiting list addon
        $url = "index.php?page=shop.waiting_list&product_id=";
        $url .= $product_id;
        mosRedirect( $sess->url(URL . $url), $msg );
    
        return False;
      }
    }

    // Quick add of item
    $q = "SELECT product_id FROM #__pshop_product WHERE ";
    $q .= "product_parent_id = '".$d['product_id']."'";
    $db->query ( $q );
   
    if ( $db->num_rows()) {
        include_class("product");
        $flypage = ps_product::get_flypage($product_id);
		$d["error"] = $PHPSHOP_LANG->_PHPSHOP_CART_SELECT_ITEM;
		return false;
        mosRedirect("index.php?option=com_phpshop&page=shop.product_details&flypage=$flypage&product_id=$product_id&category_id=".$_POST['category_id']."&Itemid=$Itemid", $PHPSHOP_LANG->_PHPSHOP_CART_SELECT_ITEM);
    } 

    // If no quantity sent them assume 1
    if ($quantity == "")
      $quantity = 1;
      
      
    // Check to see if we already have it
    $updated = 0;
    
	$result = ps_product_attribute::cartGetAttributes( &$d );

    if ( ($result["attribute_given"] == false && $result["advanced_attribute_list"])
        || ($result["custom_attribute_given"] == false && $result["custom_attribute_list"])){
        $flypage = ps_product::get_flypage($product_id);
        mosRedirect("index.php?option=com_phpshop&page=shop.product_details&flypage=$flypage&product_id=$product_id&category_id=$_POST[category_id]&Itemid=$Itemid", $PHPSHOP_LANG->_PHPSHOP_CART_SELECT_ITEM);
    } 
    
    // Check for duplicate and do not add to current quantity
      for ($i=0;$i<$_SESSION["cart"]["idx"];$i++) {
      // modified for advanced attributes
      if ($_SESSION['cart'][$i]["product_id"] == $product_id
      	 && 
      	$_SESSION['cart'][$i]["description"] == $d["description"]
      ) {
          $updated = 1;
      }
    }
    // If we did not update then add the item
    if (!$updated) {
      
      $k = $_SESSION['cart']["idx"];
      
      $_SESSION['cart'][$k]["quantity"] = $quantity;
      $_SESSION['cart'][$k]["product_id"] = $product_id;
      // added for the advanced attribute modification
      $_SESSION['cart'][$k]["description"] = $d["description"];
      $_SESSION['cart']["idx"]++;
    }
	else
		$this->update( $d );
    
    /* next 3 lines added by Erich for coupon code */
    /* if the cart was updated we gotta update any coupon discounts to avoid ppl getting free stuff */
    if( !empty( $_SESSION['coupon_discount'] )) {
      // Update the Coupon Discount !!
      require_once( CLASSPATH . "ps_coupon.php" );
      ps_coupon::process_coupon_code( $d );
    }
    
    $cart = $_SESSION['cart'];
    return True; 
  }

 /**************************************************************************
  ** name: update()
  ** created by: pablo
  ** description: updates the quantity of a product_id in the cart
  ** parameters:
  ** returns:
  ***************************************************************************/    
  function update(&$d) {
    global $sess,$PHPSHOP_LANG;

	include_class("product");

    $db = new ps_DB;
    $product_id = $d["product_id"];
    $quantity = $d["quantity"];
	$_SESSION['last_page'] = "shop.cart";

    // Check for negative quantity
    if ($quantity < 0) {
      $d["error"] = $PHPSHOP_LANG->_PHPSHOP_CART_ERROR_NO_NEGATIVE;
      return False;
    }

    if (!ereg("^[0-9]*$", $quantity)) {
        $d["error"] = $PHPSHOP_LANG->_PHPSHOP_CART_ERROR_NO_VALID_QUANTITY;
        return False;
    }

    // Check to see if checking stock quantity
    if (CHECK_STOCK) {
      $q = "SELECT product_in_stock ";
      $q .= "FROM #__pshop_product where product_id=";
      $q .= $product_id;
      $db->query($q);
      $db->next_record();
      $product_in_stock = $db->f("product_in_stock");
      if (empty($product_in_stock)) $product_in_stock = 0;
      if ($quantity > $product_in_stock) {
        $d["error"] = $PHPSHOP_LANG->_PHPSHOP_CART_STOCK_1."<br />";
        $msg = "\$msg = \"".$PHPSHOP_LANG->_PHPSHOP_CART_STOCK_2."\";";
        eval($msg);
        $d["error"] .= $msg;

     //added for the waiting list addon
      $url = "index.php?page=shop.waiting_list&product_id=";
      $url .= $product_id;
      mosRedirect( $sess->url(URL . $url), $msg );

      return False;
      }
    }

    if (!$product_id) {
      return false;
    }

    if ($quantity == 0) {
        $this->delete($d);
    }
    else {

		for ($i=0;$i<$_SESSION['cart']["idx"];$i++) {
			// modified for the advanced attribute modification
			if ( ($_SESSION['cart'][$i]["product_id"] == $product_id )
				&& 
				($_SESSION['cart'][$i]["description"] == $d["description"] )
			) {
				$_SESSION['cart'][$i]["quantity"] = $quantity;
			}
		}
    }
    if( !empty( $_SESSION['coupon_discount'] )) {
      // Update the Coupon Discount !!
      require_once( CLASSPATH . "ps_coupon.php" );
      ps_coupon::process_coupon_code( $d );
    }
    $_SESSION["cart"]=$_SESSION['cart'];
    return True;
  }
  
 /**************************************************************************
  ** name: delete()
  ** created by: pablo
  ** description: deletes a given product_id from the cart
  ** parameters:
  ** returns:
  ***************************************************************************/    
  function delete($d) {

    $temp = array();
    $product_id = $d["product_id"];

    if (!$product_id) {
	  $_SESSION['last_page'] = "shop.cart";
      return False;
    }
 
    $j = 0;
    for ($i=0;$i<$_SESSION['cart']["idx"];$i++) {
            // modified for the advanced attribute modification
      if (
      	($_SESSION['cart'][$i]["product_id"] != $product_id)
      	 || 
     	($_SESSION['cart'][$i]["description"] != $d["description"])
     ) {
          $temp[$j++] = $_SESSION['cart'][$i];
      }
    }
    $temp["idx"] = $j;
    $_SESSION['cart'] = $temp;
    
    if( !empty( $_SESSION['coupon_discount'] )) {
      // Update the Coupon Discount !!
      require_once( CLASSPATH . "ps_coupon.php" );
      ps_coupon::process_coupon_code( $d );
    }
    
    return True;
  } 


 /**************************************************************************
  ** name: reset()
  ** created by: pablo
  ** description: resets the cart (i.e. empty)
  ** parameters:
  ** returns:
  ***************************************************************************/    
  function reset() { 

    $_SESSION['cart']["idx"]=0;
    $_SESSION["cart"]=$_SESSION['cart'];
    return True;
  }
}

?>
