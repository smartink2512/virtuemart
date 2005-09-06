<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* PayPal IPN Result Checker
* @version $Id: checkout.result.php,v 1.5 2005/01/27 19:34:01 soeren_nb Exp $
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

if( !isset( $_REQUEST["order_id"] ) || empty( $_REQUEST["order_id"] ))
  echo "Order ID is not set or emtpy!";
else {
  include( CLASSPATH. "payment/ps_paypal.cfg.php" );
  $order_id = mosgetparam( $_REQUEST, "order_id" ); 

  $q = "SELECT order_status FROM #__pshop_orders WHERE "; 
  $q .= "#__pshop_orders.user_id='" . $auth["user_id"] . "' ";
  $q .= "AND #__pshop_orders.order_id='$order_id'"; 
  $db->query($q);
  if ($db->next_record()) {
      if ($db->f("order_status") == PAYPAL_VERIFIED_STATUS) {  ?> 
        <img src="<?php echo IMAGEURL ?>ps_image/button_ok.png" align="center" alt="Success" border="0" />
        <h2><?php echo $PHPSHOP_LANG->_PHPSHOP_PAYPAL_THANKYOU ?></h2>
    
    <? 
      }
      else { ?>
        <img src="<?php echo IMAGEURL ?>ps_image/button_cancel.png" align="center" alt="Failure" border="0" />
        <span class="message"><? echo $PHPSHOP_LANG->_PHPSHOP_PAYPAL_ERROR ?></span>
    
    <?
    } ?>
    <br />
     <p><a href="index.php?option=com_phpshop&page=account.order_details&order_id=<?php echo $order_id ?>">
     <?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_LINK ?></a>
     </p>
    <?php
  }
  else {
      echo "Order not found!";
  }
}
?>
