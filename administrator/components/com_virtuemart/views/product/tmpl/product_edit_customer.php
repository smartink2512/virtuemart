<?php
/**
*
* Handle the waitinglist
*
* @package	VirtueMart
* @subpackage Product
* @author RolandD
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: product_edit_waitinglist.php 3872 2011-08-15 16:56:50Z electrocity $
*/
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

 ?>

<?php
$mail_options = array(
					'customer'=> JText::_('COM_VIRTUEMART_PRODUCT_SHOPPERS'),
					'notify' => JText::_('COM_VIRTUEMART_PRODUCT_WAITING_LIST_USERLIST'),
				);
$mail_default = 'notify';
if ( VmConfig::get('stockhandle',0) != 'disableadd' || empty($this->waitinglist ) ) {
	$mail_default = 'customer';
	unset($mail_options['notify']);
}
echo VmHtml::radioList('customer_email_type',$mail_default,$mail_options);
?>

<div id="notify_particulars" style="padding-left:20px;">
	<div><input type="checkbox" name="notification_template" value="1" CHECKED><?php echo JText::_('COM_VIRTUEMART_PRODUCT_USE_NOTIFY_TEMPLATE'); ?></div>
	<div><input type="text" name="notify_number" value="" size="4"><?php echo JText::_('COM_VIRTUEMART_PRODUCT_NOTIFY_NUMBER'); ?></div>
</div>
<br />

<div class="mailing">
	<div class="button2-left" data-type="sendmail" >
		<div class="blank" style="padding:0 6px;cursor: pointer;" title="<?php echo jText::_('COM_VIRTUEMART_PRODUCT_EMAIL_SEND_TIP'); ?>">
			<span class="vmicon vmicon-16-email" ></span>
			<?php echo Jtext::_('COM_VIRTUEMART_PRODUCT_EMAIL_SEND'); ?>
		</div>
	</div>
	<br />
	<div class="clear"></div>
	
	
	<div id="customer-mail-content">
		<input type="text" class="mail-subject" size="40" value ="<?php echo jText::sprintf('COM_VIRTUEMART_PRODUCT_EMAIL_SHOPPERS_SUBJECT',$this->product->product_name) ?>">
		<div><?php echo Jtext::_('COM_VIRTUEMART_PRODUCT_EMAIL_CONTENT') ?></div>
		<textarea style="width: 100%;" class="inputbox" id="mail-body" cols="35" rows="10"></textarea>
		<br />
	</div>
	
	<div id="customer-mail-list">
		<?php echo $this->lists['OrderStatus'];?>
		<table class="adminlist" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th class="title"><?php echo JText::_('COM_VIRTUEMART_NAME');?></th>
					<th class="title"><?php echo JText::_('COM_VIRTUEMART_EMAIL');?></th>
					<th class="title"><?php echo JText::_('COM_VIRTUEMART_SHOPPER_FORM_PHONE');?></th>
					<th class="title"><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_QUANTITY');?></th>
				</tr>
			</thead>
			<tbody id="customers-list">
			<?php
			if (!empty($this->customers)) { 
				foreach ($this->customers as $virtuemart_order_user_id => $customer) {
					?>
						<tr class="customer" data-cid="<?php echo $virtuemart_order_user_id ?>">
							<td class=''><?php echo $customer['customer_name'] ?></td>
							<td><a class='mailto' href="<?php echo $customer['mail_to'] ?>"><span class='mail'><?php echo $customer['email'] ?></span></a></td>
							<td class='customer_phone'><?php echo $customer['customer_phone'] ?></td>
							<td class='quantity'><?php echo $customer['quantity'] ?></td>
						</tr>
					<?php
				}
			}
			?>
			</tbody>
		</table>
	</div>
		
	<div id="customer-mail-notify-list">
	
		<?php if ( VmConfig::get('stockhandle',0) == 'disableadd' && !empty($this->waitinglist ) ) { ?>
			<table class="adminlist" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th class="title"><?php echo JText::_('COM_VIRTUEMART_NAME');?></th>
						<th class="title"><?php echo JText::_('COM_VIRTUEMART_USERNAME');?></th>
						<th class="title"><?php echo JText::_('COM_VIRTUEMART_EMAIL');?></th>
					</tr>
				</thead>
				<tbody id="customers-notify-list">
				<?php
				if (isset($this->waitinglist) && count($this->waitinglist) > 0) {
					foreach ($this->waitinglist as $key => $wait) {
						if ($wait->virtuemart_user_id==0) {
							$row = '<tr><td></td><td></td><td><a href="mailto:' . $wait->notify_email . '">' . $wait->notify_email . '</a></td></tr>';
						}
						else {
							$row = '<tr><td>'.$wait->name.'</td><td>'.$wait->username . '</td><td>' . '<a href="mailto:' . $wait->notify_email . '">' . $wait->notify_email . '</a>' . '</td></tr>';
						}
						echo $row;
					}

				} else
				{ ?>
						<tr>
							<td colspan="4">
								<?php echo JText::_('COM_VIRTUEMART_PRODUCT_WAITING_NOWAITINGUSERS'); ?>
							</td>
						</tr>
					<?php
				} ?>
				</tbody>
			</table>

		<?php } ?>
	</div>
	
	
</div>

<script type="text/javascript">
<!--
var $customerMailLink = '<?php echo juri::root().'/index.php?option=com_virtuemart&view=productdetails&task=sentproductemailtoshoppers&virtuemart_product_id='.$this->product->virtuemart_product_id ?>';
var $customerMailNotifyLink = '<?php echo 'index.php?option=com_virtuemart&view=product&task=ajax_notifyUsers&virtuemart_product_id='.$this->product->virtuemart_product_id ?>';
var $customerListLink = '<?php echo 'index.php?option=com_virtuemart&view=product&format=json&type=userlist&virtuemart_product_id='.$this->product->virtuemart_product_id ?>';
var $customerListNotifyLink = '<?php echo 'index.php?option=com_virtuemart&view=product&task=ajax_waitinglist&virtuemart_product_id='.$this->product->virtuemart_product_id ?>';
var $customerListtype='reserved';

jQuery(document).ready(function(){
		
	populate_customer_list(jQuery('select#order_items_status').val());
	customer_initiliaze_boxes();
	jQuery("input:radio[name=customer_email_type],input:checkbox[name=notification_template]").click(function() { customer_initiliaze_boxes(); });
	jQuery('select#order_items_status').chosen({enable_select_all: false,select_some_options_text:vm2string.select_some_options_text}).change(function() { populate_customer_list(jQuery(this).val()); })		
	jQuery('.mailing .button2-left').click(function() {

		
		email_type = jQuery("input:radio[name=customer_email_type]:checked").val();
		if(email_type=='notify') {
		
			var $body = '';
			var $subject = '';
			if (jQuery('input:checkbox[name=notification_template]').is(':checked')); else {
				var $subject = jQuery('.mailing .mail-subject').val();
				var $body = jQuery('#mail-body').val();
			}
			var $max_number = jQuery('input[name=notify_number]').val();
			
			jQuery.post($customerMailNotifyLink,{ subject: $subject,mailbody: $body, max_number : $max_number, token : '<?php echo JUtility::getToken() ?>' },
				function(data){
					alert('<?php echo addslashes(JTExt::_('COM_VIRTUEMART_PRODUCT_NOTIFY_MESSAGE_SENT')); ?>');
					jQuery.getJSON($customerListNotifyLink,{tmpl:'component', no_html:1}, 
						function(data){
				//			jQuery("#customers-list").html(data.value);
							$html = '';
							jQuery.each(data, function(key, val) {
							
								if (val.virtuemart_user_id==0) {
									$html += '<tr><td></td><td></td><td><a href="mailto:'+val.notify_email+'">'+val.notify_email+'</a></td></tr>';
								}
								else {
									$html += '<tr><td>'+val.name+'</td><td>'+val.username+'</td><td><a href="mailto:'+val.notify_email+'">'+val.notify_email+'</a></td></tr>';
								}
							
							});
							jQuery("#customers-notify-list").html($html);
						}
					);
				}
			);

		}
		else if(email_type='customer') {
		
		
		
			var $subject = jQuery('.mailing .mail-subject').val();
			var $body = jQuery('#mail-body').val();
			var $statut = jQuery('select#order_items_status').val();
			jQuery.post($customerMailLink,{ subject: $subject,mailbody: $body, statut : $statut, token : '<?php echo JUtility::getToken() ?>' },
				function(data){
					jQuery("#customers-list").html('message sent');
				}
			);

			
		}
			
	});
		
});

/* JS for list changes */

	


	
function populate_customer_list($status) {
	if ($status == "undefined" || $status == null) $status = '';
	jQuery.getJSON($customerListLink,{ status : $status  },
		function(data){
			jQuery("#customers-list").html(data.value);
	});
}
function customer_initiliaze_boxes() {
	email_type = jQuery("input:radio[name=customer_email_type]:checked").val();
	if(email_type=='notify') {
		jQuery('#notify_particulars').show();
		jQuery('#customer-mail-list').hide();
		jQuery('#customer-mail-notify-list').show();
		jQuery("input:radio[name=customer_email_type]").val()
		if (jQuery('input:checkbox[name=notification_template]').is(':checked')) jQuery('#customer-mail-content').hide();
		else  jQuery('#customer-mail-content').show();
	
	}
	else if(email_type='customer') {
		jQuery('#notify_particulars').hide();
		jQuery('#customer-mail-content').show();
		jQuery('#customer-mail-list').show();
		jQuery('#customer-mail-notify-list').hide();
	}
}
-->
</script>