<?php
/**
 * @package		VirtueMart
 * @subpackage 	Config
 * @author 		RickG 
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
 * @author 		RickG 
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
		$themelist = $model->getThemeList();
		$this->assignRef('themelist', $themelist);
		$templatelist = $model->getTemplateList();
		$this->assignRef('templatelist', $templatelist);
		$flypagelist = $model->getFlypageList();
		$this->assignRef('flypagelist', $flypagelist);	
		$noimagelist = $model->getNoImageList();
		$this->assignRef('noimagelist', $noimagelist);		
		$orderStatusList = $model->getOrderStatusList();
		$this->assignRef('orderStatusList', $orderStatusList);			
	
		parent::display($tpl);
	}
}
?>
