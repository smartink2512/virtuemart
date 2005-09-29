<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: fedexdc.cfg.php,v 1.2 2005/09/27 17:51:26 soeren_nb Exp $
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
define('FEDEX_URI', 'https://gatewaybeta.fedex.com/GatewayDC', true);
define('FEDEX_HOST', 'gatewaybeta.fedex.com', true);
define('FEDEX_REQUEST_REFERER', $mosConfig_live_site, true);
define('FEDEX_REQUEST_TIMEOUT', 20, true);
define('FEDEX_REQUEST_TYPE', 'CURL', true);
define('FEDEX_ACCOUNT_NUMBER', '289176063' );
define('FEDEX_METER_NUMBER', '1041490'); 
define('FEDEX_IMG_DIR', '/tmp/');  
define( 'FEDEX_DEFAULT_RATE', 35.00);
define('ZW_FEDEX_ENABLE', 1);


define('FEDEX_SENDER_COMPANY', 'fillmeout');
// sender address 1
define('FEDEX_SENDER_ADDRESS', 'fillmeout');
// sender city
define('FEDEX_SENDER_CITY', 'fillmeout');
// sender state
define('FEDEX_SENDER_STATE', 'fillmeout');
// sender zip
define('FEDEX_SENDER_ZIP', 'fillmeout');
// sender country code
define('FEDEX_SENDER_COUNTRY', 'fillmeout');
// sender phone number
define('FEDEX_SENDER_PHONE', 'fillmeout');
?>
