<?php 
defined('_JEXEC') or die('Restricted access'); 

AdminMenuHelper::startAdminArea(); 

?>

<form action="index.php" method="post" name="adminForm">
    <div id="editcell">
	<table class="adminlist">
	    <thead>
		<tr>
		    <th width="10">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->manufacturerCategories); ?>);" />
		    </th>
		    <th>
			<?php echo JText::_( 'VM_MANUFACTURER_CAT_NAME' ); ?>
		    </th>
		    <th>
			<?php echo JText::_( 'VM_MANUFACTURER_CAT_DESCRIPTION' ); ?>
		    </th>
		    <th>
			<?php echo JText::_( 'VM_MANUFACTURER_CAT_MANUFACTURERS' ); ?>
		    </th>
		</tr>
	    </thead>
	    <?php
	    $k = 0;
	    for ($i=0, $n=count( $this->manufacturerCategories ); $i < $n; $i++) {
		$row = $this->manufacturerCategories[$i];
		/**
		 * @todo Add to database layout published column
		 */
		$row->published = 1;
		$checked = JHTML::_('grid.id', $i, $row->mf_category_id);
		$editlink = JROUTE::_('index.php?option=com_virtuemart&controller=manufacturerCategory&task=edit&cid[]=' . $row->mf_category_id);
		$mfglink = JROUTE::_('index.php?option=com_virtuemart&view=manufacturer&category=' . $row->mf_category_id);
		?>
	    <tr class="<?php echo "row$k"; ?>">
		<td width="10">
			<?php echo $checked; ?>
		</td>
		<td align="left">
			<?php echo JHTML::_('link', $editlink, JText::_($row->mf_category_name)); ?>
		</td>
		<td align="left">
			<?php echo JText::_($row->mf_category_desc); ?>
		</td>
		<td align="left">
		    <?php echo JHTML::_('link', $mfglink, JText::_('VM_MANUFACTURER_LIST_LBL')); ?>
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
    <input type="hidden" name="controller" value="manufacturerCategory" />
    <input type="hidden" name="view" value="manufacturerCategory" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
</form>



<?php AdminMenuHelper::endAdminArea(); ?> 