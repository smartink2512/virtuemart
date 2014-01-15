<?php
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @author Sören
* @author Max Milbers
* @copyright Copyright (C) 2010-2011 Virtuemart Team - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.org
*/

/**
 * The permission handler class for VirtueMart.
 *
 * @todo Further cleanup
 */
class Permissions extends JObject{

	/** @var array Contains all the user groups */
	var $_user_groups;

	/** @var virtuemart_user_id for the permissions*/
	var $_virtuemart_user_id;		//$auth['virtuemart_user_id']

	var $_show_prices; //$auth['show_prices']

	var $_db;

	private $_perms = 'shopper';

	var $_is_registered_customer;

	private $_vendorId = null;

	static $_instance;

	public function __construct() {

		$this->_db = JFactory::getDBO();

 		$this->_perms = $this->doAuthentication();

	}

	static public function getInstance() {
		if(!is_object(self::$_instance)){
			self::$_instance = new Permissions();
		}else {

		}
 		return self::$_instance;
    }


	/**
	 * Get permissions for a user ID
	 *
	 * @param int $virtuemart_user_id the user ID to check. If no user ID is given the currently logged in user will be used.
	 * @return string permissions
	 */
	public function getPermissions ($userId=null) {
		// default to current user
		if ($userId == null) {
			$user = JFactory::getUser();
			$userId = $user->id;
		}

		// only re-run authentication if we have a different user
		//vmdebug('getPermissions',$this->_virtuemart_user_id,$userId);
		if ($userId != $this->_virtuemart_user_id) {
			$perms = $this->doAuthentication($userId);
		} else {
			$perms = $this->_perms;
		}
		return $perms;
	}



	/**
	* This function does the basic authentication
	* for a user in the shop.
	* It assigns permissions, the name, country, zip  and
	* the shopper group id with the user and the session.
	* @return array Authentication information
	*/
	function doAuthentication ($user_id=null) {

		$this->_db = JFactory::getDBO();
		$session = JFactory::getSession();
		$user = JFactory::getUser($user_id);

		if (VmConfig::get('vm_price_access_level') != '') {
			// Is the user allowed to see the prices?
			$this->_show_prices  = $user->authorise( 'virtuemart', 'prices' );
		}
		else {
			$this->_show_prices = 1;
		}

		if(!empty($user->id)){
			$this->_virtuemart_user_id   = $user->id;
			$q = 'SELECT `perms` FROM #__virtuemart_vmusers
					WHERE virtuemart_user_id="'.(int)$this->_virtuemart_user_id.'"';
			$this->_db->setQuery($q);
			$perm = $this->_db->loadResult();

			//We must prevent that Administrators or Managers are 'just' shoppers
			//TODO rewrite it working correctly with jooomla ACL
			if(JVM_VERSION > 1 ){
				if($user->authorise('core.admin')){
					$perm  = 'admin';
				}
			} else {
				if(strpos($user->usertype,'Administrator')!== false){
					$perm  = 'admin';
				}
			}

			if(empty($perm)){

				if(JVM_VERSION > 1 ){
					if($user->groups){
						if($user->authorise('core.admin')){
							$perm  = 'admin';
						} else if($user->authorise('core.manage')){
							$perm  = 'storeadmin';
						} else {
							$perm  = 'shopper';
						}
					} else {
						$perm  = 'shopper';
					}

				} else {
					if(strpos($user->usertype,'Administrator')!== false){
						$perm  = 'admin';
					} else if(strpos($user->usertype,'Manager')!== false){
						$perm  = 'storeadmin';
					} else {
						$perm  = 'shopper';
					}
				}

			}

			$this->_is_registered_customer = true;
		} else {

			$this->_virtuemart_user_id = 0;
			$perm  = 'shopper';
			$this->_is_registered_customer = false;
		}

		return $perm;
	}

	/**
	 * Validates the permission to do something.
	 *
	 * @param string $perms
	 * @return boolean Check successful or not
	 * @example $perm->check( 'admin,storeadmin' );
	 * 			returns true when the user is admin or storeadmin
	 */
	public function check($perms,$acl=0) {
		/* Set the authorization for use */

		// Parse all permissions in argument, comma separated
		// It is assumed auth_user only has one group per user.
			$p1 = explode(",", $this->_perms);
			$p2 = explode(",", $perms);
// 			vmdebug('check '.$perms,$p1,$p2);
			while (list($key1, $value1) = each($p1)) {
				while (list($key2, $value2) = each($p2)) {
					if ($value1 == $value2) {
						return true;
					}
				}
			}
		return false;
	}

	/**
	 * Checks if user is admin or has vendorId=1,
	 * if superadmin, but not a vendor it gives back vendorId=1 (single vendor, but multiuser administrated)
	 *
	 * @author Mattheo Vicini
	 * @author Max Milbers
	 */

	public function isSuperVendor(){

		if($this->_vendorId===null){
			$user = JFactory::getUser();

			if(!empty( $user->id)){
				$q='SELECT `virtuemart_vendor_id` FROM `#__virtuemart_vmusers` `au`
				WHERE `au`.`virtuemart_user_id`="' .$user->id.'" AND `au`.`user_is_vendor` = "1" ';

				$db= JFactory::getDbo();
				$db->setQuery($q);
				$virtuemart_vendor_id = $db->loadResult();
				if($user->authorise('core.admin')){
					vmdebug('isSuperVendor',$virtuemart_vendor_id);
				}

				if ($virtuemart_vendor_id) {
					$this->_vendorId = $virtuemart_vendor_id;
				} else {
					if($this->check('admin,storeadmin') ){
						$this->_vendorId = 1;
					}
				}
			} else {
				$this->_vendorId = 0;

			}

		}
		return $this->_vendorId;

	}


}

//pure php no closing tag