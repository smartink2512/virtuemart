<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_display.php,v 1.5 2005/01/27 19:34:03 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.phpshop.org, forums.phpshop.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );
?>

<h2><?php
require_once(CLASSPATH.'ps_vendor.php');
$ps_vendor = new ps_vendor;

$keyword = mosgetparam( $_REQUEST, 'keyword', 0);
$limitstart = mosgetparam( $_REQUEST, 'limitstart', 0);

$product_id = $vars["product_id"];
if ($product_parent_id = $vars["product_parent_id"]) {
  if ($func == "productAdd") {
    $action = $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL; 
  } else {
    $action = $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL; 
  }
  $info_label = $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL;
  $status_label = $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL;
  $dim_weight_label = $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL;
  $images_label = $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL;
} else {
  $product_parent_id ="";
  if ($func == "productAdd") {
    $action = $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL; 
  } else {
    $action = $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL; 
  }
  $info_label = $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL;
  $status_label = $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL;
  $dim_weight_label = $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL;
  $images_label = $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL;
}

echo "$action:";

$url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&product_id=$product_id&product_parent_id=$product_parent_id&limitstart=$limitstart&keyword=$keyword";
echo "<a href=\"" . $sess->url($url) . "\">". $ps_product->get_field($product_id,"product_name")."</a>"; 
?></h2>
<?php
  $q  = "SELECT * FROM #__pshop_product WHERE product_id='$product_id' ";
  $db->query($q);                                                                                    
  $db->next_record();
?>
<div align="center">
  <a href="<?php echo $_SERVER['PHP_SELF']."?option=com_phpshop&page=product.product_list&limitstart=$limitstart&keyword=$keyword" ?>">
      <h4>&gt;&gt;<?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_LBL ?>&lt;&lt;</h4>
  </a>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td colspan="2" ><strong><?php echo $info_label ?></strong></td>
  </tr>
  <tr> 
    <td width="21%" height="18" valign="top"  align="right"> <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_VENDOR ?>:</td>
    <td width="79%" height="18" valign="top"> <?php print $ps_vendor->get_name($db->f("vendor_id")); ?></td>
  </tr>
  <tr> 
    <td width="21%" height="17" valign="top"  align="right"> <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_SKU ?>:</td>
    <td width="79%" height="17" valign="top"> <?php $db->p("product_sku"); ?></td>
  </tr>
  <tr> 
    <td width="21%" valign="top"  align="right"> <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_NAME ?>:</td>
    <td width="79%" valign="top"> <?php $db->p("product_name"); ?></td>
  </tr>
  <tr> 
    <td width="21%" valign="top"  align="right"> <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_URL ?>:</td>
    <td width="79%" valign="top"> <?php $db->p("product_url"); ?></td>
  </tr>
  <tr> 
    <td width="21%" valign="top"  align="right"> <?php if(!$product_parent_id) { 
                                                        echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_CATEGORY ?>:<?php } ?></td>
    <td width="79%" valign="top"> <?php
        if(!$product_parent_id) {
          echo $ps_product_category->get_name($product_id);
        }
?></td>
  </tr>
  <tr> 
    <td width="21%" align="right"  valign="top"> <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_S_DESC ?>:</td>
    <td width="79%"><?php $db->p("product_s_desc"); ?></td>
  </tr>
  <tr> 
    <td width="21%" align="right"  valign="top"> <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_DESCRIPTION ?>:</td>
    <td width="79%"><?php $db->p("product_desc"); ?></td>
  </tr>
  <tr> 
    <td width="21%">&nbsp;</td>
    <td width="79%">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" ><B><?php echo $status_label ?></B></td>
  </tr>
  <tr> 
    <td width="21%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_IN_STOCK ?>:</td>
    <td width="79%" valign="top"> <?php $db->p("product_in_stock"); ?></td>
  </tr>
  <tr> 
    <td width="21%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE ?>:</td>
    <td width="79%" valign="top"> <?php
if ($db->f("product_available_date")) { 
  echo date("m/j/Y",$db->f("product_available_date"));
}
?></td>
  </tr>
  <tr> 
    <td width="21%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_SPECIAL ?>:</td>
    <td width="79%" valign="top"> <?php $db->p("product_special"); ?></td>
  </tr>
  <tr> 
    <td width="21%" align="right" height="17" > <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE ?>:</td>
    <td width="79%" valign="top" height="17"> <?php $db->p("product_discount_id"); ?></td>
  </tr>
  <tr> 
    <td width="21%" align="right" height="17" > <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_PUBLISH ?>:</td>
    <td width="79%" valign="top" height="17"> <?php $db->p("product_publish"); ?></td>
  </tr>
  <tr> 
    <td width="21%">&nbsp;</td>
    <td width="79%">&nbsp;</td>
  </tr>
</table>
<?php
if ($product_parent_id) { 
  $db2 = new ps_DB; 
?> 
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td colspan="2"><b><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL ?></b></td>
  </tr>
  <?php
  $q2 = "SELECT * FROM #__pshop_product_attribute,#__pshop_product_attribute_sku ";
  $q2 .= "WHERE #__pshop_product_attribute.product_id ='". $product_id ."'";
  $q2 .= "AND #__pshop_product_attribute_sku.product_id = '". $product_parent_id ."'";
  $q2 .= "AND #__pshop_product_attribute.attribute_name = #__pshop_product_attribute_sku.attribute_name ";
  $q2 .= "ORDER BY attribute_list,#__pshop_product_attribute.attribute_name"; 
  $db2->query($q2);
  while ($db2->next_record()) {
  ?> 
  <tr nowrap> 
    <td width="21%" height="18" align="right"><?php $db2->sp("attribute_name") ?>:</td>
    <td width="79%" height="18"><?php $db2->p("attribute_value"); ?></td>
  </tr>
  <?php
  } ?> 
</table>
<?php
} 
?> 
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td colspan="2"><B><?php echo $dim_weight_label ?></B></td>
  </tr>
  <tr valign="top"> 
    <td width="21%" height="19"  align="right"> <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_LENGTH ?>:</td>
    <td width="79%" height="19"> <?php 
echo $db->f("product_length") . " " . $db->f("product_lwh_uom"); 
?></td>
  </tr>
  <tr valign="top"> 
    <td width="21%" height="19"  align="right"> <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_WIDTH ?>:</td>
    <td width="79%" height="19"> <?php
echo $db->f("product_width") . " " . $db->f("product_lwh_uom"); 
?></td>
  </tr>
  <tr valign="top"> 
    <td width="21%"  align="right"> <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_HEIGHT ?>:</td>
    <td width="79%"> <?php
echo $db->f("product_height") . " " . $db->f("product_lwh_uom"); 
?></td>
  </tr>
  <tr> 
    <td width="21%" align="right">&nbsp;</td>
    <td width="79%">&nbsp;</td>
  </tr>
  <tr> 
    <td width="21%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_WEIGHT ?>:</td>
    <td width="79%"><?php
echo $db->f("product_weight") . " " . $db->f("product_weight_uom");
?></td>
  </tr>
  <tr> 
    <td width="21%">&nbsp;</td>
    <td width="79%">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2"><B><?php echo $images_label ?></B></td>
  </tr>
  <tr> 
    <td width="21%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_THUMB_IMAGE ?>:</td>
    <td width="79%"><?php $ps_product->show_image($db->f("product_thumb_image"), "", 0); ?> 
    </td>
  </tr>
  <tr> 
    <td width="21%" align="right">&nbsp;</td>
    <td width="79%">&nbsp;</td>
  </tr>
  <tr> 
    <td width="21%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_FULL_IMAGE ?>:</td>
    <td width="79%"><?php $ps_product->show_image($db->f("product_full_image"), "", 0); ?></td>
  </tr>
</table>

