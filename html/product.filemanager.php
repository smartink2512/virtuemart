<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.filemanager.php,v 1.3 2005/01/27 19:34:03 soeren_nb Exp $
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

$product_id = mosGetParam($_REQUEST, 'product_id' );

if (!empty($keyword)) {
	$list  = "SELECT product_id, product_name, product_sku, product_publish,product_parent_id FROM #__pshop_product WHERE ";
	$count = "SELECT count(*) as num_rows FROM #__pshop_product WHERE ";
	//$q  = "product.vendor_id = '$ps_vendor_id' ";
	$q = "(#__pshop_product.product_name LIKE '%$keyword%' OR ";
	$q .= "#__pshop_product.product_sku LIKE '%$keyword%' OR ";
	$q .= "#__pshop_product.product_s_desc LIKE '%$keyword%' OR ";
	$q .= "#__pshop_product.product_desc LIKE '%$keyword%'";
	$q .= ") ";
	$q .= "ORDER BY product_name ";
	$list .= $q . " LIMIT $limitstart, " . $limit;
	$count .= $q;
}
else {
	$list  = "SELECT product_id, product_name, product_sku, product_publish,product_parent_id FROM #__pshop_product ";
	$count = "SELECT count(*) as num_rows FROM #__pshop_product ";
	//$q  = "WHERE product.vendor_id = '$ps_vendor_id' ";
	$q = "ORDER BY product_name ";
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
$listObj->writeSearchHeader($PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_LIST, IMAGEURL."ps_image/mediamanager.png", $modulename, "filemanager");

// start the list table
$listObj->startTable();

// these are the columns in the table
$columns = Array(  "#" => "width=\"20\"", 
					$PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_NAME => '',
					$PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SKU => '',
					$PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_ADD => '',
					$PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_IMAGES => '',
					$PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_DOWNLOADABLE => '',
					$PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_FILES => '',
					$PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_PUBLISHED => ''
				);
$listObj->writeTableHeader( $columns );
	
$db->query($list);
$i = 0;
$dbp = new ps_DB;
while ($db->next_record()) {
	
	$listObj->newRow();
	
	$tmp_cell = "";
	
	// The row number
	$listObj->addCell( $pageNav->rowNumber( $i ) );
      
	// Is the product downloadable?
	$database->setQuery( "SELECT attribute_name FROM #__pshop_product_attribute WHERE product_id='" . $db->f("product_id") . "' AND attribute_name='download'" );
	$database->loadObject( $downloadable );
      
	// What Images does the product have ?
	$database->setQuery( "SELECT count(file_id) as images FROM #__pshop_product_files WHERE file_product_id='" . $db->f("product_id") . "' AND file_is_image='1' " );
	$database->loadObject($images);
      
	// What Files does the product have ?
	$database->setQuery( "SELECT count(file_id) as files FROM #__pshop_product_files WHERE file_product_id='" . $db->f("product_id") . "' AND file_is_image='0' " );
	$database->loadObject($files);
	
	if( $db->f("product_parent_id")) 
		$tmp_cell = "&nbsp;&nbsp;&nbsp;&nbsp;";
	$tmp_cell .= $db->f("product_name");
	$listObj->addCell( $tmp_cell );
	
	$listObj->addCell( $db->f("product_sku") );
	
	$url = $_SERVER['PHP_SELF']."?page=$modulename.file_list&product_id=" . $db->f("product_id");
	$tmp_cell = "&nbsp;&nbsp;<a href=\"" . $sess->url($url) . "\">[ ".$PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_ADD." ]</a>";
	$listObj->addCell( $tmp_cell );
	
	$tmp_cell = empty($images->images) ? "0" : $images->images; 
	$listObj->addCell( $tmp_cell );
	
	if (empty($downloadable)) {
		$tmp_cell = '<img src="'. $mosConfig_live_site .'/administrator/images/publish_x.png" border="0" alt="Publish" />';
	} 
	else { 
		$tmp_cell = '<img src="'. $mosConfig_live_site .'/administrator/images/tick.png" border="0" alt="Unpublish" />';
	}
	$listObj->addCell( $tmp_cell );
	
	unset( $downloadable );
    
	$listObj->addCell( $files->files );
	
	if ($db->f("product_publish")=="N") { 
		$tmp_cell = '<img src="'. $mosConfig_live_site .'/administrator/images/publish_x.png" border="0" alt="Publish" />';
	} 
	else { 
		$tmp_cell = '<img src="'. $mosConfig_live_site .'/administrator/images/tick.png" border="0" alt="Unpublish" />';
	}
	$listObj->addCell( $tmp_cell );
	
	$i++;
}

$listObj->writeTable();

$listObj->endTable();

$listObj->writeFooter( $keyword, "&task=list" );
  
?>