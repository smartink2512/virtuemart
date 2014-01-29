<?php

/**
 *
 * List/add/edit/remove Users
 *
 * @package	VirtueMart
 * @subpackage User
 * @author Oscar van Eijk
 * @author Max Milbers
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
if (!class_exists('VmView'))
    require(JPATH_VM_SITE . DS . 'helpers' . DS . 'vmview.php');

// Set to '0' to use tabs i.s.o. sliders
// Might be a config option later on, now just here for testing.
define('__VM_USER_USE_SLIDERS', 0);

/**
 * HTML View class for maintaining the list of users
 *
 * @package	VirtueMart
 * @subpackage User
 * @author Oscar van Eijk
 * @author Max Milbers
 */
class VirtuemartViewUser extends VmView {

    private $_model;
    private $_currentUser = 0;
    private $_cuid = 0;
    private $_userDetails = 0;
    private $_orderList = 0;
    private $_openTab = 0;

    /**
     * Displays the view, collects needed data for the different layouts
     *
     * @author Max Milbers
     */
    function display($tpl = null) {


	$useSSL = VmConfig::get('useSSL', 0);
	$useXHTML = true;
	$this->assignRef('useSSL', $useSSL);
	$this->assignRef('useXHTML', $useXHTML);

	$mainframe = JFactory::getApplication();
	$pathway = $mainframe->getPathway();
	$layoutName = $this->getLayout();
	// 	vmdebug('layout by view '.$layoutName);
	if (empty($layoutName) or $layoutName == 'default') {
	    $layoutName = VmRequest::getCmd('layout', 'edit');
		if ($layoutName == 'default'){
			$layoutName = 'edit';
		}
		$this->setLayout($layoutName);
	}


	if (!class_exists('ShopFunctions'))
	    require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'shopfunctions.php');

	// 	vmdebug('my layoutname',$layoutName);
	if ($layoutName == 'login') {

	    parent::display($tpl);
	    return;
	}

	if (!class_exists('VirtuemartModelUser'))
	    require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'user.php');
	$this->_model = new VirtuemartModelUser();

	//		$this->_model->setCurrent(); //without this, the administrator can edit users in the FE, permission is handled in the usermodel, but maybe unsecure?
	$editor = JFactory::getEditor();

	//the cuid is the id of the current user
	$this->_currentUser = JFactory::getUser();
	$this->_cuid = $this->_lists['current_id'] = $this->_currentUser->get('id');
	$this->assignRef('userId', $this->_cuid);

	$this->_userDetails = $this->_model->getUser();

	$this->assignRef('userDetails', $this->_userDetails);

	$address_type = VmRequest::getCmd('addrtype', 'BT');
	$this->assignRef('address_type', $address_type);

	$new = false;
	if (VmRequest::getInt('new', '0') == 1) {
	    $new = true;
	}

	if ($new) {
	    $virtuemart_userinfo_id = 0;
	} else {
	    $virtuemart_userinfo_id = VmRequest::getString('virtuemart_userinfo_id', '0', '');
	}

	$this->assignRef('virtuemart_userinfo_id', $virtuemart_userinfo_id);

	$userFields = null;

	if (!class_exists('VirtueMartCart')) require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
	$this->cart = VirtueMartCart::getCart();

	if (($this->cart->fromCart or $this->cart->getInCheckOut()) && empty($virtuemart_userinfo_id)) {

	    //New Address is filled here with the data of the cart (we are in the cart)


	    $fieldtype = $address_type . 'address';
		$this->cart->prepareAddressDataInCart($address_type, $new);

	    $userFields = $this->cart->$fieldtype;

	    $task = VmRequest::getCmd('task', '');
	} else {
		$userFields = $this->_model->getUserInfoInUserFields($layoutName, $address_type, $virtuemart_userinfo_id);
		if (!$new && empty($userFields[$virtuemart_userinfo_id])) {
			$virtuemart_userinfo_id = $this->_model->getBTuserinfo_id();
// 			vmdebug('Try to get $virtuemart_userinfo_id by type BT', $virtuemart_userinfo_id);
		}
		$userFields = $userFields[$virtuemart_userinfo_id];
		$task = 'editaddressST';
	}

	$this->assignRef('userFields', $userFields);

	if ($layoutName == 'edit') {

	    if ($this->_model->getId() == 0 && $this->_cuid == 0) {
		$button_lbl = vmText::_('COM_VIRTUEMART_REGISTER');
	    } else {
		$button_lbl = vmText::_('COM_VIRTUEMART_SAVE');
	    }

	    $this->assignRef('button_lbl', $button_lbl);
	    $this->lUser();
	    $this->shopper($userFields);

	    $this->payment();
	    $this->lOrderlist();
	    $this->lVendor();
	}


	$this->_lists['shipTo'] = ShopFunctions::generateStAddressList($this,$this->_model, $task);


	$this->assignRef('lists', $this->_lists);

	$this->assignRef('editor', $editor);

	if ($layoutName == 'mailregisteruser') {
	    $vendorModel = VmModel::getModel('vendor');
	    //			$vendorModel->setId($this->_userDetails->virtuemart_vendor_id);
	    $vendor = $vendorModel->getVendor();
	    $this->assignRef('vendor', $vendor);

	}
	if ($layoutName == 'editaddress') {
	    $layoutName = 'edit_address';
	    $this->setLayout($layoutName);
	}

	if (!$this->userDetails->JUser->get('id')) {
	    $corefield_title = vmText::_('COM_VIRTUEMART_USER_CART_INFO_CREATE_ACCOUNT');
	} else {
	    $corefield_title = vmText::_('COM_VIRTUEMART_YOUR_ACCOUNT_DETAILS');
	}
	if ($this->cart->fromCart or $this->cart->getInCheckOut()) {
	    $pathway->addItem(vmText::_('COM_VIRTUEMART_CART_OVERVIEW'), JRoute::_('index.php?option=com_virtuemart&view=cart', FALSE));
	} else {
	    //$pathway->addItem(vmText::_('COM_VIRTUEMART_YOUR_ACCOUNT_DETAILS'), JRoute::_('index.php?option=com_virtuemart&view=user&&layout=edit'));
	}
	$pathway_text = vmText::_('COM_VIRTUEMART_YOUR_ACCOUNT_DETAILS');
	if (!$this->userDetails->JUser->get('id')) {
	    if ($this->cart->fromCart or $this->cart->getInCheckOut()) {
		if ($address_type == 'BT') {
		    $vmfield_title = vmText::_('COM_VIRTUEMART_USER_FORM_EDIT_BILLTO_LBL');
		} else {
		    $vmfield_title = vmText::_('COM_VIRTUEMART_USER_FORM_ADD_SHIPTO_LBL');
		}
	    } else {
		if ($address_type == 'BT') {
		    $vmfield_title = vmText::_('COM_VIRTUEMART_USER_FORM_EDIT_BILLTO_LBL');
		    $title = vmText::_('COM_VIRTUEMART_REGISTER');
		} else {
		    $vmfield_title = vmText::_('COM_VIRTUEMART_USER_FORM_ADD_SHIPTO_LBL');
		}
	    }
	} else {

	    if ($address_type == 'BT') {
		$vmfield_title = vmText::_('COM_VIRTUEMART_USER_FORM_BILLTO_LBL');
	    } else {

		$vmfield_title = vmText::_('COM_VIRTUEMART_USER_FORM_ADD_SHIPTO_LBL');
	    }
	}
	  $add_product_link="";

	if(VmConfig::isSuperVendor() ){
	    $add_product_link = JRoute::_( 'index.php?option=com_virtuemart&tmpl=component&view=product&view=product&task=edit&virtuemart_product_id=0' );
	    $add_product_link = $this->linkIcon($add_product_link, 'COM_VIRTUEMART_PRODUCT_ADD_PRODUCT', 'new', false, false, true, true);
	}
	$this->assignRef('add_product_link', $add_product_link);

	$document = JFactory::getDocument();
	$document->setTitle($pathway_text);
	$pathway->additem($pathway_text);
	$document->setMetaData('robots','NOINDEX, NOFOLLOW, NOARCHIVE, NOSNIPPET');
	$this->assignRef('page_title', $pathway_text);
	$this->assignRef('corefield_title', $corefield_title);
	$this->assignRef('vmfield_title', $vmfield_title);
	shopFunctionsF::setVmTemplate($this, 0, 0, $layoutName);

	parent::display($tpl);
    }

    function payment() {

    }

    function lOrderlist() {
	// Check for existing orders for this user
	$orders = VmModel::getModel('orders');

	if ($this->_model->getId() == 0) {
	    // getOrdersList() returns all orders when no userID is set (admin function),
	    // so explicetly define an empty array when not logged in.
	    $this->_orderList = array();
	} else {
	    $this->_orderList = $orders->getOrdersList($this->_model->getId(), true);

	    if (empty($this->currency)) {
		if (!class_exists('CurrencyDisplay'))
		    require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'currencydisplay.php');

		$currency = CurrencyDisplay::getInstance();
		$this->assignRef('currency', $currency);
	    }
	}
		if($this->_orderList){
			VmConfig::loadJLang('com_virtuemart_orders',TRUE);
		}
	$this->assignRef('orderlist', $this->_orderList);
    }

    function shopper($userFields) {

	// Shopper info
	if (!class_exists('VirtueMartModelShopperGroup'))
	    require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'shoppergroup.php');

	$_shoppergroup = VirtueMartModelShopperGroup::getShoppergroupById($this->_model->getId());

		$user = JFactory::getUser();
		if($user->authorise('core.admin','com_virtuemart') or $user->authorise('core.manage','com_virtuemart')) {

		$shoppergrps = array();
		foreach($_shoppergroup as $group){
			$shoppergrps[] = $group['virtuemart_shoppergroup_id'];
		}
	   $this->_lists['shoppergroups'] = ShopFunctions::renderShopperGroupList($shoppergrps);
	   $this->_lists['vendors'] = ShopFunctions::renderVendorList($this->_userDetails->virtuemart_vendor_id);
	} else {
		$this->_lists['shoppergroups'] = '';
		foreach($_shoppergroup as $group){
			$this->_lists['shoppergroups'] .= $group['shopper_group_name'].', ';
		}
		$this->_lists['shoppergroups'] = substr($this->_lists['shoppergroups'],0,-2);

	    if (!empty($this->_userDetails->virtuemart_vendor_id)) {
		$this->_lists['vendors'] = $this->_userDetails->virtuemart_vendor_id;
	    }

	    if (empty($this->_lists['vendors'])) {
		$this->_lists['vendors'] = vmText::_('COM_VIRTUEMART_USER_NOT_A_VENDOR'); // . $_setVendor;
	    }
	}

	//todo here is something broken we use $_userDetailsList->perms and $this->_userDetailsList->perms and perms seems not longer to exist
	//todo we should list here the joomla ACL groups

	// Load the required scripts
	if (count($userFields['scripts']) > 0) {
	    foreach ($userFields['scripts'] as $_script => $_path) {
		JHtml::script($_script, $_path);
	    }
	}
	// Load the required styresheets
	if (count($userFields['links']) > 0) {
	    foreach ($userFields['links'] as $_link => $_path) {
		JHtml::stylesheet($_link, $_path);
	    }
	}
    }

    function lUser() {

	$this->lists['canBlock'] = ($this->_currentUser->authorise('com_users', 'block user')
		&& ($this->_model->getId() != $this->_cuid)); // Can't block myself TODO I broke that, please retest if it is working again
	$this->lists['canSetMailopt'] = $this->_currentUser->authorise('workflow', 'email_events');
	$this->_lists['block'] = JHtml::_('select.booleanlist', 'block', 'class="inputbox"', $this->_userDetails->JUser->get('block'), 'COM_VIRTUEMART_YES', 'COM_VIRTUEMART_NO');
	$this->_lists['sendEmail'] = JHtml::_('select.booleanlist', 'sendEmail', 'class="inputbox"', $this->_userDetails->JUser->get('sendEmail'), 'COM_VIRTUEMART_YES', 'COM_VIRTUEMART_NO');

	$this->_lists['params'] = $this->_userDetails->JUser->getParameters(true);

	$this->_lists['custnumber'] = $this->_model->getCustomerNumberById();

	//TODO I do not understand for what we have that by Max.
	if ($this->_model->getId() < 1) {
	    $this->_lists['register_new'] = 1;
	} else {
	    $this->_lists['register_new'] = 0;
	}
    }

    function lVendor() {

	// If the current user is a vendor, load the store data
	if ($this->_userDetails->user_is_vendor) {

			$front = JURI::root(true).'/components/com_virtuemart/assets/';
			$admin = JURI::root(true).'/administrator/components/com_virtuemart/assets/';

			$document = JFactory::getDocument();
			$document->addScript($front.'js/fancybox/jquery.mousewheel-3.0.4.pack.js');
			$document->addScript($front.'js/fancybox/jquery.easing-1.3.pack.js');
			$document->addScript($front.'js/fancybox/jquery.fancybox-1.3.4.pack.js');

			vmJsApi::js ('jquery-ui', FALSE, '', TRUE);
			vmJsApi::js ('jquery.ui.autocomplete.html');
			vmJsApi::js( 'jquery.noConflict');
			$document->addScript($admin.'js/vm2admin.js');
			
	    $currencymodel = VmModel::getModel('currency', 'VirtuemartModel');
	    $currencies = $currencymodel->getCurrencies();
	    $this->assignRef('currencies', $currencies);

	    if (!$this->_orderList) {
			$this->lOrderlist();
	    }

	    $vendorModel = VmModel::getModel('vendor');

	    if (Vmconfig::get('multix', 'none') === 'none') {
		$vendorModel->setId(1);
	    } else {
		$vendorModel->setId($this->_userDetails->virtuemart_vendor_id);
	    }
	    $vendor = $vendorModel->getVendor();
	    $vendorModel->addImages($vendor);
	    $this->assignRef('vendor', $vendor);
	}
    }

    /*
     * renderMailLayout
     *
     * @author Max Milbers
     * @author Valerie Isaksen
     */

    public function renderMailLayout($doVendor, $recipient) {

	$useSSL = VmConfig::get('useSSL', 0);
	$useXHTML = true;
	$this->assignRef('useSSL', $useSSL);
	$this->assignRef('useXHTML', $useXHTML);
	$userFieldsModel = VmModel::getModel('UserFields');
	$userFields = $userFieldsModel->getUserFields();
	$this->userFields = $userFieldsModel->getUserFieldsFilled($userFields, $this->user);


    if (VmConfig::get('order_mail_html')) {
	    $mailFormat = 'html';
	    $lineSeparator="<br />";
    } else {
	    $mailFormat = 'raw';
	    $lineSeparator="\n";
    }

    $virtuemart_vendor_id=1;
    $vendorModel = VmModel::getModel('vendor');
    $vendor = $vendorModel->getVendor($virtuemart_vendor_id);
    $vendorModel->addImages($vendor);
	$vendor->vendorFields = $vendorModel->getVendorAddressFields();
    $this->assignRef('vendor', $vendor);

	if (!$doVendor) {
	    $this->subject = vmText::sprintf('COM_VIRTUEMART_NEW_SHOPPER_SUBJECT', $this->user->username, $this->vendor->vendor_store_name);
	    $tpl = 'mail_' . $mailFormat . '_reguser';
	} else {
	    $this->subject = vmText::sprintf('COM_VIRTUEMART_VENDOR_NEW_SHOPPER_SUBJECT', $this->user->username, $this->vendor->vendor_store_name);
	    $tpl = 'mail_' . $mailFormat . '_regvendor';
	}

	$this->assignRef('recipient', $recipient);
	$this->vendorEmail = $vendorModel->getVendorEmail($this->vendor->virtuemart_vendor_id);
	$this->layoutName = $tpl;
	$this->setLayout($tpl);
	parent::display();
    }

}

//No Closing Tag
