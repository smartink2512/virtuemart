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
		
		$document =& JFactory::getDocument();				
		$viewType	= $document->getType();
		$view =& $this->getView('updatesMigration', $viewType);		

		// Push a model into the view					
		$model =& $this->getModel('updatesMigration');
		if (!JError::isError($model)) {
			$view->setModel($model, true);
		}			
	}
	
	/**
	 * Display the upgrade view
	 *
	 * @author RickG	 
	 */
	function display() {
		parent::display();
	}
	

	/**
	 * Execute a fresh VM install
	 *
	 * @author Max Milbers, RickG	 
	 */
	function freshInstall($display = true){
		$model = $this->getModel('updatesMigration');
		
		$model->execSQLFile(JPATH_COMPONENT_ADMINISTRATOR.DS.'install'.DS.'install_required_data.sql');
		$model->integrateJoomlaUsers();
		$id = $model->determineStoreOwner();
		$model->setStoreOwner($id);
		$model->setUserToShopperGroup();
	
		parent::display();
	}
/*
	function setStoreOwner(){
		
		$userId = 62;
		$userId = JRequest::getString('userId');
		$this -> installer -> setStoreOwner($userId);
		parent::display();
	}
*/
	function testVersion(){
		$this -> installer -> determineAlreadyInstalledVersion();
		parent::display();
	}

	/**
	 * Install sample data into the database
	 * 
	 * @author RickG
	 */
	function installSampleData(){
		$model = $this->getModel('updatesMigration');
		$model->installSampleData();
		
		$msg = JText::_('Sample data installed!!');		
		$this->setRedirect('index.php?option=com_virtuemart', $msg);			
	}

/*
	function updateVMTables10to11(){
		$this -> installer -> populateVmDatabase(migration.DS."UPDATE-SCRIPT_VM_1.0.x_to_1.1.0.sql");
		parent::display();
	}

	function updateVMTables11to15(){
		$this -> installer -> populateVmDatabase(migration.DS."UPDATE-SCRIPT_VM_1.1.x_to_1.5.0.sql");
		parent::display();
	}
*/
	
	function deleteAll(){
		$this -> installer -> populateVmDatabase("delete_essential.sql");
		$this -> installer -> populateVmDatabase("delete_data.sql");
		$this->setRedirect(JPATH_ADMINISTRATOR, $msg);
	}
	
	function deleteRestorable(){
		$this -> installer -> populateVmDatabase("delete_restoreable.sql");
		$this->setRedirect(JPATH_ADMINISTRATOR, $msg);
	}



	
}

?>