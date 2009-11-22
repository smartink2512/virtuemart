<?php
/**
 * updatesMigration controller
 *
 * @package	VirtueMart
 * @subpackage updatesMigration
 * @author Max Milbers
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */
 
 defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
 
 class updatesMigrationHelper {
	
//	private $db;
   	public	$storeOwnerId = "62";
	public	$userUserName = "not found";
	public	$userName = "not found";
	public	$oldVersion = "fresh";
	
	
	
    function __construct(){
//			$this->db = &JFactory::getDBO();
			
		}
		
	function determineAlreadyInstalledVersion(){
		$this -> oldVersion = "fresh";
		$db = JFactory::getDBO();
		$db->setQuery( 'SELECT * FROM #__vm_country WHERE `country_id`="1" ');
		if($db->query() == true ) {
			$country1 = $db->loadResult();
			if(isset($country1)){
				$this -> oldVersion = "1.0";
				$db->setQuery( 'SELECT * FROM #__vm_auth_user_group WHERE `user_id`="'.$this -> storeOwnerId.'" ');
				if($db->query() == true ) {
					$authUser = $db->loadResult();
					if(isset($authUser)){
						$this -> oldVersion = "1.1";
						$db->setQuery( 'SELECT * FROM #__vm_menu_admin WHERE `id`= "10" ');
						if($db->query() == true ) {
							$menuAdmin = $db->loadResult();
							if(isset($menuAdmin)){
								$this -> oldVersion = "1.5";
							}
						}
					}
				}
			}
		}
		JError::raiseNotice(1, 'Installed Version '.$this -> oldVersion);
		return;
	}
	

	//Notice: main part of this function should be moved to vendorhelper
	function setStoreOwnerOld($userId=0) {
		
		if(empty($userId)){
			$userId = $this ->determineStoreOwner();
		}
		JError::raiseNotice(1, 'setStoreOwner '.$userId);
		$db = JFactory::getDBO();
		$oldUserId	="";		
		$db->setQuery('SELECT * FROM  `#__vm_auth_user_vendor` WHERE `vendor_id`= "1" ');
		$db->query();
		$oldUserId = $db->loadResult();
//		$insertVendor=false;
		JError::raiseNotice(1, '$oldUserId = '.$oldUserId);
		if(!isset($oldUserId)) {	
			$db->setQuery( 'INSERT `#__vm_auth_user_vendor` (`user_id`, `vendor_id`) VALUES ("'.$userId.'", "1")' );
			if($db->query() == false ) {
				JError::raiseNotice(1, 'setStoreOwner '.$userId.' was not possible to execute INSERT __vm_auth_user_vendor');
			} else {
				JError::raiseNotice(1, 'setStoreOwner INSERT __vm_auth_user_vendor '.$userId);
			}		
		}else{
			$db->setQuery( 'UPDATE `#__vm_auth_user_vendor` SET `user_id` ="'.$userId.'" WHERE `vendor_id` = "1" ');
			if($db->query() == false ) {
				JError::raiseNotice(1, 'setStoreOwner '.$userId.' was not possible to execute UPDATE '.$oldUserId.' query __vm_auth_user_vendor');
			}else{
				JError::raiseNotice(1, 'StoreOwner changed to user with id = '.$userId);
			}
		}
		
		$db->setQuery('SELECT `vendor_id` FROM  `#__vm_vendor` WHERE `vendor_id`= "1" ');
		$db->query();
		$oldVendorId = $db->loadResult();
//		JError::raiseNotice(1, '$oldVendorId = '.$oldVendorId);
		if(empty($oldVendorId)){
			$db->setQuery( 'INSERT `#__vm_vendor` `vendor_id` VALUES ("1")' );
			$db->query();
		}
		
		$db->setQuery( 'UPDATE `#__vm_user_info` SET `user_is_vendor` = "1" WHERE `user_id` ="'.$userId.'"');
//		$db->query();
		if($db->query() === false ) {
			JError::raiseNotice(1, 'setStoreOwner failed Update. User with id = '.$userId.' not found in table');
			return 0;
		}else{
			return $this -> storeOwnerId;
		}
		
	}

	function populateVmDatabase($sqlfile){
	
		// Check that sql files exists before reading. Otherwise raise error for rollback
		if ( !file_exists( JPATH_COMPONENT_ADMINISTRATOR.DS.install.DS.$sqlfile ) ) {
			return false;
		}
		$buffer = file_get_contents(JPATH_COMPONENT_ADMINISTRATOR.DS.install.DS.$sqlfile);

		// Graceful exit and rollback if read not successful
		if ( $buffer == false ) {
			return false;
		}

		// Create an array of queries from the sql file
		jimport('joomla.installer.helper');
		$queries = JInstallerHelper::splitSql($buffer);

		if (count($queries) == 0) {
			// No queries to process
			return 0;
		}
		$db = JFactory::getDBO();
		// Process each query in the $queries array (split out of sql file).
		foreach ($queries as $query)
		{
			$query = trim($query);
			if ($query != '' && $query{0} != '#') {
				$db->setQuery($query);
				if (!$db->query()) {
					JError::raiseWarning(1, 'JInstaller::install: '.JText::_('SQL Error')." ".$db->stderr(true));
					return false;
				}
			}
		}
	}

		
	function installSample($user_id=null){
	
		if($user_id==null){
			$user_id = $this -> storeOwnerId;
		}
		$vmLogIdentifier = 'VirtueMart';

		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS."classes".DS."ps_database.php");
		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS."classes".DS."ps_vendor.php");
		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS."classes".DS."ps_user.php");
		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS."classes".DS."ps_perm.php");
		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS."helpers".DS."vendor_helper.php");
		
		global $perm, $hVendor;
		// Instantiate the permission class
		$perm = new ps_perm();
		$hVendor = new vendor_helper;

		$fields = array();
		
		$fields['address_type'] =  "BT";
		$fields['company'] =  "Washupito''s the User";
		$fields['title'] =  "Sire";
		$fields['last_name'] =  "upito";
		$fields['first_name'] =  "Wash";
		$fields['middle_name'] =  "the cheapest";
		$fields['phone_1'] =  "555-555-555";
		$fields['address_1'] =  "vendorra road 8";
		$fields['city'] =  "Canangra";
		$fields['state'] =  "72";
		$fields['country'] =  "13";
		ps_user::setUserInfoWithEmail($fields,$user_id);

		unset($fields);
		$currencyFields = array();
		$currencyFields[0] = 'EUR';
		$currencyFields[1] = 'USD';
		
		$fields = array();
		$fields['vendor_name'] =  "Washupito";
		$fields['vendor_phone'] =  "555-555-1212";
		$fields['vendor_store_name'] =  "Washupito''s Tiendita";
		$fields['vendor_store_desc'] =  " <p>We have the best tools for do-it-yourselfers.  Check us out! </p> <p>We were established in 1969 in a time when getting good tools was expensive, but the quality was good.  Now that only a select few of those authentic tools survive, we have dedicated this store to bringing the experience alive for collectors and master mechanics everywhere.</p> 		<p>You can easily find products selecting the category you would like to browse above.</p>	";
		$fields['vendor_full_image'] =  "c19970d6f2970cb0d1b13bea3af3144a.gif";
		$fields['vendor_currency '] =  "EUR";
		$fields['vendor_accepted_currencies'] = $currencyFields;
		$fields['vendor_currency_display_style'] =  "1|&euro;|2|,|.|0|0";
		$fields['vendor_terms_of_service'] =  "<h5>You haven''t configured any terms of service yet. Click <a href=administrator/index2.php?page=store.store_form&option=com_virtuemart>here</a> to change this text.</h5>";
		$fields['vendor_url'] = JURI::root();
		
		$fields['vendor_name'] =  "Washupito";
		
		ps_vendor::setVendorInfo($fields,$user_id);
		
		$this -> populateVmDatabase("install_sample_data.sql");
	}
	
}