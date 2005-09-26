<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.function_list.php,v 1.2 2005/09/25 18:49:29 soeren_nb Exp $
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

// Get module ID
$module_id = mosgetparam( $_REQUEST, 'module_id', 0 );

$q = "SELECT module_name FROM #__pshop_module WHERE module_id='$module_id'";
$db->query($q);
$db->next_record();
$title = $PHPSHOP_LANG->_PHPSHOP_FUNCTION_LIST_LBL . ": " . $db->f("module_name");
if (!empty( $keyword )) {
	$list  = "SELECT * FROM #__pshop_function WHERE ";
	$count = "SELECT count(*) as num_rows FROM #__pshop_function WHERE ";
	$q  = "(function_name LIKE '%$keyword%' OR ";
	$q .= "function_perms LIKE '%$keyword%' ";
	$q .= ") ";
	$q .= "AND module_id='$module_id' ";
	$q .= "ORDER BY function_name ";
	$list .= $q . " LIMIT $limitstart, " . $limit;
	$count .= $q;   
}
else {
	$list  = "SELECT * FROM #__pshop_function WHERE module_id='$module_id' ";
	$list .= "ORDER BY function_name ";
	$list .= "LIMIT $limitstart, " . $limit;
	$count = "SELECT count(*) as num_rows FROM #__pshop_function ";
	$count .= "WHERE module_id='$module_id' ";
}
$db->query($count);
$db->next_record();
$num_rows = $db->f("num_rows");

// Create the Page Navigation
$pageNav = new vmPageNav( $num_rows, $limitstart, $limit );

// Create the List Object with page navigation
$listObj = new listFactory( $pageNav );

// print out the search field and a list heading
$listObj->writeSearchHeader( $title, IMAGEURL."ps_image/functions.gif", "admin", "function_list");

// start the list table
$listObj->startTable();

// these are the columns in the table
$columns = Array(  "#" => "width=\"20\"", 
					"<input type=\"checkbox\" name=\"toggle\" value=\"\" onclick=\"checkAll(".$num_rows.")\" />" => "width=\"20\"",
					$PHPSHOP_LANG->_PHPSHOP_FUNCTION_LIST_NAME => "",
					$PHPSHOP_LANG->_PHPSHOP_FUNCTION_LIST_CLASS => "",
					$PHPSHOP_LANG->_PHPSHOP_FUNCTION_LIST_METHOD => "",
					$PHPSHOP_LANG->_PHPSHOP_FUNCTION_LIST_PERMS => "",
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
	$listObj->addCell( mosHTML::idBox( $i, $db->f("function_id"), false, "function_id" ) );

	$tmp_cell = "<a href=\"". $sess->url( $_SERVER['PHP_SELF']. "?page=admin.function_form&limitstart=$limitstart&keyword=$keyword&module_id=$module_id&function_id=" . $db->f("function_id")) ."\">";
    $tmp_cell .= $db->f("function_name"). "</a>";
	$listObj->addCell( $tmp_cell );
	
	$listObj->addCell( $db->f("function_class") );
	$listObj->addCell( $db->f("function_method") );
	$listObj->addCell( $db->f("function_perms") );

	$listObj->addCell( $ps_html->deleteButton( "function_id", $db->f("function_id"), "functionDelete", $keyword, $limitstart, "&module_id=$module_id" ) );

	$i++;

}
$listObj->writeTable();

$listObj->endTable();

$listObj->writeFooter( $keyword, "&module_id=$module_id" );

?>