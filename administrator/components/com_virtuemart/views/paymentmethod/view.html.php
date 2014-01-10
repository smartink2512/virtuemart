<?php
/**
 *
 * Calc View
 *
 * @package	VirtueMart
 * @subpackage Payment Method
 * @author Max Milbers
 * @author valérie isaksen
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
 * Description
 *
 * @package		VirtueMart
 * @author valérie isaksen
 */
if (!class_exists('VirtueMartModelCurrency'))
require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'currency.php');

class VirtuemartViewPaymentMethod extends VmView {

	function display($tpl = null) {

		// Load the helper(s)
		$this->addHelperPath(JPATH_VM_ADMINISTRATOR.DS.'helpers');

		if(!class_exists('Permissions')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'permissions.php');

		if (!class_exists('VmHTML'))
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'html.php');

		if (!class_exists ('vmPSPlugin')) {
			require(JPATH_VM_PLUGINS . DS . 'vmpsplugin.php');
		}

		$this->assignRef('perms', Permissions::getInstance());

		$model = VmModel::getModel('paymentmethod');

		//@todo should be depended by loggedVendor
		//		$vendorId=1;
		//		$this->assignRef('vendorId', $vendorId);
		// TODO logo
		$this->SetViewTitle();

		$layoutName = VmRequest::getCmd('layout', 'default');

		$vendorModel = VmModel::getModel('vendor');

		$vendorModel->setId(1);
		$vendor = $vendorModel->getVendor();
		$currencyModel = VmModel::getModel('currency');
		$currencyModel = $currencyModel->getCurrency($vendor->vendor_currency);
		$this->assignRef('vendor_currency', $currencyModel->currency_symbol);

		if ($layoutName == 'edit') {

			// Load the helper(s)
			if (!class_exists('VmImage'))
				require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'image.php');
			if (!class_exists('vmParameters'))
				require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'parameterparser.php');
			VmConfig::loadJLang('plg_vmpsplugin', false);

			$payment = $model->getPayment();

			// Get the payment XML.
			$formFile	= JPath::clean( JPATH_PLUGINS.'/vmpayment/' . $payment->payment_element . '/' . $payment->payment_element . '.xml');
			if (file_exists($formFile)){

				$payment->form = JForm::getInstance($payment->payment_element, $formFile, array(),false, '//config');
				$payment->params = new stdClass();
				$varsToPush = vmPSPlugin::getVarsToPushByXML($formFile,'paymentForm');
				$payment->params->payment_params = $payment->payment_params;
				VmTable::bindParameterable($payment->params,'payment_params',$varsToPush);
				$payment->form->bind($payment);

			} else {
				$payment->form = null;
			}

			$this->assignRef('payment',	$payment);
			$this->assignRef('vmPPaymentList', self::renderInstalledPaymentPlugins($payment->payment_jplugin_id));

			$this->assignRef('shopperGroupList', ShopFunctions::renderShopperGroupList($payment->virtuemart_shoppergroup_ids, true));

			if(Vmconfig::get('multix','none')!=='none'){
				$vendorList= ShopFunctions::renderVendorList($payment->virtuemart_vendor_id);
				$this->assignRef('vendorList', $vendorList);
			}

			$this->addStandardEditViewCommands( $payment->virtuemart_paymentmethod_id);
		} else {
			$this->addStandardDefaultViewCommands();
			$this->addStandardDefaultViewLists($model);

			$payments = $model->getPayments();
			$this->assignRef('payments',	$payments);

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

	function renderInstalledPaymentPlugins($selected){

		$db = JFactory::getDBO();
		//Todo speed optimize that, on the other hand this function is NOT often used and then only by the vendors
		//		$q = 'SELECT * FROM #__plugins as pl JOIN `#__virtuemart_payment_method` AS pm ON `pl`.`id`=`pm`.`payment_jplugin_id` WHERE `folder` = "vmpayment" AND `published`="1" ';
		//		$q = 'SELECT * FROM #__plugins as pl,#__virtuemart_payment_method as pm  WHERE `folder` = "vmpayment" AND `published`="1" AND pl.id=pm.payment_jplugin_id';
		$q = 'SELECT * FROM `#__extensions` WHERE `folder` = "vmpayment" and `state`="0"  ORDER BY `ordering`,`name` ASC';
		$db->setQuery($q);
		$result = $db->loadAssocList('extension_id');
		if(empty($result)){
			$app = JFactory::getApplication();
			$app -> enqueueMessage(vmText::_('COM_VIRTUEMART_NO_PAYMENT_PLUGINS_INSTALLED'));
		}

		$listHTML='<select id="payment_jplugin_id" name="payment_jplugin_id" style= "width: 300px;">';
		if(!class_exists('JParameter')) require(JPATH_VM_LIBRARIES.DS.'joomla'.DS.'html'.DS.'parameter.php' );
		foreach($result as $paym){
			$params = new JParameter($paym['params']);
			if($paym['extension_id']==$selected) $checked='selected="selected"'; else $checked='';
			// Get plugin info
			$pType = $params->getValue('pType');
			if($pType=='Y' || $pType=='C') $id = 'pam_type_CC_on'; else $id='pam_type_CC_off';
			$listHTML .= '<option id="'.$id.'" '.$checked.' value="'.$paym['extension_id'].'">'.vmText::_($paym['name']).'</option>';

		}
		$listHTML .= '</select>';

		return $listHTML;
	}

}
// pure php not tag
