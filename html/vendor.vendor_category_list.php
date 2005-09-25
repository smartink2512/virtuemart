<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: vendor.vendor_category_list.php,v 1.5 2005/01/27 19:34:04 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) 2004-2005 Soeren Eberhardt
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
  $list  = "SELECT * FROM #__pshop_vendor_category WHERE ";
  $count = "SELECT count(*) as num_rows FROM #__pshop_vendor_category WHERE ";
  $q  = "(vendor_category_name LIKE '%$keyword%' OR ";
  $q .= "vendor_category_desc LIKE '%$keyword%'";
  $q .= ") ";
  $q .= "ORDER BY vendor_category_name ASC ";
  $list .= $q . " LIMIT $limitstart, " . $limit;
  $count .= $q;   
}
else {
  $q = "";
  $list  = "SELECT * FROM #__pshop_vendor_category ORDER BY vendor_category_name ASC ";
  $count = "SELECT count(*) as num_rows FROM #__pshop_vendor_category"; 
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
$listObj->writeSearchHeader($PHPSHOP_LANG->_PHPSHOP_VENDOR_CAT_LIST_LBL, "", $modulename, "vendor_category_list");

// start the list table
$listObj->startTable();

// these are the columns in the table
$columns = Array(  "#" => "width=\"20\"", 
					"<input type=\"checkbox\" name=\"toggle\" value=\"\" onclick=\"checkAll(".$num_rows.")\" />" => "width=\"20\"",
					$PHPSHOP_LANG->_PHPSHOP_VENDOR_CAT_NAME => 'width="21%"',
					$PHPSHOP_LANG->_PHPSHOP_VENDOR_CAT_DESCRIPTION => 'width="66%"',
					$PHPSHOP_LANG->_PHPSHOP_VENDOR_CAT_VENDORS => 'width="13%"',
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
	$listObj->addCell( mosHTML::idBox( $i, $db->f("vendor_category_id"), false, "vendor_category_id" ) );
    
	$url = $_SERVER['PHP_SELF']."?page=$modulename.vendor_category_form&limitstart=$limitstart&keyword=$keyword&vendor_category_id=". $db->f("vendor_category_id");
    $tmp_cell = "<a href=\"" . $sess->url($url) . "\">". $db->f("vendor_category_name")."</a>";
	$listObj->addCell( $tmp_cell );
	
    $listObj->addCell( $db->f("vendor_category_desc") );

	$url = $_SERVER['PHP_SELF']."?page=$modulename.vendor_list&vendor_category_id=". $db->f("vendor_category_id");
	$tmp_cell = "<a href=\"" . $sess->url($url) . "\">".$PHPSHOP_LANG->_PHPSHOP_LIST."</a>";
	$listObj->addCell( $tmp_cell );

	$listObj->addCell( $ps_html->deleteButton( "vendor_category_id", $db->f("vendor_category_id"), "vendorCategoryDelete", $keyword, $limitstart ) );

	$i++;
}
$listObj->writeTable();

$listObj->endTable();

$listObj->writeFooter( $keyword );
?>