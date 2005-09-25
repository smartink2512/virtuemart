<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: store.store_form.php,v 1.11 2005/06/18 08:51:34 soeren_nb Exp $
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

include_class( "vendor" );
global $ps_vendor, $ps_vendor_id;

$q = "SELECT * FROM #__pshop_vendor WHERE vendor_id='$ps_vendor_id'"; 
$db->query($q);  
$db->next_record();

$title = '<img src="'. IMAGEURL .'ps_image/store.gif" border="0" alt="Store" />'. $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_LBL;

//First create the object and let it print a form heading
$formObj = &new formFactory( $title );
//Then Start the form
$formObj->startForm( 'adminForm', 'enctype="multipart/form-data"' );
?>
<br /><br />
<?php 

/* Build up the Tabs */
$tabs = new mShopTabs(0, 1, "_main");
$tabs->startPane("content-pane");
$tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_STORE_MOD, "info-page");
?>
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_FULL_IMAGE ?>:</td>
      <td width="78%" ><?php  
        $ps_vendor->show_image($db->f("vendor_full_image")); 
        ?> 
        <input type="hidden" name="vendor_full_image_curr" value="<?php $db->p("vendor_full_image"); ?>" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_UPLOAD ?>:</td>
      <td width="78%" > 
        <input type="file" name="vendor_full_image" size="16" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_CURRENCY ?>: </td>
      <td width="78%" > 
        <?php $ps_html->list_currency("vendor_currency", $db->sf("vendor_currency")) ?>
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_MPOV ?>: </td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="vendor_min_pov" value="<?php $db->sp("vendor_min_pov") ?>" size="6" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_FREE_SHIPPING_AMOUNT ?>: </td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="vendor_freeshipping" value="<?php $db->sp("vendor_freeshipping") ?>" size="6" />
      <?php echo mosToolTip( $PHPSHOP_LANG->_PHPSHOP_FREE_SHIPPING_AMOUNT_TOOLTIP ) ?>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="font-weight:bold;"><hr /><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_DISPLAY ?></td>
    </tr>
    
<?php
/* Decode vendor_currency_display_style */
$currency_display =& vendor_currency_display_style( $db->f("vendor_currency_display_style") );
?>
    <tr>
      <td align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_SYMBOL ?> : </td>
      <td>
        <input type="hidden" name="display_style[0]" value="<? echo $ps_vendor_id; ?>" size="4">
        <input type="text" name="display_style[1]" value="<? echo $currency_display['symbol']; ?>" size="4" />
        <?php echo mosToolTip( $PHPSHOP_LANG->_PHPSHOP_CURRENCY_SYMBOL_TOOLTIP )?>
      </td>
    </tr>
    <tr>
      <td align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_DECIMALS ?> : </td>
      <td><input type="text" name="display_style[2]" value="<? echo $currency_display['nbdecimal']; ?>" size="1" />
      <?php echo mosToolTip( $PHPSHOP_LANG->_PHPSHOP_CURRENCY_DECIMALS_TOOLTIP ) ?>
      </td>
    </tr>
    <tr>
      <td align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_DECIMALSYMBOL ?> : </td>
      <td><input type="text" name="display_style[3]" value="<? echo $currency_display['sdecimal']; ?>" size="1" />
      <?php echo mosToolTip( $PHPSHOP_LANG->_PHPSHOP_CURRENCY_DECIMALSYMBOL_TOOLTIP ) ?></td>
    </tr>
    <tr>
      <td align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_THOUSANDS ?> : </td>
      <td><input type="text" name="display_style[4]" value="<? echo $currency_display['thousands']; ?>" size="1" />
      <?php echo mosToolTip( $PHPSHOP_LANG->_PHPSHOP_CURRENCY_THOUSANDS_TOOLTIP )?></td>
    </tr>
    <tr>
      <td align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_POSITIVE_DISPLAY ?> : </td>
      <td>
        <select name="display_style[5]">
			<option value="0"<? if ($currency_display['positive']=='0') echo ' selected=\"selected\" ';?>>00Symb</option>
	   		<option value="1"<? if ($currency_display['positive']=='1') echo ' selected=\"selected\" ';?>>00 Symb</option>
	   		<option value="2"<? if ($currency_display['positive']=='2') echo ' selected=\"selected\" ';?>>Symb00</option>
		   	<option value="3"<? if ($currency_display['positive']=='3') echo ' selected=\"selected\" ';?>>Symb 00</option>
        </select>
        <?php echo mosToolTip( $PHPSHOP_LANG->_PHPSHOP_CURRENCY_POSITIVE_DISPLAY_TOOLTIP ) ?>
      </td>
    </tr>
    <tr>
      <td align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY ?> : </td>
      <td>
        <select name="display_style[6]">
			<option value="0"<? if ($currency_display['negative']=='0') echo ' selected=\"selected\" ';?>>(Symb00)</option>
		   	<option value="1"<? if ($currency_display['negative']=='1') echo ' selected=\"selected\" ';?>>-Symb00</option>
		   	<option value="2"<? if ($currency_display['negative']=='2') echo ' selected=\"selected\" ';?>>Symb-00</option>
		   	<option value="3"<? if ($currency_display['negative']=='3') echo ' selected=\"selected\" ';?>>Symb00-</option>
		   	<option value="4"<? if ($currency_display['negative']=='4') echo ' selected=\"selected\" ';?>>(00Symb)</option>
		   	<option value="5"<? if ($currency_display['negative']=='5') echo ' selected=\"selected\" ';?>>-00Symb</option>
		   	<option value="6"<? if ($currency_display['negative']=='6') echo ' selected=\"selected\" ';?>>00-Symb</option>
		   	<option value="7"<? if ($currency_display['negative']=='7') echo ' selected=\"selected\" ';?>>00Symb-</option>
		   	<option value="8"<? if ($currency_display['negative']=='8') echo ' selected=\"selected\" ';?>>-00 Symb</option>
		   	<option value="9"<? if ($currency_display['negative']=='9') echo ' selected=\"selected\" ';?>>-Symb 00</option>
		   	<option value="10"<? if ($currency_display['negative']=='10') echo ' selected=\"selected\" ';?>>00 Symb-</option>
		   	<option value="11"<? if ($currency_display['negative']=='11') echo ' selected=\"selected\" ';?>>Symb 00-</option>
		   	<option value="12"<? if ($currency_display['negative']=='12') echo ' selected=\"selected\" ';?>>Symb -00</option>
		   	<option value="13"<? if ($currency_display['negative']=='13') echo ' selected=\"selected\" ';?>>00- Symb</option>
		   	<option value="14"<? if ($currency_display['negative']=='14') echo ' selected=\"selected\" ';?>>(Symb 00)</option>
		   	<option value="15"<? if ($currency_display['negative']=='15') echo ' selected=\"selected\" ';?>>(00 Symb)</option>
        </select>
        <?php echo mosToolTip( $PHPSHOP_LANG->_PHPSHOP_CURRENCY_NEGATIVE_DISPLAY_TOOLTIP ) ?>
      </td>
    </tr>
 
    <tr> 
      <td width="22%" align="right" valign="top"><hr /><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_DESCRIPTION ?>:</td>
      <td width="78%" ><hr /><?
	  	  editorArea( 'editor1', $db->f("vendor_store_desc"), 'vendor_store_desc', '400', '200', '70', '15' )

      ?></td>
    </tr>
        <tr> 
      <td width="22%" align="right"  valign="top"><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_TOS ?>:</td>
      <td width="78%" ><?
	  editorArea( 'editor2', $db->f("vendor_terms_of_service"), 'vendor_terms_of_service', '400', '200', '70', '15' )
      ?></td>
    </tr>
  </table>
  <?php
  $tabs->endTab();
  $tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_LBL, "store-page");
  ?>
  <table>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_STORE_NAME ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="vendor_store_name" value="<?php $db->sp("vendor_store_name") ?>" size="32" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_COMPANY_NAME ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="vendor_name" value="<?php $db->sp("vendor_name") ?>" size="32" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_URL ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="vendor_url" value="<?php $db->sp("vendor_url") ?>" size="32" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_ADDRESS_1 ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="vendor_address_1" value="<?php $db->sp("vendor_address_1") ?>" size="32" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_ADDRESS_2 ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="vendor_address_2" value="<?php $db->sp("vendor_address_2") ?>" size="32" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_CITY ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="vendor_city" value="<?php $db->sp("vendor_city") ?>" size="16" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_COUNTRY ?>:</td>
      <td width="78%" > 
        <?php $ps_html->list_country("vendor_country", $db->sf("vendor_country"), "onchange=\"changeStateList();\"") ?>
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_STATE ?>:</td>
      <td width="78%" ><?php 
        //$ps_html->list_states("vendor_state", $db->sf("vendor_state"));
        echo $ps_html->dynamic_state_lists( "vendor_country", "vendor_state", $db->sf("vendor_country"), $db->sf("vendor_state") );
        ?>
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_ZIP ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="vendor_zip" value="<?php $db->sp("vendor_zip") ?>" size="10" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_PHONE ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="vendor_phone" value="<?php $db->sp("vendor_phone") ?>" size="16" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" >&nbsp;</td>
      <td width="78%" > &nbsp;</td>
    </tr>
  </table>
  <?php
  $tabs->endTab();
  $tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_CONTACT_LBL, "contact-page");
  ?>
  <table>
    <tr>
      <td width="22%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_LAST_NAME ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="contact_last_name" value="<?php $db->sp("contact_last_name") ?>" size="16" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_FIRST_NAME ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="contact_first_name" value="<?php $db->sp("contact_first_name") ?>" size="16" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_MIDDLE_NAME ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="contact_middle_name" value="<?php $db->sp("contact_middle_name") ?>" size="16">
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_TITLE ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="contact_title" value="<?php $db->sp("contact_title") ?>" size="16" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_PHONE_1 ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="contact_phone_1" value="<?php $db->sp("contact_phone_1") ?>" size="16" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_PHONE_2 ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="contact_phone_2" value="<?php $db->sp("contact_phone_2") ?>" size="16" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_FAX ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="contact_fax" value="<?php $db->sp("contact_fax") ?>" size="16" />
      </td>
    </tr>
    <tr> 
      <td width="22%" align="right" > <?php echo $PHPSHOP_LANG->_PHPSHOP_STORE_FORM_EMAIL ?>:</td>
      <td width="78%" > 
        <input type="text" class="inputbox" name="contact_email" value="<?php $db->sp("contact_email") ?>" size="32" />
      </td>
    </tr>
    <tr> 
      <td colspan="2" align="center" >&nbsp;</td>
    </tr>
  </table>
<?php
$tabs->endTab();
$tabs->endPane();

// Add necessary hidden fields
$formObj->hiddenField( 'vendor_id', $ps_vendor_id );
$formObj->hiddenField( 'vendor_thumb_image_action', 'none' );
$formObj->hiddenField( 'vendor_full_image_action', 'none' );

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( "vendorUpdate", $modulename.'.display', $option );

?>