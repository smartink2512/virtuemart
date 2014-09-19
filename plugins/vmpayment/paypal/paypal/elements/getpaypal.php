<?php
/**
 *
 * Realex payment plugin
 *
 * @author Valerie Isaksen
 * @version $Id: getrealex.php 8206 2014-08-14 13:52:35Z alatak $
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
defined('JPATH_BASE') or die();

/**
 * Renders a label element
 */


class JElementGetPaypal extends JElement {

	/**
	 * Element name
	 *
	 * @access    protected
	 * @var        string
	 */
	var $_name = 'getPaypal';

	function fetchElement ($name, $value, &$node, $control_name) {


		$url = "https://www.paypal.com/us/webapps/mpp/referral/paypal-payments-standard?partner_id=83EP5DJG9FU6L";
		$logo = '<img src="https://www.paypalobjects.com/webstatic/en_US/logo/pp_cc_mark_111x69.png" />';
		$html = '<p><a target="_blank" href="' . $url . '"  >' . $logo . '</a></p>';
		$html .= '<p><a target="_blank" href="' . $url . '" class="signin-button-link">' . vmText::_('VMPAYMENT_PAYPAL_REGISTER') . '</a>';
		$html .= ' <a target="_blank" href="http://docs.virtuemart.net/manual/shop-menu/payment-methods/paypal.html" class="signin-button-link">' . vmText::_('VMPAYMENT_PAYPAL_DOCUMENTATION') . '</a></p>';

		return $html;
	}

}