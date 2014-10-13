<?php
defined('_JEXEC') or die();

/**
 * @author Valérie Isaksen
 * @version $Id: signin.php 8272 2014-09-04 19:57:55Z alatak $
 * @package VirtueMart
 * @subpackage vmpayment
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
?>
<?php
JHtml::_('behavior.tooltip');
vmJsApi::jPrice();
static $jsSILoaded = false;
if (!$jsSILoaded) {
	$signInButton = '<div id=\"amazonSignInButton\"><div id=\"payWithAmazonDiv\" class=\"hasTip\" title=\"::' . addslashes(vmText::_('VMPAYMENT_AMAZON_SIGNIN_TIP')) . '\"><img src=\"' . $viewData['buttonWidgetImageURL'] . '\" style=\"cursor: pointer;\"/></div><div id=\"amazonSignInErrorMsg\" class=\"error\"></div></div>';

	vmJsApi::addJScript(  '/plugins/vmpayment/amazon/amazon/assets/js/amazon.js');
	if ($viewData['include_amazon_css']) {
		vmJsApi::css(  'amazon','plugins/vmpayment/amazon/amazon/assets/css/');
	}
	$renderAmazonAddressBook = $viewData['renderAmazonAddressBook'] ? 'true' : 'false';

	vmJsApi::addJScript('vm.showAmazonButton',"
	//<![CDATA[
jQuery(document).ready( function($) {
	amazonPayment.showAmazonButton('" . $viewData['sellerId'] . "', '" . $viewData['redirect_page'] . "', " . $renderAmazonAddressBook . ");
	$( '" . $viewData['sign_in_css'] . "' ).append('" . $signInButton . "');

});
//]]>
");
	if ($viewData['layout'] == 'cart') {

		vmJsApi::addJScript('vm.leaveAmazonCheckout',"
	//<![CDATA[
jQuery(document).ready( function($) {
$('#leaveAmazonCheckout').click(function(){
	amazonPayment.leaveAmazonCheckout();
	});
});
//]]>
");


if (vRequest::getWord('view') == 'cart') {
	vmJsApi::addJScript('vm.amazonSubmit',"

//<![CDATA[
	jQuery(document).ready(function($) {
	jQuery('#checkoutFormSubmit').attr('disabled', 'true');
	jQuery('#checkoutFormSubmit').removeClass( 'vm-button-correct' );
	jQuery('#checkoutFormSubmit').addClass( 'vm-button' );
	jQuery('#checkoutFormSubmit').text( '".JText::_('VMPAYMENT_AMAZON_CLICK_PAY_AMAZON', true)."' );
	});

//]]>

");
}


	}
}
?>
