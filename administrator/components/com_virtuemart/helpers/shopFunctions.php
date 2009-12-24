<?php
/**
 * General helper class
 *
 * This class provides some shop functions that are used throughout the VirtueMart shop.
 *
 * @package	VirtueMart
 * @subpackage Helpers
 * @author RolandD
 * @copyright Copyright (c) 2004-2008 Soeren Eberhardt-Biermann, 2009 VirtueMart Team. All rights reserved.
 */

class ShopFunctions {
	
	/**
	 * @var global database object
	 */
	private $_db = null;
	
	
	/**
	 * Contructor
	 */
	public function __construct(){
		
		$this->_db = JFactory::getDBO();
	}
	
	
	/**
	* Initialise the mailer object to start sending mails
	* @author RolandD
	*/
	public function loadMailer() {
		$mainframe = JFactory::getApplication();
		jimport('joomla.mail.helper');
		
		/* Start the mailer object */
		$mailer = JFactory::getMailer();
		$mailer->isHTML(true);
		/* This has to be replaced by the vendor data */
		//$mailer->From = $mainframe->getCfg('mailfrom');
		//$mailer->FromName = $mainframe->getCfg('sitename');
		//$mailer->AddReplyTo(array($mainframe->getCfg('mailfrom'), $mainframe->getCfg('sitename')));
		
		return $mailer;
	}
	
	
	/**
	* Render a simple country list
	* @author jseros
	* 
	* @param int $countryId Selected country id
	* @return string HTML containing the <select />
	*/
	public function renderCountryList( $countryId = 0 ){
		
		$countryModel = self::_getModel('country');
				
		$countries = $countryModel->getCountries(false, true);
		
		$emptyOption = new stdClass();
		$emptyOption->country_id = '';
		$emptyOption->country_name = '-- '.JText::_('Select').' --';
		
		array_unshift($countries, $emptyOption);

		$listHTML = JHTML::_('Select.genericlist', $countries, 'country_id', '', 'country_id', 'country_name', $countryId , 'country_id');
		return $listHTML;
	}
	
	
	/**
	* Render a simple state list
	* @author jseros
	* 
	* @param int $stateID Selected state id
	* @param int $countryID Selected country id
	* @param string $dependentField Parent <select /> ID attribute
	* @return string HTML containing the <select />
	*/
	public function renderStateList( $stateId = 0, $countryId = 0, $dependentField = ''){
		
		$document = JFactory::getDocument();
		$stateModel = self::_getModel('state');
		$states = array();
		
		if( $countryId ){
			$states = $stateModel->getFullStates( $countryId );
		}
		
		$emptyOption = new stdClass();
		$emptyOption->state_id = '';
		$emptyOption->state_name = '-- '.JText::_('Select').' --';
			
		array_unshift($states, $emptyOption);
		
		$attribs = array(
			'class' => 'dependent['. $dependentField .']'
		);
		
		$document->addScriptDeclaration('VMAdmin.util.countryStateList();');
		
		$listHTML = JHTML::_('Select.genericlist', $states, 'state_id', $attribs, 'state_id', 'state_name', $stateId, 'state_id');
		return $listHTML;
	}
	
	
	/**
	 * Gets the total number of product for category
	 *
     * @author jseros
     * @param int $categoryId Own category id
	 * @return int Total number of products
	 */
	public function countProductsByCategory( $categoryId = 0 ) 
	{
		$categoryModel = self::_getModel('category');
        return $categoryModel->countProducts($categoryId);
    } 
	
	
	/**
	 * Print a select-list with enumerated categories
	 *
     * @author jseros
     * 	 
	 * @param boolean $onlyPublished Show only published categories?
	 * @param boolean $withParentId Keep in mind $parentId param?
	 * @param integer $parentId Show only its childs
	 * @param string $attribs HTML attributes for the list
	 * @return string <Select /> HTML
	 */
	public function getEnumeratedCategories( $onlyPublished = true, $withParentId = false, $parentId = 0, $name = '', $attribs = '', $key = '', $text = '', $selected = null ) 
	{
		$categoryModel = self::_getModel('category');
		
		$categories = $categoryModel->getCategoryTree($onlyPublished, $withParentId, (int)$parentId);
		
		foreach($categories as $index => $cat){
			$cat->category_name = $cat->ordering .'. '. $cat->category_name;
			$categories[$index] = $cat;
		}
		
		return JHTML::_('Select.genericlist', $categories, $name, $attribs, $key, $text, $selected, $name);
    } 

	
	/**
	 * Creates structured option fields for all categories
	 *
	 * TODO: Connect to vendor data
	 * 
	 * @param int $categoryId A single category to be pre-selected
	 * @param int $cid Internally used for recursion
	 * @param int $level Internally used for recursion
	 * @param array $selectedCategories All category IDs that will be pre-selected
	 * @return string $category_tree HTML: Category tree list
	 */
	public function categoryListTree($categoryId = 0, $cid = 0, $level = 0, $selectedCategories = array(), $disabledFields=array()) {
		//global $perm, $hVendor;
		
		//$vendor_id = $hVendor->getLoggedVendor();
		static $categoryTree = '';
		$vendor_id = 1;

		$categoryModel = self::_getModel('category');
		$level++;

		/*
		$q = "SELECT category_id, category_child_id, category_name 
			  FROM #__vm_category, #__vm_category_xref
			  WHERE #__vm_category_xref.category_parent_id = ". $cid."
			  AND #__vm_category.category_id=#__vm_category_xref.category_child_id ";
		
		if (!$perm->check("admin")) {
			//This shows for the admin everything, but for normal vendors only their own AND shared categories by Max Milbers
			$q .= "AND (#__vm_category.vendor_id = '$vendor_id' OR #__vm_category_xref.category_shared = 'Y') ";
			
		}
		$GLOBALS['vmLogger']->debug('$hVendor_id='.$vendor_id);
		
		
		$q .= "ORDER BY #__vm_category.ordering, #__vm_category.category_name ASC";
		$db->setQuery($q);   
		$records = $db->loadObjectList();*/
		
		$records = $categoryModel->getCategoryTree(true, true, $cid);
		
		foreach ($records as $key => $category) {
			
			$childId = $category->category_child_id;
			
			if ($childId != $cid) {
				
				$selected = ($childId == $categoryId) ? "selected=\"selected\"" : "";
				if( $selected == "" && isset($selectedCategories[$childId]) && $selectedCategories[$childId] == 1) {
					$selected = "selected=\"selected\"";
				}
				
				$disabled = '';
				if( in_array( $childId, $disabledFields )) {
					$disabled = 'disabled="disabled"';
				}
				
				
				if( $disabled != '' && stristr($_SERVER['HTTP_USER_AGENT'], 'msie') ) {
					//IE7 suffers from a bug, which makes disabled option fields selectable
				}
				else{
					$categoryTree .= '<option '. $selected .' '. $disabled .' value="'. $childId .'">'."\n";
					$categoryTree .= str_repeat('.  ', ($level-1) );
					
					if($level > 1) $categoryTree .= '|- ';

					$categoryTree .= $category->category_name .'</option>';
				}
			}
			
			self::categoryListTree($categoryId, $childId, $level, $selectedCategories, $disabledFields);
		}
		
		return $categoryTree;
	}
    
    
	/**
	* Return model instance. This is a DRY solution!
	* 
	* @author jseros
	* @access private
	* 
	* @param string $name Model name
	* @return JModel Instance any model
	*/
	private function _getModel($name = ''){
		
		$name = strtolower($name);
		$className = ucfirst($name);
		
		//retrieving country model
		if( !class_exists('VirtueMartModel'.$className) ){
			
			$modelPath = JPATH_COMPONENT_ADMINISTRATOR.DS."models".DS.$name.".php";
			
			if( file_exists($modelPath) ){
				require_once( $modelPath );
			}
			else{
				JError::raiseWarning( 0, 'Model '. $name .' not found.' );
				return '';
			}
		}
		
		$className = 'VirtueMartModel'.$className;
		
		//instancing the object
		$model = new $className();
		return $model;
	}
}