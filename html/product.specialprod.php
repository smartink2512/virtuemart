<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/* $Id: product.specialprod.php,v 1.3 2005/01/27 19:34:03 soeren_nb Exp $
* 
* @package mambo-phpShop
* @subpackage HTML
* @Copyright (C) 2000 - 2003 Mr PHP
* @license GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.3 $
*
* 
* www.mambo-phpshop.net
*
* ----------------------------------------------------------------------
 Special Products Manager
 ----------------------------------------------------------------------
 Module designed by 
 W: www.mrphp.com.au
 E: info@mrphp.com.au
 P: +61 418 436 690
 ----------------------------------------------------------------------*/

mm_showMyFileName( __FILE__ );

  search_header("Featured & Discounted Products", "product", "specialprod");
  
  $offset = mosgetparam($_REQUEST, 'offset', 0);
  $keyword = mosgetparam($_REQUEST, 'keyword', "");
  
  // Enable the multi-page search result display
  if (empty($offset))
         $offset=0;

  // Check to see if this is a search or a browse by category
  // Default is to show all products
  if (!empty($_REQUEST['category_id'])) {
     $category_id = $_REQUEST['category_id'];
     $list  = "SELECT * FROM #__pshop_product, #__pshop_product_category_xref WHERE ";
     $count  = "SELECT count(*) as num_rows FROM #__pshop_product,
                product_category_xref, category WHERE ";
     //$q  = "product.vendor_id = '$ps_vendor_id' ";
     $q = "#__pshop_product_category_xref.category_id='$category_id' ";
     $q .= "AND #__pshop_product.product_id=#__pshop_product_category_xref.product_id ";
     $q .= "AND (product_special='Y' OR product_dicsount_id>'0') ";
     $q .= "ORDER BY product_name ";
     $list .= $q . " LIMIT $offset, 50";
     $count .= $q;
  }
  elseif (!empty($keyword)) {
     $list  = "SELECT * FROM #__pshop_product WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_product WHERE ";
     //$q  = "product.vendor_id = '$ps_vendor_id' ";
     $q = "(#__pshop_product.product_name LIKE '%$keyword%' OR ";
     $q .= "#__pshop_product.product_sku LIKE '%$keyword%' OR ";
     $q .= "#__pshop_product.product_s_desc LIKE '%$keyword%' OR ";
     $q .= "#__pshop_product.product_desc LIKE '%$keyword%'";
     $q .= ") ";
     $q .= "AND (product_special='Y' OR product_discount_id>'0') ";
     $q .= "ORDER BY product_name ";
     $list .= $q . " LIMIT $offset, 50";
     $count .= $q;
  }
  else
  {
      $list  = "SELECT * FROM #__pshop_product ";
      $count = "SELECT count(*) as num_rows FROM #__pshop_product ";
      //$q  = "product.vendor_id = '$ps_vendor_id' ";
      if (empty($_REQUEST['allproducts'])){ 
         $q = "WHERE (product_special='Y' OR product_discount_id>0) "; 
      }
      $q = "ORDER BY product_name ";
      $list .= $q . " LIMIT $offset, 50";
      $count .= $q;
  }
  $db->query($count);
  $db->next_record();
  $num_rows = $db->f("num_rows");
  if ($num_rows == 0) {
     echo $PHPSHOP_LANG->_PHPSHOP_NO_SEARCH_RESULT;
  }
  else { ?>
    <table width="100%" class="adminlist">
    <tr>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_NAME ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SKU ?></th>
     <th><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_INVENTORY_PRICE ?></th>
     <th>Featured</th>
     <th>Discount</th>
     <th>Publish</th>
    </tr>
<?php
    $db->query($list);
    $i = 0;
    while ($db->next_record()) {
      if ($i++ % 2)
        $bgcolor=SEARCH_COLOR_1;
      else
        $bgcolor=SEARCH_COLOR_2;
?>
      <tr nowrap bgcolor="<?php echo $bgcolor; ?>">
       <td><?php
       $url = $_SERVER['PHP_SELF']."?page=$modulename.product_form&product_id=" . $db->f("product_id");
       if ($db->f("product_parent_id")) {
           $url .= "&product_parent_id=" . $db->f("product_parent_id");
       }
       echo "<a href=\"" . $sess->url($url) . "\">";
       echo $db->f("product_name");
       echo "</a>"; ?></td>
       <td><?php echo $db->f("product_sku"); ?></td>
       <td><?php $price=$ps_product->get_price($db->f("product_id"));
        if ($price) {
            if (!empty($price["item"])) {
              echo $price["product_price"];
            } else {
              echo "none";
            }
          } else {
            echo "none";
          }
       ?></td>
       <td><?php echo $db->f("product_special"); ?></td>
       <td><?php echo $db->f("product_discount_id"); ?></td>
       <td><?php echo $db->f("product_publish"); ?></td>
      </tr>
<?php
    }
  }
?>
</table>
<?php
  search_footer($modulename, "specialprod", $offset, $num_rows, $keyword);
?>
