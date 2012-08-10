<?php defined('_JEXEC') or die('Restricted access');
/**
 * @version $Id$
 *
 * @author Valérie Isaksen
 * @package VirtueMart

 * @copyright Copyright (C) iStraxx - All rights reserved.
 * @license istraxx_license.txt Proprietary License. This code belongs to istraxx UG (haftungsbeschränkt)
 * You are not allowed to distribute or sell this code.
 * You are not allowed to modify this code
 */

JHTML::stylesheet('style.css', VMKLARNAPLUGINWEBROOT . '/klarna/assets/css/', false);
JHTML::script('klarna_pp.js', VMKLARNAPLUGINWEBASSETS.'/js/', false);
JHTML::script('klarnapart.js', 'https://static.klarna.com:444/external/js/', false);
$document = JFactory::getDocument();
$document->addScriptDeclaration("

jQuery(function(){
	jQuery('.klarna_AdvertBox_bottomMid_readMore a').click( function(){
		InitKlarnaPartPaymentElements('klarna_partpayment', '". $viewData['eid'] ."', '". $viewData['country'] ."');
		ShowKlarnaPartPaymentPopup();
		return false;
	});
});
");
$js = '<script type="text/javascript">jQuery(document).find(".product_price").width("25%");</script>';
$js .= '<style>';
$js .= 'div.klarna_PPBox{z-index: 200 !important;}';
$js .= 'div.cbContainer{z-index: 10000 !important;}';
$js .= 'div.klarna_PPBox_bottomMid{overflow: visible !important;}';
$js .= '</style>';
//$html .= '<br>';
if ($viewData['country'] == 'nl') {
	$js .= '<style>.klarna_PPBox_topMid{width: 81%;}</style>';
}
$document = JFactory::getDocument();
//$document->addScriptDeclaration($js);
?>

<?php
if ($viewData['country']== "nl") {
	$country_width="klarna_PPBox_topMid_nl";
} else {
	$country_width="";
}
?>

<div class="klarna_AdvertisementBox">
 <div id="klarna_partpayment" style="display: none"></div>
                <div class="klarna_AdvertBox_bottomMid_readMore">
                    <a href="#"><?php echo JText::sprintf('VMPAYMENT_KLARNA_ADVERTISEMENT',$viewData['sFee'] ); ?></a>
                </div>

        <?php
	$notice = (($viewData['country']  == 'nl') ? '<div class="nlBanner"><img src="' . VMKLARNAPLUGINWEBASSETS . '/images/account/notice_nl.png" /></div>' : "");
	echo $notice;
	 ?>
</div>
<div style="clear: both; height: 80px;"></div>
