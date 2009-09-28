<?php
/**
* @package		VirtueMart
*/

jimport( 'joomla.application.component.view');
jimport('joomla.html.pane');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'adminMenu.php');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'image.php');

/**
 * HTML View class for the VirtueMart Component
 *
 * @package		VirtueMart
 */
class JmartViewJmart extends JView
{
	
	function display($tpl = null)
	{	
		$model =& $this->getModel();
	
//		$this->useVirtuemartBackend();
		parent::display($tpl);
	}
	
	function useVirtuemartBackend()
	{
		//A bit quickn Dirty the components\com_virtuemart\ may probably replaced
//	    include(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_virtuemart'.DS.'admin.vm.php');
		echo('In the Backend the JPATH_COMPONENT is: '.JPATH_COMPONENT);
//	    include(JPATH_COMPONENT.DS.'admin.vm.php');
	    include(JPATH_COMPONENT_ADMINISTRATOR.DS.'admin.vm.php');
	    
	 }
}
?>
