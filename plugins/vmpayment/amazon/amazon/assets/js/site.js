/**
 *
 * Amazon payment plugin
 *
 * @author Valérie Isaksen
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


//jQuery().ready(function ($) {

var haveAddress = false;
var haveWallet = false;

function amazonShowButton(sellerId, redirect_page) {
//    window.onError = null;  // some of the amazon scripts can load in error handlers to report back errors to amazon.  helps them, but keeps you in the dark.

    console.log("amazonShowButton called");

    new OffAmazonPayments.Widgets.Button({
        sellerId: sellerId,
        useAmazonAddressBook: true,
        onSignIn: function (orderReference) {
            var amazonOrderReferenceId = orderReference.getAmazonOrderReferenceId();
            window.location = redirect_page + '&session=' + amazonOrderReferenceId;
            console.log('onSignIn()');
            console.log(amazonOrderReferenceId);

        },
        onError: function (error) {
            console.log('Amazon.onError' + error);
            alert(error);
        }
    }).bind('payWithAmazonDiv');

}


function isValidCountry() {
    return true;
}


function amazonShowAddress(sellerId, amazonOrderReferenceId, width, height, onAddressSelect) {

    console.log("amazonShowAddress: " + amazonOrderReferenceId);
    new OffAmazonPayments.Widgets.AddressBook({
        sellerId: sellerId,
        amazonOrderReferenceId: amazonOrderReferenceId,  // amazonOrderReferenceId obtained from Button widget
        onAddressSelect: onAddressSelect,
        design: {
            size: {width: width, height: height}
        },
        onError: function (error) {
            haveAddress = false;
            console.log('error amazonShowAddress:');
        }
    }).bind("amazonAddressBookWidgetDiv");

}

function onAddressSelect() {
    new Ajax.Request('getShipment', {
        method: "post",
        evalScripts: true,
        onSuccess: APA.successCallback,
        onFailure: APA.ajaxFailureCallback
    })

}

function amazonShowWallet(sellerId, amazonOrderReferenceId, width, height) {
    window.onError = null;

    console.log("amazonShowWallet: " + amazonOrderReferenceId);
    //noinspection JSUnusedGlobalSymbols
    new OffAmazonPayments.Widgets.Wallet({
        sellerId: sellerId,
        amazonOrderReferenceId: amazonOrderReferenceId,  // amazonOrderReferenceId obtained from Button widget
        // amazonOrderReferenceId obtained from Button widget
        design: {
            size: {width: width, height: height}
        },
        onPaymentSelect: function (orderReference) {
            //updateCartWithAmazonInformation();
            haveWallet = true;
            //showFinalizeButton();
        },
        onError: function (error) {
            console.log(error);
        }
    }).bind("amazonWalletWidgetDiv");

}

function amazonShowRoAddress(sellerId, amazonOrderReferenceId, width, height) {
    console.log("amazonShowRoAddress: " + amazonOrderReferenceId);
    new OffAmazonPayments.Widgets.AddressBook({
        sellerId: sellerId,
        amazonOrderReferenceId: amazonOrderReferenceId,  // amazonOrderReferenceId obtained from Button widget
        displayMode: "Read",
        design: {
            size: {width: width, height: height}
        },
        onError: function (error) {
            haveAddress = false;
            console.log('error on ');
        }
    }).bind("amazonRoAddressBookWidgetDiv");

}
function amazonShowRoWallet(sellerId, amazonOrderReferenceId, width, height) {
    console.log("amazonShowRoWallet: " + amazonOrderReferenceId);
    new OffAmazonPayments.Widgets.Wallet({
        sellerId: sellerId,
        amazonOrderReferenceId: amazonOrderReferenceId,  // amazonOrderReferenceId obtained from Button widget
        displayMode: "Read",
        design: {
            size: {width: width, height: height}
        },
        onError: function (error) {
            haveWallet = false;
            console.log(error);
        }
    }).bind("amazonRoWalletWidgetDiv");

}

//});