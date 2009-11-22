<?php
defined('_JEXEC') or die('Restricted access'); 
AdminMenuHelper::startAdminArea(); 
?>
<form name="adminForm" enctype="multipart/form-data">
<?php

$pane = JPane::getInstance('tabs', array('startOffset'=>0)); 
echo $pane->startPane('pane');

echo $pane->startPanel(JText::_('VM_ADMIN_CFG_BACKEND'), 'global_panel');
echo $this->loadTemplate('backend');
echo $pane->endPanel();
echo $pane->startPanel(JText::_('VM_ADMIN_CFG_FRONTEND'), 'global_panel');
echo $this->loadTemplate('frontend');
echo $pane->endPanel();
echo $pane->startPanel(JText::_('VM_ADMIN_SECURITY'), 'security_panel');
echo $this->loadTemplate('security');
echo $pane->endPanel();
echo $pane->startPanel(JText::_('VM_ADMIN_CFG_USERS'), 'users_panel');
echo $this->loadTemplate('users');
echo $pane->endPanel();
echo $pane->startPanel(JText::_('VM_ADMIN_CFG_PRICING'), 'pricing_panel');
echo $this->loadTemplate('pricing');
echo $pane->endPanel();
echo $pane->startPanel(JText::_('VM_ADMIN_CFG_CHECKOUT'), 'checkout_panel');
echo $this->loadTemplate('checkout');
echo $pane->endPanel();
echo $pane->startPanel(JText::_('VM_ADMIN_CFG_DOWNLOADABLEGOODS'), 'downloads_panel');
echo $this->loadTemplate('downloads');
echo $pane->endPanel();
echo $pane->startPanel(JText::_('VM_ADMIN_CFG_FEED_CONFIGURATION'), 'feed_panel');
echo $this->loadTemplate('feeds');
echo $pane->endPanel();

echo $pane->endPane();
?>

<!-- Hidden Fields -->
<input type="hidden" name="task" value="" />
<input type="hidden" name="option" value="com_virtuemart" />
<input type="hidden" name="view" value="config" />
</form>
<?php AdminMenuHelper::endAdminArea(); ?> 
