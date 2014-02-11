<?php
/**
 *
 * Order items view
 *
 * @package	VirtueMart
 * @subpackage Orders
 * @author Max Milbers, Valerie Isaksen
 * @author Yagendoo Media Team
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: details_items.php 5432 2012-02-14 02:20:35Z Milbo $
 */


defined('_JEXEC') or die('Restricted access');

$showTax = VmConfig::get('show_tax');
$showTax = false;
$colspan = 6;
if ($this->doctype != 'invoice') {
    $colspan -= 4;
} elseif ( ! $showTax) {
    $colspan -= 1;
}
?>
<br /><br />
<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr align="left" class="sectiontableheader">
		<td align="left" width="15%"><strong><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_SKU') ?></strong></td>

		<td align="left" width="49%"><strong><?php echo JText::_('COM_VIRTUEMART_PRODUCT_NAME_TITLE') ?></strong></td>

		<?php if($this->doctype == 'invoice'): ?>
			<td align="right" width="12%"><strong><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_PRICE') ?></strong></td>
		<?php endif; ?>

		<td align="right" width="12%"><strong><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_QTY') ?></strong></td>

		<?php if($this->doctype == 'invoice'): ?>
			<?php if($showTax): ?>
				<td align="right"><strong><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_PRODUCT_TAX') ?></strong></td>
			<?php endif; ?>

			<td align="right" width="12%"><strong><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_TOTAL') ?></strong></td>
		<?php endif; ?>
	</tr>

	<tr>
		<td colspan="<?php echo $colspan; ?>"><hr /></td>
	</tr>

	<?php
	$menuItemID = shopFunctionsF::getMenuItemId($this->orderDetails['details']['BT']->order_language);
	foreach($this->orderDetails['items'] as $item)
	{
		$qtt = $item->product_quantity;
		$product_link = JURI::root().'index.php?option=com_virtuemart&view=productdetails&virtuemart_category_id=' . $item->virtuemart_category_id . '&virtuemart_product_id=' . $item->virtuemart_product_id . '&Itemid=' . $menuItemID;
		?>
		<tr valign="top">
			<td align="left">
				<?php echo $item->order_item_sku; ?>
			</td>

			<td align="left">
				<div float="right"><a href="<?php echo $product_link; ?>"><?php echo $item->order_item_name; ?></a></div>
				<?php
				if(!empty($item->product_attribute))
				{
					if(!class_exists('VirtueMartModelCustomfields'))require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'customfields.php');
					{
						$product_attribute = VirtueMartModelCustomfields::CustomsFieldOrderDisplay($item,'FE');
					}
					echo $product_attribute;
				}
				?>
			</td>

			<?php if ($this->doctype == 'invoice'): ?>
				<td align="right"  class="priceCol" >
					<?php
					$item->product_final_price = (float) $item->product_final_price;
					echo $this->currency->priceDisplay(  $item->product_final_price ,$this->currency, 1);
					?>
				</td>
			<?php endif; ?>

			<td align="right" >
				<?php echo $qtt; ?>
			</td>

			<?php if ($this->doctype == 'invoice'): ?>
				<?php if ( $showTax) { ?>
					<td align="right" class="priceCol"><?php echo "<span  class='priceColor2'>".$this->currency->priceDisplay($item->product_tax ,$this->currency, $qtt)."</span>" ?></td>
				<?php } ?>

				<td align="right" class="priceCol">
					<?php
					$item->product_basePriceWithTax = (float) $item->product_basePriceWithTax;
					$class = '';

					echo $this->currency->priceDisplay(  $item->product_subtotal_with_tax ,$this->currency); //No quantity or you must use product_final_price ?>
				</td>
			<?php endif; ?>
		</tr>
	<?php } ?>

<?php if ($this->doctype == 'invoice') { ?>
	<tr><td colspan="<?php echo $colspan ?>">&nbsp;</td></tr>

	<tr><td colspan="<?php echo $colspan ?>"><hr /></td></tr>

	<tr class="sectiontableentry1">
		<td colspan="4" align="right"><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_PRODUCT_PRICES_TOTAL'); ?></td>

		<?php if($showTax) { ?>
			<td align="right"><?php echo "<span  class='priceColor2'>".$this->currency->priceDisplay($this->orderDetails['details']['BT']->order_tax, $this->currency)."</span>" ?></td>
		<?php } ?>

		<td align="right"><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_salesPrice, $this->currency) ?></td>
	</tr>

	<?php if ($this->orderDetails['details']['BT']->coupon_discount <> 0.00) {
	    $coupon_code=$this->orderDetails['details']['BT']->coupon_code?' ('.$this->orderDetails['details']['BT']->coupon_code.')':'';
		?>
		<tr>
			<td align="right" class="pricePad" colspan="4"><?php echo JText::_('COM_VIRTUEMART_COUPON_DISCOUNT').$coupon_code ?></td>
			<?php if ( $showTax) { ?>
				<td align="right"> </td>
			<?php } ?>

			<td align="right"><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->coupon_discount, $this->currency); ?></td>
		</tr>
	<?php  } ?>

	<?php foreach($this->orderDetails['calc_rules'] as $rule)
	{
		if($rule->calc_kind== 'DBTaxRulesBill') { ?>
			<tr>
				<td colspan="4" align="right" class="pricePad"><?php echo $rule->calc_rule_name; ?> </td>

				<?php if($showTax) { ?>
					<td align="right"> </td>
				<?php } ?>

				<td align="right"><?php echo  $this->currency->priceDisplay($rule->calc_amount, $this->currency); ?></td>
			</tr>

		<?php
		} elseif($rule->calc_kind == 'taxRulesBill') { ?>
			<tr>
				<td colspan="4"  align="right" class="pricePad"><?php echo $rule->calc_rule_name; ?> </td>

				<?php if($showTax) { ?>
					<td align="right"><?php echo $this->currency->priceDisplay($rule->calc_amount, $this->currency); ?></td>
				<?php } ?>

				<?php /* <td align="right"><?php    ?> </td> */ ?>

				<td align="right"><?php echo $this->currency->priceDisplay($rule->calc_amount, $this->currency); ?></td>
			</tr>
		<?php
		} elseif($rule->calc_kind == 'DATaxRulesBill') { ?>
			<tr>
				<td colspan="4" align="right" class="pricePad"><?php echo $rule->calc_rule_name; ?> </td>

				<?php if($showTax) { ?>
					<td align="right"> </td>
				<?php } ?>

				<td align="right"><?php echo $this->currency->priceDisplay($rule->calc_amount, $this->currency);  ?> </td>
			</tr>
		<?php
		}
	}
	?>

	<?php if(!empty($this->orderDetails['shipmentName'])) : ?>
		<tr>
			<td align="right" class="pricePad" colspan="4"><?php echo $this->orderDetails['shipmentName'] ?></td>

			<?php if($showTax) { ?>
				<td align="right">
					<span class='priceColor2'><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_shipment_tax, $this->currency); ?></span>
				</td>
			<?php } ?>

			<td align="right">
				<?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_shipment + $this->orderDetails['details']['BT']->order_shipment_tax, $this->currency); ?>
			</td>
		</tr>
	<?php endif; ?>

	<?php if(!empty($this->orderDetails['paymentName'])) : ?>
		<tr>
			<td align="right" class="pricePad" colspan="4"><?php echo $this->orderDetails['paymentName']; ?></td>

			<?php if($showTax) { ?>
				<td align="right">
					<span class='priceColor2'><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_payment_tax, $this->currency); ?></span>
				</td>
			<?php } ?>

			<td align="right">
				<?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_payment + $this->orderDetails['details']['BT']->order_payment_tax, $this->currency); ?>
			</td>
		</tr>
	<?php endif; ?>

	<tr><td colspan="<?php echo $colspan; ?>"><hr /></td></tr>

	<tr>
		<td align="right" class="pricePad" colspan="4">
			<strong><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_TOTAL') ?></strong><br />
			<?php echo JText::_("COM_VIRTUEMART_ORDER_INCLUDED_TAX"); ?>
		</td>

		<?php if($showTax) { ?>
			<td align="right">
				<span class='priceColor2'>
					<?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_billTaxAmount, $this->currency); ?>
				</span>
			</td>
		<?php } ?>

		<td align="right">
			<strong><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_total, $this->currency); ?></strong><br />
			<span class="priceColor2" style="white-space: nowrap;"><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_billTaxAmount, $this->currency); ?></span>
		</td>
	</tr>
<?php } ?>

	<tr>
		<td colspan="<?php echo $colspan; ?>"><br /><br /></td>
	</tr>
</table>