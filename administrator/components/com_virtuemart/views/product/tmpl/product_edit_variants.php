<?php defined('_JEXEC') or die('Restricted access');
if ($this->product->product_parent_id == 0) {
	?>
	<table class="adminlist">
		<thead>
		<tr class="row1">
			<th colspan="<?php echo count($this->product->attribute_names)+2; ?>"><?php echo JText::_('VM_PRODUCT_FORM_PRODUCT_ITEMS_LBL') ?></th>
		</tr>
		<!-- Child products -->
		<tr class="row0">
			<th class="title"><?php echo JText::_('VM_PRODUCT_FORM_NAME') ?></th>
			<th class="title"><?php echo JText::_('VM_PRODUCT_FORM_SKU') ?></th>
			<?php
				foreach ($this->product->attribute_names as $key => $attribute_title) {
					?>
					<th class="title"><?php echo $attribute_title; ?></th>
					<?php
				}
			?> 
		</tr>
		</thead>
		<tbody>
		<?php
			foreach ($this->product->child_products as $product_sku => $child_product) {
				?>
				<tr class="row0">
					<td><?php
						$link = 'index.php?option='.$option.'&view=product&task=edit&product_id='.$child_product->product_id.'&product_parent_id='.$this->product->product_id;
						echo JHTML::_('link', JRoute::_($link), $child_product->product_name);
						?>
					</td>
					<td><?php echo $product_sku; ?> </td>
					<?php
						foreach ($this->product->attribute_names as $key => $attribute_title) {
							echo '<td>'.$child_product->$attribute_title.'</td>';
						}
					?>
				</tr>
			<?php } ?>
			</tbody>
	</table>
<?php
} elseif ($this->product->product_parent_id > 0) {?>
	<table class="adminform">
		<tr class="row0">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr class="row1">
			<td colspan="2"><strong><?php echo JText::_('VM_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL') ?></strong></td>
		</tr>
		<?php foreach ($this->product->attribute_names as $key => $attribute_title) { ?>
				<tr>
					<td width="21%" height="22" >
						<div style="text-align:right;font-weight:bold;"><?php
						echo $attribute_title . ":"?></div>
					</td>
					<td width="79%" >
						<input type="text" class="inputbox" name="attribute_<?php echo $this->product->attribute_values[$attribute_title]['attribute_id'];?>" size="32" maxlength="255" value="<?php echo $this->product->attribute_values[$attribute_title]['attribute_value']; ?>" />
					</td>
				</tr>
			<?php } ?>
	</table>
	<?php
}
	
	?>
	<table class="adminform">
		<tr class="row0">
			<td align="right" width="21%" valign="top"><div style="text-align:right;font-weight:bold;"><?php echo JText::_('VM_PRODUCT_FORM_ATTRIBUTE_LIST') ?>:</div></td>
			<td width="79%" id="attribute_container">
			<?php
			// ATTRIBUTE EXTENSION by Tobias (eaxs)
			// ps_product_attribute::loadAttributeExtension($db->sf("attribute"));
			echo '<input type="hidden" name="js_lbl_title" value="' . JText::_( 'VM_PRODUCT_FORM_TITLE' ) . '" />
		      <input type="hidden" name="js_lbl_property" value="' . JText::_( 'VM_PRODUCT_FORM_PROPERTY' ) . '" />
		      <input type="hidden" name="js_lbl_property_new" value="' . JText::_( 'VM_PRODUCT_FORM_PROPERTY_NEW' ) . '" />
		      <input type="hidden" name="js_lbl_attribute_new" value="' . JText::_( 'VM_PRODUCT_FORM_ATTRIBUTE_NEW' ) . '" />
		      <input type="hidden" name="js_lbl_attribute_delete" value="' . JText::_( 'VM_PRODUCT_FORM_ATTRIBUTE_DELETE' ) . '" />
		      <input type="hidden" name="js_lbl_price" value="' . JText::_( 'VM_CART_PRICE' ) . '" />' ;
		
		      
			// product has no attributes
			?>
			<table id="attributeX_table_0" cellpadding="0" cellspacing="0"
				border="0" class="adminform" width="30%">
				<tbody width="30%">
					<tr>
						<td width="5%"><?php
						echo JText::_( 'VM_PRODUCT_FORM_TITLE' ) ;
						?></td>
						<td align="left" colspan="2"><input type="text"
							name="attributeX[0][name]" value="" size="60" /></td>
						<td colspan="3" align="left"><a href="javascript: newAttribute(1)"><?php
						echo JText::_( 'VM_PRODUCT_FORM_ATTRIBUTE_NEW' ) ;
						?></a>
						| <a href="javascript: newProperty(0)"><?php
						echo JText::_( 'VM_PRODUCT_FORM_PROPERTY_NEW' ) ;
						?></a>
						</td>
					</tr>
					<tr id="attributeX_tr_0_0">
						<td width="5%">&nbsp;</td>
						<td width="10%" align="left"><?php
						echo JText::_( 'VM_PRODUCT_FORM_PROPERTY' ) ;
						?></td>
						<td align="left" width="20%"><input type="text"
							name="attributeX[0][value][]" value="" size="40" /></td>
						<td align="left" width="5%"><?php
						echo JText::_( 'VM_PRODUCT_PRICE_TITLE' ) ;
						?></td>
						<td align="left" width="60%"><input type="text"
							name="attributeX[0][price][]" size="10" value="" /></td>
					</tr>
				</tbody>
			</table>
		</tr>
		<tr class="row0">
			<td>&nbsp;</td>
			<td><?php echo JText::_('VM_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES') ?></td>
		</tr>
		<tr class="row0">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr class="row1">
			<td align="right" width="21%" valign="top"><div style="text-align:right;font-weight:bold;"><?php echo JText::_('VM_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST') ?>:</div></td>
			<td width="79%" >
				<input class="inputbox" type="text" name="product_custom_attribute" value="<?php $this->product->custom_attribute; ?>" size="64" />
		</tr>
		<tr class="row1">
			<td>&nbsp;</td>
			<td><?php echo JText::_('VM_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES') ?></td>
		</tr>
</table>
