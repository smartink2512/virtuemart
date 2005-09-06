<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: manufacturer.manufacturer_list.php,v 1.4 2005/01/27 19:34:02 soeren_nb Exp $
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

?>
 <table width="100%" cellspacing="0" cellpadding="4" border="0">
  <tr>
    <td>
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/manufacturer.gif" border="0" />
      <br /><br />
    </td>
    <td><?php
          search_header($PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_LIST_LBL, $modulename, "manufacturer_list"); 
        ?>
    </td>
  </tr>
</table>
<?php 
  // Enable the multi-page search result display
  $limitstart = mosgetparam( $_REQUEST, 'limitstart');
  $keyword = mosgetparam( $_REQUEST, 'keyword');
  $mf_category_id = mosgetparam( $_REQUEST, 'mf_category_id');
  if (!empty($keyword)) {
     $list  = "SELECT * FROM #__pshop_manufacturer WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_manufacturer WHERE ";
     $q  = "(mf_name LIKE '%$keyword%' OR ";
     $q .= "mf_desc LIKE '%$keyword%'";
     $q .= ") ";
     $q .= "ORDER BY mf_name ASC ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  elseif (!empty($mf_category_id)) 
  {
     $q = "";
     $list="SELECT * FROM #__pshop_manufacturer, #__pshop_manufacturer_category WHERE ";
     $count="SELECT count(*) as num_rows FROM #__pshop_manufacturer,#__pshop_manufacturer_category WHERE "; 
     $q = "#__pshop_manufacturer.mf_category_id=#__pshop_manufacturer_category.mf_category_id ";
     $q .= "ORDER BY #__pshop_manufacturer.mf_name ASC ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $q = "";
     $list  = "SELECT * FROM #__pshop_manufacturer ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_manufacturer ";
     $q .= "ORDER BY mf_name ASC ";
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
    <th width="45%"><?php echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME ?></th>
    <th width="45%"><?php echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_LIST_ADMIN ?></th>
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
        $url = $_SERVER['PHP_SELF'] . "?page=$modulename.manufacturer_form&limitstart=$limitstart&keyword=$keyword&manufacturer_id=";
        $url .= $db->f("manufacturer_id");
        echo "<a href=\"" . $sess->url($url) . "\">";
        echo $db->f("mf_name");
        echo "</a><br />";
       ?>
    </td>
    <td width="15%"><a href="<?php $sess->purl($_SERVER['PHP_SELF']."?page=$modulename.manufacturer_form&manufacturer_id=" . $db->f("manufacturer_id")) ?>">
    <? echo $PHPSHOP_LANG->_PHPSHOP_UPDATE ?></a></td>
    <td width="5%">
        <a class="toolbar" href="<?php echo $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=manufacturerDelete&manufacturer_id=<? echo $db->f("manufacturer_id") ?>&limitstart=<?php echo $limitstart ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
  </tr>
  <?php } ?> 
</table>

<?php 
  search_footer($modulename, "manufacturer_list", $limitstart, $num_rows, $keyword); 
}
?>
