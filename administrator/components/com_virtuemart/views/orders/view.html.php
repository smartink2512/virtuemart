<?php
/**
* @package		VirtueMart
*/

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the VirtueMart Component
 *
 * @package		VirtueMart
 */
class VirtuemartViewOrders extends JView {
	
	function display($tpl = null) {
		$mainframe = Jfactory::getApplication();
		$option = JRequest::getVar('option');
		$lists = array();
		
		/* Load helpers */
		$this->loadHelper('adminMenu');
		$this->loadHelper('currencydisplay');
		
		/* Get the data */
		$orderslist = $this->get('OrdersList');
		
		/* Apply currency */
		$currencydisplay = new CurrencyDisplay();
		foreach ($orderslist as $order_id => $order) {
			$order->order_total = $currencydisplay->getValue($order->order_total);
		}
		
		/* Get the pagination */
		$pagination = $this->get('Pagination');
		$lists['filter_order'] = $mainframe->getUserStateFromRequest($option.'filter_order', 'filter_order', '', 'cmd');
		$lists['filter_order_Dir'] = $mainframe->getUserStateFromRequest($option.'filter_order_Dir', 'filter_order_Dir', '', 'word');
		
		/* Toolbar */
		JToolBarHelper::title(JText::_( 'VM_ORDER_LIST_LBL' ), 'vm_orders_48');
		
		/* Assign the data */
		$this->assignRef('orderslist', $orderslist);
		$this->assignRef('pagination',	$pagination);
		$this->assignRef('lists',	$lists);
		
		parent::display($tpl);
	}
	
}
?>
