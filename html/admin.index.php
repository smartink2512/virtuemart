<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.index.php,v 1.1 2005/09/06 20:04:22 soeren_nb Exp $
* @package VirtueMart
* @subpackage HTML
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.virtuemart.org, forums.virtuemart.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* VirtueMart is Free Software.
* VirtueMart comes with absolute no warranty.
*
* www.virtuemart.net
*/
mm_showMyFileName( __FILE__ );
?>
<h2><?php echo _PHPSHOP_ADMIN_MOD ?></H2>
<A HREF="<?php $sess->purl($PHP_SELF ."?page=admin.show_cfg") ?>">
    <h5>Change / Show phpShop Configuration</h5></A>
<br />
<A HREF="<?php $sess->purl($PHP_SELF ."?page=store.store_form") ?>">
    <h5>Change / Show the Terms of Service for your shop</h5></A>
<br /><br />
<?php echo $module_description; ?>
