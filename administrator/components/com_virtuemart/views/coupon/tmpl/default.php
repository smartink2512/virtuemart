<?php 
defined('_JEXEC') or die('Restricted access'); 

AdminMenuHelper::startAdminArea(); 

?>
      	
<form action="index.php" method="post" name="adminForm">
	<div id="editcell">
		<table class="adminlist">
		<thead>
		<tr>
			<th>
				<?php echo JText::_( '#' ); ?>
			</th>		            
			<th width="10">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->coupons); ?>);" />
			</th>					
			<th>
				<?php echo JText::_( 'VM_COUPON_CODE_HEADER' ); ?>
			</th>				
			<th>
				<?php echo JText::_( 'VM_COUPON_PERCENT_TOTAL' ); ?>
			</th>
			<th>
				<?php echo JText::_( 'VM_COUPON_TYPE' ); ?>
			</th>				
			<th>
				<?php echo JText::_( 'VM_COUPON_VALUE_HEADER' ); ?>
			</th>	
			<th>
				<?php echo JText::_( 'VM_COUPON_VALUE_VALID_AT' ); ?>
			</th>																				
			<th width="20">
				<?php echo JText::_( 'E_REMOVE' ); ?>
			</th>										
		</tr>
		</thead>
		<?php
		$k = 0;
		for ($i=0, $n=count($this->coupons); $i < $n; $i++) {
			$row = $this->coupons[$i];
			
			$checked = JHTML::_('grid.id', $i, $row->coupon_id);
			$published = JHTML::_('grid.published', $row, $i);
			$editlink = JROUTE::_('index.php?option=com_virtuemart&view=coupon&task=edit&cid[]=' . $row->coupon_id);
			$deletelink	= JROUTE::_('index.php?option=com_virtuemart&view=coupon&task=remove&cid[]=' . $row->coupon_id);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="10" align="right">
					<?php echo $row->coupon_id; ?>
				</td>			            
				<td width="10">
					<?php echo $checked; ?>
				</td>
				<td align="left">
					<a href="<?php echo $editlink; ?>"><?php echo $row->coupon_code; ?></a>
				</td>									
				<td>
					<?php echo JText::_($row->percent_or_total); ?>
				</td>
				<td align="left">
					<?php echo JText::_($row->coupon_type); ?>
				</td>									
				<td>
					<?php echo JText::_($row->coupon_value); ?>
				</td>	
				<td align="left">
					<?php echo JText::_($row->coupon_value_valid); ?>
				</td>																	
				<td align="center">
					<?php echo JHTML::_('link', $deletelink, JHTML::_('image', JURI::base().'components/com_virtuemart/assets/images/delete.gif', JText::_('DELETE')), array('class' => 'toolbar', 'onclick' => 'return confirm(\''.JText::_('VM_DELETE_MSG').'\');')) ?>
				</td>				        																														
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		<tfoot>
			<tr>
				<td colspan="10">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>		
	</table>	
</div>
	        
	<input type="hidden" name="option" value="com_virtuemart" />
	<input type="hidden" name="controller" value="coupon" />
	<input type="hidden" name="view" value="coupon" />	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>
            
            
            
<?php AdminMenuHelper::endAdminArea(); ?> 