<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage themes
* @copyright Copyright (C) 2007 Soeren Eberhardt. All rights reserved.
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

if( $ok ) {
	echo '<h3>'.$VM_LANG->_PHPSHOP_WAITING_LIST_THANKS.'</h3>';
}
?>
<br />
<br />
<?php 
  	echo '<a class="previous_page" href="'.$sess->url( $_SERVER['PHP_SELF']."?page=shop.product_details&product_id=$product_id" ). '">'
      . $VM_LANG->_PHPSHOP_BACK_TO_DETAILS.'</a>';
?> 
