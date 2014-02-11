<?php
/**
 *
 * Layout for the shopper mail, when he confirmed an ordner
 *
 * The addresses are reachable with $this->BTaddress['fields'], take a look for an exampel at shopper_adresses.php
 *
 * With $this->cartData->paymentName or shipmentName, you get the name of the used paymentmethod/shippmentmethod
 *
 * In the array order you have details and items ($this->orderDetails['details']), the items gather the products, but that is done directly from the cart data
 *
 * $this->orderDetails['details'] contains the raw address data (use the formatted ones, like BTaddress['fields']). Interesting informatin here is,
 * order_number ($this->orderDetails['details']['BT']->order_number), order_pass, coupon_code, order_status, order_status_name,
 * user_currency_rate, created_on, customer_note, ip_address
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Max Milbers, Valerie Isaksen
 * @author Yagendoo Media GmbH
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

<tr><td colspan="2"><hr /></td></tr>

<tr valign="middle">	
	<td>
		<h3 style="margin: 0;"><?php echo JText::sprintf('COM_VIRTUEMART_MAIL_ORDER_STATUS', '<span style="font-weight: normal;">'.JText::_($this->orderDetails['details']['BT']->order_status_name).'</span>') ; ?></h3>
	</td>

	<td align="right">
		<?php echo JText::_('COM_VIRTUEMART_YOUR_CUSTOMER_NUMBER'); ?>: <?php echo $this->orderDetails['details']['BT']->virtuemart_user_id; ?><br />
		<?php echo JText::_('COM_VIRTUEMART_MAIL_SHOPPER_YOUR_ORDER'); ?> <?php echo $this->orderDetails['details']['BT']->order_number ?><br />
		<?php echo JText::_('COM_VIRTUEMART_DATE'); ?>: <?php echo strftime("%e. %B %Y"); ?><br />
	</td>
</tr>

<tr><td colspan="2" style="padding-bottom: 15px;"><hr /></td></tr>