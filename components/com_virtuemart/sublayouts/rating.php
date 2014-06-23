<?php defined('_JEXEC') or die('Restricted access');

$product = $viewData['product'];

if ($viewData['showRating']) {
	$maxrating = VmConfig::get('vm_maximum_rating_scale', 5);
	if (empty($product->rating)) {
	?>
	<span class="vote"><?php echo vmText::_('COM_VIRTUEMART_RATING') . ' ' . vmText::_('COM_VIRTUEMART_UNRATED') ?></span>
	<?php
	} else {
		$ratingwidth = $product->rating * 24;
		?>
		<span class="vote">
		<?php echo vmText::_('COM_VIRTUEMART_RATING') . ' ' . round($product->rating) . '/' . $maxrating; ?><br/>
					<span title=" <?php echo (vmText::_("COM_VIRTUEMART_RATING_TITLE") . round($product->rating) . '/' . $maxrating) ?>" class="ratingbox" style="display:inline-block;">
					<span class="stars-orange" style="width:<?php echo $ratingwidth.'px'; ?>">
					</span>
					</span>
				</span>
	<?php
	}
}