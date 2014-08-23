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
static $jsAWLoaded = false;
$doc = JFactory::getDocument();
vmJsApi::jPrice();
jimport('joomla.environment.browser');
$browser = JBrowser::getInstance();
$isMobile = $browser->isMobile();
if ($isMobile) {
	$doc->setMetaData('viewport', "width=device-width, initial-scale=1, maximum-scale=1");
}
if (!$jsAWLoaded) {
	$doc->addScript(JURI::root(true) . '/plugins/vmpayment/amazon/amazon/assets/js/amazon.js');
	$doc->addStyleSheet(JURI::root(true) . '/plugins/vmpayment/amazon/amazon/assets/css/amazon.css');

//vmJsApi::js('plugins/vmpayment/amazon/amazon/assets/js/site', '');

	if ($viewData['renderAddressBook']) {
		$doc->addScriptDeclaration("
		//<![CDATA[
jQuery(document).ready( function($) {
	amazonPayment.showAmazonAddress('" . $viewData['sellerId'] . "','" . $viewData['amazonOrderReferenceId'] . "', '" . $viewData['addressbook_designWidth'] . "', '" . $viewData['addressbook_designHeight'] . "', '" . $isMobile . "', '" . $viewData['virtuemart_paymentmethod_id'] . "', '" . $viewData['readOnlyWidgets'] . "');
});
//]]>
"); // addScriptDeclaration
	}
	if ($viewData['renderWalletBook']) {
		$doc->addScriptDeclaration("
		//<![CDATA[
jQuery(document).ready( function($) {
	amazonPayment.showAmazonWallet('" . $viewData['sellerId'] . "','" . $viewData['amazonOrderReferenceId'] . "', '" . $viewData['wallet_designWidth'] . "', '" . $viewData['wallet_designHeight'] . "', '" . $isMobile . "', '" . $viewData['virtuemart_paymentmethod_id'] . "', '" . $viewData['readOnlyWidgets'] . "');
});
//]]>
"); // addScriptDeclaration
	}

	$doc->addScriptDeclaration("
	//<![CDATA[
jQuery(document).ready( function($) {
$('#leaveAmazonCheckout').click(function(){
	var url =  vmSiteurl + 'index.php?option=com_virtuemart&view=plugin&type=vmpayment&name=amazon&action=leaveAmazonCheckout&virtuemart_paymentmethod_id=" . $viewData['virtuemart_paymentmethod_id'] . "' ;
    console.log('leaveAmazonCheckout');
    jQuery.getJSON(url, function(data) {
            var reloadurl = 'index.php?option=com_virtuemart&view=cart';
         window.location.href = reloadurl;
        });

	});
});
//]]>
");

}

?>




