<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage
* @author
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: view.html.php 3006 2011-04-08 13:16:08Z Milbo $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// Load the view framework
jimport( 'joomla.application.component.view');

/**
 * HTML View class for the VirtueMart Component
 *
 * @package		VirtueMart
 * @author
 */
class VirtuemartViewCustom extends JView {

	function display($tpl = null) {

		// Load the helper(s)
		$this->loadHelper('adminui');
		$this->loadHelper('shopFunctions');

		$model = $this->getModel('custom');
		$this->loadHelper('permissions');
		// TODO Make an Icon for custom
		$viewName=ShopFunctions::SetViewTitle('vm_countries_48', 'PRODUCT_CUSTOM_FIELD');

		$this->assignRef('viewName',$viewName);

		$layoutName = JRequest::getWord('layout', 'default');
		if ($layoutName == 'edit') {

			$this->loadHelper('customhandler');
			$field_types= VmCustomHandler::getField_types() ;
			$this->assignRef('field_types', $field_types );
			$custom = $model->getCustom();
			$this->assignRef('custom',	$custom);

			ShopFunctions::addStandardEditViewCommands();

        }
        else {

			JToolBarHelper::custom('createClone', 'copy', 'copy',  JText::_('COM_VIRTUEMART_CLONE'), true);
			JToolBarHelper::custom('toggle.admin_only.1', 'publish','', JText::_('COM_VIRTUEMART_TOGGLE_ADMIN'), true);
			JToolBarHelper::custom('toggle.admin_only.0', 'unpublish','', JText::_('COM_VIRTUEMART_TOGGLE_ADMIN'), true);
			JToolBarHelper::custom('toggle.is_hidden.1', 'publish','', JText::_('COM_VIRTUEMART_TOGGLE_HIDDEN'), true);
			JToolBarHelper::custom('toggle.is_hidden.0', 'unpublish','', JText::_('COM_VIRTUEMART_TOGGLE_HIDDEN'), true);

			$customs = $model->getCustoms(JRequest::getInt('custom_parent_id'),JRequest::getWord('keyword'));
			$this->assignRef('customs',	$customs);

			ShopFunctions::addStandardDefaultViewCommands();
			$lists = ShopFunctions::addStandardDefaultViewLists($model);
			$this->assignRef('lists', $lists);


		}

		parent::display($tpl);
	}

}
// pure php no closing tag