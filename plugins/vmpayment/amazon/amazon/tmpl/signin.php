<?php
defined('_JEXEC') or die();

/**
 * @author Valérie Isaksen
 * @version $Id$
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
	$doc = JFactory::getDocument();
	$signInButton = '<div id=\"amazonSignInButton\"><div id=\"payWithAmazonDiv\" class=\"hasTip\" title=\"::' . vmText::_('VMPAYMENT_AMAZON_SIGNIN_TIP') . '\"><img src=\"' . $viewData['buttonWidgetImageURL'] . '\" style=\"cursor: pointer;\"/></div><div id=\"amazonSignInErrorMsg\" class=\"error\"></div></div>';
	$signInButton = '<div id=\"amazonSignInButton\"><div id=\"payWithAmazonDiv\"  \"><img src=\"' . $viewData['buttonWidgetImageURL'] . '\" style=\"cursor: pointer;\"/></div><div id=\"amazonSignInErrorMsg\" class=\"error\"></div></div>';

//vmJsApi::js('plugins/vmpayment/amazon/amazon/assets/js/site', '');
	$doc->addScript(JURI::root(true) . '/plugins/vmpayment/amazon/amazon/assets/js/amazon.js');
	$doc->addStyleSheet(JURI::root(true) . '/plugins/vmpayment/amazon/amazon/assets/css/amazon.css');

	$renderAmazonAddressBook = $viewData['renderAmazonAddressBook'] ? 'true' : 'false';

	$doc->addScriptDeclaration("
	//<![CDATA[
jQuery(document).ready( function($) {
	amazonPayment.showAmazonButton('" . $viewData['sellerId'] . "', '" . $viewData['redirect_page'] . "', " . $renderAmazonAddressBook . ");
	$( '" . $viewData['sign_in_css'] . "' ).before('" . $signInButton . "');

});
//]]>
");
	if ( $viewData['layout'] == 'amazon') {
		$doc->addScriptDeclaration("
		//<![CDATA[
	jQuery(document).ready( function($) {
		$('" . $viewData['addressbook_billto_shipto'] . "').hide();
		$('" . $viewData['loginform'] . "').hide();
		$('" . $viewData['paymentForm'] . "').hide();
	});
	//]]>
");
	}

	$doc->addScriptDeclaration("
	//<![CDATA[
jQuery(document).ready( function($) {
$('#leave_amazon').click(function($){
	var url =  vmSiteurl + 'index.php?option=com_virtuemart&view=plugin&type=vmpayment&name=amazon&action=leaveAmazon&virtuemart_paymentmethod_id=" . $viewData['virtuemart_paymentmethod_id'] . "' ;
    console.log('leaveAmazon');
    jQuery.getJSON(url);
         var reloadurl = 'index.php?option=com_virtuemart&view=cart';
         window.location.href = reloadurl;
	});
});
//]]>
");
}
?>
