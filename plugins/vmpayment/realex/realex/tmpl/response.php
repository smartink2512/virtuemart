<?php
/**
 *
 * Realex payment plugin
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

$success = $viewData["success"];
$payment_name = $viewData["payment_name"];
$payment = $viewData["payment"];
$order = $viewData["order"];

?>
<br />
<div class="realex_response">
<div class="realex_comment"><?php echo $viewData["comment"] ?></div>

	<?php if ($success) { ?>
<div class="realex_pasref">
	<span class="realex_pasref_label"><?php echo JText::_('VMPAYMENT_REALEX_RESPONSE_PASREF'); ?></span>
        <span class="realex_pasref_value"><?php echo  $viewData["payment"]['realex_response_pasref']; ?></span>
    </div>
    <?php }  ?>


<?php if ($success) { ?>
	<br />
	<a class="vm-button-correct" href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=orders&layout=details&order_number='.$viewData["order"]['details']['BT']->order_number.'&order_pass='.$viewData["order"]['details']['BT']->order_pass, false)?>"><?php echo JText::_('COM_VIRTUEMART_ORDER_VIEW_ORDER'); ?></a>
<?php } ?>
</div>