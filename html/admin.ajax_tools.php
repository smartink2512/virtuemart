<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2006 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

$task = strtolower( mosGetParam( $_REQUEST, 'task' ));
$option = strtolower( mosGetParam( $_REQUEST, 'option' ));
require_once( CLASSPATH.'connectionTools.class.php');

switch( $task ) {
	case 'get_class_methods':
		$classfile = basename( mosGetParam( $_REQUEST, 'class' ) ).'.php';
		$function = mosGetParam( $_REQUEST, 'function' );
		
		if( file_exists(CLASSPATH. $classfile )) {
			require_once( CLASSPATH.$classfile);
			$class = str_replace( '.class', '', $class );
			$methods = get_class_methods( $class );
			if( empty( $methods )) {
				$methods = get_class_methods( 'vm'.$class );	
			}
			$method_array = array();
			foreach( $methods as $method ) {
				if( $method == $class ) continue;
				$method_array[$method] = $method;
			}
			vmConnector::sendHeaderAndContent( 200, ps_html::selectList( 'function_method', $function, $method_array ) );
			
		}
		break;
		
	default: die;
	
}
exit;
?>