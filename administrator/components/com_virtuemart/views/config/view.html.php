<?php
/**
 * @package		VirtueMart
 * @subpackage 	Config
 * @author 		Rick Glunt 
*/

jimport( 'joomla.application.component.view');
jimport('joomla.html.pane');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'adminMenu.php');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'image.php');

/**
 * HTML View class for the configuration maintenance
 *
 * @package		VirtueMart
 * @subpackage 	Config
 * @author 		Rick Glunt 
 */
class VirtuemartViewConfig extends JView
{
	
	function display($tpl = null)
	{	
		$model =& $this->getModel();

		JToolBarHelper::title(JText::_('VM_CONFIG'), 'vm_config_48');
		JToolBarHelper::divider();
		JToolBarHelper::save();
		JToolBarHelper::apply();
		JToolBarHelper::cancel('cancel', 'Close');
	
		$mainframe = JFactory::getApplication();
		$this->assignRef('joomlaconfig', $mainframe);
		
		$vmConfig = $model->getConfig();
		$this->assignRef('vmConfig', $vmConfig);
	
		parent::display($tpl);
	}
}
?>
