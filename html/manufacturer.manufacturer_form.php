<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: manufacturer.manufacturer_form.php,v 1.3 2005/01/27 19:34:02 soeren_nb Exp $
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

$manufacturer_id = mosgetparam( $_REQUEST, 'manufacturer_id', 0 );

if (!empty($manufacturer_id)) {
  $q = "SELECT * FROM #__pshop_manufacturer WHERE manufacturer_id='$manufacturer_id'"; 
  $db->query($q);  
  $db->next_record();
}
//First create the object and let it print a form heading
$formObj = &new formFactory( $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_FORM_LBL );
//Then Start the form
$formObj->startForm();
?>
<br />
  <table class="adminform">
    <tr> 
      <td><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_FORM_INFO_LBL ?></strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME ?></td>
      <td> 
        <input type="text" class="inputbox" name="mf_name" value="<?php $db->sp("mf_name") ?>" size="16" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_URL ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="mf_url" value="<?php $db->sp("mf_url") ?>" size="32" />
      </td>
    </tr>
    <tr> 
      <td align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_FORM_CATEGORY ?>:</td>
      <td ><?php $ps_manufacturer_category->list_category($db->f("mf_category_id"));     ?></td>
    </tr>
    <tr> 
      <td align="right">&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr> 
      <td align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_FORM_EMAIL ?>:</td>
      <td>
        <input type="text" class="inputbox" name="mf_email" value="<?php $db->sp("mf_email") ?>" size="18" />
      </td>
    </tr>
    <tr> 
      <td align="right" >&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="22%" align="right"  valign="top"><?php echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_FORM_DESCRIPTION ?>:</td>
      <td width="78%" ><?php
		editorArea( 'editor1', $db->f("mf_desc"), 'mf_desc', '300', '100', '70', '15' )
	?>
      </td>
    <tr align="center"> 
      <td colspan="2" >&nbsp;</td>
    </tr>
</table>
<?php
// Add necessary hidden fields
$formObj->hiddenField( 'manufacturer_id', $manufacturer_id );

$funcname = !empty($manufacturer_id) ? "manufacturerupdate" : "manufactureradd";
// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( $funcname, $modulename.'.manufacturer_list', $option );
?>