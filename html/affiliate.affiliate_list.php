<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: affiliate.affiliate_list.php,v 1.6 2005/09/04 20:08:55 soeren_nb Exp $
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
global $ps_affiliate;
?>
  
 <table width="100%" cellspacing="0" cellpadding="4" border="0">
  <tr>
    <td>
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/affiliate.gif" border="0" />
      <br /><br />
    </td>
    <td><?php
          search_header($PHPSHOP_LANG->_PHPSHOP_AFFILIATE_LIST_LBL, 'affiliate', "affiliate_list"); 
        ?>
    </td>
  </tr>
</table>
<?php

 if (!isset($date)) $date = time();

  // Enable the multi-page search result display
$limitstart= mosgetparam( $_REQUEST, 'limitstart', 0);
  if (isset($keyword)) {
     $list  = "SELECT DISTINCT * FROM #__pshop_affiliate, #__users WHERE ";
     $count = "SELECT DISTINCT count(*) as num_rows FROM #__pshop_affiliate, #__users  WHERE ";
     $q  = "((first_name LIKE '%$keyword%') OR (";
     $q  .= "last_name LIKE '%$keyword%') OR (";
     $q  .= "username LIKE '%$keyword%') OR (";
     $q  .= "company LIKE '%$keyword%') OR (";
     $q  .= "name LIKE '%$keyword%')) ";
     $q .= "ORDER BY first_name ASC ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  elseif (isset($vendor_category_id)) 
  {
     $q = "";
     $list  = "SELECT * FROM #__pshop_affiliate, #__users WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_affiliate, #__users  WHERE ";
     $q = "user_info_id=user_id ";
     $q .= "ORDER BY first_name ASC ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $q = "";
     $keyword = "";
     $list  = "SELECT * FROM #__users, #__pshop_affiliate";
     $list .= " WHERE #__users.user_info_id =#__pshop_affiliate.user_id";
	   //$list .= " ORDER BY company ASC";
     $count = "SELECT count(affiliate_id) as num_rows FROM #__pshop_affiliate"; 
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;       
  }
  $db->query($count);
  $db->next_record();
  $num_rows = $db->f("num_rows");
  
  if (empty($num_rows)) {
     echo $PHPSHOP_LANG->_PHPSHOP_NO_SEARCH_RESULT;
  }
  else {
?>
<h4>Showing Details for <?php echo date("M-Y",$date);?></h4>

<br />
<table class="adminlist"> 
  <tr>
      <th width="20%"><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_LIST_AFFILIATE_NAME ?></th>
      <th width="6%"><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_LIST_AFFILIATE_ACTIVE?></th>
      <th width="15%"><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_LIST_MONTH_TOTAL?></th>
      <th width="25%"><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_LIST_MONTH_COMMISSION ?></th>
      <th width="15%"><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_LIST_RATE ?></th>
      <th width="10%"><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_LIST_ORDERS ?></th>
      <th width="9%"><?php echo _E_REMOVE ?></th>
  </tr> 
<?php
$db->query($list);
$i = 0;


while ($db->next_record()) {
  $affiliate = $ps_affiliate->get_details($date,$db->f("affiliate_id"));
  if ($i++ % 2) 
     $bgcolor=SEARCH_COLOR_1;
  else
     $bgcolor=SEARCH_COLOR_2;
     
?> <tr bgcolor="<?php echo $bgcolor ?>">
        <td> <?php
            $url = SECUREURL . "?page=$modulename.affiliate_form&affiliate_id=";
            $url .= $db->f("affiliate_id");
            echo "<a href=" . $sess->url($url) . ">";
            echo $db->f("first_name")." ".$db->f("last_name")." (".$db->f("username").")";
            echo "</a><br />";?>
        </td>
        <td><?php
            if($db->f("active")=='Y') echo "Yes"; else echo "No"; ?>
        </td>
        <td><?php
            if (!empty($affiliate["orders_total"])) 
                echo $affiliate["orders_total"];
            else echo "no sales"; ?>
        </td>
        <td><?php
            if (!empty($affiliate["commission_total"]))
                echo $affiliate["commission_total"];
            else echo "no sales"; ?>
        </td>
        <td><?php
            echo $affiliate["rate"]."%"; ?>
        </td>
        <td><?php
                $url = SECUREURL . "?page=$modulename.affiliate_orders_detail&affiliate_id=";
                $url .= $db->f("affiliate_id");
                $url.="&date=".$date;
                echo "<a href=\"" . $sess->url($url) . "\">";
                echo "list orders";
                echo "</a><br />";?>
        </td>
        <td><a href="index2.php?option=com_phpshop&page=affiliate.affiliate_list&func=affiliatedelete&user_info_id=<?php echo $db->f("user_id")?>">
        <?php echo _E_REMOVE ?></a>
        </td>
    </tr>
  <?php } ?>
  </table>
  
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
  <input type="hidden" name="user_id" value="<?php $db->sp("user_id"); ?>" />
  <input type="hidden" name="date" value="<?php echo isset($date) ? $date : ""; ?>" /> 
  <input type="hidden" name="page" value="<?php echo $modulename?>.affiliate_list" /> 
  <input type="hidden" name="option" value="com_phpshop" /> 
  <input type="hidden" name="task" value="" /> 
 <br>Month
 <select name="date" size="1"><?php
  for($i=0; $i<12; $i++){ 
    $mytime = mktime(0,0,0,date('m')-$i,1,date('y'));?>
    <option value="<?php echo $mytime ?>" <?php if($mytime == $date) echo "selected"?>><?php 
    echo date('F Y',$mytime); ?>
    </option><?php echo "\n";
}
?> </select><br><br>

<input type="submit" name="submit" class="submit" value="Change View">

</form><br><br><?php 

  search_footer($modulename, "affiliate_list", $limitstart, $num_rows, $keyword); 

  } 

?> 
