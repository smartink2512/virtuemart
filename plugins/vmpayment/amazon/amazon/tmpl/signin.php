<?php
defined('_JEXEC') or die();

/**
 * @author Valérie Isaksen
 * @version $Id: render_pluginname.php 7198 2013-09-13 13:09:01Z alatak $
 * @package VirtueMart
 * @subpackage vmpayment
 * @copyright Copyright (C) 2004-${PHING.VM.COPYRIGHT}   - All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */

$doc = JFactory::getDocument();
vmJsApi::js('plugins/vmpayment/amazon/amazon/assets/js/site', '');
$doc->addStyleSheet(JURI::root(true) . '/plugins/vmpayment/amazon/amazon/assets/css/amazon-site.css');
if ($viewData['sign_in_display'] == 'advertise') {
	$doc->addScriptDeclaration("
jQuery(document).ready( function($) {
$( '.output-shipto-add' ).hide();
	amazonShowButton('" . $viewData['sellerId'] . "', '" . $viewData['redirect_page'] . "');
	var amazonButtonHtml = $('#checkout-advertise-box').html();
	$('#checkout-advertise-box').hide();
	 $('#checkoutFormSubmit').before(amazonButtonHtml);
	 $('.checkout-advertise').addClass('checkout-advertise');
});

");
}



?>
	<div id="payWithAmazonDiv">
		<img src="<?php echo $viewData['buttonWidgetImageURL'] ?>" style="cursor: pointer;"/>
	</div>
	<div id="amazonSignInErrorMsg" class="error"></div>
<?php if ($viewData['sign_in_display'] == 'advertise') { ?>
	<div><?php echo vmText::_('VMPAYMENT_AMAZON_OR') ?></div>
<?php } ?>