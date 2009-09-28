<?php
/**
 * @Todo: Edit link like: http://csvi/administrator/index3.php?page=product.file_form&product_id=1&file_id=7&option=com_jmart&no_menu=1
 */
AdminMenuHelper::startAdminArea();

/* Load some behaviors we need */
JHTML::_('behavior.modal');
JHTML::_('behavior.tooltip');
jimport('joomla.filesystem.file');

/* Get the component name */
$option = JRequest::getWord('option');

/* Load some variables */
$keyword = JRequest::getVar('keyword', null);
?>
<div id="header">
	<div style="float: left;">
	<?php
	if (JRequest::getInt('product_id', false)) echo JHTML::_('link', JRoute::_('index.php?view=media&option='.$option), JText::_('JM_RETURN_PRODUCT_FILES_LIST'));
	?>
	</div>
	<div style="float: right;">
		<form action="index.php" method="post" name="adminForm" id="adminForm">
		<?php echo JText::_('JM_PRODUCT_FILES_LIST_SEARCH_BY_NAME') ?>&nbsp;
			<input type="text" value="" name="keyword" size="25" class="inputbox" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="page" value="product.file_list" />
			<input class="button" type="submit" name="search" value="<?php echo JText::_('JM_SEARCH_TITLE')?>" />
	</div>
</div>
<?php 
$productfileslist = $this->productfileslist;
$roles = $this->productfilesroles;
$pagination = $this->pagination;
?>
	<table class="adminlist">
	<thead>
	<tr>
		<th>#</td>
		<th><input type="checkbox" name="toggle" value="" onclick="checkAll('<?php echo count($productlist); ?>')" /></td>
		<th><?php echo JText::_('JM_PRODUCT_LIST_NAME'); ?></td>
		<th><?php echo JText::_('JM_FILES_LIST_FILENAME'); ?></td>
		<th><?php echo JText::_('JM_FILES_LIST_ROLE'); ?></td>
		<th><?php echo JText::_('JM_VIEW'); ?></td>
		<th><?php echo JText::_('JM_FILES_LIST_FILETITLE'); ?></td>
		<th><?php echo JText::_('JM_FILES_LIST_FILETYPE'); ?></td>
		<th><?php echo JText::_('JM_FILEMANAGER_PUBLISHED'); ?></td>
		<th><?php echo JText::_('E_REMOVE'); ?></td>
	</tr>
	</thead>
	<tbody>
	<?php
	if (count($productfileslist) > 0) {
		$i = 0;
		$k = 0;
		foreach ($productfileslist as $key => $productfile) {
			/* Create the filename but check if it is a URL first */
			if (strtolower(substr($productfile->file_name, 0, 4)) == 'http') {
				$filename = $productfile->file_name;
			}
			else $filename = JPATH_SITE.DS.'components'.DS.'com_jmart'.DS.'shop_image'.DS.'product'.DS.str_replace(JPATH_SITE, '', $productfile->file_name);
			$checked = JHTML::_('grid.id', $i , $productfile->file_id);
			if (!is_null($productfile->file_id)) $published = JHTML::_('grid.published', $productfile, $i );
			else $published = '';
			?>
			<tr>
				<!-- Counter -->
				<td><?php echo $key + 1 + $pagination->limitstart;?></td>
				<!-- Checkbox -->
				<td><?php echo $checked; ?></td>
				<!-- Product name -->
				<?php 
				$link = "index.php?view=media&limitstart=".$pagination->limitstart."&keyword=".urlencode($keyword)."&product_id=".$productfile->file_product_id."&option=".$option;
				?>
				<td><?php echo JHTML::_('link', JRoute::_($link), $productfile->product_name); ?></td>
				<!-- File name -->
				<?php 
				$link = "index.php?view=media&task=edit&limitstart=".$pagination->limitstart."&keyword=".urlencode($keyword)."&product_id=".$productfile->file_product_id."&file_id=".$productfile->file_id."&file_role=".$productfile->file_role."&option=".$option;
				?>
				<td><?php echo JHTML::_('link', JRoute::_($link), $productfile->file_name, array('title' => JText::_('EDIT').' '.$productfile->file_name)); ?></td>
				<!-- File role -->
				<td><?php
					if ($productfile->isdownloadable) {
						$role = 'isDownloadable';
					}
					else if (substr($productfile->file_name, 0, 4) == 'http') {
						$role = 'isRemoteFile';
					}
					else {
						$role = $productfile->file_role;
					}
					echo JHTML::_('image', $roles[$role], JTEXT::_($role), array('title' => JText::_($role)));
					?>
				</td>
				<!-- Preview -->
				<td>
				<?php
					if ($productfile->file_is_image) {
						$fullimg = $filename;
						$info = pathinfo( $fullimg );
						/* Full image */
						if (JFile::exists($fullimg) || (strtolower(substr($productfile->file_name, 0, 4)) == 'http')) {
							$imgsize = getimagesize($fullimg);
							if ($imgsize[0] > 800) $imgsize[0] = 800;
							if ($imgsize[1] > 600) $imgsize[1] = 600;
							echo JText::_('JM_FILES_LIST_FULL_IMG').": ";
							echo JHTML::_('link', $productfile->file_url, JText::_('JM_VIEW'), array('class' => 'modal', 'rel' => '{handler: \'iframe\', size: {x: '.$imgsize[0].', y: '.$imgsize[1].'}}'));
						}
						echo '<br />';
						/* Create the thumbnail file, this should be in the resized folder */
						if (is_null($productfile->product_thumb_image)) $basename = $info['basename'];
						else $basename = $productfile->product_thumb_image;
						$thumbimg = $info['dirname'].DS.'resized'.DS.$basename;
						/* Thumbnail image */
						if (JFile::exists($thumbimg)) {
							$imgsize = getimagesize($thumbimg);
							echo JText::_('JM_FILES_LIST_THUMBNAIL_IMG').": ";
							echo JHTML::_('link', JURI::root().str_ireplace(array(JPATH_SITE, '\\'), array('', '/'), $info['dirname']).'/resized/'.$basename, JText::_('JM_VIEW'), array('class' => 'modal', 'rel' => '{handler: \'iframe\', size: {x: '.($imgsize[0]+20).', y: '.($imgsize[1]+20).'}}'));
						}
						else echo JText::_('JM_THUMB_NOT_FOUND').': '.$thumbimg;
					}
				?>
				</td>
				<!-- File title -->
				<td><?php echo $productfile->file_title; ?></td>
				<!-- File extension -->
				<td><?php echo $productfile->file_extension; ?></td>
				<!-- Published -->
				<td><?php echo $published; ?></td>
				<!-- Remove -->
				<?php
					/* Create link */
					$url = 'index.php?view=media&task=remove&cid='.$productfile->file_id.'&keyword='.urlencode($keyword).'&option='.$option;
					$productid = JRequest::getInt('product_id', false);
					if ($productid) $url .= '&product_id='.$productid;
					$link = JRoute::_($url);
				?>
				<td><?php echo JHTML::_('link', $link, JHTML::_('image', JURI::root().'/components/'.$option.'/shop_image/ps_image/delete.gif', JText::_('DELETE')), array('class' => 'toolbar', 'onclick' => 'return confirm(\''.JText::_('JM_DELETE_MSG').'\');')) ?></td>
			</td>
		<?php 
			$k = 1 - $k;
			$i++;
		} 
	}	
	?>
	<tfoot>
	<tr>
	<td colspan="15">
		<?php echo $this->pagination->getListFooter(); ?>
	</td>
	</tr>
	</tfoot>
	</tbody>
	</table>
<!-- Hidden Fields -->
<input type="hidden" name="task" value="" />
<?php if (JRequest::getInt('product_id', false)) { ?>
	<input type="hidden" name="product_id" value="<?php echo JRequest::getInt('product_id'); ?>" />
<?php } ?>
<input type="hidden" name="option" value="com_jmart" />
<input type="hidden" name="pshop_mode" value="admin" />
<input type="hidden" name="view" value="media" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>
<?php AdminMenuHelper::endAdminArea(); ?> 