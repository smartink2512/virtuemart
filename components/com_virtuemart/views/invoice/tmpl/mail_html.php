<?php
/**
 *
 * Layout for the shopper mail, when he confirmed an ordner
 *
 * The addresses are reachable with $this->BTaddress, take a look for an exampel at shopper_adresses.php
 *
 * With $this->orderDetails['shipmentName'] or paymentName, you get the name of the used paymentmethod/shippmentmethod
 *
 * In the array order you have details and items ($this->orderDetails['details']), the items gather the products, but that is done directly from the cart data
 *
 * $this->orderDetails['details'] contains the raw address data (use the formatted ones, like BTaddress). Interesting informatin here is,
 * order_number ($this->orderDetails['details']['BT']->order_number), order_pass, coupon_code, order_status, order_status_name,
 * user_currency_rate, created_on, customer_note, ip_address
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Max Milbers, Valerie Isaksen
 * @author Yagendoo Media Team
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 *
 */

defined('_JEXEC') or die('Restricted access'); ?>
<html>
<head>	
	<style type="text/css">
		body, table {
			font-size: <?php echo $this->vendor->vendor_mail_font_size; ?>px;
		}
		tr, td	{
			border: 0 none;
		}
		<?php if(!empty($this->vendor->vendor_mail_css)) : ?>
			<?php echo $this->vendor->vendor_mail_css; ?>
		<?php endif; ?>
	</style>
</head>

<body style="margin: 0; padding: 0; font-family: '<?php echo ucfirst($this->vendor->vendor_mail_font); ?>', 'Arial', sans-serif;">
	<table style="width: 100%; background-color: #E0E0E0; border: 0;" bgcolor="#E0E0E0" border="0">
		<tr>
			<td>
				<table style="width: <?php echo $this->vendor->vendor_mail_width; ?>px; margin: 15px auto; background-color: #FFFFFF; border: 1px solid #D5D5D5; -webkit-border-radius: 3px; -moz-border-radius: 3px; -o-border-radius: 3px; border-radius: 3px;" width="<?php echo $this->vendor->vendor_mail_width; ?>" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="<?php echo $this->vendor->vendor_mail_width; ?>">
							<table style="width: 96%; margin: 2%; border: 0;" border="0" cellpadding="0" cellspacing="0">
								<?php if($this->recipient == 'shopper'): ?>
									<?php echo $this->loadTemplate('header'); ?>
								<?php endif; ?>

								<?php echo $this->loadTemplate($this->recipient); ?>

								<?php if($this->recipient == 'vendor'): ?>
									<?php echo $this->loadTemplate('shopperaddresses'); ?>
								<?php endif; ?>

								<?php echo $this->loadTemplate('pricelist'); ?>

								<?php echo $this->loadTemplate($this->recipient . '_more'); ?>
							</table>
						</td>
					</tr>

					<?php if($this->recipient === "shopper") : ?>
						<tr>
							<td width="<?php echo $this->vendor->vendor_mail_width; ?>">
								<table style="width: 96%; margin: 2%; border: 0;" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="font-size: <?php echo $this->vendor->vendor_mail_footer_font_size; ?>px;">
											<?php echo $this->loadTemplate('footer'); ?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					<?php endif; ?>
				</table>
			</td>
		</tr>

		<?php if($this->recipient === "shopper" && $this->vendor->vendor_mail_tos === "1") : ?>
			<tr>
				<td>
					<table style="width: <?php echo $this->vendor->vendor_mail_width; ?>px; margin: 0 auto 15px auto;" width="<?php echo $this->vendor->vendor_mail_width; ?>" border="0" cellpadding="0" cellspacing="0">
						<td style="padding: 0 0 0 30px; color: #8D8D8D;" color="#8D8D8D">
							<?php echo $this->vendor->vendor_terms_of_service; ?>
						</td>
					</table>
				</td>
			</tr>
		<?php endif; ?>
	</table>
</body>
</html>