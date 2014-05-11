<?php
defined ('_JEXEC') or die();

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
$js="
//<![CDATA[
$(document).ready(function () {

 var amazonOrderReferenceId='".$viewData['amazonOrderReferenceId']."';

if (amazonOrderReferenceId != '') {
			$('#payWithAmazonDiv').click(function () {
				window.location = '".$viewData['redirect_page']."&session='
        + amazonOrderReferenceId';
			});
		} else {

 new OffAmazonPayments.Widgets.Button ({
   sellerId: '".$viewData['sellerId']."',
   onSignIn: function(orderReference) {
     amazonOrderReferenceId = orderReference.getAmazonOrderReferenceId();
     window.location = '".$viewData['redirect_page']."&session='
        + amazonOrderReferenceId
   },
   onError: function(error) {
   $('#amazonSignInErrorMsg').text('".vmText::_('VMPAYMENT_AMAZON_ERROR_OCCURRED')."');
   }
 }).bind('payWithAmazonDiv');
 }
});
//]]>
";


$js="
//<![CDATA[
 var amazonOrderReferenceId;

 new OffAmazonPayments.Widgets.Button ({
   sellerId: '".$viewData['sellerId']."',
   onSignIn: function(orderReference) {
     amazonOrderReferenceId = orderReference.getAmazonOrderReferenceId();
     window.location = '".$viewData['redirect_page']."&session='
        + amazonOrderReferenceId
   },
   onError: function(error) {
   $('#amazonSignInErrorMsg').text('".vmText::_('VMPAYMENT_AMAZON_ERROR_OCCURRED')."');
   }
 }).bind('payWithAmazonDiv');

//]]>
";
$doc->addScriptDeclaration($js);

?>
<div id="payWithAmazonDiv">
	<img src="<?php echo $viewData['buttonWidgetImageURL'] ?>" style="cursor: pointer;" />
</div>
<div id="amazonSignInErrorMsg" class="error"></div>
