<?php
/**
* VirtueMart Search Bot
* @version 1.0
* @package VirtueMart
* @copyright (C) Copyright 2004-2005 by Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/** Register search function inside Mambo's API */
$_MAMBOTS->registerFunction( 'onSearch', 'botSearchVM' );

/**
* Search method
*
* The sql must return the following fields that are used in a common display
* routine: href, title, section, created, text, browsernav
*/
function botSearchVM( $text, $phrase='', $ordering='' ) {
  global $database;
  $text = trim( $text );
  if ($text == '') {
    return array();
  }
	$wheres = array();
	switch ($phrase) {
		case 'exact':
			$wheres2 = array();
			$wheres2[] = "LOWER(product_name) LIKE '%$text%'";
			$wheres2[] = "LOWER(product_sku) LIKE '%$text%'";
			$wheres2[] = "LOWER(product_desc) LIKE '%$text%'";
			$wheres2[] = "LOWER(product_s_desc) LIKE '%$text%'";
			$wheres2[] = "LOWER(product_url) LIKE '%$text%'";
			$where = '(' . implode( ') OR (', $wheres2 ) . ')';
			break;
		case 'all':
		case 'any':
		default:
			$words = explode( ' ', $text );
			$wheres = array();
			foreach ($words as $word) {
				$wheres2 = array();
				$wheres2[] = "LOWER(product_name) LIKE '%$text%'";
				$wheres2[] = "LOWER(product_sku) LIKE '%$text%'";
				$wheres2[] = "LOWER(product_desc) LIKE '%$text%'";
				$wheres2[] = "LOWER(product_s_desc) LIKE '%$text%'";
				$wheres2[] = "LOWER(product_url) LIKE '%$text%'";
				$wheres[] = implode( ' OR ', $wheres2 );
			}
			$where = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
			break;
	}

	switch ($ordering) {
		case 'newest':
		default:
			$order = 'cdate DESC';
			break;
		case 'oldest':
			$order = 'cdate ASC';
			break;
		case 'popular':
			$order = '';
			break;
		case 'alpha':
			$order = 'product_name ASC';
			break;
		case 'category':
			$order = '';
			break;
	}
  
  $database->setQuery( " SELECT id, name FROM  `#__menu` WHERE link LIKE '%com_virtuemart%' AND published=1");
  $database->loadObject( $Item );
  $ItemName = !empty( $Item->name ) ? $Item->name : "Shop";
  $Itemid = !empty( $Item->id ) ? $Item->id : "1";
  
  $query = "SELECT product_name as title,"
               . "\n    FROM_UNIXTIME( cdate, '%Y-%m-%d %H:%i:%s'  ) AS created," 
               . "\n    product_s_desc AS text,"
               . "\n    '$ItemName' as section,"
               . "\n    CONCAT('index.php?option=com_virtuemart&page=shop.product_details&flypage=shop.flypage&product_id=', product_id, '&Itemid=".$Itemid."' ) as href,"
               . "\n    '2' as browsernav"
               . "\n FROM #__vm_product"
               . "\n WHERE $where"
			   . "\n AND (product_parent_id='' OR product_parent_id='0')"
			   . "\n AND product_publish='Y'"
               . "\n ORDER BY $order" ;
               
  $database->setQuery( $query );

  $row = $database->loadObjectList();
  return $row;
}

?>
