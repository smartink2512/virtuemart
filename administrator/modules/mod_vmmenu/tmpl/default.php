<?php
/**
 *
 * @version $Id$
 * @package VirtueMart
 * @author Valérie Isaksen
 * @subpackage mod_vmmenu
 * @copyright Copyright (C) 2014 VirtueMart Team - All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */

// No direct access.
defined('_JEXEC') or die;


$show_vmmenu 	= $params->get('show_vmmenu', 1);
$vmMenu="";
$user = JFactory::getUser();
$lang = JFactory::getLanguage();
if ($show_vmmenu) {
	$hideMainmenu=false;
}

// Get the authorised components and sub-menus.
$vmComponentItems = ModVMMenuHelper::getVMComponent(true);

// Check if there are any components, otherwise, don't render the menu
if ($vmComponentItems) {
	$class = '';
	if ($hideMainmenu) {
		$class = " disabled";
	}
	$vmMenu='<ul id="menu" >';
	$vmMenu.='<li class="node'.$class.'"><a href="'.$vmComponentItems->link.'">'.$vmComponentItems->text.'</a>';

	if (!$hideMainmenu) {
		if (!empty($vmComponentItems->submenu)) {
			$vmMenu.='<ul id="menu-com-virtuemart" class="menu-component">';
			foreach ($vmComponentItems->submenu as $sub) {
				$vmMenu.='<li class="'.$sub->class.'"><a href="'.$sub->link.'">'.$sub->text.'</a></li>';
			}
			$vmMenu.='</ul>';
		}
	}
	$vmMenu.='</li></ul>';
}


echo $vmMenu;