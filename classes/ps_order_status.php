<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: ps_order_status.php,v 1.4 2005/01/27 19:33:40 soeren_nb Exp $
* @package mambo-phpShop
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.phpshop.org, forums.phpshop.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/


class ps_order_status {
  var $classname = "ps_order_status";
  
  /*
  ** VALIDATION FUNCTIONS
  **
  */

  function validate_add(&$d) {
    
    $db = new ps_DB;
   
    if (!$d["order_status_code"]) {
      $d["error"] = "ERROR:  You this order status type is already defined.";
      return False;
    } 

    return True;    
  }
  
  function validate_delete($d) {
    
    if (!$d["order_status_id"]) {
      $d["error"] = "ERROR:  Please select an order status type to delete.";
      return False;
    }
    else {
      return True;
    }
  }
  
  function validate_update(&$d) {
    $db = new ps_DB;

    if (!$d["order_status_id"]) {
      $d["error"] = "ERROR:  You must select an order status to update.";
      return False;
    }
    if (!$d["order_status_code"]) {
      $d["error"] = "ERROR:  You must enter a order status code.";
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
    $q = "INSERT INTO #__pshop_order_status (vendor_id, order_status_code,";
    $q .= "order_status_name, list_order) ";
    $q .= "VALUES (";
    $q .= "'$ps_vendor_id','";
    $q .= $d["order_status_code"] . "','";
    $q .= $d["order_status_name"] . "','";
    $q .= $d["list_order"] . "')";
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
    $q = "UPDATE #__pshop_order_status SET ";
    $q .= "order_status_code='" . $d["order_status_code"];
    $q .= "',order_status_name='" . $d["order_status_name"];
    $q .= "',list_order='" . $d["list_order"];
    $q .= "' WHERE order_status_id='" . $d["order_status_id"] . "'";
    $q .= " AND vendor_id='$ps_vendor_id'";
    $db->query($q);
    $db->next_record();
    return True;
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
		
		$q = "DELETE from #__pshop_order_status WHERE order_status_id='$record_id'";
		$q .= " AND vendor_id='$ps_vendor_id'";
		$db->query($q);
		return True;
  }


	function list_order_status($order_status_code, $extra="") {
		echo $this->getOrderStatus( $order_status_code, $extra );
	}
	
	function getOrderStatus( $order_status_code, $extra="") {
		$db = new ps_DB;
		
		$q = "SELECT order_status_id, order_status_code, order_status_name FROM #__pshop_order_status ORDER BY list_order";
		$db->query($q);
		$html = "<select name=\"order_status\" class=\"inputbox\" $extra>\n";
		while ($db->next_record()) {
		  $html .= "<option value=\"" . $db->f("order_status_code")."\"";
		  if ($order_status_code == $db->f("order_status_code")) 
			 $html .= " selected=\"selected\">";
		  else
			 $html .= ">";
		  $html .= $db->f("order_status_name") . "</option>\n";
		}
		$html .= "</select>\n";
		
		return $html;
	}

}
?>
