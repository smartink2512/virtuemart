<?php
/**
 * @package		Joomla.Installation
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div id="step">
	<div class="far-right">
		<div class="far-right">
			<div class="button1-left"><div class="site"><a href="<?php echo JURI::root(); ?>" title="<?php echo JText::_('JNEXT'); ?>"><?php echo JText::_('JNEXT'); ?></a></div></div>
		</div>
	</div>
	<h2><?php echo JText::_('INSTL_COMPLETE_REMOVE_FOLDER'); ?></h2>
</div>
<div id="installer">
	<p class="error remove"><?php echo JText::_('INSTL_COMPLETE_REMOVE_INSTALLATION'); ?></p>
</div>
