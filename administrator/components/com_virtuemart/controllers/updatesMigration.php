<?php
/**
 * Country controller
 *
 * @package	VirtueMart
 * @subpackage Country
 * @author Rick Glunt 
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

jimport('joomla.application.component.controller');

/**
 * Country Controller
 *
 * @package    VirtueMart
 * @subpackage Country
 * @author Rick Glunt 
 */
class JmartControllerUpdatesMigration extends JController
{
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function __construct() {
		parent::__construct();
		
		// Register Extra tasks
//		$this->registerTask( 'add',  'edit' );			
		
	    $document =& JFactory::getDocument();
	    $document->addStyleSheet(JURI::base().'components/com_virtuemart/assets/css/vm.css');
	    
		$document =& JFactory::getDocument();				
		$viewType	= $document->getType();
		$view =& $this->getView('updatesMigration', $viewType);		

		// Push a model into the view					
		$model =& $this->getModel('updatesMigration');
		if (!JError::isError($model)) {
			$view->setModel($model, true);
		}			
		
		 //JRequest::setVar('task', 'submit');
	}
	
	/**
	 * Display the country view
	 *
	 * @author Rick Glunt	 
	 */
	function display() {			
		parent::display();
	}
	
	/**
	 * Updates the table to the last version of JM
	 * 
	 * @author Max Milbers
	 */
	function correctTable() 
	{
		echo 'I am here!';
	} 
	
//	/**
//	 * Handle the edit task
//	 *
//     * @author Rick Glunt
//	 */
//	function edit()
//	{				
//		JRequest::setVar('controller', 'updates_migration');
//		JRequest::setVar('view', 'updates_migration');
////		JRequest::setVar('layout', 'edit');
////		JRequest::setVar('hidemenu', 1);		
//		
//		parent::display();
//	}		
	
	
//	/**
//	 * Handle the cancel task
//	 *
//	 * @author Rick Glunt
//	 */
//	function cancel()
//	{
//		$msg = JText::_('Operation Canceled!!');
//		
//		$this->setRedirect('index.php?option=com_virtuemart&view=country', $msg);
//	}	
	
	
//	/**
//	 * Handle the save task
//	 *
//	 * @author Rick Glunt	 
//	 */	
//	function save()
//	{
//		$model =& $this->getModel('country');		
//		
//		if ($model->store()) {
//			$msg = JText::_('Country saved!');
//		}
//		else {
//			$msg = JText::_($model->getError());
//		}
//		
//		$this->setRedirect('index.php?option=com_virtuemart&view=country', $msg);
//	}	
	
	
//	/**
//	 * Handle the remove task
//	 *
//	 * @author Rick Glunt	 
//	 */		
//	function remove()
//	{
//		$model = $this->getModel('country');
//		if (!$model->delete()) {
//			$msg = JText::_('Error: One or more countries could not be deleted!');
//		}
//		else {
//			$msg = JText::_( 'Countries Deleted!');
//		}
//	
//		$this->setRedirect( 'index.php?option=com_virtuemart&view=country', $msg);
//	}	
//	
	
//	/**
//	 * Handle the publish task
//	 *
//	 * @author Rick Glunt	 
//	 */		
//	function publish()
//	{
//		$model = $this->getModel('country');
//		if (!$model->publish(true)) {
//			$msg = JText::_('Error: One or more countries could not be published!');
//		}
//	
//		$this->setRedirect( 'index.php?option=com_virtuemart&view=country', $msg);
//	}		
//	
//	
//	/**
//	 * Handle the publish task
//	 *
//	 * @author Rick Glunt	 
//	 */		
//	function unpublish()
//	{
//		$model = $this->getModel('country');
//		if (!$model->publish(false)) {
//			$msg = JText::_('Error: One or more countries could not be unpublished!');
//		}
//	
//		$this->setRedirect( 'index.php?option=com_virtuemart&view=country', $msg);
//	}	
}
?>
