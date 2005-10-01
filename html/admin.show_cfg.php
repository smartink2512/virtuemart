<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: admin.show_cfg.php,v 1.5 2005/09/30 10:14:30 codename-matrix Exp $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
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

$option = empty($option)?mosgetparam( $_REQUEST, 'option', 'com_virtuemart'):$option;

$title = '&nbsp;&nbsp;&nbsp;<img src="'. IMAGEURL .'ps_image/settings.png" width="32" height="32" border="0" />';
$title .= $VM_LANG->_PHPSHOP_CONFIG;

//First create the object and let it print a form heading
$formObj = &new formFactory( $title );
//Then Start the form
$formObj->startForm();

$ps_html->writableIndicator( $mosConfig_absolute_path.'/administrator/components/com_virtuemart/virtuemart.cfg.php' ); 

$tabs = new mShopTabs(0, 1, "_main");
$tabs->startPane("content-pane");
$tabs->startTab( $VM_LANG->_PHPSHOP_ADMIN_CFG_GLOBAL, "global-page");
	$subtabs1 = new mShopTabs(0, 0, "_global");
	$subtabs1->startPane("cfg-pane");
	$subtabs1->startTab( $VM_LANG->_PHPSHOP_ADMIN_CFG_GLOBAL." I", "cfg-1-page");
?>

<table class="adminform">
    <tr>
        <td><div align="right"><strong>Shop is offline?</strong></div></td>
        <td>
            <input type="checkbox" name="conf_PSHOP_IS_OFFLINE" class="inputbox" <?php if (PSHOP_IS_OFFLINE == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td>If you check this, the Shop will display an Offline Message.</td>
    </tr>  
    <tr>
        <td valign="top"><div align="right"><strong>Offline Message:</strong></div></td>
        <td colspan="2">
            <textarea rows="3" cols="70" name="conf_PSHOP_OFFLINE_MESSAGE" class="inputbox"><?php echo stripslashes(PSHOP_OFFLINE_MESSAGE); ?></textarea>
        </td>
    </tr>  
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_USE_AS_CATALOGUE" class="inputbox" <?php if (USE_AS_CATALOGUE == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_SHOW_PRICES ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf__SHOW_PRICES" class="inputbox" <?php if (_SHOW_PRICES == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_SHOW_PRICES_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX ?></strong></div></td>
        <td align="left">
            <input type="checkbox" name="conf_TAX_VIRTUAL" class="inputbox" <?php if (TAX_VIRTUAL == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_TAX_MODE ?></strong></div></td>
        <td>
            <select name="conf_TAX_MODE" class="inputbox">
            <option value="0" <?php if (TAX_MODE == 0) echo "selected"; ?>>
            <?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_TAX_MODE_SHIP ?>
            </option>
            <option value="1" <?php if (TAX_MODE == 1) echo "selected"; ?>>
            <?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_TAX_MODE_VENDOR ?>
            </option>
            </select>
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_TAX_MODE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_MULTIPLE_TAXRATES_ENABLE" class="inputbox" <?php if (MULTIPLE_TAXRATES_ENABLE == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_PAYMENT_DISCOUNT_BEFORE" class="inputbox" <?php if (PAYMENT_DISCOUNT_BEFORE == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right">
            <strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY ?></strong>&nbsp;&nbsp;
            </div>
        </td>
        <td>
            <input type="text" name="conf_ENCODE_KEY" class="inputbox" value="<?php echo ENCODE_KEY ?>" />
        </td>
		<td><?php echo mm_ToolTip( $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY_EXPLAIN ); ?></td>
    </tr>
</table>
    <?php
    $subtabs1->endTab();
    $subtabs1->startTab( $VM_LANG->_PHPSHOP_ADMIN_CFG_GLOBAL." II", "cfg-2-page");
    ?>
<table class="adminform">
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_COUPONS_ENABLE ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_PSHOP_COUPONS_ENABLE" class="inputbox" <?php if (PSHOP_COUPONS_ENABLE == '1') echo "checked='checked'"; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_COUPONS_ENABLE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_REVIEW ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_PSHOP_ALLOW_REVIEWS" class="inputbox" <?php if (PSHOP_ALLOW_REVIEWS == '1') echo "checked='checked'"; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_REVIEW_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_LEAVE_BANK_DATA" class="inputbox" <?php if (LEAVE_BANK_DATA == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_CAN_SELECT_STATES" class="inputbox" <?php if (CAN_SELECT_STATES == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_AGREE_TERMS ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_MUST_AGREE_TO_TOS" class="inputbox" <?php if (MUST_AGREE_TO_TOS == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_AGREE_TERMS_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_PSHOP_AGREE_TO_TOS_ONORDER" class="inputbox" <?php if (PSHOP_AGREE_TO_TOS_ONORDER == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CHECK_STOCK ?></strong></div>
            <div style="visibility:hidden;" id="cs1"><br/><br/><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS ?></strong></div>
        </td>
        <td valign="top">
            <input onchange="if(this.checked) { document.getElementById('cs1').style.visibility='visible';document.getElementById('cs2').style.visibility='visible';document.getElementById('cs3').style.visibility='visible';} else {document.getElementById('cs1').style.visibility='hidden';document.getElementById('cs2').style.visibility='hidden';document.getElementById('cs3').style.visibility='hidden';}" type="checkbox" name="conf_CHECK_STOCK" class="inputbox" <?php if (CHECK_STOCK == '1') echo "checked=\"checked\""; ?> value="1" />
            <div style="visibility:hidden;" id="cs2"><br/><br/><input type="checkbox" name="conf_PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS" class="inputbox" <?php if (PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS == '1') echo "checked=\"checked\""; ?> value="1" /></div>
        </td>
        <td valign="top"><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CHECK_STOCK_EXPLAIN ?>
        <div style="visibility:hidden;" align="left" id="cs3">
        <?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS_EXPLAIN ?>
        </div>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_AFFILIATE_ENABLE" class="inputbox" <?php if (AFFILIATE_ENABLE == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_MAIL_FORMAT ?></strong></div></td>
        <td>
            <select name="conf_ORDER_MAIL_HTML" class="inputbox">
            <option value="0" <?php if (ORDER_MAIL_HTML == '0') echo "selected"; ?>>
           <?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_TEXT ?>
            </option>
            <option value="1" <?php if (ORDER_MAIL_HTML == '1') echo "selected"; ?>>
            <?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_HTML ?>
            </option>
            </select>
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_EXPLAIN ?>
        </td>
    </tr>
<?php
  if (stristr($my->usertype, "admin")) { ?>
      <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS" class="inputbox" <?php if (PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN ?>
        </td>
    </tr>
<?php
  } ?>
</table>

<?php
    $subtabs1->endTab();
    $subtabs1->endPane();
$tabs->endTab();
$tabs->startTab( $VM_LANG->_PHPSHOP_ADMIN_CFG_PATHANDURL, "pathandurl-page");
?>

<table class="adminform">
    <tr>
        <th><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_URLSECURE ?></th>
        <td>
            <input size="40" type="text" name="conf_SECUREURL" class="inputbox" value="<?php echo SECUREURL ?>" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_URLSECURE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td colspan="3"><hr />&nbsp;</td>
    </tr>
    <tr>
        <th>Table Prefix for Shop Tables</th>
        <td>
            <input size="40" type="text" name="conf_VM_TABLEPREFIX" class="inputbox" value="<?php echo VM_TABLEPREFIX ?>" />
        </td>
        <td><?php echo mm_ToolTip( "This is <strong>vm</strong> per default" ) ?>
        </td>
    </tr>
    <tr>
        <td colspan="3"><hr />&nbsp;</td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_HOMEPAGE ?></strong></div></td>
        <td>
            <input type="text" name="conf_HOMEPAGE" class="inputbox" value="<?php echo HOMEPAGE ?>" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_HOMEPAGE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ERRORPAGE ?></strong></div></td>
        <td>
            <input type="text" name="conf_ERRORPAGE" class="inputbox" value="<?php echo ERRORPAGE ?>" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ERRORPAGE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_DEBUGPAGE ?></strong></div></td>
        <td>
            <input type="text" name="conf_DEBUGPAGE" class="inputbox" value="<?php echo DEBUGPAGE ?>" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_DEBUGPAGE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td colspan="3"><hr />&nbsp;</td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_DEBUG ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_DEBUG" class="inputbox" <?php if (DEBUG == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_DEBUG_EXPLAIN ?>
        </td>
    </tr>
</table>

<?php
  $tabs->endTab();
  $tabs->startTab( $VM_LANG->_PHPSHOP_ADMIN_CFG_SITE, "site-page");
    $subtabs2 = new mShopTabs(0, 0, "_layout");
    $subtabs2->startPane("layout-pane");
    $subtabs2->startTab( "Display", "layout-1-page");
?>

<table class="adminform">
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_PDF_BUTTON ?></strong></div></td>
        <td>
        <input type="checkbox" name="conf_PSHOP_PDF_BUTTON_ENABLE" class="inputbox" <?php if (PSHOP_PDF_BUTTON_ENABLE == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_PDF_BUTTON_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_FLYPAGE ?></strong></div></td>
        <td>
            <input type="text" name="conf_FLYPAGE" class="inputbox" value="<?php echo FLYPAGE ?>" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_FLYPAGE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE ?></strong></div></td>
        <td>
            <input type="text" name="conf_CATEGORY_TEMPLATE" class="inputbox" value="<?php echo CATEGORY_TEMPLATE ?>" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong>Show Page Navigation at the Top of the Product Listing?</strong></div></td>
        <td>
            <input type="checkbox" name="conf_PSHOP_SHOW_TOP_PAGENAV" class="inputbox" <?php if (PSHOP_SHOW_TOP_PAGENAV == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td>Switches On or Off the Display of Page Navigation at the Top of the Product Listings in the Frontend.</td>
    </tr>
    <tr>
        <td><div align="right"><strong>Show the Number of Products?</strong></div></td>
        <td>
            <input type="checkbox" name="conf_PSHOP_SHOW_PRODUCTS_IN_CATEGORY" class="inputbox" <?php if (PSHOP_SHOW_PRODUCTS_IN_CATEGORY == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td>Show the Number of Products in a Category?</td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW ?></strong></div></td>
        <td>
            <input type="text" name="conf_PRODUCTS_PER_ROW" size="4" class="inputbox" value="<?php echo PRODUCTS_PER_ROW ?>" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE ?></strong></div></td>
        <td>
            <input type="text" name="conf_NO_IMAGE" class="inputbox" value="<?php echo NO_IMAGE ?>" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_SHOWVERSION" class="inputbox" <?php if (SHOWVERSION == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION_EXPLAIN ?>
        </td>
    </tr>
</table>
<?php
    $subtabs2->endTab();
    $subtabs2->startTab( "Layout", "layout-2-page");
?>
<table class="adminform">
    <tr>
        <td valign="top"><strong>Add-to-Cart Button Style</strong></td>
        <td valign="middle" colspan="2"><?php
                    $path = IMAGEPATH."ps_image";
            $files = mosReadDirectory( "$path", "add-to-cart_?.", true, true);
            foreach ($files as $file) { 
                $file_info = pathinfo($file);
                $filename = $file_info['basename'];
                $checked = ($filename == PSHOP_ADD_TO_CART_STYLE) ? "checked=\"checked\"" : "";
                echo "<input type=\"radio\" name=\"conf_PSHOP_ADD_TO_CART_STYLE\" value=\"$filename\" $checked />&nbsp;&nbsp;";
                echo "<img align=\"center\" src=\"".IMAGEURL."ps_image/$filename\" border=\"0\" alt=\"$filename\" />";
                echo "&nbsp;&nbsp;($filename)<br />";
            }
        ?></td>
    </tr>
    <tr>
        <td colspan="3"><hr />&nbsp;</td>
    </tr>
    <tr>
        <td width="30%" valign="top" align="right"><strong>Enable Dynamic Thumbnail Resizing?</strong></td>
        <td width="15%" valign="top">
            <input type="checkbox" name="conf_PSHOP_IMG_RESIZE_ENABLE" class="inputbox" <?php if (PSHOP_IMG_RESIZE_ENABLE == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td width="55%">If checked, you enable dynamic Image Resizing. This means that all Thumbnail Images are resized to fit the Sizes you provide below,
        using PHP's GD2 functions (you can check if you have GD2 support by browsing to "System" -> "System Info" -> "PHP Info" -> gd. 
        The Thumbnail Image quality is much better than Images which were "resized" by the browser.
        The newly generated Images are put into the directory /shop_image/prduct/resized. If the Image has already been
        resized, this copy will be send to the browser, so no image is resized again and again.
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong>Thumbnail Image Width</strong></div></td>
        <td>
            <input type="text" name="conf_PSHOP_IMG_WIDTH" class="inputbox" value="<?php echo PSHOP_IMG_WIDTH ?>" />
        </td>
        <td>The target <strong>width</strong> of the resized Thumbnail Image.</td>
    </tr>
    <tr>
        <td><div align="right"><strong>Thumbnail Image Height</strong></div></td>
        <td>
            <input type="text" name="conf_PSHOP_IMG_HEIGHT" class="inputbox" value="<?php echo PSHOP_IMG_HEIGHT ?>" />
        </td>
        <td>The target <strong>height</strong> of the resized Thumbnail Image.</td>
    </tr>
    <tr>
        <td colspan="3"><hr />&nbsp;</td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1 ?></strong></td>
        <td>
            <input type="text" name="conf_SEARCH_COLOR_1" class="inputbox" value="<?php echo SEARCH_COLOR_1 ?>" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2 ?></strong></td>
        <td>
            <input type="text" name="conf_SEARCH_COLOR_2" class="inputbox" value="<?php echo SEARCH_COLOR_2 ?>" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2_EXPLAIN ?>
        </td>
    </tr>
</table>

<?php
    $subtabs2->endTab();
    $subtabs2->endPane();
  $tabs->endTab();
  
  $tabs->startTab( $VM_LANG->_PHPSHOP_ADMIN_CFG_SHIPPING, "shipping-page");
?>

<table class="adminform">
<tr><td colspan="2"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD ?></strong></td></tr>
<?php
require_once( CLASSPATH. "ps_shipping_method.php" );
$ps_shipping_method = new ps_shipping_method;
$rows = $ps_shipping_method->method_list();
$i = 0;
foreach( $rows as $row ) { 
    if( $row['filename'] == "standard_shipping.php" ) { ?>
    <tr>
        <td>
            <input type="checkbox" id="sh<?php echo $i ?>" name="conf_SHIPPING[]" <?php if (array_search('standard_shipping', $PSHOP_SHIPPING_MODULES) !== false) echo "checked=\"checked\""; ?> value="standard_shipping" />
            
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_STANDARD ?>
        </td>
    </tr><?php  
    }
    elseif( $row['filename'] == "zone_shipping.php" ) { ?>
    <tr>
        <td valign="top">
            <input type="checkbox" id="sh<?php echo $i ?>" name="conf_SHIPPING[]" <?php if (array_search('zone_shipping', $PSHOP_SHIPPING_MODULES) !== false) echo "checked=\"checked\""; ?> value="zone_shipping" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_ZONE ?>
        </td>
    </tr><?php  
    }
    elseif( $row['filename'] == "ups.php" ) { ?>
    <tr>
        <td>
            <input type="checkbox" id="sh<?php echo $i ?>" name="conf_SHIPPING[]" <?php if (array_search('ups', $PSHOP_SHIPPING_MODULES) !== false) echo "checked=\"checked\""; ?> value="ups" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS ?>
        </td>
    </tr><?php  
    }
    elseif( $row['filename'] == "intershipper.php" ) { ?>
    <tr>
        <td>
            <input type="checkbox" id="sh<?php echo $i ?>" name="conf_SHIPPING[]" <?php if (array_search('intershipper', $PSHOP_SHIPPING_MODULES) !== false) echo "checked=\"checked\""; ?> value="intershipper" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER ?>
        </td>
    </tr><?php  
    }
    elseif( $row['filename'] != "no_shipping.php" ) {
?><tr>
    <td>
        <input type="checkbox" id="sh<?php echo $i ?>" name="conf_SHIPPING[]" <?php if (array_search(basename($row['filename'], ".php"), $PSHOP_SHIPPING_MODULES) !== false) echo "checked=\"checked\""; ?> value="<?php echo basename($row['filename'], ".php") ?>" />
    </td>
    <td><?php echo $row["description"]; ?></td>
    </tr><?php    
    }
    $i++;
}
echo "<input type=\"hidden\" name=\"shippingMethodCount\" value=\"".count($rows)."\" />";
    ?>
    <tr><td colspan="2"><hr/></td></tr>
    <tr>
        <td>
            <input type="checkbox" id="sh<?php echo $i ?>" name="conf_SHIPPING[]" onclick="unCheckAndDisable( this.checked );" <?php if (NO_SHIPPING == '1') echo "checked=\"checked\""; ?> value="no_shipping" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_DISABLE ?>
        </td>
    </tr>
</table>
    
<?php
  $tabs->endTab();
  $tabs->startTab( $VM_LANG->_PHPSHOP_ADMIN_CFG_CHECKOUT, "checkout-page");
?>

<table class="adminform">
   <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_SHOW_CHECKOUT_BAR" class="inputbox" <?php if (SHOW_CHECKOUT_BAR == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td rowspan="4" valign="top"><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS ?></strong></div></td>
        <td width="40" valign="top">
            <input type="radio" name="conf_CHECKOUT_STYLE" <?php if (CHECKOUT_STYLE == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_STANDARD ?>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <input type="radio" name="conf_CHECKOUT_STYLE" <?php if (CHECKOUT_STYLE == '2') echo "checked=\"checked\""; ?> value="2" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_2 ?>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <input type="radio" name="conf_CHECKOUT_STYLE" <?php if (CHECKOUT_STYLE == '3') echo "checked=\"checked\""; ?> value="3" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_3 ?>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <input type="radio" name="conf_CHECKOUT_STYLE" <?php if (CHECKOUT_STYLE == '4') echo "checked=\"checked\""; ?> value="4" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_4 ?>
        </td>
    </tr>
  </table>

<?php
  $tabs->endTab();
  $tabs->startTab( $VM_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOADABLEGOODS, "download-page");
?>

  <table class="adminform">
  <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_ENABLE_DOWNLOADS" class="inputbox" <?php if (ENABLE_DOWNLOADS == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS ?></strong></div></td>
        <td>
            <select name="conf_ENABLE_DOWNLOAD_STATUS" class="inputbox" >
            <?php
                $db = new ps_DB;
                $q = "SELECT order_status_name,order_status_code FROM #__{vm}_order_status ORDER BY list_order";
                $db->query($q);
                $order_status_code = Array();
                $order_status_name = Array();
                
                while ($db->next_record()) {
                  $order_status_code[] = $db->f("order_status_code");
                  $order_status_name[] =  $db->f("order_status_name");
                }
                
                for ($i = 0; $i < sizeof($order_status_code); $i++) {
                  echo "<option value=\"" . $order_status_code[$i];
                  if (ENABLE_DOWNLOAD_STATUS == $order_status_code[$i]) 
                     echo "\" selected=\"selected\">";
                  else
                     echo "\">";
                  echo $order_status_name[$i] . "</option>\n";
                }?>
                </select>
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN ?>
        </td>
    </tr>
        <tr>
        <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS ?></strong></div></td>
        <td>
            <select name="conf_DISABLE_DOWNLOAD_STATUS" class="inputbox" >
            <?php
                for ($i = 0; $i < sizeof($order_status_code); $i++) {
                  echo "<option value=\"" . $order_status_code[$i];
                  if (DISABLE_DOWNLOAD_STATUS == $order_status_code[$i]) 
                     echo "\" selected=\"selected\">";
                  else
                     echo "\">";
                  echo $order_status_name[$i] . "</option>\n";
                }?>
                </select>
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN ?>
        </td>
    </tr>
      <tr>
        <td valign="top"><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOADROOT ?></strong></div></td>
        <td valign="top">
            <input size="40" type="text" name="conf_DOWNLOADROOT" class="inputbox" value="<?php echo DOWNLOADROOT ?>" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOADROOT_EXPLAIN ?>
        </td>
    </tr>
    <tr>
      <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX ?></strong></div></td>
        <td>
            <input size="3" type="text" name="conf_DOWNLOAD_MAX" class="inputbox" value="<?php echo DOWNLOAD_MAX ?>" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN ?>
        </td>
    </tr>
    <tr>
      <td><div align="right"><strong><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE ?></strong></div></td>
        <td>
            <input size="8" type="text" name="conf_DOWNLOAD_EXPIRE" class="inputbox" value="<?php echo DOWNLOAD_EXPIRE ?>" />
        </td>
        <td><?php echo $VM_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN ?>
        </td>
    </tr>
  </table>  

<?php
  $tabs->endTab();
  $tabs->endPane();
  
// Add necessary hidden fields
$formObj->hiddenField( 'conf_SEARCH_ROWS', $mosConfig_list_limit );
$formObj->hiddenField( 'myname', 'Jabba Binks' );

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( 'writeConfig', $modulename.'.index', $option );
?>   

<script type="text/javascript">
function unCheckAndDisable( disable ) {

    var n = document.adminForm.shippingMethodCount.value;
    var fldName = 'sh';
	var f = document.adminForm;
	var n2 = 0;
    if( disable )
        for (i=0; i < n; i++) {
            cb = eval( 'f.' + fldName + '' + i );
            if (cb) {
                cb.disabled = true;
                n2++;
            }
        }
    else
        for (i=0; i < n; i++) {
            cb = eval( 'f.' + fldName + '' + i );
            if (cb) {
                cb.disabled = false;
                n2++;
            }
        }
}
function submitbutton(pressbutton) {
    var form = document.adminForm;
    
    /* Shipping Configuration */
    var correct = false;
    var n = document.adminForm.shippingMethodCount.value;
    var fldName = 'sh';
	var f = document.adminForm;
	var n2 = 0;
    for (i=0; i <= n; i++) {
        cb = eval( 'f.' + fldName + '' + i );
        if (cb) {
            if(cb.checked)
                correct = true;
        }
    }
    if(!correct)
        alert('Please select at least one Checkbox in the Shipping Configuration!');

    else
        submitform( pressbutton );
}
var count = document.adminForm.shippingMethodCount.value;
var elem = eval( 'document.adminForm.sh' + count );
unCheckAndDisable( elem.checked );
if(document.adminForm.conf_CHECK_STOCK.checked) { document.getElementById('cs1').style.visibility='visible';document.getElementById('cs2').style.visibility='visible';document.getElementById('cs3').style.visibility='visible';} else {document.getElementById('cs1').style.visibility='hidden';document.getElementById('cs2').style.visibility='hidden';document.getElementById('cs3').style.visibility='hidden';}
</script>
