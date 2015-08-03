<?php
/**
 *
 * KlarnaCheckout payment plugin
 *
 * @author Valérie Isaksen
 * @version $Id:$
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


defined('_JEXEC') or die('Restricted access');

class  KlarnaCheckoutHelperKlarnaCheckout {
	function getVatTaxProduct($vatTax) {
		$countRules = count($vatTax);
		if ($countRules == 0) {
			return 0;
		}
		if ($countRules > 1) {
			$this->KlarnacheckoutError('KlarnaCheckout: More then one VATax for the product:' . $countRules);
		}
		$tax = current($vatTax);
		if ($tax[2] != "+%") {
			$this->KlarnacheckoutError('KlarnaCheckout: expecting math operation to be +% but is ' . $tax[2]);
		}
		return $tax[1];

	}


	function getTaxShipment($shipment_calc_id) {
		// TO DO add shipmentTaxRate in the cart
		// assuming there is only one rule +%

		$db = JFactory::getDBO();
		$q = 'SELECT * FROM #__virtuemart_calcs WHERE `virtuemart_calc_id`="' . $shipment_calc_id[0] . '" ';
		$db->setQuery($q);
		$taxrule = $db->loadObject();
		if ($taxrule->calc_value_mathop != "+%") {
			$this->KlarnacheckoutError('KlarnaCheckout getTaxShipment: expecting math operation to be +% but is ' . $taxrule->calc_value_mathop);
			$this->debugLog(var_export($taxrule, true), 'getTaxShipment', 'debug');
			$this->debugLog($q, 'getTaxShipment query', 'debug');
		}
		return $taxrule->calc_value * 100;

	}


	function acknowledge($klarna_checkout_order) {
	}
}