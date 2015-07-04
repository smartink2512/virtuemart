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
if ($viewData ['payment_form_position']=='right' ) {
	vmJsApi::css('klarnacheckout', 'plugins/vmpayment/klarnacheckout/klarnacheckout/assets/css');
}

?>

<script  src="https://cdn.klarna.com/1.0/code/client/all.js"></script>
<?php

$js = '

	jQuery(document).ready(function( $ ) {
 $("#checkoutFormSubmit").hide();
 $(".vm-fieldset-tos").hide();
 });

jQuery(document).ready(function( $ ) {
jQuery( "*:contains(\''. vmText::_('COM_VIRTUEMART_CART_NO_SHIPPING_METHOD_PUBLIC'). '\')" ).filter(function(){
	jQuery("#kco-shipment-method").text("'. vmText::_('VMPAYMENT_KLARNACHECKOUT_SHIPMENT_METHODS_LATER'). '");
	})
});


	';

if ($viewData ['hide_BTST']) {
	$js .= '
	jQuery(document).ready(function( $ ) {
		      $(".billto-shipto").hide();

		      $("#com-form-login").hide();

	});
	';


}
vmJsApi::addJScript('vm.kco_hide_BTST', $js);

?>
<?php if ($viewData['klarna_create_account']) { ?>
<div class="" id="klarna-create-account-box">
	<label for="klarna-create-account"><?php echo $viewData ['klarna_create_account']; ?></label>
	<input type="checkbox" id="klarna-create-account" name="klarna-create-account" class="inputbox" value="yes">
</div>
<?php
}
?>
<?php if ($viewData ['message'] )  { ?>
	<div id="kco-shipment-method"><?php echo $viewData ['message']; ?>  </div>
<?php } ?>
<?php if ($viewData ['snippet'] )  { ?>
<div><?php echo $viewData ['snippet']; ?>  </div>
<?php }


?>



