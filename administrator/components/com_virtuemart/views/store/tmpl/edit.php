<?php 
defined('_JEXEC') or die('Restricted access');

AdminMenuHelper::startAdminArea(); 
?>
<form action="index.php" method="post" name="adminForm">

<div class="col50">
	<table class="adminform">			
	<tr><td valign="top">	
		<fieldset class="adminform">
		<legend><?php echo JText::_('VM_STORE_MOD') ?></legend>
		<table class="adminform">			
			<tr>
				<td class="key">
					<label for="title">
						<?php echo JText::_('VM_STORE_FORM_STORE_NAME'); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="vendor_store_name" id="vendor_store_name" size="50" value="<?php echo $this->store->vendor_store_name; ?>" />				
				</td>
			</tr>		
			<tr>
				<td class="key">
					<label for="title">
						<?php echo JText::_('VM_STORE_FORM_COMPANY_NAME'); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="vendor_name" id="vendor_name" size="50" value="<?php echo $this->store->vendor_name; ?>" />										
				</td>
			</tr>		
			<tr>
				<td class="key">
					<label for="title">
						<?php echo JText::_('VM_PRODUCT_FORM_URL'); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="vendor_url" id="vendor_url" size="50" value="<?php echo $this->store->vendor_url; ?>" />				
				</td>
			</tr>
			<tr>
				<td class="key">
					<label for="title">
						<?php echo JText::_('VM_STORE_FORM_ADDRESS_1'); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="address_1" id="address_1" size="50" value="<?php echo $this->store->userInfo->address_1; ?>" />				
				</td>
			</tr>
			<tr>
				<td class="key">
					<label for="title">
						<?php echo JText::_('VM_STORE_FORM_ADDRESS_2'); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="address_2" id="address_2" size="50" value="<?php echo $this->store->userInfo->address_2; ?>" />				
				</td>
			</tr>
			<tr>
				<td class="key">
					<label for="title">
						<?php echo JText::_('VM_STORE_FORM_CITY'); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="city" id="city" size="50" value="<?php echo $this->store->userInfo->city; ?>" />				
				</td>
			</tr>				
			<tr>
				<td class="key">
					<label for="title">
						<?php echo JText::_('VM_STORE_FORM_COUNTRY'); ?>:
					</label>
				</td>
				<td>
					<?php echo ShopFunctions::renderCountryList($this->store->userInfo->country);?>														
				</td>
			</tr>
			<tr>
				<td class="key">
					<label for="title">
						<?php echo JText::_('VM_STORE_FORM_STATE'); ?>:
					</label>
				</td>
				<td>
					<?php echo ShopFunctions::renderStateList($this->store->userInfo->state, $this->store->userInfo->country);?>											
				</td>
			</tr>		
		</table>
		</fieldset>	
		
		<fieldset class="adminform">
		<legend><?php echo JText::_('VM_STORE_FORM_LBL') ?></legend>
		<table class="adminform">			
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_('VM_STORE_FORM_FULL_IMAGE'); ?>:
					</label>
				</td>
				<td>
					<?php ImageHelper::displayImage($this->store->vendor_full_image, 'Shop Image'); ?>
				</td>
			</tr>		
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_STORE_FORM_UPLOAD' ); ?>:
					</label>
				</td>
				<td>
					<input type="file" name="vendor_full_image" id="vendor_full_image" size="25" class="inputbox"  />										
				</td>
			</tr>		
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_STORE_FORM_MPOV' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="vendor_min_pov" id="vendor_min_pov" size="10" value="<?php echo $this->store->vendor_min_pov; ?>" />				
				</td>
			</tr>			
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_FREE_SHIPPING_AMOUNT' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="vendor_freeshipping" id="vendor_freeshipping" size="10" value="<?php echo $this->store->vendor_freeshipping; ?>" />				
				</td>
			</tr>						
		</table>
		</fieldset>		
	</td>
	<td valign="top">	
		<fieldset class="adminform">
		<legend><?php echo JText::_('VM_STORE_FORM_CONTACT_LBL') ?></legend>
		<table class="adminform">			
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_STORE_FORM_LAST_NAME' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="last_name" id="last_name" size="50" value="<?php echo $this->store->userInfo->last_name; ?>" />				
				</td>
			</tr>		
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_STORE_FORM_FIRST_NAME' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="first_name" id="first_name" size="50" value="<?php echo $this->store->userInfo->first_name; ?>" />										
				</td>
			</tr>		
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_STORE_FORM_MIDDLE_NAME' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="middle_name" id="middle_name" size="20" value="<?php echo $this->store->userInfo->middle_name; ?>" />				
				</td>
			</tr>	
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_STORE_FORM_TITLE' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="title" id="title" size="10" value="<?php echo $this->store->userInfo->title; ?>" />				
				</td>
			</tr>
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_STORE_FORM_PHONE_1' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="phone_1" id="phone_1" size="20" value="<?php echo $this->store->userInfo->phone_1; ?>" />				
				</td>
			</tr>
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_STORE_FORM_PHONE_2' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="phone_2" id="phone_2" size="20" value="<?php echo $this->store->userInfo->phone_2; ?>" />				
				</td>
			</tr>
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_STORE_FORM_FAX' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="fax" id="fax" size="20" value="<?php echo $this->store->userInfo->fax; ?>" />				
				</td>
			</tr>	
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_STORE_FORM_EMAIL' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="email" id="email" size="50" value="<?php echo $this->store->email; ?>" />				
				</td>
			</tr>																		
		</table>	
		</fieldset>
		
		<fieldset class="adminform">
		<legend><?php echo JText::_('VM_CURRENCY_DISPLAY') ?></legend>
		<table class="adminform">			
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_STORE_FORM_CURRENCY' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="creditcard_name" id="creditcard_name" size="50" value="<?php echo $this->creditcard->creditcard_name; ?>" />				
				</td>
			</tr>		
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_CURRENCY_SYMBOL' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="vendor_id" id="vendor_id" size="50" value="<?php echo $this->creditcard->vendor_id; ?>" />										
				</td>
			</tr>		
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_CURRENCY_DECIMALS' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="creditcard_code" id="creditcard_code" size="10" value="<?php echo $this->creditcard->creditcard_code; ?>" />				
				</td>
			</tr>	
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_CURRENCY_DECIMALSYMBOL' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="creditcard_code" id="creditcard_code" size="10" value="<?php echo $this->creditcard->creditcard_code; ?>" />				
				</td>
			</tr>
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_CURRENCY_THOUSANDS' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="creditcard_code" id="creditcard_code" size="10" value="<?php echo $this->creditcard->creditcard_code; ?>" />				
				</td>
			</tr>
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_CURRENCY_POSITIVE_DISPLAY' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="creditcard_code" id="creditcard_code" size="10" value="<?php echo $this->creditcard->creditcard_code; ?>" />				
				</td>
			</tr>
			<tr>
				<td width="110" class="key">
					<label for="title">
						<?php echo JText::_( 'VM_CURRENCY_NEGATIVE_DISPLAY' ); ?>:
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="creditcard_code" id="creditcard_code" size="10" value="<?php echo $this->creditcard->creditcard_code; ?>" />				
				</td>
			</tr>																
		</table>	
		</fieldset>
			
	</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="adminform">
				<tr>
					<td>
						<fieldset>
							<legend><?php echo JText::_('VM_STORE_FORM_DESCRIPTION');?></legend>
							<?php echo $this->editor->display('vendor_store_desc', $this->store->vendor_store_desc, '100%', 220, 70, 15)?>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<fieldset>
							<legend><?php echo JText::_('VM_STORE_FORM_TOS');?></legend>
							<?php echo $this->editor->display('vendor_terms_of_service', $this->store->vendor_terms_of_service, '100%', 220, 70, 15)?>
						</fieldset>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	</table>
	
</div>

	<input type="hidden" name="option" value="com_virtuemart" />
	<input type="hidden" name="view" value="store" />
	<input type="hidden" name="cid" value="<?php echo $this->store->vendor_id; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>


<?php AdminMenuHelper::endAdminArea(); ?> 