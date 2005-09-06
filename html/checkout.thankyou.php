<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: checkout.thankyou.php,v 1.17 2005/05/21 16:08:00 soeren_nb Exp $
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

require_once(CLASSPATH.'ps_product.php');
$ps_product= new ps_product;
$Itemid = mosGetParam( $_REQUEST, "Itemid", null );

global $vendor_currency;

// Order_id is returned by checkoutComplete function
$order_id = $vars["order_id"]; 

$print = mosgetparam( $_REQUEST, 'print', 0);

/** Retrieve User Email **/
$q  = "SELECT * FROM #__pshop_order_user_info WHERE order_id='$order_id' AND address_type='BT'"; 
$database->setQuery( $q );
$database->loadObject($user);
$user->email = $user->user_email;

/** Retrieve Order & Payment Info **/
$db = new ps_DB;
$q  = "SELECT * FROM #__pshop_payment_method, #__pshop_order_payment, #__pshop_orders ";
$q .= "WHERE #__pshop_order_payment.order_id='$order_id' ";
$q .= "AND #__pshop_payment_method.payment_method_id=#__pshop_order_payment.payment_method_id ";
$q .= "AND #__pshop_orders.user_id='" . $auth["user_id"] . "' ";
$q .= "AND #__pshop_orders.order_id='$order_id' ";
$db->query($q);
if ($db->next_record()) {

?>
<h3><? echo $PHPSHOP_LANG->_PHPSHOP_THANKYOU ?></h3>
 <p>
 <?php if( empty($vars['error'])) { ?>
   <img src="<?php echo IMAGEURL ?>ps_image/button_ok.png" height="48" width="48" align="center" alt="Success" border="0" />
   <?php echo $PHPSHOP_LANG->_PHPSHOP_THANKYOU_SUCCESS?>
  
  <br /><br />
  <?php echo $PHPSHOP_LANG->_PHPSHOP_EMAIL_SENDTO .": <strong>". $user->user_email; ?></strong><br />
  </p>
  <?php } ?>
  
<!-- Begin Payment Information -->
<?php

 if ($db->f("order_status") == "P" ) {
 
 /** Start printing out HTML Form code (Payment Extra Info) **/ ?>
 <br />
<table width="100%">
  <tr>
    <td width="100%" align="center">
    <?php 
      /* Try to get PayPal/PayMate/Worldpay/whatever Configuration File */
      @include( CLASSPATH."payment/".$db->f("payment_class").".cfg.php" );
      
      // Here's the place where the Payment Extra Form Code is included
      // Thanks to Steve for this solution (why make it complicated...?)
      eval('?>' . $db->f("payment_extrainfo") . '<?php ');
      
      /** END printing out HTML Form code (Payment Extra Info) **/

      ?>
    </td>
  </tr>
</table>
<br />
<?php
  }
?>
 <p><a href="<?php $sess->purl(SECUREURL."index.php?option=com_phpshop&page=account.order_details&order_id=". $order_id) ?>">
 <?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_LINK ?></a>
 </p>
 <?php
  
  
  
} /* End of security check */
?>
