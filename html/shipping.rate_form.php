<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shipping.rate_form.php,v 1.6 2005/01/27 19:34:03 soeren_nb Exp $
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
<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_FORM_LBL ?></h2>
<?php
$shipping_rate_id = mosgetparam( $_REQUEST, 'shipping_rate_id');

if (!empty($shipping_rate_id)) {
  $q = "SELECT * FROM #__pshop_shipping_rate WHERE shipping_rate_id='$shipping_rate_id'";
  $db->query($q);
  $db->next_record();
}
?><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" name="adminForm">
        <input type="hidden" name="shipping_rate_id" value="<?php echo $shipping_rate_id ?>" />
        <input type="hidden" name="func" value="<?php if ($shipping_rate_id) echo "rateupdate"; else echo "rateadd"; ?>" />
        <input type="hidden" name="page" value="<?php echo $modulename?>.rate_list" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="option" value="com_phpshop" />
        <?php $limitstart = mosgetparam( $_REQUEST, 'limitstart'); ?>
        <input type="hidden" name="limitstart" value="<?php echo $limitstart ?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
<td width="21%" ><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_FORM_NAME ?>:</strong></div></td>
<td width="79%" >
<input type="text" class="inputbox" name="shipping_rate_name" size="32" maxlength="255" value="<?php $db->sp("shipping_rate_name") ?>">
</td>
</tr>
<tr>
<td width="21%" ><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_FORM_LIST_ORDER ?>:</strong></div></td>
<td width="79%" >
<input type="text" class="inputbox" name="shipping_rate_list_order" size="32" maxlength="255" value="<?php $db->sp("shipping_rate_list_order") ?>">
</td>
</tr>
<tr>
<td width="21%" ><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_FORM_CARRIER ?>:</strong></div></td>
<td width="79%" ><?php $ps_shipping->carrier_list("shipping_rate_carrier_id", $db->f("shipping_rate_carrier_id")); ?></td>
</tr>
<tr>
<td width="21%" valign="top" ><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_FORM_COUNTRY .": </strong><br/><br/>".$PHPSHOP_LANG->_PHPSHOP_MULTISELECT ?></td>
<td width="79%" ><?php $ps_shipping->country_multiple_list("shipping_rate_country[]", $db->f("shipping_rate_country")); ?></td>
</tr>
<tr>
<td width="21%" ><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_FORM_ZIP_START ?>:</td>
<td width="79%" >
<input type="text" class="inputbox" name="shipping_rate_zip_start" size="32" maxlength="255" value="<?php $db->sp("shipping_rate_zip_start") ?>">
</td>
</tr>
<tr>
<td width="21%" ><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_FORM_ZIP_END ?>:</td>
<td width="79%" >
<input type="text" class="inputbox" name="shipping_rate_zip_end" size="32" maxlength="255" value="<?php $db->sp("shipping_rate_zip_end") ?>">
</td>
</tr>
<tr>
<td width="21%" ><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_FORM_WEIGHT_START ?>:</strong></div></td>
<td width="79%" >
<input type="text" class="inputbox" name="shipping_rate_weight_start" size="32" maxlength="255" value="<?php $db->sp("shipping_rate_weight_start") ?>">
</td>
</tr>
<tr>
<td width="21%" ><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_FORM_WEIGHT_END ?>:</strong></div></td>
<td width="79%" >
<input type="text" class="inputbox" name="shipping_rate_weight_end" size="32" maxlength="255" value="<?php $db->sp("shipping_rate_weight_end") ?>">
</td>
</tr>
<tr>
<td width="21%" ><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_FORM_VALUE ?>:</strong></div></td>
<td width="79%" >
<input type="text" class="inputbox" name="shipping_rate_value" size="32" maxlength="255" value="<?php $db->sp("shipping_rate_value") ?>">
</td>
</tr>
<tr>
<td width="21%" ><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_FORM_PACKAGE_FEE ?>:</strong></div></td>
<td width="79%" >
<input type="text" class="inputbox" name="shipping_rate_package_fee" size="32" maxlength="255" value="<?php $db->sp("shipping_rate_package_fee") ?>">
</td>
</tr>
<tr>
<td width="21%" ><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_FORM_CURRENCY ?>:</strong></div></td>
<td width="79%" >
<?php $ps_html->list_currency_id("shipping_rate_currency_id",$db->sf("shipping_rate_currency_id")) ?>
</td>
</tr>
<?php if (TAX_MODE == '1') { ?>
<tr>
<td width="21%" ><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_RATE_FORM_VAT_ID ?>:</strong></div></td>
<td width="79%" >
<?php
require_once(CLASSPATH.'ps_tax.php');
$ps_tax = new ps_tax;
$ps_tax->list_tax_value("shipping_rate_vat_id",$db->sf("shipping_rate_vat_id")) ?>
</td>
</tr>
<?php } //end if TAX_MODE == '1' ?>


</table>
</form>
