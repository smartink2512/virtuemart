<?php


defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');
if (!class_exists('VmConfig'))
require(JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'config.php');

if (!class_exists('ShopFunctions'))
require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'shopfunctions.php');
if (!class_exists('VirtueMartModelManufacturer'))
JLoader::import('manufacturer', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'models');

if (!class_exists('VmElements'))
require(JPATH_VM_ADMINISTRATOR . DS . 'elements' . DS . 'vmelements.php');
if(!class_exists('TableManufacturers')) require(JPATH_VM_ADMINISTRATOR.DS.'tables'.DS.'manufacturers.php');
if (!class_exists( 'VirtueMartModelManufacturer' ))
JLoader::import( 'manufacturer', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'models' );
if (!class_exists('JFormFieldVmModal'))
	require(JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_virtuemart' . DS . 'fields' . DS . 'modal.php');
/**
 * Supports a modal Manufacturer picker.
 *
 *
 */
class JFormFieldManufacturer extends JFormFieldVmModal
{
	/**
	 * The form field type.
	 *
	 * @author      Valerie Cartan Isaksen
	 * @var		string
	 *
	 */
	protected $type = 'manufacturer';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */

	protected function getInput()
	{
		return $this->getModalInput('manufacturer','mf_name', 'virtuemart_manufacturer_id','manufacturers');
	}


}