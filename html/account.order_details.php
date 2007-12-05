<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
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

$tpl =& vmTemplate::getInstance();

$print = vmGet( $_REQUEST, 'pop', 0);
$order_id = vmGet( $_REQUEST, 'order_id', 0);
$tpl->set( 'print', $print );
$tpl->set( 'order_id', $order_id );

$db =& new ps_DB;
$q = "SELECT * FROM `#__{vm}_orders` WHERE ";
$q .= "#__{vm}_orders.user_id='" . $auth["user_id"] . "' ";
$q .= "AND #__{vm}_orders.order_id='$order_id'";
$db->query($q);

if ($db->next_record()) {
	
	$mainframe->setPageTitle( $VM_LANG->_('PHPSHOP_ACC_ORDER_INFO').' : '.$VM_LANG->_('PHPSHOP_ORDER_LIST_ID').' '.$db->f('order_id'));
	require_once( CLASSPATH.'ps_product_category.php');
	
	// Set the CMS pathway
	$pathway = array();
	$pathway[] = $vm_mainframe->vmPathwayItem( $VM_LANG->_('PHPSHOP_ACCOUNT_TITLE'), $sess->url( SECUREURL .'index.php?page=account.index' ) );
	$pathway[] = $vm_mainframe->vmPathwayItem( $VM_LANG->_('PHPSHOP_ACC_ORDER_INFO') );
	$vm_mainframe->vmAppendPathway( $pathway );
	
	// Set the internal VirtueMart pathway
	$tpl->set( 'pathway', $pathway );
	$vmPathway = $tpl->fetch( 'common/pathway.tpl.php' );
	$tpl->set( 'vmPathway', $vmPathway );

	// Get bill_to information
	$dbbt = new ps_DB;
	$q  = "SELECT * FROM `#__{vm}_order_user_info` WHERE order_id='" . $db->f("order_id") . "' ORDER BY address_type ASC";
	$dbbt->query($q);
	$dbbt->next_record();
	$old_user = '';
	if( is_object($user)) {
		$old_user = $user;
	}
	
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
	$tpl->set( 'order_id', $order_id );

	// Get the template for this page
	echo $tpl->fetch( 'pages/account.order_details.tpl.php' );
	if( !empty($old_user) && is_object($old_user)) {
		$user = $old_user;
	}
} else {
	vmRedirect( $sess->url( SECUREURL .'index.php?page=account.index' ) );
}
?>
