<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<?php 
$catcount = 1;
$count = count( $category_list );
if( $count > 1 ) {
	$category_list = array_reverse( $category_list );
}


foreach( $category_list as $category ) { ?>
	<a class="pathway" href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?page=shop.browse&category_id=$category[category_id]")?>">
		<?php
			echo $category['category_name']
		?> 
	</a>
	<?php
	if( $catcount < $count || isset( $product_name )) {
		// This prints the separator image (uses the one from the template if available!)
		// Cat1 * Cat2 * ...
		echo vmCommonHTML::pathway_separator();
		
	}
	$catcount++;
}
if(isset($return_link)) {
    
    echo $return_link;
}
 
// Print the Product Name if it is available
echo isset($product_name) ? $product_name : ''; 
?>