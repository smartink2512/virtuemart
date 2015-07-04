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
    updateCart: function (klarnaData, virtuemart_paymentmethod_id) {
        var zip = klarnaData.postal_code;
        var email = klarnaData.email;
        var given_name = klarnaData.given_name;
        var family_name = klarnaData.family_name;
        if (zip==='') return;
        var url = vmSiteurl + 'index.php?option=com_virtuemart&view=plugin&type=vmpayment&nosef=1&name=klarnacheckout&loadJS=1&action=updateCartWithKlarnacheckoutAddress&virtuemart_paymentmethod_id=' + virtuemart_paymentmethod_id + '&zip=' + zip + '&email=' + email + vmLang;

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

        var url = vmSiteurl + 'index.php?option=com_virtuemart&nosef=1&loadJS=1&view=cart&task=updatecartJS' + vmLang;
        jQuery.ajax({
            type: "POST",
            cache: false,
            dataType: "json",
            url: url

        }).success(
            function (datas) {
                var cartview = '';
                console.log('updateShipment:back');
                if (datas.msg) {
                    console.log('updateShipment:' + datas.msg.length);
                    var parentId =jQuery("#cart-view").closest('div').prop('id');
                   console.log('updateShipment:back  parent is'+ parentId);
                   jQuery("#"+ parentId ).html(datas.msg);
                }
    });
    }
}






