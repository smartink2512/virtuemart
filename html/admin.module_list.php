<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.module_list.php,v 1.6 2005/01/27 19:34:00 soeren_nb Exp $
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

?>
 <table width="100%" cellspacing="0" cellpadding="4" border="0">
  <tr>
    <td>
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/modules.gif" border="0" />
      <br /><br />
    </td>
    <td><?php
          search_header($PHPSHOP_LANG->_PHPSHOP_MODULE_LIST_LBL, "admin", "module_list"); 
        ?>
    </td>
  </tr>
</table>
<?php 
  // Enable the multi-page search result display
  $limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );
  
  if (!empty($_REQUEST['keyword'])) {
     $keyword = $_REQUEST['keyword'];
     $list  = "SELECT * FROM #__pshop_module WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_module WHERE ";
     $q  = "(module_name LIKE '%$keyword%' OR ";
     $q .= "module_description LIKE '%$keyword%'";
     $q .= ") ";
     $q .= "ORDER BY list_order ASC ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $keyword = '';
     $q = "";
     $list  = "SELECT * FROM #__pshop_module ORDER BY list_order ASC ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_module ORDER BY list_order "; 
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
  <tr align=left> 
    <th width="20">#</th>
    <th nowrap><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_LIST_NAME ?></th>
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_LIST_PERMS ?></th>
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_LIST_FUNCTIONS ?></th>
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_LIST_ORDER ?></th>
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
  <tr bgcolor=<?php echo $bgcolor ?>>
    <td width="20"><?php $nr = $limitstart+$i; echo $nr; ?></td>
    <td width="19%"> 
     <a href="<?php echo $sess->url(SECUREURL . "administrator/index2.php?page=$modulename.module_form&&limitstart=$limitstart&module_id=" . $db->f("module_id"))?>">
     <? echo $db->f("module_name"); ?>
     </A> 
    </td>
    <TD WIDTH="20%"><?php $db->p("module_perms") ?>&nbsp;</TD>
    <td width="20%"><a href="<?php $sess->purl($_SERVER['PHP_SELF']."?page=$modulename.function_list&module_id=" . $db->f("module_id")); ?>"><? echo $PHPSHOP_LANG->_PHPSHOP_LIST ?></A></td>
    <TD WIDTH="20%"><?php $db->p("list_order") ?></TD>
    <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=moduleDelete&module_id=<? echo $db->f("module_id") ?>&limitstart=<?php echo $limitstart ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
    
  </tr>
  <?php }  ?> 
</table>
<?php 
  search_footer($modulename, "module_list", $limitstart, $num_rows, $keyword); 
}
?>

