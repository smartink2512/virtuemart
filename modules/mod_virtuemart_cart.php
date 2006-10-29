<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* VirtueMart MiniCart Module
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

/* Load the virtuemart main parse code */
require_once( $mosConfig_absolute_path.'/components/com_virtuemart/virtuemart_parser.php' );

global $VM_LANG, $sess, $mm_action_url;
        //$_SESSION['cart_module_active'] = true;
        $_SESSION['vmShowQuantity'] = $params->get( 'vmShowQuantity' );
        $_SESSION['vmShowName'] = $params->get( 'vmShowName' );
        $_SESSION['vmShowAttrib'] = $params->get( 'vmShowAttrib' );
        $_SESSION['vmShowPrice'] = $params->get( 'vmShowPrice' );
        $_SESSION['vmShowEmptyCart'] = $params->get( 'vmShowEmptyCart');
        $_SESSION['vmEnableEmptyCart'] = $params->get( 'vmEnableEmptyCart');
        $_SESSION['vmShowLogo'] = $params->get( 'vmShowLogo');
        $_SESSION['vmAlignPrice'] = $params->get( 'vmAlignPrice');
        include (PAGEPATH.'shop.basket_short.php') ; 
?>
           


        
        
        
        
 

    
