<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: checkout_bar.php,v 1.3 2005/01/27 19:34:01 soeren_nb Exp $
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
mm_showMyFileName( __FILE__ );

    /* First, here we have the checkout definitions
    * Tell me if we can do this less complicated 
    */
    if (CHECKOUT_STYLE == '1') {
    $steps_to_do = array(CHECK_OUT_GET_SHIPPING_ADDR, CHECK_OUT_GET_SHIPPING_METHOD, CHECK_OUT_GET_PAYMENT_METHOD, CHECK_OUT_GET_FINAL_CONFIRMATION);
    $step_msg = array($PHPSHOP_LANG->_PHPSHOP_ADD_SHIPTO_2,$PHPSHOP_LANG->_PHPSHOP_ISSHIP_LIST_CARRIER_LBL,$PHPSHOP_LANG->_PHPSHOP_ORDER_PRINT_PAYMENT_LBL, $PHPSHOP_LANG->_PHPSHOP_CHECKOUT_CONF_PAYINFO_COMPORDER);
    $step_count = 4;
    
    }
    elseif (CHECKOUT_STYLE == '2') {
    $steps_to_do = array(CHECK_OUT_GET_SHIPPING_ADDR, CHECK_OUT_GET_PAYMENT_METHOD, CHECK_OUT_GET_FINAL_CONFIRMATION);
    $step_msg = array($PHPSHOP_LANG->_PHPSHOP_ADD_SHIPTO_2, $PHPSHOP_LANG->_PHPSHOP_ORDER_PRINT_PAYMENT_LBL, $PHPSHOP_LANG->_PHPSHOP_CHECKOUT_CONF_PAYINFO_COMPORDER);
    $step_count = 3;
    
    }
    elseif (CHECKOUT_STYLE == '3') {
    $steps_to_do = array(CHECK_OUT_GET_SHIPPING_METHOD, CHECK_OUT_GET_PAYMENT_METHOD, CHECK_OUT_GET_FINAL_CONFIRMATION);
    $step_msg = array($PHPSHOP_LANG->_PHPSHOP_ISSHIP_LIST_CARRIER_LBL, $PHPSHOP_LANG->_PHPSHOP_ORDER_PRINT_PAYMENT_LBL, $PHPSHOP_LANG->_PHPSHOP_CHECKOUT_CONF_PAYINFO_COMPORDER);
    $step_count = 3;
    
    }
    elseif (CHECKOUT_STYLE == '4') {
    $steps_to_do = array(CHECK_OUT_GET_PAYMENT_METHOD, CHECK_OUT_GET_FINAL_CONFIRMATION);
    $step_msg = array($PHPSHOP_LANG->_PHPSHOP_ORDER_PRINT_PAYMENT_LBL, $PHPSHOP_LANG->_PHPSHOP_CHECKOUT_CONF_PAYINFO_COMPORDER);
    $step_count = 2;
    
    }
    if (empty($checkout_this_step))
      $checkout_this_step='';
      
    switch ($checkout_this_step) {
      case CHECK_OUT_GET_SHIPPING_ADDR: 
          $highlighted_step = 1; 
          break;
          
      case CHECK_OUT_GET_SHIPPING_METHOD: 
          if (NO_SHIPTO != '1')
            $highlighted_step = 2; 
          else
            $highlighted_step = 1; 
          break;
          
      case CHECK_OUT_GET_PAYMENT_METHOD: 
          if (CHECKOUT_STYLE == '4') 
              $highlighted_step = 1; 
          elseif (NO_SHIPPING == '1' || NO_SHIPTO == '1' || CHECKOUT_STYLE == '2') 
              $highlighted_step = 2; 
          else 
              $highlighted_step =3; 
          break;
          
      case CHECK_OUT_GET_FINAL_CONFIRMATION: 
          if (CHECKOUT_STYLE == '4') 
              $highlighted_step = 2; 
          elseif (NO_SHIPPING == '1' || NO_SHIPTO == '1' || CHECKOUT_STYLE == '2') 
              $highlighted_step =3; 
          else 
              $highlighted_step =4; 
          break;
          
      default: 
          $highlighted_step = 1; 
          break;
    }
    ps_checkout::show_checkout_bar($steps_to_do, $step_msg, $step_count, $highlighted_step);
    
?>
