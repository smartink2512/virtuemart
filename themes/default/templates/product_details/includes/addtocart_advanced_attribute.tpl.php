<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 

foreach($attributes as $attribute) { 		
    foreach( $attribute as $attr => $val ) {
        // Using this we make all the variables available in the template
        // translated example: $this->set( 'product_name', $product_name );
        $this->set( $attr, $val );
    }
    ?>
    <div class="vmAttribChildDetail" style="float: left;width:30%;text-align:right;margin:3px;">
        <label for="<?php echo $attribute['titlevar'] ?>_field"><?php echo $attribute['title'] ?></label>:
    </div>
    <div class="vmAttribChildDetail" style="float:left;width:60%;margin:3px;">
        <select class="inputboxattrib" id="<?php echo $attribute['titlevar'] ?>_field" name="<?php echo $attribute['titlevar'].$attribute['product_id'] ?>">
        <?php echo $attribute['options_list'] ?>
        </select>
    </div>
    <br style=\"clear:both;\" />
    
<?php } ?>