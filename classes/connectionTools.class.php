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

}
?>