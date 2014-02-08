<?php
/**
 *
 * REALEX  payment plugin
 *
 * @version $Id: REALEX.php 7217 2013-09-18 13:42:54Z alatak $
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

$customerData = $viewData['customerData'];

JHTML::_('behavior.tooltip');
JHTML::script('vmcreditcard.js', 'components/com_virtuemart/assets/js/', false);
VmConfig::loadJLang('com_virtuemart', true);
vmJsApi::jCreditCard();
vmJsApi::jQuery();
vmJsApi::chosenDropDowns();
$doc = JFactory::getDocument();
//$doc->addScript(JURI::root(true) . '/plugins/vmpayment/realex/realex/assets/js/site.js');
$doc->addStyleSheet(JURI::root(true).'/plugins/vmpayment/realex/realex/assets/css/realex.css');

?>
<div class="realex_remote_form">
<input type="radio" name="virtuemart_paymentmethod_id"
       id="payment_id_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>"
       value="<?php echo $viewData['virtuemart_paymentmethod_id']; ?>" <?php echo $viewData ['checked']; ?>>
<label for="payment_id_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>">
<span class="vmpayment">
        <?php if (!empty($viewData['payment_logo'])) { ?>
	        <span class="vmpayment_logo"><?php echo $viewData ['payment_logo']; ?> </span>
        <?php } ?>
	<span class="vmpayment_name"><?php echo $viewData['method']->payment_name; ?></span>


	<?php if (!empty($viewData['payment_cost'])) { ?>
		<span class="vmpayment_cost"><?php echo JText::_('COM_VIRTUEMART_PLUGIN_COST_DISPLAY') . $viewData['payment_cost'] ?></span>
	<?php } ?>
</span>

</label>

<?php if (!empty($viewData['creditcardsDropDown'])) { ?>
	<div class="creditcardsDropDown">
		<?php
		echo $viewData['creditcardsDropDown'];
		?>
	</div>
<?php
}
?>
	<div>


		<div class="vmpayment_cardinfo">
			<div class="vmpayment_cardinfo_text">
			<?php if (empty($viewData['creditcardsDropDown'])) {
				echo JText::_('VMPAYMENT_REALEX_CC_COMPLETE_FORM');

			} else {
				echo JText::_('VMPAYMENT_REALEX_CC_ADD_NEW');
			}
			?>
</div>


			<div class="vmpayment_creditcardtype">
				<span class="vmpayment_label"><label for="creditcardtype"><?php echo JText::_('VMPAYMENT_REALEX_CC_CCTYPE'); ?></label></span>


				<?php
				foreach ($viewData['creditcards'] as $creditCard) {
					$options[] = JHTML::_('select.option', $creditCard, JText::_('VMPAYMENT_REALEX_CC_' . strtoupper($creditCard)));
				}
				$attribs = 'class="inputbox vm-chzn-select" style= "width: 250px;" rel="' . $viewData['virtuemart_paymentmethod_id'] . '"';
				echo JHTML::_('select.genericlist', $options, 'remote_cc_type_' . $viewData['virtuemart_paymentmethod_id'], $attribs, 'value', 'text', $customerData->getVar('remote_cc_type', $viewData['virtuemart_paymentmethod_id']));
				?>
			</div>
			<div class="vmpayment_cc_type">
				<span class="vmpayment_label"><label for="cc_type"><?php echo JText::_('VMPAYMENT_REALEX_CC_CCNUM'); ?></label></span>

				<input type="text" size="30" class="inputbox" id="remote_cc_number_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>"
				       name="remote_cc_number_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>" value="<?php echo wordwrap($customerData->getVar('remote_cc_number', $viewData['virtuemart_paymentmethod_id']), 4, " "); ?>"
				       autocomplete="off" onchange="ccError=razCCerror(<?php echo $viewData['virtuemart_paymentmethod_id']; ?>);
					CheckCreditCardNumber(this . value, <?php echo $viewData['virtuemart_paymentmethod_id']; ?>);
					if (!ccError) {
					this.value='';}"/>

				<div id="cc_cardnumber_errormsg_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>"></div>

			</div>
			<div class="vmpayment_cc_cvv">

				<span class="vmpayment_label"><label for="cc_cvv"><?php echo JText::_('VMPAYMENT_REALEX_CC_CVV2') ?></label></span>

				<input type="text" class="inputbox remote_cc_cvv" id="remote_cc_cvv_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>" name="remote_cc_cvv_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>" maxlength="4" size="5" value="<?php echo $customerData->getVar('remote_cc_cvv', $viewData['virtuemart_paymentmethod_id']); ?>" autocomplete="off"/>
                    <span class="hasTip" title="<?php echo JText::_('VMPAYMENT_REALEX_CC_WHATISCVV') ?>::<?php echo JText::sprintf("VMPAYMENT_REALEX_CC_WHATISCVV_TOOLTIP", $this->_displayCVVImages($viewData['method'])) ?> ">
                        <?php echo JText::_('VMPAYMENT_REALEX_CC_WHATISCVV'); ?>
                    </span>
			</div>
			<div class="vmpayment_cc_date">
				<span class="vmpayment_label"><label for="creditcardtype"><?php echo JText::_('VMPAYMENT_REALEX_CC_EXPDATE'); ?></label></span>

				<?php
				echo shopfunctions::listMonths('remote_cc_expire_month_' . $viewData['virtuemart_paymentmethod_id'], $customerData->getVar('remote_cc_expire_month',$viewData['virtuemart_paymentmethod_id'] ),   "class=\"inputbox vm-chzn-select\" style=\"width: 150px;\"");

				echo shopfunctions::listYears('remote_cc_expire_year_' . $viewData['virtuemart_paymentmethod_id'], $customerData->getVar('remote_cc_expire_year' , $viewData['virtuemart_paymentmethod_id']), null, null, "class=\"inputbox vm-chzn-select\" style=\"width: 100px;\"  onchange=\"var month = document.getElementById('cc_expire_month_'" . $viewData['virtuemart_paymentmethod_id'] . "); if(!CreditCardisExpiryDate(month.value,this.value, '" . $viewData['virtuemart_paymentmethod_id'] . "')){this.value='';month.value='';}\" ");
				?>
				<div id="cc_expiredate_errormsg_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>"></div>

			</div>
			<div class="vmpayment_cc_name">

				<span class="vmpayment_label"><label for="cc_name"><?php echo JText::_('VMPAYMENT_REALEX_CC_CCNAME'); ?></label></span>

				<input type="text" size="30" class="inputbox" id="remote_cc_name_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>"
				       name="remote_cc_name_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>" value="<?php echo $customerData->getVar('remote_cc_name', $viewData['virtuemart_paymentmethod_id']); ?>"
				       autocomplete="off" onchange="ccError=razCCerror(<?php echo $viewData['virtuemart_paymentmethod_id']; ?>);
					CheckCreditCardNumber(this . value, <?php echo $viewData['virtuemart_paymentmethod_id']; ?>);
					if (!ccError) {
					this.value='';}"/>

				<div id="cc_cardname_errormsg_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>"></div>
			</div>

		<?php if ($viewData['method']->offer_save_card){
			if ($customerData->getVar('remote_save_card', $viewData['virtuemart_paymentmethod_id'])) {
				$checked = 'checked="checked"';
			}
			else {
				$checked = '';
			}
			?>
			<br />
		<div class="offer_save_card">
			<label for="remote_save_card_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>">
			<input id="remote_save_card_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>" name="remote_save_card_<?php echo $viewData['virtuemart_paymentmethod_id']; ?>" type="checkbox"value="1" <?php echo $checked ?>><span class="remote_save_card"> <?php echo vmText::_('VMPAYMENT_REALEX_SAVE_CARD_DETAILS') ?></span>
			</label>
				<div id="remote_save_card_tip"><?php echo vmText::_('VMPAYMENT_REALEX_SAVE_CARD_DETAILS_TIP') ?></div>
		</div>
		<?php
		}
		?>
	</div>
	</div>
</div>