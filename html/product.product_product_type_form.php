<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_product_type_form.php,v 1.2 2005/06/22 19:50:41 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
*
* @author Zdenek Dvorak <Zdenek.Dvorak@seznam.cz>
* @copyright (C) 2005 Zdenek Dvorak
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

$product_id = mosgetparam($_REQUEST, 'product_id', 0);
$product_parent_id = mosgetparam($_REQUEST, 'product_parent_id', 0);
?>

<img src="<?php echo IMAGEURL ?>ps_image/categories.gif" border="0" />
<span class="sectionname"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_LBL ?>
<?php
if (!empty($product_parent_id)) {
  echo " Item: ";
} else {
  echo " Product: ";
}
$url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&product_id=$product_id&product_parent_id=$product_parent_id";
echo "<a href=\"" . $sess->url($url) . "\">";
echo $ps_product->get_field($product_id,"product_name");
echo "</a>";
?>
</span>

<br /><br />
  
  <?php
/*
require_once(CLASSPATH.'ps_shopper_group.php');
$ps_shopper_group = new ps_shopper_group;
require_once(CLASSPATH.'ps_vendor.php');
$ps_vendor = new ps_vendor;
*/

$db = new ps_DB;
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="adminForm" >
  <table width="100%" border="0" cellpadding="2" cellspacing="0">
    <tr> 
      <td valign="top" colspan="2"> 
        </td>
    </tr>
    <tr> 
      <td width="23%" height="20" valign="middle" > 
        <div align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_PRODUCT_TYPE ?>:</div>
      </td>
      <td width="77%" height="10" >
        <select class="inputbox" name="product_type_id">
          <?php 
              $db = new ps_DB;
	      $q  = "SELECT * FROM #__pshop_product_product_type_xref ";
	      $q .= "WHERE product_id='".$product_id."'";
              $db->query( $q );
              
              $q  = "SELECT product_type_id, product_type_name, product_type_list_order ";
              $q .= "FROM `#__pshop_product_type` ";
              $q .= "WHERE 1 = 1 ";
              while( $db->next_record() ) {
                  $q .= "AND product_type_id != '".$db->f("product_type_id")."' ";
              }
	      $q .= "ORDER BY product_type_list_order ASC";
              $db->query( $q );
             
              while( $db->next_record() ) {
                echo "<option value=\"".$db->f("product_type_id")."\">".$db->f("product_type_name")."</option>";
              }
              echo "</select>";
        ?>
      </td>
    </tr>
  </table>
  <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
  <input type="hidden" name="product_parent_id" value="<?php echo $product_parent_id; ?>" />
  <input type="hidden" name="func" value="productProductTypeAdd" />
  <input type="hidden" name="page" value="<?php echo $modulename ?>.product_product_type_list" />
  <?php $return_args = mosgetparam( $_REQUEST, 'return_args'); ?>
  <input type="hidden" name="return_args" value="<?php echo $return_args; ?>" />
  <input type="hidden" name="option" value="com_phpshop" />
  <input type="hidden" name="task" value="" />
  <?php $limitstart = mosgetparam( $_REQUEST, 'limitstart'); ?>
  <input type="hidden" name="limitstart" value="<?php echo $limitstart ?>" />
</form>
<!-- /** Changed Product Type - End */ -->
