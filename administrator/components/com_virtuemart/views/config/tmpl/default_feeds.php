<?php
defined('_JEXEC') or die('Restricted access');  
?>
<br />
<table class="admintable">
   <tr>
        <td class="key">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_FEED_ENABLE_TIP'); ?>">
			<label for="conf_VM_FEED_ENABLED"><?php echo JText::_('VM_ADMIN_CFG_FEED_ENABLE') ?></label>        		
        </td>
        <td>
            <?php
			$checked = '';
			if (VmConfig::getVar('feed_enabled')) $checked = 'checked="checked"'; ?>
			<input type="checkbox" name="feed_enabled" value="1" <?php echo $checked; ?> />            
        </td>
    </tr>
   <tr>
        <td class="key">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_FEED_CACHE_TIP'); ?>">
        	<?php echo JText::_('VM_ADMIN_CFG_FEED_CACHE') ?></td>
        <td>
        	<?php
			$checked = '';
			if (VmConfig::getVar('feed_cache')) $checked = 'checked="checked"'; ?>
			<input type="checkbox" name="feed_cache" value="1" <?php echo $checked; ?> /> 
            <br />
			<input type="text" size="10" value="<?php echo defined(VmConfig::getVar('feed_cachetime')) ? VmConfig::getVar('feed_cachetime') : 1800  ?>" name="feed_cachetime" id="feed_cachetime" />
			<?php echo JText::_('VM_ADMIN_CFG_FEED_CACHETIME') ?>
        </td>
    </tr>

   <tr>
        <td class="key">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_FEED_TITLE_CATEGORIES_TIP'); ?>">
        	<?php echo JText::_('VM_ADMIN_CFG_FEED_TITLE') ?></td>
        <td>
			<input type="text" size="40" value="<?php echo VmConfig::getVar('feed_title'); ?>" name="feed_title" id="feed_title" /><br />
        </td>
    </tr>
   <tr>
        <td class="key">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_FEED_TITLE_CATEGORIES_TIP'); ?>">
        	<?php echo JText::_('VM_ADMIN_CFG_FEED_TITLE_CATEGORIES') ?>
        	</td>
        <td>
			<input type="text" size="40" value="<?php echo VmConfig::getVar('feed_category_title'); ?>" name="feed_category_title" id="feed_category_title" /><br />
        </td>
    </tr>    
   <tr>
        <td class="key">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_FEED_SHOWIMAGES_TIP'); ?>">
			<?php echo JText::_('VM_ADMIN_CFG_FEED_SHOWIMAGES') ?>        		
        </td>
        <td>
        	<?php
			$checked = '';
			if (VmConfig::getVar('feed_show_images')) $checked = 'checked="checked"'; ?>
			<input type="checkbox" name="feed_show_images" value="1" <?php echo $checked; ?> /> 
        </td>
    </tr>
   <tr>
        <td class="key">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_FEED_SHOWPRICES_TIP'); ?>">
        	<?php echo JText::_('VM_ADMIN_CFG_FEED_SHOWPRICES') ?>        		
        </td>
        <td>
        	<?php
			$checked = '';
			if (VmConfig::getVar('feed_show_prices')) $checked = 'checked="checked"'; ?>
			<input type="checkbox" name="feed_show_prices" value="1" <?php echo $checked; ?> />
        </td>
    </tr>
   <tr>
        <td class="key">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_FEED_SHOWDESC_TIP'); ?>">
			<?php echo JText::_('VM_ADMIN_CFG_FEED_SHOWDESC') ?>        		
        </td>
        <td>
        	<?php
			$checked = '';
			if (VmConfig::getVar('feed_show_description')) $checked = 'checked="checked"'; ?>
			<input type="checkbox" name="feed_show_description" value="1" <?php echo $checked; ?> />        	
        </td>
    </tr>
   <tr>
        <td class="key">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_FEED_DESCRIPTION_TYPE_TIP'); ?>">
        	<?php echo JText::_('VM_ADMIN_CFG_FEED_DESCRIPTION_TYPE') ?>
        </td>
        <td>
			<?php
			$options = array();
			$options[] = JHTML::_('select.option', 'product_s_desc', JText::_('VM_PRODUCT_FORM_S_DESC'));
			$options[] = JHTML::_('select.option', 'product_desc', JText::_('VM_PRODUCT_FORM_DESCRIPTION'));				
			echo JHTML::_('Select.genericlist', $options, 'product_s_desc', 'size=1');
			?>          	
        </td>
    </tr>
   <tr>
        <td class="key">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_MAX_TEXT_LENGTH_TIP'); ?>">
        	<?php echo JText::_('VM_ADMIN_CFG_FEED_LIMITTEXT') ?>
        </td>
        <td>
        	<?php
			$checked = '';
			if (VmConfig::getVar('feed_limittext')) $checked = 'checked="checked"'; ?>
			<input type="checkbox" name="feed_limittext" value="1" <?php echo $checked; ?> />        	
        </td>
    </tr>
   <tr>
        <td class="key">
        	<span class="editlinktip hasTip" title="<?php echo JText::_('VM_ADMIN_CFG_MAX_TEXT_LENGTH_TIP'); ?>">
        	<?php echo JText::_('VM_ADMIN_CFG_FEED_MAX_TEXT_LENGTH') ?>
        </td>
        <td>
			<input type="text" size="10" value="<?php echo defined(VmConfig::getVar('feed_max_text_length')) ? VmConfig::getVar('feed_max_text_length') : 500  ?>" name="feed_max_text_length" id="feed_max_text_length" />
        </td>
    </tr>    
    </table> 	