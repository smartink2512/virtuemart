<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
mm_showMyFileName( __FILE__ );

require_once(CLASSPATH . 'payment/paypal_lib/ps_paypal_wpp.functions.php');
require_once(CLASSPATH . 'payment/ps_paypal_wpp.cfg.php');

echo '<h2>'.$VM_LANG->_PHPSHOP_CHECKOUT_TITLE.'</h2>';

if ($_GET['message']) {
	echo '<h3>There was an error connecting to Paypal!</h3><br />Paypal Error: '.urldecode($_GET['message']);
}else{
	echo '<h3>There was an error connecting to Paypal!</h3>';
}
?>