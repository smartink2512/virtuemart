<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.show_cfg.php,v 1.20 2005/05/26 19:55:35 soeren_nb Exp $
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
?>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
<table width="100%" cellspacing="0" cellpadding="4" border="0">
<tr>
      <td width="60">
      &nbsp;&nbsp;&nbsp;<img src="<?php echo IMAGEURL ?>ps_image/settings.png" width="32" height="32" border="0" /><br /><br />
      </td>
      <td width="60%" valign="middle">
      <span class="sectionname">&nbsp;&nbsp;&nbsp;<?php echo $PHPSHOP_LANG->_PHPSHOP_CONFIG;?></span>
    </td>
    <td align="left" width="40%" class="sectionname"><br />
   <?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_FILE_STATUS ?><br /> phpshop.cfg.php<?php 
        echo is_writable( $mosConfig_absolute_path.'/administrator/components/com_phpshop/phpshop.cfg.php' ) 
        ? '&nbsp;<span style="color:green;font-weight:bold;">'.$PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_FILE_STATUS_WRITEABLE.'</span>' 
        : '&nbsp;<span style="color:red;font-weight:bold;">'.$PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_FILE_STATUS_UNWRITEABLE.'</span>' ?>
        <br /><br />
    </td>
  </tr>
</table>
  
<?php
    $tabs = new mShopTabs(0, 1, "_main");
    $tabs->startPane("content-pane");
    $tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_GLOBAL, "global-page");
        $subtabs1 = new mShopTabs(0, 0, "_global");
        $subtabs1->startPane("cfg-pane");
        $subtabs1->startTab( $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_GLOBAL." I", "cfg-1-page");
  ?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="adminForm">
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
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_USE_AS_CATALOGUE" class="inputbox" <?php if (USE_AS_CATALOGUE == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_USE_ONLY_AS_CATALOGUE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SHOW_PRICES ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf__SHOW_PRICES" class="inputbox" <?php if (_SHOW_PRICES == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SHOW_PRICES_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX ?></strong></div></td>
        <td align="left">
            <input type="checkbox" name="conf_TAX_VIRTUAL" class="inputbox" <?php if (TAX_VIRTUAL == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_VIRTUAL_TAX_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_TAX_MODE ?></strong></div></td>
        <td>
            <select name="conf_TAX_MODE" class="inputbox">
            <option value="0" <?php if (TAX_MODE == 0) echo "selected"; ?>>
            <?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_TAX_MODE_SHIP ?>
            </option>
            <option value="1" <?php if (TAX_MODE == 1) echo "selected"; ?>>
            <?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_TAX_MODE_VENDOR ?>
            </option>
            </select>
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_TAX_MODE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_MULTIPLE_TAXRATES_ENABLE" class="inputbox" <?php if (MULTIPLE_TAXRATES_ENABLE == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_MULTI_TAX_RATE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_PAYMENT_DISCOUNT_BEFORE" class="inputbox" <?php if (PAYMENT_DISCOUNT_BEFORE == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SUBSTRACT_PAYEMENT_BEFORE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right">
            <strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY ?></strong>&nbsp;&nbsp;
            <?php echo mostooltip( $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_STORE_ENCODEKEY_EXPLAIN ); ?>
            </div>
        </td>
        <td colspan="2">
            <input type="text" name="conf_ENCODE_KEY" class="inputbox" value="<?php echo ENCODE_KEY ?>" />
        </td>
    </tr>
</table>
    <?php
    $subtabs1->endTab();
    $subtabs1->startTab( $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_GLOBAL." II", "cfg-2-page");
    ?>
<table>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_COUPONS_ENABLE ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_PSHOP_COUPONS_ENABLE" class="inputbox" <?php if (PSHOP_COUPONS_ENABLE == '1') echo "checked='checked'"; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_COUPONS_ENABLE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_REVIEW ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_PSHOP_ALLOW_REVIEWS" class="inputbox" <?php if (PSHOP_ALLOW_REVIEWS == '1') echo "checked='checked'"; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_REVIEW_EXPLAIN ?>
        </td>
    </tr>
    <tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_LEAVE_BANK_DATA" class="inputbox" <?php if (LEAVE_BANK_DATA == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ACCOUNT_CAN_BE_BLANK_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_CAN_SELECT_STATES" class="inputbox" <?php if (CAN_SELECT_STATES == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CAN_SELECT_STATE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_AGREE_TERMS ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_MUST_AGREE_TO_TOS" class="inputbox" <?php if (MUST_AGREE_TO_TOS == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_AGREE_TERMS_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_PSHOP_AGREE_TO_TOS_ONORDER" class="inputbox" <?php if (PSHOP_AGREE_TO_TOS_ONORDER == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_AGREE_TERMS_ONORDER_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CHECK_STOCK ?></strong></div>
            <div style="visibility:hidden;" id="cs1"><br/><br/><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS ?></strong></div>
        </td>
        <td valign="top">
            <input onchange="if(this.checked) { document.getElementById('cs1').style.visibility='visible';document.getElementById('cs2').style.visibility='visible';document.getElementById('cs3').style.visibility='visible';} else {document.getElementById('cs1').style.visibility='hidden';document.getElementById('cs2').style.visibility='hidden';document.getElementById('cs3').style.visibility='hidden';}" type="checkbox" name="conf_CHECK_STOCK" class="inputbox" <?php if (CHECK_STOCK == '1') echo "checked=\"checked\""; ?> value="1" />
            <div style="visibility:hidden;" id="cs2"><br/><br/><input type="checkbox" name="conf_PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS" class="inputbox" <?php if (PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS == '1') echo "checked=\"checked\""; ?> value="1" /></div>
        </td>
        <td valign="top"><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CHECK_STOCK_EXPLAIN ?>
        <div style="visibility:hidden;" align="left" id="cs3">
        <?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SHOW_OUT_OF_STOCK_PRODUCTS_EXPLAIN ?>
        <div>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_AFFILIATE_ENABLE" class="inputbox" <?php if (AFFILIATE_ENABLE == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ENABLE_AFFILIATE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_MAIL_FORMAT ?></strong></div></td>
        <td>
            <select name="conf_ORDER_MAIL_HTML" class="inputbox">
            <option value="0" <?php if (ORDER_MAIL_HTML == '0') echo "selected"; ?>>
           <?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_TEXT ?>
            </option>
            <option value="1" <?php if (ORDER_MAIL_HTML == '1') echo "selected"; ?>>
            <?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_HTML ?>
            </option>
            </select>
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_MAIL_FORMAT_EXPLAIN ?>
        </td>
    </tr>
<?php
  if (stristr($my->usertype, "admin")) { ?>
      <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS" class="inputbox" <?php if (PSHOP_ALLOW_FRONTENDADMIN_FOR_NOBACKENDERS == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_FRONTENDAMDIN_EXPLAIN ?>
        </td>
    </tr>
<?php
  } ?>
</table>

<?php
    $subtabs1->endTab();
    $subtabs1->endPane();
$tabs->endTab();
$tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_PATHANDURL, "pathandurl-page");
?>

<table class="adminform">
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_URL ?></strong></div></td>
        <td>
            <input size="40" type="text" name="conf_URL" class="inputbox" value="<?php echo URL ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_URL_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_URLSECURE ?></strong></div></td>
        <td>
            <input size="40" type="text" name="conf_SECUREURL" class="inputbox" value="<?php echo SECUREURL ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_URLSECURE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_URLCOMPONENT ?></strong></div></td>
        <td>
            <input size="40" type="text" name="conf_COMPONENTURL" class="inputbox" value="<?php echo COMPONENTURL ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_URLCOMPONENT_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_URLIMAGE ?></strong></div></td>
        <td>
            <input size="40" type="text" name="conf_IMAGEURL" class="inputbox" value="<?php echo IMAGEURL ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_URLIMAGE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ADMINPATH ?></strong></div></td>
        <td>
            <input size="40" type="text" name="conf_ADMINPATH" class="inputbox" value="<?php echo ADMINPATH ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ADMINPATH_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CLASSPATH ?></strong></div></td>
        <td>
            <input size="40" type="text" name="conf_CLASSPATH" class="inputbox" value="<?php echo CLASSPATH ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CLASSPATH_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_PAGEPATH ?></strong></div></td>
        <td>
            <input size="40" type="text" name="conf_PAGEPATH" class="inputbox" value="<?php echo PAGEPATH ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_PAGEPATH_EXPLAIN ?>
        </td>
    </tr>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_IMAGEPATH ?></strong></div></td>
        <td>
            <input size="40" type="text" name="conf_IMAGEPATH" class="inputbox" value="<?php echo IMAGEPATH ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_IMAGEPATH_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_HOMEPAGE ?></strong></div></td>
        <td>
            <input type="text" name="conf_HOMEPAGE" class="inputbox" value="<?php echo HOMEPAGE ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_HOMEPAGE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ERRORPAGE ?></strong></div></td>
        <td>
            <input type="text" name="conf_ERRORPAGE" class="inputbox" value="<?php echo ERRORPAGE ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ERRORPAGE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_DEBUGPAGE ?></strong></div></td>
        <td>
            <input type="text" name="conf_DEBUGPAGE" class="inputbox" value="<?php echo DEBUGPAGE ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_DEBUGPAGE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_DEBUG ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_DEBUG" class="inputbox" <?php if (DEBUG == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_DEBUG_EXPLAIN ?>
        </td>
    </tr>
</table>

<?php
  $tabs->endTab();
  $tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SITE, "site-page");
    $subtabs2 = new mShopTabs(0, 0, "_layout");
    $subtabs2->startPane("layout-pane");
    $subtabs2->startTab( "Display", "layout-1-page");
?>

<table class="adminform">
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_PDF_BUTTON ?></strong></div></td>
        <td>
        <input type="checkbox" name="conf_PSHOP_PDF_BUTTON_ENABLE" class="inputbox" <?php if (PSHOP_PDF_BUTTON_ENABLE == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_PDF_BUTTON_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_FLYPAGE ?></strong></div></td>
        <td>
            <input type="text" name="conf_FLYPAGE" class="inputbox" value="<?php echo FLYPAGE ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_FLYPAGE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE ?></strong></div></td>
        <td>
            <input type="text" name="conf_CATEGORY_TEMPLATE" class="inputbox" value="<?php echo CATEGORY_TEMPLATE ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CATEGORY_TEMPLATE_EXPLAIN ?>
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
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW ?></strong></div></td>
        <td>
            <input type="text" name="conf_PRODUCTS_PER_ROW" size="4" class="inputbox" value="<?php echo PRODUCTS_PER_ROW ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_PRODUCTS_PER_ROW_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE ?></strong></div></td>
        <td>
            <input type="text" name="conf_NO_IMAGE" class="inputbox" value="<?php echo NO_IMAGE ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_NOIMAGEPAGE_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SEARCHROWS ?></strong></div></td>
        <td>
            <input type="text" name="conf_SEARCH_ROWS" class="inputbox" value="<?php echo SEARCH_ROWS ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SEARCHROWS_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_MAXIMUMROWS ?></strong></div></td>
        <td>
            <input type="text" name="conf_MAX_ROWS" class="inputbox" value="<?php echo MAX_ROWS ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_MAXIMUMROWS_EXPLAIN ?>
        </td>
    </tr>

    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_SHOWVERSION" class="inputbox" <?php if (SHOWVERSION == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SHOWPHPSHOP_VERSION_EXPLAIN ?>
        </td>
    </tr>
</table>
<?php
    $subtabs2->endTab();
    $subtabs2->startTab( "Layout", "layout-2-page");
?>
<table width="100%">
    <tr>
        <td valign="top"><strong>Add-to-Cart Button Style</strong></div></td>
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
        <td width="30%" valign="top" align="right"><strong>Enable Dynamic Thumbnail Resizing?</strong></div></td>
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
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1 ?></strong></div></td>
        <td>
            <input type="text" name="conf_SEARCH_COLOR_1" class="inputbox" value="<?php echo SEARCH_COLOR_1 ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SEARCHCOLOR1_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2 ?></strong></div></td>
        <td>
            <input type="text" name="conf_SEARCH_COLOR_2" class="inputbox" value="<?php echo SEARCH_COLOR_2 ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SEARCHCOLOR2_EXPLAIN ?>
        </td>
    </tr>
</table>

<?php
    $subtabs2->endTab();
    $subtabs2->endPane();
  $tabs->endTab();
  
  /* 
  TEST IF WE ARE RUNNING MAMBO 4.5 1.0.9
  */
  if( defined( '_RELEASE' ) )
    /*
    SHOW MAIL CONFIGURATION DIALOG
    */
    if( _RELEASE == '4.5' ) {

		$tabs->startTab("Mail","mail-page");
		?>
		<table width="100%" class="adminform">
		<tr>
			<td>
			Mailer:
			</td>
			<td>
            <?php
            $select_mailer=Array();
            if( CFG_MAILER == 'mail' ) { $select_mailer[0] = "checked=\"checked\""; $select_mailer[1] = $select_mailer[2] = ""; }
            elseif( CFG_MAILER == 'sendmail' ) { $select_mailer[1] = "checked=\"checked\""; $select_mailer[0] = $select_mailer[2] = ""; }
            else { $select_mailer[2] = "checked=\"checked\""; $select_mailer[0] = $select_mailer[1] = ""; }
            ?>
			<select name="CFG_MAILER" class="inputbox" size="1">
                <option value="mail" <?php echo $select_mailer[0] ?>>PHP mail function</option>
                <option value="sendmail" <?php echo $select_mailer[1] ?>>Sendmail</option>
                <option value="smtp" <?php echo $select_mailer[2] ?>>SMTP Server</option>
            </select>
			</td>
		</tr>
		<tr>
			<td>
			Mail From:
			</td>
			<td>
			<input class="text_area" type="text" name="CFG_MAILFROM" size="25" value="<?php echo CFG_MAILFROM; ?>">
			</td>
		</tr>
		<tr>
			<td>
			From Name:
			</td>
			<td>
			<input class="text_area" type="text" name="CFG_MAILFROM_NAME" size="25" value="<?php echo CFG_MAILFROM_NAME; ?>">
			</td>
		</tr>
		<tr>
			<td>
			SMTP Auth:
			</td>
			<td>
            <?php
            $select_auth=Array();
            if( CFG_SMTPAUTH == '0' ) { $select_auth[0] = "checked=\"checked\""; $select_auth[1] = ""; }
            else { $select_auth[1] = "checked=\"checked\""; $select_auth[0] = ""; }
            ?>
			<input type="radio" name="CFG_SMTPAUTH" value="0" <?php echo $select_auth[0] ?> class="inputbox" />No
            <input type="radio" name="CFG_SMTPAUTH" value="1" <?php echo $select_auth[1] ?> class="inputbox" />Yes
			</td>
		</tr>
		<tr>
			<td>
			SMTP User:
			</td>
			<td>
			<input class="text_area" type="text" name="CFG_SMTPUSER" size="15" value="<?php echo CFG_SMTPUSER; ?>">
			</td>
		</tr>
		<tr>
			<td>
			SMTP Pass:
			</td>
			<td>
			<input class="text_area" type="text" name="CFG_SMTPPASS" size="12" value="<?php echo CFG_SMTPPASS; ?>">
			</td>
		</tr>
		<tr>
			<td>
			SMTP Host:
			</td>
			<td>
			<input class="text_area" type="text" name="CFG_SMTPHOST" size="20" value="<?php echo CFG_SMTPHOST; ?>">
			</td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
    }
  $tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_SHIPPING, "shipping-page");
?>

<table class="adminform">
<tr><td colspan="2"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD ?></strong></div></td></tr>
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
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_STANDARD ?>
        </td>
    </tr><?php  
    }
    elseif( $row['filename'] == "zone_shipping.php" ) { ?>
    <tr>
        <td valign="top">
            <input type="checkbox" id="sh<?php echo $i ?>" name="conf_SHIPPING[]" <?php if (array_search('zone_shipping', $PSHOP_SHIPPING_MODULES) !== false) echo "checked=\"checked\""; ?> value="zone_shipping" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_ZONE ?>
        </td>
    </tr><?php  
    }
    elseif( $row['filename'] == "ups.php" ) { ?>
    <tr>
        <td>
            <input type="checkbox" id="sh<?php echo $i ?>" name="conf_SHIPPING[]" <?php if (array_search('ups', $PSHOP_SHIPPING_MODULES) !== false) echo "checked=\"checked\""; ?> value="ups" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_UPS ?>
        </td>
    </tr><?php  
    }
    elseif( $row['filename'] == "intershipper.php" ) { ?>
    <tr>
        <td>
            <input type="checkbox" id="sh<?php echo $i ?>" name="conf_SHIPPING[]" <?php if (array_search('intershipper', $PSHOP_SHIPPING_MODULES) !== false) echo "checked=\"checked\""; ?> value="intershipper" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_INTERSHIPPER ?>
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
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_DISABLE ?>
        </td>
    </tr>
</table>
    
<?php
  $tabs->endTab();
  $tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CHECKOUT, "checkout-page");
?>

<table class="adminform">
   <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_SHOW_CHECKOUT_BAR" class="inputbox" <?php if (SHOW_CHECKOUT_BAR == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ENABLE_CHECKOUTBAR_EXPLAIN ?>
        </td>
    </tr>
        <td rowspan="4" valign="top"><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS ?></strong></div></td>
        <td width="40" valign="top">
            <input type="radio" name="conf_CHECKOUT_STYLE" <?php if (CHECKOUT_STYLE == '1') echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_STANDARD ?>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <input type="radio" name="conf_CHECKOUT_STYLE" <?php if (CHECKOUT_STYLE == '2') echo "checked=\"checked\""; ?> value="2" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_2 ?>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <input type="radio" name="conf_CHECKOUT_STYLE" <?php if (CHECKOUT_STYLE == '3') echo "checked=\"checked\""; ?> value="3" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_3 ?>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <input type="radio" name="conf_CHECKOUT_STYLE" <?php if (CHECKOUT_STYLE == '4') echo "checked=\"checked\""; ?> value="4" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_CHECKOUT_PROCESS_4 ?>
        </td>
    </tr>
  </table>

<?php
  $tabs->endTab();
  $tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOADABLEGOODS, "download-page");
?>

  <table class="adminform">
  <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS ?></strong></div></td>
        <td>
            <input type="checkbox" name="conf_ENABLE_DOWNLOADS" class="inputbox" <?php if (ENABLE_DOWNLOADS == 1) echo "checked=\"checked\""; ?> value="1" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ENABLE_DOWNLOADS_EXPLAIN ?>
        </td>
    </tr>
    <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS ?></strong></div></td>
        <td>
            <select name="conf_ENABLE_DOWNLOAD_STATUS" class="inputbox" >
            <?php
                $db = new ps_DB;
                $q = "SELECT order_status_name,order_status_code FROM #__pshop_order_status ORDER BY list_order";
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
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ORDER_ENABLE_DOWNLOADS_EXPLAIN ?>
        </td>
    </tr>
        <tr>
        <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS ?></strong></div></td>
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
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_ORDER_DISABLE_DOWNLOADS_EXPLAIN ?>
        </td>
    </tr>
      <tr>
        <td valign="top"><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOADROOT ?></strong></div></td>
        <td valign="top">
            <input size="40" type="text" name="conf_DOWNLOADROOT" class="inputbox" value="<?php echo DOWNLOADROOT ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOADROOT_EXPLAIN ?>
        </td>
    </tr>
    <tr>
      <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX ?></strong></div></td>
        <td>
            <input size="3" type="text" name="conf_DOWNLOAD_MAX" class="inputbox" value="<?php echo DOWNLOAD_MAX ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOAD_MAX_EXPLAIN ?>
        </td>
    </tr>
    <tr>
      <td><div align="right"><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE ?></strong></div></td>
        <td>
            <input size="8" type="text" name="conf_DOWNLOAD_EXPIRE" class="inputbox" value="<?php echo DOWNLOAD_EXPIRE ?>" />
        </td>
        <td><?php echo $PHPSHOP_LANG->_PHPSHOP_ADMIN_CFG_DOWNLOAD_EXPIRE_EXPLAIN ?>
        </td>
    </tr>
  </table>  

<?php
  $tabs->endTab();
  $tabs->endPane();
?>   

<input type="hidden" name="option" value="com_phpshop" />
<input type="hidden" name="func" value="writeConfig" />
<input type="hidden" name="page" value="admin.index" />
<input type="hidden" name="myname" value="Jabba Binks" />
  <input type="hidden" name="task" value="">
</form>
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
