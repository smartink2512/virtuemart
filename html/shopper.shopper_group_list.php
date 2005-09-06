<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shopper.shopper_group_list.php,v 1.8 2005/02/22 18:58:30 soeren_nb Exp $
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

// Enable the multi-page search result display
$limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );
if (!is_numeric($limitstart))
{
    $limitstart = 0;
}
$keyword= mosgetparam( $_REQUEST, 'keyword', null );
$q = "";
?>
 <table width="100%" cellspacing="0" cellpadding="4" border="0">
  <tr>
    <td>
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/shoppers.png" width="48" height="48" border="0" />
      <br /><br />
    </td>
    <td><?php
         search_header($PHPSHOP_LANG->_PHPSHOP_SHOPPER_GROUP_LIST_LBL, $modulename, "shopper_group_list"); 
        ?>
    </td>
  </tr>
</table>
<?php 

  if (!empty($keyword)) {

      $list = "SELECT * FROM #__pshop_shopper_group WHERE ";
      $count = "SELECT count(*) as num_rows FROM #__pshop_shopper_group WHERE ";
      if( !$perm->check("admin")) {
         $q = " vendor_id='$ps_vendor_id' ";
      }
     $q .= "AND (shopper_group_name LIKE '%$keyword%' ";
     $q .= "OR shopper_group_desc LIKE '%$keyword%' ";
     $q .= ") ";
     $q .= "ORDER BY shopper_group_name "; 
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else  {

      $list = "SELECT * FROM #__pshop_shopper_group ";
      $count = "SELECT count(*) as num_rows FROM #__pshop_shopper_group ";
      if( !$perm->check("admin")) {
         $q = "WHERE vendor_id='$ps_vendor_id' ";
      }
      $q .= " ORDER BY vendor_id, shopper_group_name "; 
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
  <tr> 
    <th width="20">#</th>
    <th width="30%" ><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_GROUP_LIST_NAME ?> </th>
<?php
   if( $perm->check("admin")) { ?>
    <th ><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_VENDOR ?></th>
<?php
   } ?>  
   <th ><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_GROUP_LIST_DESCRIPTION ?></th>
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_DEFAULT ?> ?</th>
    <th><? echo _E_REMOVE ?></th>
  </tr>
  <?php

        $db->query($list);
        $i=0;
        while ($db->next_record()) { 
             if ($i++ % 2) 
                $bgcolor=SEARCH_COLOR_1;
             else
                $bgcolor=SEARCH_COLOR_2;
    ?> 
  <tr bgcolor=<?php echo $bgcolor ?> nowrap> 
    <td width="20"><?php $nr = $limitstart+$i; echo $nr; ?></td>
    <td nowrap valign="top" ><?php
        $url = $_SERVER['PHP_SELF'] . "?page=$modulename.shopper_group_form&limitstart=$limitstart&keyword=$keyword&shopper_group_id=";
        $url .= $db->f("shopper_group_id");
        echo "<a href=\"" . $sess->url($url) . "\">";
        echo $db->f("shopper_group_name"); 
        echo "</a>";
        ?> <span ><span ></span></span>
    </td><?php
   if( $perm->check("admin")) { 
      include_class("vendor");
      global $ps_vendor;
   ?>
       <td><?php echo $ps_vendor->get_name($db->f("vendor_id")) ?></td>
      <?php
   } ?> 
    <td valign="top" ><?php $db->p("shopper_group_desc"); ?></td>
    <td><img src="<?php echo ($db->f("default")=="1") ? $mosConfig_live_site ."/administrator/images/tick.png" : $mosConfig_live_site ."/administrator/images/publish_x.png" ?>" border="0" />
    <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=shopperGroupDelete&shopper_group_id=<? echo $db->f("shopper_group_id") ?>&limitstart=<?php echo $limitstart ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('Delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
  </tr>
  <?php } ?> 
</table>
<?php 
  search_footer($modulename, "shopper_group_list", $limitstart, $num_rows, $keyword); 
}
?> 
