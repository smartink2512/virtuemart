<?php
/**
*
* Data module for shipping carriers
*
* @package	VirtueMart
* @subpackage ShippingCarrier
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

// Load the model framework
jimport( 'joomla.application.component.model');

if(!class_exists('VmModel'))require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'vmmodel.php');

/**
 * Model class for shop shipping carriers
 *
 * @package	VirtueMart
 * @subpackage ShippingCarrier
 * @author RickG
 */
class VirtueMartModelShippingCarrier extends VmModel {

//    /** @var integer Primary key */
//    var $_id;
    /** @var integer Joomla plugin ID */
    var $jplugin_id;
    /** @var integer Vendor ID */
    var $virtuemart_vendor_id;

	/**
	 * constructs a VmModel
	 * setMainTable defines the maintable of the model
	 * @author Max Milbers
	 */
	function __construct() {
		parent::__construct();
		$this->setMainTable('shippingcarriers');
	}

    /**
     * Retrieve the detail record for the current $id if the data has not already been loaded.
     *
     * @author RickG
     */
    function getShippingCarrier() {

		if (empty($this->_data)) {
		    $this->_data = $this->getTable('shippingcarriers');
		    $this->_data->load((int)$this->_id);

		    if(empty($this->_data->virtuemart_vendor_id)){
		    	if(!class_exists('VirtueMartModelVendor')) require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'vendor.php');
		    	$this->_data->virtuemart_vendor_id = VirtueMartModelVendor::getLoggedVendor();;
		    }

		}

		return $this->_data;
    }


    /**
     * Delete all record ids selected
     *
     * @author RickG
     * @return boolean True is the remove was successful, false otherwise.
     */
    function remove() {
	$shippingCarrierIds = JRequest::getVar('cid',  0, '', 'array');
	$table = $this->getTable('shippingcarriers');

	foreach($shippingCarrierIds as $shippingCarrierId) {
	    if ($this->deleteShippingCarrierRates($shippingCarrierId)) {
		if (!$table->delete($shippingCarrierId)) {
		    $this->setError($table->getError());
		    return false;
		}
	    }
	    else {
		$this->setError('Could not remove shipping carrier rates!');
		return false;
	    }
	}

	return true;
    }


    /**
     * Delete all rate records for a given shipping carrier id.
     *
     * @author RickG
     * @return boolean True is the remove was successful, false otherwise.
     */
    function deleteShippingCarrierRates($carrierId = '') {
	if ($carrierId) {
	    $db = JFactory::getDBO();

	    $query = 'DELETE FROM `#__virtuemart_shippingrates`  WHERE `shipping_rate_carrier_id` = "' . $carrierId . '"';
	    $db->setQuery($query);
	    if ($db->query()) {
		return true;
	    }
	    else {
		return false;
	    }
	}
	else {
	    return false;
	}
    }


    /**
     * Retireve a list of shipping carriers from the database.
     *
     * @author RickG
     * @return object List of shipping carrier objects
     */
    public function getShippingCarriers() {
	$query = 'SELECT * FROM `#__virtuemart_shippingcarriers` ';
	$query .= 'ORDER BY `#__virtuemart_shippingcarriers`.`virtuemart_shippingcarrier_id`';
	$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
	return $this->_data;
    }


    /**
     * @deprecated Use the plugins instead
     * @author Max Milbers
     * @return a associative List
     */
	public function getShippingCarrierRates($weight=0, $country=0, $zip=0) {

		$query = 'SELECT * FROM `#__virtuemart_shippingcarriers` ';
		$query .= 'ORDER BY `#__virtuemart_shippingcarriers`.`ordering`';
		$carrierList = $this->_getList($query);

		$db = JFactory::getDBO();
		$list;
		$i=(int)0;

		foreach ($carrierList as $key=>$value) {
			$query = 'SELECT * FROM `#__virtuemart_shippingrates` WHERE `shipping_rate_carrier_id`="'.$value->virtuemart_shippingcarrier_id.'" ';
			if(!empty($weight)){
				$query .= 'AND `shipping_rate_weight_start` <="'.$weight.'" AND `shipping_rate_weight_end` > "'.$weight.'"';
			}
			if(!empty($zip)){
				$query .= 'AND `shipping_rate_zip_start` <="'.$zip.'" AND `shipping_rate_zip_end` > "'.$zip.'"';
			}

			//todo country and dimension
//			if(!empty($country)){
//				$countries = explode(';', $this->_data->shipping_rate_country);
//				$query .= 'AND (`shipping_rate_country` ="'.$country.'" OR `shipping_rate_country` ="" )';
//			}

			$db->setQuery($query);
			if ($db->query()) {
				echo '<br /><br />';

				$list[$value->shipping_carrier_name]=$db->loadAssocList();
				echo '<br />';
//				return true;
	    	}
		}
		return $list;
    }
    	/**
	 * Bind the post data to the paymentmethod tables and save it
     *
     * @author Max Milbers
     * @return boolean True is the save was successful, false otherwise.
	 */
    public function store()
	{
		$data = JRequest::get('post');
		//dump();
		if(isset($data['params'])){
			$params = new JParameter('');
			$params->bind($data['params']);
			$data['shipping_carrier_params'] = $params->toString();
		}
		if($data['virtuemart_vendor_id']) $data['virtuemart_vendor_id'] = $data['virtuemart_vendor_id'];

	  	if(empty($data['virtuemart_vendor_id'])){
	  	   	if(!class_exists('VirtueMartModelVendor')) require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'vendor.php');
	   		$data['virtuemart_vendor_id'] = VirtueMartModelVendor::getLoggedVendor();
	  	}
		// missing string FIX, Bad way ?
		if (VmConfig::isJ15()) {
			$tb = '#__plugins';
			$ext_id = 'id';
		} else {
			$tb = '#__extensions';
			$ext_id = 'extension_id';
		}
		$q = 'SELECT `element` FROM `' . $tb . '` WHERE `' . $ext_id . '` = "'.$data['shipping_carrier_jplugin_id'].'"';
		$this->_db->setQuery($q);
		$data['shipping_carrier_element'] = $this->_db->loadResult();

		$table = $this->getTable('shippingcarriers');
                if (!$table->bindChecknStore($data)) {
			$this->setError($table->getError());
		}

		return $table->virtuemart_shippingcarrier_id;
	}

}

//no closing tag
