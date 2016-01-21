
<?php

//namespace Joomla\String;

// PHP mbstring and iconv local configuration
if (version_compare(PHP_VERSION, '5.6', '>='))
{
	@ini_set('default_charset', 'UTF-8');
}
else
{
	// Check if mbstring extension is loaded and attempt to load it if not present except for windows
	if (extension_loaded('mbstring'))
	{
		@ini_set('mbstring.internal_encoding', 'UTF-8');
		@ini_set('mbstring.http_input', 'UTF-8');
		@ini_set('mbstring.http_output', 'UTF-8');
	}

	// Same for iconv
	if (function_exists('iconv'))
	{
		iconv_set_encoding('internal_encoding', 'UTF-8');
		iconv_set_encoding('input_encoding', 'UTF-8');
		iconv_set_encoding('output_encoding', 'UTF-8');
	}
}

class vString {

	static $_mb = false;

	public function __construct(){
		if (extension_loaded('mbstring')){
			self::$_mb = true;
		}
	}


	public static function is_ascii($str) {
		// Search for any bytes which are outside the ASCII range...
		return (preg_match('/(?:[^\x00-\x7F])/',$str) !== 1);
	}

	public static function strpos($str, $search, $offset = 0) {
		if(self::$_mb){
			return mb_strpos($str, $search, $offset);
		} else {
			return strpos($str, $search, $offset);
		}
	}

	public static function strrpos($str, $search, $offset = 0) {
		if(self::$_mb){
			return mb_strrpos($str, $search, $offset);
		} else {
			return strrpos($str, $search, $offset);
		}
	}

	public static function substr($str, $offset, $length = false) {

		if ($length === false) {
			if(self::$_mb){
				return mb_substr($str, $offset);
			} else {
				return substr($str, $offset);
			}
		} else {
			if(self::$_mb){
				return mb_substr($str, $offset, $length);
			} else {
				return substr($str, $offset, $length);
			}
		}
	}


	public static function strtolower($str) {
		if(self::$_mb){
			return mb_strtolower($str);
		} else {
			return strtolower($str);
		}
	}


	public static function strtoupper($str) {
		if(self::$_mb){
			return mb_strtoupper($str);
		} else {
			return strtoupper($str);
		}
	}

	public static function strlen($str) {
		if(self::$_mb){
			return mb_strlen($str);
		} else {
			return strlen($str);
		}
	}

	public static function str_ireplace($search, $replace, $str, $count = NULL){
		if(self::$_mb){
			return mb_str_ireplace($search, $replace, $str, $count);
		} else {
			return str_ireplace($search, $replace, $str, $count);
		}
	}

	function str_split($str, $spl_len = 1) {
		if(self::$_mb){
			return mb_str_split($str, $spl_len);
		} else {
			return str_split($str, $spl_len);
		}
	}


	/**
	 * UTF-8/LOCALE aware alternative to strcasecmp
	 * A case insensitive string comparison
	 *
	 * @param   string  $str1    string 1 to compare
	 * @param   string  $str2    string 2 to compare
	 * @param   mixed   $locale  The locale used by strcoll or false to use classical comparison
	 *
	 * @return  integer   < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal.
	 *
	 * @see     http://www.php.net/strcasecmp
	 * @see     http://www.php.net/strcoll
	 * @see     http://www.php.net/setlocale
	 */
	public static function strcasecmp($str1, $str2, $locale = false)
	{
		if ($locale)
		{
			// Get current locale
			$locale0 = setlocale(LC_COLLATE, 0);

			if (!$locale = setlocale(LC_COLLATE, $locale))
			{
				$locale = $locale0;
			}

			// See if we have successfully set locale to UTF-8
			if (!stristr($locale, 'UTF-8') && stristr($locale, '_') && preg_match('~\.(\d+)$~', $locale, $m))
			{
				$encoding = 'CP' . $m[1];
			}
			elseif (stristr($locale, 'UTF-8') || stristr($locale, 'utf8'))
			{
				$encoding = 'UTF-8';
			}
			else
			{
				$encoding = 'nonrecodable';
			}

			// If we successfully set encoding it to utf-8 or encoding is sth weird don't recode
			if ($encoding == 'UTF-8' || $encoding == 'nonrecodable')
			{
				return strcoll(self::strtolower($str1), self::strtolower($str2));
			}

			return strcoll(
			self::transcode(self::strtolower($str1), 'UTF-8', $encoding),
			self::transcode(self::strtolower($str2), 'UTF-8', $encoding)
			);
		}

		$strX = utf8_strtolower($str1);
		$strY = utf8_strtolower($str2);
		return strcmp($strX, $strY);

	}

	/**
	 * UTF-8/LOCALE aware alternative to strcmp
	 * A case sensitive string comparison
	 *
	 * @param   string  $str1    string 1 to compare
	 * @param   string  $str2    string 2 to compare
	 * @param   mixed   $locale  The locale used by strcoll or false to use classical comparison
	 *
	 * @return  integer  < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal.
	 *
	 * @see     http://www.php.net/strcmp
	 * @see     http://www.php.net/strcoll
	 * @see     http://www.php.net/setlocale
	 * @since   1.0
	 */
	public static function strcmp($str1, $str2, $locale = false)
	{
		if ($locale)
		{
			// Get current locale
			$locale0 = setlocale(LC_COLLATE, 0);

			if (!$locale = setlocale(LC_COLLATE, $locale))
			{
				$locale = $locale0;
			}

			// See if we have successfully set locale to UTF-8
			if (!stristr($locale, 'UTF-8') && stristr($locale, '_') && preg_match('~\.(\d+)$~', $locale, $m))
			{
				$encoding = 'CP' . $m[1];
			}
			elseif (stristr($locale, 'UTF-8') || stristr($locale, 'utf8'))
			{
				$encoding = 'UTF-8';
			}
			else
			{
				$encoding = 'nonrecodable';
			}

			// If we successfully set encoding it to utf-8 or encoding is sth weird don't recode
			if ($encoding == 'UTF-8' || $encoding == 'nonrecodable')
			{
				return strcoll($str1, $str2);
			}

			return strcoll(self::transcode($str1, 'UTF-8', $encoding), self::transcode($str2, 'UTF-8', $encoding));
		}

		return strcmp($str1, $str2);
	}

	/**
	 * UTF-8 aware alternative to strcspn
	 * Find length of initial segment not matching mask
	 *
	 * @param   string   $str     The string to process
	 * @param   string   $mask    The mask
	 * @param   integer  $start   Optional starting character position (in characters)
	 * @param   integer  $length  Optional length
	 *
	 * @return  integer  The length of the initial segment of str1 which does not contain any of the characters in str2
	 *
	 * @see     http://www.php.net/strcspn
	 * @since   1.0
	 */
	public static function strcspn($str, $mask, $start = null, $length = null) {

		if ( empty($mask) || strlen($mask) == 0 ) {
			return NULL;
		}

		$mask = preg_replace('!([\\\\\\-\\]\\[/^])!','\\\${1}',$mask);

		if ( $start !== NULL || $length !== NULL ) {
			$str = self::substr($str, $start, $length);
		}

		preg_match('/^[^'.$mask.']+/u',$str, $matches);

		if ( isset($matches[0]) ) {
			return self::strlen($matches[0]);
		}

		return 0;


	}

	/**
	 * UTF-8 aware alternative to stristr
	 * Returns all of haystack from the first occurrence of needle to the end.
	 * needle and haystack are examined in a case-insensitive manner
	 * Find first occurrence of a string using case insensitive comparison
	 *
	 * @param   string  $str     The haystack
	 * @param   string  $search  The needle
	 *
	 * @return string the sub string
	 *
	 * @see     http://www.php.net/stristr
	 * @since   1.0
	 */
	public static function stristr($str, $search) {
		if ( strlen($search) == 0 ) {
			return $str;
		}

		if(self::$_mb){
			return mb_stristr($str, $search);
		} else {
			return stristr($str, $search);
		}
	}


	function strrev($str){
		preg_match_all('/./us', $str, $ar);
		return join('',array_reverse($ar[0]));
	}

	/**
	 * UTF-8 aware alternative to strspn
	 * Find length of initial segment matching mask
	 *
	 * @param   string   $str     The haystack
	 * @param   string   $mask    The mask
	 * @param   integer  $start   Start optional
	 * @param   integer  $length  Length optional
	 *
	 * @return  integer
	 *
	 * @see     http://www.php.net/strspn
	 * @since   1.0
	 */
	public static function strspn($str, $mask, $start = null, $length = null)
	{
		$mask = preg_replace('!([\\\\\\-\\]\\[/^])!','\\\${1}',$mask);

		// Fix for $start but no $length argument.
		if ($start !== null && $length === null) {
			$length = self::strlen($str);
		}

		if ( $start !== NULL || $length !== NULL ) {
			$str = self::substr($str, $start, $length);
		}

		preg_match('/^['.$mask.']+/u',$str, $matches);

		if ( isset($matches[0]) ) {
			return self::strlen($matches[0]);
		}

		return 0;
	}

	/**
	 * UTF-8 aware substr_replace
	 * Replace text within a portion of a string
	 *
	 * @param   string   $str     The haystack
	 * @param   string   $repl    The replacement string
	 * @param   integer  $start   Start
	 * @param   integer  $length  Length (optional)
	 *
	 * @return  string
	 *
	 * @see     http://www.php.net/substr_replace
	 * @since   1.0
	 */
	public static function substr_replace($str, $repl, $start, $length = null)
	{
		// Loaded by library loader
		if ($length === false)
		{
			return utf8_substr_replace($str, $repl, $start);
		}

		return utf8_substr_replace($str, $repl, $start, $length);
	}


	/**
	 * Transcode a string.
	 *
	 * @param   string  $source         The string to transcode.
	 * @param   string  $from_encoding  The source encoding.
	 * @param   string  $to_encoding    The target encoding.
	 *
	 * @return  mixed  The transcoded string, or null if the source was not a string.
	 *
	 * @link    https://bugs.php.net/bug.php?id=48147
	 *
	 * @since   1.0
	 */
	public static function transcode($source, $from_encoding, $to_encoding)
	{
		if (is_string($source))
		{
			switch (ICONV_IMPL)
			{
				case 'glibc':
					return @iconv($from_encoding, $to_encoding . '//TRANSLIT,IGNORE', $source);

				case 'libiconv':
				default:
					return iconv($from_encoding, $to_encoding . '//IGNORE//TRANSLIT', $source);
			}
		}

		return null;
	}

	/**
	 * Tests a string as to whether it's valid UTF-8 and supported by the Unicode standard.
	 *
	 * Note: this function has been modified to simple return true or false.
	 *
	 * @param   string  $str  UTF-8 encoded string.
	 *
	 * @return  boolean  true if valid
	 *
	 * @author  <hsivonen@iki.fi>
	 * @see     http://hsivonen.iki.fi/php-utf8/
	 * @see     compliant
	 * @since   1.0
	 */
	public static function valid($str)
	{
		require_once __DIR__ . '/phputf8/utils/validation.php';

		return utf8_is_valid($str);
	}

	/**
	 * Tests whether a string complies as UTF-8. This will be much
	 * faster than utf8_is_valid but will pass five and six octet
	 * UTF-8 sequences, which are not supported by Unicode and
	 * so cannot be displayed correctly in a browser. In other words
	 * it is not as strict as utf8_is_valid but it's faster. If you use
	 * it to validate user input, you place yourself at the risk that
	 * attackers will be able to inject 5 and 6 byte sequences (which
	 * may or may not be a significant risk, depending on what you are
	 * are doing)
	 *
	 * @param   string  $str  UTF-8 string to check
	 *
	 * @return  boolean  TRUE if string is valid UTF-8
	 *
	 * @see     valid
	 * @see     http://www.php.net/manual/en/reference.pcre.pattern.modifiers.php#54805
	 * @since   1.0
	 */
	public static function compliant($str)
	{
		require_once __DIR__ . '/phputf8/utils/validation.php';

		return utf8_compliant($str);
	}

	/**
	 * Converts Unicode sequences to UTF-8 string
	 *
	 * @param   string  $str  Unicode string to convert
	 *
	 * @return  string  UTF-8 string
	 *
	 * @since   1.2.0
	 */
	public static function unicode_to_utf8($str)
	{
		if (self::$_mb)
		{
			return preg_replace_callback(
			'/\\\\u([0-9a-fA-F]{4})/',
			function ($match)
			{
				return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
			},
			$str
			);
		}

		return $str;
	}

	/**
	 * Converts Unicode sequences to UTF-16 string
	 *
	 * @param   string  $str  Unicode string to convert
	 *
	 * @return  string  UTF-16 string
	 *
	 * @since   1.2.0
	 */
	public static function unicode_to_utf16($str)
	{
		if (extension_loaded('mbstring'))
		{
			return preg_replace_callback(
			'/\\\\u([0-9a-fA-F]{4})/',
			function ($match)
			{
				return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UTF-16BE');
			},
			$str
			);
		}

		return $str;
	}

	/**
	 * Method to convert a string from camel case.
	 *
	 * This method offers two modes. Grouped allows for splitting on groups of uppercase characters as follows:
	 *
	 * "FooBarABCDef"            becomes  array("Foo", "Bar", "ABC", "Def")
	 * "JFooBar"                 becomes  array("J", "Foo", "Bar")
	 * "J001FooBar002"           becomes  array("J001", "Foo", "Bar002")
	 * "abcDef"                  becomes  array("abc", "Def")
	 * "abc_defGhi_Jkl"          becomes  array("abc_def", "Ghi_Jkl")
	 * "ThisIsA_NASAAstronaut"   becomes  array("This", "Is", "A_NASA", "Astronaut"))
	 * "JohnFitzgerald_Kennedy"  becomes  array("John", "Fitzgerald_Kennedy"))
	 *
	 * Non-grouped will split strings at each uppercase character.
	 *
	 * @param   string   $input    The string input (ASCII only).
	 * @param   boolean  $grouped  Optionally allows splitting on groups of uppercase characters.
	 *
	 * @return  string  The space separated string.
	 *
	 * @since   1.0
	 */
	public static function fromCamelCase($input, $grouped = false)
	{
		return $grouped
		? preg_split('/(?<=[^A-Z_])(?=[A-Z])|(?<=[A-Z])(?=[A-Z][^A-Z_])/x', $input)
		: trim(preg_replace('#([A-Z])#', ' $1', $input));
	}
}