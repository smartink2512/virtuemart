<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: ps_currency.php,v 1.3 2005/01/27 19:33:40 soeren_nb Exp $
* @package mambo-phpShop
*
* @copyright (C) 2004-2005 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

/****************************************************************************
* CLASS DESCRIPTION
*                   
* ps_currency
*
* The class is is used to manage the currencies in your store.
*
*************************************************************************/
 class ps_currency {
   var $classname = "ps_currency";
   var $error;
   
   function validate_add($d) {
     
     $db = new ps_DB;
     
     if (!$d["currency_name"]) {
       $this->error = "ERROR:  You must enter a name for the currency.";
       return False;	
     }
     if (!$d["currency_code"]) {
       $this->error = "ERROR:  You must enter a code for the currency.";
       return False;	
     }

     if ($d["currency_name"]) {
       $q = "SELECT count(*) as rowcnt from #__pshop_currency where";
       $q .= " currency_name='" .  $d["currency_name"] . "'";
       $db->setQuery($q);
       $db->query();
       $db->next_record();
       if ($db->f("rowcnt") > 0) {
	 $this->error = "The given currency name already exists.";
	 return False;
       }      
     }
     return True;    
   }
  
  /**************************************************************************
  ** name: validate_delete()
  ** created by: soeren
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/   
  function validate_delete($d) {
    
    if (!$d["currency_id"]) {
      $this->error = "ERROR:  Please select a currency to delete.";
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
    
    if (!$d["currency_name"]) {
      $this->error = "ERROR:  You must enter a name for the currency.";
      return False;	
    }
    if (!$d["currency_code"]) {
      $this->error = "ERROR:  You must enter a code for the currency.";
      return False;	
    }
  
   return true;
  }
  
  
  /**************************************************************************
   * name: add()
   * created by: soeren
   * description: creates a new currency record
   * parameters:
   * returns:
   **************************************************************************/
  function add(&$d) {
    $hash_secret="PHPShopIsCool";
    $db = new ps_DB;
    $timestamp = time();
    
    if (!$this->validate_add($d)) {
      $d["error"] = $this->error;
      return False;
    }
    $q = "INSERT INTO #__pshop_currency (currency_name, currency_code)";
    $q .= " VALUES ('";
    $q .= $d["currency_name"] . "','";
    $q .= $d["currency_code"] . "')";
    $db->setQuery($q);
    $db->query();
    $db->next_record();
    return True;

  }
  
  /**************************************************************************
   * name: update()
   * created by: soeren
   * description: updates currency information
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
    $q = "UPDATE #__pshop_currency set ";
    $q .= "currency_name='" . $d["currency_name"];
    $q .= "',currency_code='" . $d["currency_code"]."' ";
    $q .= "WHERE currency_id='".$d["currency_id"]."'";
    $db->setQuery($q);
    $db->query();
    $db->next_record();
    return True;
  }

  /**************************************************************************
   * name: delete()
   * created by: soeren
   * description: Delete a currency.
   * parameters: 
   * returns:
   **************************************************************************/
  function delete(&$d) {
    $db = new ps_DB;
    
    if (!$this->validate_delete($d)) {
      $d["error"]=$this->error;
      return False;
    }
    $q = "DELETE from #__pshop_currency where currency_id='" . $d["currency_id"] . "'";
    $db->setQuery($q);
    $db->query();
    $db->next_record();
    return True;
  }
  
  

}

?>
