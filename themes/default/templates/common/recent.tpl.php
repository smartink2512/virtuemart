<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<!-- List of recent products -->
<h3><?php echo $VM_LANG->_VM_RECENT_PRODUCTS ?></h3>

<?php 
foreach( $recent_products as $recent ) { // Loop through all recent products
	foreach( $recent as $attr => $val ) {
    	//echo $attr." - ".$val."<br />";
        $this->set( $attr, $val );
    }
	/**
	 * Available indexes:
	 * 
	 * $recent["product_name"] => The user ID of the comment author
	 * $recent["category_name"] => The username of the comment author
	 * $recent["product_thumb_image"] => The name of the comment author
	 * $recent["product_url"] => The UNIX timestamp of the comment ("when" it was posted)
	 * $recent["category_url"] => The rating; an integer from 1 - 5
	 * $recent["product_s_desc"] => The comment text
	 * 
	 */
	?>
	<div class="vmRecentDetail">
	<a href="<?php echo $recent["product_url"]; ?>" >
	&nbsp;
	<?php echo $recent["product_name"]; ?></a>&nbsp;From&nbsp;
	<a href="<?php echo $recent["category_url"]; ?>" ><?php echo $recent["category_name"]; ?></a>
	</div>
	<?php
}

?>