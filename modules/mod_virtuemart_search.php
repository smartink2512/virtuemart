<?php
/**
* VirtueMart Search Module
* NOTE: THIS MODULE REQUIRES THE PHPSHOP COMPONENT FOR MOS!
*
* @version $Id$
* @package VirtueMart
* @subpackage modules
*
* @copyright (C) 2004 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* VirtueMart is Free Software.
* VirtueMart comes with absolute no warranty.
*
* www.virtuemart.net
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/* Load the virtuemart main parse code */
require_once( $mosConfig_absolute_path.'/components/com_virtuemart/virtuemart_parser.php' );

global $VM_LANG, $mm_action_url, $sess;

?>
<!--BEGIN Search Box --> 
<form action="<?php $sess->purl( $mm_action_url."index.php?page=shop.browse" ) ?>" method="post">

	<p><label for="keyword"><?php echo $VM_LANG->_('PHPSHOP_SEARCH_LBL') ?></label></p>
	<p>
		<input name="keyword" type="text" size="12" title="<?php echo $VM_LANG->_('PHPSHOP_SEARCH_TITLE') ?>" class="inputbox" id="keyword"  />
		<input class="button" type="submit" name="Search" value="<?php echo $VM_LANG->_('PHPSHOP_SEARCH_TITLE') ?>" />
	</p>
</form>
<!-- End Search Box --> 