<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* mambo-phphop Product Categories Module
* NOTE: THIS MODULE REQUIRES AN INSTALLED MAMBO-PHPSHOP COMPONENT!
*
* @version $Id: mod_product_categories.php,v 1.2 2005/09/04 20:09:34 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage modules
* 
* @copyright (C) 2004-2005 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

/* Get module parameters */
if( defined ("_RELEASE") ) {
  /* Mambo 4.5 1.0.9 Workaround */
  if( _RELEASE == '4.5' ) {
    $class_sfx = isset($params->class_sfx) ? $params->class_sfx : "";
    $menutype = isset($params->menutype) ? $params->menutype : "links";
    $jscookMenu_style = isset($params->jscookMenu_style) ? $params->jscookMenu_style : "ThemeOffice";
    $jscookTree_style = isset($params->jscookTree_style) ? $params->jscookTree_style : "ThemeXP";
    $jscook_type = isset($params->jscook_type) ? $params->jscook_type : "menu";
    $menu_orientation = isset($params->menu_orientation) ? $params->menu_orientation : "hbr";
    $_REQUEST['root_label'] = isset($params->root_label) ? $params->root_label : 'Shop';
  }
}
else {
  $class_sfx = $params->get( 'class_sfx', "" );
  $menutype = $params->get( 'menutype', "links" );
  $jscookMenu_style = $params->get( 'jscookMenu_style', 'ThemeOffice' );
  $jscookTree_style = $params->get( 'jscookTree_style', 'ThemeXP' );
  $jscook_type = $params->get( 'jscook_type', 'menu' );
  $menu_orientation = $params->get( 'menu_orientation', 'hbr' );
  $_REQUEST['root_label'] = $params->get( 'root_label', 'Shop' );
}
$class_mainlevel = "mainlevel".$class_sfx;

/* Load the phpshop main parse code */
require_once( $mosConfig_absolute_path.'/components/com_phpshop/phpshop_parser.php' );
require_once(CLASSPATH.'ps_product_category.php');

global $PHPSHOP_LANG, $sess;


/* MENUTPYE LINK LIST */
if ( $menutype == 'links' ) {

  // Show only top level categories and categories that are
  // being published
  $query  = "SELECT * FROM #__pshop_category, #__pshop_category_xref ";
  $query .= "WHERE #__pshop_category.category_publish='Y' AND ";
  $query .= "(#__pshop_category_xref.category_parent_id='' OR #__pshop_category_xref.category_parent_id='0') AND ";
  $query .= "#__pshop_category.category_id=#__pshop_category_xref.category_child_id ";
  $query .= "ORDER BY #__pshop_category.list_order, #__pshop_category.category_name ASC";
  
  // initialise the query in the $database connector
  // this translates the '#__' prefix into the real database prefix
  $database->setQuery( $query );

  if($database->getErrorNum()) {
	echo "MB ".$database->stderr(true);
	return;
  }
	
  // retrieve the list of returned records as an array of objects
  $rows = $database->loadObjectList();

  // cycle through the returned rows displaying them in a table
  // with links to the product category
  // escaping in and out of php is now permitted
?>
<table cellpadding="1" cellspacing="1" border="0" width="100%">
<?php
  foreach ($rows as $category) { ?>
  <tr>
	<td colspan="2">
	  <a class="<?php echo $class_mainlevel ?>" href="<?php echo $sess->url(URL."index.php?option=com_phpshop&amp;page=shop.browse&amp;category_id=$category->category_id"); ?>">
	  <?php 
		echo $category->category_name;
		echo ps_product_category::products_in_category( $category->category_id );
	  ?></a>
	</td>
  </tr><?php 
	/* Do we have a specific category for displaying subcategories? */
	if (!empty($_REQUEST['category_id'])) {
	  $ps_product_category = new ps_product_category;
				  
	  if ($_REQUEST['category_id'] == $category->category_id 
		&& $ps_product_category->has_childs($_REQUEST['category_id'])) { ?>
	  <tr>
		<td>&nbsp;</td>
		<td> 
		  <?php   
				  $ps_product_category->print_subcategory($_REQUEST['category_id']); 
	  ?> </td></tr> <?php
			  }
			}
			if (!empty($_REQUEST['root'])) {
			  require_once(CLASSPATH.'ps_product_category.php');
			  $ps_product_category = new ps_product_category;              
			  
			  if ($_REQUEST['root'] == $category->category_id && $ps_product_category->has_childs($_REQUEST['root']))  { 

			  ?>
	  <tr>
		<td>&nbsp;</td>
		<td><?php 
			require_once(CLASSPATH.'ps_product_category.php');
			$ps_product_category = new ps_product_category;
			$ps_product_category->print_subcategory($_REQUEST['root']); ?>
		</td>
	  </tr> <?php
			  }
		  } 
	  }
}  /** END LINK LIST **/
elseif( $menutype == "dtree" ) {
	/* dTree script to display structured categories */
	include( $mosConfig_absolute_path . '/modules/phpshop_dtree.php' );
  
}
elseif( $menutype == "jscook" ) {
	/* dTree script to display structured categories */
	include( $mosConfig_absolute_path . '/modules/phpshop_JSCook.php' );
  
}
?>
</table>