<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<h3><?php echo $browsepage_lbl ?></h3>

<div style="text-align:left;">
	<?php echo $navigation_childlist; ?>
</div>
<?php if( trim(str_replace( "<br />", "" , $desc)) != "" ) { ?>

		<div style="width:100%;float:left;">
			<?php echo $desc; ?>
		</div>
		<br style="clear:both;" /><br />
		<?php
     }
?>