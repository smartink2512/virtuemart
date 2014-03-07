<?php
/**
 *
 * Controller for the front end User maintenance
 *
 * @package	VirtueMart
 * @subpackage User
 * @author Oscar van Eijk
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

// Load the controller framework
jimport('joomla.application.component.controller');

/**
 * VirtueMart Component Controller
 *
 * @package		VirtueMart
 */
class VirtueMartControllerUser extends JControllerLegacy
{

	public function __construct()
	{
		parent::__construct();
		$this->useSSL = VmConfig::get('useSSL',0);
		$this->useXHTML = false;
		VmConfig::loadJLang('com_virtuemart_shoppers',TRUE);
	}

	/**
	 * Override of display to prevent caching
	 *
	 * @return  JController  A JController object to support chaining.
	 */
	public function display(){

		$document = JFactory::getDocument();
		$viewType = $document->getType();
		$viewName = VmRequest::getCmd('view', 'user');
		$viewLayout = VmRequest::getCmd('layout', 'default');

		$view = $this->getView($viewName, $viewType, '', array('layout' => $viewLayout));
		$view->assignRef('document', $document);

		$view->display();

		return $this;
	}


	function editAddressCart(){
		$view = $this->getView('user', 'html');

		$view->setLayout('edit_address');

		if (!class_exists('VirtueMartCart')) require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		$cart = VirtueMartCart::getCart();
		$cart->fromCart = true;
		$cart->setCartIntoSession();
		// Display it all
		$view->display();

	}


	/**
	 * This is the save function for the normal user edit.php layout.
	 *
	 * @author Max Milbers
	 */
	function saveUser(){

		if (!class_exists('VirtueMartCart')) require(JPATH_VM_SITE . DS . 'helpers' . DS . 'cart.php');
		$cart = VirtueMartCart::getCart();

		$layout = VmRequest::getCmd('layout','edit');

		$msg = $this->saveData($cart);
		if($cart->fromCart or $cart->getInCheckOut()){
			$task = '';
			if ($cart->getInCheckOut()){
				$task = '&task=checkout';
			}
			$this->setRedirect(JRoute::_('index.php?option=com_virtuemart&view=cart'.$task, FALSE) , $msg);
		} else {
			$this->setRedirect( JRoute::_('index.php?option=com_virtuemart&view=user&layout='.$layout, FALSE), $msg );
		}

	}

	function saveAddressST(){

		$msg = $this->saveData(false);
		$layout = 'edit';// VmRequest::getCmd('layout','edit');
		$this->setRedirect( JRoute::_('index.php?option=com_virtuemart&view=user&layout='.$layout, FALSE), $msg );

	}

	/**
	 * Save the user info. The saveData function don't use the userModel store function for anonymous shoppers, because it would register them.
	 * We make this function private, so we can do the tests in the tasks.
	 *
	 * @author Max Milbers
	 * @author Valérie Isaksen
	 *
	 * @param boolean Defaults to false, the param is for the userModel->store function, which needs it to determine how to handle the data.
	 * @return String it gives back the messages.
	 */
	private function saveData($cartObj) {
		$mainframe = JFactory::getApplication();
		$currentUser = JFactory::getUser();
		$msg = '';

		$data = vmRequest::getPost();

		if($cartObj){
			if($cartObj->fromCart or $cartObj->getInCheckOut()){
				$cart = true;
			} else {
				$cart = false;
			}
		} else {
			$cart = false;
		}


		if (isset($_POST['register'])) {
			$register = true;
		} else {
			$register = false;
		}


		$data['address_type'] = VmRequest::getCmd('addrtype','BT');

		if(!$register and !$cart and $data['address_type'] == 'ST'){
			$onlyAddress = true;
		} else {
			$onlyAddress = false;
		}


		if($currentUser->guest!=1 || $register){
			$userModel = VmModel::getModel('user');

			if(!$cart){
				// Store multiple selectlist entries as a ; separated string
				if (array_key_exists('vendor_accepted_currencies', $data) && is_array($data['vendor_accepted_currencies'])) {
					$data['vendor_accepted_currencies'] = implode(',', $data['vendor_accepted_currencies']);
				}

				$data['vendor_store_name'] = VmRequest::getHtml('vendor_store_name');
				$data['vendor_store_desc'] = VmRequest::getHtml('vendor_store_desc');
				$data['vendor_terms_of_service'] = VmRequest::getHtml('vendor_terms_of_service');
				$data['vendor_letter_css'] = VmRequest::getHtml('vendor_letter_css');
				$data['vendor_letter_header_html'] = VmRequest::getHtml('vendor_letter_header_html');
				$data['vendor_letter_footer_html'] = VmRequest::getHtml('vendor_letter_footer_html');
			}

			//It should always be stored
			if($onlyAddress){
				$ret = $userModel->storeAddress($data);
			} else {
				$ret = $userModel->store($data);
			}
			if($currentUser->guest==1){
				$msg = (is_array($ret)) ? $ret['message'] : $ret;
				$usersConfig = JComponentHelper::getParams( 'com_users' );
				$useractivation = $usersConfig->get( 'useractivation' );

				if (is_array($ret) and $ret['success'] and !$useractivation) {
					// Username and password must be passed in an array
					$credentials = array('username' => $ret['user']->username,
			  					'password' => $ret['user']->password_clear
					);
					$return = $mainframe->login($credentials);
				} else if(VmConfig::get('oncheckout_only_registered',0)){
					$layout = VmRequest::getCmd('layout','edit');
					$this->redirect( JRoute::_('index.php?option=com_virtuemart&view=user&layout='.$layout, FALSE), $msg );
				}

			}

		}

		if(!class_exists('VirtueMartCart')) require(JPATH_VM_SITE.DS.'helpers'.DS.'cart.php');
		$cart = VirtueMartCart::getCart();
		$cart->saveAddressInCart($data, $data['address_type']);
		return $msg;
	}


	/**
	 * Action cancelled; return to the previous view
	 *
	 * @author Max Milbers
	 */
	function cancel()
	{
		if(!class_exists('VirtueMartCart')) require(JPATH_VM_SITE.DS.'helpers'.DS.'cart.php');
		$cart = VirtueMartCart::getCart();
		vmdebug('cancel executed' );
		if($cart->fromCart){
			$this->setRedirect( JRoute::_('index.php?option=com_virtuemart&view=cart', FALSE)  );
		} else {
			$return = JURI::base();
			$this->setRedirect( $return );
		}

	}


	function removeAddressST(){

		$virtuemart_userinfo_id = VmRequest::getInt('virtuemart_userinfo_id');

		//Lets do it dirty for now
		$userModel = VmModel::getModel('user');
		$userModel->removeAddress($virtuemart_userinfo_id);

		$layout = VmRequest::getCmd('layout','edit');
		$this->setRedirect( JRoute::_('index.php?option=com_virtuemart&view=user&layout='.$layout, $this->useXHTML,$this->useSSL) );
	}
}
// No closing tag
