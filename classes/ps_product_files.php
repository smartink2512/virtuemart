<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
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


	/**
	 * Checks if a file can be added or not
	 *
	 * @param array $d
	 * @return boolean
	 */
	function validate_add( &$d ) {

		$db = new ps_DB;

		if (empty($_FILES["file_upload"]["name"]) && empty($d['file_url']) && empty( $d['downloadable_file'])) {
			$GLOBALS['vmLogger']->err( "You must either Upload a File or provide a File URL." );
			return False;
		}
		if (empty($d["product_id"])) {
			$GLOBALS['vmLogger']->err( "A product ID must be specified." );
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

	/**
	 * Checks for correct update conditions
	 *
	 * @param array $d
	 * @return boolean
	 */
	function validate_update( &$d ) {
		global $vmLogger;
		
		$db = new ps_DB;
		if (empty($d["product_id"])) {
			$vmLogger->err( "A product ID must be specified.");
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

	/**
	 * Checks if a file can be deleted
	 *
	 * @param int $file_id
	 * @param array $d
	 * @return boolean
	 */
	function validate_delete( $file_id, &$d ) {

		if (empty($file_id)) {
			$GLOBALS['vmLogger']->err( "Please select a file to delete." );
			return False;
		}
		return true;
	}


	/**
	 * Upload a file & Create a new File entry
	 * @author soeren
	 * @param array $d
	 * @return boolean
	 */
	function add( &$d ) {
		global $mosConfig_absolute_path, $mosConfig_live_site, 
			$database, $VM_LANG, $vmLogger;

		$db = new ps_DB;
		$timestamp = time();

		if (!$this->validate_add($d)) {
			return False;
		}

		if( empty( $d["file_published"] )) {
			$d["file_published"] = 0;
		}
		if( empty( $d["file_create_thumbnail"] )) {
			$d["file_create_thumbnail"] = 0;
		}

		// Do we have an uploaded file?
		if( !empty($_FILES['file_upload']['name']) ) {
			if( !$this->handleFileUpload( $d ) ) {
				return false;
			}
			$is_image = $d['is_image'];
			$filename = $d['uploaddir'].$d['filename'];
			$ext = $d['ext'];
			$upload_success = $d['upload_success'];
			$file_image_height = intval(@$d['file_image_height']);$file_image_width = intval(@$d['file_image_width']);
			$file_image_thumb_height = intval(@$d['file_image_thumb_height']);$file_image_thumb_width = intval(@$d['file_image_thumb_width']);
		}
		else {
			// No file uploaded, but specified by URL
			if( stristr( $d['file_type'], "image" )) {
				$is_image = "1";
			}
			else {
				$is_image = "0";
			}
			if( !empty($d['file_url'])) {
				$filename = '';
			} else {
				$filename = DOWNLOADROOT.@$d['downloadable_file'];
				$d["file_title"] = basename( @$d['downloadable_file'] );
			}
			$ext = "";
			$upload_success = true;
			$file_image_height = $file_image_width = $file_image_thumb_height = $file_image_thumb_width = "";
		}

		$filename = $GLOBALS['vmInputFilter']->safeSQL( $filename );
		
		$d["file_title"] = $GLOBALS['vmInputFilter']->safeSQL( $d["file_title"] );
		
		if( $d['file_type'] == 'product_images' ||  $d['file_type'] == 'product_full_image' ||  $d['file_type'] == 'product_thumb_image') {
			// Handle Product Images
			$filename = @str_replace( IMAGEPATH.'product/', '', $filename );
			$fullimage = @str_replace( IMAGEPATH.'product/', '', $filename );
			$thumbimage = @str_replace( IMAGEPATH.'product/', '', $d['fileout'] );
			$q = 'UPDATE `#__{vm}_product` SET ';
			if( $d['file_type'] == 'product_images' || $d['file_type'] == 'product_full_image' ) {
				$q .= '`product_full_image`=\''.$fullimage.'\'';
			}
			if( $d['file_type'] == 'product_images' ) {
				$q .= ', `product_thumb_image`=\''.$thumbimage.'\'';
			}
			if( $d['file_type'] == 'product_thumb_image' ) {
				$q .= '`product_thumb_image`=\''.$filename.'\'';
			}
			$q .= ' WHERE `product_id` ='.intval( $d["product_id"] );
			$db->query( $q );
			return true;
		}
		else {
			// erase $mosConfig_absolute_path to have a relative path
			$filename = str_replace( $mosConfig_absolute_path, '', $filename );
			if( $d['file_type'] == 'downloadable_file') {
				// Insert an attribute called "download", attribute_value: filename
				$q2  = "INSERT INTO #__{vm}_product_attribute ";
				$q2 .= "(product_id,attribute_name,attribute_value) ";
				$q2 .= "VALUES ('" . $d["product_id"] . "','download','".basename($filename)."')";
				$db->query($q2);
				
			}
			$q = "INSERT INTO #__{vm}_product_files ";
			$q .= "(file_product_id, file_name, file_title, file_extension, file_mimetype, file_url, file_published,";
			$q .= "file_is_image, file_image_height , file_image_width , file_image_thumb_height, file_image_thumb_width )";
			$q .= " VALUES ('".$d["product_id"]."', '$filename','".$d["file_title"] . "','$ext','".$_FILES['file_upload']['type']."', '".$d['file_url']."', '".$d["file_published"]."',";
			$q .= "'$is_image', '$file_image_height', '$file_image_width', '$file_image_thumb_height', '$file_image_thumb_width')";
			$db->setQuery($q);
			$db->query();
	
			$_REQUEST['file_id'] = $db->last_insert_id();
		}
		return True;

	}

	/**
	 * Updates a file record
	 *
	 * @param array $d
	 * @return boolean
	 */
	function update( &$d ) {
		global $mosConfig_absolute_path, $mosConfig_live_site, 
			$database, $VM_LANG, $vmLogger;
		$db = new ps_DB;
		$timestamp = time();

		if (!$this->validate_update($d)) {
			return False;
		}
		if( empty( $d["file_published"] )) {
			$d["file_published"] = 0;
		}

		$is_download_attribute = false;

		$q_dl = "SELECT attribute_name,attribute_value,file_id from #__{vm}_product_attribute,#__{vm}_product_files WHERE ";
		$q_dl .= "product_id='".$d["product_id"]."' AND attribute_name='download' ";
		$q_dl .= "AND file_id='".$d["file_id"]."' AND attribute_value=file_title";
		$db->query($q_dl);

		if( $db->next_record() ) {
			
			$old_attribute = $db->f('attribute_value', false);
			$is_download_attribute = true;
			if( !empty($_FILES['file_upload']['name']) && $d['file_type']== 'downloadable_file') {
				// new file uploaded
				$qu = "UPDATE #__{vm}_product_attribute ";
				$qu .= "SET attribute_value = '". $_FILES['file_upload']['name'] ."' ";
				$qu .= "WHERE product_id='".$d["product_id"]."' AND attribute_name='download' AND attribute_value='".$old_attribute."'";
				$db->query($qu);
			}
			elseif($d['file_type'] != 'downloadable_file') {
				$qu = "DELETE FROM #__{vm}_product_attribute ";
				$qu .= "WHERE attribute_value = '$old_attribute' ";
				$qu .= "AND product_id='".$d["product_id"]."' AND attribute_name='download'";
				$db->query($qu);				
			}
		}
		elseif( $d['file_type'] == 'downloadable_file') {
			// Insert an attribute called "download", attribute_value: filename
			$q2  = "INSERT INTO #__{vm}_product_attribute ";
			$q2 .= "(product_id,attribute_name,attribute_value) ";
			$q2 .= "VALUES ('" . $d["product_id"] . "','download','".basename(@$d['downloadable_file'])."')";
			$db->query($q2);
		}
		if( empty( $d["file_create_thumbnail"] )) {
			$d["file_create_thumbnail"] = 0;
		}


		if( !empty($_FILES['file_upload']['name']) ) {
			$this->delete( $d );
			return $this->add( $d );
		}
		else {
			if( $d['file_type'] == "image" ) {
				$is_image = "1";
			}
			else {
				$is_image = "0";
			}
			if( !empty($d['file_url'])) {
				$filename = '';
			} elseif( $d['file_type'] == 'downloadable_file' && !empty($old_attribute)) {
				
				$filename = DOWNLOADROOT.@$d['downloadable_file'];
				$d["file_title"] = $db->getEscaped(basename( @$d['downloadable_file'] ));
				$qu = "UPDATE #__{vm}_product_attribute ";
				$qu .= "SET attribute_value = '". $d["file_title"] ."' ";
				$qu .= "WHERE product_id='".$d["product_id"]."' AND attribute_name='download' AND attribute_value='".$old_attribute."'";
				$db->query($qu);	
				
			}
			$ext = "";
			$upload_success = true;
			$file_image_height = $file_image_width = $file_image_thumb_height = $file_image_thumb_width = "";
		}

		$q = "UPDATE #__{vm}_product_files SET ";
		if( !empty($filename)) {
			$q .= "file_name='" . $filename."', ";
		}
		$q .= "file_title='" . $d["file_title"]."', ";
		$q .= "file_published='" . $d["file_published"]."', ";
		$q .= "file_url='" . $d["file_url"]."' ";
		$q .= "WHERE file_id='" . $d["file_id"] . "' ";
		$q .= "AND file_product_id='" . $d["product_id"] . "' ";
		$db->setQuery($q);
		$db->query();
		
		return True;
	}

	/**
	 * Controller for Deleting Records.
	 *
	 * @param array $d
	 * @return boolean
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
	 * Should delete a file record and delete the file physically.
	 *
	 * @param int $record_id
	 * @param array $d
	 * @return boolean
	 */
	function delete_record( $record_id, &$d ) {

		global $VM_LANG, $vmLogger, $mosConfig_absolute_path;
		$dbf = new ps_DB;

		if (!$this->validate_delete($record_id, $d)) {
			return False;
		}
		if( $record_id == 'product_images' ) {
			return $this->deleteProductImages($d);
		}
		else {
			$q = "SELECT file_id,file_product_id, file_name,file_is_image FROM `#__{vm}_product_files` WHERE file_id='$record_id'";
			$dbf->query($q);
			$dbf->next_record();
		}
		$fullfilepath = $mosConfig_absolute_path. str_replace($mosConfig_absolute_path, '', $dbf->f("file_name") );
		if( !is_file($fullfilepath)) {
			$fullfilepath = DOWNLOADROOT . $dbf->f('file_name');
		}
		
		if( $dbf->f("file_is_image") ) {
			$info = pathinfo($fullfilepath);
			
			if( !@unlink(realpath($fullfilepath)) ) {
				$vmLogger->err( $VM_LANG->_PHPSHOP_FILES_FULLIMG_DELETE_FAILURE );
			}
			else {
				$vmLogger->info( $VM_LANG->_PHPSHOP_FILES_FULLIMG_DELETE_SUCCESS );
			}

			$thumb = $info["dirname"]."/resized/".basename($fullfilepath, ".".$info["extension"])."_".PSHOP_IMG_WIDTH."x".PSHOP_IMG_HEIGHT.".".$info["extension"];
			if( file_exists($thumb) ) {
				if( !@unlink( realpath($thumb) ) ) {	
					$vmLogger->err( $VM_LANG->_PHPSHOP_FILES_THUMBIMG_DELETE_FAILURE." ". $thumb );
				}
				else {
					$vmLogger->info( $VM_LANG->_PHPSHOP_FILES_THUMBIMG_DELETE_SUCCESS );
				}
			}
		}
		elseif( $fullfilepath ) {
			if( !@unlink(realpath($fullfilepath)) ) {
				$vmLogger->err( $VM_LANG->_PHPSHOP_FILES_FILE_DELETE_FAILURE );
			}
			else {
				$vmLogger->info( $VM_LANG->_PHPSHOP_FILES_FILE_DELETE_SUCCESS );
			}
		}
		
		$q_del = "DELETE FROM #__{vm}_product_attribute WHERE ";
		$q_del .= "product_id='".$dbf->f('file_product_id')."' AND attribute_name='download' AND attribute_value='".basename($dbf->f('file_name', false ))."'";
		$dbf->query($q_del);
				
		$q = "DELETE FROM #__{vm}_product_files WHERE file_id='$record_id'";
		$dbf->setQuery($q);
		$dbf->query();

		return True;
	}
	/**
	 * Deletes product images
	 *
	 * @param array $d
	 */
	function deleteProductImages( &$d ) {
		$dbf = new ps_DB;
		$q = "SELECT product_id, product_full_image, product_thumb_image FROM `#__{vm}_product` WHERE product_id=".intval( $d['product_id']);
		$dbf->query($q);
		$dbf->next_record();
		$sql = array( 'product_id=product_id');
		if( $dbf->f('product_full_image') && (@$d['file_type'] == 'product_images' || @$d['file_type'] == 'product_full_image') ) {		
			$fullfilepath = IMAGEPATH .'product/'.$dbf->f('product_full_image');
			if( !@unlink( realpath($fullfilepath) ) && file_exists($fullfilepath) ) {
				$vmLogger->err( $VM_LANG->_PHPSHOP_FILES_THUMBIMG_DELETE_FAILURE." ". $thumb );
			}	
			$sql[] = "product_full_image =''";
		}
		if( $dbf->f('product_thumb_image') && (@$d['file_type'] == 'product_images' || @$d['file_type'] == 'product_thumb_image') ) {
			$thumbfilepath = IMAGEPATH .'product/'.$dbf->f('product_thumb_image');
			if( !@unlink( realpath($thumbfilepath) ) && file_exists($thumbfilepath) ) {
				$vmLogger->err( $VM_LANG->_PHPSHOP_FILES_THUMBIMG_DELETE_FAILURE." ". $thumb );
			}
			$sql[] = "product_thumb_image =''";
		}
		$q = "UPDATE `#__{vm}_product` SET ".implode(',', $sql)." WHERE product_id=".intval( $d['product_id']);
		$dbf->query($q);
		
	}
	/**
	 * This function handles the file upload
	 * and image resizing when necessary
	 *
	 * @param array $d
	 * @return boolean
	 */
	function handleFileUpload( &$d ) {
		global $vmLogger, $VM_LANG, $mosConfig_absolute_path;
		require_once(CLASSPATH . 'imageTools.class.php' );
		// Uploaded file branch
		$upload_success = false;
		$fileinfo = pathinfo( $_FILES['file_upload']['name'] );
		$d['ext'] = $ext = $fileinfo["extension"];

		if( $this->fileexists ) {
			// must rename uploaded file!
			$d['filename'] = uniqid(substr(basename($_FILES['file_upload']['name'], ".$ext" )));
		}
		else {
			$d['filename'] = $_FILES['file_upload']['name'];
		}

		// This plays a role when a file is added from the ps_product class
		// on adding and updating a downloadable product
		if( $d['file_type'] == 'downloadable_file' ) {
			$d["file_title"] = $d['filename'];
		}

		switch( $d["upload_dir"] ) {
			case "IMAGEPATH":
				$uploaddir = IMAGEPATH ."product/";
				break;
			case "FILEPATH":
				$uploaddir = $mosConfig_absolute_path. trim( $d["file_path"] );
				if( !file_exists($uploaddir) ) {
					@mkdir( $uploaddir );
				}
				if( !file_exists( $uploaddir ) ) {
					$vmLogger->err( $VM_LANG->_PHPSHOP_FILES_PATH_ERROR );
					return false;
				}
				
				if( substr( $uploaddir, strlen($uploaddir)-1, 1) != '/') {
					$uploaddir .= '/';
				}
				break;
			case "DOWNLOADPATH":
				$uploaddir = DOWNLOADROOT;
				break;
		}
		$d['uploaddir'] = $uploaddir;
		if( $this->checkUploadedFile( 'file_upload' ) ) {
			$d['upload_success'] = $this->moveUploadedFile( 'file_upload', $uploaddir.$d['filename']);
		}
		else {
			$vmLogger->err( $VM_LANG->_PHPSHOP_FILES_UPLOAD_FAILURE );
			return false;
		}
		
		switch( @$d['file_type'] ) {
			case 'image':
			case 'product_images':
			case 'product_full_image':
			case 'product_thumb_image':
				
				$d['is_image'] = "1";
				$d["file_url"] = IMAGEURL."product/".$d['filename'];

				if( !empty($d["file_create_thumbnail"]) ) {
					## RESIZE THE IMAGE ####
					$tmp_filename = $uploaddir . $d['filename'];
					$height = intval( $d['thumbimage_height'] );
					$width = intval( $d['thumbimage_width'] );
					$d['fileout'] = $fileout = $this->createThumbImage($tmp_filename, 'product', $height, $width );

					if( is_file( $fileout ) ) {
						$vmLogger->info( $VM_LANG->_PHPSHOP_FILES_IMAGE_RESIZE_SUCCESS );
						$thumbimg = getimagesize( $fileout );
						$d['file_image_thumb_width'] = $thumbimg[0];
						$d['file_image_thumb_height'] = $thumbimg[1];
					}
					else {
						$vmLogger->warning( $VM_LANG->_PHPSHOP_FILES_IMAGE_RESIZE_FAILURE );
						$d['file_image_thumb_height'] = "";
						$d['file_image_thumb_width'] = "";
					}
					$fullimg = getimagesize( $tmp_filename );
					$d['file_image_width'] = $fullimg[0];
					$d['file_image_height'] = $fullimg[1];
					
				}
				if( !empty($d["file_resize_fullimage"])) {
					// Resize the full image!
					$height = intval( $d['fullimage_height'] );
					$width = intval( $d['fullimage_width'] );
					
					vmImageTools::resizeImage( $uploaddir.$d['filename'], $uploaddir.$d['filename'], $width, $height );
					
					$fullimg = getimagesize( $uploaddir.$d['filename'] );
					$d['file_image_width'] = $fullimg[0];
					$d['file_image_height'] = $fullimg[1];
				}
				break;
		
			default:
				### File Upload ###
				$d['is_image'] = "0";
				$d['file_image_height'] = $d['file_image_width'] = $d['file_image_thumb_height'] = $d['file_image_thumb_width'] = "";
				break;
		}
		return true;
	}
	
	/**
	 * List all published and non-payable files ( not images! )
	 * @author soeren
	 * @static 
	 * @param int $product_id
	 * @return mixed
	 */
	function get_file_list( $product_id ) {
		global $mosConfig_absolute_path, $sess;
		$dbf = new ps_DB;
		$html = "";
		$sql = 'SELECT attribute_value FROM #__{vm}_product_attribute WHERE `product_id` = \''.$product_id.'\' AND attribute_name=\'download\'';
		$dbf->query( $sql );
		$dbf->next_record();
		$exclude_filename = $GLOBALS['vmInputFilter']->safeSQL( $dbf->f( "attribute_value" ) );
		$sql = 'SELECT DISTINCT file_id, file_mimetype, file_title, file_name'
			. ' FROM `#__{vm}_product_files` WHERE ';
		if( $exclude_filename ) {
			$sql .= ' file_title != \''.$exclude_filename.'\' AND ';
		}
		$sql .= 'file_product_id = \''.$product_id.'\' AND file_published = \'1\' AND file_is_image = \'0\'';
		$dbf->setQuery($sql);
		$dbf->query();

		while( $dbf->next_record() ) {
			$filename = $mosConfig_absolute_path. str_replace($mosConfig_absolute_path, '', $dbf->f("file_name") );
			$filesize = @filesize($filename) / 1048000;
			if( $filesize > 0.5) {
				$filesize_display = ' ('. number_format( $filesize, 2,',','.')." MB)";
			}
			else {
				$filesize_display = ' ('. number_format( $filesize*1024, 2,',','.')." KB)";
			}
			// Show pdf in a new Window, other file types will be offered as download
			$target = stristr($dbf->f("file_mimetype"), "pdf") ? "_blank" : "_self";
			$link = $sess->url( $_SERVER['PHP_SELF'].'?page=shop.getfile&amp;file_id='.$dbf->f("file_id")."&amp;product_id=$product_id" );
			$html .= "<a target=\"$target\" href=\"$link\" title=\"".$dbf->f("file_title")."\">\n";
			$html .= $dbf->f("file_title") . $filesize_display. "</a><br/>\n" ;
		}
		return $html;
	}
	
	/**
	 * Returns the number of files AND images which are assigned to $pid
	 *
	 * @param int $pid
	 * @param string $type Filter the query by file_is_image: [files|images|(empty)]
	 * @return int
	 */
	function countFilesForProduct( $pid, $type = '' ) {
		$db = new ps_DB();
		switch( $type ) {
			case 'files': $type_sql = 'AND file_is_image=0'; break;
			case 'images': $type_sql = 'AND file_is_image=1'; break;
			default: $type_sql = ''; break;
		}
		$db->query( "SELECT COUNT(file_id) AS files FROM #__{vm}_product_files WHERE file_product_id=".intval($pid)." AND file_published=1 $type_sql" );
		$db->next_record();
		$files = $db->f('files');
		unset( $db );
		
		return $files;
	}
	/**
	 * Returns an array holding all the files and images of the specified product
	 * $files['files'] holds all files as objects
	 * $files['images'] holds all images as objects
	 *
	 * @param unknown_type $pid
	 * @return unknown
	 */
	function getFilesForProduct( $pid ) {
		$db= new ps_DB();
		$files['images'] = array();
		$files['files'] = array();
		$db->query( "SELECT * FROM `#__{vm}_product_files` WHERE `file_product_id`=".intval($pid)." AND `file_published`=1" );
		while( $db->next_record() ) {
			switch( $db->f('file_is_image') ) {
				case 0: $files['files'][] = $db->get_row(); break;
				case 1: $files['images'][] = $db->get_row(); break;
			}
		}
		
		return $files;
		
	}
	/**
	 * Checks if a file is a restricted downloadable product file
	 * a user must pay for
	 *
	 * @param int $file_id
	 * @param int $product_id
	 * @return boolean
	 */
	function isProductDownloadFile( $file_id, $product_id ) {
		$db = new ps_DB;
		$q_dl = "SELECT attribute_value, attribute_name,file_id from #__{vm}_product_attribute,#__{vm}_product_files WHERE ";
		$q_dl .= "product_id=".intval($product_id)." AND attribute_name='download' ";
		$q_dl .= "AND file_id=".intval($file_id)." AND attribute_value=file_title";
		$db->query($q_dl);
		if( $db->next_record() ) {
			return true;
		}
		return false;
	}
	
	/**
	 * Sends the requested file to the browser
	 * and assures that the requested file is no payable product download file
	 * @author soeren
	 * @param int $file_id
	 * @param int $product_id
	 * @return mixed
	 */
	function send_file( $file_id, $product_id ) {
		global $VM_LANG, $vmLogger, $mosConfig_absolute_path;
		$dbf = new ps_DB;
		$html = "";
		
		$sql = 'SELECT attribute_value FROM #__{vm}_product_attribute WHERE `product_id` = \''.$product_id.'\' AND attribute_name=\'download\'';
		$dbf->query( $sql );
		$dbf->next_record();
		$exclude_filename = $GLOBALS['vmInputFilter']->safeSQL( $dbf->f( "attribute_value" ) );
		
		$sql = 'SELECT file_mimetype, file_name'
		. ' FROM `#__{vm}_product_files` WHERE ';
		if( $exclude_filename ) {
			$sql .= ' file_title != \''.$exclude_filename.'\' AND ';
		}
		$sql .= ' file_product_id = \''.$product_id.'\' AND file_published = \'1\' AND file_id = \''.$file_id.'\' AND file_is_image = \'0\'';
		
		$dbf->setQuery($sql);
		$dbf->query();
		if( !$dbf->next_record() ) {
			$vmLogger->err( $VM_LANG->_PHPSHOP_FILES_NOT_FOUND );
			return false;
		}
		$filename = $mosConfig_absolute_path. str_replace($mosConfig_absolute_path, '', $dbf->f("file_name") );
		// dump anything in the buffer
		while( @ob_end_clean() );
		
		if( strtolower(substr($filename,0,4))=='http') {
			mosRedirect( $filename );
		}

		if( $filename ) {

			header('Content-Type: ' . $dbf->f("file_mimetype"));

			$ext = $dbf->f('file_extension');
			if(!stristr($dbf->f("file_mimetype"), "pdf") && $ext != 'pdf') {
				header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
			}
			/*** Now send the file!! ***/
			readfile( $filename );

			exit();
		}
		else {
			$vmLogger->err( $VM_LANG->_PHPSHOP_FILES_NOT_FOUND );
		}
		return true;
	}
	
	/**
	 * Checks if a file was correctly uploaded.
	 *
	 * @param string $fieldname The name of the index in $_FILES to check
	 * @return boolean True when the file upload is correct, false when not.
	 */
	function checkUploadedFile( $fieldname ) {
		global $vars, $vmLogger;
		if( (!is_uploaded_file( @$_FILES[$fieldname]['tmp_name']) && strstr( $fieldname, 'thumb')
			|| substr( @$_REQUEST[$fieldname.'_url'], 0, 4 ) == 'http' )) {
			return true;
		}
		elseif( is_uploaded_file(@$_FILES[$fieldname]['tmp_name'])) {
			return true;
		}
		else {
			switch( @$_FILES[$fieldname]['error'] ){
				case 0: //no error; possible file attack!
					//$vmLogger->warning( "There was a problem with your upload." );
					break;
				case 1: //uploaded file exceeds the upload_max_filesize directive in php.ini
					$vmLogger->warning( "The file you are trying to upload is too big." );
					break;
				case 2: //uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form
					$vmLogger->warning( "The file you are trying to upload is too big." );
					break;
				case 3: //uploaded file was only partially uploaded
					$vmLogger->warning( "The file you are trying upload was only partially uploaded." );
					break;
				case 4: //no file was uploaded
					//$vmLogger->warning( "You have not selected a file/image for upload." );
					break;
				default: //a default error, just in case!  :)
					//$vmLogger->warning( "There was a problem with your upload." );
					break;
			}
			
			return false;
		}
	}
	/**
	 * Moves an uploaded file $_FILES[$fieldname] to $storefilename
	 *
	 * @param string $fieldname The array index of the _FILES array
	 * @param string $storefilename The full path including filename to the store path
	 */
	function moveUploadedFile( $fieldname, $storefilename ) {
		if( !is_uploaded_file( $_FILES[$fieldname]['tmp_name'] )) {
			return true;
		}
		if( move_uploaded_file( $_FILES[$fieldname]['tmp_name'], $storefilename )) {
			chmod( $storefilename, 0644 );
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Resizes an image
	 *
	 * @param string $fileName
	 * @param string $section
	 * @param int $height
	 * @param int $width
	 * @return string
	 */
	function createThumbImage( $fileName, $section='product', $height=PSHOP_IMG_HEIGHT, $width=PSHOP_IMG_WIDTH) {
		require_once(CLASSPATH . 'imageTools.class.php' );
		/* Generate Image Destination File Name */
		$pathinfo = pathinfo( $fileName );
		
		$to_file_thumb = basename( $fileName, '.'.$pathinfo['extension'])."_".$height."x".$width.".".$pathinfo['extension'];
		
		$fileout = IMAGEPATH."$section/resized/".$to_file_thumb;
		
		vmImageTools::ResizeImage( $fileName, $fileout, $height, $width );
		
		return $fileout;
			
	}
	
	function getRemoteFile( $url ) {
			@ini_set( "allow_url_fopen");
			$remote_fetching = ini_get( "allow_url_fopen");
			if( $remote_fetching ) {
				$handle = fopen( $url , "rb" );
				$data = "";
				while( !feof( $handle )) {
					$data .= fread( $handle, 4096 );
				}
				fclose( $handle );
				$tmp_file = tempnam(IMAGEPATH."/product/", "FOO");
				$handle = fopen($tmp_file, "wb");
				fwrite($handle, $data);
				fclose($handle);
				
				return $tmp_file;
				
			}
			else {
				return false;
			}
	}
	
	function isImage( $type, $file ) {
	
		switch($type) {
			case "image/gif":
			case "image/jpeg":
			case "image/png":
				return true;
				
			default:
			$image_info = getimagesize($file);
			switch($image_info[2]) {
				case 1:
				case 2:
				case 3:
					return true;
				default:
					return false;
			}
		}
	}
}
?>
