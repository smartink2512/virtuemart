<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<form action="<?php echo $mm_action_url ?>index.php" method="post" name="addtocart" id="addtocart<?php echo $i ?>" class="addtocart_form" <?php if( $this->get_cfg( 'useAjaxCartActions', 1 )) { echo 'onsubmit="handleAddToCart( this.id );return false;"'; } ?>>
    <?php echo $ps_product_attribute->show_quantity_box($product_id,$product_id); ?><br />
	<input type="submit" class="addtocart_button" value="<?php echo $VM_LANG->_PHPSHOP_CART_ADD_TO  ?>" title="<?php echo $VM_LANG->_PHPSHOP_CART_ADD_TO ?>" />
    <input type="hidden" name="category_id" value="<?php echo  @$_REQUEST['category_id'] ?>" />
    <input type="hidden" name="product_id" value="<?php echo $product_id ?>" />
    <input type="hidden" name="prod_id[]" value="<?php echo $product_id ?>" />
    <input type="hidden" name="page" value="shop.cart" />
    <input type="hidden" name="func" value="cartadd" />
    <input type="hidden" name="Itemid" value="<?php echo $sess->getShopItemid() ?>" />
    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="set_price[]" value="" />
    <input type="hidden" name="adjust_price[]" value="" />
    <input type="hidden" name="master_product[]" value="" />
</form>