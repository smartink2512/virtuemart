<?php 
/**
* @version $Id: 2checkout_notify.php,v 1.1 2005/02/22 18:56:44 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage Payment
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*
* We need this file to redirect from 2Checkout 
* to our Order Confirmation Handler
*/
$_REQUEST['option'] = "com_phpshop";
$_REQUEST['page'] = "checkout.2Checkout_result";
$_REQUEST['Itemid'] = 1;
require_once("index.php");
?>
