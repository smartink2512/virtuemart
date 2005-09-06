<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/** Changed Product Type - Begin*/
/* $Id: product.product_product_type_list.php,v 1.3 2005/09/04 20:08:55 soeren_nb Exp $
* 
* @package Mambo Open Source
* @Copyright (C) 2000 - 2003 Miro International Pty Ltd
* @ All rights reserved
* @ Mambo Open Source is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.3 $
*
* @sub-package mambo-phpShop
* mostly contains code from PHPShop:
* Copyright (c) Edikon Corporation ( www.phpshop.org ).
* Distributed under the GNU Public License (GPL)
* 
* www.mambo-phpshop.net
*
**/
$product_id = mosgetparam($_REQUEST, 'product_id', 0);
$product_parent_id = mosgetparam($_REQUEST, 'product_parent_id', 0);
$limitstart = mosgetparam($_REQUEST, 'limitstart', 0);
$keyword = mosgetparam($_REQUEST, 'keyword', 0);
global $ps_product_type;
?>

<img src="<?php echo IMAGEURL ?>ps_image/categories.gif" border="0" />
<span class="sectionname"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_LBL ?>
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

<table class="adminlist" width="100%" border="0">
    <tr>
        <th width="5%">#</th>
        <th width="25%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_NAME ?></th>
        <th width="30%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_DESCRIPTION ?></th>
        <th width="15%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_PARAMETERS ?></th>
        <th width="15%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCTS_LBL ?></th>
        <th width="10%"><?php echo _E_REMOVE ?></th>
    </tr><?php 

    $db = new ps_DB;

    $q  = "SELECT * FROM #__pshop_product_type,#__pshop_product_product_type_xref ";
    $q .= "WHERE #__pshop_product_type.product_type_id=#__pshop_product_product_type_xref.product_type_id ";
    $q .= "AND product_id='".$product_id."' ";
    $q .= "ORDER BY product_type_list_order asc ";
    $db->setQuery($q);   
    $db->query();
    
    $i = 0;
    while ($db->next_record()) {
      $product_count = $ps_product_type->product_count($db->f("product_type_id"));
      $parameter_count = $ps_product_type->parameter_count($db->f("product_type_id"));
      if ($i++ % 2)
          $bgcolor=SEARCH_COLOR_1;
      else
          $bgcolor=SEARCH_COLOR_2;
      echo "<tr bgcolor=\"$bgcolor\">\n";
      echo "<td><input style=\"display:none;\" id=\"cb$i\" name=\"cb[]\" value=\"".$db->f("product_type_id")."\" type=\"checkbox\" />&nbsp;$i</td><td>";
      echo "<a href=\"" ;   
      echo $_SERVER['PHP_SELF'] . "?option=com_phpshop&page=product.product_type_form&product_type_id=" . $db->f("product_type_id");
      echo "\">";
      echo $db->f("product_type_name") . "</a></td>\n";
      echo "<td>" . $db->f("product_type_description");
      echo "</td>\n<td>";
      echo $parameter_count . " " . $PHPSHOP_LANG->_PHPSHOP_PARAMETERS_LBL . " <a href=\"";
      echo $_SERVER['PHP_SELF'] . "?option=com_phpshop&page=product.product_type_parameter_list&product_type_id=";
      echo $db->f("product_type_id") . "\">[ ".$PHPSHOP_LANG->_PHPSHOP_SHOW." ]</a>\n</td>\n";
      echo "<td>".$product_count ." ". $PHPSHOP_LANG->_PHPSHOP_PRODUCTS_LBL."&nbsp;<a href=\"";
      echo $_SERVER['PHP_SELF'] . "?option=com_phpshop&page=product.product_list&product_type_id=" . $db->f("product_type_id");
      echo "\">[ ".$PHPSHOP_LANG->_PHPSHOP_SHOW." ]</a>\n</td>\n";
      echo "<td width=\"5%\">";
      echo "<a class=\"toolbar\" href=\"".$_SERVER['PHP_SELF']."?option=com_phpshop&page=".$_REQUEST['page'] ."&func=productProductTypeDelete&product_type_id=".$db->f("product_type_id")."&product_id=".$product_id;
	  echo !empty($product_parent_id) ? "&product_parent_id=".$product_parent_id : "";
      echo "\" onclick=\"return confirm('". $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ."');\" onmouseout=\"MM_swapImgRestore();\"  onmouseover=\"MM_swapImage('Delete$i','','". IMAGEURL ."ps_image/delete_f2.gif',1);\">";
      echo "<img src=\"". IMAGEURL ."ps_image/delete.gif\" alt=\"Delete this record\" name=\"delete$i\" align=\"middle\" border=\"0\" /></a></td></tr>\n";
    }
     
/** Changed Product Type - End*/
?>
</table>
