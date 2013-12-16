<?php

if (!defined('_JEXEC'))
die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');

/**
 *
 * @version $Id$
 * @package VirtueMart
 * @subpackage core
 * @copyright Copyright (c) 2006 Open Source Matters
 * @copyright Copyright (C) 2006-2008 soeren - All rights reserved.
 * @copyright Copyright (c) 2010 The virtuemart team
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.org

 /**
 * Parameters handler
 * @package VirtueMart
 */
class FileUtilities {

	/** TODO obsolete?
	 * Lists all available payment classes in the payment directory
	 *
	 * @param string $name
	 * @param string $preselected
	 * @return string
	 */
	function list_available_classes($name, $preselected='payment') {

		$files = self::vmReadDirectory(JPATH_PLUGINS . DS . 'vmpayment', ".php$", true, true);
		$list = array();
		foreach ($files as $file) {
			$file_info = pathinfo($file);
			$filename = $file_info['basename'];
			if (stristr($filename, '.cfg')) {
				continue;
			}
			$list[] = array('file' => basename($filename, '.php'), 'fileName' => $filename);
		}
		return JHTML::_('select.genericlist', $list, 'file', '', 'file', 'fileName', $preselected);
	}

	/**
	 * Function to strip additional / or \ in a path name
	 * @param string The path
	 * @param boolean Add trailing slash
	 */
	function vmPathName($p_path, $p_addtrailingslash = true) {
		$retval = "";

		$isWin = (substr(PHP_OS, 0, 3) == 'WIN');

		if ($isWin) {
			$retval = str_replace('/', '\\', $p_path);
			if ($p_addtrailingslash) {
				if (substr($retval, -1) != '\\') {
					$retval .= '\\';
				}
			}

			// Check if UNC path
			$unc = substr($retval, 0, 2) == '\\\\' ? 1 : 0;

			// Remove double \\
			$retval = str_replace('\\\\', '\\', $retval);

			// If UNC path, we have to add one \ in front or everything breaks!
			if ($unc == 1) {
				$retval = '\\' . $retval;
			}
		} else {
			$retval = str_replace('\\', '/', $p_path);
			if ($p_addtrailingslash) {
				if (substr($retval, -1) != '/') {
					$retval .= '/';
				}
			}

			// Check if UNC path
			$unc = substr($retval, 0, 2) == '//' ? 1 : 0;

			// Remove double //
			$retval = str_replace('//', '/', $retval);

			// If UNC path, we have to add one / in front or everything breaks!
			if ($unc == 1) {
				$retval = '/' . $retval;
			}
		}

		return $retval;
	}

	/**
	 * Utility function to read the files in a directory
	 * @param string The file system path
	 * @param string A filter for the names
	 * @param boolean Recurse search into sub-directories
	 * @param boolean True if to prepend the full path to the file name
	 */
	function vmReadDirectory($path, $filter='.', $recurse=false, $fullpath=false) {

		$arr = array();
		if (!@is_dir($path)) {
			return $arr;
		}
		$handle = opendir($path);

		while ($file = readdir($handle)) {
			$dir = self::vmPathName($path . '/' . $file, false);
			$isDir = is_dir($dir);
			if (($file != ".") && ($file != "..")) {
				if (preg_match("/$filter/", $file)) {
					if ($fullpath) {
						$arr[] = trim(self::vmPathName($path . '/' . $file, false));
					} else {
						$arr[] = trim($file);
					}
				}
				if ($recurse && $isDir) {
					$arr2 = self::vmReadDirectory($dir, $filter, $recurse, $fullpath);
					$arr = array_merge($arr, $arr2);
				}
			}
		}
		closedir($handle);
		asort($arr);
		return $arr;
	}

}


// pure php no closing tag
