/**
 *
 * Realex payment plugin
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

jQuery().ready(function ($) {

    /************/
    /* Handlers */
    /************/
    handleDebitType = function () {
        var debit_type = $('#paramsdebit_type').val();

        $('.authorization_only, .authorization_capture').parents('tr').hide();

        if (debit_type == 'authorization_only') {
            $('.authorization_only').parents('tr').show();
        } else if (debit_type == 'authorization_capture') {
            $('.authorization_capture').parents('tr').show();
        }
    }
    handle3Dsecure = function () {
        var activate_3dsecure = $('#paramsactivate_3dsecure').val();

        $('.activate_3dsecure ').parents('tr').hide();

        if (activate_3dsecure == 1) {
            $('.activate_3dsecure').parents('tr').show();
        }
    }
    handlePaymentplans = function () {
        var activate_paymentplans = $('#paramsactivate_paymentplans').val();

        $('.activate_paymentplans ').parents('tr').hide();

        if (activate_paymentplans == 1) {
            $('.activate_paymentplans').parents('tr').show();
        }
    }
    handleShopMode = function () {
        var shop_mode = $('#paramsshop_mode').val();

        $('.shop_mode ').parents('tr').hide();

        if (shop_mode == 'test') {
            $('.shop_mode').parents('tr').show();
        }
    }
    /**********/
    /* Events */
    /**********/
    $('#paramsdebit_type').change(function () {
        handleDebitType();

    });
    $('#paramsactivate_3dsecure').change(function () {
        handle3Dsecure();

    });
    $('#paramsactivate_paymentplans').change(function () {
        handlePaymentplans();

    });
    $('#paramsshop_mode').change(function () {
        handleShopMode();

    });
    /*****************/
    /* Initial calls */
    /*****************/
    handleShopMode();
    handleDebitType();
    handle3Dsecure();
    handlePaymentplans();
});
