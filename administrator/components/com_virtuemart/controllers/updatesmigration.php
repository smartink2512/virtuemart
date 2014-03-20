<?php

/**
 *
 * updatesMigration controller
 *
 * @package	VirtueMart
 * @subpackage updatesMigration
 * @author Max Milbers, RickG
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id$
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// Load the controller framework
jimport('joomla.application.component.controller');

if(!class_exists('VmController'))
require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmcontroller.php');

/**
 * updatesMigration Controller
 *
 * @package    VirtueMart
 * @subpackage updatesMigration
 * @author Max Milbers
 */
class VirtuemartControllerUpdatesMigration extends VmController{

	private $installer;

	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function __construct(){
		parent::__construct();

	}

	/**
	 * Call at begin of every task to check if the permission is high enough.
	 * Atm the standard is at least vm admin
	 * @author Max Milbers
	 */
	private function checkPermissionForTools(){
		vmRequest::vmCheckToken();
		//Hardcore Block, we may do that better later
		$user = JFactory::getUser();
		if(!$user->authorise('core.admin','com_virtuemart') ){
			$msg = 'Forget IT';
			$this->setRedirect('index.php?option=com_virtuemart', $msg);
		}

		return true;
	}

	/**
	 * Akeeba release system tasks
	 * Update
	 * @author Max Milbers
	 */
	function liveUpdate(){

		$this->setRedirect('index.php?option=com_virtuemart&view=liveupdate.', 'Akeeba release system');
	}

	/**
	 * Install sample data into the database
	 *
	 * @author RickG
	 */
	function checkForLatestVersion(){
		$model = $this->getModel('updatesMigration');
		VmRequest::setVar('latestverison', $model->getLatestVersion());
		VmRequest::setVar('view', 'updatesMigration');

		parent::display();
	}

	/**
	 * Install sample data into the database
	 *
	 * @author RickG
	 * @author Max Milbers
	 */
	function installSampleData(){

		vmRequest::vmCheckToken();

		$model = $this->getModel('updatesMigration');

		$msg = $model->installSampleData();

		$this->setRedirect($this->redirectPath, $msg);
	}

	/**
	 * Sets the storeowner to the currently logged in user
	 * He needs admin rights
	 *
	 * @author Max Milbers
	 */
	function setStoreOwner(){

		$this->checkPermissionForTools();

		$model = $this->getModel('updatesMigration');

		$storeOwnerId =VmRequest::getInt('storeOwnerId');
		$msg = $model->setStoreOwner($storeOwnerId);

		$this->setRedirect($this->redirectPath, $msg);
	}

	/**
	 * Install sample data into the database
	 *
	 * @author RickG
	 * @author Max Milbers
	 */
	function restoreSystemDefaults(){

		$this->checkPermissionForTools();

		if(VmConfig::get('dangeroustools', false)){

			$model = $this->getModel('updatesMigration');
			$model->restoreSystemDefaults();

			$msg = vmText::_('COM_VIRTUEMART_SYSTEM_DEFAULTS_RESTORED');
			$msg .= ' User id of the main vendor is ' . $model->setStoreOwner();
			$this->setDangerousToolsOff();
		}else {
			$msg = $this->_getMsgDangerousTools();
		}

		$this->setRedirect($this->redirectPath, $msg);
	}

	/**
	 * Remove all the Virtuemart tables from the database.
	 *
	 * @author RickG
	 * @author Max Milbers
	 */
	function deleteVmTables(){

		$this->checkPermissionForTools();

		$msg = vmText::_('COM_VIRTUEMART_SYSTEM_VMTABLES_DELETED');
		if(VmConfig::get('dangeroustools', false)){
			$model = $this->getModel('updatesMigration');

			if(!$model->removeAllVMTables()){
				$this->setDangerousToolsOff();
				$this->setRedirect('index.php?option=com_virtuemart', $model->getError());
			}
		}else {
			$msg = $this->_getMsgDangerousTools();
		}
		$this->setRedirect('index.php?option=com_installer', $msg);
	}

	/**
	 * Deletes all dynamical created data and leaves a "fresh" installation without sampledata
	 * OUTDATED
	 * @author Max Milbers
	 *
	 */
	function deleteVmData(){

		$this->checkPermissionForTools();

		$msg = vmText::_('COM_VIRTUEMART_SYSTEM_VMDATA_DELETED');
		if(VmConfig::get('dangeroustools', false)){
			$model = $this->getModel('updatesMigration');

			if(!$model->removeAllVMData()){
				$this->setDangerousToolsOff();
				$this->setRedirect('index.php?option=com_virtuemart', $model->getError());
			}
		}else {
			$msg = $this->_getMsgDangerousTools();
		}

		$this->setRedirect($this->redirectPath, $msg);
	}

	function deleteAll(){

		$this->checkPermissionForTools();

		$msg = vmText::_('COM_VIRTUEMART_SYSTEM_ALLVMDATA_DELETED');
		if(VmConfig::get('dangeroustools', false)){

			$this->installer->populateVmDatabase("delete_essential.sql");
			$this->installer->populateVmDatabase("delete_data.sql");
			$this->setDangerousToolsOff();
		}else {
			$msg = $this->_getMsgDangerousTools();
		}

		$this->setRedirect($this->redirectPath, $msg);
	}

	function deleteRestorable(){

		$this->checkPermissionForTools();

		$msg = vmText::_('COM_VIRTUEMART_SYSTEM_RESTVMDATA_DELETED');
		if(VmConfig::get('dangeroustools', false)){
			$this->installer->populateVmDatabase("delete_restoreable.sql");
			$this->setDangerousToolsOff();
		}else {
			$msg = $this->_getMsgDangerousTools();
		}


		$this->setRedirect($this->redirectPath, $msg);
	}

	function refreshCompleteInstallAndSample(){

		$this->refreshCompleteInstall(true);
	}


	function refreshCompleteInstall($sample=false){

		$this->checkPermissionForTools();

		if(VmConfig::get('dangeroustools', true)){

			$model = $this->getModel('updatesMigration');

			$model->restoreSystemTablesCompletly();

			$sid = $model->setStoreOwner();
			//$model->setUserToPermissionGroup($sid);

			if($sample)$model->installSampleData($sid);

			$msg = '';
			if(empty($errors)){
				$msg = 'System succesfull restored and sampledata installed, user id of the mainvendor is ' . $sid;
			} else {
				foreach($errors as $error){
					$msg .= ( $error) . '<br />';
				}
			}

			$this->setDangerousToolsOff();
		}else {
			$msg = $this->_getMsgDangerousTools();
		}

		$this->setRedirect($this->redirectPath, $msg);
	}

	function installCompleteSamples(){
		$this->installComplete(true);
	}

	function installComplete($sample=false){

		$this->checkPermissionForTools();

		if(VmConfig::get('dangeroustools', true)){

			if(!class_exists('com_virtuemartInstallerScript')) require(JPATH_VM_ADMINISTRATOR . DS . 'install' . DS . 'script.virtuemart.php');
			$updater = new com_virtuemartInstallerScript();
			$updater->install(true,false);

			$model = $this->getModel('updatesMigration');
			$sid = $model->setStoreOwner();

			$msg = 'System and sampledata succesfull installed, user id of the mainvendor is ' . $sid;

			if(!class_exists('com_virtuemart_allinoneInstallerScript')) require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart_allinone' . DS . 'script.vmallinone.php');
			$updater = new com_virtuemart_allinoneInstallerScript(false);
			$updater->vmInstall(true);

			if($sample) $model->installSampleData($sid);

			if(!class_exists('VmConfig')) require_once(JPATH_VM_ADMINISTRATOR .'/models/config.php');
			VirtueMartModelConfig::installVMconfigTable();

			//Now lets set some joomla variables
			//Caching should be enabled, set to files and for 15 minutes
			if (!class_exists( 'ConfigModelApplication' )) require(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_config'.DS.'models'.DS.'application.php');
			$jConfModel = new ConfigModelApplication();
			$jConfig = $jConfModel->getData();

			$jConfig['caching'] = 0;
			$jConfig['lifetime'] = 60;
			$jConfig['list_limit'] = 25;
			$jConfig['MetaDesc'] = 'VirtueMart works with Joomla! - the dynamic portal engine and content management system';
			$jConfig['MetaKeys'] = 'virtuemart, vm2, joomla, Joomla';

			$app = JFactory::getApplication();
			$return = $jConfModel->save($jConfig);

			// Check the return value.
			if ($return === false) {
				// Save the data in the session.
				$app->setUserState('com_config.config.global.data', $jConfig);
				vmError(vmText::sprintf('JERROR_SAVE_FAILED', $model->getError()));
				//return false;
			} else {
				// Set the success message.
				//vmInfo('COM_CONFIG_SAVE_SUCCESS');
			}
		}else {
			$msg = $this->_getMsgDangerousTools();
		}

		$this->setRedirect('index.php?option=com_virtuemart&view=updatesmigration&layout=insfinished', $msg);
	}

	/**
	 * This is executing the update table commands to adjust tables to the latest layout
	 * @author Max Milbers
	 */
	function updateDatabase(){

		VmRequest::vmCheckToken();

		if(!class_exists('com_virtuemartInstallerScript')) require(JPATH_VM_ADMINISTRATOR . DS . 'install' . DS . 'script.virtuemart.php');
		$updater = new com_virtuemartInstallerScript();
		$updater->update(false);
		$this->setRedirect($this->redirectPath, 'Database updated');
	}

	/**
	 * Delete the config stored in the database and renews it using the file
	 *
	 * @auhtor Max Milbers
	 */
	function renewConfig(){

		$this->checkPermissionForTools();

		//if(VmConfig::get('dangeroustools', true)){
			$model = $this->getModel('config');
			$model -> deleteConfig();
	//	}
		$this->setRedirect($this->redirectPath, 'Configuration is now restored by file');
	}

	/**
	 * This function resets the flag in the config that dangerous tools can't be executed anylonger
	 * This is a security feature
	 *
	 * @author Max Milbers
	 */
	function setDangerousToolsOff(){

		if(!class_exists('VirtueMartModelConfig')) require(JPATH_VM_ADMINISTRATOR .'/models/config.php');
		$res  = VirtueMartModelConfig::checkConfigTableExists();
		if(!empty($res)){
			$model = $this->getModel('config');
			$model->setDangerousToolsOff();
		}

	}

	/**
	 * Sends the message to the user that the tools are disabled.
	 *
	 * @author Max Milbers
	 */
	function _getMsgDangerousTools(){
		$uri = JFactory::getURI();
		VmConfig::loadJLang('com_virtuemart_config');
		$link = $uri->root() . 'administrator/index.php?option=com_virtuemart&view=config';
		$msg = vmText::sprintf('COM_VIRTUEMART_SYSTEM_DANGEROUS_TOOL_DISABLED', vmText::_('COM_VIRTUEMART_ADMIN_CFG_DANGEROUS_TOOLS'), $link);
		return $msg;
	}

	function portMedia(){

		$this->checkPermissionForTools();

		$this->storeMigrationOptionsInSession();
		if(!class_exists('Migrator')) require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'migrator.php');
		$migrator = new Migrator();
		$result = $migrator->portMedia();

		$this->setRedirect($this->redirectPath, $result);
	}

	function migrateGeneralFromVmOne(){

		$this->checkPermissionForTools();

		$this->storeMigrationOptionsInSession();
		if(!class_exists('Migrator')) require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'migrator.php');
		$migrator = new Migrator();
		$result = $migrator->migrateGeneral();
		if($result){
			$msg = 'Migration general finished';
		} else {
			$msg = 'Migration general was interrupted by max_execution time, please restart';
		}
		$this->setRedirect($this->redirectPath, $result);

	}

	function migrateUsersFromVmOne(){

		$this->checkPermissionForTools();

		$this->storeMigrationOptionsInSession();
		if(!class_exists('Migrator')) require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'migrator.php');
		$migrator = new Migrator();
		$result = $migrator->migrateUsers();
		if($result){
			$msg = 'Migration users finished';
		} else {
			$msg = 'Migration users was interrupted by max_execution time, please restart';
		}

		$this->setRedirect($this->redirectPath, $result);

	}

	function migrateProductsFromVmOne(){

		$this->checkPermissionForTools();

		$this->storeMigrationOptionsInSession();
		if(!class_exists('Migrator')) require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'migrator.php');
		$migrator = new Migrator();
		$result = $migrator->migrateProducts();
		if($result){
			$msg = 'Migration products finished';
		} else {
			$msg = 'Migration products was interrupted by max_execution time, please restart';
		}
		$this->setRedirect($this->redirectPath, $result);

	}

	function migrateOrdersFromVmOne(){

		$this->checkPermissionForTools();

		$this->storeMigrationOptionsInSession();
		if(!class_exists('Migrator')) require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'migrator.php');
		$migrator = new Migrator();
		$result = $migrator->migrateOrders();
		if($result){
			$msg = 'Migration orders finished';
		} else {
			$msg = 'Migration orders was interrupted by max_execution time, please restart';
		}
		$this->setRedirect($this->redirectPath, $result);

	}

	/**
	 * Is doing all migrator steps in one row
	 *
	 * @author Max Milbers
	 */
	function migrateAllInOne(){

		$this->checkPermissionForTools();

		if(!VmConfig::get('dangeroustools', true)){
			$msg = $this->_getMsgDangerousTools();
			$this->setRedirect($this->redirectPath, $msg);
			return false;
		}

		$this->storeMigrationOptionsInSession();
		if(!class_exists('Migrator')) require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'migrator.php');
		$migrator = new Migrator();
		$result = $migrator->migrateAllInOne();
		if($result){
			$msg = 'Migration finished';
		} else {
			$msg = 'Migration was interrupted by max_execution time, please restart';
		}
		$this->setRedirect($this->redirectPath, $msg);
	}

	function portVmAttributes(){

		$this->checkPermissionForTools();

		if(!VmConfig::get('dangeroustools', true)){
			$msg = $this->_getMsgDangerousTools();
			$this->setRedirect($this->redirectPath, $msg);
			return false;
		}

		$this->storeMigrationOptionsInSession();
		if(!class_exists('Migrator')) require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'migrator.php');
		$migrator = new Migrator();
		$result = $migrator->portVm1Attributes();
		if($result){
			$msg = 'Migration Vm2 attributes finished';
		} else {
			$msg = 'Migration was interrupted by max_execution time, please restart';
		}
		$this->setRedirect($this->redirectPath, $msg);
	}

	function portVmRelatedProducts(){

		$this->checkPermissionForTools();

		if(!VmConfig::get('dangeroustools', true)){
			$msg = $this->_getMsgDangerousTools();
			$this->setRedirect($this->redirectPath, $msg);
			return false;
		}

		$this->storeMigrationOptionsInSession();
		if(!class_exists('Migrator')) require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'migrator.php');
		$migrator = new Migrator();
		$result = $migrator->portVm1RelatedProducts();
		if($result){
			$msg = 'Migration Vm2 related products finished';
		} else {
			$msg = 'Migration was interrupted by max_execution time, please restart';
		}
		$this->setRedirect($this->redirectPath, $msg);
	}

	function reOrderChilds(){

		$this->checkPermissionForTools();

		if(!VmConfig::get('dangeroustools', true)){
			$msg = $this->_getMsgDangerousTools();
			$this->setRedirect($this->redirectPath, $msg);
			return false;
		}

		$this->storeMigrationOptionsInSession();
		if(!class_exists('GenericTableUpdater')) require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'tableupdater.php');
		$updater = new GenericTableUpdater();
		$result = $updater->reOrderChilds();

		$this->setRedirect($this->redirectPath, $result);
	}

	function storeMigrationOptionsInSession(){

		$session = JFactory::getSession();

		$session->set('migration_task', VmRequest::getString('task',''), 'vm');
		$session->set('migration_default_category_browse', VmRequest::getString('migration_default_category_browse',''), 'vm');
		$session->set('migration_default_category_fly', VmRequest::getString('migration_default_category_fly',''), 'vm');
	}


	function resetThumbs(){

		$this->checkPermissionForTools();

		if(!VmConfig::get('dangeroustools', true)){
			$msg = $this->_getMsgDangerousTools();
			$this->setRedirect($this->redirectPath, $msg);
			return false;
		}

		$model = VmModel::getModel('updatesMigration');
		$result = $model->resetThumbs();
		$this->setRedirect($this->redirectPath, $result);
	}
}

