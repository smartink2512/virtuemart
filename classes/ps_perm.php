<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: ps_perm.php,v 1.10 2005/11/12 08:32:08 soeren_nb Exp $
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
	 * HERE WE INSERT GROUPS THAT ARE ALLOWED TO VIEW PRICES
	 *
	 */
	function prepareACL() {
		global $acl;
		// The basic ACL integration in Mambo/Joomla is not awesome
		$child_groups = gacl_api::_getBelow( '#__core_acl_aro_groups', 'g1.group_id, g1.name, COUNT(g2.name) AS level',	'g1.name', null, VM_PRICE_ACCESS_LEVEL );
		foreach( $child_groups as $child_group ) {
			$acl->_mos_add_acl( 'virtuemart', 'prices', 'users', $child_group->name, null, null );
		}
		$admin_groups = gacl_api::_getBelow( '#__core_acl_aro_groups', 'g1.group_id, g1.name, COUNT(g2.name) AS level',	'g1.name', null, 'Public Backend' );
		foreach( $admin_groups as $child_group ) {
			$acl->_mos_add_acl( 'virtuemart', 'prices', 'users', $child_group->name, null, null );
		}
	}
	/**
	* This function does the basic authentication
	* for a user in the shop.
	* It assigns permissions, the name, country, zip  and
	* the shopper group id with the user and the session.
	* @return array Authentication information
	*/
	function doAuthentication( $shopper_group ) {

		global $my, $acl;
		$db = new ps_DB;
		$auth = array();
		
		$this->prepareACL();
		
		if( $my->id > 0 ) {
			$db->query( 'SELECT name FROM #__core_acl_aro_groups WHERE group_id=\''.$my->gid.'\'' );
			$db->next_record();
			$my->usertype = $db->f( 'name' );
		}
		else {
			$my->usertype = 'Public Frontend';
		}
		
		$auth['show_prices']  = $acl->acl_check( 'virtuemart', 'prices', 'users', strtolower($my->usertype), null, null );

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

	/**
	 * Validates the permission to do something.
	 *
	 * @param string $perms
	 * @return boolean Check successful or not
	 * @example $perm->check( 'admin', 'storeadmin' );
	 * 			returns true when the user is admin or storeadmin
	 */
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
	/**
	 * Checks if the user has higher permissions than $perm
	 *
	 * @param string $perm
	 * @return boolean
	 * @example $perm->hasHigherPerms( 'storeadmin' );
	 * 			returns true when user is admin
	 */
	function hasHigherPerms( $perm ) {
		$auth = $_SESSION["auth"];

		if( $this->permissions[$perm] <= $this->permissions[$auth['perms']] ) {
			return true;	
		}
		else {
			return false;
		}
	
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
	/**
	 * Check if a user is registered in the shop (=customer)
	 *
	 * @param int $user_id
	 * @return boolean
	 */
	function is_registered_customer($user_id) {
		global $page, $func, $auth;
		/**
		if( @is_bool( $auth["is_registered_customer"]) && ($page!="checkout.index" && strtolower($func)!="shopperupdate")) {
			return $auth["is_registered_customer"];
		}
		else {
		*/
			$db_check = new ps_DB;
			$q  = "SELECT id, user_id from #__users, #__{vm}_user_info WHERE id='" . $user_id . "' AND id=user_id AND address_type='BT' AND first_name != '' AND last_name != '' AND city != ''";
			$db_check->query($q);
			
			// Query failed or not?
			if ($db_check->num_rows() > 0) {
				return true;
			}
			else {
				return false;
			}
		//}
	}


}

?>
