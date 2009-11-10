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
	/** @var objectlist Country data */
    var $_data;  
	
	
    /**
     * Constructor for the configuration helper.
     *
     * The configuration values are read and stored in a local variable.
     *
     * @author Rick Glunt 
     */
    function __construct()
    {
    	$this->_data = JRequest::getVar('vmconfig', '');
    	
    	// Load the configuration if not aleady loaded.
        if (empty($this->_data)) {
			$this->loadConfig();        	
		}
		
		$this->loadConfig();
    }	
	
	
	/**
	 * Load the configuration values from the DB into a local variable.
	 *
	 * @author RickG
	 */
	function loadConfig() {
    	$this->_data = JRequest::getVar('vmconfig', '');
    	
    	// Load the configuration if not aleady loaded.
        if (empty($this->_data)) {
			$db = JFactory::getDBO();	
		
			$query = 'SELECT * FROM `#__vm_config`';
			$db->setQuery($query);		
			$this->_data = $db->loadObjectList();
		}
	}
	
	
	function getVar($key = '')
	{
    	// Load the configuration if not aleady loaded.
        if (empty($this->_data)) {
			VmConfig::loadConfig();        	
		}		
		
		$value = '';
		if ($key) {
			$value = $this->_data[$key];
		}	
		
		return $value;
	}
	
}
?>
