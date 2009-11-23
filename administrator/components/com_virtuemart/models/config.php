<?php
/**
 * Data module for shop configuration
 *
 * @package	VirtueMart
 * @subpackage Config
 * @author RickG 
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model');

/**
 * Model class for shop configuration
 *
 * @package	VirtueMart
 * @subpackage Config 
 * @author RickG  
 */
class VirtueMartModelConfig extends JModel
{    
	/**
	 * Retrieve a list of themes from the themes directory.
	 * 
     * @author RickG	 
	 * @return object List of theme objects
	 */
	function getThemeList()
	{		
		$dir = JPATH_ROOT.DS.'components'.DS.'com_virtuemart'.DS.'themes';
		$result = '';
		
		if ($handle = opendir($dir)) {
    		while (false !== ($file = readdir($handle))) {
    			if ($file != "." && $file != ".." && $file != '.svn') {
    				if (filetype($dir.DS.$file) == 'dir') {
    					$result[] = JHTML::_('select.option', $file, JText::_($file));
        			}
        		}
    		}
		}
		
		return $result;
	}
	
	
	/**
	 * Retrieve a list of category templates from the templates directory.
	 * 
     * @author RickG	 
	 * @return object List of template objects
	 */
	function getTemplateList()
	{		
		$dir = JPATH_ROOT.DS.'components'.DS.'com_virtuemart'.DS.'themes';
		$dir .= DS.VmConfig::getVar('theme').DS.'templates'.DS.'browse';		
		$result = '';
		
		if ($handle = opendir($dir)) {
    		while (false !== ($file = readdir($handle))) {
    			if ($file != "." && $file != ".." && $file != '.svn' && $file != 'index.html') {
    				if (filetype($dir.DS.$file) != 'dir') {
    					$result[] = JHTML::_('select.option', $file, JText::_(str_replace('.php', '', $file)));	
    				}
        		}
    		}
		}		
		$result[] = JHTML::_('select.option', 'managed', JText::_('managed'));			
		
		return $result;
	}	
	
	
	/**
	 * Retrieve a list of flypages from the templates directory.
	 * 
     * @author RickG	 
	 * @return object List of flypage objects
	 */
	function getFlypageList()
	{		
		$dir = JPATH_ROOT.DS.'components'.DS.'com_virtuemart'.DS.'themes';
		$dir .= DS.VmConfig::getVar('theme').DS.'templates'.DS.'product_details';		
		$result = '';
		
		if ($handle = opendir($dir)) {
    		while (false !== ($file = readdir($handle))) {
    			if ($file != "." && $file != ".." && $file != '.svn' && $file != 'index.html') {
    				if (filetype($dir.DS.$file) != 'dir') {
    					$result[] = JHTML::_('select.option', $file, JText::_(str_replace('.php', '', $file)));	
    				}
        		}
    		}
		}		
		
		return $result;
	}	
	
	
	/**
	 * Retrieve a list of possible images to be used for the 'no image' image.
	 * 
     * @author RickG	 
	 * @return object List of image objects
	 */
	function getNoImageList()
	{		
		$dir = JPATH_ROOT.DS.'components'.DS.'com_virtuemart'.DS.'themes';
		$dir .= DS.VmConfig::getVar('theme').DS.'images';		
		$result = '';
		
		if ($handle = opendir($dir)) {
    		while (false !== ($file = readdir($handle))) {
    			if ($file != "." && $file != ".." && $file != '.svn' && $file != 'index.html') {
    				if (filetype($dir.DS.$file) != 'dir') {
    					$result[] = JHTML::_('select.option', $file, JText::_(str_replace('.php', '', $file)));	
    				}
        		}
    		}
		}		
		
		return $result;
	}	
	
	
	/**
	 * Retrieve a list of possible order statuses.
	 * 
     * @author RickG	 
	 * @return object List of status objects
	 */
	function getOrderStatusList()
	{		
		$db = JFactory::getDBO(); 
		
		$query = 'SELECT `order_status_code`, `order_status_name` FROM `#__vm_order_status` ';
		$query .= ' ORDER BY `#__vm_order_status`.`order_status_name`';
		$db->setQuery($query);
		
		return $db->loadObjectList();
	}		
}
?>