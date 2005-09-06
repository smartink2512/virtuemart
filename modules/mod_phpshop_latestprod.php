<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/* Latest Products Module
*
* @version $Id: mod_phpshop_latestprod.php,v 1.9 2005/06/20 19:57:06 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage modules
*
* @copyright (C) 2000 - 2004 Mr PHP
// W: www.mrphp.com.au
// E: info@mrphp.com.au
// P: +61 418 436 690
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

global $mosConfig_absolute_path;
/* Load the phpshop main parse code */
require_once( $mosConfig_absolute_path.'/components/com_phpshop/phpshop_parser.php' );

if( empty($max_items))
  $max_items = $params->get( 'max_items', 2 ); //maximum number of items to display
if( empty($category_id))
  $category_id = $params->get( 'category_id', null ); // Display products from this category only
if( empty($display_style))
  $display_style = $params->get( 'display_style', "vertical" ); // Display Style
if( empty($products_per_row))
  $products_per_row = $params->get( 'products_per_row', 4 ); // Display X products per Row
if( empty($show_price))
  $show_price = (bool)$params->get( 'show_price', 1 ); // Display the Product Price?
if( empty($show_addtocart))
  $show_addtocart = (bool)$params->get( 'show_addtocart', 1 ); // Display the "Add-to-Cart" Link?

require_once( CLASSPATH . 'ps_product.php');
$ps_product = new ps_product;


  $db =& new ps_DB;
  $q  = "SELECT DISTINCT product_sku FROM #__pshop_product, #__pshop_product_category_xref, #__pshop_category WHERE ";
  $q .= "product_parent_id=''";
  $q .= "AND #__pshop_product.product_id=#__pshop_product_category_xref.product_id ";
  $q .= "AND #__pshop_category.category_id=#__pshop_product_category_xref.category_id ";
  $q .= "AND #__pshop_product.product_publish='Y' ";
  $q .= "ORDER BY #__pshop_product.product_id DESC ";
  $q .= "LIMIT 0, $max_items ";
  $db->query($q);

  if( $db->num_rows() > 0 ){ ?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%">        
        <?php
        $i = 0;
        while($db->next_record() ){
          if ($i%2)
              $sectioncolor = "sectiontableentry2";
          else
              $sectioncolor = "sectiontableentry1";
              
          if( $display_style == "vertical" ) {
          ?>
            <tr align="center" class="<?php echo $sectioncolor ?>">
              <td><?php $ps_product->show_snapshot($db->f("product_sku"), $show_price, $show_addtocart); ?><br /></td>
            </tr>
<?php
          }
          elseif( $display_style== "horizontal" ) {
            if( $i == 0 )
              echo "<tr>\n";
            echo "<td align=\"center\">";
            $ps_product->show_snapshot($db->f("product_sku"), $show_price, $show_addtocart);
            echo "</td>\n";
            if( ($i+1) == $max_items )
              echo "</tr>\n";
          }
          elseif( $display_style== "table" ) {
            if( $i == 0 )
              echo "<tr>\n";
            echo "<td align=\"center\">";
            $ps_product->show_snapshot($db->f("product_sku"), $show_price, $show_addtocart);
            echo "</td>\n";
            if ( ($i+1) % $products_per_row == 0)
              echo "</tr><tr>\n";
            if( ($i+1) == $max_items )
              echo "</tr>\n";
          }
          $i++;
        }
?>
</table>
<?php
  }

?>
