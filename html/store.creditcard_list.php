<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: store.creditcard_list.php,v 1.5 2005/01/27 19:34:03 soeren_nb Exp $
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
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/credit.jpg" border="0" />
      <br /><br />
    </td>
    <td><?php
        search_header($PHPSHOP_LANG->_PHPSHOP_CREDITCARD_LIST_LBL, 'store', 'creditcard_list'); 
        ?>
    </td>
  </tr>
</table>
<?php
  // Enable the multi-page search result display
  $limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );
  if (!empty($_REQUEST['keyword'])) {
     $keyword = $_REQUEST['keyword'];
     $list  = "SELECT * FROM #__pshop_creditcard WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_creditcard WHERE ";
     $q  = "(creditcard_name LIKE '%$keyword%' OR ";
     $q .= "creditcard_code LIKE '%$keyword%') ";
     $q .= "ORDER BY creditcard_name ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $keyword = '';
     $list  = "SELECT * FROM #__pshop_creditcard ";
     $list .= "ORDER BY creditcard_name ";
     $list .= "LIMIT $limitstart, " . SEARCH_ROWS;
     $count = "SELECT count(*) as num_rows FROM #__pshop_creditcard ";
  }
  $db->query($count);
  $db->next_record();
  $num_rows = $db->f("num_rows");
  if ($num_rows == 0) {
     echo $PHPSHOP_LANG->_PHPSHOP_NO_SEARCH_RESULT;
  }
  else {
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="adminForm">
<input type="hidden" name="option" value="com_phpshop" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<table width="100%" class="adminlist">
  <tr> 
    <th width="20">#</th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_CREDITCARD_NAME ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_CREDITCARD_CODE ?></th>
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
  
    <td width="20"><?php $nr = $limitstart+$i; echo $nr; ?></td>
    <td width="19%">
    <a href="<?php  echo $sess->url($_SERVER['PHP_SELF'] ."?page=store.creditcard_form&limitstart=$limitstart&keyword=$keyword&creditcard_id=".$db->f("creditcard_id")) ?>">
    <? echo $db->p("creditcard_name") ?></a>
    </td>
    <td width="24%"><?php $db->p("creditcard_code") ?></td>
    <td>
        <a class="toolbar" href="<?php echo $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=creditcardDelete&creditcard_id=<? echo $db->f("creditcard_id") ?>&limitstart=<?php echo $limitstart ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);">
        <img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
  </tr>
  <?php } ?> 
</table>
<?php 
  search_footer('store', 'creditcard_list', $limitstart, $num_rows, $keyword); 
}
?>
