<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shop.getfile.php,v 1.2 2005/01/27 19:34:03 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );

require_once( CLASSPATH . 'ps_product_files.php' );

$product_id = intval(mosgetparam($_REQUEST, "product_id", null));
$file_id = intval(mosgetparam($_REQUEST, "file_id", null));

if( !empty($product_id) && !empty($file_id) ) {
  ps_product_files::send_file( $file_id, $product_id );
}
?>
