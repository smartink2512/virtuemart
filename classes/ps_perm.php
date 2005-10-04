<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: ps_perm.php,v 1.3 2005/09/29 20:01:13 soeren_nb Exp $
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

class ps_perm {

    // Can be easily extended
    // Another permissions array must then
    // be changed in ps_user.php!!
    var $permissions = array(
			   "shopper" 	=>  "1",
			   "demo" 	=>  "2",
			   "storeadmin" =>  "4",
			   "admin" 	=>  "8" 
			);
	
	/**
	* This function does the basic authentication
	* for a user in the shop.
	* It assigns permissions, the name, country, zip  and
	* the shopper group id with the user and the session.
	* @returns array Authentication information
	*/
	function doAuthentication() {
		
		global $shopper_group, $my, $db;
		
		$auth = array();
		
		if (!empty($my->id)) { // user has already logged in
		  
			$auth["user_id"]   = $my->id;
			$auth["username"] = $my->username;
			
			if ($this->is_registered_customer($my->id)) {
			
				$q = "SELECT perms,first_name,last_name,country,zip FROM #__{vm}_user_info WHERE user_id='".$my->id."'";
				$db->query($q);
				$db->next_record();
			
				$auth["perms"]  = $db->f("perms");
				
				$auth["first_name"] = $db->f("first_name");
				$auth["last_name"] = $db->f("last_name");
				$auth["country"] = $db->f("country");
				$auth["zip"] = $db->f("zip");
				
				// Shopper is the default value
				// We must prevent that Administrators or Managers are 'just' shoppers
				if( $auth["perms"] == "shopper" ) {
					if (stristr($my->usertype,"Administrator"))
					  $auth["perms"]  = "admin";
					elseif (stristr($my->usertype,"Manager")) 
					  $auth["perms"]  = "storeadmin";
				}
				$auth["shopper_group_id"] = $shopper_group["shopper_group_id"];
				$auth["shopper_group_discount"] = $shopper_group["shopper_group_discount"];
				$auth["show_price_including_tax"] = $shopper_group["show_price_including_tax"];
				$auth["default_shopper_group"] = $shopper_group["default_shopper_group"];
				$auth["is_registered_customer"] = true;
			}
			
			// user is no registered customer
			else {
				if (stristr($my->usertype,"Administrator"))
				  $auth["perms"]  = "admin";
				elseif (stristr($my->usertype,"Manager")) 
				  $auth["perms"]  = "storeadmin";
				else
				  $auth["perms"]  = "shopper"; // DEFAULT
				$auth["shopper_group_id"] = 0;
				$auth["shopper_group_discount"] = $shopper_group["shopper_group_discount"];
				$auth["show_price_including_tax"] = $shopper_group["show_price_including_tax"];
				$auth["default_shopper_group"] = 1;
				$auth["is_registered_customer"] = false;
			}
			
		} // user is not logged in
		else { 
		  
			$auth["user_id"] = 0;
			$auth["username"] = "demo";
			$auth["perms"]  = "";
			$auth["first_name"] = "guest";
			$auth["last_name"] = "";
			$auth["shopper_group_id"] = $shopper_group["shopper_group_id"];
			$auth["shopper_group_discount"] = $shopper_group["shopper_group_discount"];
			$auth["show_price_including_tax"] = $shopper_group["show_price_including_tax"];
			$auth["default_shopper_group"] = 1;
			$auth["is_registered_customer"] = false;
		}
			
		// register $auth into SESSION
		$_SESSION["auth"] = $auth;
		
		return $auth;
	
	}
	
	/**************************************************************************
	** name: check()
	** created by:
	** description: Validates the permission to do something.
	** parameters:
	** returns
	***************************************************************************/
  
   function check($perms) {

    // Parse all permissions in argument, comma separated
    // It is assumed auth_user only has one group per user.
    
    $auth = $_SESSION["auth"];
    
     if ($perms == "none") {
        return True;
     }
     else {
       $p1 = explode(",", $auth['perms']);
       $p2 = explode(",", $perms);
       while (list($key1, $value1) = each($p1)) {
         while (list($key2, $value2) = each($p2)) {
           if ($value1 == $value2) {
             return True;
           }
         }
       }
     }
     return False;    
        
    }
	
	function hasHigherPerms( $perm ) {
		$auth = $_SESSION["auth"];
		
		if( $perm ) {
			if( $this->permissions[$perm] <= $this->permissions[$auth['perms']] )
				return true;
			else
				return false;		
		}
		else
			return false;
	}
  /**************************************************************************
  ** name: is_registered_customer()
  ** created by: soeren
  ** description: Validates if someone is registered customer.
  **            by checking if one has a billing address
  ** parameters: user_id
  ** returns: true if the user has a BT address
  **          false if the user has none
  ***************************************************************************/
  function is_registered_customer($user_id) {
    global $auth, $page, $func;
    
    if( @is_bool( $auth["is_registered_customer"]) && ($page!="checkout.index" && $func!="shopperupdate")) {
      return $auth["is_registered_customer"];
    }
    else {
      $db_check = new ps_DB;
      $q  = "SELECT id from #__users, #__{vm}_user_info WHERE id='" . $user_id . "' AND id=user_id AND address_type='BT'";
      $db_check->query($q);
      // Query failed or not?
      if ($db_check->num_rows()) 
          return true;
      else        
          return false;
    }
  }
  
  
}

?>
