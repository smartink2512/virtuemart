<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<?php echo $VM_LANG->_PHPSHOP_ORDERBY ?>: 
<select class="inputbox" name="orderby" onchange="order.submit()">
<option value="product_name" ><?php echo $VM_LANG->_PHPSHOP_SELECT ?></option>
<?php
// SORT BY PRODUCT NAME
if( in_array( 'product_name', $VM_BROWSE_ORDERBY_FIELDS)) { ?>
        <option value="product_name" <?php echo $orderby=="product_name" ? "selected=\"selected\"" : "";?>>
        <?php echo $VM_LANG->_PHPSHOP_PRODUCT_NAME_TITLE ?></option>
<?php
}
// SORT BY PRODUCT SKU
if( in_array( 'product_sku', $VM_BROWSE_ORDERBY_FIELDS)) { ?>
        <option value="product_sku" <?php echo $orderby=="product_sku" ? "selected=\"selected\"" : "";?>>
        <?php echo $VM_LANG->_PHPSHOP_CART_SKU ?></option>
        <?php
}
// SORT BY PRODUCT PRICE
  if (_SHOW_PRICES == '1' && $auth['show_prices'] && in_array( 'product_price', $VM_BROWSE_ORDERBY_FIELDS)) { ?>
                <option value="product_price" <?php echo $orderby=="product_price" ? "selected=\"selected\"" : "";?>>
        <?php echo $VM_LANG->_PHPSHOP_PRODUCT_PRICE_TITLE ?></option><?php 
  } 
  // SORT BY PRODUCT CREATION DATE
if( in_array( 'product_cdate', $VM_BROWSE_ORDERBY_FIELDS)) { ?>
        <option value="product_cdate" <?php echo $orderby=="product_cdate" ? "selected=\"selected\"" : "";?>>
        <?php echo $VM_LANG->_PHPSHOP_LATEST ?></option>
        <?php
}
?>
</select>