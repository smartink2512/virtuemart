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
    handleRegionParameters = function () {
        var region = $('#paramsregion').val();

        $('.region-other').parents('tr').hide();

        if (region === 'OTHER') {
            $('.region-other').parents('tr').show();
        }
    }

    handleAuthorizationERPDisabled = function () {
        var authorization = $('#paramsauthorization_mode_erp_disabled').val();
        var erp_mode = $('#paramserp_mode').val();

        $('.automatic_synchronous').hide();
        $('.automatic_asynchronous').hide();
        $('.manual_non_synchronous').hide();
        if (erp_mode === 'erp_mode_disabled') {

            if (authorization === 'automatic_synchronous') {
                $('.automatic_synchronous').show();
            } else if (authorization === 'automatic_asynchronous') {
                $('.automatic_asynchronous').show();
            } else {
                $('.automatic_asynchronous').show();
            }
        }
    }

    handleAuthorizationERPEnabled = function () {
        var authorization = $('#paramsauthorization_mode_erp_enabled').val();
        var erp_mode = $('#paramserp_mode').val();

        $('.automatic_synchronous').hide();
        $('.automatic_asynchronous').hide();
        $('.manual_non_synchronous').hide();
        if (erp_mode === 'erp_mode_enabled') {
            if (authorization === 'automatic_synchronous') {
                $('.automatic_synchronous').show();
            } else if (authorization === 'automatic_asynchronous') {
                $('.automatic_asynchronous').show();
            } else {
                $('.automatic_asynchronous').show();
            }
        }
    }


    handleCaptureModeParameters = function () {
        var capture_mode = $('#paramscapture_mode').val();
        var authorization = $('#paramsauthorization_mode_erp_disabled').val();
        var erp_mode = $('#paramserp_mode').val();

        $('.capture_mode').parents('tr').hide();
        $('.capture_immediate').parents('tr').hide();
        $('.capture_delayed').parents('tr').hide();
        if (erp_mode === 'erp_mode_disabled') {
            if (authorization === 'automatic_synchronous') {
                $('.capture_mode').parents('tr').show();
                if (capture_mode === 'capture_immediate') {
                    $('.capture_immediate').parents('tr').show();
                } else if (capture_mode === 'capture_delayed') {
                    $('.capture_delayed').parents('tr').show();
                }
            }
        }
    }

    handleERPModeParameters = function () {
        var erp_mode = $('#paramserp_mode').val();
        $('.erp_mode_enabled').parents('tr').hide();
        $('.erp_mode_disabled').parents('tr').hide();

        if (erp_mode === 'erp_mode_enabled') {
            $('.erp_mode_enabled').parents('tr').show();
        } else {
            $('.erp_mode_disabled').parents('tr').show();
        }
    }

    handleIPNReceptionParameters = function () {
        var ipn_reception = $('#paramsipn_reception').val();
        var erp_mode = $('#paramserp_mode').val();


        $('.ipn_reception_enabled').parents('tr').hide();
        $('.ipn_reception_disabled').parents('tr').hide();

        if (erp_mode === 'erp_mode_disabled') {
            if (ipn_reception === 'ipn_reception_enabled') {
                $('.ipn_reception_enabled').parents('tr').show();
            } else {
                $('.ipn_reception_disabled').parents('tr').show();
            }
        }
    }


    handleSandboxSimulationParameters = function () {
        var environment = $('#paramsenvironment').val();
        $('.sandbox').parents('tr').hide();
        $('.live').parents('tr').hide();

        if (environment === 'sandbox') {
            $('.sandbox').parents('tr').show();
        } else {
            $('.live').parents('tr').show();
        }
    }

    handleSandboxIPN = function () {
        var environment = $('#paramsenvironment').val();
        $('.ipn-sandbox').hide();

        if (environment === 'sandbox') {
            $('.ipn-sandbox').show();
        }
    }
    /**********/
    /* Events */
    /**********/
    $('#paramsregion').change(function () {
        handleRegionParameters();

    });
    $('#paramsauthorization_mode_erp_disabled').change(function () {
        handleAuthorizationERPDisabled();
        handleAuthorizationERPEnabled();
        handleCaptureModeParameters();

    });
    $('#paramsauthorization_mode_erp_enabled').change(function () {
        handleAuthorizationERPEnabled();
        handleAuthorizationERPDisabled();
        handleCaptureModeParameters();

    });
    $('#paramscapture_mode').change(function () {
        handleCaptureModeParameters();

    });
    $('#paramserp_mode').change(function () {
        handleERPModeParameters();
        handleIPNReceptionParameters();
        handleCaptureModeParameters();

    });
    $('#paramsipn_reception').change(function () {
        handleIPNReceptionParameters();

    });
    $('#paramsenvironment').change(function () {
        handleSandboxSimulationParameters();
        handleSandboxIPN();

    });


    /*****************/
    /* Initial calls */
    /*****************/
    handleRegionParameters();
    handleAuthorizationERPDisabled();
    handleAuthorizationERPEnabled();
    handleCaptureModeParameters();

    handleIPNReceptionParameters();
    handleSandboxSimulationParameters();
    handleSandboxIPN();
    // this must be the last one
    handleERPModeParameters();
});
