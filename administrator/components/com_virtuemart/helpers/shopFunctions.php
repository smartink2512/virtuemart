<?php
/**
 * General helper class
 *
 * This class provides some shop functions that are used throughout the VirtueMart shop.
 *
 * @package	VirtueMart
 * @subpackage Helpers
 * @author RolandD, RickG
 * @copyright Copyright (c) 2004-2008 Soeren Eberhardt-Biermann, 2009 VirtueMart Team. All rights reserved.
 */

class ShopFunctions {
	/**
	* Initialise the mailer object to start sending mails
	* @author RolandD
	*/
	public function loadMailer() {
		$mainframe = Jfactory::getApplication();
		jimport('joomla.mail.helper');
		
		/* Start the mailer object */
		$mailer = JFactory::getMailer();
		$mailer->isHTML(true);
		$mailer->From = $mainframe->getCfg('mailfrom');
		$mailer->FromName = $mainframe->getCfg('sitename');
		$mailer->AddReplyTo(array($mainframe->getCfg('mailfrom'), $mainframe->getCfg('sitename')));
		
		return $mailer;
	}
	
	
	/**
	 * Load the configuration values from the DB into a global variable.
	 *
	 * @author RickG
	 */
	public function loadConfig() {
		$db =& JFactory::getDBO();	
		
		$query = 'SELECT * FROM `#__vm_config`';
		$db->setQuery($query);
		$result = $db->loadObject();						
		
		JRequest::setVar('vmconfig', $result);
	}
}
?>
