<div style="width:100%;padding: 0px 3px 3px 3px;">
  <h2>
        <a style="font-size: 16px; font-weight: bold;" href="<?php echo $product_flypage ?>"><?php echo $product_name ?></a>
  </h2>
  
  <p><?php echo $product_price ?></p>
  <div style="float:left;width:90%" ><a href="<?php echo $product_flypage ?>" title="<?php echo $product_name ?>">
          <img src="<?php echo $product_thumb_image ?>" <?php echo $image_height ?> <?php echo $image_width ?> border="0" alt="<?php echo $product_name ?>" /></a>
   </div>
  
  <br style="clear:both;" />
  
  <p><?php echo $product_s_desc ?><br />
      <a style="font-size: 9px; font-weight: bold;" href="<?php echo $product_flypage ?>">[<?php echo $product_details ?>...]</a>
  </p>
   <p><?php echo $product_rating ?></p>
  <p><?php echo $form_addtocart ?></p>
</div>
