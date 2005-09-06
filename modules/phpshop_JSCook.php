<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* mambo-phpShop JSCookTree menu
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ JSCookTree mambo-phpShop menu created by Soeren
* @ modified by soeren
* @ Uses JSCookTree Javascript: http://www.cs.ucla.edu/~heng/JSCookTree/
* @ version $Id: phpshop_JSCook.php,v 1.3 2005/06/30 17:42:53 soeren_nb Exp $
*
* This file is included by the phpshop module if the module parameter
* MenuType is set to jscooktree
**/
global $module, $root_label, $jscook_type, $jscookMenu_style, $jscookTree_style, $ps_product_category;
if( !isset( $ps_product_category )) $ps_product_category = new ps_product_category;
$Itemid = mosGetParam( $_REQUEST, 'Itemid', "");
$TreeId = mosGetParam( $_REQUEST, 'TreeId', "");


if( $jscook_type == "tree" ) {
  
  if($jscookTree_style == "ThemeXP")
    $jscook_tree = "ctThemeXP1";
  if($jscookTree_style == "ThemeNavy")
    $jscook_tree = "ctThemeNavy";

  echo "
    <script language=\"JavaScript\" type=\"text/javascript\" src=\"components/com_phpshop/js/JSCookTree.js\"></script>
    <link rel=\"stylesheet\" href=\"components/com_phpshop/js/$jscookTree_style/theme.css\" type=\"text/css\" />
    <script language=\"JavaScript\" type=\"text/javascript\" src=\"components/com_phpshop/js/$jscookTree_style/theme.js\"></script>
    ";
  $MamboMart = new MamboMartTree();
}
else {

  echo "
    <script language=\"JavaScript\" type=\"text/javascript\" src=\"includes/js/JSCookMenu.js\"></script>
    <link rel=\"stylesheet\" href=\"includes/js/$jscookMenu_style/theme.css\" type=\"text/css\" />
    <script language=\"JavaScript\" type=\"text/javascript\" src=\"includes/js/$jscookMenu_style/theme.js\"></script>
    ";
  $MamboMart = new MamboMartMenu();
}
  
// create a unique tree identifier, in case multiple trees are used 
// (max one per module)
$varname = "JSCook_".uniqid( $jscook_type."_" );

$menu_htmlcode = "<div align=\"left\" class=\"mainlevel\" id=\"div_$varname\"></div>
<script type=\"text/javascript\"><!--
var $varname = 
[
";
$MamboMart->traverse_tree_down($menu_htmlcode);


$menu_htmlcode .= "];
";
if(  $jscook_type == "tree" ) {
  $menu_htmlcode .= "var treeindex = ctDraw ('div_$varname', $varname, $jscook_tree, '$jscookTree_style', 0, 0);";
}
else
  $menu_htmlcode .= "cmDraw ('div_$varname', $varname, '$menu_orientation', cm$jscookMenu_style, '$jscookMenu_style');";

$menu_htmlcode .="
--></script>\n";

if(  $jscook_type == "tree" ) {
  if( $TreeId ) {
    $menu_htmlcode .= "<input type=\"hidden\" id=\"TreeId\" name=\"TreeId\" value=\"$TreeId\" />\n";
    $menu_htmlcode .= "<script language=\"JavaScript\" type=\"text/javascript\">ctExposeTreeIndex( treeindex, parseInt(ctGetObject('TreeId').value));</script>\n";
  }
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
              $mymenu_content.= "]";
              
                
          }
        }
        else {
            
        }
      }
}
/************* END OF CATEGORY TREE ******************************
*********************************************************
*/
class MamboMartMenu {
    /***************************************************
    * function traverse_tree_down
    */
    function traverse_tree_down(&$mymenu_content, $category_id='0', $level='0') {
        static $ibg = 0;
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
          foreach ($categories as $category) {
            $itemid = isset($_REQUEST['itemid']) ? '&itemid='.$_REQUEST['itemid'] : "";
            if( $ibg != 0 )
              $mymenu_content.= ",";
              
            $mymenu_content.= "\n['<img src=\"$mosConfig_live_site/components/com_phpshop/js/ThemeXP/darrow.png\">','".$category->cname."','".sefRelToAbs('index.php?option=com_phpshop&page=shop.browse&category_id='.$category->cid.$itemid)."',null,'".$category->cname."'\n ";
            
            $ibg++;
                
            /* recurse through the subcategories */
            $this->traverse_tree_down($mymenu_content, $category->ccid, $level);
            
            /* let's see if the loop has reached its end */
            $mymenu_content.= "]";
                
          }
        }
        else {
            
        }
      }
}

?>
