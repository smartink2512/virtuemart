<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_attribute_list.php,v 1.4 2005/01/27 19:34:03 soeren_nb Exp $
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

$product_parent_id = mosgetparam($_REQUEST, 'product_parent_id', 0);
$limitstart = mosgetparam($_REQUEST, 'limitstart', 0);
$keyword = mosgetparam($_REQUEST, 'keyword', 0);
?>

<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_ATTRIBUTE_LIST_LBL ?>

<?php
if (!empty($product_parent_id)) {
  echo "Product:";
} else {
  echo  "Item:";
}
$url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&product_id=$product_id&product_parent_id=$product_parent_id";
echo "<a href=\"" . $sess->url($url) . "\">";
echo $ps_product->get_field($product_id,"product_name");
echo "</a>"; 
?>

</h2>

<table width="100%" class="adminlist">
    <tr> 
      <th width="5%">#</th>
      <th width="30%"><?php echo $PHPSHOP_LANG->_PHPSHOP_ATTRIBUTE_LIST_NAME ?></th>
      <th width="45%"><?php echo $PHPSHOP_LANG->_PHPSHOP_ATTRIBUTE_LIST_ORDER ?></th>
      <th width="20%"><? echo _E_REMOVE ?></th>
    </tr>
    <?php
    $product_id = $vars["product_id"];
    $q = "SELECT * FROM #__pshop_product_attribute_sku WHERE product_id = '$product_id' ORDER BY attribute_list,attribute_name"; 
    $db->query($q);
    $i = 0;
    while ($db->next_record()) { 
        
        $attribute_name = $db->f("attribute_name");
        $url_att_name = urlencode($attribute_name); ?> 
    
    <tr nowrap>
        <td><? echo $i++; ?></td>
        <td ><?php 
            $url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_attribute_form&limitstart=$limitstart&keyword=$keyword&product_id=" . $product_id . "&attribute_name=" . urlencode($db->f("attribute_name")) . "&return_args=" . urlencode($return_args);
            echo "<a href=\"" . $sess->url($url) . "\">$attribute_name</a>"; ?>
        </td>
        <td ><?php echo $db->f("attribute_list"); ?></td>
        <td>
          <a class="toolbar" href="<?php echo $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=productAttributeDelete&product_id=<? echo $product_id ?>&attribute_name=<? echo $url_att_name ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
          </a>
        </td>
      
    </tr>
    <?php 
    } ?> 
    <tr nowrap> 
      <td width="100%" colspan="2">&nbsp; </td>
    </tr>
</table>
