<div style="width:100%;padding: 0px 3px 3px 3px;">
    <div style="float:left;width:20%;">
        <script type="text/javascript">//<![CDATA[
        document.write('<a href="javascript:void window.open(\'<?php echo $image_url ?>product/<?php echo $product_full_image ?>\', \'win2\', \'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=<?php echo $full_image_width ?>,height=<?php echo $full_image_height ?>,directories=no,location=no\');">');
        document.write('<img src="<?php echo $product_thumb_image ?>" <?php echo $image_height ?> <?php echo $image_width ?> border="0" title="<?php echo $product_name ?>" alt="<?php echo $product_name ?>" /></a>' );
        //]]>
        </script>
        <noscript>
            <a href="<?php echo $image_url ?>product/<?php echo $product_full_image ?>" target="_blank" title="<?php echo $product_name ?>">
            <img src="<?php echo $product_thumb_image ?>" <?php echo $image_height ?> <?php echo $image_width ?> border="0" title="<?php echo $product_name ?>" alt="<?php echo $product_name ?>" />
            </a>
        </noscript>
        
    </div>
    <div>
        <h3><a style="font-size: 16px; font-weight: bold;" title="<?php echo $product_name ?>" href="<?php echo $product_flypage ?>">
            <?php echo $product_name ?></a>
        </h3>
        
        <div style="float:left;width:80%;">
            <?php echo $product_s_desc ?>&nbsp;
            <a href="<?php echo $product_flypage ?>" title="<?php echo $product_details ?>"><?php echo $product_details ?>...</a>
        </div>
        <br style="clear:both" />
        <div style="float:left;width:30%;">
            <?php echo $product_price ?>
        </div>
        <div style="float:left;width:30%;text-align:center">
        <?php echo $form_addtocart ?>
        </div>
        <div style="float:left;width:30%;">
        <?php echo $product_rating ?>
        </div>
    </div>
</div>
