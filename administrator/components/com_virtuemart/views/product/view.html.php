<?php
/**
* @package		VirtueMart
*/

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the VirtueMart Component
 *
 * @package		VirtueMart
 */
class JmartViewProduct extends JView {
	
	function display($tpl = null) {
		/* Get the task */
		$task = JRequest::getVar('task');
		
		/* Load helpers */
		$this->loadHelper('currencydisplay');
		$this->loadHelper('adminMenu');
		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'classes'.DS.'htmlTools.class.php');
		
		/* Load some common models */
		$category_model = $this->getModel('category');
		
		/* Get the category tree */
		$category_tree = $category_model->list_tree(JRequest::getInt('category_id'));
		$this->assignRef('category_tree', $category_tree);
		
		/* Handle any publish/unpublish */
		switch ($task) {
			case 'add':
			case 'edit':
				/* Load some behaviour */
				jimport('joomla.html.pane');
				$pane = JPane::getInstance('tabs'); 
				JHTML::_('behavior.tooltip');
				$editor = JFactory::getEditor();
				
				/* Load the product */
				$product_model = $this->getModel('product');
				$product = $this->get('Product');
				
				/* Load the product price */
				$product_price = $this->get('ProductPrice');
				
				/* Load the currencies */
				$currency_model = $this->getModel('currency');
				$currencies = JHTML::_('select.genericlist', $currency_model->getCurrencies(), 'product_currency', '', 'currency_id', 'currency_name', $product->product_currency);
				
				/* Load the tax rates */
				$tax_model = $this->getModel('taxRate');
				$taxrates = JHTML::_('select.genericlist', $tax_model->getTaxRates(), 'product_tax_id', '"updateGross();"', 'tax_rate_id', 'tax_rate', $product->product_tax_id);
				
				/* Load the tax rates */
				$discount_model = $this->getModel('discount');
				$discounts = JHTML::_('select.genericlist', $discount_model->getDiscounts(), 'product_discount_id', '', 'discount_id', 'amount', $product->product_discount_id);
				
				/* Load the manufacturers */
				$mf_model = $this->getModel('manufacturer');
				$manufacturers = $mf_model->getManufacturerDropdown($product->manufacturer_id);
				
				/* Get the minimum and maximum order levels */
				$min_order = 0;
				$max_order = 0;
				if(strstr($product->product_order_levels, ',')) {
					$order_levels = explode(',', $product->product_order_levels);
					$min_order = $order_levels[0];
					$max_order = $order_levels[1];
				}
				
				/* Get the related products */
				$related_products = $product_model->getRelatedProducts($product->product_id);
				
				/* Get the product attributes */
				$attribute_titles = $product_model->getAttributeTitles($product->product_id);
				$attribute_items = $product_model->getAttributeItems($product->product_id);
				
				/* Set up labels */
				if ($product->product_parent_id > 0) {
					if ($product->product_id) {
						$action = JText::_('VM_PRODUCT_FORM_UPDATE_ITEM_LBL');
					}
					else {
						$action = JText::_('VM_PRODUCT_FORM_NEW_ITEM_LBL');
					}
					$info_label = JText::_('VM_PRODUCT_FORM_ITEM_INFO_LBL');
					$status_label = JText::_('VM_PRODUCT_FORM_ITEM_STATUS_LBL');
					$dim_weight_label = JText::_('VM_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL');
					$images_label = JText::_('VM_PRODUCT_FORM_ITEM_IMAGES_LBL');
					$delete_message = JText::_('VM_PRODUCT_FORM_DELETE_ITEM_MSG');
				}
				else {
					if (0) {
						/* Cloning to be added later */
						if ($product_id = @$vars["product_id"]) {
							if( $clone_product == '1') {
								$action = JText::_('VM_PRODUCT_CLONE');
							}
							else {
								$action = JText::_('VM_PRODUCT_FORM_UPDATE_ITEM_LBL');
							}
						}
						else {
							$action = JText::_('VM_PRODUCT_FORM_NEW_PRODUCT_LBL');
						}
					}
					if ($task == 'add') $action = JText::_('VM_PRODUCT_FORM_NEW_PRODUCT_LBL');
					else $action = JText::_('VM_PRODUCT_FORM_UPDATE_ITEM_LBL');
					
					$info_label = JText::_('VM_PRODUCT_FORM_PRODUCT_INFO_LBL');
					$status_label = JText::_('VM_PRODUCT_FORM_PRODUCT_STATUS_LBL');
					$dim_weight_label = JText::_('VM_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL');
					$images_label = JText::_('VM_PRODUCT_FORM_PRODUCT_IMAGES_LBL');
					$delete_message = JText::_('VM_PRODUCT_FORM_DELETE_PRODUCT_MSG');
				}
				
				/* Assign the values */
				$this->assignRef('pane', $pane);
				$this->assignRef('editor', $editor);
				$this->assignRef('product', $product);
				$this->assignRef('currencies', $currencies);
				$this->assignRef('manufacturers', $manufacturers);
				$this->assignRef('taxrates', $taxrates);
				$this->assignRef('discounts', $discounts);
				$this->assignRef('min_order', $min_order);
				$this->assignRef('max_order', $max_order);
				$this->assignRef('related_products', $related_products);
				$this->assignRef('attribute_titles', $attribute_titles);
				$this->assignRef('attribute_items', $attribute_items);
				
				/* Assign label values */
				$this->assignRef('action', $action);
				$this->assignRef('info_label', $info_label);
				$this->assignRef('status_label', $status_label);
				$this->assignRef('dim_weight_label', $dim_weight_label);
				$this->assignRef('images_label', $images_label);
				$this->assignRef('delete_message', $delete_message);
				
				/* Toolbar */
				if ($task == 'add') $text = JText::_( 'ADD_PRODUCT' );
				else $text = JText::_( 'EDIT_PRODUCT' );
				JToolBarHelper::title($text, 'jm_product_48');
				JToolBarHelper::save();
				JToolBarHelper::cancel();
				break;
			default:
				switch ($task) {
					case 'publish':
					case 'unpublish':
						$this->get('Publish');
						break;
					case 'saveorder':
						$this->get('SaveOrder');
						break;
					case 'orderup':
						$this->get('OrderUp');
						break;
					case 'orderdown':
						$this->get('OrderDown');
						break;
				}
				/* Start model */
				$model = $this->getModel();
				
				/* Get the list of products */
				$productlist = $this->get('ProductList');
				
				/* Check for child products if it is a parent item */
				if (JRequest::getInt('product_parent_id', 0) == 0) {
					foreach ($productlist as $product_id => $product) {
						$product->haschildren = $model->checkChildProducts($product_id);
					}
				}
				
				/* Check for Media Items and Reviews, set the price*/
				$media = new VirtueMartModelMedia();
				$productreviews = new VirtueMartModelProductReviews();
				$currencydisplay = new CurrencyDisplay();
				foreach ($productlist as $product_id => $product) {
					$product->mediaitems = $media->countFilesForProduct($product_id);
					$product->reviews = $productreviews->countReviewsForProduct($product_id);
					$product->product_price_display = $currencydisplay->getValue($product->product_price);
				}
				
				/* Get the pagination */
				$pagination = $this->get('Pagination');
				
				/* Toolbar */
				JToolBarHelper::title(JText::_( 'PRODUCT_LIST' ), 'jm_product_48');
				JToolBarHelper::addNew();
				
				/* Assign the data */
				$this->assignRef('productlist', $productlist);
				$this->assignRef('pagination',	$pagination);
				break;
		}
		
		parent::display($tpl);
	}
	
}
?>
