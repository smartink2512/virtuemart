<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: ps_manufacturer.php,v 1.3 2005/01/27 19:33:40 soeren_nb Exp $
* @package mambo-phpShop
*
* @copyright (C) 2004 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

/****************************************************************************
*
* CLASS DESCRIPTION
*                   
* ps_manufacturer
*
* The class is is used to manage the manufacturers in your store.
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
 class ps_manufacturer {
   var $classname = "ps_manufacturer";
   var $error;
   
  /**************************************************************************
  ** name: validate_add()
  ** created by: soeren
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/  
   function validate_add($d) {
     
     $db = new ps_DB;
     
     if (!$d["mf_name"]) {
       $this->error = "ERROR:  You must enter a name for the manufacturer.";
       return False;	
     }
    
    else {
       $q = "SELECT count(*) as rowcnt from #__pshop_manufacturer where";
       $q .= " mf_name='" .  $d["mf_name"] . "'";
       $db->setQuery($q);
       $db->query();
       $db->next_record();
       if ($db->f("rowcnt") > 0) {
          $this->error = "The given manufacturer name already exists.";
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
    
    if (!$d["manufacturer_id"]) {
      $this->error = "ERROR:  Please select a manufacturer to delete.";
      return False;
    }
    else {
      return True;
    }
  }
  
  /**************************************************************************
  ** name: validate_update
  ** created by: soeren
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/   
  function validate_update($d) {
    
    if (!$d["mf_name"]) {
      $this->error = "ERROR:  You must enter a name for the manufacturer.";
      return False;	
    }
    
   return true;
  }
  
  
  /**************************************************************************
   * name: add()
   * created by: soeren
   * description: creates a new manufacturer record
   * parameters:
   * returns:
   **************************************************************************/
  function add(&$d) {
    
    $db = new ps_DB;
    
    if (!$this->validate_add($d)) {
      $d["error"] = $this->error;
      return false;
    }
    $q = "INSERT INTO #__pshop_manufacturer (mf_name, mf_email, mf_desc, mf_category_id, mf_url)";
    $q .= " VALUES ('";
    $q .= $d["mf_name"] . "','";
    $q .= $d["mf_email"] . "','";
    $q .= $d["mf_desc"] . "','";
    $q .= $d["mf_category_id"] . "','";
    $q .= $d["mf_url"] . "')";
    $db->setQuery($q);
    $db->query();
    $db->next_record();
    return True;

  }
  
  /**************************************************************************
   * name: update()
   * created by: soeren
   * description: updates manufacturer information
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
    $q = "UPDATE #__pshop_manufacturer set ";
    $q .= "mf_name='" . $d["mf_name"]."',";
    $q .= "mf_email='" .$d["mf_email"] . "',";
    $q .= "mf_desc='" .$d["mf_desc"] . "',";
    $q .= "mf_category_id='" .$d["mf_category_id"] . "',";
    $q .= "mf_url='" .$d["mf_url"] . "' ";
    $q .= "WHERE manufacturer_id='".$d["manufacturer_id"]."'";
    $db->setQuery($q);
    $db->query();
    $db->next_record();
    return True;
  }

  /**************************************************************************
   * name: delete()
   * created by: soeren
   * description: Should delete a manufacturer record.
   * parameters: 
   * returns:
   **************************************************************************/
  function delete(&$d) {
    $db = new ps_DB;
    
    if (!$this->validate_delete($d)) {
      $d["error"]=$this->error;
      return False;
    }
    $q = "DELETE from #__pshop_manufacturer where manufacturer_id='" . $d["manufacturer_id"] . "'";
    $db->setQuery($q);
    $db->query();
    $db->next_record();
    return True;
  }
  
  

}

?>
