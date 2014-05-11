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
$doc->addScriptDeclaration("
//<![CDATA[

jQuery(document).ready( function($) {
$( '.output-shipto-add' ).hide();
$( '.output-shipto' ).html('<span id=\"readOnlyAddressBookWidgetDiv\"></span>');


new OffAmazonPayments.Widgets.AddressBook({
sellerId: '".$viewData['sellerId']."',
  amazonOrderReferenceId: '".$viewData['amazonOrderReferenceId'] ."',
// amazonOrderReferenceId obtained from Button widget
displayMode: \"Read\",
design: {
size : {width:'".$viewData['ro_addressbook_designWidth']."px', height:'".$viewData['ro_addressbook_designHeight']."px'}
},
onError: function(error) {
// your error handling code
}
}).bind(\"readOnlyAddressBookWidgetDiv\");

new OffAmazonPayments.Widgets.Wallet({
	 sellerId: '".$viewData['sellerId']."',
	  amazonOrderReferenceId: '".$viewData['amazonOrderReferenceId'] ."',
	// amazonOrderReferenceId obtained from Button widget
	displayMode: \"Read\",
	design: {
	size : {width:'".$viewData['ro_wallet_designWidth']."px', height:'".$viewData['ro_wallet_designHeight']."px'}
	},
	onError: function(error) {
	// your error handling code
	}
	}).bind(\"readOnlyWalletWidgetDiv\");

});
//]]>
");

?>

<span id="readOnlyWalletWidgetDiv"></span>


