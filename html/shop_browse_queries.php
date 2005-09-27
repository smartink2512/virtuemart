<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/*
* This file is to be included from the file shop.browse.php
* and uses variables from the environment of the file shop.browse.php
*
* @version $Id: COPYRIGHT.php 70 2005-09-15 20:45:51Z spacemonkey $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_phpshop/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );

/** Prepare the SQL Queries
*
*/
// These are the names of all fields we fetch data from
$fieldnames = "product_name,products_per_row,category_browsepage,#__pshop_product.product_id,#__pshop_category.category_id,product_full_image,product_thumb_image,product_s_desc,product_parent_id,product_publish,product_in_stock,product_sku";
$count_name = "COUNT(DISTINCT #__pshop_product.product_sku) as num_rows";

/** Changed Product Type - Begin */
if (!empty($product_type_id)) {
 require_once (CLASSPATH."ps_product_type.php");
 $ps_product_type = new ps_product_type;
 
 // list parameters:
 $q  = "SELECT * FROM #__pshop_product_type_parameter WHERE product_type_id='$product_type_id'";
 $db_browse->query($q); 
 
/*** GET ALL PUBLISHED PRODUCT WHICH MATCH PARAMETERS ***/
 $list  = "SELECT DISTINCT $fieldnames FROM #__pshop_product, #__pshop_category, #__pshop_product_category_xref,#__pshop_shopper_group ";
 $count  = "SELECT $count_name FROM #__pshop_product, #__pshop_category, #__pshop_product_category_xref,#__pshop_shopper_group ";

 $q  = "LEFT JOIN #__pshop_product_price ON #__pshop_product.product_id = #__pshop_product_price.product_id ";
 $q .= "LEFT JOIN #__pshop_product_type_$product_type_id ON #__pshop_product.product_id = #__pshop_product_type_$product_type_id.product_id ";
 $q .= "LEFT JOIN #__pshop_product_product_type_xref ON #__pshop_product.product_id = #__pshop_product_product_type_xref.product_id ";
 $q .= "WHERE #__pshop_product_category_xref.category_id=#__pshop_category.category_id ";
// $q .= "AND #__pshop_product.product_id=#__pshop_product_category_xref.product_id ";
//  $q .= "AND #__pshop_product.product_parent_id='0' ";
 $q .= "AND (#__pshop_product.product_id=#__pshop_product_category_xref.product_id ";
 $q .= "OR #__pshop_product.product_parent_id=#__pshop_product_category_xref.product_id)";
 if( !$perm->check("admin,storeadmin") ) {
    $q .= " AND product_publish='Y'";
    if( CHECK_STOCK && PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS != "1") {
        $q .= " AND product_in_stock > 0 ";
    }
 }

 $q .= "AND #__pshop_product_product_type_xref.product_type_id=$product_type_id ";
 
 // find by parameters
 while ($db_browse->next_record()) {
	$parameter_name = $db_browse->f("parameter_name");
	$item_name = "product_type_$product_type_id"."_".$parameter_name;
	$get_item_value = mosgetparam($_REQUEST, $item_name, "");
	$get_item_value_comp = mosgetparam($_REQUEST, $item_name."_comp", "");
	
	if (is_array($get_item_value) ? count($get_item_value) : strlen($get_item_value) ) {
		// comparison
		switch ($get_item_value_comp) {
			case "lt": $comp = " < "; break;
			case "le": $comp = " <= "; break;
			case "eq": $comp = " <=> "; break;
			case "ge": $comp = " >= "; break;
			case "gt": $comp = " > "; break;
			case "ne": $comp = " <> "; break;
			case "texteq":
				$comp = " <=> "; 
				break;
			case "like":
				$comp = " LIKE ";
				$get_item_value = "%".$get_item_value."%";
				break;
			case "notlike":
				$comp = "COALESCE(`".$parameter_name."` NOT LIKE '%".$get_item_value."%',1)";
				$parameter_name = "";
				$get_item_value = "";
				break;
			case "in": // Multiple section List of values
				$comp = " IN ('".join("','",$get_item_value)."')";
				$get_item_value = "";
				break;
			case "fulltext":
				$comp = "MATCH (`".$parameter_name."`) AGAINST ";
				$parameter_name = "";
				$get_item_value = "('".$get_item_value."')";
				break;
			case "find_in_set":
				$comp = "FIND_IN_SET('$get_item_value',`$parameter_name`)";
				$parameter_name = "";
				$get_item_value = "";
				break;
			case "find_in_set_all":
			case "find_in_set_any":
				$comp = array();
				foreach($get_item_value as $value) {
					array_push($comp,"FIND_IN_SET('$value',`$parameter_name`)");
				}
				$comp = "(" . join($get_item_value_comp == "find_in_set_all"?" AND ":" OR ", $comp) . ")";
				$parameter_name = "";
				$get_item_value = "";
				break;
		}
		switch ($db_browse->f("parameter_type")) {
			case "D": $get_item_value = "CAST('".$get_item_value."' AS DATETIME)"; break;
			case "A": $get_item_value = "CAST('".$get_item_value."' AS DATE)"; break;
			case "M": $get_item_value = "CAST('".$get_item_value."' AS TIME)"; break;
			case "C": $get_item_value = "'".substr($get_item_value,0,1)."'"; break;
			default: 
				if( strlen($get_item_value) ) $get_item_value = "'".$get_item_value."'";
		}
		if( !empty($parameter_name) ) $parameter_name = "`".$parameter_name."`";
		$q .= "AND ".$parameter_name.$comp.$get_item_value." ";
	}
 }
 $item_name = "price";
 $get_item_value = mosgetparam($_REQUEST, $item_name, "");
 $get_item_value_comp = mosgetparam($_REQUEST, $item_name."_comp", "");
 // search by price
 if (!empty($get_item_value)) {
	// comparison
	switch ($get_item_value_comp) {
		case "lt": $comp = " < "; break;
		case "le": $comp = " <= "; break;
		case "eq": $comp = " = "; break;
		case "ge": $comp = " >= "; break;
		case "gt": $comp = " > "; break;
		case "ne": $comp = " <> "; break;
	}
 	$q .= "AND ( ISNULL(product_price) OR product_price".$comp.$get_item_value." ) ";
 	$auth = $_SESSION['auth'];
	// get Shopper Group
	$q .= "AND ( ISNULL(#__pshop_product_price.shopper_group_id) OR #__pshop_product_price.shopper_group_id IN (";
	$comma="";
	if ($auth["user_id"] != 0) { // find user's Shopper Group
		$q2 = "SELECT `shopper_group_id` FROM `#__pshop_shopper_vendor_xref` WHERE `user_id`='".$auth["user_id"]."'";
		$db_browse->query($q2);
		while ($db_browse->next_record()) {
			$q .= $comma.$db_browse->f("shopper_group_id");
			$comma=",";
		}
	}
	// find default Shopper Groups
	$q2 = "SELECT `shopper_group_id` FROM `#__pshop_shopper_group` WHERE `default` = 1";
	$db_browse->query($q2);
	while ($db_browse->next_record()) {
		$q .= $comma.$db_browse->f("shopper_group_id");
		$comma=",";
	}
	$q .= ")) ";
 }
 
 $q .= "GROUP BY #__pshop_product.product_sku ";
 $count .= $q;
 $q .= "ORDER BY #__$orderby ".$DescOrderBy;
 $list .= $q . " LIMIT $limitstart, " . $limit;
//  $error = $list; // only for debug
}
/** Changed Product Type - End */
elseif (empty($manufacturer_id)) {

	/*** GET ALL PUBLISHED PRODUCTS ***/
	$list  = "SELECT DISTINCT $fieldnames FROM #__pshop_product, #__pshop_category, #__pshop_product_category_xref,#__pshop_shopper_group ";
	$count  = "SELECT $count_name FROM #__pshop_product, #__pshop_category, #__pshop_product_category_xref,#__pshop_shopper_group ";
	$q  = "LEFT JOIN #__pshop_product_price ON #__pshop_product.product_id = #__pshop_product_price.product_id ";
	$q .= "WHERE #__pshop_product_category_xref.category_id=#__pshop_category.category_id ";
	if( $category_id ) {
		$q .= "AND #__pshop_product_category_xref.category_id='".$category_id."' ";
	}
	$q .= "AND #__pshop_product.product_id=#__pshop_product_category_xref.product_id ";
	$q .= "AND #__pshop_product.product_parent_id='0' ";
	if( !$perm->check("admin,storeadmin") ) {
		$q .= " AND product_publish='Y'";
		if( CHECK_STOCK && PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS != "1") {
			$q .= " AND product_in_stock > 0 ";
		}
	}
 
	$q .= "AND ((";
	if ($auth["shopper_group_id"] > 0) {
		$q .= "#__pshop_shopper_group.shopper_group_id=#__pshop_product_price.shopper_group_id ";
		//$q .= "AND #__pshop_shopper_group.shopper_group_id='".$auth["shopper_group_id"]."'";
	}
	else {
		$q .= "#__pshop_shopper_group.shopper_group_id=#__pshop_product_price.shopper_group_id ";
		//$q .= "AND #__pshop_shopper_group.default = '1' ";
	}
	$q .= ") OR (#__pshop_product_price.product_id IS NULL)) ";
	
	if( $keyword1 ) {
		$q .= "AND (";
		if ($search_limiter=="name") {
			$q .= "#__pshop_product.product_name LIKE '%$keyword1%' ";
		}
		elseif ($search_limiter=="cp") {
			$q .= "#__pshop_product.product_url LIKE '%$keyword1%' ";
		}
		elseif ($search_limiter=="desc") {
			$q .= "#__pshop_product.product_s_desc LIKE '%$keyword1%' OR ";
			$q .= "#__pshop_product.product_desc LIKE '%$keyword1%'";
		}
		else {
			$q .= "#__pshop_product.product_name LIKE '%$keyword1%' OR ";
			$q .= "#__pshop_product.product_url LIKE '%$keyword1%' OR ";
			$q .= "#__pshop_category.category_name LIKE '%$keyword1%' OR ";
			$q .= "#__pshop_product.product_sku LIKE '%$keyword1%' OR ";
			$q .= "#__pshop_product.product_s_desc LIKE '%$keyword1%' OR ";
			$q .= "#__pshop_product.product_desc LIKE '%$keyword1%'";
		}
		$q .= ") ";
		/*** KEYWORD 2 TO REFINE THE SEARCH ***/
		if ( !empty($keyword2) ) {
			$q .= "$search_op (";
			if ($search_limiter=="name") {
				$q .= "#__pshop_product.product_name LIKE '%$keyword2%' ";
			}
			elseif ($search_limiter=="cp") {
				$q .= "#__pshop_product.product_url LIKE '%$keyword2%' ";
			}
			elseif ($search_limiter=="desc") {
				$q .= "#__pshop_product.product_s_desc LIKE '%$keyword2%' OR ";
				$q .= "#__pshop_product.product_desc LIKE '%$keyword2%'";
			}
			else {
				$q .= "#__pshop_product.product_name LIKE '%$keyword2%' OR ";
				$q .= "#__pshop_product.product_url LIKE '%$keyword2%' OR ";
				$q .= "#__pshop_category.category_name LIKE '%$keyword2%' OR ";
				$q .= "#__pshop_product.product_sku LIKE '%$keyword2%' OR ";
				$q .= "#__pshop_product.product_s_desc LIKE '%$keyword2%' OR ";
				$q .= "#__pshop_product.product_desc LIKE '%$keyword2%'";
			}
			$q .= ") ";
		}
	}
	elseif( $keyword ) {
		$q .= "AND (";
		$keywords = explode( " ", $keyword, 10 );
		$numKeywords = count( $keywords );
		$i = 1;
		foreach( $keywords as $searchstring ) {
			$searchstring = trim( stripslashes($searchstring) );
			if( !empty( $searchstring )) {
				if( $searchstring[0] == "\"" || $searchstring[0]=="'" )
					$searchstring[0] = " ";
				if( $searchstring[strlen($searchstring)-1] == "\"" || $searchstring[strlen($searchstring)-1]=="'" )
					$searchstring[strlen($searchstring)-1] = " ";
				$searchstring = trim( $searchstring );
				$q .= "(#__pshop_product.product_name LIKE '%$searchstring%' OR ";
				$q .= "#__pshop_product.product_sku LIKE '%$searchstring%' OR ";
				$q .= "#__pshop_product.product_s_desc LIKE '%$searchstring%' OR ";
				$q .= "#__pshop_product.product_desc LIKE '%$searchstring%') ";
			}
			if( $i++ < $numKeywords )
				$q .= " AND ";
		}
		$q .= ") ";
	}
	$count .= $q;
	$q .= "GROUP BY #__pshop_product.product_sku ";
	$q .= "ORDER BY #__$orderby $DescOrderBy";
	$list .= $q . " LIMIT $limitstart, " . $limit;
}
  
/*** GET ALL PUBLISHED PRODUCTS FROM THAT MANUFACTURER ***/
elseif (!empty($manufacturer_id)) {
	$list  = "SELECT DISTINCT * FROM #__pshop_product, #__pshop_product_mf_xref, #__pshop_product_price,#__pshop_shopper_group ";
	$count  = "SELECT $count_name FROM #__pshop_product, #__pshop_product_mf_xref, #__pshop_product_price,#__pshop_shopper_group,#__pshop_shopper_vendor_xref WHERE ";
	$q  = " manufacturer_id='".$manufacturer_id."' "; 
	$q .= "AND #__pshop_product.product_id=#__pshop_product_mf_xref.product_id ";
	$q .= "AND #__pshop_product.product_id=#__pshop_product_price.product_id ";
	if ($perm->is_registered_customer($my->id)) {
		$list .= ",#__pshop_shopper_vendor_xref WHERE ";
		$q .= "AND #__pshop_shopper_vendor_xref.user_id = '".$my->id."' ";
		$q .= "AND #__pshop_shopper_vendor_xref.shopper_group_id=#__pshop_product_price.shopper_group_id ";
		$q .= "AND #__pshop_shopper_vendor_xref.shopper_group_id=#__pshop_shopper_group.shopper_group_id ";
	}
	else {
		$list .= " WHERE ";
		$q .= "AND #__pshop_shopper_group.default = '1' ";
		$q .= "AND #__pshop_shopper_group.shopper_group_id=#__pshop_product_price.shopper_group_id ";
	}
	$q .= "AND ((product_parent_id='0') OR (product_parent_id='')) ";
	if( !$perm->check("admin,storeadmin") ) {
		$q .= " AND product_publish='Y' ";
		if( CHECK_STOCK && PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS != "1") {
			$q .= " AND product_in_stock > 0 ";
		}
	}
	$count .= $q;
	$q .= "GROUP BY mos_pshop_product.product_sku ";
	$q .= "ORDER BY #__$orderby $DescOrderBy";
	$list .= $q . " LIMIT $limitstart, " . $limit;
}
// BACK TO shop.browse.php !
?>