<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: store.payment_method_list.php,v 1.8 2005/08/11 19:50:48 soeren_nb Exp $
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
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/payment.gif" border="0" />
      <br /><br />
    </td>
    <td><?php
          search_header($PHPSHOP_LANG->_PHPSHOP_PAYMENT_METHOD_LIST_LBL, $modulename, "payment_method_list"); 
        ?>
    </td>
  </tr>
</table>
<?php
  // Enable the multi-page search result display
  $limitstart= mosgetparam( $_REQUEST, 'limitstart');
  if (!empty($_REQUEST['keyword'])) {
     $keyword = $_REQUEST['keyword'];
     $list  = "SELECT * FROM #__pshop_payment_method, #__pshop_shopper_group WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_payment_method,#__pshop_shopper_group WHERE ";
     $q  = "(#__pshop_payment_method.payment_method_name LIKE '%$keyword%' ";
     $q .= "AND #__pshop_payment_method.vendor_id='$ps_vendor_id' ";
     $q .= "AND #__pshop_payment_method.shopper_group_id=#__pshop_shopper_group.shopper_group_id ";
     $q .= ") ";
     $q .= "ORDER BY #__pshop_payment_method.list_order,#__pshop_payment_method.payment_method_name ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $keyword = '';  
     $q = "";
     $list  = "SELECT * FROM #__pshop_payment_method,#__pshop_shopper_group WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_payment_method,#__pshop_shopper_group WHERE ";
     $q .= "#__pshop_payment_method.vendor_id='$ps_vendor_id' ";
     $q .= "AND #__pshop_payment_method.shopper_group_id=#__pshop_shopper_group.shopper_group_id ";
     $list .= $q;
     $list .= "ORDER BY #__pshop_payment_method.list_order,#__pshop_payment_method.payment_method_name ";
     $list .= "LIMIT $limitstart, " . SEARCH_ROWS;
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
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PAYMENT_METHOD_LIST_NAME ?></th>
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PAYMENT_METHOD_LIST_CODE ?></th>
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PAYMENT_METHOD_LIST_DISCOUNT ?></th>
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PAYMENT_METHOD_LIST_SHOPPER_GROUP ?></th>
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PAYMENT_METHOD_LIST_ENABLE_PROCESSOR ?></th>
    <th><?php echo $PHPSHOP_LANG->_PHPSHOP_ISSHIP_LIST_PUBLISH_LBL ?>?</th>
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
  <tr bgcolor="<?php echo $bgcolor ?>" nowrap="nowrap">
    <td width="20"><?php $nr = $limitstart+$i; echo $nr; ?></td>
    <td><?php
      $url = $_SERVER['PHP_SELF'] . "?page=$modulename.payment_method_form&limitstart=$limitstart&keyword=$keyword&payment_method_id=";
      $url .= $db->f("payment_method_id");
      echo "<a href=\"" . $sess->url($url) . "\">". $db->f("payment_method_name")."</a>"; ?>
  </td>
    <td><?php
	echo $db->f("payment_method_code");
?></td>
    <td><?php $db->p("payment_method_discount") ?></td>
    <td><?php $db->p("shopper_group_name") ?></td>
    <td><?php $enable_processor = $db->f("enable_processor");
                switch($enable_processor) { 
                    case "Y": 
                        echo $PHPSHOP_LANG->_PHPSHOP_PAYMENT_FORM_USE_PP;
                        break;
                    case "N":
                        echo $PHPSHOP_LANG->_PHPSHOP_PAYMENT_FORM_AO;
                        break;
                    case "B":
                        echo $PHPSHOP_LANG->_PHPSHOP_PAYMENT_FORM_BANK_DEBIT;
                        break;
                    case "P":
                        echo "PayPal related";
                        break;
                    default:
                        echo $PHPSHOP_LANG->_PHPSHOP_PAYMENT_FORM_CC;
                        break;
                                     
                } ?>
    </td>
   <td><?php if ($db->f("payment_enabled")=='N') { ?><img src="<?php echo $mosConfig_live_site ?>/administrator/images/publish_x.png" border="0" /><? } 
       else { ?><img src="<?php echo $mosConfig_live_site ?>/administrator/images/tick.png" border="0" /><? } ?></td>
    <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<? echo $_REQUEST['page'] ?>&func=paymentMethodDelete&payment_method_id=<? echo $db->f("payment_method_id") ?>&limitstart=<?php echo $limitstart ?>" onclick="return confirm('<? echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete<? echo $i ?>','','<? echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<? echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<? echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
  </tr>
  <?php } ?> 
</table>
<?php 
  search_footer($modulename, "payment_method_list", $limitstart, $num_rows, $keyword); 
}
?>