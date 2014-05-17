<?php
/**
 * @package LiveUpdate
 * @copyright Copyright ©2011 Nicholas K. Dionysopoulos / AkeebaBackup.com
 * @license GNU LGPLv3 or later <http://www.gnu.org/copyleft/lesser.html>
 *
 * One-click updater for Joomla! extensions
 * Copyright (C) 2011  Nicholas K. Dionysopoulos / AkeebaBackup.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

defined('_JEXEC') or die();


$task = JRequest::getCmd('task');
if($task=='updateDatabase'){
	$data = JRequest::get('get');
	JRequest::setVar($data['token'], '1', 'post');
	JRequest::checkToken() or jexit('Invalid Token, in ' . JRequest::getWord('task'));

	//Update Tables
	if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');
	if(!class_exists('Permissions'))
	require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart' . DS . 'helpers' . DS . 'permissions.php');
	if(!Permissions::getInstance()->check('admin')){
		$msg = 'Forget IT';
		$this->setRedirect('index.php?option=com_virtuemart_allinone', $msg);
	} else {
		if(!class_exists('com_virtuemart_allinoneInstallerScript')) require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart_allinone'.DS.'script.vmallinone.php');
		$updater = new com_virtuemart_allinoneInstallerScript();
		$updater->vmInstall();
		$app = JFactory::getApplication();
		$app->redirect('index.php?option=com_virtuemart_allinone', 'Database updated');
	}

}

?>


<table>
<tr>
	<td>
ALL IN ONE VIRTUEMART COMPONENT
	</td>
</tr>

</table>


