<?php
/**
 * Coupon View
 *
 * @package	JMart
 * @subpackage Coupon
 * @author Rick Glunt
 * @copyright Copyright (c) 2009 JMart Team. All rights reserved.
 */

jimport( 'joomla.application.component.view');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'adminMenu.php');

/**
 * HTML View class for maintaining the list of Coupons
 *
 * @package	JMart
 * @subpackage Coupon
 * @author Rick Glunt 
 */
class JmartViewCoupon extends JView {
	
	function display($tpl = null) {	
		$model = $this->getModel();
		
        $coupon = $model->getCoupon();
        
        $layoutName = JRequest::getVar('layout', 'default');
        $isNew = ($coupon->coupon_id < 1);
		
		if ($layoutName == 'edit') {
			if ($isNew) {
				JToolBarHelper::title(  JText::_('JM_COUPON_NEW_HEADER' ).': <small><small>[ New ]</small></small>', 'jm_coupon_48');
				JToolBarHelper::divider();
				JToolBarHelper::save();
				JToolBarHelper::cancel();
			}
			else {
				JToolBarHelper::title( JText::_('JM_COUPON_EDIT_HEADER' ).': <small><small>[ Edit ]</small></small>', 'jm_coupon_48');
				JToolBarHelper::divider();
				JToolBarHelper::save();
				JToolBarHelper::cancel('cancel', 'Close');
			}
			$this->assignRef('coupon',	$coupon);
        }
        else {
			JToolBarHelper::title( JText::_('JM_COUPON_LIST'), 'jm_coupon_48');
			JToolBarHelper::deleteList('', 'remove', 'Delete');
			JToolBarHelper::editListX();
			JToolBarHelper::addNewX();	
			
			$pagination = $model->getPagination();			
			$this->assignRef('pagination',	$pagination);	
			
			$coupons = $model->getCoupons();
			$this->assignRef('coupons',	$coupons);	
		}			
		
		parent::display($tpl);
	}
	
}
?>
