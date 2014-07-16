<?php
#####################################################################################################
#
#					Module pour la plateforme de paiement Systempay
#						Version : 1.3c (révision 46701)
#									########################
#					Développé pour VirtueMart
#						Version : 2.0.8
#						Compatibilité plateforme : V2
#									########################
#					Développé par Lyra Network
#						http://www.lyra-network.com/
#						29/04/2013
#						Contact : supportvad@lyra-network.com
#
#####################################################################################################

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Renders a label element
 */
jimport('joomla.form.formfield');
class JFormFieldReferringurl extends JFormField {
	/**
	 * Element name
	 *
	 * @access    protected
	 * @var        string
	 */
	public $type = 'referringurl';

	protected function getInput() {

		$this->value = JURI::root() . 'plugins/vmpayment/realex/jump.php';

		$class = !empty($this->class)? 'class="' . $this->class . '"' : 'class="text_area"';
		if ($this->editable == 'true') {
			$size = ($this->size) ? 'size="' . $this->size . '"' : '';

			return '<input type="text" name="' . $this->name . '" id="' . $this->name . '" value="' . $this->value . '" ' . $class . ' ' . $size . ' />';
		} else {
			return '<label for="' . $this->name . '"' . $class . '>' . $this->value . '</label>';
		}
	}
}