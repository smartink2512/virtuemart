<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* Abstract lanuages/translation handler class
*/
class vmAbstractLanguage {
/** @var boolean If true, highlights string not found */
	var $_debug = false;

	function vmAbstractLanguage() {
		global $mosConfig_debug;
		
		$this->_debug = @DEBUG == '1' || $mosConfig_debug == '1';
	}
	/**
	* Translator function
	* @param string Name of the Class Variable
	* @param boolean Encode String to HTML entities?
	* @return string The value of $var (as an HTML Entitiy-encoded string if $htmlentities)
	*/
	function _( $var, $htmlentities=true ) {
	    $key = strtoupper( $var );
	    if (isset($this->$key)) {
			if( $htmlentities )
				return htmlentities( $this->$key, ENT_QUOTES );
			else
				return $this->$key;
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
}
class mosAbstractLanguage extends vmAbstractLanguage { }
?>