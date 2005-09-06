<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: toolbar.phpshop.html.php,v 1.15 2005/09/01 19:58:06 soeren_nb Exp $
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
$_REQUEST['keyword'] = urldecode(mosgetparam($_REQUEST, 'keyword', 0));
$keyword = $_REQUEST['keyword'];

class MENU_phpshop {

    function DEFAULT_MENU($editor1='', $editor2='') {       
        global $mosConfig_absolute_path,$mosConfig_live_site, $mosConfig_lang, $PHPSHOP_LANG, $page;
        global $mosConfig_editor;
        
        ?>
        <script type="text/javascript">
        	function submitbutton(pressbutton) {
            var form = document.adminForm;
            if (pressbutton == 'cancel') {
              submitform( pressbutton );
              return;
            }
              <?php 
              if ($editor1 != '')
                getEditorContents( 'editor1', $editor1 ) ; ?>
              <?php
              if ($editor2 != '')
                getEditorContents( 'editor2', $editor2 ) ; ?>
              submitform( pressbutton );
  
          }
          </script>
          <?php
            mosMenuBar::startTable();
            $product_parent_id = mosGetParam( $_REQUEST, 'product_parent_id', 0 );
            if ($page == "product.product_form" && !empty($_REQUEST['product_id'])) {
              if( empty($product_parent_id) ) { ?>
              <td><a class="toolbar" href="index2.php?option=com_phpshop&page=product.product_attribute_form&product_id=<?php echo $_REQUEST['product_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new1','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="new" name="new1" align="middle" border="0"/>&nbsp;<?php echo $PHPSHOP_LANG->_PHPSHOP_ATTRIBUTE_FORM_MNU ?></a></td>
              <?php 
              }
              else {  
                ?>
              <td><a class="toolbar" href="index2.php?option=com_phpshop&page=product.product_form&product_id=<?php echo $product_parent_id ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new1','','<?php echo $mosConfig_live_site ?>/administrator/images/back_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/back.png" alt="new" name="new1" align="middle" border="0"/>&nbsp;<?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_RETURN_LBL ?></a></td>
              <td><a class="toolbar" href="index2.php?option=com_phpshop&page=product.product_form&product_parent_id=<?php echo $product_parent_id ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new2','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="new" name="new2" align="middle" border="0"/>&nbsp;<?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_ADD_ANOTHER_ITEM_MNU ?></a></td>
              <?php
              } ?>
              <td><a class="toolbar" href="index2.php?page=product.product_price_list&product_id=<?php echo $_REQUEST['product_id'] ?>&product_parent_id=<?php echo @$product_parent_id ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>&return_args=&option=com_phpshop" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new3','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="new" name="new3" align="middle" border="0"/>&nbsp;<?php echo $PHPSHOP_LANG->_PHPSHOP_PRICE_LIST_MNU ?></a></td>
              <td><a class="toolbar" href="index2.php?option=com_phpshop&page=product.product_product_type_form&product_id=<?php echo $_REQUEST['product_id'] ?>&product_parent_id=<?php echo @$product_parent_id ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new5','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="new" name="new5" align="middle" border="0"/>&nbsp;<?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_MNU ?></a></td>
          <?php
              /*** Adding an item is only pssible, if the product has attributes ***/
              if (ps_product::product_has_attributes( $_REQUEST['product_id'] ) ) { ?>
                <td><a class="toolbar" href="index2.php?option=com_phpshop&page=product.product_form&product_parent_id=<?php echo $_REQUEST['product_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new4','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="new" name="new4" align="middle" border="0"/>&nbsp;<?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_NEW_ITEM_LBL ?></a></td>
  <?php       }
              mosMenuBar::divider();
            }
            elseif( $page == "admin.country_form" ) {
            ?>
              <td><a class="toolbar" href="<?php $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=admin.country_state_form&country_id=<?php echo $_REQUEST['country_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new1','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="new" name="new1" align="middle" border="0"/>
              &nbsp;Add a State</a></td>
              <td><a class="toolbar" href="<?php $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=admin.country_state_list&country_id=<?php echo $_REQUEST['country_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new1','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="new" name="new1" align="middle" border="0"/>
              &nbsp;List States</a></td>
              <?php 
              mosMenuBar::divider();
            }
            // mosMenuBar::save(), but internationalized ?>
            <td><a class="toolbar" href="javascript:submitbutton('save');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('save','','<?php echo $mosConfig_live_site ?>/administrator/images/save_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/save.png" alt="Save" border="0" name="save" align="middle" />&nbsp;<?php echo _E_SAVE ?></a></td>
            <?php
              
            if ($page == "admin.curr_form" && !empty($_REQUEST['currency_id'])) {
                $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=currencyDelete&currency_id=<?php echo $_REQUEST['currency_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            elseif ($page == "admin.country_form" && !empty($_REQUEST['country_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=countryDelete&country_id=<?php echo $_REQUEST['country_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            elseif ($page == "admin.country_state_form" && !empty($_REQUEST['state_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=stateDelete&state_id=<?php echo $_REQUEST['state_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            elseif ($page == "admin.module_form" && !empty($_REQUEST['module_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=moduleDelete&module_id=<?php echo $_REQUEST['module_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
        
            
            elseif ($page == "admin.function_form" && !empty($_REQUEST['function_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=functionDelete&function_id=<?php echo $_REQUEST['function_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            elseif ($page == "admin.user_address_form" && !empty($_REQUEST['user_info_id'])) {
                    $my_page = "admin.user_list";
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=userAddressDelete&user_info_id=<?php echo $_REQUEST['user_info_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>&cid[0]=<?php echo $_REQUEST['cid'][0] ?>&task=edit" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            elseif ($page == "affiliate.affiliate_form" && !empty($_REQUEST['affiliate_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=affiliateDelete&affiliate_id=<?php echo $_REQUEST['affiliate_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            elseif ($page == "vendor.vendor_form" && !empty($_REQUEST['vendor_id']) && $_REQUEST['vendor_id'] != '1') {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=vendorDelete&vendor_id=<?php echo $_REQUEST['vendor_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            
            elseif ($page == "vendor.vendor_category_form" && !empty($_REQUEST['vendor_category_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=vendorCategoryDelete&vendor_category_id=<?php echo $_REQUEST['vendor_category_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            elseif ($page == "store.payment_method_form" && !empty($_REQUEST['payment_method_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=paymentMethodDelete&payment_method_id=<?php echo $_REQUEST['payment_method_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            
            elseif ($page == "store.user_form" && !empty($_REQUEST['user_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=userDelete&user_id=<?php echo $_REQUEST['user_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            
            elseif ($page == "tax.tax_form" && !empty($_REQUEST['tax_rate_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=deleteTaxRate&tax_rate_id=<?php echo $_REQUEST['tax_rate_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            
            elseif ($page == "zone.zone_form" && !empty($_REQUEST['zone_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=deletezone&zone_id=<?php echo $_REQUEST['zone_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            
            elseif ($page == "product.product_form" && !empty($_REQUEST['product_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=productDelete&product_id=<?php echo $_REQUEST['product_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>
      <?php
            }
            
            
            elseif ($page == "product.product_category_form" && !empty($_REQUEST['category_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=productCategoryDelete&category_id=<?php echo $_REQUEST['category_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
           elseif ($page == "product.product_price_form" && !empty($_REQUEST['product_price_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=productPriceDelete&product_id=<?php echo $_REQUEST['product_id'] ?>&product_parent_id=<?php echo $product_parent_id ?>&product_price_id=<?php echo $_REQUEST['product_price_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            elseif ($page == "order.order_status_form" && !empty($_REQUEST['order_status_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=OrderStatusDelete&order_status_id=<?php echo $_REQUEST['order_status_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            
            elseif ($page == "shopper.shopper_form" && !empty($_REQUEST['user_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=userDelete&user_id=<?php echo $_REQUEST['user_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            
            elseif ($page == "shopper.shopper_group_form" && !empty($_REQUEST['shopper_group_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=shopperGroupDelete&shopper_group_id=<?php echo $_REQUEST['shopper_group_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            
            elseif ($page == "isshipping.ISship_form" && !empty($_REQUEST['ship_method_id'])) {
                    $my_page = str_replace('form','list',$page);
            ?>
		<td><a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&func=shipDelete&ship_method_id=<?php echo $_REQUEST['ship_method_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onclick="return confirm('<?php echo $PHPSHOP_LANG->_PHPSHOP_DELETE_MSG ?>');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('delete','','<?php echo $mosConfig_live_site ?>/administrator/images/delete_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/delete.png" alt="Remove" name="delete" align="middle" border="0"/>&nbsp;<?php echo _E_REMOVE ?></a></td>

            <?php	}
            
            if(empty($my_page)) {
                if ($page == "store.store_form")
                    $my_page = "store.index";
                elseif ($page == "admin.user_address_form")
                    $my_page = "admin.user_list";
                else
                    $my_page = str_replace('form','list',$page);
            }
            if ($page == "admin.show_cfg")
                    $my_page = "store.index";
            
            // mosMenuBar::back()  
            $limitstart = "&limitstart=";
            if(!empty($_REQUEST['offset']) && !($_REQUEST['offset'] % SEARCH_ROWS))
                $limitstart .= $_REQUEST['offset'];
            else if(!empty($_REQUEST['limitstart']))
                $limitstart .= $_REQUEST['limitstart'];
            if( $page=="admin.country_state_form") $limitstart .= "&country_id=".$_REQUEST['country_id'];
            ?>
            <td>
            <a class="toolbar" href="index2.php?option=com_phpshop&page=<?php echo $my_page ?>&task=cancel&keyword=<?php echo !empty($_REQUEST['keyword']) ? $_REQUEST['keyword'] : ""; echo $limitstart; echo !empty($_REQUEST['product_id']) ? "&product_id=".$_REQUEST['product_id'] : "";
           echo !empty($_REQUEST['product_type_id']) ? "&product_type_id=".$_REQUEST['product_type_id'] : ""; // Changed Product Type
		   echo !empty($product_parent_id) ? "&product_parent_id=".$product_parent_id : "";
	    ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('cancel','','<?php echo $mosConfig_live_site ?>/administrator/images/cancel_f2.png',1);">
            <img src="<?php echo $mosConfig_live_site ?>/administrator/images/cancel.png" alt="Back" border="0" name="cancel" align="middle" />
            &nbsp;<?php echo _E_CANCEL ?></a></td>
            <?php
            
            mosMenuBar::spacer();
            mosMenuBar::endTable();
    }
    
    function MENU_NEW() {
        global $page, $mosConfig_live_site, $PHPSHOP_LANG;
        mosMenuBar::startTable();
        $product_parent_id = mosGetParam( $_REQUEST, 'product_parent_id', 0 );
        
        $my_page = str_replace('list','form',$page);
        if ($page == 'product.product_attribute_list') {
?>
        <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&product_id=<?php echo $_REQUEST['product_id'] ?>&return_args=<?php echo isset($_REQUEST['return_args']) ? $_REQUEST['return_args'] : "" ?>&page=<?php echo $my_page ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="Create a new item" name="new" align="middle" border="0"/>
            &nbsp;<?php echo _CMN_NEW ?>
        </a>
        </td>
<?php
        }
        elseif ($page == 'product.product_price_list') {
        
?>
        <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&product_id=<?php echo $_REQUEST['product_id'];
		echo !empty($product_parent_id) ? "&product_parent_id=".$product_parent_id : "";
		?>&return_args=<?php echo isset($_REQUEST['return_args']) ? $_REQUEST['return_args'] : "" ?>&page=<?php echo $my_page ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="Create a new item" name="new" align="middle" border="0"/>
            &nbsp;<?php echo _CMN_NEW ?>
        </a>
        </td>
<?php     
        }
        elseif ($page == 'admin.function_list') {
        
?>
        <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&module_id=<?php echo $_REQUEST['module_id'] ?>&page=<?php echo $my_page ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="Create a new item" name="new" align="middle" border="0"/>
            &nbsp;<?php echo _CMN_NEW ?>
        </a>
        </td>
<?php     
        }
        elseif ($page == 'admin.country_state_list') {
        
?>          
        <td><a class="toolbar" href="<?php $_SERVER['PHP_SELF'] ?>?option=com_phpshop&page=admin.country_form&country_id=<?php echo $_REQUEST['country_id'] ?>&limitstart=<?php echo @$_REQUEST['limitstart'] ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('back1','','<?php echo $mosConfig_live_site ?>/administrator/images/back_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/back.png" alt="new" name="back1" align="middle" border="0"/>
              &nbsp;Back to the country</a></td>
              <?php 
              mosMenuBar::divider();
              ?>
        <td>
                <a class="toolbar" href="index2.php?option=com_phpshop&country_id=<?php echo $_REQUEST['country_id'] ?>&page=<?php echo $my_page ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="Create a new item" name="new" align="middle" border="0"/>
                    &nbsp;<?php echo _CMN_NEW ?>
                </a>
        </td>
<?php     
        }
        elseif ($page == 'product.file_list') {
        
        ?>        
        <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&product_id=<?php echo $_REQUEST['product_id'] ?>&page=<?php echo $my_page ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="Create a new item" name="new" align="middle" border="0"/>
            &nbsp;<?php echo _CMN_NEW ?>
        </a>
        </td>
        <?php mosMenuBar::divider(); ?>
        <td><a class="toolbar" href="index2.php?option=com_phpshop&page=product.filemanager" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new1','','<?php echo $mosConfig_live_site ?>/administrator/images/back_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/back.png" alt="new" name="new1" align="middle" border="0"/>&nbsp;Back to FileManager</a></td>
<?php     
        }
         elseif ($page == 'product.product_type_parameter_list') {
        
?>
        <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&product_type_id=<?php echo $_REQUEST['product_type_id'] ?>&page=<?php echo $my_page ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="Create a new item" name="new" align="middle" border="0"/>
            &nbsp;<?php echo _CMN_NEW ?>
        </a>
        </td>
<?php     
        }
        elseif ($page == 'product.product_product_type_list') {
?>
                <td>
                <a class="toolbar" href="index2.php?option=com_phpshop&product_id=<?php echo $_REQUEST['product_id'];
				echo !empty($product_parent_id) ? "&product_parent_id=".$product_parent_id : "";
				?>&page=<?php echo $my_page ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="Create a new item" name="new" align="middle" border="0"/>
                    &nbsp;<?php echo _CMN_NEW ?>
                </a>
                </td>
<?php     
        }
        else {

?>
        <td>
        <a class="toolbar" href="index2.php?option=com_phpshop&page=<?php  echo $my_page ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('new','','<?php echo $mosConfig_live_site ?>/administrator/images/new_f2.png',1);"><img src="<?php echo $mosConfig_live_site ?>/administrator/images/new.png" alt="Create a new item" name="new" align="middle" border="0"/>
            &nbsp;<?php echo _CMN_NEW ?>
        </a>
        </td>
<?php
        }
        mosMenuBar::spacer();
        mosMenuBar::endTable();
    }
    
    
  /**
	* Draws the menu for a New users
	*/
	function _NEW_USERS() {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
	
	function _EDIT_USERS() {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
	
	function _DEFAULT_USERS() {
		mosMenuBar::startTable();
		mosMenuBar::addNew();
		mosMenuBar::editList();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
    ?>
    <td><a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to edit'); } else if (confirm('Are you sure to remove the customer information?')){ submitbutton('remove_as_customer');}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('remove_as_customer','','<?php echo IMAGEURL ?>ps_image/remove_as_customer_f2.png',1);">
    <img align="center" src="<?php echo IMAGEURL ?>ps_image/remove_as_customer.png" alt="Delete" border="0" name="remove_as_customer" />&nbsp;Remove as customer</a></td>
  <?php
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
  
}
?>
