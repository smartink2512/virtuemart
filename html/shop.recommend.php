<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: shop.recommend.php
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2006 Alatis GmbH & Co. KG. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );

$product_id = mosgetparam( $_REQUEST, 'product_id', null);

include_once(CLASSPATH.'ps_recommend.php');
$ps_recommend = new ps_recommend;

echo '<h3>'.$VM_LANG->_PHPSHOP_RECOMMEND_TITLE.'</h3>';

$ps_recommend->show_form($product_id);


?>