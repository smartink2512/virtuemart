<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: coupon.coupon_list.php,v 1.3 2005/01/27 19:34:02 soeren_nb Exp $
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
  
	$list  = "SELECT * FROM #__pshop_coupons WHERE ";
	$count = "SELECT count(*) as num_rows FROM #__pshop_coupons WHERE ";
	$q  = "(code LIKE '%$keyword%' OR ";
	$q .= "value LIKE '%$keyword%' ";
	$q .= ") ";
	$q .= "ORDER BY coupon_id ";
	$list .= $q . " LIMIT $limitstart, " . $limit;
	$count .= $q;   
}
else  {
	$list  = "SELECT * FROM #__pshop_coupons ";
	$list .= "ORDER BY coupon_id ";
	$list .= "LIMIT $limitstart, " . $limit;
	$count = "SELECT count(*) as num_rows FROM #__pshop_coupons ";
}
$db->query($count);
$db->next_record();
$num_rows = $db->f("num_rows");
  
// Create the Page Navigation
$pageNav = new vmPageNav( $num_rows, $limitstart, $limit );

// Create the List Object with page navigation
$listObj = new listFactory( $pageNav );

// print out the search field and a list heading
$listObj->writeSearchHeader($PHPSHOP_LANG->_PHPSHOP_COUPON_LIST, IMAGEURL."ps_image/percentage.png", $modulename, "coupon_list");

// start the list table
$listObj->startTable();

// these are the columns in the table
$columns = Array(  "#" => "width=\"20\"", 
					"<input type=\"checkbox\" name=\"toggle\" value=\"\" onclick=\"checkAll(".$num_rows.")\" />" => "width=\"20\"",
					$PHPSHOP_LANG->_PHPSHOP_COUPON_CODE_HEADER => '',
					$PHPSHOP_LANG->_PHPSHOP_COUPON_PERCENT_TOTAL => '',
					$PHPSHOP_LANG->_PHPSHOP_COUPON_TYPE => '',
					$PHPSHOP_LANG->_PHPSHOP_COUPON_VALUE_HEADER => '',
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
	$listObj->addCell( mosHTML::idBox( $i, $db->f("coupon_id"), false, "coupon_id" ) );
    
	$tmp_cell = "<a href=\"". $sess->url($_SERVER['PHP_SELF']."?page=coupon.coupon_form&limitstart=$limitstart&keyword=$keyword&coupon_id=" . $db->f("coupon_id")) ."\">".$db->f("coupon_code")."</a>";
	$listObj->addCell( $tmp_cell );
    
	$tmp_cell = $db->f("percent_or_total")=='total' ? $PHPSHOP_LANG->_PHPSHOP_COUPON_TOTAL : $PHPSHOP_LANG->_PHPSHOP_COUPON_PERCENT;
	$listObj->addCell( $tmp_cell );
	
    $tmp_cell = $db->f("coupon_type")=='gift' ? $PHPSHOP_LANG->_PHPSHOP_COUPON_TYPE_GIFT : $PHPSHOP_LANG->_PHPSHOP_COUPON_TYPE_PERMANENT;
	$listObj->addCell( $tmp_cell );
	
    $listObj->addCell( $db->f("coupon_value"));
	
	$listObj->addCell( $ps_html->deleteButton( "coupon_id", $db->f("coupon_id"), "couponDelete", $keyword, $limitstart ) );

	$i++;

}

$listObj->writeTable();

$listObj->endTable();

$listObj->writeFooter( $keyword );
?>