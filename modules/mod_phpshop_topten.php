<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/*
* Best selling Products module for mambo-phpShop
* @version $Id: mod_phpshop_topten.php,v 1.6 2005/04/29 16:23:05 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage modules
*
* @copyright (C) John Syben (john@webme.co.nz)
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*----------------------------------------------------------------------
* This code creates a list of the bestselling products
* and displays it wherever you want
*----------------------------------------------------------------------
*/
global $mosConfig_absolute_path, $sess;

/* Load the phpshop main parse code */
require_once( $mosConfig_absolute_path.'/components/com_phpshop/phpshop_parser.php' );

require_once(CLASSPATH.'ps_product.php');
$ps_product = new ps_product;

// change the number of items you wanna haved listed via module parameters
$num_topsellers = $params->get ('num_topsellers', 10);

$list  = "SELECT distinct #__pshop_product.product_id, #__pshop_product.product_parent_id,#__pshop_product.product_name ";
$list .= "FROM #__pshop_product, #__pshop_product_category_xref, #__pshop_category WHERE ";
$q = "#__pshop_product.product_publish='Y' AND ";
$q .= "#__pshop_product.product_sales>0 ";
$q .= "ORDER BY #__pshop_product.product_sales DESC";
$list .= $q . " LIMIT 0, $num_topsellers "; 

$db = new ps_DB;
$db->query($list);
$tt_item=0;
$i = 0;
?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<?php

  while ($db->next_record()) {
      if ($i == 0) {
          $sectioncolor = "sectiontableentry2";
          $i += 1;
      }
      else {
          $sectioncolor = "sectiontableentry1";
          $i -= 1;
      } 
      $flypage = $ps_product->get_flypage($db->f("product_id"));
      $tt_item++;
      $pid = $db->f("product_parent_id") ? $db->f("product_parent_id") : $db->f("product_id");
      ?>
    <tr class="<?php echo $sectioncolor ?>">
      <td width="15%"><?php printf("%02d", $tt_item); ?></td>
      <td width="85%">
        <a href="<?php  $sess->purl(URL . "index.php?page=shop.product_details&flypage=$flypage&product_id=" . $pid . "&category_id=" . $db->f("category_id")) ?>">
            <?php $db->p("product_name"); ?>
        </a>
      </td>
    </tr>
    <?php 
  } ?>
</table>

<!--Top 10 End-->
