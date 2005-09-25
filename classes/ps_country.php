<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: ps_country.php,v 1.4 2005/05/08 09:02:23 soeren_nb Exp $
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
     
     $db = new ps_DB;
     
     if (!$d["country_name"]) {
       $this->error = "ERROR:  You must enter a name for the country.";
       return False;	
     }
     if (!$d["country_2_code"]) {
       $this->error = "ERROR:  You must enter a 2 symbol code for the country.";
       return False;	
     }
    if (!$d["country_3_code"]) {
      $this->error = "ERROR:  You must enter a 3 symbol code for the country.";
      return False;	
    }
    
     if ($d["country_name"]) {
       $q = "SELECT count(*) as rowcnt from #__pshop_country where";
       $q .= " country_name='" .  $d["country_name"] . "'";
       $db->setQuery($q);
       $db->query();
       $db->next_record();
       if ($db->f("rowcnt") > 0) {
	 $this->error = "The given country name already exists.";
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
      $this->error = "ERROR:  Please select a country to delete.";
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
      $this->error = "ERROR:  You must enter a name for the country.";
      return False;	
    }
    if (!$d["country_2_code"]) {
      $this->error = "ERROR:  You must enter a 2 symbol code for the country.";
      return False;	
    }
      if (!$d["country_3_code"]) {
      $this->error = "ERROR:  You must enter a 3 symbol code for the country.";
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
    $q = "INSERT INTO #__pshop_country (country_name, zone_id, country_3_code, country_2_code)";
    $q .= " VALUES ('";
    $q .= $d["country_name"] . "','";
    $q .= $d["zone_id"] . "','";
    $q .= $d["country_3_code"] . "','";
    $q .= $d["country_2_code"] . "')";
    $db->setQuery($q);
    $db->query();
    $db->next_record();
    return True;

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
    $q = "UPDATE #__pshop_country set ";
    $q .= "country_name='" . $d["country_name"]."',";
    $q .= "zone_id='" . $d["zone_id"]."',";
    $q .= "country_3_code='" . $d["country_3_code"]."', ";
    $q .= "country_2_code='" . $d["country_2_code"]."' ";
    $q .= "WHERE country_id='".$d["country_id"]."'";
    $db->setQuery($q);
    $db->query();
    $db->next_record();
    return True;
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
			$q = "DELETE FROM #__pshop_country WHERE country_id='$country'";
			$db->query($q);
		}
	}
	else {
		$q = "DELETE FROM #__pshop_country WHERE country_id='" . $d["country_id"] . "'";
		$db->query($q);
	}
    return True;
  }
  
  function addState( &$d ) {
    
    $db = new ps_DB;
    if ( empty($d['country_id']) ) {
      $d["error"] = "Error: No country was selected for this State";
      return False;
    }
    $q = "INSERT INTO #__pshop_state (state_name, country_id, state_3_code, state_2_code)";
    $q .= " VALUES ('";
    $q .= $d["state_name"] . "','";
    $q .= $d["country_id"] . "','";
    $q .= $d["state_3_code"] . "','";
    $q .= $d["state_2_code"] . "')";
    $db->query( $q );
    
    return True;
    
  }

  function updateState( &$d ) {
    $db = new ps_DB;

    if (empty($d['state_id']) ||empty($d['country_id']) ) {
      $d["error"] = "Please select a state or country for update!";
      return False;	
    }
    $q = "UPDATE #__pshop_state SET ";
    $q .= "state_name='" . $d["state_name"]."',";
    $q .= "state_3_code='" . $d["state_3_code"]."', ";
    $q .= "state_2_code='" . $d["state_2_code"]."' ";
    $q .= "WHERE state_id='".$d["state_id"]."'";
    $db->query( $q );
    
    return True;
  
  }
  
  function deleteState( &$d ) {
  
    $db = new ps_DB;
    
    if (empty( $d['state_id'])) {
      $d["error"]= "Please select a state to delete!";
      return false;
    }
    $q = "DELETE FROM #__pshop_state where state_id='" . $d["state_id"] . "' LIMIT 1";
    $db->query($q);
    
    return True;
  }
  
}

?>
