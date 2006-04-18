<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
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
 * Provides general tools to handle connections (http, headers, ... )
 * @author soeren
 * @since VirtueMart 1.1.0
 */
class vmConnector {
	
	var $handle = null;
	
	/**
	 * Clears the output buffer, sends a http status code and a content if given
	 *
	 * @param int $http_status
	 * @param string $mime_type
	 * @param string $content
	 */
	function sendHeaderAndContent( $http_status=200, $content='', $mime_type='text/html' ) {
	
		// Clear all Joomla header and buffer stuff
		while( @ob_end_clean() );
		
		$http_status = intval( $http_status );
		header("HTTP/1.0 $http_status");
		if( $mime_type ) {
			header( "Content-type: $mime_type");
		}
		if( $content ) {
			echo $content;
		}
	}
	function handleCommunication( $url, $postData='') {
		global $vmLogger;
		$urlParts = parse_url( $url );
		
		if( function_exists( "curl_init" )) {

			$vmLogger->debug( 'Using the cURL library for communicating with '.$urlParts['host'] );

			$CR = curl_init();
			curl_setopt($CR, CURLOPT_URL, $urlParts['scheme'].'://'.$urlParts['host'].':'.$urlParts['port'].$urlParts['path']);
			
			curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($CR, CURLOPT_FAILONERROR, true);
			if( $postData ) {
				curl_setopt($CR, CURLOPT_POSTFIELDS, $postData );
				curl_setopt($CR, CURLOPT_POST, 1);
			}
			if( $urlParts['scheme'] == 'https') {
				// No PEER certificate validation...as we don't have
				// a certificate file for it to authenticate the host www.ups.com against!
				curl_setopt($CR, CURLOPT_SSL_VERIFYPEER, 0);
				//curl_setopt($CR, CURLOPT_SSLCERT , "/usr/locale/xxxx/clientcertificate.pem");
			}
			$result = curl_exec( $CR );
			$error = curl_error( $CR );
			curl_close( $CR );
			
			if( !empty( $error )) {
				$vmLogger->err( $error );
				return false;
			}
			else {
				return $result;
			}
		}
		else {
			if( $postData ) {
				if( $urlParts['scheme'] == 'https'){
					$protocol = 'ssl';
				}
				else {
					$protocol = $urlParts['scheme'];
				}
				$fp = fsockopen("$protocol://".$urlParts['host'], $urlParts['port'], $errno, $errstr, $timeout = 30);
			}
			else {
				// Do a read-only fopen transaction
				$fp = fopen( $urlParts['scheme'].'://'.$urlParts['host'].':'.$urlParts['port'].$urlParts['path'], 'r' );
			}
			if(!$fp){
				//error tell us
				$vmLogger->err( "Possible server error! - $errstr ($errno)\n" );
				return false;
			}
			else {
				$vmLogger->debug( 'Connection opened to '.$urlParts['host']);
			}
			if( $postData ) {
				$vmLogger->debug('Now posting the variables.' );
				//send the server request
				fputs($fp, 'POST '.$urlParts['path']." HTTP/1.1\r\n");
				fputs($fp, 'Host:'. $urlParts['host']."\r\n");
				fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
				fputs($fp, "Content-length: ".strlen($postData)."\r\n");
				fputs($fp, "Connection: close\r\n\r\n");
				fputs($fp, $postData . "\r\n\r\n");
			}

			$data = "";
			while (!feof($fp)) {
				$data .= fgets ($fp, 4096);
			}
			
			// If didnt get content-lenght, something is wrong, return false.
			if (!stristr($data, 'content-length')) {
				$vmLogger->err('An error occured while communicating with the authorize.net server. It didn\'t reply (correctly). Please try again later, thank you.' );
				return false;
			}
			$result = trim( $data );
			
			return $result;
		}
	}
}
?>