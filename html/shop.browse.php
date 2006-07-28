<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* This is the Main Product Listing File!
*
* @version $Id: shop.browse.php,v 1.9 2005/11/02 20:06:59 soeren_nb Exp $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
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

global $manufacturer_id,$keyword1,$keyword2,$search_category,$DescOrderBy,$search_limiter,$default,
$search_op,$orderby,$product_type_id, $default, $vmInputFilter, $VM_BROWSE_ORDERBY_FIELDS;

/* load important class files */
require_once (CLASSPATH."ps_product.php");
$ps_product = new ps_product;
require_once (CLASSPATH."ps_product_category.php");
$ps_product_category = new ps_product_category;
require_once (CLASSPATH."ps_product_files.php");
require_once (CLASSPATH."ps_reviews.php");
require_once (CLASSPATH."imageTools.class.php");
require_once (CLASSPATH."PEAR/Table.php");

$Itemid = mosgetparam($_REQUEST, "Itemid", null);
$keyword1 = $vmInputFilter->safeSQL( urldecode(mosGetParam( $_REQUEST, 'keyword1', null )));
$keyword2 = $vmInputFilter->safeSQL( urldecode(mosGetParam( $_REQUEST, 'keyword2', null )));
// possible values: [ASC|DESC]
$DescOrderBy = $vmInputFilter->safeSQL( mosGetParam( $_REQUEST, 'DescOrderBy', "ASC" ));
$search_limiter= $vmInputFilter->safeSQL( mosGetParam( $_REQUEST, 'search_limiter', null ));
$search_op= $vmInputFilter->safeSQL( mosGetParam( $_REQUEST, 'search_op', null ));
// possible values: 
// product_name, product_price, product_sku, product_cdate (=latest additions)
$orderby = $vmInputFilter->safeSQL( mosGetParam( $_REQUEST, 'orderby', VM_BROWSE_ORDERBY_FIELD ));

if (empty($category_id)) $category_id = $search_category;

$default['category_flypage'] = FLYPAGE;

$db_browse = new ps_DB;
$dbp = new ps_DB;
// NEW: Include the query section from an external file
require_once( PAGEPATH. "shop_browse_queries.php" );

$db_browse->query( $count );

$num_rows = $db_browse->f("num_rows");

if( $limitstart > 0 && $limit >= $num_rows) {
	
	$list = str_replace( 'LIMIT '.$limitstart, 'LIMIT 0', $list );
}

/*** when nothing has been found
* we tell this here and say goodbye */

if ($num_rows == 0 && !empty($keyword)) {
	echo $VM_LANG->_PHPSHOP_NO_SEARCH_RESULT;
}
elseif( $num_rows == 0 && empty($product_type_id) && !empty($child_list)) {
	echo _EMPTY_CATEGORY;
}
/*** NOW START THE PRODUCT LIST ***/
else {

	$tpl = new vmTemplate();
	
	if( $category_id ) {
		/**
	    * CATEGORY DESCRIPTION
	    */
		$db->query( "SELECT category_id, category_name FROM #__{vm}_category WHERE category_id='$category_id'");
		$db->next_record();
		$category_name = shopMakeHtmlSafe( $db->f('category_name') );
		
		$browsepage_lbl = $category_name;
		$tpl->set( 'browsepage_lbl', $browsepage_lbl );
		
		/* Set Dynamic Page Title */
		$mainframe->setPageTitle( $db->f("category_name") );
		
		$desc =  $ps_product_category->get_description($category_id);
		$desc = vmCommonHTML::ParseContentByPlugins( $desc );
				
		$tpl->set( 'desc', $desc );
			
		$category_childs = $ps_product_category->get_child_list($category_id);
		$tpl->set( 'categories', $category_childs );
		$navigation_childlist = $tpl->fetch_cache( 'common/categoryChildlist.tpl.php');
		$tpl->set( 'navigation_childlist', $navigation_childlist );
	    /**
	    * PATHWAY - Navigation List
	    */
		$nav_list = $ps_product_category->get_navigation_list($category_id);
		$tpl->set( 'category_list', $nav_list );
		$tpl->set( 'category_name', $category_name );
		$navigation_pathway = $tpl->fetch_cache( 'common/pathway.tpl.php');
		
	
		/* Prepend Product Short Description Meta Tag "description" when applicable */	
		$mainframe->prependMetaTag( "description", substr(strip_tags($desc ), 0, 255) );
		
		$mainframe->appendPathWay( $navigation_pathway );
		
		$browsepage_header = $tpl->fetch_cache( 'browse/includes/browse_header_category.tpl.php' );
		
	}
	elseif( $manufacturer_id) {
		$db->query( "SELECT manufacturer_id, mf_name FROM #__{vm}_manufacturer WHERE manufacturer_id='$manufacturer_id'");
		$db->next_record();
		$mainframe->setPageTitle( $db->f("mf_name") );
		
		$browsepage_lbl = shopMakeHtmlSafe( $db->f("mf_name") );
		$tpl->set( 'browsepage_lbl', $browsepage_lbl );
		$browsepage_header = $tpl->fetch_cache( 'browse/includes/browse_header_manufacturer.tpl.php' );
	}
	elseif( $keyword ) {
		$mainframe->setPageTitle( html_entity_decode( $VM_LANG->_PHPSHOP_SEARCH_TITLE ) );
		$browsepage_lbl = $VM_LANG->_PHPSHOP_SEARCH_TITLE .': '.shopMakeHtmlSafe( $keyword );
		$tpl->set( 'browsepage_lbl', $browsepage_lbl );
		
		$browsepage_header = $tpl->fetch_cache( 'browse/includes/browse_header_keyword.tpl.php' );
	}
	else {
		$mainframe->setPageTitle( html_entity_decode($VM_LANG->_PHPSHOP_BROWSE_LBL) );#
		$browsepage_lbl = $VM_LANG->_PHPSHOP_BROWSE_LBL;
		$tpl->set( 'browsepage_lbl', $browsepage_lbl );
		
		$browsepage_header = $tpl->fetch_cache( 'browse/includes/browse_header_all.tpl.php' );
	}
	$tpl->set( 'browsepage_header', $browsepage_header );
	
	if (!empty($product_type_id) && @$_REQUEST['output'] != "pdf") {
		$tpl->set( 'ps_product_type', $ps_product_type);
		$tpl->set( 'product_type_id', $product_type_id);
		$parameter_form = $tpl->fetch_cache( 'browse/includes/browse_searchparameterform.tpl.php' );
	}
	else {
		$parameter_form = '';
	}
	$tpl->set( 'parameter_form', $parameter_form );
	
	if ( $num_rows > 1 && @$_REQUEST['output'] != "pdf") {
		
		// Show the PDF, Email and Print buttons
		$tpl->set('option', $option);
		$tpl->set('category_id', $category_id );
		$tpl->set('product_id', $product_id );
		$buttons_header = $tpl->fetch( 'common/buttons.tpl.php' );
		$tpl->set( 'buttons_header', $buttons_header );
		
		// Prepare Page Navigation
		if ( $num_rows > $limit  || $num_rows > 5 ) {
			require_once( $mosConfig_absolute_path.'/includes/pageNavigation.php');
			$pagenav = new mosPageNav( $num_rows, $limitstart, $limit);

			$search_string = $mm_action_url."index.php?option=com_virtuemart&amp;page=$modulename.browse&amp;category_id=$category_id&amp;keyword=".urlencode( $keyword )."&amp;manufacturer_id=$manufacturer_id&amp;Itemid=$Itemid";
			$search_string .= !empty($orderby) ? "&amp;orderby=".urlencode($orderby) : "";

			if (!empty($keyword1)) {
				$search_string.="&amp;keyword1=".urlencode($keyword1);
				$search_string.="&amp;search_category=$search_category";
				$search_string.="&amp;search_limiter=$search_limiter";
				if (!empty($keyword2)) {
					$search_string.="&amp;keyword2=".urlencode($keyword2);
					$search_string.="&amp;search_op=$search_op";
				}
			}
		}

		$tpl->set( 'VM_BROWSE_ORDERBY_FIELDS', $VM_BROWSE_ORDERBY_FIELDS);
	    
	    if ($DescOrderBy == "DESC") {
	        $icon = "sort_desc.png";
	        $selected = Array( "selected=\"selected\"", "" );
		  	$asc_desc = Array( "DESC", "ASC" );
		}
		else {
		  	$icon = "sort_asc.png";
	        $selected = Array( "", "selected=\"selected\"" );
	        $asc_desc = Array( "ASC", "DESC" );
	    }
		$tpl->set( 'orderby', $orderby );
		$tpl->set( 'icon', $icon );
		$tpl->set( 'selected', $selected );
		$tpl->set( 'asc_desc', $asc_desc );
		$tpl->set( 'category_id', $category_id );
		$tpl->set( 'manufacturer_id', $manufacturer_id );
		$tpl->set( 'keyword', urlencode( $keyword ) );
		$tpl->set( 'keyword1', urlencode( $keyword1 ) );
		$tpl->set( 'keyword2', urlencode( $keyword2 ) );
		
		if( PSHOP_SHOW_TOP_PAGENAV =='1' && ($num_rows > $limit || $num_rows > 5)) {
			$tpl->set( 'show_top_navigation', true );
			$tpl->set( 'search_string', $search_string );
			$tpl->set( 'pagenav', $pagenav );
		}
		else {
			$tpl->set( 'show_top_navigation', false );
		}
		$orderby_form = $tpl->fetch_cache( 'browse/includes/browse_orderbyform.tpl.php' );
		$tpl->set( 'orderby_form', $orderby_form );
    }
    else {
    	$tpl->set( 'orderby_form', '' );
    }

	$db_browse->query( $list );
	$db_browse->next_record();

	$products_per_row = (!empty($category_id)) ? $db_browse->f("products_per_row") : PRODUCTS_PER_ROW;

	if( $products_per_row < 1 ) {
		$products_per_row = 1;
	}
	
	/**
	 *   Start caching all product details for a later loop
	 *
	 **/
	if(@$_REQUEST['output'] != "pdf") {
		$templatefile = (!empty($category_id)) ? $db_browse->f("category_browsepage") : CATEGORY_TEMPLATE;
		if( $templatefile == 'managed' ) {
			// automatically select the browse template with the best match for the number of products per row
			$templatefile = file_exists(VM_THEMEPATH.'templates/browse/browse_'.$products_per_row.'.php' ) 
								? 'browse_'.$products_per_row
								: 'browse_5';					
		}
	}
	else {
		$templatefile = "browse_lite_pdf";
	}
	$tpl->set('products_per_row', $products_per_row );
	$tpl->set('templatefile', $templatefile );
	
	$db_browse->reset();
	
	$products = array();
	$i = 0;
	/*** Start printing out all products (in that category) ***/
	while ($db_browse->next_record()) {

		// If it is item get parent:
		$product_parent_id = $db_browse->f("product_parent_id");
		if ($product_parent_id != 0) {
			$dbp->query("SELECT product_full_image,product_thumb_image,product_name,product_s_desc FROM #__{vm}_product WHERE product_id='$product_parent_id'" );
			$dbp->next_record();
		}

		// Set the flypage for this product based on the category.
		// If no flypage is set then use the default as set in virtuemart.cfg.php
		$flypage = $db_browse->sf("category_flypage");
		
		if (empty($flypage)) {
            $flypage = FLYPAGE;
        }
        
        $url = $sess->url( $mm_action_url."index.php?page=shop.product_details&amp;flypage=$flypage&amp;product_id=" . $db_browse->f("product_id") . "&amp;category_id=" . $db_browse->f("category_id"). "&amp;manufacturer_id=" . $manufacturer_id);

        if( $db_browse->f("product_thumb_image") ) {
            $product_thumb_image = $db_browse->f("product_thumb_image");
		}
		else {
			if( $product_parent_id != 0 ) {
				$product_thumb_image = $dbp->f("product_thumb_image"); // Use product_thumb_image from Parent Product
			}
			else {
				$product_thumb_image = 0;
			}
		}
		if( $product_thumb_image ) {
			if( substr( $product_thumb_image, 0, 4) != "http" ) {
				if(PSHOP_IMG_RESIZE_ENABLE == '1') {
					$product_thumb_image = $mosConfig_live_site."/components/com_virtuemart/show_image_in_imgtag.php?filename=".urlencode($product_thumb_image)."&amp;newxsize=".PSHOP_IMG_WIDTH."&amp;newysize=".PSHOP_IMG_HEIGHT."&amp;fileout=";
				}
				else {
					if( file_exists( IMAGEPATH."product/".$product_thumb_image )) {
                        $product_thumb_image = IMAGEURL."product/".$product_thumb_image;
                    }
                    else {
                        $product_thumb_image = IMAGEURL.NO_IMAGE;
                    }
				}
			}
		}
		else {
			$product_thumb_image = IMAGEURL.NO_IMAGE;
		}

		if( $db_browse->f("product_full_image") ) {
			$product_full_image = $db_browse->f("product_full_image");
		}
		else {
			if( $product_parent_id != 0 ) {
				$product_full_image = $dbp->f("product_full_image"); // Use product_full_image from Parent Product
			}
			else {
				$product_full_image = "..".NO_IMAGE;
			}
		}
		if( file_exists( IMAGEPATH."product/$product_full_image" )) {
			$full_image_info = getimagesize( IMAGEPATH."product/$product_full_image" );
			$full_image_width = $full_image_info[0]+40;
			$full_image_height = $full_image_info[1]+40;
		}
		else {
			$full_image_width = $full_image_height = "";
		}
		
		$files = ps_product_files::getFilesForProduct( $db_browse->f('product_id') );
		$products[$i]['files'] = $files['files'];
		$products[$i]['images'] = $files['images'];
		
		$product_name = $db_browse->f("product_name");
		if( $db_browse->f("product_publish") == "N" ) {
			$product_name .= " (".vmHtmlEntityDecode(_CMN_UNPUBLISHED).")";
		}

		if( empty($product_name) && $product_parent_id!=0 ) {
			$product_name = $dbp->f("product_name"); // Use product_name from Parent Product
		}
		$product_s_desc = $db_browse->f("product_s_desc");
		if( empty($product_s_desc) && $product_parent_id!=0 ) {
			$product_s_desc = $dbp->f("product_s_desc"); // Use product_s_desc from Parent Product
		}
		$product_details = $VM_LANG->_PHPSHOP_FLYPAGE_LBL;

		if (PSHOP_ALLOW_REVIEWS == '1' && @$_REQUEST['output'] != "pdf") {
			/**
        *   Average customer rating: xxxxx
        *   Total votes: x
        */
			$product_rating = $VM_LANG->_PHPSHOP_CUSTOMER_RATING .": <br />";
			$product_rating .= ps_reviews::allvotes( $db_browse->f("product_id") );
		}
		else {
			$product_rating = "";
		}


		/** Price: xx.xx EUR ***/
		if (_SHOW_PRICES == '1' && $auth['show_prices']) {
			$product_price = $ps_product->show_price( $db_browse->f("product_id") );
		}
		else {
			$product_price = "";
		}

		/*** Add-to-Cart Button ***/
		if (USE_AS_CATALOGUE != '1' && $product_price != "" 
			&& !stristr( $product_price, $VM_LANG->_PHPSHOP_PRODUCT_CALL )
			&& !ps_product::product_has_attributes( $db_browse->f('product_id')) ) {
			$tpl->set( 'i', $i );
			$tpl->set( 'product_id', $db_browse->f('product_id') );
			
			$products[$i]['form_addtocart'] = $tpl->fetch( 'common/addtocart_form.tpl.php' );
			$products[$i]['has_addtocart'] = true;
		}
		else {
			$products[$i]['form_addtocart'] = '';
			$products[$i]['has_addtocart'] = false;
		}

		/*** Now fill the template
		* Customizing:
		*   a. Define your own placeholders(e.g. {product_weight} )
		*   b. Add a line below like this (must be below first str_replace call!):
		$tpl->set( 'product_weight'] = $db_browse->f("product_weight") );
		*   c. put the placeholder {product_weight} somewhere in the template (/html/templates)
		<tr><td>Product Weight: {product_weight}</td></tr>
		*   d. save the template file under a new name (e.g. browse_weight.php )
		*   e. Assign the browse page "browse_weight" to the categories,
		*       you want to have using that template file (do that in the category form!)
		**/
		$products[$i]['product_flypage'] = $url;
		$products[$i]['product_thumb_image'] = $product_thumb_image;
		$products[$i]['product_full_image'] = $product_full_image;
		$products[$i]['full_image_width'] = $full_image_width;
		$products[$i]['full_image_height'] = $full_image_height;

		if( substr( $product_full_image, 0, 4) == "http" ) {
			$products[$i]['image_url/product/'] = "";
		}
		else {
			$products[$i]['image_url'] = IMAGEURL;
		}
		
		$products[$i]['product_name'] = shopMakeHtmlSafe( $product_name );
		$products[$i]['product_s_desc'] = $product_s_desc;
		$products[$i]['product_details'] = $product_details;
		$products[$i]['product_rating'] = $product_rating;
		$products[$i]['product_price'] = $product_price;
		$products[$i]['product_sku'] = $db_browse->f("product_sku");

		$i++;

	} /*** END OF while loop ***/

	$tpl->set( 'products', $products );
?>

<?php

if ( $num_rows > $limit && @$_REQUEST['output'] != "pdf") {
	if( !isset($pagenav) ) {
        require_once( $mosConfig_absolute_path.'/includes/pageNavigation.php');
        $pagenav = new mosPageNav( $num_rows, $limitstart, $limit);
    }
    $tpl->set( 'pagenav', $pagenav );
}
if( $num_rows > 5 && @$_REQUEST['output'] != "pdf") {
	$tpl->set( 'show_limitbox', true );
}
else {
	$tpl->set( 'show_limitbox', false );
}
$browsepage_footer = $tpl->fetch_cache( 'browse/includes/browse_pagenav.tpl.php' );
$tpl->set( 'browsepage_footer', $browsepage_footer );

echo $tpl->fetch_cache( 'browse/includes/browse_notables.tpl.php' );
}
?>
