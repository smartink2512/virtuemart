<?php

/**
 *
 * @package	VirtueMart
 * @subpackage   Models Fields
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2011 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id:$
 */
defined('JPATH_BASE') or die;
if (!class_exists('VmConfig'))
    require(JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'config.php');
if (!class_exists('ShopFunctions'))
    require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'shopfunctions.php');
if (!class_exists('TableCategories'))
    require(JPATH_VM_ADMINISTRATOR . DS . 'tables' . DS . 'categories.php');

if (!class_exists('JFormFieldVmModal'))
	require(JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_virtuemart' . DS . 'fields' . DS . 'modal.php');

jimport('joomla.form.formfield');

/**
 * Supports a modal category picker.
 *
 *
 */
class JFormFieldCategory extends JFormFieldVmModal
{ 
	protected $type = 'category';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */

	protected function getInput() {
		return $this->getModalInput('category','category_name', 'virtuemart_category_id','categories');
	}

}