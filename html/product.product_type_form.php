<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_type_form.php,v 1.1 2005/05/02 19:48:16 soeren_nb Exp $
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

<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_LBL ?></h2>

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr> 
    <td align="center"> <?php 
  if ($product_type_id) {
    $q = "SELECT * from #__pshop_product_type ";
    $q .= "where product_type_id='$product_type_id'";
    $db->query($q);
    $db->next_record();
  } 
  elseif (empty($vars["error"])) {
    $default["product_type_publish"] = "Y";
/*    $default["category_flypage"] = "shop.flypage";
    $default["category_browsepage"] = CATEGORY_TEMPLATE;
    $default["products_per_row"] = PRODUCTS_PER_ROW;*/
  }
?> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="adminForm">
              <table width="100%" border="0" cellspacing="0" cellpadding="2" >
                <tr> 
                  <td width="38%" nowrap align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_PUBLISH ?>:</td>
                  <td width="62%"><?php 
                    if ($db->sf("product_type_publish")=="Y") { 
                      echo "<input type=\"checkbox\" name=\"product_type_publish\" value=\"Y\" checked=\"checked\" />";
                    } 
                    else {
                      echo "<input type=\"checkbox\" name=\"product_type_publish\" value=\"Y\" />";
                    }
                  ?> 
                  </td>
                </tr>
                <tr> 
                  <td width="38%" nowrap align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_NAME ?>:</td>
                  <td width="62%"> 
                    <input type="text" class="inputbox" name="product_type_name" size="60" value="<?php $db->sp('product_type_name') ?>" />
                    <input type="hidden" name="product_type_id" value="<?php echo $product_type_id ?>" />
                    <input type="hidden" name="task" value="" />
                    <input type="hidden" name="page" value="<?php echo $modulename ?>.product_type_list" />
                    <input type="hidden" name="func" value="<?php if (!empty($product_type_id)) { echo "ProductTypeUpdate";} else {echo "ProductTypeAdd";} ?>" />
                    <input type="hidden" name="option" value="com_phpshop" />
                  </td>
                </tr>
                <tr> 
                  <td width="38%" nowrap align="right" valign="top"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_DESCRIPTION ?>:</td>
                  <td width="62%" valign="top"><?php
                    editorArea( 'editor1', $db->f("product_type_description"), 'product_type_description', '300', '100', '60', '6' ) ?>
                    <!--input type="text" class="inputbox" name="product_type_description" size="60" value="<?php // $db->sp('product_type_description') ?>" /-->
		  </td>
                </tr>
                <tr>
                  <td align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_LIST_ORDER ?>: </td>
                  <td valign="top"><?php 
                    echo $ps_product_type->list_order( $db->f("product_type_id"), $db->f("product_type_list_order"));
                    echo "<input type=\"hidden\" name=\"currentpos\" value=\"".$db->f("product_type_list_order")."\" />";
                  ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2"><br /></td>
                </tr>
                <tr>
                  <td align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_BROWSEPAGE ." ". $PHPSHOP_LANG->_PHPSHOP_LEAVE_BLANK ?>: </td>
                  <td valign="top">
                  <input type="text" class="inputbox" name="product_type_browsepage" value="<?php $db->sp("product_type_browsepage"); ?>" />
                  </td>
                </tr>
                <tr>
                  <td align="right">
                    <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_FLYPAGE ." ". $PHPSHOP_LANG->_PHPSHOP_LEAVE_BLANK ?>:
                  </td>
                  <td valign="top">
                  <input type="text" class="inputbox" name="product_type_flypage" value="<?php $db->sp("product_type_flypage"); ?>" />
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
<!-- /** Changed Product Type - End */ -->
