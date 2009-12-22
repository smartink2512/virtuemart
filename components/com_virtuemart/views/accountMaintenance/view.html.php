<?php
/**
* Account Maintenance view
*
* @package VirtueMart
* @author RolandD
*/

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

jimport( 'joomla.application.component.view' );
/**
 * Account maintenance
 */
class VirtueMartViewAccountmaintenance extends JView {
	
	function display($tpl = null) {
		$mainframe = JFactory::getApplication();
		$mainframe->setPageTitle(JText::_('VM_ACCOUNT_TITLE'));
		
		/* Load some helpers */
		$this->addHelperPath(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers');
		$this->loadHelper('permissions');
		$this->loadHelper('shopperGroup');
		
		/* Load the authorizations */
		$auth = Permissions::doAuthentication();
		
		/* Load the logged in user */
		$user = JFactory::getUser();
		
		/* Assign data */
		$this->assignRef('auth', $auth);
		$this->assignRef('user', $user);
		
		
		/* Display it all */
		parent::display($tpl); 
	}
}

?>