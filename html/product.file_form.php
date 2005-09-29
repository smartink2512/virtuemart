<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: product.file_form.php,v 1.3 2005/09/27 17:51:26 soeren_nb Exp $
* @package VirtueMart
* @subpackage html
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
mm_showMyFileName( __FILE__ );

$product_id= mosgetparam( $_REQUEST, 'product_id');

$q = "SELECT product_name FROM #__{vm}_product WHERE product_id='$product_id' "; 
$db->query($q);  
$db->next_record();
$selected_type[0] = "checked=\"checked\"";
$selected_type[1] = "";

$title ='<img src="'. $mosConfig_live_site .'/administrator/images/mediamanager.png" width="48" height="48" align="center" alt="Product List" border="0" />'
		. $VM_LANG->_PHPSHOP_FILES_FORM . ": ". $db->f("product_name");


$file_id= mosgetparam( $_REQUEST, 'file_id' );

$selected_type = Array();
if( !empty($file_id) ) {
  $q = "SELECT file_name,file_url,file_is_image,file_published,file_title 
  FROM #__{vm}_product_files 
  WHERE file_id='$file_id'"; 
  $db->query($q);  
  $db->next_record();
  $selected_type[0] = $db->f("file_is_image")==1 ? "checked=\"checked\"" : "";
  $selected_type[1] = $db->f("file_is_image")==0 ? "checked=\"checked\"" : "";
}
else {
	$default["file_title"] = "My Title";
	$default["file_published"] = "1";
}

//First create the object and let it print a form heading
$formObj = &new formFactory( $title );
//Then Start the form
$formObj->startForm( 'adminForm', 'enctype="multipart/form-data"');

?>
<br />
  <table class="adminform">
  <?php if( $file_id ) { ?>
    <tr> 
      <td><div align="right" ><strong><?php echo $VM_LANG->_PHPSHOP_FILES_FORM_CURRENT_FILE ?>:</strong></div></td>
      <td><?php echo $db->f("file_name") ?></td>
    </tr>
    <?php } ?>
    <tr> 
      <td><div align="right" ><strong><?php echo $VM_LANG->_PHPSHOP_FILES_FORM_FILE ?>:</strong></div></td>
      <td> 
        <input type="file" class="inputbox" name="file_upload" size="32" />
      </td>
    </tr>
    <tr> 
      <td valign="top"><div align="right" ><strong><?php echo $VM_LANG->_PHPSHOP_FILES_LIST_FILETYPE ?>:</strong></div></td>
      <td> 
        <input type="radio" onchange="checkThumbnailing();" <?php echo $selected_type[0] ?> class="inputbox" name="file_type" value="image" >
        <?php echo $VM_LANG->_PHPSHOP_FILES_FORM_IMAGE ?><br/>
        <input type="radio" onchange="checkThumbnailing();" <?php echo $selected_type[1] ?> class="inputbox" name="file_type" value="file">
        <?php echo $VM_LANG->_PHPSHOP_FILES_FORM_FILE ?>
      </td>
    </tr>
    <tr> 
      <td valign="top"><div align="right" ><strong><?php echo $VM_LANG->_PHPSHOP_FILES_FORM_UPLOAD_TO ?>:</strong></div></td>
      <td> 
        <input type="radio" class="inputbox" name="upload_dir" checked="checked" value="IMAGEPATH" />
        <?php echo $VM_LANG->_PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH ?><br/><br/>
        <input type="radio" class="inputbox" name="upload_dir" value="FILEPATH" />
        <?php echo $VM_LANG->_PHPSHOP_FILES_FORM_UPLOAD_OWNPATH ?>:
        &nbsp;&nbsp;&nbsp;<input type="text" class="inputbox" name="file_path" size="40" value="<?php echo $mosConfig_absolute_path ?>/media/" /><br/><br/>
        <input type="radio" class="inputbox" name="upload_dir" value="DOWNLOADPATH" /><?php echo $VM_LANG->_PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH ?>
      </td>
    </tr>
    <tr> 
      <td><div align="right" ><strong><?php echo $VM_LANG->_PHPSHOP_FILES_FORM_AUTO_THUMBNAIL ?></strong></div></td>
      <td> 
        <input type="checkbox" class="inputbox" name="file_create_thumbnail" checked="checked" value="1" />
      </td>
    </tr>

    <tr> 
      <td><div align="right" ><strong><?php echo $VM_LANG->_PHPSHOP_FILES_FORM_FILE_PUBLISHED ?></strong></div></td>
      <td> 
        <input type="checkbox" class="inputbox" name="file_published" value="1" <?php if($db->sf("file_published")==1) echo "checked=\"checked\"" ?> size="16" />
      </td>
    </tr>
    <tr> 
      <td><div align="right" ><strong><?php echo $VM_LANG->_PHPSHOP_FILES_FORM_FILE_TITLE ?>:</strong></div></td>
      <td> 
        <input type="text" class="inputbox" name="file_title" size="32" value="<?php $db->sp("file_title") ?>" />
      </td>
    </tr>
    <tr> 
      <td><div align="right" ><strong><?php echo $VM_LANG->_PHPSHOP_FILES_FORM_FILE_URL ?>:</strong></div></td>
      <td> 
        <input type="text" class="inputbox" name="file_url" value="<?php $db->sp("file_url") ?>" size="32" />
      </td>
    </tr>
    <tr align="center">
      <td colspan="2" >&nbsp;</td>
    </tr>
  </table>
<?php
// Add necessary hidden fields
$formObj->hiddenField( 'file_id', $file_id );
$formObj->hiddenField( 'product_id', $product_id );

$funcname = empty($file_id) ? "uploadProductFile" : "updateProductFile";

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( $funcname, $modulename.'.file_list', $option );
?>
<script type="text/javascript">
function checkThumbnailing() {
  if( document.adminForm.file_type[0].checked==false ) {
    document.adminForm.file_create_thumbnail.checked=false;
    document.adminForm.file_create_thumbnail.disabled=true;
    document.adminForm.upload_dir[0].disabled=true;
    document.adminForm.upload_dir[0].checked=false;
    document.adminForm.upload_dir[1].checked=true;
    document.adminForm.upload_dir[2].checked=false;
  }
  else {
    document.adminForm.file_create_thumbnail.checked=true;
    document.adminForm.file_create_thumbnail.disabled=false;
    document.adminForm.upload_dir[0].disabled=false;
    document.adminForm.upload_dir[0].checked=true;
    document.adminForm.upload_dir[1].checked=false;
    document.adminForm.upload_dir[2].checked=false;
  }
}
checkThumbnailing();
</script>