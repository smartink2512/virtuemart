<?php
/**
 *
 * Paybox payment plugin
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
class PayboxHelperPayboxSubscribe extends PayboxHelperPaybox {

	function __construct ($method, $paypalPlugin) {
		parent::__construct($method, $paypalPlugin);

	}

	function getOrderHistory ($paybox_data, $order) {
		return false;


	}

	function getSubscribePayments ($cart, $order) {
		$subscribe = $this->getSubscribeProducts($cart);
		if (!empty($subscribe)) {
			$subscribe['PBX_2MONT'] = $this->getPbxTotal($subscribe['PBX_2MONT']);
			$subscribe['PBX_NBPAIE'] = str_pad($subscribe['PBX_NBPAIE'], 2, "0", STR_PAD_LEFT);
			$subscribe['PBX_FREQ'] = str_pad($subscribe['PBX_FREQ'], 2, "0", STR_PAD_LEFT);
			$subscribe['PBX_QUAND'] = str_pad($this->_method->subscribe_quand, 2, "0", STR_PAD_LEFT);
			$subscribe['PBX_DELAIS'] = str_pad($this->_method->subscribe_delais, 3, "0", STR_PAD_LEFT);
		}
		$subscribe_cmd='';
		foreach ($subscribe as $key => $value) {
			$subscribe_cmd .= $key .  $value ;
		}
		$subscribe_cmd='PBX_2MONT0000000500PBX_NBPAIE00PBX_FREQ01PBX_QUAND28PBX_DELAIS005';
		//$subscribe_cmd = substr($subscribe_cmd, 0, -1);
		return $subscribe_cmd;
	}

	function getSubscribeProducts (VirtueMartCart $cart) {

		if ($this->_method->subscribe_customfield == 0) {
			return false;
		}

		// get id of parent custom field
		$paybox_parent_field = $this->_method->subscribe_customfield;
		vmdebug('PAYBOX getSubscriptionData paybox_parent_field', $paybox_parent_field);
		// amount in base currency
		$subscribe=array();

		$products = $cart->products;

		// go through basket prods

		foreach ($products as $key => $product) {
			$product_custom_fields = $this->getProdCustomFields($product->virtuemart_product_id);
			vmdebug('PAYBOX getSubscriptionData getProdCustomFields', $product_custom_fields);
			$pbx_freq = $pbx_nbpaie = $pbx_1mont = $pbx_2mont = 0;
			$paybox_parent_field_found = false;
			foreach ($product_custom_fields as $product_custom_field) {
				if ($product_custom_field->custom_parent_id == $paybox_parent_field) {
					$paybox_parent_field_found = true;
					if ($product_custom_field->custom_title == 'PBX_FREQ') {
						$pbx_freq = $product_custom_field->custom_value;
					}
					if ($product_custom_field->custom_title == 'PBX_NBPAIE') {
						$pbx_nbpaie = $product_custom_field->custom_value;
					}
					if ($product_custom_field->custom_title == 'PBX_2MONT') {
						$pbx_2mont = $product_custom_field->custom_value;
					}
					/*
					if ($product_custom_field->custom_title == 'PBX_1MONT' and !empty($product_custom_field->custom_value)) {
						$pbx_1mont = $product_custom_field->custom_value;
					}
					if ($product_custom_field->custom_title == 'PBX_2MONT' and !empty($product_custom_field->custom_value)) {
						$pbx_2mont = $product_custom_field->custom_value;
					}
					*/
				}
			}
			$productAmount = $this->getProductAmount($cart->pricesUnformatted[$key]);
			$pbx_2monts = $pbx_2mont * $product->quantity;
			if ($paybox_parent_field_found) {
				vmdebug('PAYBOX getSubscribeProducts $paybox_parent_field_found', $pbx_freq, $pbx_nbpaie);
				$subscribe['PBX_2MONT'] += round($pbx_2monts) * 100;
				$subscribe['PBX_2MONT']= str_pad($subscribe['PBX_2MONT'], 10, "0", STR_PAD_LEFT);

				$subscribe['PBX_FREQ'] = $pbx_freq;
				$subscribe['PBX_NBPAIE'] = $pbx_nbpaie;
			}
			$paybox_parent_field_found = false;
			vmdebug('PAYBOX getSubscriptionData BY PRODUCT', $subscribe);
		}
		// Montant total de l’achat en centimes sans virgule ni point.
		vmdebug('PAYBOX getSubscriptionData TOTAL', $subscribe);

		return $subscribe;
	}
	function getProdCustomFields($virtuemart_product_id) {
		$product = new stdClass();
		$product->virtuemart_product_id = $virtuemart_product_id;
		$customfields = VmModel::getModel('Customfields');
		$product_customfields = $customfields->getProductCustomsField($product);
		return $product_customfields;
	}
	function getProductAmount($productPricesUnformatted) {
		if ($productPricesUnformatted['salesPriceWithDiscount']) {
			return $productPricesUnformatted['salesPriceWithDiscount'];
		} else {
			return $productPricesUnformatted['salesPrice'];
		}
	}
}