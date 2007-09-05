<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>
<?php if(!@is_object( $pagenav)) return;  ?>
<!-- BEGIN PAGE NAVIGATION -->
<div align="center">
	<?php echo $pagenav->writePagesLinks( $search_string ); ?>
	<?php 
	if( $show_limitbox ) { ?>
		<br/><br/>
		<form action="<?php echo $search_string ?>" method="post">
			<?php echo $VM_LANG->_PN_DISPLAY_NR ?>&nbsp;&nbsp;
			<?php $pagenav->writeLimitBox( $search_string ); ?>
			
			<noscript><input class="button" type="submit" value="<?php echo $VM_LANG->_PHPSHOP_SUBMIT ?>" /></noscript>
		
		</form>
	<?php
	}
	echo $pagenav->writeLeafsCounter();
	?>
</div>
<!-- END PAGE NAVIGATION -->