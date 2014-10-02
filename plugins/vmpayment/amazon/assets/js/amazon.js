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



var amazonPayment = {

        showAmazonButton: function (sellerId, redirect_page, useAmazonAddressBook) {
//    window.onError = null;  // some of the amazon scripts can load in error handlers to report back errors to amazon.  helps them, but keeps you in the dark.
            console.log("amazonShowButton called: useAmazonAddressBook=" + useAmazonAddressBook);

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

        initPayment: function (sellerId, amazonOrderReferenceId, width, height, isMobile, virtuemart_paymentmethod_id, displayMode) {
            amazonPayment.sellerId = sellerId;
            amazonPayment.amazonOrderReferenceId = amazonOrderReferenceId;
            amazonPayment.width = width;
            amazonPayment.height = height;
            amazonPayment.isMobile = isMobile;
            amazonPayment.virtuemart_paymentmethod_id = virtuemart_paymentmethod_id;
            amazonPayment.displayMode = displayMode;
        },

        showAmazonWallet: function () {
            window.onError = null;
            console.log("amazonShowWallet: " + amazonPayment.amazonOrderReferenceId);
            new OffAmazonPayments.Widgets.Wallet({
                sellerId: amazonPayment.sellerId,
                amazonOrderReferenceId: amazonPayment.amazonOrderReferenceId,  // amazonOrderReferenceId obtained from Button widget
                displayMode: amazonPayment.displayMode,
                design: {
                    size: {width: amazonPayment.width, height: amazonPayment.height}
                },
                onPaymentSelect: function (orderReference) {
                    haveWallet = true;
                },
                onError: function (error) {
                    amazonPayment.onErrorAmazon('amazonShowWallet', error);
                }
            }).bind("amazonWalletWidgetDiv");

        },

        showAmazonAddress: function () {
            console.log("amazonShowAddress: " + amazonPayment.amazonOrderReferenceId);
            new OffAmazonPayments.Widgets.AddressBook({
                sellerId: amazonPayment.sellerId,
                amazonOrderReferenceId: amazonPayment.amazonOrderReferenceId,  // amazonOrderReferenceId obtained from Button widget
                onAddressSelect: function (orderReference) {
                    var url = vmSiteurl + 'index.php?option=com_virtuemart&view=plugin&type=vmpayment&name=amazon&action=updateCartWithAmazonAddress&virtuemart_paymentmethod_id=' + amazonPayment.virtuemart_paymentmethod_id + vmLang;
                    //document.id('amazonShipmentNotFoundDiv').set('html', '');
                    amazonPayment.startLoading();
                    jQuery.getJSON(url,
                        function (datas, textStatus) {
                            var errormsg = '';
                            var checkoutFormSubmit = document.getElementById("checkoutFormSubmit");
                            checkoutFormSubmit.className = 'vm-button-correct';
                            checkoutFormSubmit.removeAttribute('disabled');
                            amazonPayment.updateCart();
                            amazonPayment.showAmazonWallet();
                            if (typeof datas.error_msg != 'undefined' && datas.error_msg != '') {
                                errormsg = datas.error_msg;
                                checkoutFormSubmit.className = 'vm-button';
                                checkoutFormSubmit.setAttribute('disabled', 'true');
                                document.id('amazonShipmentsDiv').style.display = 'none';
                                amazonPayment.stopLoading();
                            }
                            document.id('amazonErrorDiv').set('html', errormsg);
                        }
                    );
                    amazonPayment.stopLoading();

                },
                displayMode: amazonPayment.displayMode,
                design: {
                    size: {width:amazonPayment.width, height: amazonPayment.height}
                },
                onError: function (error) {
                    amazonPayment.onErrorAmazon('amazonShowAddress', error, amazonPayment.virtuemart_paymentmethod_id);
                }
            }).bind("amazonAddressBookWidgetDiv");

        },

        startLoading: function () {
            var amazonLoading = vmSiteurl + '/components/com_virtuemart/assets/images/facebox/loading.gif';
            document.id('amazonLoading').position('center');
            document.id('amazonLoading').setStyle('z-index', '200');
            document.id('amazonCartDiv').setStyle('opacity', 0.75);
            document.id('amazonLoading').set('html', '<img src="' + amazonLoading + '">');
        },

        stopLoading: function () {
            document.id('amazonLoading').set('html', '');
            document.id('amazonCartDiv').setStyle('opacity', 1);
        },

        onAmazonAddressSelect: function () {
            console.log('onAddressSelect');
            amazonPayment.updateCartWithAmazonAddress();
        },



        updateCart: function () {
            var url = vmSiteurl + 'index.php?option=com_virtuemart&nosef=1&view=cart&task=updateCartJS&virtuemart_paymentmethod_id=' + amazonPayment.virtuemart_paymentmethod_id + vmLang;
            jQuery.getJSON(url,
                function (datas, textStatus) {
                    var cartview = "";
                    console.log('updateCart:' + datas.msg.length);
                    if (datas.msg) {
                        datas.msg = datas.msg.replace('amazonHeader', 'amazonHeaderHide');
                        datas.msg = datas.msg.replace('amazonShipmentNotFoundDiv', 'amazonShipmentNotFoundDivHide');
                        for (var i = 0; i < datas.msg.length; i++) {
                            cartview += datas.msg[i].toString();
                        }
                        document.id('amazonCartDiv').set('html', cartview);
                        document.id('amazonHeaderHide').set('html', '');
                        document.id('amazonShipmentNotFoundDivHide').set('html', '');
                        amazonPayment.stopLoading();
                    }

                }
            );
        },

        onErrorAmazon: function (from, error) {
            console.log('onErrorAmazon:' + from +' '+ error.getErrorCode());
            var sessionExpired = "BuyerSessionExpired";
            if (error.getErrorCode() == sessionExpired) {
                var url = vmSiteurl + 'index.php?option=com_virtuemart&view=plugin&type=vmpayment&name=amazon&action=resetAmazonReferenceId&virtuemart_paymentmethod_id=' + amazonPayment.virtuemart_paymentmethod_id;
                console.log('resetAmazonReferenceId');
                jQuery.getJSON(url, function (data) {
                    var reloadurl = 'index.php?option=com_virtuemart&view=cart';
                    window.location.href = reloadurl;
                });

            }
        },

        /**
         * used in cart_shipment tmpl
         */
        setShipmentReloadWallet: function() {
            amazonPayment.startLoading();
            var virtuemart_shipmentmethod_ids = document.getElementsByName('virtuemart_shipmentmethod_id');
            var virtuemart_shipmentmethod_id = '';

            for (var i = 0, length = virtuemart_shipmentmethod_ids.length; i < length; i++) {
                if (virtuemart_shipmentmethod_ids[i].checked) {
                    virtuemart_shipmentmethod_id = virtuemart_shipmentmethod_ids[i].value;
                    break;
                }
            }
            var url = vmSiteurl + 'index.php?option=com_virtuemart&nosef=1&view=cart&task=updatecartJS&virtuemart_shipmentmethod_id=' + virtuemart_shipmentmethod_id + vmLang;
            jQuery.getJSON(url,
                function (datas, textStatus) {
                    var cartview = '';
                    console.log('updateCart:' + datas.msg.length);
                    if (datas.msg) {
                        datas.msg = datas.msg.replace('amazonHeader', 'amazonHeaderHide');
                        for (var i = 0; i < datas.msg.length; i++) {
                            cartview += datas.msg[i].toString();
                        }
                        document.id('amazonCartDiv').set('html', cartview);
                        document.id('amazonHeaderHide').set('html', '');
                        amazonPayment.stopLoading();
                        amazonPayment.showAmazonWallet();
                    }
                }
            );
        },

        /**
         * used in addressbook_wallet tmpl
         * @param warning
         */
        displayCaptureNowWarning: function(warning) {
            document.id('amazonChargeNowWarning').set('html',warning);
        },

        leaveAmazonCheckout: function() {
            var url =  vmSiteurl + 'index.php?option=com_virtuemart&view=plugin&type=vmpayment&name=amazon&action=leaveAmazonCheckout&virtuemart_paymentmethod_id=' + amazonPayment.virtuemart_paymentmethod_id + vmLang ;
            console.log('leaveAmazonCheckout');
            jQuery.getJSON(url, function(data) {
                var reloadurl = vmSiteurl +'index.php?option=com_virtuemart&view=cart' + vmLang;
                window.location.href = reloadurl;
            });

        }
    }
    ;




