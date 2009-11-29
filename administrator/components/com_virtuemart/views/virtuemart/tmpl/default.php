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
?>
<br />
	<table class="adminlist">
		<tr>
			<th colspan="2" class="title"><?php echo JText::_('VM_STATISTIC_STATISTICS') ?></th>
		</tr>
		<tr> 
		  	<td width="50%">
		  		<a href="<?php echo JROUTE::_('index.php?option=com_virtuemart&page=admin.user_list');?>">
					<?php echo JText::_('VM_STATISTIC_CUSTOMERS') ?>
				</a>
			</td>			
		  	<td width="50%"> <?php echo $this->nbrCustomers ?></td>
		</tr>
		<tr> 
		  	<td width="50%">
		  		<a href="<?php echo JROUTE::_('index.php?option=com_virtuemart&view=product');?>">
					<?php echo JText::_('VM_STATISTIC_ACTIVE_PRODUCTS') ?>
				</a>
			</td>
		  <td width="50%"> <?php echo $this->nbrActiveProducts ?> </td>
		</tr>
		<tr> 
		  <td width="50%"><?php echo JText::_('VM_STATISTIC_INACTIVE_PRODUCTS') ?>:</td>
		  <td width="50%"> <?php  echo $this->nbrInActiveProducts ?></td>
		</tr>
		<tr> 
			<td width="50%">
		  		<a href="<?php echo JROUTE::_('index.php?option=com_virtuemart&page=product.specialprod&filter=featured');?>">
					<?php echo JText::_('VM_SHOW_FEATURED') ?>
				</a>
			</td>
		  <td width="50%"><?php echo $this->nbrFeaturedProducts ?></td>
		</tr>
		<tr>
			<th colspan="2" class="title">
		  		<a href="<?php echo JROUTE::_('index.php?option=com_virtuemart&page=order.order_list');?>">
					<?php echo JText::_('VM_ORDER_MOD') ?>
				</a>
			</th>
		</tr>
		<?php 
		$sum = 0;
		for ($i=0, $n=count( $this->ordersByStatus ); $i < $n; $i++) {
			$row = $this->ordersByStatus[$i]; 
			$link = JROUTE::_('index.php?option=com_virtuemart&page=order.order_list&show='.$row->order_status_code);
			?>
			<tr>
		  		<td width="50%">
		  			<a href="<?php echo $link; ?>"><?php echo $row->order_status_name; ?></a>
				</td>
		  		<td width="50%">
		  			<?php echo $row->order_count; ?>
		  		</td>
			</tr>
		<?php 
			$sum = $sum + $row->order_count;
		} ?>
		<tr> 
		  <td width="50%"><strong><?php echo JText::_('VM_STATISTIC_SUM') ?>:</strong></td>
		  <td width="50%"><strong><?php echo $sum ?></strong></td>
		</tr>
		<tr>
			<th colspan="2" class="title"><?php echo JText::_('VM_STATISTIC_NEW_ORDERS') ?></th>
		</tr>
		<?php 
		for ($i=0, $n=count($this->recentOrders); $i < $n; $i++) {
			$row = $this->recentOrders[$i];
			$link = JROUTE::_('index.php?option=com_virtuemart&page=order.order_print&order_id='.$row->order_id);
			?> 
		  	<tr>
				<td width="50%">
					<a href="<?php echo $link; ?>"><?php echo $row->order_id; ?></a>
			  	</td>
				<td width="50%">
					(<?php echo $total ." ".$_SESSION['vendor_currency'] ?>)
				</td>
			</tr>
			<?php 
		} ?>
		<tr> 
		  <th colspan="2" class="title"><?php echo JText::_('VM_STATISTIC_NEW_CUSTOMERS') ?></th>
		</tr>
		<?php 
		for ($i=0, $n=count($this->recentCustomers); $i < $n; $i++) {
			$row = $this->recentCustomers[$i];
			$link = JROUTE::_('index.php?option=com_virtuemart&page=admin.user_form&user_id='.$row->user_id);
			?>
			<tr>
		  		<td colspan="2">
		  			<a href="<?php echo $link; ?>">
		  				<?php echo '(' . $row->order_id . ') ' . $row->first_name . ' ' . $row->last_name; ?>
		  			</a>
		  		</td>
			</tr>
		<?php 
		}?>	
	</table>
<?php
echo $pane->endPanel();
echo $pane->endPane();

AdminMenuHelper::endAdminArea(); 
?>

