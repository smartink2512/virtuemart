<?php
/**
 * Data module for user fields
 *
 * @package	VirtueMart
 * @subpackage Userfields
 * @author RolandD 
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model class for user fields
 *
 * @package	VirtueMart
 * @subpackage Userfields 
 * @author RolandD  
 */
class VirtueMartModelUserfields extends JModel {
	
	/**
	* This function allows you to get an object list of user fields
	*
	* @param string $section The section the fields belong to (e.g. 'registration' or 'account')
	* @param boolean $required_only
	* @param mixed $sys When left empty, doesn't filter by sys
	* @return array
	*/
	public function getUserFields( $section = 'registration', $required_only=false, $sys = '', $exclude_delimiters=false, $exclude_skipfields=false ) {
		$db = JFactory::getDBO();
		
		$q = "SELECT f.* FROM `#__vm_userfield` f"
			. "\n WHERE f.published=1";
		if( $section != 'bank' && $section != '') {
			$q .= "\n AND f.`$section`=1";
		}
		elseif( $section == 'bank' ) {
			$q .= "\n AND f.name LIKE '%bank%'";
		}
		if( $exclude_delimiters ) {
			$q .= "\n AND f.type != 'delimiter' ";
			}
		if( $required_only ) {
			$q .= "\n AND f.required=1";
		}
		if( $sys !== '') {
			if( $sys == '1') { $q .= "\n AND f.sys=1"; }
			elseif( $sys == '0') { $q .= "\n AND f.sys=0"; }
		}
		if( $exclude_skipfields ) {
			$q .= "\n AND FIND_IN_SET( f.name, '".implode(',', $this->getSkipFields())."') = 0 ";
		}
		$q .= "\n ORDER BY f.ordering";
		
		$db->setQuery($q);
		return $db->loadObjectList();
	}
	
	/**
	* Returns an array of fieldnames which are NOT used for VirtueMart tables
	*
	* @return array Field names which are to be skipped by VirtueMart db functions
	*/
	public function getSkipFields() {
		return array( 'username', 'password', 'password2', 'agreed' );
	}
}
?>