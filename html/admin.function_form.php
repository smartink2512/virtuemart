<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.function_form.php,v 1.4 2005/01/27 19:34:00 soeren_nb Exp $
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

$function_id = mosGetParam( $_REQUEST, 'function_id');
$module_id = mosGetParam( $_REQUEST, 'module_id');

if (!empty($function_id) {
  $q = "SELECT * from #__pshop_function where function_id='$function_id'";
  $db->query($q);
  $db->next_record();
}
//First create the object and let it print a form heading
$formObj = &new formFactory( $PHPSHOP_LANG->_PHPSHOP_FUNCTION_FORM_LBL );
//Then Start the form
$formObj->startForm();
?> 
  <table class="adminform">
    <tr> 
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_FORM_NAME ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="function_name" value="<?php $db->sp("function_name") ?>" />
      </td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_FORM_CLASS ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="function_class" value="<?php $db->sp("function_class") ?>" />
      </td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_FORM_METHOD ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="function_method" value="<?php $db->sp("function_method") ?>" />
      </td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_FORM_PERMS ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="function_perms" value="<?php $db->sp("function_perms") ?>" />
      </td>
    </tr>
    <tr> 
      <td valign="top" colspan="2" align="right">&nbsp; </td>
    </tr>
    <tr> 
      <td valign="top" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_FORM_DESCRIPTION ?>:</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr align="center"> 
      <td valign="top" colspan="2"> 
        <textarea name="function_description" cols="60" rows="10"><?php $db->sp("function_description") ?></textarea>
      </td>
    </tr>
   
  </table>
<?php
// Add necessary hidden fields
$formObj->hiddenField( 'function_id', $function_id );
$formObj->hiddenField( 'module_id', $module_id );

$funcname = (!empty( $function_id )) ? "functionUpdate" : "functionAdd";

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( $funcname, 'admin.function_list', $option );

?>