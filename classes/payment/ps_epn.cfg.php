<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* @version $Id: ps_epn.cfg.php,v 1.3 2005/02/22 18:57:09 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage Payment
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net

* The ps_authorize class, containing the payment processing code
*  for transactions with eProcessingNetwork.com 
 */

define ('EPN_TEST_REQUEST', 'FALSE');
define ('EPN_LOGIN', '0803276');
define ('EPN_TYPE', 'AUTH_CAPTURE');
define ('EPN_CHECK_CARD_CODE', 'NO');
define ('EPN_VERIFIED_STATUS', 'P');
define ('EPN_INVALID_STATUS', 'P');
define ('EPN_RECURRING', 'NO');
?>
