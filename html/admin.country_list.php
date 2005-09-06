<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.country_list.php,v 1.7 2005/05/08 09:02:24 soeren_nb Exp $
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
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/countries.gif" border="0" />
      <br /><br />
    </td>
    <td><?php
        search_header($PHPSHOP_LANG->_PHPSHOP_COUNTRY_LIST_LBL, 'admin', 'country_list');
        ?>
    </td>
  </tr>
</table>
<?php
  // Enable the multi-page search result display
  $limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );
  
  if (!empty($_REQUEST['keyword'])) {
     $keyword = $_REQUEST['keyword'];
     $list  = "SELECT * FROM #__pshop_country WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_country WHERE ";
     $q  = "(country_name LIKE '%$keyword%' OR ";
     $q .= "country_2_code LIKE '%$keyword%' OR ";
     $q .= "country_3_code LIKE '%$keyword%' ";
     $q .= ") ";
     $q .= "ORDER BY country_name ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $keyword = '';
     $list  = "SELECT * FROM #__pshop_country ";
     $list .= "ORDER BY country_name ";
     $list .= "LIMIT $limitstart, " . SEARCH_ROWS;
     $count = "SELECT count(*) as num_rows FROM #__pshop_country ";
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
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_COUNTRY_LIST_NAME ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_ASSIGN_CURRENT_LBL ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_COUNTRY_LIST_3_CODE ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_COUNTRY_LIST_2_CODE ?></th>
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
    <a href="<?php  echo $sess->url($_SERVER['PHP_SELF'] ."?page=admin.country_form&limitstart=$limitstart&keyword=$keyword&country_id=".$db->f("country_id")) ?>">
    <? echo $db->p("country_name") ?></a>&nbsp;&nbsp;
    <a href="<?php $sess->purl($_SERVER['PHP_SELF'] ."?page=admin.country_state_list&country_id=".$db->f("country_id")) ?>">[ <?php echo $PHPSHOP_LANG->_PHPSHOP_STATE_LIST_MNU ?> ]</a>
    </td>
    <td width="24%"><?php $db->p("zone_id") ?></td>
    <td width="24%"><?php $db->p("country_3_code") ?></td>
    <td width="24%"><?php $db->p("country_2_code") ?></td>
        <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=countryDelete&country_id=<? echo $db->f("country_id") ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
  </tr>
  <?php } ?> 
</table>
<?php 
  search_footer('admin', 'country_list', $limitstart, $num_rows, $keyword); 
}
?>
