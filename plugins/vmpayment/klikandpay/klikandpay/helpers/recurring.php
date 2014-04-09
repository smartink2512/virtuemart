<?php
/**
 *
 * Klikandpay payment plugin
 *
 * @author Valérie Isaksen
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


defined('_JEXEC') or die('Restricted access');
class KlikandpayHelperKlikandpayRecurring extends KlikandpayHelperKlikandpay {

	function __construct ($method, $paypalPlugin) {
		parent::__construct($method, $paypalPlugin);

	}

	function getExtraPluginNameInfo () {
		$extraInfo['recurring'] = true;
		$extraInfo['recurring_number'] = $this->_method->recurring_number;
		return $extraInfo;

	}

	function getRecurringPayments ($totalInPaymentCurrency) {

		if (empty($this->_method->recurring_deposit)) {
			$recurring = $this->getRecurringIdenticalAmountMonthly($totalInPaymentCurrency);

		} else {
			$recurring = $this->getRecurringDeposit($totalInPaymentCurrency);

		}

		return $recurring;
	}

	/**
	 * Le montant total est divisé en 1, 2, .. 6 fois. Tous les montants à débiter sont équivalents.
	 * Le premier montant est débité au moment de la date d’achat,
	 * et les autres montants sont présentés en banque à date anniversaire à 1 mois d’intervalle.
	 * @param $totalInPaymentCurrency
	 */
	function getRecurringIdenticalAmountMonthly ($totalInPaymentCurrency) {

		$recurring["MONTANT"] = $totalInPaymentCurrency;
		$recurring["EXTRA"] = $this->_method->recurring_number . "FOIS";
		return $recurring;
	}

	/**
	 * Après versement d’un acompte immédiat, le solde à payer est divisé en 1, 2, ... 6 fois
	 * dont la date anniversaire peut être différente de celle du paiement immédiat.
	 * Chaque échéance pour le paiement du solde sera présentée à 1 mois d’intervalle à la date anniversaire définie
	 * si elle est différente du paiement initial.
	 *
	 * Indiquer une valeur pour la variable MONTANT qui sera immédiatement présentée en banque,
	 * MONTANT2 le montant du solde.
	 * EXTRA, le nombre d’échéances souhaitées.
	 *
	 *
	 * OU
	 *     * Paiement d’un acompte immédiat et paiement du solde à une date définie.
	 *
	 * Indiquer le montant à débiter immédiatement dans la variable MONTANT,
	 * le solde à débiter dans MONTANT2 et
	 * indiquer la date pour le paiement du solde dans la variable DATE2.
	 *
	 * @param $totalInPaymentCurrency
	 */
	function getRecurringDeposit ($totalInPaymentCurrency) {
		if (preg_match('/%$/', $this->_method->recurring_deposit)) {
			$recurring_deposit = substr($this->_method->recurring_deposit, 0, -1);
		} else {
			$recurring_deposit = $this->_method->recurring_deposit;
		}
		$deposit = $totalInPaymentCurrency * $recurring_deposit * 0.01;

		$recurring["MONTANT"] = $deposit;
		$recurring["MONTANT2"] = $totalInPaymentCurrency - $deposit;
		$recurring["EXTRA"] = $this->_method->recurring_number . "FOIS";
		if ($this->_method->recurring_date) {
			$recurring["DATE2"] = $this->getNextTermDate();
		}


		return $recurring;
	}

	/**
	 * La valeur DATE, doit être au format : année-mois-jour
	 */
	function getNextTermDate () {
		return date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + ($this->_method->recurring_date), date('Y')));
	}


	function getOrderHistory ($klikandpay_data, $order, $payments) {
		$amountInCurrency = vmPSPlugin::getAmountInCurrency($order['details']['BT']->order_total, $order['details']['BT']->order_currency);
		$order_history['comments'] = vmText::sprintf('VMPAYMENT_KLIKANDPAY_PAYMENT_STATUS_CONFIRMED_RECURRING', $amountInCurrency['display'], $order['details']['BT']->order_number);

		$amountInCurrency = vmPSPlugin::getAmountInCurrency($klikandpay_data['M'] * 0.01, $order['details']['BT']->order_currency);
		$order_history['comments'] .= "<br />" . vmText::sprintf('VMPAYMENT_KLIKANDPAY_PAYMENT_STATUS_CONFIRMED_RECURRING_2', $amountInCurrency['display']);

		$order_history['comments'] .= "<br />" . vmText::_('VMPAYMENT_KLIKANDPAY_RESPONSE_S') . ' ' . $klikandpay_data['S'];
		$recurring_comment = '';
		$payment = $payments[0];
		$recurring = json_decode($payment->recurring);

		if (count($payments) == 1) {
			$recurring_comment .= "<br />" . vmText::sprintf('VMPAYMENT_KLIKANDPAY_COMMENT_RECURRING_INFO', $payment->recurring_number);
			$recurring_comment .= "<br />" . vmText::_('VMPAYMENT_KLIKANDPAY_COMMENT_NEXT_DEADLINES');

			$recurring_comment .= $this->getOrderRecurringTerms($payment, $order, 1);
			$status_success = 'status_success_' . $this->_method->debit_type;
			$order_history['order_status'] = $this->_method->$status_success;
		} else {
			$nbRecurringDone = $this->getNbRecurringDone($payments);
			$this->debugLog('getNbRecurringDone:' . $nbRecurringDone, 'getOrderHistoryRecurring', 'debug', false);
			if ($nbRecurringDone < $payment->recurring_number) {
				$recurring_comment .= $this->getOrderRecurringTerms($payment, $order, $nbRecurringDone);
				$order_history['order_status'] = $this->_method->status_success_recurring;
			} else {
				$order_history['order_status'] = $this->_method->status_success_recurring_end;
			}
			$this->debugLog('Next status:' . $order_history['order_status'], 'getOrderHistoryRecurring', 'debug', false);

			$index_mont = "PBX_2MONT" . $nbRecurringDone;
			$index_date = "PBX_DATE" . $nbRecurringDone;
			//$text_mont = vmText::_('VMPAYMENT_KLIKANDPAY_PAYMENT_RECURRING_2MONT') ;
			//$text_date = vmText::_('VMPAYMENT_KLIKANDPAY_PAYMENT_RECURRING_DATE');
			//$recurring_comment .= "<br />" . $text_date . " " . $recurring->$index_date . " ";
			$amountInCurrency = vmPSPlugin::getAmountInCurrency($recurring->$index_mont * 0.01, $order['details']['BT']->order_currency);
			//$recurring_comment .= $text_mont . " " . $amountInCurrency['display'];
			$recurring_comment .= "<br />" . $recurring->$index_date . " " . $amountInCurrency['display'];
		}
		$order_history['customer_notified'] = true;
		$order_history['comments'] .= $recurring_comment;
		$order_history['recurring'] = $recurring_comment;

		return $order_history;


	}

	function getOrderRecurringTerms ($payment, $order, $start) {
		$recurring = json_decode($payment->recurring);
		$recurring_comment = "";
		for ($i = $start; $i < $payment->recurring_number; $i++) {
			$index_mont = "PBX_2MONT" . $i;
			$index_date = "PBX_DATE" . $i;
			$text_mont = vmText::_('VMPAYMENT_KLIKANDPAY_PAYMENT_RECURRING_2MONT') . " ";
			$text_date = vmText::_('VMPAYMENT_KLIKANDPAY_PAYMENT_RECURRING_DATE') . " ";
			$recurring_comment .= "<br />" . $text_date . " " . $recurring->$index_date . " ";
			$amountInCurrency = vmPSPlugin::getAmountInCurrency(($recurring->$index_mont) * 0.01, $order['details']['BT']->order_currency);
			$recurring_comment .= $text_mont . " " . $amountInCurrency['display'];
		}
		return $recurring_comment;
	}

	function getNbRecurringDone ($payments) {
		$nb = 0;
		foreach ($payments as $payment) {
			if (!empty($payment->klikandpay_fullresponse)) {
				$nb++;
			}
			return $nb;
		}
	}

	function getKlikandpayServerUrl () {
		if ($this->_method->shop_mode == 'test') {
			$url = 'https://www.klikandpay.com/paiementtest/checkxfois.pl';
		} else {
			$url = 'https://www.klikandpay.com/paiement/checkxfois.pl';
		}
		return $url;

	}
}