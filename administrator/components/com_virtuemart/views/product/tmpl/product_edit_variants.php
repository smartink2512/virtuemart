<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
	/** @todo handle child products */
?>
<table class="adminlist">
	<tr class="row0">
		<td>&nbsp;</td>
	</tr>
	<tr class="row1">
		<td><h2>
			<?php echo JText::_('VM_PRODUCT_FORM_PRODUCT_ITEMS_LBL') ?></h2>
		</td>
	</tr>
	<!-- Child products -->
	<tr class="row0">
		<th class="title"><?php echo JText::_('VM_PRODUCT_FORM_NAME') ?></th>
		<th class="title"><?php echo JText::_('VM_PRODUCT_FORM_SKU') ?></th>
		<th class="title"><?php echo JText::_('VM_PRODUCT_FORM_PRICE_NET') ?></th>
		<?php
			foreach ($this->attribute_titles as $key => $attribute_title) {
				?>
				<th class="title"><?php echo $attribute_title->attribute_name; ?></th>
				<?php
			}
		?> 
	</tr>
	<?php
		foreach ($this->attribute_items as $key => $attribute_item) {
			if (0) {
				/* No idea what this is supposed to do */
			?>
			<tr  class="row0">
				<td><?php
					$url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&product_id=" . $attribute_item->product_id . "&product_parent_id=$product_id";
					echo "<a href=\"" . $sess->url($url) . "\">". $attribute_item->product_name. '</a>'; ?>
				</td>
				<td><?php echo $attribute_item->product_sku; ?> </td>
				<td><?php
					$price = $ps_product->get_price($db_items->f("product_id"));
					$url  = $_SERVER['PHP_SELF'] . "?page=$modulename.product_price_list&product_id=" . $db_items->f("product_id") . "&product_parent_id=$product_parent_id";
					$url .= "&return_args=" . urlencode("page=$page&product_id=$product_id");
					echo "<a href=\"" . $sess->url($url) . "\">";
					if ($price) {
						if (!empty($price["item"])) {
							echo $price["product_price"];
						} else {
							echo "none";
						}
					} else {
						echo "none";
					}
					echo "</a>";
					?> 
				</td>
				<?php
					$db_detail = $ps_product->attribute_sql($db_items->f("product_id"),$product_id);
					while ($db_detail->next_record()) {
						echo '<td>'. $db_detail->f("attribute_value").'</td>';
					}
				?>
			</tr>
		<?php
				}
		}
		?>
	</table>
	<?php
	
	/*
	} elseif ($product_parent_id) {
		?>
		<table class="adminform">
		<tr class="row0">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr class="row1">
			<td colspan="2"><strong><?php echo JText::_('VM_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL') ?></strong></td>
		</tr>
		<?php
			if (!empty($_REQUEST['product_id'])) {
				$db_attribute = $ps_product->attribute_sql($product_id,$product_parent_id);
			} else {
				$db_attribute = $ps_product->attribute_sql("",$product_parent_id);
			}
			$num = 0;
			while ($db_attribute->next_record()) {
				$num++; ?>
				<tr  class="row<?php echo $num%2 ?>">
					<td width="21%" height="22" >
						<div style="text-align:right;font-weight:bold;"><?php
						echo $db_attribute->sf("attribute_name") . ":";
						$field_name = "attribute_$num"; ?></div>
					</td>
					<td width="79%" >
						<input type="text" class="inputbox"  name="<?php echo $field_name; ?>" size="32" maxlength="255" value="<?php $db_attribute->sp("attribute_value"); ?>" />
					</td>
				</tr>
			<?php
			} ?>
		</table>
	<?php
	}
	*/
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
