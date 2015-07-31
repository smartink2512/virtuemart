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

class KlarnaCheckoutHelperKCO_rest_php extends KlarnaCheckoutHelperKlarnaCheckout {
	var $_currentMethod;

	function __construct($method) {
		$this->_currentMethod = $method;
	}

	function getSnippet($klarna_checkout_order) {

		return $klarna_checkout_order['html_snippet'];
	}

	function getKlarnaUrl() {
// this one is for europe
		// todo Check If North America
		if ($this->_currentMethod->server == 'beta') {
			\Klarna\Rest\Transport\ConnectorInterface::EU_TEST_BASE_URL;
		} else {
			\Klarna\Rest\Transport\ConnectorInterface::EU_BASE_URL;
		}
	}

	function getKlarnaConnector() {
		return \Klarna\Rest\Transport\Connector::create(
			$this->_currentMethod->merchantid,
			$this->_currentMethod->sharedsecret,
			$this->getKlarnaUrl()
		);

	}

	function checkoutOrder($klarna_checkout_connector, $klarna_checkout_uri) {
		return new Klarna\Rest\Checkout\Order($klarna_checkout_connector, $klarna_checkout_uri);

	}

	function getCartItems($cart) {

	}


	/**
	 * You must now send a request to Klarna saying that you've acknowledged the order.
	 *
	 * Note: Klarna will send the push notifications every two hours for a total of 48 hours or until you confirm that you have received the order.
	 * @param $klarna_checkout_order
	 */
	function acknowledge($klarna_checkout_order) {
		$klarna_checkout_order->acknowledge();

	}
}
