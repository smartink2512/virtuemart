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

    handleRecurringDate = function () {
        var recurring_deposit = $('#paramsrecurring_deposit').val();

        $('.recurring_date').parents('tr').hide();

        if (recurring_deposit == '') {
        } else {
            $('.recurring_date').parents('tr').show();
        }
    }

    handleIntegration = function () {
        var integration = $('#paramsintegration').val();

        $('.integration ').parents('tr').hide();

        if (integration == 'recurring') {
            $('.recurring').parents('tr').show();
        } else if(integration == 'subscribe') {
            $('.subscribe').parents('tr').show();
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


    $('#paramsrecurring_deposit').change(function () {
        handleRecurringDate();

    });
    $('#paramsshop_mode').change(function () {
        handleShopMode();

    });
    $('#paramsintegration').change(function () {
        handleIntegration();

    });
    /*****************/
    /* Initial calls */
    /*****************/
    handleShopMode();
    handleRecurringDate();
    handleIntegration();
});
