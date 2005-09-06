<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.function_list.php,v 1.6 2005/01/27 19:34:00 soeren_nb Exp $
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
// Get module ID
  $module_id = mosgetparam( $_REQUEST, 'module_id', 0 );
  
  $q = "SELECT * FROM #__pshop_module WHERE module_id='$module_id'";
  $db->query($q);
  $db->next_record();
  $pagename = $PHPSHOP_LANG->_PHPSHOP_FUNCTION_LIST_LBL . ": " . $db->f("module_name");
 ?>

 <table width="100%" cellspacing="0" cellpadding="4" border="0">
  <tr>
    <td>
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/functions.gif" border="0" />
      <br /><br />
    </td>
    <td><?php
          search_header($pagename, $modulename, "function_list"); 
        ?>
    </td>
  </tr>
</table>

<?
  // Enable the multi-page search result display
  $limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );
  
  if (!empty($_REQUEST['keyword'])) {
     $keyword = $_REQUEST['keyword'];
     $list  = "SELECT * FROM #__pshop_function WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_function WHERE ";
     $q  = "(function_name LIKE '%$keyword%' OR ";
     $q .= "function_perms LIKE '%$keyword%' ";
     $q .= ") ";
     $q .= "AND module_id='$module_id' ";
     $q .= "ORDER BY function_name ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $keyword = '';
     $list  = "SELECT * FROM #__pshop_function WHERE module_id='$module_id' ";
     $list .= "ORDER BY function_name ";
     $list .= "LIMIT $limitstart, " . SEARCH_ROWS;
     $count = "SELECT count(*) as num_rows FROM #__pshop_function ";
     $count .= "WHERE module_id='$module_id' ";
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
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_LIST_NAME ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_LIST_CLASS ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_LIST_METHOD ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_LIST_PERMS ?></th>
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
    <a href="<?php echo $sess->url(SECUREURL . "administrator/index2.php?page=admin.function_form&limitstart=$limitstart&keyword=$keyword&module_id=$module_id&function_id=" . $db->f("function_id")) ?>">
    <? $db->p("function_name"); ?>
    </a>
</td>
    <td width="17%"><?php $db->p("function_class") ?></td>
    <td width="24%"><?php $db->p("function_method") ?></td>
    <td width="20%"><?php $db->p("function_perms") ?>&nbsp;</td>
    <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=functionDelete&function_id=<? echo $db->f("function_id") ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
  </tr>
  <?php } ?> 
</table>
<?php 
  search_footer($modulename, "function_list", $limitstart, $num_rows, $keyword, "&module_id=$module_id"); 
}
?>
