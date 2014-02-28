<?php
/**
 *
 * Paybox payment plugin
 *
 * @author Valerie Isaksen
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
$doc = JFactory::getDocument();
$doc->addStyleSheet(JURI::root(true) . '/plugins/vmpayment/paybox/paybox/assets/css/paybox.css');
?>

<div class="paybox response">

	<?php if ( $viewData['success']) { ?>

		<div class="vieworder">
			<a class="vm-button-correct" href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=orders&layout=details&order_number=' . $viewData["order_number"] . '&order_pass=' . $viewData["order_pass"], false) ?>"><?php echo JText::_('COM_VIRTUEMART_ORDER_VIEW_ORDER'); ?></a>
		</div>
	<?php } else { ?>
		<div class="">
			<span class=""><?php echo $viewData['not_success']; ?></span>
		</div>
	<?php } ?>
</div>