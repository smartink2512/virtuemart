/**
 *
 * Paypal payment plugin
 *
 * @author Jeremy Magne
 * @author Valérie Isaksen
 * @version $Id: paypal.php 7217 2013-09-18 13:42:54Z alatak $
 * @package VirtueMart
 * @subpackage payment
 * Copyright (C) 2004-2014 Virtuemart Team. All rights reserved.
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
    handleCredentials = function () {
        var paypalproduct = $('#params_paypalproduct').val();
        //var sandbox = $("input[name='params[sandbox]']:checked").val();
        var sandbox = $('#params_sandbox').val();

        if (sandbox==1) {
            var sandboxmode = 'sandbox';
        } else {
            var sandboxmode = 'production';
        }


        $('.std,.api,.live,.sandbox,.sandbox_warning, .accelerated_onboarding').closest('.control-group').hide();
        $('.get_sandbox_credentials').hide();
        $('.get_paypal_credentials').hide();
        // $('.authentication').hide();
        $('.authentication').closest('.control-group').hide();


        if (paypalproduct == 'std' && sandboxmode == 'production') {
            $('.std.live').closest('.control-group').show();
            $('.get_paypal_credentials').show();
            $('#params_paypal_merchant_email').addClass("required");

        } else if (paypalproduct == 'std' && sandboxmode == 'sandbox') {
            $('.std.sandbox').closest('.control-group').show();
            $('.get_sandbox_credentials').show();
            $('#params_sandbox_merchant_email').addClass("required");

        } else if (paypalproduct == 'api' && sandboxmode == 'production') {
            $('.api.live').closest('.control-group').show();
            $('.get_paypal_credentials').show();
            $('#params_paypal_merchant_email').removeClass("required");

        } else if (paypalproduct == 'api' && sandboxmode == 'sandbox') {
            $('.api.sandbox').closest('.control-group').show();
            $('.get_sandbox_credentials').show();
            $('#params_sandbox_merchant_email').removeClass("required");

        } else if (paypalproduct == 'exp' && sandboxmode == 'production') {
            $('.api.live').closest('.control-group').show();
            $('.exp.live').closest('.control-group').show();
            $('.accelerated_onboarding').closest('.control-group').show();
            $('.get_paypal_credentials').show();
            $('#params_paypal_merchant_email').removeClass("required");

            //$('.authentication.live.certificate').closest('.control-group').show();

        } else if (paypalproduct == 'exp' && sandboxmode == 'sandbox') {
            $('.api.sandbox').closest('.control-group').show();
            $('.exp.sandbox').closest('.control-group').show();
            $('.accelerated_onboarding').closest('.control-group').show();
            $('.get_sandbox_credentials').show();
            $('#params_sandbox_merchant_email').removeClass("required");
            // $('.sandbox.authentication').show();

        } else if (paypalproduct == 'hosted' && sandboxmode == 'production') {
            $('.api.live').closest('.control-group').show();
            $('.hosted.live').closest('.control-group').show();
            $('.get_paypal_credentials').show();
            $('#params_paypal_merchant_email').removeClass("required");

        } else if (paypalproduct == 'hosted' && sandboxmode == 'sandbox') {
            $('.api.sandbox').closest('.control-group').show();
            $('.hosted.sandbox').closest('.control-group').show();
            $('.get_sandbox_credentials').show();
            $('#params_sandbox_merchant_email').removeClass("required");
        }

        if (sandboxmode == 'sandbox') {
            $('.sandbox_warning').closest('.control-group').show();
        }
    }

    handlePaymentType = function () {
        var paypalproduct = $('#params_paypalproduct').val();
        var currentval = $('#params_payment_type').val();
        $('.payment_type').closest('.control-group').hide();
        if (paypalproduct == 'std') {
            $('.payment_type').closest('.control-group').show();
        }

        if (paypalproduct == 'exp' || paypalproduct == 'api' || paypalproduct == 'hosted') {
            $('#params_payment_type option[value=_cart]').attr('disabled', '');
            $('#params_payment_type option[value=_oe-gift-certificate]').attr('disabled', '');
            $('#params_payment_type option[value=_donations]').attr('disabled', '');
            $('#params_payment_type option[value=_xclick-auto-billing]').attr('disabled', '');
            if (currentval == '_cart' || currentval == '_oe-gift-certificate' || currentval == '_donations' || currentval == '_xclick-auto-billing') {
                $('#params_payment_type').val('_xclick');
            }

        } else {
            $('#params_payment_type option[value=_cart]').removeAttr('disabled');
            $('#params_payment_type option[value=_oe-gift-certificate]').removeAttr('disabled');
            $('#params_payment_type option[value=_donations]').removeAttr('disabled');
            $('#params_payment_type option[value=_xclick-auto-billing]').removeAttr('disabled');
        }
        $('#params_payment_type').trigger("liszt:updated");


    }

    handleCreditCard = function () {
        var paypalproduct = $('#params_paypalproduct').val();
        $('.creditcard').closest('.control-group').hide();
        $('.cvv_required').closest('.control-group').hide();
        if (paypalproduct == 'api') {
            $('.creditcard').closest('.control-group').show();
            $('.cvv_required').closest('.control-group').show();

        }
    }
    handleRefundOnCancel = function () {
        var paypalproduct = $('#params_paypalproduct').val();
        $('.paypal_vm').closest('.control-group').show();
        if (paypalproduct == 'std') {
            $('.paypal_vm').closest('.control-group').hide();
        }
    }

    handleCapturePayment = function () {
        var paypalproduct = $('#params_paypalproduct').val();
        var payment_action = $('#params_payment_action').val();
        $('.capture').closest('.control-group').hide();
        if (paypalproduct == 'hosted' && payment_action == 'Authorization') {
            $('.capture').closest('.control-group').show();
        }
    }
    handleTemplate = function () {
        var paypalproduct = $('#params_paypalproduct').val();
        $('.paypaltemplate').closest('.control-group').hide();

        if (paypalproduct == 'hosted') {
            $('.paypaltemplate').closest('.control-group').show();
        }
    }

    handleTemplateParams = function () {
        var paypaltemplate = $('#params_template').val();
        var paypalproduct = $('#params_paypalproduct').val();
        $('.hosted.templateA,.hosted.templateB,.hosted.templateC,.hosted.template_warning').closest('.control-group').hide();

        if (paypalproduct == 'hosted' && paypaltemplate == 'templateA') {
            $('.hosted.templateA,.hosted.template_warning').closest('.control-group').show();
        }
        if (paypalproduct == 'hosted' && paypaltemplate == 'templateB') {
            $('.hosted.templateB,.hosted.template_warning').closest('.control-group').show();
        }
        if (paypalproduct == 'hosted' && paypaltemplate == 'templateC') {
            $('.hosted.templateC,.hosted.template_warning').closest('.control-group').show();
        }
    }

    handlePaymentAction = function () {
        var paymenttype = $('#params_payment_type').val();
        //var currentval = $('#params_payment_action').val();
        if (paymenttype == '_xclick-subscriptions' || paymenttype == '_xclick-payment-plan' || paymenttype == '_xclick-auto-billing') {
            $('#params_payment_action').val('Sale');
            $('#params_payment_action').closest('.control-group').hide();
            $('#params_payment_action').trigger("liszt:updated");
        } else {
            $('#params_payment_action').closest('.control-group').show();
        }
    }

    handleLayout = function () {
        var paypalproduct = $('#params_paypalproduct').val();
        $('.paypallayout').closest('.control-group').hide();
        $('.stdlayout').closest('.control-group').hide();
        $('.explayout').closest('.control-group').hide();
        // $('.hosted.paypallayout').closest('.control-group').hide();
        if (paypalproduct == 'std' || paypalproduct == 'exp' || paypalproduct == 'hosted') {
            $('.paypallayout').closest('.control-group').show();
        }
        if (paypalproduct == 'std') {
            $('.stdlayout').closest('.control-group').show();
        }
        if (paypalproduct == 'exp') {
            $('.explayout').closest('.control-group').show();
        }
    }
    handleAuthentication = function () {
        var paypalAuthentication = $('#params_authentication').val();
        //var sandbox = $("input[name='params[sandbox]']:checked").val();
        var sandbox = $('#params_sandbox').val();

        if (sandbox==1) {
            var sandboxmode = 'sandbox';
        } else {
            var sandboxmode = 'production';
        }

        var paypalproduct = $('#params_paypalproduct').val();
        $('.authentication').closest('.control-group').hide();
        if (paypalproduct != 'std') {
            if (sandboxmode == 'sandbox') {
                $('.authentication.sandbox.select').closest('.control-group').show();
                if (paypalAuthentication == 'certificate') {
                    $('.authentication.sandbox.certificate').closest('.control-group').show();
                } else {
                    $('.authentication.sandbox.signature').closest('.control-group').show();

                }
            }
            else if (sandboxmode == 'production') {
                // $('.authentication.live.certificate').closest('.control-group').show();
                $('.authentication.live.select').closest('.control-group').show();
                if (paypalAuthentication == 'certificate') {
                    $('.authentication.live.certificate').closest('.control-group').show();
                } else {
                    $('.authentication.live.signature').closest('.control-group').show();

                }
            }
        }

    }
    handleExpectedMaxAmount = function () {
        var paypalproduct = $('#params_paypalproduct').val();
        $('.expected_maxamount').closest('.control-group').hide();

        if (paypalproduct == 'exp') {
            $('.expected_maxamount').closest('.control-group').show();
        }
    }
    handleWarningAuthorizeStd = function () {
        var paypalproduct = $('#params_paypalproduct').val();
        var payment_action = $('#params_payment_action').val();
        $('.warning_std_authorize').closest('.control-group').hide();
        if (paypalproduct == 'std' && payment_action == 'Authorization') {
            $('.warning_std_authorize').closest('.control-group').show();
        }
    }

    handleWarningHeaderImage = function () {
        var headerimage = $('#paramheaderimg').val();
        $('.warning_headerimg').closest('.control-group').hide();
        if (headerimage != '-1') {
            $('.warning_headerimg').closest('.control-group').show();
        }
    }

    handlePaymentTypeDetails = function () {
        var selectedMode = $('#params_payment_type').val();
        $('.xclick').closest('.control-group').hide();
        $('.cart').closest('.control-group').hide();
        $('.subscribe').closest('.control-group').hide();
        $('.plan').closest('.control-group').hide();
        $('.billing').closest('.control-group').hide();
        var paypalproduct = $('#params_paypalproduct').val();
        if (paypalproduct == 'std') {
            switch (selectedMode) {
                case '_xclick':
                    $('.xclick').closest('.control-group').show();
                    $('.cart').closest('.control-group').hide();
                    $('.subscribe').closest('.control-group').hide();
                    $('.plan').closest('.control-group').hide();
                    $('.billing').closest('.control-group').hide();
                    break;
                case '_cart':
                    $('.xclick').closest('.control-group').hide();
                    $('.cart').closest('.control-group').show();
                    $('.subscribe').closest('.control-group').hide();
                    $('.plan').closest('.control-group').hide();
                    $('.billing').closest('.control-group').hide();
                    break;
                case '_oe-gift-certificate':
                    $('.cart').closest('.control-group').hide();
                    $('.subscribe').closest('.control-group').hide();
                    $('.plan').closest('.control-group').hide();
                    $('.billing').closest('.control-group').hide();
                    break;
                case '_xclick-subscriptions':
                    $('.cart').closest('.control-group').hide();
                    $('.subscribe').closest('.control-group').show();
                    $('.plan').closest('.control-group').hide();
                    $('#params_subcription_trials').trigger('change');
                    $('.billing').closest('.control-group').hide();
                    handleSubscriptionTrials();
                    break;
                case '_xclick-auto-billing':
                    $('.cart').closest('.control-group').hide();
                    $('.subscribe').closest('.control-group').hide();
                    $('.plan').closest('.control-group').hide();
                    $('.billing').closest('.control-group').show();
                    handleMaxAmountType();
                    break;
                case '_xclick-payment-plan':
                    $('.cart').closest('.control-group').hide();
                    $('.subscribe').closest('.control-group').hide();
                    $('.plan').closest('.control-group').show();
                    $('.billing').closest('.control-group').hide();
                    handlePaymentPlanDefer();
                    break;
                case '_donations':
                    $('.cart').closest('.control-group').hide();
                    $('.subscribe').closest('.control-group').hide();
                    $('.plan').closest('.control-group').hide();
                    $('.billing').closest('.control-group').hide();
                    break;
            }
        }
    }

    handleSubscriptionTrials = function () {
        var nbTrials = $('#params_subcription_trials').val();
        switch (nbTrials) {
            case '0':
                $('.trial1').closest('.control-group').hide();
                //$('.trial2').closest('.control-group').hide();
                break;
            case '1':
                $('.trial1').closest('.control-group').show();
                //$('.trial2').closest('.control-group').hide();
                break;
            //case '2':
            //	$('.trial1').closest('.control-group').show();
            //	$('.trial2').closest('.control-group').show();
            //	break;
        }
    }

    handlePaymentPlanDefer = function () {
        var doDefer = $('#params_payment_plan_defer').val();
        var paypalproduct = $('#params_paypalproduct').val();
        $('.defer').closest('.control-group').hide();
        if (doDefer == 1) {
            if (paypalproduct == 'std') {
                $('.defer_std').closest('.control-group').show();
            } else {
                $('.defer_api').closest('.control-group').show();
            }
        }
    }

    handleMaxAmountType = function () {
        var max_amount_type = $('#params_billing_max_amount_type').val();
        switch (max_amount_type) {
            case 'cart':
            case 'cust':
                $('.billing_max_amount').closest('.control-group').hide();
                break;
            case 'value':
            case 'perc':
                $('.billing_max_amount').closest('.control-group').show();
                break;
        }
    }

    handlePaymentFeesWarning = function () {
        var paypalproduct = $('#params_paypalproduct').val();
        var selectedMode = $('#params_payment_type').val();
        if ((paypalproduct == 'api' || paypalproduct == 'exp') && (selectedMode == '_xclick-subscriptions' || selectedMode == '_xclick-payment-plan')) {
            $('.warning_transaction_cost').closest('.control-group').show();
        } else {
            $('.warning_transaction_cost').closest('.control-group').hide();
        }
    }


    /**********/
    /* Events */
    /**********/
    $('#params_sandbox').change(function () {
        handleCredentials();
        handleAuthentication();
    });

    $('#params_paypalproduct').change(function () {
        handleCredentials();
        handleAuthentication();
        handleExpectedMaxAmount();
        handleTemplateParams();
        handleCreditCard();
        handleRefundOnCancel();
        handleLayout();
        handleTemplate();
        handleWarningAuthorizeStd();
        handlePaymentType();
        handlePaymentPlanDefer();
    });
    $('#params_authentication').change(function () {
        handleAuthentication();
    });
    $('#params_template').change(function () {
        handleTemplateParams();
    });
    $('#params_payment_action').change(function () {
        handleWarningAuthorizeStd();
        handleCapturePayment();
    });

    $('#params_payment_type').change(function () {
        handlePaymentAction();
        handlePaymentTypeDetails();
        handlePaymentFeesWarning();
    });

    $('#paramheaderimg').change(function () {
        handleWarningHeaderImage();
    });

    $('#params_subcription_trials').change(function () {
        handleSubscriptionTrials();
    });

    $('#params_payment_plan_defer').change(function () {
        handlePaymentPlanDefer();
    });

    $('#params_billing_max_amount_type').change(function () {
        handleMaxAmountType();
    });


    /*****************/
    /* Initial calls */
    /*****************/

    handleCredentials();
    handleAuthentication();
    handleCreditCard();
    handleExpectedMaxAmount();
    handleCapturePayment();
    handleRefundOnCancel();
    handleLayout();
    handleTemplate();
    handleTemplateParams();
    handleWarningAuthorizeStd();
    handlePaymentType();
    handlePaymentAction();
    handlePaymentTypeDetails();
    handleWarningHeaderImage();
    handlePaymentFeesWarning();
    handlePaymentPlanDefer();

});
