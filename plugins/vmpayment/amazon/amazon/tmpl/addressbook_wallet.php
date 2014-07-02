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

$doc = JFactory::getDocument();
//$doc->addScript(JURI::root(true).'/plugins/vmpayment/amazon/amazon/assets/js/site.js');
vmJsApi::js('plugins/vmpayment/amazon/amazon/assets/js/site', '');
$doc->addScriptDeclaration("
jQuery(document).ready( function($) {
	amazonShowAddress('" . $viewData['sellerId'] . "','" . $viewData['amazonOrderReferenceId'] . "', '" . $viewData['addressbook_designWidth'] . "', '" . $viewData['addressbook_designHeight'] . "');
	amazonShowWallet('" . $viewData['sellerId'] . "','" . $viewData['amazonOrderReferenceId'] . "', '" . $viewData['wallet_designWidth'] . "', '" . $viewData['wallet_designHeight'] . "');
});

"); // addScriptDeclaration

?>
<h2><?php echo vmText::_('VMPAYMENT_AMAZON_SELECT_ADDRESS') ?></h2>
<?php if ($viewData['renderAddressBook']) { ?>
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


<a class="vm-button-correct"
   href="<?php echo $viewData['redirect_page'] ?>"><?php echo vmText::_('VMPAYMENT_AMAZON_BACK_TO_CART') ?></a>


