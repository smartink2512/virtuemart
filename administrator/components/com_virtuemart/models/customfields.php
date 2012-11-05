<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved by the author.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id:$
 */

// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');

if (!class_exists ('VmModel')) {
	require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmmodel.php');
}

/**
 * Model for VirtueMart Customs Fields
 *
 * @package        VirtueMart
 */
class VirtueMartModelCustomfields extends VmModel {

	/**
	 * constructs a VmModel
	 * setMainTable defines the maintable of the model
	 *
	 * @author Max Milbers
	 */
// 	function __construct($modelName ='product') {
	function __construct ($modelName = 'product') {

		parent::__construct ('virtuemart_customfield_id');
		$this->setMainTable ('product_customfields');
	}

	/** @return autorized Types of data **/
	function getField_types () {

		return array('S' => 'COM_VIRTUEMART_CUSTOM_STRING',
		             'I' => 'COM_VIRTUEMART_CUSTOM_INT',
		             'P' => 'COM_VIRTUEMART_CUSTOM_PARENT',
		             'B' => 'COM_VIRTUEMART_CUSTOM_BOOL',
		             'D' => 'COM_VIRTUEMART_DATE',
		             'T' => 'COM_VIRTUEMART_TIME',
		             'M' => 'COM_VIRTUEMART_IMAGE',
		             'V' => 'COM_VIRTUEMART_CUSTOM_CART_VARIANT',
		             'A' => 'COM_VIRTUEMART_CHILD_GENERIC_VARIANT',
		             'X' => 'COM_VIRTUEMART_CUSTOM_EDITOR',
		             'Y' => 'COM_VIRTUEMART_CUSTOM_TEXTAREA',
		             'E' => 'COM_VIRTUEMART_CUSTOM_EXTENSION'
		);

		// 'U'=>'COM_VIRTUEMART_CUSTOM_CART_USER_VARIANT',
		// 'C'=>'COM_VIRTUEMART_CUSTOM_PRODUCT_CHILD',
		// 'G'=>'COM_VIRTUEMART_CUSTOM_PRODUCT_CHILD_GROUP',
		//			'R'=>'COM_VIRTUEMART_RELATED_PRODUCT',
		//			'Z'=>'COM_VIRTUEMART_RELATED_CATEGORY',
	}


	/**
	 * Gets a single custom by virtuemart_customfield_id
	 *
	 * @param string $type
	 * @param string $mime mime type of custom, use for exampel image
	 * @return customobject
	 */
	function getCustomfield () {

		if(empty($this->data)){
			$this->data = $this->getTable ('product_customfields');
			$this->data->load ($this->_id);
		}

		return $this;
	}

	static function bindCustomEmbeddedFieldParams(&$obj,$fieldtype){
		//vmdebug('bindCustomEmbeddedFieldParams begin',$obj);
		$obj ->_xParams = 'custom_param';
		VirtueMartModelCustomfields::bindParameterableByFieldType($obj,$fieldtype);
		//vmdebug('bindCustomEmbeddedFieldParams middle',$obj);
		$obj ->_xParams = 'customfield_param';
		VirtueMartModelCustomfields::bindParameterableByFieldType($obj,$fieldtype);
		//vmdebug('bindCustomEmbeddedFieldParams end',$obj);
	}

	private function getProductCustomSelectFieldList(){

		$q = 'SELECT c.`virtuemart_custom_id`, `custom_element`, `custom_jplugin_id`, `custom_param`, `custom_parent_id`, `admin_only`, `custom_title`, `custom_tip`, ';
		$q .= 'c.`custom_value`, `custom_desc`, `field_type`, `is_list`, `is_cart_attribute`, `is_hidden`, `layout_pos`, c.`published`, field.`ordering`,
		field.`virtuemart_customfield_id`, field.`customfield_value`, field.`customfield_param`, field.`custom_price`
		FROM `#__virtuemart_customs` AS c LEFT JOIN `#__virtuemart_product_customfields` AS field ON c.`virtuemart_custom_id` = field.`virtuemart_custom_id` ';
		return $q;
	}

	function getCustomEmbeddedProductCustomField($virtuemart_customfield_id){

		$db= JFactory::getDBO ();
		$q = $this->getProductCustomSelectFieldList();
		if($virtuemart_customfield_id){
			$q .= ' WHERE `virtuemart_customfield_id` ="' . (int)$virtuemart_customfield_id . '"';
		}
		$db->setQuery ($q);
		$field = $db->loadObject ();
		if($field){
			VirtueMartModelCustomfields::bindCustomEmbeddedFieldParams($field,$field->field_type);
			//VirtueMartModelCustomfields::bindParameterableByFieldType($field);
		}

		return $field;
	}


	function getCustomEmbeddedProductCustomFields($virtuemart_product_id, $cartattribute=-1){

		$db= JFactory::getDBO ();
		$q = $this->getProductCustomSelectFieldList();
		$q .= ' WHERE `virtuemart_product_id` =' . (int)$virtuemart_product_id . ' '; // and `field_type` != "G" and `field_type` != "R" and `field_type` != "Z"';

		if($cartattribute != -1){
			$q .= ' AND is_cart_attribute = "'.$cartattribute.'" ';
		}
		$q .= ' GROUP BY `virtuemart_custom_id` ORDER BY field.`ordering`,`virtuemart_custom_id` ASC';

		$db->setQuery ($q);
		$productCustoms = $db->loadObjectList ();
		$err=$db->getErrorMsg();
		if($err){
			vmError('getCustomEmbeddedProductCustomFields error in query '.$err);
		}
		if($productCustoms){
			foreach ($productCustoms as $field) {
				VirtueMartModelCustomfields::bindCustomEmbeddedFieldParams($field,$field->field_type);
			}
			return $productCustoms;
		} else {
			return array();
		}

	}

	function getCustomEmbeddedProductCustomGroup($virtuemart_product_id, $virtuemart_custom_id, $cartattribute=-1){
		$db= JFactory::getDBO ();
		$q = $this->getProductCustomSelectFieldList();
		$q .= 'WHERE `virtuemart_product_id` =' . (int)$virtuemart_product_id.' and C.`virtuemart_custom_id`=' . (int)$virtuemart_custom_id;
		if($cartattribute!=-1){
			$q .= ' and is_cart_attribute = 1 ';
		}

		$db->setQuery ($q);
		$productCustoms = $db->loadObjectList ();
		$err=$db->getErrorMsg();
		if($err){
			vmError('getCustomEmbeddedProductCustomFields error in query '.$err);
		}
		if($productCustoms){

			foreach ($productCustoms as $field) {
				VirtueMartModelCustomfields::bindCustomEmbeddedFieldParams($field,$field->field_type);
			}
			vmdebug('getCustomEmbeddedProductCustomGroup',$productCustoms);
			return $productCustoms;
		} else {
			return array();
		}
	}

	/**
	 * Formatting admin display by roles
	 * input Types for product only !
	 * $field->is_cart_attribute if can have a price
	 */
	public function displayProductCustomfieldBE ($field, $product_id, $row) {

		$field->customfield_value = empty($field->customfield_value) ? $field->custom_value : $field->customfield_value;

		if ($field->is_cart_attribute) {
			if(!class_exists('VirtueMartModelVendor')) require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'vendor.php');
			if(!class_exists('VirtueMartModelCurrency')) require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'currency.php');
			$vendor_model = VmModel::getModel('vendor');
			$vendor_model->setId(1);
			$vendor = $vendor_model->getVendor();
			$currency_model = VmModel::getModel('currency');
			$vendor_currency = $currency_model->getCurrency($vendor->vendor_currency);
			$priceInput = '<span style="white-space: nowrap;"><input type="text" size="12" style="text-align:right;" value="' . (isset($field->custom_price) ?  $field->custom_price : '0') . '" name="field[' . $row . '][custom_price]" /> '.$vendor_currency->currency_symbol."</span>";
		}
		else {
			$priceInput = ' ';
		}

		if ($field->is_list) {
			$options = array();
			$values = explode (';', $field->custom_value);

			foreach ($values as $key => $val) {
				$options[] = array('value' => $val, 'text' => $val);
			}

		        $currentValue = $field->customfield_value;
			return JHTML::_ ('select.genericlist', $options, 'field[' . $row . '][custom_value]', NULL, 'value', 'text', $currentValue) . '</td><td>' . $priceInput;
		}
		else {

			switch ($field->field_type) {

				case 'A':
					//vmdebug('displayProductCustomfieldBE $field',$field);
					if(!isset($field->withParent)) $field->withParent = 0;
					if(!isset($field->parentOrderable)) $field->parentOrderable = 0;
					//vmdebug('displayProductCustomfieldBE',$field);
					if (!class_exists('VmHTML')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'html.php');
					$html = JText::_('COM_VIRTUEMART_CUSTOM_WP').VmHTML::checkbox('field[' . $row . '][withParent]',$field->withParent,1,0,'').'<br />';
					$html .= JText::_('COM_VIRTUEMART_CUSTOM_PO').VmHTML::checkbox('field[' . $row . '][parentOrderable]',$field->parentOrderable,1,0,'');

					$options = array();
 					$options[] = array('value' => 'product_name' ,'text' =>JText::_('COM_VIRTUEMART_PRODUCT_FORM_NAME'));
					$options[] = array('value' => 'product_sku', 'text' => JText::_ ('COM_VIRTUEMART_PRODUCT_SKU'));
					$options[] = array('value' => 'slug', 'text' => JText::_ ('COM_VIRTUEMART_PRODUCT_ALIAS'));
					$options[] = array('value' => 'product_length', 'text' => JText::_ ('COM_VIRTUEMART_PRODUCT_LENGTH'));
					$options[] = array('value' => 'product_width', 'text' => JText::_ ('COM_VIRTUEMART_PRODUCT_WIDTH'));
					$options[] = array('value' => 'product_height', 'text' => JText::_ ('COM_VIRTUEMART_PRODUCT_HEIGHT'));
					$options[] = array('value' => 'product_weight', 'text' => JText::_ ('COM_VIRTUEMART_PRODUCT_WEIGHT'));

					$html .= JHTML::_ ('select.genericlist', $options, 'field[' . $row . '][custom_value]', '', 'value', 'text', $field->customfield_value) . '</td><td>' . $priceInput;
					return $html;
					// 					return 'Automatic Childvariant creation (later you can choose here attributes to show, now product name) </td><td>';
					break;
				// variants
				case 'V':
					return '<input type="text" value="' . $field->customfield_value . '" name="field[' . $row . '][custom_value]" /></td><td>' . $priceInput;
					break;
				/*
									 * Stockable (group of) child variants
								 * Special type setted by the plugin
								 */
				case 'G':
					return;
					break;
				/*Extended by plugin*/
				case 'E':

					$html = '<input type="hidden" value="' . $field->custom_value . '" name="field[' . $row . '][custom_value]" />';
					if (!class_exists ('vmCustomPlugin')) {
						require(JPATH_VM_PLUGINS . DS . 'vmcustomplugin.php');
					}
					//vmdebug('displayProductCustomfieldBE $field',$field);
					JPluginHelper::importPlugin ('vmcustom', $field->custom_element);
					$dispatcher = JDispatcher::getInstance ();
					$retValue = '';
					$dispatcher->trigger ('plgVmOnProductEdit', array($field, $product_id, &$row, &$retValue));

					return $html . $retValue  . '</td><td>'. $priceInput;
					break;
				case 'D':
					return vmJsApi::jDate ($field->customfield_value, 'field[' . $row . '][custom_value]', 'field_' . $row . '_customvalue') .'</td><td>'. $priceInput;
					break;
				case 'T':
					//TODO Patrick
					return '<input type="text" value="' . $field->customfield_value . '" name="field[' . $row . '][custom_value]" /></td><td>' . $priceInput;
					break;
				/* string or integer */
				case 'S':
				case 'I':
					return '<input type="text" value="' . $field->customfield_value . '" name="field[' . $row . '][custom_value]" /></td><td>' . $priceInput;
					break;
				//'X'=>'COM_VIRTUEMART_CUSTOM_EDITOR',
				case 'X':
					return '<textarea class="mceInsertContentNew" name="field[' . $row . '][custom_value]" id="field-' . $row . '-custom_value">' . $field->customfield_value . '</textarea>
						<script type="text/javascript">// Creates a new editor instance
							tinymce.execCommand("mceAddControl",true,"field-' . $row . '-custom_value")
						</script></td><td>' . $priceInput;
					//return '<input type="text" value="'.$field->customfield_value.'" name="field['.$row.'][custom_value]" /></td><td>'.$priceInput;
					break;
				//'Y'=>'COM_VIRTUEMART_CUSTOM_TEXTAREA'
				case 'Y':
					return '<textarea id="field[' . $row . '][custom_value]" name="field[' . $row . '][custom_value]" class="inputbox" cols=80 rows=50 >' . $field->customfield_value . '</textarea></td><td>' . $priceInput;
					//return '<input type="text" value="'.$field->customfield_value.'" name="field['.$row.'][custom_value]" /></td><td>'.$priceInput;
					break;

				case 'editorta':
					jimport ('joomla.html.editor');
					$editor = JFactory::getEditor ();
					//TODO This is wrong!
					$_return['fields'][$_fld->name]['formcode'] = $editor->display ($_prefix . $_fld->name, $_return['fields'][$_fld->name]['value'], 300, 150, $_fld->cols, $_fld->rows);
					break;
				/* bool */
				case 'B':
					return JHTML::_ ('select.booleanlist', 'field[' . $row . '][custom_value]', 'class="inputbox"', $field->customfield_value) . '</td><td>' . $priceInput;
					break;
				/* parent */
				case 'P':
					return $field->customfield_value . '<input type="hidden" value="' . $field->customfield_value . '" name="field[' . $row . '][custom_value]" /></td><td>';
					break;
				/* related category*/
				case 'Z':
					if (!$field->customfield_value) {
						return '';
					} // special case it's category ID !
					$q = 'SELECT * FROM `#__virtuemart_categories_' . VMLANG . '` JOIN `#__virtuemart_categories` AS p using (`virtuemart_category_id`) WHERE `published`=1 AND `virtuemart_category_id`= "' . (int)$field->custom_value . '" ';
					$this->_db->setQuery ($q);
					//echo $this->_db->_sql;
					if ($category = $this->_db->loadObject ()) {
						$q = 'SELECT `virtuemart_media_id` FROM `#__virtuemart_category_medias` WHERE `virtuemart_category_id`= "' . (int)$field->custom_value . '" ';
						$this->_db->setQuery ($q);
						$thumb = '';
						if ($media_id = $this->_db->loadResult ()) {
							$thumb = $this->displayCustomMedia ($media_id);
						}
						$display = '<input type="hidden" value="' . $field->custom_value . '" name="field[' . $row . '][custom_value]" />';
						return $display . JHTML::link (JRoute::_ ('index.php?option=com_virtuemart&view=category&task=edit&virtuemart_category_id=' . (int)$field->custom_value), $thumb . ' ' . $category->category_name, array('title' => $category->category_name)) . $display;
					}
					else {
						return 'no result';
					}
				/* related product*/
				case 'R':
					if (!$field->customfield_value) {
						return '';
					}
					$q = 'SELECT `product_name`,`product_sku`,`product_s_desc` FROM `#__virtuemart_products_' . VMLANG . '` AS l LEFT JOIN `#__virtuemart_products` using (`virtuemart_product_id`) WHERE `virtuemart_product_id`=' . (int)$field->customfield_value ;
					$this->_db->setQuery ($q);
					$related = $this->_db->loadObject ();
					$err = $this->_db->getErrorMsg();
					if(!empty($err)){
						vmError('Error in get R '.$err,'Error in get R ');
					}
					$display = $related->product_name . '(' . $related->product_sku . ')';
					$display .= '<input type="hidden" value="' . $field->customfield_value . '" name="field[' . $row . '][custom_value]" />';

					$q = 'SELECT `virtuemart_media_id` FROM `#__virtuemart_product_medias`WHERE `virtuemart_product_id`= "' . (int)$field->customfield_value . '" AND (`ordering` = 0 OR `ordering` = 1)';
					$this->_db->setQuery ($q);
					$thumb = '';
					if ($media_id = $this->_db->loadResult ()) {
						vmdebug('Show media');
						$thumb = $this->displayCustomMedia ($media_id);
					}
					$title= $related->product_s_desc?  $related->product_s_desc :'';
					return $display . JHTML::link (JRoute::_ ('index.php?option=com_virtuemart&view=product&task=edit&virtuemart_product_id=' . $field->customfield_value), $thumb . '<br /> ' . $related->product_name, array('title' => $title));
					break;
				/* image */
				case 'M':
					if (empty($product)) {
						$vendorId = 1;
					}
					else {
						$vendorId = $product->virtuemart_vendor_id;
					}
					$q = 'SELECT `virtuemart_media_id` as value,`file_title` as text FROM `#__virtuemart_medias` WHERE `published`=1
					AND (`virtuemart_vendor_id`= "' . $vendorId . '" OR `shared` = "1")';
					$this->_db->setQuery ($q);
					$options = $this->_db->loadObjectList ();
					return JHTML::_ ('select.genericlist', $options, 'field[' . $row . '][custom_value]', '', 'value', 'text', $field->customfield_value) . '</td><td>' . $priceInput;
					break;

			}

		}
	}


	/**
	 * Formating front display by roles
	 *  for product only !
	 */
	public function displayProductCustomfieldFE (&$product, &$customfield) {

		if(!isset($customfield->display))$customfield->display = '';

		if(!isset($product->row)) $product->row = 0;
		$row = $product->row;   //just a quickndirty fallback must be removed

		if(!isset($customfield->row)){
			$customfield->row = 0;
			vmTrace('displayProductCustomfieldFE customfield has no row');
		}
		$customfield->customfield_value = (int)$customfield->customfield_value;


		if ($customfield->field_type == "E") {

			JPluginHelper::importPlugin ('vmcustom');
			$dispatcher = JDispatcher::getInstance ();
			$ret = $dispatcher->trigger ('plgVmOnDisplayProductFE', array(&$product, &$customfield));
			return; // $customfield->display;
		}

		$productCounter = '['.$product->row.']';

		$virtuemart_custom_id = isset($customfield->virtuemart_custom_id)? $customfield->virtuemart_custom_id:0;
		$value = $customfield->custom_value;
		$type = $customfield->field_type;
		$is_list = isset($customfield->is_list)? $customfield->is_list:0;
		$price = isset($customfield->custom_price)? $customfield->custom_price:0;
		$is_cart_attribute = isset($customfield->is_cart_attribute)? $customfield->is_cart_attribute:0;


		if (!class_exists ('CurrencyDisplay'))
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'currencydisplay.php');
		$currency = CurrencyDisplay::getInstance ();

		if ($is_list > 0) {
			$values = explode (';', $value);
			if ($is_cart_attribute != 0) {

				$options = array();

				foreach ($values as $key => $val) {
					$options[] = array('value' => $val, 'text' => $val);
				}
				vmdebug('displayProductCustomfieldFE is a list ',$options);
				return JHTML::_ ('select.genericlist', $options, 'field'.$productCounter.'[' . $row . '][custom_value]', NULL, 'value', 'text', FALSE, TRUE);
			}
			else {
				$html = '';
				// 				if($type=='M'){
				// 					foreach ($values as $key => $val){
				// 						$html .= '<div id="custom_'.$virtuemart_custom_id.'_'.$val.'" >'.$this->displayCustomMedia($val).'</div>';
				// 					}

				// 				} else {
				// 					foreach ($values as $key => $val){
				$html .= '<div id="custom_' . $virtuemart_custom_id . '_' . $value . '" >' . $value . '</div>';
				// 					}
				// 				}

				return $html;
			}

		}
		else if($is_cart_attribute==1){
			if (!class_exists ('VmHTML')) {
				require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'html.php');
			}

			if (!class_exists ('CurrencyDisplay')) {
				require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'currencydisplay.php');
			}
			$currency = CurrencyDisplay::getInstance ();

			if (!class_exists ('calculationHelper')) {
				require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'calculationh.php');
			}
			$calculator = calculationHelper::getInstance ();
			$calculator ->_product = $product;
			if (!class_exists ('vmCustomPlugin')) {
				require(JPATH_VM_PLUGINS . DS . 'vmcustomplugin.php');
			}

			$group = $customfield;

			$options = $this->getCustomEmbeddedProductCustomGroup($product->virtuemart_product_id,$group->virtuemart_custom_id,1);
			//vmdebug('getProductCustomsFieldCart options',$options);
			$group->options = array();
			foreach ($options as $option) {
				$group->options[$option->virtuemart_customfield_id] = $option;
			}

			if ($group->field_type == 'V') {
				$default = current ($group->options);
				foreach ($group->options as $productCustom) {
					$price = self::_getCustomPrice($productCustom->custom_price, $currency, $calculator);
					$productCustom->text = $productCustom->customfield_value . ' ' . $price;
				}
				$group->display = VmHTML::select ('customProductData['.$productCounter.'][' . $row . '][' . $group->virtuemart_custom_id . ']', $group->options, $default->customfield_value, '', 'virtuemart_customfield_id', 'text', FALSE);
			}
			else {

				$checked = 'checked="checked"';
				foreach ($group->options as $productCustom) {
					//vmdebug('getProductCustomsFieldCart',$productCustom);
					$price = self::_getCustomPrice($productCustom->custom_price, $currency, $calculator);
					$productCustom->field_type = $group->field_type;
					$productCustom->is_cart = 1;

					$group->display .= '<input id="' . $productCustom->virtuemart_custom_id . $row . '" ' . $checked . ' type="radio" value="' .
						$productCustom->virtuemart_customfield_id . '" name="customProductData['.$productCounter.'][' . $row . '][' . $productCustom->virtuemart_custom_id . ']" /><label
						for="' . $productCustom->virtuemart_custom_id . $row . '" >' . $this->displayProductCustomfieldFE ($product, $productCustom, $row) . ' ' . $price . '</label><br />';

					$checked = '';
				}

			}


			return $group;
		}
		else {
			if ($price > 0) {

				$price = $currency->priceDisplay ((float)$price);
			}
			switch ($type) {

				case 'A':

					$options = array();

					$session = JFactory::getSession ();
					$virtuemart_category_id = $session->get ('vmlastvisitedcategoryid', 0, 'vm');

					$productModel = VmModel::getModel ('product');

					//parseCustomParams
					//TODO I think this can now be removed
					//VirtueMartModelCustomfields::bindCustomEmbeddedFieldParams($customfield);
					//Todo preselection as dropdown of children
					//Note by Max Milbers: This is not necessary, in this case it is better to unpublish the parent and to give the child which should be preselected a category
					//Or it is withParent, in that case there exists the case, that a parent should be used as a kind of mini category and not be orderable.
					//There exists already other customs and in special plugins which wanna disable or change the add to cart button.
					//I suggest that we manipulate the button with a message "choose a variant first"
					//if(!isset($customfield->pre_selected)) $customfield->pre_selected = 0;
					$selected = JRequest::getInt ('virtuemart_product_id',0);

					$html = '';
					$uncatChildren = $productModel->getUncategorizedChildren ($customfield->withParent);

					foreach ($uncatChildren as $k => $child) {
						if(!isset($child[$customfield->custom_value])){
							vmdebug('The child has no value at index '.$customfield->custom_value,$customfield,$child);
						} else {
							$options[] = array('value' => JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_category_id=' . $virtuemart_category_id . '&virtuemart_product_id=' . $child['virtuemart_product_id']), 'text' => $child[$customfield->custom_value]);
						}
					}

					$html .= JHTML::_ ('select.genericlist', $options, 'field'.$productCounter.'[' . $row . '][custom_value]', 'onchange="window.top.location.href=this.options[this.selectedIndex].value" size="1" class="inputbox"', "value", "text",
						JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_category_id=' . $virtuemart_category_id . '&virtuemart_product_id=' . $selected));
					//vmdebug('$customfield',$customfield);

					if($customfield->parentOrderable==0 and $product->product_parent_id==0){
						$product->orderable = FALSE;
					}

					return $html;
					break;

				/* variants*/
				case 'V':
					if ($price == 0)
						$price = JText::_ ('COM_VIRTUEMART_CART_PRICE_FREE');

					/* Loads the product price details */
					return '<input type="text" value="' . JText::_ ($value) . '" name="field'.$productCounter.'[' . $row . '][custom_value]" /> ' . JText::_ ('COM_VIRTUEMART_CART_PRICE') . $price . ' ';
					break;
				/*Date variant*/
				case 'D':
					return '<span class="product_custom_date">' . vmJsApi::date ($value, 'LC1', TRUE) . '</span>'; //vmJsApi::jDate($field->custom_value, 'field['.$row.'][custom_value]','field_'.$row.'_customvalue').$priceInput;
					break;
				/* text area or editor No JText, only displayed in BE */
				case 'X':
				case 'Y':
					return $value;
					break;
				/* string or integer */
				case 'S':
				case 'I':
					return JText::_ ($value);
					break;
				/* bool */
				case 'B':
					if ($value == 0)
						return JText::_ ('COM_VIRTUEMART_NO');
					return JText::_ ('COM_VIRTUEMART_YES');
					break;
				/* parent */
				case 'P':
					return '<span class="product_custom_parent">' . JText::_ ($value) . '</span>';
					break;
				/* image */
				case 'M':
					return $this->displayCustomMedia ($value);
					break;
				case 'Z':
					$html = '';
					$q = 'SELECT * FROM `#__virtuemart_categories_' . VMLANG . '` as l JOIN `#__virtuemart_categories` AS c using (`virtuemart_category_id`) WHERE `published`=1 AND l.`virtuemart_category_id`= "' . (int)$value . '" ';
					$this->_db->setQuery ($q);
					if ($category = $this->_db->loadObject ()) {
						$q = 'SELECT `virtuemart_media_id` FROM `#__virtuemart_category_medias`WHERE `virtuemart_category_id`= "' . $category->virtuemart_category_id . '" ';
						$this->_db->setQuery ($q);
						$thumb = '';
						if ($media_id = $this->_db->loadResult ()) {
							$thumb = $this->displayCustomMedia ($media_id);
						}
						$customfield->display = JHTML::link (JRoute::_ ('index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $category->virtuemart_category_id), $thumb . ' ' . $category->category_name, array('title' => $category->category_name));
					}
					break;
				case 'R':

					$q = 'SELECT l.`product_name`, p.`product_parent_id` , l.`product_name`, x.`virtuemart_category_id` FROM `#__virtuemart_products_' . VMLANG . '` as l
					 JOIN `#__virtuemart_products` AS p using (`virtuemart_product_id`)
					 LEFT JOIN `#__virtuemart_product_categories` as x on x.`virtuemart_product_id` = p.`virtuemart_product_id`
					 WHERE p.`published`=1 AND  p.`virtuemart_product_id`= "' . $customfield->customfield_value . '" ';
					$this->_db->setQuery ($q);
					if($related = $this->_db->loadObject ()){

						$q = 'SELECT `virtuemart_media_id` FROM `#__virtuemart_product_medias` WHERE `virtuemart_product_id`= "' . (int)$customfield->customfield_value . '" ORDER BY `ordering` ASC';
						$this->_db->setQuery ($q);
						if ($media_id = $this->_db->loadResult ()) {
							$thumb = $this->displayCustomMedia ($media_id).' ';
							//vmdebug('displayProductCustomfieldFE in R ',$thumb);
							$customfield->display = JHTML::link (JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $customfield->customfield_value . '&virtuemart_category_id=' . $related->virtuemart_category_id), $thumb   . $related->product_name, array('title' => $related->product_name));
						} else {
							$err = $this->_db->getErrorMsg();
							vmdebug('No related product found for '.$customfield->customfield_value.', maybe Product has no category? '.$err);
						}
					} else {
						$err = $this->_db->getErrorMsg();
						vmdebug('No related product found for '.$customfield->customfield_value.', maybe Product has no category? '.$err);
					}
					return '';
					break;
				case 'G':
					return ''; //'<input type="text" value="'.JText::_($value).'" name="field['.$row.'][custom_value]" /> '.JText::_('COM_VIRTUEMART_CART_PRICE').' : '.$price .' ';
					break;
					break;
			}
		}
	}


	/**
	 * There are too many functions doing almost the same for my taste
	 * the results are sometimes slighty different and makes it hard to work with it, therefore here the function for future proxy use
	 *
	 */
	public function displayProductCustomfieldSelected ($product, $html, $trigger) {

		$row = 0;
		if (!class_exists ('shopFunctionsF'))
			require(JPATH_VM_SITE . DS . 'helpers' . DS . 'shopfunctionsf.php');

		$variantmods = $product -> customProductData;
		foreach ($variantmods as $selected => $nix) {

			if ($selected) {
				$productCustom = self::getCustomEmbeddedProductCustomField ($selected);
				//vmdebug('customFieldDisplay',$selected,$productCustom);
				if (!empty($productCustom)) {
					$html .= ' <span class="product-field-type-' . $productCustom->field_type . '">';
					if ($productCustom->field_type == "E") {

						$product->productCustom = $productCustom;
						$product->row = $row;
						//vmdebug('CustomsFieldCartDisplay $productCustom',$productCustom);
// 								vmdebug('customFieldDisplay $product->param selected '.$selected,$product->param);
						if (!class_exists ('vmCustomPlugin'))
							require(JPATH_VM_PLUGINS . DS . 'vmcustomplugin.php');
						JPluginHelper::importPlugin ('vmcustom');
						$dispatcher = JDispatcher::getInstance ();
						$dispatcher->trigger ($trigger, array($product, $row, &$html));

					}
					else {
						//vmdebug('customFieldDisplay $productCustom by self::getProductCustomField $variant: '.$variant.' $selected: '.$selected,$productCustom);
						$value = '';
						if (($productCustom->field_type == "G")) {

							$db = JFactory::getDBO ();
							$db->setQuery ('SELECT  `product_name` FROM `#__virtuemart_products_' . VMLANG . '` WHERE virtuemart_product_id=' . (int)$productCustom->custom_value);
							$child = $db->loadObject ();
							$value = $child->product_name;
						}
						elseif (($productCustom->field_type == "M")) {
							// 						$html .= $productCustom->custom_title.' '.self::displayCustomMedia($productCustom->custom_value);
							$value = self::displayCustomMedia ($productCustom->custom_value);
						}
						elseif (($productCustom->field_type == "S")) {
							// 					q	$html .= $productCustom->custom_title.' '.JText::_($productCustom->custom_value);
							$value = $productCustom->custom_value;
						}
						else {
							// 						$html .= $productCustom->custom_title.' '.$productCustom->custom_value;
							//vmdebug('customFieldDisplay',$productCustom);
							$value = $productCustom->custom_value;
						}
						$html .= ShopFunctionsF::translateTwoLangKeys ($productCustom->custom_title, $value);
					}
					$html .= '</span><br />';
				}
				else {
					// falldown method if customfield are deleted
					foreach ((array)$selected as $key => $value) {
						$html .= '<br/ >Couldnt find customfield' . ($key ? '<span>' . $key . ' </span>' : '') . $value;
					}
					//vmdebug ('CustomsFieldOrderDisplay, $item->productCustom empty? ' . $variant);
					vmdebug ('customFieldDisplay, $productCustom is EMPTY ');
				}

			}
			$row++;
		}

	//	vmdebug ('customFieldDisplay html begin: ' . $html . ' end');
		return $html . '</div>';
	}


	/**
	 * TODO This is html and view stuff and MUST NOT be in the model, notice by Max
	 * render custom fields display cart module FE
	 */
	public function CustomsFieldCartModDisplay ($product) {

		return self::displayProductCustomfieldSelected ($product, '<div class="vm-customfield-mod">', 'plgVmOnViewCartModule');

	}

	/**
	 *  TODO This is html and view stuff and MUST NOT be in the model, notice by Max
	 * render custom fields display cart FE
	 */
	public function CustomsFieldCartDisplay ($product) {

		return self::displayProductCustomfieldSelected ($product, '<div class="vm-customfield-cart">', 'plgVmOnViewCart');

	}

	/*
	 * render custom fields display order BE/FE
	*/
	public function CustomsFieldOrderDisplay ($item, $view = 'FE', $absUrl = FALSE) {

		if (!empty($item->product_attribute)) {
			$item->param = json_decode ($item->product_attribute, TRUE);
			if (!empty($item->param)) {
				return self::displayProductCustomfieldSelected ($item, $item->param, '<div class="vm-customfield-cart">', 'plgVmDisplayInOrder' . $view);
			} else {
				vmdebug ('CustomsFieldOrderDisplay $item->param empty? ');
			}
		}

		return FALSE;
	}

	function displayCustomMedia ($media_id, $table = 'product', $absUrl = FALSE) {

		if (!class_exists ('TableMedias'))
			require(JPATH_VM_ADMINISTRATOR . DS . 'tables' . DS . 'medias.php');
		//$data = $this->getTable('medias');
		$db = JFactory::getDBO ();
		$data = new TableMedias($db);
		$data->load ((int)$media_id);

		if (!class_exists ('VmMediaHandler'))
			require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'mediahandler.php');
		$media = VmMediaHandler::createMedia ($data, $table);

		return $media->displayMediaThumb ('', FALSE, '', TRUE, TRUE, $absUrl);

	}

	static function _getCustomPrice($customPrice, $currency, $calculator) {
		if ((float)$customPrice) {
			$price = strip_tags ($currency->priceDisplay ($calculator->calculateCustomPriceWithTax ($customPrice)));
			if ($customPrice >0) {
				$price ="+".$price;
			}
		}
		else {
			$price = ($customPrice === '') ? '' :  JText::_ ('COM_VIRTUEMART_CART_PRICE_FREE');
		}
		return $price;
	}

	/**
	 * @param $product
	 * @param $variants ids of the selected variants
	 * @return float
	 */
	public function calculateModificators(&$product, $variants) {

		$modificatorSum = 0.0;

		foreach ($variants as $selected => $variant) {

			if (!empty($selected)) {

				$productCustom = $this->getCustomEmbeddedProductCustomField($selected);

				if (!empty($productCustom) and $productCustom->field_type =='E') {
					if(!class_exists('vmCustomPlugin')) require(JPATH_VM_PLUGINS.DS.'vmcustomplugin.php');
					JPluginHelper::importPlugin('vmcustom');
					$dispatcher = JDispatcher::getInstance();
					$dispatcher->trigger('plgVmCalculateCustomVariant',array(&$product, &$productCustom,$variant,$modificatorSum));
				}

				if (!empty($productCustom->custom_price)) {
					//TODO adding % and more We should use here $this->interpreteMathOp
					$modificatorSum = $modificatorSum + $productCustom->custom_price;
				}
			//	vmdebug('calculateModificators $modificatorSum',$modificatorSum);
			}
		}

// 			echo ' $modificatorSum ',$modificatorSum;
		return $modificatorSum;
	}

	static function setParameterableByFieldType(&$table, $type, $custom_element=0,$custom_jplugin_id=0){

		//$type = $table->field_type;
		if($custom_element===0){
			$custom_element = $table->custom_element;
		}

		if($custom_jplugin_id===0){
			$custom_jplugin_id = $table->custom_jplugin_id;
		}

		$varsToPush = self::getVarsToPush($type);
		$xParams = $table->_xParams;

		if ($type == 'E') {
			JPluginHelper::importPlugin ('vmcustom');
			$dispatcher = JDispatcher::getInstance ();
			$retValue = $dispatcher->trigger ('plgVmGetTablePluginParams', array('custom',$custom_element, $custom_jplugin_id, &$xParams, &$varsToPush));
		}

		if(!empty($varsToPush)){
			$table->setParameterable($xParams,$varsToPush,TRUE);
		}

	}


	static function bindParameterableByFieldType(&$table, $type){

		$varsToPush = self::getVarsToPush($type);
		$xParams = $table->_xParams;
		if ($type == 'E') {
			JPluginHelper::importPlugin ('vmcustom');
			$dispatcher = JDispatcher::getInstance ();
			$retValue = $dispatcher->trigger ('plgVmDeclarePluginParamsCustom', array(&$table));
		}

		if(!empty($varsToPush)){
			VmTable::bindParameterable($table,$table->_xParam,$varsToPush);
		}

	}

	static function getVarsToPush($type){

		$varsToPush = 0;
		if($type=='A'){
			$varsToPush = array(
				'withParent'        => array(0, 'int'),
				'parentOrderable'   => array(0, 'int')
			);
		}
		return $varsToPush;
	}


	/* Save and delete from database
	* all product custom_fields and xref
	@ var   $table	: the xref table(eg. product,category ...)
	@array $data	: array of customfields
	@int     $id		: The concerned id (eg. product_id)
	*/
	public function storeProductCustomfields($table,$datas, $id) {

		//vmdebug('storeProductCustomfields',$datas);
		JRequest::checkToken() or jexit( 'Invalid Token, in store customfields');
		//Sanitize id
		$id = (int)$id;

		//Table whitelist
		$tableWhiteList = array('product','category','manufacturer');
		if(!in_array($table,$tableWhiteList)) return false;


		// Get old IDS
		$this->_db->setQuery( 'SELECT `virtuemart_customfield_id` FROM `#__virtuemart_'.$table.'_customfields` as `PC` WHERE `PC`.virtuemart_'.$table.'_id ='.$id );
		$old_customfield_ids = $this->_db->loadResultArray();

		if (array_key_exists('field', $datas)) {

			foreach($datas['field'] as $key => $fields){

				$fields['virtuemart_'.$table.'_id'] =$id;
				$tableCustomfields = $this->getTable($table.'_customfields');
				$tableCustomfields->setPrimaryKey('virtuemart_product_id');
				if (!empty($datas['custom_param'][$key]) and !isset($datas['clone']) ) {
					if (array_key_exists( $key,$datas['custom_param'])) {
						$fields = array_merge ((array)$fields, (array)$datas['custom_param'][$key]);
					}
				}

				VirtueMartModelCustomfields::setParameterableByFieldType($tableCustomfields,$fields['field_type'],$fields['custom_element'],$fields['custom_jplugin_id']);

				$tableCustomfields->bindChecknStore($fields);
				$errors = $tableCustomfields->getErrors();

				foreach($errors as $error){
					vmError($error);
				}
				$key = array_search($fields['virtuemart_customfield_id'], $old_customfield_ids );
				if ($key !== false ) unset( $old_customfield_ids[ $key ] );
// 				vmdebug('datas clone',$old_customfield_ids,$fields);
			}
		} else {
			vmdebug('storeProductCustomfields nothing to store',$datas['field']);
		}

		if ( count($old_customfield_ids) ) {
			// delete old unused Customfields
			$this->_db->setQuery( 'DELETE FROM `#__virtuemart_'.$table.'_customfields` WHERE `virtuemart_customfield_id` in ("'.implode('","', $old_customfield_ids ).'") ');
			$this->_db->query();
		}


		JPluginHelper::importPlugin('vmcustom');
		$dispatcher = JDispatcher::getInstance();
		if (isset($datas['plugin_param']) and is_array($datas['plugin_param'])) {
			foreach ($datas['plugin_param'] as $key => $plugin_param ) {
				$dispatcher->trigger('plgVmOnStoreProduct', array($datas, $plugin_param ));
			}
		}

	}


	static public function setEditCustomHidden ($customfield, $i) {

		if (!isset($customfield->virtuemart_customfield_id))
			$customfield->virtuemart_customfield_id = '0';
		$html = '
			<input type="hidden" value="' . $customfield->field_type . '" name="field[' . $i . '][field_type]" />
			<input type="hidden" value="' . $customfield->custom_element . '" name="field[' . $i . '][custom_element]" />
			<input type="hidden" value="' . $customfield->custom_jplugin_id . '" name="field[' . $i . '][custom_jplugin_id]" />
			<input type="hidden" value="' . $customfield->virtuemart_custom_id . '" name="field[' . $i . '][virtuemart_custom_id]" />
			<input type="hidden" value="' . $customfield->virtuemart_customfield_id . '" name="field[' . $i . '][virtuemart_customfield_id]" />
			<input type="hidden" value="' . $customfield->admin_only . '" checked="checked" name="field[' . $i . '][admin_only]" />';
		return $html;

	}
}
// pure php no closing tag
