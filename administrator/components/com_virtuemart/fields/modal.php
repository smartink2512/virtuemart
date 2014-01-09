<?php


defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

/**
 * Supports a modal product picker.
 *
 *
 */
class JFormFieldVmModal extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @author      Valerie Cartan Isaksen
	 * @var		string
	 *
	 */
	protected $type = 'vmModal';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */


	protected function getModalInput($view,$name, $key,$table)
	{
		// Load the modal behavior script.
		JHtml::_('behavior.modal', 'a.modal');
$function='jSelect'.ucfirst($view).'_'.$this->id;
		// Build the script.
		$script = array();
		$script[] = '	function  '.$function.'(id, '.$name.', object) {';
		$script[] = '		document.id("'.$this->id.'_id").value = id;';
		$script[] = '		document.id("'.$this->id.'_name").value = '.$name.';';
		$script[] = '		SqueezeBox.close();';
		$script[] = '	}';

		// Add the script to the document head.
		JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));


		// Setup variables for display.
		$html	= array();
		$link	= 'index.php?option=com_virtuemart&amp;view='.$view.'&amp;layout=modal&amp;tmpl=component&amp;function='.$function;
		$title="";
		if ($this->value) {
			if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_virtuemar'.DS.'helpers'.DS.'config.php');
			VmConfig::loadConfig();

			$db	= JFactory::getDBO();
			$db->setQuery(
				'SELECT '.$name.' ' .
				' FROM #__virtuemart_'.$table.'_' . VmConfig::$vmlang  .
				' WHERE '.$key.' = '.(int) $this->value
			);
			$title = $db->loadResult();

			if ($error = $db->getErrorMsg()) {
				JError::raiseWarning(500, $error);
			}
		}
		if (empty($title)) {
			$title = JText::_('COM_VIRTUEMART_SELECT_'.strtoupper($view));
		}
		$title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

		// The current user display field.
		$html[] = '<div class="fltlft">';
		$html[] = '  <input type="text" id="'.$this->id.'_name" value="'.$title.'" disabled="disabled" size="35" />';
		$html[] = '</div>';

		// The user select button.
		$html[] = '<div class="button2-left">';
		$html[] = '  <div class="blank">';
		$html[] = '	<a class="modal" title="'.JText::_('COM_VIRTUEMART_SELECT_'.strtoupper($view)).'"  href="'.$link.'&amp;'.JSession::getFormToken().'=1" rel="{handler: \'iframe\', size: {x: 800, y: 450}}">'.JText::_('COM_VIRTUEMART_CHANGE_MENU').'</a>';
		$html[] = '  </div>';
		$html[] = '</div>';

		// The active article id field.
		if (0 == (int)$this->value) {
			$value = '';
		} else {
			$value = (int)$this->value;
		}

		// class='required' for client side validation
		$class = '';
		if ($this->required) {
			$class = ' class="required modal-value"';
		}

		$html[] = '<input type="hidden" id="'.$this->id.'_id"'.$class.' name="'.$this->name.'" value="'.$value.'" />';

		return implode("\n", $html);
	}
	protected function getInput()
	{

	}
}
