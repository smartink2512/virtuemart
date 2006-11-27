<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<?php echo $buttons_header // The PDF, Email and Print buttons ?>

<?php 
if( $this->get_cfg( 'showPathway' )) {
	echo $navigation_pathway;
} ?>
<table border="0" align="center" style="width: 100%;" >
    <tr>
	    <td rowspan="1" colspan="2" align="center">
	        <div style="text-align: center;">
                <h1><?php echo $product_name; echo ' ' . $edit_link; ?></h1>
            </div>
        </td>
        <td>
        </td>
    </tr>
    <tr>
        <td>
	        <?php echo $product_s_desc ?>
	    </td>
    </tr>
    <tr>
	    <td colspan=2><hr style="width: 100%; height: 2px;" /></td>
    </tr>
    <tr>
        <td align="left" valign="top" width="220">
            <div float:left><?php echo $product_image ?></div>
        </td>
        <td valign="top">
            <div style="text-align: center;">
            <span style="font-style: italic;"></span><?php echo $addtocart ?><span style="font-style: italic;"></span></div>
        </td></tr>
        <tr>
  <td rowspan="1" colspan="2"><?php echo $manufacturer_link ?><br /></td>
</tr>
<tr>
      <td valign="top" align="left"><?php echo $product_price ?><br /></td>
</tr>
<tr>
      <td valign="top"><?php echo $product_packaging ?><br /></td>
</tr>
	<tr>
	  <td ><?php echo $ask_seller ?></td>
	</tr>
	<tr>
	    <td rowspan="1" colspan=2>
            <hr style="width: 100%; height: 2px;" />
            <?php echo $product_description ?>
	        <br/><span style="font-style: italic;"><?php echo $file_list ?></span>
        </td>
	</tr>
	<tr><hr style="width: 100%; height: 2px;" />
	    <td colspan="2"><?php 
	    	echo $related_products
	    	?><br />
	    </td>
	</tr>
    <tr>
	    <td colspan="2"><hr style="width: 100%; height: 2px;" />
        <div style="text-align: center;">
                </div>
                <?php echo $navigation_childlist ?><br /></td>
	</tr>
    
	<tr>
	  <td colspan="2"><?php echo $product_reviewform ?><br /></td>
	</tr>
  <tr>
	  <td colspan="3"><div style="text-align: center;"><?php echo $vendor_link ?><br /></div><br /></td>
	</tr>
</table><br style="clear:both"/>
<div class="back_button"><a href='javascript:history.go(-1)'> <?php echo _BACK ?></a></div>
