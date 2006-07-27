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

class vmTemplate {
	var $vars; /// Holds all the template variables
	var $path; /// Path to the templates
	var $cache_id;
	var $expire;
	var $cached;
	
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
		global $mosConfig_cachepath, $mosConfig_cachetime, $mosConfig_live_site, 
			$mosConfig_absolute_path, $VM_LANG, $vmLogger, $sess, $auth, $my,
			$CURRENCY_DISPLAY, $CURRENCY, $mm_action_url;
		$this->path = empty($path) ?  VM_THEMEPATH.'templates/' : $path;
		$this->vars = array('VM_LANG' => $VM_LANG, 
							'CURRENCY_DISPLAY' => $CURRENCY_DISPLAY,
							'CURRENCY' => $CURRENCY,
							'vmLogger' => $vmLogger,
							'sess' => $sess,
							'mm_action_url' => $mm_action_url,
							'auth' => $auth,
							'my' => $my,
							'mosConfig_live_site' => $mosConfig_live_site,
							'mosConfig_absolute_path' => $mosConfig_absolute_path
							);
		$this->cache_id = $cacheId ? $mosConfig_cachepath.'/' . $cacheId : $mosConfig_cachepath.'/' . $GLOBALS['cache_id'];
		$this->expire   = $expire == 0 ? $mosConfig_cachetime : $expire;
	}
	
	/**
    * Test to see whether the currently loaded cache_id has a valid
    * corresponding cache file.
    *
    * @return bool
    */
	function is_cached() {
		if($this->cached) return true;

		// Passed a cache_id?
		if(!$this->cache_id) return false;

		// Cache file exists?
		if(!file_exists($this->cache_id)) return false;

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
			if(is_array($vars)) $this->vars = array_merge($this->vars, $vars);
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
		if($this->is_cached()) {
			$fp = @fopen($this->cache_id, 'r');
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