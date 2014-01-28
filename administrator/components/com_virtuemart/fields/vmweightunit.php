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


if (!class_exists('VmConfig'))
	require(JPATH_ROOT .'/administrator/components/com_virtuemart/helpers/config.php');

if (!class_exists('ShopFunctions'))
	require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'shopfunctions.php');

class JFormFieldVmWeightunit extends JFormField {

	/**
	 * Element name
	 * @access    protected
	 * @var        string
	 */
	protected $type = 'vmWeightUnit';

	protected function getInput() {
		return ShopFunctions::renderWeightUnitList($this->name, $this->value);
	}

}