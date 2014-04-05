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


class  KlikandpayHelperKlikandpay {

	const RESPONSE_SUCCESS = '00000';

	const TYPEPAIEMENT_CARTE = 'CARTE';

	const TYPECARTE_CB = 'CB';

	const TYPE_DIRECT_AUTHORIZATION_ONLY = '00001';
	const TYPE_DIRECT_CAPTURE = '00002';
	const TYPE_DIRECT_AUTHORIZATION_CAPTURE = '00003';

	function __construct ($method, $plugin) {
		$this->_method = $method;
		$this->plugin = $plugin;
	}



	public function setOrder ($order) {
		$this->order = $order;
	}




	public function getType () {
		switch ($this->_method->type) {

			case 'authorization_capture':
				return self::TYPE_DIRECT_AUTHORIZATION_CAPTURE;
				break;
			case 'authorization_only':
			default:
				return self::TYPE_DIRECT_AUTHORIZATION_ONLY;
				break;
		}

	}


	function getOrderDetails ($order) {
		$orderDetails = '';
		foreach ($order['details']['items'] as $item) {
			$product_sku = str_replace(array('%', ':', '|'), '-', $item->order_item_sku);
			$product_name = str_replace(array('%', ':', '|'), '-', $item->order_item_name);
			$price = $item->product_final_price;
			$qty = $item->product_quantity;
			$orderDetails .= "REF:" . $product_sku . "%Q:" . $qty . "%PRIX:" . $price . "%PROD:" . $product_name . "|";
		}
		return $orderDetails;
	}


	function getLanguage () {

		$langKlikandpay = array(
			'fr' => 'fr',
			'en' => 'en',
			'es' => 'es',
			'it' => 'ir',
			'de' => 'de',
			'nl' => 'du',
		);
		$lang = JFactory::getLanguage();
		$tag = strtolower(substr($lang->get('tag'), 0, 2));
		if (array_key_exists($tag, $langKlikandpay)) {
			return $langKlikandpay[$tag];
		} else {
			return $langKlikandpay['en'];
		}
	}


	function getKlikandpayServerUrl () {


		if ($this->_method->shop_mode == 'test') {
			$url = 'https://www.klikandpay.com/paiementtest/check.pl';
		} else {
			$url = 'https://www.klikandpay.com/paiement/check.pl';
		}
		return $url;

	}


	/**
	 * @param $klikandpay_data
	 * @return mixed
	 */
	function getOrderNumber ($order_number) {
		return $order_number;
	}

	/**
	 * @return array
	 */
	function getExtraPluginNameInfo () {

		return false;
	}

	/**
	 * @param $klikandpay_data
	 * @param $order
	 * @return mixed
	 */
	function getOrderHistory ($klikandpay_data, $order) {
		$amountInCurrency = vmPSPlugin::getAmountInCurrency($klikandpay_data['MONTANTXKP'] , $klikandpay_data['DEVISEXKP']);
		$order_history['comments'] = vmText::sprintf('VMPAYMENT_KLIKANDPAY_PAYMENT_STATUS_CONFIRMED', $amountInCurrency['display'], $order['details']['BT']->order_number);
		$order_history['comments'] .= "<br />" . vmText::_('VMPAYMENT_KLIKANDPAY_RESPONSE_S') . ' ' . $klikandpay_data['S'];

		$order_history['customer_notified'] = true;
		$status_success = 'status_success_' . $this->_method->debit_type;
		$order_history['order_status'] = $this->_method->$status_success;
		return $order_history;
	}


}
