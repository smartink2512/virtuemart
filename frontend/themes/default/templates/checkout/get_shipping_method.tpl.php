<?php
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version $Id: get_shipping_method.tpl.php 1760 2009-05-03 22:58:57Z Aravot $
* @package JMart
* @subpackage templates
* @copyright Copyright (C) 2007-2008 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* JMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_jmart/COPYRIGHT.php for copyright notices and details.
*
* http://joomlacode.org/gf/project/jmart/
*/

ps_checkout::show_checkout_bar();

echo $basket_html;

echo '<br />';
$varname = 'JM_CHECKOUT_MSG_' . CHECK_OUT_GET_SHIPPING_METHOD;
echo '<h4>'. JText::_($varname) . '</h4>';

ps_checkout::list_shipping_methods($ship_to_info_id, $shipping_rate_id );

?>
