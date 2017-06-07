<?php
/**
 *
 * Paypal payment plugin
 *
 * @author Max Milbers
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

$paypalInterface = $viewData['paypalInterface'];
?>
<div style="margin: 8px;">
    <?php
    if ($viewData['sandbox'] ) {
		?>
        <span style="color:red;font-weight:bold">Sandbox (<?php echo $viewData['virtuemart_paymentmethod_id'] ?>)</span>
		<?php
	}

    ?><div class="pp-mark-express"><?php
	$product = $paypalInterface->getExpressProduct();
	$product['text'] = vmText::_('VMPAYMENT_PAYPAL_EXPCHECKOUT_AVAILABALE');
    ?>
        <a href="<?php echo $product['link'] ?>" title="<?php echo $product['text'] ?>" target="_blank">
            <img src="<?php echo $product['img'] ?>" align="left" alt="<?php echo $product['text']?>" title="<?php echo $product['text']?>"  >
        </a>
    </div>
<?php
if(!empty($viewData['offer_credit'])){

    ?><div class="pp-mark-credit"><?php
    $fcredit = 'var ppframeCredit = jQuery("<div></div>")';
	$fcredit .= ".html('<iframe id=\"paypal_offer_frame_credit\" style=\"border: 0px;\" src=\"' + ppurlcredit + '\" width=\"100%\" height=\"100%\"></iframe>')";
    $fcredit .= '.dialog({
               autoOpen: false,
               closeOnEscape: true,
               modal: true,
               height: heightsiz,
               width: widthsiz,
               title: "Paypal Credit offer"
           });';
	$j = '
jQuery(document).ready( function() {
    var page = Virtuemart.vmSiteurl + "index.php?option=com_virtuemart&view=plugin&vmtype=vmpayment&name=paypal&tmpl=component";
    var heightsiz = jQuery(window).height() * 0.9;
    var widthsiz = jQuery(window).width() * 0.8;
    
    var ppurlcredit = page+"&action=getPayPalCreditOffer";
    
    var bindClose = function(){
        ppiframe = jQuery("#paypal_offer_frame_credit");
        closElem = ppiframe.contents().find("a").filter(\':contains("Close")\');;
        closElem.on("click", function() {
            jQuery(".ui-dialog-titlebar-close").click();
        });
    };

    jQuery(".pp-mark-credit-modal").on("click", function(){
    '.$fcredit.'
        ppframeCredit.dialog("open");
        setTimeout(bindClose,2000);
    });
    
    return false;
});
';
	vmJsApi::addJScript('paypal_offer',$j);

	static $frame= false;
	?>
    <button class="pp-mark-credit-modal" >
        <img src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_bml_text.png" /></button>
	<?php if($frame){
		echo '<div id="paypal_offer_frame"></div>';
		$frame = false;
	}?>

	<?php
}
 /* ?>


        <div>
            <?php $button = $paypalInterface->getExpressCheckoutButton();
            vmdebug('my button',$button);
            ?>
        </div> */?>
</div>
