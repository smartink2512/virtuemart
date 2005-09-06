<?php
/**
* mambo-phpShop Search Module
* NOTE: THIS MODULE REQUIRES THE PHPSHOP COMPONENT FOR MOS!
*
* @version $Id: mod_phpshop_search.php,v 1.6 2005/06/13 20:49:01 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage modules
*
* @copyright (C) 2004 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/* Load the phpshop main parse code */
require_once( $mosConfig_absolute_path.'/components/com_phpshop/phpshop_parser.php' );

global $PHPSHOP_LANG, $mm_action_url;

?>
<table cellpadding="1" cellspacing="1" border="0" width="100%">
  <!--BEGIN Search Box --> 
  <tr> 
    <td colspan="2"><hr>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCTS_LBL." ".$PHPSHOP_LANG->_PHPSHOP_SEARCH_TITLE ?></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr> 
    <td colspan="2">
      <form action="<?php echo $mm_action_url."index.php" ?>" method="get" />
        <input title="<?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_TITLE ?>" class="inputbox" type="text" size="12" name="keyword" />
        <input class="button" type="Submit" name="Search" value="<?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_TITLE ?>" />
        <hr>
    </td>
  </tr>
    <input type="hidden" name="Itemid" value="<?php echo intval(@$_REQUEST['Itemid']) ?>" />
    <input type="hidden" name="option" value="com_phpshop" />
    <input type="hidden" name="page" value="shop.browse" />
  </form>
  <!-- End Search Box --> 
</table>

