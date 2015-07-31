<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @author Valérie Isaksen
 * @version $Id: cart_advertisement.php 7862 2014-04-25 09:26:53Z alatak $
 * @package VirtueMart
 * @subpackage payment
 * @copyright Copyright (C) 2004-${PHING.VM.COPYRIGHT}   - All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */

$css =".totalInPaymentCurrency {display:none;}\n";
if ($viewData ['payment_form_position']=='right' or $viewData ['payment_form_position'] =='specific') {
	vmJsApi::css('klarnacheckout', 'plugins/vmpayment/klarnacheckout/assets/css');
}

?>

<?php

$js = '


jQuery(document).ready(function( $ ) {
jQuery( "*:contains(\''. vmText::_('COM_VIRTUEMART_CART_NO_SHIPPING_METHOD_PUBLIC'). '\')" ).filter(function(){
var zip=jQuery(".output-billto .vm2-zip").value;
if (zip==="") {jQuery("#kco-shipment-method").text("'. vmText::_('VMPAYMENT_KLARNACHECKOUT_SHIPMENT_METHODS_LATER'). '");
} else {
jQuery("#kco-shipment-method").text("SHOULD NOT BE ABLE TO CHECKOUT AT KLARNA");
}

	})
});

	';

//vmJsApi::addJScript('vm.noshipments', $js);
$js="
		function setShipment() {
		    klarnaCheckoutPayment.updateShipment();
		}
";

//vmJsApi::addJScript('vm.setShipment', $js);


?>
<?php if ($viewData['klarna_create_account']) { ?>
<div class="" id="klarna-create-account-box">
	<label for="klarna-create-account"><?php echo $viewData ['klarna_create_account']; ?></label>
	<input type="checkbox" id="klarna-create-account" name="klarna-create-account" class="inputbox" value="yes">
</div>
<?php
}
?>
	<div id="kco-shipment-method"><?php echo $viewData ['message']; ?>  </div>
<?php if ($viewData ['snippet'] )  { ?>
<div id="kco-payment-method"><?php echo $viewData ['snippet']; ?>  </div>
<?php }


?>



