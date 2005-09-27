<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: COPYRIGHT.php 70 2005-09-15 20:45:51Z spacemonkey $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_phpshop/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );
?>
<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_MOD ?></h2>

<?php   search_header($PHPSHOP_LANG->_PHPSHOP_SHOPPER_LIST_LBL, $modulename, "shopper_list"); 
  // Enable the multi-page search result display
  $limitstart= mosgetparam( $_REQUEST, 'limitstart', 0 );

  if (isset($keyword)) {
     $list = "SELECT DISTINCT * FROM #__pshop_shopper_vendor_xref,#__users, #__pshop_shopper_group WHERE ";
     $count = "SELECT DISTINCT count(*) as num_rows FROM ";
     $count .= "#__pshop_shopper_vendor_xref,#__users, #__pshop_shopper_group WHERE ";
     $q = "#__users.id=#__pshop_shopper_vendor_xref.user_id ";
     $q .= "AND #__pshop_shopper_vendor_xref.vendor_id='$ps_vendor_id' ";
     $q .= "AND (#__users.perms = 'shopper' "; 
     $q .= "OR #__users.perms = 'anonymous') "; 
     $q .= "AND (#__users.last_name LIKE '%$keyword%' ";
     $q .= "OR #__users.first_name LIKE '%$keyword%' ";
     $q .= "OR #__users.middle_name LIKE '%$keyword%' ";
     $q .= "OR #__users.phone_1 LIKE '%$keyword%' ";
     $q .= "OR #__pshop_shopper_group.shopper_group_name LIKE '%$keyword%' ";
     $q .= ") ";
     $q .= "AND #__pshop_shopper_group.shopper_group_id=#__pshop_shopper_vendor_xref.shopper_group_id ";
     $q .= "ORDER BY #__users.username "; 
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else
  {
     $keyword = "";
     $list = "SELECT * FROM #__pshop_affiliate,#__pshop_shopper_vendor_xref, #__users, #__pshop_shopper_group WHERE ";
     $count = "SELECT count(*) as num_rows FROM ";
     $count .= "#__pshop_affiliate,#__pshop_shopper_vendor_xref, #__users, #__pshop_shopper_group WHERE ";
     $q = "#__users.id=#__pshop_shopper_vendor_xref.user_id ";
     $q .= "AND #__pshop_shopper_vendor_xref.vendor_id='$ps_vendor_id' ";
     $q .= "AND #__pshop_affiliate.user_id <> #__users.user_info_id ";
     $q .= "AND (#__users.perms = 'shopper' "; 
     $q .=   "OR #__users.perms = 'anonymous') "; 
     $q .= "AND #__pshop_shopper_group.shopper_group_id=#__pshop_shopper_vendor_xref.shopper_group_id ";
     $q .= "ORDER BY #__users.username "; 
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
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td width="23%"><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_LIST_USERNAME ?></td>
    <td width="50%"><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_LIST_NAME ?></td>
    <td width="27%"><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_LIST_GROUP ?></td>
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
    <td width="23%"><?php
        $url = SECUREURL . "?page=affiliate.affiliate_list&user_info_id=" . $db->f("user_info_id")."&func=affiliateadd";
        echo "<a href=\"" . $sess->url($url) . "\">";
        echo $db->f("username"); 
        echo "</a>"; ?>
    </td>
    <td width="50%"><?php echo $db->f("first_name") . " ";
        echo $db->f("middle_name") . " ";
        echo $db->f("last_name"); ?>
    </td>
    <td width="27%"><?php
        
        //$url = SECUREURL . "?page=$modulename/shopper_by_group_list&perms=";
        //$url .= $db->f("perms");
        //echo "<A HREF=" . $sess->url($url) . ">";
        
        echo $db->f("shopper_group_name");  
        
        //echo "</A>";?>
    </td>
  </tr>
  <?php } ?> 
</table>

<?php 
  search_footer($modulename, "shopper_add", $limitstart, $num_rows, $keyword); 
}
?>

