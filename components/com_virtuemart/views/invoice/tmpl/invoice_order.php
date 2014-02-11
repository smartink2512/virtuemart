<?php
/**
 *
 * Order detail view
 *
 * @package	VirtueMart
 * @subpackage Orders
 * @author Oscar van Eijk, Valerie Isaksen
 * @author Yagendoo Media Team
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: details_order.php 5341 2012-01-31 07:43:24Z alatak $
 */

defined('_JEXEC') or die('Restricted access');
?>
<tr><td colspan="2"><br /><br /><br /><hr /></td></tr>

<tr valign="middle">
	<td>
		<?php if($this->doctype == 'invoice'): ?>
			<?php if($this->invoiceNumber): ?>
				<h3><?php echo JText::_('COM_VIRTUEMART_INVOICE'); ?> <?php echo $this->invoiceNumber; ?></h3>
			<?php endif; ?>
		<?php elseif($this->doctype == 'deliverynote'): ?>
			<h3><?php echo JText::_('COM_VIRTUEMART_DELIVERYNOTE'); ?></h3>
		<?php elseif($this->doctype == 'confirmation'): ?>
			<h3><?php echo JText::_('COM_VIRTUEMART_CONFIRMATION'); ?></h3>
		<?php endif; ?>
	</td>

	<td align="right" style="font-size: 6pt;">
		<?php echo JText::_('COM_VIRTUEMART_YOUR_CUSTOMER_NUMBER'); ?>: <?php echo $this->orderDetails['details']['BT']->virtuemart_user_id; ?><br />
		<?php echo JText::_('COM_VIRTUEMART_MAIL_SHOPPER_YOUR_ORDER'); ?> <?php echo $this->orderDetails['details']['BT']->order_number ?><br />
		<?php echo JText::_('COM_VIRTUEMART_DATE'); ?>: <?php echo strftime("%e. %B %Y"); ?><br />
	</td>
</tr>

<tr><td colspan="2" style="padding-bottom: 15px;"><hr /></td></tr>