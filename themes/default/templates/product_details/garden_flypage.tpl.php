<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<p><?php echo $navigation_pathway ?></p>
<p><?php echo $navigation_childlist ?></p>
<table border="0" align="center" style="width: 100%;">
  <tbody>
	<tr>
	  <td rowspan="1">
	  <h1><?php echo $product_name ?> <?php echo $edit_link ?></h1>
	  &nbsp;<?php echo $manufacturer_link ?>
	  </td>
<td align="center" valign="top" rowspan="4"><?php echo $product_image ?><br/><br/><?php echo $more_images ?></td>
	</tr>
	<tr>
	  <td rowspan="1"><font size="2"><?php echo $product_price ?></font><br /></td>
	</tr>
	<tr>
	  <td style="text-align: center;"><br /></td>
	</tr>
	<tr>
	  <td rowspan="1">
	  	<hr style="width: 100%; height: 2px;" />
	  	<p><?php echo $product_description ?></p>
	  	<span style="font-style: italic;"><?php echo $file_list ?></span></td>
	</tr>
	<tr>
	  <td><hr style="width: 100%; height: 2px;" />
	  	<div style="text-align: center;">
	  		<?php echo $addtocart ?>
	  	</div>
	  </td>
	  <td style="text-align: center;" rowspan="1"><?php echo $product_availability ?></td>
	</tr>
	<tr>
	  <td colspan="2"><?php echo $product_type ?></td>
	</tr>
	<tr>
	  <td colspan="2"><hr /><?php echo $product_reviews ?></td>
	</tr>
	<tr>
	  <td colspan="2"><?php echo $product_reviewform ?><br /></td>
	</tr>
	<tr>
	  <td colspan="2"><?php echo $related_products ?><br /></td>
	</tr>
	<tr>
	  <td rowspan="1" colspan="2">
	  	<div style="text-align: center;"><?php echo $vendor_link ?></div>
	  	<br />
	  </td>
	</tr>
  </tbody>
</table>
