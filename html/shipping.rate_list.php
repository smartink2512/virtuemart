<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shipping.rate_list.php,v 1.5 2005/01/27 19:34:03 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* Contains code from PHPEuroShop
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );

require_once( CLASSPATH . "pageNavigation.class.php" );
require_once( CLASSPATH . "htmlTools.class.php" );

if (!empty($keyword)) {
	$list  = "SELECT * FROM #__pshop_shipping_rate WHERE ";
	$count = "SELECT count(*) as num_rows FROM #__pshop_shipping_rate WHERE ";
	$q  = "(shipping_rate_name LIKE '%$keyword%') ";
	$q .= "ORDER BY shipping_rate_carrier_id ASC ";
	$list .= $q . " LIMIT $limitstart, " . $limit;
	$count .= $q;
}
else {
	$q = "";
	$list  = "SELECT * FROM #__pshop_shipping_rate ";
	$count = "SELECT count(*) as num_rows FROM #__pshop_shipping_rate";
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
$listObj->writeSearchHeader($PHPSHOP_LANG->_PHPSHOP_RATE_LIST_LBL, IMAGEURL."ps_image/shipping.gif", $modulename, "rate_list");

// start the list table
$listObj->startTable();

// these are the columns in the table
$columns = Array(  "#" => "width=\"20\"", 
					"<input type=\"checkbox\" name=\"toggle\" value=\"\" onclick=\"checkAll(".$num_rows.")\" />" => "width=\"20\"",
					$PHPSHOP_LANG->_PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL => '',
					$PHPSHOP_LANG->_PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME => '',
					$PHPSHOP_LANG->_PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART => '',
					$PHPSHOP_LANG->_PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND => '',
					_E_REMOVE => "width=\"5%\""
				);
$listObj->writeTableHeader( $columns );

$db->query($list);
$i = 0;
while ($db->next_record()) {
	$listObj->newRow();
	
	// The row number
	$listObj->addCell( $pageNav->rowNumber( $i ) );
	
	// The Checkbox
	$listObj->addCell( mosHTML::idBox( $i, $db->f("shipping_rate_id"), false, "shipping_rate_id" ) );
	
	$cdb = new ps_DB;
	$cq = "SELECT shipping_carrier_name FROM #__pshop_shipping_carrier WHERE ";
	$cq .= "shipping_carrier_id = '" . $db->f("shipping_rate_carrier_id") . "'";
	$cdb->query($cq);
	$cdb->next_record();
	$listObj->addCell( $cdb->f("shipping_carrier_name"));
   
	$url = $_SERVER['PHP_SELF'] . "?page=$modulename.rate_form&limitstart=$limitstart&keyword=$keyword&shipping_rate_id=". $db->f("shipping_rate_id");
	$tmp_cell = "<a href=\"" . $sess->url($url) . "\">". $db->f("shipping_rate_name")."</a>";
	$listObj->addCell( $tmp_cell );
    
	$listObj->addCell( $db->f("shipping_rate_weight_start"));
    
	$listObj->addCell( $db->f("shipping_rate_weight_end"));
	
	$listObj->addCell( $ps_html->deleteButton( "shipping_rate_id", $db->f("shipping_rate_id"), "rateDelete", $keyword, $limitstart ) );

	$i++;
}
$listObj->writeTable();

$listObj->endTable();

$listObj->writeFooter( $keyword );

?>