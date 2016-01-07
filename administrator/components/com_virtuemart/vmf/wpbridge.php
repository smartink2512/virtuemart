<?php
/**
*
* @package	VirtueMart
* @subpackage Helpers
* @author Max Milbers
* @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
* @license LGPLv3
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

class wpBridge extends vBasicModel implements vIApp {

	private static $config;

	/**
	 * Get a configuration object
	 *
	 * Returns the global {@link JConfig} object, only creating it if it doesn't already exist.
	 *
	 */
	public static function getConfig() {
		if (!self::$config) {
			$file = JPATH_PLATFORM . '/config.php';
			if(!class_exists('JConfig')){
				require($file);
			}
			if(class_exists('JConfig')){
				$vo = new vObject();
				foreach (get_object_vars(new JConfig()) as $k => $v) {
					$vo->$k = $v;
				}
				self::$config = $vo;
			}
		}
		return self::$config;
	}

	function isSite(){
		return !is_admin();
	}

	function isAdmin(){
		return is_admin();
	}
}
