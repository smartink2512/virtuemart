<?php if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
mm_showMyFileName(__FILE__); ?>

<h3><?php echo $browsepage_lbl ?>
	<?php 
	if( $this->get_cfg( 'showFeedIcon', 1 ) && (JM_FEED_ENABLED == 1) ) { ?>
	<a href="index.php?option=<?php echo JM_COMPONENT_NAME ?>&amp;page=shop.feed" title="<?php echo JText::_('JM_FEED_SUBSCRIBE_TITLE') ?>">
	<img src="<?php echo JM_THEMEURL ?>/images/feed-icon-14x14.png" align="middle" alt="feed" border="0"/></a>
	<?php 
	} ?>
</h3>

