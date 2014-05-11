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

        if (region == 'OTHER') {
            $('.region-other').parents('tr').show();
        }
    }


    /**********/
    /* Events */
    /**********/
    $('#paramsregion').change(function () {
        handleRegionParameters();

    });

    /*****************/
    /* Initial calls */
    /*****************/
    handleRegionParameters();

});
