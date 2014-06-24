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

class JElementInputMax extends JElement
{
	/**
	 * Element name
	 *
	 * @access    protected
	 * @var        string
	 */
	var $_name = 'inputMax';

	function fetchElement($name, $value, &$node, $control_name)
	{


		$class = ($node->attributes('class') ? 'class="' . $node->attributes('class') . '"' : 'class="text_area"');

		$size = ($node->attributes('size') ? 'size="' . $node->attributes('size') . '"' : '');
		$maxlength = ($node->attributes('maxlength') ? 'maxlength="' . $node->attributes('maxlength') . '"' : '');

		return '<input type="text" name="' . $control_name . '[' . $name . ']" id="' . $control_name . $name . '" value="' . $value . '" ' . $class . ' ' . $size . ' ' . $maxlength . '/>';

	}
}