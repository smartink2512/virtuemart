<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: order.order_status_list.php,v 1.4 2005/01/27 19:34:02 soeren_nb Exp $
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

  search_header($PHPSHOP_LANG->_PHPSHOP_ORDER_STATUS_LIST_MNU, $modulename, "order_status_list"); 

  // Enable the multi-page search result display
  $limitstart = mosgetparam( $_REQUEST, 'limitstart', 0 );
  
  if (!empty($_REQUEST['keyword'])) {
     $keyword = $_REQUEST['keyword'];
     $list  = "SELECT * FROM #__pshop_order_status WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_order_status WHERE ";
     $q  = "(order_status_code LIKE '%$keyword%' ";
     $q .= "OR order_status_name LIKE '%$keyword%' ";
     $q .= ") ";
     $q .= "vendor_id='$ps_vendor_id' ";
     $q .= "ORDER BY list_order ASC";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $keyword = '';  
     $q = "";
     $list  = "SELECT * FROM #__pshop_order_status WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_order_status WHERE ";
     $q .= "vendor_id='$ps_vendor_id' ";
     $q .= "ORDER BY list_order ASC";
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

<table width="100%" class="adminlist">
  <tr > 
    <th width="20">#</th>
    <th NOWRAP><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_STATUS_LIST_NAME ?></th>
    <th NOWRAP><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_STATUS_LIST_CODE ?></th>
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
  <tr BGCOLOR=<?php echo $bgcolor ?>> 
    <td width="20"><?php $nr = $limitstart+$i; echo $nr; ?></td>
    <td>
        <A HREF="<? $sess->purl(SECUREURL . "administrator/index2.php?page=$modulename.order_status_form&limitstart=$limitstart&keyword=$keyword&order_status_id=".$db->f("order_status_id"))?>">
        <? echo $db->f("order_status_name");?>
        </A><BR>
    </td>
    <td NOWRAP><?php echo $db->f("order_status_code") ?></td>
    <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=OrderStatusDelete&order_status_id=<? echo $db->f("order_status_id") ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
    </tr>
  <?php } ?> 
</table>

<?php 
  search_footer($modulename, "order_status_list", $limitstart, $num_rows, $keyword); 
}
?>


