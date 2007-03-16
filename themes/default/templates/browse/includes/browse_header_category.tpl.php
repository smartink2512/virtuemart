<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>

<h3><?php echo $browsepage_lbl; ?> 
	<?php 
	if( $this->get_cfg( 'showFeedIcon', 1 )) { ?>
	<a href="index.php?option=<?php echo VM_COMPONENT_NAME ?>&amp;page=shop.feed&amp;category_id=<?php echo $category_id ?>" title="<?php echo $VM_LANG->_VM_FEED_SUBSCRIBE_TOCATEGORY_TITLE ?>">
	<img src="<?php echo VM_THEMEURL ?>/images/feed-icon-14x14.png" align="middle" alt="feed" border="0"/></a>
	<?php 
	} ?>
</h3>

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