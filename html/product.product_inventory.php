<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_inventory.php,v 1.7 2005/09/01 19:58:06 soeren_nb Exp $
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

$category_id = mosgetparam($_REQUEST, 'category_id', null );
$keyword = mosgetparam($_REQUEST, 'keyword', null );
$allproducts = mosgetparam($_REQUEST, 'allproducts', 0 );
?>
 <table width="100%" cellspacing="0" cellpadding="4" border="0">
  <tr>
    <td>
      <br />&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/inventory.gif" border="0" />
      <br /><br />
    </td>
    <td><?php
          search_header($PHPSHOP_LANG->_PHPSHOP_PRODUCT_INVENTORY_LBL, "product", "product_inventory");
        ?>
    </td>
  </tr>
</table>
<?php
  
  // Enable the multi-page search result display
  $limitstart = mosgetparam($_REQUEST, 'limitstart', 0);

  // Check to see if this is a search or a browse by category
  // Default is to show all products
  if ($category_id) {
     $list  = "SELECT * FROM #__pshop_product, #__pshop_product_category_xref WHERE ";
     $count  = "SELECT count(*) as num_rows FROM #__pshop_product, 
		#__pshop_product_category_xref WHERE ";
     $q  = "#__pshop_product.vendor_id = '$ps_vendor_id' ";
     $q .= "AND #__pshop_product_category_xref.category_id='$category_id' "; 
     $q .= "AND #__pshop_product.product_id=#__pshop_product_category_xref.product_id ";
     $q .= "AND product_in_stock > 0 ";
     $q .= "ORDER BY product_name ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;
  }
  elseif ($keyword) {
     $list  = "SELECT * FROM #__pshop_product WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_product WHERE ";
     $q  = "#__pshop_product.vendor_id = '$ps_vendor_id' ";
     $q .= "AND (#__pshop_product.product_name LIKE '%$keyword%' OR ";
     $q .= "#__pshop_product.product_sku LIKE '%$keyword%' OR ";
     $q .= "#__pshop_product.product_s_desc LIKE '%$keyword%' OR ";
     $q .= "#__pshop_product.product_desc LIKE '%$keyword%'";
     $q .= ") ";
     $q .= "AND product_in_stock > 0 ";
     $q .= "ORDER BY product_name ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  else 
  {
     $list  = "SELECT * FROM #__pshop_product WHERE ";
     $count = "SELECT count(*) as num_rows FROM #__pshop_product WHERE ";
     $q  = "#__pshop_product.vendor_id = '$ps_vendor_id' ";
     if ($allproducts == 1) 
		$q .= "AND product_in_stock > 0 ";
     $q .= "ORDER BY product_name ";
     $list .= $q . " LIMIT $limitstart, " . SEARCH_ROWS;
     $count .= $q;   
  }
  $db->query($count);
  $db->next_record();
  $num_rows = $db->f("num_rows");
  if ($num_rows == 0) {
     echo $PHPSHOP_LANG->_PHPSHOP_NO_SEARCH_RESULT;
  }
  else { 
      echo "&nbsp;&nbsp;<a href=\"".$sess->url($_SERVER['PHP_SELF']."?page=$page&allproducts=1")."\" title=\"".$PHPSHOP_LANG->_PHPSHOP_LIST_ALL_PRODUCTS."\">"
            .$PHPSHOP_LANG->_PHPSHOP_LIST_ALL_PRODUCTS."</a><br /><br />";
      ?>
    <table width="100%" class="adminlist">
    <tr>
     <th width="30%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_NAME?></th>
     <th width="15%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_LIST_SKU?></th>
     <th width="15%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_INVENTORY_STOCK ?></th>
     <th width="10%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_INVENTORY_PRICE ?></th>
     <th width="10%"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_INVENTORY_WEIGHT ?></th>
     
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
       <td align="left"><?php
       $url = $_SERVER['PHP_SELF'] . "?page=$modulename.product_form&product_id=" . $db->f("product_id");
       if ($db->f("product_parent_id")) {
           $url .= "&product_parent_id=" . $db->f("product_parent_id");
       }
       echo "<a href=\"" . $sess->url($url) . "\">";
       echo $db->f("product_name"); 
       echo "</a>"; ?></td>
       <td align="left"><?php echo $db->f("product_sku"); ?></td>
       <td align="left"><?php echo $db->f("product_in_stock"); ?></td>
       <td align="left"><?php $price=$ps_product->get_price($db->f("product_id"));
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
       
       <td align="left"><?php echo $db->f("product_weight"); ?></td>
      </tr>
<?php
    } 
  }
?>
</table>
<?php
  search_footer($modulename, "product_inventory", $limitstart, $num_rows, $keyword, "&allproducts=$allproducts");
?>
