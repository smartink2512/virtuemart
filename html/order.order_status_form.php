<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: order.order_status_form.php,v 1.4 2005/05/22 13:11:05 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.phpshop.org, forums.phpshop.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );

$order_status_id = mosGetParam( $_REQUEST, 'order_status_id' );
?>

<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_STATUS_FORM_LBL ?></H2>
<?php 
if (!empty($order_status_id)) {
  $q = "SELECT * FROM #__pshop_order_status WHERE order_status_id='$order_status_id'"; 
  $db->query($q);  
  $db->next_record();
}  
?><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" name="adminForm">
  <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td><b><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_STATUS_FORM_LBL ?></b></td>
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
      <td colspan="2" >&nbsp;</td>
    </tr>
    <tr align="center"> 
      <td colspan="2" > 
        <input type="hidden" name="order_status_id" value="<?php echo $order_status_id ?>" />
        <input type="hidden" name="func" value="<?php if ($order_status_id) echo "orderstatusupdate"; else echo "orderstatusadd"; ?>" />
        <input type="hidden" name="page" value="order.order_status_list" />
        <input type="hidden" name="option" value="com_phpshop" />
        <input type="hidden" name="task" value="" />
        <?php $limitstart = mosgetparam( $_REQUEST, 'limitstart'); ?>
        <input type="hidden" name="limitstart" value="<?php echo $limitstart ?>" />
      </td>
    </tr>
    
  </table>
</form>
