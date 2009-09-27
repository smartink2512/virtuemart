<?php 
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @version $Id: shop.infopage.php 1755 2009-05-01 22:45:17Z rolandd $
* @package JMart
* @subpackage html
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* JMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_jmart/COPYRIGHT.php for copyright notices and details.
*
* http://joomlacode.org/gf/project/jmart/
*/
mm_showMyFileName( __FILE__ );

require_once(CLASSPATH . 'ps_product.php');
$ps_product = new ps_product;
require_once(CLASSPATH . 'ps_product_category.php');
$ps_product_category = new ps_product_category;
require_once(CLASSPATH . 'ps_product_attribute.php');
$ps_product_attribute = new ps_product_attribute;

$vendor_id = vmGet($_GET, 'vendor_id', 1 );

if( intval($vendor_id) == 0 ) {
	return;
}
//added by Max Milbers
$db = ps_vendor::get_vendor_details($vendor_id);

if( !$db->next_record() ) {
	return;
}

$tpl = vmTemplate::getInstance();
$tpl->set_vars(array('v_name'=>$db->f("vendor_name"),
					'v_address_1' => $db->f("address_1"),
					'v_address_2' => $db->f("address_2"),
					'v_zip' => $db->f("zip"),
					'v_city' => $db->f("city"),
					'v_title' => $db->f("title"),
					'v_first_name' => $db->f("first_name"),
					'v_last_name' => $db->f("last_name"),
					'v_fax' => $db->f("fax"),
					'v_email' => $db->f("email"),
					'v_logo' => $db->f("vendor_full_image"),
					'v_category' => $db->f("vendor_store_name"),
					'db' => $db
					)
);
echo $tpl->fetch('pages/shop.infopage.tpl.php');
?>
   