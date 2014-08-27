<?php
/**
 *
 * Template for the shipment selection for Amazon Cart layout
 *
 * @package    VirtueMart
 * @subpackage Cart
 * @author Max Milbers, Valérie Isaksen
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
vmJsApi::jPrice();
$document = JFactory::getDocument();
$document->addScriptDeclaration("

//<![CDATA[
function setShipment() {
 amazonPayment.amazonLoading();
  var virtuemart_shipmentmethod_ids = document.getElementsByName('virtuemart_shipmentmethod_id');
  var virtuemart_shipmentmethod_id = '';

  for (var i = 0, length = virtuemart_shipmentmethod_ids.length; i < length; i++) {
    if (virtuemart_shipmentmethod_ids[i].checked) {
      virtuemart_shipmentmethod_id = virtuemart_shipmentmethod_ids[i].value;
      break;
    }
  }
 var url = vmSiteurl + 'index.php?option=com_virtuemart&nosef=1&view=cart&task=checkoutJS&virtuemart_shipmentmethod_id=' + virtuemart_shipmentmethod_id + vmLang;
            jQuery.getJSON(url,
                function (datas, textStatus) {
                    var cartview = '';
                    console.log('updateCart:' + datas.msg.length);
                    if (datas.msg) {
                        datas.msg = datas.msg.replace('amazonHeader', 'amazonHeaderHide');
                        for (var i = 0; i < datas.msg.length; i++) {
                            cartview += datas.msg[i].toString();
                        }
                        document.id('amazonCartDiv').set('html', cartview);
                        document.id('amazonHeaderHide').set('html', '');
                         amazonPayment.amazonStopLoading();
                    }
                }
            );

}



//]]>

");
$buttonclass = 'button vm-button-correct';
$buttonclass = 'default';
?>
<?php
if ($this->found_shipment_method) {
	echo "<h3>" . JText::_('COM_VIRTUEMART_CART_SELECT_SHIPMENT') . "</h3>";
	?>


	<fieldset>
		<?php
		// if only one Shipment , should be checked by default
		foreach ($this->shipments_shipment_rates as $shipment_shipment_rates) {
			if (is_array($shipment_shipment_rates)) {
				foreach ($shipment_shipment_rates as $shipment_shipment_rate) {
					$shipment_shipment_rate = str_replace('input', 'input onClick="setShipment();"', $shipment_shipment_rate);
					echo "<div>" . $shipment_shipment_rate . "</div>\n";
				}
			}
		}
		?>
	</fieldset>
<?php
}



?>

