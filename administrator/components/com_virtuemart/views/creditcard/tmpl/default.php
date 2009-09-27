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
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->creditcards); ?>);" />
			</th>					
			<th>
				<?php echo JText::_( 'JM_CREDITCARD_NAME' ); ?>
			</th>				
			<th>
				<?php echo JText::_( 'JM_CREDITCARD_CODE' ); ?>
			</th>									
			<th width="20">
				<?php echo JText::_( 'E_REMOVE' ); ?>
			</th>										
		</tr>
		</thead>
		<?php
		$k = 0;
		for ($i=0, $n=count( $this->creditcards ); $i < $n; $i++) {
			$row =& $this->creditcards[$i];
			
			$checked = JHTML::_('grid.id', $i, $row->creditcard_id);
			//$published = JHTML::_('grid.published', $row, $i);
			$editlink = JROUTE::_('index.php?option=com_jmart&controller=creditcard&task=edit&cid[]=' . $row->creditcard_id);
			$deletelink	= JROUTE::_('index.php?option=com_jmart&controller=creditcard&task=remove&cid[]=' . $row->creditcard_id);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="10" align="right">
					<?php echo $row->creditcard_id; ?>
				</td>			            
				<td width="10">
					<?php echo $checked; ?>
				</td>
				<td align="left">
					<a href="<?php echo $editlink; ?>"><?php echo $row->creditcard_name; ?></a>
				</td>									
				<td>
					<?php echo JText::_($row->creditcard_code); ?>
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
	<input type="hidden" name="controller" value="creditcard" />
	<input type="hidden" name="view" value="creditcard" />	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>
            
            
            
<?php AdminMenuHelper::endAdminArea(); ?> 