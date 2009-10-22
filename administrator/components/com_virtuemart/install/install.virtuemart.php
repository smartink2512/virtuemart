<?php
/**
 * VirtueMart installation file.
 *
 * This installation file is executed after the XML manifest file is complete.
 * This installation function extracts some of the frontend and backend files
 * need for this component.
 *
 * @author Max Milbers
 * @package VirtueMart
 */
defined('_JEXEC') or die('Restricted access');

global $option, $vmInstaller;


function com_install(){
	@ini_set( 'memory_limit', '32M' );

	$installOk = true;
	
	require_once(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'updatesMigrationHelper.php');
	$vmInstaller = new updatesMigrationHelper;
	
	$vmInstaller -> determineStoreOwner();
	$vmInstaller -> determineAlreadyInstalledVersion();

	$linkUpdate =JROUTE::_('index2.php?option=com_virtuemart&controller=updatesMigration&view=updatesMigration');
	$linkFresh =JROUTE::_('index2.php?option=com_virtuemart&controller=updatesMigration&view=updatesMigration&task=freshInstall');
	$linkSample=JROUTE::_('index2.php?option=com_virtuemart&controller=updatesMigration&view=updatesMigration&task=freshInstallSample');
	$linkEssentials=JROUTE::_('index2.php?option=com_virtuemart&controller=updatesMigration&view=updatesMigration&task=InstallEssentials');


	include(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'install'.DS.'install.virtuemart.html.php');

  return $installOk;
}

function com_uninstall(){


}

?>