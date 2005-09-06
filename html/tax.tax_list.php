<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: tax.tax_list.php,v 1.6 2005/01/27 19:34:04 soeren_nb Exp $
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
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/taxes.gif" border="0" />
      <br /><br />
    </td>
    <td><?php
          search_header($PHPSHOP_LANG->_PHPSHOP_TAX_LIST_LBL, $modulename, "tax_list"); 
        ?>
    </td>
  </tr>
</table>
<?php 
  // Enable the multi-page search result display
  $limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );
  if (!empty($_REQUEST['keyword'])) {
    $keyword= $_REQUEST['keyword'];
     $list  = "SELECT * FROM #__pshop_tax_rate WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_tax_rate WHERE ";
     $q  = "(tax_state LIKE '%$keyword%' OR ";
     $q .= "tax_country LIKE '%$keyword%'";
     $q .= ") ";
     $q .= "ORDER BY tax_country, tax_state ASC ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $keyword='';
     $q = "";
     $list  = "SELECT * FROM #__pshop_tax_rate ORDER BY tax_country, tax_state ASC ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_tax_rate"; 
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
    <th width="44%"><?php echo $PHPSHOP_LANG->_PHPSHOP_TAX_LIST_COUNTRY ?></th>
    <th width="38%"><?php echo $PHPSHOP_LANG->_PHPSHOP_TAX_LIST_STATE ?></th>
    <th width="18%"><?php echo $PHPSHOP_LANG->_PHPSHOP_TAX_LIST_RATE ?></th>
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
    <td width="44%" nowrap><?php
        $url = $_SERVER['PHP_SELF'] . "?page=$modulename.tax_form&limitstart=$limitstart&keyword=$keyword&tax_rate_id=";
        $url .= $db->f("tax_rate_id");
        echo "<a href=\"" . $sess->url($url) . "\">";
        $db->p("tax_country");
        echo "</a><br />";
       ?></td>
    <td width="38%"><?php $db->p("tax_state") ?></td>
    <td width="18%"><?php
        $url = $_SERVER['PHP_SELF'] . "?page=$modulename.tax_form&limitstart=$limitstart&keyword=$keyword&tax_rate_id=";
        $url .= $db->f("tax_rate_id");
        echo "<a href=\"" . $sess->url($url) . "\">";
        printf("%8.4f", $db->f("tax_rate"));
        echo "</a><br />";
       ?>
    </td>
   <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=deleteTaxRate&tax_rate_id=<? echo $db->f("tax_rate_id") ?>&limitstart=<?php echo $limitstart ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
  </tr>
  <?php } ?> 
</table>

<?php 
  search_footer($modulename, "tax_list", $limitstart, $num_rows, $keyword); 
}
?>
