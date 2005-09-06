<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: ps_user.php,v 1.4 2005/01/27 19:33:40 soeren_nb Exp $
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

class ps_user {
    var $classname = "ps_user";
    var $permissions = array(
			   "shopper" 	=>  "1",
			   "demo" 	=>  "2",
			   "storeadmin" =>  "4",
			   "admin" 	=>  "8" 
			);
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
    
    // security fix: Remove all html and php tags from data passed by
    // from a user
    while(list($key,$value)=each($d)) $d[$key]=trim(strip_tags($value));
    
    if (empty($d["country"])) {
      $d["error"] .= "Please select a country.";
      $valid = false;
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
    /*
    if (!$d["phone_1"]) {
      $d["error"] .= "'Phone Number' is a required field.";
      $valid = false;
    }
    */
    if ($my->id == 0){
      $d["error"] .= "Please Login first.";
      $valid = false;
    }
    if (!$d['perms']) {
      $d["error"] .= "You must assign the user to a group.";
      $valid = false;
    }

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
    $valid = true;
    
    if ($my->id == 0){
      $d["error"] .= "Please Login first.";
      $valid = false;
    }


    if (!$d["user_id"]) {
      $d["error"] .= "Please select a user to delete.";
      $valid =  False;
    }
    else {
      $valid =  True;
    }    
    return $valid;
  }


  /**************************************************************************
  ** name: validate_update()
  ** created by:
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/
  function validate_update(&$d) {
    global $my;
    
    // security fix: Remove all html and php tags from data passed by
    // from a user
    while(list($key,$value)=each($d)) $d[$key]=trim(strip_tags($value));
    
    $valid = true;
    
    if ($my->id == 0){
      $d["error"] .= "Please Login first.";
      $valid = false;
    }
    if (empty($d['user_id'])){
      $d["error"] .= "Please select a user to update.";
      $valid = false;
    }
    if (empty($d["country"])) {
      $d["error"] .= "Please select a country.";
      $valid = false;
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
    /*
    if (!$d["phone_1"]) {
      $d["error"] .= "'Phone Number' is a required field.";
      $valid = false;
    }
    */
  
    if (!$d['perms']) {
      $d["error"] .= "You must assign the user to a group.";
      $valid = false;
    }
    return $valid;
  }
  
  
  /**************************************************************************
   * name: add()
   * created by:
   * description:
   * parameters:
   * returns:
   **************************************************************************/
  function add(&$d) {
    global $my;
    $ps_vendor_id = $_SESSION["ps_vendor_id"];
    $hash_secret = "PHPShopIsCool";
    $db = new ps_DB;
    $timestamp = time();
    
    if (!$this->validate_add($d)) {
      return False;
    }
    

    if (USER_INFO_XF_4 and $d["extra_field_4"] == "") {
      $d["extra_field_4"] = "N";
    }
    if (USER_INFO_XF_5 and $d["extra_field_5"] == "") {
      $d["extra_field_5"] = "N";
    } 
    
    // Insert billto

    $q = "UPDATE #__users SET ";
    $q .= "user_info_id='" . md5(uniqid(rand())) . "',";
    $q .= "address_type='".$d['address_type']."',";
    $q .= "address_type_name='".$d['address_type_name']."',";
    $q .= "company='" .$d["company"] . "',";
    $q .= "title='" .$d["title"] . "',";
    $q .= "last_name='" .$d["last_name"] . "',";
    $q .= "first_name='" .$d["first_name"] . "',";
    $q .= "middle_name='" .$d["middle_name"] . "',";
    $q .= "phone_1='" .$d["phone_1"] . "',";
    $q .= "phone_2='" .$d["phone_2"] . "',";
    $q .= "fax='" .$d["fax"] . "',";
    $q .= "address_1='" .$d["address_1"] . "',";
    $q .= "address_2='" .$d["address_2"] . "',";
    $q .= "city='" .$d["city"] . "',";
    $q .= "state='" .$d["state"] . "',";
    $q .= "country='" .$d["country"] . "',";
    $q .= "zip='" .$d["zip"] . "',";
    $q .= "extra_field_1='" .$d["extra_field_1"] . "',";
    $q .= "extra_field_2='" .$d["extra_field_2"] . "',";
    $q .= "extra_field_3='" .$d["extra_field_3"] . "',";
    $q .= "extra_field_4='" .$d["extra_field_4"] . "',";
    $q .= "extra_field_5='" .$d["extra_field_5"] . "',";
    $q .= "bank_iban='" . $d["bank_iban"] . "', ";
    $q .= "bank_account_nr='" . $d["bank_account_nr"] . "', ";
    $q .= "bank_sort_code='" . $d["bank_sort_code"] . "', ";
    $q .= "bank_name='" . $d["bank_name"] . "', ";
    $q .= "bank_account_holder='" . $d["bank_account_holder"] . "', ";
    $q .= "perms= '".$d['perms']."' ";
    $q .= "WHERE id='".$_POST['user_id']."'";
    $db->query($q);
    
    
    // Insert vendor relationship
    $q = "INSERT INTO #__pshop_auth_user_vendor (user_id,vendor_id)";
    $q .= " VALUES ";
    $q .= "('" . $_POST["user_id"] . "','";
    $q .= $ps_vendor_id . "') ";
    $db->query($q);
    
    
    return True;
    
  }
  
  /**************************************************************************
   * name: update()
   * created by:
   * description:
   * parameters:
   * returns:
   **************************************************************************/
  function update(&$d) {
    global $my;
    $ps_vendor_id = $_SESSION["ps_vendor_id"];
    $db = new ps_DB;
    $timestamp = time();
    
    if (!$this->validate_update($d)) {
      return False;
    }
    
    if (USER_INFO_XF_4 and $d["extra_field_4"] == "") {
      $d["extra_field_4"] = "N";
    }
    if (USER_INFO_XF_5 and $d["extra_field_5"] == "") {
      $d["extra_field_5"] = "N";
    }
    
    /* Update Bill To */
    $q  = "UPDATE #__users SET ";
    $q .= "company='" . $d["company"] . "', ";
    $q .= "address_type='" . $d["address_type"] . "', ";
    $q .= "address_type_name='" . $d["address_type_name"] . "', ";
    $q .= "title='" . $d["title"] . "', ";
    $q .= "last_name='" . $d["last_name"] . "', ";
    $q .= "first_name='" . $d["first_name"] . "', ";
    $q .= "middle_name='" . $d["middle_name"] . "', ";
    $q .= "phone_1='" . $d["phone_1"] . "', ";
    $q .= "phone_2='" . $d["phone_2"] . "', ";
    $q .= "fax='" . $d["fax"] . "', ";
    $q .= "address_1='" . $d["address_1"] . "', ";
    $q .= "address_2='" . $d["address_2"] . "', ";
    $q .= "city='" . $d["city"] . "', ";
    $q .= "state='" . $d["state"] . "', ";
    $q .= "country='" . $d["country"] . "', ";
    $q .= "zip='" . $d["zip"] . "', ";
    $q .= "extra_field_1='" . $d["extra_field_1"] . "', ";
    $q .= "extra_field_2='" . $d["extra_field_2"] . "', ";
    $q .= "extra_field_3='" . $d["extra_field_3"] . "', ";
    $q .= "extra_field_4='" . $d["extra_field_4"] . "', ";
    $q .= "extra_field_5='" . $d["extra_field_5"] . "', ";
    $q .= "bank_iban='" . $d["bank_iban"] . "', ";
    $q .= "bank_account_nr='" . $d["bank_account_nr"] . "', ";
    $q .= "bank_sort_code='" . $d["bank_sort_code"] . "', ";
    $q .= "bank_name='" . $d["bank_name"] . "', ";
    $q .= "bank_account_holder='" . $d["bank_account_holder"] . "', ";
    $q .= "perms ='".$d['perms']."' ";    
    $q .= "WHERE id='" . $_POST["user_id"] . "' AND ";
    $q .= "address_type='BT'";
    $q .= $q_end;
    $db->query($q);

    $q = "UPDATE #__pshop_auth_user_vendor set ";
    $q .= "vendor_id='$ps_vendor_id' ";
    $q .= "WHERE user_id='" . $_POST["user_id"] . "'";
    $db->query($q);

    
    return True;
  }
  
  /**************************************************************************
   * name: delete()
   * created by:
   * description:
   * parameters:
   * returns:
   **************************************************************************/
  function delete(&$d) {
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
    $db->query($q);
    $db->next_record();

    $q = "DELETE FROM #__pshop_auth_user_vendor where user_id='" . $d["user_id"] . "'"; 
    $db->query($q);

    return True;
  }
  
  
  /**************************************************************************
   * name: list_perms()
   * created by: pablo
   * description: lists the permission in a select box
   * parameters:
   * returns:
   **************************************************************************/
  function list_perms($name,$group_name) {
    global $perm,$PHPSHOP_LANG;
    $auth = $_SESSION['auth'];
        
    $db = new ps_DB;
  
    // Get users current permission value 
    $dvalue = $this->permissions[$auth["perms"]];
    echo "<select class=\"inputbox\" name=\"$name\">\n";
    echo "<option value=\"0\">".$PHPSHOP_LANG->_PHPSHOP_SELECT ."</option>\n";
    while (list($key,$value) = each($this->permissions)) {
      // Display only those permission that this user can set
      if ($value <= $dvalue)
      if ($key == $group_name) {
	echo "<option value=\"".$key."\" selected>$key</option>\n";
      }
      else {
	echo "<option value=\"$key\">$key</option>\n";
      }
    }
    echo "</select>\n";
  }        

  /**************************************************************************
   * name: logout()
   * created by:
   * description:
   * parameters:
   * returns:
   **************************************************************************/
  function logout(&$d) {
    global $sess;
    $auth = $_SESSION['auth'];    
    $auth["uid"]="";
    $auth["user_id"]="";
    $auth["uname"]="";
    $auth["username"]="";
    $auth["perm"]="";
    $auth["perms"]="";
    $_SESSION["auth"]="";
    $_SESSION["cart"]="";
    session_destroy();
    return True;   
  }

  /**************************************************************************
   * name: logout()
   * created by:
   * description:
   * parameters:
   * returns:
   **************************************************************************/
  function logged_in() {
    $auth = $_SESSION['auth'];
    
    if ($auth["perms"]) {
      return True;   
    }
    else return False;
  }

  /**************************************************************************
   * name: login()
   * created by:
   * description:
   * parameters:
   * returns:
   **************************************************************************/
  function login(&$d) { /*
    global $auth, $sess, $ps_vendor_id;
    $db = new ps_DB;

    $q = "SELECT * from auth_user_md5,user_info ";
    $q .= "WHERE auth_user_md5.username ='" . $d["username"] . "' ";
    $q .= "AND auth_user_md5.password ='" . md5($d["password"]) . "'";
    $q .= "AND auth_user_md5.password ='" . md5($d["password"]) . "'";
    $q .= "AND auth_user_md5.user_id = user_info.user_id ";
    $q .= "AND user_info.address_type = 'BT'";

    $db->query($q);

    if ($db->next_record()) {
      $auth["user_id"]   = $db->f("user_id");
      $auth["username"] = $d["username"];
      $auth["perms"]  = $db->f("perms");
      $auth["first_name"] = $db->f("first_name");
      $auth["last_name"] = $db->f("last_name");
    }
    else {
      $d["error"] = "The username and password you entered were not found.";
      $d["error"] .= "Please try again.";
      $d["login"]="1";
      return False;
    }

    $q = "SELECT * from vendor";
    $db->query($q);
    if ($db->next_record()) {
       $ps_vendor_id=$db->f("vendor_id");
       $sess->register("ps_vendor_id");
    }
    $d["login"] = "0";*/
    return $auth["user_id"];

  }

  
}

?>
