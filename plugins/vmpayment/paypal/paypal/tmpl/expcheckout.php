<?php
/**
 *
 * Paypal payment plugin
 *
 * @author Valerie Isaksen
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
?>

<div style="margin: 8px;">
    <?php
    if ($viewData['sandbox'] ) {
        ?>
		<span style="color:red;font-weight:bold">Sandbox (<?php echo $viewData['virtuemart_paymentmethod_id'] ?>)</span>
    <?php
    }
    ?>
<a href="<?php echo $viewData['link'] ?>" title="<?php echo $viewData['text'] ?>">
    <img src="<?php echo $viewData['img'] ?>" align="left"   alt="<?php echo $viewData['text']?>" title="<?php echo $viewData['text']?>"  >
</a>
    <?php
    if(!empty($viewData['offer_credit'])){
        $f = "
        var heightsiz = jQuery(window).height() * 0.9;
        var widthsiz = jQuery(window).width() * 0.8;
        var ppframe = jQuery('<div></div>')
               .html('<iframe id=\"paypal_offer_frame\" style=\"border: 0px;\" src=\"' + page + '\" width=\"100%\" height=\"100%\"></iframe>')
               .dialog({
                   autoOpen: false,
                   closeOnEscape: true,
                   modal: true,
                   height: heightsiz,
                   width: widthsiz,
                   title: \"Paypal Credit offer\"
               });";
$j = '
jQuery(document).ready( function() {
    var page = Virtuemart.vmSiteurl + "index.php?option=com_virtuemart&view=plugin&vmtype=vmpayment&name=paypal&action=getPayPalCreditOffer&tmpl=component";
    '.$f.'
    
    var bindClose = function(){
        ppiframe = jQuery("#paypal_offer_frame");
        closElem = ppiframe.contents().find("a").filter(\':contains("Close")\');;
        closElem.on("click", function() {
            jQuery(".ui-dialog-titlebar-close").click();
        });
    };

    jQuery(".jqmodal").on("click", function(){
        ppframe.dialog("open");
        setTimeout(bindClose,1000);
    });
    return false;
});
';
vmJsApi::addJScript('paypal_offer',$j);

static $frame= false;
?>
        <button class="jqmodal" >
            <img src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_bml_text.png" /></button>
            <?php if($frame){
                echo '<div id="paypal_offer_frame"></div>';
                $frame = false;
            }?>

    <?php
    }
    ?>


    </div>
