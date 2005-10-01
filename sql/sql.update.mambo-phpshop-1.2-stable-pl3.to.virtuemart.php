<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage core
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

// RENAME all mambo-phpShop tables used by this site
$database->setQuery( 'SHOW TABLES LIKE \'#__vm_%\'' );
$tables = $database->loadObjectList();
foreach( $tables as $pshop_table ) {
	foreach (get_object_vars($pshop_table) as $k => $v) {
		if( substr( $k, 0, 1 ) != '_' ) {			// internal attributes of an object are ignored
			$vm_table = str_replace( '_vm_', '_vm_', $v );
			$database->setQuery( 'ALTER TABLE `'.$v.'` RENAME `'.$vm_table.'` ;' );
			if( !$database->query() )
				$messages[] = "Failed renaming table $v to $vm_table";
			else
				$messages[] = "Successfully renamed table $v to $vm_table";
		}
	}
}
		
$db->query( 'SELECT file_name FROM `#__{vm}_product_files`' );
$files_to_copy = $db->record;
foreach( $files_to_copy as $file ) {
	if( stristr( $file, 'com_phpshop' ) ) {
		$newFile = str_replace( 'com_phpshop', 'com_virtuemart' );
		copy( $file, $newFile );
	}
}

// REPLACE 'com_phpshop' with 'com_virtuemart' for file references
// in the table mos_vm_product_files
$db->query( "UPDATE `#__{vm}_product_files` SET 
file_name = REPLACE (file_name ,'com_phpshop','com_virtuemart'), 
file_url = REPLACE (file_url  ,'com_phpshop','com_virtuemart')";

$db->query( "ALTER TABLE #__{vm}_user_info ADD `bank_account_nr` varchar(32) NOT NULL;" );
$db->query( "ALTER TABLE #__{vm}_user_info ADD `bank_name` varchar(32) NOT NULL;" );
$db->query( "ALTER TABLE #__{vm}_user_info ADD `bank_sort_code` varchar(16) NOT NULL;" );
$db->query( "ALTER TABLE #__{vm}_user_info ADD `bank_iban` varchar(64) NOT NULL;" );
$db->query( "ALTER TABLE #__{vm}_user_info ADD `bank_account_holder` varchar(48) NOT NULL;" );
$db->query( "ALTER TABLE #__{vm}_user_info ADD `bank_account_type` ENUM( 'Checking', 'Business Checking', 'Savings' ) DEFAULT 'Checking' NOT NULL;" ); 

$q  = "SELECT * from #__users WHERE id='" . $user_id . "' AND address_type='BT'";
$db->query( $q );
$registered_users = $db->record;

foreach( $registered_users as $u ) {
	$q = "INSERT INTO `#__{vm}_user_info` 
		(`user_info_id`, `user_id`, `user_email`, `address_type`, `address_type_name`, `company`, `title`, `last_name`, `first_name`, `middle_name`, `phone_1`, `phone_2`, `fax`, `address_1`, `address_2`, `city`, `state`, `country`, `zip`, `extra_field_1`, `extra_field_2`, `extra_field_3`, `extra_field_4`, `extra_field_5`, `perms`, `bank_account_nr`, `bank_name`, `bank_sort_code`, `bank_iban`, `bank_account_holder`, `bank_account_type`, `cdate`, `mdate`)
		VALUES
		('".$u->user_info_id."','".$u->id."', '".$u->email."', 'BT','','".$u->company."','".$u->title."','".$u->last_name."','".$u->first_name."','".$u->middle_name."','".$u->phone_1."','".$u->phone_2."','".$u->fax."','".$u->address_1."','".$u->address_2."','".$u->city."','".$u->state."','".$u->country."','".$u->extra_field_1."','".$u->extra_field_2."','".$u->extra_field_3."','".$u->extra_field_4."','".$u->extra_field_5."','".$u->perms."','".$u->bank_account_nr."','".$u->bank_name."','".$u->bank_sort_code."','".$u->bank_iban."','".$u->bank_account_holder."','".$u->bank_account_type."', UNIX_TIMESTAMP( '".$u->registerDate."' ), UNIX_TIMESTAMP( '".$u->lastvisitDate."' ));";
	$db->query( $q );
}

$db->query( 'ALTER TABLE `#__users` DROP `user_info_id`;' );
$db->query( 'ALTER TABLE `#__users` DROP `address_type`;' );
$db->query( 'ALTER TABLE `#__users` DROP `address_type_name`;' );
$db->query( 'ALTER TABLE `#__users` DROP `company`;' );
$db->query( 'ALTER TABLE `#__users` DROP `title`;' );
$db->query( 'ALTER TABLE `#__users` DROP `last_name`;' );
$db->query( 'ALTER TABLE `#__users` DROP `first_name`;' );
$db->query( 'ALTER TABLE `#__users` DROP `middle_name`;' );
$db->query( 'ALTER TABLE `#__users` DROP `phone_1`;' );
$db->query( 'ALTER TABLE `#__users` DROP `phone_2`;' );
$db->query( 'ALTER TABLE `#__users` DROP `fax`;' );
$db->query( 'ALTER TABLE `#__users` DROP `address_1`;' );
$db->query( 'ALTER TABLE `#__users` DROP `address_2`;' );
$db->query( 'ALTER TABLE `#__users` DROP `city`;' );
$db->query( 'ALTER TABLE `#__users` DROP `state`;' );
$db->query( 'ALTER TABLE `#__users` DROP `country`;' );
$db->query( 'ALTER TABLE `#__users` DROP `zip`;' );
$db->query( 'ALTER TABLE `#__users` DROP `extra_field_1`;' );
$db->query( 'ALTER TABLE `#__users` DROP `extra_field_2`;' );
$db->query( 'ALTER TABLE `#__users` DROP `extra_field_3`;' );
$db->query( 'ALTER TABLE `#__users` DROP `extra_field_4`;' );
$db->query( 'ALTER TABLE `#__users` DROP `extra_field_5`;' );
$db->query( 'ALTER TABLE `#__users` DROP `perms`;' );
$db->query( 'ALTER TABLE `#__users` DROP `bank_account_nr`;' );
$db->query( 'ALTER TABLE `#__users` DROP `bank_account_type`;' );
$db->query( 'ALTER TABLE `#__users` DROP `bank_name`;' );
$db->query( 'ALTER TABLE `#__users` DROP `bank_sort_code`;' );
$db->query( 'ALTER TABLE `#__users` DROP `bank_iban`;' );
$db->query( 'ALTER TABLE `#__users` DROP `bank_account_holder`;' );
?>