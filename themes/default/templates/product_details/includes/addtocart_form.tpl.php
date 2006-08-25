<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<div>
    <form action="<?php echo $mm_action_url ?>index.php" method="post" name="addtocart" id="addtocart" class="addtocart_form">

<?php

// This function lists all product children ( = Items)
// or, when not children are defined, the product_id
// SO LEAVE THIS IN HERE!
echo $ps_product_attribute->list_attribute($product_id);

// This function lists the "advanced" simple attributes
echo $ps_product_attribute->list_advanced_attribute($product_id);
// This function lists the "custom" simple attributes
echo $ps_product_attribute->list_custom_attribute($product_id);

if (USE_AS_CATALOGUE != '1' && $product_price != "" && !stristr( $product_price, $VM_LANG->_PHPSHOP_PRODUCT_CALL )) {
	?>
    <p><label for="quantity" class="quantity_box"><?php echo $VM_LANG->_PHPSHOP_CART_QUANTITY ?>:</label>
        <input type="text" class="inputbox" size="4" id="quantity" name="quantity" value="1" />&nbsp;
        <input type="submit" class="addtocart_button" value="<?php echo $VM_LANG->_PHPSHOP_CART_ADD_TO ?>" title="<?php echo $VM_LANG->_PHPSHOP_CART_ADD_TO ?>" />
    </p>
    <input type="hidden" name="flypage" value="shop.<?php echo $flypage ?>" />
	<input type="hidden" name="page" value="shop.cart" />
    <input type="hidden" name="manufacturer_id" value="<?php echo $manufacturer_id ?>" />
    <input type="hidden" name="category_id" value="<?php echo $category_id ?>" />
    <input type="hidden" name="func" value="cartAdd" />
    <input type="hidden" name="option" value="<?php echo $option ?>" />
    <input type="hidden" name="Itemid" value="<?php echo $Itemid ?>" />
    <?php
}
?>
	</form>
</div>