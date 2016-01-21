<?php

defined('JPATH_BASE') or die;

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
if (!class_exists( 'VmConfig' )) require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');

if (!class_exists('ShopFunctions')) require(VMPATH_ADMIN . DS . 'helpers' . DS . 'shopfunctions.php');
if(!class_exists('vFormField')) require(VMPATH_ADMIN .DS. 'vmf' .DS. 'form' .DS. 'field.php');


/**
 * Supports a modal Manufacturer picker.
 *
 *
 */
class vFormFieldManufacturer extends vFormField
{
	/**
	 * The form field type.
	 *
	 * @author      Valerie Cartan Isaksen
	 * @var		string
	 *
	 */
	var $type = 'manufacturer';

	function getInput() {

		VmConfig::loadConfig();

		$model = VmModel::getModel('Manufacturer');
		$manufacturers = $model->getManufacturers(true, true, false);
		$emptyOption = vHtml::_ ('select.option', '', vmText::_ ('COM_VIRTUEMART_LIST_EMPTY_OPTION'), 'virtuemart_manufacturer_id', 'mf_name');
		if(!empty($manufacturers) and is_array($manufacturers)){
			array_unshift ($manufacturers, $emptyOption);
		} else {
			$manufacturers = array($emptyOption);
		}

		return vHtml::_('select.genericlist', $manufacturers, $this->name, 'class="inputbox"  size="1"', 'virtuemart_manufacturer_id', 'mf_name', $this->value, $this->id);
	}

}

if(JVM_VERSION>0){
	//could be written abstract with eval
	jimport('joomla.form.formfield');
	class JFormFieldManufacturer extends vFormFieldManufacturer{

		public function __construct($form = null){
			parent::__construct($form);
			vBasicModel::addIncludePath(VMPATH_ADMIN.DS.'vmf'.DS.'html','html');
			VmConfig::loadJLang('com_virtuemart');
		}
	}
}

