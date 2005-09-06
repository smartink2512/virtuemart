<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* @version $Id: ps_function.php,v 1.5 2005/09/01 19:58:06 soeren_nb Exp $
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
* ps_function
*
* The class is is used to manage the function register.
* 
* propeties:  
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
 class ps_function {
   var $classname = "ps_function";
   var $error;
   
   ////
   // !Validates adding a function to a module.
   // Validate routine for module-function add.  
   // A longer, more complete description would go here
   // We might include details of what the function parameters do and what the
   // result should be, etc
   function validate_add($d) {
     
     $db = new ps_DB;
     
     if (!$d["function_name"]) {
       $this->error = "ERROR:  You must enter a name for the function.";
       return False;	
     }
     if (!$d["module_id"]) {
       $this->error = "ERROR:  ERROR:  A module id must be specified.";
       return False;
     }
     if (!$d["function_class"]) {
       $this->error = "ERROR:  You must enter a name for the class.";
       return False;	
     }
     if (!$d["function_method"]) {
       $this->error = "ERROR:  You must enter a name for the method.";
       return False;	
     }
     if (!$d["function_perms"]) {
       $this->error = "ERROR:  You must enter a permissions for the method.";
       return False;	
     }
     if ($d["function_name"]) {
       $q = "SELECT count(*) as rowcnt from #__pshop_function where";
       $q .= " function_name='" .  $d["function_name"] . "'";
       $db->setQuery($q);
       $db->query();
       $db->next_record();
       if ($db->f("rowcnt") > 0) {
	 $this->error = "The given function name already exists.";
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
    
    if (!$d["function_id"]) {
      $this->error = "ERROR:  Please select a function to delete.";
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
    
    if (!$d["function_name"]) {
      $this->error = "ERROR:  You must enter a name for the function.";
      return False;	
    }
    if (!$d["function_class"]) {
      $this->error = "ERROR:  You must enter a name for the class.";
      return False;	
    }
    if (!$d["function_method"]) {
      $this->error = "ERROR:  You must enter a name for the method.";
      return False;	
    }
    if (!$d["function_perms"]) {
      $this->error = "ERROR:  You must enter a permissions for the method.";
      return False;	
    }
    else {
      return True;
    }
  }
  
  
  /**************************************************************************
   * name: add()
   * created by: pablo
   * description: creates a new function record
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
    
    foreach ($d as $key => $value)
        $d[$key] = addslashes($value);
        
        
    $q = "INSERT INTO #__pshop_function (module_id, function_name, function_class, ";
    $q .= "function_method, function_perms, function_description)";
    $q .= " VALUES ('";
    $q .= $d["module_id"] . "','";
    $q .= $d["function_name"] . "','";
    $q .= $d["function_class"] . "','";
    $q .= $d["function_method"] . "','";
    $q .= $d["function_perms"] . "','";
    $q .= $d["function_description"] . "')";
    $db->setQuery($q);
    $db->query();
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
    $timestamp = time();

    if (!$this->validate_update($d)) {
      $d["error"] = $this->error;
      return False;	
    }
    
    foreach ($d as $key => $value)
        $d[$key] = addslashes($value);
        
    $q = "UPDATE #__pshop_function set ";
    $q .= "function_name='" . $d["function_name"];
    $q .= "',function_class='" . $d["function_class"];
    $q .= "',function_method='" . $d["function_method"];
    $q .= "',function_perms='" . $d["function_perms"];
    $q .= "', function_description='" . $d["function_description"];
    $q .= "' WHERE function_id='" . $d["function_id"] . "'";
    $db->setQuery($q);
    $db->query();
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
  function delete(&$d) {
    $db = new ps_DB;
    
    if (!$this->validate_delete($d)) {
      $d["error"]=$this->error;
      return False;
    }
    $q = "DELETE from #__pshop_function where function_id='" . $d["function_id"] . "'";
    $db->setQuery($q);
    $db->query();
    $db->next_record();
    return True;
  }
  
  
  /**************************************************************************
   * name: get_function()
   * created by: pablo
   * description: 
   * parameters: 
   * returns: an array
   **************************************************************************/
   
  function get_function($func) {
    $db = new ps_DB;
    $result = array(); 
    
    $q = "SELECT * FROM #__pshop_function WHERE LOWER(function_name)='".strtolower($func)."'";
    $db->setQuery($q);
    $db->query();
    if ($db->next_record()) {
      $result["perms"] = $db->f("function_perms");
      $result["class"] = $db->f("function_class");
      $result["method"] = $db->f("function_method");      
      return $result;
    }
    else {
      return False;
    }
  }
  /**********************************************
    ** Get Function Permissions
    ** returns true if the function $func is registered 
    ** and user has permission to run it
    ** Displays error if function is not registered
    ************************************************/
  function checkFuncPermissions( $func ) {
	
	global $page, $perm, $PHPSHOP_LANG, $error_type, $error;
	  
	if (!empty($func)) {
    
        $funcParams = $this->get_function($func);
        if ($funcParams) {
            if ($perm->check($funcParams["perms"])) {
				return $funcParams;
			}
			else {
				$error_type = $PHPSHOP_LANG->_PHPSHOP_PAGE_403;
				$error = $PHPSHOP_LANG->_PHPSHOP_FUNC_NO_EXEC . $func;
				$page = ERRORPAGE;          
				return false;
			}
		}
		else {
			$error_type = $PHPSHOP_LANG->_PHPSHOP_FUNC_NOT_REG;
			$error = $func . $PHPSHOP_LANG->_PHPSHOP_FUNC_ISNO_REG ;
			$page = ERRORPAGE;    
			return false;
		}
    }
	else
		return true;
  }
}

?>
