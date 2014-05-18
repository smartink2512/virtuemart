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


?>
<div class="realex redirect_notify">
	<?php
	if ($viewData["success"]) {
		?>
		<div class="transaction_success">
			<div class="notify_success">
				<?php
				echo vmText::sprintf('VMPAYMENT_REALEX_NOTIFY_SUCCESS', $viewData["shop_name"]);
				?>
			</div>
			<?php
			if ($viewData["order_history_comments"]) {
				?>
				<div class="order_history_comments">
					<?php
					echo $viewData["order_history_comments"];
					?>
				</div>
			<?php
			}
			?>
			<div class="return_url">
				<a href="<?php echo $viewData["return_success"] ?>"><?php echo vmText::sprintf('VMPAYMENT_REALEX_NOTIFY_RETURN_URL', $viewData["shop_name"]); ?></a>
			</div>
		</div>
	<?php
	} else {
		?>
		<div class="transaction_declined">

			<?php
			if ($viewData["order_history_comments"]) {
				?>
				<div class="order_history_comments">
					<?php
					echo $viewData["order_history_comments"];
					?>
				</div>
			<?php
			} else {
				?>
				<div class="notify_declined">
					<?php
					echo vmText::sprintf('VMPAYMENT_REALEX_NOTIFY_DECLINED', $viewData["order_number"], $viewData["shop_name"]);
					?>
				</div>
			<?php
			}
			?>
			<div class="return_url">
				<a href="<?php echo $viewData["return_declined"] ?>"><?php echo vmText::sprintf('VMPAYMENT_REALEX_NOTIFY_RETURN_URL', $viewData["shop_name"]); ?></a>
			</div>
		</div>
	<?php
	}
	?>

</div>
