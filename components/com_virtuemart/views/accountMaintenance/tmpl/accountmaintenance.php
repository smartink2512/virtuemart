<?php 
defined('_JEXEC') or die('Restricted access');

if ($this->auth['is_registered_customer']) {
?>
  <strong><?php echo JText::_('VM_ACC_CUSTOMER_ACCOUNT') ?></strong>
  <?php echo $this->user->name; ?><br />
  <br />
  <table border="0" cellspacing="0" cellpadding="10" width="100%" align="center">
  
<?php if( $this->user->id > 0)  { ?>
    <tr>
      <td>
      <strong>
      	<?php echo JHTML::_('link', JRoute::_(Vmconfig::getVar('secureurl')."index.php?option=com_virtuemart&page=account.billing"), 
      				JHTML::_('image', JURI::root().'components/com_virtuemart/assets/images/identity.png', JText::_('VM_ACCOUNT_TITLE')).' '.JText::_('VM_ACC_ACCOUNT_INFO')); ?>
       </strong>
       <br /><?php echo JText::_('VM_ACC_UPD_BILL') ?>
      </td>
    </tr>
    <?php
    if (Vmconfig::getVar('no_shipto') != '1') {
	?>
		<tr><td>&nbsp;</td></tr>
		
		<tr>
		  <td><hr />
		  <strong>
		  	<?php echo JHTML::_('link', JRoute::_(Vmconfig::getVar('secureurl')."index.php?option=com_virtuemart&page=account.shipping"), 
		  				JHTML::_('image', JURI::root().'components/com_virtuemart/assets/images/web.png', JText::_('VM_ACC_SHIP_INFO')).' '.JText::_('VM_ACC_SHIP_INFO')); ?>
		  </strong>
                        <br />
                        <?php echo JText::_('VM_ACC_UPD_SHIP') ?>
                  </td>
                </tr>
                <?php
	}
	?>
    <tr><td>&nbsp;</td></tr>
<?php } ?>
    <tr>
      <td>
      	<hr />
      	<strong>
      	<?php echo JHTML::_('image', JURI::root().'components/com_virtuemart/assets/images/package.png', JText::_('VM_ACC_ORDER_INFO')).' '.JText::_('VM_ACC_ORDER_INFO'); ?>
	    </strong>
        <?php 
        //$ps_order->list_order("A", "1" ); 
        ?>
      </td>
    </tr>
    
</table>
<!-- Body ends here -->
<?php 
} 
else { 
	// You're not allowed... you need to login.
    echo JText::_('DO_LOGIN') .'<br/><br/><br/>';
   // include(PAGEPATH.'checkout.login_form.php');
} 
?>