<?php

if (!defined('_JEXEC')) {
	die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
}

/**
 * @author Valerie Isaksen
 * @package    VirtueMart
 * @subpackage Plugins
 * @copyright Copyright (C) 2014 iStraxx - All rights reserved.
 * @license license.txt Proprietary License. This code belongs to iStraxx UG
 * You are not allowed to distribute or sell this code. You bought only a license to use it for ONE virtuemart installation.
 * You are allowed to modify this code for your installation.
 */

if (!class_exists('vmUserfieldPlugin')) {
	require(JPATH_VM_PLUGINS . DS . 'vmuserfieldtypeplugin.php');
}
define('USERFIELD_REALEX', 1);
class plgVmUserfieldRealex extends vmUserfieldPlugin
{

	var $varsToPush = array();

	const REALEX_FOLDERNAME = "realex";

	function __construct(& $subject, $config)
	{

		parent::__construct($subject, $config);

		$this->_loggable = TRUE;
		$this->tableFields = array_keys($this->getTableSQLFields());
		$this->_tablepkey = 'id';
		$this->_tableId = 'id';
		$this->setConfigParameterable('params', $this->varsToPush);
		$this->_userFieldName = 'realex';
	}

	/**
	 * @return string
	 */
	public function getVmPluginCreateTableSQL()
	{

		$db = JFactory::getDBO();
		$query = 'SHOW TABLES LIKE "%' . str_replace('#__', '', $this->_tablename) . '"';
		$db->setQuery($query);
		$result = $db->loadResult();
		$app = JFactory::getApplication();
		$tablesFields = 0;
		if ($result) {
			$SQLfields = $this->getTableSQLFields();
			$loggablefields = $this->getTableSQLLoggablefields();
			$tablesFields = array_merge($SQLfields, $loggablefields);
			$update[$this->_tablename] = array($tablesFields, array(), array());
			vmdebug(get_class($this) . ':: VirtueMart2 update ' . $this->_tablename);
			if (!class_exists('GenericTableUpdater')) {
				require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'tableupdater.php');
			}
			$updater = new GenericTableUpdater();
			$updater->updateMyVmTables($update);
			//	return FALSE;   //TODO enable this, when using vm version higher than 2.0.8F
		} else {
			return $this->createTableSQL('Userfield Realex Realvault Table', $tablesFields);
		}

	}

	/**
	 * @return array
	 */
	function getTableSQLFields()
	{

		$SQLfields = array(
			'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT',
			'virtuemart_user_id' => 'int(1) UNSIGNED',
			'virtuemart_paymentmethod_id' => 'mediumint(1) UNSIGNED',
			'realex_saved_payer_ref' => 'char(50)',
			'realex_saved_pmt_type' => 'varchar(20)',
			'realex_saved_pmt_ref' => 'char(50)',
			'realex_saved_pmt_digits' => 'varchar(128)',
			'realex_saved_pmt_expdate' => 'varchar(5)',
			'realex_saved_pmt_name' => 'char(255)',
		);
		return $SQLfields;
	}

	function plgVmDeclarePluginParamsUserfield($type, $name, $id, &$data)
	{

		return $this->declarePluginParams($type, $name, $id, $data);
	}

	/**
	 * Create the table for this plugin if it does not yet exist.
	 * This functions checks if the called plugin is active one.
	 * When yes it is calling the standard method to create the tables
	 *
	 * @author Valérie Isaksen
	 *
	 */
	function plgVmOnStoreInstallPluginTable($type, $data)
	{

		return $this->onStoreInstallPluginTable($type, $data->name);

	}


	/**
	 * This method is fired when showing the order details in the frontend.
	 * It displays the shipment-specific data.
	 *
	 * @param integer $order_number The order Number
	 * @return mixed Null for shipments that aren't active, text (HTML) otherwise
	 * @author Valérie Isaksen
	 * @author Max Milbers
	 */

	public function plgVmOnUserfieldDisplay($_prefix, $field, $userId, &$return)
	{

		if ('plugin' . $this->_name != $field->type) {
			return;
		}

		$return['fields'][$field->name]['formcode'] .= $this->onShowUserDisplayUserfield($userId, $field->name);

	}

	public function plgVmOnPaymentDisplay($fieldtype, $userId, &$storedCreditCards)
	{

		if ('plugin' . $this->_name != $fieldtype) {
			return;
		}

		$storedCreditCards = $this->getStoredCreditCards($userId);


	}

	public function plgVmPrepareUserfieldDataSave($fieldType, $fieldName, $post, &$value, $params)
	{

		if ('plugin' . $this->_name != $fieldType) {
			return;
		}
		if (JFactory::getUser()->guest) {
			return;
		}
		$card_delete_ids = JRequest::getVar('realex_card_delete_ids', array(), 'post', 'array');
		$card_update_ids = JRequest::getVar('realex_card_update_ids', array(), 'post', 'array');
		if (!empty($card_delete_ids)) {
			return $this->deleteStoredCards($card_delete_ids);
		}
		if (!empty($card_update_ids)) {
			return $this->updateStoredCards($card_update_ids);
		}
		if (!class_exists('ShopFunctions')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'shopfunctions.php');
		}
// we come from payment
		if (isset($params['realex_saved_payer_ref'])) {
			$this->storePluginInternalData($params);
		}

	}

	/**
	 * Delete a stored card
	 * To remove a card from the RealVault system
	 */
	function deleteStoredCards($card_ids)
	{
		$user = JFactory::getUser();
		$db = JFactory::getDBO();
		foreach ($card_ids as $card_id) {

			JLoader::import('joomla.plugin.helper');
			JPluginHelper::importPlugin('vmpayment');
			$app = JFactory::getApplication();

			$storedCC = $this->getStoredCCInfo($card_id);
			$success = false;
			// the trigger will send the card-cancel-card to Releax
			$app->triggerEvent('plgVmOnRealexDeletedStoredCard', array('realex', $storedCC, &$success));
			if ($success) {
				$query = 'DELETE FROM `' . $this->_tablename . '` WHERE `id`=' . $card_id . ' AND `virtuemart_user_id`=' . $storedCC['virtuemart_user_id'];
				$db->setQuery($query);
				$db->query();
				vmInfo('VMUSERFIELD_REALEX_CARD_DELETED');

			} else {
				$vendorId = 1;
				$vendor_link = JRoute::_('index.php?option=com_virtuemart&view=vendor&layout=contact&virtuemart_vendor_id=' . $vendorId);
				vmInfo(vmText::sprintf('VMUSERFIELD_REALEX_CARD_NOT_DELETED', $vendor_link));

			}

		}
	}

	/**
	 * Delete a stored card
	 * To remove a card from the RealVault system
	 */
	function updateStoredCards($card_ids)
	{
		$user = JFactory::getUser();
		$db = JFactory::getDBO();
		foreach ($card_ids as $card_id) {

			JLoader::import('joomla.plugin.helper');
			JPluginHelper::importPlugin('vmpayment');
			$app = JFactory::getApplication();

			$storedCC = $this->getStoredCCInfo($card_id);
			$updatedCCname = vRequest::getString('cc_name_' . $card_id);
			$updatedYear = vRequest::getInt('cc_expire_year_' . $card_id);
			$updatedMonth = vRequest::getInt('cc_expire_month_' . $card_id);
			$expDate = explode('/', $storedCC['realex_saved_pmt_expdate']);
			if (($storedCC['realex_saved_pmt_name'] == $updatedCCname) AND ($expDate[1] == $updatedYear) AND ($expDate[0] == $updatedMonth)) {
				continue;
			} else {
				$storedCC['realex_saved_pmt_name'] = $updatedCCname;
				$storedCC['realex_saved_pmt_expdate'] = $updatedMonth . $updatedYear;
			}
			$success = false;
			// the trigger will send the card-cancel-card to Releax
			$app->triggerEvent('plgVmOnRealexUpdateStoredCard', array('realex', $storedCC, &$success));
			if ($success) {

				$query = 'UPDATE  `' . $this->_tablename . '` SET `realex_saved_pmt_name`="' . $storedCC['realex_saved_pmt_name'] . '" , `realex_saved_pmt_expdate`="' . $updatedMonth . '/' . $updatedYear . '" WHERE `id`=' . $card_id . ' AND `virtuemart_user_id`=' . $storedCC['virtuemart_user_id'];
				$db->setQuery($query);
				$db->query();
				vmInfo('VMUSERFIELD_REALEX_CARD_UPDATED');

			} else {
				$vendorId = 1;
				$vendor_link = JRoute::_('index.php?option=com_virtuemart&view=vendor&layout=contact&virtuemart_vendor_id=' . $vendorId);
				vmInfo(vmText::sprintf('VMUSERFIELD_REALEX_CARD_NOT_UPDATED', $vendor_link));

			}

		}
	}

	function onShowUserDisplayUserfield($userId, $fieldName)
	{
		if ($userId == 0) {
			return;
		}
		$display_fields = array(
			'realex_saved_pmt_type',
			'realex_saved_pmt_digits',
			'realex_saved_pmt_expdate',
			'realex_saved_pmt_name'
		);


		$storedCreditCards = $this->getStoredCreditCards($userId);
		if (empty ($storedCreditCards)) {
			return vmText::_('VMUSERFIELD_REALEX_NO_CARD_SAVED');
		}
		$storedCreditCards = $this->isValidExpiredDate($storedCreditCards);


		if (!class_exists('VmHTML')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'html.php');
		}
		$view = vRequest::getString('view', '');
		$deleteUpdateAuthorized = false;

		if ($view == 'user' OR JFactory::getApplication()->isSite()) {
			$deleteUpdateAuthorized = true;
		}
		$this->loadJLang('plg_vmpayment_realex', 'vmpayment');

		$html = $this->renderByLayout("creditcardlist", array("storedCreditCards" => $storedCreditCards,
			'deleteUpdateAuthorized' => $deleteUpdateAuthorized
		));


		return $html;
	}

	private function getStoredCreditCards($userId)
	{
		if (!($storedCreditCards = $this->_getInternalData($userId))) {
			return '';
		}

		return $storedCreditCards;

	}

	/**
	 * check if the expired Date is ok
	 * @param $storedCreditCards
	 */
	function isValidExpiredDate($creditCards)
	{
		if (!class_exists('Creditcard')) {
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'creditcard.php');
		}
		foreach ($creditCards as $creditCard) {
			$exp_date = explode("/", $creditCard->realex_saved_exp_date);
			$creditCard->validExpiredDate = Creditcard::validate_credit_card_date('', $exp_date[0], $exp_date[0]);
		}
		return $creditCards;
	}


	/**
	 * @param        $virtuemart_order_id
	 * @param string $order_number
	 * @return mixed|string
	 */
	function _getInternalData($userId)
	{

		$db = JFactory::getDBO();
		$q = 'SELECT * FROM `' . $this->_tablename . '` WHERE ';
		$q .= ' `virtuemart_user_id` = "' . $userId . '"';
		$q .= ' ORDER BY `modified_on` DESC ';

		$db->setQuery($q);
		return $db->loadObjectList();

	}

	/**
	 * @param        $virtuemart_order_id
	 * @param string $order_number
	 * @return mixed|string
	 */
	function getStoredCCInfo($card_id)
	{

		$db = JFactory::getDBO();
		$q = 'SELECT * FROM `' . $this->_tablename . '` ';
		$q .= ' WHERE `id`=' . $card_id;

		$db->setQuery($q);
		return $db->loadAssoc();

	}


}

// No closing tag
