<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: ps_tax.php,v 1.3 2005/09/27 17:48:50 soeren_nb Exp $
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

class ps_tax {
  var $classname = "ps_tax";
  
  /*
  ** VALIDATION FUNCTIONS
  **
  */

  function validate_add(&$d) {
    
    $db = new ps_DB;
    if( TAX_MODE != '1' ) {
      $q = "SELECT * from #__{vm}_tax_rate WHERE tax_state='" . $d["tax_state"] . "'";
      $db->query($q);
      if ($db->next_record()) {
        $d["error"] = "ERROR:  This state is already listed.";
        return False;
      } 
    }
    if (!$d["tax_state"]) {
      $d["error"] = "ERROR:  You must enter a state or region for this tax rate.";
      return False;	
    }
    if (!$d["tax_country"]) {
      $d["error"] = "ERROR:  You must enter a country for this tax rate.";
      return False;
    }
    if (!$d["tax_rate"]) {
      $d["error"] = "ERROR:  You must enter a tax rate.";
      return False;
    }

    return True;    
  }
  
  function validate_delete($d) {
    
    if (!$d["tax_rate_id"]) {
      $d["error"] = "ERROR:  Please select a tax rate to delete.";
      return False;
    }
    else {
      return True;
    }
  }
  
  function validate_update(&$d) {
    $db = new ps_DB;

    if (!$d["tax_rate_id"]) {
      $d["error"] = "ERROR:  You must select a tax rate to update.";
      return False;
    }
    if (!$d["tax_state"]) {
      $d["error"] = "ERROR:  You must enter a state or region for this tax rate.";
      return False;
    }
    if (!$d["tax_country"]) {
      $d["error"] = "ERROR:  You must enter a country for this tax rate.";
      return False;
    }
    if (!$d["tax_rate"]) {
      $d["error"] = "ERROR:  You must enter a tax rate.";
      return False;
    }
    return True;
  }
  
  
  /**************************************************************************
   * name: add()
   * created by: pablo
   * description: creates a new tax rate record
   * parameters:
   * returns:
   **************************************************************************/
  function add(&$d) {
    $db = new ps_DB; 
    $ps_vendor_id = $_SESSION["ps_vendor_id"];
    $timestamp = time();
    
    if (!$this->validate_add($d)) {
      return False;
    }
    $q = "INSERT INTO #__{vm}_tax_rate (vendor_id, tax_state, tax_country, ";
    $q .= "tax_rate, mdate) VALUES (";
    $q .= "'$ps_vendor_id','";
    $q .= $d["tax_state"] . "','";
    $q .= $d["tax_country"] . "','";
    $q .= $d["tax_rate"] . "','";
    $q .= $timestamp . "')";
    $db->query($q);
    $db->next_record();
    return True;

  }
  
  /**************************************************************************
   * name: update()
   * created by: pablo
   * description: updates function information
   * parameters:
   * returns:
   **************************************************************************/
  function update(&$d) {
    $db = new ps_DB; 
    $ps_vendor_id = $_SESSION["ps_vendor_id"];
    $timestamp = time();

    if (!$this->validate_update($d)) {
      return False;	
    }
    $q = "UPDATE #__{vm}_tax_rate SET ";
    $q .= "tax_state='" . $d["tax_state"];
    $q .= "',tax_country='" . $d["tax_country"];
    $q .= "',tax_rate='" . $d["tax_rate"];
    $q .= "',mdate='" . $timestamp;
    $q .= "' WHERE tax_rate_id='" . $d["tax_rate_id"] . "'";
    $q .= " AND vendor_id='$ps_vendor_id'";
    $db->query($q);
    $db->next_record();
    return True;
  }

  /**************************************************************************
   * name: delete()
   * created by: pablo
   * description: Should delete a category and and categories under it.
   * parameters: 
   * returns:
   **************************************************************************/
	/**
	* Controller for Deleting Records.
	*/
	function delete(&$d) {
	
		if (!$this->validate_delete($d)) {
		  return False;
		}
		
		$record_id = $d["tax_rate_id"];
		
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
		
		$q = "DELETE from #__{vm}_tax_rate where tax_rate_id='$record_id'";
		$q .= " AND vendor_id='$ps_vendor_id'";
		$db->query($q);
		$db->next_record();
		return True;
	}
  
  /**************************************************************************
   ** name: list_tax_value
   ** created by: Ekkehard Domning
   ** description: creates a HTML List of the tax values
   ** parameters: select_name : the name of the select form,
   **             selected_value_id : ID of the selected Item
   ** returns: An array containng all Tax Rates
   ***************************************************************************/
  function list_tax_value($select_name, $selected_value_id) {
    global $VM_LANG;
    $db = new ps_DB;

    // Get list of Values
    $q = "SELECT * FROM #__{vm}_tax_rate ORDER BY tax_rate_id ASC";
    $db->query($q);
    
    $html = "<select class=\"inputbox\" name=\"$select_name\">\n";
    if ($select_name == "shipping_rate_vat_id" || stristr($select_name, "tax_class") || $select_name == "zone_tax_rate") 
      $html .= "<option value=\"0\">" . $VM_LANG->_PHPSHOP_INFO_MSG_VAT_ZERO_LBL . "</option>\n";
    $tax_rates = Array();
    while ($db->next_record()) {
      $tax_rates[$db->f("tax_rate_id")] = $db->f("tax_rate");
      $html .= "<option value=\"";
      $html .= $db->f("tax_rate_id")."\"";
      if ($db->f("tax_rate_id")==$selected_value_id) {
         $html .= " selected=\"selected\" ";
      }
      $html .= ">";
      $html .= $db->f("tax_rate_id") . " (" . $db->f("tax_rate")*100 . "%)";
      $html .= "</option>\n";

    }
    /* This makes you able to select "no tax" for a product - so if you need it, uncomment it.
        Then you must edit get_taxrate in ps_product too.
    if ($select_name == "product_tax_id") 
      $html .= "<option value=\"0\">" . _PHPSHOP_INFO_MSG_VAT_ZERO_LBL . "</option>\n";
    */
    $html .= "</select>\n";
    echo $html;
    
    return $tax_rates;
  }
  
  /**************************************************************************
  ** name: get_taxrate_by_id()
  ** created by: soeren
  ** description: Return the Tax Rate with the given id
  **            
  ** parameters: none
  ** returns: the Tax rate as 0.XX
  ***************************************************************************/
   function get_taxrate_by_id( $tax_rate_id ) {

    $db = new ps_DB;   

    $q = "SELECT tax_rate FROM #__{vm}_tax_rate WHERE tax_rate_id='$tax_rate_id'"; 
    $db->query($q);
    if ($db->next_record()) {
       $rate = $db->f("tax_rate");
       return $rate;
    }
    else
       return(0);
  }
        
}
?>
