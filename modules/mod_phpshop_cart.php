<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* mambo-phpShop MiniCart Module
*
* @version $Id: mod_phpshop_cart.php,v 1.7 2005/06/14 19:10:57 soeren_nb Exp $
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

/* Load the phpshop main parse code */
require_once( $mosConfig_absolute_path.'/components/com_phpshop/phpshop_parser.php' );

global $PHPSHOP_LANG, $sess, $mm_action_url;

?><table width="100%">
        <tr>
            <td>
                <a class="mainlevel" href="<?php echo $sess->url($mm_action_url."index.php?page=shop.cart")?>">
                <?php echo $PHPSHOP_LANG->_PHPSHOP_CART_SHOW ?></a>
            </td>
        </tr>
        <tr>
            <td><?php include (PAGEPATH.'shop.basket_short.php') ?></td>
        </tr>
    </table>
