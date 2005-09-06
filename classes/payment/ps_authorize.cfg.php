<?php
/**
* @version $Id: ps_authorize.cfg.php,v 1.6 2005/02/22 18:56:57 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage Payment
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
define ('AN_TEST_REQUEST', 'true');
define ('AN_LOGIN', 'dgi00000');
define ('AN_TYPE', 'AUTH_CAPTURE');
define ('AN_CHECK_CARD_CODE', 'NO');
define ('AN_VERIFIED_STATUS', 'P');
define ('AN_INVALID_STATUS', 'P');
define ('AN_RECURRING', 'NO');
?>
