<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: ps_perm.php,v 1.7 2005/09/01 19:58:06 soeren_nb Exp $
* @package mambo-phpShop
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
	
	
	function doAuthentication() {
		
		global $shopper_group, $my, $db;
		
		$auth = array();
		
		if (!empty($my->id)) { // user has already logged in
		  
			$auth["user_id"]   = $my->id;
			$auth["username"] = $my->username;
			
			if ($this->is_registered_customer($my->id)) {
			
				$q = "SELECT perms,first_name,last_name,country,zip FROM #__users WHERE id='".$my->id."'";
				$db->query($q);
				$db->next_record();
			
				switch ($db->f("perms")) {
					case "admin": 
						$auth["perms"]  = "admin";
						break;
					case "storeadmin":
						$auth["perms"]  = "storeadmin";
						break;
					case "shopper":
						$auth["perms"]  = "shopper";
						break;
					case "demo":
						$auth["perms"]  = "demo";
						break;
				}
				$auth["first_name"] = $db->f("first_name");
				$auth["last_name"] = $db->f("last_name");
				$auth["country"] = $db->f("country");
				$auth["zip"] = $db->f("zip");
				
				if (stristr($my->usertype,"Administrator"))
				  $auth["perms"]  = "admin";
				elseif (stristr($my->usertype,"Manager")) 
				  $auth["perms"]  = "storeadmin";
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
      $q  = "SELECT id from #__users WHERE id='" . $user_id . "' AND address_type='BT'";
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
