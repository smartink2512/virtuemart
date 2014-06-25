/**
 *
 * Paypal payment plugin
 *
 * @author Jeremy Magne
 * @author Valérie Isaksen
 * @version $Id: paypal.php 7217 2013-09-18 13:42:54Z alatak $
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
    /* BC compatibillities function */
    hideParent = function(param) {
        $(param).parents('tr').hide();
        $(param).parents('.control-group').hide();
    }
    showParent = function(param) {
        $(param).parents('tr').show();
        $(param).parents('.control-group').show();
    }
    getParamId = function(param) {
        if($("#params_"+param).length == 0) {
            //it doesn't exist
            var newparam=   '#params'+param;
        } else {
            var newparam= "#params_"+param;
        }
        return newparam;
    }
    getParamValue = function(param) {
        if($("#params_"+param).length == 0) {
            //it doesn't exist
            return   $('#params'+param).val();
        } else {
            return  $("#params_"+param).val();
        }
    }
    /************/
    /* Handlers */
    /************/
    handleCredentials = function () {

        var paypalproduct=getParamValue('paypalproduct');
        var sandbox = $("input[name='params[sandbox]']:checked").val();
        if (sandbox==1) {
            var sandboxmode = 'sandbox';
        } else {
            var sandboxmode = 'production';
        }

        hideParent('.std,.api,.live,.sandbox,.sandbox_warning, .accelerated_onboarding');
        $('.get_sandbox_credentials').hide();
        $('.get_paypal_credentials').hide();
        // $('.authentication').hide();
        hideParent('.authentication');


        if (paypalproduct == 'std' && sandboxmode == 'production') {
            showParent('.std.live') ;
            $('.get_paypal_credentials').show();
            $(getParamId('paypal_merchant_email')).addClass("required");

        } else if (paypalproduct == 'std' && sandboxmode == 'sandbox') {
            showParent('.std.sandbox');
            $('.get_sandbox_credentials').show();
            $(getParamId('sandbox_merchant_email')).addClass("required");

        } else if (paypalproduct == 'api' && sandboxmode == 'production') {
            showParent('.api.live');
            $('.get_paypal_credentials').show();
            $(getParamId('paypal_merchant_email')).removeClass("required");

        } else if (paypalproduct == 'api' && sandboxmode == 'sandbox') {
            showParent('.api.sandbox');
            $('.get_sandbox_credentials').show();
            $(getParamId('sandbox_merchant_email')).removeClass("required");

        } else if (paypalproduct == 'exp' && sandboxmode == 'production') {
            showParent('.api.live');
            $('.exp.live');
            showParent('.accelerated_onboarding');
            $('.get_paypal_credentials').show();
            $(getParamId('paypal_merchant_email')).removeClass("required");

            //$('.authentication.live.certificate');

        } else if (paypalproduct == 'exp' && sandboxmode == 'sandbox') {
            showParent('.api.sandbox');
            showParent('.exp.sandbox');
            showParent('.accelerated_onboarding');
            $('.get_sandbox_credentials').show();
            $(getParamId('sandbox_merchant_email')).removeClass("required");
            // $('.sandbox.authentication').show();

        } else if (paypalproduct == 'hosted' && sandboxmode == 'production') {
            showParent('.api.live');
            showParent('.hosted.live');
            $('.get_paypal_credentials').show();
            $(getParamId('paypal_merchant_email')).removeClass("required");

        } else if (paypalproduct == 'hosted' && sandboxmode == 'sandbox') {
            showParent('.api.sandbox');
            showParent('.hosted.sandbox');
            $('.get_sandbox_credentials').show();
            $(getParamId('sandbox_merchant_email')).removeClass("required");
        }

        if (sandboxmode == 'sandbox') {
            showParent('.sandbox_warning');
        }
    }

    handlePaymentType = function () {
        var paypalproduct=getParamValue('paypalproduct');
        var currentval = getParamValue('payment_type');
        hideParent('.payment_type');
        if (paypalproduct == 'std') {
            $('.payment_type');
        }

        if (paypalproduct == 'exp' || paypalproduct == 'api' || paypalproduct == 'hosted') {
            $(getParamId('payment_type')+' option[value=_cart]').attr('disabled', '');
            $(getParamId('payment_type')+' option[value=_oe-gift-certificate]').attr('disabled', '');
            $(getParamId('payment_type')+' option[value=_donations]').attr('disabled', '');
            $(getParamId('payment_type')+' option[value=_xclick-auto-billing]').attr('disabled', '');
            if (currentval == '_cart' || currentval == '_oe-gift-certificate' || currentval == '_donations' || currentval == '_xclick-auto-billing') {
                $(getParamId('payment_type')).val('_xclick');
            }

        } else {
            $(getParamId('payment_type')+' option[value=_cart]').removeAttr('disabled');
            $(getParamId('payment_type')+' option[value=_oe-gift-certificate]').removeAttr('disabled');
            $(getParamId('payment_type')+' option[value=_donations]').removeAttr('disabled');
            $(getParamId('payment_type')+' option[value=_xclick-auto-billing]').removeAttr('disabled');
        }
        $(getParamId('payment_type')).trigger("liszt:updated");


    }

    handleCreditCard = function () {
        var paypalproduct = $(getParamValue('paypalproduct'));
        hideParent('.creditcard');
        hideParent('.cvv_required');
        if (paypalproduct == 'api') {
            showParent('.creditcard');
            showParent('.cvv_required');

        }
    }
    handleRefundOnCancel = function () {
        var paypalproduct=getParamValue('paypalproduct');
        showParent('.paypal_vm');
        if (paypalproduct == 'std') {
            hideParent('.paypal_vm');
        }
    }

    handleCapturePayment = function () {
        var paypalproduct=getParamValue('paypalproduct');
        var payment_action=getParamValue('payment_action');
        hideParent('.capture');
        if (paypalproduct == 'hosted' && payment_action == 'Authorization') {
            showParent('.capture');
        }
    }
    handleTemplate = function () {
        var paypalproduct=getParamValue('paypalproduct');
        hideParent('.paypaltemplate');

        if (paypalproduct == 'hosted') {
            showParent('.paypaltemplate');
        }
    }

    handleTemplateParams = function () {
        var paypaltemplate=getParamValue('template');
        var paypalproduct=getParamValue('paypalproduct');
        hideParent('.hosted.templateA,.hosted.templateB,.hosted.templateC,.hosted.template_warning');

        if (paypalproduct == 'hosted' && paypaltemplate == 'templateA') {
            showParent('.hosted.templateA,.hosted.template_warning');
        }
        if (paypalproduct == 'hosted' && paypaltemplate == 'templateB') {
            showParent('.hosted.templateB,.hosted.template_warning');
        }
        if (paypalproduct == 'hosted' && paypaltemplate == 'templateC') {
            showParent('.hosted.templateC,.hosted.template_warning');
        }
    }

    handlePaymentAction = function () {
        var paymenttype = $(getParamId('payment_type')).val();
        //var currentval = $(getParamId('payment_action')).val();
        if (paymenttype == '_xclick-subscriptions' || paymenttype == '_xclick-payment-plan' || paymenttype == '_xclick-auto-billing') {
            $(getParamId('payment_action')).val('Sale');
            hideParent(getParamId('payment_action'));
            $(getParamId('payment_action')).trigger("liszt:updated");
        } else {
            showParent(getParamId('payment_action'));
        }
    }

    handleLayout = function () {
        var paypalproduct=getParamValue('paypalproduct');
        hideParent('.paypallayout');
        hideParent('.stdlayout');
        hideParent('.explayout');
        // $('.hosted.paypallayout');
        if (paypalproduct == 'std' || paypalproduct == 'exp' || paypalproduct == 'hosted') {
            showParent('.paypallayout');
        }
        if (paypalproduct == 'std') {
            showParent('.stdlayout');
        }
        if (paypalproduct == 'exp') {
            showParent('.explayout');
        }
    }
    handleAuthentication = function () {
        var paypalAuthentication=getParamValue('authentication');
        var sandbox = $("input[name='params[sandbox]']:checked").val();
        var paypalproduct=getParamValue('paypalproduct');

        if (sandbox==1) {
            var sandboxmode = 'sandbox';
        } else {
            var sandboxmode = 'production';
        }

        hideParent('.authentication');
        if (paypalproduct != 'std') {
            if (sandboxmode == 'sandbox') {
                showParent('.authentication.sandbox.select');
                if (paypalAuthentication == 'certificate') {
                    showParent('.authentication.sandbox.certificate');
                } else {
                    showParent('.authentication.sandbox.signature');

                }
            }
            else if (sandboxmode == 'production') {
                // $('.authentication.live.certificate');
                showParent('.authentication.live.select');
                if (paypalAuthentication == 'certificate') {
                    showParent('.authentication.live.certificate');
                } else {
                    showParent('.authentication.live.signature');

                }
            }
        }

    }
    handleExpectedMaxAmount = function () {
        var paypalproduct=getParamValue('paypalproduct');
        hideParent('.expected_maxamount');

        if (paypalproduct == 'exp') {
            showParent('.expected_maxamount');
        }
    }
    handleWarningAuthorizeStd = function () {
        var paypalproduct=getParamValue('paypalproduct');
        var payment_action=getParamValue('payment_action');
        hideParent('.warning_std_authorize');
        if (paypalproduct == 'std' && payment_action == 'Authorization') {
            showParent('.warning_std_authorize');
        }
    }

    handleWarningHeaderImage = function () {
        var headerimage=getParamValue('headerimg');
        hideParent('.warning_headerimg');
        if (headerimage != '-1') {
            showParent('.warning_headerimg');
        }
    }

    handlePaymentTypeDetails = function () {
        var selectedMode=getParamValue('payment_type');
        hideParent('.xclick');
        hideParent('.cart');
        hideParent('.subscribe');
        hideParent('.plan');
        hideParent('.billing');
        var paypalproduct=getParamValue('paypalproduct');
        if (paypalproduct == 'std') {
            switch (selectedMode) {
                case '_xclick':
                    showParent('.xclick');
                    hideParent('.cart');
                    hideParent('.subscribe');
                    hideParent('.plan');
                    hideParent('.billing');
                    break;
                case '_cart':
                    hideParent('.xclick');
                    showParent('.cart');
                    hideParent('.subscribe');
                    hideParent('.plan');
                    hideParent('.billing');
                    break;
                case '_oe-gift-certificate':
                    hideParent('.cart');
                    hideParent('.subscribe');
                    hideParent('.plan');
                    hideParent('.billing');
                    break;
                case '_xclick-subscriptions':
                    hideParent('.cart');
                    showParent('.subscribe');
                    hideParent('.plan');
                    $('#params_subcription_trials').trigger('change');
                    hideParent('.billing');
                    handleSubscriptionTrials();
                    break;
                case '_xclick-auto-billing':
                    hideParent('.cart');
                    hideParent('.subscribe');
                    hideParent('.plan');
                    showParent('.billing');
                    handleMaxAmountType();
                    break;
                case '_xclick-payment-plan':
                    hideParent('.cart');
                    hideParent('.subscribe');
                    showParent('.plan');
                    hideParent('.billing');
                    handlePaymentPlanDefer();
                    break;
                case '_donations':
                    hideParent('.cart');
                    hideParent('.subscribe');
                    hideParent('.plan');
                    hideParent('.billing');
                    break;
            }
        }
    }

    handleSubscriptionTrials = function () {
        var nbTrials=getParamValue('subcription_trials');

        switch (nbTrials) {
            case '0':
                hideParent('.trial1');
                //$('.trial2');
                break;
            case '1':
                showParent('.trial1');
                //$('.trial2');
                break;
            //case '2':
            //	$('.trial1');
            //	$('.trial2');
            //	break;
        }
    }

    handlePaymentPlanDefer = function () {
        var doDefer=getParamValue('payment_plan_defer');
        var paypalproduct=getParamValue('paypalproduct');

        hideParent('.defer');
        if (doDefer == 1) {
            if (paypalproduct == 'std') {
                showParent('.defer_std');
            } else {
                showParent('.defer_api');
            }
        }
    }

    handleMaxAmountType = function () {
        var max_amount_type=getParamValue('billing_max_amount_type');

        switch (max_amount_type) {
            case 'cart':
            case 'cust':
                hideParent('.billing_max_amount');
                break;
            case 'value':
            case 'perc':
                showParent('.billing_max_amount');
                break;
        }
    }

    handlePaymentFeesWarning = function () {
        var paypalproduct=getParamValue('paypalproduct');
        var selectedMode=getParamValue('payment_type');
        if ((paypalproduct == 'api' || paypalproduct == 'exp') && (selectedMode == '_xclick-subscriptions' || selectedMode == '_xclick-payment-plan')) {
            showParent('.warning_transaction_cost');
        } else {
            hideParent('.warning_transaction_cost');
        }
    }

    handleProductPricesApi = function() {
        var paypalproduct=getParamValue('paypalproduct');
        var add_prices_api=getParamValue('add_prices_api');
        if (paypalproduct == 'api'  || paypalproduct == 'exp' ) {
            showParent('.add_prices_api');
        } else {
            hideParent('.add_prices_api');
        }
    }
    /**********/
    /* Events */
    /**********/
    $("input[name='params[sandbox]']").change(function () {
        handleCredentials();
        handleAuthentication();
    });

    $(getParamId('paypalproduct')).change(function () {
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
        handleProductPricesApi();

    });
    $(getParamId('authentication')).change(function () {
        handleAuthentication();
    });
    $(getParamId('template')).change(function () {
        handleTemplateParams();
    });
    $(getParamId('payment_action')).change(function () {
        handleWarningAuthorizeStd();
        handleCapturePayment();
    });

    $(getParamId('payment_type')).change(function () {
        handlePaymentAction();
        handlePaymentTypeDetails();
        handlePaymentFeesWarning();
    });

    $(getParamId('headerimg')).change(function () {
        handleWarningHeaderImage();
    });

    $(getParamId('subcription_trials')).change(function () {
        handleSubscriptionTrials();
    });

    $(getParamId('payment_plan_defer')).change(function () {
        handlePaymentPlanDefer();
    });

    $(getParamId('billing_max_amount_type')).change(function () {
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
    handleProductPricesApi();

});
