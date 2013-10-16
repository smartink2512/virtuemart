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

        if (!class_exists ('vmPlugin')) {
            require(JPATH_VM_PLUGINS . DS . 'vmplugin.php');
        }

        $permsInstance=Permissions::getInstance();
        $this->assignRef('perms', $permsInstance);

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
        if (  JVM_VERSION < 3) {
            $this->assignRef('vendor_currency', $currencyModel->currency_symbol);
        }else {
            $this->vendor_currency =$currencyModel->currency_symbol;
        }

        if ($layoutName == 'edit') {

            // Load the helper(s)
            if (!class_exists('VmImage'))
                require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'image.php');

            if (!class_exists('vmParameters'))
                require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'parameterparser.php');

            $payment = $model->getPayment();
            $this->assignRef('payment',	$payment);
            $paymentPlugins= VirtuemartViewPaymentMethod::renderInstalledPaymentPlugins($payment->payment_jplugin_id);
            $this->assignRef('vmPPaymentList', $paymentPlugins);
            //			$this->assignRef('PaymentTypeList',self::renderPaymentRadioList($paym->payment_type));

            //			$this->assignRef('creditCardList',self::renderCreditCardRadioList($paym->payment_creditcards));
            //			echo 'humpf <pre>'.print_r($paym).'</pre>' ;
            $virtuemart_shoppergroup_list =ShopFunctions::renderShopperGroupList($payment->virtuemart_shoppergroup_ids, true);
            $this->assignRef('shopperGroupList', $virtuemart_shoppergroup_list);

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





    function renderInstalledPaymentPlugins($selected){

        $db = JFactory::getDBO();
        //Todo speed optimize that, on the other hand this function is NOT often used and then only by the vendors
        //$q = 'SELECT * FROM `#__extensions` WHERE `folder` = "vmpayment" AND `enabled`="1" ';
        $q = 'SELECT * FROM `#__extensions` WHERE `folder` = "vmpayment"   ';
        $db->setQuery($q);
        $payments = $db->loadAssocList('extension_id');
        if(empty($payments)){
            $app = JFactory::getApplication();
            $app -> enqueueMessage(JText::_('COM_VIRTUEMART_NO_PAYMENT_PLUGINS_INSTALLED'));
        }
        $listHTML='<select id="payment_jplugin_id" name="payment_jplugin_id">';
        foreach($payments as $payment){
            if($payment['extension_id']==$selected) $checked='selected="selected"'; else $checked='';
            $enabled='';
            if(!$payment['enabled']) {
                $enabled=' (disabled)';
            }
            $listHTML .= '<option   '.$checked.' value="'.$payment['extension_id'].'">'.JText::_($payment['name']).$enabled.'</option>';

        }
        $listHTML .= '</select>';

        return $listHTML;
    }

}
// pure php not tag
