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
jQuery().ready(function ($) {

    /************/
    /* Handlers */
    /************/
    handleRealexRemoteCCForm = function () {
       var hasCreditcardsDropDownClass = $("#vmpayment_cardinfo > *").hasClass("creditcardsDropDown");
        if (hasCreditcardsDropDownClass) {
            var CCselected= $(".creditcardsDropDown input[type='radio']:checked").val();
            $('.realexRemoteCCForm').hide();

            if (CCselected == -1) {
                $('.realexRemoteCCForm').show();
            }
        }

    }


    /**********/
    /* Events */
    /**********/
    $('.realexListCC').change(function () {
        handleRealexRemoteCCForm();

    });

    /*****************/
    /* Initial calls */
    /*****************/
    handleRealexRemoteCCForm();

});

