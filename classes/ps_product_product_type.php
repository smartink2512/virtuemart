<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/** Changed Product Type - Begin*/
/*
* @version $Id: ps_product_product_type.php,v 1.2 2005/06/22 19:50:40 soeren_nb Exp $
* @package Mambo_4.5.1
* @subpackage mambo-phpShop
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.phpshop.org, forums.phpshop.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004 Soeren Eberhardt
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
* ps_product_product_type
*************************************************************************/
class ps_product_product_type {
  var $classname = "ps_product_product_type";
  
  /**************************************************************************
  ** name: validate_add()
  ** created by:
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/
  function validate_add(&$d) {
    
    if (!isset($d["product_type_id"])) {
      $d["error"] = "ERROR:  Please select a Product Type.";
      return False;
    }
    if (!isset($d["product_id"])) {
      $d["error"] = "ERROR:  Please select a Product.";
      return false;
    }
    $db = new ps_DB;
    $q  = "SELECT COUNT(*) AS count FROM #__pshop_product_product_type_xref ";
    $q .= "WHERE product_id='".$d["product_id"]."' AND product_type_id='".$d["product_type_id"]."'";
    $db->query($q);
    if ($db->f("count") != 0) {
      $d["error"] = "ERROR:  This Product is already in this Product Type.";
      return false;
    }
    else {
      return True;    
    }
  }
    
  /**************************************************************************
  ** name: validate_delete()
  ** created by: Zdenek Dvorak
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/
  function validate_delete(&$d) {

    if (!isset($d["product_type_id"])) {
      $d["error"] = "ERROR:  Please select a Product Type to delete a Product from this Product Type.";
      return False;
    }
    if (!isset($d["product_id"])) {
      $d["error"] = "ERROR:  Please select a Product to delete from Product Type.";
      return false;
    }

    return True;
  }

  /**************************************************************************
  ** name: add()
  ** created by: Zdenek Dvorak
  ** description: add a Product into a Product Type
  ** parameters:
  ** returns:
  ***************************************************************************/
  function add(&$d) {
    $db = new ps_DB;
	    
    if ($this->validate_add($d)) {
      foreach ($d as $key => $value) {
          if (!is_array($value))
            $d[$key] = addslashes($value);
      }
      $q  = "INSERT INTO #__pshop_product_product_type_xref (product_id, product_type_id) ";
      $q .= "VALUES ('".$d["product_id"]."','".$d["product_type_id"]."')";
      $db->query($q);
      
      $q  = "INSERT INTO #__pshop_product_type_".$d["product_type_id"]." (product_id) ";
      $q .= "VALUES ('".$d["product_id"]."')";
      $db->query($q);
      
      return true;
    }
    else {
      return False;
    }

  }

	/**
	* Controller for Deleting Records.
	*/
	function delete(&$d) {
		
		if (!$this->validate_delete($d)) {
		  return False;
		}
		
		$record_id = $d["product_type_id"];
		
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
	
		$q  = "DELETE FROM #__pshop_product_product_type_xref WHERE product_type_id='$record_id' ";
		$q .= "AND product_id='".$d["product_id"]."'";
		$db->setQuery($q);   $db->query();
	
		$q  = "DELETE FROM #__pshop_product_type_".$record_id." WHERE product_id='".$d["product_id"]."'";
		$db->query($q);
		
		return True;
  }

}
/** Changed Product Type - End*/
?>
