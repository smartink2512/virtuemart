<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
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

require_once( CLASSPATH . "pageNavigation.class.php" );
require_once( CLASSPATH . "htmlTools.class.php" );

if (!empty($keyword)) {
	$list  = "SELECT * FROM #__{vm}_shipping_carrier WHERE ";
	$count = "SELECT count(*) as num_rows FROM #__{vm}_shipping_carrier WHERE ";
	$q  = "(shipping_carrier_name LIKE '%$keyword%') ";
	$q .= "ORDER BY shipping_carrier_list_order ASC ";
	$list .= $q . " LIMIT $limitstart, " . $limit;
	$count .= $q;
}
else {
	$q = "";
	$list  = "SELECT * FROM #__{vm}_shipping_carrier ";
	$count = "SELECT count(*) as num_rows FROM #__{vm}_shipping_carrier";
	$list .= $q . " LIMIT $limitstart, " . $limit;
	$count .= $q;
}
$db->query($count);
$db->next_record();
$num_rows = $db->f("num_rows");
  
// Create the Page Navigation
$pageNav = new vmPageNav( $num_rows, $limitstart, $limit );

// Create the List Object with page navigation
$listObj = new listFactory( $pageNav );

// print out the search field and a list heading
$listObj->writeSearchHeader($VM_LANG->_('PHPSHOP_CARRIER_LIST_LBL'), IMAGEURL."ps_image/ups.gif", $modulename, "carrier_list");

// start the list table
$listObj->startTable();

// these are the columns in the table
$columns = Array(  "#" => "width=\"20\"", 
					"<input type=\"checkbox\" name=\"toggle\" value=\"\" onclick=\"checkAll(".$num_rows.")\" />" => "width=\"20\"",
					$VM_LANG->_('PHPSHOP_CARRIER_LIST_NAME_LBL') => '',
					$VM_LANG->_('PHPSHOP_CARRIER_LIST_ORDER_LBL') => '',
					$VM_LANG->_('E_REMOVE') => "width=\"5%\""
				);
$listObj->writeTableHeader( $columns );
  
$db->query($list);
$i = 0;
while ($db->next_record()) {

	$listObj->newRow();
	
	// The row number
	$listObj->addCell( $pageNav->rowNumber( $i ) );
	
	// The Checkbox
	$listObj->addCell( vmCommonHTML::idBox( $i, $db->f("shipping_carrier_id"), false, "shipping_carrier_id" ) );

    $url = $_SERVER['PHP_SELF'] . "?page=$modulename.carrier_form&limitstart=$limitstart&keyword=".urlencode($keyword)."&shipping_carrier_id=". $db->f("shipping_carrier_id");
    $tmp_cell = "<a href=\"" . $sess->url($url) . "\">". $db->f("shipping_carrier_name")."</a>";
	$listObj->addCell( $tmp_cell );
	
	$listObj->addCell( $db->f("shipping_carrier_list_order"));
	
	$listObj->addCell( $ps_html->deleteButton( "shipping_carrier_id", $db->f("shipping_carrier_id"), "carrierDelete", $keyword, $limitstart ) );

	$i++;

}
$listObj->writeTable();

$listObj->endTable();

$listObj->writeFooter( $keyword );

?>