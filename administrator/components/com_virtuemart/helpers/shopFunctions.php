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
	 * @return int Total number of products
	 */
	public function countProductsByCategory( $categoryId = 0 ) 
	{
		$categoryModel = self::_getModel('category');
        return $categoryModel->countProducts($categoryId);
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
?>