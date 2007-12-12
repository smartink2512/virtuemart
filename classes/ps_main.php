<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* This is no class! This file only provides core virtuemart functions.
* 
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/


/**
 * This function validates a given date and creates a timestamp
 * @deprecated 
 *
 * @param array $d
 * @param string $field The name of the field
 * @param string $type
 * @return boolean
 */
function process_date_time(&$d,$field,$type="") {
	$month = $d["$field" . "_month"];
	$day = $d["$field" . "_day"];
	$year = $d["$field" . "_year"];
	$hour = $d["$field" . "_hour"];
	$minute = $d["$field" . "_minute"];
	$use = $d["$field" . "_use"];
	$valid = true;

	/* If user unchecked "Use date and time" then time = 0 */
	if (!$use) {
		$d[$field] = 0;
		return true;
	}
	if (!checkdate($month,$day,$year)) {
		$d["error"] .= "ERROR: $type date is invalid.";
		$valid = false;
	}
	if (!$hour and !$minute) {
		$hour = 0;
		$minute = 0;
	} elseif ($hour < 0 or $hour > 23 or $minute < 0 or $minute > 59) {
		$d["error"] .= "ERROR: $type time is invalid.";
		$valid = false;
	}

	if ($valid) {
		$d[$field] = mktime($hour,$minute,0,$month,$day,$year);
	}

	return $valid;
}

/**
 * Validates an email address by using regular expressions
 * Does not resolve the domain name!
 *
 * @param string $email
 * @return boolean The result of the validation
 */
function vmValidateEmail( $email ) {
	$valid = preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $email );
	
	return $valid;
}

/**
 * Checks if a given string is a valid (from-)name or subject for an email
 *
 * @since		1.0.7
 * @param		string		$string		String to check for validity
 * @return		boolean
 */
function vmValidateName( $string ) {
	/*
	 * The following regular expression blocks all strings containing any low control characters:
	 * 0x00-0x1F, 0x7F
	 * These should be control characters in almost all used charsets.
	 * The high control chars in ISO-8859-n (0x80-0x9F) are unused (e.g. http://en.wikipedia.org/wiki/ISO_8859-1)
	 * Since they are valid UTF-8 bytes (e.g. used as the second byte of a two byte char),
	 * they must not be filtered.
	 */
	$invalid = preg_match( '/[\x00-\x1F\x7F]/', $string );
	if ($invalid) {
		return false;
	} else {
		return true;
	}
}
/**
 * Validates an EU-vat number
 * @author Steve Endredy
 * @param string $euvat EU-vat number to validate
 * @return boolean The result of the validation
 */
function vmValidateEUVat( $euvat ){
	require_once( CLASSPATH . 'connectionTools.class.php' );
	
	$eurl = "http://ec.europa.eu/taxation_customs/vies/cgi-bin/viesquer";
	if(!ereg("([a-zA-Z][a-zA-Z])[- ]*([0-9]*)", $euvat, $r)){
		return false;
	}
	$CountryCode = $r[1];
	$VAT = $r[2];
	$query = "Lang=EN&MS=$CountryCode&ISO=$CountryCode&VAT=$VAT";
	
	$ret = vmConnector::handleCommunication($eurl, $query);
	
	if (strstr( $ret, "Yes, valid VAT number" )) {
		return true;
	}
	return false;

}

/**
 * Returns the current time in microseconds
 *
 * @return float current time in microseconds
 */
function utime()
{
	list($usec, $sec) = explode(" ", microtime());
	return ((float)$usec + (float)$sec);
}


/**
 * Checks if $item is in $list
 *
 * @param array $list
 * @param string $item
 * @return mixed An integer representing the postion of $item in $list, false when not in list
 */
function in_list($list, $item) {
	for ($i=0;$i<$list["cnt"];$i++) {
		if (!strcmp($list[$i]["name"],$item)) {
			return $i;
		}
	}
	return False;
}

/**
 * reads a file and returns its content as a string
 *
 * @param string $file The path to the file that shall be read
 * @param string $defaultfile The path to the file to is read when $file doesn't exist
 * @return string The file contents
 */
function read_file( $file, $defaultfile='' ) {

	// open the HTML file and read it into $html
	if (file_exists( $file )) {
		$html_file = fopen( $file, "r" );
	}
	elseif( !empty( $defaultfile ) && file_exists( $defaultfile ) ) {
		$html_file = fopen( $defaultfile, "r" );
	}
	else {
		return;
	}
	if( $html_file === false ) {
		$GLOBALS['vmLogger']->err( 'Could not open '.basename( $file ).'.' );
		return;
	}
	$html = "";

	while (!feof($html_file)) {
		$buffer = fgets($html_file, 1024);
		$html .= $buffer;
	}
	fclose ($html_file);

	return( $html );
}

/**
 * Includes all needed classes for a core module and create + populate the objects
 *
 * @param string $module The name of the virtuemart core module
 */
function include_class($module) {

	// globalize the vars so that they can be used outside of this function
	global $ps_vendor, $ps_affiliate, $ps_manufacturer, $ps_manufacturer_category,
	$ps_user,
	$ps_vendor_category,
	$ps_checkout,
	$ps_intershipper,
	$psShip,
	$ps_shipping,
	$ps_order,
	$ps_order_status,
	$ps_product,
	$ps_product_category ,
	$ps_product_attribute,
	$ps_product_type, // Changed Product Type
	$ps_product_type_parameter, // Changed Product Type
	$ps_product_product_type, // Changed Product Type
	$ps_product_price,
	$nh_report,
	$ps_payment_method,
	$ps_shopper,
	$ps_shopper_group,
	$ps_cart,
	$ps_zone,
	$ps_tax,
	$zw_waiting_list;

	switch ( $module ) {

		case "account":
			break;

		case "admin" :
			// Load class files
			require_once(CLASSPATH. 'ps_html.php' );
			require_once(CLASSPATH. 'ps_function.php' );
			require_once(CLASSPATH. 'ps_module.php' );
			require_once(CLASSPATH. 'ps_perm.php' );
			require_once(CLASSPATH. 'ps_user.php' );
			require_once(CLASSPATH. 'ps_user_address.php' );
			require_once(CLASSPATH. 'ps_session.php' );
	
			//Instantiate Classes
			$ps_html = new ps_html;
			$ps_function = new ps_function;
			$ps_module= new ps_module;
			$ps_perm= new ps_perm;
			$ps_user= new ps_user;
			$ps_user_address = new ps_user_address;
			$ps_session = new ps_session;
	
			break;

		case "affiliate" :
			// Load class file
			require_once(CLASSPATH. 'ps_affiliate.php' );
			//Instantiate Class
			$ps_affiliate = new ps_affiliate;
			break;

		case "checkout" :
			// Load class file
			require_once(CLASSPATH. 'ps_checkout.php' );
	
			//Instantiate Class
			//$ps_checkout = new ps_checkout;
	
			break;

		case "order" :
			// Load classes
			require_once(CLASSPATH.'ps_order.php' );
			require_once(CLASSPATH.'ps_order_status.php' );
	
			// Instantiate Classes
			$ps_order = new ps_order;
			$ps_order_status = new ps_order_status;
			break;

		case "product" :
			// Load Classes
			require_once(CLASSPATH.'ps_product.php' );
			require_once(CLASSPATH.'ps_product_category.php' );
			require_once(CLASSPATH.'ps_product_attribute.php' );
			require_once(CLASSPATH.'ps_product_type.php' ); // Changed Product Type
			require_once(CLASSPATH.'ps_product_type_parameter.php' ); // Changed Product Type
			require_once(CLASSPATH.'ps_product_product_type.php' ); // Changed Product Type
			require_once(CLASSPATH.'ps_product_price.php' );
	
			// Instantiate Classes
			$ps_product = new ps_product;
			$ps_product_category = new ps_product_category;
			$ps_product_attribute = new ps_product_attribute;
			$ps_product_type = new ps_product_type; // Changed Product Type
			$ps_product_type_parameter = new ps_product_type_parameter; // Changed Product Type
			$ps_product_product_type = new ps_product_product_type; // Changed Product Type
			$ps_product_price = new ps_product_price;
			break;

		case "reportbasic" :
			// Load Classes
			require_once( CLASSPATH . 'ps_reportbasic.php');
			$nh_report = new nh_report;
			break;

		case "shipping" :
			// Load Class
			require_once( CLASSPATH . 'ps_shipping.php');
			// Instantiate Class
			$ps_shipping = new ps_shipping;
			break;

		case "shop" :
			// Load Classes
			require_once( CLASSPATH. 'ps_cart.php' );
			require_once( CLASSPATH. 'zw_waiting_list.php');

			// Instantiate Classes
			$ps_cart = new ps_cart;
			$zw_waiting_list = new zw_waiting_list;
			break;

		case "shopper" :
			// Load Classes
			require_once( CLASSPATH . 'ps_shopper.php' );
			require_once( CLASSPATH . 'ps_shopper_group.php' );
			// Instantiate Classes
			$ps_shopper = new ps_shopper;
			$ps_shopper_group = new ps_shopper_group;
			break;

		case "store" :
			// Load Classes
			require_once( CLASSPATH . 'ps_payment_method.php' );
			// Instantiate Classes
			$ps_payment_method = new ps_payment_method;
			break;

		case "tax" :
			// Load Classes
			require_once ( CLASSPATH . 'ps_tax.php' );
			// Instantiate Classes
			$ps_tax = new ps_tax;
			break;

		case "vendor" :
			// Load Classes
			require_once (CLASSPATH . 'ps_vendor.php' );
			require_once (CLASSPATH . 'ps_vendor_category.php' );
			// Instantiate Classes
			$ps_vendor = new ps_vendor;
			$ps_vendor_category = new ps_vendor_category;
			break;

		case "zone" :
			// Load Class
			require_once (CLASSPATH . 'ps_zone.php');
			// Instantiate Class
			$ps_zone = new ps_zone;
			break;

		case "manufacturer" :

			require_once (CLASSPATH . 'ps_manufacturer.php');
			require_once (CLASSPATH . 'ps_manufacturer_category.php');
			$ps_manufacturer = new ps_manufacturer;
			$ps_manufacturer_category = new ps_manufacturer_category;
			break;
	}
}

/**
* Login validation function
*
* Username and encoded password is compared to db entries in the mos_users
* table. A successful validation returns true, otherwise false
*/
function vmCheckPass() {
	global $database, $perm, $my, $mainframe;

	// only allow access to admins or storeadmins
	if( $perm->check("admin,storeadmin")) {

		$username = $my->username;
		$passwd_plain = $passwd = trim( vmGet( $_POST, 'passwd', '' ) );
		if( empty( $passwd_plain )) {
			$GLOBALS['vmLogger']->err( 'Password empty!');
			return false;
		}
		$passwd = md5( $passwd );
		$bypost = 1;
		if (!$username || !$passwd || $_REQUEST['option'] != "com_virtuemart") {
			return false;
		} elseif( vmIsJoomla('1.5') ) {
			$credentials = array();
			$credentials['username'] = $username;
			$credentials['password'] = $passwd_plain;
			
			$options = array();
			
			jimport( 'joomla.user.authentication');
			$authenticate = & JAuthentication::getInstance();
			$response	  = $authenticate->authenticate($credentials, $options);
	
			if ($response->status === JAUTHENTICATE_STATUS_SUCCESS) {
				return true;
			} else {
				return false;
			}

		} else {
			if( vmIsJoomla('1.0.12', '<=', false )) {
				$database->setQuery( "SELECT id, gid, block, usertype"
				. "\nFROM #__users"
				. "\nWHERE username='$username' AND password='$passwd'"
				);
				$row = null;
				$res = $database->loadObject( $row );
			} else {
				$query = "SELECT id, name, username, password, usertype, block, gid"
				. "\n FROM #__users"
				. "\n WHERE username = ". $database->Quote( $username );
				$database->setQuery( $query );
				$row = null;
				$database->loadObject( $row );
				
				list($hash, $salt) = explode(':', $row->password);
				$cryptpass = md5($passwd_plain.$salt);
				$res = $hash == $cryptpass;
			}
			if ($res) {
				return true;
			}
			else {
				$GLOBALS['vmLogger']->err( 'The Password you\'ve entered is not correct for your User Account');
				return false;
			}
		}
	}
	return false;
}
/**
 * Formerly used to print a search header for lists
 * use class listFactory instead
 * @deprecated 
 *
 */
function search_header() {
	echo "### THIS FUNCTION IS DEPRECATED. Use the class listFactory instead. ###";
}
/**
 * Formerly used to print a search header for lists
 * use class listFactory instead
 * @deprecated 
 *
 */
function search_footer() {
	echo "### THIS FUNCTION IS DEPRECATED. Use the class listFactory instead. ###";
}
/**
 * Used by the frontend adminsitration to save editor field contents
 *
 * @param string $editor1 the name of the editor field no. 1
 * @param string $editor2 the name of the editor field no. 2
 */
function editorScript($editor1='', $editor2='') {
	?>
	 <script type="text/javascript">
	 function submitbutton(pressbutton) {
	 	var form = document.adminForm;
	 	if (pressbutton == 'cancel') {
	 		submitform( pressbutton );
	 		return;
	 	}
	 	<?php
	 	if ($editor1 != '')
	 	getEditorContents( 'editor1', $editor1 ) ; ?>
	 	<?php
	 	if ($editor2 != '')
	 	getEditorContents( 'editor2', $editor2 ) ; ?>
	 	submitform( pressbutton );

	 }
	 </script><?php
}

/**
* Function to create an email object for further use (uses phpMailer)
* @param string From e-mail address
* @param string From name
* @param string E-mail subject
* @param string Message body
* @return vmPHPMailer Mail object
*/
function vmCreateMail( $from='', $fromname='', $subject='', $body='' ) {
	global $mosConfig_absolute_path, $mosConfig_sendmail;
	global $mosConfig_smtpauth, $mosConfig_smtpuser;
	global $mosConfig_smtppass, $mosConfig_smtphost;
	global $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mailer;
	
	require_once( CLASSPATH . 'phpmailer/class.phpmailer.php');
	
	$mail = new vmPHPMailer();

	$mail->PluginDir = CLASSPATH .'phpmailer/';
	$mail->SetLanguage( 'en', CLASSPATH . 'phpmailer/language/' );
	$mail->CharSet 	= vmGetCharset();
	$mail->IsMail();
	$mail->From 	= $from ? $from : $mosConfig_mailfrom;
	$mail->FromName = $fromname ? $fromname : $mosConfig_fromname;
	$mail->Sender 	= $from ? $from : $mosConfig_mailfrom;
	$mail->Mailer 	= $mosConfig_mailer;

	// Add smtp values if needed
	if ( $mosConfig_mailer == 'smtp' ) {
		$mail->SMTPAuth = $mosConfig_smtpauth;
		$mail->Username = $mosConfig_smtpuser;
		$mail->Password = $mosConfig_smtppass;
		$mail->Host 	= $mosConfig_smtphost;
	} else

	// Set sendmail path
	if ( $mosConfig_mailer == 'sendmail' ) {
		if (isset($mosConfig_sendmail))
			$mail->Sendmail = $mosConfig_sendmail;
	} // if
	if( $subject ) {
		$mail->Subject 	= vmAbstractLanguage::safe_utf8_encode( $subject, $mail->CharSet );
	}
	if( $body) {
		$mail->Body 	= $body;
	}
	// Patch to get correct Line Endings
	switch( substr( strtoupper( PHP_OS ), 0, 3 ) ) {
		case "WIN":
			$mail->LE = "\r\n";
			break;
		case "MAC": // fallthrough
		case "DAR": // Does PHP_OS return 'Macintosh' or 'Darwin' ?
			$mail->LE = "\r";
		default: // change nothing
			break;
	}
	return $mail;
}

/**
* Mail function (uses phpMailer)
* @param string From e-mail address
* @param string From name
* @param string/array Recipient e-mail address(es)
* @param string E-mail subject
* @param string Message body
* @param boolean false = plain text, true = HTML
* @param string/array CC e-mail address(es)
* @param string/array BCC e-mail address(es)
* @param array Images path,cid,name,filename,encoding,mimetype
* @param string/array Attachment file name(s)
* @return boolean Mail send success
*/
function vmMail($from, $fromname, $recipient, $subject, $body, $Altbody, $mode=false, $cc=NULL, $bcc=NULL, $images=null, $attachment=null ) {
	global $mosConfig_debug;

		// Filter from, fromname and subject
	if (!vmValidateEmail( $from ) || !vmValidateName( $fromname ) || !vmValidateName( $subject )) {
		return false;
	}
	
	$mail = vmCreateMail( $from, $fromname, $subject, $body );
	
	if( $Altbody != "" ) {
		// In this section we take care for utf-8 encoded mails
		$mail->AltBody = vmAbstractLanguage::safe_utf8_encode( $Altbody, $mail->CharSet );
	}
	
	// activate HTML formatted emails
	if ( $mode ) {
		$mail->IsHTML(true);
	}
	if( $mail->ContentType == "text/plain" ) {
		$mail->Body = vmAbstractLanguage::safe_utf8_encode( $mail->Body, $mail->CharSet );
	}
	if( is_array($recipient) ) {
		foreach ($recipient as $to) {
			if( vmValidateEmail( $to )) {
				$mail->AddAddress($to);
			}
		}
	} else {
		if( vmValidateEmail( $recipient )) {
			$mail->AddAddress($recipient);
		}
	}
	if (isset($cc)) {
		if( is_array($cc) )
			foreach ($cc as $to) {
				if( vmValidateEmail( $to )) {
					$mail->AddCC($to);
				}
			}
		else {
			if( vmValidateEmail( $cc )) {
				$mail->AddCC($cc);
			}
		}
	}
	if (isset($bcc)) {
		if( is_array($bcc) )
			foreach ($bcc as $to) {
				if( vmValidateEmail( $to )) {
					$mail->AddBCC($to);
				}
			}
		else {
			if( vmValidateEmail( $bcc )) {
				$mail->AddBCC($bcc);
			}
		}
	}
	if( $images ) {
		foreach( $images as $image) {
			$mail->AddEmbeddedImage( $image['path'], $image['name'], $image['filename'], $image['encoding'], $image['mimetype']);
		}
	}
	if ($attachment) {
		if ( is_array($attachment) )
			foreach ($attachment as $fname) $mail->AddAttachment($fname);
		else
			$mail->AddAttachment($attachment);
	}
	$mailssend = $mail->Send();

	if( $mosConfig_debug ) {
		//$mosDebug->message( "Mails send: $mailssend");
	}
	if( $mail->error_count > 0 ) {
		//$mosDebug->message( "The mail message $fromname <$from> about $subject to $recipient <b>failed</b><br /><pre>$body</pre>", false );
		//$mosDebug->message( "Mailer Error: " . $mail->ErrorInfo . "" );
	}
	return $mailssend;
} 

// $ Id: html_entity_decode.php,v 1.7 2005/01/26 04:55:13 aidan Exp $
if (!defined('ENT_NOQUOTES')) {
    define('ENT_NOQUOTES', 0);
}
if (!defined('ENT_COMPAT')) {
    define('ENT_COMPAT', 2);
}
if (!defined('ENT_QUOTES')) {
    define('ENT_QUOTES', 3);
}

/**
 * Replace html_entity_decode()
 *
 * @category    PHP
 * @package     PHP_Compat
 * @link        http://php.net/function.html_entity_decode
 * @author      David Irvine <dave@codexweb.co.za>
 * @author      Aidan Lister <aidan@php.net>
 * @since       PHP 4.3.0
 * @internal    Setting the charset will not do anything
 * @require     PHP 4.0.0 (user_error)
 */
function vmHtmlEntityDecode($string, $quote_style = ENT_COMPAT, $charset = null) {
	if( function_exists('html_entity_decode')) {
		return @html_entity_decode( $string, $quote_style, $charset );
	}
    if (!is_int($quote_style) && !is_null($quote_style)) {
        user_error(__FUNCTION__.'() expects parameter 2 to be long, ' .
            gettype($quote_style) . ' given', E_USER_WARNING);
        return;
    }
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);

    // Add single quote to translation table;
    $trans_tbl['&#039;'] = '\'';

    // Not translating double quotes
    if ($quote_style & ENT_NOQUOTES) {
        // Remove double quote from translation table
        unset($trans_tbl['&quot;']);
    }

    return strtr($string, $trans_tbl);
}
/**
 * Unescapes REQUEST values if magic_quotes_gpc is set 
 *
 * @param string $string The string to strip slashes from
 * @return string
 * @since 1.1.0
 */
function vmGetUnEscaped( $string ) {
	if (get_magic_quotes_gpc()==1) {
		// if (ini_get('magic_quotes_sybase')) return str_replace("''","'",$string);
		return ( stripslashes( $string ));			// this does not handle it correctly if magic_quotes_sybase is ON.
	} else {
		return ( $string );
	}
}

/**
 * Reads a file and sends them in chunks to the browser
 * This should overcome memory problems
 * http://www.php.net/manual/en/function.readfile.php#54295
 *
 * @since 1.0.3
 * @param string $filename
 * @param boolean $retbytes
 * @return mixed
 */
function vmReadFileChunked($filename,$retbytes=true) {
	$chunksize = 1*(1024*1024); // how many bytes per chunk
	$buffer = '';
	$cnt =0;
	// $handle = fopen($filename, 'rb');
	$handle = fopen($filename, 'rb');
	if ($handle === false) {
		return false;
	}
	// Prevent time outs on big files
	@set_time_limit(0);
	// PHP on Windows has a useless "usleep" function until 5.0.0
	if( substr( strtoupper( PHP_OS ), 0, 3 ) == 'WIN' && version_compare( phpversion(), '5.0' ) < 0 ) {
		$sleepfunc = 'sleep';
		$time = 1; // sec.
	} else {
		$sleepfunc = 'usleep';
		$time = 100; // msec.
	}
	while (!feof($handle)) {
		$buffer = fread($handle, $chunksize);
		echo $buffer;
		$sleepfunc($time);
		@ob_flush();
		flush();
		if ($retbytes) {
			$cnt += strlen($buffer);
		}
	}
	$status = fclose($handle);
	if ($retbytes && $status) {
		return $cnt; // return num. bytes delivered like readfile() does.
	}
	return $status;
}

/**
 * Returns the charset string from the global _ISO constant
 *
 * @return string UTF-8 by default
 * @since 1.0.5
 */
function vmGetCharset() {
	$iso = explode( '=', @constant('_ISO') );
	if( !empty( $iso[1] )) {
		return $iso[1];
	}
	else {
		return 'UTF-8';
	}
}
/**
 * Create a file system - safe file name
 *
 * @param string $filename
 * @since 1.1.0
 */
function vmSafeFileName( $filename ) {
	
	$filename = str_replace(' ', '_', $filename );
	$filename = str_replace('/', '-', $filename );
	$filename = str_replace('\\', '-', $filename );
	$filename = str_replace('`', '', $filename );
	$filename = str_replace('´', '', $filename );
	$filename = str_replace('\'', '', $filename );
	$filename = str_replace(':', '-', $filename );
	$filename = str_replace('?', '-', $filename );
	$filename = str_replace('*', '-', $filename );
	$filename = str_replace('"', '-', $filename );
	$filename = str_replace('<', '-', $filename );
	$filename = str_replace('>', '-', $filename );
	$filename = str_replace('|', '-', $filename );
	
	return $filename;
}
function vmIsAdminMode() {
	global $page;
	return ( defined( '_VM_IS_BACKEND' ) 
	|| @$_REQUEST['pshop_mode'] == 'admin' 
	|| stristr($page,"form")
	|| stristr($page, "list")
	|| stristr($page, "cfg")
	|| stristr($page, "print")
	|| stristr($page, "display"));
}


function vmCreateHash( $seed='virtuemart' ) {
    return md5( ENCODE_KEY . md5( $seed ) );
}


/**
 * Equivalent to Joomla's josSpoofCheck function
 * @author Joomla core team
 *
 * @param boolean $header
 * @param unknown_type $alt
 */
function vmSpoofCheck( $header=NULL, $alt=NULL ) {	
	$validate 	= vmGet( $_POST, vmSpoofValue($alt), 0 );
	
	// probably a spoofing attack
	if (!$validate) {
		header( 'HTTP/1.0 403 Forbidden' );
		mosErrorAlert( $VM_LANG->_('NOT_AUTH') );
		return;
	}
	
	// First, make sure the form was posted from a browser.
	// For basic web-forms, we don't care about anything
	// other than requests from a browser:   
	if (!isset( $_SERVER['HTTP_USER_AGENT'] )) {
		header( 'HTTP/1.0 403 Forbidden' );
		mosErrorAlert( $VM_LANG->_('NOT_AUTH') );
		return;
	}
	
	// Make sure the form was indeed POST'ed:
	//  (requires your html form to use: action="post")
	if (!$_SERVER['REQUEST_METHOD'] == 'POST' ) {
		header( 'HTTP/1.0 403 Forbidden' );
		mosErrorAlert( $VM_LANG->_('NOT_AUTH') );
		return;
	}
	
	if ($header) {
	// Attempt to defend against header injections:
		$badStrings = array(
			'Content-Type:',
			'MIME-Version:',
			'Content-Transfer-Encoding:',
			'bcc:',
			'cc:'
		);
		
		// Loop through each POST'ed value and test if it contains
		// one of the $badStrings:
		foreach ($_POST as $k => $v){
			foreach ($badStrings as $v2) {
				if (strpos( $v, $v2 ) !== false) {
					header( "HTTP/1.0 403 Forbidden" );
					mosErrorAlert( $VM_LANG->_('NOT_AUTH') );
					return;
				}
			}
		}   
		
		// Made it past spammer test, free up some memory
		// and continue rest of script:   
		unset($k, $v, $v2, $badStrings);
	}
}
/**
 * Equivalent to Joomla's josSpoofValue function
 *
 * @param boolean $alt
 * @return string Validation Hash
 */
function vmSpoofValue($alt=NULL) {
	global $mainframe, $_VERSION;
	
	if ($alt) {
		if ( $alt == 1 ) {
			$random		= date( 'Ymd' );
		} else {
			$random		= $alt . date( 'Ymd' );
		}
	} else {		
		$random		= date( 'dmY' );
	}
	$validate 	= vmCreateHash( $mainframe->getCfg( 'db' ) . $random );
	
	if( $_VERSION->DEV_LEVEL >= 11 ) {
		// Joomla 1.0.11 compatibility workaround
		// the prefix ensures that the hash is non-numeric
		// otherwise it will be intercepted by globals.php
		$validate = 'j' . $validate;
	}
	
	return $validate;
}

/**
 * This function creates the superglobal variable $product_currency
 * This variable is used for currency conversion
 *
 */
function vmSetGlobalCurrency(){
	global $page, $vendor_accepted_currencies, $vendor_currency, $vmLogger;

	if( !defined('_VM_IS_BACKEND') && empty( $_REQUEST['ajax_request']) && empty($_REQUEST['pshop_mode'])) {
		if( isset( $_REQUEST['product_currency']) ) {
			$GLOBALS['product_currency'] = $_SESSION['product_currency'] = vmGet($_REQUEST, 'product_currency' );
		}
	}
	$GLOBALS['product_currency'] = vmGet($_SESSION, 'product_currency', $vendor_currency);
	
	// Check if the selected currency is accepted! (the vendor currency is always accepted)
	if( $GLOBALS['product_currency'] != $vendor_currency ) {
		if( empty( $vendor_accepted_currencies )) {
			$vendor_accepted_currencies = $vendor_currency;
		}
		
		$acceptedCurrencies = explode(',', $vendor_accepted_currencies );
		if( !in_array( $GLOBALS['product_currency'], $acceptedCurrencies) 
				&& (stristr( $page, 'checkout.') || stristr( $page, 'account.') || stristr( $page, 'shop.cart')) ) {
			// Fallback to global vendor currency (as set in the store form)
			$vmLogger->warning( 'The Currency you had selected ('.$GLOBALS['product_currency'].') is not accepted for Checkout.');
			$GLOBALS['product_currency'] = $vendor_currency;
		}
	}
}

function vmIsJoomla( $version='', $operator='=', $compare_minor_versions=true) {
	$this_version = '';
	if( !empty($GLOBALS['_VERSION']) && is_object($GLOBALS['_VERSION'])) {
		$jversion =& $GLOBALS['_VERSION'];
		$this_version = $jversion->RELEASE;
	}
	elseif ( defined('JVERSION')) {
		$jversion = new JVersion();
		$this_version = $jversion->RELEASE;
	}
	if( !$compare_minor_versions ) $this_version .= '.'. $jversion->DEV_LEVEL;
	if( empty( $version ) ) {
		return !empty($this_version) && strtolower($jversion->PRODUCT) == 'joomla!';
	}
	$allowed_operators = array( '<', 'lt', '<=', 'le', '>', 'gt', '>=', 'ge', '==', '=', 'eq', '!=', '<>', 'ne' );
	
	if( $compare_minor_versions ) {
		if( $jversion->RELEASE != $version ) {
			return false;
		}
	}
	if( in_array($operator, $allowed_operators )) {
		return version_compare( $this_version, $version, $operator );
	}
	return false;
}
function vmIsHttpsMode() {
	return ($_SERVER['SERVER_PORT'] == 443 || @$_SERVER['HTTPS'] == 'on');
}
/**
* Utility function redirect the browser location to another url
*
* Can optionally provide a message.
* @param string The URL to redirect to
* @param string A Message to display to the user
*/
function vmRedirect( $url, $msg ) {
	if( function_exists('mosRedirect')) {
		mosRedirect($url, $msg );
	} else {
	   global $mainframe;
	
	    // specific filters
		$iFilter = vmInputFilter::getInstance();
		$url = $iFilter->process( $url );
		if (!empty($msg)) {
			$msg = $iFilter->process( $msg );
		}
	
		// Strip out any line breaks and throw away the rest
		$url = preg_split("/[\r\n]/", $url);
		$url = $url[0];
	
		if ($iFilter->badAttributeValue( array( 'href', $url ))) {
			$url = $GLOBALS['mosConfig_live_site'];
		}
	
		if (trim( $msg )) {
		 	if (strpos( $url, '?' )) {
				$url .= '&mosmsg=' . urlencode( $msg );
			} else {
				$url .= '?mosmsg=' . urlencode( $msg );
			}
		}
	
		if (headers_sent()) {
			echo '<script type="text/javascript">document.location.href=\''.$url.'\';</script>';
		} else {
			@ob_end_clean(); // clear output buffer
			header( 'HTTP/1.1 301 Moved Permanently' );
			header( "Location: ". $url );
		}
		$GLOBALS['vm_mainframe']->close(true);
	}
}
/**
 * Raise the memory limit when it is lower than the needed value
 *
 * @param string $setLimit Example: 16M
 */
function vmRaiseMemoryLimit( $setLimit ) {
	
	$memLimit = @ini_get('memory_limit');
	
	if( stristr( $memLimit, 'k') ) {
		$memLimit = str_replace( 'k', '', str_replace( 'K', '', $memLimit )) * 1024;
	}
	elseif( stristr( $memLimit, 'm') ) {
		$memLimit = str_replace( 'm', '', str_replace( 'M', '', $memLimit )) * 1024 * 1024;
	}
	
	if( stristr( $setLimit, 'k') ) {
		$setLimitB = str_replace( 'k', '', str_replace( 'K', '', $setLimit )) * 1024;
	}
	elseif( stristr( $setLimit, 'm') ) {
		$setLimitB = str_replace( 'm', '', str_replace( 'M', '', $setLimit )) * 1024 * 1024;
	}
	
	if( $memLimit < $setLimitB ) {
		@ini_set('memory_limit', $setLimit );
	}	
}
/**
 * Returns a formatted date
 *
 * @param int $time TimeStamp format
 * @param String $dateformat strftime Format String
 * @return String
 */
function vmFormatDate( $time=0, $dateformat='' ) {
	global $vendor_date_format;
	if( empty($time)) $time = time();
	
	if( empty( $dateformat )) {
		return strftime( $vendor_date_format, $time );
	} else {
		return strftime( $dateformat, $time );
	}
}
/**
* Function to strip additional / or \ in a path name
* @param string The path
* @param boolean Add trailing slash
*/
function vmPathName($p_path,$p_addtrailingslash = true) {
	$retval = "";

	$isWin = (substr(PHP_OS, 0, 3) == 'WIN');

	if ($isWin)	{
		$retval = str_replace( '/', '\\', $p_path );
		if ($p_addtrailingslash) {
			if (substr( $retval, -1 ) != '\\') {
				$retval .= '\\';
			}
		}

		// Check if UNC path
		$unc = substr($retval,0,2) == '\\\\' ? 1 : 0;

		// Remove double \\
		$retval = str_replace( '\\\\', '\\', $retval );

		// If UNC path, we have to add one \ in front or everything breaks!
		if ( $unc == 1 ) {
			$retval = '\\'.$retval;
		}
	} else {
		$retval = str_replace( '\\', '/', $p_path );
		if ($p_addtrailingslash) {
			if (substr( $retval, -1 ) != '/') {
				$retval .= '/';
			}
		}

		// Check if UNC path
		$unc = substr($retval,0,2) == '//' ? 1 : 0;

		// Remove double //
		$retval = str_replace('//','/',$retval);

		// If UNC path, we have to add one / in front or everything breaks!
		if ( $unc == 1 ) {
			$retval = '/'.$retval;
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
function vmReadDirectory( $path, $filter='.', $recurse=false, $fullpath=false  ) {
	$arr = array();
	if (!@is_dir( $path )) {
		return $arr;
	}
	$handle = opendir( $path );

	while ($file = readdir($handle)) {
		$dir = vmPathName( $path.'/'.$file, false );
		$isDir = is_dir( $dir );
		if (($file != ".") && ($file != "..")) {
			if (preg_match( "/$filter/", $file )) {
				if ($fullpath) {
					$arr[] = trim( vmPathName( $path.'/'.$file, false ) );
				} else {
					$arr[] = trim( $file );
				}
			}
			if ($recurse && $isDir) {
				$arr2 = vmReadDirectory( $dir, $filter, $recurse, $fullpath );
				$arr = array_merge( $arr, $arr2 );
			}
		}
	}
	closedir($handle);
	asort($arr);
	return $arr;
}
/**
 * Utility function to return a value from a named array or a specified default
 *
 * @static
 * @param	array	$array		A named array
 * @param	string	$name		The key to search for
 * @param	mixed	$default	The default value to give if no key found
 * @param	string	$type		Return type for the variable (INT, FLOAT, STRING, WORD, BOOLEAN, ARRAY)
 * @return	mixed	The value from the source array
 * @since	1.1
 */
function vmGetArrayValue(&$array, $name, $default=null, $type='') {
	// Initialize variables
	$result = null;

	if (isset ($array[$name])) {
		$result = $array[$name];
	}

	// Handle the default case
	if ((is_null($result))) {
		$result = $default;
	}

	// Handle the type constraint
	switch (strtoupper($type)) {
		case 'INT' :
		case 'INTEGER' :
			// Only use the first integer value
			@ preg_match('/-?[0-9]+/', $result, $matches);
			$result = @ (int) $matches[0];
			break;

		case 'FLOAT' :
		case 'DOUBLE' :
			// Only use the first floating point value
			@ preg_match('/-?[0-9]+(\.[0-9]+)?/', $result, $matches);
			$result = @ (float) $matches[0];
			break;

		case 'BOOL' :
		case 'BOOLEAN' :
			$result = (bool) $result;
			break;

		case 'ARRAY' :
			if (!is_array($result)) {
				$result = array ($result);
			}
			break;

		case 'STRING' :
			$result = (string) $result;
			break;

		case 'WORD' :
			$result = (string) preg_replace( '#\W#', '', $result );
			break;

		case 'NONE' :
		default :
			// No casting necessary
			break;
	}
	return $result;
}

function vmGetCleanArrayFromKeyword( $keyword ) {
	global $db;
	$keywordArr = array();

	if( empty( $keyword )) return $keywordArr;
	
	$keywords = explode( " ", $keyword, 10 );

	foreach( $keywords as $searchstring ) {
		$searchstring = trim( stripslashes($searchstring) );
		
		if( !empty( $searchstring )) {
			if( $searchstring[0] == "\"" || $searchstring[0]=="'" )  {
				$searchstring[0] = " ";
			}
			if( $searchstring[strlen($searchstring)-1] == "\"" || $searchstring[strlen($searchstring)-1]=="'" ) {
				$searchstring[strlen($searchstring)-1] = " ";
			}
			$searchstring = $db->getEscaped( $searchstring );
			$searchstring = str_replace('\"', '"', $searchstring );
		
			$keywordArr[] = $searchstring;
		}
	}
	return $keywordArr;
}
?>