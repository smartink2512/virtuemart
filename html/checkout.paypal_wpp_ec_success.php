<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
mm_showMyFileName( __FILE__ );

require_once(CLASSPATH . 'payment/paypal_lib/ps_paypal_wpp.functions.php');

require_once(CLASSPATH . 'ps_product.php');
$ps_product= new ps_product;

$Itemid = $sess->getShopItemid();
global $vendor_currency;
$auth = $_SESSION['auth'];
$cart = $_SESSION['cart'];

// Order_id is returned by complete_order() function
$order_id = complete_order($_POST, $method='ec'); 
if (!$order_id) {
	echo 'Order Failed <br />';
	exit;
}

$print = mosgetparam( $_REQUEST, 'print', 0);

// Retrieve User Email
$q  = "SELECT * FROM `#__{vm}_order_user_info` WHERE `order_id`='$order_id' AND `address_type`='BT'";
$db->query( $q );
$db->next_record();
$old_user = '';
if( is_object($user)) {
	$old_user = $user;
}
$user = $db->record[0];
$dbbt = $db->_clone( $db );

$user->email = $db->f("user_email");

// Retrieve Order & Payment Info
$db = new ps_DB;
$q  = "SELECT * FROM (#__{vm}_order_payment LEFT JOIN #__{vm}_payment_method ";
$q .= "ON #__{vm}_payment_method.payment_method_id  = #__{vm}_order_payment.payment_method_id), #__{vm}_orders ";
$q .= "WHERE #__{vm}_order_payment.order_id='$order_id' ";
$q .= "AND #__{vm}_orders.user_id='" . $auth["user_id"] . "' ";
$q .= "AND #__{vm}_orders.order_id='$order_id' ";
$db->query($q);

if ($db->next_record()) {
?>
	<h3><?php echo $VM_LANG->_PHPSHOP_THANKYOU ?></h3>
	<p>
	<?php if( empty($vars['error'])) { ?>
		<img src="<?php echo IMAGEURL ?>ps_image/button_ok.png" height="48" width="48" align="center" alt="Success" border="0" />
		<?php echo $VM_LANG->_PHPSHOP_THANKYOU_SUCCESS ?>
		<br /><br />
		<?php echo $VM_LANG->_PHPSHOP_EMAIL_SENDTO .": <strong>". $user_email; ?></strong><br />
	</p>
<?php } 
  
// Begin Payment Information

if ($db->f("order_status") == "P" ) {
// Payment Extra Info
?>
<br />
<table width="100%">
  <tr>
    <td width="100%" align="center">
    <?php 
      // Get configuration
		@include_once(CLASSPATH ."payment/".$this->classname.".cfg.php");
		eval('?>' . $db->f("payment_extrainfo") . '<?php ');
      ?>
    </td>
  </tr>
</table>
<br />
<?php
  }
?>
 <p><a href="<?php $sess->purl(SECUREURL."index.php?option=com_virtuemart&page=account.order_details&order_id=". $order_id) ?>">
 <?php echo $VM_LANG->_PHPSHOP_ORDER_LINK ?></a>
 </p>
 <?php
} 
if( !empty($old_user) && is_object($old_user)) {
	$user = $old_user;
}
?>