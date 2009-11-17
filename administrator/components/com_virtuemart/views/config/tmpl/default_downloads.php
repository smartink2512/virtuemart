<?php
defined('_JEXEC') or die('Restricted access');  
?> 
	<table class="adminform">
  	<tr>
    	<td class="labelcell">
    		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN'); ?>">
    		<?php echo JText::_('VM_ADMIN_CFG_ENABLE_DOWNLOADS') ?>
    	</td>
        <td>
            <?php
			$checked = '';
			if (VmConfig::getVar('enable_downloads')) $checked = 'checked="checked"'; ?>
			<input type="checkbox" name="enable_downloads" value="1" <?php echo $checked; ?> />
        </td>
    </tr>
    <tr>
        <td class="labelcell">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN'); ?>">
        	<?php echo JText::_('VM_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS') ?></td>
        <td>
			<?php echo JHTML::_('Select.genericlist', $this->orderStatusList, 'enable_download_status', 'size=1', 'order_status_code', 'order_status_name', VmConfig::getVar('enable_download_status')); ?>
        </td>
    </tr>
        <tr>
        <td class="labelcell">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN'); ?>">
        	<?php echo JText::_('VM_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS') ?>
        </td>
        <td>
			<?php echo JHTML::_('Select.genericlist', $this->orderStatusList, 'disable_download_status', 'size=1', 'order_status_code', 'order_status_name', VmConfig::getVar('disable_download_status')); ?>
        </td>
    </tr>
      <tr>
        <td class="labelcell">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_DOWNLOADROOT_EXPLAIN'); ?>">
        	<?php echo JText::_('VM_ADMIN_CFG_DOWNLOADROOT') ?></td>
        <td valign="top">
            <input size="40" type="text" name="conf_DOWNLOADROOT" class="inputbox" value="<?php echo VmConfig::getVar('download_root'); ?>" />
        </td>
    </tr>
    <tr>
    	<td class="labelcell">
      		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN'); ?>">
      		<?php echo JText::_('VM_ADMIN_CFG_DOWNLOAD_MAX') ?>
      	</td>
        <td>
            <input size="3" type="text" name="download_max" class="inputbox" value="<?php echo VmConfig::getVar('download_max'); ?>" />
        </td>
    </tr>
    <tr>
    	<td class="labelcell">
      		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN'); ?>">
      		<?php echo JText::_('VM_ADMIN_CFG_DOWNLOAD_EXPIRE') ?></td>
        <td>
            <input size="8" type="text" name="download_expire" class="inputbox" value="<?php echo VmConfig::getVar('download_expire'); ?>" />
        </td>
    </tr>
    <tr>
      	<td class="labelcell">
      		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_DOWNLOAD_KEEP_STOCKLEVEL_TIP'); ?>">
      		<?php echo JText::_('VM_ADMIN_CFG_DOWNLOAD_KEEP_STOCKLEVEL') ?>
      	</td>
        <td>
            <?php
			$checked = '';
			if (VmConfig::getVar('downloadable_products_keep_stocklevel')) $checked = 'checked="checked"'; ?>
			<input type="checkbox" name="downloadable_products_keep_stocklevel" value="1" <?php echo $checked; ?> />
        </td>
    </tr>
    </table>    	