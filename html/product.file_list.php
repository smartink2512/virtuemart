<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.file_list.php,v 1.4 2005/01/27 19:34:03 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software. www.mambo-phpshop.net
* mambo-phpShop comes with absolute no warranty.
*
* List all files of a specific product
* @author Soeren Eberhardt
* @param int product_id
*
*/
mm_showMyFileName( __FILE__ );


$product_id = mosGetParam($_REQUEST, 'product_id' );
$task = mosGetParam($_REQUEST, 'task' );

$q  = "SELECT product_name FROM #__pshop_product WHERE product_id = '$product_id'";
$db->query($q);
$db->next_record();
$product_name = $db->f("product_name");

$q = "SELECT file_id, file_is_image, file_product_id, file_extension, file_url, file_published, file_name, file_title FROM #__pshop_product_files  ";
$q .= "WHERE file_product_id = '$product_id' ";
$q .= "ORDER BY file_is_image ";
$db->query($q);
$db->next_record();
if( $db->num_rows() < 1 && $task != "cancel" ) {
  mosRedirect( $_SERVER['PHP_SELF']."?option=com_phpshop&page=product.file_form&product_id=$product_id" );
}
?>

  <table width="100%" cellspacing="0" cellpadding="4" border="0">
   <tr><td>
	   <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo $mosConfig_live_site ?>/administrator/images/mediamanager.png" width="48" height="48" alt="Product List" border="0" />
	   <br /><br /></td>
	 <td><span class="componentheading"><?php echo $PHPSHOP_LANG->_PHPSHOP_FILES_LIST ." " . $product_name ?></span></td>
   </tr></table>
 <?php  
  // Reset Result pointer
  $db->called=false;
  
  if ($db->num_rows() == 0) {
     echo $PHPSHOP_LANG->_PHPSHOP_NO_SEARCH_RESULT;
  }
  else { ?>
    <table width="100%" class="adminlist">
    <tr>
     <th width="20px">#</th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_FILES_LIST_FILENAME ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_FILES_LIST_FILETITLE ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_UPDATE ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_VIEW ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_FILES_LIST_FILETYPE ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_PUBLISHED ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE ?></th>
    </tr>
<?php

    $i = 0;
    while ($db->next_record()) {
      if ($i++ % 2)
        $bgcolor=SEARCH_COLOR_1;
      else
        $bgcolor=SEARCH_COLOR_2;
?>
      <tr nowrap="nowrap" bgcolor="<?php echo $bgcolor; ?>">
       <td width="20px"><?php echo $i; ?></td>
       <td><?php 
		  if($db->f("file_name")) 
			echo basename($db->f("file_name"));
		  else
			echo basename($db->f("file_url")); ?></td>
       <td><?php $db->p("file_title") ?></td>
	   <td><a href="<?php echo $_SERVER['PHP_SELF']."?option=com_phpshop&page=product.file_form&product_id=$product_id&file_id=".$db->f("file_id") ?>">  
		  <?php echo $PHPSHOP_LANG->_PHPSHOP_FILES_LIST_EDITFILE ?></a>&nbsp;
      </td>
       <td><?php 
		if( $db->f("file_is_image")) {
		  $fullimg = $db->f("file_name");
		  $info = pathinfo( $fullimg );
		  $thumb = $info["dirname"] ."/resized/". basename($db->f("file_name"),".".$info["extension"])."_".PSHOP_IMG_WIDTH."x".PSHOP_IMG_HEIGHT.".".$info["extension"];
		  $thumburl = str_replace( $mosConfig_absolute_path, $mosConfig_live_site, $thumb );
		  if( is_file( $fullimg ) ) {
			echo $PHPSHOP_LANG->_PHPSHOP_FILES_LIST_FULL_IMG.":";
			echo "&nbsp;<a target=\"_blank\" href=\"".$db->f("file_url") . "\">[ ".$PHPSHOP_LANG->_PHPSHOP_VIEW . " ]</a><br/>"; 
		  }
		  if( is_file( $thumb ) ) {
			echo $PHPSHOP_LANG->_PHPSHOP_FILES_LIST_THUMBNAIL_IMG.":";
			echo "&nbsp;<a target=\"_blank\" href=\"$thumburl\">[ ".$PHPSHOP_LANG->_PHPSHOP_VIEW . " ]</a><br/>"; 
		  }
		  if( !$db->f("file_name") ) {
			echo "&nbsp;<a target=\"_blank\" href=\"".$db->f("file_url"). "\">[ ".$PHPSHOP_LANG->_PHPSHOP_VIEW . " ]</a><br/>"; 
		  }
		}
		?>
	   </td>
       <td><?php $db->p("file_extension"); ?></td>
       <td><?php 
         if ($db->f("file_published")=="0") { ?>
            <img src="<?php echo $mosConfig_live_site ?>/administrator/images/publish_x.png" border="0" alt="Publish" /><?php
         } 
         else { ?>
            <img src="<?php echo $mosConfig_live_site ?>/administrator/images/tick.png" border="0" alt="Unpublish" /><?php 
         } ?>
	   </td>
	   <td>
        <a class="toolbar" href="<?php echo $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=<?php echo $_REQUEST['page'] ?>&func=deleteProductFile&product_id=<?php echo $product_id ?>&file_id=<?php echo $db->f("file_id") ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
	   </td>
      </tr>
<?php
   }
?>
</table>
</form>
<?php
  }

