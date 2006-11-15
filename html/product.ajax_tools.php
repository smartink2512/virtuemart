<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage classes
* @copyright Copyright (C) 2004-2006 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

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
		$formName = uniqid('priceForm');
		$content = '<div id="'.$formName.'">';
		$content .= '<strong>'.$VM_LANG->_PHPSHOP_PRICE_FORM_PRICE.':</strong> <input type="text" name="product_price" value="'.$price['product_price'].'" class="inputbox" id="product_price_'.$formName.'" size="11" /><br />';
		$content .= '<strong>'.$VM_LANG->_PHPSHOP_PRICE_FORM_GROUP.':</strong> '.$ps_shopper_group->list_shopper_groups('shopper_group_id', $shopper_group_id, '', 'onchange="reloadForm( \''.$product_id.'\', \'shopper_group_id\', this.options[this.selectedIndex].value);"' ).'<br />';
		$content .= '<strong>'.$VM_LANG->_PHPSHOP_PRICE_FORM_CURRENCY.':</strong> '.ps_html::getCurrencyList( 'product_currency', $currency_code, 'currency_code', 'style="max-width:120px;"' ).'<br />';
		$content .= '<input type="hidden" name="product_price_id" value="'.$price['product_price_id'].'" id="product_price_id_'.$formName.'" />';
		$content .= '<input type="hidden" name="product_id" value="'.$product_id.'" />';
		$content .= '<input type="hidden" name="func" value="'. (empty($price['product_price_id']) ? 'productPriceAdd' : 'productPriceUpdate') . '" />';
		$content .= '<input type="hidden" name="ajax_request" value="1" />';
		$content .= '<input type="hidden" name="option" value="'.$option.'" />';
		$content .= '<input type="button" id="priceFormSubmit" name="submit" value="'.$VM_LANG->_CMN_SAVE.'" onclick="submitPriceForm(\''.$formName.'\');" class="button" /> ';
		$content .= '<input type="button" id="priceFormCancel" name="submit" value="'.$VM_LANG->_CMN_CANCEL.'" onclick="cancelPriceForm(\''.$product_id.'\');" class="button" />';
		$content .= '</div>';
		vmConnector::sendHeaderAndContent( 200, $content );
		break;
		
	default:
		exit;
}
exit;
?>