<?php
defined('_JEXEC') or die('Restricted access'); 

AdminMenuHelper::startAdminArea(); 

JToolBarHelper::title(JText::_('VM_YOUR_STORE')."::".JText::_('VM_CONTROL_PANEL'), 'vm_store_48');

$pane =& JPane::getInstance('tabs', array('startOffset'=>0)); 
echo $pane->startPane( 'pane' );
echo $pane->startPanel(JText::_('VM_CONTROL_PANEL'), 'control_panel');
ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=product'), 'vm_shop_products_48.png', JText::_('VM_PRODUCT_LIST_LBL'));
ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=product'), 'vm_shop_categories_48.png', JText::_('VM_CATEGORY_LIST_LBL'));
ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=product'), 'vm_shop_orders_48.png', JText::_('VM_ORDER_MOD'));
ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=product'), 'vm_shop_payment_48.png', JText::_('VM_PAYMENT_METHOD_LIST_MNU'));
ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=product'), 'vm_shop_vendors_48.png', JText::_('VM_VENDOR_MOD'));
ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=product'), 'vm_shop_users_48.png', JText::_('VM_USERS'));
ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=product'), 'vm_shop_configuration_48.png', JText::_('VM_CONFIG'));
ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=product'), 'vm_shop_mart_48.png', JText::_('VM_STORE_FORM_MNU'));
ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=product'), 'vm_shop_help_48.png', JText::_('VM_HELP_MOD'));
echo $pane->endPanel();
echo $pane->startPanel(JText::_('VM_STATISTIC_STATISTICS'), 'statistics_page');
echo "This is panel2";
echo $pane->endPanel();
echo $pane->endPane();

AdminMenuHelper::endAdminArea(); 
?>

