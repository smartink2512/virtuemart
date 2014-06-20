<?php
/**
 * field tos
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL2, see LICENSE.php
 * @version $Id: cart.php 7682 2014-02-26 17:07:20Z Milbo $
 */

defined('_JEXEC') or die('Restricted access');
$products_per_row = $viewData['products_per_row'];
$currency = $viewData['currency'];
$showRating = $viewData['showRating'];
$verticalseparator = " vertical-separator";

$js = '
jQuery(document).ready(function() {
  jQuery(".valign-content").each(function() {
    var height = jQuery(this).height();
	var top = height / 2;
	jQuery(this).css("top", "-" + top + "px");
  });
})
';
$document = JFactory::getDocument ();
$document->addScriptDeclaration ($js);

foreach ($viewData['products'] as $type => $products ) {

	// Calculating Products Per Row
	$cellwidth = ' width'.floor ( 100 / $products_per_row );

	// Category and Columns Counter
	$col = 1;
	$nb = 1;
	$BrowseTotalProducts = count($products);
	//vmdebug('amount to browse '.$type,$BrowseTotalProducts);
	if(!empty($type)){
		$productTitle = vmText::_('COM_VIRTUEMART_'.$type.'_PRODUCT');
		?>
		<div class="<?php echo $type ?>-view">
		<h4><?php echo $productTitle ?></h4>
		<?php // Start the Output
	}

	foreach ( $products as $product ) {

		// Show the horizontal seperator
		if ($col == 1 && $nb > $products_per_row) { ?>
			<div class="horizontal-separator"></div>
		<?php }

		// this is an indicator wether a row needs to be opened or not
		if ($col == 1) { ?>
			<div class="row">
		<?php }

		// Show the vertical seperator
		if ($nb == $products_per_row or $nb % $products_per_row == 0) {
			$show_vertical_separator = ' ';
		} else {
			$show_vertical_separator = $verticalseparator;
		}

		// Show Products ?>
		<div class="product floatleft<?php echo $cellwidth . $show_vertical_separator ?>">
			<div class="spacer">

				<div class="clear">
					<div class="width40 floatleft valign-wrapper" style="height: <?php echo VmConfig::get ('img_height', '90') ?>px;">
						<div class="vm-products-media-container valign-content-wrapper">
							<div class="valign-content">
							<a title="<?php echo $product->product_name ?>" href="<?php echo $product->link; ?>">
								<?php
								echo $product->images[0]->displayMediaThumb('class="browseProductImage"', false);
								?>
							</a>
							</div>
						</div>
					</div>
					<div class="width60 floatleft valign-wrapper" style="height: <?php echo VmConfig::get ('img_height', '90') ?>px; position: relative;">
						<div class="valign-content-wrapper" style="position: absolute; height: 100%; top: 50%; width: 100%;">
						<div class="valign-content" style="position: absolute; margin: 0 auto; left:0; right: 0;">
						<?php
						echo shopFunctionsF::renderVmField('rating',array('showRating'=>$showRating, 'product'=>$product));
						if ( VmConfig::get ('display_stock', 1)) { ?>
							<span class="vmicon vm2-<?php echo $product->stock->stock_level ?>" title="<?php echo $product->stock->stock_tip ?>"></span>
						<?php
						} 
						
						?>
						</div>
						</div>
					</div>
				</div>
				<div class="clear">
							<!-- The "Average Customer Rating" Part -->
					<?php // Output: Average Product Rating
					
					//echo shopFunctionsF::renderVmField('stockhandle',array('product'=>$product));
					?>

					<?php //	<div class="width70 floatright"> ?>

						<h2><?php echo JHtml::link ($product->link, $product->product_name); ?></h2>

						<?php // Product Short Description
						if (!empty($product->product_s_desc)) {
							?>
							<p class="product_s_desc">
								<?php echo shopFunctionsF::limitStringByWord ($product->product_s_desc, 40, '...') ?>
							</p>
						<?php }

					echo shopFunctionsF::renderVmField('prices',array('product'=>$product,'currency'=>$currency));
					echo shopFunctionsF::renderVmField('addtocart',array('product'=>$product,'row'=>0)); ?>

					<div>
						<?php // Product Details Button
						echo JHtml::link ( JRoute::_ ( 'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id , FALSE), vmText::_ ( 'COM_VIRTUEMART_PRODUCT_DETAILS' ), array ('title' => $product->product_name, 'class' => 'product-details' ) );
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
		$nb ++;

		// Do we need to close the current row now?
		if ($col == $products_per_row || $nb>$BrowseTotalProducts) { ?>
			<div class="clear"></div>
			</div>
			<?php
			$col = 1;
		} else {
			$col ++;
		}
	}

	if(!empty($type)){
		// Do we need a final closing row tag?
		//if ($col != 1) {
		?>
			<div class="clear"></div>
			</div>
		<?php
		//}
	}
}
