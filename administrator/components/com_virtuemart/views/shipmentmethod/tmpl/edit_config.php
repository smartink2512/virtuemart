<?php

/**
 *
 * Description
 *
 * @package	VirtueMart
 * @subpackage shipment
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_config.php 3386 2011-05-27 12:34:11Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

if ($this->shipment->shipment_name) {
	if ($this->shipment->form) {
		$fieldSets = $this->shipment->form->getFieldsets();
		if (!empty($fieldSets)) {

			?>
<table width="100%" class="paramlist admintable" cellspacing="1">
	<tbody>
	<?php
	foreach ($fieldSets as $name => $fieldSet) {
		$label = !empty($fieldSet->label) ? $fieldSet->label : 'JGLOBAL_FIELDSET_'.$name;
		$class = isset($fieldSet->class) && !empty($fieldSet->class) ? $fieldSet->class : '';

		if (isset($fieldSet->description) && trim($fieldSet->description)) {
			echo '<p class="tip">'.$this->escape(vmText::_($fieldSet->description)).'</p>';
		}
		?>

		<?php foreach ($this->shipment->form->getFieldset($name) as $field) { ?>
			<tr>
				<td width="40%" class="paramlist_key">
					<?php echo $field->label; ?>
				</td>
				<td class="paramlist_value">
					<?php echo $field->input; ?>
				</td>
			</tr>
		<?php }?>

	<?php

	}
	?>
	</tbody></table>
<?php
	} else {
		$parameters = new vmParameters($this->shipment, $this->shipment->shipment_element, 'plugin', 'vmshipment');

		echo $rendered = $parameters->render();
		}
	}
} else {
    echo vmText::_('COM_VIRTUEMART_SELECT_SHIPPING_METHOD');
}

