<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_type_list.php,v 1.2 2005/06/22 19:50:41 soeren_nb Exp $
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
?>
<form name="adminForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="hidden" name="option" value="com_phpshop" />
    <input type="hidden" name="page" value="product.product_type_list" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="func" value="ProductTypeReorder" />
    <input type="hidden" name="boxchecked" value="" />

<img src="<?php echo IMAGEURL ?>ps_image/categories.gif" border="0" />
<span class="sectionname"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_LIST_LBL ?></span>
<br /><br />

<table class="adminlist" width="100%" border="0">
    <tr>
        <th width="5%">#</th>
        <th width="25%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_NAME ?></th>
        <th width="30%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_DESCRIPTION ?></th>
        <th width="15%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_PARAMETERS ?></th>
        <th width="15%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCTS_LBL ?></th>
        <th width="5%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_PUBLISH ?>?</th>
        <th width="5%"><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_LIST_ORDER ?></th>
        <th width="5%"><?php echo _E_REMOVE ?></th>
    </tr><?php 

    $db = new ps_DB;

    $q = "SELECT * FROM #__pshop_product_type ";
/*    $q .= "WHERE #__pshop_category_xref.category_parent_id='";
    $q .= $category_id . "' AND ";
    $q .= "#__pshop_category.category_id=#__pshop_category_xref.category_child_id ";
    $q .= "AND #__pshop_category.vendor_id = $ps_vendor_id ";*/
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
      //echo "<td>". $db->f("list_order")."</td>";
      echo "<td>";
      if ($db->f("product_type_publish")=='Y') { 
          echo "<img src=\"". $mosConfig_live_site ."/administrator/images/tick.png\" border=\"0\" />\n";
      } 
      else { 
          echo "<img src=\"". $mosConfig_live_site ."/administrator/images/publish_x.png\" border=\"0\" />";
      } 
      echo "<td width=\"5%\"><div align=\"center\">\n";
//      echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','orderdown')\">";
//      echo "Down</a>";
      echo mShop_orderUpIcon( $db->row, $db->num_rows(), $i ) . "\n&nbsp;" . mShop_orderDownIcon( $db->row, $db->num_rows(), $i );
      echo "</div></td>\n";
      echo "<td width=\"5%\">";
      echo "<a class=\"toolbar\" href=\"".$_SERVER['PHP_SELF']."?option=com_phpshop&page=".$_REQUEST['page'] ."&func=ProductTypeDelete&product_type_id=". $db->f("product_type_id") ."\"";
      echo " onclick=\"return confirm('". $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ."');\" onmouseout=\"MM_swapImgRestore();\"  onmouseover=\"MM_swapImage('Delete$i','','". IMAGEURL ."ps_image/delete_f2.gif',1);\">";
      echo "<img src=\"". IMAGEURL ."ps_image/delete.gif\" alt=\"Delete this record\" name=\"delete$i\" align=\"middle\" border=\"0\" /></a></td></tr>\n";
    }
       
       
/** Changed Product Type - End*/
?>
</table>
</form>
