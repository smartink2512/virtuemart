<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shop.tos.php,v 1.3 2005/01/27 19:34:03 soeren_nb Exp $
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

$db = new ps_DB;
$ps_vendor_id = $_SESSION['ps_vendor_id'];

$q = "SELECT vendor_terms_of_service FROM #__pshop_vendor ";
$q .= "WHERE vendor_id='".$ps_vendor_id."'";

$db->query($q);
$db->next_record();
$db->p("vendor_terms_of_service");

?>
