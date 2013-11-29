<?php
/**
 *
 * Paypal payment plugin
 *
 * @author Valérie Isaksen
 * @version $Id: paypal.php 7217 2013-09-18 13:42:54Z alatak $
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


defined ('_JEXEC') or die();

class JElementCredentials extends JElement {

	/**
	 * Element name
	 *
	 * @access    protected
	 * @var        string
	 */
	var $_name = 'Credentials';

	function fetchElement ($name, $value, &$node, $control_name) {
		
		$class = ($node->attributes('class') ? $node->attributes('class') : '');


       $html="<div class=\"get_paypal_credentials\">
<a   href=\"javascript:window.open('Waiting for Paypal for the link', '','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, ,left=100, top=100, width=380, height=470'); return false;\" >
".Jtext::_('VMPAYMENT_PAYPAL_GET_CREDENTIALS')."</a></div>";

        $html.="<div class=\"get_sandbox_credentials\">
<a title=\"".Jtext::_('VMPAYMENT_PAYPAL_SANDBOX_DEVELOPER')."\" class=\"get_sandbox_credentials\" href=\"javascript:window.open('https://www.paypal.com/webapps/auth/loginauth?execution=e1s1', '','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, ,left=100, top=100, width=380, height=470'); return false;\" >
".Jtext::_('VMPAYMENT_PAYPAL_GET_SANDBOX_CREDENTIALS')."</a></div>";


		return $html;		
	}

}