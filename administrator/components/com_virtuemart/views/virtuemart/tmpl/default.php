<?php
defined('_JEXEC') or die('Restricted access'); 

AdminMenuHelper::startAdminArea(); 

JToolBarHelper::title(JText::_('VM_YOUR_STORE')."::".JText::_('VM_CONTROL_PANEL'), 'vm_store_48');

$pane =& JPane::getInstance('tabs', array('startOffset'=>0)); 
echo $pane->startPane( 'pane' );
echo $pane->startPanel(JText::_('VM_CONTROL_PANEL'), 'control_panel');
?>
<br />
<div id="cpanel">
<div class="icon"><?php ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=product'), 'vm_shop_products_48.png', JText::_('VM_PRODUCT_LIST_LBL')); ?></div>
<div class="icon"><?php ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&pshop_mode=admin&page=product.product_category_list'), 'vm_shop_categories_48.png', JText::_('VM_CATEGORY_LIST_LBL')); ?></div>
<div class="icon"><?php ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&pshop_mode=admin&page=order.order_list'), 'vm_shop_orders_48.png', JText::_('VM_ORDER_MOD')); ?></div>
<div class="icon"><?php ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&pshop_mode=admin&page=store.payment_method_list'), 'vm_shop_payment_48.png', JText::_('VM_PAYMENT_METHOD_LIST_MNU')); ?></div>
<div class="icon"><?php ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&view=product'), 'vm_shop_vendors_48.png', JText::_('VM_VENDOR_MOD')); ?></div>
<div class="icon"><?php ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&pshop_mode=admin&page=admin.user_list'), 'vm_shop_users_48.png', JText::_('VM_USERS')); ?></div>
<div class="icon"><?php ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&pshop_mode=admin&page=admin.show_cfg'), 'vm_shop_configuration_48.png', JText::_('VM_CONFIG')); ?></div>
<div class="icon"><?php ImageHelper::displayImageButton(JROUTE::_('index.php?option=com_virtuemart&pshop_mode=admin&page=store.store_form'), 'vm_shop_mart_48.png', JText::_('VM_STORE_FORM_MNU')); ?></div>
<div class="icon"><?php ImageHelper::displayImageButton(JROUTE::_('http://virtuemart.org/index.php?option=com_content&amp;task=view&amp;id=248&amp;Itemid=125'), 'vm_shop_help_48.png', JText::_('VM_HELP_MOD')); ?></div>
</div>			
<br /><br /><br /><br /><br /><br /><br /><br />
<?php
echo $pane->endPanel();
echo $pane->startPanel(JText::_('VM_STATISTIC_STATISTICS'), 'statistics_page');
echo "Statistics not finished yet";
echo $pane->endPanel();
echo $pane->endPane();

AdminMenuHelper::endAdminArea(); 
?>

