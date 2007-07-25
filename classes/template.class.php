<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage core
* @copyright Copyright (c) 2003 Brian E. Lozier (brian@massassi.net)
* @copyright Copyright (C) 2006 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*
* set_vars() method contributed by Ricardo Garcia (Thanks!)
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to
* deal in the Software without restriction, including without limitation the
* rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
* sell copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.
*/
require_once( CLASSPATH . 'parameters.class.php');

class vmTemplate {
	var $vars; /// Holds all the template variables
	var $path; /// Path to the templates
	/**
	 * Stores the theme configuration
	 *
	 * @var $config
	 */
	var $config;
	var $cache_id;
	var $expire;
	var $cached = false;
	
	/**
    * Constructor.
    *
    * @param string $path path to template files
    * @param string $cache_id unique cache identifier
    * @param int $expire number of seconds the cache will live
    *
    * @return void
    */
	function vmTemplate($path='', $cacheId = null, $expire = 0 ) {
		global $mosConfig_live_site, $mosConfig_cachepath, $mosConfig_cachetime;
			
		$this->path = empty($path) ?  VM_THEMEPATH.'templates/' : $path;
		$this->default_path = $mosConfig_live_site.'/components/'.VM_COMPONENT_NAME.'/themes/default/templates/';
		
		$globalsArray = vmGetGlobalsArray();
		foreach( $globalsArray as $global ) {
			global $$global;
			$this->vars[$global] = $GLOBALS[$global];
		}
		$this->cache_id = $cacheId ? $mosConfig_cachepath.'/' . $cacheId : $mosConfig_cachepath.'/' . $GLOBALS['cache_id'];
		$this->expire   = $expire == 0 ? $mosConfig_cachetime : $expire;
		
		// the theme configuration needs to be available to the templates! (so you can use $this->get_cfg('showManufacturerLink') for example )
		if( empty( $GLOBALS['vmThemeConfig'] ) || !empty( $_REQUEST['vmThemeConfig'])) {
			$GLOBALS['vmThemeConfig'] =& new vmParameters( @file_get_contents(VM_THEMEPATH.'theme.config.php'), VM_THEMEPATH.'theme.xml', 'theme');

		}
		$this->config =& $GLOBALS['vmThemeConfig'];
		
	}
	/**
	 * @static 
	 *
	 * @return vmTemplate_default
	 */
	function getInstance() {
		return new $GLOBALS['VM_THEMECLASS']();
	}
	/**
    * Test to see whether the currently loaded cache_id has a valid
    * corresponding cache file.
    *
    * @return bool
    */
	function is_cached() {
		if($this->cached) {			
			return true;
		}

		// Passed a cache_id?
		if(!$this->cache_id) return false;

		// Cache file exists?
		if(!@file_exists($this->cache_id)) return false;
		if( @filesize($this->cache_id) == 0) return false;

		// Can get the time of the file?
		if(!($mtime = filemtime($this->cache_id))) return false;

		// Cache expired?
		if(($mtime + $this->expire) < time()) {
			@unlink($this->cache_id);
			return false;
		}
		else {
			/**
            * Cache the results of this is_cached() call.  Why?  So
            * we don't have to double the overhead for each template.
            * If we didn't cache, it would be hitting the file system
            * twice as much (file_exists() & filemtime() [twice each]).
            */
			$this->cached = true;
			return true;
			//
		}
	}
	
	/**
    * Set the path to the template files.
    *
    * @param string $path path to template files
    *
    * @return void
    */
	function set_path($path) {
		$this->path = $path;
	}

	/**
    * Set a template variable.
    *
    * @param string $name name of the variable to set
    * @param mixed $value the value of the variable
    *
    * @return void
    */
	function set($name, $value) {
		$this->vars[$name] = $value;
	}

	/**
    * Set a bunch of variables at once using an associative array.
    *
    * @param array $vars array of vars to set
    * @param bool $clear whether to completely overwrite the existing vars
    *
    * @return void
    */
	function set_vars($vars, $clear = false) {
		if($clear) {
			$this->vars = $vars;
		}
		else {
			if(is_array($vars)) {
				$this->vars = array_merge($this->vars, $vars);
			}
		}
	}
	/**
	 * Returns the value of a configuration parameter of this theme
	 *
	 * @param string $var
	 * @param mixed $default
	 * @return mixed
	 */
	function get_cfg( $var, $default='' ) {

		return $this->config->get( $var, $default );
	}
	
	/**
	 * Sets the configuration parameter of this theme
	 *
	 * @param string $var
	 * @param mixed $value
	 */
	function set_cfg( $var, $value ) {
		if( is_a( $this->config, 'vmParameters' )) {
			$this->config->set( $var, $value );
		}
	}
	
	/**
    * Open, parse, and return the template file.
    *
    * @param string string the template file name
    *
    * @return string
    */
	function fetch($file) {
		extract($this->vars);          // Extract the vars to local namespace
		ob_start();                    // Start output buffering
		if( file_exists( $this->path . $file ) ) {
			include($this->path . $file);  // Include the file
		} elseif( file_exists( $this->default_path . $file ) ) {
			include( $this->default_path . $file );
		}
		$contents = ob_get_contents(); // Get the contents of the buffer
		ob_end_clean();                // End buffering and discard
		return $contents;              // Return the contents
	}

	/**
    * This function returns a cached copy of a template (if it exists),
    * otherwise, it parses it as normal and caches the content.
    *
    * @param $file string the template file
    *
    * @return string
    */
	function fetch_cache($file) {
		global $mosConfig_caching;
		if($this->is_cached() && $fp = @fopen($this->cache_id, 'r') ) {
			
			$contents = fread($fp, filesize($this->cache_id));
			fclose($fp);
			return $contents;
		}
		else {
			$contents = $this->fetch($file);
			if( $mosConfig_caching ) {
				// Write the cache
				if($fp = @fopen($this->cache_id, 'w')) {
					fwrite($fp, $contents);
					fclose($fp);
				}
				else {
					die('Unable to write cache.');
				}
			}
			return $contents;
		}
	}
}


?>