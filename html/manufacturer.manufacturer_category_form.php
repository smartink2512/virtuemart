<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: manufacturer.manufacturer_category_form.php,v 1.3 2005/01/27 19:34:02 soeren_nb Exp $
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

$mf_category_id = mosGetParam( $_REQUEST, 'mf_category_id' );
if (!empty($mf_category_id)) {
   $q = "SELECT * from #__pshop_manufacturer_category ";
   $q .= "where mf_category_id='$mf_category_id'";
   $db->query($q);
   $db->next_record();
}
//First create the object and let it print a form heading
$formObj = &new formFactory( $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_CAT_FORM_LBL );
//Then Start the form
$formObj->startForm();
?>
<table class="adminform">
	<tr> 
                  <td width="38%" align="right"><B><?php echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_CAT_FORM_INFO_LBL ?></b> 
                  </td>
                  <td width="62%">&nbsp;</td>
	</tr>
	<tr> 
                  <td width="38%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_CAT_FORM_NAME ?>:</td>
                  <td width="62%"> 
                    <input type="text" class="inputbox" name="mf_category_name" size="18" value="<?php $db->sp('mf_category_name') ?>" />
                  </td>
	</tr>
	<tr> 
                  <td width="38%" nowrap align="right" valign="top"><?php echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_CAT_FORM_DESCRIPTION ?>:</td>
                  <td width="62%" valign="top"> 
                    <textarea name="mf_category_desc" cols="40" rows="2"><?php $db->sp('mf_category_desc'); ?></textarea>
                  </td>
	</tr>
	<tr> 
                  <td width="38%" nowrap align="right" valign="top">&nbsp;</td>
                  <td width="62%" valign="top">&nbsp;</td>
	</tr>
</table>
<?php
// Add necessary hidden fields
$formObj->hiddenField( 'mf_category_id', $mf_category_id );

$funcname =  !empty($mf_category_id) ? "manufacturercategoryupdate" : "manufacturercategoryadd";

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( $funcname, $modulename.'.manufacturer_category_list', $option );
?>