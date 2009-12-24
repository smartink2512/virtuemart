<?php
/**
 * category View
 *
 * @package	VirtueMart
 * @subpackage Category
 * @author RickG, jseros
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 */

jimport( 'joomla.application.component.view');
jimport('joomla.html.pane');

require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'adminMenu.php');
require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'image.php');

/**
 * HTML View class for maintaining the list of categories
 *
 * @package	VirtueMart
 * @subpackage Category
 * @author RickG, jseros
 */
class VirtuemartViewCategory extends JView {
	
	function display($tpl = null) {	
		$model = $this->getModel();        
        $layoutName = JRequest::getVar('layout', 'default');
        
        $category = $model->getCategory();
        
        // loading the ShopFunctions and Image Helpers
		$this->loadHelper('shopFunctions');
		$this->loadHelper('image');
        
        $isNew = ($category->category_id < 1);
		
		if ($layoutName == 'edit') {
			if ( $isNew ) {
				JToolBarHelper::title(  JText::_('VM_CATEGORY_LIST_LBL' ).': <small><small>[ New ]</small></small>', 'vm_categories_48');
				JToolBarHelper::save();
				JToolBarHelper::cancel();				
			}
			else {
				JToolBarHelper::title( JText::_('VM_CATEGORY_LIST_LBL' ).': <small><small>[ Edit ]</small></small>', 'vm_categories_48');
				JToolBarHelper::save();
				JToolBarHelper::cancel('cancel', 'Close');

				$relationInfo = $model->getRelationInfo( $category->category_id );
				$this->assignRef('relationInfo', $relationInfo);
			}
			
			
			$parent = $model->getParentCategory( $category->category_id );
			$flypages = $model->getTemplateList('product_details');
			$browsePages = $model->getTemplateList('browse');
			
			
			$this->assignRef('parent', $parent);
			$this->assignRef('flypageList', $flypages);
			$this->assignRef('browsePageList', $browsePages);
			$this->assignRef('category', $category);
        }
        else {
			JToolBarHelper::title( JText::_( 'VM_CATEGORY_LIST_LBL' ), 'vm_categories_48' );
			JToolBarHelper::addNewX();
			JToolBarHelper::editListX();
			JToolBarHelper::publishList();
			JToolBarHelper::unpublishList();
			JToolBarHelper::deleteList('', 'remove', 'Delete');
			
			$categories = $model->getCategoryTree(false);
        	$categoriesSorted = $model->sortCategoryTree($categories);
			
			$pagination = $model->getPagination();			
			
			$this->assignRef('pagination',	$pagination);			
			$this->assignRef('categories', $categoriesSorted['categories']);
			$this->assignRef('depthList', $categoriesSorted['depth_list']);
			$this->assignRef('rowList',	$categoriesSorted['row_list']);
			$this->assignRef('idList', $categoriesSorted['id_list']);
		}			
		
		
		parent::display($tpl);
	}
	
}
?>
