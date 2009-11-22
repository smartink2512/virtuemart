<?php
defined('_JEXEC') or die('Restricted access'); 
?> 
<br />
<fieldset class="adminform">
<legend><?php echo JText::_('VM_ADMIN_CFG_PRICE_CONFIGURATION') ?></legend>	
<table class="admintable">
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_SHOW_PRICES_EXPLAIN'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_SHOW_PRICES') ?>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('show_prices')) $checked = 'checked'; ?>
		<input type="checkbox" name="show_prices" value="1" <?php echo $checked; ?> />				
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PRICE_ACCESS_LEVEL_TIP'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_PRICE_ACCESS_LEVEL') ?>
	</td>
	<td>
		<input type="checkbox" id="price_access_level_enabled" name="price_access_level_enabled" class="inputbox" value="<?php echo VmConfig::getVar('price_access_level_enabled'); ?>" />
		<?php echo JText::_('VM_CFG_ENABLE_FEATURE'); ?>
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PRICE_SHOW_WITHOUTTAX_TIP'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_PRICE_SHOW_WITHOUTTAX') ?>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('show_prices_with_tax')) $checked = 'checked"'; ?>
		<input type="checkbox" name="show_prices_with_tax" value="1" <?php echo $checked; ?> />
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PRICE_SHOW_EXCLUDINGTAX_TIP'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_PRICE_SHOW_EXCLUDINGTAX') ?>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('show_excluding_tax_note')) $checked = 'checked'; ?>
		<input type="checkbox" name="show_excluding_tax_note" value="1" <?php echo $checked; ?> />
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PRICE_SHOW_WITHTAX_TIP'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_PRICE_SHOW_WITHTAX') ?>
	</td>
	<td>
		<input type="checkbox" id="conf_VM_PRICE_SHOW_WITHTAX" name="conf_VM_PRICE_SHOW_WITHTAX" class="inputbox" <?php if (defined('VM_PRICE_SHOW_WITHTAX')) { if (VM_PRICE_SHOW_WITHTAX == 1) { echo "checked=\"checked\""; }} ?> value="1" />
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PRICE_SHOW_INCLUDINGTAX_TIP'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_PRICE_SHOW_INCLUDINGTAX') ?>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('show_including_tax_note')) $checked = 'checked"'; ?>
		<input type="checkbox" name="show_including_tax_note" value="1" <?php echo $checked; ?> />
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PRICE_SHOW_PACKAGING_PRICELABEL_TIP'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_PRICE_SHOW_PACKAGING_PRICELABEL'); ?>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('show_price_for_packaging')) $checked = 'checked"'; ?>
		<input type="checkbox" name="show_price_for_packaging" value="1" <?php echo $checked; ?> />
	</td>
</tr>
</table>
</fieldset>

<fieldset class="adminform">
<legend><?php echo JText::_('VM_ADMIN_CFG_TAX_CONFIGURATION') ?></legend>	
<table class="admintable">
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN'); ?>">
		<label for="conf_TAX_VIRTUAL"><?php echo JText::_('VM_ADMIN_CFG_VIRTUAL_TAX') ?></label>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('virtual_tax')) $checked = 'checked"'; ?>
		<input type="checkbox" name="virtual_tax" value="1" <?php echo $checked; ?> />
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_TAX_MODE_EXPLAIN'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_TAX_MODE') ?>
	</td>
	<td>
		<?php
		$options = array();
		$options[] = JHTML::_('select.option', '0', JText::_('VM_ADMIN_CFG_TAX_MODE_SHIP') );
		$options[] = JHTML::_('select.option', '1', JText::_('VM_ADMIN_CFG_TAX_MODE_VENDOR'));
		$options[] = JHTML::_('select.option', '17749', JText::_('VM_ADMIN_CFG_TAX_MODE_EU'));
		echo JHTML::_('Select.genericlist', $options, 'tax_mode', 'size=1');
		?>				
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_MULTI_TAX_RATE') ?>				
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('enable_multiple_taxrates')) $checked = 'checked'; ?>
		<input type="checkbox" name="enable_multiple_taxrates" value="1" <?php echo $checked; ?> />
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE') ?>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('subtract_payment_before_discount')) $checked = 'checked'; ?>
		<input type="checkbox" name="subtract_payment_before_discount" value="1" <?php echo $checked; ?> />
	</td>
</tr>
</table>