<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Paymentmethod
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id$
 */

// Check to ensure this file is included in Joomla!
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
if ($this->payment->payment_jplugin_id) {
	?>
	<h2 style="text-align: center;"><?php echo $this->payment->payment_name ?></h2>
	<div style="text-align: center;"><?php echo  VmText::_('COM_VIRTUEMART_PAYMENT_CLASS_NAME').": ".$this->payment->payment_element ?></div>
	<?php
	if ($this->payment->form) {
		$fieldSets = $this->payment->form->getFieldsets();
		if (!empty($fieldSets)) {
			?>

				<?php
				foreach ($fieldSets as $name => $fieldSet) {
					?>
					<div class="<?php echo $control_field_class ?>">
						<?php
					$label = !empty($fieldSet->label) ? $fieldSet->label : strtoupper('VMPSPLUGIN_FIELDSET_' . $name);

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
					<?php foreach ($this->payment->form->getFieldset($name) as $field) { ?>
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
				?>

		<?php


		}
	}
} else {
	echo vmText::_('COM_VIRTUEMART_SELECT_PAYMENT_METHOD');
}




