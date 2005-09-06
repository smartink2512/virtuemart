<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_list.php,v 1.20 2005/08/12 09:28:50 dvorakz Exp $
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
  
// Enable the multi-page search result display
$limitstart = mosgetparam($_REQUEST, 'limitstart', 0);
if( $limitstart == "" ) $limitstart = 0;
$keyword = mosgetparam($_REQUEST, 'keyword' );
$vendor = mosgetparam($_REQUEST, 'vendor', '');
$product_parent_id = mosgetparam($_REQUEST, 'product_parent_id', null);
$category_id = mosgetparam($_REQUEST, 'category_id', null);
$product_type_id = mosgetparam($_REQUEST, 'product_type_id', null); // Changed Product Type
$search_date = mosgetparam($_REQUEST, 'search_date', null); // Changed search by date
?>
 <table width="100%" cellspacing="0" cellpadding="4" border="0">
  <tr>
    <td>
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/product_code.png" width="48" height="48" alt="Product List" border="0" />
      <br /><br />
    </td>
    <td><?php
         search_header($PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_LBL, "product", "product_list");
         ?><div align="right">
         <select id="category_id" name="category_id" onchange="window.location='<?php echo $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=product.product_list&category_id='+document.getElementById('category_id').options[selectedIndex].value;">
         <option value=""><?php echo _SEL_CATEGORY ?></option>
         <?php
         $ps_product_category->list_tree( $category_id );
        ?>
        </select></div>
    </td>
    <!-- Changed search by date - Begin -->
    <?php
        $now = getdate();
        $nowstring = $now["hours"].":".$now["minutes"]." ".$now["mday"].".".$now["mon"].".".$now["year"];
        $search_order = @$_REQUEST["search_order"] ? $_REQUEST["search_order"] : "<";
        $search_type = @$_REQUEST["search_type"] ? $_REQUEST["search_type"] : "product";
    ?>
    <td align="right">
          <form action="<?php $PHP_SELF ?>" method="get"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE ?>&nbsp;
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
          </form>
    </td>
    <!-- Changed search by date - End -->
  </tr>
</table>
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
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
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
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
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
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;

  } /** Changed Product Type - Begin */
  elseif (!empty($product_type_id)) {
     $list  = "SELECT DISTINCT * FROM #__pshop_product,#__pshop_product_product_type_xref WHERE ";
     $count = "SELECT DISTINCT count(*) as num_rows FROM #__pshop_product,#__pshop_product_product_type_xref WHERE ";
     $q = "#__pshop_product.product_id=#__pshop_product_product_type_xref.product_id ";
     $q .= "AND product_type_id='$product_type_id' ";
//     $q .= "AND product_parent_id='0' ";
     if (!$perm->check("admin")) {
         $q  .= "AND #__pshop_product.vendor_id = '$ps_vendor_id' ";
     }
     elseif( !empty($vendor) ) {
         $q .=  "AND #__pshop_product.vendor_id='$vendor' ";
     }
     $q .= " ORDER BY product_publish DESC,product_name ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
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
        $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
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
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
  }
  $db->query($count);
  $db->next_record();
  $num_rows = $db->f("num_rows");
  if ($num_rows == 0) {
     echo $PHPSHOP_LANG->_PHPSHOP_NO_SEARCH_RESULT;
  }
  else { 
      ?>
    <table width="100%" class="adminlist">
    <tr>
     <th width="5%">#</th>
     <th width="30%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_NAME ?></th>
     <th width="15%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SKU ?></th>
     <th width="15%"><?php echo $PHPSHOP_LANG->_PHPSHOP_CATEGORY ?></th>
     <th width="15%"><?php echo $PHPSHOP_LANG->_PHPSHOP_VENDOR_MOD ?></th>
     <th width="10%"><?php echo $PHPSHOP_LANG->_PHPSHOP_REVIEWS ?></th>
     <th width="5%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_PUBLISH ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_CLONE ?></th>
     <th width="5%"><?php echo _E_REMOVE ?></th>
    </tr>
<?php
    $db->query($list);
    $i = 0;
    $db_cat = new ps_DB;
    while ($db->next_record()) {
      if ($i++ % 2)
        $bgcolor=SEARCH_COLOR_1;
      else
        $bgcolor=SEARCH_COLOR_2;
?>
      <tr nowrap bgcolor="<?php echo $bgcolor; ?>">
       <td width="5%"><?php $nr = $limitstart+$i; echo $nr; ?></td>
       <td width="30%"><?php
         echo "<a href=\"";
         $url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&limitstart=$limitstart&keyword=$keyword&product_id=" . $db->f("product_id");
		 $product_parent_id = $db->f("product_parent_id");
         if( !empty($product_parent_id) )
            $url .= "&product_parent_id=$product_parent_id";
         $sess->purl( $url );
         echo "\">".$db->f("product_name"). "</a>";
         if( $ps_product->parent_has_children( $db->f("product_id") ) ) {
            echo "&nbsp;&nbsp;&nbsp;<a href=\"";
            $sess->purl($_SERVER['PHP_SELF'] . "?page=$modulename.product_list&product_parent_id=" . $db->f("product_id"));
            echo "\">[ ".$PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL. " ]</a>";
         }
      ?>
        </td>
       <td width="15%"><?php echo $db->f("product_sku"); ?></td>
       <td width="15%"><?php              
			if( empty($product_parent_id) ) {
              $q_cat="SELECT category_name FROM #__pshop_category,#__pshop_product_category_xref ";
              $q_cat.="WHERE #__pshop_category.category_id=#__pshop_product_category_xref.category_id ";
              $q_cat.="AND #__pshop_product_category_xref.product_id='".$db->f("product_id") ."'";
              $db_cat->query($q_cat);
              while($db_cat->next_record()) {
                  echo $db_cat->f("category_name") . "<br/>";
              }
 		    }
			else {
         	  echo $PHPSHOP_LANG->_PHPSHOP_CATEGORY_FORM_PARENT .": <a href=\"";
         	  $url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&limitstart=$limitstart&keyword=$keyword&product_id=$product_parent_id";
			  $sess->purl( $url );
			  echo "\">".$ps_product->get_field($product_parent_id,"product_name"). "</a>";
			}
      ?>
       </td>
       <td width="15%"><?php $ps_product->show_vendorname($db->f("vendor_id")); ?></td>
       <td width="10%"><?php
        $db_cat->query("SELECT count(*) as num_rows FROM #__pshop_product_reviews WHERE product_id='".$db->f("product_id")."'");
        $db_cat->next_record();
        if ($db_cat->f("num_rows")) {
            echo $db_cat->f("num_rows")."&nbsp;";
            echo "<a href=\"".$_SERVER["PHP_SELF"]."?option=com_phpshop&page=product.review_list&product_id=".$db->f("product_id")."\">";
            echo "[".$PHPSHOP_LANG->_PHPSHOP_SHOW."]</a>";
        }
        else {
            echo " - ";
        }
        ?>
        </td>
       <td width="15%">
          <a href="<?php 
          echo $_SERVER['PHP_SELF']."?option=com_phpshop&page=product.product_list&keyword=$keyword&limitstart=$limitstart&product_id=".$db->f("product_id")."&func=publishproduct";
          if ($db->f("product_publish")=='N') { ?>&product_publish=Y">
            <img src="<?php echo $mosConfig_live_site ?>/administrator/images/publish_x.png" border="0" alt="Publish" /><?php 
          } 
          else { ?>&product_publish=N">
            <img src="<?php echo $mosConfig_live_site ?>/administrator/images/tick.png" border="0" alt="Unpublish" /><?php 
            } ?></a>
        </td>
       <td><?php
         echo "<a title=\"".$PHPSHOP_LANG->_PHPSHOP_PRODUCT_CLONE."\" onmouseout=\"MM_swapImgRestore();\"  onmouseover=\"MM_swapImage('copy_$i','','". IMAGEURL ."ps_image/copy_f2.gif',1);\" href=\"";
         $url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&clone_product=1&limitstart=$limitstart&keyword=$keyword&product_id=" . $db->f("product_id");
         if( !empty($product_parent_id) )
            $url .= "&product_parent_id=$product_parent_id";
         $sess->purl( $url );
         echo "\"><img src=\"".IMAGEURL."/ps_image/copy.gif\" name=\"copy_$i\" border=\"0\" alt=\"".$PHPSHOP_LANG->_PHPSHOP_PRODUCT_CLONE."\" /></a>";?>
      </td>
       <td width="5%">
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $_REQUEST['page'] ?>&func=productDelete&product_id=<?php echo $db->f("product_id") ?>&keyword=<?php echo urlencode($keyword) ?>&limitstart=<?php echo $limitstart ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete<?php echo $i ?>','','<?php echo IMAGEURL ?>ps_image/delete_f2.gif',1);"><img src="<?php echo IMAGEURL ?>ps_image/delete.gif" alt="Delete this record" name="delete<?php echo $i ?>" align="middle" border="0"/>
        </a>
    </td>
      </tr>
<?php
    } 
  }
?>
</table>
<?php
  search_footer($modulename, "product_list", $limitstart, $num_rows, $keyword,  "&product_parent_id=$product_parent_id&category_id=$category_id");
?>
