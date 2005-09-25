<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_attribute_form.php,v 1.3 2005/01/27 19:34:03 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );

$product_id = $vars["product_id"];

if( is_array( $product_id ))
	$product_id = (int)$product_id[0];

$product_parent_id = mosgetparam($_REQUEST, 'product_parent_id', 0);
$attribute_name = mosgetparam($_REQUEST, 'attribute_name', 0);
$return_args = mosgetparam($_REQUEST, 'return_args' );

$title = $PHPSHOP_LANG->_PHPSHOP_ATTRIBUTE_FORM_LBL.'<br />';

if (!empty($attribute_name)) {
  if (empty($product_parent_id)) {
    $title .= $PHPSHOP_LANG->_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT . " ";
  } 
  else {
    $title .= $PHPSHOP_LANG->_PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM . " ";
  }
} 
else {
  if (empty($product_parent_id)) {
    $title .= $PHPSHOP_LANG->_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT . " ";
  } 
  else {
    $title .= $PHPSHOP_LANG->_PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM . " ";
  }
}

$url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&product_id=$product_id&product_parent_id=$product_parent_id";
$title .= '<a href="' . $sess->url($url) . '">'. $ps_product->get_field($product_id,'product_name').'</a>'; 

if ($attribute_name) {
  $db = new ps_DB;
  $q = "SELECT * FROM #__pshop_product_attribute_sku WHERE product_id='$product_id' ";
  $q .= "AND attribute_name = '$attribute_name' ";
  $db->query($q); 
  $db->next_record();
}

//First create the object and let it print a form heading
$formObj = &new formFactory( $title );
//Then Start the form
$formObj->startForm();

?> 
<table class="adminform">
	<tr> 
		<td width="23%" height="20" valign="top"> 
			<div align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_ATTRIBUTE_FORM_NAME ?>:</div>
		</td>
		<td width="77%" height="20"> 
			<input type="text" class="inputbox" name="attribute_name" value="<?php $db->sp("attribute_name"); ?>" size="32" maxlength="255" />
		</td>
	</tr>
	<tr> 
		<td width="23%" height="10" valign="top"> 
			<div align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_ATTRIBUTE_FORM_ORDER ?>:</div>
		</td>
		<td width="77%" height="10"> 
			<input type="text" class="inputbox" name="attribute_list" value="<?php $db->sp("attribute_list"); ?>" size="5" maxlength="11" />
		</td>
	</tr>
	<tr> 
		<td colspan="2" height="22">&nbsp;</td>
	</tr>
</table>
<?php
// Add necessary hidden fields
$formObj->hiddenField( 'product_id', $product_id );
$formObj->hiddenField( 'old_attribute_name', $attribute_name );
$formObj->hiddenField( 'return_args', $return_args );

$funcname = !empty($attribute_name) ? "productAttributeUpdate" : "productAttributeAdd";

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( $funcname, $modulename.'.country_list', $option );
?>