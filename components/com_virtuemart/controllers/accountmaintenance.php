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
    
	function __construct() {
		parent::__construct();
	}
	
	function Accountmaintenance() {
		/* Create the view */
		$view = $this->getView('accountmaintenance', 'html');
	
		/* Add the default model */
		$view->setModel( $this->getModel( 'accountmaintenance', 'VirtuemartModel' ), true );
		if (0) {
		/* Add model path */
		JController::addModelPath(JPATH_COMPONENT_ADMINISTRATOR.DS.'models');
		/* Log functions */
		$view->setModel( $this->getModel( 'log', 'CsvivirtuemartModel' ));
		/* Settings functions */
		$view->setModel( $this->getModel( 'settings', 'CsvivirtuemartModel' ));
		/* General import functions */
		$view->setModel( $this->getModel( 'exportfile', 'CsvivirtuemartModel' ));
		/* General category functions */
		$view->setModel( $this->getModel( 'category', 'CsvivirtuemartModel' ));
		/* Template settings */
		$view->setModel( $this->getModel( 'templates', 'CsvivirtuemartModel' ));
		/* Available fields */
		$view->setModel( $this->getModel( 'availablefields', 'CsvivirtuemartModel' ));
		/* Model replacement */
		$view->setModel( $this->getModel( 'replacement', 'CsvivirtuemartModel' ));
		/* Export specific model */
		$view->setModel( $this->getModel( $this->getTemplateType(), 'CsvivirtuemartModel' ));		
		}
		/* Set the layout */
		$view->setLayout('accountmaintenance');
		
		/* Display it all */
		$view->display();
		   		        								
	}    
}
?>
