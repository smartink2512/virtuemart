<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* mambo-phpShop JSCookTree menu
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ JSCookTree mambo-phpShop menu created by Soeren
* @ modified by soeren
* @ Uses JSCookTree Javascript: http://www.cs.ucla.edu/~heng/JSCookTree/
* @ version $Id: phpshop_JSCookTree.php,v 1.3 2005/05/31 20:42:35 soeren_nb Exp $
*
* This file is included by the phpshop module if the module parameter
* MenuType is set to jscooktree
**/
global $module, $root_label;
$Itemid = mosGetParam( $_REQUEST, 'Itemid', "");
$TreeId = mosGetParam( $_REQUEST, 'TreeId', "");

//$jscook_theme = "ThemeXP";
//$jscook_tree = "ctThemeXP1";

$jscook_theme = "ThemeNavy";
$jscook_tree = "ctThemeNavy";

echo "
<script language=\"JavaScript\" type=\"text/javascript\" src=\"components/com_phpshop/js/JSCookTree.js\"></script>
<link rel=\"stylesheet\" href=\"components/com_phpshop/js/$jscook_theme/theme.css\" type=\"text/css\" />
<script language=\"JavaScript\" type=\"text/javascript\" src=\"components/com_phpshop/js/$jscook_theme/theme.js\"></script>
";
/*********************************************************
************* CATEGORY TREE ******************************
*/

$MamboMartTree = new MamboMartTree();
  
// create a unique tree identifier, in case multiple trees are used 
// (max one per module)
$treename = "JSCook".uniqid( "Tree_" );

$menu_htmlcode = "<div align=\"left\" class=\"mainlevel\" id=\"div_$treename\"></div>
<script type=\"text/javascript\"><!--
var $treename = 
[
";
$phpShopmenu->traverse_tree_down($menu_htmlcode);
  
$menu_htmlcode .= "];
var treeindex = ctDraw ('div_$treename', $treename, $jscook_tree, '$jscook_theme', 0, 0);
--></script>\n";
if( $TreeId ) {
  $menu_htmlcode .= "<input type=\"hidden\" id=\"TreeId\" name=\"TreeId\" value=\"$TreeId\" />\n";
  $menu_htmlcode .= "<script language=\"JavaScript\" type=\"text/javascript\">ctExposeTreeIndex( treeindex, parseInt(ctGetObject('TreeId').value));</script>\n";
}
$menu_htmlcode .= "<noscript>";
$menu_htmlcode .= $ps_product_category->get_category_tree( $category_id, $class_mainlevel );
$menu_htmlcode .= "\n</noscript>\n";

echo $menu_htmlcode;


class MamboMartTree {
    /***************************************************
    * function traverse_tree_down
    */
    function traverse_tree_down(&$mymenu_content, $category_id='0', $level='0') {
        static $ibg = -1;
        global $database, $module, $mosConfig_live_site;
        $level++;
        $query = "SELECT category_name as cname, category_id as cid, category_child_id as ccid "
        . "FROM #__pshop_category as a, #__pshop_category_xref as b "
         . "WHERE a.category_publish='Y' AND "
         . " b.category_parent_id='$category_id' AND a.category_id=b.category_child_id "
         . "ORDER BY category_parent_id, list_order, category_name ASC";
        $database->setQuery( $query );
        
        $categories = $database->loadObjectList();
        
        if( !( $categories==null ) ) {
          $i = 1;
          foreach ($categories as $category) {
            $ibg++;
            $Treeid = $ibg == 0 ? 1 : $ibg;
            $itemid = isset($_REQUEST['itemid']) ? '&itemid='.$_REQUEST['itemid'] : "";
            $mymenu_content.= ",\n[null,'".$category->cname;
            $mymenu_content.= ps_product_category::products_in_category( $category->cid );
            $mymenu_content.= "','".sefRelToAbs('index.php?option=com_phpshop&page=shop.browse&category_id='.$category->cid.$itemid."&TreeId=$Treeid")."','_self','".$category->cname."'\n ";
            /*$database->setQuery("SELECT count(*) FROM #__pshop_category as a, #__pshop_category_xref as b "
                                         . "WHERE a.category_publish='Y' AND "
                                         . "b.category_parent='".$category->cid."'");
              $res = $database->query();
              // are there more categories?
              if ($database->getNumRows($res) > 0)
                $mymenu_content.= ",\n";
              else
                $mymenu_content.= "],\n";*/
                
              /* recurse through the subcategories */
              $this->traverse_tree_down($mymenu_content, $category->ccid, $level);
              
              /* let's see if the loop has reached its end */
              if ( $i == sizeof( $categories ) && $level == 1)
                $mymenu_content.= "]";
              else
                $mymenu_content.= "]";
              $i++;
              
                
          }
        }
        else {
            
        }
      }
}
/************* END OF CATEGORY TREE ******************************
*********************************************************
*/
?>
