<?php
/**
 * VirtueMart installation file.
 *
 * This installation file is executed after the XML manifest file is complete.
 * This installation function extracts some of the frontend and backend files
 * need for this component.
 *
 * @author Rick Glunt, Max Milbers
 * @package VirtueMart
 */
defined('_JEXEC') or die('Restricted access');

global $option;

function com_installSampleData($user_id){
	
		$backendPath = JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'; 
			//Add store information
		require_once($backendPath.DS."virtuemart.cfg.php" );
		require_once($backendPath.DS."classes".DS."vmAbstractObject.class.php");
		require_once($backendPath.DS."classes".DS."ps_main.php");
		$vmLogIdentifier = 'VirtueMart';
		require_once($backendPath.DS."classes".DS."Log".DS."LogInit.php");

		require_once($backendPath.DS."classes".DS."ps_database.php");
		require_once($backendPath.DS."classes".DS.'ps_vendor.php');
		require_once($backendPath.DS."classes".DS.'ps_user.php');
		require_once($backendPath.DS."classes".DS."ps_perm.php");
		require_once($backendPath.DS."helpers".DS."vendor_helper.php");
		
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
		
		ps_vendor::setVendorInfo($fields,1,$user_id);
		
		$db = JFactory::getDBO();
		$dbsample = $backendPath.DS.'install'.DS.'install_sample_data.sql';
		require_once($backendPath.DS.'install'.DS.'helper.php');
		$result = JInstallationHelper::populateDatabase($db, $dbsample, $errors);
		
		
		/*
		 * prepare sql error messages if returned from populate
		 */
		if (!is_null($errors)){
			foreach($errors as $error){
				$msg .= stripslashes( $error['msg'] );
				$msg .= chr(13)."-------------".chr(13);
				$txt = '<textarea cols="35" rows="5" name="instDefault" readonly="readonly" >'.('Database Errors Reported').chr(13).$msg.'</textarea>';
			}
			echo('Installer Result: '.$txt);
			return false;
		} else {
			// consider other possible errors from populate
			$msg = $result == 0 ? ("Sample data installed successfully") : ("Error installing SQL script") ;
			$txt = '<input size="35" name="instDefault" value="'.$msg.'" readonly="readonly" />';
			echo('Installer Result: '.$txt);
			return true;
		}
		
}

function com_install(){
    @ini_set( 'memory_limit', '32M' );   
    
    //Must be adjusted to the given data
    $sampleData = true;
    
    echo('Start with VirtueM installation script </br>');
    $frontendPath = JPATH_ROOT.DS.'components'.DS.'com_virtuemart';
    $backendPath = JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart';    
    $installOk = true;

	$db = JFactory::getDBO();
	
    //Handles the ID of the shopowner, here set to the logged in joomla user
	/**
	 * You wonder why users are visible in VirtueMart after installation?
	 * Well, because we add them here.
	 */
	$db->setQuery( "SELECT `id`, `registerDate`, `lastvisitDate` FROM `#__users`"); 
	$row = $db->loadObjectList();
	
	foreach( $row as $user) {
	?><pre><?php //print_r($user); ?></pre><?php
	echo (' </br>');
		$db->setQuery( "INSERT INTO `#__jmart_shopper_vendor_xref` VALUES ('".$user->id."', '1', '5', '')" );
		$db->query();
		$db->setQuery( "INSERT INTO `#__jmart_user_info` (`user_info_id`,`user_id`, `address_type`,`cdate`,`mdate` )
						VALUES( '".md5(uniqid('virtuemart'))."','".$user->id."','BT', UNIX_TIMESTAMP('".$user->registerDate."'),UNIX_TIMESTAMP('".$user->lastvisitDate."'))" );
		$db->query();
	}

	# Set Admin Xref to vendor_id = 1
	$user = JFactory::getUser();
	$userId = $user->id;
	$userUserName = $user->username;
	$userName = $user->name;
	$db->setQuery( 'INSERT `#__jmart_auth_user_vendor` (`user_id`, `vendor_id`) VALUES ("'.$userId.'", "1")' );
	$db->query();
	$db->setQuery( "UPDATE `#__jmart_user_info` SET `user_is_vendor` = '1' WHERE `user_id` ='".$userId."' ") ;
	$db->query();
//	echo('ID of Storeadmin: '.$userId. '  </br>');
	 
	# insert the user <=> group relationship
	$db->setQuery( "INSERT INTO `#__jmart_auth_user_group` 
				SELECT user_id, 
					CASE `perms` 
					    WHEN 'admin' THEN 0
					    WHEN 'storeadmin' THEN 1
					    WHEN 'shopper' THEN 2
					    WHEN 'demo' THEN 3
					    ELSE 2 
					END
				FROM #__jmart_user_info
				WHERE address_type='BT' ");
	$db->query();
	
	$db->setQuery( "UPDATE `#__jmart_auth_user_group` SET `group_id` = '0' WHERE `user_id` ='".$userId."' ") ;
	$db->query();
	
	if($sampleData){
		$installOk = com_installSampleData($userId);

	}
	
//		$installation = "new";
//		JError::raiseNotice(1, 'Installer $msg '.$msg.' und $txt: '.$txt);
//		$this->setNotice(JText::_('Installer $msg '.$msg.' und $txt: '.$txt));
		
//        processSqlFile($backendPath.DS.'install'.DS.'install_required_data.sql');         
//        JError::raiseNotice('Processed required SQL data ');
//        	$this->setNotice(JText::_('Couldnt find file '.$filename));
//        // For now, just install sample data
//        processSqlFile($backendPath.DS.'install'.DS.'install_sample_data.sql');
//        JError::raiseNotice('Processed sample SQL data ');
//       	$this->setNotice(JText::_('Couldnt find file '.$filename));
//   }else{
//			$installation = "jm_update";
//		}  

    
    if ($installOk) {
        include($backendPath.DS.'install'.DS.'install.virtuemart.html.php');
    }
    
    return $installOk;
}



?>