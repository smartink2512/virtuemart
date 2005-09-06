<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: vendor.vendor_list.php,v 1.7 2005/05/25 19:05:04 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
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
mm_showMyFileName( __FILE__ );

?>
<h1>This feature is still in an early ALPHA stadium. Just don't use it for now.</h1>
 <table width="100%" cellspacing="0" cellpadding="4" border="0">
  <tr>
    <td>
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/vendors.gif" border="0" />
      <br /><br />
    </td>
    <td><?php
          search_header($PHPSHOP_LANG->_PHPSHOP_VENDOR_LIST_LBL, $modulename, "vendor_list"); 
        ?>
    </td>
  </tr>
</table>
<?php 
  // Enable the multi-page search result display
  $limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );
  $keyword= mosgetparam( $_REQUEST, 'keyword', "" );
  $vendor_category_id= mosgetparam( $_REQUEST, 'vendor_category_id', "" );
  
  if (!empty($keyword)) {
     $list  = "SELECT * FROM #__pshop_vendor WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_vendor WHERE ";
     $q  = "(vendor_name LIKE '%$keyword%' OR ";
     $q .= "vendor_store_desc LIKE '%$keyword%'";
     $q .= ") ";
     $q .= "AND vendor_id > 1 ";
     $q .= "ORDER BY vendor_name ASC ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  elseif (!empty($vendor_category_id)) 
  {
     $q = "";
     $list="SELECT * FROM #__pshop_vendor, #__pshop_vendor_category WHERE ";
     $count="SELECT count(*) as num_rows FROM #__pshop_vendor,#__pshop_vendor_category WHERE "; 
     $q = "#__pshop_vendor.vendor_category_id=#__pshop_vendor_category.vendor_category_id ";
     $q .= "AND vendor_id > 1 ";
     $q .= "ORDER BY #__pshop_vendor.vendor_name ASC ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $q = "";
     $list  = "SELECT * FROM #__pshop_vendor ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_vendor ";
     $q .= "WHERE vendor_id > 1 ORDER BY vendor_name ASC ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  $db->query($count);
  $db->next_record();
  $num_rows = $db->f("num_rows");
  if ($num_rows == 0) {
     echo $PHPSHOP_LANG->_PHPSHOP_NO_SEARCH_RESULT;
  }
  else {
?>

<table class="adminlist">
   <tr> 
    <th width="5%">#</th>
    <th width="45%"><?php echo $PHPSHOP_LANG->_PHPSHOP_VENDOR_LIST_VENDOR_NAME ?></th>
    <th width="45%"><?php echo $PHPSHOP_LANG->_PHPSHOP_VENDOR_LIST_ADMIN ?></th>
    <th width="5%"><? echo _E_REMOVE ?></th>
  </tr>
    <?php
    $db->query($list);
    $i = 0;
    while ($db->next_record()) {
      if ($i++ % 2) 
         $bgcolor=SEARCH_COLOR_1;
      else
         $bgcolor=SEARCH_COLOR_2;
    ?>
  <tr bgcolor="<?php echo $bgcolor ?>">
    <td width="5%"><?php $nr = $limitstart+$i; echo $nr; ?></td>
    <td width="40%">
       <?php
        $url = $_SERVER['PHP_SELF']."?page=$modulename.vendor_form&limitstart=$limitstart&keyword=$keyword&vendor_id=";
        $url .= $db->f("vendor_id");
        echo "<a href=\"" . $sess->url($url) . "\">";
        echo $db->f("vendor_name");
        echo "</a><br />";
       ?>
    </td>
    <td width="15%"><a href="<?php $sess->purl($_SERVER['PHP_SELF']."?page=$modulename.vendor_form&vendor_id=" . $db->f("vendor_id")) ?>">
    <? echo $PHPSHOP_LANG->_PHPSHOP_UPDATE ?></a></td>
    <td width="5%">
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=vendorDelete&vendor_id=<? echo $db->f("vendor_id") ?>&limitstart=<?php echo $limitstart ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
  </tr>
  <?php } ?> 
</table>

<?php 
  search_footer($modulename, "vendor_list", $limitstart, $num_rows, $keyword); 
}
?>
