<?php
defined('_JEXEC') or die('Restricted access'); 
?> 
<br />
<fieldset class="adminform">
<legend><?php echo JText::_('VM_ADMIN_CFG_GLOBAL') ?></legend>		
<table class="admintable">
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_SHOP_OFFLINE_TIP'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_SHOP_OFFLINE',false); ?>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('shop_is_offline')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="shop_is_offline" value="1" <?php echo $checked; ?> />
	</td>
</tr>
<tr>
	<td class="key"><?php echo JText::_('VM_ADMIN_CFG_SHOP_OFFLINE_MSG') ?></td>
	<td>
		<textarea rows="8" cols="35" name="offline_message"><?php echo VmConfig::getVar('offline_message'); ?></textarea>
	</td>
</tr>  
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_USE_ONLY_AS_CATALOGUE') ?>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('use_as_catalog')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="use_as_catalog" value="1" <?php echo $checked; ?> />
	</td>
</tr>
</table>				
</fieldset>

<fieldset class="adminform">
<legend><?php echo JText::_('VM_ADMIN_CFG_FRONTEND_FEATURES') ?></legend>
<table class="admintable">
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_CFG_CONTENT_PLUGINS_ENABLE_TIP'); ?>">
		<label for="conf_VM_CONTENT_PLUGINS_ENABLE"><?php echo JText::_('VM_CFG_CONTENT_PLUGINS_ENABLE') ?></label>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('enable_content_plugins')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="enable_content_plugins" value="1" <?php echo $checked; ?> />
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_COUPONS_ENABLE_EXPLAIN'); ?>">
		<label for="conf_PSHOP_COUPONS_ENABLE"><?php echo JText::_('VM_COUPONS_ENABLE') ?></label>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('enable_coupons')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="enable_coupons" value="1" <?php echo $checked; ?> />
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_REVIEW_EXPLAIN'); ?>">
		<label for="conf_PSHOP_ALLOW_REVIEWS"><?php echo JText::_('VM_ADMIN_CFG_REVIEW') ?></label>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('enable_reviews')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="enable_reviews" value="1" <?php echo $checked; ?> />
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_REVIEWS_AUTOPUBLISH_TIP'); ?>">
		<label for="conf_VM_REVIEWS_AUTOPUBLISH"><?php echo JText::_('VM_REVIEWS_AUTOPUBLISH') ?></label>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('autopublish_reviews')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="autopublish_reviews" value="1" <?php echo $checked; ?> />
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_REVIEW_MINIMUM_COMMENT_LENGTH_TIP'); ?>">
		<label for="conf_VM_REVIEWS_MINIMUM_COMMENT_LENGTH"><?php echo JText::_('VM_ADMIN_CFG_REVIEW_MINIMUM_COMMENT_LENGTH') ?></label>
	</td>
	<td>
		<input type="text" size="6" id="comment_min_length" name="comment_min_length" class="inputbox" value="<?php echo VmConfig::getVar('comment_min_length'); ?>" />
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_REVIEW_MAXIMUM_COMMENT_LENGTH_TIP'); ?>">
		<label for="conf_VM_REVIEWS_MAXIMUM_COMMENT_LENGTH"><?php echo JText::_('VM_ADMIN_CFG_REVIEW_MAXIMUM_COMMENT_LENGTH') ?></label>				
	</td>
	<td>
		<input type="text" size="6" id="comment_max_length" name="comment_max_length" class="inputbox" value="<?php echo VmConfig::getVar('comment_max_length'); ?>" />
	</td>
</tr>
</table>
</fieldset>

<fieldset class="adminform">
<legend><?php echo JText::_('VM_ADMIN_CFG_CORE_SETTINGS') ?></legend>
<table class="admintable">
<tr>
	<td class="key">
		<?php echo JText::_('VM_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS') ?>
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS_EXPLAIN'); ?>">				
	</td>
	<td valign="top">
		<?php
		$checked = '';
		if (VmConfig::getVar('show_out_of_stock_products')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="show_out_of_stock_products" value="1" <?php echo $checked; ?> />					
	</td>
</tr>
<tr>
	<td class="key">
		<?php echo JText::_('VM_ADMIN_CFG_COOKIE_CHECK') ?>
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_COOKIE_CHECK_EXPLAIN'); ?>">
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('enable_cookie_check')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="enable_cookie_check" value="1" <?php echo $checked; ?> />
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_CFG_CURRENCY_MODULE_TIP'); ?>">
		<?php echo JText::_('VM_CFG_CURRENCY_MODULE') ?>
	</td>
	<td>
		<select id="conf__VM_CURRENCY_CONVERTER_MODULE" name="conf__VM_CURRENCY_CONVERTER_MODULE" class="inputbox">
			<?php 
			//$files = vmReadDirectory( CLASSPATH."currency/", "convert?.", true, true);
			foreach ($files as $file) {
				$file_info = pathinfo($file);
				$filename = $file_info['basename'];
				$checked = ($filename == @VM_CURRENCY_CONVERTER_MODULE.'.php') ? 'selected="selected"' : "";
				echo "<option value=\"".basename($filename, '.php' )."\" $checked>$filename</option>\n";
			}
           ?>
		</select>
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_MAIL_FORMAT_EXPLAIN'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_MAIL_FORMAT') ?></td>
	<td>
		<select name="mail_format" class="inputbox">
		<option value="0" <?php if (VmConfig::getVar('mail_format') == '0') echo 'selected="selected"'; ?>>
	   <?php echo JText::_('VM_ADMIN_CFG_MAIL_FORMAT_TEXT') ?>
		</option>
		<option value="1" <?php if (VmConfig::getVar('mail_format') == '1') echo 'selected="selected"'; ?>>
		<?php echo JText::_('VM_ADMIN_CFG_MAIL_FORMAT_HTML') ?>
		</option>
		</select>
	</td>
</tr>
<tr>
	<td class="key">
		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_DEBUG_EXPLAIN'); ?>">
		<?php echo JText::_('VM_ADMIN_CFG_DEBUG') ?>
	</td>
	<td>
		<?php
		$checked = '';
		if (VmConfig::getVar('debug')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="debug" value="1" <?php echo $checked; ?> />				
	</td>
</tr>
<tr>
    <td class="key">
       	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_DEBUG_IP_ENABLED_EXPLAIN'); ?>">
       	<?php echo JText::_('VM_ADMIN_CFG_DEBUG_IP_ENABLED') ?>
    </td>
    <td>
		<?php
		$checked = '';
		if (VmConfig::getVar('debug_by_ip')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="debug_by_ip" value="1" <?php echo $checked; ?> />            	
    </td>
</tr>
<tr>
    <td class="key">
       	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_DEBUG_IP_ADDRESS_EXPLAIN'); ?>">
       	<?php echo JText::_('VM_ADMIN_CFG_DEBUG_IP_ADDRESS') ?>
   </td>
   <td>
        <input size="20" type="text" name="debug_ip_address" class="inputbox" value="<?php echo VmConfig::getVar('debug_ip_address'); ?>" />
   </td>
</tr>
</table>		
</fieldset>
	
<fieldset class="adminform">
<legend><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_HEADER') ?></legend>
<table class="admintable">
<tr>
	<td class="key">
       	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_ENABLED_EXPLAIN'); ?>">
       	<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_ENABLED') ?>
    </td>
    <td>
       	<?php
		$checked = '';
		if (VmConfig::getVar('enable_logfile')) $checked = 'checked="checked"'; ?>
		<input type="checkbox" name="enable_logfile" value="1" <?php echo $checked; ?> />
    </td>
</tr>
<tr>
    <td class="key">
      	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_NAME_EXPLAIN'); ?>">
       	<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_NAME') ?>
    </td>
    <td>
        <input size="65" type="text" name="logfile_name" class="inputbox" value="<?php echo VmConfig::getVar('logfile_name'); ?>" />
    </td>
</tr>
<tr>
	<td class="key">
   		<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_EXPLAIN'); ?>">
   		<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL') ?>
	</td>
    <td>
       	<?php if (!defined('VM_LOGFILE_LEVEL')) define('VM_LOGFILE_LEVEL', 'PEAR_LOG_WARNING'); ?>
        <select class="inputbox" name="logfile_level">
        <option value="PEAR_LOG_TIP" <?php if (VmConfig::getVar('logfile_level') == 'PEAR_LOG_TIP') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_TIP') ?></option>
        <option value="PEAR_LOG_DEBUG" <?php if (VmConfig::getVar('logfile_level') == 'PEAR_LOG_DEBUG') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_DEBUG') ?></option>
        <option value="PEAR_LOG_INFO" <?php if (VmConfig::getVar('logfile_level') == 'PEAR_LOG_INFO') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_INFO') ?></option>
        <option value="PEAR_LOG_NOTICE" <?php if (VmConfig::getVar('logfile_level') == 'PEAR_LOG_NOTICE') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_NOTICE') ?></option>
        <option value="PEAR_LOG_WARNING" <?php if (VmConfig::getVar('logfile_level') == 'PEAR_LOG_WARNING') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_WARNING') ?></option>
        <option value="PEAR_LOG_ERR" <?php if (VmConfig::getVar('logfile_level') == 'PEAR_LOG_ERR') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_ERR') ?></option>
        <option value="PEAR_LOG_CRIT" <?php if (VmConfig::getVar('logfile_level') == 'PEAR_LOG_CRIT') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_CRIT') ?></option>
        <option value="PEAR_LOG_ALERT" <?php if (VmConfig::getVar('logfile_level') == 'PEAR_LOG_ALERT') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_ALERT') ?></option>
        <option value="PEAR_LOG_EMERG" <?php if (VmConfig::getVar('logfile_level') == 'PEAR_LOG_EMERG') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_EMERG') ?></option>
	    </select>
   </td>
</tr>
<tr>
   	<?php
    if (VmConfig::getVar('logfile_level') <> '') {
       	$logfile_format = VmConfig::getVar('logfile_level');
    } else {
        $logfile_format = '%{timestamp} %{ident} [%{priority}] [%{remoteip}] [%{username}] %{message}';
	}
    ?>
    <td class="key">
       	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_FORMAT_EXPLAIN'); ?>">
       	<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_FORMAT') ?>
    </td>
    <td>
        <input size="65" type="text" name="logfile_format" class="inputbox" value="<?php echo VmConfig::getVar('logfile_format') ?>" />
    </td>
</tr>
<tr>
   	<td>&nbsp;</td>
   	<td>
   		<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_FORMAT_EXPLAIN_EXTRA') ?>
   	</td>
</tr>
</table>    	
</fieldset>    