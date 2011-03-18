<?php
if(  !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version $Id: 1.9 beta1
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2010 Kohl Patrick - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/



/* views are virtuemart\user\state\productdetails\orders\category\cart\*/
/*task editAddressSt */

function virtuemartBuildRoute(&$query) {

	$helper = vmrouterHelper::getInstance();
	$lang = &$helper->lang ;

	$view = '';
	$segments = array();

	$menuView		= $helper->activeMenu->view;
	$menuCatid		= $helper->activeMenu->category_id;
	$menuProdId		= $helper->activeMenu->product_id;
	$menuComponent	= $helper->activeMenu->Component;


	if(isset($query['view'])){
		$view = $query['view'];
		unset($query['view']);
	}
	switch ($view) {
		case 'virtuemart';
			unset($query['view']);
		// Shop category view 
		case 'category';	
			if(!empty( $query['category_id']) && $menuCatid != $query['category_id'] ){
				$categoryRoute = $helper->getCategoryRoute($query['category_id']);
				if ($categoryRoute->route) $segments[] = $categoryRoute->route;
				if ($categoryRoute->itemId) $query['Itemid'] = $categoryRoute->itemId;
				unset($query['category_id']);
			} else {
				if (isset ($helper->menu->no_category_id))$query['Itemid'] = $helper->menu->no_category_id;
				elseif (isset ($helper->menu->virtuemart))$query['Itemid'] = $helper->menu->virtuemart[0]['itemId'] ;
				unset($query['category_id']);
			}
			// Fix for search with no category
			if ( isset($query['search'])  ) $segments[] = 'search' ;
			if ( isset($query['keyword'] )) {
				$segments[] = $query['keyword'];
				unset($query['keyword']);
			}
		break;
		// Shop product details view 
		case 'productdetails';			
			$product_id_exists = false;
			$menuCatid = 0 ;
			if(isset($query['product_id'])) {
				$segments[] = $query['product_id'];
				$product_id_exists = true;
				$product_id = $query['product_id'];
				unset($query['product_id']);
			}
			if(!empty( $query['category_id'])){
				$categoryRoute = $helper->getCategoryRoute($query['category_id']);
				if ($categoryRoute->route) $segments[] = $categoryRoute->route;
				if ($categoryRoute->itemId) $query['Itemid'] = $categoryRoute->itemId;
				unset($query['category_id']);
			}
			if($product_id_exists)	{
				$segments[] = $helper->getProductName($product_id);
			}
		break;
		case 'manufacturer';
			if ( isset($helper->menu->manufacturer_id) ) $query['Itemid'] = $helper->menu->manufacturer_id;
			else $segments[] = $lang->manufacturer;
			if(isset($query['manufacturer_id'])) {
				$segments[] = $query['manufacturer_id'];
				unset($query['manufacturer_id']);
			}
		break;
		case 'manufacturer';
			if ( isset($helper->menu->manufacturer_id) ) $query['Itemid'] = $helper->menu->manufacturer_id;
			else $segments[] = $lang->manufacturer ;
			if(isset($query['manufacturer_id'])) {
				$segments[] = $query['manufacturer_id'];
				unset($query['manufacturer_id']);
			}
		break;
		
		// sef only view	
		default ;
		if ($helper->activeMenu->view != $view) $segments[] = $view;
		

	} 
	// sef the task
	if (isset($query['task'])) {
		if ($query['task'] == 'editshipping') $segments[] = $lang->editshipping ;
		elseif ($query['task'] == 'editpayment') $segments[] = $lang->editpayment;
		elseif ($query['task'] == 'askquestion') $segments[] = $lang->askquestion;
		else $segments[] = $query['task'] ;
		unset($query['task']);
	}	// sef the task
	if (isset($query['tmpl'])) {
		if ( $query['tmpl'] = 'component') $segments[] = 'detail' ;
		unset($query['tmpl']);
	}
	if (empty ($query['Itemid'])) $query['Itemid'] = $helper->menu->virtuemart[0]['itemId'] ;

	return $segments;
}

function virtuemartParseRoute($segments)
{
	$vars = array();
	$helper = vmrouterHelper::getInstance();
	$lang = &$helper->lang ;
	
	$segments[0]=str_replace(":", "-",$segments[0]);
	$count = count($segments)-1;	
	if ($segments[0] == 'search') {
		$vars['view'] = 'category';
		array_shift($segments);
		$count--;
		if ($count <1) return $vars;
	}
	if ($segments[$count] == $lang->editshipping ){
		$vars['view'] = 'cart';
		$vars['task'] = 'editshipping' ;
		return $vars;	
	}
	if ($segments[$count] == $lang->editpayment ){
		$vars['view'] = 'cart';
		$vars['task'] = 'editpayment' ;
		return $vars;	
	}
	
	if ($segments[$count] == 'detail') {
		$vars['tmpl'] = 'component';
		array_pop($segments);
		$count--;
	}	
	if ($segments[$count] == $lang->askquestion) {
		$vars['task'] = 'askquestion';
		array_pop($segments);
		$count--;
	}
	if ($segments[0] == $lang->manufacturer || $helper->activeMenu->view == 'manufacturer') {
		$vars['view'] = 'manufacturer';
		if ($segments[0] == $lang->manufacturer) {
			array_shift($segments);
			$count--;
		}
		if (isset($segments[0])  && ctype_digit ($segments[0])) {
			$vars['manufacturer_id'] = $segments[0];
			array_shift($segments);
		}
		$count--;
		//return $vars;
	}

	if  ($count<1 ) return $vars;
	//uppercase first (trick for product details )
	if ($segments[$count][0] == ucfirst($segments[$count][0]) ){
		$vars['view'] = 'productdetails';
		if (ctype_digit ($segments[1])){
			$vars['product_id'] = $segments[0];
			$vars['category_id'] = $segments[1];
		} else {
			$vars['product_id'] = $segments[0];
			$vars['category_id'] = $helper->activeMenu->category_id ;
		}
		return $vars;
	} elseif (isset($segments[0]) && ctype_digit ($segments[0]) || $helper->activeMenu->category_id>0 ) {
		$vars['category_id'] = $segments[0];
		$vars['view'] = 'category';
		return $vars;
	} elseif ($helper->activeMenu->category_id >0 && $vars['view'] != 'productdetails') {
		$vars['category_id'] = $helper->activeMenu->category_id ;
		$vars['view'] = 'category';
		return $vars;
	} 
		//($helper->activeMenu->view) $vars['view'] = $helper->activeMenu->view;
		
		$vars['view'] = $segments[0] ;
		if ( isset($segments[1]) ) {
			$vars['task'] = $segments[1] ;
		}

	return $vars;
}

class vmrouterHelper {

	/* language array */
	public $lang = null ;

	/* Joomla menu ID object */
	public $menu = null ;

	/* Joomla active menu ID object */
	public $activeMenu = null ;

	/* instance of class */
	private static $_instance = null;	

	private function __construct() {

		self::setLang();
		self::setMenuItemId();
		self::setActiveMenu();
	}

	public static function getInstance() {
		if(is_null(self::$_instance)) {
			self::$_instance = new vmrouterHelper();
		}
		return self::$_instance;
	}
	/* Get the route for category */
	public function getCategoryRoute($category_id){
		$category = new stdClass();
		$category->route = '';
		$category->itemId = 0;
		$menuCatid = 0 ;
		$ismenu = false ;
		$CatParentIds = self::getCategoryRecurse($category_id,0) ;
		// control if category is joomla menu
		foreach ($this->menu->category_id as $menuId) {
			if ($category_id ==  $menuId['category_id']) {
				$ismenu = true;
				$category->itemId = $menuId['itemId'] ;
				break;
			}
			/* control if parent categories are joomla menu */
			foreach ($CatParentIds as $CatParentId) {
				// No ? then find te parent menu categorie !
				if ($menuId['category_id'] == $CatParentId ) {
					$category->itemId = $menuId['itemId'] ;
					$menuCatid = $CatParentId;
				}
			}
		}
		if ($ismenu==false) {
			$category->route = $category_id.'/'.self::getCategoryName($category_id, $menuCatid );
			if ($menuCatid == 0 ) $category->itemId = $this->menu->virtuemart[0]['itemId'] ;
		}
		return $category ;
	}

	public function getCategoryName($category_id,$catMenuId=0){

		$strings = array();
		$db = & JFactory::getDBO();
		$parents_id = array_reverse(self::getCategoryRecurse($category_id,$catMenuId)) ;

		foreach ($parents_id as $id ) {
			$q = "SELECT `category_name` as name
					FROM  `#__vm_category` 
					WHERE  `category_id`=".$id;

			$db->setQuery($q);
			$category = $db->loadResult();
			$string  = trim($category);
			if ( ctype_digit($string) ){
				return $string ;
			}
			else {
				// accented chars converted
				$accents = '/&([A-Za-z]{1,2})(grave|acute|circ|cedil|uml|lig);/';
				$string_encoded = htmlentities($string,ENT_NOQUOTES,'UTF-8');
				$string = preg_replace($accents,'$1',$string_encoded);
				
				// clean out the rest
				$replace = array('([\40])','/&nbsp/','/&amp/','/\//','([^a-zA-Z0-9-/])','/\-+/');
				$with = array('-','-','-','-','-','-');
				$string = preg_replace($replace,$with,$string);
				
			}
			$strings[] = $string;
		}
		
		return strtolower(implode ('/', $strings ) );

	}

	public function getCategoryRecurse($category_id,$catMenuId,$first=true ) {
		static $idsArr = array();
		if ($first==true) $idsArr = array();

		$db			= & JFactory::getDBO();	
		$q = "SELECT `category_child_id` AS `child`, `category_parent_id` AS `parent`
				FROM  #__vm_category_xref AS `xref`
				WHERE `xref`.`category_child_id`= ".$category_id;
		$db->setQuery($q);
		$ids = $db->loadObject();
		if ($ids->child) $idsArr[] = $ids->child;
		if($ids->parent != 0 and $catMenuId != $category_id and $catMenuId != $ids->parent) {
			self::getCategoryRecurse($ids->parent,$catMenuId,false);
		} 
		return $idsArr ;
	}

	public function getProductName($id){

		$db			= & JFactory::getDBO();
		$query = 'SELECT `product_name` FROM `#__vm_product`  ' .
		' WHERE `product_id` = ' . (int) $id;

		$db->setQuery($query);
		// gets product name of item
		$product_name = $db->loadResult();
			$string  = trim($product_name) ;
			if ( ctype_digit($string)){
				return $string ;
			}
			else {	
				// accented chars converted
				$accents = '/&([A-Za-z]{1,2})(grave|acute|circ|cedil|uml|lig);/';
				$string_encoded = htmlentities($string,ENT_NOQUOTES,'UTF-8');
				$string = preg_replace($accents,'$1',$string_encoded);
				
				// clean out the rest
				$replace = array('([\40])','/&nbsp/','/&amp/','/\//','([^a-zA-Z0-9-/])','/\-+/');
				$with = array('-','-','-','-','-','-');
				$string = preg_replace($replace,$with,$string);
				
			}
		return ucfirst($string);
	}
 
	/* Set $this-lang (Translator for language from virtuemart string) */
	private function setLang(){

		if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'helpers'.DS.'config.php');

		if ( VmConfig::get('seo_translate', false) ) {
			/* use translator */
			$lang =& JFactory::getLanguage();
			$extension = 'com_virtuemart';
			$base_dir = JPATH_SITE;
			$lang->load($extension, $base_dir);
			$this->lang->editshipping = $lang->_('VM_SEF_EDITSHIPPING');
			$this->lang->manufacturer = $lang->_('VM_SEF_MANUFACTURER');
			$this->lang->askquestion  = $lang->_('VM_SEF_ASKQUESTION');
			$this->lang->editpayment  = $lang->_('VM_SEF_EDITPAYMENT');
		} else {
			/* use default */
			$this->lang->editshipping = 'editshipping';
			$this->lang->manufacturer = 'manufacturer';
			$this->lang->askquestion  = 'askquestion';
			$this->lang->editpayment  = 'editpayment';
		}  
	}

	/* Set $this->menu with the Item ID from Joomla Menus */
	private function setMenuItemId(){

		$app		= JFactory::getApplication();
		$menus		= $app->getMenu('site');
		$component	= JComponentHelper::getComponent('com_virtuemart');
		$items		= $menus->getItems('componentid', $component->id);
		// Search  Virtuemart root menu id
		foreach ($items as $item)	{
			if ( $item->query['view']=='category' && isset( $item->query['category_id'])) {
				if ( isset( $item->query['category_id']) )
				$this->menu->category_id[]  = array_merge( $item->query, array('itemId' => $item->id) );
				else $this->menu->no_category_id = $item->id;
				
			} elseif ( $item->query['view']=='virtuemart' ) {
				$this->menu->virtuemart[]  = array_merge($item->query, array('itemId' => $item->id) ); 
			} elseif ( $item->query['view']=='manufacturer' ) {
				$this->menu->manufacturer_id = $item->id ;
			}
			
		}
	}

	/* Set $this->activeMenu to current Item ID from Joomla Menus */
	private function setActiveMenu(){
		
		$Itemid = JRequest::getInt('Itemid',null);
		$menu = &JSite::getMenu();
		if (!$Itemid) {
			$menuItem = &$menu->getActive();

		} else {
			$menuItem = &$menu->getItem($Itemid);
		}

		$this->activeMenu->view			= (empty($menuItem->query['view'])) ? null : $menuItem->query['view'];
		$this->activeMenu->category_id	= (empty($menuItem->query['category_id'])) ? 0 : $menuItem->query['category_id'];
		$this->activeMenu->product_id	= (empty($menuItem->query['product_id'])) ? null : $menuItem->query['product_id'];
		$this->activeMenu->Component	= (empty($menuItem->component)) ? null : $menuItem->component;

	}
}

// pure php no closing tag