<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* This is the theme's function file.
* It allows you to declare additional functions and classes
* that may be used in your templates 
*
* @version $Id$
* @package VirtueMart
* @subpackage themes
* @copyright Copyright (C) 2006 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
global $mainframe;

// include the stylesheet for this template
$mainframe->addCustomHeadTag( '<link type="text/css" href="'.VM_THEMEURL.'theme.css" rel="stylesheet" media="screen, projection" />' );

/**
 * Builds a list of all additional images
 *
 * @param int $product_id
 * @param array $images
 * @return string
 */
function vmlistAdditionalImages( $product_id, $images, $limit=1000 ) {
	global $sess;
	$html = '';
	$i = 0;
	foreach( $images as $image ) { 
		$thumbtag = ps_product::image_tag( vmImageTools::getResizedFilename($image->file_name ), 'class="browseProductImage"' );
		$fulladdress = $sess->url( 'index2.php?page=shop.view_images&amp;image_id='.$image->file_id.'&amp;product_id='.$product_id.'&amp;pop=1' );
		$html .= vmPopupLink( $fulladdress, $thumbtag, 640, 550 );
		if( ++$i > $limit ) break;
	}
	return $html;
}
/**
 * Builds the "more images" link
 *
 * @param array $images
 */
function vmMoreImagesLink( $images ) {
	global $mosConfig_live_site, $VM_LANG, $sess;
	/* Build the JavaScript Link */
	$url = $sess->url( "index2.php?page=shop.view_images&amp;flypage=".@$_REQUEST['flypage']."&amp;product_id=".@$_REQUEST['product_id']."&amp;category_id=".@$_REQUEST['category_id']."&amp;pop=1" );
	$text = $VM_LANG->_PHPSHOP_MORE_IMAGES.'('.count($images).')';
	$image = vmCommonHTML::imageTag( VM_THEMEURL.'images/more_images.png', $text, '', '16', '16' );
	
	return vmPopupLink( $url, $image.'<br />'.$text, 640, 550, '_blank', '', 'screenX=100,screenY=100' );
}

// Your code here please...

?>