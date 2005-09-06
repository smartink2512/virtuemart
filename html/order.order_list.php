<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: order.order_list.php,v 1.13 2005/09/01 19:58:06 soeren_nb Exp $
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
global $mosConfig_locale;
$show = mosGetParam( $_REQUEST, "show", "" );
$keyword = mosGetParam( $_REQUEST, "keyword", "" );

// Enable the multi-page search result display
$limitstart = mosgetparam( $_REQUEST, 'limitstart', 0 );
?>
 <table width="100%" cellspacing="0" cellpadding="4" border="0">
  <tr>
    <td>
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/orders.gif" border="0" />
      <br /><br />
    </td>
    <td><?php
          search_header($PHPSHOP_LANG->_PHPSHOP_ORDER_LIST_LBL, $modulename, "order_list"); 
        ?>
    </td>
  </tr>
</table>
<div align="center">
<?php

    $navi_db = new ps_DB;
    $q = "SELECT order_status_code, order_status_name ";
    $q .= "FROM #__pshop_order_status WHERE vendor_id = '$ps_vendor_id'";
    $navi_db->query($q);
    while ($navi_db->next_record()) {  ?> 
      <a href="<?php $sess->purl($_SERVER['PHP_SELF']."?page=$modulename.order_list&show=".$navi_db->f("order_status_code")) ?>">
      <b><?php echo $navi_db->f("order_status_name")?></b></a>
      | 
<?php 
    } 
?>
    <a href="<?php $sess->purl($_SERVER['PHP_SELF']."?page=$modulename.order_list&show=")?>"><b>
    <?php echo $PHPSHOP_LANG->_PHPSHOP_LIST." ".$PHPSHOP_LANG->_PHPSHOP_ALL ?></b></a>
</div>
<br />
<?php 
    
  if (!empty($keyword)) {
     $list  = "SELECT  order_id,#__pshop_orders.cdate,#__pshop_orders.mdate,order_total,";
     $list .= "order_status FROM #__pshop_orders, #__users WHERE ";
     $count = "SELECT  count(*) as num_rows FROM #__pshop_orders, #__users WHERE ";
     $q  = "(#__pshop_orders.order_id LIKE '%$keyword%' ";
     $q .= "OR #__pshop_orders.order_status LIKE '%$keyword%' ";
     $q .= "OR #__users.username LIKE '%$keyword%' ";
     $q .= ") ";
     $q .= "AND (#__pshop_orders.user_id=#__users.id) ";
     $q .= "AND #__pshop_orders.vendor_id='".$_SESSION['ps_vendor_id']."' ";
     $q .= "ORDER BY #__pshop_orders.cdate DESC ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $keyword = "";
     $q = "";
     $list  = "SELECT * FROM #__pshop_orders ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_orders ";
     $q .= "WHERE  #__pshop_orders.vendor_id='".$_SESSION['ps_vendor_id']."' ";
     
     if (!empty($show)) 
        $q .= "AND order_status = '$show' ";
        
     $q .= "ORDER BY #__pshop_orders.cdate DESC ";
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
    <th style="white-space:nowrap;"><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_LIST_ID ?></th>
    <th style="white-space:nowrap;" ><?php echo $PHPSHOP_LANG->_PHPSHOP_CHECK_OUT_THANK_YOU_PRINT_VIEW ?></th>
    <th style="white-space:nowrap;" ><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_LIST_CDATE ?></th>
    <th style="white-space:nowrap;" ><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_LIST_MDATE ?></th>
    <th style="white-space:nowrap;"><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_LIST_STATUS ?></th>
    <th style="white-space:nowrap;"><?php echo $PHPSHOP_LANG->_PHPSHOP_UPDATE ?></th>
    <th style="white-space:nowrap;"><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_LIST_TOTAL ?></th>
    <th><?php echo _E_REMOVE ?></th>
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
    <td width="20"><?php $nr = $limitstart+$i; echo $nr; ?></td>
    <td><?php
        $url = $_SERVER['PHP_SELF']."?page=$modulename.order_print&limitstart=$limitstart&keyword=$keyword&order_id=";
        $url .= $db->f("order_id");
        echo "<a href=\"" . $sess->url($url) . "\">";
        printf("%08d", $db->f("order_id"));
        echo "</a><br />";
    ?></td>
    <td><?php
	$details_url = $sess->url( $_SERVER['PHP_SELF']."?page=order.order_printdetails&amp;order_id=".$db->f("order_id")."&amp;no_menu=1");
    $details_url = stristr( $_SERVER['PHP_SELF'], "index2.php" ) ? str_replace( "index2.php", "index3.php", $details_url ) : str_replace( "index.php", "index2.php", $details_url );
	
    $details_link = "&nbsp;<a href=\"javascript:void window.open('$details_url', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');\">";
    $details_link .= "<img src=\"$mosConfig_live_site/images/M_images/printButton.png\" align=\"center\" height=\"16\" width=\"16\" border=\"0\" /></a>"; 
    echo $details_link;
?>
    </td>
    <td style="white-space:nowrap;"><?php 
        setlocale(LC_TIME,$mosConfig_locale);
        echo strftime("%d-%b-%y %H:%M", $db->f("cdate")); ?>
    </td>
    <td style="white-space:nowrap;"><?php 
        setlocale(LC_TIME,$mosConfig_locale);
        echo strftime("%d-%b-%y %H:%M", $db->f("mdate"));  ?>
    </td>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="adminForm<?php echo $i ?>">
    <td style="white-space:nowrap;"><?php
        $q = "SELECT order_status_name FROM #__pshop_order_status WHERE ";
        $q .= "order_status_code = '" . $db->f("order_status") . "'";
        $dbos = new ps_DB;
        $dbos->query($q);
        $dbos->next_record(); 
        $ps_order_status->list_order_status($db->f("order_status"), "onchange=\"document.adminForm$i.changed.value='1'\""); ?>
    </td>
    <td style="white-space:nowrap;">
      <input type="checkbox" class="inputbox" name="notify_customer" value="Y" /><?php
      echo $PHPSHOP_LANG->_PHPSHOP_ORDER_LIST_NOTIFY ?>
      <br />
      <input type="submit" class="button" onclick="if(document.adminForm<?php echo $i ?>.changed.value!='1') { alert('<?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_LIST_NOTIFY_ERR ?>'); return false;} else return true;" name="Submit" value="Update Status" />
    </td>
      <input type="hidden" name="page" value="order.order_list" />
      <input type="hidden" name="func" value="orderStatusSet" />
      <input type="hidden" name="changed" value="0" />
      <input type="hidden" name="option" value="com_phpshop" />
      <input type="hidden" name="order_id" value="<?php echo $db->f("order_id") ?>" />
      <input type="hidden" name="current_order_status" value="<?php echo $db->f("order_status") ?>" />
    </form>
    <td><?php echo $CURRENCY_DISPLAY->getFullValue($db->f("order_total")) ?></td>
    <td>
        <a class="toolbar" href="<?php echo $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=<?php echo $_REQUEST['page'] ?>&func=orderDelete&order_id=<?php echo $db->f("order_id") ?>&limitstart=<?php echo $limitstart ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete<?php echo $i ?>','','<?php echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<?php echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<?php echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
</tr>
  <?php } ?> 
</table>

<?php 
  search_footer($modulename, "order_list", $limitstart, $num_rows, $keyword, "&show=$show" ); 
}
?>


