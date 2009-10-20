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
				if ($this->vmConfig->shop_is_offline) $checked = 'checked="checked"'; ?>
				<input type="checkbox" name="shop_is_offline" value="1" <?php echo $checked; ?> />
			</td>
		</tr>
		<tr>
			<td class="key"><?php echo JText::_('VM_ADMIN_CFG_SHOP_OFFLINE_MSG') ?></td>
			<td>
				<textarea rows="8" cols="35" name="offline_message"><?php echo $this->vmConfig->offline_message; ?></textarea>
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
				if ($this->vmConfig->use_as_catalog) $checked = 'checked="checked"'; ?>
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
				if ($this->vmConfig->show_prices) $checked = 'checked="checked"'; ?>
				<input type="checkbox" name="show_prices" value="1" <?php echo $checked; ?> />				
			</td>
		</tr>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_PRICE_ACCESS_LEVEL_TIP'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_PRICE_ACCESS_LEVEL') ?>
			</td>
			<td>
				<input type="checkbox" id="price_access_level_enabled" name="price_access_level_enabled" class="inputbox" value="<?php echo $this->vmConfig->price_access_level_enabled; ?>" />
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
				if ($this->vmConfig->show_prices_with_tax) $checked = 'checked="checked"'; ?>
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
				if ($this->vmConfig->show_excluding_tax_note) $checked = 'checked="checked"'; ?>
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
				if ($this->vmConfig->show_including_tax_note) $checked = 'checked="checked"'; ?>
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
				if ($this->vmConfig->show_price_for_packaging) $checked = 'checked="checked"'; ?>
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
				if ($this->vmConfig->enable_content_plugins) $checked = 'checked="checked"'; ?>
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
				if ($this->vmConfig->show_price_for_packaging) $checked = 'checked="checked"'; ?>
				<input type="checkbox" name="show_price_for_packaging" value="1" <?php echo $checked; ?> />
				<input type="checkbox" id="conf_PSHOP_COUPONS_ENABLE" name="conf_PSHOP_COUPONS_ENABLE" class="inputbox" <?php if (PSHOP_COUPONS_ENABLE == '1') echo "checked='checked'"; ?> value="1" />
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
				if ($this->vmConfig->show_price_for_packaging) $checked = 'checked="checked"'; ?>
				<input type="checkbox" name="show_price_for_packaging" value="1" <?php echo $checked; ?> />
				<input type="checkbox" id="conf_PSHOP_ALLOW_REVIEWS" name="conf_PSHOP_ALLOW_REVIEWS" class="inputbox" <?php if (PSHOP_ALLOW_REVIEWS == '1') echo "checked='checked'"; ?> value="1" />
			</td>
		</tr>
		
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_REVIEWS_AUTOPUBLISH_TIP'); ?>">
				<label for="conf_VM_REVIEWS_AUTOPUBLISH"><?php echo JText::_('VM_REVIEWS_AUTOPUBLISH') ?></label>
				
			</td>
			<td>
				<input type="checkbox" id="conf_VM_REVIEWS_AUTOPUBLISH" name="conf_VM_REVIEWS_AUTOPUBLISH" class="inputbox" <?php if (@VM_REVIEWS_AUTOPUBLISH == '1') echo "checked='checked'"; ?> value="1" />
			</td>
		</tr>
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_REVIEW_MINIMUM_COMMENT_LENGTH_TIP'); ?>">
				<label for="conf_VM_REVIEWS_MINIMUM_COMMENT_LENGTH"><?php echo JText::_('VM_ADMIN_CFG_REVIEW_MINIMUM_COMMENT_LENGTH') ?></label>
				
			</td>
			<td>
				<input type="text" size="6" id="conf_VM_REVIEWS_MINIMUM_COMMENT_LENGTH" name="conf_VM_REVIEWS_MINIMUM_COMMENT_LENGTH" class="inputbox" value="<?php echo @intval(VM_REVIEWS_MINIMUM_COMMENT_LENGTH); ?>" />
			</td>
		</tr>
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_REVIEW_MAXIMUM_COMMENT_LENGTH_TIP'); ?>">
				<label for="conf_VM_REVIEWS_MAXIMUM_COMMENT_LENGTH"><?php echo JText::_('VM_ADMIN_CFG_REVIEW_MAXIMUM_COMMENT_LENGTH') ?></label>
				
			</td>
			<td>
				<input type="text" size="6" id="conf_VM_REVIEWS_MAXIMUM_COMMENT_LENGTH" name="conf_VM_REVIEWS_MAXIMUM_COMMENT_LENGTH" class="inputbox" value="<?php echo @intval(VM_REVIEWS_MAXIMUM_COMMENT_LENGTH); ?>" />
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
				<input type="checkbox" name="conf_TAX_VIRTUAL" id="conf_TAX_VIRTUAL" class="inputbox" <?php if (TAX_VIRTUAL == 1) echo "checked=\"checked\""; ?> value="1" />
			</td>
		</tr>
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_TAX_MODE_EXPLAIN'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_TAX_MODE') ?>
			</td>
			<td>
				<select name="conf_TAX_MODE" class="inputbox">
					<option value="0" <?php if (TAX_MODE == 0) echo 'selected="selected"'; ?>>
					<?php echo JText::_('VM_ADMIN_CFG_TAX_MODE_SHIP') ?>
					</option>
					<option value="1" <?php if (TAX_MODE == 1) echo 'selected="selected"'; ?>>
					<?php echo JText::_('VM_ADMIN_CFG_TAX_MODE_VENDOR') ?>
					</option>
					<option value="17749" <?php if (TAX_MODE == 17749) echo 'selected="selected"'; ?>>
					<?php echo JText::_('VM_ADMIN_CFG_TAX_MODE_EU') ?>
					</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_MULTI_TAX_RATE') ?>
				
			</td>
			<td>
				<input type="checkbox" id="conf_MULTIPLE_TAXRATES_ENABLE" name="conf_MULTIPLE_TAXRATES_ENABLE" class="inputbox" <?php if (MULTIPLE_TAXRATES_ENABLE == '1') echo "checked=\"checked\""; ?> value="1" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN'); ?>">
				<?php echo JText::_('VM_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE') ?>
			</td>
			<td>
				<input type="checkbox" id="conf_PAYMENT_DISCOUNT_BEFORE" name="conf_PAYMENT_DISCOUNT_BEFORE" class="inputbox" <?php if (PAYMENT_DISCOUNT_BEFORE == '1') echo "checked=\"checked\""; ?> value="1" />
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
				<select id="conf_VM_REGISTRATION_TYPE" name="conf_VM_REGISTRATION_TYPE" class="inputbox">
					<option value="NORMAL_REGISTRATION"<?php if( @VM_REGISTRATION_TYPE == 'NORMAL_REGISTRATION' ) echo "selected=\"selected\""; ?>><?php echo JText::_('VM_CFG_REGISTRATION_TYPE_NORMAL_REGISTRATION') ?></option>
					<option value="SILENT_REGISTRATION"<?php if( @VM_REGISTRATION_TYPE == 'SILENT_REGISTRATION' ) echo "selected=\"selected\""; ?>><?php echo JText::_('VM_CFG_REGISTRATION_TYPE_SILENT_REGISTRATION') ?></option>
					<option value="OPTIONAL_REGISTRATION"<?php if( @VM_REGISTRATION_TYPE == 'OPTIONAL_REGISTRATION' ) echo "selected=\"selected\""; ?>><?php echo JText::_('VM_CFG_REGISTRATION_TYPE_OPTIONAL_REGISTRATION') ?></option>
					<option value="NO_REGISTRATION"<?php if( @VM_REGISTRATION_TYPE == 'NO_REGISTRATION' ) echo "selected=\"selected\""; ?>><?php echo JText::_('VM_CFG_REGISTRATION_TYPE_NO_REGISTRATION') ?></option>
				</select>
			</td> 
		</tr>
		
		<tr>
			<td class="labelcell">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_SHOW_REMEMBER_ME_BOX_TIP'); ?>">
				<?php echo JText::_('VM_SHOW_REMEMBER_ME_BOX') ?>
				
			</td>
			<td>
				<input type="checkbox" id="conf_VM_SHOW_REMEMBER_ME_BOX" name="conf_VM_SHOW_REMEMBER_ME_BOX" class="inputbox" <?php if (@VM_SHOW_REMEMBER_ME_BOX == "1") echo "checked=\"checked\""; ?> value="1" />
			</td> 
		</tr>
		
		<tr>
			<td class="key"><?php
			//echo $_VERSION->PRODUCT.': ' .  JText::_('VM_ADMIN_CFG_ALLOW_REGISTRATION');
			?></td>
			<td colspan="2"><?php
			if ($this->joomlaconfig->getCfg('allowUserRegistration') == '1' ) {
				echo '<span style="color:green;">'.JText::_('VM_ADMIN_CFG_YES').'</span>';
			}
			else {
				echo '<span style="color:red;font-weight:bold;">'.JText::_('VM_ADMIN_CFG_NO').'</span>';
			}
			$link = JROUTE::_('administrator/index2.php?option=com_config&amp;hidemainmenu=1');
			echo JHTML::_('link', $link, '', JText::_('VM_UPDATE'));
			?></td>
		</tr>
		<tr>
			<td class="key"><?php
			//echo $_VERSION->PRODUCT.': ' .  JText::_('VM_ADMIN_CFG_ACCOUNT_ACTIVATION');
			?></td>
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
				<input type="checkbox" id="conf_PSHOP_AGREE_TO_TOS_ONORDER" name="conf_PSHOP_AGREE_TO_TOS_ONORDER" class="inputbox" <?php if (PSHOP_AGREE_TO_TOS_ONORDER == '1') echo "checked=\"checked\""; ?> value="1" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_ONCHECKOUT_SHOW_LEGALINFO_TIP'); ?>">
				<label for="conf_VM_ONCHECKOUT_SHOW_LEGALINFO"><?php echo JText::_('VM_ADMIN_ONCHECKOUT_SHOW_LEGALINFO') ?></label>
			</td>
			<td>
				<input type="checkbox" id="conf_VM_ONCHECKOUT_SHOW_LEGALINFO" name="conf_VM_ONCHECKOUT_SHOW_LEGALINFO" class="inputbox" <?php if (@VM_ONCHECKOUT_SHOW_LEGALINFO == '1') echo "checked=\"checked\""; ?> value="1" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_ONCHECKOUT_LEGALINFO_SHORTTEXT_TIP'); ?>">
				<?php echo JText::_('VM_ADMIN_ONCHECKOUT_LEGALINFO_SHORTTEXT') ?>
			</td>
			<td>
				<textarea rows="6" cols="40" id="conf_VM_ONCHECKOUT_LEGALINFO_SHORTTEXT" name="conf_VM_ONCHECKOUT_LEGALINFO_SHORTTEXT" class="inputbox"><?php if( @VM_ONCHECKOUT_LEGALINFO_SHORTTEXT=='' || !defined('VM_ONCHECKOUT_LEGALINFO_SHORTTEXT')) {echo JText::_('VM_LEGALINFO_SHORTTEXT');} else {echo @VM_ONCHECKOUT_LEGALINFO_SHORTTEXT;} ?></textarea>
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
			</td>
			<td valign="top">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS_EXPLAIN'); ?>">
				<input  type="checkbox" name="conf_CHECK_STOCK" id="conf_CHECK_STOCK" class="inputbox" onchange="toggleVisibility( this.checked, 'cs1' );toggleVisibility( this.checked, 'cs2' );toggleVisibility( this.checked, 'cs3' );" <?php if (CHECK_STOCK == '1') echo "checked=\"checked\""; ?> value="1" />
				<div style="display:none;visibility:hidden;" id="cs2"><br/><br/><input type="checkbox" name="conf_PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS" id="conf_PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS" class="inputbox" <?php if (PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS == '1') echo "checked=\"checked\""; ?> value="1" /></div>
			</td>
		</tr>
		  <tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_COOKIE_CHECK_EXPLAIN'); ?>">
				<label for="conf_VM_ENABLE_COOKIE_CHECK"><?php echo JText::_('VM_ADMIN_CFG_COOKIE_CHECK') ?></label>
				
			</td>
			<td>
				<input type="checkbox" id="conf_VM_ENABLE_COOKIE_CHECK" name="conf_VM_ENABLE_COOKIE_CHECK" class="inputbox" <?php if (@VM_ENABLE_COOKIE_CHECK == '1') echo "checked=\"checked\""; ?> value="1" />
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
				<select name="conf_ORDER_MAIL_HTML" class="inputbox">
				<option value="0" <?php if (ORDER_MAIL_HTML == '0') echo 'selected="selected"'; ?>>
			   <?php echo JText::_('VM_ADMIN_CFG_MAIL_FORMAT_TEXT') ?>
				</option>
				<option value="1" <?php if (ORDER_MAIL_HTML == '1') echo 'selected="selected"'; ?>>
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
				<input type="checkbox" id="conf_DEBUG" name="conf_DEBUG" class="inputbox" <?php if (DEBUG == 1) echo "checked=\"checked\""; ?> value="1" />
			</td>
		</tr>
        <tr>
            <td class="key">
            	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_DEBUG_IP_ENABLED_EXPLAIN'); ?>">
            	<?php echo JText::_('VM_ADMIN_CFG_DEBUG_IP_ENABLED') ?></td>
            <td>
                <input type="checkbox" id="conf_VM_DEBUG_IP_ENABLED" name="conf_VM_DEBUG_IP_ENABLED" class="inputbox" <?php if (@VM_DEBUG_IP_ENABLED == 1) echo "checked=\"checked\""; ?> value="1" />
            </td>
        </tr>
        <tr>
            <td class="key">
            	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_DEBUG_IP_ADDRESS_EXPLAIN'); ?>">
            	<?php echo JText::_('VM_ADMIN_CFG_DEBUG_IP_ADDRESS') ?></td>
            <td>
                <input size="20" type="text" name="conf_VM_DEBUG_IP_ADDRESS" class="inputbox" value="<?php echo @VM_DEBUG_IP_ADDRESS ?>" />
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
                <input type="checkbox" id="conf_VM_LOGFILE_ENABLED" name="conf_VM_LOGFILE_ENABLED" class="inputbox" <?php if (@VM_LOGFILE_ENABLED == 1) echo "checked=\"checked\""; ?> value="1" />
            </td>
        </tr>
        <tr>
            <td class="key">
            	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_NAME_EXPLAIN'); ?>">
            	<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_NAME') ?>
            </td>
            <td>
                <input size="65" type="text" name="conf_VM_LOGFILE_NAME" class="inputbox" value="<?php if(defined('VM_LOGFILE_NAME')) echo VM_LOGFILE_NAME ?>" />
            </td>
        </tr>
    	<tr>
        <td class="key">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_EXPLAIN'); ?>">
        	<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL') ?>
        </td>
        <td>
        	<?php if (!defined('VM_LOGFILE_LEVEL')) define('VM_LOGFILE_LEVEL', 'PEAR_LOG_WARNING'); ?>
                <select class="inputbox" name="conf_VM_LOGFILE_LEVEL">
                        <option value="PEAR_LOG_TIP" <?php if (@VM_LOGFILE_LEVEL == 'PEAR_LOG_TIP') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_TIP') ?></option>
                        <option value="PEAR_LOG_DEBUG" <?php if (@VM_LOGFILE_LEVEL == 'PEAR_LOG_DEBUG') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_DEBUG') ?></option>
                        <option value="PEAR_LOG_INFO" <?php if (@VM_LOGFILE_LEVEL == 'PEAR_LOG_INFO') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_INFO') ?></option>
                        <option value="PEAR_LOG_NOTICE" <?php if (@VM_LOGFILE_LEVEL == 'PEAR_LOG_NOTICE') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_NOTICE') ?></option>
                        <option value="PEAR_LOG_WARNING" <?php if (@VM_LOGFILE_LEVEL == 'PEAR_LOG_WARNING') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_WARNING') ?></option>
                        <option value="PEAR_LOG_ERR" <?php if (@VM_LOGFILE_LEVEL == 'PEAR_LOG_ERR') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_ERR') ?></option>
                        <option value="PEAR_LOG_CRIT" <?php if (@VM_LOGFILE_LEVEL == 'PEAR_LOG_CRIT') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_CRIT') ?></option>
                        <option value="PEAR_LOG_ALERT" <?php if (@VM_LOGFILE_LEVEL == 'PEAR_LOG_ALERT') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_ALERT') ?></option>
                        <option value="PEAR_LOG_EMERG" <?php if (@VM_LOGFILE_LEVEL == 'PEAR_LOG_EMERG') echo "selected=\"selected\""; ?>><?php echo JText::_('VM_ADMIN_CFG_LOGFILE_LEVEL_EMERG') ?></option>
            </select>
        </td>
    	</tr>
        <tr>
        	<?php
            if(defined('VM_LOGFILE_FORMAT') && (VM_LOGFILE_FORMAT != '')) {
            	$logfile_format = VM_LOGFILE_FORMAT;
            } else {
                $logfile_format = '%{timestamp} %{ident} [%{priority}] [%{remoteip}] [%{username}] %{message}';
			}
            ?>
            <td class="key">
            	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_FORMAT_EXPLAIN'); ?>">
            	<?php echo JText::_('VM_ADMIN_CFG_LOGFILE_FORMAT') ?>
            </td>
            <td>
                <input size="65" type="text" name="conf_VM_LOGFILE_FORMAT" class="inputbox" value="<?php echo $logfile_format ?>" />
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