<?php
/**
 *
 * Layout for the shopping cart, look in mailshopper for more details
 *
 * @package	VirtueMart
 * @subpackage Order
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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
?>

<?php if($this->vendor->vendor_mail_header === "1") : ?>
	<tr valign="top">
		<td style="width: 50%; padding-top: 10px; padding-bottom: 20px; overflow: hidden;" align="left" width="50%">
			<?php if($this->vendor->vendor_mail_logo === "1" && !empty($this->vendor->images[0]->file_url)) : ?>
				<img style="max-width: 100%; height: auto;" src="<?php  echo JURI::root () . $this->vendor->images[0]->file_url ?>" alt="vendor_image" border="0" />
			<?php endif; ?>
		</td>

		<td style="width: 50%; padding-top: 10px; padding-bottom: 20px; font-size: 9px; text-align: right;" align="right" width="50%">
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
<?php endif; ?>

<tr><td colspan="2"><br /><br /></td></tr>

<tr>
	<td colspan="2">
		<?php echo JText::sprintf("COM_VIRTUEMART_MAIL_VENDOR_INTRO", $vendorCompanyName, $this->orderDetails['details']['BT']->order_number); ?>
	</td>
</tr>

<?php if(!empty($this->orderDetails['details']['BT']->customer_note)) : ?>
	<tr>
		<td colspan="2">
			<br /><br />
			<?php echo JText::sprintf('COM_VIRTUEMART_CART_MAIL_VENDOR_SHOPPER_QUESTION', $this->orderDetails['details']['BT']->customer_note); ?>
			<br />
		</td>
	</tr>
<?php endif; ?>

<tr><td colspan="2"><br /><br /><hr /></td></tr>