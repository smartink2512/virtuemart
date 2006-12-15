<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* Header file for the shop administration.
* shows all modules that are available to the user in a dropdown menu
*
* @version $Id$
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2004-2006 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );
include_once( ADMINPATH . "version.php" );

global $error, $page, $ps_product, $ps_product_category;
$product_id = mosGetParam( $_REQUEST, 'product_id' );
$module_id = mosGetParam( $_REQUEST, 'module_id', '' );

if( is_array( $product_id )) {
    $recent_product_id = "";
}
else {
    $recent_product_id = $product_id;
}
        
$mod = array();
$q = "SELECT module_name,module_perms from #__{vm}_module WHERE module_publish='Y' ";
$q .= "AND module_name <> 'checkout' ORDER BY list_order ASC";
$db->query($q);

while ($db->next_record()) {
    if ($perm->check($db->f("module_perms"))) {
        $mod[] = $db->f("module_name");
	}
}
/*
if (!defined('_PSHOP_ADMIN')) {
  	$my_path = "includes/js/ThemeOffice/";
  	if( stristr( $_SERVER['PHP_SELF'], "index2.php" )) {
		echo '<script type="text/javascript" src="includes/js/mambojavascript.js"></script>
		<a href="index.php" title="Back"><h3>&nbsp;&nbsp;&gt;&gt; '.$VM_LANG->_PHPSHOP_BACK_TO_MAIN_SITE.' &lt;&lt;</h3></a>';
  	}
  	// We need the admin template css now, but which one? - so check here
  	$adminTemplate = $_VERSION->PRODUCT == 'Joomla!' ? 'joomla_admin' : 'mambo_admin_blue';
	?>
	<link rel="stylesheet" href="administrator/templates/<?php echo $adminTemplate; ?>/css/template_css.css" type="text/css" />
    <?php 
}
else {
  $my_path = "../includes/js/ThemeOffice/";
}
*/

$mainframe->addCustomHeadTag('<link rel="stylesheet" type="text/css" href="'.$mosConfig_live_site.'/components/com_virtuemart/js/admin_menu/css/menu.css" />');
$mainframe->addCustomHeadTag('<link rel="stylesheet" type="text/css" href="'.VM_THEMEURL.'admin.styles.css" />');
$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$mosConfig_live_site.'/components/com_virtuemart/js/admin_menu/js/virtuemart_menu.js"></script>');
$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$mosConfig_live_site.'/components/com_virtuemart/js/admin_menu/js/nifty.js"></script>');
$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$mosConfig_live_site.'/components/com_virtuemart/js/admin_menu/js/fat.js"></script>');
$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$mosConfig_live_site.'/components/com_virtuemart/js/functions.js"></script>');

?>
<script type="text/javascript">
window.onload=function(){
	Fat.fade_all();
	if(!NiftyCheck()) alert("hello");
	Rounded("div.sidemenu-box","all","#fff","#f7f7f7","border #ccc");
	Rounded("div.element-box","all","#fff","#fff","border #ccc");
	Rounded("div.toolbar-box","all","#fff","#fbfbfb","border #ccc");
	Rounded("div.submenu-box","all","#fff","#f2f2f2","border #ccc");

}
</script>

<div id="content-box2">
<div id="content-pad">
  <div class="sidemenu-box">
    <div class="sidemenu-pad">
		<center>
			<a href="http://virtuemart.net" target="_blank"><img align="middle" hspace="15" src="<?php echo IMAGEURL ?>ps_image/menu_logo.gif" alt="VirtueMart Cart Logo" /></a>
		</center>
		<center>
			<h2>
			<?php echo $VM_LANG->_PHPSHOP_ADMIN	?>
			</h2>
		</center>
		<div class="status-divider">
		</div>
		<div class="sidemenu" id="masterdiv2">
		<h3 class="title-smenu" title="admin" onclick="SwitchMenu('1')"><?php echo $VM_LANG->_PHPSHOP_ADMIN_MOD ?></h3>
				<div class="section-smenu">
			<ul>
			<li class="item-smenu vmicon-16-config">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=admin.show_cfg&amp;option=com_virtuemart") ?>"><?php echo $VM_LANG->_PHPSHOP_CONFIG ?></a>
			<hr />
			</li>
			<?php if (defined('_PSHOP_ADMIN')) { ?>
			<li class="item-smenu vmicon-16-user">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=admin.user_list") ?>"><?php echo $VM_LANG->_PHPSHOP_USERS ?></a>
			</li>
			<?php } ?>
			<li class="item-smenu vmicon-16-user">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=admin.usergroup_list") ?>"><?php echo $VM_LANG->_VM_USERGROUP_LBL ?></a>
			</li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=admin.user_field_list") ?>"><?php echo $VM_LANG->_VM_MANAGE_USER_FIELDS ?></a>
			<hr />
			</li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=admin.country_list") ?>"><?php echo $VM_LANG->_PHPSHOP_COUNTRY_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=admin.country_form") ?>"><?php echo $VM_LANG->_PHPSHOP_COUNTRY_LIST_ADD ?></a>
			<hr />
			</li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=admin.curr_list") ?>"><?php echo $VM_LANG->_PHPSHOP_CURRENCY_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=admin.curr_form") ?>"><?php echo $VM_LANG->_PHPSHOP_CURRENCY_LIST_ADD ?></a>
			<hr />
			</li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=admin.module_list") ?>"><?php echo $VM_LANG->_PHPSHOP_MODULE_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=admin.module_form") ?>"><?php echo $VM_LANG->_PHPSHOP_MODULE_FORM_MNU ?></a>
			</li>
			<?php if (!empty($module_id)) { ?>
			<hr /> 
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=admin.function_list&amp;module_id=".$module_id) ?>"><?php echo $VM_LANG->_PHPSHOP_FUNCTION_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=admin.function_form&amp;module_id=".$module_id) ?>"><?php echo $VM_LANG->_PHPSHOP_FUNCTION_FORM_MNU ?></a>
			</li>
			 <?php } ?>
			</ul>
			</div>
			<h3 class="title-smenu" title="store" onclick="SwitchMenu('2')">
			<?php echo $VM_LANG->_PHPSHOP_STORE_MOD
			?>
			</h3>
			<div class="section-smenu">
			<ul>
			<li class="item-smenu vmicon-16-info">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=store.index") ?>"><?php echo $VM_LANG->_PHPSHOP_STATISTIC_SUMMARY ?></a>
			</li>
			<li class="item-smenu vmicon-16-config">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=store.store_form") ?>"><?php echo $VM_LANG->_PHPSHOP_STORE_FORM_MNU ?></a>
			</li>
			<?php if ($_SESSION['auth']['perms'] != "admin" && defined('_PSHOP_ADMIN')) { ?>
			<li class="item-smenu vmicon-16-user">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=store.user_list") ?>"><?php echo $VM_LANG->_PHPSHOP_USERS_LIST_MNU ?></a>
			</li>
			<?php } ?>
			<li><hr /></li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=store.payment_method_list") ?>"><?php echo $VM_LANG->_PHPSHOP_PAYMENT_METHOD_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=store.payment_method_form") ?>"><?php echo $VM_LANG->_PHPSHOP_PAYMENT_METHOD_FORM_MNU ?></a>
			<hr />
			</li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->url($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=store.shipping_modules") ?>"><?php echo $VM_LANG->_VM_SHIPPING_MODULE_LIST_LBL ?></a>
			<hr />
			</li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=store.creditcard_list") ?>"><?php echo $VM_LANG->_PHPSHOP_CREDITCARD_LIST_LBL ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=store.creditcard_form") ?>"><?php echo $VM_LANG->_PHPSHOP_CREDITCARD_FORM_LBL ?></a>
			<hr />
			</li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=store.export_list") ?>>"><?php echo $VM_LANG->_VM_ORDER_EXPORT_MODULE_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=store.export_form") ?>"><?php echo $VM_LANG->_VM_ORDER_EXPORT_MODULE_LIST_MNU ?></a>
			</li>
			</ul>
			</div>
			<h3 class="title-smenu" title="shopper" onclick="SwitchMenu('3')">
			<?php echo $VM_LANG->_PHPSHOP_SHOPPER_MOD
			?>
			</h3>
			<div class="section-smenu">
			<ul>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=shopper.shopper_group_list") ?>"><?php echo $VM_LANG->_PHPSHOP_SHOPPER_GROUP_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=shopper.shopper_group_form") ?>"><?php echo $VM_LANG->_PHPSHOP_SHOPPER_GROUP_FORM_MNU ?></a>
			</li>
			</ul>
			</div>
			<h3 class="title-smenu" title="product" onclick="SwitchMenu('4')">
			<?php echo $VM_LANG->_PHPSHOP_PRODUCT_MOD;
			?>
			</h3>
			<div class="section-smenu">
			<ul>
			<?php include_class("product"); ?>
           	<li class="item-smenu vmicon-16-import">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?pshop_mode=admin&amp;page=product.csv_upload"); ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_CSV_UPLOAD ?></a>
			<hr />
			</li>
			<li><strong><?php echo $VM_LANG->_PHPSHOP_PRODUCT_MOD ?></strong></li>
			<?php    
            if (!empty($recent_product_id) && empty($_REQUEST['product_parent_id'])) { 
               	if (!isset($return_args)) $return_args = ""; ?> 
				<li><hr /></li>
						
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?pshop_mode=admin&page=product.product_attribute_list&product_id=$recent_product_id&return_args=" . urlencode($return_args)); ?>"><?php echo $VM_LANG->_PHPSHOP_ATTRIBUTE_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?pshop_mode=admin&page=product.product_attribute_form&product_id=$recent_product_id&return_args=" . urlencode($return_args)); ?>"><?php echo $VM_LANG->_PHPSHOP_ATTRIBUTE_FORM_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?pshop_mode=admin&page=product.product_price_list&product_id=$recent_product_id&return_args=" . urlencode($return_args)); ?>"><?php echo $VM_LANG->_PHPSHOP_PRICE_FORM_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?pshop_mode=admin&page=product.product_product_type_list&product_id=$recent_product_id&return_args=" . urlencode($return_args)); ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_MNU ?></a>
			</li>
			
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?pshop_mode=admin&page=product.product_product_type_form&product_id=$recent_product_id&return_args=" . urlencode($return_args)); ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_MNU ?></a>
			</li>
			<?php if ($ps_product->product_has_attributes($recent_product_id)) { ?>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?pshop_mode=admin&page=product.product_form&product_parent_id=$recent_product_id"); ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_FORM_ADD_ITEM_MNU ?></a>
			</li>
			</ul>
            <?php } ?>
            <?php }
            elseif (!empty($_REQUEST['product_parent_id'])) { ?> 
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php @$sess->purl($_SERVER['PHP_SELF'] . "?pshop_mode=admin&page=product.product_price_list&product_id=$recent_product_id&product_parent_id=$product_parent_id&return_args=" . urlencode($return_args)); ?>"><?php echo $VM_LANG->_PHPSHOP_PRICE_FORM_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?pshop_mode=admin&page=product.product_form&product_parent_id=" . $product_parent_id); ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_FORM_ADD_ANOTHER_ITEM_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php @$sess->purl($_SERVER['PHP_SELF'] . "?pshop_mode=admin&page=product.product_product_type_list&product_id=$recent_product_id&product_parent_id=$product_parent_id&return_args=" . urlencode($return_args)); ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?pshop_mode=admin&page=product.product_form&product_id=" . $product_parent_id); ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_FORM_RETURN_LBL ?></a>
			</li>
            <?php } ?>
            
            <li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=product.product_list") ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_LIST_MNU ?></a>
			</li>
            <li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=product.product_form") ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_FORM_MNU ?></a>
			</li>
			<?php 
            if( !empty($recent_product_id) ) { ?>
            <li class="item-smenu vmicon-16-media">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?pshop_mode=admin&page=product.file_form&product_id=$recent_product_id"); ?>"><?php echo $VM_LANG->_PHPSHOP_FILEMANAGER_ADD ?></a>
			</li>
            <?php } ?>
           <li class="item-smenu vmicon-16-install">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?pshop_mode=admin&page=product.product_inventory"); ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_INVENTORY_MNU ?></a>
			</li>
             <li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=product.specialprod") ?>"><?php echo $VM_LANG->_PHPSHOP_SPECIAL_PRODUCTS ?></a>
			</li>
             <li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=product.folders") ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_FOLDERS  ?></a>
			<hr />			
			</li>
			
			 <li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=product.product_discount_list") ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_DISCOUNT_LIST_LBL ?></a>
			</li>
			 <li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=product.product_discount_form") ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_DISCOUNT_ADDEDIT ?></a>
			<hr />	
			</li>
		    <li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=product.product_type_list") ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_TYPE_LIST_LBL ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=product.product_type_form") ?>"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_TYPE_ADDEDIT ?></a>
			<hr />	
			</li>
     		<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=product.product_category_list") ?>"><?php echo $VM_LANG->_PHPSHOP_CATEGORY_LIST_MNU ?></a>
			</li>
			 <li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=product.product_category_form") ?>"><?php echo $VM_LANG->_PHPSHOP_CATEGORY_FORM_MNU ?></a>
			</li>
			</div>
			<h3 class="title-smenu" title="order" onclick="SwitchMenu('5')">
			<?php echo $VM_LANG->_PHPSHOP_ORDER_MOD
			?>
			</h3>
			<div class="section-smenu">
			<ul>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=order.order_list") ?>"><?php echo $VM_LANG->_PHPSHOP_ORDER_LIST_MNU ?></a>
			<hr />
			</li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=order.order_status_list") ?>"><?php echo $VM_LANG->_PHPSHOP_ORDER_STATUS_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=order.order_status_form") ?>"><?php echo $VM_LANG->_PHPSHOP_ORDER_STATUS_FORM_MNU ?></a>
			</li>
		
			</ul>
			</div>
			<h3 class="title-smenu" title="vendor" onclick="SwitchMenu('6')">
			<?php echo $VM_LANG->_PHPSHOP_VENDOR_MOD
			?>
			</h3>
			<div class="section-smenu">
			<ul>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=vendor.vendor_list") ?>"><?php echo $VM_LANG->_PHPSHOP_VENDOR_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=vendor.vendor_form") ?>"><?php echo $VM_LANG->_PHPSHOP_VENDOR_FORM_MNU ?></a>
			<hr />
			</li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=vendor.vendor_category_list") ?>"><?php echo $VM_LANG->_PHPSHOP_VENDOR_CAT_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=vendor.vendor_category_form") ?>"><?php echo $VM_LANG->_PHPSHOP_VENDOR_CAT_FORM_MNU ?></a>
			</li>
			</ul>
			</div>
			<h3 class="title-smenu" title="report" onclick="SwitchMenu('7')">
			<?php echo $VM_LANG->_PHPSHOP_REPORTBASIC_MOD
			?>
			</h3>
			<div class="section-smenu">
			<ul>
			<li class="item-smenu vmicon-16-info">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=reportbasic.index") ?>"><?php echo $VM_LANG->_PHPSHOP_REPORTBASIC_MOD ?></a>
			</li>
			</ul>
			</div>
			<h3 class="title-smenu" title="tax" onclick="SwitchMenu('8')">
			<?php echo $VM_LANG->_PHPSHOP_TAX_MOD
			?>
			</h3>
			<div class="section-smenu">
			<ul>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=tax.tax_list") ?>"><?php echo $VM_LANG->_PHPSHOP_TAX_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=tax.tax_form") ?>"><?php echo $VM_LANG->_PHPSHOP_TAX_FORM_MNU ?></a>
			</li>
			</ul>
			</div>
			<h3 class="title-smenu" title="coupon" onclick="SwitchMenu('9')">
			<?php echo $VM_LANG->_PHPSHOP_COUPON_MOD
			?>
			</h3>
			<div class="section-smenu">
			<ul>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=coupon.coupon_list") ?>"><?php echo $VM_LANG->_PHPSHOP_COUPON_LIST ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=coupon.coupon_form") ?>"><?php echo $VM_LANG->_PHPSHOP_COUPON_NEW_HEADER ?></a>
			</li>
			</ul>
			</div>
			<h3 class="title-smenu" title="manufactor" onclick="SwitchMenu('10')">
			<?php echo $VM_LANG->_PHPSHOP_MANUFACTURER_MOD
			?>
			</h3>
			<div class="section-smenu">
			<ul>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=manufacturer.manufacturer_list") ?>"><?php echo $VM_LANG->_PHPSHOP_MANUFACTURER_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=manufacturer.manufacturer_form") ?>"><?php echo $VM_LANG->_PHPSHOP_MANUFACTURER_FORM_MNU ?></a>
			<hr />
			</li>
			<li class="item-smenu vmicon-16-content">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=manufacturer.manufacturer_category_list") ?>"><?php echo $VM_LANG->_PHPSHOP_MANUFACTURER_CAT_LIST_MNU ?></a>
			</li>
			<li class="item-smenu vmicon-16-editadd">
			<a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=manufacturer.manufacturer_category_form") ?>"><?php echo $VM_LANG->_PHPSHOP_MANUFACTURER_CAT_FORM_MNU ?></a>
			</li>
			</ul>
			</div>
			<h3 class="title-smenu" title="about" onclick="SwitchMenu('11')">
			<?php echo $VM_LANG->_PHPSHOP_HELP_MOD
			?>
			</h3>
			<div class="section-smenu">
			<ul>
			<li class="item-smenu vmicon-16-info">
			<a href="<?php echo $sess->url($_SERVER['PHP_SELF']."?pshop_mode=admin&amp;page=help.about");?>"><?php echo $VM_LANG->_VM_ABOUT ?></a>
			</li>
			<li class="item-smenu vmicon-16-help">
			<a href="http://virtuemart.net/documentation/User_Manual/index.html"><?php echo $VM_LANG->_VM_HELP_TOPICS ?></a>
			</li>
			<li class="item-smenu vmicon-16-language">
			<a href="http://virtuemart.net/index.php?option=com_smf&Itemid=71"><?php echo $VM_LANG->_VM_COMMUNITY_FORUM ?></a>
			</li>

	
			</ul>
			<hr />
			</div>
			</div>
			<center>
			<b><?php echo 'Your Version' ?></b>
			</center>
			<center>
			<?php echo $VMVERSION->PRODUCT .'&nbsp;' . $VMVERSION->RELEASE .'&nbsp;'. $VMVERSION->DEV_STATUS
			?>
			 </center>
              </div>
            </div>
          </div>
        </div>
   
   
<?php 
if (!empty($error) && ($page != ERRORPAGE)) {
     echo '<br /><div class="message">'. $error.'</div><br />';
}
$db = new ps_DB(); ?>