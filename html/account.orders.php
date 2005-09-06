<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: account.orders.php,v 1.4 2005/01/27 19:34:00 soeren_nb Exp $
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

require_once(CLASSPATH.'ps_order.php');
$ps_order = new ps_order;

$page_name = "Order Maintenance";
?>
<?php
  $q  = "SELECT * FROM #__pshop_orders WHERE ";
  $q .= "user_id='" . $auth["user_id"] . "' ";
  $q .= "ORDER BY cdate DESC";
  $db->query($q);
?>
<form action="<?php echo SECUREURL ?>index.php" method="post">
<input type="hidden" name="option" value="com_phpshop" />
<input type="hidden" name="page" value="account.order_details" />
<input type="hidden" name="print" value="1" />
<table border="0" cellspacing="0" cellpadding="10" width="100%" align="center">
<tr>
   <td>
   <b><?php echo $PHPSHOP_LANG->_("Order Information") ?></b>
   <br>
	<?php $ps_order->list_order("A","1"); ?>
   <br>
   <input type="submit" class="button" name="submit" value="<?php echo $PHPSHOP_LANG->_PHPSHOP_VIEW ?>" />
   </td>
</tr>
</table>
</form>
<!-- Body ends here -->
