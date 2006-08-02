<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: account.order_details.php,v 1.7 2005/10/24 18:13:07 soeren_nb Exp $
* @package VirtueMart
* @subpackage html
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
mm_showMyFileName( __FILE__ );

global $vendor_currency;

require_once(CLASSPATH.'ps_checkout.php');
require_once(CLASSPATH.'ps_product.php');
$ps_product= new ps_product;

$tpl =& new vmTemplate();

$print = mosgetparam( $_REQUEST, 'print', 0);
$order_id = mosgetparam( $_REQUEST, 'order_id', 0);
$tpl->set( 'print', $print );
$tpl->set( 'order_id', $order_id );

$db =& new ps_DB;
$q = "SELECT * FROM `#__{vm}_orders` WHERE ";
$q .= "#__{vm}_orders.user_id='" . $auth["user_id"] . "' ";
$q .= "AND #__{vm}_orders.order_id='$order_id'";
$db->query($q);

if ($db->next_record()) {
	
	$mainframe->setPageTitle( $VM_LANG->_PHPSHOP_ACC_ORDER_INFO.' : '.$VM_LANG->_PHPSHOP_ORDER_LIST_ID.' '.$db->f('order_id'));
	require_once( CLASSPATH.'ps_product_category.php');
	$pathway = "<a href=\"".$sess->url( SECUREURL ."index.php?page=account.index")."\" title=\"".$VM_LANG->_PHPSHOP_ACCOUNT_TITLE."\">"
	      .$VM_LANG->_PHPSHOP_ACCOUNT_TITLE."</a> ".ps_product_category::pathway_separator().' '
	      .$VM_LANG->_PHPSHOP_ACC_ORDER_INFO;
	$mainframe->appendPathWay( $pathway );
	
	// Get bill_to information
	$dbbt = new ps_DB;
	$q  = "SELECT * FROM `#__{vm}_order_user_info` WHERE order_id='" . $db->f("order_id") . "' ORDER BY address_type ASC";
	$dbbt->query($q);
	$dbbt->next_record();
	
	$user = $dbbt->record;
	/** Retrieve Payment Info **/
	$dbpm = new ps_DB;
	
	$q  = "SELECT * FROM `#__{vm}_payment_method`, `#__{vm}_order_payment`, `#__{vm}_orders` ";
	$q .= "WHERE #__{vm}_order_payment.order_id='$order_id' ";
	$q .= "AND #__{vm}_payment_method.payment_method_id=#__{vm}_order_payment.payment_method_id ";
	$q .= "AND #__{vm}_orders.user_id='" . $auth["user_id"] . "' ";
	$q .= "AND #__{vm}_orders.order_id='$order_id' ";
	$dbpm->query($q);
	$dbpm->next_record();

	$tpl->set( 'db', $db );
	$tpl->set( 'dbbt', $dbbt );
	$tpl->set( 'dbpm', $dbpm );
	$tpl->set( 'user', $user );

}
// Get the template for this page
echo $tpl->fetch( 'pages/account.order_details.tpl.php' );
?>
