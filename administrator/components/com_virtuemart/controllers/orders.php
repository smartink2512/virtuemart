<?php
/**
 * Orders controller
 *
 * @package VirtueMart
 * @author VirtueMart
 * @link http://virtuemart.org
 * @version $Id$
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

jimport('joomla.application.component.controller');

/**
* Orders Controller
*
* @package    VirtueMart
*/
class VirtuemartControllerOrders extends JController
{
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function __construct() {
		parent::__construct();
		
		/* Redirect templates to templates as this is the standard call */
		$this->registerTask('edit','add');
	}
	
	/**
	* Shows the product list screen
	*/
	public function Orders() {
		/* Create the view object */
		$view = $this->getView('orders', 'html');
		
		/* Default model */
		$view->setModel( $this->getModel( 'orders', 'VirtueMartModel' ), true );
		
		/* Set the layout */
		$view->setLayout('orders');
		
		/* Now display the view. */
		$view->display();
	}
	
	/**
	* Cancellation, redirect to main order list
	*
	* @author RolandD
	*/
	public function Cancel() {
		$mainframe = Jfactory::getApplication();
		$mainframe->redirect('index.php?option=com_virtuemart&view=orders');
	}
	
	/**
	* Save an order
	*
	* @author RolandD
	*/
	public function save() {
		$mainframe = Jfactory::getApplication();
		
		/* Load the view object */
		$view = $this->getView('orders', 'html');
		
		$model = $this->getModel('orders');
		$msgtype = '';
		if ($model->saveOrder()) $msg = JText::_('ORDER_SAVED_SUCCESSFULLY');
		else {
			$msg = JText::_('ORDER_NOT_SAVED_SUCCESSFULLY');
			$msgtype = 'error';
		}
		$mainframe->redirect('index.php?option=com_virtuemart&view=orders', $msg, $msgtype);
	}
	
	/**
	* Delete an order
	*
	* @author RolandD
	*/
	public function remove() {
		$mainframe = Jfactory::getApplication();
		
		/* Load the view object */
		$view = $this->getView('orders', 'html');
		
		$model = $this->getModel('orders');
		$msgtype = '';
		if ($model->removeOrder()) $msg = JText::_('ORDER_REMOVED_SUCCESSFULLY');
		else {
			$msg = JText::_('ORDER_NOT_REMOVED_SUCCESSFULLY');
			$msgtype = 'error';
		}
		$mainframe->redirect('index.php?option=com_virtuemart&view=orders', $msg, $msgtype);
	}
	
	/**
	* Update an order status
	*
	* @author RolandD
	*/
	public function updatestatus() {
		$mainframe = Jfactory::getApplication();
		?><pre><?php
		print_r($_POST);
		?></pre><?php
		
		/* Load the view object */
		$view = $this->getView('orders', 'html');
		
		$model = $this->getModel('orders');
		$msgtype = '';
		if ($model->updateStatus()) $msg = JText::_('ORDER_UPDATED_SUCCESSFULLY');
		else {
			$msg = JText::_('ORDER_NOT_UPDATED_SUCCESSFULLY');
			$msgtype = 'error';
		}
		
		$mainframe->redirect('index.php?option=com_virtuemart&view=orders', $msg, $msgtype);
	}
}
?>
