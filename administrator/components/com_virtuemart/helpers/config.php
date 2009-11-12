<?php
/**
 * Configuration helper class
 *
 * This class provides some functions that are used throughout the VirtueMart shop to access confgiuration values.
 *
 * @package	VirtueMart
 * @subpackage Helpers
 * @author RickG
 * @copyright Copyright (c) 2004-2008 Soeren Eberhardt-Biermann, 2009 VirtueMart Team. All rights reserved.
 */

class VmConfig {
	/**
	 * Load the configuration values from the INI file into a local variable.
	 *
	 * @author RickG
	 */
	function loadConfig() {   	
		$ini_array = parse_ini_file(JPATH_COMPONENT_ADMINISTRATOR.DS.'vm.ini');
		JRequest::setVar('vmconfig', $ini_array);
	}
	
	
	/**
	 * Find the configuration value for a given key
	 *
	 * @author RickG
	 * @param string $key Key name to lookup
	 * @return Value for the given key name
	 */	
	function getVar($key = '')
	{
		$value = '';
		if ($key) {
			$config = JRequest::getVar('vmconfig', '');
			if ($config) {
				$value = $config[$key];
			}
		}	
		
		return $value;
	}
	
}
?>
