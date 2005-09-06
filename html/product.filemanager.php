<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.filemanager.php,v 1.3 2005/01/27 19:34:03 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );

// Enable the multi-page search result display
$limitstart = mosGetParam($_REQUEST, 'limitstart', 0);

$keyword = mosGetParam($_REQUEST, 'keyword' );
$product_id = mosGetParam($_REQUEST, 'product_id' );
?>
 <table width="100%" cellspacing="0" cellpadding="4" border="0">
  <tr><td>
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo $mosConfig_live_site ?>/administrator/images/mediamanager.png" width="48" height="48" alt="Product List" border="0" />
      <br /><br /></td>
    <td><?php
         search_header( $PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_LIST, "product", "filemanager");
        ?></td>
  </tr></table>
<?php  
   
   if (!empty($keyword)) {
     $list  = "SELECT product_id, product_name, product_sku, product_publish,product_parent_id FROM #__pshop_product WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_product WHERE ";
     //$q  = "product.vendor_id = '$ps_vendor_id' ";
     $q = "(#__pshop_product.product_name LIKE '%$keyword%' OR ";
     $q .= "#__pshop_product.product_sku LIKE '%$keyword%' OR ";
     $q .= "#__pshop_product.product_s_desc LIKE '%$keyword%' OR ";
     $q .= "#__pshop_product.product_desc LIKE '%$keyword%'";
     $q .= ") ";
     $q .= "ORDER BY product_name ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;
  }
  else
  {
      $list  = "SELECT product_id, product_name, product_sku, product_publish,product_parent_id FROM #__pshop_product ";
      $count = "SELECT count(*) as num_rows FROM #__pshop_product ";
      //$q  = "WHERE product.vendor_id = '$ps_vendor_id' ";
      $q = "ORDER BY product_name ";
      $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
      $count .= $q;
  }
  $db->query($count);
  $db->next_record();
  $num_rows = $db->f("num_rows");
  if ($num_rows == 0) {
     echo $PHPSHOP_LANG->_PHPSHOP_NO_SEARCH_RESULT;
  }
  else { ?>
    <table width="100%" class="adminlist">
    <tr>
     <th width="20px">#</th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_NAME ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SKU ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_ADD ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_IMAGES ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_DOWNLOADABLE ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_FILES ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_PUBLISHED ?></th>
    </tr>
<?php
    $db->query($list);
    $i = 0;
    $dbp = new ps_DB;
    while ($db->next_record()) {
      if ($i++ % 2)
        $bgcolor=SEARCH_COLOR_1;
      else
        $bgcolor=SEARCH_COLOR_2;
      
      // Is the product downloadable?
      $database->setQuery( "SELECT attribute_name FROM #__pshop_product_attribute WHERE product_id='" . $db->f("product_id") . "' AND attribute_name='download'" );
      $database->loadObject( $downloadable );
      
      // What Images does the product have ?
      $database->setQuery( "SELECT count(file_id) as images FROM #__pshop_product_files WHERE file_product_id='" . $db->f("product_id") . "' AND file_is_image='1' " );
      $database->loadObject($images);
      
      // What Files does the product have ?
      $database->setQuery( "SELECT count(file_id) as files FROM #__pshop_product_files WHERE file_product_id='" . $db->f("product_id") . "' AND file_is_image='0' " );
      $database->loadObject($files);
?>
      <tr nowrap="nowrap" bgcolor="<?php echo $bgcolor; ?>">
       <td width="20px"><?php $nr = $limitstart+$i; echo $nr; ?></td>
       <td><?php
          if( $db->f("product_parent_id")) echo "&nbsp;&nbsp;&nbsp;&nbsp;";
          $db->p("product_name");
           ?>
      </td>
       <td><?php $db->p("product_sku"); ?></td>
       <td><?php 
          $url = $_SERVER['PHP_SELF']."?page=$modulename.file_list&product_id=" . $db->f("product_id");
          echo "&nbsp;&nbsp;<a href=\"" . $sess->url($url) . "\">[ ".$PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_ADD." ]</a>"; ?></td>
       <td><?php echo empty($images->images) ? "0" : $images->images; ?></td>
       <td><?php 
         if (empty($downloadable)) { ?>
            <img src="<?php echo $mosConfig_live_site ?>/administrator/images/publish_x.png" border="0" alt="Publish" /><?php
         } 
         else { ?>
            <img src="<?php echo $mosConfig_live_site ?>/administrator/images/tick.png" border="0" alt="Unpublish" /><?php 
         }
        unset( $downloadable );
        ?>
       </td>
       <td><?php echo $files->files; ?></td>
       <td><?php 
         if ($db->f("product_publish")=="N") { ?>
            <img src="<?php echo $mosConfig_live_site ?>/administrator/images/publish_x.png" border="0" alt="Publish" /><?php
         } 
         else { ?>
            <img src="<?php echo $mosConfig_live_site ?>/administrator/images/tick.png" border="0" alt="Unpublish" /><?php 
         } ?></td>
      </tr>
<?php
    }
  }
?>
</table>
<?php
  search_footer($modulename, "filemanager", $limitstart, $num_rows, $keyword, "&task=list");
  
?>
