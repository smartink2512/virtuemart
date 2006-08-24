<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage themes
* @copyright Copyright (C) 2004-2006 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );

echo '<h2>'. $VM_LANG->_PHPSHOP_CART_TITLE .'</h2>
<!-- Cart Begins here -->
';
include(PAGEPATH. 'basket.php');

echo '<!-- End Cart --><br />
';

if ($cart["idx"]) {
    echo '<div align="center">';
    
    if( $continue_link != '') {
		?>
		 <a href="<?php echo $continue_link ?>" class="continue_link">
		 	<?php echo $VM_LANG->_PHPSHOP_CONTINUE_SHOPPING; ?>
		 </a>
		<?php
    }
        
   if (!defined('_MIN_POV_REACHED')) { ?>

       <span style="font-weight:bold;"><?php echo $VM_LANG->_PHPSHOP_CHECKOUT_ERR_MIN_POV2 . " ".$CURRENCY_DISPLAY->getFullValue($_SESSION['minimum_pov']) ?></span>
       <?php
   }
   else {
 		?>
     	<a href="<?php $sess->purl( $mm_action_url . "index.php?page=checkout.index&ssl_redirect=1"); ?>" class="checkout_link">
           <?php echo $VM_LANG->_PHPSHOP_CHECKOUT_TITLE ?>
     	</a> 
 		<?php
 	}
	?>
	</div>
	
	<?php
	// End if statement
}