<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: version.php,v 1.22 2005/06/22 19:50:38 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

/** Version information */
class phpShopversion {
	/** @var string Product */
	var $PRODUCT = 'mambo-phpShop';
	/** @var int Main Release Level */
	var $RELEASE = '1.2.1';
	/** @var string Development Status */
	var $DEV_STATUS = 'beta';
	/** @var int Sub Release Level */
	var $PATCH_LEVEL = '0';
	/** @var string Codename */
	var $CODENAME = 'Big Bill Broonzy';
	/** @var string Date */
	var $RELDATE = '14/09/2005';
	/** @var string Time */
	var $RELTIME = '18:23';
	/** @var string Timezone */
	var $RELTZ = 'GMT';
	/** @var string Copyright Text */
	var $COPYRIGHT = 'Copyright (C) 2005 Soeren Eberhardt. All rights reserved.'; 
	/** @var string URL */
	var $URL = '<a href="http://mambo-phpshop.net">mambo-phpShop</a> is a Free Component for Mambo released under the GNU/GPL License.';
}
$PHPSHOPVERSION =& new phpShopversion();

$version = $PHPSHOPVERSION->PRODUCT . " " . $PHPSHOPVERSION->RELEASE . " " . $PHPSHOPVERSION->DEV_STATUS. " ". $PHPSHOPVERSION->PATCH_LEVEL . " "

. " [".$PHPSHOPVERSION->CODENAME ."] <br />" . $PHPSHOPVERSION->RELDATE . " "
. $PHPSHOPVERSION->RELTIME . " " . $PHPSHOPVERSION->RELTZ;
?>
