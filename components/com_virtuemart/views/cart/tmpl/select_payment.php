<?php
/**
 *
 * Layout for the payment selection
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Max Milbers
 *
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id$
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$addClass="";

if(VmConfig::get('oncheckout_opc',false) and VmConfig::get('oncheckout_opc_js',false)) {
	$js = "
jQuery(document).ready(function() {
 jQuery(\"input[name=virtuemart_paymentmethod_id]\").live('change', function() {
        virtuemartOPC.setPayment(jQuery(this).val());
    });
});

";
	vmJsApi::addJScript('vm.setPayment', $js);
}

if (VmConfig::get('oncheckout_show_steps', 1)) {
    echo '<div class="checkoutStep" id="checkoutStep3">' . vmText::_('COM_VIRTUEMART_USER_FORM_CART_STEP3') . '</div>';
}

if ($this->layoutName!='default') {
	$headerLevel = 1;
	if($this->cart->getInCheckOut()){
		$buttonclass = 'button vm-button-correct';
	} else {
		$buttonclass = 'default';
	}
?>
	<form method="post" id="paymentForm" name="choosePaymentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate <?php echo $addClass ?>">
<?php } else {
		$headerLevel = 3;
		$buttonclass = 'vm-button-correct';
	}
if(!VmConfig::get('oncheckout_opc_js',false)){

	if($this->cart->virtuemart_paymentmethod_id){
		echo '<h'.$headerLevel.'>'.vmText::_('COM_VIRTUEMART_CART_SELECTED_PAYMENT_SELECT').'</h'.$headerLevel.'>';
	} else {
		echo '<h'.$headerLevel.'>'.vmText::_('COM_VIRTUEMART_CART_SELECT_PAYMENT').'</h'.$headerLevel.'>';
	}
} else {
    echo '<h'.$headerLevel.'>'.vmText::_('COM_VIRTUEMART_CART_PAYMENT').'</h'.$headerLevel.'>';
}
    ?>
<?php
if (!VmConfig::get('oncheckout_opc_js',false) ) {
    ?>
<div class="buttonBar-right">

<button name="updatecart" class="<?php echo $buttonclass ?>" type="submit"><?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?></button>

   <?php   if ($this->layoutName!='default') { ?>
<button class="<?php echo $buttonclass ?>" type="reset" onClick="window.location.href='<?php echo JRoute::_('index.php?option=com_virtuemart&view=cart&task=cancel'); ?>'" ><?php echo vmText::_('COM_VIRTUEMART_CANCEL'); ?></button>
	<?php  } ?>
    </div>

<?php
}
     if ($this->found_payment_method ) {


    echo '<fieldset class="vm-payment-shipment-select vm-payment-select">';
		foreach ($this->paymentplugins_payments as $paymentplugin_payments) {
		    if (is_array($paymentplugin_payments)) {
			foreach ($paymentplugin_payments as $paymentplugin_payment) {
			    echo '<div class="vm-payment-plugin-single">'.$paymentplugin_payment.'</div>';
			}
		    }
		}
    echo '</fieldset>';

    } else {
	 echo '<h1>'.$this->payment_not_found_text.'</h1>';
    }

if ($this->layoutName!='default') {
?>    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="view" value="cart" />
    <input type="hidden" name="task" value="updatecart" />
    <input type="hidden" name="controller" value="cart" />
</form>
<?php
}
?>