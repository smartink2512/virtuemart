<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.country_state_list.php,v 1.2 2005/06/11 10:16:58 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) 2005 Soeren Eberhardt
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

$country_id = mosgetparam( $_REQUEST, 'country_id' );
if( empty($country_id)) 
	mosRedirect( $_SERVER['PHP_SELF']."?option=com_phpshop&page=admin.country_list", "A country ID could not be found");

$db->query( "SELECT country_name FROM #__pshop_country WHERE country_id='$country_id'");
$db->next_record();
$title = $PHPSHOP_LANG->_PHPSHOP_STATE_LIST_LBL." ".$db->f("country_name");

$q  = "SELECT SQL_CALC_FOUND_ROWS * FROM #__pshop_state ";
 
if (!empty($keyword)) {
 $q .= "WHERE( state_name LIKE '%$keyword%' OR ";
 $q .= "state_2_code LIKE '%$keyword%' OR ";
 $q .= "state_3_code LIKE '%$keyword%' ";
 $q .= ") ";
}
$q .= "WHERE country_id='$country_id' ";
$q .= "ORDER BY state_name ";
$q .= " LIMIT $limitstart, " . $limit;

$db->query($q);

$database->setQuery("SELECT FOUND_ROWS() as num_rows");
$num_rows = $database->loadResult();
  
// Create the Page Navigation
$pageNav = new vmPageNav( $num_rows, $limitstart, $limit );

// Create the List Object with page navigation
$listObj = new listFactory( $pageNav );

// print out the search field and a list heading
$listObj->writeSearchHeader( $title, IMAGEURL."ps_image/countries.gif", "admin", "country_state_list");

// start the list table
$listObj->startTable();


// these are the columns in the table
$columns = Array(  "#" => "", 
					"<input type=\"checkbox\" name=\"toggle\" value=\"\" onclick=\"checkAll(".$num_rows.")\" />" => "",
					$PHPSHOP_LANG->_PHPSHOP_STATE_LIST_NAME => "",
					$PHPSHOP_LANG->_PHPSHOP_STATE_LIST_3_CODE => "",
					$PHPSHOP_LANG->_PHPSHOP_STATE_LIST_2_CODE => "",
					_E_REMOVE => "width=\"5%\""
				);
$listObj->writeTableHeader( $columns );

  
$i = 0;
while ($db->next_record()) {
  
	$listObj->newRow();
	
	// The row number
	$listObj->addCell( $pageNav->rowNumber( $i ) );
	
	// The Checkbox
	$listObj->addCell( mosHTML::idBox( $i, $db->f("state_id"), false, "state_id" ) );
	
	$tmp_cell = "<a href=\"". $sess->url($_SERVER['PHP_SELF'] ."?page=admin.country_state_form&limitstart=$limitstart&keyword=$keyword&state_id=".$db->f("state_id")."&country_id=".$country_id) ."\">";
    $tmp_cell .=  $db->f("state_name") ."</a>";
	$listObj->addCell( $tmp_cell );
	
	$listObj->addCell( $db->f("state_3_code") );
	
	$listObj->addCell( $db->f("state_2_code") );
    
    $listObj->addCell( $ps_html->deleteButton( "state_id", $db->f("state_id"), "stateDelete", $keyword, $limitstart ) );
		
	$i++;
}

$listObj->writeTable();

$listObj->endTable();

$listObj->writeFooter( $keyword, "&country_id=$country_id" );

?>