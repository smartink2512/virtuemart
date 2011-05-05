<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage Manufacturer Category
* @author Patrick Kohl
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 3172 2011-05-05 10:20:37Z Electrocity $
*/
 
// Check to ensure this file is included in Joomla!
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
				<?php echo JText::_('COM_VIRTUEMART_MANUFACTURER_CATEGORY_NAME'); ?>
			</th>				
				
			<th>
				<?php echo JText::_('COM_VIRTUEMART_MANUFACTURER_CATEGORY_DESC'); ?>
			</th>								
			<th>
				<?php echo JText::_('COM_VIRTUEMART_MANUFACTURER_LIST'); ?>
			</th>	
			<th width="20">
				<?php echo JText::_('COM_VIRTUEMART_PUBLISH'); ?>
			</th>													
		</tr>
		</thead>
		<?php
		$k = 0;
		for ($i=0, $n=count( $this->manufacturerCategories ); $i < $n; $i++) {
			$row =& $this->manufacturerCategories[$i];
			
			$checked = JHTML::_('grid.id', $i, $row->mf_category_id);
			$published = JHTML::_('grid.published', $row, $i);
			$editlink = JROUTE::_('index.php?option=com_virtuemart&controller=manufacturerCategory&task=edit&cid[]=' . $row->mf_category_id);
			$manufacturersList = JROUTE::_('index.php?option=com_virtuemart&view=manufacturer&mf_category_id=' . $row->mf_category_id);

			?>
			<tr class="<?php echo "row$k"; ?>">
				<td width="10">
					<?php echo $checked; ?>
				</td>
				<td align="left">
					<a href="<?php echo $editlink; ?>"><?php echo $row->mf_category_name; ?></a>
					
				</td>					
				<td>
					<?php echo JText::_($row->mf_category_desc); ?>
				</td>	
				<td>
					<a href="<?php echo $manufacturersList; ?>">Manufacturers</a>
				</td>	
				<td align="center">
					<?php echo $published; ?>
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