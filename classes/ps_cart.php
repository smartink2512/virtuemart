<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
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

	/**
	 * Calls the constructor
	 *
	 * @return array An empty cart
	 */
	function initCart() {
		global $my, $cart, $sess;
		// Register the cart
		if (empty($_SESSION['cart'])) {
			$cart = array();
			$cart['idx'] = 0;
			$_SESSION['cart'] = $cart;
			return $cart;
		}
		else {
			if( ( @$_SESSION['auth']['user_id'] != $my->id ) && empty( $my->id )
			&& @$_GET['cartReset'] != 'N') {
				// If the user ID has changed (after logging out)
				// empty the cart!
				$sess->emptySession();
				ps_cart::reset();
			}
		}
		return $_SESSION['cart'];
	}
	/**
 	* adds an item to the shopping cart
 	* @author pablo
 	* @param array $d
 	*/
	function add(&$d) {
		global $sess, $VM_LANG, $cart, $option, $vmLogger,$func, $mm_action_url;
		
		$d = $GLOBALS['vmInputFilter']->process( $d );
		
		include_class("product");
		require_once (CLASSPATH . 'ps_product_attribute.php' );
		$ps_product_attribute = new ps_product_attribute;
		$Itemid = mosgetparam($_REQUEST, "Itemid", null);
		$db = new ps_DB;
		$ci = 0;
		$request_stock = "";
		$total_quantity = 0;
		$total_updated = 0;
		$total_deleted = 0;
		$_SESSION['last_page'] = "shop.product_details";
		if( !empty( $d['product_id']) && !isset($d["prod_id"])) {
			if( empty( $d['prod_id'] )) $d['prod_id'] = array();
			if( is_array($d['product_id'])) {
				$d['prod_id'] = array_merge( $d['prod_id'], $d['product_id'] );
			} else {
				$d['prod_id'] = array_merge( $d['prod_id'], array( $d['product_id'] ) );
			}
		}
		//Check to see if a prod_id has been set
		if (!isset($d["prod_id"])) {
			return true;
		}
		$multiple_products = sizeof($d["prod_id"]);
		//Iterate through the prod_id's and perform an add to cart for each one
		for ($ikey = 0; $ikey < $multiple_products; $ikey++) {

			// Create single array from multi array
			$key_fields=array_keys($d);
			foreach($key_fields as $key) {
				if(is_array($d[$key])) {
					$e[$key] = @$d[$key][$ikey];
				}
				else {
					$e[$key] = $d[$key];
				}
			}

			if ($multiple_products > 1 ) {
				$func = "cartUpdate";
			}
			$e['product_id'] = $d['product_id'];
			$e['Itemdid'] = $d['Itemid'];
			// Standard ps_cart.php with $d changed to $e
			$product_id = $e["prod_id"];
			$quantity = (int)@$e['quantity'];

			// Check for negative quantity
			if ($quantity < 0) {
				$vmLogger->warning( $VM_LANG->_PHPSHOP_CART_ERROR_NO_NEGATIVE );
				return False;
			}

			if (!ereg("^[0-9]*$", $quantity)) {
				$vmLogger->warning( $VM_LANG->_PHPSHOP_CART_ERROR_NO_VALID_QUANTITY );
				return False;
			}
			// Check to see if checking stock quantity
			if (CHECK_STOCK) {
				$q = "SELECT product_in_stock ";
				$q .= "FROM #__{vm}_product where product_id='$product_id'";
				$db->query($q);
				$db->next_record();
				$product_in_stock = $db->f("product_in_stock");
				if (empty($product_in_stock)) {
					$product_in_stock = 0;
				}
				if ($quantity > $product_in_stock) {
					//Create an array for out of stock items and continue to next item
					$request_stock[$ci]['product_id'] = $product_id;
					$request_stock[$ci]['quantity'] = $quantity;
					$ci++;
					continue;
				}
			}

			// Check if product exists and is published
			$q = "SELECT product_id FROM #__{vm}_product WHERE ";
			$q .= "product_id = ".(int)$product_id .' AND product_publish=\'Y\'';
			$db->query ( $q );

			if ( $db->num_rows() < 1) {
				$vmLogger->tip( 'The selected product does not exist.' );
				return false;
			}
			// Quick add of item
			$q = "SELECT product_id FROM #__{vm}_product WHERE ";
			$q .= "product_parent_id = ".(int)$product_id;
			$db->query ( $q );

			if ( $db->num_rows()) {
				$vmLogger->tip( $VM_LANG->_PHPSHOP_CART_SELECT_ITEM );
				return false;
			}

			// Check to see if we already have it
			$updated = 0;

			$result = ps_product_attribute::cartGetAttributes( $e);

			if ( ($result["attribute_given"] == false && !empty( $result["advanced_attribute_list"] ))
			|| ($multiple_products == 1 && ($result["custom_attribute_given"] == false && !empty( $result["custom_attribute_list"] ))) ) {
				$_REQUEST['flypage'] = ps_product::get_flypage($product_id);
				$GLOBALS['page'] = 'shop.product_details';
				$vmLogger->tip( $VM_LANG->_PHPSHOP_CART_SELECT_ITEM );
				return true;
			}

			//Check for empty custom field and quantity>0 for multiple addto
			//Normally means no info added to a custom field, but once added to a cart the quantity is automatically placed
			//If another item is added and the custom field is left blank for another product already added this will just ignore that item
			if ($multiple_products != 1 && $quantity != 0 && ($result["custom_attribute_given"] == false && !empty( $result["custom_attribute_list"] )))  {
				$vmLogger->tip( $VM_LANG->_PHPSHOP_CART_SELECT_ITEM );
				continue;
			}

			// Check for duplicate and do not add to current quantity
			for ($i=0;$i<$_SESSION["cart"]["idx"];$i++) {
				// modified for advanced attributes
				if ($_SESSION['cart'][$i]["product_id"] == $product_id
				&&
				$_SESSION['cart'][$i]["description"] == $e["description"]
				) {
					$updated = 1;
				}
			}
			list($min,$max) = ps_product::product_order_levels($product_id);
			If ($min!= 0 && $quantity !=0 && $quantity < $min) {
				eval( "\$msg = \"".$VM_LANG->_VM_CART_MIN_ORDER."\";" );
				$vmLogger->warning( $msg );
				continue;
			}
			if ($max !=0 && $quantity !=0 && $quantity>$max) {
				eval( "\$msg = \"".$VM_LANG->_VM_CART_MAX_ORDER."\";" );
				$vmLogger->warning( $msg );
				continue;
			}

			// If we did not update then add the item
			if ((!$updated) && ($quantity)){
				list($min,$max) = ps_product::product_order_levels($product_id);
				$k = $_SESSION['cart']["idx"];
				
				$_SESSION['cart'][$k]["quantity"] = $quantity;
				$_SESSION['cart'][$k]["product_id"] = $product_id;
				$_SESSION['cart'][$k]["parent_id"] = $e["product_id"];
                $_SESSION['cart'][$k]["category_id"] = $e["category_id"];
				// added for the advanced attribute modification
				$_SESSION['cart'][$k]["description"] = $e["description"];
				$_SESSION['cart']["idx"]++;
				$total_quantity += $quantity;
			}
			else {
				list($updated_prod,$deleted_prod) = $this->update( $e );
				$total_updated += $updated_prod;
				$total_deleted += $deleted_prod;
			}

			/* next 3 lines added by Erich for coupon code */
			/* if the cart was updated we gotta update any coupon discounts to avoid ppl getting free stuff */
			if( !empty( $_SESSION['coupon_discount'] )) {
				// Update the Coupon Discount !!
				$_POST['do_coupon'] = 'yes';
			}
		} // End Iteration through Prod id's
		$cart = $_SESSION['cart'];

		// Ouput info message with cart update details /*
		if($total_quantity !=0 || $total_updated !=0 || $total_deleted !=0) {
			if( $total_quantity > 0 && $total_updated ==0 ) {
				$msg = $VM_LANG->_VM_CART_PRODUCT_ADDED;
			} else {
				$msg = $VM_LANG->_VM_CART_PRODUCT_UPDATED;
			}
			/*if($total_quantity !=0)
			$msg .= "Added: ".$total_quantity." ";
			if($total_updated !=0)
			$msg .= "Updated: ".$total_updated."  ";
			if($total_deleted !=0)
			$msg .= "Deleted: ".$total_deleted." ";
			$msg .= "Product/s";
			*/
			// Comment out the following line to turn off msg i.e. //$vmLogger->tip( $msg );
			$vmLogger->info( $msg );
		}
		// end cart update message */

		// Perform notification of out of stock items
		if (@$request_stock) {
			Global $notify;
			$_SESSION['notify'] = array();
			$_SESSION['notify']['idx'] = 0;
			$k=0;
			$notify = $_SESSION['notify'];
			foreach($request_stock as $request) {
				$_SESSION['notify'][$k]["prod_id"] = $request['product_id'];
				$_SESSION['notify'][$k]["quantity"] = $request['quantity'];
				$_SESSION['notify']['idx']++;
				$k++;
			}
			$GLOBALS['vm_mainframe']->scriptRedirect( $sess->url( 'index.php?page=shop.waiting_list&product_id='.$product_id, true, false ) );
		}

		return True;
	}

	/**
	 * updates the quantity of a product_id in the cart
	 * @author pablo
	 * @param array $d
	 * @return boolean result of the update
	 */
	function update(&$d) {
		global $sess,$VM_LANG, $vmLogger, $func, $page;
		$d = $GLOBALS['vmInputFilter']->process( $d );
		include_class("product");

		$db = new ps_DB;
		$product_id = $d["prod_id"];
		$quantity = isset($d["quantity"]) ? (int)$d["quantity"] : 1;
		$_SESSION['last_page'] = "shop.cart";

		// Check for negative quantity
		if ($quantity < 0) {
			$vmLogger->warning( $VM_LANG->_PHPSHOP_CART_ERROR_NO_NEGATIVE );
			return False;
		}

		if (!ereg("^[0-9]*$", $quantity)) {
			$vmLogger->warning( $VM_LANG->_PHPSHOP_CART_ERROR_NO_VALID_QUANTITY );
			return False;
		}

		if (!$product_id) {
			return false;
		}
		$deleted_prod = 0;
		$updated_prod = 0;
		if ($quantity == 0) {
			$deleted_prod = $this->delete($d);
		}
		else {
			for ($i=0;$i<$_SESSION['cart']["idx"];$i++) {
				// modified for the advanced attribute modification
				if ( ($_SESSION['cart'][$i]["product_id"] == $product_id )
				&&
				($_SESSION['cart'][$i]["description"] == stripslashes($d["description"]) )
				) {
					if( strtolower( $func ) == 'cartadd' ) {
						$quantity += $_SESSION['cart'][$i]["quantity"];
					}
					// Get min and max order levels
					list($min,$max) = ps_product::product_order_levels($product_id);
					If ($min!= 0 && $quantity < $min) {
						eval( "\$msg = \"".$VM_LANG->_VM_CART_MIN_ORDER."\";" );
						$vmLogger->warning( $msg );
						return false;
					}
					if ($max !=0 && $quantity>$max) {
						eval( "\$msg = \"".$VM_LANG->_VM_CART_MAX_ORDER."\";" );
						$vmLogger->warning( $msg );
						return false;
					}

					// Check to see if checking stock quantity
					if (CHECK_STOCK) {
						$q = "SELECT product_in_stock ";
						$q .= "FROM #__{vm}_product where product_id=";
						$q .= $product_id;
						$db->query($q);
						$db->next_record();
						$product_in_stock = $db->f("product_in_stock");
						if (empty($product_in_stock)) $product_in_stock = 0;
						if (($quantity) > $product_in_stock) {
							Global $notify;
							$_SESSION['notify'] = array();
							$_SESSION['notify']['idx'] = 0;
							$k=0;
							$notify = $_SESSION['notify'];
							$_SESSION['notify'][$k]["prod_id"] = $product_id;
							$_SESSION['notify'][$k]["quantity"] = $quantity;
							$_SESSION['notify']['idx']++;

							$page = 'shop.waiting_list';

							return true;
						}
					}
					$_SESSION['cart'][$i]["quantity"] = $quantity;
					$updated_prod++;
				}
			}
		}
		if( !empty( $_SESSION['coupon_discount'] )) {
			// Update the Coupon Discount !!
			$_POST['do_coupon'] = 'yes';
		}
		$_SESSION["cart"]=$_SESSION['cart'];
		return array($updated_prod,$deleted_prod);
	}

	/**
	 * deletes a given product_id from the cart
	 *
	 * @param array $d
	 * @return boolan Result of the deletion
	 */
	function delete($d) {

		$temp = array();
		if( !empty( $d["prod_id"])) {
			$product_id = (int)$d["prod_id"];
		} else {
			$product_id = (int)$d["product_id"];
		}
		$deleted = 0;
		if (!$product_id) {
			$_SESSION['last_page'] = "shop.cart";
			return False;
		}

		$j = 0;
		for ($i=0;$i<$_SESSION['cart']["idx"];$i++) {
			// modified for the advanced attribute modification
			if ( ($_SESSION['cart'][$i]["product_id"] == $product_id )
			&&
			($_SESSION['cart'][$i]["description"] == stripslashes($d["description"]) )
			) {
				$deleted = $_SESSION['cart'][$i]['quantity'];
			}
			if (
			($_SESSION['cart'][$i]["product_id"] != $product_id)
			||
			($_SESSION['cart'][$i]["description"] != stripslashes($d["description"]))
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

		return $deleted;
	}


	/**
	 * Empties the cart
	 * @author pablo
	 * @return boolean true
	 */
	function reset() {
		global $cart;
		$_SESSION['cart'] = array();
		$_SESSION['cart']["idx"]=0;
		$cart = $_SESSION['cart'];
		return True;
	}
}

?>