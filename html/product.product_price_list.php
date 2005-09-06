<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_price_list.php,v 1.7 2005/06/23 18:59:16 soeren_nb Exp $
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

<h2> <?php
if (empty($product_parent_id)) {
  echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LBL;
} else {
  echo  $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_ITEM_LBL;
}
$limitstart = mosgetparam($_REQUEST, 'limitstart', 0);
$keyword = mosgetparam($_REQUEST, 'keyword', "");
$product_parent_id = mosgetparam($_REQUEST, 'product_parent_id', 0);

echo $PHPSHOP_LANG->_PHPSHOP_PRICE_LIST_FOR_LBL."&nbsp;&nbsp;";
$url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&product_id=$product_id&product_parent_id=$product_parent_id";
echo "<a href=\"" . $sess->url($url) . "\">";
echo $ps_product->get_field($product_id,"product_name");
echo "</a>"; 
if( empty($return_args) ) $return_args = "";
?></h2>
<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
  <tr> 
    <td> 
      <table width="100%" class="adminlist">
        <tr> 
          <th width="20">#</th>
          <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PRICE_LIST_GROUP_NAME ?></th>
          <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PRICE_LIST_PRICE ?></th>
          <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_CURRENCY ?></th>
          <th width="50">Quantity Start</th>
          <th width="50">Quantity End</th>
          <th width="20"><?php echo _E_REMOVE ?></th>
        </tr>
        <?php
        $q  = "SELECT shopper_group_name,product_price_id,product_price,product_currency,price_quantity_start,price_quantity_end ";
        $q .= "FROM #__pshop_shopper_group,#__pshop_product_price ";
        $q .= "WHERE product_id = '$product_id' ";
        if( !$perm->check("admin"))
          $q .= "AND #__pshop_shopper_group.vendor_id = '$ps_vendor_id' ";
        $q .= "AND #__pshop_shopper_group.shopper_group_id = #__pshop_product_price.shopper_group_id ";
        $q .= "ORDER BY shopper_group_name,price_quantity_start, product_price "; 
        $db->query($q);
        $i = 0;
        
        while ($db->next_record()) { ?> 
        <tr nowrap>
          <td width="20"><?php echo $i++ ?></td>
          <td><?php
            $url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_price_form&limitstart=$limitstart&keyword=$keyword&product_price_id=" . $db->f("product_price_id") . "&product_id=$product_id&product_parent_id=$product_parent_id&return_args=" . urlencode($return_args);
            echo "<a href=" . $sess->url($url) . ">";
            $db->sp("shopper_group_name"); 
            echo "</a>"; 
            ?></td>
          <td><?php echo $db->f("product_price"); ?></td>
          <td><?php echo $db->f("product_currency"); ?></td>
          <td width="50"><?php echo $db->f("price_quantity_start"); ?></td>
          <td width="50"><?php echo $db->f("price_quantity_end"); ?></td>
          <td width="20">
              <a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $_REQUEST['page'] ?>&func=productPriceDelete&product_id=<? echo $product_id ?>&product_price_id=<? $db->p("product_price_id") ?>&limitstart=<?php echo $limitstart ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
              </a>
          </td>
        </tr>
        <?php 
        } ?> 
      </table>
    </td>
  </tr>
</table>
