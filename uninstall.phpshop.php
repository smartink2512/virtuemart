<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: COPYRIGHT.php 70 2005-09-15 20:45:51Z spacemonkey $
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_phpshop/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
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
