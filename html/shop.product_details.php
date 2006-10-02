<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: shop.product_details.php,v 1.12.2.1 2005/11/28 19:06:53 soeren_nb Exp $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2006 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );

require_once(CLASSPATH . 'ps_product_files.php' );
require_once(CLASSPATH . 'imageTools.class.php' );
require_once(CLASSPATH . 'ps_product.php' );
$ps_product = $GLOBALS['ps_product'] = new ps_product;

require_once(CLASSPATH . 'ps_product_category.php' );
$ps_product_category = new ps_product_category;

require_once(CLASSPATH . 'ps_product_attribute.php' );
$ps_product_attribute = new ps_product_attribute;

require_once(CLASSPATH . 'ps_product_type.php' );
$ps_product_type = new ps_product_type;
require_once(CLASSPATH . 'ps_reviews.php' );

/* Flypage Parameter has old page syntax: shop.flypage
* so let's get the second part - flypage */
$flypage = mosGetParam($_REQUEST, "flypage", FLYPAGE);
$flypage = str_replace( 'shop.', '', $flypage);
$flypage = stristr( $flypage, '.tpl') ? $flypage : $flypage . '.tpl';

$product_id = intval( mosgetparam($_REQUEST, "product_id", null) );
$product_sku = $db->getEscaped( mosgetparam($_REQUEST, "sku", '' ) );
$category_id = mosgetparam($_REQUEST, "category_id", null);
$manufacturer_id = mosgetparam($_REQUEST, "manufacturer_id", null);
$Itemid = $sess->getShopItemid();
$db_product = new ps_DB;

// Get the product info from the database
$q = "SELECT * FROM `#__{vm}_product` WHERE ";
if( !empty($product_id)) {
	$q .= "`product_id`=$product_id";
}
elseif( !empty($product_sku )) {
	$q .= "`product_sku`='$product_sku'";
}
else {
	mosRedirect( $_SERVER['PHP_SELF']."?option=com_virtuemart&keyword={$_SESSION['keyword']}&category_id={$_SESSION['category_id']}&limitstart={$_SESSION['limitstart']}", $VM_LANG->_PHPSHOP_PRODUCT_NOT_FOUND );
}

if( !$perm->check("admin,storeadmin") ) {
	$q .= " AND `product_publish`='Y'";
	if( CHECK_STOCK && PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS != "1") {
		$q .= " AND `product_in_stock` > 0 ";
	}
}
$db_product->query( $q );

// Redirect back to Product Browse Page on Error
if( !$db_product->next_record() ) {
	mosRedirect( $_SERVER['PHP_SELF']."?option=com_virtuemart&keyword={$_SESSION['keyword']}&category_id={$_SESSION['category_id']}&limitstart={$_SESSION['limitstart']}", $VM_LANG->_PHPSHOP_PRODUCT_NOT_FOUND );
}
if( empty($product_id)) {
	$product_id = $db_product->f('product_id');
}
$product_parent_id = $db_product->f("product_parent_id");
if ($product_parent_id != 0) {
	$dbp= new ps_DB;
	$dbp->query("SELECT * FROM #__{vm}_product WHERE product_id='$product_parent_id'" );
	$dbp->next_record();
}

/* Create the template object */
$tpl = new $GLOBALS['VM_THEMECLASS']();


// Let's have a look wether the product has related products.
$q = "SELECT product_sku, related_products FROM #__{vm}_product,#__{vm}_product_relations ";
$q .= "WHERE #__{vm}_product_relations.product_id='$product_id' AND product_publish='Y' ";
$q .= "AND FIND_IN_SET(#__{vm}_product.product_id, REPLACE(related_products, '|', ',' )) LIMIT 0, 4";
$db->query( $q );
/*// This shows randomly selected products from the products table
// if you don't like to set up related products for each product
$q = "SELECT product_sku FROM #__{vm}_product ";
$q .= "WHERE product_publish='Y' AND product_id != $product_id ";
$q .= "ORDER BY RAND() LIMIT 0, 4";
$db->query( $q );*/
$related_products = '';
if( $db->num_rows() > 0 ) {
	$tpl->set( 'ps_product', $ps_product );
	$tpl->set( 'products', $db );
	$related_products = $tpl->fetch( '/common/relatedProducts.tpl.php' );
}

/** GET THE PRODUCT NAME **/
$product_name = shopMakeHtmlSafe( $db_product->f("product_name") );
if( $db_product->f("product_publish") == "N" ) {
	$product_name .= " ("._CMN_UNPUBLISHED.")";
}
$product_description = $db_product->f("product_desc");
if( (str_replace("<br />", "" , $product_description)=='') && ($product_parent_id!=0) ) {
	$product_description = $dbp->f("product_desc"); // Use product_desc from Parent Product
}
$product_description = vmCommonHTML::ParseContentByPlugins( $product_description );

/** Get the CATEGORY NAVIGATION **/
$navigation_pathway = "";
$navigation_childlist = "";
$pathway_appended = false;
if (empty($category_id))  {
	$q = "SELECT category_id FROM #__{vm}_product_category_xref WHERE product_id = '$product_id' LIMIT 0,1";
	$db->query( $q );
	$db->next_record();
	if( !$db->f("category_id") ) {
		// The Product Has no category entry and must be a Child Product
		// So let's get the Parent Product
		$q = "SELECT product_id FROM #__{vm}_product WHERE product_id = '".$db_product->f("product_parent_id")."' LIMIT 0,1";
		$db->query( $q );
		$db->next_record();

		$q = "SELECT category_id FROM #__{vm}_product_category_xref WHERE product_id = '".$db->f("product_id")."' LIMIT 0,1";
		$db->query( $q );
		$db->next_record();
	}
	$_GET['category_id'] = $category_id = $db->f("category_id");
}
$category_list = $ps_product_category->get_navigation_list($category_id);
$tpl->set( 'category_list', $category_list );
$tpl->set( 'product_name', $product_name );
$navigation_pathway = $tpl->fetch_cache( 'common/pathway.tpl.php');

if ($ps_product_category->has_childs($category_id) ) {
	$category_childs = $ps_product_category->get_child_list($category_id);
	$tpl->set( 'categories', $category_childs );
	$navigation_childlist = $tpl->fetch_cache( 'common/categoryChildlist.tpl.php');
}

/* Set Dynamic Pathway */
$mainframe->appendPathWay( $navigation_pathway );

/* Set Dynamic Page Title */
$mainframe->setPageTitle( html_entity_decode( substr($product_name, 0, 60 ) ));

/* Prepend Product Short Description Meta Tag "description" */
$mainframe->prependMetaTag( "description", strip_tags( $db_product->f("product_s_desc")) );


/** Show an "Edit PRODUCT"-Link ***/
if ($perm->check("admin,storeadmin")) {
	$edit_link = "<a href=\"". sefRelToAbs($mosConfig_live_site."/index.php?page=product.product_form&amp;next_page=shop.product_details&amp;product_id=$product_id&amp;option=com_virtuemart&amp;Itemid=$Itemid")."\">
      <img src=\"images/M_images/edit.png\" width=\"16\" height=\"16\" alt=\"". $VM_LANG->_PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT ."\" border=\"0\" /></a>";
}
else {
	$edit_link = "";
}

/** LINK TO MANUFACTURER POP-UP **/
$manufacturer_id = $ps_product->get_manufacturer_id($product_id);
$manufacturer_name = $ps_product->get_mf_name($product_id);
$manufacturer_link = "";
if( $manufacturer_id && !empty($manufacturer_name) ) {
	$link = "$mosConfig_live_site/index2.php?page=shop.manufacturer_page&amp;manufacturer_id=$manufacturer_id&amp;output=lite&amp;option=com_virtuemart&amp;Itemid=".$Itemid;
	$text = '( '.$manufacturer_name.' )';
	$manufacturer_link .= vmPopupLink( $link, $text );

	// Avoid JavaScript on PDF Output
	if( @$_REQUEST['output'] == "pdf" )
	$manufacturer_link = "<a href=\"$link\" target=\"_blank\" title=\"$text\">$text</a>";
}
/** PRODUCT PRICE **/
if (_SHOW_PRICES == '1') { /** Change - Begin */
	if( $db_product->f("product_unit") && VM_PRICE_SHOW_PACKAGING_PRICELABEL) {
		$product_price_lbl = "<strong>". $VM_LANG->_PHPSHOP_CART_PRICE_PER_UNIT.' ('.$db_product->f("product_unit")."):</strong>";
	}
	else {/** Change - End */
		$product_price_lbl = "<strong>". $VM_LANG->_PHPSHOP_CART_PRICE. ": </strong>";
	}
	$product_price = $ps_product->show_price( $product_id );
}
else {
	$product_price = "";
}

/** Change Packaging - Begin */
/** PRODUCT PACKAGING **/
if (  $db_product->f("product_packaging") ) {
	$packaging = $db_product->f("product_packaging") & 0xFFFF;
	$box = ($db_product->f("product_packaging") >> 16) & 0xFFFF;
	$product_packaging = "";
	if ( $packaging ) {
		$product_packaging .= $VM_LANG->_PHPSHOP_PRODUCT_PACKAGING1.$packaging;
		if( $box ) $product_packaging .= "<br/>";
	}
	if ( $box ) {
		$product_packaging .= $VM_LANG->_PHPSHOP_PRODUCT_PACKAGING2.$box;
	}

	$product_packaging = str_replace("unit",$db_product->f("product_unit")?$db_product->f("product_unit") : $VM_LANG->_PHPSHOP_PRODUCT_FORM_UNIT_DEFAULT,$product_packaging);
}
else {
	$product_packaging = "";
}
/** Change Packaging - End */

/** PRODUCT IMAGE **/
$product_full_image = $product_parent_id!=0 && !$db_product->f("product_full_image") ?
					$dbp->f("product_full_image") : $db_product->f("product_full_image"); // Change
$product_thumb_image = $product_parent_id!=0 && !$db_product->f("product_thumb_image") ?
					$dbp->f("product_thumb_image") : $db_product->f("product_thumb_image"); // Change

/* MORE IMAGES ??? */
$files = ps_product_files::getFilesForProduct( $product_id );

$more_images = "";
if( !empty($files['images']) ) {
	$more_images = $tpl->vmMoreImagesLink( $files['images'] );
}
/* Files? */
$file_list = ps_product_files::get_file_list( $product_id );

if( @$_REQUEST['output'] != "pdf" ) {
	
	// Show the PDF, Email and Print buttons
	$tpl->set('option', $option);
	$tpl->set('category_id', $category_id );
	$tpl->set('product_id', $product_id );
	$buttons_header = $tpl->fetch( 'common/buttons.tpl.php' );
	$tpl->set( 'buttons_header', $buttons_header );
	
	/** AVAILABILITY **/
	// This is the place where it shows:
	// Availability: 24h, In Stock: 5 etc.
	// You can make changes to this functionality in the file: classes/ps_product.php
	$product_availability = $ps_product->get_availability($product_id);
}

/** Ask seller a question **/
$ask_seller = '<a class="button" href="'.$sess->url( $mosConfig_live_site.'/index.php?page=shop.ask&amp;flypage='.@$_REQUEST['flypage']."&amp;product_id=$product_id&amp;category_id=$category_id&amp;set=1" ). '">';
$ask_seller .= $VM_LANG->_VM_PRODUCT_ENQUIRY_LBL.'</a>';

/* SHOW RATING */
$product_rating = "";
if (PSHOP_ALLOW_REVIEWS == '1') {
	$product_rating = ps_reviews::allvotes( $product_id );
}

$product_reviews = $product_reviewform = "";
/* LIST ALL REVIEWS **/
if (PSHOP_ALLOW_REVIEWS == '1') {
	/*** Show all reviews available ***/
	$product_reviews = ps_reviews::product_reviews( $product_id );
	/*** Show a form for writing a review ***/
	
	if( $my->id ) {
		$product_reviewform = ps_reviews::reviewform( $product_id );
	}
}

/* LINK TO VENDOR-INFO POP-UP **/
$vend_id = $ps_product->get_vendor_id($product_id);
$vend_name = $ps_product->get_vendorname($product_id);

$link = "$mosConfig_live_site/index2.php?page=shop.infopage&amp;vendor_id=$vend_id&amp;output=lite&amp;option=com_virtuemart&amp;Itemid=".$Itemid;
$text = $VM_LANG->_PHPSHOP_VENDOR_FORM_INFO_LBL;
$vendor_link = vmPopupLink( $link, $text );

// Avoid JavaScript on PDF Output
if( @$_REQUEST['output'] == "pdf" )
$vendor_link = "<a href=\"$link\" target=\"_blank\" title=\"$text\">$text</a>";

if ($product_parent_id!=0 && !$ps_product_type->product_in_product_type($product_id)) {
	$product_type = $ps_product_type->list_product_type($product_parent_id);
}
else {
	$product_type = $ps_product_type->list_product_type($product_id);
}

/**
* This has changed since VM 1.1.0  
* Now we have a template object that can use all variables 
* that we assign here.
* 
* Example: If you run
* $tpl->set( "product_name", $product_name );
* The variable "product_name" will be available in the template under this name
* with the value of $product_name
* 
* */

// This part allows us to copy ALL properties from the product table
// into the template
$productData = $db_product->get_row();
$productArray = get_object_vars( $productData );

$productArray["product_full_image"] = $product_full_image; // to display the full image on flypage
$productArray["product_thumb_image"] = $product_thumb_image;

$tpl->set( 'productArray', $productArray );
foreach( $productArray as $property => $value ) {
	$tpl->set( $property, $value);
}
// Assemble the thumbnail image as a link to the full image
// This function is defined in the theme (theme.php)
$product_image = $tpl->vmBuildFullImageLink( $productArray );

$tpl->set( "product_id", $product_id );
$tpl->set( "product_name", $product_name );
$tpl->set( "product_image", $product_image );
$tpl->set( "more_images", $more_images );
$tpl->set( "images", $files['images'] );
$tpl->set( "files", $files['files'] );
$tpl->set( "file_list", $file_list );
$tpl->set( "edit_link", $edit_link );
$tpl->set( "manufacturer_link", $manufacturer_link );
$tpl->set( "product_price", $product_price );
$tpl->set( "product_price_lbl", $product_price_lbl );
$tpl->set( "product_description", $product_description );

/* ADD-TO-CART */
$tpl->set( 'manufacturer_id', $manufacturer_id );
$tpl->set( 'flypage', $flypage );
$tpl->set( 'ps_product_attribute', $ps_product_attribute );
$addtocart = $tpl->fetch('product_details/includes/addtocart_form.tpl.php' );

$tpl->set( "addtocart", $addtocart );
// Those come from separate template files
$tpl->set( "navigation_pathway", $navigation_pathway );
$tpl->set( "navigation_childlist", $navigation_childlist );
$tpl->set( "product_reviews", $product_reviews );
$tpl->set( "product_reviewform", $product_reviewform );
$tpl->set( "product_availability", $product_availability );

$tpl->set( "related_products", $related_products );
$tpl->set( "vendor_link", $vendor_link );
$tpl->set( "product_type", $product_type ); // Changed Product Type
$tpl->set( "product_packaging", $product_packaging ); // Changed Packaging
$tpl->set( "ask_seller", $ask_seller ); // Product Enquiry!

/* Finish and Print out the Page */
echo $tpl->fetch_cache( '/product_details/'.$flypage . '.php' );

?>
