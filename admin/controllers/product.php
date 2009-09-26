<?php
/**
 * Product controller
 *
 * @package JMart
 * @author JMart
 * @link http://joomlacode.org/gf/project/jmart/
 * @version $Id: product.php 186 2009-09-10 14:12:18Z rolandd $
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

jimport('joomla.application.component.controller');

/**
 * Product Controller
 *
 * @package    JMart
 */
class JmartControllerProduct extends JController
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
	}
	
	/**
	 * Shows the product list screen
	 */
	public function Product() {
		/* Create the view object */
		$view = $this->getView('product', 'html');
				
		/* Default model */
		$view->setModel( $this->getModel( 'product', 'JMartModel' ), true );
		/* Media files functions */
		$view->setModel( $this->getModel( 'media', 'JMartModel' ));
		/* Product reviews functions */
		$view->setModel( $this->getModel( 'productReviews', 'JMartModel' ));
		/* Product category functions */
		$view->setModel( $this->getModel( 'category', 'JMartModel' ));
		
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
		$view->setModel( $this->getModel( 'product', 'JMartModel' ), true );
		/* Media files functions */
		$view->setModel( $this->getModel( 'media', 'JMartModel' ));
		/* Product category functions */
		$view->setModel( $this->getModel( 'category', 'JMartModel' ));
		/* Manufacturer functions */
		$view->setModel( $this->getModel( 'manufacturer', 'JMartModel' ));
		/* Currency functions */
		$view->setModel( $this->getModel( 'currency', 'JMartModel' ));
		/* Tax functions */
		$view->setModel( $this->getModel( 'taxRate', 'JMartModel' ));
		/* Discount functions */
		$view->setModel( $this->getModel( 'discount', 'JMartModel' ));
		
		/* Set the layout */
		$view->setLayout('product_edit');
		
		/* Now display the view. */
		$view->display();
	}
}
?>
