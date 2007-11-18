<?php 
/**
* @version $Id: checkout.epay_result.php,v 1.4 2005/05/22 09:21:15 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage Payment
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*
* ePay Order Confirmation Handler
*/
defined('_VALID_MOS') or die( "Direct access to this location is not allowed.");   

function addPaymentLog($dbConn, $log, $order_id)
{
	$dbConn->query( "UPDATE #__{vm}_order_payment SET order_payment_log = concat('" . $log. "<br>', order_payment_log) where order_id = '" . $order_id . "'");
}

function orderPaymentNotYetUpdated($dbConn, $order_id, $tid)
{
	$res = false;
	$dbConn->query("select count(*) 'qty' from #__{vm}_order_payment where order_payment_number = '" . $order_id . "' and order_payment_trans_id = '" . $tid . "'");
	if($dbConn->next_record()) {
		if ($dbConn->f['qty'] == 0) {
			$res = true;
		}
	}
	return $res;
}

require_once(  CLASSPATH ."payment/ps_epay.cfg.php");
$accept = mosGetParam( $_REQUEST, "accept", "0" );
$tid = mosGetParam( $_REQUEST, "tid", "0" );
$order_id = mosGetParam( $_REQUEST, "orderid", "0" );
$order_amount = mosGetParam( $_REQUEST, "amount", "0" );
$order_currency = mosGetParam( $_REQUEST, "cur", "0" );
$order_ekey = mosGetParam( $_REQUEST, "eKey", "0" );
$error = mosGetParam( $_REQUEST, "error", "-1" );
$order_currency = mosGetParam( $_REQUEST, "cur", "0" );



//////////////////////



////////////////////////

//
// Now validat on the MD5 stamping. If the MD5 key is valid or if MD5 is disabled
//
if(($order_ekey == md5( $order_amount . $order_id . $tid  . EPAY_MD5_KEY)) || EPAY_MD5_TYPE == 0 ) {
			//
			// Find the corresponding order in the database
			//  
      $qv = "SELECT order_id, order_number FROM #__{vm}_orders WHERE order_id='".$order_id."'";
      $dbo = new ps_DB;
      $dbo->query($qv);
      if($dbo->next_record()) {
        $d['order_id'] = $dbo->f("order_id");
        
        //
        // Switch on the order accept code
        // accept = 1 (standard redirect) accept = 2 (callback)
        //
        if( empty($_REQUEST['errorcode']) && ($accept == "1" || $accept == "2") ) {	
        	
        	//
        	// Only update the order information once
        	//
        	if (orderPaymentNotYetUpdated($dbo, $order_id, $tid)) {
            
	            // UPDATE THE ORDER STATUS to 'VALID'
	            $d['order_status'] = EPAY_VERIFIED_STATUS;
	            // Setting this to "Y" = yes is required by Danish Law
	            $d['notify_customer'] = "Y";
	            $d['include_comment'] = "Y";
	            // Notifying the customer about the transaction key and
	            // the order Status Update
	            $d['order_comment'] = $VM_LANG->_PHPSHOP_EPAY_PAYMENT_ORDER_COMMENT . urldecode($tid)."\n";
	                
	            require_once ( CLASSPATH . 'ps_order.php' );
	            $ps_order= new ps_order;
	            $ps_order->order_status_update($d);
	            
	            //
	            // Order payment
	            //
	            $dbo->query( "UPDATE #__{vm}_order_payment SET order_payment_number = '" . $order_id . "', order_payment_trans_id = '" . $tid . "', order_payment_code = 0 where order_id = '" . $order_id . "'");
	            
	            // add history callback info
	            if ($accept == "2") {
	            	addPaymentLog($dbo, $VM_LANG->_PHPSHOP_EPAY_PAYMENT_CALLBACK, $order_id);
	            }
	            
	            // payment fee
	            if (mosGetParam( $_REQUEST, "transfee", "0" )) {
	            	addPaymentLog($dbo, $VM_LANG->_PHPSHOP_EPAY_PAYMENT_FEE . mosGetParam( $_REQUEST, "transfee", "0"), $order_id);
	            }
	            
	            // payment date
	            if (mosGetParam( $_REQUEST, "date", "0" )) {
	            	addPaymentLog($dbo, $VM_LANG->_PHPSHOP_EPAY_PAYMENT_DATE . mosGetParam( $_REQUEST, "date", "0"), $order_id);
	            }
	            
	            // payment fraud control
	            if (mosGetParam( $_REQUEST, "fraud", "0" )) {
	            	addPaymentLog($dbo, sprintf($VM_LANG->_PHPSHOP_EPAY_FRAUD, mosGetParam( $_REQUEST, "fraud", "0")), $order_id);
	            }
	            
	            // creation information
	            addPaymentLog($dbo, $VM_LANG->_PHPSHOP_EPAY_PAYMENT_LOG_TID . $tid . $VM_LANG->_PHPSHOP_EPAY_PAYMENT_EPAY_LINK, $order_id);
	        }
  
?> 
            <img src="<?php echo IMAGEURL ?>ps_image/button_ok.png" align="center" alt="Success" border="0" />
            <h2><?php echo $VM_LANG->_PHPSHOP_PAYMENT_TRANSACTION_SUCCESS ?></h2>
<?php
        }
        elseif( $accept == "0" ) {
            // the Payment wasn't successful. Maybe the Payment couldn't
            // be verified and is pending
            // UPDATE THE ORDER STATUS to 'INVALID'
            $d['order_status'] = EPAY_INVALID_STATUS;
            // Setting this to "Y" = yes is required by Danish Law
            $d['notify_customer'] = "Y";
            $d['include_comment'] = "Y";
            // Notifying the customer about the transaction key and
            // the order Status Update
            $d['order_comment'] = $VM_LANG->_PHPSHOP_EPAY_PAYMENT_DECLINE . $fejl;
            require_once ( CLASSPATH . 'ps_order.php' );
            $ps_order= new ps_order;
            $ps_order->order_status_update($d);
            
?> 
            <img src="<?php echo IMAGEURL ?>ps_image/button_cancel.png" align="center" alt="Failure" border="0" />
            <h2><?php echo $VM_LANG->_PHPSHOP_PAYMENT_ERROR ?></h2>
<?php
		
           
						echo $VM_LANG->_PHPSHOP_EPAY_PAYMENT_RETRY_PAYMENT;
        }
        
?>
        <br/>
        <p><a href="<?php @$sess->purl( SECUREURL."index.php?option=com_virtuemart&page=account.order_details&order_id=$order_id" ) ?>">
           <?php echo $VM_LANG->_PHPSHOP_ORDER_LINK ?></a>
        </p>
<?php
      }
      else {
        ?>
        <img src="<?php echo IMAGEURL ?>ps_image/button_cancel.png" align="center" alt="Failure" border="0" />
        <span class="message"><? echo $VM_LANG->_PHPSHOP_PAYMENT_ERROR . $VM_LANG->_PHPSHOP_EPAY_PAYMENT_ORDER_NOT_FOUND ?> </span><?php
      }
}
else{
        ?>
        <img src="<?php echo IMAGEURL ?>ps_image/button_cancel.png" align="center" alt="Failure" border="0" />
        <span class="message"><? echo $VM_LANG->_PHPSHOP_PAYMENT_ERROR . $VM_LANG->_PHPSHOP_EPAY_PAYMENT_MD5_CHECK_FAILURE ?> </span><?php
  }
  ?>
