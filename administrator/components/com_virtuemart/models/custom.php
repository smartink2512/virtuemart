<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage
* @author Max Milbers
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved by the author.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: custom.php 3057 2011-04-19 12:59:22Z Electrocity $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// Load the model framework
jimport( 'joomla.application.component.model');

if(!class_exists('VmModel'))require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'vmmodel.php');

/**
 * Model for VirtueMart Customs Fields
 *
 * @package		VirtueMart
 */
class VirtueMartModelCustom extends VmModel {

	private $plugin=null ;
	/**
	 * constructs a VmModel
	 * setMainTable defines the maintable of the model
	 * @author Max Milbers
	 */
	function __construct() {
		parent::__construct('virtuemart_custom_id');
		$this->setMainTable('customs');
		$this->setToggleName('admin_only');
		$this->setToggleName('is_hidden');
	}

    /**
     * Gets a single custom by virtuemart_custom_id
     * .
     * @param string $type
     * @param string $mime mime type of custom, use for exampel image
     * @return customobject
     */
    function getCustom(){

    	//if(empty($this->_db)) $this->_db = JFactory::getDBO();
		JTable::addIncludePath(JPATH_VM_ADMINISTRATOR.DS.'tables');
   		$data =& $this->getTable('customs');
   		$data->load($this->_id);
//		if(!class_exists('VirtueMartModelCustomfields'))require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'customfields.php');
//
//  		$custom = VmCustomHandler::createCustom($data);
		if(!class_exists('VirtueMartModelCustomfields'))require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'customfields.php');
		$customfields = new VirtueMartModelCustomfields();
		$data->field_types = $customfields->getField_types() ;
  		return $data;

    }
    /**
     * Gets a single custom by virtuemart_custom_id
     * .
     * @param int $virtuemart_product_id
     * @return customobject
     */
    function getProductCustoms($virtuemart_product_id){

		$query='SELECT `virtuemart_customfield_id` FROM `#__virtuemart_product_customfields`
			WHERE `virtuemart_product_id`='.(int)$virtuemart_product_id;
		$this->_db->setQuery($query);
		$ids = $this->_db->loadResultArray();

		JTable::addIncludePath(JPATH_VM_ADMINISTRATOR.DS.'tables');
   		$data =& $this->getTable('customs');
		foreach ($ids as $id) $this->_data->productCustoms[] = $data->load($id);

		$this->_data->customFields = self::getCustoms() ;

  		return $this->_data;

    }

	public function getCustomPlugin($virtuemart_custom_id ){

  		if (empty($this->plugin)) {
			$this->_db->setQuery('SELECT * FROM `#__virtuemart_customplugins` WHERE virtuemart_custom_id =' .(int)$virtuemart_custom_id);
			$this->plugin = $this->_db->loadObject();
  		}
		if (empty($this->plugin)) {
			$this->plugin->custom_jplugin_id = null;
			return $this->plugin ;
		}
  		if(empty($this->plugin->virtuemart_vendor_id)){
  		   	if(!class_exists('VirtueMartModelVendor')) require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'vendor.php');
   			$this->plugin->virtuemart_vendor_id = VirtueMartModelVendor::getLoggedVendor();
  		}

  		if(!empty($this->_id)){
			// /* Add the paymentmethod shoppergroups */
			// $q = 'SELECT `virtuemart_shoppergroup_id` FROM #__virtuemart_paymentmethod_shoppergroups WHERE `virtuemart_paymentmethod_id` = "'.$this->_id.'"';
			// $this->_db->setQuery($q);
			// $this->plugin->virtuemart_shoppergroup_ids = $this->_db->loadResultArray();

			// /* Add the accepted credit cards */
			// $q = 'SELECT `virtuemart_creditcard_id` FROM #__virtuemart_paymentmethod_creditcards WHERE `virtuemart_paymentmethod_id` = "'.$this->_id.'"';
			// $this->_db->setQuery($q);
			// $this->plugin->payment_creditcards = $this->_db->loadResultArray();


			if (VmConfig::isJ15()) {
				$table = '#__plugins';
				$ext_id = 'id';
			} else {
				$table = '#__extensions';
				$ext_id = 'extension_id';
			}
			$q = 'SELECT `params` FROM `' . $table . '` WHERE `' . $ext_id . '` = "'.$this->plugin->custom_jplugin_id.'"';
			$this->_db->setQuery($q);
			$this->plugin->param = $this->_db->loadResult();
  		} else {
  			// $this->plugin->virtuemart_shoppergroup_ids = '';
  			// $this->plugin->payment_creditcards = '';
  			$this->plugin->param = '';
			
  		}



  		return $this->plugin;
	}

    /**
	 * Retireve a list of customs from the database. This is meant only for backend use
	 *
	 * @author Kohl Patrick
	 * @return object List of custom objects
	 */
    function getCustoms($custom_parent_id,$search = false){

		$this->_db = JFactory::getDBO();
		$query='SELECT * FROM `#__virtuemart_customs` WHERE field_type <> "R" AND field_type <> "Z" ';
		if($custom_parent_id){
			$query .= 'AND `custom_parent_id` ='.(int)$custom_parent_id;
		}

		if($search){
			$search = '"%' . $this->_db->getEscaped( $search, true ) . '%"' ;
			//$search = $this->_db->Quote($search, false);
			$query .= 'AND `custom_title` LIKE '.$search;
		}

		$this->_db->setQuery($query);
		// set total for pagination
		$this->_total = $this->_getListCount($query);

		$datas->items = $this->_db->loadObjectList();

//		$data = $this->getTable('customs');
//   	$data->load($this->virtuemart_custom_id);
		if(!class_exists('VirtueMartModelCustomfields'))require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'customfields.php');
		$customfields = new VirtueMartModelCustomfields();
//		$customHandler = VmCustomHandler::createCustom($data);
		if (!class_exists('VmHTML')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'html.php');
		$datas->field_types = $customfields->getField_types() ;

		foreach ($datas->items as $key => & $data) {
  		if (!empty($data->custom_parent_id)) $data->custom_parent_title = $customfields->getCustomParentTitle($data->custom_parent_id);
		else {
			$data->custom_parent_title =  '-' ;
		}
  		$data->field_type_display = JText::_( $datas->field_types[$data->field_type ] );
		}
		$datas->customsSelect=$customfields->displayCustomSelection();

		return $datas;
    }

	/**
	 * Creates a clone of a given custom id
	 *
	 * @author Max Milbers
	 * @param int $virtuemart_product_id
	 */

	public function createClone($id){
		$this->virtuemart_custom_id = $id;
		$row = $this->getTable('customs');
		$row->load( $id );
		$row->virtuemart_custom_id = 0;
		$row->custom_title = $row->custom_title.' Copy';

		if (!$clone = $row->store()) {
			JError::raiseError(500, $row->getError() );
		}
		return $clone;
	}

	/* Save and delete from database
	* all product custom_fields and xref
	@ var   $table	: the xref table(eg. product,category ...)
	@array $data	: array of customfields
	@int     $id		: The concerned id (eg. product_id)
	*/
	public function saveModelCustomfields($table,$datas, $id) {

		JRequest::checkToken() or jexit( 'Invalid Token, in store customfields');
		//Sanitize id
		$id = (int)$id;

		//Table whitelist
		$tableWhiteList = array('product','category','manufacturer');
		if(!in_array($table,$tableWhiteList)) return false;

		// delete existings from modelXref and table customfields
		$this->_db->setQuery( 'DELETE PC.* FROM `#__virtuemart_'.$table.'_customfields` as `PC` , `#__virtuemart_customs` as C WHERE `PC`.`virtuemart_custom_id` = `C`.`virtuemart_custom_id` and C.field_type!="C" AND  `PC`.virtuemart_'.$table.'_id ='.$id );
		if(!$this->_db->query()){
			$this->setError('Error in saveModelCustomfields '); //.$this->_db->getQuery()); Dont give hackers too much info
		}
		 if (isset ( $datas['custom_param'] )) $params = true ;
		if (array_key_exists('field', $datas)) {
			$customfieldIds = array();
			foreach($datas['field'] as $key => $fields){
				$fields['virtuemart_'.$table.'_id'] =$id;
				$tableCustomfields = $this->getTable($table.'_customfields');
				if ( $params  ) {
					if (array_key_exists( $key,$datas['custom_param'])) {

						$fields['custom_param'] = json_encode($datas['custom_param'][$key]);
						// $varsToPushParam = null;
						// $ParamKeys = array_keys($datas['custom_param'][$key]);
						// foreach ( $ParamKeys as $key =>$param )$varsToPushParam[ $param ] = array("",'string');
						// $tableCustomfields->setParameterable('custom_param',$varsToPushParam);
						// $fields =  (array)$datas['custom_param'][$key]+$fields;
 
					}
				
				}
				$data = $tableCustomfields->bindChecknStore($fields);
				$errors = $tableCustomfields->getErrors();
				foreach($errors as $error){
					$this->setError($error);
				}
			}
		}

	}

	/* Save and delete from database
	 *  all Child product custom_fields relation
	 * 	@ var   $table	: the xref table(eg. product,category ...)
	 * 	@array $data	: array of customfields
	 * 	@int     $id		: The concerned id (eg. product_id)
	 **/
	public function saveChildCustomRelation($table,$datas) {

		JRequest::checkToken() or jexit( 'Invalid Token, in store customfields');
		//Table whitelist
		$tableWhiteList = array('product','category','manufacturer');
		if(!in_array($table,$tableWhiteList)) return false;

		$customfieldIds = array();
		// delete existings from modelXref and table customfields
		foreach ($datas as $child_id =>$fields) {
			$fields['virtuemart_'.$table.'_id']=$child_id;
			$this->_db->setQuery( 'DELETE PC FROM `#__virtuemart_'.$table.'_customfields` as `PC`, `#__virtuemart_customs` as `C` WHERE `PC`.`virtuemart_custom_id` = `C`.`virtuemart_custom_id` AND field_type="C" and virtuemart_'.$table.'_id ='.$child_id );
			if(!$this->_db->query()){
				$this->setError('Error in deleting child relation '); //.$this->_db->getQuery()); Dont give hackers too much info
			}

			$tableCustomfields = $this->getTable($table.'_customfields');
			$data = $tableCustomfields->bindChecknStore($fields);
    		$errors = $tableCustomfields->getErrors();
			foreach($errors as $error){
				$this->setError($error);
			}
		}

	}
	public function store(&$data){
		$id = parent::store($data);
		if(isset($data['custom_jplugin_id'])){
		if ($data['custom_jplugin_id'] ) self::saveCustomPlugin($data) ;
		}

		return $id ; 
	}

	/**
	 * Bind the post data to the customPlugin tables 
	 * Save the default personnal setting(original are in joomla plugin Table)
	 * @author Patrick Kohl
	 * @return boolean True is the save was successful, false otherwise.
	 */
	public function saveCustomPlugin($data)
	{
		//$data = JRequest::get('post');
		//TODO  remove if $data['custom_jplugin_id'] == 0 ; no custom plugin selected
		$data['custom_name'] = $data['custom_title'];
		if(isset($data['params'])){
			if(!class_exists('JParameter')) require(JPATH_VM_LIBRARIES.DS.'joomla'.DS.'html'.DS.'parameter.php' );
			$params = new JParameter('');
			$params->bind($data['params']);
			$data['custom_params'] = $params->toString();
		}

		if(empty($data['virtuemart_vendor_id'])){
			if(!class_exists('VirtueMartModelVendor')) require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'vendor.php');
			$data['virtuemart_vendor_id'] = VirtueMartModelVendor::getLoggedVendor();
		} else {
			$data['virtuemart_vendor_id'] = (int) $data['virtuemart_vendor_id'];
		}
		// missing string FIX, Bad way ?
		if (VmConfig::isJ15()) {
			$tb = '#__plugins';
			$ext_id = 'id';
		} else {
			$tb = '#__extensions';
			$ext_id = 'extension_id';
		}
		$q = 'SELECT `element` FROM `' . $tb . '` WHERE `' . $ext_id . '` = "'.$data['custom_jplugin_id'].'"';
		$this->_db->setQuery($q);
		$data['custom_element'] = $this->_db->loadResult();
		$table = $this->getTable('customplugins');
		$table->bindChecknStore($data);
		$errors = $table->getErrors();
		foreach($errors as $error){
			$this->setError($error);
		}

		return $table->virtuemart_custom_id;
	}
}
// pure php no closing tag
