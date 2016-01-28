<?php
defined('JPATH_PLATFORM') or die;

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
 * @version $Id: $
 */
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
if(!class_exists('VmConfig')) require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');
if(!class_exists('vFormField')) require(VMPATH_ADMIN .DS. 'vmf' .DS. 'form' .DS. 'field.php');
/*
 * This class is used by VirtueMart Payment or Shipment Plugins
 * So It should be an extension of vFormField
 */

vFormHelper::loadFieldClass('list');

class vFormFieldVmCurrencies extends vFormFieldList {
//class JFormFieldVmCurrencies extends JFormFieldList {
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	var $type = 'vmCurrencies';

	protected function getOptions() {
		$options = array();

		if (!class_exists('VirtueMartModelVendor')) require(VMPATH_ADMIN . DS . 'models' . DS . 'vendor.php');
		$vendor_id = VirtueMartModelVendor::getLoggedVendor();
		// set currency_id to logged vendor
		if (empty($this->value)) {
			$currency = VirtueMartModelVendor::getVendorCurrency($vendor_id);
			$this->value = $currency->virtuemart_currency_id;
		}
		// why not logged vendor? shared is missing
		$db = vFactory::getDbo();
		$query = 'SELECT `virtuemart_currency_id` AS value, `currency_name` AS text
			FROM `#__virtuemart_currencies`
			WHERE `virtuemart_vendor_id` = "1"  AND `published` = "1" ORDER BY `currency_name` ASC ';
		// default value should be vendor currency
		$db->setQuery($query);
		$values = $db->loadObjectList();
		foreach ($values as $v) {
			$options[] = vHtml::_('select.option', $v->value, $v->text);
		}
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}

}

//could be written abstract with eval
if(JVM_VERSION>0){
	$o = vRequest::getCmd('option',false);
	if($o=='com_modules' or $o=='com_plugins') {
		jimport( 'joomla.form.formfield' );
		class JFormFieldVmCurrencies extends vFormFieldVmCurrencies {
			public function __construct ($form = null) {
				parent::__construct( $form );
				vBasicModel::addIncludePath( VMPATH_ADMIN.DS.'vmf'.DS.'html', 'html' );
				vFactory::$_lang = JFactory::getLanguage();
			}
		}
	}
}