<?php


defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');
if (!class_exists('VmConfig'))
require(JPATH_ROOT .'/administrator/components/com_virtuemart/helpers/config.php');

if (!class_exists('ShopFunctions'))
require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'shopfunctions.php');
if (!class_exists('VirtueMartModelManufacturer'))
JLoader::import('manufacturer', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'models');


if(!class_exists('TableManufacturers')) require(JPATH_VM_ADMINISTRATOR.DS.'tables'.DS.'manufacturers.php');
if (!class_exists( 'VirtueMartModelManufacturer' ))
JLoader::import( 'manufacturer', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'models' );
/**
 * Supports a modal Manufacturer picker.
 *
 *
 */
class JFormFieldManufacturer extends JFormField
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


	function getInput() {

		$key = ($this->element['key_field'] ? $this->element['key_field'] : 'value');
		$val = ($this->element['value_field'] ? $this->element['value_field'] : $this->name);
		$model = VmModel::getModel('Manufacturer');
		$manufacturers = $model->getManufacturers(true, true, false);
		$emptyOption = JHtml::_ ('select.option', '', vmText::_ ('COM_VIRTUEMART_LIST_EMPTY_OPTION'), 'virtuemart_manufacturer_id', 'mf_name');
		array_unshift ($manufacturers, $emptyOption);
		return JHtml::_('select.genericlist', $manufacturers, $this->name, 'class="inputbox"  size="1"', 'virtuemart_manufacturer_id', 'mf_name', $this->value, $this->id);
	}


}