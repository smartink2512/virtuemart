<?php
/**
 * Product controller
 *
 * @package VirtueMart
 * @author VirtueMart
 * @link http://virtuemart.org
 * @version $Id: product.php 186 2009-09-10 14:12:18Z rolandd $
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

jimport('joomla.application.component.controller');

/**
 * Product Controller
 *
 * @package    VirtueMart
 */
class VirtuemartControllerProduct extends JController
{
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function __construct() {
		parent::__construct();
		
		/* Redirect templates to templates as this is the standard call */
		$this->registerTask('saveorder','product');
		$this->registerTask('orderup','product');
		$this->registerTask('orderdown','product');
		$this->registerTask('edit','add');
	}
	
	/**
	 * Shows the product list screen
	 */
	public function Product() {
		/* Create the view object */
		$view = $this->getView('product', 'html');
				
		/* Default model */
		$view->setModel( $this->getModel( 'product', 'VirtueMartModel' ), true );
		/* Media files functions */
		$view->setModel( $this->getModel( 'media', 'VirtueMartModel' ));
		/* Product reviews functions */
		$view->setModel( $this->getModel( 'productReviews', 'VirtueMartModel' ));
		/* Product category functions */
		$view->setModel( $this->getModel( 'category', 'VirtueMartModel' ));
		
		/* Set the layout */
		$view->setLayout('product');
		
		/* Now display the view. */
		$view->display();
	}
	
	/**
	 * Shows the product add/edit screen
	 */
	public function Add() {
		/* Create the view object */
		$view = $this->getView('product', 'html');
		
		/* Default model */
		$view->setModel( $this->getModel( 'product', 'VirtueMartModel' ), true );
		/* Media files functions */
		$view->setModel( $this->getModel( 'media', 'VirtueMartModel' ));
		/* Product category functions */
		$view->setModel( $this->getModel( 'category', 'VirtueMartModel' ));
		/* Vendor functions */
		$view->setModel( $this->getModel( 'vendor', 'VirtueMartModel' ));
		/* Manufacturer functions */
		$view->setModel( $this->getModel( 'manufacturer', 'VirtueMartModel' ));
		/* Currency functions */
		$view->setModel( $this->getModel( 'currency', 'VirtueMartModel' ));
		/* Tax functions */
		$view->setModel( $this->getModel( 'taxRate', 'VirtueMartModel' ));
		/* Discount functions */
		$view->setModel( $this->getModel( 'discount', 'VirtueMartModel' ));
		/* Waitinglist functions */
		$view->setModel( $this->getModel( 'waitinglist', 'VirtueMartModel' ));
		
		/* Set the layout */
		$view->setLayout('product_edit');
		
		/* Now display the view. */
		$view->display();
	}
	
	/**
	* Cancellation, redirect to main product list
	*
	* @author RolandD
	*/
	public function Cancel() {
		$mainframe = Jfactory::getApplication();
		$mainframe->redirect('index.php?option=com_virtuemart&view=product&task=product', JText::_('Operation Canceled!!'));
	}
	
	/**
	* Save a product
	*
	* @author RolandD
	*/
	public function Save() {
		$mainframe = Jfactory::getApplication();
		
		/* Load the view object */
		$view = $this->getView('product', 'html');
		
		/* Waitinglist functions */
		$view->setModel( $this->getModel( 'waitinglist', 'VirtueMartModel' ));
		
		/* Load some helpers */
		$view->loadHelper('image');
		$view->loadHelper('shopFunctions');
		
		$model = $this->getModel('product');
		$msgtype = '';
		if ($model->saveProduct()) $msg = JText::_('PRODUCT_SAVED_SUCCESSFULLY');
		else {
			$msg = JText::_('PRODUCT_NOT_SAVED_SUCCESSFULLY');
			$msgtype = 'error';
		}
		$mainframe->redirect('index.php?option=com_virtuemart&view=product&task=product', $msg, $msgtype);
	}
	
	/**
	* Get a list of related products
	*/
	public function getData() {
		/* Create the view object */
		$view = $this->getView('product', 'json');
				
		/* Default model */
		$view->setModel( $this->getModel( 'product', 'VirtueMartModel' ), true );
		
		$view->setLayout('product');
		
		/* Now display the view. */
		$view->display();
	}
}
?>
