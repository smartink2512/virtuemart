<?php
/**
* This file is used to send gzipped Javascripts and Stylesheets to the browser
* 
* It expects three parameters:
* 
* gzip (can be 1 or 0, for yes or no; default: 0)
* subdir (relative directory from /components/com_virtuemart/js)
* file (filename only)
*
* @version $Id$
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2006 Soeren Eberhardt. All rights reserved.
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
 * Initialise GZIP
 * @author Mambo / Joomla Project
 */
function initGzip() {
	global $do_gzip_compress;
	
	$gzip = isset( $_GET['gzip'] ) ? (boolean)$_GET['gzip'] : false;
	
	$do_gzip_compress = FALSE;
	if ($gzip) {
		$phpver 	= phpversion();
		$useragent 	= isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : '';
		$canZip 	= isset( $_SERVER['HTTP_ACCEPT_ENCODING'] ) ? $_SERVER['HTTP_ACCEPT_ENCODING'] : '';
		
		$gzip_check 	= 0;
		$zlib_check 	= 0;
		$gz_check		= 0;
		$zlibO_check	= 0;
		$sid_check		= 0;
		if ( strpos( $canZip, 'gzip' ) !== false) {
			$gzip_check = 1;
		}		
		if ( extension_loaded( 'zlib' ) ) {
			$zlib_check = 1;
		}		
		if ( function_exists('ob_gzhandler') ) {
			$gz_check = 1;
		}
		if ( ini_get('zlib.output_compression') ) {
			$zlibO_check = 1;
		}
		if ( ini_get('session.use_trans_sid') ) {
			$sid_check = 1;
		}

		if ( $phpver >= '4.0.4pl1' && ( strpos($useragent,'compatible') !== false || strpos($useragent,'Gecko')	!== false ) ) {
			// Check for gzip header or norton internet securities or session.use_trans_sid
			if ( ( $gzip_check || isset( $_SERVER['---------------']) ) && $zlib_check && $gz_check && !$zlibO_check && !$sid_check ) {
				// You cannot specify additional output handlers if
				// zlib.output_compression is activated here
				ob_start( 'ob_gzhandler' );
				return;
			}
		} else if ( $phpver > '4.0' ) {
			if ( $gzip_check ) {
				if ( $zlib_check ) {
					$do_gzip_compress = TRUE;
					ob_start();
					ob_implicit_flush(0);
					
					header( 'Content-Encoding: gzip' );
					return;
				}
			}
		}
	}
	ob_start();
}

/**
* Perform GZIP
* @author Mambo / Joomla project
*/
function doGzip() {
	global $do_gzip_compress;
	if ( $do_gzip_compress ) {
		/**
		*Borrowed from php.net!
		*/
		$gzip_contents = ob_get_contents();
		ob_end_clean();

		$gzip_size = strlen($gzip_contents);
		$gzip_crc = crc32($gzip_contents);

		$gzip_contents = gzcompress($gzip_contents, 9);
		$gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);

		echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
		echo $gzip_contents;
		echo pack('V', $gzip_crc);
		echo pack('V', $gzip_size);
	} else {
		ob_end_flush();
	}
}
function cssUrl( $ref, $subdir ) {
	$ref = str_replace( "'", '', stripslashes( trim($ref) ));
	$ref = str_replace( '"', '', $ref);
	if( $subdir[0] == '/' ) {
		$subdir = substr( $subdir, 1 );
	}
	return 'url( "'. $subdir.'/'.str_replace( '../', '', $ref ).'" )';
}

initGzip();

$base_dir = dirname( __FILE__ );
$subdir = $_GET['subdir'];
$dir = realpath( $base_dir . '/' .  $subdir );

$file = $dir . '/' . basename( $_GET['file'] );

if( !file_exists( $file ) || !stristr( $dir, $base_dir )) {
	die();
}

$fileinfo = pathinfo( $file );
switch ( $fileinfo['extension']) {
	case 'css': 
		$mime_type = 'text/css'; 
		header( 'Content-Type: '.$mime_type.';');
		$css = implode( '', file( $file ));
		
		$str_css =   preg_replace("/url\((.+?)\)/ie","cssUrl('\\1', '$subdir')", $css);
		echo $str_css;
		
		break;
		
	case 'js': 
		$mime_type = 'text/javascript'; 
		header( 'Content-Type: '.$mime_type.';');
		
		include( $file );
		
		break;
		
	default: 
		die();
	
}

doGzip();

exit;

?>