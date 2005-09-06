<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: toolbar.phpshop.php,v 1.5 2005/09/01 19:58:06 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage Core
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/

define( '_PSHOP_ADMIN', '1' );

if (!file_exists( $mosConfig_absolute_path.'/administrator/components/com_phpshop/install.php' )) {
    // We parse the phpShop main code before loading the toolbar,
    // for we can catch errors and adjust the toolbar when
    // the admin has to stay on a site or is redirected back on error
    require_once( $mosConfig_absolute_path."/components/com_phpshop/phpshop_parser.php");
}

require_once( $mainframe->getPath( 'toolbar_html' ) );


if (!isset($page))
    $page = "";
    
if ($page == "admin.user_list" || $page == "store.user_list") {
  if (!empty($_REQUEST['task']))
      $task = $_REQUEST['task'];
  else
      $task = '';
  switch ( $task ) {

    case "edit":
      MENU_phpshop::_EDIT_USERS();
      break;
  
    case "new":
      MENU_phpshop::_NEW_USERS();
      break;
  
    default:
      MENU_phpshop::_DEFAULT_USERS();
      break;
  }
}
else {

    if ( $page == "admin.show_cfg" || $page == "affiliate.affiliate_add" || stristr($page, "form")) {
        $editor1_array = Array('product.product_form' => 'product_desc', 'shopper.shopper_group_form' => 'shopper_group_desc',
                                          'product.product_category_form' => 'category_description', 'manufacturer.manufacturer_form' => 'mf_desc',
                                          'store.store_form' => 'vendor_store_desc',
                                          'product.product_type_parameter_form' => 'parameter_description',
                                          'product.product_type_form' => 'product_type_description',
                                          'vendor.vendor_form' => 'vendor_store_desc');
        $editor2_array = Array('store.store_form' => 'vendor_terms_of_service',
                                          'vendor.vendor_form' => 'vendor_terms_of_service');
       MENU_phpshop::DEFAULT_MENU(isset($editor1_array[$page]) ? $editor1_array[$page] : '', isset($editor2_array[$page]) ? $editor2_array[$page] : '');
    }
    
    elseif ( ($page != "isshipping.ISship_list") && ($page != "affiliate.shopper_list")  && (stristr($page,"list") && $page != "order.order_list"))
        MENU_phpshop::MENU_NEW();
}

?>
