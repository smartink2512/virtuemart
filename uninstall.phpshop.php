<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: uninstall.phpshop.php,v 1.5 2005/05/12 22:21:39 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage Core
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

function com_uninstall() {
  global $database;
  
  // This is the function which is called on Uninstall after the component files
  // have been removed and all tables for mambo-phpShop that are contained
  // in the phpshop.xml file have been removed.
  // But what if we can't predict the number of tables?
  // e.g.: For each new Product Type we dynamically create one new Table.
  // So let's remove those tables (if there).
  $database->setQuery( "SELECT product_type_id FROM #__pshop_product_type" );
  $tables = $database->loadObjectList();
  if( !empty( $tables )) {
	foreach( $tables as $table ) {
	  $database->setQuery( "DROP TABLE IF EXISTS `#__pshop_product_type_". $table->product_type_id . "`" );
	  $database->query();
	}
  }
  
}

?>
