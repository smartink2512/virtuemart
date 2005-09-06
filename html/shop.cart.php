<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shop.cart.php,v 1.10 2005/06/23 18:59:16 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.phpshop.org, forums.phpshop.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );
if( isset($_VERSION)) {
 $mainframe->setPageTitle( $PHPSHOP_LANG->_PHPSHOP_CART_TITLE );
}
$show_basket = true;

?>
<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_CART_TITLE ?></h2>
<!-- Cart Begins here -->
<?php include(PAGEPATH. 'basket.php'); ?>
<!-- End Cart -->
<?php
if ($cart["idx"]) {
 ?>
 <br />
 <div style="text-align:center;width:40%;float:left;">
     <h3><a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
     <img src="<?php echo IMAGEURL ?>ps_image/back.png" align="middle" width="32" height="32" alt="Back" border="0" />
      <?php echo $PHPSHOP_LANG->_PHPSHOP_CONTINUE_SHOPPING; ?>
     </a></h3>
 </div>
 <?php
   if (!defined('_MIN_POV_REACHED')) { ?>
       <div style="text-align:center;width:40%;float:left;">
       <br /><br />
           <span style="font-weight:bold;"><?php echo $PHPSHOP_LANG->_PHPSHOP_CHECKOUT_ERR_MIN_POV2 . " ".$CURRENCY_DISPLAY->getFullValue($_SESSION['minimum_pov']) ?></span>
       </div><?php
   }
   else {
 ?>
 <div style="text-align:center;width:40%;float:left;">
     <h3><a href="<?php $sess->purl( $mm_action_url . "index.php?page=checkout.index&ssl_redirect=1"); ?>">
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/forward.png" align="middle" width="32" height="32" alt="Forward" border="0" />
      <?php echo $PHPSHOP_LANG->_PHPSHOP_CHECKOUT_TITLE ?>
     </a></h3>
 </div>
 
 <?php
 }
 ?>
<br style="clear:both;" /><br/>

<?php
// End if statement
}
?>

