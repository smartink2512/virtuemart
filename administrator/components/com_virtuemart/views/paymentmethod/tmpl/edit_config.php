<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage Paymentmethod
* @author Max Milbers
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 2279 2010-01-31 15:15:38Z Milbo $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); 
//		echo 'Wie ist das mit dem Pfad? '.JPATH_PLUGINS.DS.'vmpayment'.DS.basename($this->paym->paym_element).'.xml';
//        if( $db->sf('element') ) {
		if($this->paym->paym_element){
//	        $parameters = new vmParameters($db->f('params'), ADMINPATH.'plugins/payment/'.basename($db->f('element')).'.xml', 'payment' );
	        $parameters = new vmParameters($this->paym->paym_params, JPATH_PLUGINS.DS.'vmpayment'.DS.basename($this->paym->paym_element).'.xml', 'payment' );
	        echo $parameters->render();
        }
        echo '<br />
<strong>'.JText::_('VM_PAYMENT_EXTRAINFO').':';
		echo JHTML::tooltip( JText::_('VM_PAYMENT_EXTRAINFO_TIP') ) 
	?>
<br />
<textarea class="inputbox" name="paym_extra_info" cols="120" rows="20"><?php echo htmlspecialchars( $this->paym->paym_extra_info ); ?></textarea>
<?php /*
<script type="text/javascript">
function check() {
   if (document.adminForm.type[0].checked == true || document.adminForm.type[1].checked == true) {
      document.getElementById('accepted_creditcards1').innerHTML = '<strong><?php echo JText::_('VM_PAYMENT_ACCEPTED_CREDITCARDS') ?>:';
      if (document.getElementById('accepted_creditcards_store').innerHTML != '')
        document.getElementById('accepted_creditcards2').innerHTML ='<input type="text" name="accepted_creditcards" value="' + document.getElementById('accepted_creditcards_store').innerHTML + '" class="inputbox" />';
      else
        document.getElementById('accepted_creditcards2').innerHTML = '<?php ps_creditcard::creditcard_checkboxes( $this->paym->paym_creditcard ); ?>';
   }
   else {
    try {
      document.getElementById('accepted_creditcards_store').innerHTML = document.adminForm.accepted_creditcards.value;
    }
    catch (e) {}
    document.getElementById('accepted_creditcards1').innerHTML = '';
    document.getElementById('accepted_creditcards2').innerHTML = '';
  }
}
check();
</script>*/
?>