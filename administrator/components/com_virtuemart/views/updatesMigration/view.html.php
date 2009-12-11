<?php
/**
 * UpdatesMigration View
 *
 * @package	VirtueMart
 * @subpackage UpdatesMigration
 * @author Max Milbers
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

jimport( 'joomla.application.component.view');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'adminMenu.php');

/**
 * HTML View class for maintaining the Installation. Updating of the files and imports of the database should be done here
 *
 * @package	VirtueMart
 * @subpackage UpdatesMigration
 * @author Max Milbers
 */
class VirtuemartViewUpdatesMigration extends JView 
{	
	function display($tpl = null) {	
		JToolBarHelper::title(  'Updating and data migration', 'vm_config_48');
		
		require_once( CLASSPATH.'update.class.php');
		if( JRequest::getVar( 'vm_updatepackage',null )!== null ) {
//			include( PAGEPATH.'admin.update_preview.php');
			if( JRequest::getVar( 'vm_updatepackage',null )== null ) {
				JError::raiseWarning(JText::_('VM_UPDATE_NOTDOWNLOADED')." ".$extractdir,JText::_('VM_UPDATE_NOTDOWNLOADED')." ".$extractdir);
//				return;
			}
			$packageContents = vmUpdate::getPatchContents(JRequest::getVar( 'vm_updatepackage',false ));
			if( $packageContents === false ) {
			//	$vmLogger->flush(); // An Error should be logged before
//				return;
			}
			
			$vm_mainframe->addStyleDeclaration(".writable { color:green;}\n.unwritable { color:red;font-weight:bold; }");
			
			//vmUpdate::stepBar(2);
			$layout = 'update_preview';
		}
		else {
			$model = $this->getModel();
	/*		$latestVersion = $model->getLatestVersion();
			$this->assignRef('latestVersion', $latestVersion);
			
			if (!empty($latestVersion) && version_compare(VmConfig::getVar('version_release'), $latestVersion) === -1) {
				$checkbutton_style = 'display:none;';
				$downloadbutton_style = '';
			} else {
				$checkbutton_style = '';
				$downloadbutton_style = 'display:none;';
			}*/
			$this->assignRef('checkbutton_style', $checkbutton_style);
			$this->assignRef('downloadbutton_style', $downloadbutton_style);

			$layout = 'default';
		}

		jimport('joomla.html.pane');
		$pane = JPane::getInstance('tabs');		
		$this->assignRef('pane', $pane);

		parent::display($tpl);
	}

}
?>
