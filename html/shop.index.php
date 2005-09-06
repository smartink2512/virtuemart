<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/* $Id: shop.index.php,v 1.4 2005/09/06 19:28:36 soeren_nb Exp $
* 
* @package Mambo Open Source
* @Copyright (C) 2000 - 2003 Miro International Pty Ltd
* @ All rights reserved
* @ Mambo Open Source is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.4 $
*
* @sub-package mambo-phpShop
* mostly contains code from PHPShop:
* Copyright (c) Edikon Corporation ( www.phpshop.org ).
* Distributed under the GNU Public License (GPL)
* 
* www.mambo-phpshop.net
*
**/
require_once( CLASSPATH . 'ps_product.php');
require_once( CLASSPATH . 'ps_product_category.php');
$ps_product = new ps_product;

// Show only top level categories and categories that are
// being published
$query  = "SELECT * FROM #__pshop_category, #__pshop_category_xref ";
$query .= "WHERE #__pshop_category.category_publish='Y' AND ";
$query .= "(#__pshop_category_xref.category_parent_id='' OR #__pshop_category_xref.category_parent_id='0') AND ";
$query .= "#__pshop_category.category_id=#__pshop_category_xref.category_child_id ";
$query .= "ORDER BY #__pshop_category.list_order, #__pshop_category.category_name ASC";

// initialise the query in the $database connector
// this translates the '#__' prefix into the real database prefix
$db->query( $query );

$iCol = 1;
$categories_per_row = 4;
$cellwidth = intval( 100 / $categories_per_row );
?>
<table class="moduletable" width="100%" cellspacing="0" cellpadding="0">  
  <tr>
    <th colspan="<?php echo $categories_per_row ?>"><?php echo $PHPSHOP_LANG->_PHPSHOP_CATEGORIES ?></th>
  </tr>
  <?php
	// cycle through the returned rows displaying them in a table
	// with links to the product category
	// escaping in and out of php is now permitted
    while( $db->next_record() ) {	  
	  
        if ($iCol == 1) {
          echo "<tr>";
        }
		$catname = shopMakeHtmlSafe($db->f("category_name"))
      ?> 
        <td align="center" width="<?php echo $cellwidth ?>" valign="top">
          <a title="<?php echo $catname ?>" href="<?php echo $sess->url(URL."index.php?option=com_phpshop&amp;page=shop.browse&amp;category_id=".$db->f("category_id")); ?>"> 
          <?php 
          if ($db->f("category_thumb_image")) {
            echo $ps_product->show_image( $db->f("category_thumb_image"), "", 0, "category");
            echo "<br />";
          }
		  echo $catname;
          echo ps_product_category::products_in_category( $db->f("category_id") );
?>
          </a>
        </td>
      <?php
        if ($iCol == $categories_per_row) {
          echo "</tr>";
          $iCol = 1;
        }
        else
          $iCol++;

	  }
?>
</table>
<?php echo $vendor_store_desc;  ?>
