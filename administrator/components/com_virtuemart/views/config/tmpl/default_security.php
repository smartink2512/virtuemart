<?php
defined('_JEXEC') or die('Restricted access'); 
?> 

<table>
<tr><td valign="top">
	<fieldset class="adminform">
		<legend><?php echo JText::_('VM_ADMIN_SECURITY_SETTINGS') ?></legend>
		<table class="adminform">
		<tr>
			<td class="labelcell">Site URL</td>
			<td>
				<input size="40" type="text" name="url" class="inputbox" value="<?php echo JText::_(VmConfig::getVar('url')); ?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_URLSECURE_EXPLAIN'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_URLSECURE') ?>
			</td>
			<td>
				<input size="40" type="text" name="secureurl" class="inputbox" value="<?php echo JText::_(VmConfig::getVar('secureurl')); ?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_MODULES_FORCE_HTTPS_TIP'); ?>">
				<?php echo JText::_('VM_MODULES_FORCE_HTTPS') ?>				
			</td>
			<td>
				<?php
				//echo ps_module::list_modules( 'conf_VM_MODULES_FORCE_HTTPS[]', $VM_MODULES_FORCE_HTTPS, true );
				?>
			</td>
		</tr>
	
		<tr>
			<td>
				<?php
				$checked = '';
				if (VmConfig::getVar('generally_prevent_https')) $checked = 'checked="checked"'; ?>
				<input type="checkbox" name="generally_prevent_https" value="1" <?php echo $checked; ?> />
			</td>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_GENERALLY_PREVENT_HTTPS_TIP'); ?>">
				<?php echo JText::_('VM_GENERALLY_PREVENT_HTTPS') ?>
			</td>			
		</tr>
		<tr>
			<td colspan="3"><hr />&nbsp;</td>
		</tr>
		<?php
		//if( version_compare( $database->getVersion(), '4.0.2', '>=') ) { ?>
			<tr>
				<td class="key">
					<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_ENCRYPTION_FUNCTION_TIP'); ?>">
					<?php echo JText::_('VM_ADMIN_ENCRYPTION_FUNCTION') ?>&nbsp;&nbsp;
				</td>
				<td>
					<?php
					$options = array();
					$options[] = JHTML::_('select.option', 'ENCODE', JText::_('ENCODE (insecure)'));
					$options[] = JHTML::_('select.option', 'AES_ENCRYPT', JText::_('AES_ENCRYPT (strong security)'));
					echo JHTML::_('Select.genericlist', $options, 'encrypt_function', 'size=1');
					?>
				</td>
			</tr>
		<?php
		//}
		?>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_ENCRYPTION_KEY_TIP'); ?>">
				<?php echo JText::_('VM_ADMIN_ENCRYPTION_KEY') ?>&nbsp;&nbsp;</td>
			<td>
				<input type="text" name="conf_ENCODE_KEY" class="inputbox" value="<?php echo JText::_(VmConfig::getVar('encode_key')); ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<?php
				$checked = '';
				if (VmConfig::getVar('store_creditcard_data')) $checked = 'checked="checked"'; ?>
				<input type="checkbox" name="store_creditcard_data" value="1" <?php echo $checked; ?> />
			</td>			
			<td>
				<label for="conf_VM_STORE_CREDITCARD_DATA"><?php echo JText::_('VM_ADMIN_STORE_CREDITCARD_DATA') ?>&nbsp;&nbsp;</label>
			</td>
		</tr>	
		<tr>
			<td colspan="3"><hr />&nbsp;</td>
		</tr>
		<?php
	  	if (stristr(JFactory::getUser()->usertype, "admin")) { ?>
		  <tr>		  
		  	<td>
				<?php
				$checked = '';
				if (VmConfig::getVar('allow_frontendadminfor_nonbackenders')) $checked = 'checked="checked"'; ?>
				<input type="checkbox" name="allow_frontendadminfor_nonbackenders" value="1" <?php echo $checked; ?> />
			</td>	
			<td>
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN'); ?>">				
				<?php echo JText::_('VM_ADMIN_CFG_FRONTENDAMDIN') ?></label>
			</td>
		</tr>
		<?php
	  	}
	  	else {
	  		echo '<input type="hidden" name="allow_frontendadminfor_nonbackenders" value="'.VmConfig::getVar('allow_frontendadminfor_nonbackenders').'" />';
	  	}
		?>
		</table>    	
	</fieldset>
	    
	</td><td valign="top">	
		
	<fieldset class="adminform">
	<legend><?php echo JText::_('VM_ADMIN_CFG_MORE_CORE_SETTINGS') ?></legend>
	<table class="adminform">
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_TABLEPREFIX_TIP'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_TABLEPREFIX') ?>
			</td>
			<td>
				<input size="40" type="text" name="conf_VM_TABLEPREFIX" class="inputbox" value="<?php echo JText::_(VmConfig::getVar('table_prefix')); ?>" readonly="readonly" />
			</td>
		</tr>
		<tr>
			<td colspan="3"><hr />&nbsp;</td>
		</tr>
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_HOMEPAGE_EXPLAIN'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_HOMEPAGE') ?>
			</td>
			<td>
				<input type="text" name="conf_HOMEPAGE" class="inputbox" value="<?php echo JText::_(VmConfig::getVar('homepage')); ?>" />
			</td>
		</tr>
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_ERRORPAGE_EXPLAIN'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_ERRORPAGE') ?>
			</td>
			<td>
				<input type="text" name="conf_ERRORPAGE" class="inputbox" value="<?php echo JText::_(VmConfig::getVar('errorpage')); ?>" />
			</td>
		</tr>
	</table>
	</fieldset>

	<fieldset class="adminform">
	<legend><?php echo JText::_('VM_ADMIN_CFG_PROXY_SETTINGS') ?></legend>
	<table class="adminform">
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PROXY_URL_TIP'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_PROXY_URL') ?>
			</td>
			<td>
				<input size="40" type="text" name="conf_VM_PROXY_URL" class="inputbox" value="<?php JText::_(VmConfig::getVar('proxy_url')); ?>" />
			</td>
		</tr>
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PROXY_PORT_TIP'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_PROXY_PORT') ?>
			</td>
			<td>
				<input type="text" name="conf_VM_PROXY_PORT" class="inputbox" value="<?php echo JText::_(VmConfig::getVar('proxy_port')); ?>" />
			</td>
		</tr>
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PROXY_USER_TIP'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_PROXY_USER') ?>
			</td>
			<td>
				<input type="text" name="conf_VM_PROXY_USER" class="inputbox" value="<?php echo JText::_(VmConfig::getVar('proxy_user'));; ?>" />
			</td>
		</tr>
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PROXY_PASS_TIP'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_PROXY_PASS') ?>
			</td>
			<td>
				<input autocomplete="off" type="password" name="conf_VM_PROXY_PASS" class="inputbox" value="<?php echo JText::_(VmConfig::getVar('proxy_pass'));; ?>" />
			</td>
		</tr>
	</table>
	</fieldset>
	
</td></tr>
</table>