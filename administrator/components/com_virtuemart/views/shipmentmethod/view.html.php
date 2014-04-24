<?php
/**
*
* Shipment  View
*
* @package	VirtueMart
* @subpackage Shipment
* @author RickG
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id$
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// Load the view framework
if(!class_exists('VmView'))require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'vmview.php');

/**
 * HTML View class for maintaining the list of shipment
 *
 * @package	VirtueMart
 * @subpackage Shipment
 * @author RickG
 */
class VirtuemartViewShipmentmethod extends VmView {

	function display($tpl = null) {

		// Load the helper(s)
		$this->addHelperPath(JPATH_VM_ADMINISTRATOR.DS.'helpers');

		if(!class_exists('vmPSPlugin')) require(JPATH_VM_PLUGINS.DS.'vmpsplugin.php');

		if (!class_exists('VmHTML'))
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'html.php');

		$model = VmModel::getModel();

		$layoutName = vRequest::getCmd('layout', 'default');
		$this->SetViewTitle();

		$layoutName = vRequest::getCmd('layout', 'default');
		if ($layoutName == 'edit') {
			VmConfig::loadJLang('plg_vmpsplugin', false);

			JForm::addFieldPath(JPATH_VM_ADMINISTRATOR . DS . 'fields');

			$shipment = $model->getShipment();

			// Get the payment XML.
			$formFile	= JPath::clean( JPATH_PLUGINS.'/vmshipment/' . $shipment->shipment_element . '/' . $shipment->shipment_element . '.xml');
			if (file_exists($formFile)){
				$shipment->form = JForm::getInstance($shipment->shipment_element, $formFile, array(),false, '//config');
				$shipment->params = new stdClass();
				$varsToPush = vmPlugin::getVarsToPushByXML($formFile,'shipmentForm');
				$shipment->params->shipment_params = $shipment->shipment_params;
				VmTable::bindParameterable($shipment->params,'shipment_params',$varsToPush);
				$shipment->form->bind($shipment);

			} else {
				$shipment->form = null;
			}
			if (!class_exists('VmImage'))
				require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'image.php');

			 if(!class_exists('VirtueMartModelVendor')) require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'vendor.php');
			 $vendor_id = 1;
			 $currency=VirtueMartModelVendor::getVendorCurrency ($vendor_id);
			 $this->assignRef('vendor_currency', $currency->currency_symbol);

			 if(Vmconfig::get('multix','none')!=='none'){
					$vendorList= ShopFunctions::renderVendorList($shipment->virtuemart_vendor_id);
					$this->assignRef('vendorList', $vendorList);
			 }

			$this->assignRef('pluginList', self::renderInstalledShipmentPlugins($shipment->shipment_jplugin_id));
			$this->assignRef('shipment',	$shipment);
			$this->assignRef('shopperGroupList', ShopFunctions::renderShopperGroupList($shipment->virtuemart_shoppergroup_ids,true));

			$this->addStandardEditViewCommands($shipment->virtuemart_shipmentmethod_id);

		} else {
			JToolBarHelper::custom('cloneshipment', 'copy', 'copy', JText::_('COM_VIRTUEMART_SHIPMENT_CLONE'), true);

			$this->addStandardDefaultViewCommands();
			$this->addStandardDefaultViewLists($model);

			$this->shipments = $model->getShipments();
			foreach ($this->shipments as &$data){
				// Write the first 5 shoppergroups in the list
				$data->shipmentShoppersList = shopfunctions::renderGuiList($data->virtuemart_shoppergroup_ids,'shoppergroups','shopper_group_name','shopper');
			}

			$pagination = $model->getPagination();
			$this->assignRef('pagination', $pagination);

		}

		parent::display($tpl);
	}
	function getParams($raw) {

		if (!empty($raw)) {
			$params = explode('|', substr($raw, 0,-1));
			foreach($params as $param){
				$item = explode('=',$param);
				if(!empty($item[1])){
					$pair[$item[0]] = str_replace('"','', $item[1]);
				} else {
					$pair[$item[0]] ='';
				}

			}
		}
		return $pair;
	}

	function renderInstalledShipmentPlugins($selected)
	{
		$db = JFactory::getDBO();

		$table = '#__extensions';
		$enable = 'enabled';
		$ext_id = 'extension_id';

		$q = 'SELECT * FROM `'.$table.'` WHERE `folder` = "vmshipment" AND `state`="0" ORDER BY `ordering`,`name` ASC';
		$db->setQuery($q);
		$result = $db->loadAssocList($ext_id);
		if(empty($result)){
			$app = JFactory::getApplication();
			$app -> enqueueMessage(JText::_('COM_VIRTUEMART_NO_SHIPMENT_PLUGINS_INSTALLED'));
		}

		foreach ($result as &$sh) {
			$sh['name'] = JText::_($sh['name']);
		}
		$attribs='style= "width: 300px;"';
		return JHtml::_('select.genericlist', $result, 'shipment_jplugin_id', $attribs, $ext_id, 'name', $selected);
	}

}
// pure php no closing tag
