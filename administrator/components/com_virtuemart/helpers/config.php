<?php
/**
 * Configuration menu helper class
 *
 * This class provides access to configuration settings throughout the VirtueMart shop.
 *
 * @package	VirtueMart
 * @subpackage Helpers
 * @author Rick Glunt
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * Configuration helper
 *
 * @package		VirtueMart
 * @subpackage 	Helpers
 * @author Rick Glunt 
 */
class ConfigHelper
{
	
	/**
	 * Retireve a configuraion value from the database.
	 * 
     * @author Rick Glunt	 
     * @param string $key Configuration key to read
	 * @return object Value for the given key.
	 */
	function getConfigValue($key='')
	{		
		$db =& JFactory::getDBO();	
		
		$query = 'SELECT `#__vm_config`.`' . $key . '` FROM `#__vm_config`';
		$db->setQuery($query);
		$result = $db->loadObject();						
		return $result->$key;
	}


}
?>