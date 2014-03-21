<?php
/**
 *
 * @version $Id$
 * @package VirtueMart
 * @author Valérie Isaksen
 * @subpackage mod_vmmenu
 * @copyright Copyright (C) VirtueMart Team - All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */
/**
 * @copyright    Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * @package        Joomla.Administrator
 * @subpackage    mod_menu
 * @since        1.5
 */
abstract class ModVMMenuHelper {


	/**
	 * Get a list of the authorised, non-special components to display in the components menu.
	 *
	 * @param    boolean $authCheck    An optional switch to turn off the auth check (to support custom layouts 'grey out' behaviour).
	 *
	 * @return    array    A nest array of component objects and submenus
	 * @since    1.6
	 */
	public static function getVMComponent($authCheck = true) {
		// Initialise variables.
		$lang = JFactory::getLanguage();
		$user = JFactory::getUser();
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$result = array();
		$langs = array();

		// Prepare the query.
		$query->select('m.id, m.title, m.alias, m.link, m.parent_id, m.img, e.element');
		$query->from('#__menu AS m');

		// Filter on the enabled states.
		$query->leftJoin('#__extensions AS e ON m.component_id = e.extension_id');
		$query->where('m.client_id = 1');
		$query->where('e.enabled = 1');
		$query->where('m.id > 1');
		$query->where('e.element = \'com_virtuemart\'');

		// Order by lft.
		$query->order('m.lft');

		$db->setQuery($query);
		// component list
		$vmComponentItems = $db->loadObjectList();
		if ($vmComponentItems) {
			// Parse the list of extensions.
			foreach ($vmComponentItems as &$vmComponentItem) {
				// Trim the menu link.
				$vmComponentItem->link = trim($vmComponentItem->link);

				if ($vmComponentItem->parent_id == 1) {
					// Only add this top level if it is authorised and enabled.
					if ($authCheck == false || ($authCheck && $user->authorise('core.manage', $vmComponentItem->element))) {
						// Root level.
						$result[$vmComponentItem->id] = $vmComponentItem;
						if (!isset($result[$vmComponentItem->id]->submenu)) {
							$result[$vmComponentItem->id]->submenu = array();
						}

						// If the root menu link is empty, add it in.
						if (empty($vmComponentItem->link)) {
							$vmComponentItem->link = 'index.php?option=' . $vmComponentItem->element;
						}

						if (!empty($vmComponentItem->element)) {
							// Load the core file then
							// Load extension-local file.
							$lang->load($vmComponentItem->element . '.sys', JPATH_BASE, null, false, false)
							|| $lang->load($vmComponentItem->element . '.sys', JPATH_ADMINISTRATOR . '/components/' . $vmComponentItem->element, null, false, false)
							|| $lang->load($vmComponentItem->element . '.sys', JPATH_BASE, $lang->getDefault(), false, false)
							|| $lang->load($vmComponentItem->element . '.sys', JPATH_ADMINISTRATOR . '/components/' . $vmComponentItem->element, $lang->getDefault(), false, false);
						}
						$vmComponentItem->text = $lang->hasKey($vmComponentItem->title) ? JText::_($vmComponentItem->title) : $vmComponentItem->alias;
					}
				} else {
					// Sub-menu level.
					if (isset($result[$vmComponentItem->parent_id])) {
						// Add the submenu link if it is defined.
						if (isset($result[$vmComponentItem->parent_id]->submenu) && !empty($vmComponentItem->link)) {
							$vmComponentItem->text = $lang->hasKey($vmComponentItem->title) ? JText::_($vmComponentItem->title) : $vmComponentItem->alias;
							$result[$vmComponentItem->parent_id]->submenu[] = & $vmComponentItem;
						}
					}
				}
			}

			$result = JArrayHelper::sortObjects($result, 'text', 1, true, $lang->getLocale());

			return $result[0];
		} else {
			return NULL;
		}


	}
}
