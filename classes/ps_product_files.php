<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: ps_product_files.php,v 1.3 2005/09/27 17:48:50 soeren_nb Exp $
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

/*
* CLASS DESCRIPTION
*
* ps_product_files
*
* The class is is used to manage product files.
*************************************************************************/
class ps_product_files {

  /*@param boolean Wether filename already exists or not */
  var $fileexists = false;
  
 /**************************************************************************
  ** name: validate_add()
  ** created by: Soeren
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/  
   function validate_add( &$d ) {
     
     $db = new ps_DB;
     
     if (empty($_FILES["file_upload"]["name"]) && empty($d['file_url'])) {
       $d["error"] = "ERROR: You must either Upload a File or provide a File URL.";
       return False;	
     }
     if (empty($d["product_id"])) {
       $d["error"] = "ERROR: A product ID must be specified.";
       return False;	
     }
    
     if (!empty($_FILES["file_upload"]["name"])) {
       $q = "SELECT count(*) as rowcnt from #__{vm}_product_files WHERE";
       $q .= " file_name LIKE '%" .  $_FILES["file_upload"]["name"] . "%'";
       $db->query($q);
       $db->next_record();
       if ($db->f("rowcnt") > 0) {
        $this->fileexists = true;
       }      
     }
     return True;   

   }
  
  /**************************************************************************
  ** name: validate_delete()
  ** created by: Soeren
  ** description:
  ** parameters:
  ** returns:
  ***************************************************************************/   
  function validate_delete( $file_id, &$d ) {
    
    $db = new ps_DB;
    
    if (empty($file_id)) {
      $d["error"] = "ERROR:  Please select a file to delete.";
      return False;
    }
    $q_dl = "SELECT attribute_name,file_id from #__{vm}_product_attribute,#__{vm}_product_files WHERE ";
    $q_dl .= "product_id='".$d["product_id"]."' AND attribute_name='download' ";
    $q_dl .= "AND file_id='$file_id' AND attribute_value=file_title";
    $db->query($q_dl);
    if( $db->next_record() ) {
      $d["error"] = "ERROR:  This file is still a Downloadable Product File!";
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
  function validate_update( &$d ) {
    
    $db = new ps_DB;
     if (empty($d["product_id"])) {
       $d["error"] = "ERROR:  A product ID must be specified.";
       return False;	
     }
    
     if (!empty($_FILES["file_upload"]["name"])) {
       $q = "SELECT count(*) as rowcnt from #__{vm}_product_files WHERE";
       $q .= " file_name LIKE '%" .  $_FILES["file_upload"]["name"] . "%'";
       $db->query($q);
       $db->next_record();
       if ($db->f("rowcnt") > 0) {
        $this->fileexists = true;
       }      
     }
     return True;    
  }
  
  
  /**************************************************************************
   * name: add()
   * created by: Soeren
   * description: Upload a file & Create a new File entry
   * parameters:
   * returns:
   **************************************************************************/
  function add( &$d ) {
    global $mosConfig_absolute_path, $mosConfig_live_site, $database, $VM_LANG;
    
    $db = new ps_DB;
    $timestamp = time();
    
    if (!$this->validate_add($d)) {
      return False;
    }
	
    if( empty( $d["file_published"] ))
      $d["file_published"] = 0;
    if( empty( $d["file_create_thumbnail"] ))
      $d["file_create_thumbnail"] = 0;
    
    
    if( !empty($_FILES['file_upload']['name']) ) {
      $upload_success = false;
      $fileinfo = pathinfo( $_FILES['file_upload']['name'] );
      $ext = $fileinfo["extension"];
      
      if( $this->fileexists ) {
        // must rename uploaded file!
        $filename = uniqid("ren_") . $_FILES['file_upload']['name'];
      }
      else {
        $filename = $_FILES['file_upload']['name'];
      }
      
      // file_title...Beware of renaming files!
      if( @$d["file_title"] == $_FILES['file_upload']['name'] ) {
        if( $filename != $_FILES['file_upload']['name'] ) {
          $d["file_title"] = $filename;
        }
      }
      
      switch( $d["upload_dir"] ) {
        case "IMAGEPATH":
          $uploaddir = IMAGEPATH ."product/";
          break;
        case "FILEPATH":
          $uploaddir = $d["file_path"];
          if( !file_exists($uploaddir) )
            @mkdir( $uploaddir );
          if( !file_exists( $uploaddir ) ) {
            $d["error"] = $VM_LANG->_PHPSHOP_FILES_PATH_ERROR;
            return false;
          }
          break;
        case "DOWNLOADPATH":
          $uploaddir = DOWNLOADROOT;
          break;
      }
      if( @$d['file_type'] == "image" ) {
        $is_image = "1";
        $d["file_url"] = IMAGEURL."product/".$filename;
        
        $file_contents = "";
        if( move_uploaded_file($_FILES['file_upload']['tmp_name'], $uploaddir . $filename )) {
          $upload_success = true;
		  
        }
        if( $d["file_create_thumbnail"] == "1" ) {
          ## RESIZE THE IMAGE ####
          require_once( CLASSPATH . "class.img2thumb.php" );
          $fileout = $uploaddir . "resized/".basename($filename, ".".$ext)."_".PSHOP_IMG_WIDTH."x".PSHOP_IMG_HEIGHT.".$ext";
          $tmp_filename = $uploaddir . $filename;
          $newxsize = PSHOP_IMG_WIDTH;
          $newysize = PSHOP_IMG_HEIGHT;
          $maxsize = 0;
		  
          $bgred = $bggreen = $bgblue = 255;
          /* We need to resize the image and Save the new one (all done in the constructor) */
		  $neu = new Img2Thumb($tmp_filename,$newxsize,$newysize,$fileout,$maxsize,$bgred,$bggreen,$bgblue);
		  
          if( is_file( $fileout ) ) {
            $_REQUEST['mosmsg'] = $VM_LANG->_PHPSHOP_FILES_IMAGE_RESIZE_SUCCESS;
            $thumbimg = getimagesize( $fileout );
            $file_image_thumb_width = $thumbimg[0];
            $file_image_thumb_height = $thumbimg[1];
          }
          else {
            $_REQUEST['mosmsg'] = $VM_LANG->_PHPSHOP_FILES_IMAGE_RESIZE_FAILURE;
            $file_image_thumb_height = "";
            $file_image_thumb_width = "";
          }
          $fullimg = getimagesize( $tmp_filename );
          $file_image_width = $fullimg[0];
          $file_image_height = $fullimg[1];
          $filename = $tmp_filename;
        }
        
      }
      else {
        ### File (no image) Upload ###
        $is_image = "0";
        $filename = $uploaddir . $filename;
        // $d['file_type'] == "file"
        if( move_uploaded_file($_FILES['file_upload']['tmp_name'], $filename )) {
          $upload_success = true;
        }        
        $file_image_height = $file_image_width = $file_image_thumb_height = $file_image_thumb_width = "";
      }
    }
    else {
      if( $d['file_type'] == "image" )
        $is_image = "1";
      else
        $is_image = "0";
      $filename = "";
      $file_contents = "";
      $ext = "";
      $upload_success = true;
      $file_image_height = $file_image_width = $file_image_thumb_height = $file_image_thumb_width = "";
    }
    
    if( !$upload_success ) {
      $d["error"] = $VM_LANG->_PHPSHOP_FILES_UPLOAD_FAILURE;
      return false;
    }
    $q = "INSERT INTO #__{vm}_product_files ";
    $q .= "(file_product_id, file_name, file_title, file_extension, file_mimetype, file_url, file_published,";
    $q .= "file_is_image, file_image_height , file_image_width , file_image_thumb_height, file_image_thumb_width )";
    $q .= " VALUES ('".$d["product_id"]."', '$filename','".$d["file_title"] . "','$ext','".$_FILES['file_upload']['type']."', '".$d['file_url']."', '".$d["file_published"]."',";
    $q .= "'$is_image', '$file_image_height', '$file_image_width', '$file_image_thumb_height', '$file_image_thumb_width')";
    $db->setQuery($q);
    $db->query();
    
    return True;

  }
  
  /**************************************************************************
   * name: update()
   * created by: soeren
   * description: updates file information
   * parameters:
   * returns:
   **************************************************************************/
  function update( &$d ) {
    global $mosConfig_absolute_path, $mosConfig_live_site, $database, $VM_LANG;
    $db = new ps_DB;
    $timestamp = time();

    if (!$this->validate_update($d)) {
      return False;	
    }
    if( empty( $d["file_published"] ))
      $d["file_published"] = 0;
    
    $is_download_attribute = false;
    
    $q_dl = "SELECT attribute_name,file_id from #__{vm}_product_attribute,#__{vm}_product_files WHERE ";
    $q_dl .= "product_id='".$d["product_id"]."' AND attribute_name='download' ";
    $q_dl .= "AND file_id='".$d["file_id"]."' AND attribute_value=file_title";
    $db->query($q_dl);
    
    if( $db->next_record() ) {
      $is_download_attribute = true;
      if( !empty($_FILES['file_upload']['name'])) {
        // new file uploaded
        $qu = "UPDATE #__{vm}_product_attribute ";
        $qu .= "SET attribute_value = '". $_FILES['file_upload']['name'] ."' ";
        $qu .= "WHERE product_id='".$d["product_id"]."' AND attribute_name='download'";
        $db->query($qu);
      }
    }
    if( empty( $d["file_create_thumbnail"] ))
      $d["file_create_thumbnail"] = 0;
    
    
    if( !empty($_FILES['file_upload']['name']) ) {
    

      $upload_success = false;
      $fileinfo = pathinfo( $_FILES['file_upload']['name'] );
      $ext = $fileinfo["extension"];
      
      if( $this->fileexists ) {
        // must rename uploaded file!
        $filename = uniqid("ren_") . $_FILES['file_upload']['name'];
      }
      else {
        $filename = $_FILES['file_upload']['name'];
      }
      switch( $d["upload_dir"] ) {
        case "IMAGEPATH":
          $uploaddir = IMAGEPATH ."product/";
          break;
        case "FILEPATH":
          $uploaddir = $d["file_path"];
          if( !file_exists($uploaddir) )
            @mkdir( $uploaddir );
          if( !file_exists( $uploaddir ) ) {
            $d["error"] = $VM_LANG->_PHPSHOP_FILES_PATH_ERROR;
            return false;
          }
          break;
        case "DOWNLOADPATH":
          $uploaddir = DOWNLOADROOT;
          break;
      }
      if( @$d['file_type'] == "image" ) {
        $is_image = "1";
        $d["file_url"] = IMAGEURL."product/".$_FILES['file_upload']['name'];
        
        $file_contents = "";
        if( move_uploaded_file($_FILES['file_upload']['tmp_name'], $uploaddir . $filename )) {
          $upload_success = true;
        }
        if( $d["file_create_thumbnail"] == "1" ) {
          ## RESIZE THE IMAGE ####
          require_once( CLASSPATH . "class.img2thumb.php" );
          $fileout = $uploaddir . "resized/".basename($filename, ".".$ext)."_".PSHOP_IMG_WIDTH."x".PSHOP_IMG_HEIGHT.".$ext";
          $tmp_filename = $uploaddir . $filename;
          $newxsize = PSHOP_IMG_WIDTH;
          $newysize = PSHOP_IMG_HEIGHT;
          $maxsize = 0;
          $bgred = $bggreen = $bgblue = 255;
          /* We need to resize the image and Save the new one (all done in the constructor) */
          $neu = new Img2Thumb($tmp_filename,$newxsize,$newysize,$fileout,$maxsize,$bgred,$bggreen,$bgblue);
          if( is_file( $fileout ) ) {
            $_REQUEST['mosmsg'] = $VM_LANG->_PHPSHOP_FILES_IMAGE_RESIZE_SUCCESS;
            $thumbimg = getimagesize( $fileout );
            $file_image_thumb_width = $thumbimg[0];
            $file_image_thumb_height = $thumbimg[1];
          }
          else {
            $_REQUEST['mosmsg'] = $VM_LANG->_PHPSHOP_FILES_IMAGE_RESIZE_FAILURE;
            $file_image_thumb_height = "";
            $file_image_thumb_width = "";
          }
          $fullimg = getimagesize( $tmp_filename );
          $file_image_width = $fullimg[0];
          $file_image_height = $fullimg[1];
          $filename = $tmp_filename;
        }
        
      }
      else {
        ### File (no image) Upload ###
        $is_image = "0";
        $filename = $uploaddir . $filename;
        // $d['file_type'] == "file"
        if( move_uploaded_file($_FILES['file_upload']['tmp_name'], $filename )) {
          $upload_success = true;
        }        
        $file_image_height = $file_image_width = $file_image_thumb_height = $file_image_thumb_width = "";
      }
    }
    else {
      if( $d['file_type'] == "image" )
        $is_image = "1";
      else
        $is_image = "0";
      $filename = "";
      $file_contents = "";
      $ext = "";
      $upload_success = true;
      $file_image_height = $file_image_width = $file_image_thumb_height = $file_image_thumb_width = "";
    }
    
    if( !$upload_success ) {
      $d["error"] = $VM_LANG->_PHPSHOP_FILES_UPLOAD_FAILURE;
      return false;
    } 
    if( !empty($_FILES['file_upload']['name']) ) {
      // Delete the old file
      $this->delete( $d );

      $q = "INSERT INTO #__{vm}_product_files SET ";
      if( !empty($_FILES['file_upload']['name'])) {
        $q .= "file_id='" . $d["file_id"] . "', ";
        $q .= "file_product_id='" . $d["product_id"] . "', ";
        $q .= "file_name='" . $filename."', ";
        $q .= "file_extension='$ext', ";
        $q .= "file_mimetype='" .$_FILES['file_upload']['type']."', ";
        $q .= "file_is_image='" . $is_image."', ";
        $q .= "file_image_height='" . $file_image_height."', ";
        $q .= "file_image_width='" . $file_image_width."', ";
        $q .= "file_image_thumb_height='" . $file_image_thumb_height."', ";
        $q .= "file_image_thumb_width='" . $file_image_thumb_width."', ";
      }
      $q .= "file_published='" . $d["file_published"]."', ";
      if( !$is_download_attribute) 
        $q .= "file_title='" . $d['file_title']."', ";
      $q .= "file_url='" . $d["file_url"]."'; ";
      $db->setQuery($q);
      $db->query();
    }
    else {
      $q = "UPDATE #__{vm}_product_files SET ";
      if( !empty($_FILES['file_upload']['name'])) {
        $q .= "file_name='" . $filename."', ";
        $q .= "file_extension='$ext', ";
        $q .= "file_mimetype='" .$_FILES['file_upload']['type']."', ";
        $q .= "file_is_image='" . $is_image."', ";
        $q .= "file_image_height='" . $file_image_height."', ";
        $q .= "file_image_width='" . $file_image_width."', ";
        $q .= "file_image_thumb_height='" . $file_image_thumb_height."', ";
        $q .= "file_image_thumb_width='" . $file_image_thumb_width."', ";
      }
      if( !$is_download_attribute) 
        $q .= "file_title='" . $d["file_title"]."', ";
      $q .= "file_published='" . $d["file_published"]."', ";
      $q .= "file_url='" . $d["file_url"]."' ";
      $q .= "WHERE file_id='" . $d["file_id"] . "' ";
      $q .= "AND file_product_id='" . $d["product_id"] . "' ";
      $db->setQuery($q);
      $db->query();
    }
    return True;
  }

  /**************************************************************************
   * name: delete()
   * created by: soeren
   * description: Should delete a file record and delete the file physically.
   * parameters: 
   * returns:
   **************************************************************************/
	/**
	* Controller for Deleting Records.
	*/
	function delete(&$d) {
	
		$record_id = $d["file_id"];
		
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
	
		global $VM_LANG;
		$dbf = new ps_DB;
		
		if (!$this->validate_delete($record_id, $d)) {
		  return False;
		}
		$q = "SELECT file_name,file_is_image FROM #__{vm}_product_files WHERE file_id='$record_id'";
		$dbf->setQuery($q);
		$dbf->query();
		$dbf->next_record();
		$_REQUEST['mosmsg'] = "";
		
		if( $dbf->f("file_is_image") ) {
		  $info = pathinfo($dbf->f("file_name"));
		  if( !@unlink(realpath($dbf->f("file_name"))) )
			$_REQUEST['mosmsg'] = $VM_LANG->_PHPSHOP_FILES_FULLIMG_DELETE_FAILURE;
		  else
			$_REQUEST['mosmsg'] = $VM_LANG->_PHPSHOP_FILES_FULLIMG_DELETE_SUCCESS;
		  $thumb = $info["dirname"]."/resized/".basename($dbf->f("file_name"), ".".$info["extension"])."_".PSHOP_IMG_WIDTH."x".PSHOP_IMG_HEIGHT.".".$info["extension"];
		  if( !@unlink( realpath($thumb) ) )
			$_REQUEST['mosmsg'] .= $VM_LANG->_PHPSHOP_FILES_THUMBIMG_DELETE_FAILURE." ". $thumb ;
		  else
			$_REQUEST['mosmsg'] .= $VM_LANG->_PHPSHOP_FILES_THUMBIMG_DELETE_SUCCESS;
		}
		elseif( $dbf->f("file_name") ) {
		  if( !@unlink(realpath($dbf->f("file_name"))) )
			$_REQUEST['mosmsg'] = $VM_LANG->_PHPSHOP_FILES_FILE_DELETE_FAILURE;
		  else
			$_REQUEST['mosmsg'] = $VM_LANG->_PHPSHOP_FILES_FILE_DELETE_SUCCESS;
		}
		
		$q = "DELETE FROM #__{vm}_product_files WHERE file_id='$record_id'";
		$dbf->setQuery($q);
		$dbf->query();
		
		return True;
	}
  
  /**************************************************************************
   * name: get_file_list()
   * created by: soeren
   * description: List all published and non-payable files ( not images! )
   * parameters: 
   * returns:
   **************************************************************************/
  function get_file_list( $product_id ) {

    $dbf = new ps_DB;
    $html = "";
	$sql = 'SELECT attribute_value FROM #__{vm}_product_attribute WHERE `product_id` = \''.$product_id.'\' AND attribute_name=\'download\'';
	$dbf->query( $sql );
	$dbf->next_record();
    $sql = 'SELECT file_id, file_mimetype, file_title'
        . ' FROM `#__{vm}_product_files` '
        . ' WHERE file_title != \''.$dbf->f( "attribute_value" ).'\' AND file_product_id = \''.$product_id.'\' AND file_published = \'1\' AND file_is_image = \'0\'';
    $dbf->setQuery($sql);
    $dbf->query();
	
    while( $dbf->next_record() ) {
      // Show pdf in a new Window, other file types will be offered as download
      $target = stristr($dbf->f("file_mimetype"), "pdf") ? "_blank" : "_self";
      $html .= "<a target=\"$target\" href=\"index.php?option=com_virtuemart&page=shop.getfile&file_id=".$dbf->f("file_id")."&product_id=$product_id\" title=\"".$dbf->f("file_title")."\">\n";
      $html .= $dbf->f("file_title") . "</a><br/>\n";
    }
    return $html;
  }
  
  /**************************************************************************
   * name: send_file()
   * created by: soeren
   * description: 
   * Sends the requested file to the browser 
   * and assures that the requested file is no payable product download file
   * parameters: 
   * returns:
   **************************************************************************/
  function send_file( $file_id, $product_id ) {
    global $VM_LANG;
    $dbf = new ps_DB;
    $html = "";
    $sql = 'SELECT file_mimetype, file_name'
        . ' FROM `#__{vm}_product_files` '
        . ' LEFT JOIN #__{vm}_product_attribute ON `product_id` = \''.$product_id.'\''
        . ' WHERE file_title NOT IN ( attribute_value )'
        . ' AND file_product_id = \''.$product_id.'\' AND file_published = \'1\' AND file_id = \''.$file_id.'\' AND file_is_image = \'0\'';
    $dbf->setQuery($sql);
    $dbf->query();
    if( $dbf->next_record() && is_readable($dbf->f("file_name") ) ) {
      // dump anything in the buffer
      @ob_end_clean();
    
      header('Content-Type: ' . $dbf->f("file_mimetype"));
      if(!stristr($dbf->f("file_mimetype"), "pdf"))
        header('Content-Disposition: attachment; filename="' . basename($dbf->f("file_name")) . '"');
      /*** Now send the file!! ***/
      readfile( $dbf->f("file_name") );
    
      exit();
    }
    else {
      echo "<span class=\"message\">".$VM_LANG->_PHPSHOP_FILES_NOT_FOUND."</span>";
    }
    return true;
  }
  
}
  
?>
