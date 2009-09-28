<?php
/**
* @package		JMart
*/

jimport( 'joomla.application.component.view');
jimport('joomla.html.pane');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'adminMenu.php');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'image.php');

/**
 * HTML View class for the JMart Component
 *
 * @package		JMart
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
		//A bit quickn Dirty the components\com_jmart\ may probably replaced
//	    include(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jmart'.DS.'admin.jmart.php');
		echo('In the Backend the JPATH_COMPONENT is: '.JPATH_COMPONENT);
//	    include(JPATH_COMPONENT.DS.'admin.jmart.php');
	    include(JPATH_COMPONENT_ADMINISTRATOR.DS.'admin.jmart.php');
	    
	 }
}
?>
