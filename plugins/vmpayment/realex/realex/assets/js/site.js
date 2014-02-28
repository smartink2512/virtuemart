/**
 *
 * Realex payment plugin
 *
 * @author Valerie Isaksen
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

jQuery().ready(function($) {


	$('input[name=virtuemart_paymentmethod_id]').change(function() {
		var selectedMethod = $('input[name=virtuemart_paymentmethod_id]:checked').val();
		$('.paymentMethodOptions').hide();
		$('#paymentMethodOptions_'+selectedMethod).show();
	});

	$('input[name=virtuemart_paymentmethod_id]').trigger('change');
	
});

jQuery().ready(function($) {
    $('.cc-number').payment('formatCardNumber');
    $('.cc-exp').payment('formatCardExpiry');
    $('.cc-cvc').payment('formatCardCVC');

    $('#CCVALIDATE').submit(function(e){
        e.preventDefault();
        $('input').removeClass('invalid');
        $('.validation').removeClass('passed failed');

        var cardType = $.payment.cardType($('.cc-number').val());

        $('.cc-number').toggleClass('invalid', !$.payment.validateCardNumber($('.cc-number').val()));
        $('.cc-exp').toggleClass('invalid', !$.payment.validateCardExpiry($('.cc-exp').payment('cardExpiryVal')));
        $('.cc-cvc').toggleClass('invalid', !$.payment.validateCardCVC($('.cc-cvc').val(), cardType));

        if ( $('input.invalid').length ) {
            $('.validation').addClass('failed');
        } else {
            $('.validation').addClass('passed');
        }
    });
});

