<?php
/**
 * Store controller
 *
 * @package	VirtueMart
 * @subpackage Store
 * @author Rick Glunt 
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

jimport('joomla.application.component.controller');

/**
 * Store Controller
 *
 * @package    VirtueMart
 * @subpackage Store
 * @author Rick Glunt 
 */
class JmartControllerStore extends JController
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
	}
	
	/**
	 * The default store view
	 */
	 function Store() {
	 	$document = JFactory::getDocument();
	    $document->addStyleSheet(JURI::base().'components/com_virtuemart/assets/css/vm.css');
	    
		$document = JFactory::getDocument();				
		$viewType	= $document->getType();
		$view = $this->getView('store', $viewType);		

		// Push a model into the view					
		/* Default model */
		$view->setModel( $this->getModel( 'store', 'VirtueMartModel' ), true );
		/* Country functions */
		$view->setModel( $this->getModel( 'country', 'VirtueMartModel' ));
		
		/* Now display the view. */
		$view->display();
	 }
	
	/**
	 * Handle the edit task
	 *
     * @author Rick Glunt
	 */
	function edit()
	{	
		JRequest::setVar('controller', 'store');
		JRequest::setVar('view', 'store');
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
		
		$this->setRedirect('index.php?option=com_virtuemart&view=store', $msg);
	}	
	
	
	/**
	 * Handle the save task
	 *
	 * @author Rick Glunt	 
	 */	
	function save()
	{
		$model = $this->getModel( 'store' );		
		
		if ($model->store()) {
			$msg = JText::_('Store saved!');
		}
		else {
			$msg = JText::_('Error saving store!');
		}
		
		$this->setRedirect('index.php?option=com_virtuemart&view=store', $msg);
	}	
	
	
	/**
	 * Handle the remove task
	 *
	 * @author Rick Glunt	 
	 */		
	function remove()
	{
		$model = $this->getModel('store');
		if (!$model->delete()) {
			$msg = JText::_('Error: One or more stores could not be deleted!');
		}
		else {
			$msg = JText::_( 'Stores Deleted!');
		}
	
		$this->setRedirect( 'index.php?option=com_virtuemart&view=store', $msg);
	}	
	
	
	/**
	 * Handle the publish task
	 *
	 * @author Rick Glunt	 
	 */		
	function publish()
	{
		$model = $this->getModel('store');
		if (!$model->publish(true)) {
			$msg = JText::_('Error: One or more stores could not be published!');
		}
	
		$this->setRedirect( 'index.php?option=com_virtuemart&view=store', $msg);
	}		
	
	
	/**
	 * Handle the publish task
	 *
	 * @author Rick Glunt	 
	 */		
	function unpublish()
	{
		$model = $this->getModel('store');
		if (!$model->publish(false)) {
			$msg = JText::_('Error: One or more stores could not be unpublished!');
		}
	
		$this->setRedirect( 'index.php?option=com_virtuemart&view=store', $msg);
	}

	/**
	 * Retrieve countrylist
	 */
	function getData() {
		/* Create the view object. */
		$view = $this->getView('store', 'json');
		
		/* Standard model */
		$view->setModel( $this->getModel( 'country', 'VirtueMartModel' ), true );
		
		/* Now display the view. */
		$view->display();
	}	
}
?>
