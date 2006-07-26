<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<div class="buttons_heading">
<?php 
$pdf_link = "index2.php?option=$option&page=shop.pdf_output&showpage=$page&pop=1&output=pdf&product_id=$product_id&category_id=$category_id";
?>
<?php echo vmCommonHTML::PdfIcon( $pdf_link ); ?>
<?php echo vmCommonHTML::PrintIcon(); ?>
<?php echo vmCommonHTML::EmailIcon($product_id); ?>

</div>