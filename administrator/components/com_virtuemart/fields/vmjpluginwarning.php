<?php
defined('_JEXEC') or die();
/**
 *
 * @package    VirtueMart
 * @subpackage Plugins  - Elements
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2011 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id$
 */

if (!class_exists('vmRequest')) require(JPATH_ROOT . '/administrator/components/com_virtuemart/helpers/config.php');

class JFormFieldVmjpluginwarning extends JFormField {

	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'vmjpluginwarning';

	protected function getLabel() {

	}

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput() {
		$lang = JFactory::getLanguage();
		$lang->load('com_virtuemart', JPATH_ADMINISTRATOR);

		$option = vmRequest::getCmd('option');
		if ($option == 'com_virtuemart')
			return null;
		else
			return '<span class="alert alert-info">'.vmText::_('COM_VIRTUEMART_PLUGIN_WARNING').'</span>';
	}

}