<?php
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.'); 
/**
*
* @version $Id: usps.cfg.php,v 1.2 2005/09/27 17:51:26 soeren_nb Exp $
* @package VirtueMart
* @subpackage shipping
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
define ('USPS_USERNAME', '171MAMBO0915');
define ('USPS_PASSWORD', '802UQ28ND045');
define ('USPS_SERVER', 'production.shippingapis.com');
define ('USPS_PATH', '/ShippingAPI.dll');
define ('USPS_CONTAINER', '0-1095');
define ('USPS_PACKAGESIZE', 'REGULAR');
define ('USPS_PACKAGEID', '0');
define ('USPS_SHIPSERVICE', 'Priority');
define ('USPS_HANDLINGFEE', '5');
define ('USPS_INTLLBRATE', '10');
define ('USPS_INTLHANDLINGFEE', '10');
?>