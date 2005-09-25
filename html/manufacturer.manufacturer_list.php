<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: manufacturer.manufacturer_list.php,v 1.4 2005/01/27 19:34:02 soeren_nb Exp $
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

$mf_category_id = mosgetparam( $_REQUEST, 'mf_category_id');

if (!empty($keyword)) {
	$list  = "SELECT * FROM #__pshop_manufacturer WHERE ";
	$count = "SELECT count(*) as num_rows FROM #__pshop_manufacturer WHERE ";
	$q  = "(mf_name LIKE '%$keyword%' OR ";
	$q .= "mf_desc LIKE '%$keyword%'";
	$q .= ") ";
	$q .= "ORDER BY mf_name ASC ";
	$list .= $q . " LIMIT $limitstart, " . $limit;
	$count .= $q;   
}
elseif (!empty($mf_category_id)) {
	$q = "";
	$list="SELECT * FROM #__pshop_manufacturer, #__pshop_manufacturer_category WHERE ";
	$count="SELECT count(*) as num_rows FROM #__pshop_manufacturer,#__pshop_manufacturer_category WHERE "; 
	$q = "#__pshop_manufacturer.mf_category_id=#__pshop_manufacturer_category.mf_category_id ";
	$q .= "ORDER BY #__pshop_manufacturer.mf_name ASC ";
	$list .= $q . " LIMIT $limitstart, " . $limit;
	$count .= $q;   
}
else {
	$q = "";
	$list  = "SELECT * FROM #__pshop_manufacturer ";
	$count = "SELECT count(*) as num_rows FROM #__pshop_manufacturer ";
	$q .= "ORDER BY mf_name ASC ";
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
$listObj->writeSearchHeader($PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_LIST_LBL, IMAGEURL."ps_image/manufacturer.gif", $modulename, "manufacturer_list");

// start the list table
$listObj->startTable();

// these are the columns in the table
$columns = Array(  "#" => "width=\"20\"", 
					"<input type=\"checkbox\" name=\"toggle\" value=\"\" onclick=\"checkAll(".$num_rows.")\" />" => "width=\"20\"",
					$PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_LIST_MANUFACTURER_NAME => 'width="45%"',
					$PHPSHOP_LANG->_PHPSHOP_MANUFACTURER_LIST_ADMIN => 'width="45%"',
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
	$listObj->addCell( mosHTML::idBox( $i, $db->f("manufacturer_id"), false, "manufacturer_id" ) );
	
	$url = $_SERVER['PHP_SELF'] . "?page=$modulename.manufacturer_form&limitstart=$limitstart&keyword=$keyword&manufacturer_id=";
	$url .= $db->f("manufacturer_id");
	$tmp_cell = "<a href=\"" . $sess->url($url) . "\">". $db->f("mf_name"). "</a><br />";
	$listObj->addCell( $tmp_cell );
	
    $tmp_cell = "<a href=\"". $sess->url($_SERVER['PHP_SELF']."?page=$modulename.manufacturer_form&manufacturer_id=" . $db->f("manufacturer_id")) ."\">".$PHPSHOP_LANG->_PHPSHOP_UPDATE ."</a>";
    $listObj->addCell( $tmp_cell );
	
	$listObj->addCell( $ps_html->deleteButton( "manufacturer_id", $db->f("manufacturer_id"), "manufacturerDelete", $keyword, $limitstart ) );

	$i++;

}
$listObj->writeTable();

$listObj->endTable();

$listObj->writeFooter( $keyword );

?>