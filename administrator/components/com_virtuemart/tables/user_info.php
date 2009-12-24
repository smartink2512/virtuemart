<?php
/**
 * User Info Table
 *
 * @package	VirtueMart
 * @subpackage User
 * @author RickG 
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * User Info table class
 * The class is is used to manage the user_info table.
 *
 * @author 	RickG
 * @package	VirtueMart
 */
class TableUser_info extends JTable
{
	/** @var varchar Info Id */
	var $user_info_id				= '';
	/** @var int Primary key */
	var $user_id	  	         	= 0;		
	/** @var tinyint Is the user a vendor? */
	var $user_is_vendor        		= 0;				
	/** @var char Address type */
	var $address_type				= '';
	/** @var varchar Address type name */
	var $address_type_name   		= '';
	/** @var varchar Company */
	var $company   					= '';
	/** @var varchar Title */
	var $title   					= '';
	/** @var varchar Last Name */
	var $last_name			   		= '';
	/** @var varchar First Name */
	var $first_name			  		= '';
	/** @var varchar Middle Name */
	var $middle_name	 	 		= '';
	/** @var varchar Phone 1 */
	var $phone_1			  		= '';
	/** @var varchar Phone 2 */
	var $phone_2			  		= '';	
	/** @var varchar Fax */
	var $fax				   		= '';
	/** @var varchar Addrress line 1 */
	var $address_1					= '';
	/** @var varchar Addrress line 2 */
	var $address_2					= '';		
	/** @var varchar City */
	var $city						= '';
	/** @var varchar State */
	var $state			 	   		= '';
	/** @var varchar Country */
	var $country  					= 'US';
	/** @var varchar Zip */
	var $zip						= '';
	/** @var varchar Extra Field 1 */
	var $extra_field_1 				= '';
	/** @var varchar Extra Field 2 */
	var $extra_field_2 				= '';
	/** @var varchar Extra Field 3 */
	var $extra_field_3 				= '';
	/** @var varchar Extra Field 4 */
	var $extra_field_4 				= '';
	/** @var varchar Extra Field 5 */
	var $extra_field_5				= '';				
	/** @var int Change date */
	var $cdate						= '';
	/** @var int Modified Date */
	var $mdate						= '';	
	/** @var varchar Bank Account Nbr */
	var $bank_account_nr			= '';	
	/** @var varchar Bank_name */
	var $bank_name					= '';	
	/** @var varchar Bank sort code */
	var $bank_sort_code				= '';	
	/** @var varchar Bank iban */
	var $bank_iban					= '';
	/** @var varchar Bank Account Holder */
	var $bank_account_holder		= '';	
	/** @var varchar Bank Account Type */
	var $bank_account_type			= 'Checking';	


	/**
	 * @author RickG
	 * @param $db A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__vm_user_info', 'user_id', $db);
	}


	/**
	 * Validates the user info record fields.
	 *
	 * @author RickG
	 * @return boolean True if the table buffer is contains valid data, false otherwise.
	 */
	function check() 
	{
		
		return true;
	}
	
	
	

}
?>
