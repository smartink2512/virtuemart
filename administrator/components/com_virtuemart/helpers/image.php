<?php
/**
 * Image helper class
 *
 * This class was derived from the show_image_in_imgtag.php and imageTools.class.php files in VM.  It provides some
 * image functions that are used throughout the VirtueMart shop.
 *
 * @package	VirtueMart
 * @subpackage Helpers
 * @author RickG
 * @copyright Copyright (c) 2004-2008 Soeren Eberhardt-Biermann, 2009 VirtueMart Team. All rights reserved.
 */
defined('_JEXEC') or die();

require_once(JPATH_COMPONENT_ADMINISTRATOR . DS . 'classes' . DS. "class.img2thumb.php");


/**
 * Image Helper class
 *
 * @package	VirtueMart
 * @subpackage Helpers
 * @author RickG
 */
class ImageHelper
{
	/**
	 * Display an image icon for the given image and create a link to the given link.
	 *
	 * @param string $link Link to use in the href tag
	 * @param string $image Name of the image file to display
	 * @param string $text Text to use for the image alt text and to display under the image.
	 */
	function displayImageButton($link, $image, $text) 
	{
		$button  = '<div style="float:left;width=100px;"><div class="icon">';
		$button .= '<a title="' . $text . '" href="' . $link . '">';
		$button .= JHTML::_('image.administrator',  $image, '/components/com_virtuemart/assets/images/icon_48/', NULL, NULL, $text);
		$button .= '<br />' . $text.'</a></div></div>';
		echo $button;
	}	
	
	
	/**
	 * Display a given image witin IMG tags.
	 *
	 * @param string $image Name of the image file to display
	 * @param string $text Text to use for the image alt text.
	 */
	function displayImage($image, $text) 
	{
		$imageHtml  = '<div style="float:left;"><div class="icon">';
		$imageHtml .= JHTML::_('image.administrator',  $image, '/components/com_virtuemart/assets/images/icon_48/', NULL, NULL, $text);
		$imageHtml .= '</div></div>';
		echo $imageHtml;
	}	
	
	
	/** 
	 * Display a given image in <img> tags
	 *
	 * @author RickG
	 * @param string $image Filename of the image.  No path.
	 * @param string $imgRootFolder Folder under the shop imgae location that contains this image.  For example, 'products'.	 
	 * @param string $imageArgs Attributes to be included in the <img> tag.
	 * @param integer $resize Should this image be auto resized.
	 * @param integer $thumbWidth Width the returned image should be.
	 * @param integer $thumbHeight Height the returned image should be. 
	 * @param boolean $overrideSize If true, $thumbWidth and $thumbHeight will overried image sizes set in the shop configuration.
	 */
	function displayShopImage($image, $imgRootFolder='', $imageArgs="", $resize=1, $thumbWidth=0, $thumbHeight=0, $overrideSize=false)
	{
		echo ImageHelper::genterateImageHtml($image, $imgRootFolder, $imageArgs, $resize, $thumbWidth, $thumbHeight, $overrideSize);		
	}
	
	/** Return the HTML <img> code for a given image.
	 *
	 * @author RickG
	 * @param string $image Filename of the image.  No path.
	 * @param string $imgRootFolder Folder under the shop imgae location that contains this image.  For example, 'products'.	 
	 * @param string $imageArgs Attributes to be included in the <img> tag.
	 * @param integer $resize Should this image be auto resized.
	 * @param integer $thumbWidth Width the returned image should be.
	 * @param integer $thumbHeight Height the returned image should be. 
	 * @param boolean $overrideSize If true, $thumbWidth and $thumbHeight will overried image sizes set in the shop configuration.
	 * @return string <img> tag containing the image as the src attribute.  Needs only to be echo'd.
	 */	
	function getShopImageHtml($image, $imgRootFolder='', $imageArgs="", $resize=1, $thumbWidth=0, $thumbHeight=0, $overrideSize=false)
	{
		return ImageHelper::genterateImageHtml($image, $imgRootFolder, $imageArgs, $resize, $thumbWidth, $thumbHeight, $overrideSize);		
	}
	
	/**
	 * Generate the <img> html code for a given image and a given image size.
	 *
	 * @author RickG
	 * @param string $image Filename of the image.  No path.
	 * @param string $imgRootFolder Folder under the shop imgae location that contains this image.  For example, 'products'.	 
	 * @param string $imageArgs Attributes to be included in the <img> tag.
	 * @param integer $resize Should this image be auto resized.
	 * @param integer $thumbWidth Width the returned image should be.
	 * @param integer $thumbHeight Height the returned image should be. 
	 * @param boolean $overrideSize If true, $thumbWidth and $thumbHeight will overried image sizes set in the shop configuration.
	 * @return string <img> tage containing the image as the src attribute.  Needs only to be echo'd.
	 */
	function genterateImageHtml($image, $imgRootFolder='', $imageArgs="", $resize=1, $thumbWidth=0, $thumbHeight=0, $overrideSize=false)
	{
		// Process image arguments
		$border="";
		if( strpos( $imageArgs, "border=" )===false ) {
			$border = 'border="0"';
		}
		$newImageHeight = $newImageWidth = '';
		
		if ($image != "") {
			// Remote image URL
			if( substr( $image, 0, 4) == "http" ) {
				$url = $image;
			}
			// Local image file
			else {
				if ($overrideSize) {
					$newImageWidth = $thumbWidth;
					$newImageHeight = $thumbHeight;
				}
				else {
					$newImageWidth = PSHOP_IMG_WIDTH;
					$newImageHeight = PSHOP_IMG_HEIGHT;
				}
				
				// Dynamic image resizing will happen
				if (PSHOP_IMG_RESIZE_ENABLE == '1' || $resize==1) {
					$url = ImageHelper::createResizedImage(urlencode($image), $imgRootFolder, $newImageWidth, $newImageHeight);
					if (!strpos($imageArgs, "height=")) {
						$arr = @getimagesize(ImageHelper::getresizedfilename($image, $imgRootFolder, '', $newImageWidth, $newImageHeight));
						$width = $arr[0]; 
						$height = $arr[1];
					}
				}			
				else {
					if ($imgRootFolder <> '') {
						$url = JURI::root().'components/com_virtuemart/shop_image/'.$imgRootFolder.'/'.$image;	
					}
					else {
						$url = JURI::root().'components/com_virtuemart/shop_image/'.$image;	
					}
					if ($resize) {
						if ($height < $width) {
							$newImageWidth = round($width / ($height / PSHOP_IMG_HEIGHT));
							$newImageHeight = PSHOP_IMG_HEIGHT;
						} 
						else {
							$newImageHeight = round($height / ($width / PSHOP_IMG_WIDTH));
							$newImageWidth = PSHOP_IMG_WIDTH;
						}
						$url = ImageHelper::createResizedImage(urlencode($image), $imgRootFolder, $newImageWidth, $newImageHeight);
					}
				}
			}
		}
		else {
			$url = VM_THEMEURL.'images/'.NO_IMAGE;
		}		

		return JHTML::image($url, '');
			
	}
	
	
	/**
	 * Create a resized image for a given image if one does not already exit.
	 *
	 * Resized images are currently held in the shop image directory in a resized folder found under the $imageRootFolder.
	 *
	 * @author RickG
	 * @param string $imageFilename Filename of the image.  No path included.
	 * @param string $imageRootFolder Folder under the shop imgae location that contains this image.  For example, 'products'.
	 * @param integer $width Width the resized image should be 
	 * @param integer $height Height the resized image should be
	 * @return string URL to the resized image or 'No Imgae'
	 */
	function createResizedImage($imageFilename, $imageRootFolder, $width, $height) 
	{
		$maxsize = false;
		$bgred = 255;
		$bggreen = 255;
		$bgblue = 255;
		
		$origFileInfo = pathinfo($imageFilename);
		$resizedFilename = $origFileInfo['filename'].'_'.$width.'x'.$height.'.'.$origFileInfo['extension'];
		
		if ($imageRootFolder) {
			$fullSizeFilenamePath = JPATH_COMPONENT_SITE.DS.'shop_image'.DS.$imageRootFolder.DS.$imageFilename;
			$resizedFilenamePath = JPATH_COMPONENT_SITE.DS.'shop_image'.DS.$imageRootFolder.DS.'resized'.DS.$resizedFilename;
		}
		else {
			$fullSizeFilenamePath = JPATH_COMPONENT_SITE.DS.'shop_image'.DS.$imageFilename;
			$resizedFilenamePath = JPATH_COMPONENT_SITE.DS.'shop_image'.DS.'resized'.DS.$resizedFilename;
		}			

		// Don't allow sizes beyond 2000 pixels
		$width = min($width, 2000);
		$height = min($height, 2000);

		if (!file_exists($resizedFilenamePath) && file_exists($fullSizeFilenamePath)) {
			$newFile = new Img2Thumb($fullSizeFilenamePath, $width, $height, $resizedFilenamePath, $maxsize, $bgred, $bggreen, $bgblue);
		}	
		
		if (file_exists($resizedFilenamePath)) {
			if ($imageRootFolder <> '') {
				return JURI::root().'components/com_virtuemart/shop_image/'.$imageRootFolder.'/resized/'.$resizedFilename;
			}
			else {
				return JURI::root().'components/com_virtuemart/shop_image/resized/'.$resizedFilename;
			}				
		}
		else {
			return VM_THEMEURL.'images/'.NO_IMAGE;
		}
	}
	
	
	/**
	 * Returns the filename of an image's resized copy in the /resized folder
	 *
	 * @author RickG
	 * @param string $filename Filename of the image we are looking for.
	 * @param string $imageRootFolder Folder under the shop image location that contains this image.  For example, 'products'.
	 * @param string $ext Image extension we ar elooking for,  If none we will use what is on the $filename.
	 * @param integer $height Height of the image we are looking for.  
	 * @param integer $width Width of the image we are looking for.  
	 * @return string Full path to the resized image file.
	 */
	function getResizedFilename($filename, $imageRootFolder='product', $ext='', $height=0, $width=0)
	{
		$fileinfo = pathinfo($filename);
		if ($ext == '') {
			$ext = $fileinfo['extension'];
		}
		
		if ($width == 0) {
			$width = PSHOP_IMG_WIDTH;
		}
		if ($height == 0) {
			$height = PSHOP_IMG_HEIGHT;
		}
		
		$resizedFilename = $fileinfo['filename'].'_'.$width.'x'.$height.'.'.$fileinfo['extension'];
		if ($imageRootFolder) {
			return JPATH_COMPONENT.DS.'shop_image'.DS.$imageRootFolder.DS.'resized'.DS.$resizedFilename;
		}
		else {
			return JPATH_COMPONENT.DS.'shop_image'.DS.'resized'.DS.$resizedFilename;
		}
	}
	
}
?>