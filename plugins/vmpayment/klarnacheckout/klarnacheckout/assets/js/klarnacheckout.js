/**
 *
 * KlarnaCheckout payment plugin
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



var klarnaCheckoutPayment = {
    initPayment: function (hideBTST, noShipmentString, shipmentMethodsLaterString) {

        klarnaCheckoutPayment.noShipmentString = noShipmentString;
        klarnaCheckoutPayment.shipmentMethodsLaterString = shipmentMethodsLaterString;
        if (hideBTST == 1) {
            jQuery(".billto-shipto").hide();
            jQuery("#com-form-login").hide();
        }
        jQuery("#checkoutFormSubmit").hide();
        jQuery(".vm-fieldset-tos").hide();
        klarnaCheckoutPayment.checkShipmentAvailable();
    },


    updateCart: function (klarnaData, virtuemart_paymentmethod_id) {
        var zip = klarnaData.postal_code;
        var email = klarnaData.email;
        var given_name = klarnaData.given_name;
        var family_name = klarnaData.family_name;

        if (zip === '') return;
        var url = vmSiteurl + 'index.php?option=com_virtuemart&view=plugin&type=vmpayment&nosef=1&name=klarnacheckout&loadJS=1&action=updateCartWithKlarnacheckoutAddress&virtuemart_paymentmethod_id=' + virtuemart_paymentmethod_id + '&zip=' + zip + '&email=' + email + vmLang;
        window._klarnaCheckout(function (api) {
            console.log('suspend');
            api.suspend();
        });
        jQuery.ajax({
            type: "POST",
            cache: false,
            dataType: "json",
            url: url

        }).success(
            function (datas) {
                if (datas.msg) {
                    console.log('updateCart:' + datas.msg.length);
                }
                console.log('updateCart:');
                if (datas.getShipment) {
                    console.log('getShipment:');
                    klarnaCheckoutPayment.updateShipment();
                }
            });
    },

    updateShipment: function () {
        console.log('updateShipment:');

        var url = vmSiteurl + 'index.php?option=com_virtuemart&nosef=1&snippet=0&view=cart&task=updatecartJS' + vmLang;
        jQuery.ajax({
            type: "POST",
            cache: false,
            dataType: "json",
            url: url

        }).success(
            function (datas) {
                window._klarnaCheckout(function (api) {
                    console.log('resume');
                    api.resume();
                });
                console.log('updateShipment:back');
                cartview = "";
                if (datas.msg) {
                    console.log('updateShipment:back and data');
                    jQuery("#cart-view").replaceWith(datas.msg);
                }
                klarnaCheckoutPayment.checkShipmentAvailable();
            });
    },
    checkShipmentAvailable: function () {
        var zip = jQuery(".vm2-zip").text();
        console.log('checkShipmentAvailable zip='+zip);
        var foundShipment=true;
        jQuery("*:contains(" + klarnaCheckoutPayment.noShipmentString + ")").filter(function () {
            if (zip ===  undefined || zip === '-' || zip === '') {
                console.log('checkShipmentAvailable no zip msg');
                jQuery("#kco-shipment-method").text(klarnaCheckoutPayment.shipmentMethodsLaterString );
            }
            foundShipment=false;
            console.log('checkShipmentAvailable foundShipment='+foundShipment);
        })

        if (foundShipment) {
            jQuery("#kco-shipment-method").text("shipment methods,and zip what shall we write");
        }
        // TODO does not contains , and shipment is not selected: please select
    }
}






