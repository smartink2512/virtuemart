<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: store.creditcard_form.php,v 1.3 2005/01/27 19:34:03 soeren_nb Exp $
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

$creditcard_id = mosgetparam( $_REQUEST, 'creditcard_id', "");

if (!empty($creditcard_id)) {
    $q = "SELECT * FROM #__pshop_creditcard WHERE creditcard_id='$creditcard_id'";
    $db->query($q);
    $db->next_record();
}

//First create the object and let it print a form heading
$formObj = &new formFactory( $PHPSHOP_LANG->_PHPSHOP_CREDITCARD_FORM_LBL );
//Then Start the form
$formObj->startForm();

?> 
<table class="adminform">
    <tr> 
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CREDITCARD_NAME ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="creditcard_name" value="<?php $db->sp("creditcard_name") ?>" />
      </td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CREDITCARD_CODE ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="creditcard_code" value="<?php $db->sp("creditcard_code") ?>">
      </td>
    </tr>
</table>
<?php
// Add necessary hidden fields
$formObj->hiddenField( 'creditcard_id', $creditcard_id );

$funcname = !empty($creditcard_id) ? "creditcardUpdate" : "creditcardAdd";

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( $funcname, $modulename.'.creditcard_list', $option );
?>