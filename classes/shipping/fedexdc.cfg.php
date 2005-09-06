<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/*
* @version $Id: fedexdc.cfg.php,v 1.2 2005/01/27 19:33:59 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage Shipping
*
* @copyright (C) 2000 - 2004 devcompany.com  All rights reserved.
* @author Mike Wattier - geek@devcompany.com
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004 Soeren Eberhardt
*
* @license phpShop Public License (pSPL) Version 1.0
*
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
* 
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
