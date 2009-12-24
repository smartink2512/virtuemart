<?php 
defined('_JEXEC') or die('Restricted access');

AdminMenuHelper::startAdminArea(); 
?>

<form action="index.php" method="post" name="adminForm">


    <div class="col50">
	<fieldset class="adminform">
	    <legend><?php echo JText::_('VM_MANUFACTURER_CAT_FORM_INFO_LBL'); ?></legend>
	    <table class="admintable">
		<tr>
		    <td width="110" class="key">
			<label for="title">
			    <?php echo JText::_( 'VM_MANUFACTURER_CAT_FORM_NAME' ); ?>:
			</label>
		    </td>
		    <td>
			<input class="inputbox" type="text" name="mf_category_name" id="mf_category_name" size="50" value="<?php echo $this->manufactuerCategory->mf_category_name; ?>" />
		    </td>
		</tr>
		<tr>
		    <td width="110" class="key">
			<label for="title">
			    <?php echo JText::_( 'VM_MANUFACTURER_CAT_FORM_DESCRIPTION' ); ?>:
			</label>
		    </td>
		    <td>
			<textarea name="mf_category_desc" rows="2" col="40"><?php echo $this->manufactuerCategory->mf_category_desc; ?></textarea>
		    </td>
		</tr>
	    </table>
	</fieldset>
    </div>

    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="mf_category_id" value="<?php echo $this->manufactuerCategory->mf_category_id; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="manufacturercategory" />
</form>


<?php AdminMenuHelper::endAdminArea(); ?> 