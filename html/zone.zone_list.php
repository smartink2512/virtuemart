<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: zone.zone_list.php,v 1.4 2005/01/27 19:34:04 soeren_nb Exp $
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

  search_header($PHPSHOP_LANG->_PHPSHOP_ZONE_LIST_LBL, $modulename, "zone_list"); 

  // Enable the multi-page search result display
  $limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );
  $keyword= mosgetparam( $_REQUEST, 'keyword', "" );
  
  if (!empty($keyword)) {
     $list  = "SELECT * FROM #__pshop_zone_shipping WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_zone_shipping WHERE ";
     $q  = "(zone_name LIKE '%$keyword%')";
     $q .= "ORDER BY zone_name ASC ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else {
     $q = "";
     $list  = "SELECT * FROM #__pshop_zone_shipping ORDER BY zone_name ASC ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_zone_shipping"; 
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  $db->query($count);
  $db->next_record();
  $num_rows = $db->f("num_rows");
  if ($num_rows == 0) {
     echo $PHPSHOP_LANG->_PHPSHOP_NO_SEARCH_RESULT ."<BR>";
  }
  else {
?>

<table border="0" cellpadding="2" cellspacing="0" width="100%">
<tr>
    <th width="5%">#</th>
    <th width="21%" align="center"><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_LIST_NAME_LBL;?></th>
    <th width="21%" align="center"><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_LIST_DESC_LBL;?></th>
    <th width="21%" align="center"><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_LIST_COST_PER_LBL;?></th>
    <th width="21%" align="center"><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_LIST_COST_LIMIT_LBL;?></th>
    <th width="11%"><? echo _E_REMOVE ?></th>
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
  <tr bgcolor=<?php echo $bgcolor ?>> 
        <td width="5%"><?php $nr = $limitstart+$i; echo $nr; ?></td>
        <td width="21%">
        <?php
               $url = $_SERVER['PHP_SELF']."?page=$modulename.zone_form&limitstart=$limitstart&keyword=$keyword&zone_id=" . $db->f("zone_id");
               echo "<a href=\"" . $sess->url($url) . "\">";
               echo $db->f("zone_name"); 
               echo "</a>"; ?>
        </td>
        <td width="21%">
        <?php $db->p("zone_description") ?>
        </td>
        <td width="21%"><?php $db->p("zone_cost") ?>
        </td>
        <td width="21%">
        <?php $db->p("zone_limit") ?>
        </td>
        <td width="11%">
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=deletezone&zone_id=<? echo $db->f("zone_id") ?>&limitstart=<?php echo $limitstart ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0" />
        </a>
    </td>
    </tr>
</form>

<?php 
}
echo "</table>";
  search_footer("zone", "zone_list", $limitstart, $num_rows, $keyword); 
}
?>
