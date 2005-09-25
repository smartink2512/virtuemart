<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: ps_product_discount.php,v 1.3 2005/01/27 19:33:40 soeren_nb Exp $
* @package mambo-phpShop
*
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

/****************************************************************************
*
* CLASS DESCRIPTION
*                   
* ps_product_discount
*
* The class is is used to manage the discounts in your store.
* 
*	
*
*************************************************************************/
 class ps_product_discount {
   var $classname = "ps_product_discount";
   var $error;
   
  /**************************************************************************
  ** name: validate_add()
  ** created by:
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/  
   function validate_add($d) {
     
     $db = new ps_DB;
     
     if (!$d["amount"]) {
       $this->error = "ERROR:  You must enter an amount for the Discount.";
       return False;	
     }
     if( $d["is_percent"]=="" ) {
       $this->error = "ERROR:  You must enter an amount type for the Discount.";
       return False;	
     }
     return True;    
   }

  /**************************************************************************
  ** name: validate_update
  ** created by:
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/   
  function validate_update($d) {
    
    if (!$d["amount"]) {
      $this->error = "ERROR:  You must enter an amount for the Discount.";
      return False;	
    }
    if( $d["is_percent"]=="" ) {
      $this->error = "ERROR:  You must enter an amount type for the Discount.";
      return False;	
    }
    if (!$d["discount_id"]) {
      $this->error = "ERROR:  You must specifiy a discount to Update.";
      return False;	
    }
   return true;
  }
    
  /**************************************************************************
  ** name: validate_delete()
  ** created by:
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/   
  function validate_delete($d) {
    
    if (!$d["discount_id"]) {
      $this->error = "ERROR:  Please select a Discount to delete.";
      return False;
    }
    else {
      return True;
    }
  }
  
  
  /**************************************************************************
   * name: add()
   * created by: pablo
   * description: creates a new discount record
   * parameters:
   * returns:
   **************************************************************************/
  function add(&$d) {

    $db = new ps_DB;
    
    if (!$this->validate_add($d)) {
      $d["error"] = $this->error;
      return False;
    }
    if (!empty($d["start_date"])) {
        $day = substr ( $d["start_date"], 8, 2);
        $month= substr ( $d["start_date"], 5, 2);
        $year =substr ( $d["start_date"], 0, 4);
        $d["start_date"] = mktime(0,0,0,$month, $day, $year);
    }
    else {
      $d["start_date"] = "";
    }
    if (!empty($d["end_date"])) {
        $day = substr ( $d["end_date"], 8, 2);
        $month= substr ( $d["end_date"], 5, 2);
        $year =substr ( $d["end_date"], 0, 4);
        $d["end_date"] = mktime(0,0,0,$month, $day, $year);
    }
    else {
      $d["end_date"] = "";
    }
    
    $q = "INSERT INTO #__pshop_product_discount (amount, is_percent, start_date, end_date)";
    $q .= " VALUES ('";
    $q .= $d["amount"] . "','";
    $q .= $d["is_percent"] . "','";
    $q .= $d["start_date"] . "','";
    $q .= $d["end_date"] . "')";
    $db->setQuery($q);
    $db->query();
    
    return True;

  }
  
  /**************************************************************************
   * name: update()
   * created by: pablo
   * description: updates discount information
   * parameters:
   * returns:
   **************************************************************************/
  function update(&$d) {
    $db = new ps_DB;


    if (!$this->validate_update($d)) {
      $d["error"] = $this->error;
      return False;	
    }
    if (!empty($d["start_date"])) {
        $day = substr ( $d["start_date"], 8, 2);
        $month= substr ( $d["start_date"], 5, 2);
        $year =substr ( $d["start_date"], 0, 4);
        $d["start_date"] = mktime(0,0,0,$month, $day, $year);
    }
    else {
      $d["start_date"] = "";
    }
    if (!empty($d["end_date"])) {
        $day = substr ( $d["end_date"], 8, 2);
        $month= substr ( $d["end_date"], 5, 2);
        $year =substr ( $d["end_date"], 0, 4);
        $d["end_date"] = mktime(0,0,0,$month, $day, $year);
    }
    else {
      $d["end_date"] = "";
    }
    
    $q = "UPDATE #__pshop_product_discount SET ";
    $q .= "amount='" . $d["amount"]."',";
    $q .= "is_percent='" . $d["is_percent"]."',";
    $q .= "start_date='" . $d["start_date"]."', ";
    $q .= "end_date='" . $d["end_date"]."' ";
    $q .= "WHERE discount_id='".$d["discount_id"]."'";
    $db->setQuery($q);
    $db->query();
    
    return True;
  }

	/**
	* Controller for Deleting Records.
	*/
	function delete(&$d) {
		
		if (!$this->validate_delete($d)) {
			$d["error"]=$this->error;
			return False;
		}
		$record_id = $d["discount_id"];
		
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
		
		$q = "DELETE FROM #__pshop_product_discount WHERE discount_id='record_id'";
		$db->query($q);
		
		return True;
	}
  
  /**************************************************************************
   * name: discount_list()
   * created by: soeren
   * description: Builds a select list of all discount records.
   * parameters: 
   * returns:
   **************************************************************************/
  function discount_list( $discount_id='' ) {
    global $PHPSHOP_LANG;
    $db = new ps_DB;
    $html = "";
    $db->query( "SELECT * FROM #__pshop_product_discount" );
    
    if($db->num_rows() > 0) {
      $html = "<select name=\"product_discount_id\" class=\"inputbox\">\n";
      $html .= "<option value=\"0\">".$PHPSHOP_LANG->_PHPSHOP_INFO_MSG_VAT_ZERO_LBL."</option>\n";
      while( $db->next_record() ) {
        $selected = $db->f("discount_id") == $discount_id ? "selected=\"selected\"" : "";
        $html .= "<option value=\"".$db->f("discount_id")."\" $selected>".$db->f("amount");
        $html .= $db->f("is_percent")=="1" ? "%" : $_SESSION['vendor_currency'];
        $html .= "</option>\n";
      }
      $html .= "</select>\n";
    }
    else {
      $html = "<input type=\"hidden\" name=\"product_discount_id\" value=\"0\" />\n
      <a href=\"".$_SERVER['PHP_SELF']."\" target=\"_blank\">".$PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_ADDDISCOUNT_TIP."</a>";
    }
    return $html;
  }
}

?>
