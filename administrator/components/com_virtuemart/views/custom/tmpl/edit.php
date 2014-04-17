<?php
/**
 *
 * Description
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: media_edit.php 3049 2011-04-17 07:01:44Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
vmJsApi::JvalideForm();
AdminUIHelper::startAdminArea($this);
?>
<form name="adminForm" id="adminForm" method="post" action="">
    <fieldset>
	<legend><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_CUSTOM_FIELD'); ?></legend>
	<?php
	$this->addHidden('view', 'custom');
	$this->addHidden('task', '');
	$this->addHidden(JSession::getFormToken(), 1);
//if ($this->custom->custom_parent_id) $this->customfields->addHidden('custom_parent_id',$this->custom->custom_parent_id);
	$attribute_id = vRequest::getVar('attribute_id', '');
	if (!empty($attribute_id))
	    $this->customfields->addHidden('attribute_id', $attribute_id);
	?>
	<table class="admintable">
	    <?php echo $this->displayCustomFields($this->custom); ?>

	    <tr id="custom_plg">
		<td valign="top"><?php echo vmText::_('COM_VIRTUEMART_SELECT_CUSTOM_PLUGIN') ?></td>
		<td>
		    <fieldset>
			<?php echo $this->pluginList ?>
			<div class="clear"></div>
    			<div id="plugin-Container">
				<?php
				defined('_JEXEC') or die('Restricted access');
				if (JVM_VERSION < 3){
					$control_field_class="width100 floatleft control-field";
					$control_group_class="width100 control-group";
					$control_label_class="width25 floatleft control-label";
					$control_input_class="width74 floatright control-input";
				} else {
					$control_field_class="control-field";
					$control_group_class="control-group";
					$control_label_class="control-label";
					$control_input_class="control-input";
				}
				if ($this->custom->custom_jplugin_id) {

					?>
					<h2 style="text-align: center;"><?php echo vmText::_($this->custom->custom_title) ?></h2>
					<div style="text-align: center;"><?php echo  VmText::_('COM_VIRTUEMART_CUSTOM_CLASS_NAME').": ".$this->custom->custom_element ?></div>
					<?php
					if ($this->custom->form) {

						$fieldSets = $this->custom->form->getFieldsets();
						vmdebug('my custom ',$fieldSets);
						if (!empty($fieldSets)) {
							?>

							<?php
							foreach ($fieldSets as $name => $fieldSet) {
								?>
								<div class="<?php echo $control_field_class ?>">
									<?php
									$label = !empty($fieldSet->label) ? $fieldSet->label : strtoupper('VMPLUGIN_FIELDSET_' . $name);

									if (!empty($label)) {
										$class = isset($fieldSet->class) && !empty($fieldSet->class) ? "class=\"".$fieldSet->class."\"" : '';
										?>
										<h3> <span<?php echo $class  ?>><?php echo vmText::_($label) ?></span></h3>
										<?php
										if (isset($fieldSet->description) && trim($fieldSet->description)) {
											echo '<p class="tip">' . $this->escape(vmText::_($fieldSet->description)) . '</p>';
										}
									}
									?>

									<?php $i=0; ?>
									<?php foreach ($this->custom->form->getFieldset($name) as $field) { ?>
										<?php if (!$field->hidden) {
											?>
											<div class="<?php echo $control_group_class ?>">
												<div class="<?php echo $control_label_class ?>">
													<?php echo $field->label; ?>
												</div>
												<div class="<?php echo $control_input_class ?>">
													<?php echo $field->input; ?>
												</div>
											</div>
										<?php } ?>
									<?php } ?>

								</div>
							<?php

							}

						}
					}
				} else {
					echo vmText::_('COM_VIRTUEMART_SELECT_CUSTOM_METHOD');
				}
				?>

    			</div>
    		    </fieldset>
    		</td>
    	    </tr>
	    <?php //} ?>
	</table>
    </fieldset>
    <?php if (!empty($this->customPlugin->custom_jplugin_id)) { ?>
        <input type="hidden" name="id" value="<?php echo $this->customPlugin->virtuemart_custom_id ?>" >
    <?php } ?>
</form>
<script type="text/javascript">
function submitbutton(pressbutton) {
	if (pressbutton=='cancel'){
        submitform(pressbutton);
        return true;
    }
	if (jQuery('#adminForm').validationEngine('validate')== true){
        submitform(pressbutton);
        return true;
    }
	else return false ;
}
jQuery(function($) {

<?php if ($this->custom->field_type !== "E") { ?>$('#custom_plg').hide();<?php } ?>
    $('#field_type').change(function () {
	var $selected = $(this).val();
	if ($selected == "E" ) $('#custom_plg').show();
	else { $('#custom_plg').hide();
	    $('#custom_jplugin_id option:eq(0)').attr("selected", "selected");
	    $('#custom_jplugin_id').change();
	}

    });
    $('#custom_jplugin_id').change(function () {
	var $id = $(this).val();
	$('#plugin-Container').load( 'index.php?option=com_virtuemart&view=custom&task=viewJson&format=json&custom_jplugin_id='+$id , function() { 
	$(this).find("[title]").vm2admin('tips',tip_image) });

    });
});
</script>
<?php AdminUIHelper::endAdminArea(); ?>