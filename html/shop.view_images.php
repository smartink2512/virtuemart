<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shop.view_images.php,v 1.6 2005/06/11 10:16:58 soeren_nb Exp $
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

$flypage = mosGetParam($_REQUEST, "flypage", FLYPAGE);
$product_id = intval(mosgetparam($_REQUEST, "product_id"));
$page = mosgetparam($_REQUEST, "page", null);
$image_id = intval(mosgetparam($_REQUEST, "image_id", "product"));
$Itemid = intval(mosgetparam($_REQUEST, "Itemid"));

if( !empty($product_id) ) {

  require_once( CLASSPATH . "ps_product.php" );
  $ps_product =& new ps_product();
  
// Get the default full and thumb image
  $db->query( "SELECT product_name,product_full_image,product_thumb_image FROM #__pshop_product WHERE product_id='$product_id'" );
  $db->next_record();
  echo "<h3>".$PHPSHOP_LANG->_PHPSHOP_AVAILABLE_IMAGES." ".$db->f("product_name")."</h3>\n";
  echo "<a href=\"".$_SERVER['PHP_SELF']."?option=com_phpshop&page=shop.product_details&flypage=$flypage&product_id=$product_id&Itemid=$Itemid\">"
      . $PHPSHOP_LANG->_PHPSHOP_BACK_TO_DETAILS."</a>\n<br/><br/><br/>";
  
  $alt = $db->f("product_name");
  $height = PSHOP_IMG_WIDTH;
  $width = PSHOP_IMG_HEIGHT;
  $border = ($image_id == "product") ? "4" : "1";
  $href = $_SERVER['PHP_SELF']."?option=com_phpshop&page=$page&product_id=$product_id&image_id=product&Itemid=".$Itemid;
  $title = $db->f("product_name");
  echo "<a href=\"$href\" target=\"_self\" title=\"$title\">\n";
  $ps_product->show_image( $db->f("product_thumb_image"), "alt=\"$alt\" align=\"center\" border=\"$border\"");
  echo "</a>&nbsp;&nbsp;&nbsp;";

// Let's have a look wether the product has more images.
  $database->setQuery( "SELECT * FROM #__pshop_product_files WHERE file_product_id='$product_id' AND file_is_image='1'" );
  $images = $database->loadObjectList();
  $i = 0;
  foreach( $images as $image ) {
    $info = pathinfo( $image->file_name );
    
    $src = dirname($image->file_url) ."/resized/". basename($image->file_name, ".".$info["extension"])."_".PSHOP_IMG_WIDTH."x".PSHOP_IMG_HEIGHT.".".$info["extension"];
    $alt = $image->file_title;
    $height = empty($image->file_image_thumb_height) ? PSHOP_IMG_HEIGHT : $image->file_image_thumb_height; 
    $width = empty($image->file_image_thumb_width) ? PSHOP_IMG_WIDTH : $image->file_image_thumb_width; 
    
    $border = ($image->file_id == $image_id) ? "4" : "1";
    $href = $_SERVER['PHP_SELF']."?option=com_phpshop&page=$page&product_id=$product_id&image_id=".$image->file_id."&Itemid=".$Itemid;
    $title = $image->file_title;
    echo "<a href=\"$href\" target=\"_self\" title=\"$title\"><img src=\"$src\" alt=\"$alt\" align=\"center\" width=\"$width\" border=\"$border\" /></a>\n&nbsp;&nbsp;&nbsp;";
    // Break Row when needed
    //if( $i++ >= 4 ) { $i=0; echo "<br/><br/>"; }
  }
  echo "<br/><br/><hr/>\n";
  
  if( $image_id == "product" ) {
    echo "<div style=\"text-align:center;overflow:auto;\">";
    $ps_product->show_image($db->f("product_full_image"), "alt=\"$alt\" align=\"center\" border=\"0\"", 0);
    echo "</div>";
  }
  else {
    if( !empty($image_id) ) {
      // Get that image!
      $database->setQuery( "SELECT * FROM #__pshop_product_files WHERE file_product_id='$product_id' AND file_is_image='1' AND file_id='$image_id'" );
    }
    else {
      // Get the first image
      $database->setQuery( "SELECT * FROM #__pshop_product_files WHERE file_product_id='$product_id' AND file_is_image='1'" );
    }
    $database->loadObject( $show_img );
    if( $show_img ) {
      $src = str_replace( $mosConfig_absolute_path, $mosConfig_live_site, $show_img->file_name );
      if( strstr( $src, $mosConfig_live_site.$show_img->file_name))
        $src = str_replace( $mosConfig_live_site.$show_img->file_name, $mosConfig_live_site."/".$show_img->file_name, $src );
      $alt = $show_img->file_title;
      $height = $show_img->file_image_height; 
      $width = $show_img->file_image_width;
      echo "<div style=\"text-align:center;overflow:auto;\"><img src=\"$src\" alt=\"$alt\" width=\"$width\" height=\"$height\" border=\"0\" /></div>";
    }
    else {
      echo $PHPSHOP_LANG->_PHPSHOP_IMAGE_NOT_FOUND;
    }
  }
}
?>
