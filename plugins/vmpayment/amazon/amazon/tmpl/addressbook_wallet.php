<?php
defined ('_JEXEC') or die();

/**
 * @author Valérie Isaksen
 * @version $Id$
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
?>

<?php
$doc = JFactory::getDocument();
$js="
//<![CDATA[
new OffAmazonPayments.Widgets.AddressBook({
  sellerId: '".$viewData['sellerId']."',
  amazonOrderReferenceId: '".$viewData['amazonOrderReferenceId']."',
    onAddressSelect: function(orderReference) {
   },
   design: {
      size : {width:'".$viewData['addressbook_designWidth']."px', height:'".$viewData['addressbook_designHeight']."px'}
   },
   onError: function(error) {
   $('#amazonAddressBookErrorMsg').text('".vmText::_('VMPAYMENT_AMAZON_ERROR_OCCURRED')."');
   }
 }).bind('addressBookWidgetDiv');


  var myWalletWidget = new OffAmazonPayments.Widgets.Wallet({
  sellerId: '".$viewData['sellerId']."',
  amazonOrderReferenceId: '". $viewData['amazonOrderReferenceId']."',
    design: {
      size : {width:'". $viewData['wallet_designWidth']."px', height:'". $viewData['wallet_designHeight']."px'}
    },

    onPaymentSelect: function(orderReference) {
    },
    onError: function(error) {
      $('#amazonWalletErrorMsg').text('".vmText::_('VMPAYMENT_AMAZON_ERROR_OCCURRED')."');
    }
  }).bind('walletWidgetDiv');





//]]>
";

?>
<h2><?php echo vmText::_('VMPAYMENT_AMAZON_SELECT_ADDRESS')?></h2>
<?php if ($viewData['renderAddressBook']) { ?>
<!-- AddressbookWidget -->
      <div id='addressBookWidgetDiv'></div>
<div id="amazonAddressBookErrorMsg" class="error"></div>
<?php
}
?>

<h2><?php echo vmText::_('VMPAYMENT_AMAZON_SELECT_PAYMENT')?></h2>

<!-- WalletWidget -->
      <span id='walletWidgetDiv'></span>
<div id="amazonWalletErrorMsg" class="error"></div>


<a  class="vm-button-correct" href="<?php echo $viewData['redirect_page']?>"><?php echo vmText::_('VMPAYMENT_AMAZON_BACK_TO_CART') ?></a>

<?php
echo '<script type="text/javascript">';
echo $js;
echo '</script>';
