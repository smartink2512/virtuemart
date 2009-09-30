<?php
/**
 * Shipper View
 *
 * @package	VirtueMart
 * @subpackage Shipper
 * @author Rick Glunt
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

jimport( 'joomla.application.component.view');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'adminMenu.php');

/**
 * HTML View class for maintaining the list of shipping carriers
 *
 * @package	VirtueMart
 * @subpackage ShippingCarriers
 * @author Rick Glunt 
 */
class VirtuemartViewShippingCarrier extends JView {
	
	function display($tpl = null) {	
		$model = $this->getModel();
        $shippingCarrier = $model->getShippingCarrier();
        
        $layoutName = JRequest::getVar('layout', 'default');
        $isNew = ($shippingCarrier->shipping_carrier_id < 1);
		
		if ($layoutName == 'edit') {
			if ($isNew) {
				JToolBarHelper::title(  JText::_('VM_CARRIER_LIST_LBL' ).': <small><small>[ New ]</small></small>', 'vm_ups_48');
				JToolBarHelper::divider();
				JToolBarHelper::save();
				JToolBarHelper::cancel();
			}
			else {
				JToolBarHelper::title( JText::_('VM_SHIPPER_LIST_ADD' ).': <small><small>[ Edit ]</small></small>', 'vm_ups_48');
				JToolBarHelper::divider();
				JToolBarHelper::save();
				JToolBarHelper::cancel('cancel', 'Close');
			}
			$this->assignRef('shipper',	$shipper);
        }
        else {
			JToolBarHelper::title( JText::_( 'VM_CARRIER_LIST_LBL' ), 'vm_ups_48' );
			JToolBarHelper::deleteList('', 'remove', 'Delete');
			JToolBarHelper::editListX();
			JToolBarHelper::addNewX();	
			
			$pagination = $model->getPagination();			
			$this->assignRef('pagination',	$pagination);	
			
			$shippingCarriers = $model->getShippingCarriers();
			$this->assignRef('shippingCarriers', $shippingCarriers);	
		}			
		
		parent::display($tpl);
	}
	
}
?>
