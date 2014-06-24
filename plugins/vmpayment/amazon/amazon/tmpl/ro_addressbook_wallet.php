<?php
defined ('_JEXEC') or die();

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
$doc = JFactory::getDocument();
vmJsApi::js('plugins/vmpayment/amazon/amazon/assets/js/site', '');
$doc->addScriptDeclaration("
jQuery(document).ready( function($) {
	amazonShowRoAddress('".$viewData['sellerId']."','".$viewData['amazonOrderReferenceId']."', '".$viewData['ro_addressbook_designWidth']."', '".$viewData['ro_addressbook_designHeight']."');
	amazonShowRoWallet('".$viewData['sellerId']."','".$viewData['amazonOrderReferenceId']."', '".$viewData['ro_wallet_designWidth']."', '".$viewData['ro_wallet_designHeight']."');

	$( '#".$viewData['ro_addressbook_output_shipto_add_id']."' ).hide();
	$( '#".$viewData['ro_addressbook_output_shipto_id']."' ).html('<div id=\"amazonRoAddressBookDiv\"><div id=\"amazonRoWalletEditDiv\"></div><a href=\"".$viewData['redirect_page']."\">".vmText::_('VMPAYMENT_AMAZON_EDIT')."</a><div id=\"amazonRoAddressBookWidgetDiv\"></div></div>');
});

");

?>
<div id="amazonRoWalletDiv">
	<span id="amazonRoWalletEditDiv">
		<a href="<?php echo $viewData['redirect_page'] ?>"><?php echo vmText::_('VMPAYMENT_AMAZON_EDIT')?></a>
	</span>
	<span id="amazonRoWalletWidgetDiv"></span>
</div>



