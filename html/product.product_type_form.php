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

//First create the object and let it print a form heading
$formObj = &new formFactory( $PHPSHOP_LANG->_PHPSHOP_PRODUCT_TYPE_FORM_LBL );
//Then Start the form
$formObj->startForm();

if ($product_type_id) {
    $q = "SELECT * from #__pshop_product_type WHERE product_type_id='$product_type_id'";
    $db->query($q);
    $db->next_record();
} 
elseif (empty($vars["error"])) {
    $default["product_type_publish"] = "Y";
}
?> 
<table class="adminform">
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
<?php
// Add necessary hidden fields
$formObj->hiddenField( 'product_type_id', $product_type_id );

$funcname = !empty($product_type_id) ? "ProductTypeUpdate" : "ProductTypeAdd";

// finally close the form:
$formObj->finishForm( $funcname, $modulename.'.product_type_list', $option );
?>