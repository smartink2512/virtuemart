<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.country_state_list.php,v 1.2 2005/06/11 10:16:58 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) 2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );

// Enable the multi-page search result display
$limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );
if( $limitstart=="") $limitstart= 0;
$keyword= mosgetparam( $_REQUEST, 'keyword', "" );
$country_id = mosgetparam( $_REQUEST, 'country_id' );
if( empty($country_id)) mosredirect( $_SERVER['PHP_SELF']."?option=com_phpshop&page=admin.country_list", "A country ID could not be found");

$db->query( "SELECT country_name FROM #__pshop_country WHERE country_id='$country_id'");
$db->next_record();
?>
<table width="100%" cellspacing="0" cellpadding="4" border="0">
  <tr>
    <td>
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/countries.gif" border="0" />
      <br /><br />
    </td>
    <td><?php
        search_header($PHPSHOP_LANG->_PHPSHOP_STATE_LIST_LBL." ".$db->f("country_name"), 'admin', 'country_state_list');
        ?>
    </td>
  </tr>
</table>
<?php
  
  
  $q  = "SELECT SQL_CALC_FOUND_ROWS * FROM #__pshop_state ";
     
  if (!empty($keyword)) {
     $q .= "WHERE( state_name LIKE '%$keyword%' OR ";
     $q .= "state_2_code LIKE '%$keyword%' OR ";
     $q .= "state_3_code LIKE '%$keyword%' ";
     $q .= ") ";
  }
  $q .= "WHERE country_id='$country_id' ";
  $q .= "ORDER BY state_name ";
  $q .= " LIMIT $limitstart, " . SEARCH_ROWS;

  $db->query($q);
  
  $database->setQuery("SELECT FOUND_ROWS() as num_rows");
  $num_rows = $database->loadResult();
  
  if ($num_rows == 0) {
     echo $PHPSHOP_LANG->_PHPSHOP_NO_SEARCH_RESULT;
  }
  else {
?>
<table width="100%" class="adminlist">
  <tr> 
    <th width="20">#</th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_STATE_LIST_NAME ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_STATE_LIST_3_CODE ?></th>
    <th align="left"><?php echo $PHPSHOP_LANG->_PHPSHOP_STATE_LIST_2_CODE ?></th>
    <th><? echo _E_REMOVE ?></th>
  </tr>
<?php
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
    <a href="<?php  echo $sess->url($_SERVER['PHP_SELF'] ."?page=admin.country_state_form&limitstart=$limitstart&keyword=$keyword&state_id=".$db->f("state_id")."&country_id=".$country_id) ?>">
    <? echo $db->p("state_name") ?></A>
    </td>    
    <td width="24%"><?php $db->p("state_3_code") ?></td>
    <td width="24%"><?php $db->p("state_2_code") ?></td>
        <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=stateDelete&state_id=<? echo $db->f("state_id") ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
  </tr>
  <?php } ?> 
</table>
<?php 
  search_footer('admin', 'country_state_list', $limitstart, $num_rows, $keyword, "&country_id=$country_id" ); 
}
?>
