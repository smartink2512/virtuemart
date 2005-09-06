<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: affiliate.affiliate_orders_list.php,v 1.3 2005/01/27 19:34:00 soeren_nb Exp $
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
<h3>order summary <?php echo date('f y',$date) ?></h3><basefont <?php echo $base_font?>> 

<table width=100% align=center border=0 cellspacing=0 cellpadding=10>
    <tr valign=top> 
      <td align=left width=90%><?php 
         // order_id is returned by checkoutcomplete function
        $affiliate = $ps_affiliate->get_affiliate_details($auth["user_id"]);
      
        echo $affiliate["company"];
      
      ?>
      </td>
      <td width=10% align=right>&nbsp; </td>
    </tr>
    <tr> 
      <td colspan=2>
        <table class="adminlist">
          <tr>
            <th width="22%">order Ref </th>
            <th width="19%">date Ordered</th>
            <th width="19%">order Total</th>
            <th width="23%">commission(rate)</th>
            <th width="17%">order Status</th>
          </tr> <?php 
      
        $start_date = mktime(0,0,0,date("n"),1,date("Y"));
        $end_date = mktime(24,0,0,date("n")+1,0,date("Y"));

        $q = "select * from #__pshop_orders,#__pshop_affiliate_sale";
        $q .=" where #__pshop_orders.order_id = #__pshop_affiliate_sale.order_id";
        $q .=" and #__pshop_affiliate_sale.affiliate_id = '".$affiliate["id"]."'";
        $q .= " AND cdate BETWEEN $start_date AND $end_date ";

        $db->query($q);
      
        while($db->next_record()){ 
      
      ?>
          <tr>
            <td width="22%"><?php  printf("%08d", $db->f("order_id")); ?>
            <a href="<?php $sess->purl(secureurl . "?page=affiliate.orders_detail&print=1&order_id=".$db->f("order_id")) ?>">view</a>
            </td>
            <td width="19%"><?php echo date("d-m-y", $db->f("cdate")); ?></td>
            <td width="19%"><?php  printf("%1.2f", $db->f("order_subtotal")); ?></td>
            <td width="23%"><?php  printf("%1.2f", $db->f("order_subtotal") *$db->f("rate")*0.01); echo "(".$db->f("rate")."%)";?></td>
            <td width="17%"><?php  $db->p("order_status") ?></td>
          </tr> 
      
      <?php }?>
        </table>
      </td>
    </tr>
</table>
