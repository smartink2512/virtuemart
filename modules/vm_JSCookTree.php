<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* VirtueMart JSCookTree menu
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ JSCookTree VirtueMart menu created by Soeren
* @ modified by soeren
* @ Uses JSCookTree Javascript: http://www.cs.ucla.edu/~heng/JSCookTree/
* @ version $Id$
*
* This file is included by the virtuemart module if the module parameter
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
<script language=\"JavaScript\" type=\"text/javascript\" src=\"components/com_virtuemart/js/JSCookTree.js\"></script>
<link rel=\"stylesheet\" href=\"components/com_virtuemart/js/$jscook_theme/theme.css\" type=\"text/css\" />
<script language=\"JavaScript\" type=\"text/javascript\" src=\"components/com_virtuemart/js/$jscook_theme/theme.js\"></script>
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
        global $db, $module, $mosConfig_live_site;
        $level++;
        $query = "SELECT category_name, category_id, category_child_id "
        . "FROM #__{vm}_category as a, #__{vm}_category_xref as b "
         . "WHERE a.category_publish='Y' AND "
         . " b.category_parent_id='$category_id' AND a.category_id=b.category_child_id "
         . "ORDER BY category_parent_id, list_order, category_name ASC";
        $db->query( $query );
        
        if( !( $db->num_rows() < 1 ) ) {
			$i = 1;
			while( $db->next_record() ) {
				$ibg++;
				$Treeid = $ibg == 0 ? 1 : $ibg;
				$itemid = isset($_REQUEST['itemid']) ? '&itemid='.$_REQUEST['itemid'] : "";
				$mymenu_content.= ",\n[null,'".$db->f("category_name");
				$mymenu_content.= ps_product_category::products_in_category( $db->f("category_id") );
				$mymenu_content.= "','".sefRelToAbs('index.php?option=com_virtuemart&page=shop.browse&category_id='.$db->f("category_id").$itemid."&TreeId=$Treeid")."','_self','".$db->f("category_name")."'\n ";
                
				/* recurse through the subcategories */
				$this->traverse_tree_down($mymenu_content, $db->f("category_child_id"), $level);
              
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
