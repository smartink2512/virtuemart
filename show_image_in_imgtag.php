<?php
/**
* Image Resizer & img Tag "Filler"
*
* @version $Id: show_image_in_imgtag.php,v 1.6 2005/02/22 18:56:26 soeren_nb Exp $
* @package mambo-phpShop

* @copyright Andreas Martens <heyn@plautdietsch.de>
* @copyright Patrick Teague <webdude@veslach.com>
* @copyright Soeren Eberhardt <soeren@mambo-phpshop.net>
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
include_once("../../configuration.php");
include_once("../../administrator/components/com_phpshop/phpshop.cfg.php");

//	Image2Thumbnail - Klasse einbinden 
include( CLASSPATH . "class.img2thumb.php");

$filename = @basename(urldecode($_REQUEST['filename']));
$filename = IMAGEPATH."product/".$filename;
$newxsize = @$_REQUEST['newxsize'];
$newysize = @$_REQUEST['newysize'];
$maxsize = false;
$bgred = 255;
$bggreen = 255;
$bgblue = 255;

/*
if( !isset($fileout) )
	$fileout="";
if( !isset($maxsize) )
	$maxsize=0;
*/

/* Minimum security */
file_exists( $filename ) or exit();

$fileinfo = pathinfo( $filename );
$file = str_replace(".".$fileinfo['extension'], "", $fileinfo['basename']);
// In class.img2thumb in the function NewImgShow() the extension .jpg will be added to .gif if imagegif does not exist.

// If the image is a gif, and imagegif() returns false then make the extension ".gif.jpg"

if( $fileinfo['extension'] == "gif") {
  if( function_exists("imagegif") ) {
    $ext = ".".$fileinfo['extension'];
    $noimgif="";
  }
  else {
    $ext = ".jpg";
    $noimgif = ".".$fileinfo['extension'];
  }
} 
else {
  $ext =  ".".$fileinfo['extension'];
  $noimgif="";
}

$fileout = IMAGEPATH."/product/resized/".$file."_".PSHOP_IMG_WIDTH."x".PSHOP_IMG_HEIGHT.$noimgif.$ext;

if( file_exists( $fileout ) ) {
  /* We already have a resized image
  * So send the file to the browser */
  switch($ext)
		{
			case ".gif":
				header ("Content-type: image/gif");
				readfile($fileout);
				break;
			case ".jpg":
				header ("Content-type: image/jpeg");
				readfile($fileout);
				break;
			case ".png":
				header ("Content-type: image/png");
				readfile($fileout);
				break;
		}
}
else {
  /* We need to resize the image and Save the new one (all done in the constructor) */
  $neu = new Img2Thumb($filename,$newxsize,$newysize,$fileout,$maxsize,$bgred,$bggreen,$bgblue);
  
  /* Send the file to the browser */
  switch($ext)
		{
			case ".gif":
				header ("Content-type: image/gif");
				readfile($fileout);
				break;
			case ".jpg":
				header ("Content-type: image/jpeg");
				readfile($fileout);
				break;
			case ".png":
				header ("Content-type: image/png");
				readfile($fileout);
				break;
		}
}
?>
