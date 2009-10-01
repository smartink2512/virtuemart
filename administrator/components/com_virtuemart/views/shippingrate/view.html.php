<?php
/**
 * Shipping Rate View
 *
 * @package	VirtueMart
 * @subpackage ShippingRate
 * @author Rick Glunt
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

jimport( 'joomla.application.component.view');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'adminMenu.php');

/**
 * HTML View class for maintaining the list of shipping rates
 *
 * @package	VirtueMart
 * @subpackage ShippingRate
 * @author Rick Glunt 
 */
class VirtuemartViewShippingRate extends JView {
	
	function display($tpl = null) {	
		$model = $this->getModel();
        $shippingRate = $model->getShippingRate();
        
        $layoutName = JRequest::getVar('layout', 'default');
        $isNew = ($shippingRate->shipping_rate_id < 1);
		
		if ($layoutName == 'edit') {
			if ($isNew) {
				JToolBarHelper::title(  JText::_('VM_RATE_LIST_LBL' ).': <small><small>[ New ]</small></small>', 'vm_shipping_rates_48');
				JToolBarHelper::divider();
				JToolBarHelper::save();
				JToolBarHelper::cancel();
			}
			else {
				JToolBarHelper::title( JText::_('VM_RATE_FORM_LBL' ).': <small><small>[ Edit ]</small></small>', 'vm_shipping_rates_48');
				JToolBarHelper::divider();
				JToolBarHelper::save();
				JToolBarHelper::cancel('cancel', 'Close');
			}
			$this->assignRef('rate', $shippingRate);
			
			$carrierModel = $this->getModel('shippingcarrier');
        	$carriers = $carrierModel->getShippingCarriers(true, true);		     	
        	$this->assignRef('carriers', $carriers);	
        	
			$currencyModel = $this->getModel('currency');
        	$currencies = $currencyModel->getCurrencies(true, true);		     	
        	$this->assignRef('currencies', $currencies);	  
        	
			$countrymodel = $this->getModel('country');
        	$countries = $countrymodel->getCountries(true, true);		     	
        	$this->assignRef('countries', $countries);	        	      	
        }
        else {
			JToolBarHelper::title( JText::_('VM_RATE_LIST_LBL' ), 'vm_shipping_rates_48');
			JToolBarHelper::deleteList('', 'remove', 'Delete');
			JToolBarHelper::editListX();
			JToolBarHelper::addNewX();	
			
			$pagination = $model->getPagination();			
			$this->assignRef('pagination',	$pagination);	
			
			$shippingRates = $model->getShippingRates();
			$this->assignRef('shippingRates', $shippingRates);	
		}			
		
		parent::display($tpl);
	}
	
}
?>
