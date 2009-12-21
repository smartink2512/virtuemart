<?php
defined('_JEXEC') or die('Restricted access'); 
?> 
<br />
<table>
    <tr><td valign="top">
	    <fieldset class="adminform">
		<legend><?php echo JText::_('VM_ADMIN_SECURITY_SETTINGS') ?></legend>
		<table class="adminform">
		    <tr>
			<td class="labelcell">Site URL</td>
			<td>
			    <input size="40" type="text" name="url" class="inputbox" value="<?php echo JText::_($this->config->get('url')); ?>" />
			</td>
		    </tr>
		    <tr>
			<td class="key">
			    <span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_URLSECURE_EXPLAIN'); ?>"/>
			    <?php echo JText::_('VM_ADMIN_CFG_URLSECURE') ?>
			</td>
			<td>
			    <input size="40" type="text" name="secureurl" class="inputbox" value="<?php echo JText::_($this->config->get('secureurl')); ?>" />
			</td>
		    </tr>
		    <tr>
			<td class="key">
			    <span class="editlinktip hasTip" title="<?php echo JText::_('VM_MODULES_FORCE_HTTPS_TIP'); ?>"/>
			    <?php echo JText::_('VM_MODULES_FORCE_HTTPS') ?>
			</td>
			<td>
			    <?php
			    echo JHTML::_('Select.genericlist', $this->moduleList, 'modules_force_https', 'size=4 multiple', 'module_id', 'module_name', $this->config->get('modules_force_https'));
			    ?>
			</td>
		    </tr>

		    <tr>
			<td class="key">
			    <span class="editlinktip hasTip" title="<?php echo JText::_('VM_GENERALLY_PREVENT_HTTPS_TIP'); ?>"/>
			    <?php echo JText::_('VM_GENERALLY_PREVENT_HTTPS') ?>
			</td>
			<td>
			    <?php
			    $checked = '';
			    if ($this->config->get('generally_prevent_https')) $checked = 'checked="checked"'; ?>
			    <input type="checkbox" name="generally_prevent_https" value="1" <?php echo $checked; ?> />
			</td>
		    </tr>
		    <?php
		    //if( version_compare( $database->getVersion(), '4.0.2', '>=') ) { ?>
		    <tr>
			<td class="key">
			    <span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_ENCRYPTION_FUNCTION_TIP'); ?>"/>
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
			    <span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_ENCRYPTION_KEY_TIP'); ?>"/>
			    <?php echo JText::_('VM_ADMIN_ENCRYPTION_KEY') ?>&nbsp;&nbsp;</td>
			<td>
			    <input type="text" name="encode_key" class="inputbox" size="40" value="<?php echo JText::_($this->config->get('encode_key')); ?>" />
			</td>
		    </tr>
		    <tr>
			<td>
			    <?php echo JText::_('VM_ADMIN_STORE_CREDITCARD_DATA'); ?>&nbsp;&nbsp;
			</td>
			<td>
			    <?php
			    $checked = '';
			    if ($this->config->get('store_creditcard_data')) $checked = 'checked="checked"'; ?>
			    <input type="checkbox" name="store_creditcard_data" value="1" <?php echo $checked; ?> />
			</td>
		    </tr>
		    <?php
		    if (stristr(JFactory::getUser()->usertype, "admin")) { ?>
		    <tr>
			<td>
			    <span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN'); ?>"/>
				<?php echo JText::_('VM_ADMIN_CFG_FRONTENDAMDIN') ?>
			</td>
			<td>
			    <?php
			    $checked = '';
			    if ($this->config->get('allow_frontendadmin_for_nonbackenders')) $checked = 'checked="checked"'; ?>
			    <input type="checkbox" name="allow_frontendadmin_for_nonbackenders" value="1" <?php echo $checked; ?> />
			</td>
		    </tr>
			<?php
		    }
		    else {
			echo '<input type="hidden" name="allow_frontendadmin_for_nonbackenders" value="'.$this->config->get('allow_frontendadmin_for_nonbackenders').'" />';
		    }
		    ?>
		</table>
	    </fieldset>

	</td><td valign="top">

	    <fieldset class="adminform">
		<legend><?php echo JText::_('VM_ADMIN_CFG_MORE_CORE_SETTINGS') ?></legend>
		<table class="adminform">
		    <tr>
			<td class="labelcell">
			    <span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_HOMEPAGE_EXPLAIN'); ?>"/>
			    <?php echo JText::_('VM_ADMIN_CFG_HOMEPAGE') ?>
			</td>
			<td>
			    <input type="text" name="homepage" class="inputbox" value="<?php echo JText::_($this->config->get('homepage')); ?>" />
			</td>
		    </tr>
		    <tr>
			<td class="labelcell">
			    <span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_ERRORPAGE_EXPLAIN'); ?>"/>
			    <?php echo JText::_('VM_ADMIN_CFG_ERRORPAGE') ?>
			</td>
			<td>
			    <input type="text" name="errorpage" class="inputbox" value="<?php echo JText::_($this->config->get('errorpage')); ?>" />
			</td>
		    </tr>
		</table>
	    </fieldset>

	    <fieldset class="adminform">
		<legend><?php echo JText::_('VM_ADMIN_CFG_PROXY_SETTINGS') ?></legend>
		<table class="adminform">
		    <tr>
			<td class="labelcell">
			    <span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PROXY_URL_TIP'); ?>"/>
			    <?php echo JText::_('VM_ADMIN_CFG_PROXY_URL') ?>
			</td>
			<td>
			    <input size="40" type="text" name="proxy_url" class="inputbox" value="<?php JText::_($this->config->get('proxy_url')); ?>" />
			</td>
		    </tr>
		    <tr>
			<td class="labelcell">
			    <span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PROXY_PORT_TIP'); ?>"/>
			    <?php echo JText::_('VM_ADMIN_CFG_PROXY_PORT') ?>
			</td>
			<td>
			    <input type="text" name="proxy_port" class="inputbox" value="<?php echo JText::_($this->config->get('proxy_port')); ?>" />
			</td>
		    </tr>
		    <tr>
			<td class="labelcell">
			    <span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PROXY_USER_TIP'); ?>"/>
			    <?php echo JText::_('VM_ADMIN_CFG_PROXY_USER') ?>
			</td>
			<td>
			    <input type="text" name="proxy_user" class="inputbox" value="<?php echo JText::_($this->config->get('proxy_user'));
				   ; ?>" />
			</td>
		    </tr>
		    <tr>
			<td class="labelcell">
			    <span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PROXY_PASS_TIP'); ?>"/>
			    <?php echo JText::_('VM_ADMIN_CFG_PROXY_PASS') ?>
			</td>
			<td>
			    <input autocomplete="off" type="password" name="proxy_pass" class="inputbox" value="<?php echo JText::_($this->config->get('proxy_pass')); ?>" />
			</td>
		    </tr>
		</table>
	    </fieldset>

	</td></tr>
</table>