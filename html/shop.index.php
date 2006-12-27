<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: shop.index.php 431 2006-10-17 21:55:46 +0200 (Di, 17 Okt 2006) soeren_nb $
* @package VirtueMart
* @subpackage html
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
require_once( CLASSPATH . 'ps_product.php');
require_once( CLASSPATH . 'ps_product_category.php');
$ps_product_category = new ps_product_category();

// Show only top level categories and categories that are
// being published
$tpl = new $GLOBALS['VM_THEMECLASS']();
$category_childs = $ps_product_category->get_child_list($category_id);
$tpl->set( 'categories', $category_childs );

echo $tpl->fetch_cache( 'common/categoryChildlist.tpl.php');

echo $vendor_store_desc;

?>