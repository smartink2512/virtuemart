<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_list.php,v 1.2 2005/09/25 18:49:29 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.phpshop.org, forums.phpshop.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );
global $ps_product, $ps_product_category;
  
$keyword = mosgetparam($_REQUEST, 'keyword' );
$vendor = mosgetparam($_REQUEST, 'vendor', '');
$product_parent_id = mosgetparam($_REQUEST, 'product_parent_id', null);
$category_id = mosgetparam($_REQUEST, 'category_id', null);
$product_type_id = mosgetparam($_REQUEST, 'product_type_id', null); // Changed Product Type
$search_date = mosgetparam($_REQUEST, 'search_date', null); // Changed search by date

$now = getdate();
$nowstring = $now["hours"].":".$now["minutes"]." ".$now["mday"].".".$now["mon"].".".$now["year"];
$search_order = @$_REQUEST["search_order"] ? $_REQUEST["search_order"] : "<";
$search_type = @$_REQUEST["search_type"] ? $_REQUEST["search_type"] : "product";
	
require_once( CLASSPATH . "pageNavigation.class.php" );
require_once( CLASSPATH . "htmlTools.class.php" );

?>
<div align="right">

	<form style="float:right;" action="<?php $_SERVER['PHP_SELF'] ?>" method="get"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE ?>&nbsp;
          <select class="inputbox" name="search_type">
              <option value="product"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRODUCT ?></option>
              <option value="price" <?php echo $search_type == "price" ? "selected>" : ">"; echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRICE ?></option>
              <option value="withoutprice" <?php echo $search_type == "withoutprice" ? "selected>" : ">"; echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_WITHOUTPRICE ?></option>
          </select>
          <select class="inputbox" name="search_order">
              <option value="<"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_BEFORE ?></option>
              <option value=">" <?php echo $search_order == ">" ? "selected>" : ">"; echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_AFTER ?></option>
          </select>
          <input type="hidden" name="option" value="com_phpshop" />
          <input class="inputbox" type="text" size="15" name="search_date" value="<?php echo mosgetparam($_REQUEST, 'search_date', $nowstring) ?>" />
          <input type="hidden" name="page" value="product.product_list" />
          <input class="button" type="submit" name="search" value="<?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_TITLE?>" />
		  <br/>
         <select class="inputbox" id="category_id" name="category_id" onchange="window.location='<?php echo $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=product.product_list&category_id='+document.getElementById('category_id').options[selectedIndex].value;">
		<option value=""><?php echo _SEL_CATEGORY ?></option>
		<?php
         $ps_product_category->list_tree( $category_id );
        ?>
         </select>
	</form>
	<br/>
</div>
<?php

if (!$perm->check("admin")) {
    $q = "SELECT vendor_id FROM #__pshop_auth_user_vendor WHERE user_id='".$auth['user_id']."'";
    $db->query( $q );
    $db->next_record();
    $vendor = $db->f("vendor_id");
}
// Check to see if this is a search or a browse by category
// Default is to show all products 
if (!empty($category_id)) {
	$list  = "SELECT #__pshop_category.category_name,#__pshop_product.product_id,#__pshop_product.product_name,#__pshop_product.product_sku,#__pshop_product.vendor_id,product_publish";
	$list .= " FROM #__pshop_product, #__pshop_product_category_xref, #__pshop_category WHERE ";
	$count  = "SELECT count(*) as num_rows FROM #__pshop_product, #__pshop_product_category_xref, #__pshop_category WHERE ";

	$q = "#__pshop_product_category_xref.category_id='$category_id' "; 
	$q .= "AND #__pshop_category.category_id=#__pshop_product_category_xref.category_id ";
	$q .= "AND #__pshop_product.product_id=#__pshop_product_category_xref.product_id ";
	$q .= "AND #__pshop_product.product_parent_id='' ";
	if (!$perm->check("admin")) {
		$q  .= "AND #__pshop_product.vendor_id = '$ps_vendor_id' ";
	}
	elseif( !empty($vendor) ) {
		$q .=  "AND #__pshop_product.vendor_id='$vendor' ";
	}
	$count .= $q;
	$q .= "ORDER BY product_publish DESC,product_name ";
	$list .= $q . " LIMIT $limitstart, " . $limit;
}  
elseif (!empty($keyword)) {
	$list  = "SELECT DISTINCT *";
	$list .= " FROM #__pshop_product WHERE ";
	$count = "SELECT DISTINCT count(*) as num_rows FROM #__pshop_product WHERE ";
	$q = "(#__pshop_product.product_name LIKE '%$keyword%' OR ";
	$q .= "#__pshop_product.product_sku LIKE '%$keyword%' OR ";
	$q .= "#__pshop_product.product_s_desc LIKE '%$keyword%' OR ";
	$q .= "#__pshop_product.product_desc LIKE '%$keyword%'";
	$q .= ") ";
	$q .= "AND #__pshop_product.product_parent_id='' ";
	if (!$perm->check("admin")) {
		$q  .= "AND #__pshop_product.vendor_id = '$ps_vendor_id' ";
	}
	elseif( !empty($vendor) ) {
		$q .=  "AND #__pshop_product.vendor_id='$vendor' ";
	}
	$count .= $q;   
	$q .= " ORDER BY product_publish DESC,product_name ";
	$list .= $q . " LIMIT $limitstart, " . $limit;
}
elseif (!empty($product_parent_id)) {
	$list  = "SELECT DISTINCT * FROM #__pshop_product WHERE ";
	$count = "SELECT DISTINCT count(*) as num_rows FROM #__pshop_product WHERE ";
	$q = "product_parent_id='$product_parent_id' ";
	$q .= !empty($vendor) ? "AND #__pshop_product.vendor_id='$vendor'" : "";
	//$q .= "AND #__pshop_product.product_id=#__pshop_product_reviews.product_id ";
	//$q .= "AND #__pshop_category.category_id=#__pshop_product_category_xref.category_id ";
	$count .= $q;
	$q .= " ORDER BY product_publish DESC,product_name ";
	$list .= $q . " LIMIT $limitstart, " . $limit;
} 
/** Changed Product Type - Begin */
elseif (!empty($product_type_id)) {
	$list  = "SELECT DISTINCT * FROM #__pshop_product,#__pshop_product_product_type_xref WHERE ";
	$count = "SELECT DISTINCT count(*) as num_rows FROM #__pshop_product,#__pshop_product_product_type_xref WHERE ";
	$q = "#__pshop_product.product_id=#__pshop_product_product_type_xref.product_id ";
	$q .= "AND product_type_id='$product_type_id' ";
	if (!$perm->check("admin")) {
		$q  .= "AND #__pshop_product.vendor_id = '$ps_vendor_id' ";
	}
	elseif( !empty($vendor) ) {
		$q .=  "AND #__pshop_product.vendor_id='$vendor' ";
	}
	$q .= " ORDER BY product_publish DESC,product_name ";
	$list .= $q . " LIMIT $limitstart, " . $limit;
	$count .= $q;
}  /** Changed Product Type - End */
/** Changed search by date - Begin */
elseif (!empty($search_date)) {
    list($time,$date) = explode(" ",$search_date);
    list($d["search_date_hour"],$d["search_date_minute"]) = explode(":",$time);
    list($d["search_date_day"],$d["search_date_month"],$d["search_date_year"]) = explode(".",$date);
    $d["search_date_use"] = true;
    if (process_date_time($d,"search_date",$PHPSHOP_LANG->_PHPSHOP_SEARCH_LBL)) {
        $date = $d["search_date"];
        switch( $search_type ) {
            case "product" : 
                $list  = "SELECT DISTINCT * FROM #__pshop_product WHERE ";
                $count = "SELECT DISTINCT count(*) as num_rows FROM #__pshop_product WHERE ";
                break;
            case "withoutprice" :
            case "price" :
                $list  = "SELECT DISTINCT #__pshop_product.product_id,product_name,product_sku,vendor_id,";
                $list .= "product_publish,product_parent_id FROM #__pshop_product ";
                $list .= "LEFT JOIN #__pshop_product_price ON #__pshop_product.product_id = #__pshop_product_price.product_id WHERE ";
                $count = "SELECT DISTINCT count(*) as num_rows FROM #__pshop_product ";
                $count.= "LEFT JOIN #__pshop_product_price ON #__pshop_product.product_id = #__pshop_product_price.product_id WHERE ";
                break;
        }
        $where = array();
//         $where[] = "#__pshop_product.product_parent_id='0' ";
        if (!$perm->check("admin")) {
            $where[] = " #__pshop_product.vendor_id = '$ps_vendor_id' ";
        }
        elseif( !empty($vendor) ) {
            $where[] =  " #__pshop_product.vendor_id='$vendor' ";
        }
        $q = "";
        switch( $search_type ) {
            case "product" :
                $where[] = "#__pshop_product.mdate ". $search_order . " $date ";
                break;
            case "price" :
                $where[] = "#__pshop_product_price.mdate ". $search_order . " $date ";
                $q = "GROUP BY #__pshop_product.product_sku ";
                break;
            case "withoutprice" :
                $where[] = "#__pshop_product_price.mdate IS NULL ";
                $q = "GROUP BY #__pshop_product.product_sku ";
                break;
        }
        
        $q = implode(" AND ",$where) . $q . " ORDER BY #__pshop_product.product_publish DESC,#__pshop_product.product_name ";
        $list .= $q . " LIMIT $limitstart, " . $limit;
        $count .= $q;
    }
    else
        echo "<script type=\"text/javascript\">alert('".$d["error"]."')</script>\n";  
}
/** Changed search by date - End */
else {
	$list  = "SELECT DISTINCT * FROM #__pshop_product WHERE ";
	$count = "SELECT DISTINCT count(*) as num_rows FROM #__pshop_product WHERE ";
	$q = "product_parent_id='0' ";
	if (!$perm->check("admin")) {
		$q  .= "AND #__pshop_product.vendor_id = '$ps_vendor_id' ";
	}
	elseif( !empty($vendor) ) {
		$q .=  "AND #__pshop_product.vendor_id='$vendor' ";
	}
	//$q .= "AND #__pshop_product.product_id=#__pshop_product_reviews.product_id ";
	//$q .= "AND #__pshop_category.category_id=#__pshop_product_category_xref.category_id ";
	$count .= $q;
	$q .= " ORDER BY product_publish DESC,product_name ";
	$list .= $q . " LIMIT $limitstart, " . $limit;
}
$db->query($count);
$db->next_record();
$num_rows = $db->f("num_rows");
       
// Create the Page Navigation
$pageNav = new vmPageNav( $num_rows, $limitstart, $limit );

// Create the List Object with page navigation
$listObj = new listFactory( $pageNav );

// print out the search field and a list heading
$listObj->writeSearchHeader($PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_LBL, IMAGEURL."ps_image/product_code.png", "product", "product_list");

// start the list table
$listObj->startTable();

// these are the columns in the table
$columns = Array(  "#" => "", 
					"<input type=\"checkbox\" name=\"toggle\" value=\"\" onclick=\"checkAll(".$num_rows.")\" />" => "",
					$PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_NAME => "width=\"30%\"",
					$PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SKU => "width=\"15%\"",
					$PHPSHOP_LANG->_PHPSHOP_CATEGORY => "width=\"15%\"",
					$PHPSHOP_LANG->_PHPSHOP_VENDOR_MOD => "width=\"15%\"",
					$PHPSHOP_LANG->_PHPSHOP_REVIEWS => "width=\"10%\"",
					$PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_PUBLISH => "width=\"5%\"",
					$PHPSHOP_LANG->_PHPSHOP_PRODUCT_CLONE => "",
					_E_REMOVE => "width=\"5%\""
				);
$listObj->writeTableHeader( $columns );

if ($num_rows > 0) {

	$db->query($list);
	$i = 0;
	$db_cat = new ps_DB;
	$tmpcell = "";
	
	while ($db->next_record()) {
		
		$listObj->newRow();
		
		// The row number
		$listObj->addCell( $pageNav->rowNumber( $i ) );
		
		// The Checkbox
		$listObj->addCell( mosHTML::idBox( $i, $db->f("product_id"), false, "product_id" ) );
		
		// The link to the product form / to the child products
		$tmpcell = "<a href=\"".$sess->url( $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&limitstart=$limitstart&keyword=$keyword&product_id=" . $db->f("product_id")."&product_parent_id=".$product_parent_id )."\">".$db->f("product_name"). "</a>";
		if( $ps_product->parent_has_children( $db->f("product_id") ) ) {
			$tmpcell .= "&nbsp;&nbsp;&nbsp;<a href=\"";
			$tmpcell .= $sess->url($_SERVER['PHP_SELF'] . "?page=$modulename.product_list&product_parent_id=" . $db->f("product_id"));
			$tmpcell .=  "\">[ ".$PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL. " ]</a>";
		}
		$listObj->addCell( $tmpcell );
		
		// The product sku
		$listObj->addCell( $db->f("product_sku") );
		
		// The Categories or the parent product's name
		$tmpcell = "";
		if( empty($product_parent_id) ) {
		  $db_cat->query("SELECT #__pshop_category.category_id, category_name FROM #__pshop_category,#__pshop_product_category_xref 
							WHERE #__pshop_category.category_id=#__pshop_product_category_xref.category_id
							AND #__pshop_product_category_xref.product_id='".$db->f("product_id") ."'");
		  while($db_cat->next_record()) {
			  $tmpcell .= $db_cat->f("category_name") . "<br/>";
		  }
		}
		else {
		  $tmpcell .= $PHPSHOP_LANG->_PHPSHOP_CATEGORY_FORM_PARENT .": <a href=\"";
		  $url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&limitstart=$limitstart&keyword=$keyword&product_id=$product_parent_id";
		  $tmpcell .= $sess->url( $url );
		  $tmpcell .= "\">".$ps_product->get_field($product_parent_id,"product_name"). "</a>";
		}
		$listObj->addCell( $tmpcell );
		
		$listObj->addCell( $ps_product->getVendorName($db->f("vendor_id")) );
		
		$db_cat->query("SELECT count(*) as num_rows FROM #__pshop_product_reviews WHERE product_id='".$db->f("product_id")."'");
		$db_cat->next_record();
		if ($db_cat->f("num_rows")) {
			$tmp_cell = $db_cat->f("num_rows")."&nbsp;";
			$tmpcell .= "<a href=\"".$_SERVER["PHP_SELF"]."?option=com_phpshop&page=product.review_list&product_id=".$db->f("product_id")."\">";
			$tmpcell .= "[".$PHPSHOP_LANG->_PHPSHOP_SHOW."]</a>";
		}
		else {
			$tmpcell = " - ";
		}
		$listObj->addCell( $tmpcell );
		
		$tmpcell = "<a href=\"". $_SERVER['PHP_SELF']."?option=com_phpshop&page=product.product_list&keyword=$keyword&limitstart=$limitstart&product_id=".$db->f("product_id")."&func=publishproduct";
		if ($db->f("product_publish")=='N') {
			$tmpcell .= "&product_publish=Y\">";
		} 
		else { 
			$tmpcell .= "&product_publish=N\">";
		}
		$tmpcell .= vmCommonHTML::getYesNoIcon( $db->f("product_publish"), "Publish", "Unpublish" );
		$tmpcell .= "</a>";
		$listObj->addCell( $tmpcell );
		
		$tmpcell = "<a title=\"".$PHPSHOP_LANG->_PHPSHOP_PRODUCT_CLONE."\" onmouseout=\"MM_swapImgRestore();\"  onmouseover=\"MM_swapImage('copy_$i','','". IMAGEURL ."ps_image/copy_f2.gif',1);\" href=\"";
		$url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&clone_product=1&limitstart=$limitstart&keyword=$keyword&product_id=" . $db->f("product_id");
		if( !empty($product_parent_id) )
			$url .= "&product_parent_id=$product_parent_id";
		$tmpcell .= $sess->url( $url );
		$tmpcell .= "\"><img src=\"".IMAGEURL."/ps_image/copy.gif\" name=\"copy_$i\" border=\"0\" alt=\"".$PHPSHOP_LANG->_PHPSHOP_PRODUCT_CLONE."\" /></a>";
		$listObj->addCell( $tmpcell );
	  
		$listObj->addCell( $ps_html->deleteButton( "product_id", $db->f("product_id"), "productDelete", $keyword, $limitstart ) );
	
		$i++;
	}
}

$listObj->writeTable();

$listObj->endTable();

$listObj->writeFooter( $keyword,  "&product_parent_id=$product_parent_id&category_id=$category_id&product_type_id=$product_type_id&search_date$search_date");
	
?>