<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_type_parameter_list.php,v 1.2 2005/06/22 19:50:41 soeren_nb Exp $
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

$product_type_id = mosgetparam($_REQUEST, 'product_type_id', 0);

?>
<form name="adminForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="hidden" name="option" value="com_phpshop" />
    <input type="hidden" name="page" value="product.product_type_parameter_list" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="product_type_id" value="<?php echo $product_type_id ?>" />
    <input type="hidden" name="func" value="ProductTypeReorderParam" />
    <input type="hidden" name="boxchecked" value="" />

<img src="<?php echo IMAGEURL ?>ps_image/categories.gif" border="0" />
<span class="sectionname"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_PARAMETER_LIST_LBL ?>:&nbsp;
<?php    
    $db = new ps_DB;
    
    $q  = "SELECT product_type_name FROM #__pshop_product_type ";
    $q .= "WHERE product_type_id=$product_type_id";
    $db->setQuery($q);
    $db->query();
    
    if ($product_type_id && $db->f("product_type_name")) {
      echo $db->f("product_type_name");
?>
 <a href="<?php echo $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=product.product_type_list">[
<?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_LIST_LBL ?> ]</a>
</span>
<br /><br />

<table class="adminlist" width="100%" border="0">
    <tr>
        <th width="5%">#</th>
        <th width="25%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LABEL ?></th>
        <th width="20%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME ?></th>
        <th width="40%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_DESCRIPTION ?></th>
        <th width="5%"><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_LIST_ORDER ?></th>
        <th width="5%"><?php echo _E_REMOVE ?></th>
    </tr><?php 

    $q  = "SELECT * FROM #__pshop_product_type_parameter ";
    $q .= "WHERE product_type_id=$product_type_id ";
    $q .= "ORDER BY parameter_list_order asc ";
    $db->setQuery($q);   
    $db->query();
    
    $i = 0;
    while ($db->next_record()) {
      if ($i++ % 2)
          $bgcolor=SEARCH_COLOR_1;
      else
          $bgcolor=SEARCH_COLOR_2;
      echo "<tr bgcolor=\"$bgcolor\">\n";
      echo "<td><input style=\"display:none;\" id=\"cb$i\" name=\"cb[]\" value=\"".$db->f("parameter_name")."\" type=\"checkbox\" />&nbsp;$i</td><td>";
      echo "<a href=\"" ;   
      echo $_SERVER['PHP_SELF'] . "?option=com_phpshop&page=product.product_type_parameter_form&product_type_id=" . $db->f("product_type_id")."&parameter_name=".$db->f("parameter_name")."&task=edit";
      echo "\">";
      echo $db->f("parameter_label") . "</a></td>\n<td>";
      echo $db->f("parameter_name") . "</a></td>\n";
      echo "<td>" . $db->f("parameter_description");
      echo "</td>\n<td>";
      echo "<div align=\"center\">\n";
      echo mShop_orderUpIcon( $db->row, $db->num_rows(), $i ) . "\n&nbsp;" . mShop_orderDownIcon( $db->row, $db->num_rows(), $i );
      echo "</div></td>\n";
      echo "<td>";
      echo "<a class=\"toolbar\" href=\"".$_SERVER['PHP_SELF']."?option=com_phpshop&page=".$_REQUEST['page'] ."&func=ProductTypeDeleteParam&product_type_id=". $db->f("product_type_id") ."&parameter_name=".$db->f("parameter_name")."\"";
      echo " onclick=\"return confirm('". $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ."');\" onmouseout=\"MM_swapImgRestore();\"  onmouseover=\"MM_swapImage('Delete$i','','". IMAGEURL ."ps_image/delete_f2.gif',1);\">";
      echo "<img src=\"". IMAGEURL ."ps_image/delete.gif\" alt=\"Delete this record\" name=\"delete$i\" align=\"middle\" border=\"0\" /></a></td></tr>\n";
    }
       
       
/** Changed Product Type - End*/

/************************************************************************** 
   ** name: list_advanced_parameter($product_id) 
   ** created by: Sean Tobin (byrdhuntr@hotmail.com) 
   ** description: Creates drop-down boxes from advanced parameter format.  
   ** parameters: product_id (may be a product or item) 
   ** returns: html 
   ***************************************************************************/ 
/*  function list_advanced_parameter($product_id) { 
//ps_product_parameter.php
    $db = new ps_DB;    
    
    $q = "SELECT * from #__pshop_product WHERE product_id='$product_id'"; 
    $db->query($q); 
    $db->next_record(); 

    $advanced_parameter_list=$db->f("parameter"); 
    if ($advanced_parameter_list) {
      $has_advanced_parameters=1; 
      $fields=explode(";",$advanced_parameter_list); 
      $html = "<table>";
      foreach($fields as $field) {
        
        $base=explode(",",$field); 
        $title=array_shift($base); 
        $titlevar=str_replace(" ","_",$title); 
        $html .= "<tr><td align=\"right\">$title:</td><td><select class=\"inputbox\" name=\"$titlevar\">"; 
        foreach ($base as $base_value) { 
        
            $base_var=str_replace(" ","_",$base_value); 
            $html.="<option value=\"$base_var\">$base_value</option>"; 
        
        } 
        $html.="</select></td></tr>\n"; 
      }
      $html.="</table>";
    } 

    if ($advanced_parameter_list) { 
      return $html; 
    } 
  }
*/

?>
</table>
<?php
    }
    else {
      echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_PRODUCT_TYPE_NOT_FOUND;
      echo " <a href=\"".$_SERVER['PHP_SELF']."?option=com_phpshop&page=product.product_type_list\"> [";
      echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_LBL." ]</a>";
      echo "</span>";
    }
?>
</form>
