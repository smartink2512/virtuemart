<?php
/**
 *
 * Data module for the order status
 *
 * @package	VirtueMart
 * @subpackage OrderStatus
 * @author Oscar van Eijk
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: orderstatus.php 6350 2012-08-14 17:18:08Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


if(!class_exists('VmModel'))require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'vmmodel.php');

/**
 * Model class for the order status
 *
 * @package	VirtueMart
 * @subpackage OrderStatus
 * @author Oscar van Eijk
 */
class VirtueMartModelOrderstatus extends VmModel {

	private $_renderStatusList = array();
	/**
	 * constructs a VmModel
	 * setMainTable defines the maintable of the model
	 * @author Max Milbers
	 */
	function __construct() {
		parent::__construct();
		VmConfig::loadJLang('com_virtuemart_orders',TRUE);
		$this->setMainTable('orderstates');
	}

	function getVMCoreStatusCode(){
		return array( 'P','S');
	}

	/**
	 * Retrieve a list of order statuses from the database.
	 *
	 * @return object List of order status objects
	 */
	function getOrderStatusList()
	{

		if (JRequest::getWord('view') !== 'orderstatus') $ordering = ' order by `ordering` ';
		else $ordering = $this->_getOrdering();
		$this->_noLimit=true;
		$this->_data = $this->exeSortSearchListQuery(0,'*',' FROM `#__virtuemart_orderstates`','','',$ordering);
		// 		vmdebug('order data',$this->_data);
		return $this->_data ;
	}
	/**
	 * Return the order status names
	 *
	 * @author Kohl Patrick
	 * @access public
	 *
	 * @param char $_code Order status code
	 * @return string The name of the order status
	 */
	public function getOrderStatusNames ()
	{
		$q = 'SELECT `order_status_name`,`order_status_code` FROM `#__virtuemart_orderstates` order by `ordering` ';
		$this->_db->setQuery($q);
		return $this->_db->loadAssocList('order_status_code');

	}

	function renderOSList($value,$name = 'order_status',$multiple=FALSE,$attrsIn=0,$langkey=''){

		$idA = $id = $name;

		$attrs = ' class="inputbox" ';
		if ($multiple) {
			$attrs .= ' multiple="multiple" ';
			if(empty($langkey)) $langkey = 'COM_VIRTUEMART_DRDOWN_SELECT_SOME_OPTIONS';
			$idA .= '[]';
		} else {
			if(empty($langkey)) $langkey = 'COM_VIRTUEMART_DRDOWN_SELECT_SOME_OPTIONS';

		}

		$chosenDropDowns = FALSE;
		if ($chosenDropDowns) {
			vmJsApi::chosenDropDowns();
			$attrs .=  ' data-placeholder="'.JText::_($langkey).'"';
		}

		if(is_array($value)){
			$hashValue = implode($value);
		} else {
			$hashValue = $value;
		}

		$hash = md5($hashValue.$name.$attrs);
		if (!isset($this->_renderStatusList[$hash])) {
			$orderStates = $this->getOrderStatusNames();
			if (!$multiple) {
				$emptyOption = JHTML::_ ('select.option', 0, JText::_ ('COM_VIRTUEMART_LIST_EMPTY_OPTION'), $id, 'order_status_name');
				array_unshift ($orderStates, $emptyOption);
			} else {
				$attrs .=' size="'.count($orderStates).'" ';
			}
			if($attrsIn!==0){
				$attrs = $attrsIn;
			}
			$this->_renderStatusList[$hash] = JHTML::_('select.genericlist', $orderStates, $idA, $attrs, 'order_status_code', 'order_status_name', $value,$id,true);
		}
		return $this->_renderStatusList[$hash] ;
	}

	function renderOrderStatusList($value, $name = 'order_status[]' )
	{
		$id = substr($name,0,-2);
		return $this->renderOSList($value,$id,TRUE);
		$attrs = 'multiple="multiple"';

		if (!isset($this->_renderStatusList[$name])) {
			$orderStates = $this->getOrderStatusNames();
			$this->_renderStatusList[$name] = JHTML::_('select.genericlist', $orderStates, $name, 'multiple="multiple" data-placeholder="'.JText::_('COM_VIRTUEMART_DRDOWN_SELECT_SOME_OPTIONS').'"', 'order_status_code', 'order_status_name', $value,$id,true);
		}
		return $this->_renderStatusList[$name] ;
	}

}

//No Closing tag
