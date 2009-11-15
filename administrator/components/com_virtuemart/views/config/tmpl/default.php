<?php
defined('_JEXEC') or die('Restricted access'); 
AdminMenuHelper::startAdminArea(); 
?>
<form name="adminForm" enctype="multipart/form-data">
<?php

$pane =& JPane::getInstance('tabs', array('startOffset'=>0)); 
echo $pane->startPane( 'pane' );

echo $pane->startPanel(JText::_('VM_ADMIN_CFG_GLOBAL'), 'global_panel');
echo $this->loadTemplate('global');
echo $pane->endPanel();

echo $pane->startPanel(JText::_('VM_ADMIN_SECURITY'), 'security_panel');
echo $this->loadTemplate('security');
echo $pane->endPanel();
echo $pane->startPanel(JText::_('VM_ADMIN_CFG_SITE'), 'site_panel');
echo $this->loadTemplate('site');
echo $pane->endPanel();
echo $pane->startPanel(JText::_('VM_ADMIN_CFG_CHECKOUT'), 'checkout_panel');
?>
Checkout here
<?php
echo $pane->endPanel();
echo $pane->startPanel(JText::_('VM_ADMIN_CFG_DOWNLOADABLEGOODS'), 'downloads_panel');
?>
Downloads here
<?php
echo $pane->endPanel();
echo $pane->startPanel(JText::_('VM_ADMIN_CFG_FEED_CONFIGURATION'), 'feed_panel');
?>
Feed here
<?php
echo $pane->endPanel();
echo $pane->endPane();
?>

<!-- Hidden Fields -->
<input type="hidden" name="task" value="" />
<input type="hidden" name="option" value="com_virtuemart" />
<input type="hidden" name="view" value="config" />
</form>
<?php AdminMenuHelper::endAdminArea(); ?> 
