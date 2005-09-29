<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* DOMIT! is a non-validating, but lightweight and fast DOM parser for PHP
* @package VirtueMart
* @subpackage domit-xmlparser
* @version 1.0
* @copyright (C) 2004 John Heinstein. All rights reserved
* @license http://www.gnu.org/copyleft/lesser.html LGPL License
* @author John Heinstein <johnkarl@nbnet.nb.ca>
* @link http://www.engageinteractive.com/domit/ DOMIT! Home Page
* DOMIT! is Free Software
**/

if (!defined('PHP_TEXT_CACHE_INCLUDE_PATH')) {
	define('PHP_TEXT_CACHE_INCLUDE_PATH', (dirname(__FILE__) . "/"));
}

class php_file_utilities {
	/**
	* Retrieves binary or text data from the specified file
	* @param string The file path
	* @param string The attributes for the read operation ('r' or 'rb')
	* @return mixed he text or binary data contained in the file
	*/
	function &getDataFromFile($filename, $readAttributes, $readSize = 8192) {
		$fileContents = null;
		$fileHandle = @fopen($filename, $readAttributes);

		if($fileHandle){
			do {
				$data = fread($fileHandle, $readSize);

				if (strlen($data) == 0) {
					break;
				}

				$fileContents .= $data;
			} while (true);

			fclose($fileHandle);
		}

		return $fileContents;
	} //getDataFromFile
	
	/**
	* Writes the specified binary or text data to a file
	* @param string The file path
	* @param mixed The data to be written
	* @param string The attributes for the write operation ('w' or 'wb')
	*/
	function putDataToFile($fileName, &$data, $writeAttributes) {
		$fileHandle = @fopen($fileName, $writeAttributes);
		if ($fileHandle) {
			fwrite($fileHandle, $data);	
			fclose($fileHandle);
		}
	} //putDataToFile
} //php_file_utilities
?>
