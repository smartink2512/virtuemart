<?php
/**
* This file contains the lanuages handler class
*
* @version $Id$
* @package VirtueMart
* @copyright Copyright (C) 2007 soeren, thepisu - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Abstract lanuages/translation handler class
*/
class vmAbstractLanguage {
/** @var boolean If true, highlights string not found */
	var $_debug = false;

	function vmAbstractLanguage() {
		$this->setDebug();
		if( empty( $this->CHARSET )) $this->setCharset();
	}

	/**
	* Translator function
	* @param string Name of the Class Variable
	* @param boolean Encode String to HTML entities?
	* @return string The value of $var (as an HTML Entitiy-encoded string if $htmlentities)
	*/
	function _( $var, $htmlentities=false ) {
	    $key = '_' . strtoupper( $var );
	    if (isset($this->$key)) {
			if( $htmlentities ) {
				$text = htmlentities( $this->$key, ENT_QUOTES, $this->CHARSET );
				// some symbols are not converted correctly... doing manually
				$text = str_replace(chr(128),'&euro;',$text);
				// enable the use of HTML tags in language file... is this really good?
				$text = str_replace('&lt;','<',$text);
				$text = str_replace('&gt;','>',$text);
				return $text;
			} else {
				$text = $this->$key;
				if (strtolower(vmGetCharset())=='utf-8' && strtolower($this->CHARSET)=='iso-8859-1' && function_exists('utf8_encode')) {
					$text = utf8_encode($text);
				}
				if (stristr(vmGetCharset(), 'iso-8859-1') && strtolower($this->CHARSET)=='utf-8' && function_exists('utf8_decode')) {
					$text = utf8_decode($text);
				}
				return stripslashes( $text );
			}
		} 
		elseif( $this->_debug )
		    return "$var is missing in language file.";
	}
	/**
	* Merges the class vars of another class
	* @param string The name of the class to merge
	* @return boolean True if successful, false is failed
	*/
	function merge( $classname ) {
	    if (class_exists( $classname )) {
	        foreach (get_class_vars( $classname ) as $k=>$v) {
	            if (is_string( $v )) {
	                if ($k[0] != '_') {
	                    $this->$k = $v;
					}
				}
			}
		} else {
		    return false;
		}
	}
	function setDebug() {
		$this->_debug = @DEBUG == '1' || $GLOBALS['mosConfig_debug'] == '1';
	}
	function setCharset( $charset='') {
		if( !empty( $charset )) {
			$this->CHARSET = $charset;
		} else {
			$this->CHARSET = vmGetCharset();
		}
	}
	function getCharset() {
		return $this->CHARSET;
	}
	/**
	 * This safely converts an iso-8859 string into an utf-8 encoded
	 * string. It does not convert when the string is already utf-8 encoded
	 *
	 * @param string $text iso-8859 encoded text
	 * @param string $charset This is a k.o.-Argument. If it is NOT equal to 'utf-8', no conversion will take place
	 * @return unknown
	 */
	function safe_utf8_encode( $text, $charset ) {
		if( strtolower($charset) == 'utf-8') {
			// safely decode and reencode the string
			$text = utf8_encode(utf8_decode($text));
		}
		// This converts the currency symbol from HTML entity to the utf-8 symbol
		// example:  &euro; => €
		$text = vmHtmlEntityDecode( $text, null, vmGetCharset() );
		
		return $text;
	}
	/**
	 * a simple function that can help, if you want to know 
	 * if a string could be UTF-8 or not
	 * @author bmorel at ssi dot fr
	 * @param unknown_type $Str
	 * @return unknown
	 */
	function seems_utf8($Str) {
		for ($i=0; $i<strlen($Str); $i++) {
			if (ord($Str[$i]) < 0x80) continue; # 0bbbbbbb
			elseif ((ord($Str[$i]) & 0xE0) == 0xC0) $n=1; # 110bbbbb
			elseif ((ord($Str[$i]) & 0xF0) == 0xE0) $n=2; # 1110bbbb
			elseif ((ord($Str[$i]) & 0xF8) == 0xF0) $n=3; # 11110bbb
			elseif ((ord($Str[$i]) & 0xFC) == 0xF8) $n=4; # 111110bb
			elseif ((ord($Str[$i]) & 0xFE) == 0xFC) $n=5; # 1111110b
			else return false; # Does not match any model
			for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
				if ((++$i == strlen($Str)) || ((ord($Str[$i]) & 0xC0) != 0x80)) {
					return false;
				}
			}
		}
		return true;
	}
	/**
	* Check if a language variable exists in current language file
	* @param string Name of the Class Variable
	* @return boolean True if exists, false is non exists
	*/
	function exists($var) {
	    $key = '_' . strtoupper( $var );
	    if (isset($this->$key)) {
			return true;
		} else {
			return false;
		}
	}
}
class mosAbstractLanguage extends vmAbstractLanguage { }
?>