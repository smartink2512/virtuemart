<?php 
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
 * This is the page that is shown when the order has been placed.
 * It is used to thank the customer for her/his order and show a link 
 * to the order details.
*
* @version $Id: checkout.thankyou.tpl.php 1760 2009-05-03 22:58:57Z Aravot $
* @package JMart
* @subpackage themes
* @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* JMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_jmart/COPYRIGHT.php for copyright notices and details.

* http://joomlacode.org/gf/project/jmart/
*/

mm_showMyFileName( __FILE__ );

 require_once(CLASSPATH.'paymentMethod.class.php');
 $vmPaymentMethod = new vmPaymentMethod();

?>

<h3><?php echo JText::_('JM_THANKYOU') ?></h3>
<p>
 	<?php 
 	echo vmCommonHTML::imageTag( JM_THEMEURL .'images/button_ok.png', 'Success', 'center', '48', '48' ); ?>
   	<?php echo JText::_('JM_THANKYOU_SUCCESS')?>
  
	<br /><br />
	<?php echo JText::_('JM_EMAIL_SENDTO') .": <strong>". $user->email . '</strong>'; ?><br />
</p>
  
<!-- Begin Payment Information -->
<?php
if( empty($auth['user_id'])) {
	return;
}
if ($db->f("order_status") == "P" ) {
	// Copy the db object to prevent it gets altered
	$db_temp = ps_DB::_clone( $db );
 /** Start printing out HTML Form code (Payment Extra Info) **/ ?>
 <br />
<table width="100%">
  <tr>
    <td width="100%" align="center">
    	<?php 
	    
		$vmLogger->debug('Beginning to parse the payment extra info code...' );
		
	    vmPaymentMethod::importPaymentPluginById($db->f('id'));
	    
		$vm_mainframe->triggerEvent('showPaymentForm', array($db, $user, $dbbt) );

      	?>
    </td>
  </tr>
</table>
<br />
<?php
$db = $db_temp;
}
?>
<p>
	<a href="<?php $sess->purl(SECUREURL.basename($_SERVER['PHP_SELF'])."?page=account.order_details&order_id=". $order_id) ?>" onclick="if( parent.parent.location ) { parent.parent.location = this.href.replace(/index2.php/, 'index.php' ); };">
 		<?php echo JText::_('JM_ORDER_LINK') ?>
 	</a>
</p>