<?php
/**
 *
 * Define here the Header for order mail success !
 *
 * @package    VirtueMart
 * @subpackage Cart
 * @author Kohl Patrick
 * @author Yagendoo Media Team
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined ('_JEXEC') or die('Restricted access');
$vendorCompanyName = (!empty($this->vendor->vendorFields["fields"]["company"]["value"])) ? $this->vendor->vendorFields["fields"]["company"]["value"] : $this->vendor->vendor_store_name;
?>

<?php if($this->vendor->vendor_mail_header === "1") : ?>
	<tr valign="top">
		<td style="width: 50%; padding-top: 10px; padding-bottom: 20px; overflow: hidden;" align="left" width="50%">
			<?php if($this->vendor->vendor_mail_logo === "1" && !empty($this->vendor->images[0]->file_url)) : ?>
				<img style="width: <?php echo $this->vendor->vendor_mail_logo_width; ?>px; max-width: 100%; height: auto;" src="<?php  echo JURI::root () . $this->vendor->images[0]->file_url; ?>" width="<?php echo $this->vendor->vendor_mail_logo_width; ?>" alt="vendor_image" border="0" />
			<?php endif; ?>
		</td>

		<td style="width: 50%; padding-top: 10px; padding-bottom: 20px; font-size: <?php echo $this->vendor->vendor_mail_header_font_size; ?>px; text-align: right;" align="right" width="50%">
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

<tr valign="top">
	<td colspan="2" style="width: 100%; font-size: <?php echo (int)$this->vendor->vendor_mail_header_font_size + 2; ?>px" align="left" width="100%">
		<span style="display: block; margin-bottom: 5px; font-size: <?php echo $this->vendor->vendor_mail_header_font_size; ?>px;">
			<u>
				<?php echo (!empty($vendorCompanyName)) ? $vendorCompanyName." &ndash; " : ""; ?>
				<?php echo (!empty($this->vendor->vendorFields["fields"]["address_1"]["value"])) ? $this->vendor->vendorFields["fields"]["address_1"]["value"]." &ndash; " : ""; ?>
				<?php echo (!empty($this->vendor->vendorFields["fields"]["zip"]["value"])) ? $this->vendor->vendorFields["fields"]["zip"]["value"]." " : ""; ?>
				<?php echo (!empty($this->vendor->vendorFields["fields"]["city"]["value"])) ? $this->vendor->vendorFields["fields"]["city"]["value"] : ""; ?></u>
		</span>

		<?php echo (!empty($this->orderDetails['details']['BT']->company)) ? $this->orderDetails['details']['BT']->company."<br />" : ""; ?>

		<?php echo (!empty($this->orderDetails['details']['BT']->title)) ? $this->orderDetails['details']['BT']->title." " : ""; ?>
		<?php echo (!empty($this->orderDetails['details']['BT']->first_name)) ? $this->orderDetails['details']['BT']->first_name." " : ""; ?>
		<?php echo (!empty($this->orderDetails['details']['BT']->last_name)) ? $this->orderDetails['details']['BT']->last_name : ""; ?>
		<br />

		<?php echo (!empty($this->orderDetails['details']['BT']->address_1)) ? $this->orderDetails['details']['BT']->address_1."<br />" : ""; ?>

		<?php echo (!empty($this->orderDetails['details']['BT']->zip)) ? $this->orderDetails['details']['BT']->zip." " : ""; ?>
		<?php echo (!empty($this->orderDetails['details']['BT']->city)) ? $this->orderDetails['details']['BT']->city : ""; ?><br />

		<?php echo (!empty($this->userfields['fields']['virtuemart_country_id']['value'])) ? $this->userfields['fields']['virtuemart_country_id']['value']."<br />": ""; ?><br />
		<br />
	</td>
</tr>

<?php if(!empty($this->vendor->vendor_mail_free1)) : ?>
	<tr valign="top">
		<td colspan="2">
			<?php echo $this->vendor->vendor_mail_free1; ?>
		</td>
	</tr>
<?php endif; ?>