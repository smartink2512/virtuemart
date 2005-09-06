<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: zone.zone_form.php,v 1.5 2005/02/22 18:58:35 soeren_nb Exp $
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
?>

<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_MOD ?></h2>
<?php 
$zone_id = mosgetparam( $_REQUEST, 'zone_id');
if (!empty($zone_id)) {
  $q = "SELECT * FROM #__pshop_zone_shipping WHERE zone_id='$zone_id'"; 
  $db->query($q);  
  $db->next_record();
}  
?><br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" name="adminForm">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td valign="top">
			<div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_FORM_NAME_LBL;?>:&nbsp;</strong></div>
		</td>
		<td valign="top">
		  <input type="text" name="zone_name" size="25" value="<?php echo $db->sp("zone_name");?>" />
		</td>
	</tr>
	<tr>
		<td valign="top">
			<div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_FORM_DESC_LBL;?>:&nbsp;</strong></div>
		</td>
		<td valign="top">
		  <textarea name="zone_description" rows="7" cols="35"><?php echo $db->sp("zone_description");?></textarea>
		</td>
	</tr>
	<tr>
	  <td valign="top">
		  <div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_FORM_COST_PER_LBL;?>:&nbsp;</strong></div>
	  </td>
	  <td valign="top">
		<input type="text" name="zone_cost" size="5" value="<?php echo $db->sp("zone_cost");?>" />
	  </td>
	</tr>
	<tr>
	  <td valign="top">
		  <div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_FORM_COST_LIMIT_LBL;?>:&nbsp;</strong></div>
	  </td>
	  <td valign="top">
		<input type="text" name="zone_limit" size="5" value="<?php echo $db->sp("zone_limit");?>">
	  </td>
	</tr>
	<tr>
	  <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_UPS_TAX_CLASS ?></strong></div></td>
	  <td>
		<?php
		require_once(CLASSPATH.'ps_tax.php');
		ps_tax::list_tax_value("zone_tax_rate", $db->sf("zone_tax_rate")) ;
		echo mosToolTip($PHPSHOP_LANG->_PHPSHOP_UPS_TAX_CLASS_TOOLTIP) ?>
	  </td>
	</tr>	
	<tr>
		<td valign="top" colspan="2">&nbsp; </td>
	</tr>
</table>
<?php 
if (!empty($zone_id)) { ?>
  <input type="hidden" name="zone_id" value="<?php echo $zone_id ?>" /><?php 
}?>
<input type="hidden" name="option" value="com_phpshop" />
<input type="hidden" name="func" value="<?php if ($zone_id) echo "updatezone"; else echo "addzone"; ?>" />
<input type="hidden" name="page" value="zone.zone_list" />
<input type="hidden" name="task" value="" />
<?php $limitstart = mosgetparam( $_REQUEST, 'limitstart'); ?>
<input type="hidden" name="limitstart" value="<?php echo $limitstart ?>" />
</form>



