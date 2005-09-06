<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shipping.rate_list.php,v 1.5 2005/01/27 19:34:03 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* Contains code from PHPEuroShop
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
 <table width="100%" cellspacing="0" cellpadding="4" border="0">
  <tr>
    <td>
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/shipping.gif" border="0" />
      <br /><br />
    </td>
    <td><?php
          search_header($PHPSHOP_LANG->_PHPSHOP_RATE_LIST_LBL, $modulename, "rate_list");
        ?>
    </td>
  </tr>
</table>
<?php
  // Enable the multi-page search result display
  $limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );
  $keyword= mosgetparam( $_REQUEST, 'keyword', null );
  if (!empty($keyword)) {
     $list  = "SELECT * FROM #__pshop_shipping_rate WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_shipping_rate WHERE ";
     $q  = "(shipping_rate_name LIKE '%$keyword%') ";
     $q .= "ORDER BY shipping_rate_carrier_id ASC ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;
  }
  else {
     $q = "";
     $list  = "SELECT * FROM #__pshop_shipping_rate ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_shipping_rate";
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
<div id="main">
<table class="adminlist" width="100%">
   <tr >
    <th width="20">#</th>
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL ?></th>
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME ?></th>
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART ?></th>
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND ?></th>
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
  <tr BGCOLOR="<?php echo $bgcolor ?>">
  <td width="20"><?php $nr = $limitstart+$i; echo $nr; ?></td>
    <td><?php
          $cdb = new ps_DB;
          $cq = "SELECT * FROM #__pshop_shipping_carrier WHERE ";
          $cq .= "shipping_carrier_id = '" . $db->f("shipping_rate_carrier_id") . "'";
          $cdb->query($cq);
          $cdb->next_record();
          echo $cdb->f("shipping_carrier_name"); ?>
   </td>
    <td><?php
            $url = $_SERVER['PHP_SELF'] . "?page=$modulename.rate_form&limitstart=$limitstart&keyword=$keyword&shipping_rate_id=";
            $url .= $db->f("shipping_rate_id");
            echo "<a href=\"" . $sess->url($url) . "\">";
            echo $db->f("shipping_rate_name")."</a>"; ?>
    </td>
    <td><?php $db->p("shipping_rate_weight_start") ?></td>
    <td><?php $db->p("shipping_rate_weight_end") ?></td>
    <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=rateDelete&shipping_rate_id=<? echo $db->f("shipping_rate_id") ?>&limitstart=<?php echo $limitstart ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
</form>
  </tr>
<?php
  } //while shipping rates
?>
</table>
</div>
<?php
  search_footer($modulename, "rate_list", $limitstart, $num_rows, $keyword);
}
?>
