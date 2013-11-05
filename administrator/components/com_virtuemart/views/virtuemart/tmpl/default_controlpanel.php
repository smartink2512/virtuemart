<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage Config
* @author RickG
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default_system.php 3477 2011-06-11 12:50:50Z Milbo $
*/
 
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); 

// Include ALU System
require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'liveupdate'.DS.'liveupdate.php';

?> 

<div id="cpanel">

    <?php if ($this->canDo->get('core.admin') || $this->canDo->get('vm.product')) { ?>
	<div class="icon"><?php VmImage::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=product'), 'vm_shop_products_48', JText::_('COM_VIRTUEMART_PRODUCT_S')); ?></div>
    <?php } ?>
    <?php if ($this->canDo->get('core.admin') || $this->canDo->get('vm.category')) { ?>
	<div class="icon"><?php VmImage::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=category'), 'vm_shop_categories_48', JText::_('COM_VIRTUEMART_CATEGORY_S')); ?></div>
    <?php } ?>
    <?php if ($this->canDo->get('core.admin') || $this->canDo->get('vm.orders')) { ?>
	<div class="icon"><?php VmImage::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=orders'), 'vm_shop_orders_48', JText::_('COM_VIRTUEMART_ORDER_S')); ?></div>
    <?php } ?>

    <?php  if ($this->canDo->get('core.admin') || $this->canDo->get('vm.paymentmethod')) { ?>
	<div class="icon"><?php VmImage::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=paymentmethod'), 'vm_shop_payment_48', JText::_('COM_VIRTUEMART_PAYMENTMETHOD_S')); ?></div>
    <?php }  ?>
    <?php if ($this->canDo->get('core.admin') || $this->canDo->get('vm.user')) { ?>
	<div class="icon"><?php VmImage::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=user'), 'vm_shop_users_48', JText::_('COM_VIRTUEMART_USER_S')); ?></div>
    <?php } ?>
	<div class="clear"></div>
    <?php if ($this->canDo->get('core.admin')) { ?>
	<div class="icon"><?php VmImage::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=config'), 'vm_shop_configuration_48', JText::_('COM_VIRTUEMART_CONFIG')); ?></div>
    <?php } ?>
    <?php if ($this->canDo->get('core.admin') || $this->canDo->get('vm.user.editshop')) { ?>
	<div class="icon"><?php VmImage::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=user&task=editshop'), 'vm_shop_mart_48', JText::_('COM_VIRTUEMART_STORE')); ?></div>
    <?php } ?>
	<div class="icon"><?php VmImage::displayImageButton('http://virtuemart.net/community/translations', 'vm_country_48', JText::_('COM_VIRTUEMART_TRANSLATIONS'), 'vmicon48','target="_blank"'); ?></div>
	<div class="icon"><?php VmImage::displayImageButton('http://docs.virtuemart.net', 'vm_shop_help_48', JText::_('COM_VIRTUEMART_DOCUMENTATION'), 'vmicon48','target="_blank"'); ?></div>
    <?php if ($this->canDo->get('core.admin')) { ?>
	<div class="icon"><?php echo LiveUpdate::getIcon(array(),'url'); ?></div>
    <?php } ?>


	<?php
	if ( $this->extensionsFeed) {
	$maxItems=15;
	$totalItems=count($this->extensionsFeed->items);
	$displayItems=min($totalItems,$maxItems);
	VmConfig::loadJLang('com_virtuemart', true);

	?>
		<?php
		for ($j = 0; $j < $displayItems; $j ++){
			// This is directly related to extensions.virtuemart.net
			if (($j / 5) == 0) { ?>
				<div class="clear"></div>
				<h2><?php echo JText::_('COM_VIRTUEMART_FEED_LATEST_EXTENSION')?></h2>
				<?php
			} elseif (($j / 5) == 1) { ?>
				<div class="clear"></div>
				<h2><?php echo JText::_('COM_VIRTUEMART_FEED_FEATURED_EXTENSION')?></h2>
			<?php
			} elseif (($j / 5) == 2) { ?>
				<div class="clear"></div>
				<h2><?php echo JText::_('COM_VIRTUEMART_FEED_POPULAR_EXTENSION')?></h2>
			<?php
			}

			$currItem =  $this->extensionsFeed->items[$j];
					$image="";
			if (!is_null($currItem->get_link())) {
				 $description = $currItem->get_description();
				preg_match('/<img[^>]+>/i',$description, $result);
				if (is_array($result) and isset($result[0])){
					$image=$result[0];
					$description=str_replace($image,"",$description);
					$description=strip_tags($description);
					$description=str_replace(JText::_ ('COM_VIRTUEMART_FEED_READMORE') ,"",$description);
				} else {
					$description="";
				}
				?>
				<div class="icon vmextimg" >
					<a href="<?php echo $currItem->get_link(); ?>" target="_blank" title="<?php echo $description ?>">
						<?php
						if ($image){
							echo  $image."<br />" ;
						}
						echo $currItem->get_title();
						?>
					</a>
				</div>
			<?php
			}
		}
	}

			?>
	<div class="clear"></div>
	<h2>
		<a href="http://extensions.virtuemart.net" target="_blank" title="<?php echo JText::_('COM_VIRTUEMART_ALL_EXTENSIONS') ?>"> <?php echo JText::_('COM_VIRTUEMART_ALL_EXTENSIONS') ?></a>
	</h2>

	<div class="clear"></div>
</div>
<div>
	<?php

	$totalItems=5;
	if ( $this->virtuemartFeed) {
	?>
	<h2><?php echo JText::_('COM_VIRTUEMART_FEED_LATEST_NEWS')?></h2>
	<ul class="newsfeed">
		<?php

			for ($j = 0; $j < $totalItems; $j ++){
				$currItem =  $this->virtuemartFeed->items[$j];
				if (!is_null($currItem->get_link())) {
					$description = $currItem->get_description();
					$description=strip_tags($description);
					$description=substr($description, 0,200)."...";
					?>
					<li class="newsfeed-item">
						<a href="<?php echo $currItem->get_link(); ?>" target="_blank" title=" <?php echo $description; ?>"> <?php echo $currItem->get_title(); ?></a>
					</li>
				<?php
				}
			}


		?>
	</ul>

	<?php
	}
	?>
	<h2><?php echo JText::_('COM_VIRTUEMART_VOTE_JED')?></h2>
		<a href="http://extensions.joomla.org/extensions/e-commerce/shopping-cart/129" target="_blank" title=" <?php echo JText::_('COM_VIRTUEMART_VOTE_JED_DESC') ?>"> <?php echo JText::_('COM_VIRTUEMART_VOTE_JED_DESC') ?></a>

</div>