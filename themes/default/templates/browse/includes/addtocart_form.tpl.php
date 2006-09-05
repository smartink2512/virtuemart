<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<form action="<?php echo $mm_action_url ?>index.php" method="post" name="addtocart" id="addtocart<?php echo $i ?>" class="addtocart_form">
    <label for="quantity_<?php echo $i ?>"><?php echo $VM_LANG->_PHPSHOP_CART_QUANTITY ?>:</label>
    <input id="quantity_<?php echo $i ?>" class="inputbox" type="text" size="3" name="quantity" value="<?php echo mosGetParam( $_REQUEST, 'quantity', 1 ); ?>" />
    <br />
	<input type="submit" class="addtocart_button" value="<?php echo $VM_LANG->_PHPSHOP_CART_ADD_TO  ?>" title="<?php echo $VM_LANG->_PHPSHOP_CART_ADD_TO ?>" />
    <input type="hidden" name="category_id" value="<?php echo  @$_REQUEST['category_id'] ?>" />
    <input type="hidden" name="product_id" value="<?php echo $product_id ?>" />
    <input type="hidden" name="page" value="shop.cart" />
    <input type="hidden" name="func" value="cartadd" />
    <input type="hidden" name="Itemid" value="<?php echo $sess->getShopItemid() ?>" />
    <input type="hidden" name="option" value="com_virtuemart" />
</form>