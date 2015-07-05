<?php
/**
 *
 * Template for the shipment selection
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
 * @version $Id: cart.php 2400 2010-05-11 19:30:47Z milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
vmJsApi::jPrice();
if(VmConfig::get('oncheckout_opc',false) and VmConfig::get('oncheckout_opc_js',false)) {
    $js = "
jQuery(document).ready(function() {
 jQuery(\"input[name=virtuemart_shipmentmethod_id]\").live('change', function() {
        virtuemartOPC.setShipment(jQuery(this).val());
    });
});

";

    vmJsApi::addJScript('vm.setShipment', $js);
}
	if (VmConfig::get('oncheckout_show_steps', 1)) {
		echo '<div class="checkoutStep" id="checkoutStep2">' . vmText::_('COM_VIRTUEMART_USER_FORM_CART_STEP2') . '</div>';
	}

	if ($this->layoutName!='default') {
		$headerLevel = 1;
		if($this->cart->getInCheckOut()){
			$buttonclass = 'button vm-button-correct';
		} else {
			$buttonclass = 'default';
		}
		?>
<form method="post" id="userForm" name="chooseShipmentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate">
	<?php
	} else {
		$headerLevel = 3;
		$buttonclass = 'vm-button-correct';
	}
    if(!VmConfig::get('oncheckout_opc_js',true) ) {

	if($this->cart->virtuemart_shipmentmethod_id){

		echo '<h'.$headerLevel.'>'.vmText::_('COM_VIRTUEMART_CART_SELECTED_SHIPMENT_SELECT').'</h'.$headerLevel.'>';
	} else {
		echo '<h'.$headerLevel.'>'.vmText::_('COM_VIRTUEMART_CART_SELECT_SHIPMENT').'</h'.$headerLevel.'>';
	}
    }else {
        echo '<h'.$headerLevel.'>'.vmText::_('COM_VIRTUEMART_CART_SHIPMENT').'</h'.$headerLevel.'>';

    }

	?>
    <?php
    if (!VmConfig::get('oncheckout_opc_js',false) ) {
    ?>
	<div class="buttonBar-right">

	        <button  name="updatecart" class="<?php echo $buttonclass ?>" type="submit" ><?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?></button>
		<?php   if ($this->layoutName!='default') { ?>
		<button class="<?php echo $buttonclass ?>" type="reset" onClick="window.location.href='<?php echo JRoute::_('index.php?option=com_virtuemart&view=cart&task=cancel'); ?>'" ><?php echo vmText::_('COM_VIRTUEMART_CANCEL'); ?></button>
		<?php  } ?>
	</div>

<?php
    }
    if ($this->found_shipment_method ) {

	   echo '<fieldset class="vm-payment-shipment-select vm-shipment-select">';
	// if only one Shipment , should be checked by default
	    foreach ($this->shipments_shipment_rates as $shipment_shipment_rates) {
			if (is_array($shipment_shipment_rates)) {
			    foreach ($shipment_shipment_rates as $shipment_shipment_rate) {
					//$shipment_shipment_rate = str_replace('input', 'input onClick="setShipment();"', $shipment_shipment_rate);
					echo "<div>" . $shipment_shipment_rate . "</div>\n";
			    }
			}
	    }
	    echo '</fieldset>';
    } else {
	 echo '<h'.$headerLevel.'>'.$this->shipment_not_found_text.'</h'.$headerLevel.'>';
    }


if ($this->layoutName!='default') {
?> <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="view" value="cart" />
    <input type="hidden" name="task" value="updatecart" />
    <input type="hidden" name="controller" value="cart" />
</form>
<?php
}
?>

