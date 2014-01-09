<?php


defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');
if (!class_exists('VmConfig'))
require(JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'config.php');
if (!class_exists('ShopFunctions'))
require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'shopfunctions.php');

if (!class_exists('TableCategories'))
require(JPATH_VM_ADMINISTRATOR . DS . 'tables' . DS . 'categories.php');

if (!class_exists('VmElements'))
require(JPATH_VM_ADMINISTRATOR . DS . 'elements' . DS . 'vmelements.php');
if (!class_exists('JFormFieldVmModal'))
	require(JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_virtuemart' . DS . 'fields' . DS . 'modal.php');
/**
 * Supports a modal product picker.
 *
 *
 */
class JFormFieldProduct extends JFormFieldVmModal
{
	/**
	 * The form field type.
	 *
	 * @author      Valerie Cartan Isaksen
	 * @var		string
	 *
	 */
	protected $type = 'product';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */


	protected function getInput()
	{

		return $this->getModalInput('product','product_name', 'virtuemart_product_id','products');

	}
}
