<?php
/**
 * @package		VirtueMart
 */

jimport('joomla.application.component.controller');

/**
 * VirtueMart Component Controller
 *
 * @package		VirtueMart
 */
class VirtueMartControllerAccountmaintenance extends JController
{
    
	public function __construct() {
		parent::__construct();
	}
	
	public function Accountmaintenance() {
		/* Create the view */
		$view = $this->getView('accountmaintenance', 'html');
		
		/* Add the default model */
		$view->setModel( $this->getModel( 'accountmaintenance', 'VirtuemartModel' ), true );
		
		/* Set the layout */
		$view->setLayout('accountmaintenance');
		
		/* Display it all */
		$view->display();
	}
	
	/**
	* Modify the billing address in front-end
	* @author RolandD
	*/
	public function accountBilling() {
		/* Create the view */
		$view = $this->getView('accountmaintenance', 'html');
	
		/* Add the default model */
		$view->setModel($this->getModel( 'accountmaintenance', 'VirtuemartModel' ), true);
		
		/* Set the layout */
		$view->setLayout('accountbilling');
		
		/* Display it all */
		$view->display();
	}
}
?>
