<?php
/**
 *
 * Order detail view
 *
 * @package    VirtueMart
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
 * @version $Id: details.php 5412 2012-02-09 19:27:55Z alatak $
 */

defined('_JEXEC') or die('Restricted access');

JHTML::stylesheet('vmpanels.css', JURI::root() . 'components/com_virtuemart/assets/css/');

if ($this->_layout == "invoice")
{
    $document = JFactory::getDocument();
    $document->setTitle(JText::_('COM_VIRTUEMART_ORDER_PRINT_PO_NUMBER') . ' ' . $this->orderDetails['details']['BT']->order_number . ' ' . $this->vendor->vendor_store_name);
}

//==>	Company name
$vendorCompanyName = (!empty($this->vendor->vendorFields["fields"]["company"]["value"])) ? $this->vendor->vendorFields["fields"]["company"]["value"] : $this->vendor->vendor_store_name;
?>
<?php if(!empty($this->vendor->vendor_letter_css)) : ?>
	<style type="text/css">
		<?php echo $this->vendor->vendor_letter_css; ?>
	</style>
<?php endif; ?>

<?php $this->vendor->vendor_letter_header_image ?>

<?php if($this->print): ?>
	<body onload="javascript:print();">
<?php else: ?>
	<body style="font-family: '<?php echo ucfirst($this->vendor->vendor_letter_font); ?>', sans-serif;">
<?php endif; ?>
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0">
					<tr valign="top">
						<td style="width: 50%; padding-top: 10px; padding-bottom: 20px; overflow: hidden; font-size: <?php echo $this->vendor->vendor_letter_header_font_size; ?>pt;" align="left" width="50%">
							<?php if($this->vendor->vendor_letter_header_image === "1") : ?>
								<img style="width: <?php echo $this->vendor->vendor_letter_header_imagesize; ?>mm; height: auto;" src="<?php echo JURI::root() . $this->vendor->images[0]->file_url; ?>" alt="vendor_image" border="0" />
							<?php else : ?>
								<span style="display: block; margin-bottom: 5px; font-size: <?php echo (int)$this->vendor->vendor_letter_header_font_size - 2; ?>pt;"><u><?php echo (!empty($vendorCompanyName)) ? $vendorCompanyName." &ndash; " : ""; ?>
									<?php echo (!empty($this->vendor->vendorFields["fields"]["address_1"]["value"])) ? $this->vendor->vendorFields["fields"]["address_1"]["value"]." &ndash; " : ""; ?>
									<?php echo (!empty($this->vendor->vendorFields["fields"]["zip"]["value"])) ? $this->vendor->vendorFields["fields"]["zip"]["value"]." " : ""; ?>
									<?php echo (!empty($this->vendor->vendorFields["fields"]["city"]["value"])) ? $this->vendor->vendorFields["fields"]["city"]["value"] : ""; ?></u>
								</span>
								<br />
								<?php echo (!empty($this->orderDetails['details']['BT']->company)) ? $this->orderDetails['details']['BT']->company."<br />" : ""; ?>
	
								<?php echo (!empty($this->orderDetails['details']['BT']->title)) ? $this->orderDetails['details']['BT']->title." " : ""; ?>
								<?php echo (!empty($this->orderDetails['details']['BT']->first_name)) ? $this->orderDetails['details']['BT']->first_name." " : ""; ?>
								<?php echo (!empty($this->orderDetails['details']['BT']->last_name)) ? $this->orderDetails['details']['BT']->last_name : ""; ?>
								<br />
	
								<?php echo (!empty($this->orderDetails['details']['BT']->address_1)) ? $this->orderDetails['details']['BT']->address_1."<br />" : ""; ?>
								<?php echo (!empty($this->orderDetails['details']['BT']->address_2)) ? $this->orderDetails['details']['BT']->address_2."<br />" : ""; ?>
	
								<?php echo (!empty($this->orderDetails['details']['BT']->zip)) ? $this->orderDetails['details']['BT']->zip." " : ""; ?>
								<?php echo (!empty($this->orderDetails['details']['BT']->city)) ? $this->orderDetails['details']['BT']->city."<br />" : ""; ?>
	
								<?php echo (!empty($this->userfields['fields']['virtuemart_country_id']['value'])) ? $this->userfields['fields']['virtuemart_country_id']['value']."<br />" : ""; ?>
								<br />
							<?php endif; ?>
						</td>

						<td style="width: 50%; padding-top: 10px; padding-bottom: 20px; font-size: <?php echo (int)$this->vendor->vendor_letter_header_font_size - 2; ?>pt; text-align: right;" align="right" width="50%">
							<?php if(!empty($vendorCompanyName)) : ?><b><?php echo $vendorCompanyName; ?></b><br /><?php endif; ?>

							<?php echo (strpos($this->vendor->vendorFields["fields"]["title"]["value"], "-") === false) ? $this->vendor->vendorFields["fields"]["title"]["value"]." " : ""; ?>
							<?php echo (!empty($this->vendor->vendorFields["fields"]["first_name"]["value"])) ? $this->vendor->vendorFields["fields"]["first_name"]["value"]." " : ""; ?>
							<?php echo (!empty($this->vendor->vendorFields["fields"]["last_name"]["value"])) ? $this->vendor->vendorFields["fields"]["last_name"]["value"]."<br />" : ""; ?>

							<?php echo (!empty($this->vendor->vendorFields["fields"]["address_1"]["value"])) ? $this->vendor->vendorFields["fields"]["address_1"]["value"]."<br />" : ""; ?>
							<?php echo (!empty($this->vendor->vendorFields["fields"]["address_2"]["value"])) ? $this->vendor->vendorFields["fields"]["address_2"]["value"] . "<br />" : ""; ?>

							<?php echo (!empty($this->vendor->vendorFields["fields"]["zip"]["value"])) ? $this->vendor->vendorFields["fields"]["zip"]["value"]." " : ""; ?>
							<?php echo (!empty($this->vendor->vendorFields["fields"]["city"]["value"])) ? $this->vendor->vendorFields["fields"]["city"]["value"]."<br />" : ""; ?>

							<?php echo (!empty($this->vendor->vendorFields["fields"]["email"]["value"])) ? $this->vendor->vendorFields["fields"]["email"]["value"]."<br />" : ""; ?>

							<?php echo (!empty($this->vendor->vendor_url)) ? $this->vendor->vendor_url."<br />" : ""; ?>

							<?php echo (!empty($this->vendor->vendorFields["fields"]["phone_1"]["value"])) ? $this->vendor->vendorFields["fields"]["phone_1"]["value"]."<br />" : ""; ?>

							<?php /* Custom fields */ ?>
								<?php echo (!empty($this->vendor->vendorFields["fields"]["fax"]["value"])) ? $this->vendor->vendorFields["fields"]["fax"]["value"]."<br />" : ""; ?>
							<?php /* /Custom fields */ ?>
						</td>
					</tr>

					<?php if($this->vendor->vendor_letter_header_image === "1") : ?>
						<tr valign="top">
							<td colspan="2" style="width: 100%;" align="left" width="100%" style="font-size: <?php echo $this->vendor->vendor_letter_header_font_size; ?>pt;">
								<br /><br />
								<span style="display: block; margin-bottom: 5px; font-size: <?php echo (int)$this->vendor->vendor_letter_header_font_size - 2; ?>pt;"><u><?php echo (!empty($vendorCompanyName)) ? $vendorCompanyName." &ndash; " : ""; ?>
									<?php echo (!empty($this->vendor->vendorFields["fields"]["address_1"]["value"])) ? $this->vendor->vendorFields["fields"]["address_1"]["value"]." &ndash; " : ""; ?>
									<?php echo (!empty($this->vendor->vendorFields["fields"]["zip"]["value"])) ? $this->vendor->vendorFields["fields"]["zip"]["value"]." " : ""; ?>
									<?php echo (!empty($this->vendor->vendorFields["fields"]["city"]["value"])) ? $this->vendor->vendorFields["fields"]["city"]["value"] : ""; ?></u>
								</span>
								<br />
								<?php echo (!empty($this->orderDetails['details']['BT']->company)) ? $this->orderDetails['details']['BT']->company."<br />" : ""; ?>
	
								<?php echo (!empty($this->orderDetails['details']['BT']->title)) ? $this->orderDetails['details']['BT']->title." " : ""; ?>
								<?php echo (!empty($this->orderDetails['details']['BT']->first_name)) ? $this->orderDetails['details']['BT']->first_name." " : ""; ?>
								<?php echo (!empty($this->orderDetails['details']['BT']->last_name)) ? $this->orderDetails['details']['BT']->last_name : ""; ?>
								<br />
	
								<?php echo (!empty($this->orderDetails['details']['BT']->address_1)) ? $this->orderDetails['details']['BT']->address_1."<br />" : ""; ?>
								<?php echo (!empty($this->orderDetails['details']['BT']->address_2)) ? $this->orderDetails['details']['BT']->address_2."<br />" : ""; ?>
	
								<?php echo (!empty($this->orderDetails['details']['BT']->zip)) ? $this->orderDetails['details']['BT']->zip." " : ""; ?>
								<?php echo (!empty($this->orderDetails['details']['BT']->city)) ? $this->orderDetails['details']['BT']->city."<br />" : ""; ?>
	
								<?php echo (!empty($this->userfields['fields']['virtuemart_country_id']['value'])) ? $this->userfields['fields']['virtuemart_country_id']['value']."<br />" : ""; ?>
								<br />
							</td>
						</tr>
					<?php endif; ?>

					<?php echo $this->loadTemplate('order'); ?>

					<?php if(!empty($this->vendor->vendor_invoice_free1)): ?>
						<tr>
							<td colspan="2">
								<?php echo $this->vendor->vendor_invoice_free1; ?>								
							</td>
						</tr>
					<?php endif; ?>

					<tr>
						<td colspan="2">
							<?php echo $this->loadTemplate('items'); ?>
						</td>
					</tr>

					<?php if(!empty($this->orderDetails['details']['BT']->customer_note)): ?>
						<tr>
							<td colspan="2">			
								<u><?php echo JText::sprintf('COM_VIRTUEMART_MAIL_SHOPPER_QUESTION', ''); ?></u><br />
								<?php echo nl2br($this->orderDetails['details']['BT']->customer_note); ?><br /><br />			
							</td>
						</tr>
					<?php endif; ?>

					<tr>
						<td colspan="2"><u><?php echo JText::_("COM_VIRTUEMART_MAIL_ORDER_DETAILS"); ?>:</u><br /></td>
					</tr>

					<tr>
						<td colspan="2"><?php echo JText::_("COM_VIRTUEMART_MAIL_PAYMENT_METHOD"); ?>: <?php echo $this->orderDetails['paymentName']; ?></td>
					</tr>

					<tr>
						<td colspan="2">
							<br /><br />
							<?php echo JText::_('COM_VIRTUEMART_MAIL_FOOTER'); ?> <?php echo $vendorCompanyName; ?>.<br />
						</td>
					</tr>

					<?php if(!empty($this->vendor->vendor_invoice_free2)): ?>
						<tr>
							<td colspan="2">
								<?php echo $this->vendor->vendor_invoice_free2; ?>								
							</td>
						</tr>
					<?php endif; ?>
				</table>
			</td>
		</tr>
	</table>
</body>