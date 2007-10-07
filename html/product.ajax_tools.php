<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2007 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
global $ps_product;
$task = strtolower( mosGetParam( $_REQUEST, 'task' ));
$option = strtolower( mosGetParam( $_REQUEST, 'option' ));
require_once( CLASSPATH.'connectionTools.class.php');

switch( $task ) {
	case 'getshoppergroups':
		include_class('shopper');
		$shopper_group_id = intval( mosGetParam( $_REQUEST, 'shopper_group_id', 5 ));
		vmConnector::sendHeaderAndContent( 200, $ps_shopper_group->list_shopper_groups() );
		break;
		
	case 'getpriceforshoppergroup':
		include_class('product');
		$shopper_group_id = intval( mosGetParam( $_REQUEST, 'shopper_group_id', 5 ));
		$product_id = intval( mosGetParam( $_REQUEST, 'product_id' ));
		$price = $ps_product->getPriceByShopperGroup( $product_id, $shopper_group_id );
		$formatPrice = mosGetParam( $_REQUEST, 'formatPrice', 0 );
		if( $formatPrice ) {
			$price['product_price'] = '<span class="editable" onclick="getPriceForm(this);">'.$GLOBALS['CURRENCY_DISPLAY']->getValue( $price['product_price']).' '.$price['product_currency'].'</span>';
		}
		vmConnector::sendHeaderAndContent( 200, @$price['product_price'] );
		break;
		
	case 'getcurrencylist':
		$currency_code = mosGetParam( $_REQUEST, 'product_currency', $vendor_currency );
		if( strstr($currency_code, ',')) {
			$currency_code = explode( ',', $currency_code );
		}
		elseif( empty( $currency_code)) {
			$currency_code = $vendor_currency;
		}
		$selectSize = intval( mosGetParam( $_REQUEST, 'selectSize', 1 ) );
		$elementName = urldecode( mosGetParam( $_REQUEST, 'elementName', 'product_currency'));
		$multiple = intval( mosGetParam( $_REQUEST, 'multiple', 0 ) );
		if( $multiple ) { $multiple = 'multiple="multiple"'; } else { $multiple = ''; }
		vmConnector::sendHeaderAndContent( 200, ps_html::getCurrencyList( $elementName, $currency_code, 'currency_code', '', $selectSize, $multiple ) );
		break;
	
	case 'getpriceform':
		include_class('shopper');
		include_class('product');
		$shopper_group_id = intval( mosGetParam( $_REQUEST, 'shopper_group_id', 5 ));
		$product_id = intval( mosGetParam( $_REQUEST, 'product_id' ));
		$currency_code = mosGetParam( $_REQUEST, 'product_currency', $vendor_currency );
		$price = $ps_product->getPriceByShopperGroup( $product_id, $shopper_group_id );
		if( isset( $price['product_currency'] )) {
			$currency_code = $price['product_currency'];
			$currency_code = $price['product_currency'];
		}
		$formName = 'priceForm';
		$content = '<form id="'.$formName.'" method="post" name="priceForm">';
		$content .= '<table class="adminform"><tr><td><strong>'.$VM_LANG->_PHPSHOP_PRICE_FORM_PRICE.':</strong></td><td><input type="text" name="product_price" value="'.$price['product_price'].'" class="inputbox" id="product_price_'.$formName.'" size="11" /></td></tr>';
		$content .= '<tr><td><strong>'.$VM_LANG->_PHPSHOP_PRICE_FORM_GROUP.':</strong></td><td>'.$ps_shopper_group->list_shopper_groups('shopper_group_id', $shopper_group_id, '', 'onchange="reloadForm( \''.$product_id.'\', \'shopper_group_id\', this.options[this.selectedIndex].value);"' ).'</td></tr>';
		$content .= '<tr><td><strong>'.$VM_LANG->_PHPSHOP_PRICE_FORM_CURRENCY.':</strong></td><td>'.ps_html::getCurrencyList( 'product_currency', $currency_code, 'currency_code', 'style="max-width:120px;"' ).'</td></tr></table>';
		$content .= '<input type="hidden" name="product_price_id" value="'.$price['product_price_id'].'" id="product_price_id_'.$formName.'" />';
		$content .= '<input type="hidden" name="product_id" value="'.$product_id.'" />';
		$content .= '<input type="hidden" name="func" value="'. (empty($price['product_price_id']) ? 'productPriceAdd' : 'productPriceUpdate') . '" />';
		$content .= '<input type="hidden" name="ajax_request" value="1" />';
		$content .= '<input type="hidden" name="no_html" value="1" />';
		$content .= '<input type="hidden" name="option" value="'.$option.'" />';
		$content .= '</form>';
		vmConnector::sendHeaderAndContent( 200, $content );
		break;
		
	case 'getproducts':
		require_once(CLASSPATH . 'JSON.php');
		$db =& new ps_DB;
		$keyword = mosGetParam( $_REQUEST, 'query' );
		$q = "SELECT #__{vm}_product.product_id,category_name,product_name
			FROM #__{vm}_product,#__{vm}_product_category_xref,#__{vm}_category ";
		if( empty($_REQUEST['show_items']) ) {
			$q .= "WHERE product_parent_id='0'
					AND #__{vm}_product.product_id <> '$product_id' 
					AND #__{vm}_product.product_id=#__{vm}_product_category_xref.product_id
					AND #__{vm}_product_category_xref.category_id=#__{vm}_category.category_id";
		}
		else {
			$q .= "WHERE #__{vm}_product.product_id <> '$product_id' 
					AND  #__{vm}_product.product_id=#__{vm}_product_category_xref.product_id 
					AND #__{vm}_product_category_xref.category_id=#__{vm}_category.category_id";
		}
		if( $keyword ) {
			$q .= ' AND (product_name LIKE \'%'.$keyword.'%\'';
			$q .= ' OR category_name LIKE \'%'.$keyword.'%\')';
		}
		$q .= ' ORDER BY category_name,#__{vm}_category.category_id,product_name';
		$q .= ' LIMIT '.(int)$_REQUEST['start'].', '.$_REQUEST['limit'];
		$db->query( $q );
		$response['totalCount'] = $db->num_rows();
		while( $db->next_record() ) {
			$response['products'][] = array( 'product_id' => $db->f("product_id"),
									'category' => htmlentities($db->f("category_name")),
									'product' => htmlentities($db->f("product_name"))
									);
			
		}
		error_reporting(0);
		while( @ob_end_clean() );
		$json = new Services_JSON();
		echo $json->encode( $response );
		$vm_mainframe->close(true);
		
		break;
	default:
		exit;
}
exit;
?>