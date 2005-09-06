<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: ps_shopper.php,v 1.10 2005/08/26 09:32:56 dvorakz Exp $
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
*
*************************************************************************
*
* CLASS DESCRIPTION
*                   
* ps_shopper
*
* The class is meant to manage shopper entries
*
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
class ps_shopper {
  var $classname = "ps_shopper";
  
  /**************************************************************************
  ** name: validate_add()
  ** created by:
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/
  function validate_add(&$d) {
    global $my;
    $valid = true;
    
    while(list($key,$value)=each($d)) {
        if (!is_array($value))
          $d[$key]=trim(strip_tags($value));
    }
    
    if (!$d["address_1"]) {
      $d["error"] .= "'Address 1' is a required field.";
      $valid = false;
    }
    if (!$d["city"]) {
      $d["error"] .= "'City' is a required field.";
      $valid = false;
    }
    if (CAN_SELECT_STATES == '1') {
      if (!$d["state"]) {
        $d["error"] .= "'State/Region' is a required field.";
        $valid = false;
      }
    }
    if (!$d["zip"]) {
      $d["error"] .= "'Zip' is a required field.";
      $valid = false;
    }
    if (!$d["phone_1"]) {
      $d["error"] .= "'Phone Number' is a required field.";
      $valid = false;
    }
    if ($my->id == 0){
      $d["error"] .= "Please Login first.";
      $valid = false;
    }
    /*    $db = new ps_DB;
    $q  = "SELECT * from #__users ";
    $q .= "WHERE id='" .  $d["user_id"] . "'";
    $db->query($q);
    if (!$db->next_record()) {
      $d["error"] .= "The given user doesn't exist in MOS userDB. ";
      $d["error"] .= "ONLY REGISTERED MOS USERS CAN BE ADDED HERE.<br>";
      $valid = false;
    }*/
    return $valid;
  }
  
  /**************************************************************************
  ** name: validate_delete()
  ** created by:
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/
  function validate_delete(&$d) {
      global $my;
      
     
    if ($my->id == 0){
      $d["error"] .= "Please Login first.";
      return false;
    }
    if (!$d["user_id"]) {
      $d["error"] .= "ERROR:  Please select a user to delete.";
      return False;
    }
    else {
      return True;
    }
  }

  /**************************************************************************
  ** name: validate_update()
  ** created by:
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/
  function validate_update(&$d) {
  global $my, $perm;
    $valid = true;
    
    while(list($key,$value)=each($d)) {
        if (!is_array($value))
          $d[$key]=trim(strip_tags($value));
    }
    $_REQUEST['missing'] = "";
    
    if ($my->id == 0){
      $d["error"] .= "Please Login first.";
      $valid = false;
    }
    if (!$d["first_name"]) {
      $_REQUEST['missing'] = "first_name,";
      $valid = false;
    }
    if (!$d["last_name"]) {
      $valid = false;
      $_REQUEST['missing'] .= "last_name,";
    }
    if (!$d["address_1"]) {
      $_REQUEST['missing'] .= "address_1,";
      $valid = false;
    }
    if (!$d["city"]) {
      $valid = false;
      $_REQUEST['missing'] .= "city,";
    }
    if (CAN_SELECT_STATES == '1') {
      if (!$d["state"]) {
        $valid = false;
        $_REQUEST['missing'] .= "state,";
      }
    }
    if (!$d["zip"]) {
      $valid = false;
      $_REQUEST['missing'] .= "zip,";
    }
    if (!$d["country"]) {
      $valid = false;
      $_REQUEST['missing'] .= "country";
    }
    
    return $valid;
  }
  
  /**************************************************************************
   * name: add()
   * created by: pablo, modded by soeren
   * description: adds the shopper - vendor relationship
   * parameters:
   * returns:
   **************************************************************************/
  function add($id, $sg_id, $customer_nr, $vendor_id) {
    global $my, $ps_user;
    
    $db = new ps_DB;
   
    if (empty($sg_id)) {
    
       $q =  "SELECT shopper_group_id from #__pshop_shopper_group WHERE ";
       $q .= "`default`='1' ";
       
       $db->query($q);
       if (!$db->num_rows()) {  // take the first in the table
       
           $q =  "SELECT shopper_group_id from #__pshop_shopper_group";
           $db->query($q);
       }
       $db->next_record();
       $sg_id = $db->f("shopper_group_id");
    }
 
    $q  = "INSERT INTO #__pshop_shopper_vendor_xref ";
    $q .= "(user_id,vendor_id,shopper_group_id,customer_number) ";
    $q .= "VALUES ('$id', '$vendor_id','$sg_id', '$customer_nr')";
    $db->query($q);

    // Insert vendor relationship
    $q = "INSERT INTO #__pshop_auth_user_vendor (user_id,vendor_id)";
    $q .= " VALUES ('$id', '$vendor_id') ";
    $db->query($q);
    
     return True;
    
  }
  
  /**************************************************************************
  ** name: update()
  ** created by:
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/
  function update(&$d) {
    global $my, $perm, $sess;
    
    $auth = $_SESSION['auth'];
        
    $db = new ps_DB;
    

    if ($d["user_id"] != $auth["user_id"] && $auth["perms"] != "admin") {
      $d["error"] = "Tricky tricky, but we know about this one.";
      return False;
    }
    
    
    if (empty($d["extra_field_1"]))
      $d["extra_field_1"] = "";
    if (empty($d["extra_field_2"]))
      $d["extra_field_2"] = "";
    if (empty($d["extra_field_3"]))
      $d["extra_field_3"] = "";
    if (empty($d["extra_field_4"]))
      $d["extra_field_4"] = "N";
    if (empty($d["extra_field_5"]))
      $d["extra_field_5"] = "N";
    
    if (defined('_PSHOP_ADMIN')) {
      
      $q = "SELECT shopper_group_id FROM #__pshop_shopper_vendor_xref ";
      $q .= "WHERE user_id = '".$d['user_id']."'";
      $db->query($q);
      if (!$db->num_rows()) {
          //add
          $q  = "INSERT INTO #__pshop_shopper_vendor_xref ";
          $q .= "(user_id,vendor_id,shopper_group_id,customer_number) ";
          $q .= "VALUES ('";
          $q .= $d['user_id'] . "','".$d['vendor_id']."', '";
          $q .= $d["shopper_group_id"] . "','";
          $q .= $d["customer_number"] . "')";
          $db->query($q);
      
          // Insert vendor relationship
          $q = "INSERT INTO #__pshop_auth_user_vendor (user_id,vendor_id)";
          $q .= " VALUES ";
          $q .= "('" . $d['user_id'] . "','";
          $q .= $d['vendor_id'] . "') ";
          $db->query($q);
      }
      else {
          $q = "UPDATE #__pshop_shopper_vendor_xref SET ";
          $q .= "shopper_group_id='" . $d["shopper_group_id"] . "', ";
          $q .= "vendor_id='" . $d["vendor_id"] . "', ";
          $q .= "customer_number='" . $d["customer_number"] . "' ";
          $q .= "WHERE user_id='" . $d['user_id'] . "'";
          $db->query($q);
          $q = "UPDATE #__pshop_auth_user_vendor SET ";
          $q .= "vendor_id='" . $d["vendor_id"] . "' ";
          $q .= "WHERE user_id='" . $d['user_id'] . "'";
          $db->query($q);
      }
    }
    
    else {
      if (!$this->validate_update($d)) {
        $_SESSION['last_page'] = "checkout.index";
        return false;
      }
      $user_id = $auth["user_id"];
      $q = "SELECT user_info_id FROM #__users ";
      $q .= "WHERE id = '".$user_id."'";
      $db->query($q);

      /* Update Bill To */
      $q  = "UPDATE #__users SET ";
      if ($db->f("user_info_id") == "") {
          $q .= "user_info_id = '".md5 (uniqid (rand()))."',";
      }
      $q .= "address_type='BT' ";
      $q .= ",address_type_name='-default-' ";
      if (!empty($d['company']))
        $q .= ",company='" . $d["company"] . "' ";
      $q .= ",title='" . $d["title"] . "' ";
      $q .= ",last_name='" . $d["last_name"] . "' ";
      $q .= ",first_name='" . $d["first_name"] . "' ";
      if (!empty($d['middle_name']))
        $q .= ",middle_name='" . $d["middle_name"] . "' ";
      $q .= ",phone_1='" . $d["phone_1"] . "' ";
      if (!empty($d['phone_2']))
        $q .= ",phone_2='" . $d["phone_2"] . "'";
      if (!empty($d['fax']))
        $q .= ",fax='" . $d["fax"] . "' ";
      $q .= ",address_1='" . $d["address_1"] . "' ";
      $q .= ",address_2='" . @$d["address_2"] . "' ";
      $q .= ",city='" . $d["city"] . "' ";
      if (!empty($d['state']))
        $q .= ",state='" . $d["state"] . "' ";
      $q .= ",country='" . $d["country"] . "' ";
      $q .= ",zip='" . $d["zip"] . "' ";
      $q .= ",extra_field_1='" . $d["extra_field_1"] . "'";
      $q .= ",extra_field_2='" . $d["extra_field_2"] . "'";
      $q .= ",extra_field_3='" . $d["extra_field_3"] . "'";
      $q .= ",extra_field_4='" . $d["extra_field_4"] . "' ";
      $q .= ",extra_field_5='" . $d["extra_field_5"] . "' ";
      if (!empty($d['bank_iban']))
        $q .= ",bank_iban='" . $d["bank_iban"] . "' ";
      if (!empty($d['bank_account_nr']))
        $q .= ",bank_account_nr='" . $d["bank_account_nr"] . "' ";
      if (!empty($d['bank_sort_code']))
        $q .= ",bank_sort_code='" . $d["bank_sort_code"] . "' ";
      if (!empty($d['bank_name']))
        $q .= ",bank_name='" . $d["bank_name"] . "'";
      if (!empty($d['bank_account_holder']))
        $q .= ", bank_account_holder='" . $d["bank_account_holder"] . "' ";
      if (mShop_validateEmail(@$d['user_email']))
        $q .= ",email = '".@$d['user_email']."' ";
      $q .= "WHERE id='" . $user_id . "' ";
  
      $db->query($q);
  
      // UPDATE #__pshop_shopper group relationship
      $q = "SELECT shopper_group_id FROM #__pshop_shopper_vendor_xref ";
      $q .= "WHERE user_id = '".$d['user_id']."'";
      $db->query($q);
      if (!$db->num_rows()) {
        //add
        
        $shopper_db = new ps_DB;
        // get the default shopper group
        $q =  "SELECT * from #__pshop_shopper_group WHERE ";
        $q .= "`default`='1'";
        $shopper_db->query($q);
        if (!$shopper_db->num_rows()) {  // when there is no "default", take the first in the table 
            $q =  "SELECT * from #__pshop_shopper_group";
            $shopper_db->query($q);
        }
        
        $shopper_db->next_record();
        $my_shopper_group_id = $shopper_db->f("shopper_group_id");
        if (empty($d['customer_number'])) $d['customer_number'] = "";
        
        $q  = "INSERT INTO #__pshop_shopper_vendor_xref ";
        $q .= "(user_id,vendor_id,shopper_group_id,customer_number) ";
        $q .= "VALUES ('";
        $q .= $_SESSION['auth']['user_id'] . "','";
        $q .= $_SESSION['ps_vendor_id'] . "','";
        $q .= $my_shopper_group_id. "','";
        $q .= $d["customer_number"] . "')";
        $db->query($q);
      }
      $q = "SELECT user_id FROM #__pshop_auth_user_vendor ";
      $q .= "WHERE user_id = '".$_SESSION['auth']['user_id']."'";
      $db->query($q);
      if (!$db->num_rows()) {
        // Insert vendor relationship
        $q = "INSERT INTO #__pshop_auth_user_vendor (user_id,vendor_id)";
        $q .= " VALUES ";
        $q .= "('" . $_SESSION['auth']['user_id'] . "','";
        $q .= $_SESSION['ps_vendor_id'] . "') ";
        $db->query($q);
      }
    }
    
    return True;
  }
  
  /**************************************************************************
  ** name: delete()
  ** created by: soeren
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/
  function delete(&$d) {
  global $my;
  
    $db = new ps_DB;
    
    if (!$this->validate_delete($d)) {
      return False;
    }

    // Delete user_info entries
    $q  = "UPDATE #__users SET ";
    $q .= "user_info_id=NULL, ";
    $q .= "address_type=NULL, ";
    $q .= "address_type_name=NULL, ";
    $q .= "company=NULL, ";
    $q .= "title=NULL, ";
    $q .= "last_name=NULL, ";
    $q .= "first_name=NULL, ";
    $q .= "middle_name=NULL, ";
    $q .= "phone_1=NULL, ";
    $q .= "phone_2=NULL, ";
    $q .= "fax=NULL, ";
    $q .= "address_1=NULL, ";
    $q .= "address_2=NULL, ";
    $q .= "city=NULL, ";
    $q .= "state=NULL, ";
    $q .= "country=NULL, ";
    $q .= "zip=NULL, ";
    $q .= "extra_field_1=NULL, ";
    $q .= "extra_field_2=NULL, ";
    $q .= "extra_field_3=NULL, ";
    $q .= "extra_field_4=NULL, ";
    $q .= "extra_field_5=NULL, ";
    $q .= "perms='shopper' ";
    $q .= "WHERE id='" . $d['user_id'] . "' ";
    $q .= "AND address_type='BT'";
    
    // Delete Shipping addresses
    $q = "DELETE FROM #__pshop_user_info where user_id='" . $d["user_id"] . "'"; 
    $db->query($q);
    
    // Delete shopper_vendor_xref entries
    $q = "DELETE FROM #__pshop_shopper_vendor_xref where user_id='" . $d["user_id"] . "'"; 
    $db->query($q);
    
    $q = "DELETE FROM #__pshop_auth_user_vendor where user_id='" . $d["user_id"] . "'"; 
    $db->query($q);
    return True;
  }
}
$ps_shopper = new ps_shopper;
?>
