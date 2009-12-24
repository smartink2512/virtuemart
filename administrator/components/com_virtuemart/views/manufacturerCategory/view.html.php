<?php
/**
 * Manufacturer Category View
 *
 * @package	VirtueMart
 * @subpackage ManufacturerCategory
 * @author RickG
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

jimport( 'joomla.application.component.view');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'adminMenu.php');

/**
 * HTML View class for maintaining the list of manufacturer categories
 *
 * @package	VirtueMart
 * @subpackage ManufacturerCategory
 * @author RickG
 */
class VirtuemartViewManufacturerCategory extends JView {

    function display($tpl = null) {
	$model = $this->getModel();
	$manufacturerCategory = $model->getManufacturerCategory();

	$layoutName = JRequest::getVar('layout', 'default');
	$isNew = ($manufacturerCategory->mf_category_id < 1);

	if ($layoutName == 'edit') {
	    if ($isNew) {
		JToolBarHelper::title(  JText::_('VM_MANUFACTURER_CAT_FORM_LBL' ).': <small><small>[ New ]</small></small>', 'vm_manufacturer_48');
		JToolBarHelper::divider();
		JToolBarHelper::save();
		JToolBarHelper::cancel();
	    }
	    else {
		JToolBarHelper::title( JText::_('VM_MANUFACTURER_CAT_FORM_LBL' ).': <small><small>[ Edit ]</small></small>', 'vm_manufacturer_48');
		JToolBarHelper::divider();
		JToolBarHelper::save();
		JToolBarHelper::cancel('cancel', 'Close');
	    }
	    $this->assignRef('manufactuerCategory', $manufacturerCategory);
	}
	else {
	    JToolBarHelper::title( JText::_( 'VM_MANUFACTURER_CAT_LIST_LBL' ), 'vm_manufacturer_48' );
	    JToolBarHelper::deleteList('', 'remove', 'Delete');
	    JToolBarHelper::editListX();
	    JToolBarHelper::addNewX();

	    $pagination = $model->getPagination();
	    $this->assignRef('pagination',	$pagination);

	    $manufacturerCategories = $model->getManufacturerCategories();
	    $this->assignRef('manufacturerCategories', $manufacturerCategories);
	}

	parent::display($tpl);
    }

}
?>
