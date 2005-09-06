<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shipping.carrier_form.php,v 1.3 2005/01/27 19:34:03 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* Contains code from PHPEuroShop
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
?>
<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_CARRIER_FORM_LBL ?></h2>
<?php

$limitstart = mosgetparam( $_REQUEST, 'limitstart');
$shipping_carrier_id = mosgetparam( $_REQUEST, 'shipping_carrier_id');

if (!empty($shipping_carrier_id)) {
  $q = "SELECT * FROM #__pshop_shipping_carrier WHERE shipping_carrier_id='$shipping_carrier_id'";
  $db->query($q);
  $db->next_record();
}
?><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" name="adminForm">
        <input type="hidden" name="shipping_carrier_id" value="<?php echo $shipping_carrier_id ?>" />
        <input type="hidden" name="func" value="<?php if (!empty($shipping_carrier_id)) echo "carrierupdate"; else echo "carrieradd"; ?>" />
        <input type="hidden" name="page" value="<?php echo $modulename?>.carrier_list" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="option" value="com_phpshop" />
        <input type="hidden" name="limitstart" value="<?php echo $limitstart ?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
<td width="21%" ><div align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CARRIER_FORM_NAME ?>:</div></td>
<td width="79%" ><input class="inputbox" type="text" name="shipping_carrier_name" size="32" maxlength="255" value="<?php $db->sp("shipping_carrier_name") ?>"></td>
</tr>
<tr>
<td width="21%" ><div align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CARRIER_FORM_LIST_ORDER ?>:</div></td>
<td width="79%" ><input class="inputbox" type="text" name="shipping_carrier_list_order" size="32" maxlength="255" value="<?php $db->sp("shipping_carrier_list_order") ?>"></td>
</tr>
</table>
</form>
