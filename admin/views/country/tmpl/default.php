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
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->countries); ?>);" />
			</th>			
			<th>
				<?php echo JText::_( 'JM_COUNTRY_LIST_NAME' ); ?>
			</th>				
			<th>
				<?php echo JText::_( 'JM_ZONE_ASSIGN_CURRENT_LBL' ); ?>
			</th>						
			<th>
				<?php echo JText::_( 'JM_COUNTRY_LIST_3_CODE' ); ?>
			</th>	
			<th>
				<?php echo JText::_( 'JM_COUNTRY_LIST_2_CODE' ); ?>
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
		for ($i=0, $n=count( $this->countries ); $i < $n; $i++) {
			$row =& $this->countries[$i];
			
			$checked = JHTML::_('grid.id', $i, $row->country_id);
			$published = JHTML::_('grid.published', $row, $i);
			$editlink = JROUTE::_('index.php?option=com_jmart&controller=country&task=edit&cid[]=' . $row->country_id);
			$statelink	= JROUTE::_('index.php?option=com_jmart&view=state&country_id=' . $row->country_id);
			$deletelink	= JROUTE::_('index.php?option=com_jmart&controller=country&task=remove&cid[]=' . $row->country_id);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="10" align="right">
					<?php echo $row->country_id; ?>
				</td>			            
				<td width="10">
					<?php echo $checked; ?>
				</td>
				<td align="left">
					<a href="<?php echo $editlink; ?>"><?php echo $row->country_name; ?></a>
					<a href="<?php echo $statelink; ?>">&nbsp;[States]</a>
				</td>					
				<td align="left">
					<?php echo JText::_($row->zone_id); ?>
				</td>				
				<td>
					<?php echo JText::_($row->country_2_code); ?>
				</td>	
				<td>
					<?php echo JText::_($row->country_3_code); ?>
				</td>	
				<td align="center">
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
	<input type="hidden" name="controller" value="country" />
	<input type="hidden" name="view" value="country" />	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>
            
            
<?php AdminMenuHelper::endAdminArea(); ?> 