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
				<input size="40" type="text" name="url" class="inputbox" value="<?php echo VmConfig::getVar('url'); ?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_URLSECURE_EXPLAIN'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_URLSECURE') ?>
			</td>
			<td>
				<input size="40" type="text" name="secureurl" class="inputbox" value="<?php echo VmConfig::getVar('secureurl') ?>" />
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
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_GENERALLY_PREVENT_HTTPS_TIP'); ?>">
				<input type="checkbox" id="conf_VM_GENERALLY_PREVENT_HTTPS" name="conf_VM_GENERALLY_PREVENT_HTTPS" class="inputbox" <?php if (@VM_GENERALLY_PREVENT_HTTPS == '1') echo "checked=\"checked\""; ?> value="1" />
			</td>
			<td>
				<label for="conf_VM_GENERALLY_PREVENT_HTTPS"><?php echo JText::_('VM_GENERALLY_PREVENT_HTTPS') ?></label>
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
					$options = array('ENCODE' => 'ENCODE (insecure)', 
								'AES_ENCRYPT' => 'AES_ENCRYPT (strong security)'
								);
					//echo ps_html::selectList('conf_ENCRYPT_FUNCTION', @VM_ENCRYPT_FUNCTION, $options );
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
				<input type="text" name="conf_ENCODE_KEY" class="inputbox" value="<?php //echo shopMakeHtmlSafe(ENCODE_KEY) ?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_STORE_CREDITCARD_DATA_TIP'); ?>">
				<input type="checkbox" name="conf_VM_STORE_CREDITCARD_DATA" id="conf_VM_STORE_CREDITCARD_DATA" class="inputbox" <?php if (@VM_STORE_CREDITCARD_DATA == '1') echo "checked=\"checked\""; ?> value="1" />
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
			<td class="labelcell">
				<input type="checkbox" id="conf_PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS" name="conf_PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS" class="inputbox" <?php if (PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS == '1') echo "checked=\"checked\""; ?> value="1" />
			</td>
			<td>
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN'); ?>">				
				<?php echo JText::_('VM_ADMIN_CFG_FRONTENDAMDIN') ?></label>
			</td>
		</tr>
		<?php
	  	}
	  	else {
	  		echo '<input type="hidden" name="conf_PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS" value="'.PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS.'" />';
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
				<input size="40" type="text" name="conf_VM_TABLEPREFIX" class="inputbox" value="<?php echo VM_TABLEPREFIX ?>" readonly="readonly" />
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
				<input type="text" name="conf_HOMEPAGE" class="inputbox" value="<?php echo HOMEPAGE ?>" />
			</td>
		</tr>
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_ERRORPAGE_EXPLAIN'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_ERRORPAGE') ?>
			</td>
			<td>
				<input type="text" name="conf_ERRORPAGE" class="inputbox" value="<?php echo ERRORPAGE ?>" />
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
				<input size="40" type="text" name="conf_VM_PROXY_URL" class="inputbox" value="<?php echo defined('VM_PROXY_URL')?VM_PROXY_URL:''; ?>" />
			</td>
		</tr>
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PROXY_PORT_TIP'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_PROXY_PORT') ?>
			</td>
			<td>
				<input type="text" name="conf_VM_PROXY_PORT" class="inputbox" value="<?php echo defined('VM_PROXY_PORT')?VM_PROXY_PORT:''; ?>" />
			</td>
		</tr>
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PROXY_USER_TIP'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_PROXY_USER') ?>
			</td>
			<td>
				<input type="text" name="conf_VM_PROXY_USER" class="inputbox" value="<?php echo defined('VM_PROXY_USER')?VM_PROXY_USER:''; ?>" />
			</td>
		</tr>
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PROXY_PASS_TIP'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_PROXY_PASS') ?>
			</td>
			<td>
				<input autocomplete="off" type="password" name="conf_VM_PROXY_PASS" class="inputbox" value="<?php echo defined('VM_PROXY_PASS')?VM_PROXY_PASS:''; ?>" />
			</td>
		</tr>
	</table>
	</fieldset>
	
</td></tr>
</table>