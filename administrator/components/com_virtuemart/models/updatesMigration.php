<?php
/**
 * Data module for shop countries
 *
 * @package	VirtueMart
 * @subpackage Country
 * @author Rick Glunt 
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model class for shop countries
 *
 * @package	VirtueMart
 * @subpackage Country 
 * @author Rick Glunt  
 */
class VirtueMartModelUpdatesMigration extends JModel
{    
	/** @var integer Primary key */
    var $_id;          
	/** @var objectlist Country data */
    var $_data;        
	/** @var integer Total number of countries in the database */
	var $_total;      
	/** @var pagination Pagination for country list */
	var $_pagination;    
    
    
    /**
     * Constructor for the country model.
     *
     * The country id is read and detmimined if it is an array of ids or just one single id.
     *
     * @author Rick Glunt 
     */
    function __construct()
    {
        parent::__construct();

		$mainframe = JFactory::getApplication() ;
    }
    
    
	function execSQLFile($filename) 
	{ 
		$db = JFactory::getDBO();   	     
		$content = file_get_contents($filename);             
    	$file_content = explode("\n",$content);    
    	      
   		// Parsing the SQL file content    	      
    	$query = "";                       
    	foreach($file_content as $sql_line) {        
    		if(trim($sql_line) != "" && strpos($sql_line, "--") === false) {              
        		$query .= $sql_line; 
            	// Checking whether the line is a valid statement 
            	if(preg_match("/(.*);/", $sql_line)) { 
            		$query = substr($query, 0, strlen($query)-1);                                   
					$db->setQuery($query);
        			if (!$db->query()){
						$installOk = false;
            			break;
        			}                     
                	$query = ""; 
            	} 
        	} 
    	}        
    	return true; 
	}    
	
	
	/**
	 * Add existing Joomla users into the Virtuemart database.
	 */
	function integrateJoomlaUsers()
	{
		$db = JFactory::getDBO();
		$query = "SELECT `id`, `registerDate`, `lastvisitDate` FROM `#__users`";
		$db->setQuery($query);
		$row = $db->loadObjectList();
	
		foreach ($row as $user) {
			$query = "INSERT INTO `#__vm_shopper_vendor_xref` VALUES ('" . $user->id . "', '1', '5', '')"; 
			$db->setQuery($query);
			if (!$db->query()) {
				JError::raiseNotice(1, 'integrateJUsers INSERT '.$user->id.' INTO #__vm_shopper_vendor_xref FAILED' );
			}
			
			$query = "INSERT INTO `#__vm_user_info` (`user_info_id`, `user_id`, `address_type`, `cdate`, `mdate`) ";
			$query .= "VALUES( '" . md5(uniqid('virtuemart')) . "', '" . $user->id . "', 'BT', UNIX_TIMESTAMP('" . $user->registerDate . "'), UNIX_TIMESTAMP('" . $user->lastvisitDate."'))";
			$db->setQuery($query);
			if (!$db->query()) {
				JError::raiseNotice(1, 'integrateJUsers INSERT '.$user->id.' INTO #__vm_user_info FAILED' );
			}
		}
	}	
	
	
	function determineStoreOwner(){
		global $hVendor;
		if(empty($hVendor)){
			require_once(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'vendor_helper.php');
			$hVendor = new vendor_helper;
		}
		$vendorid= 1;
		$user_id = $hVendor->getUserIdByVendorId($vendorid);
		if(isset($user_id)){
			$user = JFactory::getUser($user_id);
		}else{
			$user = JFactory::getUser();
		}
		
		$id = $user -> id;
		$this -> storeOwnerId = $id;
		$this -> userUserName = $user->username;
		$this -> userName = $user->name;
		return $id;
	}
	
	
	function setStoreOwner($userId=0){
		
		if(empty($userId)){
			$userId = $this ->determineStoreOwner();
		}
		
		$oldUserId	= "";
		$oldVendorId = "";
		
		$db = JFactory::getDBO();
		
		$db->setQuery('SELECT * FROM  `#__vm_auth_user_vendor` WHERE `vendor_id`= "1" ');
		$db->query();
		$oldVendorId = $db->loadResult();
//		JError::raiseNotice(1, '$oldVendorId = '.$oldVendorId);
		
		$db->setQuery('SELECT * FROM  `#__vm_auth_user_vendor` WHERE `user_id`= "'.$userId.'" ');
		$db->query();
		$oldUserId = $db->loadResult();
//		JError::raiseNotice(1, '$oldUserId = '.$oldUserId);
		
		if(!isset($oldVendorId) && !isset($oldUserId)){
			$db->setQuery( 'INSERT `#__vm_auth_user_vendor` (`user_id`, `vendor_id`) VALUES ("'.$userId.'", "1")' );
			if($db->query() == false ) {
				JError::raiseNotice(1, 'setStoreOwner '.$userId.' was not possible to execute INSERT __vm_auth_user_vendor');
			} else {
				JError::raiseNotice(1, 'setStoreOwner INSERT __vm_auth_user_vendor '.$userId);
			}			
		}else{
			if(!isset($oldUserId)) {
				$db->setQuery( 'UPDATE `#__vm_auth_user_vendor` SET `user_id` ="'.$userId.'" WHERE `vendor_id` = "1" ');
			}else{
				$db->setQuery( 'UPDATE `#__vm_auth_user_vendor` SET `vendor_id` = "1" WHERE `user_id` ="'.$userId.'" ');
			}
			if($db->query() == false ) {
				
			}
		}
	
		$db->setQuery('SELECT `vendor_id` FROM  `#__vm_vendor` WHERE `vendor_id`= "1" ');
		$db->query();
		$oldVendorId = $db->loadResult();
//		JError::raiseNotice(1, '$oldVendorId = '.$oldVendorId);
		if(!isset($oldVendorId)){
			$db->setQuery( 'INSERT INTO `#__vm_vendor` (
										`vendor_id` ,
										`vendor_name` ,
										`vendor_phone` ,
										`vendor_store_name` ,
										`vendor_store_desc` ,
										`vendor_category_id` ,
										`vendor_thumb_image` ,
										`vendor_full_image` ,
										`vendor_currency` ,
										`cdate` ,
										`mdate` ,
										`vendor_image_path` ,
										`vendor_terms_of_service` ,
										`vendor_url` ,
										`vendor_min_pov` ,
										`vendor_freeshipping` ,
										`vendor_currency_display_style` ,
										`vendor_accepted_currencies` ,
										`vendor_address_format` ,
										`vendor_date_format`
				) VALUES (
"1", NULL , NULL , "", NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , "", "", NULL , "0.00", "", "", "", "");' );
		} else {
		//	$db->setQuery( 'UPDATE INTO `#__vm_vendor` SET `vendor_id` VALUES ("1")' );
		}
		$db->query();
		
		$db->setQuery( 'UPDATE `#__vm_user_info` SET `user_is_vendor` = "1" WHERE `user_id` ="'.$userId.'"');
//		$db->query();
		if($db->query() === false ) {
			JError::raiseNotice(1, 'setStoreOwner failed Update. User with id = '.$userId.' not found in table');
			return 0;
		}else{
			return $this -> storeOwnerId;
		}
	
	}	
	
	
	function setUserToShopperGroup(){
		# insert the user <=> group relationship
		$db = JFactory::getDBO();
		$db->setQuery( "INSERT INTO `#__vm_auth_user_group` 
				SELECT user_id, 
					CASE `perms` 
					    WHEN 'admin' THEN 0
					    WHEN 'storeadmin' THEN 1
					    WHEN 'shopper' THEN 2
					    WHEN 'demo' THEN 3
					    ELSE 2 
					END
				FROM #__vm_user_info
				WHERE address_type='BT' ");
		$db->query();
	
		$db->setQuery( "UPDATE `#__vm_auth_user_group` SET `group_id` = '0' WHERE `user_id` ='".$this -> userId."' ") ;
		$db->query();
	}	
}
?>