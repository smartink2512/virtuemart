<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: store.index.php,v 1.10 2005/06/20 19:57:06 soeren_nb Exp $
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

// Number of customers
$db->query('SELECT count(*) as num_rows FROM #__users WHERE user_info_id <> ""');
$db->next_record();
$customers = $db->f('num_rows') ? $db->f('num_rows') : 0;

// Number of active products
$db->query('SELECT count(*) as num_rows FROM #__pshop_product WHERE product_publish="Y"');
$db->next_record();
$active_products = $db->f('num_rows') ? $db->f('num_rows') : 0;

// Number of inactive products
$db->query('SELECT count(*) as num_rows FROM #__pshop_product WHERE product_publish="N"');
$db->next_record();
$inactive_products = $db->f('num_rows') ? $db->f('num_rows') : 0;

// Number of featured products
$db->query('SELECT count(*) as num_rows FROM #__pshop_product WHERE product_special="Y"');
$db->next_record();
$special_products = $db->f('num_rows') ? $db->f('num_rows') : 0;

// 5 last orders
$new_orders= Array();
$db->query('SELECT order_id,order_total FROM #__pshop_orders ORDER BY cdate desc limit 5');
while($db->next_record()) {
  $new_orders[$db->f('order_id')] = $db->f('order_total');
}

$db_order_status = new ps_DB;
$db_order_status->query('SELECT order_status_code,order_status_name FROM #__pshop_order_status');

$orders = Array();
$sum = 0;
while($db_order_status->next_record()) {
  // Number of orders with status...
  $db->query('SELECT count(*) as num_rows FROM #__pshop_orders WHERE order_status="'.$db_order_status->f("order_status_code").'"');
  $db->next_record();
  $orders[$db_order_status->f("order_status_name")] = $db->f('num_rows') ? $db->f('num_rows') : 0;
  $order_status_code[] = $db_order_status->f("order_status_code");
  $sum += $db->f('num_rows');
}

// last 5 new customers
$new_customers = Array();
$db->query('SELECT id,first_name, last_name, username FROM #__users 
              WHERE user_info_id <> "" AND perms <> \'admin\' AND perms <> \'storeadmin\' 
              AND INSTR(usertype,\'administrator\') = 0 AND INSTR(usertype,\'Administrator\') = 0 
              ORDER BY registerdate desc limit 5');

while($db->next_record())
  $new_customers[$db->f("id")] = $db->f('username') ." (" . $db->f('first_name')." ".$db->f('last_name').")";

if( defined( '_PSHOP_ADMIN' ) && !defined( '_RELEASE' )) echo "</td></tr></table>";
?>
<div class="main">
<table width="100%" border="0">
  <tr>
    <td valign="middle" align="left">
      <table width="100%" border="0">
		<tr>
			<th class="sectionname">
              <img src="<?php echo IMAGEURL ?>ps_image/Desktop.png" width="48px" height="48px" align="center" alt="Desktop" border="0"/>
              <?php echo $PHPSHOP_LANG->_PHPSHOP_YOUR_STORE."::".$PHPSHOP_LANG->_PHPSHOP_CONTROL_PANEL; ?>
			</th>
		</tr>
      </table>
      <table width="100%" class="adminform">
        <tr>
          <td width="50%" valign="top">
          <table width="100%" border="0" class="cpanel">
            <tr>
                <td align="center" width="34%" height="100px">
                  <a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=product.product_list") ?>" style="text-decoration:none;">
                  <img src="<?php echo IMAGEURL ?>ps_image/shop_products.png" width="48px" height="48px" align="middle" border="0"/>
                  <br /><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_LBL; ?></a>
                </td>
                <td align="center" width="33%" height="100px">
                  <a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=product.product_category_list") ?>" style="text-decoration:none;">
                  <img src="<?php echo IMAGEURL ?>ps_image/shop_categories.png" width="48px" height="48px" align="middle" border="0"/>
                  <br /><?php echo $PHPSHOP_LANG->_PHPSHOP_CATEGORY_LIST_LBL; ?></a>
                </td>
                <td align="center" width="33%" height="100px">
                  <a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=order.order_list") ?>" style="text-decoration:none;">
                  <img src="<?php echo IMAGEURL ?>ps_image/shop_orders.png" width="48px" height="48px" align="middle" border="0"/>
                  <br /><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_MOD ?></a>
                </td>
            </tr>
            <tr>
                <td align="center" height="100px">
                  <a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=store.payment_method_list") ?>" style="text-decoration:none;">
                  <img src="<?php echo IMAGEURL ?>ps_image/shop_payment.png" width="48px" height="48px" align="middle" border="0"/>
                  <br /><?php echo $PHPSHOP_LANG->_PHPSHOP_PAYMENT_METHOD_LIST_MNU ?></a>
                </td>
                <td align="center" height="100px">
                  <a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=vendor.vendor_list") ?>" style="text-decoration:none;">
                  <img src="<?php echo IMAGEURL ?>ps_image/shop_vendors.png" width="48px" height="48px" align="middle" border="0"/>
                  <br /><?php echo $PHPSHOP_LANG->_PHPSHOP_VENDOR_MOD ?> Manager</a>
                </td>
                <td align="center" height="100px">
                <?php 
                if (defined( "_PSHOP_ADMIN" ) ) { ?>
                  <a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=admin.user_list") ?>" style="text-decoration:none;">
                  <img src="<?php echo IMAGEURL ?>ps_image/shop_users.png" width="48px" height="48px" align="middle" border="0"/>
                  <br /><?php echo $PHPSHOP_LANG->_PHPSHOP_USERS ?></a>
                  <?php 
                } ?>
                </td>
            </tr>
            <tr>
                <td align="center" height="100px">
                  <a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=admin.show_cfg") ?>" style="text-decoration:none;">
                  <img src="<?php echo IMAGEURL ?>ps_image/shop_configuration.png" width="48px" height="48px" align="middle" border="0"/>
                  <br /><?php echo $PHPSHOP_LANG->_PHPSHOP_CONFIG ?></a>
                </td>
                
                <td align="center" height="100px">
                <a href="<?php $sess->purl($_SERVER['PHP_SELF']."?pshop_mode=admin&page=store.store_form") ?>" style="text-decoration:none;">
                <img src="<?php echo IMAGEURL ?>ps_image/shop_mart.png" width="48px" height="48px" align="middle" border="0"/>
                <br /><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_MNU; ?>
                </a>
                </td>
                <td align="center" height="100px">
                  <a href="http://www.mambo-phpshop.net/index.php?option=com_wikidoc&Itemid=55" target="_blank" style="text-decoration:none;">
                  <img src="<?php echo IMAGEURL ?>ps_image/shop_help.png" width="48px" height="48px" align="middle" border="0"/>
                  <br /><?php echo $PHPSHOP_LANG->_PHPSHOP_HELP_MOD ?></a>
                </td>
            </tr>
          </table>
        </td>
	<td width="50%" valign="top">
	<div style="width:100%;">
    <?php
        $tabs = new mShopTabs(0, 1, "_main");
        $tabs->startPane("content-pane");
        $tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_STATISTIC_STATISTICS, "statistic-page");
    ?>
    <table class="adminlist">
        <tr> 
          <th colspan="2" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_STATISTIC_STATISTICS ?></th>
        </tr>
        <tr> 
          <td width="50%"><?php 
              echo "<a href=\"".$_SERVER['PHP_SELF']."?option=com_phpshop&page=admin.user_list\">"
                      .  $PHPSHOP_LANG->_PHPSHOP_STATISTIC_CUSTOMERS ?></a>:</td>
          <td width="50%"> <?php echo $customers ?></td>
        </tr>
        <tr> 
          <td width="50%"><?php 
              echo "<a href=\"".$_SERVER['PHP_SELF']."?option=com_phpshop&page=product.product_list\">"
                      .  $PHPSHOP_LANG->_PHPSHOP_STATISTIC_ACTIVE_PRODUCTS ?></a>:</td>
          <td width="50%"> <?php echo $active_products ?> </td>
        </tr>
        <tr> 
          <td width="50%"><?php echo $PHPSHOP_LANG->_PHPSHOP_STATISTIC_INACTIVE_PRODUCTS ?>:</td>
          <td width="50%"> <?php  echo $inactive_products ?></td>
        </tr>
        <tr> 
          <td width="50%"><?php 
              echo "<a href=\"".$_SERVER['PHP_SELF']."?option=com_phpshop&page=product.specialprod\">"
                      .  $PHPSHOP_LANG->_PHPSHOP_SPECIAL_PRODUCTS ?></a>:</td>
          <td width="50%"><?php echo $special_products ?></td>
        </tr>
    </table>
<?php
$tabs->endTab();
$tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_ORDER_MOD, "order-page");
?>
    <table class="adminlist">
        <tr> 
          <th colspan="2" ><?php 
              echo "<a href=\"".$_SERVER['PHP_SELF']."?option=com_phpshop&page=order.order_list\">"
                      .  $PHPSHOP_LANG->_PHPSHOP_ORDER_MOD ?></a>:</th>
        </tr>
        <?php 
        $i = 0;
        foreach($orders as $order_status_name => $order_count) { ?>
        <tr>
          <td width="50%"><?php 
            echo "<a href=\"".$_SERVER['PHP_SELF']."?option=com_phpshop&page=order.order_list&show=".$order_status_code[$i++]."\">";
            echo $order_status_name ."</a>" ?>:</td>
          <td width="50%"> <?php echo $order_count ?></td>
        </tr>
        <?php } ?>
        <tr> 
          <td width="50%"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_STATISTIC_SUM ?>:</strong></td>
          <td width="50%"><strong><?php echo $sum ?></strong></td>
        </tr>
	</table>
<?php
$tabs->endTab();
$tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_STATISTIC_NEW_ORDERS, "neworder-page");
?>
    <table class="adminlist">
      <tr>
          <th colspan="2"><?php echo $PHPSHOP_LANG->_PHPSHOP_STATISTIC_NEW_ORDERS ?></th>
      </tr>
<?php 
    foreach($new_orders as $order_id => $total) { ?>
          <tr>
          <td width="50%"><?php 
              echo "<a href=\"".$_SERVER['PHP_SELF']."?option=com_phpshop&page=order.order_print&order_id=$order_id\">";
              echo $PHPSHOP_LANG->_PHPSHOP_ORDER_LIST_ID." ". $order_id ."</a>" ?>:</td>
          <td width="50%">(<?php echo $total ." ".$_SESSION['vendor_currency'] ?>)</td>
        </tr>
        <?php 
    } ?>
	</table>
<?php
$tabs->endTab();
$tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_STATISTIC_NEW_CUSTOMERS, "newcustomer-page");
?>
    <table class="adminlist">
        <tr> 
          <th colspan="2" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_STATISTIC_NEW_CUSTOMERS ?></th>
        </tr>
	        <?php foreach($new_customers as $id => $name) { ?>
        <tr>
          <td colspan="2">
              <a href="<?php echo $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=admin.user_list&task=edit&cid[0]=<?php echo $id ?>">
              <?php echo $name ?></a></td>
        </tr>
        <?php } ?>
    </table>
<?php
$tabs->endTab();
$tabs->endPane();
?> 
</td></tr></table>
</td></tr></table>

</div>
