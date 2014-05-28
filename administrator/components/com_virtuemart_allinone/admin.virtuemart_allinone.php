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

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
if (!class_exists( 'VmConfig' )) {
	$path = JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php';
	if(file_exists($path)){
		require($path);
		VmConfig::loadConfig();
	} else {
		$app = JFactory::getApplication();
		$app->enqueueMessage('VirtueMart Core is not installed, please install VirtueMart again, or uninstall the AIO component by the joomla extension manager');
		return false;
	}
}

$task = vRequest::getCmd('task');
if($task=='updateDatabase'){
	vRequest::vmCheckToken('Invalid Token, in ' . vRequest::getCmd('task')) ;

	//Update Tables
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
<script type="text/javascript">
	<!--
	function confirmation(message, destnUrl) {
		var answer = confirm(message);
		if (answer) {
			window.location = destnUrl;
		}
	}
	//-->
</script>

<table>

	<tr>
		<td align="center">
			<?php
			VmConfig::loadConfig();
			VmConfig::loadJLang('com_virtuemart');

			?>
			<?php $link=JROUTE::_('index.php?option=com_virtuemart_allinone&task=updateDatabase&'.JSession::getFormToken().'=1' ); ?>
			<button onclick="javascript:confirmation('<?php echo addslashes( JText::_('COM_VIRTUEMART_UPDATE_VMPLUGINTABLES') ); ?>', '<?php echo $link; ?>');">

				<?php echo JText::_('COM_VIRTUEMART_UPDATE_VMPLUGINTABLES'); ?>
			</button>
		</td>
	</tr>
</table>


