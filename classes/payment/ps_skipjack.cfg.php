<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* @version $Id: ps_skipjack.cfg.php,v 1.1 2005/05/10 18:45:03 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage Payment
* @copyright (C) 2005 Matthew Schick
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net

* The ps_skipjack class, containing the payment processing code
*  for transactions with Skipjack.com
 */

define ('SKJ_TEST_REQUEST', 'FALSE');
define ('SKJ_SERIAL', '0000000000');
define ('SKJ_CHECK_CARD_CODE', 'NO');
define ('SKJ_VERIFIED_STATUS', 'P');
define ('SKJ_INVALID_STATUS', 'P');
define ('SKJ_RECURRING', 'NO');
?>
