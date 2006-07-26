<table width="100%" cellspacing="0" cellpadding="0" border="0" >
  <tr>
    <td >
        <a style="font-size: 16px; font-weight: bold;" href="<?php echo $product_flypage ?>"><?php echo $product_name ?></a>
    </td>
  </tr>
  <tr>
    <td align="left" nowrap ><?php echo $product_price ?></td>
  </tr>
  <tr>
    <td ><a href="<?php echo $product_flypage ?>">
          <img src="<?php echo $product_thumb_image ?>" <?php echo $image_height ?> <?php echo $image_width ?> border="0" alt="<?php echo $product_name ?>" /></a>
    </td>
  </tr>
  <tr>
    <td height="80" valign="top"><?php echo $product_s_desc ?><br />
      <a style="font-size: 9px; font-weight: bold;" href="<?php echo $product_flypage ?>">[<?php echo $product_details ?>...]</a>
    </td>
  </tr>
  <tr>
    <td ><hr /></td>
  </tr>
  <tr>
    <td ><?php echo $product_rating ?></td>
  </tr>
  <tr>
    <td ><hr /></td>
  </tr>
  <tr>
    <td align="center"><?php echo $form_addtocart ?></td>
  </tr>
</table>
