<?php defined('_JEXEC') or die('Restricted access'); ?>
<table width="100%">
	<tr>
		<td width="50%">
			<table class="adminform">
				<tr class="row1">
					<td align="left" colspan="2"><?php echo '<h2>'.$this->status_label.'</h2>'; ?></td>
				</tr>
				<tr class="row0">
					<td width="21%">
						<div style="text-align:right;font-weight:bold;">
						<?php echo JText::_('JM_PRODUCT_FORM_IN_STOCK') ?>:</div>
					</td>
					<td width="79%">
						<input type="text" class="inputbox"  name="product_in_stock" value="<?php $this->product->product_in_stock; ?>" size="10" />
					</td>
				</tr>
				<!-- low stock notification -->
				<tr class="row1">
					<td width="21%">
						<div style="text-align:right;font-weight:bold;">
							<?php echo JText::_( 'JM_LOW_STOCK_NOTIFICATION' ); ?>:
						</div>
					</td>
					<td width="79%">
						<input type="text" class="inputbox" name="low_stock_notification" value="<?php $this->product->low_stock_notification; ?>" size="3" />
					</td>
				</tr>
				<!-- end low stock notification -->
				<tr class="row0"> 
					<td width="21%">
						<div style="text-align:right;font-weight:bold;">
							<?php echo JText::_('JM_PRODUCT_FORM_MIN_ORDER') ?>:
						</div>
					</td>
					<td width="79%">
						<input type="text" class="inputbox"  name="min_order_level" value="<?php echo $this->min_order; ?>" size="10" />
					</td>
				</tr>
				<tr class="row1"> 
					<td width="21%">
						<div style="text-align:right;font-weight:bold;">
							<?php echo JText::_('JM_PRODUCT_FORM_MAX_ORDER') ?>:
						</div>
					</td>
					<td width="79%">
						<input type="text" class="inputbox"  name="max_order_level" value="<?php echo $this->max_order; ?>" size="10" />
					</td>
				</tr>
				<tr class="row0"> 
					<td width="21%" >
						<div style="text-align:right;font-weight:bold;">
							<?php echo JText::_('JM_PRODUCT_FORM_AVAILABLE_DATE') ?>:
						</div>
					</td>
					<td width="79%" >
						<input class="inputbox" type="text" name="product_available_date" id="product_available_date" size="20" maxlength="19" value="<?php echo date('Y-m-d', $this->product->product_available_date ); ?>" />
						<input name="reset" type="reset" class="button" onClick="return showCalendar('product_available_date', 'y-mm-dd');" value="..." />
					</td>
				</tr>
				<tr class="row1"><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td valign="top" width="21%" >
						<div style="text-align:right;font-weight:bold;">
							<?php echo JText::_('JM_AVAILABILITY') ?>:
						</div>
					</td>
					<td width="79%" >
						<input type="text" class="inputbox" name="product_availability" value="<?php $this->product->product_availability; ?>" />
						<?php
						$path = JM_THEMEPATH."images/availability";
						echo JHTML::_('list.images', 'image', $this->product->product_availability, null, $path); 
							// echo vmToolTip(JText::_('JM_PRODUCT_FORM_AVAILABILITY_TOOLTIP1'));
						?>
					</td>
				</tr>
				<tr class="row1">
					<td width="21%" >
						<div style="text-align:right;font-weight:bold;">
						<?php echo JText::_('JM_PRODUCT_FORM_SPECIAL') ?>:</div>
					</td>
					<td width="79%" >
						<?php
							$checked = '';
							if (strtoupper($this->product->product_special) == "Y") $checked = 'checked="checked"' ?>
							<input type="checkbox" name="product_special" value="Y" <?php echo $checked; ?> />
					</td>
				</tr>
				<tr class="row0">
					<td colspan="2">&nbsp;</td>
				</tr>
			</table>
		</td>
		<td width="50%" valign="top">
			<table class="adminform">
				<tr class="row1">
					<td colspan="3"><h2><?php echo JText::_('JM_RELATED_PRODUCTS'); ?></h2></td>
				</tr>
				<tr class="row0">
					<td style="vertical-align:top;"><br />
						<?php echo JText::_('JM_PRODUCT_RELATED_SEARCH'); ?>
						<input type="text" size="40" name="search" id="relatedProductSearch" value="" />
					</td>
					<td>
						<input type="button" name="remove_related" onclick="removeSelectedOptions(relatedSelection, 'related_products');" value="&nbsp; &lt; &nbsp;" />
					</td>
					<td>
						<?php
						if (0) {
						$relProducts = array();
						foreach( $this->related_products as $relProd ) {
							$relProducts[$relProd] = $ps_product->get_field( $relProd, 'product_sku'). ", ". $ps_product->get_field( $relProd, 'product_name');
						}
						echo ps_html::selectList('relProds', '', $relProducts, 10, 'multiple="multiple"', 'id="relatedSelection" ondblclick="removeSelectedOptions(relatedSelection, \'related_products\');"');
						}
						?>
						<input type="hidden" name="related_products" value="<?php echo implode('|', $related_products ) ?>" />
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
