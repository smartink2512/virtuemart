<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: coupon.coupon_list.php,v 1.3 2005/01/27 19:34:02 soeren_nb Exp $
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
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/percentage.png" width="48" alt="percentage" height="48" border="0" />
      <br /><br />
    </td>
    <td><?php
          search_header($PHPSHOP_LANG->_PHPSHOP_COUPON_LIST, $modulename, "coupon_list"); 
        ?>
    </td>
  </tr>
</table>

<?
  // Enable the multi-page search result display
  $limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );
  $keyword= mosgetparam( $_REQUEST, 'keyword', null );
  
  if (!empty($keyword)) {
  
     $list  = "SELECT * FROM #__pshop_coupons WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_coupons WHERE ";
     $q  = "(code LIKE '%$keyword%' OR ";
     $q .= "value LIKE '%$keyword%' ";
     $q .= ") ";
     $q .= "ORDER BY coupon_id ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $list  = "SELECT * FROM #__pshop_coupons ";
     $list .= "ORDER BY coupon_id ";
     $list .= "LIMIT $limitstart, " . SEARCH_ROWS;
     $count = "SELECT count(*) as num_rows FROM #__pshop_coupons ";
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
  <tr> 
    <th width="20">#</th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_COUPON_CODE_HEADER ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_COUPON_PERCENT_TOTAL ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_COUPON_TYPE ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_COUPON_VALUE_HEADER ?></th>
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
    <td><?php $nr = $limitstart+$i; echo $nr; ?></td>
    <td width="19%">
      <a href="<?php echo $sess->url($_SERVER['PHP_SELF']."?page=coupon.coupon_form&limitstart=$limitstart&keyword=$keyword&coupon_id=" . $db->f("coupon_id")) ?>">
      <?php $db->p("coupon_code"); ?>
      </a>
    </td>
    <td width="17%"><?php echo $db->f("percent_or_total")=='total' ? $PHPSHOP_LANG->_PHPSHOP_COUPON_TOTAL : $PHPSHOP_LANG->_PHPSHOP_COUPON_PERCENT ?></td>
    <td width="17%"><?php echo $db->f("coupon_type")=='gift' ? $PHPSHOP_LANG->_PHPSHOP_COUPON_TYPE_GIFT : $PHPSHOP_LANG->_PHPSHOP_COUPON_TYPE_PERMANENT ?></td>
    <td width="20%"><?php $db->p("coupon_value") ?>&nbsp;</td>
    <td>
        <a class="toolbar" href="<?php echo $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=couponDelete&coupon_id=<? echo $db->f("coupon_id") ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
  </tr>
  <?php } ?> 
</table>
<?php 
  search_footer($modulename, "coupon_list", $limitstart, $num_rows, $keyword ); 
}
?>
