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


/** 
 * Parse a .sql file and execute the sql statements found.
 *
 * @author RickG 
 */
function execSQLFile($filename) 
{ 
	$db = JFactory::getDBO();   	
     
	$content = file_get_contents($filename);             
    $file_content = explode("\n",$content);    
      
    $query = ""; 
        
   	// Parsing the SQL file content              
    foreach($file_content as $sql_line) 
    {        
    	if(trim($sql_line) != "" && strpos($sql_line, "--") === false) {              
        	$query .= $sql_line; 
            // Checking whether the line is a valid statement 
            if(preg_match("/(.*);/", $sql_line)) { 
            	$query = substr($query, 0, strlen($query)-1);                                   
				$db->setQuery($query);
        		if (!$db->query()){
					$installOk = false;
            		break;
        		}                     
                $query = ""; 
            } 
        } 
    }        
    return true; 
}



function com_install(){	
	@ini_set( 'memory_limit', '32M' );
	$db = JFactory::getDBO();  
	
	$query = "SELECT count(id) AS idCount FROM `#__vm_menu_admin`";
	$db->setQuery($query);
	$result = $db->loadObject();
	if ($result->idCount > 0) {
		$newInstall = false;
	}
	else {
		$newInstall = true;
	}
	
	if ($newInstall) {	
		// Install Essential Data
		$filename = JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'install'.DS.'install_essential_data.sql'; 
		execSQLFile($filename);
	}

	$installOk = true;
	
	require_once(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'updatesMigrationHelper.php');
	$vmInstaller = new updatesMigrationHelper;
	
	//$vmInstaller -> determineStoreOwner();
	//$vmInstaller -> determineAlreadyInstalledVersion();

	$linkUpdate = JROUTE::_('index2.php?option=com_virtuemart&controller=updatesMigration&view=updatesMigration');
	$linkFresh = JROUTE::_('index2.php?option=com_virtuemart&controller=updatesMigration&view=updatesMigration&task=freshInstall');
	$linkSample = JROUTE::_('index2.php?option=com_virtuemart&controller=updatesMigration&view=updatesMigration&task=freshInstallSample');
	$linkEssentials = JROUTE::_('index2.php?option=com_virtuemart&controller=updatesMigration&view=updatesMigration&task=InstallEssentials');


	include(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'install'.DS.'install.virtuemart.html.php');

  return $installOk;
}

function com_uninstall(){


}




?>