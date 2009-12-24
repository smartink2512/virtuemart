<?php
/**
 * Category controller
 *
 * @package	VirtueMart
 * @subpackage Category
 * @author RickG, jseros 
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

jimport('joomla.application.component.controller');

/**
 * Category Controller
 *
 * @package    VirtueMart
 * @subpackage Category
 * @author jseros 
 */
class VirtuemartControllerCategory extends JController
{
	/**
	 * Contructor
	 *
	 * @access	public
	 */
	function __construct() {
		parent::__construct();
		
		// Register Extra tasks
		$this->registerTask( 'add',  'edit' );			
	    
		$document = JFactory::getDocument();				
		$viewType	= $document->getType();
		$view = $this->getView('category', $viewType);		

		// Pushing default model					
		$categoryModel = $this->getModel('category');
		if (!JError::isError($categoryModel)) {
			$view->setModel($categoryModel, true);
		}			
	}
	
	/**
	 * Display any category view
	 *
	 * @author RickG, jseros
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
		JRequest::setVar('controller', 'category');
		JRequest::setVar('view', 'category');
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
		$this->setRedirect('index.php?option=com_virtuemart&view=category');
	}	
	
	
	/**
	 * Handle the save task
	 *
	 * @author RickG, jseros 
	 */	
	function save()
	{
		$categoryModel =& $this->getModel('category');		
		
		if ($categoryModel->store()) {
			$msg = JText::_('VM_CATEGORY_SAVED_SUCCESS');
		}
		else {
			$msg = JText::_($categoryModel->getError());
		}
		
		$this->setRedirect('index.php?option=com_virtuemart&view=category', $msg);
	}	
	
	
	/**
	 * Handle the remove task
	 *
	 * @author RickG, jseros	 
	 */		
	function remove()
	{
		$categoryModel = $this->getModel('category');
		if (!$categoryModel->delete()) {
			$msg = JText::_('VM_ERROR_CATEGORIES_COULD_NOT_BE_DELETED');
		}
		else {
			$msg = JText::_( 'VM_CATEGORY_DELETED_SUCCESS');
		}
	
		$this->setRedirect( 'index.php?option=com_virtuemart&view=category', $msg);
	}	
	
	
	/**
	 * Handle the publish task
	 *
	 * @author RickG, jseros	 
	 */		
	function publish()
	{
		$categoryModel = $this->getModel('category');
		if (!$categoryModel->publish(true)) {
			$msg = JText::_('VM_ERROR_CATEGORIES_COULD_NOT_BE_PUBLISHED');
		}
	
		$this->setRedirect( 'index.php?option=com_virtuemart&view=category', $msg);
	}		
	
	
	/**
	 * Handle the publish task
	 *
	 * @author RickG, jseros	 
	 */		
	function unpublish()
	{
		$categoryModel = $this->getModel('category');
		if (!$categoryModel->publish(false)) {
			$msg = JText::_('VM_ERROR_CATEGORIES_COULD_NOT_BE_UNPUBLISHED');
		}
	
		$this->setRedirect( 'index.php?option=com_virtuemart&view=category', $msg);
	}
	
	
	/**
	* Save the category order
	* 
	* @author jseros	
	*/
	public function orderUp()
	{
		// Check token
		JRequest::checkToken() or jexit( 'Invalid Token' );

		//capturing category_id
		$id = 0;
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (isset($cid[0]) && $cid[0]) {
			$id = $cid[0];
		} else {
			$this->setRedirect( 'index.php?option=com_virtuemart&view=category', JText::_('No Items Selected') );
			return false;
		}

		//getting the model
		$model = $this->getModel('category');
		
		if ($model->orderCategory($id, -1)) {
			$msg = JText::_( 'Item Moved Up' );
		} else {
			$msg = $model->getError();
		}
		
		$this->setRedirect( 'index.php?option=com_virtuemart&view=category', $msg );
	}

	
	/**
	* Save the category order
	* 
	* @author jseros	
	*/
	public function orderDown()
	{
		// Check token
		JRequest::checkToken() or jexit( 'Invalid Token' );

		//capturing category_id
		$id = 0;
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (isset($cid[0]) && $cid[0]) {
			$id = $cid[0];
		} else {
			$this->setRedirect( 'index.php?option=com_virtuemart&view=category', JText::_('No Items Selected') );
			return false;
		}

		//getting the model
		$model = $this->getModel('category');
		
		if ($model->orderCategory($id, 1)) {
			$msg = JText::_( 'Item Moved Down' );
		} else {
			$msg = $model->getError();
		}
		
		$this->setRedirect( 'index.php?option=com_virtuemart&view=category', $msg );
	}
	
	
	/**
	* Save the categories order
	*/
	public function saveOrder()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		$model = $this->getModel('category');
		
		if ($model->setOrder($cid)) {
			$msg = JText::_( 'New ordering saved' );
		} else {
			$msg = $model->getError();
		}
		$this->setRedirect('index.php?option=com_virtuemart&view=category', $msg );
	}
	
}
