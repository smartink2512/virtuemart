<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_discount_list.php,v 1.2 2005/01/27 19:34:03 soeren_nb Exp $
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
          search_header($PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_LIST_LBL, $modulename, "product_discount_list"); 
        ?>
    </td>
  </tr>
</table>

<?
  // Enable the multi-page search result display
  $limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );
  $keyword= mosgetparam( $_REQUEST, 'keyword', null );
  
  if (!empty($keyword)) {
  
     $list  = "SELECT * FROM #__pshop_product_discount WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_product_discount WHERE ";
     $q  = "(start_date LIKE '%$keyword%' OR ";
     $q .= "end_date LIKE '%$keyword%' OR ";
     $q .= "amount LIKE '%$keyword%' ";
     $q .= ") ";
     $q .= "ORDER BY amount ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $list  = "SELECT * FROM #__pshop_product_discount ";
     $list .= "ORDER BY amount ";
     $list .= "LIMIT $limitstart, " . SEARCH_ROWS;
     $count = "SELECT count(*) as num_rows FROM #__pshop_product_discount ";
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
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_AMOUNTTYPE ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE ?></th>
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
    <a href="<?php echo $sess->url($_SERVER['PHP_SELF']."?page=product.product_discount_form&limitstart=$limitstart&keyword=$keyword&discount_id=" . $db->f("discount_id")) ?>">
    <?php $db->p("amount"); ?>
    </a>
</td>
    <td width="17%"><?php echo $db->f("is_percent")=='1' ? $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT : $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_ISTOTAL ?></td>
    <td width="24%"><?php if($db->f("start_date")) echo strftime("%Y-%m-%d", $db->f("start_date")) ?></td>
    <td width="20%"><?php if($db->f("end_date")) echo strftime("%Y-%m-%d", $db->f("end_date")) ?>&nbsp;</td>
    <td>
        <a class="toolbar" href="<?php echo $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=discountDelete&discount_id=<? echo $db->f("discount_id") ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
  </tr>
  <?php } ?> 
</table>
<?php 
  search_footer($modulename, "discount_list", $limitstart, $num_rows, $keyword ); 
}
?>
