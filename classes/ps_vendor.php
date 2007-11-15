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

class ps_vendor {
	var $classname = "ps_vendor";
	var $error;


	/**************************************************************************
	** name: validate_add()
	** created by:
	** description:
	** parameters:
	** returns:
	***************************************************************************/
	function validate_add(&$d) {
		global $vmLogger;
		
		$db = new ps_DB;
		require_once(CLASSPATH . 'imageTools.class.php' );
		
		if (!vmImageTools::validate_image($d,"vendor_thumb_image","vendor")) {
			return false;
		}
		if (!vmImageTools::validate_image($d,"vendor_full_image","vendor")) {
			return false;
		}
		if (!$d["vendor_name"]) {
			$vmLogger->err( 'You must enter a name for the vendor.' );
			return False;
		}
		if (!$d["contact_email"]) {
			$vmLogger->err( 'You must enter an email address for the vendor contact.');
			return False;
		}
		if (!vmValidateEmail($d["contact_email"])) {
			$vmLogger->err( 'Please provide a valide email address for the vendor contact.' );
			return False;
		}
		else {
			return True;
		}
	}

	/**************************************************************************
	** name: validate_delete()
	** created by:
	** description:
	** parameters:
	** returns:
	***************************************************************************/
	function validate_delete( $vendor_id, &$d) {
		global $vmLogger;
		$db = new ps_DB;

		if (!$d["vendor_id"]) {
			$vmLogger->err( 'Please select a vendor to delete.' );
			return False;
		}

		$q = "SELECT vendor_id FROM #__{vm}_product where vendor_id='$vendor_id'";
		$db->query($q);
		if ($db->next_record()) {
			$vmLogger->err( 'This vendor still has products. Delete all products first.' );
			return False;
		}

		/* Get the image filenames from the database */
		$db = new ps_DB;
		$q  = "SELECT vendor_thumb_image,vendor_full_image ";
		$q .= "FROM #__{vm}_vendor ";
		$q .= "WHERE vendor_id='$vendor_id'";
		$db->query($q);
		$db->next_record();
		
		require_once(CLASSPATH . 'imageTools.class.php' );
		/* Validate vendor_thumb_image */
		$d["vendor_thumb_image_curr"] = $db->f("vendor_thumb_image");
		$d["vendor_thumb_image_name"] = "none";
		if (!vmImageTools::validate_image($d,"vendor_thumb_image","vendor")) {
			return false;
		}

		/* Validate vendor_full_image */
		$d["vendor_full_image_curr"] = $db->f("vendor_full_image");
		$d["vendor_full_image_name"] = "none";
		if (!vmImageTools::validate_image($d,"vendor_full_image","vendor")) {
			return false;
		}

		return True;
	}

	/**************************************************************************
	** name: validate_update()
	** created by:
	** description:
	** parameters:
	** returns:
	***************************************************************************/
	function validate_update(&$d) {
		global $vmLogger;
		require_once(CLASSPATH . 'imageTools.class.php' );
		if (!vmImageTools::validate_image($d,"vendor_thumb_image","vendor")) {
			return false;
		}
		if (!vmImageTools::validate_image($d,"vendor_full_image","vendor")) {
			return false;
		}

		// convert all "," in prices to decimal points.
		if (stristr($d["vendor_min_pov"],",")) {
			$d["vendor_min_pov"] = str_replace(',', '.', $d["vendor_min_pov"]);
		}

		if (!$d["vendor_name"]) {
			$vmLogger->err( 'You must enter a name for the vendor.' );
			return False;
		}
		if (!$d["contact_email"]) {
			$vmLogger->err( 'You must enter an email address for the vendor contact.');
			return False;
		}
		if (!vmValidateEmail($d["contact_email"])) {
			$vmLogger->err( 'Please provide a valide email address for the vendor contact.' );
			return False;
		}
		
		return True;
		
	}

	/**
	 * Adds a Vendor Record
	 *
	 * @param array $d
	 * @return boolean
	 */
	function add(&$d) {
		global $vendor_currency;
		$db = new ps_DB;
		$timestamp = time();

		if (!$this->validate_add($d)) {
			return False;
		}
		
		if (!vmImageTools::process_images($d)) {
			return false;
		}
		$d['display_style'][1] = ps_vendor::checkCurrencySymbol( $d['display_style'][1] );
		
		$d['display_style'] = implode("|", $d['display_style'] );
		
		if( empty( $d['vendor_accepted_currencies'] )) {
			$d['vendor_accepted_currencies'] = array( $vendor_currency );
		}
		$fields = array( 'vendor_name' => $d["vendor_name"],
						'contact_last_name' => $d["contact_last_name"],
						'contact_first_name' => $d["contact_first_name"],
						'contact_middle_name' => $d["contact_middle_name"],
						'contact_title' => $d["contact_title"],
						'contact_phone_1' => $d["contact_phone_1"],
						'contact_phone_2' => $d["contact_phone_2"],
						'contact_fax' => $d["contact_fax"],
						'contact_email' => $d["contact_email"],
						'vendor_phone' => $d["vendor_phone"],
						'vendor_address_1' => $d["vendor_address_1"],
						'vendor_address_2' => $d["vendor_address_2"],
						'vendor_city' => $d["vendor_city"],
						'vendor_state' => $d["vendor_state"],
						'vendor_country' => $d["vendor_country"],
						'vendor_zip' => $d["vendor_zip"],
						'vendor_store_name' => $d["vendor_store_name"],
						'vendor_store_desc' => $d["vendor_store_desc"],
						'vendor_category_id' => $d["vendor_category_id"],
						'vendor_image_path' => $d["vendor_image_path"],
						'vendor_thumb_image' => $d["vendor_thumb_image"],
						'vendor_full_image' => $d["vendor_full_image"],
						'vendor_currency' => $d["vendor_currency"],
						'vendor_url' => $d["vendor_url"],
						'cdate' => $timestamp,
						'mdate' => $timestamp,
						'vendor_terms_of_service' => $d["vendor_terms_of_service"],
						'vendor_min_pov' => $d["vendor_min_pov"],
						'vendor_currency_display_style' => $d["display_style"],
						'vendor_freeshipping' => $d['vendor_freeshipping'],
						'vendor_accepted_currencies' => implode( ',', $d['vendor_accepted_currencies'] ),
						'vendor_address_format' => $d['vendor_address_format'],
						'vendor_date_format' => $d['vendor_date_format']
						);
						
		$db->buildQuery('INSERT', '#__{vm}_vendor', $fields );
		$db->query();

		// Get the assigned vendor_id //
		$_REQUEST['vendor_id'] = $db->last_insert_id();
		
		$GLOBALS['vmLogger']->info('The Vendor has been added.');
		
		/* Insert default- shopper group */
		$q = "INSERT INTO #__{vm}_shopper_group (";
		$q .= "`vendor_id`,";
		$q .= "`shopper_group_name`,";
		$q .= "`shopper_group_desc`,`default`) VALUES ('";
		$q .= $d["vendor_id"] . "',";
		$q .= "'-default-',";
		$q .= "'Default shopper group for ".$d["vendor_name"]."','1')";
		$db->query($q);
		
		return True;
	}
	/**
	 * Updates a Vendor (and the Store) Record
	 *
	 * @param array $d
	 * @return boolean
	 */
	function update(&$d) {
		global $vendor_currency;
		$db = new ps_DB;
		$timestamp = time();

		if (!$this->validate_update($d)) {
			return False;
		}

		if (!vmImageTools::process_images($d)) {
			return false;
		}
		foreach ($d as $key => $value) {
			if (!is_array($value))
			$d[$key] = addslashes($value);
		}
		
		$d['display_style'][1] = ps_vendor::checkCurrencySymbol( $d['display_style'][1] );
		$d['display_style'] = implode("|", $d['display_style'] );
		
		if( empty( $d['vendor_accepted_currencies'] )) {
			$d['vendor_accepted_currencies'] = array( $vendor_currency );
		}
		$fields = array( 'vendor_name' => $d["vendor_name"],
						'contact_last_name' => $d["contact_last_name"],
						'contact_first_name' => $d["contact_first_name"],
						'contact_middle_name' => $d["contact_middle_name"],
						'contact_title' => $d["contact_title"],
						'contact_phone_1' => $d["contact_phone_1"],
						'contact_phone_2' => $d["contact_phone_2"],
						'contact_fax' => $d["contact_fax"],
						'contact_email' => $d["contact_email"],
						'vendor_phone' => $d["vendor_phone"],
						'vendor_address_1' => $d["vendor_address_1"],
						'vendor_address_2' => $d["vendor_address_2"],
						'vendor_city' => $d["vendor_city"],
						'vendor_state' => $d["vendor_state"],
						'vendor_country' => $d["vendor_country"],
						'vendor_zip' => $d["vendor_zip"],
						'vendor_store_name' => $d["vendor_store_name"],
						'vendor_store_desc' => $d["vendor_store_desc"],
						'vendor_thumb_image' => $d["vendor_thumb_image"],
						'vendor_full_image' => $d["vendor_full_image"],
						'vendor_currency' => $d["vendor_currency"],
						'vendor_url' => $d["vendor_url"],
						'mdate' => $timestamp,
						'vendor_terms_of_service' => $d["vendor_terms_of_service"],
						'vendor_min_pov' => $d["vendor_min_pov"],
						'vendor_currency_display_style' => $d["display_style"],
						'vendor_freeshipping' => $d['vendor_freeshipping'],
						'vendor_accepted_currencies' => implode( ',', $d['vendor_accepted_currencies'] ),
						'vendor_address_format' => $d['vendor_address_format'],
						'vendor_date_format' => $d['vendor_date_format']
						);
		if (!empty($d["vendor_category_id"])) {
			$fields['vendor_category_id'] = $d["vendor_category_id"];
		}
		if (!empty($d["vendor_image_path"])) {
			$fields['vendor_image_path'] = $d["vendor_image_path"];
		}
		
		$db->buildQuery( 'UPDATE', '#__{vm}_vendor', $fields, 'WHERE vendor_id = '.$d["vendor_id"] );
		$db->query();
		if( $d['vendor_id'] == 1 ) {
			$GLOBALS['vmLogger']->info('Your Store has been updated.');
		} else {
			$GLOBALS['vmLogger']->info('The Vendor has been updated.');
		}
		
		return True;
	}

	/**************************************************************************
	* name: delete()
	* created by:
	* description:
	* parameters:
	* returns:
	**************************************************************************/
	/**
	* Controller for Deleting Records.
	*/
	function delete(&$d) {

		$record_id = $d["_id"];

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

		if (!$this->validate_delete( $record_id, $d)) {
			return False;
		}

		/* Delete Image files */
		if (!vmImageTools::process_images($d)) {
			return false;
		}

		$q = "DELETE FROM #__{vm}_vendor where vendor_id='$record_id'";
		$db->query($q);


		return True;
	}
	
	/**
	 * Checks a currency symbol wether it is a HTML entity.
	 * When not and $convertToEntity is true, it converts the symbol
	 *
	 * @param string $symbol
	 */
	function checkCurrencySymbol( $symbol, $convertToEntity=true ) {
		
		$symbol = str_replace('&amp;', '&', $symbol );
		
		if( substr( $symbol, 0, 1) == '&' && substr( $symbol, strlen($symbol)-1, 1 ) == ';') {
			return $symbol;
		}
		else {
			if( $convertToEntity ) {
				$symbol = htmlentities( $symbol, ENT_QUOTES, 'utf-8' );
				
				if( substr( $symbol, 0, 1) == '&' && substr( $symbol, strlen($symbol)-1, 1 ) == ';') {
					return $symbol;
				}		
				// Sometimes htmlentities() doesn't return a valid HTML Entity
				switch( ord( $symbol ) ) {
					case 128:
					case 63:
						$symbol = '&euro;';
						break;
				}
						
			}
		}
		
		return $symbol;
	}
	/**************************************************************************
	** name: get_user_vendor_id
	** created by: jep
	** description:
	** parameters:
	** returns:
	***************************************************************************/
	function get_user_vendor_id() {
		$auth = $_SESSION['auth'];

		$db = new ps_DB;

		$q  = "SELECT vendor_id FROM #__{vm}_auth_user_vendor ";
		$q .= "WHERE user_id='" . $auth["user_id"] . "'";
		$db->query($q);
		$db->next_record();
		return $db->f("vendor_id");
	}

	/**************************************************************************
	* name: find()
	* created by:
	* description:
	* parameters:
	* returns:
	**************************************************************************/
	function find($d, $start=0) {
		$db = new ps_DB;

		if ($d["vendor_thumb_image"] == "none") {
			$d["vendor_thumb_image"] = "";
		}
		if ($d["vendor_full_image"] == "none") {
			$d["vendor_full_image"] = "";
		}

		if ($d["vendor_category_id"] == "0") {
			$d["vendor_category_id"] = "";
		}
		$q = "SELECT * FROM #__{vm}_vendor where vendor_name LIKE '%" . $d["vendor_name"] . "%'";
		$q .= " AND contact_last_name LIKE '%" . $d["contact_last_name"] . "%'";
		$q .= " AND contact_first_name LIKE '%" . $d["contact_first_name"] . "%'";
		$q .= " AND contact_middle_name LIKE '%" . $d["contact_middle_name"] . "%'";
		$q .= " AND contact_title LIKE '%" . $d["contact_title"] . "%'";
		$q .= " AND contact_phone_1 LIKE '%" . $d["contact_phone_1"] . "%'";
		$q .= " AND contact_phone_2 LIKE '%" . $d["contact_phone_2"] . "%'";
		$q .= " AND contact_fax LIKE '%" . $d["contact_fax"] . "%'";
		$q .= " AND contact_email LIKE '%" . $d["contact_email"] . "%'";
		$q .= " AND vendor_phone LIKE '%" . $d["vendor_phone"] . "%'";
		$q .= " AND vendor_address_1 LIKE '%" . $d["vendor_address_1"] . "%'";
		$q .= " AND vendor_address_2 LIKE '%" . $d["vendor_address_2"] . "%'";
		$q .= " AND vendor_city LIKE '%" . $d["vendor_city"] . "%'";
		$q .= " AND vendor_state LIKE '%" . $d["vendor_state"] . "%'";
		$q .= " AND vendor_country LIKE '%" . $d["vendor_country"] . "%'";
		$q .= " AND vendor_zip LIKE '%" . $d["vendor_zip"] . "%'";
		$q .= " AND vendor_store_name LIKE '%" . $d["vendor_store_name"] . "%'";
		$q .= " AND vendor_store_desc LIKE '%" . $d["vendor_store_desc"] . "%'";
		$q .= " AND vendor_category_id LIKE '%" . $d["vendor_category_id"] . "%'";
		$q .= " AND vendor_thumb_image LIKE '%" . $d["vendor_thumb_image"] . "%'";
		$q .= " AND vendor_full_image LIKE '%" . $d["vendor_full_image"] . "%'";
		$q .= " AND vendor_currency LIKE '%" . $d["vendor_currency"] . "%'";

		$db->query($q);
		$db->next_record();
		if ($db->num_rows() == 1) {
			return "?vid=" . $db->f("vendor_id");
		}

		return True;
	}

	/**
	 * Retrieves the name of a vendor specified by $vendor_id
	 *
	 * @param int $vendor_id
	 * @param int $product_id
	 * @return String
	 */
	function get_name($vendor_id,$product_id="") {

		// Returns the vendor name corresponding to a vendor_id;
		$db = new ps_DB;

		if ($vendor_id) {
			$q = "SELECT vendor_name FROM #__{vm}_vendor WHERE vendor_id = '$vendor_id'";
		} elseif ($product_id) {
			$q  = "SELECT vendor_name FROM #__{vm}_product,#__{vm}_vendor ";
			$q .= "WHERE product_id = '$product_id' ";
			$q .= "AND #__{vm}_product.vendor_id = #__{vm}_vendor.vendor_id ";
		} else {
			/* ERROR: No arguments were specified. */
			return 0;
		}

		$db->query($q);
		$db->next_record();
		return $db->f("vendor_name");
	}


	/**************************************************************************
	* name: set_vendor()
	* created by:
	* description: Creates a list of SELECT recods using vendor name and vendor id.
	* parameters:
	* returns: array of values
	**************************************************************************/
	function set_vendor($d) {
		global  $sess;
		$ps_vendor_id = $_SESSION["ps_vendor_id"];

		$ps_vendor_id = $d["vendor_id"];
		return True;

	}

	/**************************************************************************
	** name: listVendor()
	** created by:
	** description: Creates a list of SELECT recods using vendor name and
	**              vendor id.
	** parameters:
	** returns: array of values
	***************************************************************************/
	function list_vendor($vendor_id=0) {
		global $sess;
		$ps_vendor_id = $_SESSION["ps_vendor_id"];

		// Creates a form drop down list and prints it
		$db = new ps_DB;

		$q = "SELECT count(*) as rowcnt FROM #__{vm}_vendor ORDER BY vendor_name";
		$db->query($q);
		$db->next_record();
		$rowcnt = $db->f("rowcnt");

		// If only one vendor do not show list
		if ($rowcnt == 1)
		return True;

		$q = "SELECT * FROM #__{vm}_vendor ORDER BY vendor_name";
		$db->query($q);

		$code = "<form action=\"" . SECUREURL . "\" method=\"post\">\n";
		$code .= "<input type=\"hidden\" name=\"page\" value=\"admin.index\" />\n";
		$code .= "<input type=\"hidden\" name=\"func\" value=\"setvendor\" />\n";
		$code .= "<input type=\"hidden\" name=\"option\" value=\"com_virtuemart\" />\n";
		$code .= "<select name=\"vendor_id\">\n";
		while ($db->next_record()) {
			$code .= "  <option value=\"" . $db->f("vendor_id") . "\"";
			if ($db->f("vendor_id") == $vendor_id) {
				$code .= " selected";
			}
			$code .= ">" . $db->f("vendor_name") . "</option>\n";
		}
		$code .= "</select><BR>\n";
		$code .= "<input type=\"submit\" name=\"go\" value=\"go\">\n";
		$code .= "</font>";
		print $code;
	}


	/**************************************************************************
	** name: get_field
	** created by: pablo
	** description:
	** parameters:
	** returns:
	***************************************************************************/
	function get_field($vendor_id, $field_name) {
		$db = new ps_DB;

		$q = "SELECT $field_name FROM #__{vm}_vendor WHERE vendor_id='$vendor_id'";
		$db->query($q);
		if ($db->next_record()) {
			return $db->f($field_name);
		}
		else {
			return False;
		}
	}


	/**************************************************************************
	** name: show_image()
	** created by: pablo
	** description:  Shows the image send in the $image field.
	**               $args are appended to the IMG tag.
	** parameters:
	** returns:
	***************************************************************************/
	function show_image($image, $args="") {

		$ps_vendor_id = $_SESSION["ps_vendor_id"];

		$url = IMAGEURL;
		$path = $this->get_field($ps_vendor_id,"vendor_image_path");
		if (!empty($path))
		$url = str_replace( "shop_image/", $path, $url );

		$url .= "vendor/";
		$url .= $image;
		echo "<img src=\"".$url ."\" ". $args ." />\n";

		return True;
	}
	/**
	* @param string The vendor_currency_display_code
	*   FORMAT: 
    1: id, 
    2: CurrencySymbol, 
    3: NumberOfDecimalsAfterDecimalSymbol,
    4: DecimalSymbol,
    5: Thousands separator
    6: Currency symbol position with Positive values :
									// 0 = '00Symb'
									// 1 = '00 Symb'
									// 2 = 'Symb00'
									// 3 = 'Symb 00'
    7: Currency symbol position with Negative values :
									// 0 = '(Symb00)'
									// 1 = '-Symb00'
									// 2 = 'Symb-00'
									// 3 = 'Symb00-'
									// 4 = '(00Symb)'
									// 5 = '-00Symb'
									// 6 = '00-Symb'
									// 7 = '00Symb-'
									// 8 = '-00 Symb'
									// 9 = '-Symb 00'
									// 10 = '00 Symb-'
									// 11 = 'Symb 00-'
									// 12 = 'Symb -00'
									// 13 = '00- Symb'
									// 14 = '(Symb 00)'
									// 15 = '(00 Symb)'
    	EXAMPLE: ||&euro;|2|,||1|8
	* @return string
	*/
	function get_currency_display_style( $style ) {
	
		$array = explode( "|", $style );
		$display = Array();
		$display["id"] = @$array[0];
		$display["symbol"] = @$array[1];
		$display["nbdecimal"] = @$array[2];
		$display["sdecimal"] = @$array[3];
		$display["thousands"] = @$array[4];
		$display["positive"] = @$array[5];
		$display["negative"] = @$array[6];
		return $display;
	}
	/**
	 * Returns the formatted Store Address
	 *
	 * @param boolean $use_html
	 * @return String
	 */
	function formatted_store_address( $use_html=false ) {
		global $vendor_store_name, $vendor_address, $vendor_address_2, $vendor_city,
		$vendor_state, $vendor_zip, $vendor_phone, $vendor_fax, $vendor_mail, $vendor_country, $vendor_url;
		
		$address_details['name'] = $vendor_store_name;
		$address_details['address_1'] = $vendor_address;
		$address_details['address_2'] = $vendor_address_2;
		$address_details['state'] = $vendor_state;
		$address_details['city'] = $vendor_city;
		$address_details['zip'] = $vendor_zip;
		$address_details['country'] = $vendor_country;
		$address_details['phone'] = $vendor_phone;
		$address_details['email'] = $vendor_mail;
		$address_details['fax'] = $vendor_fax;
		$address_details['url'] = $vendor_url;
		
		return vmFormatAddress( $address_details, $use_html );
	}
}
?>
