<?php
/**
* @package		JMart
*/

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the JMart Component
 *
 * @package		JMart
 */
class JMartViewBrowse extends JView
{
	
	function display($tpl = null)
	{	
		$model =& $this->getModel();
	
		
		parent::display($tpl);
	}
}
?>
