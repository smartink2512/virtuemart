/**
 *
 *
 * @author Valérie Isaksen
 * @version $Id$
 * @package VirtueMart
 * @subpackage cart
 * Copyright (C) 2004-2015 Virtuemart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */



var virtuemartOPC = {


        /**
         * used in cart_shipment tmpl
         */
        setShipment: function (virtuemart_shipmentmethod_id) {

            var url = vmSiteurl + 'index.php?option=com_virtuemart&nosef=1&view=cart&task=updatecartJS&virtuemart_shipmentmethod_id=' + virtuemart_shipmentmethod_id + vmLang;
            jQuery.getJSON(url,
                function (datas, textStatus) {
                    var cartview = '';
                    if (datas.msg) {
                        for (var i = 0; i < datas.msg.length; i++) {
                            cartview += datas.msg[i].toString();
                        }
                        document.id('cart-view').set('html', cartview);
                    }
                }
            );
        },
        /**
         * used in cart_payment tmpl
         */
        setPayment: function (virtuemart_paymentmethod_id) {

            var url = vmSiteurl + 'index.php?option=com_virtuemart&nosef=1&view=cart&task=updatecartJS&virtuemart_paymentmethod_id=' + virtuemart_paymentmethod_id + vmLang;
            jQuery.getJSON(url,
                function (datas, textStatus) {
                    var cartview = '';
                    if (datas.msg) {
                        for (var i = 0; i < datas.msg.length; i++) {
                            cartview += datas.msg[i].toString();
                        }
                        document.id('cart-view').set('html', cartview);
                    }
                }
            );
        }

    }
    ;




