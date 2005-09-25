<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.curr_form.php,v 1.4 2005/01/27 19:34:00 soeren_nb Exp $
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

$currency_id = mosgetparam( $_REQUEST, 'currency_id');
if ($currency_id) {
    $q = "SELECT * from #__pshop_currency WHERE currency_id='$currency_id'";
    $db->query($q);
    $db->next_record();
}
  
//First create the object and let it print a form heading
$formObj = &new formFactory( $PHPSHOP_LANG->_PHPSHOP_CURRENCY_LIST_ADD );
//Then Start the form
$formObj->startForm();

?> 
<table class="adminform">
    <tr> 
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_LIST_NAME ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="currency_name" value="<?php $db->sp("currency_name") ?>" />
      </td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_LIST_CODE ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="currency_code" value="<?php $db->sp("currency_code") ?>" />
      </td>
    </tr>
    <tr> 
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
<?php
// Add necessary hidden fields
$formObj->hiddenField( 'currency_id', $currency_id );

$funcname = !empty($currency_id) ? "currencyUpdate" : "currencyAdd";

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( $funcname, 'admin.curr_list', $option );
?>