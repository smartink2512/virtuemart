<?php
/**
 * updatesMigration controller
 *
 * @package	VirtueMart
 * @subpackage updatesMigration
 * @author Max Milbers
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

jimport('joomla.application.component.controller');

/**
 * updatesMigration Controller
 *
 * @package    VirtueMart
 * @subpackage updatesMigration
 * @author Max Milbers
 */
 
global $vmInstaller;
 
class VirtuemartControllerUpdatesMigration extends JController{

	private $installer;
	
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
		
		if(empty($this -> installer){
			if(empty($vmInstaller)){
				echo('Global $vmInstaller == null');
				JError::raiseNotice(1, 'Global $vmInstaller == null');
				require_once(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'updatesMigrationHelper.php');
				$this -> installer = new updatesMigrationHelper;
			}else{
				JError::raiseNotice(1, 'Global $vmInstaller exists !!!');
				echo('Global $vmInstaller exists !!!');
				$this -> installer = $vmInstaller;
			}
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
	

	function freshInstall(){
	
		$this -> installer -> installTables;
		$this -> installer -> installRequiredData;
		
		$this -> installer -> integrateJUsers;
		$this -> installer -> setStoreOwner;
		$this -> installer -> setUserToShopperGroup;

	}
	
	function freshInstallSample(){
		$this -> freshInstall;
		$this -> installer -> installSample;
	}
	
	function updateVM10to11(){
		$db = JFactory::getDBO();
		$db->setQuery(include(JPATH_COMPONENT_ADMINISTRATOR.DS.install.DS.migration.DS."UPDATE-SCRIPT_VM_1.0.x_to_1.1.0.sql"));
		if($db->query() === false ) {
			JError::raiseNotice(1, 'updateVM10to11 Query error ');
		}
		parent::display();
	}
	
	function updateVM11to15(){
		$db = JFactory::getDBO();
		$db->setQuery(include(JPATH_COMPONENT_ADMINISTRATOR.DS.install.DS.migration.DS."UPDATE-SCRIPT_VM_1.1.x_to_1.5.0.sql"));
		if($db->query() === false ) {
			JError::raiseNotice(1, 'updateVM11to15 Query error ');
		}
		parent::display();
	}
}

?>