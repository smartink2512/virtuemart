<?php
/**
 *
 * Amazon payment plugin
 *
 * @author Valérie Isaksen
 * @version $Id$
 * @package VirtueMart
 * @subpackage payment
 * ${PHING.VM.COPYRIGHT}
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */
defined('_JEXEC') or die();

$success = $viewData["success"];
$payment_name = $viewData["payment_name"];
$payment = $viewData["payment"];
$order = $viewData["order"];
$currency = $viewData["currency"];

?>
<div id="amazonResponse">
<div class="amazonResponseItem">
		<span class=""> <?php echo vmText::_('VMPAYMENT_AMAZON_PAYMENT_NAME'); ?></span>
		<span class=""><?php echo $viewData["payment_name"]; ?></span>
</div>
	<div class="amazonResponseItem">

	<span class=""><?php echo vmText::_('COM_VIRTUEMART_ORDER_NUMBER'); ?></span>
	<span class=""><?php echo $order['details']['BT']->order_number; ?></span>
	</div>
	<div class="amazonResponseItem">
	<?php if ($success) { ?>
			<span class=""><?php echo vmText::_('VMPAYMENT_AMAZON_AMOUNT'); ?></span>
			<span class=""><?php echo $payment->payment_order_total . ' ' . $payment->payment_currency; ?></span>
	</div>
	<div class="amazonResponseItem">
			<span class=""><?php echo vmText::_('VMPAYMENT_AMAZON_AUTHORIZATION_ID'); ?> </span>
			<span class=""><?php echo $viewData["amazonAuthorizationId"] ; ?></span>
	<?php }  ?>
	</div>
<?php if ($success) { ?>
	<div class="amazonResponseItem">
	<a class="vm-button-correct" href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=orders&layout=details&order_number='.$viewData["order"]['details']['BT']->order_number.'&order_pass='.$viewData["order"]['details']['BT']->order_pass, false)?>"><?php echo vmText::_('COM_VIRTUEMART_ORDER_VIEW_ORDER'); ?></a>
</div>
		<?php } ?>
</div>