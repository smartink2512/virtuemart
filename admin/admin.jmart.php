<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
/**
*
* @version $Id: admin.virtuemart.php 1755 2009-05-01 22:45:17Z rolandd $
* @package JMart
* @subpackage core
* @copyright Copyright (C) JMart Team - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* JMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_jmart/COPYRIGHT.php for copyright notices and details.
*
* http://joomlacode.org/gf/project/jmart/
*/

/* Load the configuration file */
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'jmart.cfg.php');

// Require the base controller
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'controller.php');

// Require specific controller if requested
if ($controllername = JRequest::getVar('controller')) {
	$path = JPATH_COMPONENT_ADMINISTRATOR.DS.'controllers'.DS.$controllername.'.php';
	if (file_exists($path)) {
		require_once $path;
	}
	else {
		$controllername = '';
	}
}
// Try to find a controller with the same name as the view
else if ($controllername = JRequest::getVar('view')) {
	$path = JPATH_COMPONENT_ADMINISTRATOR.DS.'controllers'.DS.$controllername.'.php';
	if (file_exists($path)) {
		require_once $path;
	}
	else {
		$controllername = '';
	}
}

// Create the controller
$classname	= 'JMartController'.ucfirst($controllername);
$controller = new $classname();

// Perform the Request task
$controller->execute(JRequest::getVar('task', $controllername));
$controller->redirect();

?>