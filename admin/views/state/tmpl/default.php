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
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->states ); ?>);" />
			</th>			
			<th>
				<?php echo JText::_( 'JM_STATE_LIST_NAME' ); ?>
			</th>				
			<th>
				<?php echo JText::_( 'JM_ZONE_ASSIGN_CURRENT_LBL' ); ?>
			</th>						
			<th>
				<?php echo JText::_( 'JM_STATE_LIST_3_CODE' ); ?>
			</th>	
			<th>
				<?php echo JText::_( 'JM_STATE_LIST_2_CODE' ); ?>
			</th>
			<th width="20">
				<?php echo JText::_( 'JM_COUNTRY_PUBLISH' ); ?>
			</th>				
			<th width="20">
				<?php echo JText::_( 'E_REMOVE' ); ?>
			</th>										
		</tr>
		</thead>
		<?php
		$k = 0;

		for ($i=0, $n=count( $this->states ); $i < $n; $i++) {
			$row =& $this->states[$i];
			
			$checked = JHTML::_('grid.id', $i, $row->state_id);
			$published = JHTML::_('grid.published', $row, $i);
			$editlink = JROUTE::_('index.php?option=com_jmart&controller=state&task=edit&cid[]=' . $row->state_id);
//			$statelink	= JROUTE::_('index.php?option=com_jmart&view=country&state_id=' . $row->state_id);
			$deletelink	= JROUTE::_('index.php?option=com_jmart&controller=state&task=remove&cid[]=' . $row->state_id);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="10" align="right">
					<?php echo $row->state_id; ?>
				</td>			            
				<td width="10">
					<?php echo $checked; ?>
				</td>
				<td align="left">
					<a href="<?php echo $editlink; ?>"><?php echo $row->state_name; ?></a>
				</td>					
				<td align="left">
					<?php echo JText::_($row->zone_id); ?>
				</td>				
				<td>
					<?php echo JText::_($row->state_2_code); ?>
				</td>	
				<td>
					<?php echo JText::_($row->state_3_code); ?>
				</td>	
				<td>
					<?php echo $published; ?>
				</td>	
				<td align="center">
					<?php echo JHTML::_('link', $deletelink, JHTML::_('image', JURI::base().'components/com_jmart/assets/images/delete.gif', JText::_('DELETE')), array('class' => 'toolbar', 'onclick' => 'return confirm(\''.JText::_('JM_DELETE_MSG').'\');')) ?>
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
	        
	<input type="hidden" name="option" value="com_jmart" />
	<input type="hidden" name="controller" value="state" />
	<input type="hidden" name="view" value="state" />	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="country_id" value="<?php echo $this->country_id; ?>" value="0" />	
</form>
            
            
            
<?php AdminMenuHelper::endAdminArea(); ?> 