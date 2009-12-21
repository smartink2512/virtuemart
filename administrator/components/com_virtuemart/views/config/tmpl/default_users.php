<?php
defined('_JEXEC') or die('Restricted access'); 
?> 
<br />	
<fieldset class="adminform">
    <legend><?php echo JText::_('VM_ADMIN_CFG_USER_REGISTRATION_SETTINGS') ?></legend>
    <table class="admintable">
	<tr>
	    <td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_CFG_REGISTRATION_TYPE_TIP'); ?>"/>
		    <?php echo JText::_('VM_CFG_REGISTRATION_TYPE') ?>
	    </td>
	    <td>
		<?php
		$options = array();
		$options[] = JHTML::_('select.option', 'NORMAL_REGISTRATION', JText::_('VM_CFG_REGISTRATION_TYPE_NORMAL_REGISTRATION') );
		$options[] = JHTML::_('select.option', 'SILENT_REGISTRATION', JText::_('VM_CFG_REGISTRATION_TYPE_SILENT_REGISTRATION'));
		$options[] = JHTML::_('select.option', 'OPTIONAL_REGISTRATION', JText::_('VM_CFG_REGISTRATION_TYPE_OPTIONAL_REGISTRATION'));
		$options[] = JHTML::_('select.option', 'NO_REGISTRATION', JText::_('VM_CFG_REGISTRATION_TYPE_NO_REGISTRATION'));
		echo JHTML::_('Select.genericlist', $options, 'registration_type', 'size=1');
		?>
	    </td>
	</tr>
	<tr>
	    <td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_SHOW_REMEMBER_ME_BOX_TIP'); ?>"/>
		    <?php echo JText::_('VM_SHOW_REMEMBER_ME_BOX') ?>
	    </td>
	    <td>
		<?php
		$checked = '';
		if ($this->config->get('show_remember_me_box')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="show_remember_me_box" value="1" <?php echo $checked; ?> />
	    </td>
	</tr>
	<tr>
	    <td class="key">
		<?php echo 'Joomla! ' . JText::_('VM_ADMIN_CFG_ALLOW_REGISTRATION'); ?>
	    </td>
	    <td><?php
		if ($this->joomlaconfig->getCfg('allowUserRegistration') == '1' ) {
		    echo '<span style="color:green;">'.JText::_('VM_ADMIN_CFG_YES').'</span>';
		}
		else {
		    echo '<span style="color:red;font-weight:bold;">'.JText::_('VM_ADMIN_CFG_NO').'</span>';
		}
		$link = JROUTE::_('index.php?option=com_config');
		echo JHTML::_('link', $link, '&nbsp;['.JText::_('VM_UPDATE').']');
		?></td>
	</tr>
	<tr>
	    <td class="key">
		<?php echo 'Joomla! ' . JText::_('VM_ADMIN_CFG_ACCOUNT_ACTIVATION'); ?>
	    </td>
	    <td><?php
		if ($this->joomlaconfig->getCfg('useractivation') == '0' ) {
		    echo '<span style="color:green;">'.JText::_('VM_ADMIN_CFG_NO').'</span>';
		}
		else {
		    echo '<span style="color:red;font-weight:bold;">'.JText::_('VM_ADMIN_CFG_YES').'</span>';
		}
		$link = JROUTE::_('index.php?option=com_config');
		echo JHTML::_('link', $link, '&nbsp['.JText::_('VM_UPDATE').']');
		?>
	    </td>
	</tr>
	<tr>
	    <td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN'); ?>"/>
		    <?php echo JText::_('VM_ADMIN_CFG_AGREE_TERMS_ONORDER') ?>
	    </td>
	    <td>
		<?php
		$checked = '';
		if ($this->config->get('agree_to_tos_onorder')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="agree_to_tos_onorder" value="1" <?php echo $checked; ?> />
	    </td>
	</tr>
	<tr>
	    <td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_ONCHECKOUT_SHOW_LEGALINFO_TIP'); ?>"/>
		    <label for="conf_VM_ONCHECKOUT_SHOW_LEGALINFO"><?php echo JText::_('VM_ADMIN_ONCHECKOUT_SHOW_LEGALINFO') ?></label>
	    </td>
	    <td>
		<?php
		$checked = '';
		if ($this->config->get('oncheckout_show_legal_info')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="oncheckout_show_legal_info" value="1" <?php echo $checked; ?> />
	    </td>
	</tr>
	<tr>
	    <td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_ONCHECKOUT_LEGALINFO_SHORTTEXT_TIP'); ?>"/>
		    <?php echo JText::_('VM_ADMIN_ONCHECKOUT_LEGALINFO_SHORTTEXT') ?>
	    </td>
	    <td>
		<textarea rows="6" cols="40" id="oncheckout_legalinfo_shorttext" name="oncheckout_legalinfo_shorttext" class="inputbox"><?php echo $this->config->get('oncheckout_legalinfo_shorttext'); ?></textarea>
	    </td>
	</tr>
	<tr>
	    <td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_ONCHECKOUT_LEGALINFO_LINK_TIP'); ?>"/>
		    <?php echo JText::_('VM_ADMIN_ONCHECKOUT_LEGALINFO_LINK') ?>
	    </td>
	    <td>
		<?php
		echo JHTML::_('Select.genericlist', $this->contentLinks, 'oncheckout_legalinfo_link', 'size=5', 'id', 'text', $this->config->get('oncheckout_legalinfo_link'));
		?>
	    </td>
	</tr>
    </table>
</fieldset>