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
defined('JPATH_BASE') or die();

/**
 * Renders a label element
 */


class JElementGetRealex extends JElement {

	/**
	 * Element name
	 *
	 * @access    protected
	 * @var        string
	 */
	var $_name = 'getRealex';

	function fetchElement ($name, $value, &$node, $control_name) {


		$url = "http://www.realexpayments.com/";
		$logo = '<img src="http://www.realexpayments.com/images/logo_realex_large.png" width="150"/>';
		$html = '<a target="_blank" href="' . $url . '" id="klarna_getrealex_link" ">' . $logo . '</a><br />';
		$html .= '<a target="_blank" href="' . $url . '" id="klarna_getrealex_link" ">' . vmText::_('VMPAYMENT_REALEX_HPP_API_REGISTER') . '</a>';

		return $html;
	}

}