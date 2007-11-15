<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
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
 * The class is is used to manage the manufacturers in your store.
 *
 */
class ps_manufacturer {

	/**
	 * Validates the Input Parameters onBeforeManufacturerAdd
	 *
	 * @param array $d
	 * @return boolean
	 */
	function validate_add($d) {

		$db = new ps_DB;

		if (empty($d["mf_name"])) {
			$GLOBALS['vmLogger']->err( 'You must enter a name for the manufacturer.' );
			return False;
		}
		else {
			$q = "SELECT count(*) as rowcnt from #__{vm}_manufacturer where";
			$q .= " mf_name='" .  $db->getEscaped($d["mf_name"]) . "'";
			$db->query($q);
			$db->next_record();
			if ($db->f("rowcnt") > 0) {
				$GLOBALS['vmLogger']->err( 'The given manufacturer name already exists.' );
				return False;
			}
		}
		return True;
	}
	/**
	 * Validates the Input Parameters onBeforeManufacturerUpdsate
	 *
	 * @param array $d
	 * @return boolean
	 */
	function validate_update($d) {

		if (empty($d["mf_name"])) {
			$GLOBALS['vmLogger']->err( 'You must enter a name for the manufacturer.' );
			return False;
		}

		return true;
	}
	/**
	 * Validates the Input Parameters onBeforeManufacturerDelete
	 *
	 * @param array $d
	 * @return boolean
	 */
	function validate_delete($mf_id) {
		global $db;

		if (empty( $mf_id )) {
			$GLOBALS['vmLogger']->err( 'Please select a manufacturer to delete.' );
			return False;
		}
		$db->query( "SELECT jos_vm_product.product_id, manufacturer_id
						FROM jos_vm_product, jos_vm_product_mf_xref
						WHERE manufacturer_id =".intval($mf_id)."
						AND jos_vm_product.product_id = jos_vm_product_mf_xref.product_id" );
		if( $db->num_rows() > 0 ) {
			$GLOBALS['vmLogger']->err( 'This Manufacturer still has products assigned to it.' );
			return false;
		}
		return True;

	}

	/**
	 * creates a new manufacturer record
	 *
	 * @param array $d
	 * @return boolean
	 */
	function add(&$d) {

		$db = new ps_DB;
		
		$GLOBALS['vmInputFilter']->safeSQL( $d );
		
		if (!$this->validate_add($d)) {
			return false;
		}
		$fields = array( 'mf_name' => vmGet( $d, 'mf_name' ),
					'mf_email' => vmGet( $d, 'mf_email' ),
					'mf_desc' => vmGet( $d, 'mf_desc', VMREQUEST_ALLOWHTML ),
					'mf_category_id' => vmRequest::getInt('mf_category_id'),
					'mf_url' => vmGet( $d, 'mf_url')
		);
		$db->buildQuery('INSERT', '#__{vm}_manufacturer', $fields );
		if( $db->query() !== false ) {
			$GLOBALS['vmLogger']->info('The Manufacturer has been added.');
			$_REQUEST['manufacturer_id'] = $db->last_insert_id();
			return true;	
		}
		return false;

	}

	/**
	 * updates manufacturer information
	 *
	 * @param array $d
	 * @return boolean
	 */
	function update(&$d) {
		$db = new ps_DB;
		$timestamp = time();

		$GLOBALS['vmInputFilter']->safeSQL( $d );
		
		if (!$this->validate_update($d)) {
			return False;
		}
		$fields = array( 'mf_name' => vmGet( $d, 'mf_name' ),
					'mf_email' => vmGet( $d, 'mf_email' ),
					'mf_desc' => vmGet( $d, 'mf_desc', VMREQUEST_ALLOWHTML ),
					'mf_category_id' => vmRequest::getInt('mf_category_id'),
					'mf_url' => vmGet( $d, 'mf_url')
		);
		$db->buildQuery('UPDATE', '#__{vm}_manufacturer', $fields, 'WHERE manufacturer_id='.(int)$d["manufacturer_id"] );
		if( $db->query() ) {
			$GLOBALS['vmLogger']->info('The Manufacturer has been updated.');
			return true;	
		}
		return false;
	}

	/**
	* Controller for Deleting Records.
	*/
	function delete(&$d) {

		$record_id = $d["manufacturer_id"];

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
		if (!$this->validate_delete($record_id)) {
			$d["error"]=$this->error;
			return False;
		}
		$q = 'DELETE from #__{vm}_product_mf_xref WHERE manufacturer_id='.(int)$record_id.' LIMIT 1';
		$db->query($q);
		$q = 'DELETE from #__{vm}_manufacturer WHERE manufacturer_id='.(int)$record_id.' LIMIT 1';
		$db->query($q);
		return True;
	}

}

?>