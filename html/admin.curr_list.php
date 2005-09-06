<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.curr_list.php,v 1.5 2005/01/27 19:34:00 soeren_nb Exp $
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
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/currency.gif" border="0" />
      <img src="<?php echo IMAGEURL ?>ps_image/payment.jpg" border="0" />
      <br /><br />
    </td>
    <td><?php
          search_header($PHPSHOP_LANG->_PHPSHOP_CURRENCY_LIST_LBL, 'admin', 'curr_list'); 
        ?>
    </td>
  </tr>
</table>
<?php
  // Enable the multi-page search result display
  $limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );
  
  if (!empty($_REQUEST['keyword'])) {
     $keyword = $_REQUEST['keyword'];
     $list  = "SELECT * FROM #__pshop_currency WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_currency WHERE ";
     $q  = "(currency_name LIKE '%$keyword%' OR ";
     $q .= "currency_code LIKE '%$keyword%' ";
     $q .= ") ";
     $q .= "ORDER BY currency_name ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $keyword = '';
     $list  = "SELECT * FROM #__pshop_currency ";
     $list .= "ORDER BY currency_name ";
     $list .= "LIMIT $limitstart, " . SEARCH_ROWS;
     $count = "SELECT count(*) as num_rows FROM #__pshop_currency ";
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
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_LIST_NAME ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_LIST_CODE ?></th>
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
        $my_number = $i + $limitstart;
        ?> 
  <tr bgcolor=<?php echo $bgcolor ?>>
    <td><? echo $my_number ?></td>
    <td width="19%">
        <a href="<?php echo $sess->url($_SERVER['PHP_SELF'] ."?page=admin.curr_form&limitstart=$limitstart&keyword=$keyword&currency_id=".$db->f("currency_id")) ?>">
            <? $db->p("currency_name") ?>
        </a>
    </td>
    <td width="24%"><?php $db->p("currency_code") ?></td>
    <td><a class="toolbar" href="index2.php?option=com_phpshop&page=<? echo $page ?>&func=currencyDelete&currency_id=<? echo $db->f('currency_id') ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete<?php echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="delete" name="delete<?php echo $i ?>" align="middle" border="0"/></a></td>

  </tr>
  <?php } ?> 
</table>
<?php 
  search_footer('admin', 'curr_list', $limitstart, $num_rows, $keyword); 
}
?>
