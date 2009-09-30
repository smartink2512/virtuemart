<?php 
defined('_JEXEC') or die('Restricted access');

AdminMenuHelper::startAdminArea(); 
?>

<form action="index.php" method="post" name="adminForm">


<div class="col50">
	<fieldset class="adminform">
	<legend><?php echo JText::_('Shipping Carrier'); ?></legend>
	<table class="admintable">			
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'VM_RATE_FORM_NAME' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="shipping_carrier_name" id="shipping_carrier_name" size="50" value="<?php echo $this->carrier->shipping_carrier_name; ?>" />				
			</td>
		</tr>					
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'VM_RATE_FORM_LIST_ORDER' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="shipping_carrier_list_order" id="shipping_carrier_list_order" size="3" value="<?php echo $this->carrier->shipping_carrier_list_order; ?>" />				
			</td>
		</tr>		
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'VM_RATE_FORM_CARRIER' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="shipping_carrier_name" id="shipping_carrier_name" size="50" value="<?php echo $this->carrier->shipping_carrier_name; ?>" />				
			</td>
		</tr>					
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'VM_RATE_FORM_COUNTRY' ); ?>:
				</label>
			</td>
			<td>
				<?php echo JHTML::_('Select.genericlist', $this->countries, 'shipping_rate_country', '', 'country_id', 'country_name', $this->rate->shipping_rate_country); ?>			
			</td>
		</tr>		
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'VM_RATE_FORM_ZIP_START' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="shipping_carrier_name" id="shipping_carrier_name" size="50" value="<?php echo $this->carrier->shipping_carrier_name; ?>" />				
			</td>
		</tr>					
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'VM_RATE_FORM_ZIP_END' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="shipping_carrier_list_order" id="shipping_carrier_list_order" size="3" value="<?php echo $this->carrier->shipping_carrier_list_order; ?>" />				
			</td>
		</tr>				
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'VM_RATE_FORM_WEIGHT_START' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="shipping_carrier_name" id="shipping_carrier_name" size="50" value="<?php echo $this->carrier->shipping_carrier_name; ?>" />				
			</td>
		</tr>					
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'VM_RATE_FORM_WEIGHT_END' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="shipping_carrier_list_order" id="shipping_carrier_list_order" size="3" value="<?php echo $this->carrier->shipping_carrier_list_order; ?>" />				
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'VM_RATE_FORM_VALUE' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="shipping_carrier_name" id="shipping_carrier_name" size="50" value="<?php echo $this->carrier->shipping_carrier_name; ?>" />				
			</td>
		</tr>					
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'VM_RATE_FORM_PACKAGE_FEE' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="shipping_carrier_list_order" id="shipping_carrier_list_order" size="3" value="<?php echo $this->carrier->shipping_carrier_list_order; ?>" />				
			</td>
		</tr>	
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'VM_RATE_FORM_CURRENCY' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="shipping_carrier_name" id="shipping_carrier_name" size="50" value="<?php echo $this->carrier->shipping_carrier_name; ?>" />				
			</td>
		</tr>					
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'VM_RATE_FORM_VAT_ID' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="shipping_carrier_list_order" id="shipping_carrier_list_order" size="3" value="<?php echo $this->carrier->shipping_carrier_list_order; ?>" />				
			</td>
		</tr>										
	</table>
	</fieldset>
</div>

	<input type="hidden" name="option" value="com_virtuemart" />
	<input type="hidden" name="shipping_rate_id" value="<?php echo $this->rate->shipping_rate_id; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="controller" value="shippingrate" />
</form>


<?php AdminMenuHelper::endAdminArea(); ?> 