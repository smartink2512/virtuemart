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
$('" . $viewData['addressbook_billto_shipto'] . "').hide();
$('" . $viewData['loginform'] . "').hide();
$('#leave_amazon').click(function(){
	var url =  vmSiteurl + 'index.php?option=com_virtuemart&view=plugin&type=vmpayment&name=amazon&action=leaveAmazon&virtuemart_paymentmethod_id=" . $viewData['virtuemart_paymentmethod_id'] . "' ;
    console.log('leaveAmazon'  );
    jQuery.getJSON(url);
         var reloadurl = vmSiteurl + 'index.php?option=com_virtuemart&view=cart' + vmLang;
         window.location.href = reloadurl;
	});
});
//]]>
");
		$doc->addScriptDeclaration("
		//<![CDATA[
	jQuery(document).ready( function($) {
		$('" . $viewData['paymentForm'] . "').hide();
		//$('" . $viewData['loginform'] . "').hide();
	});
	//]]>
");

}

?>

<?php
if (false) {

	if ($viewData['renderAddressBook']) {
		?>
		<h2><?php echo vmText::_('VMPAYMENT_AMAZON_SELECT_ADDRESS') ?></h2>

		<!-- AddressbookWidget -->
		<div id='amazonAddressBookWidgetDiv'></div>
		<div id="amazonAddressBookErrorMsg" class="error"></div>
	<?php
	}
	?>

	<h2><?php echo vmText::_('VMPAYMENT_AMAZON_SELECT_PAYMENT') ?></h2>

	<!-- WalletWidget -->
	<span id='amazonWalletWidgetDiv'></span>
	<div id="amazonWalletErrorMsg" class="error"></div>

<?php
}
?>


