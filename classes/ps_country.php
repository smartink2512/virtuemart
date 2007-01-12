<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

/****************************************************************************
*
* CLASS DESCRIPTION
*
* ps_country
*
* The class is is used to manage the countries in your store.
*
* properties:
*
*       error - the error message returned by validation if any
* methods:
*       validate_add()
*	validate_delete()
*	validate_update()
*       add()
*       update()
*       delete()
*
*
*************************************************************************/
class ps_country {
	var $classname = "ps_country";
	var $error;

	/**************************************************************************
	** name: validate_add()
	** created by:
	** description:
	** parameters:
	** returns:
	***************************************************************************/
	function validate_add($d) {
		global $vmLogger;
		$db = new ps_DB;

		if (!$d["country_name"]) {
			$vmLogger->err( "You must enter a name for the country." );
			return False;
		}
		if (!$d["country_2_code"]) {
			$vmLogger->err( "You must enter a 2 symbol code for the country." );
			return False;
		}
		if (!$d["country_3_code"]) {
			$vmLogger->err( 'You must enter a 3 symbol code for the country.' );
			return False;
		}

		if ($d["country_name"]) {
			$q = "SELECT count(*) as rowcnt from #__{vm}_country where";
			$q .= " country_name='" .  $d["country_name"] . "'";
			$db->setQuery($q);
			$db->query();
			$db->next_record();
			if ($db->f("rowcnt") > 0) {
				$vmLogger->err( "The given country name already exists." );
				return False;
			}
		}
		return True;
	}

	/**************************************************************************
	** name: validate_delete()
	** created by:
	** description:
	** parameters:
	** returns:
	***************************************************************************/
	function validate_delete($d) {

		if (!$d["country_id"]) {
			$GLOBALS['vmLogger']->err( "Please select a country to delete." );
			return False;
		}
		else {
			return True;
		}
	}

	/**************************************************************************
	** name: validate_update
	** created by:
	** description:
	** parameters:
	** returns:
	***************************************************************************/
	function validate_update($d) {

		if (!$d["country_name"]) {
			$GLOBALS['vmLogger']->err( "You must enter a name for the country." );
			return False;
		}
		if (!$d["country_2_code"]) {
			$GLOBALS['vmLogger']->err( "You must enter a 2 symbol code for the country." );
			return False;
		}
		if (!$d["country_3_code"]) {
			$GLOBALS['vmLogger']->err( "You must enter a 3 symbol code for the country." );
			return False;
		}
		return true;
	}


	/**************************************************************************
	* name: add()
	* created by: pablo
	* description: creates a new country record
	* parameters:
	* returns:
	**************************************************************************/
	function add(&$d) {

		$db = new ps_DB;

		if (!$this->validate_add($d)) {
			$d["error"] = $this->error;
			return False;
		}
		$fields = array('country_name' => $d["country_name"], 
					'zone_id' => $d["zone_id"], 
					'country_2_code' => $d["country_2_code"], 
					'country_3_code' => $d["country_3_code"] );

		$db->buildQuery('INSERT', '#__{vm}_country', $fields );
		if( $db->query() ) {
			$GLOBALS['vmLogger']->info('The country has been added.');
			$_REQUEST['country_id'] = $db->last_insert_id();
			return True;
		}
		
		return false;

	}

	/**************************************************************************
	* name: update()
	* created by: pablo
	* description: updates country information
	* parameters:
	* returns:
	**************************************************************************/
	function update(&$d) {
		$db = new ps_DB;
		$timestamp = time();

		if (!$this->validate_update($d)) {
			$d["error"] = $this->error;
			return False;
		}
		$fields = array('country_name' => $d["country_name"], 
					'zone_id' => $d["zone_id"], 
					'country_2_code' => $d["country_2_code"], 
					'country_3_code' => $d["country_3_code"] );

		$db->buildQuery('UPDATE', '#__{vm}_country', $fields, "WHERE country_id='".(int)$d["country_id"]."'" );
		if( $db->query() ) {
			$GLOBALS['vmLogger']->info('The country has been updated.');
			return True;
		}
		return false;
	}

	/**************************************************************************
	* name: delete()
	* created by: pablo
	* description: Should delete a country record.
	* parameters:
	* returns:
	**************************************************************************/
	function delete(&$d) {
		$db = new ps_DB;

		if (!$this->validate_delete($d)) {
			$d["error"]=$this->error;
			return False;
		}
		if( is_array( $d["country_id"])) {
			foreach($d["country_id"] as $country ) {
				$q = 'DELETE FROM #__{vm}_country WHERE country_id='.(int)$country;
				$db->query($q);
			}
		}
		else {
			$q = 'DELETE FROM #__{vm}_country WHERE country_id=' . (int)$d["country_id"];
			$db->query($q);
		}
		return True;
	}
	/**
	 * Adds a new state entry for a country specified by country_id
	 *
	 * @param array $d
	 * @return boolean
	 */
	function addState( &$d ) {

		$db = new ps_DB;
		if ( empty($d['country_id']) ) {
			$GLOBALS['vmLogger']->err('No country was selected for this State' );
			return False;
		}
		$fields = array('state_name' => $d["state_name"], 
					'country_id' => $d["country_id"], 
					'state_2_code' => $d["state_2_code"], 
					'state_3_code' => $d["state_3_code"] );

		$db->buildQuery('INSERT', '#__{vm}_state', $fields );
		if( $db->query() ) {
			$GLOBALS['vmLogger']->info('The state has been added.');
			$_REQUEST['state_id'] = $db->last_insert_id();
			return True;
		}
		return false;

	}
	/**
	 * Updates a state entry
	 *
	 * @param array $d
	 * @return boolean
	 */
	function updateState( &$d ) {
		$db = new ps_DB;

		if (empty($d['state_id']) ||empty($d['country_id']) ) {
			$GLOBALS['vmLogger']->err('Please select a state or country for update!');
			return False;
		}
		$fields = array('state_name' => $d["state_name"], 
					'country_id' => (int)$d["country_id"], 
					'state_2_code' => $d["state_2_code"], 
					'state_3_code' => $d["state_3_code"] );

		$db->buildQuery('UPDATE', '#__{vm}_state', $fields, 'WHERE state_id='.(int)$d["state_id"] );
		if( $db->query() ) {
			$GLOBALS['vmLogger']->info('The state has been updated.');
			return True;
		}
		return false;

	}

	function deleteState( &$d ) {

		$db = new ps_DB;

		if (empty( $d['state_id'])) {
			$$GLOBALS['vmLogger']->err('Please select a state to delete!');
			return false;
		}
		$q = 'DELETE FROM #__{vm}_state where state_id=' . (int)$d["state_id"] . ' LIMIT 1';
		$db->query($q);

		return True;
	}

}

?>
