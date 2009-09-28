<?php
/**
 * Currency View
 *
 * @package	VirtueMart
 * @subpackage Currency
 * @author Rick Glunt
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

jimport( 'joomla.application.component.view');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'adminMenu.php');

/**
 * HTML View class for maintaining the list of countries
 *
 * @package	VirtueMart
 * @subpackage Currency
 * @author Rick Glunt 
 */
class JmartViewCurrency extends JView {
	
	function display($tpl = null) {	
		$model = $this->getModel();
        $currency = $model->getCurrency();
        
        $layoutName = JRequest::getVar('layout', 'default');
        $isNew = ($currency->currency_id < 1);
		
		if ($layoutName == 'edit') {
			if ($isNew) {
				JToolBarHelper::title(  JText::_('VM_CURRENCY_LIST_ADD' ).': <small><small>[ New ]</small></small>', 'jm_currency_48');
				JToolBarHelper::divider();
				JToolBarHelper::save();
				JToolBarHelper::cancel();
			}
			else {
				JToolBarHelper::title( JText::_('VM_CURRENCY_LIST_ADD' ).': <small><small>[ Edit ]</small></small>', 'jm_currency_48');
				JToolBarHelper::divider();
				JToolBarHelper::save();
				JToolBarHelper::cancel('cancel', 'Close');
			}
			$this->assignRef('currency',	$currency);
        }
        else {
			JToolBarHelper::title( JText::_( 'VM_CURRENCY_LIST_LBL' ), 'jm_currency_48' );
			JToolBarHelper::deleteList('', 'remove', 'Delete');
			JToolBarHelper::editListX();
			JToolBarHelper::addNewX();	
			
			$pagination = $model->getPagination();			
			$this->assignRef('pagination',	$pagination);	
			
			$currencies = $model->getCurrenciesList();
			$this->assignRef('currencies',	$currencies);	
		}			
		
		parent::display($tpl);
	}
	
}
?>
