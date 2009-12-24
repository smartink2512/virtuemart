<?php
/**
 * Manufacturer Category controller
 *
 * @package	VirtueMart
 * @subpackage ManufacturerCategory
 * @author RickG 
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

jimport('joomla.application.component.controller');

/**
 * Manufacturer Category Controller
 *
 * @package    VirtueMart
 * @subpackage ManufacturerCategory
 * @author RickG 
 */
class VirtuemartControllerManufacturerCategory extends JController
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
		$viewType	= $document->getType();
		$view =& $this->getView('manufacturerCategory', $viewType);

		// Push a model into the view					
		$model =& $this->getModel('manufacturerCategory');
		if (!JError::isError($model)) {
			$view->setModel($model, true);
		}					
	}
	
	/**
	 * Display the view
	 *
	 * @author RickG	 
	 */
	function display() {			
		parent::display();
	}
	
	
	/**
	 * Handle the edit task
	 *
     * @author RickG
	 */
	function edit()
	{				
		JRequest::setVar('controller', 'manufacturerCategory');
		JRequest::setVar('view', 'manufacturerCategory');
		JRequest::setVar('layout', 'edit');
		JRequest::setVar('hidemenu', 1);		
		
		parent::display();
	}		
	
	
	/**
	 * Handle the cancel task
	 *
	 * @author RickG
	 */
	function cancel()
	{
		$this->setRedirect('index.php?option=com_virtuemart&view=manufacturerCategory');
	}	
	
	
	/**
	 * Handle the save task
	 *
	 * @author RickG	 
	 */	
	function save()
	{
		$model = $this->getModel('manufacturerCategory');
		
		if ($model->store()) {
			$msg = JText::_('Manufacturer Category saved!');
		}
		else {
			$msg = JText::_($model->getError());
		}
		
		$this->setRedirect('index.php?option=com_virtuemart&view=manufacturerCategory', $msg);
	}	
	
	
	/**
	 * Handle the remove task
	 *
	 * @author RickG	 
	 */		
	function remove()
	{
		$model = $this->getModel('manufacturerCategory');
		if (!$model->delete()) {
			$msg = JText::_('Error: One or more categories could not be deleted!');
		}
		else {
			$msg = JText::_( 'Categories deleted!');
		}
	
		$this->setRedirect( 'index.php?option=com_virtuemart&view=manufacturerCategory', $msg);
	}		
}
?>
