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



var  amazonPayment = {

        showAmazonButton: function (sellerId, redirect_page, useAmazonAddressBook) {

            console.log("amazonShowButton called");

            new OffAmazonPayments.Widgets.Button({
                sellerId: sellerId,
                useAmazonAddressBook: useAmazonAddressBook,
                onSignIn: function (orderReference) {
                    var amazonOrderReferenceId = orderReference.getAmazonOrderReferenceId();
                    window.location = redirect_page + '&session=' + amazonOrderReferenceId;
                    console.log('onSignIn() ' + amazonOrderReferenceId);

                },
                onError: function (error) {
                    console.log('Amazon onSignIn()' + error);
                    alert('AMAZON onSignIn(): ' + error.getErrorCode() + ": " + error.getErrorMessage());
                }
            }).bind('payWithAmazonDiv');

        },


        showAmazonAddress: function (sellerId, amazonOrderReferenceId, width, height, isMobile, virtuemart_paymentmethod_id, displayMode) {

            console.log("amazonShowAddress: " + amazonOrderReferenceId);
            new OffAmazonPayments.Widgets.AddressBook({
                sellerId: sellerId,
                amazonOrderReferenceId: amazonOrderReferenceId,  // amazonOrderReferenceId obtained from Button widget
                onAddressSelect: function (orderReference) {
                    var url =  vmSiteurl + 'index.php?option=com_virtuemart&view=plugin&type=vmpayment&name=amazon&action=updateCartWithAmazonAddress&virtuemart_paymentmethod_id=' + virtuemart_paymentmethod_id  + vmLang;
                    jQuery.getJSON(url,
                        function(datas, textStatus) {
                            var errormsg='';
                            console.log('json return:' + datas.reload + ' ' + textStatus);
                            if (datas.reload === 'addressUpdated') {
                                var reloadurl = vmSiteurl + 'index.php?option=com_virtuemart&view=cart&task=checkout' + vmLang;
                                window.location.href = reloadurl;
                            } else if (datas.reload === 'deliveryCountryNotAllowed') {
                                errormsg= datas.errormsg;
                            }
                            document.id('amazonErrorDiv').set('html', errormsg);
                        }
                    );

                },
                displayMode: displayMode,
                design: {
                    size: {width: width, height: height}
                },
                onError: function (error) {
                    amazonPayment.onErrorAmazon('amazonShowAddress', error, virtuemart_paymentmethod_id );
                    //console.log('amazonShowAddress' + error);
                    //alert('amazonShowAddress: ' + error.getErrorCode() + ": " + error.getErrorMessage());
                },
            }).bind("amazonAddressBookWidgetDiv");

        },


        selectShipment: function (virtuemart_paymentmethod_id) {
            var url = vmSiteurl+'index.php?option=com_virtuemart&view=cart&format=json&layout=amazon' + vmLang;
            var reloadurl = vmSiteurl+'index.php?option=com_virtuemart&view=cart&layout=amazon' + vmLang;

            jQuery.ajax({
                url: url,
                type: 'POST', // Notice
                headers: {
                    "cache-control": "no-cache"
                },
                data: JSON.stringify(),
                dataType: 'json',
                contentType: 'application/json; charset=UTF-8',

            }).done(function (data) {
                    //document.id('amazonShipmentsDiv').set('html', '');
                    console.log('selectShipment DONE' );
                    var shipments = "";
                    if (data.shipments) {
                        shipments = '<h2>Select Shipment xxxx</h2>';
                        console.log('selectShipment:' + data.shipments.length);
                        for (var i = 0; i < data.shipments.length; i++) {
                            shipments += '<div>' + data.shipments[i].toString() + '</div>';
                        }
                        //$('#amazonShipmentsDiv').html(shipments);
                        document.id('amazonShipmentsDiv').set('html',shipments);
                    }
                });

        },

        onErrorAmazon: function (from, error, virtuemart_paymentmethod_id) {
            var sessionExpired = "BuyerSessionExpired";
            if (error.getErrorCode() === "BuyerSessionExpired") {
                var url =  vmSiteurl +'index.php?option=com_virtuemart&view=plugin&type=vmpayment&name=amazon&action=resetAmazonReferenceId&virtuemart_paymentmethod_id=' + virtuemart_paymentmethod_id + vmLang;
                console.log(from);
                jQuery.getJSON(url);
                var reloadurl = vmSiteurl + 'index.php?option=com_virtuemart&view=cart' + vmLang;
                window.location.href = reloadurl;
            }
            alert(from + error.getErrorCode() + ": " + error.getErrorMessage());
        },


        showAmazonWallet: function (sellerId, amazonOrderReferenceId, width, height, isMobile, virtuemart_paymentmethod_id, displayMode) {
            window.onError = null;

            console.log("amazonShowWallet: " + amazonOrderReferenceId);
            new OffAmazonPayments.Widgets.Wallet({
                sellerId: sellerId,
                amazonOrderReferenceId: amazonOrderReferenceId,  // amazonOrderReferenceId obtained from Button widget
                displayMode: displayMode,
                design: {
                    size: {width: width, height: height}
                },
                onPaymentSelect: function (orderReference) {
                },
                onError: function (error) {
                    amazonPayment.onErrorAmazon('showAmazonWallet', error);
                    //console.log('showAmazonWallet' + error);
                    //alert('showAmazonWallet: ' + error.getErrorCode() + ": " + error.getErrorMessage());
                },
            }).bind("amazonWalletWidgetDiv");

        }

    }
    ;



