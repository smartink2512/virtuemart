<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<div class="vmCartContainer">
    
<?php

// This function lists all product children ( = Items)
// or, when not children are defined, the product_id
// SO LEAVE THIS IN HERE!
list($html,$children) = $ps_product_attribute->list_attribute($product_id,$product_price);

if ($children != "multi") { 
?>
    <form action="<?php echo $mm_action_url ?>index.php" method="post" name="addtocart" id="addtocart" class="addtocart_form" onsubmit="handleAddToCart( this.id );return false;">

<?php
}
echo $html;

if (USE_AS_CATALOGUE != '1' && $product_price != "" && !stristr( $product_price, $VM_LANG->_PHPSHOP_PRODUCT_CALL )) {
	?>
        <?php if ($children != "multi") { ?> 
    <div style="float: right;vertical-align: middle;"> <?php if ($children == "drop") { 
    echo $ps_product_attribute->show_quantity_box($product_id,$product_id);
     } 
     if ($children == "radio") {
        echo $ps_product_attribute->show_radio_quantity_box();
     }?>    
    <input type="submit" class="addtocart_button" value="<?php echo $VM_LANG->_PHPSHOP_CART_ADD_TO ?>" title="<?php echo $VM_LANG->_PHPSHOP_CART_ADD_TO ?>" />
    </div>
    <?php  } ?>    
    <input type="hidden" name="flypage" value="shop.<?php echo $flypage ?>" />
	<input type="hidden" name="page" value="shop.cart" />
    <input type="hidden" name="manufacturer_id" value="<?php echo $manufacturer_id ?>" />
    <input type="hidden" name="category_id" value="<?php echo $category_id ?>" />
    <input type="hidden" name="func" value="cartAdd" />
    <input type="hidden" name="option" value="<?php echo $option ?>" />
    <input type="hidden" name="Itemid" value="<?php echo $Itemid ?>" />
    <input type="hidden" name="set_price[]" value="" />
    <input type="hidden" name="adjust_price[]" value="" />
    <input type="hidden" name="master_product[]" value="" />
    <?php
}
if ($children != "multi") { ?>
	</form></div>
<?php } 
    if($children == "radio") {?>
    
    <script language="JavaScript" type="text/javascript">//<![CDATA[
    function alterQuantity(myForm) {
        for (i=0;i<myForm.selItem.length;i++){
            setQuantity = myForm.elements['quantity'];
            selected = myForm.elements['selItem'];
            j = selected[i].id.substr(7);
            k= document.getElementById('quantity' + j);
            if (selected[i].checked==true){
                k.value = myForm.quantity_adjust.value; }
            else {
                k.value  = 0;
            }
        }
    }
//]]>   
</script>
<?php } ?>
</div>