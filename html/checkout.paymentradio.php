<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: checkout.paymentradio.php,v 1.12 2005/08/30 19:51:57 soeren_nb Exp $
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

require_once( CLASSPATH. 'ps_creditcard.php' );

$payment_method_id = mosgetparam($_REQUEST, 'payment_method_id', 0);

// Do we have Credit Card Payments?
$db_cc  = new ps_DB;
$q = "SELECT * from #__pshop_payment_method,#__pshop_shopper_group WHERE ";
$q .= "#__pshop_payment_method.shopper_group_id=#__pshop_shopper_group.shopper_group_id ";
$q .= "AND (#__pshop_payment_method.shopper_group_id='".$auth['shopper_group_id']."' ";
$q .= "OR #__pshop_shopper_group.default='1') ";
$q .= "AND (enable_processor='' OR enable_processor='Y') ";
$q .= "AND payment_enabled='Y' ";
$q .= "AND #__pshop_payment_method.vendor_id='$ps_vendor_id'";
$db_cc->query($q);

if ($db_cc->num_rows()) {
    $cc_payments=true;
    $ps_creditcard = new ps_creditcard();
}
else {
    $cc_payments=false;
}
$count = 0;
$db_nocc  = new ps_DB;
$q = "SELECT * from #__pshop_payment_method,#__pshop_shopper_group WHERE ";
$q .= "#__pshop_payment_method.shopper_group_id=#__pshop_shopper_group.shopper_group_id ";
$q .= "AND (#__pshop_payment_method.shopper_group_id='".$auth['shopper_group_id']."' ";
$q .= "OR #__pshop_shopper_group.default='1') ";
$q .= "AND (enable_processor='B' OR enable_processor='N' OR enable_processor='P') ";
$q .= "AND payment_enabled='Y' ";
$q .= "AND #__pshop_payment_method.vendor_id='$ps_vendor_id'";
$db_nocc->query($q);
if ($db_nocc->next_record()) {
    $nocc_payments=true;
    $first_payment_method_id = $db_nocc->f("payment_method_id");
    $count = $db_nocc->num_rows();
    $db_nocc->reset();
}
else {
    $nocc_payments=false;
}
  /** This redirect has lead to critics  **/
    if ($count <= 1 && $cc_payments==false)
        mosRedirect($sess->url(SECUREURL."index.php?page=checkout.index&payment_method_id=$first_payment_method_id&ship_to_info_id=$ship_to_info_id&shipping_rate_id=".urlencode($shipping_rate_id)."&checkout_this_step=99&checkout_next_step=99"),"");

?>
<table border="0" cellspacing="0" cellpadding="2" width="100%">

<?php 
  if ($cc_payments==true) { ?>

    <tr class="sectiontableheader">
        <th align="left" colspan="2"><?php echo $PHPSHOP_LANG->_PHPSHOP_CHECKOUT_CONF_PAYINFO ?></th>
    </tr>
    <tr>
        <td colspan="2"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_CHECKOUT_PAYMENT_CC ?></strong></td>
    </tr>
    <tr>
        <td colspan="2"><?php $ps_payment_method->list_cc($payment_method_id, false) ?>

        </td>
    </tr>
    <tr>
        <td colspan="2"><strong>&nbsp;</strong></td>
    </tr>
    <tr>
        <td nowrap width="10%" align="right">Credit Card Type:</td>
        <td>
        <?php echo $ps_creditcard->creditcard_lists( $db_cc ); ?>
        <div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
        <script language="Javascript" type="text/javascript" src="includes/js/overlib_mini.js"></script>
        <script language="Javascript" type="text/javascript"><!--
		writeDynaList( 'class="inputbox" name="creditcard_code" size="1"',
		orders, originalPos, originalPos, originalOrder );
		//--></script>
<?php 
            $db_cc->reset();
            $payment_class = $db_cc->f("payment_class");
            $require_cvv_code = "YES";
            if(file_exists(CLASSPATH."payment/$payment_class.php") && file_exists(CLASSPATH."payment/$payment_class.cfg.php")) {
                require_once(CLASSPATH."payment/$payment_class.php");
                require_once(CLASSPATH."payment/$payment_class.cfg.php");
                eval( "\$_PAYMENT = new $payment_class();" );
                eval( "\$require_cvv_code = ".$_PAYMENT->payment_code."_CHECK_CARD_CODE;" );
            }
?>      </td>
    </tr>
    <tr valign="top">
        <td nowrap width="10%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CHECKOUT_CONF_PAYINFO_NAMECARD ?>:</td>
        <td>
        <input type="text" class="inputbox" name="order_payment_name" value="<?php if(!empty($_SESSION['ccdata']['order_payment_name'])) echo $_SESSION['ccdata']['order_payment_name'] ?>" />
        </td>
    </tr>
    <tr valign="top">
        <td nowrap width="10%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CHECKOUT_CONF_PAYINFO_CCNUM ?>:</td>
        <td>
        <input type="text" class="inputbox" name="order_payment_number" value="<?php if(!empty($_SESSION['ccdata']['order_payment_number'])) echo $_SESSION['ccdata']['order_payment_number'] ?>" />
        </td>
    </tr>
<?php if( $require_cvv_code == "YES" ) { ?>
    <tr valign="top">
        <td nowrap width="10%" align="right">Credit Card Security Code:</td>
        <td>
            <input type="text" class="inputbox" name="credit_card_code" value="<?php if(!empty($_SESSION['ccdata']['credit_card_code'])) echo $_SESSION['ccdata']['credit_card_code'] ?>" />
            <input type="hidden" class="inputbox" name="need_card_code" value="1" />
        <?php echo mosToolTip($PHPSHOP_LANG->_PHPSHOP_CUSTOMER_CVV2_TOOLTIP); ?>
        </td>
    </tr>
<?php } ?>
    <tr>
        <td nowrap width="10%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CHECKOUT_CONF_PAYINFO_EXDATE ?>:</td>
        <td><?php 
        $ps_html->list_month("order_payment_expire_month", @$_SESSION['ccdata']['order_payment_expire_month']);
        echo "/";
        $ps_html->list_year("order_payment_expire_year", @$_SESSION['ccdata']['order_payment_expire_year']) ?></td>
    </tr>
    
  <?php  }  

  if ($nocc_payments==true) {  
    if ($cc_payments==true) {?>
    
    <tr>
        <td colspan="2"><br /><br /><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_CHECKOUT_PAYMENT_OTHER ?></strong></td>
    </tr>
    <?php
    } ?>
    <tr>
        <td colspan="2"><?php 
            $ps_payment_method->list_nocheck($payment_method_id,  false); 
            $ps_payment_method->list_bank($payment_method_id,  false);
            $ps_payment_method->list_paypalrelated($payment_method_id,  false); ?>
        </td>
    </tr>
    
    <?php   
    }  ?>
</table>
