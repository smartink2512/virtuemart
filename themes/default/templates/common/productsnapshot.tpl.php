<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>
 
<span style="font-weight:bold;"><?php echo $product_name ?></span>
<br />

<a title="<?php echo $product_name ?>" href="<?php echo $product_link ?>">
	<?php
		// Print the product image or the "no image available" image
		echo ps_product::image_tag( $product_thumb_image, "alt=\"".$product_name."\"");
	?>
</a>
<br />

<?php
if( !empty($price) ) {
	echo $price;
}
?>
<?php
if( !empty($addtocart_link) ) {
	?>
	<br />
	
	<a title="<?php echo $VM_LANG->_PHPSHOP_CART_ADD_TO.": ".$product_name ?>" href="<?php echo $addtocart_link ?>">
		<?php echo $VM_LANG->_PHPSHOP_CART_ADD_TO ?></a>
	<br />
	<?php
}
?>