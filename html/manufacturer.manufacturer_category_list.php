<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: manufacturer.manufacturer_category_list.php,v 1.4 2005/01/27 19:34:02 soeren_nb Exp $
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

search_header($PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_CAT_LIST_LBL, $modulename, "manufacturer_category_list"); 
?>

<?php 
  // Enable the multi-page search result display
  $limitstart = mosgetparam( $_REQUEST, 'limitstart');
  $keyword = mosgetparam( $_REQUEST, 'keyword');
  
  if (!empty($keyword)) {
     $list  = "SELECT * FROM #__pshop_manufacturer_category WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_manufacturer_category WHERE ";
     $q  = "(mf_category_name LIKE '%$keyword%' OR ";
     $q .= "mf_category_desc LIKE '%$keyword%'";
     $q .= ") ";
     $q .= "ORDER BY mf_category_name ASC ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $q = "";
     $list  = "SELECT * FROM #__pshop_manufacturer_category ORDER BY mf_category_name ASC ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_manufacturer_category"; 
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
  <tr > 
    <th width="20">#</th>
    <th width="21%" NOWRAP><?php echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_CAT_NAME ?></th>
    <th width="66%" NOWRAP ><?php echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_CAT_DESCRIPTION ?></th>
    <th width="13%" colspan="2"><?php echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_CAT_MANUFACTURERS ?></th>
    <th><? echo _E_REMOVE ?></th>
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
    <td width="20%" ><?php
        $url = $_SERVER['PHP_SELF']."?page=$modulename.manufacturer_category_form&limitstart=$limitstart&keyword=$keyword&mf_category_id=";
        $url .= $db->f("mf_category_id");
        echo "<a href=\"" . $sess->url($url) . "\">";
        echo $db->f("mf_category_name");
        echo "</a><br />";
        ?>
    </td>
    <td width="60%" ><?php echo $db->f("mf_category_desc");

?> </td>
    <td width="10%" colspan="2" ><?php
        $url = $_SERVER['PHP_SELF']."?page=$modulename.manufacturer_list&mf_category_id=";
        $url .= $db->f("mf_category_id");
        echo "<a href=\"" . $sess->url($url) . "\">";
        echo $PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_LIST_LBL."</a>";
        
        ?> 
    </td>
    <td width="5%">
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=manufacturerCategoryDelete&mf_category_id=<? echo $db->f("mf_category_id") ?>&limitstart=<?php echo $limitstart ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="Delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
  </tr>
  <?php } ?> 
</table>

<?php 
  search_footer($modulename, "manufacturer_list", $limitstart, $num_rows, $keyword); 
}
?>
