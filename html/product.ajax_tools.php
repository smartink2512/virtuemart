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
		$price = $ps_product->get_price( $product_id, false, $shopper_group_id );
		vmConnector::sendHeaderAndContent( 200, $price['product_price'] );
		break;
		
	case 'getcurrencylist':
		$currency_code = mosGetParam( $_REQUEST, 'product_currency', $vendor_country_3_code );
		vmConnector::sendHeaderAndContent( 200, ps_html::getCurrencyList( 'product_currency', $currency_code ) );
		break;
	
	case 'getpriceform':
		include_class('shopper');
		include_class('product');
		$shopper_group_id = intval( mosGetParam( $_REQUEST, 'shopper_group_id', 5 ));
		$product_id = intval( mosGetParam( $_REQUEST, 'product_id' ));
		$currency_code = mosGetParam( $_REQUEST, 'product_currency', $vendor_country_3_code );
		$price = $ps_product->get_price( $product_id, false, $shopper_group_id );
		$content = '<form action="index2.php" method="post" name="priceForm">';
		$content .= $VM_LANG->_PHPSHOP_PRICE_FORM_PRICE. ': <input type="text" name="product_price" value="'.$price['product_price'].'" /><br />';
		$content .= $VM_LANG->_PHPSHOP_PRICE_FORM_CURRENCY.' '.ps_html::getCurrencyList( 'product_currency', $currency_code ).'<br />';
		$content .= $VM_LANG->_PHPSHOP_PRICE_FORM_GROUP.': '.$ps_shopper_group->list_shopper_groups().'<br />';
		$content .= '<input type="hidden" name="product_price_id" value="'.$price['product_price_id'].'" />';
		$content .= '<input type="hidden" name="func" value="productPriceUpdate" />';
		$content .= '<input type="hidden" name="option" value="'.$option.'" />';
		$content .= '</form>';
		vmConnector::sendHeaderAndContent( 200, $content );
		break;
		
	default:
		exit;
}
exit;
?>