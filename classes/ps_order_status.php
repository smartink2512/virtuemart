<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

/**
 * The class for managing order status entries
 *
 */
class ps_order_status extends vmAbstractObject {

	var $_key = 'order_status_id';
	var $_table_name = '#__{vm}_order_status';
	
	var $_protected_status_codes = array( 'P', 'C', 'X' );
	
	function ps_order_status() {
		$this->addRequiredField( array( 'order_status_code', 'order_status_name') );
		$this->addUniqueField( 'order_status_code');
	}
	
	/*
	** VALIDATION FUNCTIONS
	**
	*/

	function validate_add(&$d) {

		return $this->validate( $d );
	}

	function validate_update(&$d) {
		
		if( !$this->validate( $d ) ) {
			return false;
		}
		$db = $this->get(intval($d["order_status_id"]));
		if( $db->f('order_status_code')) {
			$order_status_code = $db->f('order_status_code');
			// Check if the Order Status Code of protected Order Statuses is to be changed
			if( in_array( $order_status_code, $this->_protected_status_codes ) && $order_status_code != $d["order_status_code"] ) {
				$vmLogger->err( 'This Order Status Code cannot be changed, it is one of the core status codes.' );
				return False;
			}
			if( $order_status_code != $d["order_status_code"] ) {
				// If the order Status Code has changed, we need to update all orders with this order status to use the new Status Code
				$dbo = new ps_DB();
				$dbo->query('UPDATE #__{vm}_orders SET 
										order_status=\''.$dbo->getEscaped($d["order_status_code"]).'\'
										WHERE order_status=\''.$order_status_code.'\'');
				
			}
			return true;
		} else {
			return false;
		}
		
	}

	function validate_delete($d) {

		if (empty($d["order_status_id"])) {
			$vmLogger->err( 'Please select an order status type to delete.' );
			return False;
		}
		$db = $this->get(intval($d["order_status_id"]));
		if( $db->f('order_status_code')) {
			$order_status_code = $db->f('order_status_code');
			if( in_array( $order_status_code, $this->_protected_status_codes ) ) {
				$vmLogger->err( 'This Order Status cannot be deleted, it is one of the core status codes.' );
				return False;
			}
			$dbo = new ps_DB();
			$dbo->query('SELECT order_id FROM #__{vm}_orders WHERE order_status=\''.$order_status_code.'\' LIMIT 1');
			if( $dbo->next_record() ) {
				$vmLogger->err( 'This Order Status cannot be deleted, there are still Orders with this Status.' );
				return False;
			}
		}
		return True;

	}

	/**
	 * creates a new Order Status
	 * @author soeren, pablo
	 * @param array $d
	 * @return boolean
	 */
	function add(&$d) {
		$db = new ps_DB;
		$ps_vendor_id = $_SESSION["ps_vendor_id"];

		if (!$this->validate_add($d)) {
			return False;
		}
		$fields = array( 'vendor_id' => $ps_vendor_id,
						'order_status_code' => vmGet($d, 'order_status_code' ),
						'order_status_name' => vmGet($d, 'order_status_name' ),
						'order_status_description' => vmGet($d, 'order_status_description' ),
						'list_order' => vmRequest::getInt('list_order' )
					);
		$db->buildQuery( 'INSERT', $this->_table_name, $fields );
		
		$result = $db->query();
		
		if( $result ) {
			$GLOBALS['vmLogger']->info('The Order Status Type has been added.');
			$d["order_status_id"] = $_REQUEST['order_status_id'] = $db->last_insert_id();
		} else {
			$GLOBALS['vmLogger']->err('Adding the Order Status Type has failed.');
		}
		return $result;

	}

	/**
	 * Updates an Order Status
	 *
	 * @param array $d
	 * @return boolean
	 */
	function update(&$d) {
		$db = new ps_DB;
		$ps_vendor_id = $_SESSION["ps_vendor_id"];

		if (!$this->validate_update($d)) {
			return False;
		}
		$fields = array(	'order_status_code' => vmGet($d, 'order_status_code' ),
						'order_status_name' => vmGet($d, 'order_status_name' ),
						'order_status_description' => vmGet($d, 'order_status_description' ),
						'list_order' => vmRequest::getInt('list_order' )
					);
		$db->buildQuery( 'UPDATE', $this->_table_name, $fields, "WHERE order_status_id=".(int)$d["order_status_id"]." AND vendor_id=$ps_vendor_id" );
		
		if( $db->query() !== false ) {
			$GLOBALS['vmLogger']->info('The Order Status Type has been updated.');
			return true;
		}
		return false;
	}

	/**
	* Controller for Deleting Records.
	*/
	function delete(&$d) {

		if (!$this->validate_delete($d)) {
			return False;
		}
		$record_id = $d["order_status_id"];

		if( is_array( $record_id)) {
			foreach( $record_id as $record) {
				if( !$this->delete_record( $record, $d ))
				return false;
			}
			return true;
		}
		else {
			return $this->delete_record( $record_id, $d );
		}
	}
	/**
	* Deletes one Record.
	*/
	function delete_record( $record_id, &$d ) {
		global $db;
		$ps_vendor_id = $_SESSION["ps_vendor_id"];

		$q = 'DELETE FROM `'.$this->_table_name.'` WHERE order_status_id='.(int)$record_id;
		$q .= " AND vendor_id='$ps_vendor_id'";
		
		return $db->query($q);
	}


	function list_order_status($order_status_code, $extra="") {
		echo $this->getOrderStatus( $order_status_code, $extra );
	}
	/**
	 * Returns a DropDown List of all available Order Status Codes
	 *
	 * @param string $order_status_code
	 * @param string $extra
	 * @return string
	 */
	function getOrderStatus( $order_status_code, $extra="") {
		$db = new ps_DB;

		$q = "SELECT order_status_id, order_status_code, order_status_name FROM #__{vm}_order_status ORDER BY list_order";
		$db->query($q);
		$array = array();
		while ($db->next_record()) {
			$array[$db->f("order_status_code")] = $db->f("order_status_name");
		}
		return ps_html::selectList( 'order_status', $order_status_code, $array, 1, '', $extra );
	}
	/**
	 * Returns the order status name for a given order status code
	 *
	 * @param string $order_status_code
	 * @return string
	 */
	function getOrderStatusName( $order_status_code ) {
		$db = new ps_DB;

		$q = "SELECT order_status_id, order_status_name FROM #__{vm}_order_status WHERE `order_status_code`='".$order_status_code."'";
		$db->query($q);
		$db->next_record();
		return $db->f("order_status_name");
	}
}
?>