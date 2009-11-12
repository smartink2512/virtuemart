<?php
defined('_JEXEC') or die('Restricted access'); 
?> 

<table>
	<tr><td valign="top">
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
	</td><td>
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
				if (VmConfig::getVar('show_prices')) $checked = 'checked="checked"'; ?>
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
				if (VmConfig::getVar('show_prices_with_tax')) $checked = 'checked="checked"'; ?>
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
				if (VmConfig::getVar('show_excluding_tax_note')) $checked = 'checked="checked"'; ?>
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
				if (VmConfig::getVar('show_including_tax_note')) $checked = 'checked="checked"'; ?>
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
				if (VmConfig::getVar('show_price_for_packaging')) $checked = 'checked="checked"'; ?>
				<input type="checkbox" name="show_price_for_packaging" value="1" <?php echo $checked; ?> />
			</td>
		</tr>
		</table>				
	</fieldset>	
	</td>
</tr>
<tr><td>
	<fieldset class="adminform">
		<legend><?php echo JText::_('VM_ADMIN_CFG_FRONTEND_FEATURES') ?></legend>
		<table class="adminform">
		<tr>
			<td class="labelcell">
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
			<td class="labelcell">
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
			<td class="labelcell">
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
			<td class="labelcell">
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
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_REVIEW_MINIMUM_COMMENT_LENGTH_TIP'); ?>">
				<label for="conf_VM_REVIEWS_MINIMUM_COMMENT_LENGTH"><?php echo JText::_('VM_ADMIN_CFG_REVIEW_MINIMUM_COMMENT_LENGTH') ?></label>
				
			</td>
			<td>
				<input type="text" size="6" id="comment_min_length" name="comment_min_length" class="inputbox" value="<?php echo VmConfig::getVar('comment_min_length'); ?>" />
			</td>
		</tr>
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_REVIEW_MAXIMUM_COMMENT_LENGTH_TIP'); ?>">
				<label for="conf_VM_REVIEWS_MAXIMUM_COMMENT_LENGTH"><?php echo JText::_('VM_ADMIN_CFG_REVIEW_MAXIMUM_COMMENT_LENGTH') ?></label>				
			</td>
			<td>
				<input type="text" size="6" id="comment_max_length" name="comment_max_length" class="inputbox" value="<?php echo VmConfig::getVar('comment_max_length'); ?>" />
			</td>
		</tr>

	</table>
	</fieldset>
</td><td>	
	<fieldset class="adminform">
		<legend><?php echo JText::_('VM_ADMIN_CFG_TAX_CONFIGURATION') ?></legend>
		<table class="adminform">
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN'); ?>">
				<label for="conf_TAX_VIRTUAL"><?php echo JText::_('VM_ADMIN_CFG_VIRTUAL_TAX') ?></label>
				
			</td>
			<td align="left">
				<?php
				$checked = '';
				if (VmConfig::getVar('virtual_tax')) $checked = 'checked="checked"'; ?>
				<input type="checkbox" name="virtual_tax" value="1" <?php echo $checked; ?> />
			</td>
		</tr>
		<tr>
			<td class="labelcell">
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
				if (VmConfig::getVar('enable_multiple_taxrates')) $checked = 'checked="checked"'; ?>
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
				if (VmConfig::getVar('subtract_payment_before_discount')) $checked = 'checked="checked"'; ?>
				<input type="checkbox" name="subtract_payment_before_discount" value="1" <?php echo $checked; ?> />
			</td>
		</tr>
	</table>		
	</fieldset>	
</td>
</tr>
<tr><td colspan="2">
	<fieldset class="adminform">
		<legend><?php echo JText::_('VM_ADMIN_CFG_USER_REGISTRATION_SETTINGS') ?></legend>	
		<table class="adminform">
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_CFG_REGISTRATION_TYPE_TIP'); ?>">
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
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_SHOW_REMEMBER_ME_BOX_TIP'); ?>">
				<?php echo JText::_('VM_SHOW_REMEMBER_ME_BOX') ?>				
			</td>
			<td>
				<?php
				$checked = '';
				if (VmConfig::getVar('show_remember_me_box')) $checked = 'checked="checked"'; ?>
				<input type="checkbox" name="show_remember_me_box" value="1" <?php echo $checked; ?> />
			</td> 
		</tr>
		
		<tr>
			<td class="key">
				<?php echo 'Joomla! ' . JText::_('VM_ADMIN_CFG_ALLOW_REGISTRATION'); ?>
			</td>
			<td colspan="2"><?php
			if ($this->joomlaconfig->getCfg('allowUserRegistration') == '1' ) {
				echo '<span style="color:green;">'.JText::_('VM_ADMIN_CFG_YES').'</span>';
			}
			else {
				echo '<span style="color:red;font-weight:bold;">'.JText::_('VM_ADMIN_CFG_NO').'</span>';
			}
			$link = JROUTE::_('administrator/index2.php?option=com_config&amp');
			echo JHTML::_('link', $link, '', JText::_('VM_UPDATE'));
			?></td>
		</tr>
		<tr>
			<td class="key">
				<?php echo 'Joomla! ' . JText::_('VM_ADMIN_CFG_ACCOUNT_ACTIVATION'); ?>
			</td>
			<td colspan="2"><?php
			if ($this->joomlaconfig->getCfg('useractivation') == '0' ) {
				echo '<span style="color:green;">'.JText::_('VM_ADMIN_CFG_NO').'</span>';
			}
			else {
				echo '<span style="color:red;font-weight:bold;">'.JText::_('VM_ADMIN_CFG_YES').'</span>';
			}
			$link = JROUTE::_('/administrator/index2.php?option=com_config&amp;hidemainmenu=1');
			echo JHTML::_('link', $link, '', JText::_('VM_UPDATE'));			
			?></td>
		</tr>
		
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_AGREE_TERMS_ONORDER') ?>
			</td>
			<td>
				<?php
				$checked = '';
				if (VmConfig::getVar('agree_tos_onorder')) $checked = 'checked="checked"'; ?>
				<input type="checkbox" name="agree_tos_onorder" value="1" <?php echo $checked; ?> />
			</td>
		</tr>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_ONCHECKOUT_SHOW_LEGALINFO_TIP'); ?>">
				<label for="conf_VM_ONCHECKOUT_SHOW_LEGALINFO"><?php echo JText::_('VM_ADMIN_ONCHECKOUT_SHOW_LEGALINFO') ?></label>
			</td>
			<td>
				<?php
				$checked = '';
				if (VmConfig::getVar('oncheckout_show_legal_info')) $checked = 'checked="checked"'; ?>
				<input type="checkbox" name="oncheckout_show_legal_info" value="1" <?php echo $checked; ?> />
			</td>
		</tr>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_ONCHECKOUT_LEGALINFO_SHORTTEXT_TIP'); ?>">
				<?php echo JText::_('VM_ADMIN_ONCHECKOUT_LEGALINFO_SHORTTEXT') ?>
			</td>
			<td>
				<textarea rows="6" cols="40" id="oncheckout_legalinfo_shorttext" name="oncheckout_legalinfo_shorttext" class="inputbox"><?php echo VmConfig::getVar('oncheckout_legalinfo_shorttext'); ?></textarea>
			</td>
		</tr>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_ONCHECKOUT_LEGALINFO_LINK_TIP'); ?>">
				<?php echo JText::_('VM_ADMIN_ONCHECKOUT_LEGALINFO_LINK') ?>
			</td>
			<td>
			<?php
			//$db->query( "SELECT id AS value, CONCAT( title, ' (', title_alias, ')' ) AS text FROM #__content ORDER BY id" );
			
			//$select =  "<select size=\"5\" name=\"conf_VM_ONCHECKOUT_LEGALINFO_LINK\" id=\"conf_VM_ONCHECKOUT_LEGALINFO_LINK\" class=\"inputbox\" style=\"width: 300px;\">\n";
			//while( $db->next_record()) {
		//		$selected = @VM_ONCHECKOUT_LEGALINFO_LINK == $db->f('value') ? 'selected="selected"' : '';
		//		$select .= "<option title=\"".$db->f('text')."\" value=\"".$db->f('value')."\" $selected>".$db->f('text')."</option>\n";
		//	}
			//$select .=  "</select>\n";
			echo $select;
			?>
			</td>
		</tr>
		
		</table>		
	</fieldset>	
</td></tr>
<tr><td colspan="2">	
	<fieldset class="adminform">
		<legend><?php echo JText::_('VM_ADMIN_CFG_CORE_SETTINGS') ?></legend>
		<table class="adminform">
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
            	<?php echo JText::_('VM_ADMIN_CFG_DEBUG_IP_ENABLED') ?></td>
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
            	<?php echo JText::_('VM_ADMIN_CFG_DEBUG_IP_ADDRESS') ?></td>
            <td>
                <input size="20" type="text" name="debug_ip_address" class="inputbox" value="<?php echo VmConfig::getVar('debug_ip_address'); ?>" />
            </td>
        </tr>
		</table>		
	</fieldset>
</td></tr>
<tr><td colspan="2">	
	<fieldset class="adminform">
    	<legend><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_HEADER') ?></legend>
		<table class="adminform">
        <tr>
            <td class="labelcell">
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
        	<td colspan="2">
        		<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_FORMAT_EXPLAIN_EXTRA') ?>
        	</td>
        </tr>
    </table>    	
	</fieldset>    
</td></tr>
</table>