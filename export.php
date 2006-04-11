<?php

// Set flag that this is a parent file
define( '_VALID_MOS', 1 );


require_once( '../../../configuration.php' );
require_once( '../../../includes/joomla.php' );
include_once ( $mosConfig_absolute_path . '/language/'. $mosConfig_lang .'.php' );

$usrname 	= $database->getEscaped( mosGetParam( $_REQUEST, 'usrname', '' ) );
$pass 		= $database->getEscaped( mosGetParam( $_REQUEST, 'pass', '' ) );

if (!$usrname) {
	echo 'Please enter a username';
	exit;
}

if (!$pass) {
	echo 'Please enter a password';
	exit;
} else {
	$pass = md5( $pass );
}


$query = "SELECT COUNT(*)"
. "\n FROM #__users"
. "\n WHERE ("
// Administrators
. "\n gid = 24"
// Super Administrators
. "\n OR gid = 25"
. "\n )"
;
$database->setQuery( $query );
$count = intval( $database->loadResult() );
if ($count < 1) {
	echo _LOGIN_NOADMINS;
	exit;
}

$my = null;
$query = "SELECT *"
. "\n FROM #__users"
. "\n WHERE username = '$usrname'"
. "\n AND block = 0"
;
$database->setQuery( $query );
$database->loadObject( $my );

/** find the user group (or groups in the future) */
if (@$my->id) {
	$grp 			= $acl->getAroGroup( $my->id );
	$my->gid 		= $grp->group_id;
	$my->usertype 	= $grp->name;

	if ( strcmp( $my->password, $pass ) || !$acl->acl_check( 'administration', 'login', 'users', $my->usertype ) ) {
		echo "Incorrect Username, Password, or Access Level.";
		exit;
	}
} else {
	echo "Incorrect Username, Password.  Please try again";
	exit;
}

// If we are here, then authentication was successfull
$action = mosGetParam($_REQUEST, 'action', '');
require_once( $mosConfig_absolute_path. "/administrator/components/com_virtuemart/virtuemart.cfg.php" );
require_once(CLASSPATH."ps_database.php");

// Instantiate the DB class
$db = new ps_DB();

$default_vendor = 1;

if( $my->id ) {
	$db->query( 'SELECT `vendor_id` FROM `#__{vm}_auth_user_vendor` WHERE `user_id` ='.$my->id );
	$db->next_record();
	if( $db->f( 'vendor_id' ) ) {
		$default_vendor = $db->f( 'vendor_id' );
	}
}
$ps_vendor_id = $default_vendor;

switch ($action) {

	case 'order_export':
	$order_export_id = $database->getEscaped( mosGetParam( $_REQUEST, 'method', '' ) );
	if (!empty($order_export_id)) {
		$q = "SELECT * FROM #__{vm}_order_export WHERE vendor_id='$ps_vendor_id' AND ";
		$q .= "order_export_id='$order_export_id'";
		$db->query($q);
		$db->next_record();
	} else {
		echo 'Export Method not defined. Please define method.';
		exit;
	}

	if($db->f('export_enabled') != 'Y') {
		echo 'Export Method Inactive. Please activate Export Module in Admin.';
		exit;
	}
	$export_class = $db->f('order_export_class');

	$order_status = mosGetParam( $_REQUEST, 'status', '' );
	$order_from = mosGetParam( $_REQUEST, 'from', '' );
	$order_since = mosGetParam( $_REQUEST, 'since', '' );
	$order_since = mosGetParam( $_REQUEST, 'since', '' );
	$order_to = mosGetParam( $_REQUEST, 'to', '' );
	$order_id = mosGetParam( $_REQUEST, 'order_id', '' );

	$where = array();
	if (!$order_status && !$order_from && !$order_since && !$order_to && !$order_id){
		$order_status = 'P';
	}
	if ($order_status) {
		$where[] = "order_status = '" . $db->getEscaped( $order_status ) . "'";
	}
	if($order_from) {
		$where[] = "order_id >= '" . $db->getEscaped($order_from) . "'";
	} elseif ($order_since) {
		$where[] = "order_id > '" . $db->getEscaped($order_since) . "'";
	} elseif ($order_id) {
		$where[] = "order_id = '" . $db->getEscaped($order_id) . "'";
	}

	if($order_to && !$order_id) {
		$where[] = "order_id <= '" . $db->getEscaped($order_to) . "'";
	}

	//select the orders to export
	$q = "SELECT * FROM #__{vm}_orders WHERE vendor_id='$ps_vendor_id' AND ";
	$q .= implode($where);
	$db->setQuery($q);
	$orders = $db->loadAssocList();

	for($i=0; $i < count($orders); $i++ ) {
		//get billing and shipping address
		$q = "SELECT * FROM #__{vm}_order_user_info WHERE order_id='". $orders[$i]['order_id'] ."'";
		$db->setQuery($q);
		$orders[$i]['user_info'] = $db->loadAssocList();
		//get shipping address
		$q = "SELECT * FROM #__{vm}_order_item WHERE order_id='". $orders[$i]['order_id'] ."'";
		$db->setQuery($q);
		$orders[$i]['item'] = $db->loadAssocList();
		//get payment info
		$q = "SELECT * FROM #__{vm}_order_payment WHERE order_id='". $orders[$i]['order_id'] ."'";
		$db->setQuery($q);
		$orders[$i]['payment'] = $db->loadAssocList();
	}
	
	//if there is no export class then only process order export config from database

	if(file_exists(CLASSPATH."export/$export_class.php") && file_exists(CLASSPATH."export/$export_class.cfg.php")) {
		require_once(CLASSPATH."export/$export_class.php");
		require_once(CLASSPATH."export/$export_class.cfg.php");
		eval( "\$_EXPORT = new $export_class();" );
		$_EXPORT->process_export($orders, $db);
		eval($db->f('order_export_config'));
		$_EXPORT->output_export($orders, $db);
	} else {
		eval($db->f('order_export_config'));
	}
	break;

	//change the status of orders
	case 'status_change':

	break;
}
?>