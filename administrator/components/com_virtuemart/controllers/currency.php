<?php
/**
 * Currency controller
 *
 * @package	JMart
 * @subpackage Currency
 * @author Rick Glunt 
 * @copyright Copyright (c) 2009 JMart Team. All rights reserved.
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

jimport('joomla.application.component.controller');

/**
 * Currency Controller
 *
 * @package    JMart
 * @subpackage Currency
 * @author Rick Glunt 
 */
class JmartControllerCurrency extends JController
{
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function __construct() {
		parent::__construct();
		
		// Register Extra tasks
		$this->registerTask( 'add',  'edit' );			
		
	    $document =& JFactory::getDocument();
	    $document->addStyleSheet(JURI::base().'components/com_jmart/assets/css/jmart.css');
	    
		$document =& JFactory::getDocument();				
		$viewType	= $document->getType();
		$view =& $this->getView('currency', $viewType);		

		// Push a model into the view					
		$model =& $this->getModel('currency');
		if (!JError::isError($model)) {
			$view->setModel($model, true);
		}					
	}
	
	/**
	 * Display the currency view
	 *
	 * @author Rick Glunt	 
	 */
	function display() {			
		parent::display();
	}
	
	
	/**
	 * Handle the edit task
	 *
     * @author Rick Glunt
	 */
	function edit()
	{				
		JRequest::setVar('controller', 'currency');
		JRequest::setVar('view', 'currency');
		JRequest::setVar('layout', 'edit');
		JRequest::setVar('hidemenu', 1);		
		
		parent::display();
	}		
	
	
	/**
	 * Handle the cancel task
	 *
	 * @author Rick Glunt
	 */
	function cancel()
	{
		$msg = JText::_('Operation Canceled!!');
		
		$this->setRedirect('index.php?option=com_jmart&view=currency', $msg);
	}	
	
	
	/**
	 * Handle the save task
	 *
	 * @author Rick Glunt	 
	 */	
	function save()
	{
		$model =& $this->getModel('currency');		
		
		if ($model->store()) {
			$msg = JText::_('Currency saved!');
		}
		else {
			$msg = JText::_($model->getError());
		}
		
		$this->setRedirect('index.php?option=com_jmart&view=currency', $msg);
	}	
	
	
	/**
	 * Handle the remove task
	 *
	 * @author Rick Glunt	 
	 */		
	function remove()
	{
		$model = $this->getModel('currency');
		if (!$model->delete()) {
			$msg = JText::_('Error: One or more currencies could not be deleted!');
		}
		else {
			$msg = JText::_( 'Currencies Deleted!');
		}
	
		$this->setRedirect( 'index.php?option=com_jmart&view=currency', $msg);
	}	
	
	
	/**
	 * Handle the publish task
	 *
	 * @author Rick Glunt	 
	 */		
	function publish()
	{
		$model = $this->getModel('currency');
		if (!$model->publish(true)) {
			$msg = JText::_('Error: One or more currencies could not be published!');
		}
	
		$this->setRedirect( 'index.php?option=com_jmart&view=currency', $msg);
	}		
	
	
	/**
	 * Handle the publish task
	 *
	 * @author Rick Glunt	 
	 */		
	function unpublish()
	{
		$model = $this->getModel('currency');
		if (!$model->publish(false)) {
			$msg = JText::_('Error: One or more currencies could not be unpublished!');
		}
	
		$this->setRedirect( 'index.php?option=com_jmart&view=currency', $msg);
	}	
}
?>
