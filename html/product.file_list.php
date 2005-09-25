<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.file_list.php,v 1.4 2005/01/27 19:34:03 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software. www.mambo-phpshop.net
* mambo-phpShop comes with absolute no warranty.
*
* List all files of a specific product
* @author Soeren Eberhardt
* @param int product_id
*
*/
mm_showMyFileName( __FILE__ );

require_once( CLASSPATH . "pageNavigation.class.php" );
require_once( CLASSPATH . "htmlTools.class.php" );

$product_id = mosGetParam($_REQUEST, 'product_id' );
$task = mosGetParam($_REQUEST, 'task' );

$q  = "SELECT product_name FROM #__pshop_product WHERE product_id = '$product_id'";
$db->query($q);
$db->next_record();
$product_name = $db->f("product_name");

$q = "SELECT file_id, file_is_image, file_product_id, file_extension, file_url, file_published, file_name, file_title FROM #__pshop_product_files  ";
$q .= "WHERE file_product_id = '$product_id' ";
$q .= "ORDER BY file_is_image ";
$db->query($q);
$db->next_record();
if( $db->num_rows() < 1 && $task != "cancel" ) {
  mosRedirect( $_SERVER['PHP_SELF']."?option=com_phpshop&page=product.file_form&product_id=$product_id" );
}
else
	$num_rows = $db->num_rows();
	
// Create the Page Navigation
$pageNav = new vmPageNav( $num_rows, $limitstart, $limit );

// Create the List Object with page navigation
$listObj = new listFactory( $pageNav );

// print out the search field and a list heading
$listObj->writeSearchHeader($PHPSHOP_LANG->_PHPSHOP_FILES_LIST ." " . $product_name, $mosConfig_live_site."/administrator/images/mediamanager.png", $modulename, "file_list");

// start the list table
$listObj->startTable();

// these are the columns in the table
$columns = Array(  "#" => 'width="20"', 
					"<input type=\"checkbox\" name=\"toggle\" value=\"\" onclick=\"checkAll($num_rows)\" />" => 'width="20"',
					$PHPSHOP_LANG->_PHPSHOP_FILES_LIST_FILENAME => '',
					$PHPSHOP_LANG->_PHPSHOP_VIEW => '',
					$PHPSHOP_LANG->_PHPSHOP_FILES_LIST_FILETITLE => '',
					$PHPSHOP_LANG->_PHPSHOP_UPDATE => '',
					$PHPSHOP_LANG->_PHPSHOP_FILES_LIST_FILETYPE => '',
					$PHPSHOP_LANG->_PHPSHOP_FILEMANAGER_PUBLISHED => '',
					_E_REMOVE => "width=\"5%\""
				);
$listObj->writeTableHeader( $columns );

// Reset Result pointer
$db->called=false;

$i = 0;
while ($db->next_record()) {
	
	$listObj->newRow();
	
	// The row number
	$listObj->addCell( $pageNav->rowNumber( $i ) );
	
	// The Checkbox
	$listObj->addCell( mosHTML::idBox( $i, $db->f("file_id"), false, "file_id" ) );
	
	if($db->f("file_name")) 
		$tmp_cell = basename($db->f("file_name"));
	else
		$tmp_cell = basename($db->f("file_url"));
	$listObj->addCell( $tmp_cell );	
	
	$tmp_cell = "";
	if( $db->f("file_is_image")) {
		$fullimg = $db->f("file_name");
		$info = pathinfo( $fullimg );
		$thumb = $info["dirname"] ."/resized/". basename($db->f("file_name"),".".$info["extension"])."_".PSHOP_IMG_WIDTH."x".PSHOP_IMG_HEIGHT.".".$info["extension"];
		$thumburl = str_replace( $mosConfig_absolute_path, $mosConfig_live_site, $thumb );
		if( is_file( $fullimg ) ) {
			$tmp_cell = $PHPSHOP_LANG->_PHPSHOP_FILES_LIST_FULL_IMG.":";
			$tmp_cell .= mm_ToolTip( "&nbsp;<img src=\"".$db->f("file_url") . "\" alt=\"Full Image\" />", $PHPSHOP_LANG->_PHPSHOP_FILES_LIST_FULL_IMG, "[ ".$PHPSHOP_LANG->_PHPSHOP_VIEW . " ]<br/>" ); 
		}
		if( is_file( $thumb ) ) {
			$tmp_cell .= $PHPSHOP_LANG->_PHPSHOP_FILES_LIST_THUMBNAIL_IMG.":";
			$tmp_cell .= mm_ToolTip( "&nbsp;<img src=\"$thumburl\" alt=\"thumbnail\" />", $PHPSHOP_LANG->_PHPSHOP_FILES_LIST_THUMBNAIL_IMG, "[ ".$PHPSHOP_LANG->_PHPSHOP_VIEW . " ]" ); 
		}
		if( !$db->f("file_name") ) {
			$tmp_cell = "&nbsp;<a target=\"_blank\" href=\"".$db->f("file_url"). "\">[ ".$PHPSHOP_LANG->_PHPSHOP_VIEW . " ]</a><br/>"; 
		}
	}
	$listObj->addCell( $tmp_cell );
	
	$listObj->addCell( $db->f("file_title"));
	   
	$tmp_cell = "<a href=\"". $_SERVER['PHP_SELF']."?option=com_phpshop&page=product.file_form&product_id=$product_id&file_id=".$db->f("file_id") ."\">". $PHPSHOP_LANG->_PHPSHOP_FILES_LIST_EDITFILE ."</a>&nbsp;";
    $listObj->addCell( $tmp_cell );	  
	


	$listObj->addCell( $db->f("file_extension") );


	if ($db->f("file_published")=="0") { 
		$tmp_cell = '<img src="'. $mosConfig_live_site .'/administrator/images/publish_x.png" border="0" alt="Publish" />';
	} 
	else { 
		$tmp_cell = '<img src="'. $mosConfig_live_site .'/administrator/images/tick.png" border="0" alt="Unpublish" />';
	} 
	$listObj->addCell( $tmp_cell );

	$listObj->addCell( $ps_html->deleteButton( "file_id", $db->f("file_id"), "deleteProductFile", $keyword, $limitstart, "&product_id=$product_id" ) );

	$i++;

}
$listObj->writeTable();

$listObj->endTable();

$listObj->writeFooter( $keyword,"&product_id=$product_id" );

?>