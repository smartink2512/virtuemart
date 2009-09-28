<?php
defined('_JEXEC') or die('Restricted access'); 
AdminMenuHelper::startAdminArea(); 

/* Load some behaviors we need */
JHTML::_('behavior.modal');
JHTML::_('behavior.tooltip');

/* Get the component name */
$option = JRequest::getWord('option');

/* Load some variables */
$search_date = JRequest::getVar('search_date', null); // Changed search by date
$now = getdate();
$nowstring = $now["hours"].":".$now["minutes"]." ".$now["mday"].".".$now["mon"].".".$now["year"];
$search_order = JRequest::getVar('search_order', '>');
$search_type = JRequest::getVar('search_type', 'product');
$category_id = JRequest::getInt('category_id', false);
?>
<div align="right">
	<form action="index.php" method="post" name="adminForm" id="adminForm"><?php echo JText::_('VM_PRODUCT_LIST_SEARCH_BY_DATE') ?>&nbsp;
		<select class="inputbox" name="search_type">
		<option value="product"><?php echo JText::_('VM_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRODUCT') ?></option>
		<option value="price" <?php echo $search_type == "price" ? 'selected="selected"' : ''; ?>><?php echo JText::_('VM_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRICE') ?></option>
		<option value="withoutprice" <?php echo $search_type == "withoutprice" ? 'selected="selected"' : ''; ?>><?php echo JText::_('VM_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_WITHOUTPRICE') ?></option>
		</select>
		<select class="inputbox" name="search_order">
		<option value="&lt;"><?php echo JText::_('VM_PRODUCT_LIST_SEARCH_BY_DATE_BEFORE') ?></option>
		<option value="&gt;" <?php echo $search_order == ">" ? 'selected="selected"' : ''; ?>><?php echo JText::_('VM_PRODUCT_LIST_SEARCH_BY_DATE_AFTER') ?></option>
		</select>
		<input type="hidden" name="option" value="com_virtuemart" />
		<input class="inputbox" type="text" size="15" name="search_date" value="<?php echo JRequest::getVar('search_date', $nowstring) ?>" />
		<input type="hidden" name="page" value="product.product_list" />
		<input class="button" type="submit" name="search" value="<?php echo JText::_('VM_SEARCH_TITLE')?>" />
	<br/>
	<?php echo JText::_('VM_PRODUCT_LIST_SEARCH_BY_NAME') ?>&nbsp;
		<input type="text" value="" name="keyword" size="25" class="inputbox" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="page" value="product.product_list" />
		<input class="button" type="submit" name="search" value="<?php echo JText::_('VM_SEARCH_TITLE')?>" />
</div>
<?php echo JText::_('VM_FILTER') ?>:
 <select class="inputbox" id="category_id" name="category_id" onchange="window.location='<?php echo $_SERVER['PHP_SELF'] ?>?option=com_virtuemart&view=product&task=product&category_id='+document.getElementById('category_id').options[selectedIndex].value;">
	<option value=""><?php echo JText::_('SEL_CATEGORY') ?></option>
	<?php echo $this->category_tree; ?>
</select>
<?php 
echo JHTML::tooltip(JText::_('VM_PRODUCT_LIST_REORDER_TIP'), JText::_('TIP'), 'tooltip.png', '', '', false);
$productlist = $this->productlist;
$pagination = $this->pagination;
?>
	<table class="adminlist">
	<thead>
	<tr>
		<td>#</td>
		<td><input type="checkbox" name="toggle" value="" onclick="checkAll('<?php echo count($productlist); ?>')" /></td>
		<td><?php echo JText::_('VM_PRODUCT_LIST_NAME'); ?></td>
		<td><?php echo JText::_('VM_PRODUCT_LIST_VENDOR_NAME'); ?></td>
		<td><?php echo JText::_('VM_PRODUCT_LIST_MEDIA'); ?></td>
		<td><?php echo JText::_('VM_PRODUCT_LIST_SKU'); ?></td>
		<td><?php echo JText::_('VM_PRODUCT_PRICE_TITLE'); ?></td>
		<td><?php echo JText::_('VM_CATEGORY'); ?></td>
		<!-- Only show reordering fields when a category ID is selected! -->
		<?php
		$num_rows = 0;
		if( $category_id ) { ?>
			<td><?php echo JText::_('VM_FIELDMANAGER_REORDER'); ?></td>
			<td><?php echo vmCommonHTML::getSaveOrderButton( $num_rows, 'changeordering' ); ?></td>
		<?php } ?>
		<td><?php echo JText::_('VM_MANUFACTURER_MOD'); ?></td>
		<td><?php echo JText::_('VM_REVIEWS'); ?></td>
		<td><?php echo JText::_('VM_PRODUCT_LIST_PUBLISH'); ?></td>
		<td><?php echo JText::_('VM_PRODUCT_CLONE'); ?></td>
		<td><?php echo JText::_('E_REMOVE'); ?></td>
		<td><?php echo JText::_('ID'); ?></td>
	</tr>
	</thead>
	<tbody>
	<?php
	if (count($productlist) > 0) {
		$i = 0;
		$k = 0;
		$keyword = JRequest::getVar('keyword');
		foreach ($productlist as $key => $product) {
			$checked = JHTML::_('grid.id', $i , $product->product_id);
			$published = JHTML::_('grid.published', $product, $i );
			?>
			<tr class="<?php echo "row$k"; ?>">
				<!-- Counter -->
				<td><?php echo $key + 1 + $pagination->limitstart;?></td>
				<!-- Checkbox -->
				<td><?php echo $checked; ?></td>
				<!-- Product name -->
				<?php 
				//$link = "index.php?page=product.product_form&limitstart=$pagination->limitstart&keyword=".urlencode($keyword)."&product_id=".$product->product_id."&product_parent_id=".$product->product_parent_id."&option=".$option;
				$link = 'index.php?option='.$option.'&view=product&task=edit&product_id='.$product->product_id.'&product_parent_id='.$product->product_parent_id;
				$child_link = '';
				if ($product->product_parent_id == 0 && $product->haschildren) {
					$child_link = '&nbsp;&nbsp;&nbsp;'.JHTML::_('link', JRoute::_('index.php?view=product&product_parent_id='.$product->product_id.'&option='.$option), '[ '.JText::_('VM_PRODUCT_FORM_ITEM_INFO_LBL').' ]');
				}
				?>
				<td><?php echo JHTML::_('link', JRoute::_($link), $product->product_name, array('title' => JText::_('EDIT').' '.$product->product_name)).$child_link; ?></td>
				<!-- Vendor name -->
				<td><?php echo $product->vendor_name; ?></td>
				<!-- Media -->
				<?php
					/* Create URL */
					$link = JRoute::_('index.php?view=media&product_id='.$product->product_id.'&option='.$option);
				?>
				<td><?php echo JHTML::_('link', $link, JHTML::_('image', JURI::root().'includes/js/ThemeOffice/media.png', JTEXT::_('MEDIA_MANAGER')).'<br />('.$product->mediaitems.')');?></td>
				<!-- Product SKU -->
				<td><?php echo $product->product_sku; ?></td>
				<!-- Product price -->
				<td><?php echo $product->product_price_display; ?></td>
				<!-- Category name -->
				<td><?php echo JHTML::_('link', JRoute::_('index.php?page=product.product_category_form&category_id='.$product->category_id.'&category_parent_id='.$product->category_parent_id.'&option='.$option), $product->category_name); ?></td>
				<!-- Reorder only when category ID is present -->
				<?php if( $category_id ) { ?>
					<?php
					$page = '';
					$tmp_cell = "<div align=\"center\">"
					. $pagination->orderUpIcon( $i, $i > 0)
					. "\n&nbsp;"
					. $pagination->orderDownIcon( $i, $pagination->total, $i-1 <= count($productlist))
					. "</div>";
					?>
					<td><?php echo $tmp_cell;?></td>
					
					<td><?php echo vmCommonHTML::getOrderingField( $product->product_list ); ?></td>
				<?php } ?>
				<!-- Manufacturer name -->
				<td><?php echo JHTML::_('link', JRoute::_('index.php?page=manufacturer.manufacturer_form&manufacturer_id='.$product->manufacturer_id.'&option='.$option), $product->mf_name); ?></td>
				<!-- Reviews -->
				<?php
					/* Create URL */
					$link = JRoute::_('index.php?page=product.review_form&product_id='.$product->product_id.'&no_menu=1&tmpl=component&option='.$option);
				?>
				<td><?php echo JHTML::_('link', $link, $product->reviews.' ['.JText::_('VM_REVIEW_FORM_LBL').']', array('class' => 'modal', 'rel' => '{handler: \'iframe\', size: {x: 800, y: 540}}')); ?></td>
				<!-- Published -->
				<td><?php echo $published; ?></td>
				<!-- Clone -->
				<?php 
				$url = 'index.php?page=product.product_form&clone_product=1&limitstart=$limitstart&keyword='.urlencode($keyword).'&product_id='.$product->product_id.'&option='.$option;
					if (!empty($product->product_parent_id)) $url .= '&product_parent_id='.$product->product_parent_id;
					$link = JRoute::_($url);
					$imglink = IMAGEURL.'/ps_image/copy.gif';
				?>
				<td><?php echo JHTML::_('link', $link,  JHTML::_('image', $imglink, JText::_('VM_PRODUCT_CLONE')))?></td>
				<!-- Remove -->
				<?php
					/* Create link */
					$link = JRoute::_('index.php?page=product.product_list&func=productDelete&product_id='.$product->product_id.'&keyword='.urlencode($keyword).'&limitstart=0&option='.$option);
				?>
				<td><?php echo JHTML::_('link', $link, JHTML::_('image', JURI::root().'/components/'.$option.'/shop_image/ps_image/delete.gif', JText::_('DELETE')), array('class' => 'toolbar', 'onclick' => 'return confirm(\''.JText::_('VM_DELETE_MSG').'\');')) ?></td>
				<!-- Product ID -->
				<td><?php echo $product->product_id; ?></td>
			</tr>
		<?php 
			$k = 1 - $k;
			$i++;
		}
	}	
	?>
	</tbody>
	<tfoot>
		<tr>
		<td colspan="16">
			<?php echo $pagination->getListFooter(); ?>
		</td>
		</tr>
	</tfoot>
	</table>
<!-- Hidden Fields -->
<input type="hidden" name="task" value="" />
<input type="hidden" name="option" value="com_virtuemart" />
<input type="hidden" name="pshop_mode" value="admin" />
<input type="hidden" name="page" value="product.product_list" />
<input type="hidden" name="view" value="product" />
<input type="hidden" name="func" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>
<?php AdminMenuHelper::endAdminArea(); ?> 