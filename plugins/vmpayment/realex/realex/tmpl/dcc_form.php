<?php  defined('_JEXEC') or die();

/**
 * @author Valérie Isaksen
 * @version $Id$
 * @package VirtueMart
 * @subpackage payment
 * @copyright Copyright (C) 2004-${PHING.VM.COPYRIGHT}   - All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */
JHTML::_('behavior.tooltip');
JHTML::script('vmcreditcard.js', 'components/com_virtuemart/assets/js/', false);
VmConfig::loadJLang('com_virtuemart', true);

$doc = JFactory::getDocument();
//$doc->addScript(JURI::root(true) . '/plugins/vmpayment/realex/realex/assets/js/site.js');
$doc->addStyleSheet(JURI::root(true) . '/plugins/vmpayment/realex/realex/assets/css/realex.css');
$xml_response = $viewData['xml_response_dcc'];
$order = $viewData['order'];
$customerData = $viewData['customerData'];
$method = $viewData['method'];
?>
<div class="dcc_box">
	<div class="dcc_offer_title">
		<?php echo vmText::_('VMPAYMENT_REALEX_DCC_PAY_OWN_CURRENCY'); ?>
	</div>

	<div class="dcc_offer" id="dcc_offer_section">
		<div id="dcc_offer_text">
			<?php echo vmText::sprintf('VMPAYMENT_REALEX_DCC_PAY_OWN_CURRENCY_TIP', $this->getCardHolderAmount($xml_response->dccinfo->merchantamount), $xml_response->dccinfo->merchantcurrency, $this->getCardHolderAmount($xml_response->dccinfo->cardholderamount), $xml_response->dccinfo->cardholdercurrency); ?>
		</div>
		<div class="dcc_offer_exchange_rate">
			<?php echo vmText::sprintf('VMPAYMENT_REALEX_DCC_PAY_OWN_CURRENCY_EXCHANGE_RATE', 1, $xml_response->dccinfo->merchantcurrency, $xml_response->dccinfo->cardholderrate, $xml_response->dccinfo->cardholdercurrency); ?>
		</div>


		<form method="post" action="<?php echo $viewData['submit_url'] ?>">
			<?php
			if ($viewData['realvault']) {
				?>
				<input type="hidden" name="remote" value="1">
			<?php
			}
			?>

			<input type="hidden" name="order_number" value="<?php echo $order['details']['BT']->order_number ?>">
			<input type="hidden" name="virtuemart_paymentmethod_id" value="<?php echo $order['details']['BT']->virtuemart_paymentmethod_id ?>">
			<input type="hidden" name="dcc_form" value="1">

	</div>
	<div class="dcc_choices">
			<div class="dcc_choice">
				<input class="dcc_offer_btn vm-button" name="dcc_choice" id="dcc_choice_1" type="radio" value="1">
				<label for="dcc_choice_1">
				<?php echo   vmText::sprintf('VMPAYMENT_REALEX_DCC_PAY_OWN_CURRENCY_YES', $this->getCardHolderAmount($xml_response->dccinfo->cardholderamount), $xml_response->dccinfo->cardholdercurrency); ?>
				</label>
			</div>
			<div class="dcc_choice">
				<input class="dcc_offer_btn vm-button" name="dcc_choice" id="dcc_choice_0" type="radio" value="0" checked="checked">
				<label for="dcc_choice_0">
				<?php echo vmText::sprintf('VMPAYMENT_REALEX_DCC_PAY_OWN_CURRENCY_NO', $this->getCardHolderAmount($xml_response->dccinfo->merchantamount), $xml_response->dccinfo->merchantcurrency); ?>
					</label>
			</div>
	</div>
	<div class="dcc_card_payment_button details-button">
		<span class="addtocart-button">
		<input type="submit" class="dcc_offer_btn addtocart-button" value="<?php echo $viewData['card_payment_button'] ?>"/>
			</span>
	</div>
	</form>
	<div class=" dcc_offer_legal ">

		<?php echo vmText::sprintf('VMPAYMENT_REALEX_DCC_PAY_OWN_CURRENCY_LEGAL', $xml_response->dccinfo->exchangeratesourcetimestamp, sprintf("%d", $xml_response->dccinfo->marginratepercentage), $xml_response->dccinfo->commissionpercentage); ?>
	</div>
</div>
