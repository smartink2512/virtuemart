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
//    window.onError = null;  // some of the amazon scripts can load in error handlers to report back errors to amazon.  helps them, but keeps you in the dark.

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
                    amazonPayment.amazonLoading();
                    jQuery.getJSON(url,
                        function(datas, textStatus) {
                            var errormsg='';
                            var checkoutFormSubmit = document.getElementById("checkoutFormSubmit");
                            checkoutFormSubmit.className = 'vm-button-correct';
                            checkoutFormSubmit.removeAttribute('disabled');
                            console.log('json return:' + datas.reload + ' ' + textStatus);
                            if (datas.reload === 'addressUpdated' ) {
                                console.log('get cart updated' );
                                amazonPayment.updateCart(virtuemart_paymentmethod_id);
                            }
                            if (typeof datas.error_msg != 'undefined' && datas.error_msg != '') {
                                errormsg= datas.error_msg;
                                //document.id('amazonErrorDiv').set('amazonShipmentsDiv', '');
                                //document.id('checkoutFormSubmit').set('amazonShipmentsDiv', '');
                                checkoutFormSubmit.className = 'vm-button';
                                checkoutFormSubmit.setAttribute('disabled', 'true');
                                document.id('amazonShipmentsDiv').style.display = 'none';
                                amazonPayment.amazonStopLoading();
                            }
                            document.id('amazonErrorDiv').set('html', errormsg);
                            if (datas.reload === 'sameAddress') {
                                amazonPayment.amazonStopLoading();
                            }
                            //amazonPayment.amazonStopLoading();
                        }
                    );

                },
                displayMode: displayMode,
                design: {
                    size: {width: width, height: height}
                },
                onError: function (error) {
                    amazonPayment.onErrorAmazon('amazonShowAddress', error, virtuemart_paymentmethod_id);
                    //console.log('amazonShowAddress' + error);
                    //alert('amazonShowAddress: ' + error.getErrorCode() + ": " + error.getErrorMessage());
                },
            }).bind("amazonAddressBookWidgetDiv");

        },

        amazonLoading: function () {
            var amazonLoading= vmSiteurl + 'plugins/vmpayment/amazon/amazon/assets/images/loader.gif';
            //document.id('amazonLoading').setStyle('height',Math.max( document.body.scrollHeight, document.body.offsetHeight,document.documentElement.clientHeight, document.documentElement.scrollHeight, document.documentElement.offsetHeight ));
            document.id('amazonLoading').position('center');
            document.id('amazonLoading').setStyle('z-index', '200');
            document.id('amazonCartDiv').setStyle('opacity', 0.75);
            document.id('amazonLoading').set('html', '<img src="' + amazonLoading + '">');
        },

        amazonStopLoading: function () {
            document.id('amazonLoading').set('html', '');
            document.id('amazonCartDiv').setStyle('opacity', 1);
        },

        onAmazonAddressSelect: function (virtuemart_paymentmethod_id) {
            console.log('onAddressSelect');
            amazonPayment.updateCartWithAmazonAddress(virtuemart_paymentmethod_id);
            //  amazonPayment.selectShipment(virtuemart_paymentmethod_id);
            // amazonPayment.showAmazonWallet();
            //  amazonShowWallet(sellerId, amazonOrderReferenceId, width, height);
        },


        updateCartWithAmazonAddress: function (virtuemart_paymentmethod_id) {

            var url = 'index.php?option=com_virtuemart&view=plugin&type=vmpayment&name=amazon&action=updateCartWithAmazonAddress&virtuemart_paymentmethod_id=' + virtuemart_paymentmethod_id;

            jQuery.ajax({
                url: url,
                type: 'POST', // Notice
                headers: {
                    "cache-control": "no-cache"
                },
                data: JSON.stringify(),
                dataType: 'json',
                contentType: 'application/json; charset=UTF-8',
            }).done(function(data) {
                    console.log('updateCartWithAmazonAddress DONE  SUCCESS' + data.isSameAddress);
                    if (data.isSameAddress === false) {
                        console.log('reload then' );
                        var reloadurl = 'index.php?option=com_virtuemart&view=cart';
                        window.location.href = reloadurl;
                    }
                });

            console.log('updateCartWithAmazonAddress OUSIDE  SUCCESS');
        },

        updateCartWithAmazonAddressxx : function(virtuemart_paymentmethod_id) {
            var url = window.vmSiteurl+'index.php?option=com_virtuemart&view=plugin&type=vmpayment&name=amazon&action=updateCartWithAmazonAddress&virtuemart_paymentmethod_id=' + virtuemart_paymentmethod_id + window.vmLang;
            var url =  'index.php?option=com_virtuemart&view=plugin&type=vmpayment&name=amazon&action=updateCartWithAmazonAddress&virtuemart_paymentmethod_id=' + virtuemart_paymentmethod_id ;

            var $ = jQuery ;
            $.ajaxSetup({ cache: false })
            $.getJSON(url,
                function($json, textStatus) {
                    if ($json.isSameAddress) {
                        var reloadurl = 'index.php?option=com_virtuemart&view=cart';
                        window.location.href = reloadurl;
                    }
                }
            );
        },


        updateCart: function (virtuemart_paymentmethod_id) {
            var url = 'index.php?option=com_virtuemart&view=cart&format=json&task=checkout';
            jQuery.getJSON(url,
                function(datas, textStatus) {
                    console.log('json return:' + datas.reload + ' ' + textStatus);
                    var cartview = "";
                    console.log('updateCart:' + datas.cartview.length);
                    if (datas.cartview) {
                        //shipments = '<h2>Select Shipment</h2>';
                        //console.log('selectShipment:' + data.cartview.length);
                        datas.cartview=  datas.cartview.replace('amazonHeader','amazonHeaderHide');
                        for (var i = 0; i < datas.cartview.length; i++) {
                            cartview += datas.cartview[i].toString() ;
                            //shipments +=    data.shipments[i].toString() + '<br />';
                        }
                        //cartview.id('amazonHeader').set('html','');
//document.id('amazonHeader').setStyle('display','none');
                        document.id('amazonCartDiv').set('html',cartview);
                        document.id('amazonHeaderHide').set('html','');
                        amazonPayment.amazonStopLoading();
                    }
                }
            );


        },

        onErrorAmazon: function (from, error, virtuemart_paymentmethod_id) {
            var sessionExpired = "BuyerSessionExpired";
            if (error.getErrorCode() == sessionExpired) {
                var url =  vmSiteurl + 'index.php?option=com_virtuemart&view=plugin&type=vmpayment&name=amazon&action=resetAmazonReferenceId&virtuemart_paymentmethod_id=' +virtuemart_paymentmethod_id;
                console.log('resetAmazonReferenceId');
                jQuery.getJSON(url, function(data) {
                    var reloadurl = 'index.php?option=com_virtuemart&view=cart';
                    window.location.href = reloadurl;
                });

            }
            alert(from + error.getErrorCode() + ": " + error.getErrorMessage());
        },

        selectShipmentx: function (virtuemart_paymentmethod_id) {
            // var url= vmSiteurl+"index.php?option=com_virtuemart&nosef=1&view=cart&task=edit_shipment&format=json"+vmLang;
            //var url = "index.php?option=com_virtuemart&nosef=1&view=cart&task=setshipment&format=json&virtuemart_paymentmethod_id=" + virtuemart_paymentmethod_id;
            var url = "index.php?option=com_virtuemart&view=cart";
            // window.location.href = url;
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
                    //updateCartWithAmazonInformation();
                    haveWallet = true;
                    //showFinalizeButton();
                },
                onError: function (error) {
                    amazonPayment.onErrorAmazon('amazonShowWallet', error, virtuemart_paymentmethod_id);
                }
            }).bind("amazonWalletWidgetDiv");

        }
    }
    ;




