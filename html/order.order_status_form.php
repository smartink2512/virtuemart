<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: order.order_status_form.php,v 1.4 2005/05/22 13:11:05 soeren_nb Exp $
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

$order_status_id = mosGetParam( $_REQUEST, 'order_status_id' );

//First create the object and let it print a form heading
$formObj = &new formFactory( $PHPSHOP_LANG->_PHPSHOP_ORDER_STATUS_FORM_LBL );
//Then Start the form
$formObj->startForm();

if (!empty($order_status_id)) {
  $q = "SELECT * FROM #__pshop_order_status WHERE order_status_id='$order_status_id'"; 
  $db->query($q);  
  $db->next_record();
}  
?><br />
<table class="adminform">
    <tr> 
      <td><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_STATUS_FORM_LBL ?></strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_STATUS_FORM_CODE ?>:</td>
      <td> 
        <input type="text" class="inputbox" name="order_status_code" value="<?php $db->sp("order_status_code") ?>" size="2" maxlength="1" />
      </td>
    </tr>
    <tr> 
      <td align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_STATUS_FORM_NAME ?>:</td>
      <td> 
        <input type="text" class="inputbox" name="order_status_name" value="<?php $db->sp("order_status_name") ?>" size="16" />
      </td>
    </tr>
    <tr> 
      <td align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_STATUS_FORM_LIST_ORDER ?>:</td>
      <td> 
        <input type="text" class="inputbox" name="list_order" value="<?php $db->sp("list_order") ?>" size="3" maxlength="3" />
      </td>
    </tr>
    <tr align="center">
      <td colspan="2">&nbsp;</td>
    </tr>    
</table>
<?php
// Add necessary hidden fields
$formObj->hiddenField( 'order_status_id', $order_status_id );

$funcname = !empty($order_status_id) ? "orderstatusupdate" : "orderstatusadd";

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( $funcname, $modulename.'.order_status_list', $option );
?>